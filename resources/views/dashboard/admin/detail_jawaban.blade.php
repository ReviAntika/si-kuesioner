@extends('dashboard.main')
@section('content')
<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title pb-4" data-aos="fade-up">
    <h2 class="">Detail Jawaban Hasil Kegiatan</h2>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-2 justify-content-center" data-aos="fade-up">
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
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                     @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['pertanyaan'] }}</td>
                        <td>
                            @if ($item['jawaban'] == 'SS')
                                <input type="radio" value="SS" disabled checked>
                            @else
                                <input type="radio" value="SS" disabled>
                            @endif
                        </td>
                        <td>
                            @if ($item['jawaban'] == 'S')
                                <input type="radio" value="S" disabled checked>
                            @else
                                <input type="radio" value="S" disabled>
                            @endif
                        </td>
                        <td>
                            @if ($item['jawaban'] == 'N')
                                <input type="radio" value="N" disabled checked>
                            @else
                                <input type="radio" value="N" disabled>
                            @endif
                        </td>
                        <td>
                            @if ($item['jawaban'] == 'TS')
                                <input type="radio" value="TS" disabled checked>
                            @else
                                <input type="radio" value="TS" disabled>
                            @endif
                        </td>
                        <td>
                            @if ($item['jawaban'] == 'STS')
                                <input type="radio" value="STS" disabled checked>
                             @else
                                <input type="radio" value="STS" disabled>
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
        <div class="form-floating shadow-lg p-3 mb-3 bg-body-tertiary rounded">
            <textarea class="form-control" placeholder="" id="saran" style="height: 200px"readonly>{{$saran['saran']}}</textarea>
            <label for="floatingTextarea2">Saran pengembangan Kegiatan</label>
        </div>

    </div>
  </div>
</section>
@endsection
