@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">
            Kuesioner
            @if ($list_pertanyaan['status'] == 'success')
                {{ ' ' . 'Perkuliahan' }}
            @else
                {{ ' ' . 'Perkuliahan' }}
            @endif
        </h2>
      </div><!-- End Section Title -->

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
                            <th scope="col" style="background-color: green!important; color: white; text-align: center;">Action</th>
                            
                    </thead>
                    <tbody>
                        @if ($list_pertanyaan['status'] == 'success')
                            @foreach ($list_pertanyaan['data']['list_pertanyaan'] as $key => $item)
                                <tr>
                                    <td colspan="7" class="bg-primary">{{ $key }}</td>
                                </tr>
                                @foreach ($item as $index => $pertanyaan)
                                <tr>
                                    @php
                                        ++$countPertanyaan;
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pertanyaan['pertanyaan'] }}</td>
                                    <td><a href="" class="btn btn-success"><i class="fas fa-pencil"></i></a></td>

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

              {{-- Tombol menuju pengisian saran --}}
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
                        window.location.href = '/kuesioner/perkuliahan/saran/' + id;
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
