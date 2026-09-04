<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Eksternal -->
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

                <!-- Form Hubungi Kanan -->
                <div class="col-md-6 px-lg-4">
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-baseline gap-2 flex-wrap">
                            <h2 class="fw-bold mb-0 text-dark" style="font-size: 1.8rem;">栄明高等学校</h2>
                            <h3 class="fw-normal mb-0 text-dark" style="font-size: 1.8rem;">Admin Login</h3>
                        </div>
                        <p class="text-secondary small mb-0 mt-1">Eimei Highschool</p>
                    </div>

                    <!-- Input Email (Readonly/Disabled untuk Informasi Contact) -->
                    <div class="mb-1">
                        <label class="form-label text-dark fw-medium small mb-1">Email</label>
                        <input type="email" 
                               class="form-control form-control-custom bg-white" 
                               value="eimeihighschool@sch.id" 
                               readonly>
                    </div>
                    
                    <!-- Catatan Dilarang Spam Mail -->
                    <div class="mb-5">
                        <small class="text-secondary" style="font-size: 0.75rem;">*hubungi email diatas untuk meminta akun</small>
                    </div>

                    <!-- Tombol Kembali Ke Beranda -->
                    <div class="d-grid pt-3">
                        <a href="{{ route('login') }}" class="btn btn-black rounded-pill py-2.5 fw-semibold text-center text-decoration-none">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>