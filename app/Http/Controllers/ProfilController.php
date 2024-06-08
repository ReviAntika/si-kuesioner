<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminKuesionerService;
use App\Models\MahasiswaKuesionerService;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    protected $mahasiswaService;
    protected $adminService;

    public function __construct() {
        $this->mahasiswaService = new MahasiswaKuesionerService();
        $this->adminService = new AdminKuesionerService();
    }

    public function profil(){
        if (isset(Session::get('role')['is_mhs'])) {
            return view('dashboard.mahasiswa.profil', [
                'title' => 'My Profil'
            ]);
         }

         if (isset(Session::get('role')['is_admin'])) {
            // dd(Session::get('profile'));
            // dd(Session::get('user_email'));
            // dd(Session::get('user_image'));
            return view('dashboard.admin.profil', [
                'title' => 'My Profil'
            ]);
         }
    }
}
