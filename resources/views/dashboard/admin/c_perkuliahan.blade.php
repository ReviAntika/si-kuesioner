@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title pb-4" data-aos="fade-up">
            <h2 class="">CHART HASIL PERKULIAHAN</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <!-- Button trigger modal -->
            <div class="row gy-2 justify-content-center" data-aos="fade-up">
                <div class="container mb-3">
                    <form>
                        <div class="form-group d-flex col-lg-4 gap-1">
                            <select name="cariTahun" id="cariTahun" class="form-control">
                                <option value="" selected disabled hidden>Select Tahun Ajaran</option>
                                @if ($data['status'] == 'success')
                                    @foreach ($data['data']['kuesioner_perkuliahan']['list_tahun'] as $item)
                                        <option value="{{ $item['tahun_id'] }}">
                                            {{ $item['tahun'] . ' - ' . $item['uraian'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" class="btn btn-success col-lg-3" id="btnCariTahun"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
                <div class="container" id="cardChartWrapper">
                </div>
            </div>
        </div>
    </section>

    <script>
        $("#btnCariTahun").click(function(e) {
            e.preventDefault();
            var tahun = $("#cariTahun").find(':selected').val();

            $.ajax({
                type: "GET",
                url: "/admin/kuesioner/perkuliahan/chart/tahun/" + tahun,
                beforeSend: () => {
                    $('#cardChartWrapper').html('Loading...');
                },
                success: function(response,xhr,rows) {
                    $('#cardChartWrapper').html(response.content);
                },
                error: (xhr, status) => {
                    console.log(xhr);
                }
            });
        });
    </script>
@endsection
