<?php

namespace App\Models;

use App\Models\MyWebService;
use Illuminate\Support\Facades\DB;

class AdminKuesionerService extends MyWebService
{
    /**
     * untuk penjelasan lebih lanjut akseslah API Documentation STMIK Bandung
     * dan kunjungi halaman kuesioner di menu Web -> Kuesioner
     */
    public function __construct() {
        parent::__construct('kuesioner');
    }

    /**
     * * START - Kuesioner Perkuliahan
     */

    /**
     * digunaakn untuk mendapatkan list tahun ajaran aktif
     * yang memiliki jadwal kelas kuliah untuk matkulnya
     */
    public function getTahunAjaranKuesionerPerkuliahan() {
        return $this->get(null, '/tahun-ajaran');
    }

    /**
     * digunakan untuk get daftar matkul tersedia
     * pada tahun ajaran aktif yang dipilih
     */
    public function getMatkulForKuesionerPerkuliahan($tahunId, $jenisMahasiswa, $kodeKampus) {
        return $this->get(
            null, "/perkuliahan?tahun_id=$tahunId&jns_mhs=$jenisMahasiswa&kd_kampus=$kodeKampus"
        );
    }

    /**
     * digunakan untuk membuka kuesioner perkuliahan
     * berdasarkan tahun ajaran aktif yang dipilih
     */
    public function bukaKuesionerPerkuliahan($tahunId) {
        $payload = [
            'tahun_id' => $tahunId
        ];

        return $this->post($payload, '/perkuliahan/open');
    }

    /**
     * * END - Kuesioner Perkuliahan
     */

    /**
     * * START - Kuesioner Kegiatan
     */

    /**
     * digunakan untuk menambah kuesioner kegiatan
     */
    public function addKuesionerKegiatan($tanggalMulai, $tanggalAkhir, $penyelenggara, $kegiatan) {
        $payload = [
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_akhir' => $tanggalAkhir,
            'penyelenggara' => $penyelenggara,
            'kegiatan' => $kegiatan
        ];

        return $this->post($payload, '/kegiatan/add');
    }



    /**
     * * END - Kuesioner Kegiatan
     */

    /**
     * * COMMON - Dapat digunakan untuk perkuliahan dan kegiatan
     */

    /**
     * digunakan untuk melihat jenis pertanyaan kuesioner yang ada
     * saat ini ada dua, yaitu: Perkuliahan dan Kegiatan
     */
    public function getListJenisPertanyaan() {
        return $this->get(null, '/pertanyaan/jenis');
    }

    /**
     * digunakan untuk melihat list kelompok pertanyaan
     * seperti: 'Kepuasan Mahasiswa', 'Teknologi Pembelajaran', dll.
     */
    public function getListKelompokPertanyaanByJenisId($jenisPertanyaanId) {
        return $this->get(null, "/pertanyaan/kelompok?jenis_id=$jenisPertanyaanId");
    }

    /**
     * digunakan untuk melihat semua pertanyaan yang ada
     * berdasarkan pada jenis pertanyaan
     */
    public function getListPertanyaanByJenisId($jenisPertanyaanId) {
        return $this->get(null, "/pertanyaan?jenis_id=$jenisPertanyaanId");
    }

    /**
     * digunakan untuk melihat detail dari satu pertanyaan
     */
    public function getDetailPertanyaanById($pertanyaanId) {
        return $this->get(null, "/pertanyaan/detail/$pertanyaanId");
    }

    /**
     * digunakan untuk menambah pertanyaan baru
     */
    public function addNewPertanyaan($jenisPertanyaanId, $kelompokPertanyaanId, $pertanyaan) {
        $payload = [
            'jenis_pertanyaan_id' => $jenisPertanyaanId,
            'kelompok_pertanyaan_id' => $kelompokPertanyaanId,
            'pertanyaan' => $pertanyaan,
        ];

        return $this->post($payload, '/pertanyaan/add');
    }

    /**
     * digunakan untuk mengubah pertanyaan yang sudah ada
     */
    public function editPertanyaan($pertanyaanId, $jenisPertanyaanId, $kelompokPertanyaanId, $pertanyaan) {
        $payload = [
            'pertanyaan_id' => $pertanyaanId,
            'jenis_pertanyaan_id' => $jenisPertanyaanId,
            'kelompok_pertanyaan_id' => $kelompokPertanyaanId,
            'pertanyaan' => $pertanyaan,
        ];

        return $this->put($payload, '/pertanyaan/edit');
    }


}
