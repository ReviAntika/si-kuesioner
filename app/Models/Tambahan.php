<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tambahan extends Model
{
      /**
     * ini Dipakai untuk post data kegiatan
     */
    public function sendJawabanKuesionerKegiatan($namaResponden, $kegiatanId, array $listJawaban) {

        foreach ($listJawaban as $key => $value) {
            $payload = [
                'nama_responden' => $namaResponden,
                'kegiatan_id' => $kegiatanId,
                'jawaban' => $value['jawaban'],
                'pertanyaan_id' => $value['pertanyaan_id'],
            ];
            DB::table('tb_jawaban')->insert($payload);
        }
        // dd($listJawaban);
        // dd($payload);
        return 'sukses';
    }

    public function addDataKegiatan($data)
    {
        return DB::table('tb_kegiatan')->insert($data);
    }
        /**
     * digunakan untuk melihat list kuesioner kegiatan yang tersedia
     */
    public function getListKuesionerKegiatan() {
        return DB::table('tb_kegiatan')->get();
    }
    public function getListKuesionerKegiatanWithPertanyaan() {
        return DB::table('tb_kegiatan')
        ->get();
    }
    public function getListKuesionerKegiatanPertanyaan() {
        $pertanyaan = DB::table('tb_pertanyaan')->get();
        $pilihan = DB::table('tb_pilihan')->get();

        return ['list_pertanyaan' => $pertanyaan, 'pilihan'=>$pilihan];
    }
    public function UpdateKuesionerKegiatanPertanyaan($id,$data) {
        return DB::table('tb_pertanyaan')->where('id',$id)->update($data);
    }
    public function sendSaranKegiatan($saran, $kegiatanId)
    {
        $payload = [
            'id_kegiatan'=> $kegiatanId,
            'saran'=> $saran
        ];
        DB::table('tb_saran')->insert($payload);
        return 'sukses';
    }
}
