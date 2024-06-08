@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Kegiatan</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-2 justify-content-center" data-aos="fade-up">
            <table class="table">
                <thead>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info">Tambah Kegiatan</button>
                    </div>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Tanggal Acara</th>
                    <th scope="col">Organisasi</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Isi Kuesioner</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($data['status'] == 'success')
                        @foreach ($data['data']['kuesioner_kegiatan'] as $item)
                        @php
                            $tanggalMulai = date('d F Y', strtotime($item['tanggal_mulai']));
                            $tanggalAkhir = date('d F Y', strtotime($item['tanggal_akhir']));
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item['tahun'] }}</td>
                            <td>{{ $tanggalMulai . ' - ' . $tanggalAkhir }}</td>
                            <td>{{ $item['organisasi'] }}</td>
                            <td>{{ $item['kegiatan'] }}</td>
                            <td>-</td>
                            <td>
                                <button class="btn btn-small btn-primary">
                                    Lihat Pertanyaan
                                </button>
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
