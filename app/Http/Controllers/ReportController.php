<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $start = Carbon::parse($request->input('tanggal_mulai', now()->startOfMonth()))->startOfDay();
        $end = Carbon::parse($request->input('tanggal_selesai', now()))->endOfDay();

        if ($start->gt($end)) {
            [$start, $end] = [$end, $start];
        }

        $cashes = Cash::whereBetween('tanggal', [$start, $end])->get();

        $totalPemasukan = $cashes->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $cashes->where('jenis', 'pengeluaran')->sum('nominal');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        $chart = $this->monthlyChartData($start, $end);

        return view('reports.index', compact(
            'cashes',
            'totalPemasukan',
            'totalPengeluaran',
            'labaBersih',
            'start',
            'end',
            'chart'
        ));
    }

    public function exportPdf(Request $request)
    {
        $data = $this->reportData($request);

        $pdf = Pdf::loadView('reports.pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-keuangan.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->reportData($request);
        $cashes = $data['cashes'];

        $filename = 'laporan-keuangan-'.now()->format('Ymd-His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($cashes) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['Tanggal', 'Jenis', 'Kategori', 'Nominal', 'Metode', 'Keterangan']);

            foreach ($cashes as $cash) {
                fputcsv($handle, [
                    $cash->tanggal->format('Y-m-d'),
                    ucfirst($cash->jenis),
                    $cash->kategori,
                    $cash->nominal,
                    $cash->metode ?? '-',
                    $cash->keterangan ?? '-',
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    private function reportData(Request $request): array
    {
        $start = Carbon::parse($request->input('tanggal_mulai', now()->startOfMonth()))->startOfDay();
        $end = Carbon::parse($request->input('tanggal_selesai', now()))->endOfDay();

        if ($start->gt($end)) {
            [$start, $end] = [$end, $start];
        }

        $cashes = Cash::whereBetween('tanggal', [$start, $end])->get();

        $totalPemasukan = $cashes->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $cashes->where('jenis', 'pengeluaran')->sum('nominal');

        $umkm = auth()->user()->umkm;

        return compact('cashes', 'totalPemasukan', 'totalPengeluaran', 'start', 'end', 'umkm');
    }

    private function monthlyChartData(Carbon $start, Carbon $end): array
    {
        $months = [];
        $labels = [];
        $cursor = $start->copy()->startOfMonth();

        while ($cursor->lte($end)) {
            $key = $cursor->format('Y-m');
            $labels[] = $cursor->translatedFormat('M Y');
            $months[$key] = ['pemasukan' => 0, 'pengeluaran' => 0];
            $cursor->addMonth();
        }

        Cash::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, jenis, SUM(nominal) as total")
            ->whereBetween('tanggal', [$start, $end])
            ->groupBy('bulan', 'jenis')
            ->get()
            ->each(function ($row) use (&$months) {
                if (isset($months[$row->bulan])) {
                    $months[$row->bulan][$row->jenis] = (int) $row->total;
                }
            });

        return [
            'labels' => $labels,
            'pemasukan' => array_values(array_column($months, 'pemasukan')),
            'pengeluaran' => array_values(array_column($months, 'pengeluaran')),
        ];
    }
}
