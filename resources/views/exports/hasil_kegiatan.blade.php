<br>
<table>
    <tbody>
        <tr>
            <th colspan="2" style="font-weight: 800; font-size: 14px">Waktu Pelaksanaan:</th>
            <th colspan="4" style="font-weight: 800; font-size: 14px">{{ $data['kegiatan']['dari_tgl'] . ' - ' . $data['kegiatan']['sampai_tgl'] }}</th>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: 800; font-size: 14px">Penyelenggara:</th>
            <th colspan="4" style="font-weight: 800; font-size: 14px">{{ $data['kegiatan']['penyelenggara'] }}</th>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: 800; font-size: 14px">Kegiatan:</th>
            <th colspan="4" style="font-weight: 800; font-size: 14px">{{ $data['kegiatan']['kegiatan'] }}</th>
        </tr>
        <tr>
            <th colspan="2" style="font-weight: 800; font-size: 14px">Total Responden:</th>
            <th colspan="4" style="font-weight: 800; font-size: 14px; text-align: left">{{ $data['total_responden'] }}</th>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black" bgcolor="#0d6efd" width="6" valign="center">No.</th>
            <th style="font-weight: 800; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="40" valign="center">Pertanyaan</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black" bgcolor="#0d6efd" width="8" valign="center">STS</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="8" valign="center">TS</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="8" valign="center">N</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="8">S</th>
            <th style="font-weight: 800; text-align: center; font-size: 12px; border: 1px solid black; word-wrap: break-word" bgcolor="#0d6efd" width="8">SS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['pertanyaan_dan_jawaban'] as $row)
            <tr>
                <td style="text-align: center; border: 1px solid black">{{ $loop->iteration }}</td>
                <td style="text-align: left; border: 1px solid black; word-wrap: break-word;">{{ $row['pertanyaan'] }}</td>
                <td style="text-align: center; border: 1px solid black">{{ round($row['persentase_jawaban']['STS'], 2) . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ round($row['persentase_jawaban']['TS'], 2) . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ round($row['persentase_jawaban']['N'], 2) . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ round($row['persentase_jawaban']['S'], 2) . '%' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ round($row['persentase_jawaban']['SS'], 2) . '%' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
