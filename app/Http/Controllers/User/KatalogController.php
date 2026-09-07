<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    // Halaman katalog + riwayat
    public function index()
    {
        // Buku dengan stok > 0
        $bukus = Buku::where('stok', '>', 0)->get();

        // Riwayat peminjaman user yang sedang login
        $riwayat = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('bukus', 'riwayat'));
    }

    // Proses peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('dashboard')->with('success', 'Berhasil meminjam buku. Silakan ambil buku di perpustakaan.');
    }

    // Proses pengembalian buku (mandiri)
    public function kembali(Peminjaman $peminjaman)
    {
        // Pastikan peminjaman milik user yang login
        if ($peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        // Pastikan status masih dipinjam
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Update status dan tambah stok
        $peminjaman->update(['status' => 'dikembalikan']);
        $peminjaman->buku->increment('stok');

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dikembalikan. Terima kasih!');
    }
}