<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Jawaban;

class Pertanyaan extends Model
{
    protected $table = 'tb_pertanyaan';
    protected $guarded = ['id'];

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'pertanyaan_id', 'id');
    }
}
