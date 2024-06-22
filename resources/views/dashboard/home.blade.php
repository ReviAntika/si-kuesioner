@extends('dashboard.main')
@section('content')

    @if (isset(session('role')['is_mhs']))
        {{-- yang login adalah mahasiswa  --}}
        @include('dashboard.mahasiswa.home', [ 'data' => $data ])
    @endif

    @if (isset(session('role')['is_admin']))
        {{-- yang login adalah admin --}}
        @include('dashboard.admin.home', [ 'data' => $data ])
    @endif

    @if ($data == 'Guest')
        {{-- yang login adalah Guest  --}}
        @include('dashboard.pengguna_umum.home', [ 'data' => $data ])
    @endif
@endsection
