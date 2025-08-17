<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar semua poli.
     */
    public function index()
    {
        $polis = Poli::latest()->paginate(10);
        return view('admin.polis.index', compact('polis'));
    }

    /**
     * Menampilkan form untuk membuat poli baru.
     */
    public function create()
    {
        return view('admin.polis.create');
    }

    /**
     * Menyimpan poli baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:polis,name',
            'description' => 'nullable|string',
        ]);

        // Buat data baru
        Poli::create($request->all());

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.polis.index')
                         ->with('success', 'Data Poli berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data poli.
     */
    public function edit(Poli $poli)
    {
        return view('admin.polis.edit', compact('poli'));
    }

    /**
     * Memperbarui data poli di database.
     */
    public function update(Request $request, Poli $poli)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:polis,name,' . $poli->id,
            'description' => 'nullable|string',
        ]);

        // Update data
        $poli->update($request->all());

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.polis.index')
                         ->with('success', 'Data Poli berhasil diperbarui.');
    }

    /**
     * Menghapus data poli dari database.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();

        return redirect()->route('admin.polis.index')
                         ->with('success', 'Data Poli berhasil dihapus.');
    }
}