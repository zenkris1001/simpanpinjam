@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">
                Tambah Pengajuan
            </h1>

            <p class="text-gray-500 mt-1">
                Masukkan data pengajuan pembiayaan nasabah.
            </p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="font-semibold text-red-700 mb-2">
                    Terdapat kesalahan:
                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('applications.store') }}"
              method="POST"
              class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div class="md:col-span-2">

                    <label for="nama_lengkap"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap Nasabah
                    </label>

                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >

                </div>

                {{-- Tipe --}}
                <div>

                    <label for="tipe_pengajuan"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Pengajuan
                    </label>

                    <select
                        id="tipe_pengajuan"
                        name="tipe_pengajuan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >

                        <option value="">
                            Pilih tipe pengajuan
                        </option>

                        <option value="Sepeda Motor"
                            {{ old('tipe_pengajuan') == 'Sepeda Motor' ? 'selected' : '' }}>
                            Sepeda Motor
                        </option>

                        <option value="Mobil"
                            {{ old('tipe_pengajuan') == 'Mobil' ? 'selected' : '' }}>
                            Mobil
                        </option>

                        <option value="Multiguna"
                            {{ old('tipe_pengajuan') == 'Multiguna' ? 'selected' : '' }}>
                            Multiguna
                        </option>

                    </select>

                </div>

                {{-- Nominal --}}
                <div>

                    <label for="nominal"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Nominal Pengajuan
                    </label>

                    <input
                        type="number"
                        id="nominal"
                        name="nominal"
                        value="{{ old('nominal') }}"
                        min="1"
                        max="200000000"
                        placeholder="Contoh: 50000000"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >

                    <p class="text-xs text-gray-500 mt-1">
                        Maksimal Rp200.000.000
                    </p>

                </div>

                {{-- Tenor --}}
                <div>

                    <label for="tenor"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Tenor (Bulan)
                    </label>

                    <input
                        type="number"
                        id="tenor"
                        name="tenor"
                        value="{{ old('tenor') }}"
                        min="1"
                        max="24"
                        placeholder="Contoh: 12"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >

                    <p class="text-xs text-gray-500 mt-1">
                        Maksimal 24 bulan
                    </p>

                </div>

                {{-- Pendapatan --}}
                <div>

                    <label for="pendapatan_bulanan"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Pendapatan Bulanan
                    </label>

                    <input
                        type="number"
                        id="pendapatan_bulanan"
                        name="pendapatan_bulanan"
                        value="{{ old('pendapatan_bulanan') }}"
                        min="1000000"
                        placeholder="Contoh: 5000000"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >

                    <p class="text-xs text-gray-500 mt-1">
                        Minimal Rp1.000.000
                    </p>

                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">

                    <label for="catatan"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan
                    </label>

                    <textarea
                        id="catatan"
                        name="catatan"
                        rows="4"
                        placeholder="Masukkan catatan jika diperlukan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-500"
                    >{{ old('catatan') }}</textarea>

                </div>

            </div>

            {{-- Button --}}
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">

                <a href="/"
                   class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-lg bg-slate-900 text-white hover:bg-slate-800 transition">
                    Simpan Pengajuan
                </button>

            </div>

        </form>

    </div>

@endsection