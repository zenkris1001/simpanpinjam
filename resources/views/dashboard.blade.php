@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Ringkasan pengajuan pembiayaan nasabah.
        </p>
    </div>


    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Total --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Pengajuan
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalPengajuan }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <span class="text-blue-600 text-xl">
                        📄
                    </span>
                </div>

            </div>
        </div>


        {{-- Pending --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Pending
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $pending }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center">
                    <span class="text-yellow-600 text-xl">
                        ⏳
                    </span>
                </div>

            </div>
        </div>


        {{-- Disetujui --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Disetujui
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $disetujui }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                    <span class="text-green-600 text-xl">
                        ✓
                    </span>
                </div>

            </div>
        </div>


        {{-- Ditolak --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Ditolak
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $ditolak }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                    <span class="text-red-600 text-xl">
                        ✕
                    </span>
                </div>

            </div>
        </div>

    </div>


    {{-- Welcome --}}
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

        <h2 class="text-xl font-semibold text-gray-800">
            Selamat Datang 👋
        </h2>

        <p class="text-gray-500 mt-2 leading-relaxed">
            Gunakan sistem ini untuk mencatat, melihat, dan memproses
            pengajuan pembiayaan nasabah.
        </p>

        <div class="mt-6">

            <a href="{{ route('applications.create') }}"
               class="inline-flex items-center px-5 py-3 rounded-xl bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition">

                + Tambah Pengajuan

            </a>

        </div>

    </div>

</div>

@endsection