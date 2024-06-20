<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'tb_kegiatan';
    protected $guarded = ['id'];

    public $timestamps = false;
    public $primaryKey = 'id';

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'kegiatan_id');
    }
}
