<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Menampilkan daftar pengajuan.
     */
    public function index(Request $request)
    {
        $query = Application::query();

        // Search berdasarkan nama nasabah
        if ($request->filled('search')) {
            $query->where(
                'nama_lengkap',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Pagination
        $applications = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistik
        $totalPengajuan = Application::where('status', '!=', 'Lunas')->count();

        $pending = Application::where('status', 'Pending')->count();

        $disetujui = Application::where('status', 'Disetujui')->count();

        $ditolak = Application::where('status', 'Ditolak')->count();

        return view('applications.index', [
            'title' => 'Daftar Pengajuan',
            'applications' => $applications,
            'totalPengajuan' => $totalPengajuan,
            'pending' => $pending,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
        ]);
    }


    /**
     * Menampilkan detail pengajuan.
     */
    public function show(Application $application)
    {
        return view('applications.show', [
            'title' => 'Detail Pengajuan',
            'application' => $application,
        ]);
    }


    /**
     * Menampilkan form tambah pengajuan.
     */
    public function create()
    {
        return view('applications.create', [
            'title' => 'Tambah Pengajuan',
        ]);
    }


    /**
     * Menyimpan pengajuan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_lengkap' => [
                    'required',
                    'string',
                    'max:255'
                ],

                'tipe_pengajuan' => [
                    'required',
                    'in:Sepeda Motor,Mobil,Multiguna'
                ],

                'nominal' => [
                    'required',
                    'numeric',
                    'min:1',
                    'max:200000000'
                ],

                'tenor' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:24'
                ],

                'pendapatan_bulanan' => [
                    'required',
                    'numeric',
                    'min:1000000'
                ],

                'catatan' => [
                    'nullable',
                    'string'
                ],
            ],
            [
                'nama_lengkap.required' =>
                    'Nama lengkap wajib diisi.',

                'tipe_pengajuan.required' =>
                    'Tipe pengajuan wajib dipilih.',

                'nominal.required' =>
                    'Nominal pengajuan wajib diisi.',

                'nominal.max' =>
                    'Nominal maksimal pengajuan adalah Rp200.000.000.',

                'tenor.required' =>
                    'Tenor wajib diisi.',

                'tenor.max' =>
                    'Tenor maksimal adalah 24 bulan.',

                'pendapatan_bulanan.required' =>
                    'Pendapatan bulanan wajib diisi.',

                'pendapatan_bulanan.min' =>
                    'Nasabah belum dapat mengajukan pinjaman.',
            ]
        );


        // Cek maksimal 3 pengajuan berdasarkan nama
        $jumlahPengajuan = Application::where(
            'nama_lengkap',
            $validated['nama_lengkap']
        )->count();


        if ($jumlahPengajuan >= 3) {
            return back()
                ->withInput()
                ->withErrors([
                    'nama_lengkap' =>
                        'Nasabah sudah mencapai maksimal 3 kali pengajuan.',
                ]);
        }


        // Perhitungan cicilan per bulan
        $cicilanPerBulan =
            $validated['nominal'] / $validated['tenor'];


        // Simpan data
        Application::create([
            'nama_lengkap' =>
                $validated['nama_lengkap'],

            'tipe_pengajuan' =>
                $validated['tipe_pengajuan'],

            'nominal' =>
                $validated['nominal'],

            'tenor' =>
                $validated['tenor'],

            'pendapatan_bulanan' =>
                $validated['pendapatan_bulanan'],

            'cicilan_per_bulan' =>
                $cicilanPerBulan,

            'catatan' =>
                $validated['catatan'] ?? null,

            'status' =>
                'Pending',
        ]);


        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Pengajuan berhasil ditambahkan.'
            );
    }


    /**
     * Menyetujui pengajuan.
     */
    public function approve(Application $application)
    {
        // Hanya pengajuan Pending yang boleh disetujui
        if ($application->status !== 'Pending') {
            return back()->withErrors([
                'status' =>
                    'Pengajuan ini sudah memiliki keputusan.',
            ]);
        }


        // Cek maksimal nominal
        if ($application->nominal > 200000000) {
            return back()->withErrors([
                'status' =>
                    'Nominal maksimal pinjaman yang dapat disetujui adalah Rp200.000.000.',
            ]);
        }


        $application->update([
            'status' => 'Disetujui',
        ]);


        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Pengajuan berhasil disetujui.'
            );
    }


    /**
     * Menolak pengajuan.
     */
    public function reject(Application $application)
    {
        // Hanya pengajuan Pending yang boleh ditolak
        if ($application->status !== 'Pending') {
            return back()->withErrors([
                'status' =>
                    'Pengajuan ini sudah memiliki keputusan.',
            ]);
        }


        $application->update([
            'status' => 'Ditolak',
        ]);


        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Pengajuan berhasil ditolak.'
            );
    }


    /**
     * Menandai pengajuan sebagai lunas.
     */
    public function lunas(Application $application)
    {
        // Hanya pengajuan Disetujui yang dapat dilunasi
        if ($application->status !== 'Disetujui') {
            return back()->withErrors([
                'status' =>
                    'Hanya pengajuan yang sudah disetujui yang dapat ditandai sebagai lunas.',
            ]);
        }


        $application->update([
            'status' => 'Lunas',
        ]);


        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Pengajuan berhasil ditandai sebagai lunas.'
            );
    }
}