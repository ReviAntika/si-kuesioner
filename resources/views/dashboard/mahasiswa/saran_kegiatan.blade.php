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
                const token = $('input[name="_token"]').val();

                $.ajax({
                    url: '/kuesioner/perkuliahan/saran/' + id,
                    type: 'POST',
                    data: {
                        _token: token,
                        _method: 'POST',
                        id: id,
                        saran: saran,
                    },
                    beforeSend: () => {
                        $.LoadingOverlay('show');
                    },
                    success: (response, xhr) => {

                        window.location.href = '/kuesioner/perkuliahan';
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
