<x-app-layout>

    <div class="p-4 sm:p-6  pt-24 sm:pt-20">

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="p-3 sm:p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
             <div class="p-3 sm:p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Card Sisa Cuti -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700">Sisa Cuti Tahunan Anda</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">
                        {{ $pegawai->sisaCuti->sisa_cuti ?? 0 }} Hari
                    </p>
                </div>
                <a href="{{ route('pegawai.cuti.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 text-sm rounded-md shadow w-full sm:w-auto text-center">
                    + Ajukan Cuti Baru
                </a>
            </div>
        </div>

        <!-- Card Riwayat Pengajuan -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">
                Riwayat Pengajuan Cuti
            </h3>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-max sm:min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs sm:text-sm">
                        <tr>
                            <th class="border-b px-3 sm:px-4 py-2 text-left">Tanggal Cuti</th>
                            <th class="border-b px-3 sm:px-4 py-2 text-center">Durasi</th>
                            <th class="border-b px-3 sm:px-4 py-2 text-left">Keterangan</th>
                            <th class="border-b px-3 sm:px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cutis as $cuti)
                        <tr class="hover:bg-gray-50">
                            <td class="border-b px-3 sm:px-4 py-2 text-xs sm:text-sm">
                                {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}
                                –
                                {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                            </td>

                            <td class="border-b px-3 sm:px-4 py-2 text-center text-xs sm:text-sm font-medium">
                                {{ $cuti->durasi_hari_kerja }} hari
                            </td>

                            <td class="border-b px-3 sm:px-4 py-2 text-xs sm:text-sm">
                                {{ $cuti->keterangan }}
                            </td>

                            <td class="border-b px-3 sm:px-4 py-2 text-center">
                                @if($cuti->status == 'Disetujui')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                        Disetujui
                                    </span>
                                @elseif($cuti->status == 'Ditolak')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                        Diajukan
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 text-sm">
                                Anda belum pernah mengajukan cuti.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $cutis->links() }}
            </div>

        </div>
    </div>

</x-app-layout>