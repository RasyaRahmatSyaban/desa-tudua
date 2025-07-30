<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use App\Models\Penduduk;
use App\Models\SuratMasuk;
use App\Services\BeritaService;
use App\Services\DanaKeluarService;
use App\Services\DanaMasukService;
use App\Services\PengumumanService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $totalSuratMasuk = SuratMasuk::count();
        $totalDanaMasuk = new DanaMasukService()->getAll()->sum('jumlah');
        $totalDanaKeluar = new DanaKeluarService()->getAll()->sum('jumlah');
        $berita = new BeritaService()->getPaginated();
        $pengumuman = new PengumumanService()->getPaginated();
        $user = auth()->user();
        if ($user) {
            return view('admin.dashboard', compact(
                'totalPenduduk',
                'totalSuratMasuk',
                'totalDanaMasuk',
                'totalDanaKeluar',
                'berita',
                'pengumuman'
            ));
        } else {
            return view('home.index', compact('danaKeluar'));
        }
    }
}