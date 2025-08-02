<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-3/assets/css/login-3.css">
  <link rel="stylesheet" href="login.css">
  <title>mocikimici - login</title>
</head>

<body>
  <!-- Login 3 - Bootstrap Brain Component -->
  <section class="p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 bsb-tpl-bg-pink">
          <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
            <h3 class="m-0">Welcome!</h3>
            <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true" width="245" height="80" alt="BootstrapBrain Logo">
          </div>
        </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
          <div class="p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Log in</h3>
                </div>
              </div>
            </div>
            @if (session('error'))
            <div class="alert alert-danger mt-3">
              {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-secondary" for="remember">
                      Keep me logged in
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</body>

</html>