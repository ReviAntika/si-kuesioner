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

        <!-- Petunjuk Pengisian Angket -->
        <div class="container mt-4" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    @foreach ($data as $kegiatan)
                        <a href="kegiatan/{{$kegiatan->id}}" class="btn btn-primary">{{$kegiatan->kegiatan}}</a>
                    @endforeach
                </div>
            </div>
        </div> <!-- End Petunjuk Pengisian Angket -->
    </section>
@endsection
