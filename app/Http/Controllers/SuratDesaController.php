<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\SuratMasukService;
use App\Services\SuratKeluarService;
use Illuminate\Pagination\LengthAwarePaginator;

class SuratDesaController extends Controller
{
    protected $suratMasukService;
    protected $suratKeluarService;

    public function __construct(SuratMasukService $suratMasukService, SuratKeluarService $suratKeluarService)
    {
        $this->suratMasukService = $suratMasukService;
        $this->suratKeluarService = $suratKeluarService;
    }

    public function index(Request $request)
    {
        // Validasi input filter
        $request->validate([
            'search' => 'nullable|string|max:100',
            'jenis' => 'nullable|in:masuk,keluar',
            'sort' => 'nullable|in:terbaru,terlama',
        ]);

        // Ambil berdasarkan jenis
        $masuk = collect();
        $keluar = collect();

        if (!$request->filled('jenis') || $request->jenis == 'masuk') {
            $masuk = $this->suratMasukService->getFiltered($request, false)->map(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal_terima);
                $item->jenis = 'masuk';
                return $item;
            });
        }

        if (!$request->filled('jenis') || $request->jenis == 'keluar') {
            $keluar = $this->suratKeluarService->getFiltered($request, false)->map(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal_kirim);
                $item->jenis = 'keluar';
                return $item;
            });
        }

        // Gabungkan dan sort
        $all = $masuk->concat($keluar);

        if ($request->sort == 'terlama') {
            $all = $all->sortBy('tanggal')->values();
        } else {
            $all = $all->sortByDesc('tanggal')->values(); // default terbaru
        }

        // Paginate manual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 12;
        $pagedData = $all->slice(($currentPage - 1) * $perPage, $perPage);
        $pagination = new LengthAwarePaginator(
            $pagedData,
            $all->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('surat-desa', [
            'surat' => $pagination,
        ]);
    }

    public function showMasuk($id)
    {
        $surat = $this->suratMasukService->getById($id);
        return view('surat.surat-masuk-show', compact('surat'));
    }

    public function showKeluar($id)
    {
        $surat = $this->suratKeluarService->getById($id);
        return view('surat.surat-keluar-show', compact('surat'));
    }
}
