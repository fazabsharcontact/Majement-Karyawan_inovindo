<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\MasterTunjangan;
use App\Models\MasterPotongan;
use App\Services\GajiService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GajiController extends Controller
{
    protected GajiService $gajiService;

    public function __construct(GajiService $gajiService)
    {
        $this->gajiService = $gajiService;
    }

    /**
     * Menampilkan daftar semua data gaji.
     */
    public function index(Request $request)
    {
        $query = Gaji::with(['pegawai.jabatan'])->latest();

        $query->when($request->search, fn ($q) =>
            $q->whereHas('pegawai', fn ($sq) =>
                $sq->where('nama', 'like', "%{$request->search}%")
            )
        );

        $query->when($request->jabatan, fn ($q) =>
            $q->whereHas('pegawai.jabatan', fn ($sq) =>
                $sq->where('nama_jabatan', $request->jabatan)
            )
        );

        $query->when($request->bulan, fn ($q) =>
            $q->where('bulan', $request->bulan)
        );

        $query->when($request->tahun, fn ($q) =>
            $q->where('tahun', $request->tahun)
        );

        $gaji = $query->paginate(10);
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();

        $pegawaiBelumGajian = collect();
        if (Carbon::now()->day > 1) {
            $pegawaiBelumGajian = Pegawai::whereDoesntHave('gajis', function ($q) {
                $q->where('bulan', now()->month)
                  ->where('tahun', now()->year);
            })->with('jabatan')->orderBy('nama')->get();
        }

        return view('admin.gaji.index', compact(
            'gaji',
            'jabatan',
            'pegawaiBelumGajian'
        ));
    }

    /**
     * Form tambah gaji
     */
    public function create()
    {
        return view('admin.gaji.create', [
            'pegawais' => Pegawai::orderBy('nama')->get(),
            'masterTunjangans' => MasterTunjangan::orderBy('nama_tunjangan')->get(),
            'masterPotongans' => MasterPotongan::orderBy('nama_potongan')->get(),
        ]);
    }

    /**
     * Simpan gaji
     */
    public function store(Request $request)
    {
        $validated = $this->validateGaji($request);

        $this->gajiService->store($validated);

        return redirect()
            ->route('admin.gaji.index')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * Form edit gaji
     */
    public function edit(Gaji $gaji)
    {
        $gaji->load(['pegawai', 'tunjanganDetails', 'potonganDetails']);

        return view('admin.gaji.edit', [
            'gaji' => $gaji,
            'pegawais' => Pegawai::orderBy('nama')->get(),
            'masterTunjangans' => MasterTunjangan::orderBy('nama_tunjangan')->get(),
            'masterPotongans' => MasterPotongan::orderBy('nama_potongan')->get(),
        ]);
    }

    /**
     * Update gaji
     */
    public function update(Request $request, Gaji $gaji)
    {
        $validated = $this->validateGaji($request);

        $this->gajiService->update($gaji, $validated);

        return redirect()
            ->route('admin.gaji.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Hapus gaji
     */
    public function destroy(Gaji $gaji)
    {
        $gaji->delete();

        return redirect()
            ->route('admin.gaji.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }

    /**
     * Unduh slip gaji
     */
    public function unduhSlipGaji(Gaji $gaji)
    {
        $gaji->load([
            'pegawai.jabatan',
            'tunjanganDetails.masterTunjangan',
            'potonganDetails.masterPotongan'
        ]);

        $pdf = Pdf::loadView('admin.gaji.slip-gaji-pdf', [
            'gaji' => $gaji
        ]);

        return $pdf->download(
            'slip-gaji-' . $gaji->pegawai->nama . '-' . $gaji->bulan . '-' . $gaji->tahun . '.pdf'
        );
    }

    /**
     * Validasi data gaji
     */
    private function validateGaji(Request $request): array
    {
        return $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangans' => 'nullable|array',
            'tunjangans.*.master_tunjangan_id' => 'required_with:tunjangans|exists:master_tunjangans,id',
            'tunjangans.*.jumlah' => 'required_with:tunjangans|numeric|min:0',
            'potongans' => 'nullable|array',
            'potongans.*.master_potongan_id' => 'required_with:potongans|exists:master_potongans,id',
            'potongans.*.jumlah' => 'required_with:potongans|numeric|min:0',
        ]);
    }
}