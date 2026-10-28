<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Apm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'header' => true,
            'view'   => 'form_home',
            'assets' => $this->template->getMetadata(),
        );
        echo json_encode($data); die();
        go('index', $data);
    }

    public function eksekutif()
    {
        header('Access-Control-Allow-Origin: *');
        $kd_poli = null; 
        $kd_dokter = null; 
        $klinik = segment(4);
        $kd_dokter = segment(5); 
        
        $view = 'form_apm_eksekutif';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
        $this->template->useAsset()->setJs('admisi', array($view, 'jquery.mb.YTPlayer.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
        $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS('admisi', array('jquery.mb.YTPlayer.min'));
        $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');

        $data = array(
            'view'            => $view,
            'assets'          => $this->template->getMetadata(),
        );
        go('index_apm', $data);
    }
    public function cek_norm() {
        $no_reg = $this->input->post('no_reg'); 
        $no_reg = substr('0000000'.$no_reg, -7); 
        $this->load->model('Pasien'); 
        $pasien = Pasien::find($no_reg); 
        if (!empty($pasien)) {
            $pasien->tgl_lahir = date("d/m/y", strtotime($pasien->tgl_lahir)); 
        }
        // var_dump($pasien); die();
        echo json_encode($pasien); die();
    }
    public function cek_jadwal_dokter() {
        $this->load->helper('tampiltanggal'); 
        $this->load->model('Jadwal'); 
        $no_reg = $this->input->post('no_reg'); 
        $no_reg = substr('0000000'.$no_reg, -7); 
        $this->load->model('Pasien'); 
        $today = date("Y-m-d"); 
        $page = segment(4);
        $hari_ini = str_replace("'", "", get_day_name($today));
        $query = "  SELECT 
                    a.id,
                    b.nama_poli, 
                    b.kode_poli, 
                    c.nama2 AS nama_dokter,
                    c.no_dr AS kode_dokter, 
                    LEFT(a.awal, 5) AS awal, 
                    LEFT(a.akhir, 5) AS akhir 
                    FROM
                        pendaftaran.jadwal a 
                        LEFT JOIN rsiklaten.poli b 
                            ON a.kd_poli = b.kode_poli 
                        LEFT JOIN rsiklaten.dokter c 
                            ON a.kd_dr = c.no_dr 
                    WHERE 
                        a.deleted IS NULL
                        AND a.hari = '$hari_ini' 
                        AND a.akhir > CURRENT_TIME
                    ORDER BY 
                        TIME(awal) ASC 
                    "; 
        $rows_dokter = DB::select($query); 
        echo json_encode($rows_dokter); die();
    }

    public function cek_kuota_dokter() {
        $no_reg = $this->input->post('no_reg'); 
        $id_jadwal = $this->input->post('jadwal'); 
        $no_reg = substr('0000000'.$no_reg, -7); 
        $this->load->model('Pasien'); 
        $data = Pasien::find($no_reg); 
        if (!empty($data)) {
            $data->tgl_lahir = date("d/m/y", strtotime($data->tgl_lahir)); 
            $query = "  SELECT 
                    a.id,
                    b.nama_poli, 
                    b.kode_poli, 
                    c.nama2 AS nama_dokter,
                    c.no_dr AS kode_dokter, 
                    LEFT(a.awal, 5) AS awal, 
                    LEFT(a.akhir, 5) AS akhir 
                    FROM
                        pendaftaran.jadwal a 
                        LEFT JOIN rsiklaten.poli b 
                            ON a.kd_poli = b.kode_poli 
                        LEFT JOIN rsiklaten.dokter c 
                            ON a.kd_dr = c.no_dr 
                    WHERE 
                        a.deleted IS NULL
                        AND a.id = $id_jadwal 
                    "; 
            $row_jadwal = null; 
            $rows_jadwal = DB::select($query);
            $data->dokter = ""; 
            $data->praktek = "";  
            if (!empty($rows_jadwal)) {
                foreach ($rows_jadwal as $row_jadwal) {
                    $row_jadwal = (object) $row_jadwal;
                }
                $data->dokter = $row_jadwal->nama_dokter;
                $data->praktek = $row_jadwal->nama_poli." (".$row_jadwal->awal."-".$row_jadwal->akhir.")";
            }
        }
        echo json_encode($data); die();
    }

    public function simpan_pendaftaran() {
        $no_reg = $this->input->post('no_reg'); 
        $id_jadwal = $this->input->post('jadwal'); 
        $kd_asuransi = $this->input->post('kd_asuransi'); 
        $tgl_masuk = date("Y-m-d"); 
        $no_reg = substr('0000000'.$no_reg, -7); 
        $this->load->model('Pasien'); 
        $this->load->model('Kunjung'); 
        $this->load->model('Antri');
        /* ambil jadwal dulu */
        $query = "  SELECT 
                    a.id,
                    b.nama_poli, 
                    b.kode_poli, 
                    c.nama2 AS nama_dokter,
                    c.no_dr AS kode_dokter, 
                    LEFT(a.awal, 5) AS awal, 
                    LEFT(a.akhir, 5) AS akhir 
                    FROM
                        pendaftaran.jadwal a 
                        LEFT JOIN rsiklaten.poli b 
                            ON a.kd_poli = b.kode_poli 
                        LEFT JOIN rsiklaten.dokter c 
                            ON a.kd_dr = c.no_dr 
                    WHERE 
                        a.deleted IS NULL
                        AND a.id = $id_jadwal 
                    "; 
        $row_jadwal = null; 
        $rows_jadwal = DB::select($query);
        if (!empty($rows_jadwal)) {
            foreach ($rows_jadwal as $row_jadwal) {
                $row_jadwal = (object) $row_jadwal;
            }
        }
        
        /* 
        cek apakah sudah terdaftar atau belum 
        kalau belum daftarkan, kalau sudah disimpan dbf nya saja
        */ 
        $row_kunjung = Kunjung::where('no_reg', $no_reg)
                        ->where('tanggal', $tgl_masuk)
                        ->where('kd_poli', $row_jadwal->kode_poli)
                        ->where('kd_dr', $row_jadwal->kode_dokter)
                        ->where('deletedstate', 0)
                        ->leftJoin('rsiklaten.dokter', function ($join) {
                                $join->on('kd_dr', '=', 'rsiklaten.dokter.no_dr');
                            })
                        ->leftJoin('rsiklaten.poli', function ($join) {
                                $join->on('kd_poli', '=', 'rsiklaten.poli.kode_poli');
                            })
                        ->leftJoin('rsiklaten.asuransi', function ($join) {
                                $join->on('pasien', '=', 'rsiklaten.asuransi.no_rel');
                            })
                        ->first(array(
                            'kunjung.no_reg', 
                            'kunjung.tanggal', 
                            'kunjung.jam', 
                            'kunjung.umur', 
                            'kunjung.pasien', 
                            'asuransi.nama', 
                            'kunjung.kd_poli', 
                            'poli.nama_poli', 
                            'kunjung.kd_dr', 
                            'dokter.nama2', 
                            'kunjung.antrian'
                        ));
        $pasien = Pasien::find($no_reg); 
        
        $data = array(
            "status" => false, 
            "message" => "Data tidak tersimpan"
        ); 

        if (empty($row_kunjung)) {
            // die('kosong maka harus diisi');
            /* proses simpan disini */


            $detil = array(
                "no_reg" => $pasien->no_reg, 
                "nama" => $pasien->nama, 
                "alamat" => $pasien->alamat, 
                "tgl_lahir" => $pasien->tgl_lahir, 
                "umur" => $pasien->umur, 
                "nik" => $pasien->no_id, 
                "antrian" => $row_kunjung->antrian, 
                "kode_poli" => $row_kunjung->kd_poli, 
                "nama_poli" => $row_kunjung->nama_poli, 
                "kode_dokter" => $row_kunjung->kd_dr, 
                "nama_dokter" => $row_kunjung->nama2, 
                "tgl_daftar" => $row_kunjung->tanggal." ".$row_kunjung->jam,
                "kode_asuransi" => $row_kunjung->pasien, 
                "nama_asuransi" => $row_kunjung->nama
            ); 
            $data = array(
                "status" => true, 
                "data" => $data,
                "message" => "Data tersimpan"
            ); 
        } else {
            $detil = array(
                "no_reg" => $pasien->no_reg, 
                "nama" => $pasien->nama, 
                "alamat" => $pasien->alamat, 
                "tgl_lahir" => $pasien->tgl_lahir, 
                "umur" => $pasien->umur, 
                "nik" => $pasien->no_id, 
                "antrian" => $row_kunjung->antrian, 
                "kode_poli" => $row_kunjung->kd_poli, 
                "nama_poli" => $row_kunjung->nama_poli, 
                "kode_dokter" => $row_kunjung->kd_dr, 
                "nama_dokter" => $row_kunjung->nama2, 
                "tgl_daftar" => $row_kunjung->tanggal." ".$row_kunjung->jam,
                "kode_asuransi" => $row_kunjung->pasien, 
                "nama_asuransi" => $row_kunjung->nama
            ); 
            $data = array(
                "status" => true, 
                "data" => $detil,
                "message" => "Data tersimpan"
            ); 
        }
        echo json_encode($data); die();
    }

    public function pilih_asuransi() {
        $this->load->helper('tampiltanggal'); 
        $this->load->model('Asuransi'); 
        $no_reg = $this->input->post('no_reg'); 
        $no_reg = substr('0000000'.$no_reg, -7); 
        $this->load->model('Pasien'); 
        $today = date("Y-m-d"); 
        $page = segment(4);
        $hari_ini = str_replace("'", "", get_day_name($today));
        $query = "  SELECT 
                        c.NO_REL as kode, c.NAMA as nama
                    FROM 
                        rsiklaten.kunjung a
                        LEFT JOIN rsiklaten.poli b 
                            ON a.kd_poli = b.kode_poli
                            AND a.tanggal > DATE_ADD(CURRENT_DATE, INTERVAL -3 MONTH) 
                        LEFT JOIN rsiklaten.asuransi c 
                            ON a.pasien = c.NO_REL
                    WHERE 
                        b.report_nama = 'EKSEKUTIF'
                    GROUP BY 
                        c.NAMA
                    ORDER BY FIELD(c.NO_REL, '000', '001') DESC, c.NAMA ASC
                "; 
        $query = "  SELECT 
                        c.NO_REL as kode, c.NAMA as nama
                    FROM 
                        rsiklaten.asuransi c 
                    WHERE 
                        c.NO_REL IN ('001')
                ";
        $rows_asuransi = DB::select($query); 
        echo json_encode($rows_asuransi); die();
    }
}
