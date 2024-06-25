@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Kegiatan Chart</h2>
      </div><!-- End Section Title -->

      <div class="container">
          <!-- Button trigger modal -->

        <div class="row gy-2 justify-content-center" data-aos="fade-up">
                <div class="container">
                    <div class="d-flex">
                        <div class="col-md-4">
                            <form action="">
                                @csrf
                                <div class="form-group">
                                    <select name="cariTahun" id="cariTahun" class="form-control">
                                        <option value="">Select Tahun Ajaran</option>
                                        @foreach ($tahun as $item)
                                            <option  value="{{$item->tahun}}">{{$item->tahun}}</option>
                                        @endforeach
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
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-header">KEGIATAN</div>
                        <div class="card-body">
                            <canvas id="kegiatanChart"></canvas>
                        </div>
                    </div>
                </div>
                @foreach ($kegiatan as $item)
                <div class="container" id="kegiatan{{$item->kegiatan}}"></div>
                @endforeach

        </div>
      </div>
    </section>
<script>
var chartBar;
    $("#btnCariTahun").click(function(){

        const token = $('input[name="_token"]').val();
        var tahun = $("#cariTahun").val();

        // console.log(jns_mhs);
        $.ajax({
            type: 'POST',
            url: "/admin/kuesioner/kegiatan/graph/tahun-ajaran/" + tahun ,
            data: {_token: token},
            success: function(response,xhr,rows) {
                // console.log(rows);
                const ctx = document.getElementById('kegiatanChart').getContext('2d');

                if (chartBar) {
                    chartBar.destroy();
                }
                chartBar = new Chart(ctx, {
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

                var apa =response.kegiatan;
                var pilihan = response.pilihanJawaban;
                for (i = 0; i < pilihan.length; i++) {
                    for (j= 0; j < apa.length; j++) {
                    // console.log(apa[i]);
                    document.getElementById('kegiatan'+apa[i]).innerHTML="<div class='card'>"+
                        "<div class='card-header'>KEGIATAN "+response.kegiatan[i]+"</div>"+
                        "<div class='card-body'>"+
                            "<div class='row'>"+
                                "<div class='col-md-4' id='canvas"+response.kegiatan[i]+pilihan[j].kd_point+"'>"+
                                    "<canvas id='kegiatanChartpie"+response.kegiatan[i]+pilihan[j].kd_point+"'></canvas>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                    "</div>";
                        // console.log(pilihan[j].kd_point;
                    }
                }
                for (i = 0; i < response.kegiatan.length; i++) {
                    // console.log(apa[i]);
                    document.getElementById('kegiatanChartpie'+apa[i]).getContext('2d');
                }
            }
        });
    });

</script>
@endsection
