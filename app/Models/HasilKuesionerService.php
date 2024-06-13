<?php

namespace App\Models;

use App\Models\MyWebService;

class HasilKuesionerService extends MyWebService
{
    /**
     * Hanya dapat digunakan oleh Admin
     * Service ini digunakan untuk get hasil kuesioner
     *
     * Untuk informasi lainnya mengenai service ini
     * kunjungi Dokumentasi API menu Kuesioner
     */
    public function __construct()
    {
        parent::__construct('kuesioner/perkuliahan/hasil');
    }

    public function getListTahunAjaranTersedia() {
        return $this->get(null, '/tahun-ajaran');
    }

    public function getListSemesterByTahunId(int $tahunId) {
        $query = '/semester?tahun_id=' . $tahunId;

        return $this->get(null, $query);
    }

    public function getListDosenByTahunIdAndSemester(int $tahunId, int $semester) {
        $query = '/dosen?tahun_id=' . $tahunId . '&semester=' . $semester;

        return $this->get(null, $query);
    }

    public function getListMatkulDiampuDosen(int $tahunId, int $semester, int $dosenId) {
        $query = '/matkul?tahun_id=' . $tahunId . '&semester=' . $semester . '&dosen_id=' . $dosenId;

        return $this->get(null, $query);
    }

    public function getListMahasiswaMengisiKuesioner(string $kelasKuliahId) {
        $query = '/mahasiswa?kelas_kuliah_id=' . $kelasKuliahId;

        return $this->get(null, $query);
    }

    public function getJawabanKuesionerMahasiswa(int $kuesionerPerkuliahanMahasiswaId) {
        $query = '/jawaban?kuesioner_perkuliahan_mahasiswa_id=' . $kuesionerPerkuliahanMahasiswaId;

        return $this->get(null, $query);
    }
}
