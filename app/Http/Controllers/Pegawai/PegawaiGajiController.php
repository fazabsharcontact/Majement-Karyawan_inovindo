<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Services\Pegawai\PegawaiGajiService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PegawaiGajiController extends Controller
{
    protected PegawaiGajiService $service;
    use AuthorizesRequests;

    public function __construct(PegawaiGajiService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $data = $this->service->getDashboardGajiPegawai(
            auth()->id(),
            $request->get('bulan'),
            $request->get('tahun')
        );

        return view('pegawai.gaji.index', $data);
    }

    public function unduhSlipGaji(Gaji $gaji)
    {
        $this->authorize('view', $gaji);

        return $this->service->downloadSlipGaji($gaji);
    }
}