<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.buku.update', $buku) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Kode Buku</label>
                            <input type="text" name="kode_buku" class="form-control" value="{{ $buku->kode_buku }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}" required min="0">
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>