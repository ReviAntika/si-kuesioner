<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center w-100">
        <div class="card-title fw-bold">
            Hasil Kuesioner Perkuliahan
        </div>
        <div id="buttonExportExcelWrapper">
            <button class="btn btn-outline-success" id="buttonExportToExcel" data-tahun="{{ $tahunId }}">
                <i class="fas fa-file-excel"></i>
                <span id="textExportToExcel">
                    Export
                </span>
            </button>
        </div>
    </div>
    <div class="card-body" id="chartWrapper">
        {{-- <canvas id="perkuliahanChart"></canvas> --}}
        @if ($status === 'success')
            @if (count($data['kuesioner_perkuliahan']) > 0)
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

        if (response.kuesioner_perkuliahan.length > 0) {
            $('#buttonExportToExcel').prop('disabled', false);
            generatePieCharts(response.kuesioner_perkuliahan);
        } else {
            $('#chartWrapper').html('Data hasil kuesioner perkuliahan belum tersedia.');
            $('#buttonExportToExcel').prop('disabled', true);
        }

        // When Button Export to Excel Clicked
        $('#buttonExportToExcel').on('click', (e) => {
            e.preventDefault();
            const tahunId = e.currentTarget.dataset.tahun;
            const url = `/admin/kuesioner/perkuliahan/chart/export-to-excel/${tahunId}`;
            window.open(url, '_blank');
        });
    });

    function generatePieCharts(data) {
        const labels = ['Kegiatan Awal Pembelajaran', 'Teknologi Pembelajaran', 'Pelaksanaan Pembelajaran', 'Penilaian Hasil Belajar'];
        const charts = [];
        let rows = 0; // baris pertama

        for (let i = 0; i < data.length; i += 2) {
            // kolom 1
            if (i < data.length) {
                charts.push({
                    values: [
                        data[i].pertanyaan_dan_jawaban[0].value, // nilai Teknologi Pembelajaran
                        data[i].pertanyaan_dan_jawaban[1].value, // nilai Kegiatan Awal Pembelajaran
                        data[i].pertanyaan_dan_jawaban[2].value, // nilai Pelaksanaan Pembelajaran
                        data[i].pertanyaan_dan_jawaban[3].value, // nilai Penilaian Hasil Belajar
                    ],
                    labels: labels,
                    type: 'pie',
                    name: data[i].nm_mk,
                    hoverinfo: 'label+percent+name',
                    domain: {
                        row: rows,
                        column: 0
                    }
                });
            }

            // kolom 2
            if ((i + 1) < data.length) {
                charts.push({
                    values: [
                        data[i + 1].pertanyaan_dan_jawaban[0].value, // nilai Teknologi Pembelajaran
                        data[i + 1].pertanyaan_dan_jawaban[1].value, // nilai Kegiatan Awal Pembelajaran
                        data[i + 1].pertanyaan_dan_jawaban[2].value, // nilai Pelaksanaan Pembelajaran
                        data[i + 1].pertanyaan_dan_jawaban[3].value, // nilai Penilaian Hasil Belajar
                    ],
                    labels: labels,
                    type: 'pie',
                    name: data[i + 1].nm_mk,
                    hoverinfo: 'label+percent+name',
                    domain: {
                        row: (i === (data.length - 1)) ? ++rows : rows,
                        column: 1
                    }
                });

                ++rows;
            }
        }

        const layout = {
            height:1200,
            grid: {
                rows: ++rows,
                columns: 2,
            }
        };

        Plotly.newPlot('pieChartWrapper', charts, layout);
    }
</script>
