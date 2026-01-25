<?php

namespace App\Services\Pegawai;

use App\Models\Pegawai;
use App\Models\Gaji;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PegawaiGajiService
{
    public function getDashboardGajiPegawai(int $userId, ?int $bulan, ?int $tahun): array
    {
        $pegawai = Pegawai::where('user_id', $userId)->firstOrFail();

        $tahun = $tahun ?? Carbon::now()->year;
        $bulan = $bulan ?? Carbon::now()->month;

        $riwayat = Gaji::where('pegawai_id', $pegawai->id)
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        $detail = Gaji::where('pegawai_id', $pegawai->id)
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->with([
                'tunjanganDetails.masterTunjangan',
                'potonganDetails.masterPotongan',
                'pegawai.jabatan'
            ])
            ->first();

        return [
            'riwayat' => $riwayat,
            'detail' => $detail,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanNama' => $this->getNamaBulan(),
        ];
    }

    public function downloadSlipGaji(Gaji $gaji)
    {
        $gaji->load([
            'pegawai.jabatan',
            'tunjanganDetails.masterTunjangan',
            'potonganDetails.masterPotongan'
        ]);

        $pdf = Pdf::loadView('pegawai.gaji.slip-gaji-pdf', [
            'gaji' => $gaji
        ]);

        $bulanNama = $this->getNamaBulan()[$gaji->bulan] ?? 'Bulan';

        return $pdf->download(
            "slip-gaji-{$gaji->pegawai->nama}-{$bulanNama}-{$gaji->tahun}.pdf"
        );
    }

    private function getNamaBulan(): array
    {
        return [
            1 => "Januari", 2 => "Februari", 3 => "Maret",
            4 => "April", 5 => "Mei", 6 => "Juni",
            7 => "Juli", 8 => "Agustus", 9 => "September",
            10 => "Oktober", 11 => "November", 12 => "Desember",
        ];
    }
}