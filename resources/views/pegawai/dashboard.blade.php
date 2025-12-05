<x-app-layout>
    <div class="pt-20 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 lg:space-y-10">

            {{-- ================= HEADER ================= --}}
            <header
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-200 pb-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center rounded-full bg-blue-600 text-white text-xs font-semibold px-3 py-1">
                            Pegawai
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">
                        Dashboard Pegawai
                    </h1>
                    <p class="text-sm text-slate-500">
                        Selamat datang kembali,
                        <span class="font-semibold text-slate-900">{{ $pegawai->nama }}</span>.
                        Pantau ringkasan kehadiran dan gajimu di sini.
                    </p>
                </div>

                <div
                    class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl shadow-sm border border-slate-100">
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600/90 text-white shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                d="M3 4h18M3 12h18M3 20h18" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Hari ini</span>
                        <span class="text-sm font-semibold text-slate-800">
                            {{ now()->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                </div>
            </header>

            {{-- ================= RINGKASAN & STATISTIK ================= --}}
            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-6 space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                            Ringkasan Tahun {{ $tahunSekarang }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Ikhtisar gaji dan kehadiran kamu selama tahun berjalan.
                        </p>
                    </div>
                </div>

                @php
                    $stats = [
                        [
                            'title' => 'Gaji Tahun Ini',
                            'value' => 'Rp ' . number_format($totalGajiTahun, 0, ',', '.'),
                            'color' => 'emerald',
                            'icon' => 'currency-dollar',
                        ],
                        [
                            'title' => 'Total Hadir',
                            'value' => $totalHariMasuk . ' hari',
                            'color' => 'sky',
                            'icon' => 'check-circle',
                        ],
                        [
                            'title' => 'Total Terlambat',
                            'value' => $totalTerlambat . ' kali',
                            'color' => 'slate',
                            'icon' => 'clock',
                        ],
                        [
                            'title' => 'Total Izin',
                            'value' => $totalIzin . ' hari',
                            'color' => 'amber',
                            'icon' => 'calendar',
                        ],
                        [
                            'title' => 'Total Sakit',
                            'value' => $totalSakit . ' hari',
                            'color' => 'rose',
                            'icon' => 'heart',
                        ],
                        [
                            'title' => 'Total Absen',
                            'value' => $totalAbsen . ' hari',
                            'color' => 'zinc',
                            'icon' => 'x-circle',
                        ],
                    ];
                @endphp

                <div class="grid gap-4 sm:gap-5 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                    @foreach ($stats as $stat)
                        <article
                            class="bg-slate-50/70 border border-slate-100 rounded-xl px-4 py-4 sm:px-5 sm:py-5 shadow-[0_1px_2px_rgba(15,23,42,0.05)] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex items-center justify-center w-11 h-11 rounded-full bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 shadow-inner">
                                    @switch($stat['icon'])
                                        @case('currency-dollar')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10v12" />
                                            </svg>
                                        @break

                                        @case('check-circle')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @break

                                        @case('clock')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @break

                                        @case('calendar')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                                            </svg>
                                        @break

                                        @case('heart')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-8.682a4.5 4.5 0 010-6.364z" />
                                            </svg>
                                        @break

                                        @case('x-circle')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @break
                                    @endswitch
                                </div>

                                <div class="space-y-1">
                                    <p class="text-xs font-medium tracking-wide text-slate-500 uppercase">
                                        {{ $stat['title'] }}
                                    </p>
                                    <p class="text-lg sm:text-xl font-semibold text-slate-900 leading-snug">
                                        {{ $stat['value'] }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- ================= VISUALISASI DATA ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                {{-- Pie Kehadiran --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-6 flex flex-col items-center">
                    <div class="w-full flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                                Ringkasan Kehadiran
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500">
                                Bulan {{ $bulanSekarang }}
                            </p>
                        </div>
                    </div>

                    <div class="h-64 sm:h-72 w-full flex items-center justify-center">
                        <canvas id="kehadiranChart"></canvas>
                    </div>
                </div>

                {{-- Line Gaji --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-6 lg:col-span-2 flex flex-col">
                    <div class="w-full flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                                Tren Gaji Bersih
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500">
                                Tahun {{ $tahunSekarang }}
                            </p>
                        </div>
                    </div>

                    <div class="w-full h-64 sm:h-80">
                        <canvas id="gajiChart"></canvas>
                    </div>
                </div>
            </section>

            {{-- ================= DAFTAR PENGUMUMAN ================= --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                            Daftar Pengumuman
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Informasi terbaru yang berkaitan dengan kepegawaianmu.
                        </p>
                    </div>
                </div>

                @if ($pengumumans->isEmpty())
                    <div
                        class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl text-sm font-medium text-center">
                        Belum ada pengumuman untuk Anda.
                    </div>
                @else
                    <div class="grid gap-4 sm:gap-5 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($pengumumans as $p)
                            <article
                                class="bg-slate-50/60 border border-slate-100 rounded-xl p-4 sm:p-5 hover:bg-white hover:shadow-md transition-all duration-200 flex flex-col h-full">
                                <h3 class="font-semibold text-slate-900 text-base sm:text-lg mb-1.5 line-clamp-2">
                                    {{ $p->pengumuman->judul ?? '-' }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 mb-3 line-clamp-3">
                                    {{ $p->pengumuman->isi ?? '-' }}
                                </p>
                                <p class="mt-auto text-xs text-slate-400">
                                    {{ $p->pengumuman->created_at?->format('d M Y, H:i') }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </div>

    {{-- ================= SCRIPT CHARTS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulanArray = @json($bulanArray);
        const dataGaji = @json($dataGaji);
        const dataKehadiran = @json($dataKehadiran);

        // Line chart gaji
        const gajiChart = new Chart(document.getElementById('gajiChart'), {
            type: 'line',
            data: {
                labels: bulanArray,
                datasets: [{
                    label: 'Total Gaji Bersih (Rp)',
                    data: dataGaji,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(15, 23, 42, 0.08)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 5,
                    pointBackgroundColor: '#0f172a'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#020617',
                        titleColor: '#e5e7eb',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    }
                }
            }
        });

        // Pie chart kehadiran
        new Chart(document.getElementById('kehadiranChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(dataKehadiran),
                datasets: [{
                    data: Object.values(dataKehadiran),
                    backgroundColor: ['#3b82f6', '#f59e0b', '#ef4444', '#6b7280', '#22c55e'],
                    borderColor: '#f9fafb',
                    borderWidth: 2,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 14,
                            usePointStyle: true,
                            boxWidth: 10,
                            color: '#4b5563',
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>