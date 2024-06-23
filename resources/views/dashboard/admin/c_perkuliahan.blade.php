@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Perkuliahan Chart</h2>
      </div><!-- End Section Title -->

      <div class="container">
          <!-- Button trigger modal -->

        <div class="row gy-2 justify-content-center" data-aos="fade-up">
                <div class="container">
                    <div class="d-flex">
                        <form action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="cariSemester" id="cariSemester" class="form-control">
                                            <option value="">Select Semester</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="cariDosen" id="cariDosen" class="form-control">
                                            <option value="">Select Dosen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-end">
                                            <button type="button"  class="btn btn-success" id="btnCariTahun"><i class="fas fa-search"></i>Cari</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-header">Perkuliahan</div>
                        <div class="card-body">
                            <canvas id="kegiatanChart"></canvas>
                        </div>
                    </div>
                </div>
        </div>
      </div>
    </section>
<script>
    
    $("#btnCariTahun").click(function(){
        const token = $('input[name="_token"]').val();
        var tahun = $("#cariTahun").val();
        // console.log(jns_mhs);
        $.ajax({
            type: 'POST',
            url: "/admin/kuesioner/kegiatan/graph/tahun-ajaran/" + tahun ,
            data: {_token: token},
            success: function(response,xhr,rows) {
                // console.log(response);
                const ctx = document.getElementById('kegiatanChart');
  
                new Chart(ctx, {
                    destroy:true,
                    type: 'bar',
                    data: {
                    labels: response.acara,
                    datasets: [{
                        label: 'CHART BAR KEGIATAN',
                        data: response.jawaban,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true
                        }
                    }
                    }
                });

            }
        });
    });

</script>
@endsection
