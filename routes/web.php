<?php

use App\Models\ArsipSurat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

// Export CSV
Route::get('/admin/export-arsip', function () {
    $filename = 'arsip-surat-' . now()->format('Y-m-d') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'No', 'Jenis', 'Nomor Surat', 'Kategori', 'Perihal',
            'Asal', 'Tujuan', 'Tanggal Surat', 'Tanggal Terima', 'Keterangan',
        ]);

        $no = 1;
        $data = ArsipSurat::with('kategori')->orderBy('tanggal_surat', 'desc')->get();

        foreach ($data as $row) {
            fputcsv($file, [
                $no++,
                $row->jenis === 'masuk' ? 'Masuk' : 'Keluar',
                $row->nomor_surat,
                $row->kategori->nama ?? '-',
                $row->perihal,
                $row->asal ?? '-',
                $row->tujuan ?? '-',
                $row->tanggal_surat ? \Carbon\Carbon::parse($row->tanggal_surat)->format('d/m/Y') : '-',
                $row->tanggal_terima ? \Carbon\Carbon::parse($row->tanggal_terima)->format('d/m/Y') : '-',
                $row->keterangan ?? '-',
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
});

// Print surat
Route::get('/admin/arsip-surat/{id}/print', function ($id) {
    $surat = ArsipSurat::with(['kategori', 'user'])->findOrFail($id);
    return view('print.arsip-surat', compact('surat'));
})->name('arsip.print');
