@extends('dashboard.main')
@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title pb-4" data-aos="fade-up">
            <h2 class="">Kuesioner Kegiatan</h2>
                {{-- @if ($list_pertanyaan->count() > 0)
                    {{ ' ' . $kegiatan->nama_kegiatan }}

                @endif --}}
            </h2>
        </div><!-- End Section Title -->

        <!-- Nama Input -->
        <div class="container mt-4" data-aos="fade-up">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-1 col-form-label"><strong>Nama:</strong></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
        </div><!-- End Nama Input -->


        <!-- Petunjuk Pengisian Angket -->
        <div class="container mt-4" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <p><strong>PETUNJUK:</strong></p>
                    <p>a. Isilah angket ini dengan memberi tanda centang di kolom pada jawaban yang disediakan.</p>
                    <p>b. Angket ini menunjukkan tanggapan Anda terhadap kegiatan yang dilaksanakan oleh penyelenggara yang berguna untuk perbaikan mutu kegiatan.</p>
                    <p>c. Jawaban yang Anda berikan dijamin kerahasiaannya, dan tidak berpengaruh terhadap status Anda sebagai mahasiswa. Oleh karena itu, Anda diminta untuk memberikan penilaian secara sungguh-sungguh.</p>
                    <p>d. Kriteria bobot penilaian adalah sebagai berikut:</p>
                    <ul>
                        <li>5 = Sangat Setuju: 81 - 100%</li>
                        <li>4 = Setuju: 61 - 80%</li>
                        <li>3 = Netral: 41 - 60%</li>
                        <li>2 = Tidak Setuju: 21 - 40%</li>
                        <li>1 = Sangat Tidak Setuju: 1 - 20%</li>
                    </ul>
                </div>
            </div>
        </div> <!-- End Petunjuk Pengisian Angket -->

        <div class="container">
            <div class="row gy-2 justify-content-center" data-aos="fade-up">
                    @csrf
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($list_pertanyaan->count() > 0)
                                @foreach ($list_pertanyaan as $pertanyaan)
                                <tr>
                                    @php
                                        ++$countPertanyaan;
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pertanyaan->pertanyaan }}</td>

                                    @foreach ($pilihan_jawaban as $pilihan)
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                        <td>
                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}" value="{{ $pilihan->kd_point }}">
                                        </td>
                                    @endforeach

                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No data available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <input type="hidden" name="total_pertanyaan" value="{{ $countPertanyaan }}">


                    {{-- Tombol menuju pengisian saran --}}
                    <div class="d-flex">
                        <button class="btn btn-small btn-danger ms-auto" type="submit" id="buttonLanjutkan">
                            Lanjutkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
