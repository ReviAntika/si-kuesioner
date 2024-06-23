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
