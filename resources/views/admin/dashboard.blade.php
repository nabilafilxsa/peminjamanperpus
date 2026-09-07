<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                    <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
                    <div class="alert alert-info mt-3">
                        Kamu berhasil login sebagai <strong>Administrator</strong>.
                    </div>
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-primary mt-3">Kelola Buku</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>