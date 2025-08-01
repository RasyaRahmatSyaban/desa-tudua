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
use App\Services\PerangkatDesaService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            $totalPenduduk = Penduduk::count();
            $totalSuratMasuk = SuratMasuk::count();
            $totalDanaMasuk = new DanaMasukService()->getAll()->sum('jumlah');
            $totalDanaKeluar = new DanaKeluarService()->getAll()->sum('jumlah');
            $berita = new BeritaService()->getPaginated();
            $pengumuman = new PengumumanService()->getPaginated();
            return view('admin.dashboard', compact(
                'totalPenduduk',
                'totalSuratMasuk',
                'totalDanaMasuk',
                'totalDanaKeluar',
                'berita',
                'pengumuman'
            ));
        } else {
            $berita = new BeritaService()->getPaginated(3);
            $kepalaDesa = new PerangkatDesaService()->getKepalaDesa();
            $request = new Request(['status' => 'aktif']);
            $pengumumanAktif = (new PengumumanService())->getFiltered($request);
            return view('dashboard', compact('berita', 'kepalaDesa', 'pengumumanAktif'));
        }
    }
}