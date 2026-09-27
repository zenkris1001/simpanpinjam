@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>

                <h1 class="text-2xl font-bold text-gray-900">
                    Detail Pengajuan
                </h1>

                <p class="text-gray-500 mt-1">
                    Informasi lengkap pengajuan pembiayaan nasabah.
                </p>

            </div>

            <a href="{{ route('applications.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">

                ← Kembali

            </a>

        </div>


        {{-- Status --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <p class="text-sm text-gray-500">
                        Status Pengajuan
                    </p>

                    <div class="mt-2">

                        @if ($application->status === 'Pending')

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                Pending
                            </span>

                        @elseif ($application->status === 'Disetujui')

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                Disetujui
                            </span>

                        @else

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                Ditolak
                            </span>

                        @endif

                    </div>

                </div>

                <div class="text-sm text-gray-500">

                    Tanggal Pengajuan:
                    <span class="font-medium text-gray-700">
                        {{ $application->created_at->format('d F Y, H:i') }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Informasi Nasabah --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">

            <h2 class="text-lg font-semibold text-gray-900 mb-6">
                Informasi Nasabah
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Nama Lengkap
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        {{ $application->nama_lengkap }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Pendapatan Bulanan
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        Rp {{ number_format($application->pendapatan_bulanan, 0, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Informasi Pengajuan --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">

            <h2 class="text-lg font-semibold text-gray-900 mb-6">
                Informasi Pembiayaan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Tipe Pengajuan
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        {{ $application->tipe_pengajuan }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Nominal Pengajuan
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        Rp {{ number_format($application->nominal, 0, ',', '.') }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Tenor
                    </p>

                    <p class="font-medium text-gray-900 mt-1">
                        {{ $application->tenor }} bulan
                    </p>

                </div>

            </div>

        </div>


        {{-- Kalkulasi Pembayaran --}}
        <div class="bg-slate-900 rounded-xl shadow-sm p-6 text-white mb-6">

            <h2 class="text-lg font-semibold">
                Kalkulasi Pembayaran
            </h2>

            <p class="text-slate-300 text-sm mt-1">
                Perhitungan pembayaran berdasarkan nominal pengajuan dan tenor.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Pengajuan
                    </p>

                    <p class="text-xl font-bold mt-1">
                        Rp {{ number_format($application->nominal, 0, ',', '.') }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-400">
                        Tenor
                    </p>

                    <p class="text-xl font-bold mt-1">
                        {{ $application->tenor }} bulan
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-400">
                        Tagihan Per Bulan
                    </p>

                    <p class="text-xl font-bold mt-1">
                        Rp {{ number_format($application->cicilan_per_bulan, 0, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Catatan --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

            <h2 class="text-lg font-semibold text-gray-900 mb-3">
                Catatan
            </h2>

            @if ($application->catatan)

                <p class="text-gray-600 leading-relaxed">
                    {{ $application->catatan }}
                </p>

            @else

                <p class="text-gray-400 italic">
                    Tidak ada catatan.
                </p>

            @endif

        </div>

    </div>

@endsection