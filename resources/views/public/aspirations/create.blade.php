<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Aspirasi Masyarakat</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FFF9F2] to-orange-50 min-h-screen flex flex-col">

    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-orange-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                    A
                </div>
                <span class="font-bold text-slate-800 text-lg tracking-wide">Portal Aspirasi</span>
            </div>
            <a href="{{ url('/') }}"
                class="text-sm font-semibold text-slate-500 hover:text-orange-600 transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6">
        <div class="max-w-3xl w-full">

            @if (session('success'))
                <div
                    class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl shadow-orange-900/5 border border-orange-100 p-8 md:p-12">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-bold text-slate-800 mb-3">Sampaikan Aspirasi Anda</h2>
                    <p class="text-slate-500 leading-relaxed">Suara Anda sangat berarti untuk kemajuan bersama. Silakan
                        isi formulir di bawah ini dengan jelas agar kami dapat menindaklanjutinya.</p>
                </div>

                <form action="{{ route('public.aspirations.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" required placeholder="Masukkan nama Anda"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white placeholder-slate-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email / No HP <span
                                    class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="contact" placeholder="Untuk keperluan *follow-up*"
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white placeholder-slate-400">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori Aspirasi <span
                                class="text-red-500">*</span></label>
                        <select name="category" required
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white cursor-pointer appearance-none">
                            <option value="" disabled selected>Pilih kategori yang paling sesuai...</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Infrastruktur">Infrastruktur & Pembangunan</option>
                            <option value="Ekonomi">Ekonomi & UMKM</option>
                            <option value="Layanan Publik">Layanan Administrasi Publik</option>
                            <option value="Lingkungan">Lingkungan & Kebersihan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Aspirasi / Pengaduan <span
                                class="text-red-500">*</span></label>
                        <textarea name="message" rows="5" required placeholder="Ceritakan detail aspirasi atau masalah yang Anda temui..."
                            class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all text-slate-700 bg-slate-50 focus:bg-white placeholder-slate-400 resize-y"></textarea>
                    </div>

                    <div
                        class="flex flex-col-reverse md:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-100">
                        <a href="{{ url('/') }}"
                            class="w-full md:w-auto text-center px-6 py-3 text-slate-500 hover:text-slate-800 font-semibold transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-full md:w-auto bg-orange-600 text-white px-8 py-3.5 rounded-xl font-bold hover:bg-orange-700 active:scale-95 transition-all shadow-lg shadow-orange-600/30 flex items-center justify-center gap-2">
                            <span>Kirim Aspirasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-8 text-slate-400 text-sm font-medium">
                &copy; {{ date('Y') }} Portal Layanan Masyarakat. Dilindungi Undang-Undang.
            </div>

        </div>
    </main>

</body>

</html>
