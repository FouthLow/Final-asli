<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Eksternal Login -->
    <link rel="stylesheet" href="{{ asset('css/login-custom.css') }}">
</head>
<body>

    <div class="min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="login-wrapper">
            <div class="row align-items-center g-5">
                
                <!-- Gambar Kiri -->
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ asset('storage/images/Piclogin1.png') }}" alt="Eimei Highschool Hero" class="hero-img">
                </div>

                <!-- Form Login Kanan -->
                <div class="col-md-6 px-lg-4">
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-baseline gap-2 flex-wrap">
                            <h2 class="fw-bold mb-0 text-dark" style="font-size: 1.8rem;">栄明高等学校</h2>
                            <h3 class="fw-normal mb-0 text-dark" style="font-size: 1.8rem;">Admin Login</h3>
                        </div>
                        <p class="text-secondary small mb-0 mt-1">Eimei Highschool</p>
                    </div>

                    <!-- Alert Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-4 py-2 px-3 mb-3 small" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Input Email -->
                        <div class="mb-3">
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-custom @error('email') is-invalid @enderror" 
                                   placeholder="Email/Nama Pengguna" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                        </div>

                        <!-- Input Password -->
                        <div class="mb-4">
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-custom @error('password') is-invalid @enderror" 
                                   placeholder="Kata Sandi" 
                                   required>
                        </div>

                        <!-- Remember Me -->
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <input class="form-check-input form-check-input-custom mt-0" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary small" for="remember" style="cursor: pointer;">
                                Simpan riwayat masuk
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-black">Masuk</button>
                        </div>

                        <div class="text-center">
                            <small class="text-secondary" style="font-size: 0.8rem;">
                                *Hubungi pihak terkait untuk meminta akun 
                                <a href="/" class="text-dark fw-bold text-decoration-underline ms-1">Hubungi</a>
                            </small>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>