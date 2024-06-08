@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Kuesioner Perkuliahan</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-2 justify-content-center" data-aos="fade-up">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Matakuliah</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">Status</th>
                    <th scope="col">Isi Kuesioner</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($data['status'] == 'success')
                        @foreach ($data['data']['list_matkul'] as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data['data']['tahun'] }}</td>
                            <td>{{ $item['matakuliah']['semester'] }}</td>
                            <td>{{ $item['matakuliah']['nm_mk'] }}</td>
                            <td>{{ $item['pengajar']['nm_dosen'] }}</td>
                            <td>{!! $item['sts_isi_kuesioner']
                                ? '<span class="badge bg-success">Sudah Mengisi</span>'
                                : '<span class="badge bg-danger">Belum Mengisi</span>' !!}
                            </td>
                            <td>
                                @if ($item['sts_isi_kuesioner'])
                                    <a class="btn btn-small btn-primary disabled" href="#" disabled>
                                        Isi Kuesioner
                                    </a>
                                @else
                                    <a class="btn btn-small btn-primary" href="/kuesioner/perkuliahan/{{$item['kelas_kuliah_id']}}">
                                        Isi Kuesioner
                                    </a>
                                @endif
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
