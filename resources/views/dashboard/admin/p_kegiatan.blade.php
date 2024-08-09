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
                                <td style="display: none">{{$pertanyaan->id}}</td>
                                <td>{{ $pertanyaan->pertanyaan }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKegiatanPertanyaan"
                                        data-idpertanyaan="{{$pertanyaan->id}}"
                                        data-pertanyaan="{{$pertanyaan->pertanyaan}}"
                                        onclick="editPertanyaan(this)"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No data available.</td>
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
                        <input type="hidden" name="idPertanyaan" id="idPertanyaan">
                        <div class="mb-2">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <textarea class="form-control" id="pertanyaan" name="pertanyaan" cols="30" rows="10"></textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    function editPertanyaan(element) {
        var ids = element.getAttribute("data-idpertanyaan");
        var pert = element.getAttribute("data-pertanyaan");

        document.getElementById("idPertanyaan").value = ids;
        document.getElementById("pertanyaan").value = pert;

        console.log(ids, pert);
    }
</script>
@endsection
