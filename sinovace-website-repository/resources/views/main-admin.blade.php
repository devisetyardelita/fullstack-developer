
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title') | SINOVACE</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
{{-- {{ asset('style/') }} --}}
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    {{-- <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}" /> --}}

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('style/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('style/assets/js/config.js') }}"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          {{-- <div class="app-brand demo">

              <a href="{{ url('admin/pengaduan_langsung') }}" class="app-brand-link">
                <span class="app-brand-logo demo"></span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2 d-flex justify-content-center align-items-center">
                  <i class='bx bxs-book-content text-primary' style="font-size: 1.75rem;"></i>
                  <span class="ms-2 text-primary">SINOVACE</span>
                </span>
              </a>
              
          </div> --}}
          <div class="app-brand" style="background-color: rgba(31, 49, 111, 0.95)">
            <a href="{{ url('admin/pengaduan_langsung') }}" class="app-brand-link">
                <span class="app-brand-logo" style="margin-top: 20px; margin-bottom: 20px;">
                    <img src="{{ asset('build/assets/Logo.png') }}" alt="Logo Sinovace" style="height: 33px; width: auto;" />
                </span>
            </a>
          </div>
        


          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
        
            <!-- Forms & Tables -->
              <!-- Pengaduan -->
              <li class="menu-item {{ Request::is('admin/pengaduan_langsung*') || Request::is('admin/pengaduan_tidak_langsung*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-support"></i>
                  <div data-i18n="Tables">Layanan Pengaduan</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item {{ Request::is('admin/pengaduan_langsung*') ? 'active' : '' }}">
                    <a href="{{ url('admin/pengaduan_langsung') }}" class="menu-link">
                      <div data-i18n="Tables">Langsung</div>
                    </a>
                  </li>
                  <li class="menu-item {{ Request::is('admin/pengaduan_tidak_langsung*') ? 'active' : '' }}">
                    <a href="{{ url('admin/pengaduan_tidak_langsung') }}" class="menu-link">
                      <div data-i18n="Tables">Tidak Langsung</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Izin Penelitian -->
              <li class="menu-item {{ Request::is('admin/izin_penelitian') ? 'active' : '' }}">
                <a href="{{ url('admin/izin_penelitian') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Analytics">Izin Penelitian/Riset</div>
                </a>
              </li>

              <li class="menu-item {{ Request::is('legalisir_fotokopi_ijazah_sttb*') ? 'active' : '' }}">
                <a href="{{ url('legalisir_fotokopi_ijazah_sttb') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Legalisir Fotokopi Ijazah/STTB</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('legalisir_piagam_penghargaan*') ? 'active' : '' }}">
                <a href="{{ url('legalisir_piagam_penghargaan') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Legalisir Piagam Penghargaan</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('mutasi_siswa') ? 'active' : '' }}">
                <a href="{{ url('mutasi_siswa') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Mutasi Siswa</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('pelayanan_dapodik') ? 'active' : '' }}">
                <a href="{{ url('pelayanan_dapodik') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">DAPODIK</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('pengelolaan_dana_bos') ? 'active' : '' }}">
                <a href="{{ url('pengelolaan_dana_bos') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Pengelolaan BOS</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('surat_keterangan_ralat_ijazah_sttb*') ? 'active' : '' }}">
                <a href="{{ url('surat_keterangan_ralat_ijazah_sttb') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Surat Keterangan Ralat Ijazah/STTB</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('surat_pengganti_ijazah_sttb_hilang*') ? 'active' : '' }}">
                <a href="{{ url('surat_pengganti_ijazah_sttb_hilang') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paste"></i>
                  <div data-i18n="Tables">Surat Pengganti Ijazah/STTB Hilang</div>
                </a>
              </li>
        </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          
        <!-- Navbar -->
        <nav class="navbar-nav-right navbar-expand-xl d-flex align-items-center" id="navbar-collapse">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <div class="navbar-nav-right d-flex align-items-end row" id="navbar-collapse"></div>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  {{-- <img src="{{ asset('profile/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar w-px-40 h-auto rounded-circle"> --}}
                  <img src="{{ asset('build/assets/Profil.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          {{-- <img src="{{ asset('profile/' . Auth::user()->avatar) }}" alt="Avatar" class="w-px-10 h-auto rounded-circle" /> --}}
                          <img src="{{ asset('build/assets/Profil.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">
                          @auth
                          {{auth()->user()->name }}
                          @endauth
                        </span>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>

                  <div class="dropdown-divider"></div>
                </li>
                @auth
                  <li>
                    <a class="dropdown-item" href="{{ url('admin/login') }}">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                @endauth
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </nav>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            @yield('content')
            <!-- / Content -->


            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  SINOVACE
                </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('style/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('style/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('style/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Include JS files -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const currentUrl = window.location.pathname;
          const menuItems = document.querySelectorAll('.menu-item a');
  
          menuItems.forEach(item => {
              if (item.href === window.location.href) {
                  item.parentElement.classList.add('active');
  
                  // Tambahkan kelas aktif ke menu induk jika item adalah submenu
                  const parentMenuItem = item.closest('.menu-item.menu-toggle');
                  if (parentMenuItem) {
                      parentMenuItem.classList.add('active');
                  }
              }
          });
      });
    </script>

    <!-- Toggle script -->
    <script>
      document.querySelector('.navbar-toggler').addEventListener('click', function () {
        const mainMenu = document.getElementById('main-menu');
        mainMenu.classList.toggle('show');
      });
    </script>
  </body>
</html>
