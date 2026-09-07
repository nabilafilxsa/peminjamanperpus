<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
{
    $bukus = Buku::all();
    return view('admin.buku.index', compact('bukus'));
}

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create($request->all());
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus,kode_buku,'.$buku->id,
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $buku->update($request->all());
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}