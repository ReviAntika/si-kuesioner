@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title pb-4" data-aos="fade-up">
            <h2 class="">Kuesioner Kegiatan</h2>
                {{-- @if ($list_pertanyaan->count() > 0)
                    {{ ' ' . $kegiatan->nama_kegiatan }}

                @endif --}}
            </h2>
        </div><!-- End Section Title -->

        <!-- Nama Input -->
        <div class="container mt-4" data-aos="fade-up">
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('token'))
                        <input type="hidden" id="nama" name="nama" value="{{ session('profile')['nama'] }}">

                        @else
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-1 col-form-label"><strong>Nama:</strong></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                          </div>
                        </div>
                        @endif
                    </div>
                </div>
        </div><!-- End Nama Input -->


        <!-- Petunjuk Pengisian Angket -->
        <div class="container mt-4" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <p><strong>PETUNJUK:</strong></p>
                    <p>a. Isilah angket ini dengan memberi tanda centang di kolom pada jawaban yang disediakan.</p>
                    <p>b. Angket ini menunjukkan tanggapan Anda terhadap kegiatan yang dilaksanakan oleh penyelenggara yang berguna untuk perbaikan mutu kegiatan.</p>
                    <p>c. Jawaban yang Anda berikan dijamin kerahasiaannya, dan tidak berpengaruh terhadap status Anda sebagai mahasiswa. Oleh karena itu, Anda diminta untuk memberikan penilaian secara sungguh-sungguh.</p>
                    <p>d. Kriteria bobot penilaian adalah sebagai berikut:</p>
                    <ul>
                        <li>5 = Sangat Setuju</li>
                        <li>4 = Setuju</li>
                        <li>3 = Netral</li>
                        <li>2 = Tidak Setuju</li>
                        <li>1 = Sangat Tidak Setuju</li>
                    </ul>
                </div>
            </div>
        </div> <!-- End Petunjuk Pengisian Angket -->

        <div class="container">
            <div class="row gy-2 justify-content-center" data-aos="fade-up" id="form-kegiatan">
                <form action="" >
                    @php
                        // hitung total pertanyaan
                        $countPertanyaan = 0;
                    @endphp
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: green!important; color: white;">No.</th>
                                <th scope="col" style="background-color: green!important; color: white; text-align: center;">Pertanyaan</th>
                                <th scope="col" style="background-color: green!important; color: white;">SS</th>
                                <th scope="col" style="background-color: green!important; color: white;">S</th>
                                <th scope="col" style="background-color: green!important; color: white;">N</th>
                                <th scope="col" style="background-color: green!important; color: white;">TS</th>
                                <th scope="col" style="background-color: green!important; color: white;">STS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($list_pertanyaan->count() > 0)
                                @foreach ($list_pertanyaan as $pertanyaan)
                                <tr>
                                    @php
                                        ++$countPertanyaan;
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pertanyaan->pertanyaan }}</td>

                                    @foreach ($pilihan_jawaban as $pilihan)
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                    @endforeach

                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No data available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @csrf
                    <input type="hidden" name="total_pertanyaan" value="{{ $countPertanyaan }}">
                    <input type="hidden" name="kegiatanId" value="{{ $id_kegiatan}}">

                    {{-- Tombol menuju pengisian saran --}}
                    <div class="d-flex">
                        <button class="btn btn-small btn-danger ms-auto" type="submit" id="buttonLanjutkan">
                            Lanjutkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(() => {
            $('#form-kegiatan').on('submit', ((event) => {
                event.preventDefault();

                // * get setiap value yang diperlukan
                const token = $('input[name="_token"]').val();
                const totalPertanyaan = $('input[name="total_pertanyaan"]').val();
                const IdKegiatan = $('input[name="kegiatanId"]').val();
                const namaResponden = $('input[name="nama"]').val();
                const selectedRadios = $('input[type="radio"]:checked');
                const tempValueArr = [];

                // check apakah semua pertanyaan sudah dijawab
                if (selectedRadios.length != totalPertanyaan) {
                    return Swal.fire({
                        icon: 'warning',
                        text: 'Mohon jawab semua pertanyaan yang tersedia',
                        showConfirmButton: false,
                        toast: true,
                        timer: 3000, // detik
                        timerProgressBar: true,
                        position: 'top-right'
                    });
                }

                // * urai setiap nilai pada radio button
                selectedRadios.each((index, item) => {
                    const radioName = $(item).attr('name');
                    const pertanyaanId = radioName.split('_');
                    const kdPoint = $(item).val();

                    tempValueArr.push({ pertanyaan_id: pertanyaanId[1], jawaban: kdPoint });
                });

                // * kelompokkan data untuk dikirim
                const payload = {
                    _token: token,
                    _method: 'POST',
                    kegiatan_id: IdKegiatan,
                    nama_responden: namaResponden,
                    list_jawaban: tempValueArr
                };
                console.log(payload);

                $.ajax({
                    url: '/kuesioner/kegiatan/kirim/' + IdKegiatan +'/' + namaResponden,
                    type: 'POST',
                    data: payload,

                    beforeSend: () => {
                        // console.log(data);
                        $.LoadingOverlay('show');
                    },
                    success: (response) => {
                        console.log('berhasil'+ namaResponden);
                        window.location.href = '/kuesioner/kegiatan/saran/' + IdKegiatan +'/'+ namaResponden;
                    },
                    error: (xhr) => {
                        console.log(xhr);

                        Swal.fire({
                            icon: 'error',
                            text: 'Terjadi kesalahan. Hubungan IT Support.',
                            toast: true,
                            timerProgressBar: true,
                            timer: 3000,
                            showConfirmButton: false,
                            position: 'top-right'
                        });
                    },
                    complete: () => {
                        $.LoadingOverlay('hide');
                    }
                });
            }))
        });
    </script>
@endsection
