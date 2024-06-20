<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminKuesionerService;
use App\Models\Tambahan;
use Carbon\Carbon;

use App\Models\Kegiatan;
use App\Models\Jawaban;
use App\Models\Pertanyaan;

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
        $kegiatan = Kegiatan::all();

        foreach ($kegiatan as $index => $item) {
            $totalResponden = Jawaban::where('kegiatan_id', $item['id'])
                ->get()
                ->groupBy('nama_responden')
                ->count();

            $item['total_responden'] = $totalResponden;
            $kegiatan[$index] = $item;
        }

        return view('dashboard.admin.h_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $kegiatan,
        ]);
    }

    public function kuesionerKegiatanListRespondenView($idKegiatan) {
        $respondenKegiatan = Jawaban::where('kegiatan_id', $idKegiatan)
            ->select('id', 'kegiatan_id', 'nama_responden')
            ->get()
            ->groupBy('nama_responden');
        $kegiatan = Kegiatan::where('id', $idKegiatan)->first();

        return view('dashboard.admin.list_responden', [
            'title' => 'List Responden Hasil Kegiatan',
            'data' => [
                'responden' => $respondenKegiatan,
                'kegiatan' => $kegiatan
            ]
        ]);
    }

    public function kuesionerKegiatanDetailJawabanView ($responden, $idKegiatan) {
        // Dapatkan data responden kegiatan
        $respondenKegiatan = Jawaban::where('nama_responden', $responden)
                                    ->where('kegiatan_id', $idKegiatan)
                                    ->get();
        $jawabanDenganPertanyaan = [];
        foreach ($respondenKegiatan as $jawaban) {
            $pertanyaan = Pertanyaan::find($jawaban->pertanyaan_id);
            $jawabanDenganPertanyaan[] = [
                'pertanyaan' => $pertanyaan->teks_pertanyaan,
                'jawaban' => $jawaban->teks_jawaban,
            ];
        }

        dd($jawabanDenganPertanyaan);

        return view('dashboard.admin.detail_jawaban', [
            'title' => 'Detail Jawaban Hasil Kegiatan',
            'jawabanDenganPertanyaan' => $jawabanDenganPertanyaan,
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

        $lihatPertanyaan = $tambah->getListKuesionerKegiatanPertanyaan();

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

