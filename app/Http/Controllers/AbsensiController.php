<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal_absensi ?? now()->toDateString();
        $matakuliah_id = $request->matakuliah_id;

        $mahasiswa = Mahasiswa::orderBy('NIM', 'asc')->get();

        $matakuliah = Matakuliah::orderBy('nama_matakuliah')->get();

        $absensi = collect();

        if ($matakuliah_id) {
            $absensi = Absensi::where('tanggal_absensi', $tanggal)
                ->where('matakuliah_id', $matakuliah_id)
                ->get()
                ->keyBy('mahasiswa_id');
        }

        return view('absensi.index', compact(
            'tanggal',
            'matakuliah_id',
            'mahasiswa',
            'matakuliah',
            'absensi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'absensi' => 'required|array',
            'absensi.*' => 'required|in:H,A,I,S'
        ]);

        foreach ($request->absensi as $mahasiswa_id => $status) {

            Mahasiswa::findOrFail($mahasiswa_id);

            Absensi::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa_id,
                    'matakuliah_id' => $request->matakuliah_id,
                    'tanggal_absensi' => $request->tanggal_absensi
                ],
                [
                    'status_absen' => $status
                ]
            );
        }

        return redirect()->route('absensi.index', [
            'tanggal_absensi' => $request->tanggal_absensi,
            'matakuliah_id' => $request->matakuliah_id
        ])->with('success', 'Data absensi berhasil disimpan.');
    }
}