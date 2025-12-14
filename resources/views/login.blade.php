<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="login.css">
  <link rel="shortcut icon" href="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true" type="image/x-icon">
  <title>Mochi Kimochi - Admin Login</title>
</head>
<body>
  <section class="login-container p-3 p-md-4">
    <div class="container">
      <div class="row g-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 900px; margin: 0 auto;">
        <!-- Logo Sectionsection -->
        <div class="col-12 col-md-5 bsb-tpl-bg-pink">
          <div class="logo-section">
            <div class="text-center">
              <img class="img-fluid rounded" loading="lazy" 
                   src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true" 
                   width="200" alt="Mochi Kimochi Logo">
              <h4 class="text-white mt-4 fw-bold">Admin Panel</h4>
              <p class="text-white opacity-75">Mochi Kimochi</p>
            </div>
          </div>
        </div>
        
        <!-- Form Section -->
        <div class="col-12 col-md-7 bsb-tpl-bg-lotion">
          <div class="login-form-section">
            <div class="mb-4">
              <h3><i class="fas fa-lock me-2"></i>Login Admin</h3>
              <p class="text-muted">Masukkan credentials untuk akses dashboard</p>
            </div>
            
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="username" class="form-label fw-semibold">
                  <i class="fas fa-user me-1"></i>Username <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-lg" name="username" id="username" 
                       placeholder="Masukkan username" required>
              </div>
              
              <div class="mb-3">
                <label for="password" class="form-label fw-semibold">
                  <i class="fas fa-key me-1"></i>Password <span class="text-danger">*</span>
                </label>
                <input type="password" class="form-control form-control-lg" name="password" id="password" 
                       placeholder="Masukkan password" required>
              </div>
              
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember">
                  <label class="form-check-label text-secondary" for="remember">
                    Ingat saya
                  </label>
                </div>
              </div>
              
              <div class="d-grid">
                <button class="btn btn-primary btn-lg" type="submit">
                  <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>