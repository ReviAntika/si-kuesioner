@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Perkuliahan</h2>
      </div><!-- End Section Title -->

      <div class="container">
          <!-- Button trigger modal -->
          {{-- {{[0]}} --}}
        <div class="row gy-2 justify-content-center" data-aos="fade-up">

            <div class="d-flex">
                <div class="col-md-4">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <select name="cariTahun" id="cariTahun" class="form-control">
                                <option value="" selected disabled hidden>Select Tahun Ajaran</option>
                                @if ($data['status'] == 'success')
                                    @foreach ($data['data']['tahun_ajaran'] as $item)
                                        <option id="das" value="{{$item['tahun_id']}}" data-jnsMhs="{{$item['jns_mhs']}}" data-kampus="{{$item['kd_kampus']}}">
                                            {{$item['tahun'] . ' - ' . $item['uraian']}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mt-2 my-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-primary d-none" id="buttonBukaKuesioner" type="button">
                                    Buka
                                </button>
                                <button type="button"  class="btn btn-success" id="btnCariTahun"><i class="fas fa-search"></i>Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tableWrapper" class="mt-3"></div>
        </div>
      </div>
    </section>

    <script>
    $(document).ready(function(){
        const tahunAjaran = @json($data['data']['tahun_ajaran']);

        $('#cariTahun').on('change', (e) => {
            e.preventDefault();
            const target = e.currentTarget.value;

            if (target.length > 0) {
                const selectedTahunAjaran = tahunAjaran.filter((item) => item.tahun_id == target);

                if (!selectedTahunAjaran[0].kuesioner_open) {
                    $('#buttonBukaKuesioner').removeClass('d-none');
                } else {
                    $('#buttonBukaKuesioner').addClass('d-none');
                }
            } else {
                $('#buttonBukaKuesioner').addClass('d-none');
            }
        });

        // buka kuesioner
        $('#buttonBukaKuesioner').on('click', (e) => {
            e.preventDefault();
            const tahun = $('#cariTahun').find(':selected').val();
            const url = '/admin/kuesioner/perkuliahan/tahun-ajaran/buka/' + tahun;

            $.ajax({
                url,
                type: 'GET',
                beforeSend: () => {
                    $('#buttonBukaKuesioner').text('Loading...');
                },
                success: (response, status, xhr) => {
                    $('#buttonBukaKuesioner').text('Buka');

                    if (status === 'success') {
                        $('#buttonBukaKuesioner').addClass('d-none');

                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            toast: true,
                            timer: 1500,
                            position: 'top-right',
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });

                        $('#btnCariTahun').trigger('click');
                    };
                },
                error: (xhr, status) => {
                    console.log(xhr);
                    $('#buttonBukaKuesioner').text('Buka');
                },
            })
        })
    });

    $("#btnCariTahun").click(function(e) {
        e.preventDefault();

        var select = $('#cariTahun').find(':selected');
        const token = $('input[name="_token"]').val();
        var tahun = select.val();
        var jns_mhs = select[0].dataset.jnsmhs;
        var kd_kampus = select[0].dataset.kampus;

        $.ajax({
            type: 'GET',
            url: "/admin/kuesioner/perkuliahan/tahun-ajaran/" + tahun +'/' + jns_mhs +'/' + kd_kampus,
            beforeSend: () => {
                $('#tableWrapper').html('Loading...');
            },
            success: function(response,xhr,rows) {
                $('#tableWrapper').html(response.content);

                /**
                $('#tablePerkuliahan').dataTable({
                    "bDestroy": true,
                    "aaData": filteredResponse,
                    "aoColumns": [
                        {
                            "mData": null,
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        { data: 'tahun_id' },
                        { data: 'semester' },
                        { data: 'nm_mk' },
                        { data: 'detail_dosen.nm_dosen' },
                        {
                            data: "detail_kuesioner",
                            render: function (data, type, row) {
                                return row.detail_kuesioner.total_mahasiswa_mengisi_kuesioner + '/' + row.detail_kuesioner.total_mahasiswa;
                            }
                        },
                        {
                            "mData": null,
                            "title": "Aksi",
                            "sortable": false,
                            "render": function (data, type, row, meta) {
                                let btn = "<a href='/admin/kuesioner/perkuliahan/pertanyaan/show' class='btn btn-small btn-primary'><i class='fas fa-eye'></i> Lihat Pertanyaan</a>";
                                return btn;
                            }
                        }
                    ],
                    "pagingType": "full_numbers", // Menambahkan jenis pagination
                    "lengthMenu": [10, 25, 50, 75, 100], // Menambahkan pilihan jumlah baris per halaman
                    "pageLength": 10, // Menentukan jumlah baris default per halaman
                    "language": {
                        "paginate": {
                            "first": "<<",
                            "last": ">>",
                            "next": ">",
                            "previous": "<"
                        }
                    }
                });
                */
            }
        });
    });
    </script>
@endsection
