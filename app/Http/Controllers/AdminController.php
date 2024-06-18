<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminKuesionerService;
use App\Models\Tambahan;
use Carbon\Carbon;

class AdminController extends Controller
{
    private $service;

    public function __construct() {
        $this->service = new AdminKuesionerService();
    }

    public function kuesionerKegiatanView() {
        $tambah = new Tambahan();

        $listKuesionerKegiatan =$tambah->getListKuesionerKegiatan();

        // dd($listKuesionerKegiatan);

        return view('dashboard.admin.kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $listKuesionerKegiatan,
        ]);
    }
    public function kuesionerKegiatanHasilView() {
        $tambah = new Tambahan();

        $listKuesionerKegiatan =$tambah->getListKuesionerKegiatanWithPertanyaan();
        dd($listKuesionerKegiatan);
        $idkegiatan=0;
        $respons = $tambah->get();

        // dd($listKuesionerKegiatan);

        return view('dashboard.admin.h_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $listKuesionerKegiatan,
        ]);
    }

        /**
     * ini buat tambah data kegiatan
     * langsung masuk ke DB baru
     * ubah 2 tanggal jadi d-m-Y
     */
    public function kuesionerKegiatanTambah(Request $request) {

        $kdAcara = 'SB'. $request->organisasi . Carbon::parse($request->dari_tgl)->format('dmY');
        // dd($kdAcara);
        $data = [

            'kd_acara' => $kdAcara,
            'tahun' => $request->tahun,
            'dari_tgl' => $request->dari_tgl,
            'sampai_tgl' => $request->sampai_tgl,
            'penyelenggara' => $request->organisasi,
            'kegiatan' => $request->kegiatan,
        ];
        $tambah = new Tambahan();

        $tambah->addDataKegiatan($data);

        return redirect()->back()->with('Success','Data Berhasil Di Tambah');
    }

    public function kuesionerKegiatanPertanyaan() {
        $tambah = new Tambahan();

        $lihatPertanyaan =$tambah->getListKuesionerKegiatanPertanyaan();

        // dd($lihatPertanyaan);

        return view('dashboard.admin.p_kegiatan', [
            'title' => 'Pertanyaan Kuesioner Kegiatan',
            'data' => $lihatPertanyaan,
        ]);
    }
    public function kuesionerKegiatanPertanyaanEdit(Request $request) {
        $tambah = new Tambahan();
        $id = $request->idPertanyaan;
        // dd($id);
        if ($request->idPertanyaan != null) {
            $data =['pertanyaan'=>$request->pertanyaan];
            $tambah->UpdateKuesionerKegiatanPertanyaan($id,$data);
            return redirect()->back()->with('success','Data Berhasil Di Edit');

        }else{
            abort(403);
        }
    }

}

