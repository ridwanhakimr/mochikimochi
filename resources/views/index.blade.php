<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon"
    href="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true"
    type="image/x-icon">
  <title>Mochi Kimochi</title>
</head>

<body>
  <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light fixed-top navbar-transparent">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#"><img
          src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true"
          alt="logo mochi kimochi" width="55" height="55"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item p-2 text-center"><a class="nav-link rounded py-2 px-3" href="#">HOME</a></li>
          <li class="nav-item p-2 text-center"><a class="nav-link rounded py-2 px-3" href="#produk">PRODUK</a></li>
          <li class="nav-item p-2 text-center"><a class="nav-link rounded py-2 px-3" href="#kontak">KONTAK</a></li>
          <li class="nav-item p-2 text-center">
            <a id="checkoutToggle" class="nav-link rounded py-2 px-3 position-relative" href="javascript:void(0)">
              <i class="bi bi-cart-check"></i> Check Out
              <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                0
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="home bg-light d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-white display-1 mb-1 fw-bold">MOCHI KIMOCHI</h1>
    <p class="lead text-white">Rasakan sensasi mochi premium isi krim dan topping buah segar. Cocok untuk cemilan,
      hadiah, atau teman santai soremu!</p>
    <a href="#produk" class="btn btn-pink me-2">Lihat Menu</a>
  </div>

  <section class="container py-5" id="produk">
    <h2 class="text-center mb-5 fw-bold" style="color:#FF90BB;">Varian Rasa Mochi Kami</h2>
    <div class="row g-4">
      @foreach($products as $product)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="product-card">
          <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-img" />
          <div class="card-body">
            <h5 class="product-title">{{ $product->nama }}</h5>
            <p class="product-desc">
              {{ $product->deskripsi }}
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <p class="product-price fw-bold text-success mb-0">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
              <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                  Stok: {{ $product->stok }}
              </span>
            </div>
            @if ($product->stok > 0)
            <button class="btn btn-buy mt-2"
              data-id="{{ $product->id }}"
              data-nama="{{ $product->nama }}"
              data-harga="{{ $product->harga }}"
              data-gambar="{{ asset('storage/' . $product->gambar) }}"
              data-stok="{{ $product->stok }}">
              <i class="bi bi-cart-check-fill"></i> Pesan Sekarang
            </button>
            @else
            <button class="btn btn-secondary mt-2" disabled>Stok Habis</button>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>
  <aside id="checkoutSidebar" class="checkout-sidebar closed">
    <div class="p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0"><i class="bi bi-cart-check"></i> Check Out</h5>
        <button id="closeSidebar" class="btn-close"></button>
      </div>

      <ul class="list-group mb-3" id="cart-items">
        </ul>

      <hr />

      <div class="d-flex justify-content-between fw-bold mb-3">
        <span>Total</span>
        <span class="text-success" id="cart-total">Rp0</span>
      </div>

      <button class="btn btn-success w-100" id="whatsapp-checkout">
        <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
      </button>
    </div>
  </aside>

  <section id="kontak" class="py-5 bg-light" style="height: 100vh;">
    <div class="container">
      <h2 class="text-center fw-bold mb-5" style="color: #0d6efd;">KONTAK</h2>
      <div class="row g-4 align-items-center">

        <div class="col-md-6">
          <div class="d-flex align-items-start mb-4">
            <div class="me-3 fs-3 text-success"><i class="bi bi-whatsapp"></i></div>
            <div>
              <h5 class="fw-bold mb-1">WhatsApp</h5>
              <a href="https://wa.me/6281234567890" target="_blank" class="text-decoration-none text-dark">+62
                812-3456-7890</a>
            </div>
          </div>
          <div class="d-flex align-items-start mb-4">
            <div class="me-3 fs-3 text-danger"><i class="bi bi-instagram"></i></div>
            <div>
              <h5 class="fw-bold mb-1">Instagram</h5>
              <a href="https://instagram.com/mochikimochi" target="_blank"
                class="text-decoration-none text-dark">@mochikimochi</a>
            </div>
          </div>
          <div class="d-flex align-items-start">
            <div class="me-3 fs-3 text-primary"><i class="bi bi-geo-alt-fill"></i></div>
            <div>
              <h5 class="fw-bold mb-1">Alamat</h5>
              <p class="mb-0">Jl. Pak Gatot Raya No.73S, Gegerkalong, Kec. Sukasari, Kota Bandung, Jawa Barat 40153</p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="ratio ratio-4x3 rounded shadow-sm">
            <iframe
              src="https://maps.google.com/maps?q=Jalan%20Pak%20Gatot%20Raya%20No.73S%2C%20Gegerkalong%2C%20Kecamatan%20Sukasari%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040153&t=&z=13&ie=UTF8&iwloc=&output=embed"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer class="bg-dark text-light pt-5 pb-3">
    <div class="container">
      <div class="row g-4 justify-content-between">

        <div class="col-md-6">
          <div class="d-flex align-items-start">
            <img src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true" alt="Logo Mochi Kimochi" width="50" class="me-3" />
            <div>
              <h5 class="fw-bold">Mochi Kimochi</h5>
              <p class="small mb-0">
                Rasakan kelembutan dan cita rasa khas dari mochi kami. Manis, lembut, dan selalu segar!
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4 align-items-start">
          <h5 class="fw-bold">Ikuti Kami</h5>
          <ul class="list-unstyled">
            <li>
              <i class="bi bi-instagram text-danger me-2"></i>
              <a href="https://instagram.com/mochikimochi" class="text-light text-decoration-none"
                target="_blank">@mochikimochi</a>
            </li>
          </ul>
        </div>

      </div>

      <hr class="border-secondary mt-4" />
      <div class="text-center small">
        © 2025 Mochi Kimochi. Hak Cipta Dilindungi.
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cart = {};
      const cartItemsContainer = document.getElementById('cart-items');
      const cartTotalElement = document.getElementById('cart-total');
      const whatsappCheckoutButton = document.getElementById('whatsapp-checkout');
      const cartBadge = document.getElementById('cart-badge');

      function updateCartView() {
        cartItemsContainer.innerHTML = '';
        let total = 0;
        let totalQty = 0;

        for (const id in cart) {
          const item = cart[id];
          total += item.harga * item.qty;
          totalQty += item.qty;

          const cartItemHTML = `
            <li class="list-group-item d-flex align-items-center">
              <img src="${item.gambar}" alt="${item.nama}" width="50" height="50" class="rounded me-3" />
              <div class="flex-grow-1">
                <div class="fw-semibold">${item.nama}</div>
                <div class="d-flex align-items-center gap-2 mt-1">
                  <button class="btn btn-sm btn-outline-secondary px-2 py-0 btn-minus" data-id="${id}">−</button>
                  <span class="qty">${item.qty}</span>
                  <button class="btn btn-sm btn-outline-secondary px-2 py-0 btn-plus" data-id="${id}">+</button>
                </div>
              </div>
              <span class="fw-bold text-success ms-3">Rp${(item.harga * item.qty).toLocaleString('id-ID')}</span>
            </li>
          `;
          cartItemsContainer.innerHTML += cartItemHTML;
        }

        cartTotalElement.textContent = `Rp${total.toLocaleString('id-ID')}`;

        if (totalQty > 0) {
          cartBadge.textContent = totalQty;
          cartBadge.style.display = 'block';
        } else {
          cartBadge.style.display = 'none';
        }
      }

      function resetCart() {
        for (const key in cart) {
          delete cart[key];
        }
        updateCartView();
      }

      document.querySelectorAll('.btn-buy').forEach(button => {
          button.addEventListener('click', function() {
              const id = this.dataset.id;
              const stok = parseInt(this.dataset.stok);

              if (cart[id] && cart[id].qty >= stok) {
                  alert('Jumlah pesanan tidak boleh melebihi stok!');
                  return;
              }

              if (cart[id]) {
                  cart[id].qty++;
              } else {
                  cart[id] = {
                      nama: this.dataset.nama,
                      harga: parseInt(this.dataset.harga),
                      gambar: this.dataset.gambar,
                      stok: stok,
                      qty: 1
                  };
              }
              updateCartView();
          });
      });

      cartItemsContainer.addEventListener('click', function(e) {
          const id = e.target.dataset.id;
          if (e.target.classList.contains('btn-plus')) {
              if (cart[id].qty < cart[id].stok) {
                  cart[id].qty++;
              } else {
                  alert('Jumlah pesanan tidak boleh melebihi stok!');
              }
          } else if (e.target.classList.contains('btn-minus')) {
              cart[id].qty--;
              if (cart[id].qty === 0) {
                  delete cart[id];
              }
          }
          updateCartView();
      });

      whatsappCheckoutButton.addEventListener('click', function() {
    if (Object.keys(cart).length === 0) {
        alert("Keranjang Anda masih kosong!");
        return;
    }

    // Kirim data ke server untuk mengurangi stok
    fetch("{{ route('checkout.process') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token ada di meta tag
        },
        body: JSON.stringify({ cart: cart })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal mengurangi stok produk.');
        }
        return response.json();
    })
    .then(data => {
        console.log(data.message); // Tampilkan pesan sukses

        // Lanjutkan ke WhatsApp
        let message = "Halo, saya ingin memesan:\n\n";
        let total = 0;

        for (const id in cart) {
            const item = cart[id];
            const subtotal = item.harga * item.qty;
            message += `${item.nama} ${item.qty} = Rp${subtotal.toLocaleString('id-ID')}\n`;
            total += subtotal;
        }

        message += `\nTotal: Rp${total.toLocaleString('id-ID')}`;

        const whatsappURL = `https://wa.me/6289604482359?text=${encodeURIComponent(message)}`;
        window.open(whatsappURL, '_blank');

        // Reset keranjang setelah berhasil
        resetCart();
        
        // Refresh halaman untuk mendapatkan data stok terbaru
        location.reload(); 
    })
    .catch(error => {
        alert(error.message);
        console.error('Error:', error);
    });
});

      const toggleBtn = document.getElementById("checkoutToggle");
      const sidebar = document.getElementById("checkoutSidebar");
      const closeBtn = document.getElementById("closeSidebar");

      toggleBtn.addEventListener("click", () => {
        sidebar.classList.remove("closed");
        sidebar.classList.add("open");
      });

      closeBtn.addEventListener("click", () => {
        sidebar.classList.remove("open");
        sidebar.classList.add("closed");
      });
      
      updateCartView();

    });

    const navbar = document.getElementById("mainNavbar");

    window.addEventListener("scroll", function() {
      if (window.scrollY > 20) {
        navbar.classList.add("navbar-scrolled");
        navbar.classList.remove("navbar-transparent");
      } else {
        navbar.classList.add("navbar-transparent");
        navbar.classList.remove("navbar-scrolled");
      }
    });

    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".nav-link");

    window.addEventListener("scroll", () => {
      let current = "";

      sections.forEach(section => {
        const sectionTop = section.offsetTop - 100; // sesuaikan offset
        const sectionHeight = section.offsetHeight;

        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${current}`) {
          link.classList.add("active");
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>