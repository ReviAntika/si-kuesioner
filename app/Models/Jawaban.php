<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pertanyaan;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'tb_jawaban';
    protected $guarded = ['id'];

    public $timestamps = false;
    public $primaryKey = 'id';

    public function kegiatan() {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function pertanyaan() {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
