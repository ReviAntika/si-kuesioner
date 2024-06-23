<!-- Hero Section -->
<section id="hero" class="hero section pt-5">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 class="">Selamat Datang, Admin!</h1>
            <p class="">SISTEM KUESIONER EVALUASI LAYANAN PERKULIAHAN DAN LAYANAN KEGIATAN KAMPUS STMIK BANDUNG</p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="images/home.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->
<section>
    <div class="container">
        <div class="d-flex">
            <div class="col-md-4">
                <form action="">
                    @csrf
                    <div class="form-group">    
                        <select name="cariTahun" id="cariTahun" class="form-control">
                            <option value="">Select Tahun Ajaran</option>
                            @foreach ($data['tahun'] as $item)
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
        <div class="row">
            <div class="col-md-6">
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
  