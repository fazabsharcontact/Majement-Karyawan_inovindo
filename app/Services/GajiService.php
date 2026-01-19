<?php

namespace App\Services;

use App\Models\Gaji;
use Illuminate\Support\Facades\DB;

class GajiService
{
    /**
     * Hitung total tunjangan, potongan, dan gaji bersih
     */
    public function hitungKomponenGaji(float $gajiPokok, ?array $tunjangans, ?array $potongans): array
    {
        $totalTunjangan = collect($tunjangans)->sum('jumlah');
        $totalPotongan  = collect($potongans)->sum('jumlah');

        return [
            'total_tunjangan' => $totalTunjangan,
            'total_potongan'  => $totalPotongan,
            'gaji_bersih'     => $gajiPokok + $totalTunjangan - $totalPotongan,
        ];
    }

    /**
     * Simpan data gaji baru
     */
    public function store(array $data): void
    {
        DB::transaction(function () use ($data) {

            $komponen = $this->hitungKomponenGaji(
                $data['gaji_pokok'],
                $data['tunjangans'] ?? [],
                $data['potongans'] ?? []
            );

            $gaji = Gaji::create([
                'pegawai_id'      => $data['pegawai_id'],
                'bulan'           => $data['bulan'],
                'tahun'           => $data['tahun'],
                'gaji_pokok'      => $data['gaji_pokok'],
                'total_tunjangan' => $komponen['total_tunjangan'],
                'total_potongan'  => $komponen['total_potongan'],
                'gaji_bersih'     => $komponen['gaji_bersih'],
            ]);

            if (!empty($data['tunjangans'])) {
                foreach ($data['tunjangans'] as $tunjangan) {
                    $gaji->tunjanganDetails()->create($tunjangan);
                }
            }

            if (!empty($data['potongans'])) {
                foreach ($data['potongans'] as $potongan) {
                    $gaji->potonganDetails()->create($potongan);
                }
            }
        });
    }

    /**
     * Update data gaji
     */
    public function update(Gaji $gaji, array $data): void
    {
        DB::transaction(function () use ($gaji, $data) {

            $gaji->tunjanganDetails()->delete();
            $gaji->potonganDetails()->delete();

            $komponen = $this->hitungKomponenGaji(
                $data['gaji_pokok'],
                $data['tunjangans'] ?? [],
                $data['potongans'] ?? []
            );

            $gaji->update([
                'pegawai_id'      => $data['pegawai_id'],
                'bulan'           => $data['bulan'],
                'tahun'           => $data['tahun'],
                'gaji_pokok'      => $data['gaji_pokok'],
                'total_tunjangan' => $komponen['total_tunjangan'],
                'total_potongan'  => $komponen['total_potongan'],
                'gaji_bersih'     => $komponen['gaji_bersih'],
            ]);

            if (!empty($data['tunjangans'])) {
                foreach ($data['tunjangans'] as $tunjangan) {
                    $gaji->tunjanganDetails()->create($tunjangan);
                }
            }

            if (!empty($data['potongans'])) {
                foreach ($data['potongans'] as $potongan) {
                    $gaji->potonganDetails()->create($potongan);
                }
            }
        });
    }
}