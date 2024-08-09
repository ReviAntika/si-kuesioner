<br>
<table>
    <tbody>
        <tr>
            <th colspan="2" style="font-weight: 800; font-size: 14px">Tahun Ajaran:</th>
            <th colspan="4" style="font-weight: 800; font-size: 14px">{{ $tahun_ajaran }}</th>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black" bgcolor="#0d6efd" width="6" valign="center">No.</th>
            <th style="font-weight: 800; font-size: 12px; border: 1px solid black" bgcolor="#0d6efd" width="20" valign="center">Dosen</th>
            <th style="font-weight: 800; font-size: 12px; border: 1px solid black" bgcolor="#0d6efd" width="20" valign="center">Nama MK</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="10" valign="center">Semester</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="20" valign="center">Total Mahasiswa</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="20">Kegiatan Awal Pembelajaran</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="20">Teknologi Pembelajaran</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="20">Pelaksanaan Pembelajaran</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="20">Penilaian Hasil Belajar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['kuesioner_perkuliahan'] as $row)
            <tr>
                <td style="text-align: center; border: 1px solid black">{{ $loop->iteration }}</td>
                <td style="border: 1px solid black;">{{ $row['nm_dosen'] }}</td>
                <td style="border: 1px solid black;">{{ $row['nm_mk'] }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['semester'] }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['total_mahasiswa_mengisi_kuesioner'] . '/' . $row['total_mahasiswa'] }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['pertanyaan_dan_jawaban'][0]['value'] . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['pertanyaan_dan_jawaban'][1]['value'] . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['pertanyaan_dan_jawaban'][2]['value'] . '%'}}</td>
                <td style="text-align: center; border: 1px solid black">{{ $row['pertanyaan_dan_jawaban'][3]['value'] . '%' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
