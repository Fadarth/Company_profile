<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login | Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <style>
        /* 1. Animasi Latar Belakang Gradasi Halus Nuansa Oranye */
        body {
            /* Perubahan: Warna dasar bernuansa putih krem, oranye muda, dan peach */
            background: linear-gradient(-45deg, #fffdfa, #fdf4e7, #fae1c5, #fffdfa);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .authentication-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* 2. Animasi Munculnya Kartu Login */
        .card-authentication {
            width: 100%;
            max-width: 420px;
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 15px 35px 0 rgba(234, 88, 12, 0.15);
            /* Shadow bernuansa oranye */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-top: 5px solid #ea580c;
            /* Aksen oranye di atas kartu */

            /* Animasi Slide Up & Fade In */
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 0.8s cubic-bezier(0.25, 0.8, 0.25, 1) forwards;
        }

        @keyframes slideUpFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 3. Animasi pada Input Field saat Fokus */
        .form-control {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        /* Perubahan: Efek fokus input bernuansa oranye */
        .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(234, 88, 12, 0.15);
            border-color: #ea580c;
        }

        .input-group-text i {
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .form-control:focus+.input-group-text i,
        .input-group:focus-within .input-group-text i {
            color: #ea580c;
            /* Ikon berubah oranye saat input fokus */
        }

        /* Styling Tombol Login */
        .btn-primary {
            background-color: #ea580c;
            /* Tailwind orange-600 */
            border-color: #ea580c;
            border-radius: 0.5rem;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: white;
        }

        .btn-primary:hover {
            background-color: #c2410c;
            /* Tailwind orange-700 */
            border-color: #c2410c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(234, 88, 12, 0.4);
            color: white;
        }

        .btn-primary:focus {
            background-color: #c2410c;
            border-color: #c2410c;
            box-shadow: 0 0 0 0.25rem rgba(234, 88, 12, 0.5);
        }

        /* Custom Checkbox Oranye */
        .form-check-input:checked {
            background-color: #ea580c;
            border-color: #ea580c;
        }

        /* 4. Animasi Loading pada Tombol saat Submit */
        .btn-loading {
            position: relative;
            color: transparent !important;
            pointer-events: none;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            width: 1.2rem;
            height: 1.2rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Text styling */
        .text-orange {
            color: #ea580c !important;
        }
    </style>
</head>

<body>

    <div class="authentication-wrapper px-4">
        <div class="card card-authentication">
            <div class="card-body p-sm-5 p-4">
                <div class="d-flex justify-content-center mb-4">
                    <span class="fs-3 fw-bolder text-orange d-flex align-items-center gap-3">
                        <img src="{{ asset('images/logo-pemda.png') }}" alt="Logo Pemda Merauke"
                            style="height: 45px; width: auto; object-fit: contain; transition: transform 0.3s ease;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                        Admin Panel
                    </span>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2" style="animation: slideUpFadeIn 0.5s ease forwards;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted fw-bold">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text bg-transparent border-end-0"><i class='bx bx-user'></i></span>
                            <input type="email" class="form-control border-start-0 ps-0" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text bg-transparent border-end-0"><i
                                    class='bx bx-lock-alt'></i></span>
                            <input type="password" id="password" class="form-control border-start-0 ps-0"
                                name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                        </div>
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label text-muted" for="remember"> Ingat Saya </label>
                        </div>
                    </div>

                    <button id="submitBtn" class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('btn-loading');
        });
    </script>
</body>

</html>
