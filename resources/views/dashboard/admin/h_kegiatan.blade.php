@extends('dashboard.main')
@section('content')
<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title pb-4" data-aos="fade-up">
    <h2 class="">Hasil Kuesioner Kegiatan</h2>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-2 justify-content-center" data-aos="fade-up">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tahun</th>
                <th scope="col">Tanggal Acara</th>
                <th scope="col">Penyelenggara</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @if ($data != null)
                     @foreach ($data as $item)
                    <?php
                        $no=1;
                        $tglAwal = \Carbon\Carbon::parse($item->dari_tgl)->format('d F Y');
                        $tglAkhir = \Carbon\Carbon::parse($item->sampai_tgl)->format('d F Y');

                    ?>
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$tglAwal .' - '.$tglAkhir}}</td>
                        <td>{{$item->penyelenggara}}</td>
                        <td>{{$item->kegiatan}}</td>
                        <td>{{$item->total_responden}}</td>

                        <td>
                            <a href="/admin/kuesioner/kegiatan/hasil/list_responden/{{$item->id}}" class="btn btn-primary">View</a>
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
