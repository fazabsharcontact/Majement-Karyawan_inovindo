<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\MasterPotongan;
use App\Models\MasterTunjangan;
use App\Models\Pegawai;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\GajiMassalService;

class GajiMassalController extends Controller
{
    protected GajiMassalService $service;

    public function __construct(GajiMassalService $service)
    {
        $this->service = $service;
    }

    public function langkahSatu(Request $request)
    {
        $bulan = now()->month;
        $tahun = now()->year;

        return view('admin.gaji.gaji-massal-1', [
            'pegawaiBelumGajian' => $this->service->getPegawaiBelumGajian($bulan, $tahun),
            'divisis' => Divisi::orderBy('nama_divisi')->get(),
            'tims' => Tim::orderBy('nama_tim')->get(),
            'jabatans' => Jabatan::orderBy('nama_jabatan')->get(),
        ]);
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'pegawai_gaji' => 'required|array|min:1',
            'pegawai_gaji.*.pegawai_id' => 'required|exists:pegawais,id',
            'pegawai_gaji.*.gaji_pokok' => 'required|numeric',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'tunjangans' => 'nullable|array',
            'potongans' => 'nullable|array',
        ]);

        $jumlah = $this->service->simpanGajiMassal($validated);

        return redirect()
            ->route('admin.gaji.index')
            ->with('success', "Gaji untuk {$jumlah} pegawai berhasil ditambahkan.");
    }

    public function cekGajiSudahAda(Request $request)
    {
        $validated = $request->validate([
            'pegawai_ids' => 'required|array',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
        ]);

        return response()->json([
            'data' => $this->service->cekPegawaiSudahGajian(
                $validated['pegawai_ids'],
                $validated['bulan'],
                $validated['tahun']
            )
        ]);
    }
}