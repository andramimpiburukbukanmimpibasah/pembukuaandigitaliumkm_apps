<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan {{ $umkm?->nama_usaha ?? 'UMKM' }}</title>
    <style>
        @page { margin: 18mm 14mm 24mm 14mm; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1e293b; }

        .header { width: 100%; border-bottom: 2px solid #115468; padding-bottom: 10px; margin-bottom: 14px; }
        .header table { width: 100%; border-collapse: collapse; }
        .header .logo { width: 90px; vertical-align: middle; }
        .header .title { vertical-align: middle; }
        .header h1 { font-size: 18px; margin: 0 0 2px; color: #115468; text-transform: uppercase; }
        .header .subtitle { margin: 0; color: #64748b; font-size: 11px; }

        .info { margin-bottom: 18px; font-size: 11px; }
        .info table { width: 100%; border-collapse: collapse; }
        .info td { padding: 2px 0; }
        .info .label { color: #64748b; width: 140px; }
        .info .value { font-weight: bold; color: #1e293b; }

        .summary { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .summary td { width: 33.33%; border: 1px solid #e2e8f0; padding: 12px; text-align: center; }
        .summary .label { display: block; color: #64748b; font-size: 11px; margin-bottom: 4px; }
        .summary .value { font-size: 16px; font-weight: bold; }

        table.data { width: 100%; border-collapse: collapse; }
        table.data th, table.data td { border: 1px solid #e2e8f0; padding: 6px 8px; text-align: left; }
        table.data th { background: #f1f5f9; font-size: 11px; }
        .pemasukan { color: #148d3a; }
        .pengeluaran { color: #dc2626; }

        .footer {
            position: fixed;
            bottom: -17mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="footer">
        Dokumen ini dicetak secara otomatis melalui Sistem Laporan Keuangan UMKM pada {{ date('d-m-Y H:i') }} WITA
    </div>

    <!-- Official Header -->
    <div class="header">
        <table>
            <tr>
                <td class="logo">
                    <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo Pusat Layanan Kemasan" style="height: 56px;">
                </td>
                <td class="title">
                    <h1>LAPORAN KEUANGAN UMKM</h1>
                    <p class="subtitle">Binaan Pusat Layanan Kemasan Provinsi Kalimantan Selatan</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Laporan Info -->
    <div class="info">
        <table>
            @if ($umkm?->nama_usaha)
                <tr>
                    <td class="label">Nama Usaha</td>
                    <td class="value">: {{ $umkm->nama_usaha }}</td>
                </tr>
            @endif
            @if ($umkm?->pemilik)
                <tr>
                    <td class="label">Pemilik</td>
                    <td class="value">: {{ $umkm->pemilik }}</td>
                </tr>
            @endif
            <tr>
                <td class="label">Periode Laporan</td>
                <td class="value">: {{ $start->format('d F Y') }} - {{ $end->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="summary">
        <tr>
            <td><span class="label">Total Pemasukan</span><span class="value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span></td>
            <td><span class="label">Total Pengeluaran</span><span class="value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span></td>
            <td><span class="label">Laba Bersih</span><span class="value">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</span></td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Metode</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cashes as $cash)
                <tr>
                    <td>{{ $cash->tanggal->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($cash->jenis) }}</td>
                    <td>{{ $cash->kategori }}</td>
                    <td>{{ $cash->metode ?? '-' }}</td>
                    <td class="{{ $cash->jenis }}">Rp {{ number_format($cash->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Tidak ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
