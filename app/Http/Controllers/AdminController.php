<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminKuesionerService;

class AdminController extends Controller
{
    private $service;

    public function __construct() {
        $this->service = new AdminKuesionerService();
    }

    public function kuesionerKegiatanView() {
        $listKuesionerKegiatan = $this->service->getListKuesionerKegiatan()->getData('data');

        return view('dashboard.admin.kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $listKuesionerKegiatan,
        ]);
    }
}

