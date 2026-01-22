<?php

namespace App\Services;

use App\Models\Gaji;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class GajiMassalService
{
    public function getPegawaiBelumGajian(int $bulan, int $tahun)
    {
        return Pegawai::where('tanggal_masuk', '<=', now())
            ->whereDoesntHave('gajis', function ($q) use ($bulan, $tahun) {
                $q->where('bulan', $bulan)
                  ->where('tahun', $tahun);
            })
            ->with(['jabatan', 'tim.divisi'])
            ->orderBy('nama')
            ->get();
    }

    public function simpanGajiMassal(array $validated): int
    {
        $tunjangans = $validated['tunjangans'] ?? [];
        $potongans = $validated['potongans'] ?? [];

        $totalTunjangan = collect($tunjangans)->sum('jumlah');
        $totalPotongan = collect($potongans)->sum('jumlah');

        DB::transaction(function () use ($validated, $tunjangans, $potongans, $totalTunjangan, $totalPotongan) {
            foreach ($validated['pegawai_gaji'] as $pegawai) {

                $gajiBersih = 
                    $pegawai['gaji_pokok'] 
                    + $totalTunjangan 
                    - $totalPotongan;

                $gaji = Gaji::create([
                    'pegawai_id' => $pegawai['pegawai_id'],
                    'bulan' => $validated['bulan'],
                    'tahun' => $validated['tahun'],
                    'gaji_pokok' => $pegawai['gaji_pokok'],
                    'total_tunjangan' => $totalTunjangan,
                    'total_potongan' => $totalPotongan,
                    'gaji_bersih' => $gajiBersih,
                ]);

                foreach ($tunjangans as $tunjangan) {
                    $gaji->tunjanganDetails()->create($tunjangan);
                }

                foreach ($potongans as $potongan) {
                    $gaji->potonganDetails()->create($potongan);
                }
            }
        });

        return count($validated['pegawai_gaji']);
    }

    public function cekPegawaiSudahGajian(array $pegawaiIds, int $bulan, int $tahun)
    {
        return Pegawai::whereIn('id', $pegawaiIds)
            ->whereHas('gajis', function ($q) use ($bulan, $tahun) {
                $q->where('bulan', $bulan)
                  ->where('tahun', $tahun);
            })
            ->with(['jabatan', 'tim.divisi'])
            ->get();
    }
}