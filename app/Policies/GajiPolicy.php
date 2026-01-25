<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gaji;
use App\Models\Pegawai;

class GajiPolicy
{
    public function view(User $user, Gaji $gaji): bool
    {
        $pegawai = Pegawai::where('user_id', $user->id)->first();

        return $pegawai && $gaji->pegawai_id === $pegawai->id;
    }
}