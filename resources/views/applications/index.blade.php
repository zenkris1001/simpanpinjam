@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Pengajuan</h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola dan proses pengajuan pembiayaan nasabah.
            </p>
        </div>

        <a href="{{ route('applications.create') }}"
           class="px-5 py-3 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800 transition">
            + Tambah Pengajuan
        </a>
    </div>


    {{-- Pesan --}}
    @if(session('success'))
        <div class="px-4 py-3 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="px-4 py-3 bg-red-50 border border-red-100 text-red-700 rounded-xl text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    {{-- Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 uppercase font-medium">Total Pengajuan</p>
            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalPengajuan }}</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 uppercase font-medium">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $pending }}</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 uppercase font-medium">Disetujui</p>
            <p class="text-2xl font-bold text-green-600 mt-2">{{ $disetujui }}</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 uppercase font-medium">Ditolak</p>
            <p class="text-2xl font-bold text-red-600 mt-2">{{ $ditolak }}</p>
        </div>

    </div>


    {{-- Search & Filter --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-4">

        <form method="GET" action="{{ route('applications.index') }}"
              class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama nasabah..."
                class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10">

            <select
                name="status"
                class="md:w-48 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10">

                <option value="">Semua Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>

            </select>

            <button
                type="submit"
                class="px-5 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800 transition">
                Filter
            </button>

            @if(request('search') || request('status'))
                <a href="{{ route('applications.index') }}"
                   class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 text-center">
                    Reset
                </a>
            @endif

        </form>

    </div>


    {{-- Table --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nasabah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nominal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tenor</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Cicilan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($applications as $application)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Nasabah --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-600">
                                        {{ strtoupper(substr($application->nama_lengkap, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $application->nama_lengkap }}
                                        </p>
                                        
                                    </div>

                                </div>
                            </td>


                            {{-- Tipe --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $application->tipe_pengajuan }}
                            </td>


                            {{-- Nominal --}}
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                Rp{{ number_format($application->nominal, 0, ',', '.') }}
                            </td>


                            {{-- Tenor --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $application->tenor }} bulan
                            </td>


                            {{-- Cicilan --}}
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-700">
                                    Rp{{ number_format($application->cicilan_per_bulan, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-400">/ bulan</p>
                            </td>


                            {{-- Tanggal --}}
                            <td class="px-6 py-4">
                                <p class="text-gray-600">
                                    {{ $application->created_at->format('d/m/Y') }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $application->created_at->format('H:i') }}
                                </p>
                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($application->status === 'Pending')

                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                        Pending
                                    </span>

                                @elseif($application->status === 'Disetujui')

                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                        Disetujui
                                    </span>

                                @elseif($application->status === 'Ditolak')

                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                        Ditolak
                                    </span>

                                @else

                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                        Lunas
                                    </span>

                                @endif

                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    <a href="{{ route('applications.show', $application->id) }}"
                                       class="px-3 py-2 rounded-lg bg-gray-50 text-gray-600 hover:bg-gray-100 text-xs font-medium">
                                        Detail
                                    </a>


                                    @if($application->status === 'Pending')

                                        <form action="{{ route('applications.approve', $application->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 text-xs font-medium">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('applications.reject', $application->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium">
                                                Tolak
                                            </button>
                                        </form>

                                    @elseif($application->status === 'Disetujui')

                                        <form action="{{ route('applications.lunas', $application->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin pengajuan ini sudah lunas?')">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium">
                                                Lunas
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">

                                <div class="text-gray-400">

                                    <div class="text-4xl mb-3">
                                        📄
                                    </div>

                                    <p class="font-semibold text-gray-700">
                                        Tidak ada pengajuan
                                    </p>

                                    <p class="text-sm mt-1">
                                        Belum ada data yang sesuai.
                                    </p>

                                    @if(request('search') || request('status'))

                                        <a href="{{ route('applications.index') }}"
                                           class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white rounded-lg text-sm">
                                            Reset Filter
                                        </a>

                                    @else

                                        <a href="{{ route('applications.create') }}"
                                           class="inline-block mt-4 px-4 py-2 bg-gray-900 text-white rounded-lg text-sm">
                                            Tambah Pengajuan
                                        </a>

                                    @endif

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if($applications->hasPages())

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <p class="text-sm text-gray-500">
                Menampilkan
                <span class="font-medium text-gray-700">{{ $applications->firstItem() }}</span>
                -
                <span class="font-medium text-gray-700">{{ $applications->lastItem() }}</span>
                dari
                <span class="font-medium text-gray-700">{{ $applications->total() }}</span>
                pengajuan
            </p>

            <div class="flex items-center gap-1">

                @if($applications->onFirstPage())
                    <span class="px-3 py-2 border rounded-lg text-gray-300 text-sm">
                        ←
                    </span>
                @else
                    <a href="{{ $applications->previousPageUrl() }}"
                       class="px-3 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm">
                        ←
                    </a>
                @endif


                @foreach($applications->getUrlRange(
                    max(1, $applications->currentPage() - 2),
                    min($applications->lastPage(), $applications->currentPage() + 2)
                ) as $page => $url)

                    @if($page == $applications->currentPage())

                        <span class="px-3 py-2 bg-gray-900 text-white rounded-lg text-sm">
                            {{ $page }}
                        </span>

                    @else

                        <a href="{{ $url }}"
                           class="px-3 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm">
                            {{ $page }}
                        </a>

                    @endif

                @endforeach


                @if($applications->hasMorePages())
                    <a href="{{ $applications->nextPageUrl() }}"
                       class="px-3 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm">
                        →
                    </a>
                @else
                    <span class="px-3 py-2 border rounded-lg text-gray-300 text-sm">
                        →
                    </span>
                @endif

            </div>

        </div>

    @endif

</div>

@endsection