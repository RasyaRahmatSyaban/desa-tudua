<?php

namespace App\Http\Controllers;

use App\Services\DanaKeluarService;
use App\Services\DanaMasukService;
use Illuminate\Http\Request;

class DanaDesaController extends Controller
{
    protected $danaMasukService;
    protected $danaKeluarService;

    public function __construct(DanaMasukService $danaMasukService, DanaKeluarService $danaKeluarService)
    {
        $this->danaMasukService = $danaMasukService;
        $this->danaKeluarService = $danaKeluarService;
    }

    public function index(Request $request)
    {
        $tahunMasuk = $this->danaMasukService->getAll()->pluck('tahun')->unique()->values();
        $tahunKeluar = $this->danaKeluarService->getAll()->pluck('tahun')->unique()->values();
        $availableYears = $tahunMasuk->merge($tahunKeluar)->unique()->sortDesc()->values();

        $tahunDipilih = $request->input('tahun', now()->year);

        $danaMasuk = $this->danaMasukService->getAll()->where('tahun', $tahunDipilih);
        $danaKeluar = $this->danaKeluarService->getAll()->where('tahun', $tahunDipilih);

        $totalMasuk = $danaMasuk->sum('jumlah');
        $totalKeluar = $danaKeluar->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        $danaMasukBulanan = $danaMasuk->groupBy('bulan')->map(function ($item) {
            return $item->sum('jumlah');
        });

        $danaKeluarBulanan = $danaKeluar->groupBy('bulan')->map(function ($item) {
            return $item->sum('jumlah');
        });

        $danaMasukDetailBulanan = $danaMasuk->groupBy('bulan')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'sumber' => $item->sumber,
                    'keterangan' => $item->keterangan,
                    'jumlah' => $item->jumlah,
                ];
            })->values();
        });

        $danaKeluarDetailBulanan = $danaKeluar->groupBy('bulan')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'keterangan' => $item->keterangan,
                    'jumlah' => $item->jumlah,
                ];
            })->values();
        });

        $bulanMapping = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view('dana-desa', compact(
            'availableYears',
            'tahunDipilih',
            'totalMasuk',
            'totalKeluar',
            'danaMasukBulanan',
            'danaKeluarBulanan',
            'danaMasukDetailBulanan',
            'danaKeluarDetailBulanan',
            'saldo',
            'bulanMapping',
        ));
    }
}