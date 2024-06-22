<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $table = 'tb_saran';
    protected $guarded = ['id'];

    public $timestamps = false;
    public $primaryKey = 'id';

    public function kegiatan() {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
