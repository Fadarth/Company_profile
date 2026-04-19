<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dewan Perwakilan Rakyat RI</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-pemda.png') }}" />

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        html {
            scroll-behavior: smooth;
            /* Menambahkan efek smooth scroll */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fffdfa !important;
            /* Warna Oren Buram/Muted Orange */
        }

        /* Menghilangkan background putih/abu pada section agar tembus ke background utama */
        section {
            background-color: transparent !important;
        }

        /* Menyembunyikan scrollbar agar slider terlihat lebih bersih */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-pemda.png') }}" alt="Logo Pemda" class="w-10 h-10 object-contain">
                    <div>
                        <h1 class="font-bold text-lg leading-tight">Dewan Perwakilan Rakyat</h1>
                        <p class="text-xs text-slate-500">Republik Indonesia</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-6 text-sm font-medium text-slate-600">
                    <a href="#beranda" class="text-orange-600 font-bold">Beranda</a>
                    <a href="#foto-daerah" class="hover:text-orange-600">Foto Daerah</a>
                    <a href="#anggota" class="hover:text-orange-600">Anggota</a>
                    <a href="#kegiatan" class="hover:text-orange-600">Kegiatan</a>
                    <a href="#organisasi" class="hover:text-orange-600">Organisasi</a>
                    <a href="#kelengkapan" class="hover:text-orange-600">Kelengkapan</a>
                    <a href="#struktural" class="hover:text-orange-600">Struktural</a>
                    <a href="#aspirasi" class="hover:text-orange-600">Aspirasi</a>
                    <a href="#berita" class="hover:text-orange-600">Berita</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- BERANDA --}}

    <section id="beranda" class="bg-gradient-to-br from-orange-50 to-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 text-center md:text-left">

                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 leading-tight mb-4">
                    {!! $hero->title !!}
                </h2>

                <p class="text-slate-600 mb-8 leading-relaxed">
                    Dewan Perwakilan Rakyat Republik Indonesia adalah lembaga perwakilan rakyat yang bertugas membentuk
                    undang-undang dan mengawasi jalannya pemerintahan.
                </p>
                <div class="flex gap-4 justify-center md:justify-start">
                    <a href="#kegiatan"
                        class="bg-orange-600 text-white px-6 py-3 rounded-md font-medium hover:bg-orange-700 transition">
                        Lihat Kegiatan
                    </a>
                    <a href="#aspirasi"
                        class="border border-orange-600 text-orange-600 px-6 py-3 rounded-md font-medium hover:bg-orange-50 transition">
                        Sampaikan Aspirasi
                    </a>
                </div>
            </div>

            <div class="md:w-1/2">
                <div class="p-3 bg-orange-100/50 rounded-[2rem]">
                    <div class="rounded-[1.5rem] overflow-hidden shadow-lg aspect-video">

                        <img src="{{ $hero->image_path ? asset('storage/hero/' . $hero->image_path) : 'https://images.unsplash.com/photo-1574958269340-fa927503f3dd?auto=format&fit=crop&q=80' }}"
                            alt="Gedung DPR RI" class="w-full h-full object-cover">

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Foto Daerah Indonesia --}}

    <section id="foto-daerah" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center items-center gap-3 mb-6">
            <i class="fa-solid fa-map-location-dot text-2xl text-orange-600"></i>
            <h3 class="text-2xl font-bold text-center">Foto Daerah Indonesia</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($regions as $region)
                <div
                    class="relative h-48 rounded-xl overflow-hidden cursor-pointer transition-transform duration-300 hover:scale-105 shadow-md hover:shadow-xl border border-orange-600/50">

                    <div class="absolute inset-0 bg-slate-300"
                        style="background-image: url('{{ asset('storage/regions/' . $region->image_path) }}'); background-size: cover; background-position: center;">
                    </div>

                    <div class="absolute inset-0 bg-black/30 hover:bg-black/20 transition-colors"></div>

                    <span class="absolute bottom-4 left-4 text-white font-bold text-xl z-10">{{ $region->name }}</span>
                </div>
            @endforeach

        </div>
    </section>

    {{-- Anggota Dewan --}}

    <section id="anggota" class="py-12 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center gap-3 mb-8">
                <i class="fa-solid fa-users text-2xl text-orange-600"></i>
                <h3 class="text-2xl font-bold text-center text-slate-800">Anggota Dewan</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($members as $member)
                    <div
                        class="bg-white border border-orange-200 rounded-2xl p-6 flex flex-col items-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">

                        <div
                            class="w-32 h-32 rounded-full overflow-hidden border-4 border-orange-100 flex-shrink-0 mb-4 shadow-sm group-hover:border-orange-300 transition-colors">
                            {{-- Ubah bagian asset di bawah ini --}}
                            <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="text-center">
                            <h4 class="font-bold text-lg text-slate-900">{{ $member->name }}</h4>
                            <p
                                class="text-sm text-orange-600 font-semibold mt-1 bg-orange-50 px-3 py-1 rounded-full inline-block">
                                {{ $member->position }}</p>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>


    {{-- Informasi Kegiatan --}}

    <section id="kegiatan" class="py-12 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center gap-3 mb-6">
                <i class="fa-solid fa-calendar-days text-2xl text-orange-600"></i>
                <h3 class="text-2xl font-bold text-center text-slate-800">Informasi Kegiatan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach ($activities as $activity)
                    <div
                        class="bg-white rounded-xl p-6 border border-orange-300 shadow-sm cursor-pointer transition-transform duration-300 hover:scale-105 hover:shadow-xl group">

                        <div class="flex items-start gap-4">

                            <div
                                class="w-12 h-12 bg-orange-100 rounded-lg flex-shrink-0 flex items-center justify-center group-hover:bg-orange-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 text-orange-600 group-hover:text-white transition-colors duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>

                            <div class="w-full">
                                <h4 class="font-bold text-lg text-slate-800 leading-snug mb-3">{{ $activity->title }}
                                </h4>

                                <div class="space-y-3 text-sm text-slate-600">
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 text-orange-500 mt-0.5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>
                                            @php
                                                $startDate = \Carbon\Carbon::parse($activity->start_date)->locale('id');

                                                // Cek apakah ada end_date dan end_date tidak sama dengan start_date
                                                if (
                                                    $activity->end_date &&
                                                    $activity->end_date != $activity->start_date
                                                ) {
                                                    $endDate = \Carbon\Carbon::parse($activity->end_date)->locale('id');

                                                    // Jika bulan sama (misal: 8 - 10 April 2026)
                                                    if ($startDate->format('m-Y') == $endDate->format('m-Y')) {
                                                        echo $startDate->format('d') .
                                                            ' - ' .
                                                            $endDate->translatedFormat('d F Y');
                                                    } else {
                                                        // Jika bulan beda (misal: 30 April - 2 Mei 2026)
                                                        echo $startDate->translatedFormat('d M') .
                                                            ' - ' .
                                                            $endDate->translatedFormat('d M Y');
                                                    }
                                                } else {
                                                    // Hanya 1 hari
                                                    echo $startDate->translatedFormat('d F Y');
                                                }
                                            @endphp
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 text-orange-500 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($activity->time)->format('H:i') }} WIB</span>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor"
                                            class="w-4 h-4 text-orange-500 mt-0.5 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="leading-tight">{{ $activity->location }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- Data Organisasi --}}

    <section id="organisasi" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-100 font-sans">
        <div class="mb-6 text-center md:text-left">
            <div class="flex items-center justify-center md:justify-start gap-3 mb-1">
                <i class="fa-solid fa-building text-2xl text-orange-600"></i>
                <h3 class="text-2xl font-bold text-slate-800">Data Organisasi</h3>
            </div>
            <p class="text-slate-500 text-sm mt-1">Informasi lengkap mengenai Partai Politik, Fraksi, dan Komisi DPR
                RI.</p>
        </div>

        <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide border-b border-slate-200 mb-6">
            @foreach ($organizations as $index => $org)
                <button onclick="switchPdf('pdf-panel-{{ $index }}', this)"
                    class="tab-btn whitespace-nowrap px-5 py-2.5 rounded-t-lg font-medium text-sm transition-all duration-300 {{ $index === 0 ? 'bg-orange-600 text-white shadow-md' : 'bg-slate-50 text-slate-600 border border-slate-200 border-b-0 hover:bg-orange-100 hover:text-orange-700' }}">
                    {{ $org->title }}
                </button>
            @endforeach
        </div>

        <div class="bg-white rounded-b-xl rounded-tr-xl shadow-lg border border-orange-200 overflow-hidden relative">

            @foreach ($organizations as $index => $org)
                <div id="pdf-panel-{{ $index }}" class="pdf-panel {{ $index === 0 ? 'block' : 'hidden' }}">

                    <div
                        class="bg-orange-50/50 p-4 border-b border-orange-100 flex flex-wrap justify-between items-center gap-4">
                        <span class="font-bold text-slate-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="w-5 h-5 text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Menampilkan: <span class="text-orange-700">{{ $org->title }}</span>
                        </span>
                        <a href="{{ asset('storage/' . $org->file_path) }}" target="_blank"
                            class="text-sm bg-white border border-orange-200 px-4 py-1.5 rounded-full text-orange-600 font-medium hover:bg-orange-600 hover:text-white transition-colors shadow-sm whitespace-nowrap">
                            <span class="flex items-center gap-2">
                                Buka Layar Penuh
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="h-[700px] w-full bg-slate-100">
                        <iframe src="{{ asset('storage/' . $org->file_path) }}#toolbar=0&view=FitH"
                            class="w-full h-full border-none"></iframe>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    {{-- Alat Kelengkapan Dewan --}}

    <section id="kelengkapan" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-100">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-1">
                <i class="fa-solid fa-briefcase text-2xl text-orange-600"></i>
                <h3 class="text-2xl font-bold text-slate-800">Alat Kelengkapan Dewan</h3>
            </div>
            <p class="text-slate-500 text-sm mt-1">Struktur organisasi dan kelengkapan tugas DPR RI.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($councilEquipments as $equipment)
                <a href="{{ route('landing.equipment.show', $equipment->slug) }}" class="block">
                    <div
                        class="relative cursor-pointer overflow-hidden rounded-lg bg-white px-6 py-8 shadow-sm hover:shadow-lg transform transition-all duration-300 hover:scale-105 border border-orange-600/50 group h-full">

                        <div class="absolute top-0 right-0 h-3/4 w-4/5 pointer-events-none">
                            <div class="relative h-full w-full overflow-hidden">
                                <span
                                    class="absolute top-0 right-0 h-28 w-28 -translate-y-1/2 translate-x-1/4 bg-orange-400/40 blur-3xl rounded-full"></span>
                                <img src="{{ asset('images/peta-indonesia-oren.png') }}" alt="Pattern Map"
                                    class="absolute right-[-10%] top-[-10%] w-full h-full object-contain object-right-top opacity-20">
                            </div>
                        </div>

                        <div class="relative mb-6 flex items-center h-12 w-12 text-orange-600">
                            <i class="{{ $equipment->icon_class }} text-5xl"></i>
                        </div>

                        <p class="relative text-2xl font-bold text-slate-800">{{ $equipment->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Struktural Dewan --}}

    <section id="struktural" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-100">
        <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <i class="fa-solid fa-sitemap text-2xl text-orange-600"></i>
                    <h3 class="text-2xl font-bold">{{ $councilStructure->title }}</h3>
                </div>
                <p class="text-slate-500 text-sm mt-1">{{ $councilStructure->description }}</p>
            </div>

            <a href="{{ $councilStructure->file_path ? asset($councilStructure->file_path) : '#' }}" target="_blank"
                class="text-sm font-medium text-orange-600 hover:underline flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Unduh Dokumen
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-orange-600/50 overflow-hidden">
            <div class="w-full h-[600px] bg-slate-100 flex items-center justify-center">
                @if ($councilStructure->file_path)
                    <iframe src="{{ asset($councilStructure->file_path) }}#toolbar=0"
                        class="w-full h-full border-none" title="Dokumen Struktural Dewan">
                        <p class="text-slate-600">
                            Browser Anda tidak mendukung tampilan PDF langsung.
                            <a href="{{ asset($councilStructure->file_path) }}"
                                class="text-orange-600 underline">Klik di sini untuk melihat dokumen.</a>
                        </p>
                    </iframe>
                @else
                    <p class="text-slate-500">Belum ada dokumen PDF yang diunggah.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Aspirasi Masyarakat --}}

    <section id="aspirasi" class="py-12 bg-[#FFF9F2] font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success_aspiration'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                    {{ session('success_aspiration') }}
                </div>
            @endif

            <div class="flex items-center gap-3 mb-8">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                    </path>
                </svg>
                <h3 class="text-3xl font-bold text-slate-800 tracking-tight">Aspirasi Masyarakat</h3>
            </div>

            <div class="bg-white p-3 rounded-3xl shadow-sm border border-slate-100 mb-10">
                <div class="bg-white border border-orange-200 rounded-2xl p-8 shadow-sm flex items-start gap-5">
                    <div
                        class="bg-orange-600 rounded-full p-4 text-white flex-shrink-0 shadow-md shadow-orange-200 transform rotate-[15deg]">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-slate-800">Sampaikan Aspirasi Anda</h4>
                        <p class="text-slate-500 text-base mt-2 mb-6 leading-relaxed">
                            Kami siap menampung dan menindaklanjuti aspirasi masyarakat untuk kemajuan bangsa.
                        </p>
                        <a href="{{ route('public.aspirations.create') }}"
                            class="inline-block bg-orange-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-orange-700 transition-all active:scale-95 shadow-lg shadow-orange-100">
                            Kirim Aspirasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($aspirations as $aspiration)
                    <div
                        class="bg-white border border-orange-600/50 p-6 rounded-2xl shadow-[0_4px_20px_-5px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-1">
                            <h5 class="font-bold text-slate-800 text-lg">{{ $aspiration->name }}</h5>
                            <span
                                class="text-xs px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full font-semibold border border-orange-100">
                                {{ $aspiration->category }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-400 mb-4">{{ $aspiration->created_at->format('d F Y') }}</p>
                        <p class="text-base text-slate-700 mb-6 font-medium">
                            {{ Str::limit($aspiration->message, 100) }}</p>

                        <div class="flex items-center gap-2 text-sm text-slate-600 font-semibold">
                            @if ($aspiration->status == 'dalam_proses')
                                <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span> Dalam Proses
                            @elseif($aspiration->status == 'ditindaklanjuti')
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Ditindaklanjuti
                            @else
                                <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span> Selesai
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 text-center py-8 text-slate-500">
                        Belum ada aspirasi masyarakat yang ditampilkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Berita Terkini --}}

    <section id="berita" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-100">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-1">
                <i class="fa-solid fa-newspaper text-2xl text-orange-600"></i>
                <h3 class="text-2xl font-bold text-slate-800">Berita Terkini</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($newsList as $news)
                <div class="news-card bg-white rounded-2xl border border-orange-600/50 shadow-sm cursor-pointer transition-transform duration-300 hover:scale-105 hover:shadow-2xl group flex flex-col h-full overflow-hidden"
                    data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->id }}"
                    data-id="{{ $news->id }}">

                    <div class="w-full h-48 bg-slate-100 flex items-center justify-center overflow-hidden shrink-0">
                        <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <span
                                class="bg-orange-100 text-orange-600 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-widest">
                                {{ $news->category }}
                            </span>
                            <span class="text-xs text-slate-500 font-medium">• {{ $news->formatted_date }}</span>
                        </div>

                        <h4
                            class="font-bold text-slate-800 text-lg leading-snug group-hover:text-orange-600 transition-colors line-clamp-2">
                            {{ $news->title }}
                        </h4>

                        <p class="text-slate-500 text-sm mt-3 mb-6 line-clamp-2">
                            {{ strip_tags($news->description) }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center text-orange-600 font-semibold text-sm">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>

                            <div
                                class="flex items-center gap-1.5 bg-slate-50 border border-slate-100 text-slate-600 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm group-hover:bg-orange-50 group-hover:text-orange-600 group-hover:border-orange-200 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ number_format($news->views_count, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content rounded-2xl border-0 overflow-hidden">
                            <div class="modal-header border-b border-slate-100 bg-white">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}"
                                    class="w-full h-64 object-cover">

                                <div class="p-6 md:p-8">
                                    <div class="flex items-center flex-wrap gap-2 mb-4">
                                        <span
                                            class="bg-orange-100 text-orange-600 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-widest">
                                            {{ $news->category }}
                                        </span>
                                        <span class="text-sm text-slate-500 font-medium">•
                                            {{ $news->formatted_date }}</span>

                                        <span
                                            class="bg-slate-100 text-slate-600 font-bold text-xs px-3 py-1 rounded-full flex items-center gap-1.5 shadow-sm md:ml-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ number_format($news->views_count, 0, ',', '.') }} Views
                                        </span>
                                    </div>

                                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 leading-tight">
                                        {{ $news->title }}
                                    </h2>
                                    <div class="prose prose-slate max-w-none text-slate-700">
                                        {!! $news->description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-slate-50 border-t border-slate-100">
                                <button type="button"
                                    class="bg-slate-200 text-slate-700 px-6 py-2 rounded-lg font-medium hover:bg-slate-300 transition"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-slate-900 text-slate-300 py-12 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">

            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo-pemda.png') }}" alt="Logo Pemda" class="w-8 h-8 object-contain">
                    <h3 class="font-bold text-white text-lg">DPR RI</h3>
                </div>
                <p class="text-sm text-slate-400">Dewan Perwakilan Rakyat Republik Indonesia</p>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="#beranda" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#foto-daerah" class="hover:text-white transition">Foto Daerah</a></li>
                    <li><a href="#anggota" class="hover:text-white transition">Anggota Dewan</a></li>
                    <li><a href="#kegiatan" class="hover:text-white transition">Informasi Kegiatan</a></li>
                    <li><a href="#berita" class="hover:text-white transition">Berita Terkini</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Layanan</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="#organisasi" class="hover:text-white transition">Data Organisasi</a></li>
                    <li><a href="#kelengkapan" class="hover:text-white transition">Alat Kelengkapan</a></li>
                    <li><a href="#struktural" class="hover:text-white transition">Struktural Dewan</a></li>
                    <li><a href="#aspirasi" class="hover:text-white transition">Aspirasi Masyarakat</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Kontak</h4>
                <address class="not-italic text-sm text-slate-400 space-y-3">
                    <p>Jl. Jenderal Gatot Subroto<br>Jakarta Pusat, DKI Jakarta</p>
                    <p>Tel: (021) 5715.509</p>
                    <p>Email: info@dpr.go.id</p>
                </address>
            </div>

        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-slate-800 text-sm text-slate-400 text-center">
            &copy; 2026 Dewan Perwakilan Rakyat Republik Indonesia. All rights reserved.
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function switchPdf(targetId, clickedBtn) {
            // 1. Sembunyikan semua panel PDF
            document.querySelectorAll('.pdf-panel').forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            });

            // 2. Tampilkan panel yang dituju
            document.getElementById(targetId).classList.remove('hidden');
            document.getElementById(targetId).classList.add('block');

            // 3. Reset warna semua tombol tab ke keadaan tidak aktif
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-orange-600', 'text-white', 'shadow-md');
                btn.classList.add('bg-slate-50', 'text-slate-600', 'border', 'border-slate-200', 'border-b-0',
                    'hover:bg-orange-100', 'hover:text-orange-700');
            });

            // 4. Beri warna aktif (oranye) pada tombol yang baru saja diklik
            clickedBtn.classList.remove('bg-slate-50', 'text-slate-600', 'border', 'border-slate-200', 'border-b-0',
                'hover:bg-orange-100', 'hover:text-orange-700');
            clickedBtn.classList.add('bg-orange-600', 'text-white', 'shadow-md');
        }
        $(document).ready(function() {
            // Ketika card berita diklik
            $('.news-card').on('click', function() {
                let newsId = $(this).data('id');
                let url = "/news/" + newsId + "/track-view";

                // Kirim request di belakang layar (tanpa reload halaman)
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log("Status view:", response.status);
                    }
                });
            });
        });
    </script>
</body>

</html>
