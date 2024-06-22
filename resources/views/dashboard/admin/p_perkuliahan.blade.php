@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">
            Pertanyaan Kuesioner
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
                            <th scope="col" style="background-color: green!important; color: white; text-align: center;">Edit</th>

                    </thead>
                    <tbody>
                        @if ($list_pertanyaan['status'] == 'success')
                            @foreach ($list_pertanyaan['data']['list_pertanyaan'] as $key => $item)
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
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="btnModalEditPertanyaan" data-bs-target="#modalPerkuliahanPertanyaan"
                                        data-idPertanyaan="{{$pertanyaan['pertanyaan_id']}}"
                                        data-idJenisPertanyaan="{{$pertanyaan['jenis_pertanyaan_id']}}"
                                        data-idKelompokPertanyaan="{{$pertanyaan['kelompok_pertanyaan_id']}}"
                                        data-pertanyaan="{{$pertanyaan['pertanyaan']}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>

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


            </form>
        </div>
      </div>
    </section>
<!-- Modal -->
<div class="modal fade" id="modalPerkuliahanPertanyaan" tabindex="-1" aria-labelledby="modalPertanyaanKegiatan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPertanyaanKegiatan">Edit Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="/admin/kuesioner/perkuliahan/pertanyaan/edit" method="post">
                        @csrf
                        <input type="hidden" name="idPertanyaan" id="idPertanyaan" value="">
                        <input type="hidden" name="idJenisPertanyaan" id="idJenisPertanyaan" value="">
                        <input type="hidden" name="idKelompokPertanyaan" id="idKelompokPertanyaan" value="">
                        <div class="mb-3">

                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <textarea class="form-control" id="pertanyaan" name="pertanyaan" cols="30" rows="10"></textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    $("#btnModalEditPertanyaan").click(function () {
    var ids = $(this).attr('data-idPertanyaan');
    var idjenis = $(this).attr('data-idJenisPertanyaan');
    var idkelompok = $(this).attr('data-idKelompokPertanyaan');
    var pert = $(this).attr('data-pertanyaan');
    $("#idPertanyaan").val( ids );
    $("#pertanyaan").val( pert );
    $("#idJenisPertanyaan").val( idjenis );
    $("#idKelompokPertanyaan").val( idkelompok );
    $('#myModal').modal('show');
});
</script>
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
