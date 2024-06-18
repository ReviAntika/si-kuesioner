<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaKuesionerService;

// ? Model
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;
use App\Models\Tambahan;

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

    //KHUSUS UNTUK KEGIATAN MULAI DARI BAWAH

    public function getKegiatanView(){
        $listKegiatan = $this->service->getListKegiatan();
        // dd($listKegiatan);
        return view('dashboard.mahasiswa.l_kegiatan', [
            'title' => 'Kegiatan',
            'data' => $listKegiatan,
            ]);
    }

    public function getPertanyaanKegiatanView($id) {
        $list_pertanyaan = Pertanyaan::all();
        $pilihan_jawaban = PilihanJawaban::all();
        $id_kegiatan = $id;
        // dd([$list_pertanyaan,$pilihan_jawaban]);


        return view('dashboard.mahasiswa.p_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'list_pertanyaan' => $list_pertanyaan,
            'pilihan_jawaban' => $pilihan_jawaban,
            'id_kegiatan' => $id_kegiatan
        ]);
    }

    public function addJawabanKegiatan(Request $request , $id) {
        // dd($request->all());
        $dataKegiatan = new Tambahan();

        $dataKegiatan->sendJawabanKuesionerKegiatan(
            $request->nama_responden, $request->kegiatan_id, $request->list_jawaban
        );

        return redirect('/kuesioner/kegiatan/saran/'.$id)->with($idKegiatan);
    }
    public function saranKegiatanView($idKegiatan) {
        return view('dashboard.mahasiswa.saran_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => [
                'kuesioner_saran_kegiatan_id' => $idKegiatan
            ],
        ]);
    }
    public function addSaranKegiatan(Request $request) {
       $dataKegiatan = new Tambahan();
       $result = $dataKegiatan->sendSaranKegiatan($request->saran,$request->id
       );

        return $result;
    }
}
