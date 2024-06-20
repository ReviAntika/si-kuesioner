@extends('dashboard.main')
@section('content')
<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title pb-4" data-aos="fade-up">
    <h2 class="">List Responden Hasil Kegiatan</h2>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-2 justify-content-center" data-aos="fade-up">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tahun</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Acara</th>
                <th scope="col">Penyelenggara</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @if (array_key_exists('responden', $data) and array_key_exists('kegiatan', $data))
                     @foreach ($data['responden'] as $key => $item)
                    <?php
                        $tglAwal = \Carbon\Carbon::parse($data['kegiatan']['dari_tgl'])->format('d F Y');
                        $tglAkhir = \Carbon\Carbon::parse($data['kegiatan']['sampai_tgl'])->format('d F Y');
                    ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data['kegiatan']['tahun'] }}</td>
                        <td>{{ $key }}</td>
                        <td>{{ $tglAwal . ' - ' .$tglAkhir }}</td>
                        <td>{{ $data['kegiatan']['penyelenggara'] }}</td>
                        <td>{{ $data['kegiatan']['kegiatan'] }}</td>
                        <td>
                            <a href="/admin/kuesioner/kegiatan/hasil/list_reponden/detail_jawaban/{{$key}}/{{$data['kegiatan']['id']}}" class="btn btn-primary">Lihat Jawaban</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7" class="text-center">No data available.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection
