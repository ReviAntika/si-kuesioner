// tidak di pakai dulu
@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Hasil Perkuliahan</h2>
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
                                <option value="">Select Tahun Ajaran</option>
                                @if ($data['status'] == 'success')
                                    @foreach ($data['data']['tahun_ajaran'] as $item)
                                        <option id="das" value="{{$item['tahun_id']}}" data-jnsMhs="{{$item['jns_mhs']}}" data-kampus="{{$item['kd_kampus']}}">
                                            {{$item['tahun'] . ' - ' . $item['uraian']}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-end">
                                <button type="button"  class="btn btn-success" id="btnCariTahun"><i class="fas fa-search"></i>Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table" id="tablePerkuliahan">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Lihat Kelas</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">No data available.</td>
                    </tr>
                </tbody>
              </table>
        </div>
      </div>
    </section>

    <script>
    $(document).ready(function(){

    // $('#cariTahun').select2();
        });

    $("#btnCariTahun").click(function(){
        var select = document.getElementById("das")
        const token = $('input[name="_token"]').val();
        var tahun = $("#cariTahun").val();
        var jns_mhs = select.getAttribute("data-jnsMhs");
        var kd_kampus = select.getAttribute("data-kampus");
        console.log(jns_mhs);
        $.ajax({
            type: 'POST',
            url: "/admin/kuesioner/perkuliahan/tahun-ajaran/" + tahun +'/' + jns_mhs +'/' + kd_kampus,
            data: {_token: token},
            success: function(response,xhr,rows) {
                console.log(response);
                $('#tablePerkuliahan').dataTable({
                    "bDestroy": true,
                    "aaData": response,
                    "aoColumns": [
                        {
                            "mData": null,
                            render: function (data, type, row, meta) {
	                        return meta.row + meta.settings._iDisplayStart + 1;}
                        },
                        { data: 'tahun' },
                        { data: 'semester' },
                        {
                            "mData": null,
                            "title": "Aksi",
                            "sortable": false,
                            "render": function (data, row, type, meta) {
                                let btn = "<a href='/admin/kuesioner/perkuliahan/pertanyaan/show' class='btn btn-primary'><i class='fas fa-eyes'></i>Lihat Pertanyaan</a>";

                                return btn;
                            }
                        }
                        ],

                });
            }
        });
    });
    </script>
@endsection
