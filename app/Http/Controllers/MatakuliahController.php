<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::all();

        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliah,kode',
            'nama_matakuliah' => 'required'
        ]);

        Matakuliah::create([
            'id' => Str::uuid(),
            'kode' => $request->kode,
            'nama_matakuliah' => $request->nama_matakuliah
        ]);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:matakuliah,kode,' . $id . ',id',
            'nama_matakuliah' => 'required'
        ]);

        $matakuliah->update([
            'kode' => $request->kode,
            'nama_matakuliah' => $request->nama_matakuliah
        ]);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}