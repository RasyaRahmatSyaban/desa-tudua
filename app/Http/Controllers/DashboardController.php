<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use App\Models\KepalaKeluarga;
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

        $danaMasukService = new DanaMasukService();
        $danaKeluarService = new DanaKeluarService();
        $beritaService = new BeritaService();
        $pengumumanService = new PengumumanService();
        $perangkatService = new PerangkatDesaService();

        $totalPenduduk = Penduduk::count();
        $totalKepalaKeluarga = KepalaKeluarga::count();
        if ($user) {
            $totalSuratMasuk = SuratMasuk::count();
            $totalDanaMasuk = $danaMasukService->getAll()->sum('jumlah');
            $totalDanaKeluar = $danaKeluarService->getAll()->sum('jumlah');
            $berita = $beritaService->getPaginated();
            $pengumuman = $pengumumanService->getPaginated();
            return view('admin.dashboard', compact(
                'totalPenduduk',
                'totalSuratMasuk',
                'totalDanaMasuk',
                'totalDanaKeluar',
                'berita',
                'pengumuman'
            ));
        } else {
            $berita = $beritaService->getPaginated(3);
            $berita = $berita->where('status', 'Dipublikasi');
            $kepalaDesa = $perangkatService->getKepalaDesa();
            $request = new Request(['status' => 'aktif']);
            $pengumumanAktif = ($pengumumanService)->getFiltered($request);
            return view('dashboard', compact('berita', 'kepalaDesa', 'pengumumanAktif', 'totalPenduduk', 'totalKepalaKeluarga'));
        }
    }
}