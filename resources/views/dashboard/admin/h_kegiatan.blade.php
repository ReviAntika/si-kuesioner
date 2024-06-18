@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">Hasil Kuesioner Kegiatan</h2>
      </div><!-- End Section Title -->

      <div class="container">
          <!-- Button trigger modal -->
          
        <div class="row gy-2 justify-content-center" data-aos="fade-up">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKegiatanTambah">
                  Tambah Data
              </button>
          </div>
            <table class="table">
                <thead>
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
                            <td>{{ is_null($item->status) ? '-' : $item->status }}</td>
                            <td>
                                <a href="/admin/kuesioner/kegiatan/pertanyaan" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
                            </td>
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

    <!-- Modal -->
    <div class="modal fade" id="modalKegiatanTambah" tabindex="-1" aria-labelledby="modalTambahKegiatan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKegiatan">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="/admin/kuesioner/kegiatan/add" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" rows="3">
                            </div>
                            <div class="mb-3">
                                <label for="dari_tgl" class="form-label"> Dari Tanggal</label>
                                <input type="date" class="form-control" id="tgl_acara" name="dari_tgl" rows="3">
                            </div>
                            <div class="mb-3">
                                <label for="sampai_tgl" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="tgl_acara" name="sampai_tgl" rows="3">
                            </div>
                            <div class="mb-3">
                                <label for="organisasi" class="form-label">Organisasi</label>
                                <input type="text" class="form-control" id="organisasi" name="organisasi" rows="3">
                            </div>
                            <div class="mb-3">
                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" rows="3">
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
