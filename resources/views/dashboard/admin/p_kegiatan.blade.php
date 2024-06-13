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
                            <th scope="col" style="background-color: green!important; color: white;">SS</th>
                            <th scope="col" style="background-color: green!important; color: white;">S</th>
                            <th scope="col" style="background-color: green!important; color: white;">N</th>
                            <th scope="col" style="background-color: green!important; color: white;">TS</th>
                            <th scope="col" style="background-color: green!important; color: white;">STS</th>
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

                                @foreach ($data['pilihan'] as $pilihan)
                                    <td>
                                        <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                    </td>
                                @endforeach
                                <td class="text-center"><a href="#" class="btn btn-success "><i class="fa-solid fa-pen-to-square"></i></a></td>
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

@endsection
