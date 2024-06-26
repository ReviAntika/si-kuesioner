@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title pb-3" data-aos="fade-up">
            <h2 class="">Saran Kegiatan</h2>
        </div><!-- End Section Title -->

        <div class="mt-3">
            <div class="container">
                <div class="row justify-content-center" data-aos="fade-up">
                    @csrf
                    <input type="hidden" name="kuesioner_perkuliahan_mahasiswa_id" value="{{ $data['kuesioner_saran_kegiatan_id'] }}">
                    <input type="hidden" name="kuesioner_kegiatan_mahasiswa_nama" value="{{ $data['kuesioner_saran_kegiatan_nmResponden'] }}">

                    <div class="form-floating shadow-lg p-3 mb-3 bg-body-tertiary rounded">
                        <textarea class="form-control" placeholder="" id="saran" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Apakah anda memiliki kritik & saran untuk pengembangan Kegiatan?</label>
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-small btn-success ms-auto" type="button" id="buttonKirimSaran">
                            Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(() => {
            $('#buttonKirimSaran').on('click', () => {
                const saran = $('#saran').val();
                const id = $('input[name="kuesioner_perkuliahan_mahasiswa_id"]').val();
                const nmResponden = $('input[name="kuesioner_kegiatan_mahasiswa_nama"]').val();
                const token = $('input[name="_token"]').val();

                console.log(nmResponden);

                $.ajax({
                    url: '/kuesioner/kegiatan/saran/kirim/' + id,
                    type: 'POST',
                    data: {
                        _token: token,
                        _method: 'POST',
                        id: id,
                        saran: saran,
                        nmResponden : nmResponden,
                    },
                    beforeSend: () => {
                        $.LoadingOverlay('show');
                    },
                    success: (response, xhr) => {
                        Swal.fire({
                            icon: 'Success',
                            text: 'Berhasil Menambahkan Saran.',
                            toast: true,
                            timerProgressBar: true,
                            timer: 3000,
                            showConfirmButton: false,
                            position: 'top-right'
                        });
                        window.location.href = '/';
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
                })
            });
        });
    </script>
@endsection
