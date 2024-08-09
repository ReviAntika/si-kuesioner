@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title pb-4" data-aos="fade-up">
            <h2 class="">CHART HASIL KEGIATAN</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <!-- Button trigger modal -->

            <div class="row gy-2 justify-content-center" data-aos="fade-up">
                <div class="container mb-4">
                    <form id="formCariKegiatan">
                        {{-- <div class="form-group">
                            <select name="cariTahun" id="cariTahun" class="form-control">
                                <option value="">Select Tahun Ajaran</option>
                                @foreach ($tahun as $item)
                                    <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group d-flex col-lg-4 gap-1">
                            <select name="cariKegiatan" id="cariKegiatan" class="form-control">
                                <option value="" selected disabled hidden>Pilih Kegiatan</option>
                                @foreach ($kegiatan as $item)
                                    <option value="{{ $item->id }}">{{ $item->kegiatan }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success col-lg-3" id="btnCariKegiatan"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
                <div class="container" id="cardChartWrapper">
                </div>

                {{-- <div class="container">
                    <div class="card">
                        <div class="card-header">KEGIATAN</div>
                        <div class="card-body">
                            <canvas id="kegiatanChart"></canvas>
                        </div>
                    </div>
                </div>
                @foreach ($kegiatan as $item)
                    <div class="container flex gap-3" id="kegiatan{{ $item->kegiatan }}"></div>
                @endforeach --}}
            </div>
        </div>
    </section>
    <script>
        // var chartBar;
        // $("#btnCariKegiatan").click(function() {
            // const kegiatan = $("#cariKegiatan").find(':selected').val();

            /*$.ajax({
                type: 'POST',
                url: "/admin/kuesioner/kegiatan/graph/tahun-ajaran/" + tahun,
                data: {
                    _token: token
                },
                success: function(response) {
                    const ctxBar = document.getElementById('kegiatanChart').getContext('2d');
                    let chartBar;

                    if (chartBar) {
                        chartBar.destroy();
                    }

                    chartBar = new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: response.kegiatan,
                            datasets: [{
                                label: 'CHART BAR KEGIATAN',
                                data: response
                                    .barChartData,
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

                    const kegiatan = response.kegiatan;
                    const pieChartData = response.pieChartData;

                    // console.log(pieChartData);

                    kegiatan.forEach((kegiatanId, i) => {
                        const container = document.getElementById('kegiatan' + kegiatanId);
                        if (container) {
                            let content = `
                                <div class='card mt-4'>
                                    <div class='card-header'>KEGIATAN ${response.kegiatan[i]}</div>
                                    <div class='card-body'>
                                        <div class='row'>`;

                            if (pieChartData[kegiatanId]) {
                                for (let pertanyaanId in pieChartData[kegiatanId]) {
                                    content += `
                                        <div class='col-md-4 mt-5' id='canvas${kegiatanId}${pertanyaanId}'>
                                            <canvas id='kegiatanChartpie${kegiatanId}${pertanyaanId}'></canvas>
                                        </div>`;
                                }
                            }

                            content += `
                                    </div>
                                </div>
                            </div>`;

                            container.innerHTML += content;

                            if (pieChartData[kegiatanId]) {
                                for (let pertanyaanId in pieChartData[kegiatanId]) {
                                    const pertanyaan = pieChartData[kegiatanId][pertanyaanId]
                                        .pertanyaan
                                    const pieData = pieChartData[kegiatanId][pertanyaanId];
                                    const ctxPie = document.getElementById(
                                            `kegiatanChartpie${kegiatanId}${pertanyaanId}`)
                                        .getContext('2d');
                                    if (ctxPie) {
                                        new Chart(ctxPie, {
                                            type: 'pie',
                                            data: {
                                                labels: ['SS', 'S', 'N', 'TS', 'STS'],
                                                datasets: [{
                                                    data: pieData.data,
                                                    backgroundColor: ['#9ACD32',
                                                        '#ADD8E6',
                                                        '#FAFAD2',
                                                        '#FFC0CB', '#D8BFD8'
                                                    ],
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: pertanyaan,
                                                    },
                                                    legend: {
                                                        labels: {
                                                            // Custom function to generate labels
                                                            generateLabels: function(
                                                                chart) {
                                                                var data = chart
                                                                    .data;
                                                                if (data.labels
                                                                    .length && data
                                                                    .datasets.length
                                                                ) {
                                                                    return data
                                                                        .labels.map(
                                                                            function(
                                                                                label,
                                                                                i) {
                                                                                var meta =
                                                                                    chart
                                                                                    .getDatasetMeta(
                                                                                        0
                                                                                    );
                                                                                var arc =
                                                                                    meta
                                                                                    .data[
                                                                                        i
                                                                                    ];
                                                                                var custom =
                                                                                    arc &&
                                                                                    arc
                                                                                    .custom ||
                                                                                    {};
                                                                                var fill =
                                                                                    custom
                                                                                    .backgroundColor ||
                                                                                    data
                                                                                    .datasets[
                                                                                        0
                                                                                    ]
                                                                                    .backgroundColor[
                                                                                        i
                                                                                    ];
                                                                                // Get the value of the current label, defaulting to 0 if undefined
                                                                                var value =
                                                                                    data
                                                                                    .datasets[
                                                                                        0
                                                                                    ]
                                                                                    .data[
                                                                                        i
                                                                                    ] ||
                                                                                    0;

                                                                                return {
                                                                                    text: label +
                                                                                        ' (' +
                                                                                        value +
                                                                                        ')',
                                                                                    fillStyle: fill,
                                                                                    hidden: isNaN(
                                                                                        value
                                                                                    ), // Hide label if value is NaN
                                                                                    index: i
                                                                                };
                                                                            });
                                                                } else {
                                                                    return [];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    });
                }
            });**/
        // });

        $('#formCariKegiatan').on('submit', (e) => {
            e.preventDefault();
            const kegiatanId = $('#cariKegiatan').find(':selected').val();

            $.ajax({
                url: '/admin/kuesioner/kegiatan/chart/jawaban/' + kegiatanId,
                type: 'GET',
                beforeSend: () => {
                    $('#cardChartWrapper').text('Loading...');
                },
                success: (response, xhr, status) => {
                    // console.log(response);
                    $('#cardChartWrapper').html(response.content);
                },
                error: (xhr, status) => {
                    console.log(xhr);
                }
            })
        });
    </script>
@endsection
