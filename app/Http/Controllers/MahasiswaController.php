<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaKuesionerService;

// ? Model
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;

class MahasiswaController extends Controller
{
    private $service;

    public function __construct() {
        $this->service = new MahasiswaKuesionerService();
    }

    public function kuesionerPerkuliahanView() {
        $listKuesionerPerkuliahan = $this->service->getListKuesionerPerkuliahan()->getData('data');

        return view('dashboard.mahasiswa.perkuliahan', [
            'title' => 'Kuesioner Perkuliahan',
            'data' => $listKuesionerPerkuliahan,
        ]);
    }

    public function getPertanyaanView($kelasKuliahId) {
        $listPertanyaan = $this->service->getPertanyaanKuesionerForMatkul($kelasKuliahId)->getData('data');
        $pilihanJawaban = $this->service->getPilihanJawaban()->getData('data')['data']['pilihan_jawaban'];

        return view('dashboard.mahasiswa.p_perkuliahan', [
            'title' => 'Kuesioner Perkuliahan',
            'list_pertanyaan' => $listPertanyaan,
            'pilihan_jawaban' => $pilihanJawaban
        ]);
    }

    public function addJawabanPerkuliahan(Request $request) {
        $result = $this->service->sendJawabanKuesionerPerkuliahan(
            $request->kuesioner_perkuliahan_id, $request->kelas_kuliah_id, $request->list_jawaban
        );

        return $result;
    }

    public function saranPerkuliahanView($kuesionerPerkuliahanMahasiswaId) {
        return view('dashboard.mahasiswa.saran_perkuliahan', [
            'title' => 'Kuesioner Perkuliahan',
            'data' => [
                'kuesioner_perkuliahan_mahasiswa_id' => $kuesionerPerkuliahanMahasiswaId
            ],
        ]);
    }

    public function addSaranPerkuliahan(Request $request) {
        $result = $this->service->sendSaranForMatkul(
            $request->id, $request->saran
        );

        return $result;
    }

    public function getPertanyaanKegiatanView() {
        $list_pertanyaan = Pertanyaan::where('id')->get();
        $pilihan_jawaban = PilihanJawaban::all();

        return view('dashboard.mahasiswa.p_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'list_pertanyaan' => $list_pertanyaan,
            'pilihan_jawaban' => $pilihan_jawaban
        ]);
    }
}
