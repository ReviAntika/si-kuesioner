<header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #1B287D">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/home" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="/images/favicons/android-chrome-192x192.png" alt="">
        <h1 class="sitename fs-6">KUPEKA STMIK BANDUNG</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/home#hero" class="">Home</a></li>

          <!-- Buat mahasiswa -->
          @if (isset(session('role')['is_mhs']))
          <li class="dropdown"><a href="#"><span>Kuesioner</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/kuesioner/perkuliahan">Perkuliahan</a></li>
              <li><a href="/kuesioner/kegiatan">Kegiatan</a></li>
            </ul>
          </li>

          @elseif (isset(session('role')['is_admin']))
          <li class="dropdown"><a href="#"><span>Kuesioner</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/admin/kuesioner/perkuliahan">Perkuliahan</a></li>
              <li><a href="/admin/kuesioner/kegiatan">Kegiatan</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Hasil Kuesioner</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/admin/kuesioner/perkuliahan/hasil">Perkuliahan</a></li>
              <li><a href="/admin/kuesioner/kegiatan/hasil">Kegiatan</a></li>
            </ul>
          </li>
          @else
           <li class="dropdown"><a href="#"><span>Kuesioner</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
             <ul>
               <li><a href="/kuesioner/kegiatan">Kegiatan</a></li>
             </ul>
           </li>
           @endif

          <li><a href="/profil">Profil</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <h1>

      </h1>
      @if (session()->has('token'))
        <a class="btn-getstarted" href="/logout">Logout</a>
      @else
        <a class="btn-getstarted" href="/login">Login</a>
      @endif

    </div>
  </header>
