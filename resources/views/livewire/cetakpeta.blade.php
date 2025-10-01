<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Potensi Sawah</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 0;
            font-size: 12px;
            color: #000;
        }

        @page {
            margin: 30px;
        }

        .frame {
            border: 2px solid #000;
            padding: 40px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            page-break-inside: avoid;
        }

        /* Main content grows */
        .content {
            flex: 1;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            height: 80px;
            position: absolute;
            top: 0;
        }
        .header .logo-left {
            left: 0;
        }
        .header .logo-right {
            right: 0;
        }
        .header h2, .header h3, .header h4 {
            margin: 2px 0;
        }
        .header h2 {
            font-size: 18px;
            font-weight: bold;
        }
        .header h3 {
            font-size: 14px;
            font-weight: normal;
        }
        .header h4 {
            font-size: 14px;
            text-decoration: underline;
        }
        .report-meta {
            margin-top: 10px;
            font-size: 12px;
            text-align: center;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        th, td {
            padding: 6px;
            text-align: center;
            font-size: 12px;
        }
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Signatures */
        .signatures {
            margin-top: auto; /* push signatures to bottom */
            display: flex;
            justify-content: space-between;
            padding-top: 40px;
        }
        .signature-box {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto 5px auto;
            height: 2px;
        }
        .signature-box p {
            margin: 2px 0;
        }

        /* Footer */
        .generated {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="frame">
        <div class="content">
            <!-- Header -->
            <div class="header">
                <img src="https://lgubangar.gov.ph/wp-content/uploads/2021/10/cropped-tablogo.png" alt="Logo Left" class="logo-left">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Bagong_Pilipinas_logo.png" alt="Logo Right" class="logo-right">
                
                <h2>AGRI BANGAR</h2>
                <h3>OFFICE FOR AGRICULTURAL SERVICES</h3>
                <h4>Land Information Report</h4>

                @if($petas->isNotEmpty())
                    <div class="report-meta">
                        Year: {{ $tahun ?? 'All' }} |
                        {{ $kecamatan ?? ($petas->first()->town_name ?? '-') }} |
                        Barangay: {{ $desa ?? ($petas->first()->barangay_name ?? '-') }}
                    </div>
                @endif
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barangay Name</th>
                        <th>Farmer / Land Owner</th>
                        <th>Crop Type</th>
                        <th>Land Area (Ha)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petas as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->barangay_name }}</td>
                            <td>{{ $item->farmer_name }}</td>
                            <td>{{ $item->crop_type }}</td>
                            <td>{{ $item->land_area }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No Data Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Signatures -->
        <div class="signatures">
            <div class="signature-box">
                <div class="signature-line"></div>
                <p><strong>Regina M. Labiano</strong></p>
                <p>Municipal Agriculturist</p>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <p><strong>__________________</strong></p>
                <p>Head of Department</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="generated">
            <p>Generated on: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>
