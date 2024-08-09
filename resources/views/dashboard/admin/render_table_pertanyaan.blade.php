<table class="table table-stripped" style="width: 100%" id="tablePerkuliahan">
    <thead>
      <tr>
        <th>No</th>
        <th>Semester</th>
        <th>Matakuliah</th>
        <th>Dosen</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        @if (count($matakuliah->toArray()) < 1)
            <tr>
                <td colspan="7" class="text-center" id="textDataKosong">No data available.</td>
            </tr>
        @else
            @foreach ($matakuliah->toArray() as $item)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $item['semester'] }}</td>
                    <td>{{ $item['nm_mk'] }}</td>
                    <td>{{ $item['detail_dosen']['nm_dosen'] }}</td>
                    <td>{{ $item['detail_kuesioner']['total_mahasiswa_mengisi_kuesioner'] . '/' . $item['detail_kuesioner']['total_mahasiswa'] }}</td>
                    <td>
                        <a href='/admin/kuesioner/perkuliahan/pertanyaan/show' class='btn btn-small btn-primary'><i class='fas fa-eye'></i> Lihat Pertanyaan</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
    $(document).ready(() => {
        let table = new DataTable('#tablePerkuliahan');
    });
</script>
