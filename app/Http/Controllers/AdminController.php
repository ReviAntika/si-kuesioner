<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminKuesionerService;
use App\Models\Tambahan;
use Carbon\Carbon;

use App\Models\Kegiatan;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;
use App\Models\Saran;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    private $service;

    public function __construct() {
        $this->service = new AdminKuesionerService();
    }

    public function kuesionerPerkuliahanView()
    {
        $listTahunAjaran = $this->service->getTahunAjaranKuesionerPerkuliahan()->getData('data');

        // dd($listTahunAjaran);
        return view('dashboard.admin.perkuliahan', [
            'title' => 'Kuesioner Perkuliahan',
            'data' => $listTahunAjaran,
        ]);
    }

    public function kuesionerPerkuliahanViewTahun($tahunId, $jenisMahasiswa, $kodeKampus)
    {
        $listData = $this->service->getMatkulForKuesionerPerkuliahan($tahunId, $jenisMahasiswa, $kodeKampus)->getData('data');
        $listDataByTahunAjaran = $listData['data']['matakuliah'];

        return $listDataByTahunAjaran;
    }

    public function getPertanyaanView() {
        $jenisId = 1;
        $listPertanyaan = $this->service->getPertanyaanKuesioner($jenisId)->getData('data');
        // dd($listPertanyaan);
        return view('dashboard.admin.p_perkuliahan', [
            'title' => 'Kuesioner Perkuliahan',
            'list_pertanyaan' => $listPertanyaan
        ]);
    }

    public function kuesionerPerkulihanHasilView()
    {
        $listTahunAjaran = $this->service->getTahunAjaranKuesionerPerkuliahan()->getData('data');

        // dd($listTahunAjaran);
        return view('dashboard.admin.h_perkuliahan', [
            'title' => 'Kuesioner Hasil Perkuliahan',
            'data' => $listTahunAjaran,
        ]);
    }

    public function kuesionerPerkuliahanChartView() {

        $tahun = $this->service->getTahunAjaranKuesionerPerkuliahan()->getData('data');

        // dd($listKuesionerKegiatan);

        return view('dashboard.admin.c_perkuliahan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $tahun,
        ]);
    }

    public function HasilChartPerkuliahanView()
    {
        $listTahunAjaran = $this->service->getTahunAjaranKuesionerPerkuliahan()->getData('data');

        // dd($listTahunAjaran);
        return view('dashboard.admin.h_perkuliahan', [
            'title' => 'Kuesioner Hasil Perkuliahan',
            'data' => $listTahunAjaran,
        ]);
    }
    public function HasilChartPerkuliahanViewFilter()
    {
        $data =  $this->service->getJawabanHasilKuesioner();
        dd($data);
    }


    // CONTROLLER FOR KEGIATAN

    public function kuesionerKegiatanView() {
        $tambah = new Tambahan();

        $listKuesionerKegiatan =$tambah->getListKuesionerKegiatan();

        // dd($listKuesionerKegiatan);

        return view('dashboard.admin.kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $listKuesionerKegiatan,
        ]);
    }
    public function kuesionerKegiatanHasilView() {
        $kegiatan = Kegiatan::all();

        foreach ($kegiatan as $index => $item) {
            $totalResponden = Jawaban::where('kegiatan_id', $item['id'])
                ->get()
                ->groupBy('nama_responden')
                ->count();

            $item['total_responden'] = $totalResponden;
            $kegiatan[$index] = $item;
        }

        return view('dashboard.admin.h_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'data' => $kegiatan,
        ]);
    }

    public function kuesionerKegiatanListRespondenView($idKegiatan) {
        $respondenKegiatan = Jawaban::where('kegiatan_id', $idKegiatan)
            ->select('id', 'kegiatan_id', 'nama_responden')
            ->get()
            ->groupBy('nama_responden');
        $kegiatan = Kegiatan::where('id', $idKegiatan)->first();

        return view('dashboard.admin.list_responden', [
            'title' => 'List Responden Hasil Kegiatan',
            'data' => [
                'responden' => $respondenKegiatan,
                'kegiatan' => $kegiatan
            ]
        ]);
    }

    public function kuesionerKegiatanDetailJawabanView ($responden, $idKegiatan) {
        // Dapatkan data responden kegiatan
        $respondenKegiatan = Jawaban::where('nama_responden', $responden)
                                    ->where('kegiatan_id', $idKegiatan)
                                    ->get();
        $saran = Saran::where('nama_responden', $responden)
                ->where('id_kegiatan', $idKegiatan)
                ->first();
                // dd($saran);
        $jawabanDenganPertanyaan = [];
        foreach ($respondenKegiatan as $row) {
            $item = Pertanyaan::find($row->pertanyaan_id);

            $jawabanDenganPertanyaan[] = [
                'pertanyaan' => $item->pertanyaan,
                'jawaban' => $row->jawaban,
            ];
        }

        // dd($saran);

        return view('dashboard.admin.detail_jawaban', [
            'title' => 'Detail Jawaban Hasil Kegiatan',
            'data' => $jawabanDenganPertanyaan,
            'saran' => $saran,
        ]);
    }



        /**
     * ini buat tambah data kegiatan
     * langsung masuk ke DB baru
     * ubah 2 tanggal jadi d-m-Y
     */
    public function kuesionerKegiatanTambah(Request $request) {

        $kdAcara = 'SB'. $request->organisasi . Carbon::parse($request->dari_tgl)->format('dmY');
        // dd($kdAcara);
        $data = [

            'kd_acara' => $kdAcara,
            'tahun' => $request->tahun,
            'dari_tgl' => $request->dari_tgl,
            'sampai_tgl' => $request->sampai_tgl,
            'penyelenggara' => $request->organisasi,
            'kegiatan' => $request->kegiatan,
        ];
        $tambah = new Tambahan();

        $tambah->addDataKegiatan($data);

        return redirect()->back()->with('Success','Data Berhasil Di Tambah');
    }

    public function kuesionerKegiatanPertanyaan() {
        $tambah = new Tambahan();

        $lihatPertanyaan = $tambah->getListKuesionerKegiatanPertanyaan();

        // dd($lihatPertanyaan);

        return view('dashboard.admin.p_kegiatan', [
            'title' => 'Pertanyaan Kuesioner Kegiatan',
            'data' => $lihatPertanyaan,
        ]);
    }
    public function kuesionerKegiatanPertanyaanEdit(Request $request) {
        $tambah = new Tambahan();
        $id = $request->idPertanyaan;
        // dd($id);
        if ($request->idPertanyaan != null) {
            $data =['pertanyaan'=>$request->pertanyaan];
            $tambah->UpdateKuesionerKegiatanPertanyaan($id,$data);
            return redirect()->back()->with('success','Data Berhasil Di Edit');

        }else{
            abort(403);
        }
    }
    public function kuesionerPerkuliahanPertanyaanEdit(Request $request) {
        $pertanyaanId = $request->idPertanyaan;
        $jenisPertanyaanId = $request->idJenisPertanyaan;
        $kelompokPertanyaanId = $request->idKelompokPertanyaan;
        $pertanyaan = $request->pertanyaan;
        if ($request->idPertanyaan != null) {
            // dd('masuk');
           $result =  $this->service->editPertanyaan($pertanyaanId,$kelompokPertanyaanId,$jenisPertanyaanId,$pertanyaan);
            return redirect()->route('showPertanyaan');

        }else{
            abort(403);
        }
    }

    public function kuesionerKegiatanChartView() {

        $tahun = Kegiatan::groupBy('tahun')->get('tahun');
        $kegiatan = Kegiatan::all();

        // dd($kegiatan);

        return view('dashboard.admin.c_kegiatan', [
            'title' => 'Kuesioner Kegiatan',
            'tahun' => $tahun,
            'kegiatan' =>$kegiatan
        ]);
    }

    public function GraphChartKegiatanByTahun($tahun)
    {
        $data = Kegiatan::where('tahun',$tahun)->get(['id','kegiatan','penyelenggara','kd_acara']);
        $pilihan = PilihanJawaban::all();
        $datajawabanSS = Jawaban::where('kegiatan_id',$data[0]->id)->get();
        // dd($datajawabanSS);
        $isiData = [];
        $lebel =[];
        $datajawabanSS=[];
        $kegiatan=[];
        $kdAcara=[];

        foreach ($data as $key => $value) {
            $datajawabanSS = Jawaban::where('kegiatan_id',$value->id)->get()->groupBy('nama_responden')->count();
            $jawaban [] = $datajawabanSS;
            $isiData[] =$value->kegiatan;
            $lebel[]=$value->penyelenggara;
            $kegiatan[]=$value->kegiatan;
            $kdAcara[]=$value->kd_acara;
        };
        // dd($kegiatan);
        return [
            'status'=> 'success',
            'acara' => $isiData ,
            'penye' => $lebel,
            'jawaban' =>$jawaban,
            'kegiatan' => $kegiatan,
            'kd_acara' => $kdAcara,
            'pilihanJawaban' => $pilihan
        ];
    }

    // public function GraphChartKegiatanByTahun($tahun)
    // {
    //     $data = Kegiatan::where('tahun', $tahun)->get(['id', 'kegiatan', 'penyelenggara', 'kd_acara']);
    //     $kegiatan = [];
    //     $lebel = [];
    //     $kdAcara = [];
    //     $pieChartData = [];
    //     $barChartData = [];

    //     foreach ($data as $value) {
    //         $kegiatan[] = $value->kegiatan;
    //         $lebel[] = $value->penyelenggara;
    //         $kdAcara[] = $value->kd_acara;

    //         $dataJawaban = DB::table('tb_jawaban')
    //         ->where('kegiatan_id', $value->id)
    //         ->join('tb_pertanyaan', 'tb_pertanyaan.id', '=', 'tb_jawaban.pertanyaan_id')
    //         ->join('tb_pilihan', 'tb_pilihan.kd_point', '=', 'tb_jawaban.jawaban')
    //         ->select('tb_pertanyaan.pertanyaan', 'tb_jawaban.jawaban', 'tb_jawaban.pertanyaan_id')
    //         ->get()
    //         ->groupBy('pertanyaan_id');

    //         foreach ($dataJawaban as $pertanyaanId => $jawaban) {
    //             $pertanyaan = $jawaban->first()->pertanyaan;
    //             $counts = $jawaban->groupBy('jawaban')->map->count();
    //             $pieChartData[$value->kegiatan][$pertanyaanId] = [
    //                 'pertanyaan' => $pertanyaan,
    //                 'labels' => $counts->keys()->all(),
    //                 'data' => $counts->values()->all(),
    //             ];
    //         }

    //         $barChartData[] = DB::table('tb_jawaban')
    //             ->where('kegiatan_id', 2)
    //             ->get()
    //             ->groupBy('nama_responden')
    //             ->count();
    //     }

    //     return [
    //         'status' => 'success',
    //         'kegiatan' => $kegiatan,
    //         'penye' => $lebel,
    //         'kd_acara' => $kdAcara,
    //         'pieChartData' => $pieChartData,
    //         'barChartData' => $barChartData,
    //     ];
    // }


    public function export($idKegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($idKegiatan);

        // Ambil semua data responden dari tabel Jawaban berdasarkan idKegiatan
        $respondenKegiatan = Jawaban::where('kegiatan_id', $idKegiatan)
            ->get()
            ->unique('nama_responden');

        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan data ke worksheet
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tahun');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Tanggal Acara');
        $sheet->setCellValue('E1', 'Penyelenggara');
        $sheet->setCellValue('F1', 'Kegiatan');

        // Gaya untuk header
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFF00', // Background color
                ],
            ],
        ];

        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Mulai dari baris kedua
        $row = 2;

        // Gaya untuk sel
        $cellStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        foreach ($respondenKegiatan as $responden) {
            $sheet->setCellValue('A' . $row, $kegiatan->id);
            $sheet->setCellValue('B' . $row, $kegiatan->tahun);
            $sheet->setCellValue('C' . $row, $responden->nama_responden);
            $sheet->setCellValue('D' . $row, $kegiatan->dari_tgl . ' - ' . $kegiatan->sampai_tgl);
            $sheet->setCellValue('E' . $row, $kegiatan->penyelenggara);
            $sheet->setCellValue('F' . $row, $kegiatan->kegiatan);

            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($cellStyle);

            // Increment baris
            $row++;
        }

        // Mengatur judul file dan format
        $filename = 'kegiatan.xlsx';

        // Mengatur header untuk file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Menggunakan Writer untuk menyimpan file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // Hentikan eksekusi kode setelah menyimpan file
        exit();
    }
}

