<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $totalPemasukan = Cash::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Cash::where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $laba = $saldo;
        $totalTransaksi = Transaction::count();
        $totalProduk = Product::count();

        $periods = [
            'today' => ['label' => 'Hari Ini'],
            '7_days' => ['label' => '7 Hari Terakhir'],
            'this_month' => ['label' => 'Bulan Ini'],
            '6_months' => ['label' => '6 Bulan Terakhir'],
        ];

        $filter = (string) $request->query('filter', '6_months');

        if (! array_key_exists($filter, $periods)) {
            $filter = '6_months';
        }

        $periodLabel = $periods[$filter]['label'];
        $chart = $this->buildChart($filter);

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'laba',
            'totalTransaksi',
            'totalProduk',
            'chart',
            'filter',
            'periodLabel'
        ));
    }

    private function buildChart(string $filter): array
    {
        [$interval, $intervalFormat, $groupFormat, $dateColumn, $count, $rangeStart, $label] = match ($filter) {
            'today' => [
                'hour',
                'Y-m-d H',
                '%Y-%m-%d %H',
                'created_at',
                24,
                Carbon::today(),
                fn (Carbon $cursor) => $cursor->format('H:00'),
            ],
            '7_days' => [
                'day',
                'Y-m-d',
                '%Y-%m-%d',
                'tanggal',
                7,
                Carbon::today()->subDays(6),
                fn (Carbon $cursor) => $cursor->translatedFormat('D d'),
            ],
            'this_month' => [
                'day',
                'Y-m-d',
                '%Y-%m-%d',
                'tanggal',
                Carbon::now()->day,
                Carbon::now()->startOfMonth(),
                fn (Carbon $cursor) => $cursor->translatedFormat('d M'),
            ],
            default => [
                'month',
                'Y-m',
                '%Y-%m',
                'tanggal',
                6,
                Carbon::now()->startOfMonth()->subMonths(5),
                fn (Carbon $cursor) => $cursor->translatedFormat('M'),
            ],
        };

        $series = [];
        $labels = [];
        $cursor = $rangeStart->copy();

        for ($i = 0; $i < $count; $i++) {
            $key = $cursor->format($intervalFormat);
            $labels[] = $label($cursor);
            $series[$key] = ['pemasukan' => 0, 'pengeluaran' => 0];

            if ($interval === 'hour') {
                $cursor->addHour();
            } elseif ($interval === 'day') {
                $cursor->addDay();
            } else {
                $cursor->addMonth();
            }
        }

        Cash::selectRaw("DATE_FORMAT({$dateColumn}, '{$groupFormat}') as bucket, jenis, SUM(nominal) as total")
            ->where($dateColumn, '>=', $rangeStart)
            ->groupBy('bucket', 'jenis')
            ->get()
            ->each(function ($row) use (&$series) {
                if (isset($series[$row->bucket])) {
                    $series[$row->bucket][$row->jenis] = (int) $row->total;
                }
            });

        return [
            'labels' => $labels,
            'pemasukan' => array_values(array_column($series, 'pemasukan')),
            'pengeluaran' => array_values(array_column($series, 'pengeluaran')),
        ];
    }
}
