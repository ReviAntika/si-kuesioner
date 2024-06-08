<?php

namespace App\Http\Controllers;

use App\Models\AdminKuesionerService;
use App\Models\MahasiswaKuesionerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $mahasiswaService;
    protected $adminService;

    public function __construct() {
        $this->mahasiswaService = new MahasiswaKuesionerService();
        $this->adminService = new AdminKuesionerService();
    }

    public function index() {
        $data = null;

        if (isset(Session::get('role')['is_mhs'])) {
            /**
             * jika yang login adalah mahasiswa
             */
            $data = 'Mahasiswa';
        } else if (isset(Session::get('role')['is_admin'])) {
            /**
             * jika yang login adalah admin
             */
            $data = 'Admin';
        }

        return view('dashboard.home', [
            'title' => 'Home',
            'data' => $data,
        ]);
    }
}
