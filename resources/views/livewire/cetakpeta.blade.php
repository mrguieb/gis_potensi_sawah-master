<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Potensi Sawah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header, .footer {
            width: 100%;
            text-align: center;
        }
        .header img {
            height: 80px;
            float: left;
        }
        .header h2, .header h3 {
            margin: 0;
        }
        .frame {
            border: 3px solid #000;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: center;
            font-size: 12px;
        }
        .signatures {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 30%;
        }
        .generated {
            margin-top: 50px;
            text-align: right;
            font-size: 10px;
        }
        .logo-right {
            float: right;
            height: 80px;
        }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="frame">
        <!-- Header with logos -->
        <div class="header">
            <img src="https://yourdomain.com/logo-left.png" alt="Logo Left">
            <img src="https://yourdomain.com/logo-right.png" alt="Logo Right" class="logo-right">
            <div class="clear"></div>
            <h2>DINAS PERTANIAN</h2>
            <h3>KABUPATEN KOLAKA TIMUR</h3>
            <h4>Laporan Potensi Sawah</h4>
            @if($petas->isNotEmpty())
                <p>
                    Tahun: {{ request()->get('tahun') ?? 'Semua' }} |
                    Kecamatan: {{ $petas->first()->nama_kecamatan ?? '-' }} |
                    Desa: {{ $petas->first()->nama_desa ?? '-' }}
                </p>
            @endif
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Desa</th>
                    <th>Nama Pemilik</th>
                    <th>Jenis Tanah</th>
                    <th>Ketinggian</th>
                    <th>Kelembaban</th>
                    <th>Luas Sawah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_desa }}</td>
                        <td>{{ $item->nama_pemiliklahan }}</td>
                        <td>{{ $item->jenis_tanah }}</td>
                        <td>{{ $item->ketinggian }} mpdl</td>
                        <td>{{ $item->kelembaban }}%</td>
                        <td>{{ $item->luas_lahan }} Ha</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Signatures -->
        <div class="signatures">
            <div class="signature-box">
                <p>Mengetahui,</p>
                <p><strong>Bupati</strong></p>
                <br><br>
                <p>__________________</p>
            </div>
            <div class="signature-box">
                <p>Kepala Dinas</p>
                <p><strong>Dinas Pertanian</strong></p>
                <br><br>
                <p>__________________</p>
            </div>
        </div>

        <!-- Generated on -->
        <div class="generated">
            <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>
