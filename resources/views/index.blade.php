<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Mochi Kimochi - Rasakan sensasi mochi premium isi krim dan topping buah segar. Cocok untuk cemilan, hadiah, atau teman santai soremu!">
  <meta name="keywords" content="mochi, mochi kimochi, dessert, cemilan, bandung, premium mochi">
  <meta name="author" content="Mochi Kimochi">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Bootstrap Icons (fallback) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Custom Styles -->
  <link rel="stylesheet" href="style.css">
  
  <link rel="shortcut icon"
    href="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true"
    type="image/x-icon">
  <title>Mochi Kimochi - Premium Mochi Bandung</title>
</head>

<body>
  <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light fixed-top navbar-transparent">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#" aria-label="Mochi Kimochi Home">
        <img src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true"
          alt="Logo Mochi Kimochi" width="55" height="55">
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item p-2 text-center">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item p-2 text-center">
            <a class="nav-link" href="#produk">Produk</a>
          </li>
          <li class="nav-item p-2 text-center">
            <a class="nav-link" href="#kontak">Kontak</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Floating Cart Button -->
  <div id="floatingCart" class="floating-cart" role="button" aria-label="Shopping Cart">
    <i class="fas fa-shopping-cart"></i>
    <span id="floating-cart-badge" class="cart-badge hidden">0</span>
  </div>

  <!-- Mobile Bottom Navigation -->
  <nav class="mobile-bottom-nav">
    <div class="nav-container">
      <a href="#" class="nav-item-mobile active">
        <i class="fas fa-home"></i>
        <span>Home</span>
      </a>
      <a href="#produk" class="nav-item-mobile">
        <i class="fas fa-cookie-bite"></i>
        <span>Produk</span>
      </a>
      <a href="#kontak" class="nav-item-mobile">
        <i class="fas fa-phone-alt"></i>
        <span>Kontak</span>
      </a>
    </div>
  </nav>

  <header class="home">
    <div class="container">
      <h1 class="text-white mb-3 fw-bold">MOCHI KIMOCHI</h1>
      <p class="lead text-white mb-4">Rasakan sensasi mochi premium isi krim dan topping buah segar.<br>Cocok untuk cemilan, hadiah, atau teman santai soremu!</p>
      <a href="#produk" class="btn btn-pink">
        <i class="fas fa-arrow-down me-2"></i>Lihat Menu
      </a>
    </div>
  </header>

  <section id="produk" class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Varian Rasa Mochi Kami</h2>
      </div>
      <div class="row g-4">
        @foreach($products as $product)
        <div class="col-12 col-sm-6 col-lg-4">
          <article class="product-card">
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-img" loading="lazy" />
            <div class="card-body">
              <h3 class="product-title">{{ $product->nama }}</h3>
              <p class="product-desc">{{ $product->deskripsi }}</p>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="product-price">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                  <i class="fas fa-box"></i> {{ $product->stok }}
                </span>
              </div>
              @if ($product->stok > 0)
              <button class="btn btn-buy"
                data-id="{{ $product->id }}"
                data-nama="{{ $product->nama }}"
                data-harga="{{ $product->harga }}"
                data-gambar="{{ asset('storage/' . $product->gambar) }}"
                data-stok="{{ $product->stok }}">
                <i class="fas fa-cart-plus me-2"></i>Pesan Sekarang
              </button>
              @else
              <button class="btn btn-secondary" disabled>
                <i class="fas fa-times-circle me-2"></i>Stok Habis
              </button>
              @endif
            </div>
          </article>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <aside id="checkoutSidebar" class="checkout-sidebar closed d-none d-lg-block">
    <div class="p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
          <i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja
        </h5>
        <button id="closeSidebar" class="btn-close" aria-label="Close"></button>
      </div>
      <ul class="list-group mb-3" id="cart-items-desktop"></ul>
      <hr />
      <div class="d-flex justify-content-between fw-bold mb-3">
        <span>Total</span>
        <span class="text-success" id="cart-total-desktop">Rp0</span>
      </div>
      <button class="btn btn-success w-100" id="whatsapp-checkout-desktop">
        <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
      </button>
    </div>
  </aside>

  <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="checkoutModalLabel">
            <i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group mb-3" id="cart-items-mobile"></ul>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="d-flex justify-content-between fw-bold mb-3">
              <span>Total</span>
              <span class="text-success" id="cart-total-mobile">Rp0</span>
            </div>
            <button class="btn btn-success w-100" id="whatsapp-checkout-mobile">
              <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section id="kontak" class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Hubungi Kami</h2>
      </div>
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-6">
          <div class="row g-3 h-100">
            <div class="col-12">
              <div class="contact-item h-100">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <i class="fab fa-whatsapp text-success"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold mb-1">WhatsApp</h5>
                    <a href="https://wa.me/6289630832740" target="_blank" class="text-decoration-none text-muted">
                      +62 896-3083-2740
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="contact-item h-100">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <i class="fab fa-instagram" style="color: #E4405F;"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold mb-1">Instagram</h5>
                    <a href="https://instagram.com/mochikimochi" target="_blank" class="text-decoration-none text-muted">
                      @mochikimochi
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="contact-item h-100">
                <div class="d-flex align-items-start">
                  <div class="me-3">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold mb-1">Alamat</h5>
                    <p class="mb-0 text-muted">
                      Jl. Pak Gatot Raya No.73S, Gegerkalong, Kec. Sukasari, Kota Bandung, Jawa Barat 40153
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden">
            <iframe
              src="https://maps.google.com/maps?q=Jalan%20Pak%20Gatot%20Raya%20No.73S%2C%20Gegerkalong%2C%20Kecamatan%20Sukasari%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040153&t=&z=15&ie=UTF8&iwloc=&output=embed"
              style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="pt-5 pb-3">
    <div class="container">
      <div class="row g-4 justify-content-between">
        <div class="col-md-7">
          <div class="d-flex align-items-start mb-3">
            <img src="https://github.com/ridwanhakimr/gambar/blob/main/image/mochi%20kimochi/mochilogo.png?raw=true" 
                 alt="Logo Mochi Kimochi" width="60" class="me-3" />
            <div>
              <h5 class="fw-bold mb-2">Mochi Kimochi</h5>
              <p class="mb-0" style="max-width: 400px;">
                Rasakan kelembutan dan cita rasa khas dari mochi kami. Manis, lembut, dan selalu segar!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h5 class="fw-bold mb-3">Ikuti Kami</h5>
          <div class="d-flex gap-3">
            <a href="https://instagram.com/mochikimochi" target="_blank" 
               class="text-light text-decoration-none d-flex align-items-center" 
               aria-label="Instagram Mochi Kimochi">
              <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" 
               class="text-light text-decoration-none d-flex align-items-center" 
               aria-label="WhatsApp Mochi Kimochi">
              <i class="fab fa-whatsapp fa-2x text-success"></i>
            </a>
          </div>
        </div>
      </div>
      <hr class="border-secondary mt-4 mb-3" />
      <div class="text-center small">
        <p class="mb-0">
          © 2025 <strong>Mochi Kimochi</strong>. All Rights Reserved.
        </p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cart = {};
      const cartItemsDesktop = document.getElementById('cart-items-desktop');
      const cartTotalDesktop = document.getElementById('cart-total-desktop');
      const whatsappCheckoutDesktop = document.getElementById('whatsapp-checkout-desktop');

      const cartItemsMobile = document.getElementById('cart-items-mobile');
      const cartTotalMobile = document.getElementById('cart-total-mobile');
      const whatsappCheckoutMobile = document.getElementById('whatsapp-checkout-mobile');

      const floatingCartBadge = document.getElementById('floating-cart-badge');

      function updateCartView() {
        cartItemsDesktop.innerHTML = '';
        cartItemsMobile.innerHTML = '';
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
          cartItemsDesktop.innerHTML += cartItemHTML;
          cartItemsMobile.innerHTML += cartItemHTML;
        }

        cartTotalDesktop.textContent = `Rp${total.toLocaleString('id-ID')}`;
        cartTotalMobile.textContent = `Rp${total.toLocaleString('id-ID')}`;

        // Update floating cart badge
        if (totalQty > 0) {
          floatingCartBadge.textContent = totalQty;
          floatingCartBadge.classList.remove('hidden');
        } else {
          floatingCartBadge.classList.add('hidden');
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

      function handleCartActions(container) {
        container.addEventListener('click', function(e) {
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
      }

      handleCartActions(cartItemsDesktop);
      handleCartActions(cartItemsMobile);

      function handleCheckout() {
        if (Object.keys(cart).length === 0) {
            alert("Keranjang Anda masih kosong!");
            return;
        }

        // Kirim data ke server untuk mengurangi stok
        fetch("{{ route('checkout.process') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
            console.log(data.message);

            let message = "Halo, saya ingin memesan:\n\n";
            let total = 0;

            for (const id in cart) {
                const item = cart[id];
                const subtotal = item.harga * item.qty;
                message += `${item.nama} ${item.qty} = Rp${subtotal.toLocaleString('id-ID')}\n`;
                total += subtotal;
            }

            message += `\nTotal: Rp${total.toLocaleString('id-ID')}`;

            const whatsappURL = `https://wa.me/6289630832740?text=${encodeURIComponent(message)}`;
            window.open(whatsappURL, '_blank');

            resetCart();
            location.reload(); 
        })
        .catch(error => {
            alert(error.message);
            console.error('Error:', error);
        });
      }

      whatsappCheckoutDesktop.addEventListener('click', handleCheckout);
      whatsappCheckoutMobile.addEventListener('click', handleCheckout);

      // Floating cart button handler
      const floatingCart = document.getElementById("floatingCart");
      const sidebar = document.getElementById("checkoutSidebar");
      const closeBtn = document.getElementById("closeSidebar");
      const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));

      floatingCart.addEventListener("click", () => {
        if (window.innerWidth < 992) {
          checkoutModal.show();
        } else {
          sidebar.classList.remove("closed");
          sidebar.classList.add("open");
        }
      });

      closeBtn.addEventListener("click", () => {
        sidebar.classList.remove("open");
        sidebar.classList.add("closed");
      });
      
      // Mobile bottom nav active state
      const mobileNavLinks = document.querySelectorAll('.nav-item-mobile');
      mobileNavLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          mobileNavLinks.forEach(l => l.classList.remove('active'));
          this.classList.add('active');
        });
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
        const sectionTop = section.offsetTop - 100;
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