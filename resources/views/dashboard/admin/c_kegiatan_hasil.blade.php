<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center w-100">
        <div class="card-title fw-bold">
            Hasil Kuesioner Kegiatan {{ $data['kegiatan']['kegiatan'] . ' - ' . $data['kegiatan']['dari_tgl'] }}
        </div>
        <div id="buttonExportExcelWrapper">
            <button class="btn btn-outline-success" id="buttonExportToExcel" data-kegiatan="{{ $data['kegiatan']['id'] }}">
                <i class="fas fa-file-excel"></i>
                <span id="textExportToExcel">
                    Export
                </span>
            </button>
        </div>
    </div>
    <div class="card-body" id="chartWrapper">
        {{-- <canvas id="perkuliahanChart"></canvas> --}}
        @if (isset($data['kegiatan']))
            @if (count($data['pertanyaan_dan_jawaban']) > 0)
                <div id="pieChartWrapper" class="w-100"></div>
            @endif
        @else
            <p>
                Oops. Terjadi kesalahan.
            </p>
        @endif
    </div>
</div>


<script>
    $(document).ready(() => {
        const response = @json($data);

        if (response.pertanyaan_dan_jawaban.length > 0) {
            $('#buttonExportToExcel').prop('disabled', false);
            generatePieCharts(response);
        } else {
            $('#chartWrapper').html('Data hasil kuesioner kuesioner belum tersedia.');
            $('#buttonExportToExcel').prop('disabled', true);
        }

        // When Button Export to Excel Clicked
        $('#buttonExportToExcel').on('click', (e) => {
            e.preventDefault();
            const kegiatanId = e.currentTarget.dataset.kegiatan;
            const url = `/admin/kuesioner/kegiatan/chart/jawaban/${kegiatanId}?to-excel=true`;
            window.open(url, '_blank');
        });
    });

    function generatePieCharts(data) {
        const dataPertanyaan = data.pertanyaan_dan_jawaban;
        const labels = ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'];
        const charts = [];
        let rows = 0; // baris pertama

        for (let i = 0; i < dataPertanyaan.length; i += 2) {
            // kolom 1
            if (i < dataPertanyaan.length) {
                charts.push({
                    values: [
                        dataPertanyaan[i].persentase_jawaban.STS, // sangat tidak setuju
                        dataPertanyaan[i].persentase_jawaban.TS, // tidak setuju
                        dataPertanyaan[i].persentase_jawaban.N, // netral
                        dataPertanyaan[i].persentase_jawaban.S, // setuju
                        dataPertanyaan[i].persentase_jawaban.SS, // sangat setuju
                    ],
                    labels: labels,
                    type: 'pie',
                    name: dataPertanyaan[i].pertanyaan,
                    hoverinfo: 'label+percent+name',
                    domain: {
                        row: rows,
                        column: 0
                    }
                });
            }

            // kolom 2
            if ((i + 1) < dataPertanyaan.length) {
                charts.push({
                    values: [
                        dataPertanyaan[i + 1].persentase_jawaban.STS, // sangat tidak setuju
                        dataPertanyaan[i + 1].persentase_jawaban.TS, // tidak setuju
                        dataPertanyaan[i + 1].persentase_jawaban.N, // netral
                        dataPertanyaan[i + 1].persentase_jawaban.S, // setuju
                        dataPertanyaan[i + 1].persentase_jawaban.SS, // sangat setuju
                    ],
                    labels: labels,
                    type: 'pie',
                    name: dataPertanyaan[i + 1].pertanyaan,
                    hoverinfo: 'label+percent+name',
                    domain: {
                        row: (i === (dataPertanyaan.length - 1)) ? ++rows : rows,
                        column: 1
                    }
                });

                ++rows;
            }
        }

        const layout = {
            height: 2200,
            grid: {
                rows: ++rows,
                columns: 2,
            }
        };

        Plotly.newPlot('pieChartWrapper', charts, layout);
    }
</script>
