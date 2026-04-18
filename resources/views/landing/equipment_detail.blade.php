<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $equipment->name }} - Dewan Perwakilan Rakyat RI</title>
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fffdfa !important;
        }

        section {
            background-color: transparent !important;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 w-full">
        <div id="alert-banner"
            class="bg-amber-100 text-amber-800 px-4 py-3 rounded-md text-sm flex justify-between items-center border border-amber-200">
            <span>
                <i class="fa-solid fa-circle-info text-amber-600 me-2"></i>
                Isi dan kelengkapan data merupakan kewenangan masing-masing Sekretariat Alat Kelengkapan Dewan (AKD).
            </span>
            <button onclick="document.getElementById('alert-banner').remove()"
                class="text-amber-800 hover:text-amber-900 transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="text-center mt-12 mb-8">
            <h1 class="text-4xl font-bold text-slate-900 mb-4">{{ $equipment->name }}</h1>
            <div class="flex items-center justify-center gap-6 text-slate-500">
                <span><i class="fa-solid fa-envelope me-2"></i> Email:
                    set_{{ str_replace('-', '', $equipment->slug) }}@dpr.go.id</span>
                <span>|</span>
                <span><i class="fa-solid fa-phone me-2"></i> Telepon: -</span>
            </div>
        </div>
    </div>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mb-20 flex flex-col md:flex-row gap-8">

        <aside class="w-full md:w-1/4">
            <div class="bg-white border border-slate-100 rounded-lg shadow-sm overflow-hidden">
                <ul class="flex flex-col text-slate-700 font-medium">
                    <li class="border-b border-slate-100">
                        <a href="#"
                            class="flex justify-between items-center px-6 py-4 hover:bg-slate-50 transition">
                            <span><i class="fa-regular fa-calendar me-3 w-5 text-center"></i> Tentang</span>
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </a>
                    </li>
                    <li class="border-b border-slate-100 bg-orange-50/50 border-l-4 border-orange-600">
                        <a href="#" class="block px-6 py-4 text-orange-600 font-bold">
                            <span class="ms-8">Informasi Tugas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <section class="w-full md:w-3/4">
            <div class="mb-10">
                <h3 class="text-lg font-bold text-slate-900 mb-4 uppercase tracking-wide">Ruang Lingkup Tugas</h3>
                <ul class="list-square pl-5 space-y-2 text-slate-700 marker:text-slate-800 marker:text-sm">
                    @if ($equipment->task_scope)
                        @foreach (explode("\n", $equipment->task_scope) as $item)
                            @if (trim($item) != '')
                                <li class="pl-2" style="list-style-type: square;">{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    @else
                        <p class="text-slate-400 italic list-none -ml-5">Belum ada data ruang lingkup tugas.</p>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-900 mb-4 uppercase tracking-wide">Mitra Kerja</h3>
                <ul class="list-square pl-5 space-y-2 text-slate-700 marker:text-slate-800 marker:text-sm">
                    @if ($equipment->work_partners)
                        @foreach (explode("\n", $equipment->work_partners) as $item)
                            @if (trim($item) != '')
                                <li class="pl-2" style="list-style-type: square;">{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    @else
                        <p class="text-slate-400 italic list-none -ml-5">Belum ada data mitra kerja.</p>
                    @endif
                </ul>
            </div>
        </section>

    </main>

    <footer class="bg-slate-900 text-slate-300 py-12 mt-auto">
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
</body>

</html>
