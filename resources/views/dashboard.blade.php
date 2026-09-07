<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: #6c2bd9;">
            {{ __('📚 Katalog & Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow" style="border-left: 6px solid #22c55e;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow" style="border-left: 6px solid #ef4444;">
                    {{ session('error') }}
                </div>
            @endif

            {{-- KATALOG BUKU --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" style="border: 2px solid #d8b4fe;">
                <h3 class="text-lg font-bold text-gray-800 mb-4" style="color: #6c2bd9;">📖 Daftar Katalog Buku Tersedia</h3>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-purple-100 text-gray-700">
                            <th class="border border-gray-300 p-2">Kode</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2">Pengarang</th>
                            <th class="border border-gray-300 p-2">Penerbit</th>
                            <th class="border border-gray-300 p-2">Stok</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $buku)
                            <tr class="hover:bg-purple-50">
                                <td class="border border-gray-300 p-2 text-center font-medium">{{ $buku->kode_buku }}</td>
                                <td class="border border-gray-300 p-2">{{ $buku->judul }}</td>
                                <td class="border border-gray-300 p-2">{{ $buku->pengarang }}</td>
                                <td class="border border-gray-300 p-2">{{ $buku->penerbit }}</td>
                                <td class="border border-gray-300 p-2 text-center">{{ $buku->stok }}</td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <form action="{{ route('user.pinjam') }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <input type="hidden" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                        <button type="submit" 
                                                style="background-color: #059669 !important; 
                                                       color: #ffffff !important; 
                                                       font-weight: bold !important; 
                                                       padding: 8px 16px; 
                                                       border-radius: 6px; 
                                                       border: 2px solid #065f46 !important; 
                                                       font-size: 14px; 
                                                       cursor: pointer;
                                                       box-shadow: 0 2px 4px rgba(0,0,0,0.3);
                                                       min-width: 80px;">
                                            📌 Pinjam
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 p-4 text-center text-gray-500">
                                    Semua stok buku sedang kosong atau habis dipinjam.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- RIWAYAT PEMINJAMAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" style="border: 2px solid #d8b4fe;">
                <h3 class="text-lg font-bold text-gray-800 mb-4" style="color: #6c2bd9;">📋 Riwayat Peminjaman Saya</h3>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-purple-100 text-gray-700">
                            <th class="border border-gray-300 p-2">No</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2">Tgl Pinjam</th>
                            <th class="border border-gray-300 p-2">Batas Kembali</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $index => $r)
                            <tr class="hover:bg-purple-50">
                                <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 p-2">{{ $r->buku->judul }}</td>
                                <td class="border border-gray-300 p-2 text-center">{{ $r->tanggal_pinjam }}</td>
                                <td class="border border-gray-300 p-2 text-center">{{ $r->tanggal_kembali }}</td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $r->status === 'dipinjam' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 p-2 text-center">
                                    @if($r->status === 'dipinjam')
                                        <form action="{{ route('user.kembali', $r->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    style="background-color: #2563eb !important; 
                                                           color: #ffffff !important; 
                                                           font-weight: bold !important; 
                                                           padding: 8px 16px; 
                                                           border-radius: 6px; 
                                                           border: 2px solid #1e3a8a !important; 
                                                           font-size: 14px; 
                                                           cursor: pointer;
                                                           box-shadow: 0 2px 4px rgba(0,0,0,0.3);
                                                           min-width: 80px;">
                                                🔄 Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span style="background-color: #d1d5db !important; 
                                                     color: #1f2937 !important; 
                                                     padding: 4px 12px; 
                                                     border-radius: 6px; 
                                                     font-size: 14px; 
                                                     font-weight: bold !important;
                                                     border: 1px solid #9ca3af;">
                                            ✅ Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 p-4 text-center text-gray-500">
                                    Belum ada riwayat peminjaman buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>