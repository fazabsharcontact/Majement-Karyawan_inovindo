<x-app-layout>
    <div class="pt-20 sm:pt-24 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ================= WRAPPER CARD ================= --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-8">

                {{-- RINGKASAN GAJI --}}
                <section class="space-y-3">
                    <h2 class="text-lg font-semibold text-slate-900">Ringkasan Gaji Periode Saat Ini</h2>

                    <div class="flex flex-wrap gap-3 items-center">
                        @if ($detail)
                            <button
                                class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition flex items-center gap-2"
                                id="btnDetailGaji">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Lihat Detail ({{ $bulanNama[$bulan] ?? 'Bulan Error' }} {{ $tahun }})
                            </button>

                            <a href="{{ route('pegawai.gaji.unduh', $detail->id) }}" target="_blank"
                                class="px-5 py-2.5 bg-rose-600 text-white font-medium rounded-lg shadow hover:bg-rose-700 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Unduh Slip Gaji PDF
                            </a>
                        @else
                            <p class="text-slate-500">Data gaji untuk periode ini belum tersedia.</p>
                        @endif
                    </div>
                </section>

                {{-- POPUP DETAIL GAJI --}}
                <div class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center"
                    id="popupDetailGaji">
                    <div class="bg-white w-full max-w-lg rounded-2xl shadow-lg border border-slate-200 p-6 animate-fadeIn">
                        <div class="flex justify-between items-center border-b pb-3">
                            <h3 class="text-xl font-semibold text-slate-900">
                                Detail Gaji: {{ $bulanNama[$bulan] ?? '' }} {{ $tahun }}
                            </h3>
                            <button id="closePopup"
                                class="text-slate-500 hover:text-slate-700 text-2xl leading-none">&times;</button>
                        </div>

                        <div class="mt-4 space-y-3 text-slate-700">
                            @if ($detail)

                                {{-- Gaji Pokok --}}
                                <p class="flex justify-between font-medium">
                                    <span class="text-slate-600">Gaji Pokok:</span>
                                    <span>Rp {{ number_format($detail->gaji_pokok, 0, ',', '.') }}</span>
                                </p>

                                {{-- Tunjangan --}}
                                <div class="pt-2 border-t border-slate-200">
                                    <p class="font-semibold text-blue-600 mb-1">Penerimaan</p>
                                    @foreach ($detail->tunjanganDetails as $t)
                                        <p class="text-sm flex justify-between ml-2">
                                            <span>{{ $t->masterTunjangan->nama_tunjangan }}</span>
                                            <span>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</span>
                                        </p>
                                    @endforeach

                                    <p class="font-medium flex justify-between pt-2 border-t border-slate-200">
                                        <span>Total Tunjangan:</span>
                                        <span class="text-emerald-600">Rp
                                            {{ number_format($detail->total_tunjangan, 0, ',', '.') }}</span>
                                    </p>
                                </div>

                                {{-- Potongan --}}
                                <div class="pt-2 border-t border-slate-200">
                                    <p class="font-semibold text-rose-600 mb-1">Potongan</p>
                                    @foreach ($detail->potonganDetails as $p)
                                        <p class="text-sm flex justify-between ml-2">
                                            <span>{{ $p->masterPotongan->nama_potongan }}</span>
                                            <span>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</span>
                                        </p>
                                    @endforeach

                                    <p class="font-medium flex justify-between pt-2 border-t border-slate-200">
                                        <span>Total Potongan:</span>
                                        <span class="text-rose-600">Rp
                                            {{ number_format($detail->total_potongan, 0, ',', '.') }}</span>
                                    </p>
                                </div>

                                {{-- Gaji Bersih --}}
                                <p class="text-xl font-extrabold text-emerald-700 flex justify-between pt-4 border-t-2 border-emerald-200">
                                    <span>Gaji Bersih:</span>
                                    <span>Rp {{ number_format($detail->gaji_bersih, 0, ',', '.') }}</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- FILTER --}}
                <form method="GET" class="flex flex-wrap gap-6 items-end">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Tahun</label>
                        <select name="tahun"
                            class="rounded-lg border border-slate-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                            @for ($i = now()->year; $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Bulan</label>
                        <select name="bulan"
                            class="rounded-lg border border-slate-300 px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($bulanNama as $key => $value)
                                <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
                        Lihat Data
                    </button>
                </form>

                {{-- RIWAYAT GAJI --}}
                <section>
                    <h2 class="text-lg font-semibold text-slate-900 mb-3">Riwayat Gaji</h2>

                    <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-100 text-slate-700 border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 text-left">Tahun</th>
                                    <th class="px-4 py-3 text-left">Bulan</th>
                                    <th class="px-4 py-3 text-left">Gaji Bersih</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200">
                                @forelse($riwayat as $row)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-4 py-3">{{ $row->tahun }}</td>
                                        <td class="px-4 py-3">
                                            {{ $bulanNama[$row->bulan] ?? '' }}
                                        </td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">
                                            Rp {{ number_format($row->gaji_bersih, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('pegawai.gaji.unduh', $row->id) }}" target="_blank"
                                                class="px-3 py-1.5 bg-rose-500 text-white rounded-md text-xs font-semibold hover:bg-rose-600">
                                                Unduh PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-center text-slate-500">
                                            Data riwayat gaji tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>

    {{-- POPUP JS --}}
    <script>
        document.getElementById("btnDetailGaji")?.addEventListener("click", () => {
            document.getElementById("popupDetailGaji").classList.remove("hidden");
        });

        document.getElementById("closePopup")?.addEventListener("click", () => {
            document.getElementById("popupDetailGaji").classList.add("hidden");
        });
    </script>

</x-app-layout>