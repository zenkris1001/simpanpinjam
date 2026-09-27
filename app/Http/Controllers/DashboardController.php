<?php

namespace App\Http\Controllers;

use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = Application::where('status', '!=', 'Lunas')->count();

        $pending = Application::where('status', 'Pending')->count();

        $disetujui = Application::where('status', 'Disetujui')->count();

        $ditolak = Application::where('status', 'Ditolak')->count();

        return view('dashboard', [
            'title' => 'Dashboard',
            'totalPengajuan' => $totalPengajuan,
            'pending' => $pending,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
        ]);
    }
}