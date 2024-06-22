@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">
            Kuesioner
            @if ($list_pertanyaan['status'] == 'success')
                {{ ' ' . $list_pertanyaan['data']['kuesioner']['nm_mk'] }}
            @else
                {{ ' ' . 'Perkuliahan' }}
            @endif
        </h2>
      </div><!-- End Section Title -->

          <!-- Petunjuk Pengisian Angket -->
          <div class="container mt-4" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <p><strong>PETUNJUK:</strong></p>
                    <p>a. Isilah angket ini dengan memberi tanda centang di kolom pada jawaban yang disediakan.</p>
                    <p>b. Angket ini menunjukkan tanggapan Anda terhadap pembelajaran yang dilaksanakan oleh dosen yang berguna untuk perbaikan mutu pembelajaran.</p>
                    <p>c. Jawaban yang Anda berikan dijamin kerahasiaannya, dan tidak berpengaruh terhadap nilai mata kuliah atau status Anda sebagai mahasiswa. Oleh karena itu, Anda diminta untuk memberikan penilaian secara sungguh-sungguh.</p>
                    <p>d. Kriteria bobot penilaian adalah sebagai berikut:</p>
                    <ul>
                        <li>5 = Sangat Setuju: 81 - 100%</li>
                        <li>4 = Setuju: 61 - 80%</li>
                        <li>3 = Netral: 41 - 60%</li>
                        <li>2 = Tidak Setuju: 21 - 40%</li>
                        <li>1 = Sangat Tidak Setuju: 1 - 20%</li>
                    </ul>
                </div>
            </div>
        </div> <!-- End Petunjuk Pengisian Angket -->

      <div class="container">
        <div class="row gy-2 justify-content-center" data-aos="fade-up">
            <form action="">
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
                        @if ($list_pertanyaan['status'] == 'success')
                            @foreach ($list_pertanyaan['data']['kuesioner']['list_pertanyaan'] as $key => $item)
                                <tr>
                                    <td colspan="7" class="bg-primary text-white">{{ $key }}</td>
                                </tr>
                                @foreach ($item as $index => $pertanyaan)
                                <tr>
                                    @php
                                        ++$countPertanyaan;
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pertanyaan['pertanyaan'] }}</td>
                                    {{-- <td><input type="radio" name="question_{{ $loop->parent->iteration }}_{{ $index }}" value="SS"></td>
                                    <td><input type="radio" name="question_{{ $loop->parent->iteration }}_{{ $index }}" value="S"></td>
                                    <td><input type="radio" name="question_{{ $loop->parent->iteration }}_{{ $index }}" value="N"></td>
                                    <td><input type="radio" name="question_{{ $loop->parent->iteration }}_{{ $index }}" value="TS"></td>
                                    <td><input type="radio" name="question_{{ $loop->parent->iteration }}_{{ $index }}" value="STS"></td> --}}

                                    @foreach ($pilihan_jawaban as $pilihan)
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan['pertanyaan_id'] }}" value="{{ $pilihan['kd_point'] }}">
                                        </td>
                                    @endforeach

                                </tr>
                                @endforeach
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
              <input type="hidden" name="kelas_kuliah_id" value="{{ $list_pertanyaan['data']['kuesioner']['kelas_kuliah_id'] }}">
              <input type="hidden" name="kuesioner_perkuliahan_id" value="{{ $list_pertanyaan['data']['kuesioner']['kuesioner_perkuliahan_id'] }}">

              {{-- Tombol menuju pengisian saran --}}
              <div class="d-flex">
                <button class="btn btn-small btn-danger ms-auto" type="button" id="buttonLanjutkan">
                    Lanjutkan
                </button>
              </div>
            </form>
        </div>
      </div>
    </section>

    <script>
        $(document).ready(() => {
            $('#buttonLanjutkan').on('click', () => {
                // * get setiap value yang diperlukan
                const token = $('input[name="_token"]').val();
                const totalPertanyaan = $('input[name="total_pertanyaan"]').val();
                const kelasKuliahId = $('input[name="kelas_kuliah_id"]').val();
                const kuesionerPerkuliahanId = $('input[name="kuesioner_perkuliahan_id"]').val();
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
                    kuesioner_perkuliahan_id: kuesionerPerkuliahanId,
                    kelas_kuliah_id: kelasKuliahId,
                    list_jawaban: tempValueArr
                };

                $.ajax({
                    url: '/kuesioner/perkuliahan/' + kelasKuliahId,
                    type: 'POST',
                    data: payload,
                    beforeSend: () => {
                        $.LoadingOverlay('show');
                    },
                    success: (response) => {
                        const id = response.data.kuesioner.kuesioner_perkuliahan_mahasiswa_id;
                        window.location.href = '/kuesioner/perkuliahan/saran/' + id ;
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
            });
        });
    </script>
@endsection
