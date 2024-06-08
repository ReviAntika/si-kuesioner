@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">My Profil</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-2 justify-content-center">

          <div class="col-lg-4 content" data-aos="fade-up" data-aos-delay="100">
            <img src="http://103.119.67.164:16080/storage/users/images/college_student.png" class="rounded mx-auto d-block" alt="User Image" style="max-width: 250px">
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <form>
                <fieldset disabled>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" class="form-control" value="{{ session('profile')['nama'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">NIM</label>
                        <input type="text" id="nim" class="form-control" value="{{ session('profile')['nim'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ session('user_email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Program Studi</label>
                        <input type="text" id="nama_jurusan" class="form-control" value="{{ session('profile')['nama_jurusan'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Angkatan</label>
                        <input type="text" id="masuk_tahun" class="form-control" value="{{ session('profile')['masuk_tahun'] }}">
                    </div>
                </fieldset>
                </form>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->
@endsection