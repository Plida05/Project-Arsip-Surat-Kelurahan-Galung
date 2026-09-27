<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Print Surat - {{ $surat->nomor_surat }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', serif; padding: 2cm; color: #000; }

        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .kop h1 { font-size: 18px; letter-spacing: 1px; }
        .kop h2 { font-size: 22px; font-weight: bold; margin: 5px 0; }
        .kop p { font-size: 12px; font-style: italic; }

        .title {
            text-align: center;
            margin: 30px 0;
        }
        .title h3 {
            font-size: 16px;
            text-decoration: underline;
            letter-spacing: 2px;
        }
        .title p { font-size: 12px; margin-top: 5px; }

        .content {
            font-size: 14px;
            line-height: 1.8;
            margin: 30px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table.data td {
            padding: 8px 10px;
            vertical-align: top;
            font-size: 14px;
        }
        table.data td:first-child {
            width: 200px;
            font-weight: bold;
        }
        table.data td:nth-child(2) {
            width: 20px;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
            font-size: 14px;
        }
        .ttd .nama {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            font-family: sans-serif;
        }
        .btn-print:hover { background: #d97706; }

        @media print {
            .btn-print { display: none; }
            body { padding: 1cm; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">🖨️ Print / Save PDF</button>

    <!-- KOP SURAT -->
    <div class="kop">
        <h1>PEMERINTAH KOTA ___________</h1>
        <h1>KECAMATAN ___________</h1>
        <h2>KELURAHAN GALUNG</h2>
        <p>Jl. ______________________ No. ___ Telp. (____) ___________</p>
    </div>

    <!-- TITLE -->
    <div class="title">
        <h3>LEMBAR ARSIP SURAT</h3>
        <p>Nomor: {{ $surat->nomor_surat }}</p>
    </div>

    <!-- DATA SURAT -->
    <div class="content">
        <table class="data">
            <tr>
                <td>Jenis Surat</td>
                <td>:</td>
                <td>{{ $surat->jenis === 'masuk' ? 'Surat Masuk' : 'Surat Keluar' }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td>{{ $surat->kategori->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nomor Surat</td>
                <td>:</td>
                <td>{{ $surat->nomor_surat }}</td>
            </tr>
            @if($surat->jenis === 'masuk')
            <tr>
                <td>Asal Surat</td>
                <td>:</td>
                <td>{{ $surat->asal ?? '-' }}</td>
            </tr>
            @else
            <tr>
                <td>Tujuan Surat</td>
                <td>:</td>
                <td>{{ $surat->tujuan ?? '-' }}</td>
            </tr>
            @endif
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>{{ $surat->perihal }}</td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->isoFormat('D MMMM Y') }}</td>
            </tr>
            @if($surat->tanggal_terima)
            <tr>
                <td>Tanggal Diterima</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal_terima)->isoFormat('D MMMM Y') }}</td>
            </tr>
            @endif
            @if($surat->keterangan)
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>{{ $surat->keterangan }}</td>
            </tr>
            @endif
        </table>
    </div>

    <!-- TANDA TANGAN -->
    <div class="ttd">
        <p>Galung, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kepala Kelurahan Galung</p>
        <p class="nama">________________________</p>
    </div>
</body>
</html>
