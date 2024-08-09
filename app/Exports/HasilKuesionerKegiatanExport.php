<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class HasilKuesionerKegiatanExport implements FromView
{
    private $hasilKegiatan;

    public function __construct($hasilKegiatan)
    {
        $this->hasilKegiatan = $hasilKegiatan;
    }

    public function view(): View
    {
        return view('exports.hasil_kegiatan', [
            'data' => $this->hasilKegiatan
        ]);
    }
}
