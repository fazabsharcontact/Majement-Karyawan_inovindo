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
                            Admin
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">
                        Dashboard Admin
                    </h1>
                    <p class="text-sm text-slate-500">
                        Pantau ringkasan pegawai, gaji, aktivitas, pengumuman, dan jadwal meeting dalam satu halaman.
                    </p>
                </div>

                <div
                    class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl shadow-sm border border-slate-100">
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white shadow-inner">
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

            {{-- ================= NOTIFIKASI GLOBAL (OPSIONAL) ================= --}}
            @if (session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- ================= RINGKASAN STATISTIK ================= --}}
            <section class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">
                {{-- Total Pegawai --}}
                <article
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm px-5 py-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between gap-3">
                        <div class="space-y-1">
                            <p class="text-xs font-medium tracking-wide text-slate-500 uppercase">
                                Active employee
                            </p>
                            <p class="text-3xl sm:text-4xl font-bold text-slate-900">
                                {{ $totalPegawai }}
                            </p>
                        </div>
                        <div
                            class="flex items-center justify-center w-11 h-11 rounded-full bg-sky-100 text-sky-600 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-2M5 20h8v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2zM15 7a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">
                        Jumlah pegawai aktif yang terdaftar dalam sistem.
                    </p>
                </article>

                {{-- Total Gaji Periode Terakhir --}}
                <article
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm px-5 py-5 flex flex-col gap-3">
                    <div class="flex items-center justify-between gap-3">
                        <div class="space-y-1">
                            <p class="text-xs font-medium tracking-wide text-slate-500 uppercase">
                                Total salary for the final period
                            </p>
                            <p class="text-2xl sm:text-3xl font-bold text-slate-900">
                                Rp {{ number_format($totalGaji, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="flex items-center justify-center w-11 h-11 rounded-full bg-emerald-100 text-emerald-600 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10v12" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">
                        Total gaji bersih yang dibayarkan pada periode terakhir.
                    </p>
                </article>

                {{-- Pie Jabatan --}}
                <article
                    class="bg-white rounded-2xl border border-slate-200 shadow-sm px-5 py-5 flex flex-col items-stretch">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs font-medium tracking-wide text-slate-500 uppercase">
                                Employees per position
                            </p>
                            <p class="text-xs text-slate-500">Distribusi pegawai berdasarkan jabatan.</p>
                        </div>
                    </div>
                    <div class="flex-1 flex items-center justify-center">
                        <div class="h-28 w-28 sm:h-32 sm:w-32">
                            <canvas id="jabatanChart"></canvas>
                        </div>
                    </div>
                </article>
            </section>

            {{-- ================= ACTIVITY & ANNOUNCEMENT ================= --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                {{-- Aktivitas Terbaru --}}
                <article class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">
                    <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-3 border-b border-slate-200 pb-2">
                        New Activity
                    </h2>

                    <ul class="space-y-3">
                        @forelse ($aktivitas as $item)
                            <li
                                class="flex items-start gap-3 rounded-xl border border-slate-100 bg-slate-50/60 px-3 py-3 hover:bg-white hover:shadow-sm transition">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 100 8 4 4 0 000-8zm-6 14a6 6 0 1112 0H4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 space-y-1">
                                    <p class="text-sm text-slate-900 font-medium leading-snug">
                                        {!! $item->keterangan !!}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        {{ \Carbon\Carbon::parse($item->waktu)->diffForHumans() }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li>
                                <p class="text-center text-sm text-slate-500 py-6 italic">
                                    Tidak ada aktivitas terbaru dalam 7 hari terakhir.
                                </p>
                            </li>
                        @endforelse
                    </ul>
                </article>

                {{-- Pengumuman --}}
                <article class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                                Announcement
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                Informasi dan pengumuman terbaru untuk seluruh pegawai.
                            </p>
                        </div>
                        <a href="{{ route('admin.pengumuman.create') }}"
                            class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-full shadow-sm text-xs sm:text-sm font-semibold">
                            <span>+ Add New</span>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($pengumumans as $pengumuman)
                            <article
                                class="border border-slate-100 rounded-xl p-4 bg-slate-50/70 hover:bg-white hover:shadow-sm transition">
                                <div class="flex justify-between items-start gap-2">
                                    <div>
                                        <h3 class="font-semibold text-sm sm:text-base text-slate-900">
                                            {{ $pengumuman->judul }}
                                        </h3>
                                        <p class="text-[11px] text-slate-500 mt-0.5">
                                            Dipublikasikan oleh
                                            <span class="font-medium text-slate-700">
                                                {{ $pengumuman->pembuat->username ?? 'N/A' }}
                                            </span>
                                            pada {{ $pengumuman->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Hapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-rose-500 hover:text-rose-700 font-semibold">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                                <div class="prose max-w-none mt-2 text-xs sm:text-sm text-slate-700">
                                    {!! $pengumuman->isi !!}
                                </div>
                            </article>
                        @empty
                            <div class="text-center py-8 text-sm text-slate-500">
                                Belum ada pengumuman yang dibuat.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $pengumumans->links('vendor.pagination.tailwind') }}
                    </div>
                </article>
            </section>

            {{-- ================= MEETING SCHEDULE ================= --}}
            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                            Meeting Schedule
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Daftar meeting yang telah dijadwalkan dalam sistem.
                        </p>
                    </div>
                    <a href="{{ route('admin.meeting.create') }}"
                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-full shadow-sm text-xs sm:text-sm font-semibold">
                        <span>+ Add Meeting</span>
                    </a>
                </div>

                {{-- Notifikasi khusus meeting (kalau ada) --}}
                @if(session('success_meeting'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs sm:text-sm text-emerald-800">
                        {{ session('success_meeting') }}
                    </div>
                @endif

                <div class="overflow-x-auto rounded-xl border border-slate-200 bg-slate-50/40">
                    <table class="min-w-full text-xs sm:text-sm">
                        <thead class="bg-slate-100/80 text-slate-700">
                            <tr>
                                <th class="px-4 py-2.5 text-left font-medium">Judul Meeting</th>
                                <th class="px-4 py-2.5 text-left font-medium">Jadwal</th>
                                <th class="px-4 py-2.5 text-left font-medium">Lokasi</th>
                                <th class="px-4 py-2.5 text-left font-medium">Dibuat Oleh</th>
                                <th class="px-4 py-2.5 text-center font-medium">Peserta</th>
                                <th class="px-4 py-2.5 text-center font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($meetings as $meeting)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-2.5 font-medium text-slate-900">
                                        {{ $meeting->judul }}
                                    </td>
                                    <td class="px-4 py-2.5 text-slate-700">
                                        {{ \Carbon\Carbon::parse($meeting->waktu_mulai)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-4 py-2.5 text-slate-700">
                                        {{ $meeting->lokasi }}
                                    </td>
                                    <td class="px-4 py-2.5 text-slate-700">
                                        {{ $meeting->pembuat->nama ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2.5 text-center text-slate-800 font-semibold">
                                        {{ $meeting->pesertas_count }}
                                    </td>
                                    <td class="px-4 py-2.5 text-center">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('admin.meeting.edit', $meeting->id) }}"
                                                class="text-xs font-semibold text-amber-600 hover:text-amber-700">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.meeting.destroy', $meeting->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Hapus meeting ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-xs font-semibold text-rose-600 hover:text-rose-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-sm text-slate-500">
                                        Belum ada meeting yang dijadwalkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $meetings->links('vendor.pagination.tailwind') }}
                </div>
            </section>

        </div>
    </div>

    {{-- ================= CHART.JS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let jabatanLabels = {!! json_encode(array_keys($jabatanData)) !!};
            let jabatanValues = {!! json_encode(array_values($jabatanData)) !!};

            if (jabatanLabels.length > 0) {
                new Chart(document.getElementById("jabatanChart"), {
                    type: "pie",
                    data: {
                        labels: jabatanLabels,
                        datasets: [{
                            data: jabatanValues,
                            backgroundColor: [
                                "#0f172a",
                                "#334155",
                                "#9ca3af",
                                "#1d4ed8",
                                "#22c55e",
                            ],
                            borderWidth: 2,
                            borderColor: "#f9fafb"
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>