<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class HasilKuesionerPerkuliahanExport implements FromView
{
    private $hasilKuesioner;
    private $tahunAjaran;

    public function __construct($hasilKuesioner, $tahunAjaran)
    {
        $this->hasilKuesioner = $hasilKuesioner;
        $this->tahunAjaran = $tahunAjaran;
    }

    public function view(): View
    {
        return view('exports.hasil_perkuliahan', [
            'data' => $this->hasilKuesioner,
            'tahun_ajaran' => $this->tahunAjaran
        ]);
    }
}
