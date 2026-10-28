<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
include APPPATH . 'controllers/construct.php';

class Main extends Construct
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $data = array(
            'view' => 'form_home',
            'assets' => $this->template->getMetadata()
        );
        
        go('index', $data);
    }
    function pasien()
    {
        //connect to database
        $db = dbase_open("E:\BACKUP\DATA\DAFTAR\psnbaru.dbf", 2);

        $found = false;
        // get every record 
        $limit = 10;
        if(!empty(segment(3)))
        {
            $offset = segment(3);
        }
        else
        {
            $offset = 1;
        }
        $per_page = 5;
        $count = $offset+$per_page;
        if($count < dbase_numrecords($db))
        {
            $count = $count;
        }
        else
        {
            $count = dbase_numrecords($db);
        }

        for($i = $offset; $i < $count; $i++)
        {
            if($count <= dbase_numrecords($db))
            {
                $record = dbase_get_record_with_names($db, $i);

                $no_reg = $record["NO_REG"];
                $nama = $record["NAMA"];
                $alamat = $record["ALAMAT"];
                $kd_daerah = $record["KD_DAERAH"];
                $telp = $record["TELP"];
                $telp2 = $record["TELP2"];
                $no_id = $record["NO_ID"];
                $ktp = $record["KTP"];
                $jenis_kel = $record["JENIS_KEL"];
                $pekerjaan = $record["PEKERJAAN"];
                $agama = $record["AGAMA"];
                $kawin = $record["KAWIN"];
                $didik = $record["DIDIK"];
                $tgl_lahir = $record["TGL_LAHIR"];
                $umur = $record["UMUR"];
                $gol_darah = $record["GOL_DARAH"];
                $tgl_masuk = $record["TGL_MASUK"];
                $jam_masuk = $record["JAM_MASUK"];
                $tgl_ri = $record["TGL_RI"];
                $jam_ri = $record["JAM_RI"];
                $kd_poli = $record["KD_POLI"];
                $kd_dr = $record["KD_DR"];
                $kd_dr_ri1 = $record["KD_DR_RI1"];
                $kd_dr_ri2 = $record["KD_DR_RI2"];
                $rawat = $record["RAWAT"];
                $kelas = $record["KELAS"];
                $bangsal = $record["BANGSAL"];
                $no_bed = $record["NO_BED"];
                $rujuk = $record["RUJUK"];
                $pasien = $record["PASIEN"];
                $inapke = $record["INAPKE"];
                $pulang = $record["PULANG"];
                $tgl_keluar = $record["TGL_KELUAR"];
                $jam_ri = $record["JAM_RI"];
                $jam_keluar = $record["JAM_KELUAR"];
                $keadaanplg = $record["KEADAANPLG"];
                $statusplg = $record["STATUSPLG"];
                $no_kp = $record["NO_KP"];
                $pisa = $record["PISA"];
                $kodebu = $record["KODEBU"];

                $d = substr($tgl_masuk, 6, 2);
                $m = substr($tgl_masuk, 4, 2);
                $y = substr($tgl_masuk, 0, 4);
                $content[] = array(
                    'no_reg' => $no_reg,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'telp' => $telp,
                    'tgl_masuk' => $d."-".$m."-".$y,
                );
            }
        }

        $config['base_url'] = URL.'main/pasien/';
        $config['total_rows'] = dbase_numrecords($db);
        $config['per_page'] = $per_page;
        //pagination customization using bootstrap styles
        $config['full_tag_open'] = '<div class=""><ul class="pagination">'; // I added class name 'page_test' to used later for jQuery
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data = array(
            'content' => $content,
            'view' => 'form_pasien',
            'pages' => $this->pagination->create_links(),
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function dokter()
    {
        //connect to database
        $db = dbase_open("E:\BACKUP\DATA\DAFTAR\dokter.dbf", 2);

        $found = false;
        // get every record 
        $limit = 10;
        if(!empty(segment(3)))
        {
            $offset = segment(3);
        }
        else
        {
            $offset = 1;
        }
        $per_page = 5;
        $count = $offset+$per_page;
        if($count < dbase_numrecords($db))
        {
            $count = $count;
        }
        else
        {
            $count = dbase_numrecords($db);
        }

        for($i = $offset; $i < $count; $i++)
        {
            if($count <= dbase_numrecords($db))
            {
                $record = dbase_get_record_with_names($db, $i);

                $no_dr = $record["NO_DR"];
                $nama = $record["NAMA"];
                $nama2 = $record["NAMA2"];
                $kode_nama = $record["KODE_NAMA"];
                $bagian = $record["BAGIAN"];
                $alamat = $record["ALAMAT"];
                $tgl_masuk = $record["TGL_MASUK"];
                $j_pasien = $record["J_PASIEN"];
                $infaq = $record["INFAQ"];
                $sps = $record["SPS"];
                $zakat = $record["ZAKAT"];
                $jasa = $record["JASA"];
                $ps_zakat = $record["PS_ZAKAT"];
                $ps_infaq = $record["PS_INFAQ"];
                $kemitraan = $record["KEMITRAAN"];
                $pajak = $record["PAJAK"];
                $lain2 = $record["LAIN2"];
                $ps_pajak = $record["PS_PAJAK"];
                $ps_kemitra = $record["PS_KEMITRA"];
                $ps_lain2 = $record["PS_LAIN2"];
                $bahan = $record["BAHAN"];

                $content[] = array(
                    'no_dr' => $no_dr,
                    'nama' => $nama,
                );
            }
        }

        $config['base_url'] = URL.'main/pasien/';
        $config['total_rows'] = dbase_numrecords($db);
        $config['per_page'] = $per_page;
        //pagination customization using bootstrap styles
        $config['full_tag_open'] = '<div class=""><ul class="pagination">'; // I added class name 'page_test' to used later for jQuery
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data = array(
            'content' => $content,
            'view' => 'form_dokter',
            'pages' => $this->pagination->create_links(),
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function diagnosa()
    {
        //connect to database
        $db = dbase_open("E:\BACKUP\DATA\DAFTAR\diagnosa.dbf", 2);

        $found = false;
        // get every record 
        $limit = 5;
        $offset = 1;
        for($i = $offset; $i <= $limit; $i++)
        {
            $record = dbase_get_record_with_names($db, $i);

            $kode = $record["KODE"];
            $nama = $record["NAMA"];

            $content[] = array(
                'kode' => $kode,
                'nama' => $nama,
            );
        }
        $data = array(
            'content' => $content,
            'view' => 'form_diagnosa',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function icd()
    {
        //connect to database
        $db = dbase_open("E:\BACKUP\DATA\MEDICAL\DIAGNOSA.dbf", 2);

        $found = false;
        // get every record 
        $limit = 5;
        $offset = 1;
        for($i = $offset; $i <= $limit; $i++)
        {
            $record = dbase_get_record_with_names($db, $i);

            $dtd = $record["DTD"];
            $icd = $record["ICD"];
            $deskripsi = $record["DESKRIPSI"];
            $nmdg = $record["NMDG"];

            $content[] = array(
                'dtd' => $dtd,
                'icd' => $icd,
                'deskripsi' => $deskripsi,
                'nmdg' => $nmdg,
            );
        }
        $data = array(
            'content' => $content,
            'view' => 'form_icd',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function askeprj()
    {
        $data = array(
            'view' => 'form_askep',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function rmrajal()
    {
        $data = array(
            'view' => 'form_rmrajal',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function mro()
    {
        $data = array(
            'view' => 'form_medical',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function resmeranap()
    {
        $data = array(
            'view' => 'form_resmeranap',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
}
