@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title pb-4" data-aos="fade-up">
        <h2 class="">
           Pertanyaan Kuesioner Kegiatan
        </h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-2 justify-content-center" data-aos="fade-up">
            <form action="">
                @php
                    // hitung total pertanyaan
                    $countPertanyaan = 0;
                @endphp
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="background-color: green!important; color: white;">No.</th>
                            <th scope="col" style="background-color: green!important; color: white; text-align: center;">Pertanyaan</th>
                            {{-- <th scope="col" style="background-color: green!important; color: white;">SS</th>
                            <th scope="col" style="background-color: green!important; color: white;">S</th>
                            <th scope="col" style="background-color: green!important; color: white;">N</th>
                            <th scope="col" style="background-color: green!important; color: white;">TS</th>
                            <th scope="col" style="background-color: green!important; color: white;">STS</th> --}}
                            <th scope="col" style="background-color: green!important; color: white; text-align:center;">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data['list_pertanyaan']->count() > 0)
                            @foreach ($data['list_pertanyaan'] as $pertanyaan)
                            <tr>
                                @php
                                    ++$countPertanyaan;
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pertanyaan->pertanyaan }}</td>

                                {{-- @foreach ($data['pilihan'] as $pilihan)
                                    <td>
                                        <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                    </td>
                                @endforeach --}}
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="btnModalEditPertanyaan" data-bs-target="#modalKegiatanPertanyaan"
                                        data-idPertanyaan="{{$pertanyaan->id}}"
                                        data-pertanyaan="{{$pertanyaan->pertanyaan}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
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
            </form>
        </div>
      </div>
    </section>
<!-- Modal -->
<div class="modal fade" id="modalKegiatanPertanyaan" tabindex="-1" aria-labelledby="modalPertanyaanKegiatan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPertanyaanKegiatan">Edit Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="/admin/kuesioner/kegiatan/pertanyaan/edit" method="post">
                        @csrf
                        <input type="hidden" name="idPertanyaan" id="idPertanyaan" value="">
                        <div class="mb-3">
                            {{-- {{$data->idPertanyaan}} --}}
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" rows="3" value="">
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
<script>
    $("#btnModalEditPertanyaan").click(function () {
    var ids = $(this).attr('data-idPertanyaan');
    var pert = $(this).attr('data-pertanyaan');
    $("#idPertanyaan").val( ids );
    $("#pertanyaan").val( pert );
    $('#myModal').modal('show');
});
</script>
@endsection
