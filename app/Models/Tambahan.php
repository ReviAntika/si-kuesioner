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
}