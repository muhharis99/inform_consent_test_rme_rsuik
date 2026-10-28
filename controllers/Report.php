<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_log');
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->sessid;
        }
        else
        {
            $sessid = session_id();
        }
        $user_log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'))->first();
        //if (sess_on($id) && sess_on($id)->date == date('Y-m-d')) {
        if (count($user_log) > 0)
        {
            if($user_log->user_id) {
                if (in_array(segments(), array('signin'))) {
                    redirect(SUBDOM, 'refresh');
                }
            }
            else {
                if (!in_array(segments(), array('signin', 'reset', 'auth_on', 'auth_status', 'coba'))) {
                    redirect(SUBDOM . 'main/signin', 'refresh');
                }
            }
            //$this->load->model('poli_antrian');
        } else {
            if (!in_array(segments(), array('signin', 'reset', 'auth_on', 'auth_status', 'coba'))) {
                redirect(SUBDOM . 'main/signin', 'refresh');
            }
        }
    }
    public function akses()
    {
        $this->load->model('dokter');
        $this->load->model('karyawan');

        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $user = $sess->user;
        }

        $nama = '';
        $karyawan = Karyawan::find($user);
        if(count($karyawan) > 0)
        {
            $nama = $karyawan->nama;
        }
        else
        {
            $dokter = Dokter::find($user);
            if(count($dokter) > 0)
            {
                $nama = $dokter->nama2;
            }
        }

        return $nama;
    }
    public function kode_akses()
    {
        $this->load->model('bangsal');
        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');

        $sessid = '';
        $akses = '';
        $induk = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
        }

        $kd = array();
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $sessid)->first($field);
        if(count($karya) > 0)
        {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
                $bangsal = Bangsal::where('induk', $induk)->get();
                if(count($bangsal) > 0)
                {
                    $akses = 'bangsal';
                    foreach ($bangsal as $all) {
                        $kd[] = $all->kd_bangsal;
                    }
                }
                else
                {
                    if($induk == 'PDF')
                    {
                        $akses = 'pendaftaran';
                    }
                    elseif($induk == 'ASR')
                    {
                        $akses = 'asuransi';
                    }
                    elseif($induk == 'EDP')
                    {
                        $akses = 'edp';
                    }
                    elseif($induk == 'RDG')
                    {
                        $akses = 'ro';
                    }
                    elseif($induk == 'LAB')
                    {
                        $akses = 'lab';
                    }
                    elseif($induk == 'GZI')
                    {
                        $akses = 'gizi';
                    }
                    elseif($induk == 'RMD')
                    {
                        $akses = 'rm';
                    }
                    elseif($induk == 'RHN')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'SPM')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'PLY')
                    {
                        $akses = 'poli';
                    }
                    elseif($induk == 'FIS')
                    {
                        $akses = 'poli';
                    }
                    elseif($induk == 'FRM')
                    {
                        $akses = 'farmasi';
                    }
                    elseif($induk == 'UGD')
                    {
                        $akses = 'ugd';
                    }
                }
            }
        }
        else
        {
            $dokter = Dokter::find($sessid);
            if(count($dokter) > 0)
            {
                $akses = 'poli';
                $induk = 'PLY';
            }
        }

        return $induk;
    }
    public function absen_dokter()
    {
        $view = 'report_absen_dokter';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }

        go('index', $data);
    }
    function coba()
    {
        echo CI_VERSION;
    }
    function dny($pure_string, $encryption_key = null) {
        $output = false;
        /*
         * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
         */
        //date_default_timezone_set('UTC');
        $tStamp = strtotime(date('Y-m-d'));
        if(!is_null($encryption_key))
        {
            $tStamp = $encryption_key;
        }
        $signature = strval($tStamp-strtotime('1970-01-01 00:00:00'));
        //$signature = preg_replace("/[^a-zA-Z0-9]+/", "", $signature);

        $security = parse_ini_file(APPPATH.'security.ini');
        $secret_key = $security['encryption_key'];
        $secret_iv = $tStamp;
        if(is_null($encryption_key))
        {
            $secret_iv = $security['iv'];
        }
        $encrypt_method = $security['encryption_mechanism'];

        // hash

        $keys = hash('sha256', $secret_key);
        // Computes the signature by hashing the salt with the secret key as the key
        //$key = hash_hmac('sha256', $id."&".$tStamp, $secret_key, true);
        // base64 encode…
        //$key = base64_encode($key);

        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning

        $iv = substr(hash('sha256', $signature.$secret_iv), 0, 16);
        $encrypted_string = hash('sha256', $pure_string.$signature);

        if(!is_null($pure_string))
        {
            $encrypted_string = (object)array(
                'epassword' => $encrypted_string,
                'signature' => $tStamp,
            );
        }
        return $encrypted_string;
    }
    function ayp($encrypted_string, $encryption_key = null) {
        $output = false;
        /*
         * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
         */
        //date_default_timezone_set('UTC');
        $tStamp = strtotime(date('Y-m-d'));
        if(!is_null($encryption_key))
        {
            $tStamp = $encryption_key;
        }
        $signature = strval($tStamp-strtotime('1970-01-01 00:00:00'));
        //$signature = preg_replace("/[^a-zA-Z0-9]+/", "", $signature);

        $security = parse_ini_file(APPPATH.'security.ini');
        $secret_key = $security['encryption_key'];
        $secret_iv = $tStamp;
        if(is_null($encryption_key))
        {
            $secret_iv = $security['iv'];
        }
        $encrypt_method = $security['encryption_mechanism'];

        // hash

        $keys = hash('sha256', $encrypted_string);
        // Computes the signature by hashing the salt with the secret key as the key
        //$key = hash_hmac('sha256', $id."&".$tStamp, $secret_key, true);
        // base64 encode…
        //$key = base64_encode($key);

        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning

        $iv = substr(hash('sha256', $signature.$secret_iv), 0, 16);
        echo $encryption_key;
        //do the decryption given text/string/number
        $output = openssl_decrypt(base64_decode($encrypted_string), $encrypt_method, $keys, 0, $iv);

        //$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        //$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }
    public function rawat_jalan()
    {
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $view = 'report_rawat_jalan';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }

    public function spm_fisioterapi()
    {
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $view = 'report_spm_fisioterapi';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function spm_jantung()
    {
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $view = 'report_spm_jantung';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }

    public function spm_hemodialisa()
    {
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $view = 'report_spm_hemodialisa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }

    public function spm_igd()
    {
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $view = 'report_spm_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }

    public function printer()
    {
        $this->load->model('printer');

        $view = 'form_printer';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $printer = Printer::orderBy('nama', 'asc')->get();
        $data    = array(
            'view'    => $view,
            'akses' => self::akses(),
            'printer' => $printer,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function page_printer()
    {
        $this->load->model('poli');

        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $datas  = array();
        $poli   = Poli::whereRaw("CONCAT(nama_poli) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
        if (count($poli) > 0) {
            foreach ($poli as $all) {
                # code...
                $kode_poli = $all->kode_poli;
                $nama_poli = $all->nama_poli;
                $pfarm     = $all->printer_farm;
                $pfarmgd     = $all->printer_farmgd;
                $plab      = $all->printer_lab;
                $pro       = $all->printer_ro;
                $psoap     = $all->printer_soap;
                $aktif     = $all->show;

                $datas[] = array(
                    'kode_poli'    => $kode_poli,
                    'nama_poli'    => $nama_poli,
                    'printer_farm' => $pfarm,
                    'printer_farmgd' => $pfarmgd,
                    'printer_lab'  => $plab,
                    'printer_ro'   => $pro,
                    'printer_soap' => $psoap,
                    'aktif' => $aktif,
                );
            }
        }

        $poli = Poli::whereRaw("CONCAT(nama_poli) like '%$search%'")->count();

        $data = array(
            "total" => $poli,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function obat()
    {
        $akses = self::akses_menu();
        $direksi = $akses->direksi;

        $view = 'form_obat';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min'));
        $data = array(
            'view'   => $view,
            'direksi' => $direksi,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function antibiotik()
    {
        $view = 'form_antibiotik';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min'));
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function penunjang()
    {
        $view = 'report_penunjang';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min'));
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function surat()
    {
        $this->load->model('poli');
        
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $unit = Poli::whereIn('kode_poli', array('L001', 'R001'))->get(array('kode_poli', 'nama_poli'));

        $view = 'report_surat';
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'socket.io'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min'));
        $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $data = array(
            'view'   => $view,
            'induk' => $induk,
            'unit' => $unit,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function anatomy()
    {
        $template = IMG.'anatomy/body_front.png';
        $mark = './assets/rme/img/anatomy/0000001/0000001_1_20170109.png';
        $imgs = anatomy($template, $mark);
        $anatomy1 = "<img src='data:image/png;base64,$imgs'/>";
        $bs = base64_encode(file_get_contents($mark));
        echo "<img src='data:image/png;base64,$bs'/>";
        echo $anatomy1;
    }
    public function page_obat()
    {
        $this->load->model('obat');

        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $datas  = array();
        $obat   = Obat::whereRaw("CONCAT(KODE_STOK,NAMA_BRG) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
        if (count($obat) > 0) {
            foreach ($obat as $all) {
                # code...
                $kode  = $all->KODE_STOK;
                $nama  = $all->NAMA_BRG;
                $jenis = $all->JENIS;
                $psrm  = $all->PSRM;
                $sbw   = $all->SBW;
                $harga_jual   = $all->HRG_JUAL;

                $datas[] = array(
                    'kode_stok' => $kode,
                    'nama_brg'  => $nama,
                    'jenis'     => $jenis,
                    'psrm'      => $psrm,
                    'sbw'       => $sbw,
                    'harga_jual'       => $harga_jual,
                );
            }
        }

        $obat = Obat::whereRaw("CONCAT(KODE_STOK,NAMA_BRG) like '%$search%'")->count();

        $data = array(
            "total" => $obat,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_antibiotik()
    {
        $this->load->model('antibiotik');

        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $datas  = array();
        $antibiotik   = Antibiotik::whereRaw("CONCAT(nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
        if (count($antibiotik) > 0) {
            foreach ($antibiotik as $all) {
                # code...
                $id  = $all->id;
                $nama  = $all->nama;
                $status = $all->status;

                $datas[] = array(
                    'id' => $id,
                    'nama'  => $nama,
                    'status'     => $status,
                );
            }
        }

        $antibiotik = Antibiotik::whereRaw("CONCAT(nama) like '%$search%'")->count();

        $data = array(
            "total" => $antibiotik,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function capture_resep()
    {
        $this->load->model('dokter');

        $dokter = Dokter::all();
        $view   = 'report_capture_resep';
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'dokter' => $dokter,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function dokter()
    {
        $this->load->model('poli');
        $this->load->model('dokter');

        $view = 'form_dokter';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $dokter = Dokter::all();
        $poli   = Poli::all();
        $data   = array(
            'view'   => $view,
            'dokter' => $dokter,
            'poli'   => $poli,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function perawat()
    {
        $this->load->model('perawat');

        $view = 'form_perawat';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $perawat = Perawat::all();
        $data   = array(
            'view'   => $view,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'perawat' => $perawat,
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function page_perawat()
    {
        $this->load->model('perawat');

        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $datas  = array();
        $field  = array('id', 'nama', 'ttd', 'poli_id', 'status');
        $perawat = Perawat::whereRaw("CONCAT(nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
        if (count($perawat) > 0) {
            foreach ($perawat as $all) {
                # code...
                $id     = $all->id;
                $nama      = $all->nama;
                $ttd      = $all->ttd;
                $poli      = $all->poli_id;
                $status      = $all->status;

                $datas[] = array(
                    'id'     => $id,
                    'nama'      => $nama,
                    'ttd'      => $ttd,
                    'poli'      => $poli,
                    'status'      => $status,
                );
            }
        }

        $perawat = Perawat::whereRaw("CONCAT(nama) like '%$search%'")->count();

        $data = array(
            "total" => $perawat,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_dokter()
    {
        $this->load->model('dokter');
        $this->load->model('dokter_poli');

        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $datas  = array();
        $field  = array('no_dr', 'nama', 'nama2', 'kode_nama', 'ttd', 'sps_id');
        $dokter = Dokter::with(array('dokter_poli' => function ($q) {
            $q->get(array('kd_dokter', 'kd_poli'));
        }))->whereRaw("CONCAT(no_dr,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
        if (count($dokter) > 0) {
            foreach ($dokter as $all) {
                # code...
                $poli = array();
                $no_dr     = $all->no_dr;
                $nama      = $all->nama;
                $nama2     = $all->nama2;
                $kode_nama = $all->kode_nama;
                $smf       = $all->sps_id;
                $ttd       = $all->ttd;
                $polis     = $all->dokter_poli;
                if (count($polis) > 0) {
                    foreach ($polis as $all) {
                        # code...
                        $poli[] = $all->kd_poli;
                    }
                } else {
                    $poli = array();
                }

                $datas[] = array(
                    'no_dr'     => $no_dr,
                    'nama'      => $nama,
                    'nama2'     => $nama2,
                    'kode_nama' => $kode_nama,
                    'ttd'       => $ttd,
                    'poli'      => $poli,
                    'smf'      => $smf,
                );
            }
        }

        $dokter = Dokter::with(array('dokter_poli' => function ($q) {
            $q->get(array('kd_dokter', 'kd_poli'));
        }))->whereRaw("CONCAT(no_dr,nama) like '%$search%'")->count();

        $data = array(
            "total" => $dokter,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_surat()
    {
        $dokter = $this->load->model('dokter');

        $search = $this->input->get('search');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $no_reg = $this->input->get('no_reg');
        $jenis = $this->input->get('jenis');

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;

        $file = '';
        $surat = array();
        if($jenis == 1)
        {
            $this->load->model('surat_kontrol');
            $surat = Surat_Kontrol::select('*')->from(DB::raw("(select * from surat_kontrol where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'kontrol';
        }
        elseif($jenis == 2)
        {
            $this->load->model('surat_rujuk_bpjs');
            $surat = Surat_Rujuk_BPJS::select('*')->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'rujuk_bpjs';
        }
        elseif($jenis == 3)
        {
            $this->load->model('surat_rujuk');
            $surat = Surat_Rujuk::select('*')->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('printed', 'desc')->get();
            $file = 'rujuk';
        }
        elseif($jenis == 4)
        {
            $this->load->model('surat_sehat');
            $surat = Surat_Sehat::select('*')->from(DB::raw("(select * from surat_sehat where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'sehat';
        }
        elseif($jenis == 5)
        {
            $this->load->model('surat_istirahat');
            $surat = Surat_Istirahat::select('*')->from(DB::raw("(select * from surat_istirahat where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'istirahat';
        }
        elseif($jenis == 6)
        {
            $this->load->model('surat_butawarna');
            $surat = Surat_Butawarna::select('*')->from(DB::raw("(select * from surat_butawarna where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'buta_warna';
        }
        elseif($jenis == 7)
        {
            $this->load->model('surat_fisioterapi');
            $surat = Surat_Fisioterapi::select('*')->from(DB::raw("(select * from surat_fisioterapi where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'fisioterapi';
        }
        elseif($jenis == 8)
        {
            $this->load->model('surat_mondok');
            $surat = Surat_Mondok::select('*')->from(DB::raw("(select * from surat_mondok where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'mondok';
        }
        elseif($jenis == 9)
        {
            $this->load->model('ro_pengantar');
            $field = array('id', 'no_reg', 'no_dr as dokter_id', 'tanggal', 'registered');
            $surat   = RO_Pengantar::where('no_reg', $no_reg)->take($take)->offset($offset)->orderBy('id', 'desc')->get($field);
            $file = 'ro';
        }
        elseif($jenis == 10)
        {
            $this->load->model('lab_order');
            $field = array('id', 'no_reg', 'kd_dr as dokter_id', 'tanggal', 'registered');
            $surat   = Lab_Order::where('no_reg', $no_reg)->whereRaw("registered = (select max(b.registered) from lab_order b where b.no_reg = '$no_reg' and b.tanggal = lab_order.tanggal)")->take($take)->offset($offset)->orderBy($sort, $order)->groupBy(array('no_reg', 'tanggal'))->get($field);
            $file = 'lab_klinik';
        }
        elseif($jenis == 11)
        {
            $this->load->model('lab_pengantar_pa');
            $field = array('id', 'no_reg', 'no_dr as dokter_id', 'tanggal', 'registered');
            $surat   = Lab_Pengantar_Pa::where('no_reg', $no_reg)->take($take)->offset($offset)->orderBy('id', 'desc')->get($field);
            $file = 'lab_pa';
        }
        elseif($jenis == 12)
        {
            $this->load->model('lab_pengantar_mikro');
            $field = array('id', 'no_reg', 'no_dr as dokter_id', 'tgl_buat as tanggal', 'registered');
            $surat   = Lab_Pengantar_Mikro::where('no_reg', $no_reg)->take($take)->offset($offset)->orderBy('id', 'desc')->get($field);
            $file = 'lab_mikro';
        }
        elseif($jenis == 13)
        {
            $this->load->model('surat_kehamilan');
            $surat = Surat_Kehamilan::select('*')->from(DB::raw("(select * from surat_kehamilan where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'kehamilan';
        }
        elseif($jenis == 14)
        {
            $this->load->model('surat_rujuk');
            $surat = Surat_Rujuk::select('*')->where('no_reg', $no_reg)->where('rujuk_internal', 1)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('printed', 'desc')->get();
            $file = 'rujuk_internal';
        }
        elseif($jenis == 15)
        {
            $this->load->model('surat_klaim');
            //$this->load->model('soap');
            //$surat = Soap::select('*', DB::raw('kd_dr as dokter_id'), DB::raw('tgl_masuk as tanggal'))->where('no_reg', $no_reg)->where('kd_asuransi', 'like', '3%')->take($take)->offset($offset)->groupBy('tgl_masuk')->orderBy('registered', 'desc')->get();
            $surat = Surat_Klaim::select('*')->from(DB::raw("(select * from surat_klaim where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->orderBy('registered', 'desc')->get();
            $file = 'klaim';
        }
        elseif($jenis == 16)
        {
            $this->load->model('surat_poli');
            $surat = Surat_Poli::select('*')->from(DB::raw("(select * from surat_poli where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'poli';
        }
        elseif($jenis == 17)
        {
            $this->load->model('surat_ijin');
            $this->load->model('msg_ijin');
            $surat = Surat_Ijin::select('a.*', 'b.readed as no_reg')->from(DB::raw("(select * from rme.surat_ijin order by registered desc) a"))->leftJoin('message.msg_ijin as b', 'b.ijin_id', '=', 'a.id')->take($take)->offset($offset)->groupBy(array('tanggal', 'dokter_id'))->orderBy('registered', 'desc')->get();
            $file = 'ijin';
        }
        elseif($jenis == 18)
        {
            $this->load->model('surat_dirawat');
            $surat = Surat_dirawat::select('*')->from(DB::raw("(select * from surat_dirawat where no_reg = '$no_reg' order by registered desc) a"))->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'dirawat';
        }
        elseif($jenis == 19)
        {
            $this->load->model('surat_meninggal');
            $surat = Surat_Meninggal::select('*')->from(DB::raw("(select * from surat_meninggal where no_reg = '$no_reg' order by registered desc) a"))->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'meninggal';
        }
        elseif($jenis == 20)
        {
            $this->load->model('surat_pantau');
            $surat = Surat_Pantau::select('*')->from(DB::raw("(select * from surat_pantau where no_reg = '$no_reg' order by registered desc) a"))->take($take)->offset($offset)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'pantau';
        }
        elseif($jenis == 21)
        {
            $this->load->model('surveilans_covid');
            $surat = Surveilans_Covid::select('*', DB::raw('date(registered) as tanggal'))->from(DB::raw("(select * from surveilans_covid where no_reg = '$no_reg' order by registered desc) a"))->take($take)->offset($offset)->groupBy('jenis')->orderBy('registered', 'desc')->get();
            $file = 'surveilans_covid';
        }

        $html   = '';
        // $dokter_id = '';
        $datas  = array();
        if (count($surat) > 0) {
            foreach ($surat as $all) {
                # code...
                $byid = false;
                $action = '';
                $id = $all->id;
                $no_reg = $all->no_reg;
                $registered = $all->registered;
                $registered = date('d-m-Y H:i:s', strtotime($registered));
                $dokter_id = $all->dokter_id;
                $tanggal = date('d-m-Y', strtotime($all->tanggal));
                $dokter = Dokter::find($dokter_id);
                if(count($dokter) > 0)
                {
                    $dokter = $dokter->nama2;
                }
                else
                {
                    $dokter = '';
                }

                $poli_id = '';
                if($jenis == 15)
                {
                    $poli_id = $all->poli_id;
                }

                if($jenis == 17)
                {
                    $byid = true;
                    if($induk == 'SKR' || $induk == 'EDP')
                    {
                        $cetak = $all->cetak;
                        if($cetak == '') $action = "<a class='btn btn-default acc' data-id='$id'>ACC</a>";
                    }
                }

                if($byid)
                {
                    $files = '<a class="fancybox-file txc surat" data-original-title="'.$file.'" href="'.URL.'rme/pdf/'.$file.'/'.$id.'" rel="tooltip" style="" title="" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
                }
                else
                {
                    $files = '<a class="fancybox-file txc surat" data-original-title="'.$file.'" href="'.URL.'rme/pdf/'.$file.'/'.$dokter_id.'/'.$no_reg.'/'.strtotime($tanggal).'/'.strtotime($registered).'/'.$poli_id.'" rel="tooltip" style="" title="" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
                }
                if($jenis == 21)
                {
                    $files = '<a class="fancybox-file txc surat" data-original-title="'.$file.'" href="'.URL.'rme/pdf/'.$file.'/'.$no_reg.'/'.strtotime($registered).'" rel="tooltip" style="" title="" target="_blank"><i class="fa fa-file-pdf-o"></i></a>';
                }

                $datas[] = (object) array(
                    'id'   => $id,
                    'no_reg' => $no_reg,
                    'file' => $files,
                    'registered' => $registered,
                    'dokter' => $dokter,
                    'action' => $action,
                );
            }
        }

        if($jenis == 1)
        {
            $surat = Surat_Kontrol::select('*')->from(DB::raw("(select * from surat_kontrol where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 2)
        {
            $surat = Surat_Rujuk_BPJS::select('*')->from(DB::raw("(select * from surat_rujuk_bpjs where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 3)
        {
            $surat = Surat_Rujuk::select('*')->from(DB::raw("(select * from surat_rujuk where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('printed', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 4)
        {
            $surat = Surat_Sehat::select('*')->from(DB::raw("(select * from surat_sehat where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 5)
        {
            $surat = Surat_Istirahat::select('*')->from(DB::raw("(select * from surat_istirahat where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 6)
        {
            $surat = Surat_Butawarna::select('*')->from(DB::raw("(select * from surat_butawarna where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 7)
        {
            $this->load->model('surat_fisioterapi');
            $surat = Surat_Fisioterapi::where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->first();
            $surat = count($surat);
        }
        elseif($jenis == 8)
        {
            $this->load->model('surat_mondok');
            $surat = Surat_Mondok::where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->first();
            $surat = count($surat);
        }
        elseif($jenis == 9)
        {
            $surat   = RO_Pengantar::where('no_reg', $no_reg)->orderBy('id', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 10)
        {
            $surat   = Lab_Order::where('no_reg', $no_reg)->whereRaw("registered = (select max(b.registered) from lab_order b where b.no_reg = '$no_reg' and b.tanggal = lab_order.tanggal)")->orderBy($sort, $order)->groupBy(array('no_reg', 'tanggal'))->get();
            $surat = count($surat);
        }
        elseif($jenis == 11)
        {
            $surat   = Lab_Pengantar_Pa::where('no_reg', $no_reg)->orderBy('id', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 12)
        {
            $surat   = Lab_Pengantar_Mikro::where('no_reg', $no_reg)->orderBy('id', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 13)
        {
            $surat = Surat_Kehamilan::select('*')->from(DB::raw("(select * from surat_kehamilan where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 14)
        {
            $surat = Surat_Rujuk::select('*')->from(DB::raw("(select * from surat_rujuk where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->where('rujuk_internal', 1)->groupBy('tanggal')->orderBy('printed', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 15)
        {
            //$surat = Soap::where('no_reg', $no_reg)->where('kd_asuransi', 'like', '3%')->take($take)->offset($offset)->groupBy('tgl_masuk')->orderBy('registered', 'desc')->get();
            $surat = Surat_Klaim::select('*')->from(DB::raw("(select * from surat_klaim where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 16)
        {
            $surat = Surat_Poli::select('*')->from(DB::raw("(select * from surat_poli where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 17)
        {
            $surat = Surat_Ijin::select('a.*', 'b.readed as no_reg')->from(DB::raw("(select * from rme.surat_ijin order by registered desc) a"))->leftJoin('message.msg_ijin as b', 'b.ijin_id', '=', 'a.id')->groupBy(array('tanggal', 'dokter_id'))->orderBy('registered', 'desc')->get();
            $surat = count($surat);
        }
        elseif($jenis == 18)
        {
            $surat = Surat_dirawat::select('*')->from(DB::raw("(select * from surat_dirawat where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'dirawat';
        }
        elseif($jenis == 19)
        {
            $surat = Surat_Meninggal::select('*')->from(DB::raw("(select * from surat_meninggal where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'meninggal';
        }
        elseif($jenis == 20)
        {
            $surat = Surat_Pantau::select('*')->from(DB::raw("(select * from surat_pantau where no_reg = '$no_reg' order by registered desc) a"))->groupBy('tanggal')->orderBy('registered', 'desc')->get();
            $file = 'pantau';
        }
        elseif($jenis == 21)
        {
            $surat = Surveilans_Covid::select('*', DB::raw('date(registered) as tanggal'))->from(DB::raw("(select * from surveilans_covid where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->groupBy('jenis')->orderBy('registered', 'desc')->get();
            $file = 'covid';
        }

        $data = array(
            "total" => $surat,
            "rows"  => $datas,
        );

        echo json_encode($data);
    }
    function authlogin()
    {
        $array = array(
            'user' => 'deny'
        );

        $this->session->set_userdata( $array );
    }
    function auth()
    {
        echo CI_VERSION;
        echo '<br>';
        echo $this->session->userdata('user');
    }
    public function list_poli()
    {
        $this->load->model('poli');

        $poli = Poli::where('report_status', '1')->orderBy('report_order', 'asc')->groupBy('report_nama')->get(array('report_nama'));
        return $poli;
    }
    public function list_penunjang()
    {
        $this->load->model('poli');

        $poli = Poli::whereIn('kode_poli', array('F001', 'F002', 'F003', 'L001', 'L002', 'L003', 'R001'))->get(array(DB::Raw("nama_poli as report_nama")));
        return $poli;
    }
    public function list_hd()
    {
        $this->load->model('poli');

        $poli = Poli::whereIn('kode_poli', array('HD'))->get(array(DB::Raw("nama_poli as report_nama")));
        return $poli;
    }
    public function list_ugd()
    {
        $this->load->model('poli');

        $poli = Poli::whereIn('kode_poli', array('UGD', 'PNEK'))->get(array(DB::Raw("nama_poli as report_nama")));
        return $poli;
    }
    public function list_bangsal2()
    {
        $this->load->model('bangsal');

        $poli = Bangsal::where('aktif', 'Y')->get(array(DB::Raw("nama_pendaftaran as report_nama")));
        return $poli;
    }
    public function list_bangsal()
    {
        $this->load->model('bangsal');

        $bangsal = Bangsal::all();
        return $bangsal;
    }
    public function list_dokter()
    {
        $this->load->model('dokter');
        $this->load->model('dokter_poli');

        $field  = array('rme.dokter.kd_dokter', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2');
        $dokter = Dokter_Poli::join('rsiklaten.dokter', 'rme.dokter.kd_dokter', '=', 'rsiklaten.dokter.no_dr')->groupBy('rme.dokter.kd_dokter')->get($field);
        return $dokter;
    }
    public function treadmill()
    {
        $view = 'report_treadmill';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function verif_soap()
    {
        $view = 'report_verif_soap';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));

        $data = array(
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'kode_akses' => self::kode_akses(),
            'view'    => $view,
            'pages'   => $this->pagination->create_links(),
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function page_verif_soap()
    {
        $this->load->model('soap');
        $this->load->model('poli');
        $this->load->model('dokter');

        $userid  = $this->input->get('userid');
        $tanggal = $this->input->get('tanggal');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $datas   = array();
        $soap = 0;

        $sess = sess_on('auth');
        if(isset($sess->user))
        {
            $user = $sess->user;
        }
        /*
        $akses  = Dokter::where('no_dr', $dokter)->where('kode_nama', $kode)->get();
        if (count($akses) > 0) {

            $register = User_Register::where('user', '=', $userid)->first();
            $userid   = $register->kd_akun;
            if($userid == 5 || $userid == 9)
            {
                if(!empty($tanggal))
                {
                    $soap    = Soap::where('kd_dr', $dokter)->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
                }
                else
                {
                    $soap    = Soap::where('kd_dr', $dokter)->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
                }
            }
            else
            {
                $soap    = Soap::where('kd_dr', $dokter)->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();
            }
            */
                $soap    = Soap::where('kd_dr', $user)->where('approve', $user)->where('approved', '<', 'writed')->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get();

            if (count($soap) > 0) {
                foreach ($soap as $all) {
                    # code...
                    $id        = $all->id;
                    $no_reg    = $all->no_reg;
                    $nama      = $all->nama;
                    $tgl_lahir = $all->tgl_lahir;
                    $tgl_lahir = date('d-m-Y', strtotime($tgl_lahir));
                    $kd_poli   = $all->kd_poli;
                    $poli      = Poli::find($kd_poli);
                    if (count($poli) > 0) {
                        $nm_poli = $poli->nama_poli;
                    } else {
                        $nm_poli = '';
                    }
                    $registered = $all->registered;


                    /*
                    $soap_verif = Soap_Verif::where('soap_id', '=', $id)->first();
                    if (!empty($soap_verif->registered)) {
                        $streg = '1';
                    } else {
                        $streg = '0';
                    }

                    if (!empty($soap_verif->registered)) {
                        $tgl_verif = date('d-m-Y H:i:s', strtotime($soap_verif->registered));
                    } else {
                        $tgl_verif = '';
                    }
                    */

                    $kd_dr   = $all->kd_dokter;
                    $datas[] = array(
                        'id'        => $id,
                        'no_reg'    => $no_reg,
                        'nama'      => $nama,
                        'tgl_lahir' => $tgl_lahir,
                        'poli'      => $nm_poli,
                        'registered' => $registered,
                    );
                }
            }

            /*
            if($userid == 5 || $userid == 9)
            {
                if(!empty($tanggal))
                {
                    $soap = Soap::where('kd_dr', $dokter)->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }
                else
                {
                    $soap = Soap::where('kd_dr', $dokter)->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }
            }
            else
            {
                $soap = Soap::where('kd_dr', $dokter)->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
            }
            */
                $soap = Soap::where('kd_dr', $user)->where('approve', $user)->where('approved', '<', 'writed')->whereRaw("date(registered) = '" . date('Y-m-d', strtotime($tanggal)) . "'")->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                /*
        }
        */

        $data = array(
            "total" => $soap,
            "rows"  => $datas,
            "user"  => $user,
        );
        echo json_encode($data);
    }
    public function page_soap_pasien()
    {
        $this->load->model('soap_gd');
        $this->load->model('inap');
        $this->load->model('pasien');
        $this->load->model('bangsal');
        $this->load->model('karyawan');
        $this->load->model('dokter');
        $this->load->model('unit');

        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $tanggal = $this->input->get('tanggal');
        $datas   = array();
        $total  = 0;

        $sessid = '';
        $akses = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
        }

        //$akses = 'poli';
        $kd = array();
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $sessid)->first($field);
        if(count($karya) > 0)
        {
            $field = array('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk');
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
                $bangsal = Bangsal::where('induk', $induk)->get();
                if(count($bangsal) > 0)
                {
                    $akses = 'bangsal';
                    foreach ($bangsal as $all) {
                        $kd[] = $all->kd_bangsal;
                    }
                    //$field = array('NO_REG', 'NAMA', 'TGL_LAHIR', 'TGL_MASUK', 'JAM_MASUK', 'BANGSAL');
                    $field = array('ranap.inap.no_reg', 'ranap.inap.nama', 'ranap.inap.tgl_lahir', 'ranap.inap.tgl_masuk', 'ranap.inap.jam_masuk', 'ranap.inap.kd_bangsal');
                    //$soap  = Inap::join('rme.soap', 'ranap.inap.no_reg', '=', 'rme.soap.no_reg')->whereRaw("CONCAT(ranap.inap.no_reg,ranap.inap.nama) like '%$search%'")->whereIn('kd_bangsal', $kd)->groupBy('no_reg')->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $soap  = Inap::whereRaw("CONCAT(ranap.inap.no_reg,ranap.inap.nama) like '%$search%'")->whereIn('kd_bangsal', $kd)->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                }
                else
                {
                    if($induk == 'PDF')
                    {
                        $akses = 'pendaftaran';
                    }
                    elseif($induk == 'ASR')
                    {
                        $akses = 'asuransi';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'EDP')
                    {
                        $akses = 'edp';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'RDG')
                    {
                        $akses = 'ro';
                    }
                    elseif($induk == 'LAB')
                    {
                        $akses = 'lab';
                    }
                    elseif($induk == 'GZI')
                    {
                        $akses = 'gizi';
                    }
                    elseif($induk == 'RMD')
                    {
                        $akses = 'rm';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'RHN')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'SPM')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'PLY')
                    {
                        $akses = 'poli';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'FIS')
                    {
                        $akses = 'poli';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'FRM')
                    {
                        $akses = 'farmasi';
                        // if(!empty($tanggal))
                        // {
                            // $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            // $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                            // $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->whereRaw("date(tgl_masuk) = '".date('Y-m-d')."'")->orderBy('no_reg', 'asc');
                            if (!empty($search) && strlen($search) >= 4) {
                                $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->orderBy('no_reg', 'asc');
                            } else {
                                $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->whereRaw("date(tgl_masuk) = '".date('Y-m-d')."'")->orderBy('no_reg', 'asc');
                            }
                        // $ranap = DB::table('ranap.inap')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->orderBy('no_reg', 'asc');

                        // $total = count($rajal->union($ranap)->orderBy($sort, $order)->get());
                        // $soap = $rajal->union($ranap)->take($take)->offset($offset)->orderBy($sort, $order)->get();
                        $total = count($rajal->orderBy($sort, $order)->get());
                        $soap = $rajal->take($take)->offset($offset)->orderBy($sort, $order)->get();

                        // }
                        // else
                        // {
                        //     $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                        //     $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        // }
                    }
                    elseif($induk == 'UGD')
                    {
                        $akses = 'ugd';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'IBS')
                    {
                        $akses = 'ibs';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                }

                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $all = (object)$all;
                        // $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $tgl_daftar = date('d-m-Y', strtotime($all->tgl_masuk));
                        $jam_daftar = $all->jam_masuk;

                        $diagranap = '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/diagnosa/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $resume = '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/resume_soap/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $resume_all = '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/resume_soap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $penunjang = '<a class="btpenunjang" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/penunjang/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $inap = '<a class="btinap" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/soap_inap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $ibs = '<a class="btibs" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/ibs/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        if($induk == 'FRM')
                        {
                            $diagranap = '';
                            $resume = '';
                            $resume_all = '';
                            $penunjang = '';
                            $inap = '';
                            $ibs = '';
                        }

                        $poli = '<a class="btpoli" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/soap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $poli_inap = '<a class="btpoli_inap" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/soap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $ugd = '<a class="btgd" data-no_reg="' . $no_reg . '" data-poli="UGD" href="' . SUBDOM . 'pdf/soap_gd/' . $no_reg . '/UGD" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        $ponek = '<a class="btgd" data-no_reg="' . $no_reg . '" data-poli="PNEK" href="' . SUBDOM . 'pdf/soap_gd/' . $no_reg . '/PNEK" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                        if($sessid == '')
                        {
                            $poli = '';
                            $poli_inap = '';
                            $ugd = '';
                            $ponek = '';
                            $inap = '';
                            $diagranap = '';
                            $resume = '';
                            $resume_all = '';
                            $penunjang = '';
                            $ibs = '';
                        }
                        if($induk == 'IBS')
                        {
                            $poli = '';
                            $poli_inap = '';
                            $ugd = '';
                            $ponek = '';
                            $diagranap = '';
                            $resume = '';
                            $resume_all = '';
                            $penunjang = '';
                            $inap = '';
                        }
                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'tgl_lahir' => $tgl_lahir,
                            'tgl_masuk' => $tgl_daftar,
                            'jam_masuk' => $jam_daftar,
                            'diagranap' => $diagranap,
                            'poli' => $poli,
                            'poli_inap' => $poli_inap,
                            'ugd' => $ugd,
                            'ponek' => $ponek,
                            'inap' => $inap,
                            'resume' => $resume,
                            'resume_all' => $resume_all,
                            'penunjang' => $penunjang,
                            'ibs' => $ibs,
                        );
                    }
                }
            }
        }
        else
        {
            $field = array('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk');
            $dokter = Dokter::find($sessid);
            if(count($dokter) > 0)
            {
                if(!empty($tanggal))
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                }
                else
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }
                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $tgl_daftar = date('d-m-Y', strtotime($all->tgl_masuk));
                        $jam_daftar = $all->jam_masuk;
                        $ibs = '<a class="btibs" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/ibs/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';

                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'tgl_lahir' => $tgl_lahir,
                            'tgl_masuk' => $tgl_daftar,
                            'jam_masuk' => $jam_daftar,
                            'diagranap' => '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/diagnosa/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'poli' => '<a class="btpoli" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/soap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'ugd' => '<a class="btgd" data-no_reg="' . $no_reg . '" data-poli="UGD" href="' . SUBDOM . 'pdf/soap_gd/' . $no_reg . '/UGD" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'ponek' => '<a class="btgd" data-no_reg="' . $no_reg . '" data-poli="PNEK" href="' . SUBDOM . 'pdf/soap_gd/' . $no_reg . '/PNEK" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'inap' => '<a class="btinap" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/soap_inap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'resume' => '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/resume_soap/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'resume_all' => '<a class="tbpdfpasien" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/resume_soap_all/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'penunjang' => '<a class="btpenunjang" data-no_reg="' . $no_reg . '" href="' . SUBDOM . 'pdf/penunjang/' . $no_reg . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                            'ibs' => $ibs,
                        );
                    }
                }
            }
            else
            {
                $field = array('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk');
                $akses = 'poli';
                if(!empty($tanggal))
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                }
                else
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }

                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $tgl_daftar = date('d-m-Y', strtotime($all->tgl_masuk));
                        $jam_daftar = $all->jam_masuk;

                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'tgl_lahir' => $tgl_lahir,
                            'tgl_masuk' => $tgl_daftar,
                            'jam_masuk' => $jam_daftar,
                        );
                    }
                }
            }
        }

        $data = array(
            "total" => $total,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function resep()
    {
        $this->load->model('soap');
        $this->load->model('user');
        $this->load->model('karyawan');
        $this->load->model('farmasi_store');
        $this->load->model('dokter');

        $akses = self::akses_menu();
        $induk = $akses->induk;

        $view = 'report_resep';
        //$this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $count = Soap::count();

        $found = false;
        // get every record
        if (!empty(segment(4))) {
            $offset = segment(4);
        } else {
            $offset = 1;
        }
        $take    = 10;
        $content = '';

        $field = array('rsiklaten.user.id', 'sdm.karya.nama');
        //$user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('sdm.karya.unit', '036')->get($field);

        $store = Farmasi_Store::select(DB::raw("group_concat(distinct(dokter_id)) as dokter"), 'id', 'nama', 'jenis')->groupBy(array('jenis'))->get();
        $dokter = Dokter::select(DB::raw("group_concat(no_dr) as dokter_id"))->where('status_dpjp', '!=', '')->orWhere('sps_id', '!=', '')->first();
        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'induk' => $induk,
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            // 'dokter'  => self::list_dokter(),
            'dokter'  => $dokter,
            //'karyawan'    => $user,
            'store'    => $store,
            'view'    => $view,
            'pages'   => $this->pagination->create_links(),
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function page_pasien_resep()
    {
        $this->load->model('pasien_resep');
        $this->load->model('pasien_resep_verif');
        $this->load->model('pasien_resep_gd');
        $this->load->model('pasien_resep_gd_verif');
        $this->load->model('pasien_resep_inap');
        $this->load->model('pasien_resep_inap_verif');
        $this->load->model('kunjung');
        $this->load->model('pasien');
        $this->load->model('dokter');
        $this->load->model('poli');
        $this->load->model('soap');
        $this->load->model('soap_gd');
        $this->load->model('soap_inap');
        $this->load->model('printer');

        $no_reg  = $this->input->get('no_reg');
        $store = $this->input->get('store');
        $jns  = $this->input->get('jenis');
        if($jns == 'awal')
        {
            $jns = '';
        }
        elseif($jns == 'resume')
        {
            $jns = 1;
        }
        elseif($jns == 'cppt')
        {
            $jns = 2;
        }

        $dokter = $this->input->get('dokter');
        if(isset($dokter)) {
            $dokter = explode(',', $dokter);
        }
        else
        {
            $dokter = Dokter::select(DB::raw("group_concat(no_dr) as dokter_id"))->where('sps_id', '<>', '')->get();
            $dokter = explode(',', $dokter[0]->dokter_id);
        }
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $poli  = $this->input->get('poli');
        $tanggal  = $this->input->get('tanggal');
        $tanggal = date('Y-m-d', strtotime($tanggal));

        $ri = '';
        $datas  = array();
        $total = '';
        $prn = array();

        $printer = Printer::where('jenis', $store)->get(array('id'));
        foreach ($printer as $all) {
            # code...
            $prn[] = $all->id;
        }
        $prn = implode(',', $prn);

        $jenis = 'RJ';
        if($store == 'HD') $jenis = 'HD';
        $resep = DB::table('rme.pasien_resep')->select(DB::raw("'$jenis' as jenis"), 'rme.pasien_resep.soap_id', 'rme.pasien_resep.kd_dr as dokter_id', 'rsiklaten.pasien.no_reg', 'rsiklaten.pasien.nama', 'rsiklaten.pasien.alamat', 'rsiklaten.pasien.tgl_lahir', 'rme.pasien_resep.registered', 'rme.pasien_resep_verif.id as verif_id', 'rme.pasien_resep_verif.antrian', 'rme.pasien_resep_verif.petugas1', 'rme.pasien_resep_verif.petugas2', 'rme.pasien_resep.trx')->leftJoin('rme.pasien_resep_verif', 'rme.pasien_resep_verif.soap_id', '=', 'rme.pasien_resep.soap_id')->join('rsiklaten.pasien', 'rsiklaten.pasien.no_reg', '=', 'rme.pasien_resep.no_reg')->where('rme.pasien_resep.tgl_masuk', $tanggal)->whereIn('rme.pasien_resep.kd_dr', $dokter)->groupBy('rme.pasien_resep.no_reg')->orderBy($sort, $order);
        //if(isset($dokter)) $resep = $resep->whereIn('rme.pasien_resep.kd_dr', $dokter);
        $resep = $resep->join('rme.soap', 'rme.soap.id', '=', 'rme.pasien_resep.soap_id')->join('rsiklaten.poli', function($join) use ($prn){
                $join->on(DB::raw("rsiklaten.poli.printer_farm in ($prn)"), DB::raw(''), DB::raw(''));
        })->whereRaw('rme.soap.kd_poli = rsiklaten.poli.kode_poli');
        if(($no_reg)) $resep = $resep->where('rme.pasien_resep.no_reg', $no_reg);

        $resep_gd = DB::table('rme.pasien_resep_gd')->select(DB::raw("'GD' as jenis"), 'rme.pasien_resep_gd.soap_id', 'rme.pasien_resep_gd.dokter_id', 'rsiklaten.pasien.no_reg', 'rsiklaten.pasien.nama', 'rsiklaten.pasien.alamat', 'rsiklaten.pasien.tgl_lahir', 'rme.pasien_resep_gd.registered', 'rme.pasien_resep_gd_verif.id as verif_id', 'rme.pasien_resep_gd_verif.antrian', 'rme.pasien_resep_gd_verif.petugas1', 'rme.pasien_resep_gd_verif.petugas2', 'rme.pasien_resep_gd.trx')->leftJoin('rme.pasien_resep_gd_verif', 'rme.pasien_resep_gd_verif.soap_id', '=', 'rme.pasien_resep_gd.soap_id')->join('rsiklaten.pasien', 'rsiklaten.pasien.no_reg', '=', 'rme.pasien_resep_gd.no_reg')->where('rme.pasien_resep_gd.tgl_masuk', $tanggal)->whereIn('rme.pasien_resep_gd.dokter_id', $dokter)->groupBy('rme.pasien_resep_gd.no_reg')->orderBy($sort, $order);
        //if(isset($dokter)) $resep_gd = $resep_gd->whereIn('rme.pasien_resep_gd.dokter_id', $dokter);
        $resep_gd = $resep_gd->join('rme.soap_gd', 'rme.soap_gd.id', '=', 'rme.pasien_resep_gd.soap_id')->join('rsiklaten.poli', function($join) use ($prn) {
                $join->on(DB::raw("rsiklaten.poli.printer_farm in ($prn)"), DB::raw(''), DB::raw(''));
            })->whereRaw('rme.soap_gd.poli_id = rsiklaten.poli.kode_poli');
        if(($no_reg)) $resep_gd = $resep_gd->where('rme.pasien_resep_gd.no_reg', $no_reg);

        if($jns == 2)
        {
            $resep_inap = DB::table('rme.pasien_resep_inap')->select(DB::raw("'RI' as jenis"), 'rme.pasien_resep_inap.soap_id', 'rme.pasien_resep_inap.dokter_id', 'rsiklaten.pasien.no_reg', 'rsiklaten.pasien.nama', 'rsiklaten.pasien.alamat', 'rsiklaten.pasien.tgl_lahir', 'rme.pasien_resep_inap.registered', 'rme.pasien_resep_inap_verif.id as verif_id', 'rme.pasien_resep_inap_verif.antrian', 'rme.pasien_resep_inap_verif.petugas1', 'rme.pasien_resep_inap_verif.petugas2', 'rme.pasien_resep_inap.trx')->leftJoin('rme.pasien_resep_inap_verif', 'rme.pasien_resep_inap_verif.soap_id', '=', 'rme.pasien_resep_inap.soap_id')->join('rsiklaten.pasien', 'rsiklaten.pasien.no_reg', '=', 'rme.pasien_resep_inap.no_reg')->where('rme.pasien_resep_inap.tgl_resep', $tanggal)->whereIn('rme.pasien_resep_inap.dokter_id', $dokter)->groupBy(array('rme.pasien_resep_inap.trx'))->orderBy($sort, $order);
        }
        else
        {
            $resep_inap = DB::table('rme.pasien_resep_inap')->select(DB::raw("'RI' as jenis"), 'rme.pasien_resep_inap.soap_id', 'rme.pasien_resep_inap.dokter_id', 'rsiklaten.pasien.no_reg', 'rsiklaten.pasien.nama', 'rsiklaten.pasien.alamat', 'rsiklaten.pasien.tgl_lahir', 'rme.pasien_resep_inap.registered', 'rme.pasien_resep_inap_verif.id as verif_id', 'rme.pasien_resep_inap_verif.antrian', 'rme.pasien_resep_inap_verif.petugas1', 'rme.pasien_resep_inap_verif.petugas2', 'rme.pasien_resep_inap.trx')->leftJoin('rme.soap_inap', 'rme.soap_inap.id', '=', 'rme.pasien_resep_inap.soap_id')->leftJoin('rme.pasien_resep_inap_verif', 'rme.pasien_resep_inap_verif.soap_id', '=', 'rme.pasien_resep_inap.soap_id')->join('rsiklaten.pasien', 'rsiklaten.pasien.no_reg', '=', 'rme.pasien_resep_inap.no_reg')->where('rme.soap_inap.resume', $jns)->where('rme.pasien_resep_inap.tgl_resep', $tanggal)->whereIn('rme.pasien_resep_inap.dokter_id', $dokter)->groupBy('rme.pasien_resep_inap.no_reg')->orderBy($sort, $order);
        }
        //if(isset($dokter)) $resep_inap = $resep_inap->whereIn('rme.pasien_resep_inap.dokter_id', $dokter);
        if(($no_reg)) $resep_inap = $resep_inap->where('rme.pasien_resep_inap.no_reg', $no_reg);

        if($store == 'RJ')
        {
            $total = count($resep->orderBy($sort, $order)->get());
            $resep = $resep->take($take)->offset($offset)->orderBy($sort, $order)->get();
        }
        elseif($store == 'HD')
        {
            $total = count($resep->orderBy($sort, $order)->get());
            $resep = $resep->take($take)->offset($offset)->orderBy($sort, $order)->get();
        }
        elseif($store == 'GD')
        {
            $total = count($resep_gd->orderBy($sort, $order)->get());
            $resep = $resep_gd->take($take)->offset($offset)->orderBy($sort, $order)->get();
        }
        elseif($store == 'RI')
        {
            $total = count($resep->union($resep_inap)->orderBy($sort, $order)->get());
            $resep = $resep->union($resep_inap)->take($take)->offset($offset)->orderBy($sort, $order)->get();
        }

        if (count($resep) > 0 && $store) {
            foreach ($resep as $all) {
                # code...
                $all = (object)$all;
                $soap_id         = $all->soap_id;
                $no_reg         = $all->no_reg;
                $nama         = $all->nama;
                $tgl_lahir         = date('d-m-Y', strtotime($all->tgl_lahir)).' / '.age($all->tgl_lahir, date('Y-m-d', strtotime($all->registered)));
                $alamat         = $all->alamat;
                $registered  = strtotime($all->registered);
                $dokter_id  = $all->dokter_id;
                $jenis = $all->jenis;
                $antrian = $all->antrian;
                $verif_id = $all->verif_id;
                $petugas1 = $all->petugas1;
                $petugas2 = $all->petugas2;
                $trx = $all->trx;

                    /*
                if(isset($jns))
                {
                    */
                    //if($jns <> $jenis) continue;
                /*
                }
                */

                $pdf = '';
                if($jenis == 'RJ')
                {
                    $pdf = URL."rme/pdf/resep/$soap_id";
                }
                elseif($jenis == 'GD')
                {
                    $pdf = URL."rme/pdf/resep_gd/$soap_id";
                }
                elseif($jenis == 'RI')
                {
                    if($soap_id == 0) $soap_id = "0/$no_reg/$trx";
                    $pdf = URL."rme/pdf/resep_inap/$soap_id";
                }

                $datas[] = array(
                    'soap_id'         => $soap_id,
                    'antrian'         => $antrian,
                    'jenis'  => $jenis,
                    'no_reg'         => $no_reg,
                    'nama'  => $nama,
                    'tgl_lahir'  => $tgl_lahir,
                    'alamat'  => $alamat,
                    'registered'  => $registered,
                    'dokter_id'  => $dokter_id,
                    'pdf'  => $pdf,
                    'verif_id'  => $verif_id,
                    'petugas1'  => $petugas1,
                    'petugas2'  => $petugas2,
                    'trx'  => $trx,
                );
            }
        }

        $data = array(
            "total" => $total,
            "rows"  => $datas,
            'printer' => $printer,
        );
        echo json_encode($data);
    }
    function resep_gd()
    {
        $this->load->model('soap_gd');
        $this->load->model('askep_gd');
        $this->load->model('asuransi');
        $this->load->model('dokter');
        $this->load->model('poli');
        $this->load->model('pasien');
        $this->load->model('pasien_resep_gd');
        $this->load->model('pasien');

        $id = segments();

        $found = false;

        $soap = Soap_GD::find($id);
        if(count($soap) > 0)
        {
            $no_reg = $soap->no_reg;
            $diagnosa = $soap->diagkerja;
            $alergi = $soap->alergi;
            $trx = $soap->trx;
            $dpjp1 = $soap->dpjp1;
            $dpjp2 = $soap->dpjp2;
            $kd_dr = $soap->dokter_id;
            $tinlan = $soap->tinlan;
            $rekonsiliasi = $soap->rekonsiliasi;
            $dpjp1 = Dokter::find($dpjp1);
            if(count($dpjp1) > 0)
            {
                $dpjp1 = $dpjp1->nama2;
            }
            else
            {
                $dpjp1 = '';
            }
            $dpjp2 = Dokter::find($dpjp2);
            if(count($dpjp2) > 0)
            {
                $dpjp2 = $dpjp2->nama2;
            }
            else
            {
                $dpjp2 = '';
            }
            $dokter = Dokter::find($kd_dr);
            if(count($dokter) > 0)
            {
                $nm_dr = $dokter->nama2;
                $ttd = $dokter->ttd;
                $sps = $dokter->sps;
            }
            else
            {
                $nm_dr = '';
                $ttd = '';
                $sps = '';
            }
        }

        $resep = Pasien_Resep_GD::where('dari', '1')->where('trx', $trx)->whereRaw("date(registered) = '".date('Y-m-d')."'")->get();
        $resepo = Pasien_Resep_GD::where('dari', '2')->where('trx', $trx)->whereRaw("date(registered) = '".date('Y-m-d')."'")->get();

        $pasien = Pasien::find($no_reg);
        if(count($pasien) > 0)
        {
            $no_reg = $pasien->no_reg;
            $nama = $pasien->nama;
            $alamat = $pasien->alamat;

            $no_id = $pasien->no_id;
            $jenis_kel = $pasien->jenis_kel;

            $tgl_lahir = $pasien->tgl_lahir;
            $d = substr($tgl_lahir, 8, 2);
            $m = substr($tgl_lahir, 5, 2);
            $y = substr($tgl_lahir, 0, 4);
            $tgl_lahir = $d.'-'.$m.'-'.$y;

            $umur = $pasien->umur;
            $gol_darah = $pasien->gol_darah;
            $tgl_masuk = $pasien->tgl_masuk;
            $d = substr($tgl_masuk, 8, 2);
            $m = substr($tgl_masuk, 5, 2);
            $y = substr($tgl_masuk, 0, 4);
            $tgl_masuk = $d.'-'.$m.'-'.$y;

            $jam_masuk = $pasien->jam_masuk;
            $tgl_ri = $pasien->tgl_ri;
            $jam_ri = $pasien->jam_ri;
            $kd_poli = $pasien->kd_poli;
            $poli = Poli::find($kd_poli);
            if(count($poli) > 0) {
                # code...
                $nm_poli = $poli->nama_poli;
            }
            else
            {
                $nm_poli = '';
            }

            $pasien = $pasien->pasien;
            $asuransi = Asuransi::find($pasien);
            if(count($asuransi) > 0)
            {
                $asuransi = $asuransi->NAMA;
            }
            else
            {
                $asuransi = '';
            }

            $askep = Askep_GD::where('no_reg', $no_reg)->orderBy('id', 'desc')->first();
            if(count($askep) > 0)
            {
                $berat = $askep->bb;
            }
            else
            {
                $berat = '';
            }

            $content = (object)array(
                'no_reg' => $no_reg,
                'nama' => $nama,
                'alamat' => $alamat,
                'no_id' => $no_id,
                'jenis_kel' => $jenis_kel,
                'asuransi' => $asuransi,
                'tgl_lahir' => $tgl_lahir,
                'umur' => $umur,
                'gol_darah' => $gol_darah,
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk,
                'tgl_ri' => $tgl_ri,
                'jam_ri' => $jam_ri,
                'kd_poli' => $kd_poli,
                'poli' => $nm_poli,
                'kd_dr' => $kd_dr,
                'ttd' => $ttd,
                'sps' => $sps,
                'dokter' => $nm_dr,
                'dpjp1' => $dpjp1,
                'dpjp2' => $dpjp2,
                'pasien' => $pasien,
                'trx' => $trx,
                'rekonsiliasi' => $rekonsiliasi,
                'resep' => $resep,
                'resepo' => $resepo,
                'diagnosa' => $diagnosa,
                'alergi' => $alergi,
                'berat' => $berat,
            );

            $found = true;
        }

        $data = array(
            'content' => $content,
            'pdf_type' => 'I',
        );

        if($tinlan == 5)
        {
            go('pdf_resep_gd', $data);
        }
        else
        {
            go('pdf_resep', $data);
        }
    }
    public function lab_klinik()
    {
        $view = 'report_klinik';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $found   = false;
        $content = '';

        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function lab_pa()
    {
        $view = 'report_pa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $found   = false;
        $content = '';

        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function lab_mikro()
    {
        $view = 'report_mikro';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $found   = false;
        $content = '';

        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function spm()
    {
        $view = 'report_spm';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));

        $data = array(
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'pages'   => $this->pagination->create_links(),
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function page_spm()
    {
        $this->load->model('askep');
        $this->load->model('askep_gd');
        $this->load->model('spm');
        $this->load->model('kunjung');
        $this->load->model('pasien');
        $this->load->model('dokter');

        $no_reg = $this->input->get('no_reg');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $search = $this->input->get('search');
        $poli  = $this->input->get('poli');
        $tanggal  = $this->input->get('tanggal');
        $tanggal = date('Y-m-d', strtotime($tanggal));

        $ri = '';
        $datas  = array();

        if($poli == 'UGD')
        {
            $field = array('rsiklaten.kunjung.no_reg', 'rsiklaten.kunjung.tanggal', 'rsiklaten.kunjung.kd_poli as poli', 'b.dokter_id as askep_dr', 'b.no_reg as askep_stat', 'c.kd_dr as spm_dr', 'c.no_reg as spm_stat', 'c.jenis', 'c.bangsal', 'd.nama');
            $kunjung = Kunjung::leftJoin(DB::raw("(select no_reg, dokter_id, tgl_masuk from rme.askep_gd where poli_id = '$poli' and tgl_masuk = '$tanggal' group by no_reg) b"), function($join) use ($poli, $tanggal) {
                $join->on('b.no_reg', '=', 'rsiklaten.kunjung.no_reg');
            })->leftJoin(DB::raw("(select no_reg, bangsal, kd_dr, tanggal, jenis from poli.db5j where tanggal = '$tanggal' and bangsal = '$poli' group by no_reg) c"), function($join) use ($poli, $tanggal) {
                $join->on('c.no_reg', '=', 'rsiklaten.kunjung.no_reg');
                $join->on('c.bangsal', '=', DB::raw("'$poli'"));
            })->join('rsiklaten.pasien as d', 'd.no_reg', '=', 'rsiklaten.kunjung.no_reg')->where('rsiklaten.kunjung.kd_poli', $poli)->where('rsiklaten.kunjung.tanggal', $tanggal)->where('rsiklaten.kunjung.no_reg', 'like', "%$search%")->take($take)->offset($offset)->orderBy($sort, $order)->groupBy('rsiklaten.kunjung.no_reg')->groupBy('rsiklaten.kunjung.kd_poli')->get($field);
        }
        else
        {
            $field = array('rsiklaten.kunjung.no_reg', 'rsiklaten.kunjung.tanggal', 'rsiklaten.kunjung.kd_poli as poli', 'b.kd_per as askep_dr', 'b.no_reg as askep_stat', 'c.kd_dr as spm_dr', 'c.no_reg as spm_stat', 'c.jenis', 'c.bangsal', 'd.nama');
            $kunjung = Kunjung::leftJoin(DB::raw("(select no_reg, kd_per, tgl_masuk from rme.askep where poli = '$poli' and tgl_masuk = '$tanggal' group by no_reg) b"), function($join) use ($poli, $tanggal) {
                $join->on('b.no_reg', '=', 'rsiklaten.kunjung.no_reg');
            })->leftJoin(DB::raw("(select no_reg, bangsal, kd_dr, tanggal, jenis from poli.db5j where tanggal = '$tanggal' and bangsal = '$poli' group by no_reg) c"), function($join) use ($poli, $tanggal) {
                $join->on('c.no_reg', '=', 'rsiklaten.kunjung.no_reg');
                $join->on('c.bangsal', '=', DB::raw("'$poli'"));
            })->join('rsiklaten.pasien as d', 'd.no_reg', '=', 'rsiklaten.kunjung.no_reg')->where('rsiklaten.kunjung.kd_poli', $poli)->where('rsiklaten.kunjung.tanggal', $tanggal)->where('rsiklaten.kunjung.no_reg', 'like', "%$search%")->take($take)->offset($offset)->orderBy($sort, $order)->groupBy('rsiklaten.kunjung.no_reg')->groupBy('rsiklaten.kunjung.kd_poli')->get($field);

            $month = date('Y-m', strtotime($tanggal));
            $ri = SPM::where('tanggal', 'like', "$month%")->where('bangsal', $poli)->where('jenis', 'DB5')->count();

        }

        if (count($kunjung) > 0) {
            foreach ($kunjung as $all) {
                # code...
                $no_reg         = $all->no_reg;
                $nama         = $all->nama;
                $tanggal         = $all->tanggal;
                $poli         = $all->poli;
                $askep_dr         = $all->askep_dr;
                if($askep_dr)
                {
                    $askep_dr = '<i class="fa fa-check"></i>';
                }
                $askep_stat  = $all->askep_stat;
                $spm_dr  = $all->spm_dr;
                $dokter = Dokter::find($spm_dr);
                if(count($dokter) > 0)
                {
                    $dokter = $dokter->nama2;
                }
                else
                {
                    $dokter = '';
                }

                $jenis  = $all->jenis;
                if($spm_dr && $jenis == 'DB5J')
                {
                    $spm_dr = '<i class="fa fa-check"></i>';
                }
                elseif($spm_dr && $jenis == 'DB5')
                {
                    $spm_dr = 'RI';
                }
                $spm_stat  = $all->spm_stat;
                $datas[] = array(
                    'no_reg'         => $no_reg,
                    'nama'  => $nama,
                    'dokter'  => $dokter,
                    'askep_dr'  => $askep_dr,
                    'askep_stat'  => $askep_stat,
                    'spm_dr'  => $spm_dr,
                    'spm_stat'  => $spm_stat,
                );
            }
        }

        $kunjung = Kunjung::where('kd_poli', $poli)->where('tanggal', $tanggal)->groupBy('no_reg')->groupBy('kd_poli')->get();

        $data = array(
            "total" => count($kunjung),
            "rows"  => $datas,
            "ri"  => $ri,
        );
        echo json_encode($data);
    }
    public function soap()
    {
        $view = 'report_soap';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));

        $data = array(
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'kode_akses'    => self::kode_akses(),
            'pages'   => $this->pagination->create_links(),
            'assets'  => $this->template->getMetadata(),
        );

        $sessid = '';
        $akses = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
        }

        go('index', $data);
    }
    public function bpjs()
    {
        $view = 'report_bpjs';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->load->model('asuransi');
        $asuransi = Asuransi::get();
        $data = array(
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'kode_akses'    => self::kode_akses(),
            'pages'   => $this->pagination->create_links(),
            'assets'  => $this->template->getMetadata(),
            'asuransi' => $asuransi,
        );

        $sessid = '';
        $akses = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
        }

        go('index', $data);
    }
    public function page_bpjs_pasien()
    {
        $this->load->model('soap_gd');
        $this->load->model('inap');
        $this->load->model('pasien');
        $this->load->model('bangsal');
        $this->load->model('karyawan');
        $this->load->model('dokter');
        $this->load->model('unit');
        $this->load->model('asuransi');

        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $tanggal = $this->input->get('tanggal');
        $datas   = array();
        $total  = 0;

        $sessid = '';
        $akses = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
        }

        //$akses = 'poli';
        $kd = array();
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $sessid)->first($field);
        if(count($karya) > 0)
        {
            $field = array('no_reg', 'nama', 'alamat', 'tgl_lahir', 'tgl_masuk', 'jam_masuk', 'no_id', 'nopeserta', 'pasien');
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
                $bangsal = Bangsal::where('induk', $induk)->get();
                if(count($bangsal) > 0)
                {
                    $akses = 'bangsal';
                    foreach ($bangsal as $all) {
                        $kd[] = $all->kd_bangsal;
                    }
                    //$field = array('NO_REG', 'NAMA', 'TGL_LAHIR', 'TGL_MASUK', 'JAM_MASUK', 'BANGSAL');
                    $field = array('ranap.inap.no_reg', 'ranap.inap.nama', 'ranap.inap.tgl_lahir', 'ranap.inap.tgl_masuk', 'ranap.inap.jam_masuk', 'ranap.inap.kd_bangsal');
                    //$soap  = Inap::join('rme.soap', 'ranap.inap.no_reg', '=', 'rme.soap.no_reg')->whereRaw("CONCAT(ranap.inap.no_reg,ranap.inap.nama) like '%$search%'")->whereIn('kd_bangsal', $kd)->groupBy('no_reg')->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $soap  = Inap::whereRaw("CONCAT(ranap.inap.no_reg,ranap.inap.nama) like '%$search%'")->whereIn('kd_bangsal', $kd)->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                }
                else
                {
                    if($induk == 'PDF')
                    {
                        $akses = 'pendaftaran';
                    }
                    elseif($induk == 'ASR')
                    {
                        $akses = 'asuransi';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'EDP')
                    {
                        $akses = 'edp';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'RDG')
                    {
                        $akses = 'ro';
                    }
                    elseif($induk == 'LAB')
                    {
                        $akses = 'lab';
                    }
                    elseif($induk == 'GZI')
                    {
                        $akses = 'gizi';
                    }
                    elseif($induk == 'RMD')
                    {
                        $akses = 'rm';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'RHN')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'SPM')
                    {
                        $akses = 'rohani';
                    }
                    elseif($induk == 'PLY')
                    {
                        $akses = 'poli';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'FIS')
                    {
                        $akses = 'poli';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                    elseif($induk == 'FRM')
                    {
                        $akses = 'farmasi';
                        // if(!empty($tanggal))
                        // {
                            // $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            // $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                            // $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->whereRaw("date(tgl_masuk) = '".date('Y-m-d')."'")->orderBy('no_reg', 'asc');
                            if (!empty($search) && strlen($search) >= 4) {
                                $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->orderBy('no_reg', 'asc');
                            } else {
                                $rajal = DB::table('pasien')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->whereRaw("date(tgl_masuk) = '".date('Y-m-d')."'")->orderBy('no_reg', 'asc');
                            }
                        // $ranap = DB::table('ranap.inap')->select('no_reg', 'nama', 'tgl_lahir', 'tgl_masuk', 'jam_masuk')->whereRaw("CONCAT(no_reg,nama) like '%$search%'")->orderBy('no_reg', 'asc');

                        // $total = count($rajal->union($ranap)->orderBy($sort, $order)->get());
                        // $soap = $rajal->union($ranap)->take($take)->offset($offset)->orderBy($sort, $order)->get();
                        $total = count($rajal->orderBy($sort, $order)->get());
                        $soap = $rajal->take($take)->offset($offset)->orderBy($sort, $order)->get();

                        // }
                        // else
                        // {
                        //     $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                        //     $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        // }
                    }
                    elseif($induk == 'UGD')
                    {
                        $akses = 'ugd';
                        if(!empty($tanggal))
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                        }
                        else
                        {
                            $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                            $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                        }
                    }
                }

                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $all = (object)$all;
                        // $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $alamat     = $all->alamat;
                        $nik        = trim($all->no_id);
                        if (strlen($nik)<10) {
                            $nik  = '<i class="fa fa-credit-card">';
                        }
                        $kartu      = trim($all->nopeserta);
                        if (strlen($kartu)<10) {
                            $kartu  = '<i class="fa fa-credit-card">';
                        }
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $asuransi   = Asuransi::find($all->pasien);
                        $kode_asuransi = $all->pasien;
                        if(count($asuransi) > 0)
                        {
                            $asuransi = $asuransi->NAMA;
                        }
                        else
                        {
                            $asuransi = '';
                        }

                        if($induk == 'FRM')
                        {
                            $diagranap = '';
                            $resume = '';
                            $resume_all = '';
                            $penunjang = '';
                            $inap = '';
                            $ibs = '';
                        }

                        if($sessid == '')
                        {
                            $poli = '';
                            $ugd = '';
                            $ponek = '';
                            $inap = '';
                            $diagranap = '';
                            $resume = '';
                            $resume_all = '';
                            $penunjang = '';
                            $ibs = '';
                        }
                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'alamat'    => $alamat,
                            'tgl_lahir' => $tgl_lahir,
                            'nik'       => $nik, 
                            'kartu'     => $kartu,
                            'asuransi'  => $asuransi,
                            'kode_asuransi' => $kode_asuransi,
                        );
                    }
                }
            }
        }
        else
        {
            $field = array('no_reg', 'nama', 'alamat', 'tgl_lahir', 'tgl_masuk', 'jam_masuk', 'no_id', 'nopeserta', 'pasien');
            $dokter = Dokter::find($sessid);
            if(count($dokter) > 0)
            {
                if(!empty($tanggal))
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                }
                else
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }
                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $alamat     = $all->alamat;
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $nik        = trim($all->no_id);
                        if (strlen($nik)<10) {
                            $nik  = '<i class="fa fa-credit-card">';
                        }
                        $kartu      = trim($all->nopeserta);
                        if (strlen($kartu)<10) {
                            $kartu  = '<i class="fa fa-credit-card">';
                        }
                        $asuransi   = Asuransi::find($all->pasien);
                        $kode_asuransi = $all->pasien;
                        if(count($asuransi) > 0)
                        {
                            $asuransi = $asuransi->NAMA;
                        }
                        else
                        {
                            $asuransi = '';
                        }
                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'alamat'    => $alamat,
                            'tgl_lahir' => $tgl_lahir,
                            'nik'       => $nik, 
                            'kartu'     => $kartu,
                            'asuransi'  => $asuransi,
                            'kode_asuransi' => $kode_asuransi,
                        );
                    }
                }
            }
            else
            {
                $field = array('no_reg', 'nama', 'alamat', 'tgl_lahir', 'tgl_masuk', 'jam_masuk', 'no_id', 'nopeserta', 'pasien');
                $akses = 'poli';
                if(!empty($tanggal))
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d', strtotime($tanggal)))->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->where('tgl_masuk', date('Y-m-d'))->count();
                }
                else
                {
                    $soap  = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->take($take)->offset($offset)->orderBy($sort, $order)->get($field);
                    $total = Pasien::whereRaw("CONCAT(no_reg,nama) like '%$search%'")->count();
                }

                if (count($soap) > 0) {
                    foreach ($soap as $all) {
                        # code...
                        $id         = $all->id;
                        $no_reg     = $all->no_reg;
                        $nama       = $all->nama;
                        $alamat     = $all->alamat;
                        $tgl_lahir  = $all->tgl_lahir;
                        $tgl_lahir  = date('d-m-Y', strtotime($tgl_lahir));
                        $nik        = trim($all->no_id);
                        if (strlen($nik)<10) {
                            $nik  = '<i class="fa fa-credit-card">';
                        }
                        $kartu      = trim($all->nopeserta);
                        if (strlen($kartu)<10) {
                            $kartu  = '<i class="fa fa-credit-card">';
                        }
                        $asuransi   = Asuransi::find($all->pasien);
                        $kode_asuransi = $all->pasien;
                        if(count($asuransi) > 0)
                        {
                            $asuransi = $asuransi->NAMA;
                        }
                        else
                        {
                            $asuransi = '';
                        }
                        $datas[] = array(
                            'no_reg'    => $no_reg,
                            'nama'      => $nama,
                            'alamat'    => $alamat,
                            'tgl_lahir' => $tgl_lahir,
                            'nik'       => $nik,
                            'kartu'     => $kartu,
                            'asuransi'  => $asuransi,   
                            'kode_asuransi'  => $kode_asuransi,                          
                        );
                    }
                }
            }
        }

        $data = array(
            "total" => $total,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_soap_poli()
    {
        $this->load->model('askep');
        $this->load->model('soap');

        $no_reg = $this->input->get('no_reg');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $datas  = array();

        $akses = self::kode_akses();
        $soap = Soap::leftJoin('pasien_resep', function($join) {
                $join->on('soap.trx', '=', 'pasien_resep.trx');
                $join->on('soap.tgl_masuk', '=', 'pasien_resep.tgl_masuk');
            })->where('soap.no_reg', $no_reg)->take($take)->offset($offset)->orderBy($sort, $order)->groupBy(array('soap.no_reg', 'soap.tgl_masuk', 'soap.kd_dr'))->get(array('soap.id', 'soap.tgl_masuk', 'soap.jam_masuk', 'pasien_resep.id as resep'));

        if (count($soap) > 0) {
            foreach ($soap as $all) {
                # code...
                $darah      = '';
                $nadi       = '';
                $suhu       = '';
                $gds        = '';
                $pernafasan = '';
                $oksigen    = '';
                $tinggi     = '';
                $berat      = '';
                $id         = $all->id;
                $tgl_masuk  = $all->tgl_masuk;
                $jam_masuk  = $all->jam_masuk;
                $time = strtotime($tgl_masuk.' '.$jam_masuk);
                $tgl_masuk  = date('d-m-Y', strtotime($all->tgl_masuk));

                $askep = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/askep/' . $no_reg . '/'.$time.'" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                $soap = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/soap/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                if($akses == 'FRM')
                {
                    // $askep = '';
                    // $soap = '';
                }

                $resep = $all->resep;
                if($resep)
                {
                    $resep = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/resep/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                }

                $datas[] = array(
                    'id'         => $id,
                    'tgl_masuk'  => $tgl_masuk,
                    'askep'  => $askep,
                    'soap'  => $soap,
                    'resep'  => $resep,
                    //'keterangan' => $berat . $tinggi . $darah . $nadi . $suhu . $gds . $pernafasan . $oksigen . $keterangan,
                );
            }
        }

        $soap = Soap::leftJoin('pasien_resep', function($join) {
                $join->on('soap.trx', '=', 'pasien_resep.trx');
                $join->on('soap.tgl_masuk', '=', 'pasien_resep.tgl_masuk');
            })->where('soap.no_reg', $no_reg)->groupBy(array('soap.no_reg', 'soap.tgl_masuk', 'soap.kd_dr'))->get(array('soap.id', 'soap.tgl_masuk', 'soap.jam_masuk', 'pasien_resep.id as resep'));

        $data = array(
            "total" => count($soap),
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_soap_poli_inap()
    {
        $this->load->model('askep_poli_inap');
        $this->load->model('soap_poli_inap');
        $this->load->model('pasien_resep_poli_inap');
        $this->load->model('dokter');

        $no_reg = $this->input->get('no_reg');
        $poli = $this->input->get('poli');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $datas  = array();

        // if(!isset($poli))
        // {
        //     $poli = 'UGD';
        // }

        $akses = self::kode_akses();

        $soap = Soap_Poli_Inap::select('*')->from(DB::raw("(select * from rme.soap_poli_inap where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy(array('dokter_id', 'tgl_masuk', 'jam_masuk'))->orderBy($sort, $order)->get();

        if (count($soap) > 0) {
            foreach ($soap as $all) {
                # code...
                $darah      = '';
                $nadi       = '';
                $suhu       = '';
                $gds        = '';
                $pernafasan = '';
                $oksigen    = '';
                $tinggi     = '';
                $berat      = '';
                $id         = $all->id;
                $poli = $all->poli_id;
                $dokter_id         = $all->dokter_id;
                $dokter = Dokter::find($dokter_id);
                if(count($dokter) > 0)
                {
                    $dokter = $dokter->nama2;
                }
                else
                {
                    $dokter = '';
                }

                $tgl_masuk  = date('d-m-Y', strtotime($all->tgl_masuk));
                $registered  = strtotime($all->registered);

                $askep = Askep_Poli_Inap::where('no_reg', $no_reg)->where('tgl_masuk', $all->tgl_masuk)->orderBy('id', 'desc')->first();
                if(count($askep) > 0)
                {
                    $registered_askep = strtotime($askep->registered);
                }
                else
                {
                    $registered_askep = '';
                }

                $askep = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/askep_poli_inap/' . $no_reg . '/' . $registered_askep . '/' . $poli . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                $soap = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/soap_poli_inap/' . $no_reg . '/' . $registered . '/' . $poli . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                if($akses == 'FRM')
                {
                    // $askep = '';
                    // $soap = '';
                }

                $datas[] = array(
                    'id'         => $id,
                    'tgl_masuk'  => $tgl_masuk,
                    'dokter'  => $dokter,
                    'askep'  => $askep,
                    'soap'  => $soap,
                    'resep'  => '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/resep_poli_inap/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                    //'keterangan' => $berat . $tinggi . $darah . $nadi . $suhu . $gds . $pernafasan . $oksigen . $keterangan,
                );
            }
        }

        $soap = Soap_Poli_Inap::where('no_reg', $no_reg)->groupBy(array('dokter_id', 'tgl_masuk', 'jam_masuk'))->get();

        $data = array(
            "total" => count($soap),
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_soap_ibs()
    {
        $this->load->model('pasien_operasi');
        $this->load->model('operasi');

        $no_reg = $this->input->get('no_reg');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $datas  = array();

        $akses = self::kode_akses();
        $soap = Operasi::leftJoin('ranap.bon_op', function($join) {
                $join->on('operasi.bon_id', '=', 'bon_op.id');
            })->where('operasi.no_reg', $no_reg)->take($take)->offset($offset)->orderBy($sort, $order)->groupBy(array('operasi.no_reg', 'bon_op.tanggal', 'operasi.bangsal_id'))->get(array('operasi.id', 'operasi.start'));

        if (count($soap) > 0) {
            foreach ($soap as $all) {
                # code...
                $darah      = '';
                $nadi       = '';
                $suhu       = '';
                $gds        = '';
                $pernafasan = '';
                $oksigen    = '';
                $tinggi     = '';
                $berat      = '';
                $id         = $all->id;
                $tgl_masuk  = date('d-m-Y', strtotime($all->start));
                $jam_masuk  = date('H:i:s', strtotime($all->start));
                $time = strtotime($tgl_masuk.' '.$jam_masuk);
                $tgl_masuk  = date('d-m-Y', strtotime($all->start));

                $operasi = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/operasi/' . $id.'" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                if($akses == 'FRM')
                {
                    $operasi = '';
                }

                $datas[] = array(
                    'id'         => $id,
                    'tanggal'  => $tgl_masuk,
                    'operasi'  => $operasi,
                    //'keterangan' => $berat . $tinggi . $darah . $nadi . $suhu . $gds . $pernafasan . $oksigen . $keterangan,
                );
            }
        }

        $soap = Operasi::leftJoin('ranap.bon_op', function($join) {
                $join->on('operasi.bon_id', '=', 'bon_op.id');
            })->where('operasi.no_reg', $no_reg)->groupBy(array('operasi.no_reg', 'bon_op.tanggal', 'operasi.bangsal_id'))->get(array('operasi.id', 'operasi.start'));

        $data = array(
            "total" => count($soap),
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_soap_gd()
    {
        $this->load->model('dokter');
        $this->load->model('askep_gd');
        $this->load->model('soap_gd');

        $no_reg = $this->input->get('no_reg');
        $poli = $this->input->get('poli');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $datas  = array();

        if(!isset($poli))
        {
            $poli = 'UGD';
        }

        $akses = self::kode_akses();

        $soap = Soap_GD::select('*')->from(DB::raw("(select * from rme.soap_gd where no_reg = '$no_reg' order by registered desc) a"))->where('no_reg', $no_reg)->take($take)->offset($offset)->groupBy(array('dokter_id', 'tgl_masuk', 'jam_masuk'))->orderBy($sort, $order)->get();

        if (count($soap) > 0) {
            foreach ($soap as $all) {
                # code...
                $darah      = '';
                $nadi       = '';
                $suhu       = '';
                $gds        = '';
                $pernafasan = '';
                $oksigen    = '';
                $tinggi     = '';
                $berat      = '';
                $id         = $all->id;
                $poli = $all->poli_id;
                $dokter_id         = $all->dokter_id;
                $dokter = Dokter::find($dokter_id);
                if(count($dokter) > 0)
                {
                    $dokter = $dokter->nama2;
                }
                else
                {
                    $dokter = '';
                }

                $tgl_masuk  = date('d-m-Y', strtotime($all->tgl_masuk));
                $registered  = strtotime($all->registered);

                $askep = Askep_GD::where('no_reg', $no_reg)->where('tgl_masuk', $all->tgl_masuk)->orderBy('id', 'desc')->first();
                if(count($askep) > 0)
                {
                    $registered_askep = strtotime($askep->registered);
                }
                else
                {
                    $registered_askep = '';
                }

                $askep = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/askep_gd/' . $no_reg . '/' . $registered_askep . '/' . $poli . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                $soap = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/soap_gd/' . $no_reg . '/' . $registered . '/' . $poli . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                if($akses == 'FRM')
                {
                    // $askep = '';
                    // $soap = '';
                }

                $datas[] = array(
                    'id'         => $id,
                    'tgl_masuk'  => $tgl_masuk,
                    'dokter'  => $dokter,
                    'askep'  => $askep,
                    'soap'  => $soap,
                    'resep'  => '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/resep_gd/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                    //'keterangan' => $berat . $tinggi . $darah . $nadi . $suhu . $gds . $pernafasan . $oksigen . $keterangan,
                );
            }
        }

        $soap = Soap_GD::where('no_reg', $no_reg)->groupBy(array('dokter_id', 'tgl_masuk', 'jam_masuk'))->get();

        $data = array(
            "total" => count($soap),
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function page_soap_inap()
    {
        $this->load->model('askep_inap');
        $this->load->model('soap_inap');

        $no_reg = $this->input->get('no_reg');
        $take   = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort   = $this->input->get('sort');
        $order  = $this->input->get('order');
        $datas  = array();

        $akses = self::kode_akses();

        $soap = Soap_Inap::where('no_reg', $no_reg)->take($take)->offset($offset)->orderBy($sort, $order)->groupBy(array('no_reg', 'tgl_masuk', 'jam_masuk', 'dokter_id'))->get();

        if (count($soap) > 0) {
            foreach ($soap as $all) {
                # code...
                $darah      = '';
                $nadi       = '';
                $suhu       = '';
                $gds        = '';
                $pernafasan = '';
                $oksigen    = '';
                $tinggi     = '';
                $berat      = '';
                $id         = $all->id;
                $tgl_masuk  = $all->tgl_masuk;
                $jam_masuk  = $all->jam_masuk;
                $time = strtotime($tgl_masuk.' '.$jam_masuk);
                $tgl_masuk  = date('d-m-Y', strtotime($all->tgl_masuk));

                $askep = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/askep_inap/' . $no_reg . '/'.$time.'" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                $soap = '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/soap_inap_all/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>';
                // if($akses == 'FRM')
                // {
                //     $askep = '';
                //     $soap = '';
                // }

                $datas[] = array(
                    'id'         => $id,
                    'tgl_masuk'  => $tgl_masuk,
                    'askep'  => $askep,
                    'soap'  => $soap,
                    'resep'  => '<a class="txc" data-no_reg="' . $no_reg . '" href="' . URL . 'rme/pdf/resep_inap/' . $id . '" target="blank" title="Pdf"><i class="fa fa-file-pdf-o"></i></a>',
                    //'keterangan' => $berat . $tinggi . $darah . $nadi . $suhu . $gds . $pernafasan . $oksigen . $keterangan,
                );
            }
        }

        $soap = Soap_Inap::where('no_reg', $no_reg)->groupBy(array('no_reg', 'tgl_masuk', 'jam_masuk', 'dokter_id', 'smf'))->get();

        $data = array(
            "total" => count($soap),
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function barcode()
    {
        //I'm just using rand() function for data example
        $temp = rand(10000, 99999);
        $this->set_barcode($temp);
    }
    public function set_barcode($code)
    {
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }
    public function akses_menu()
    {
        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');
        $this->load->model('bangsal');
        $this->load->model('smf');

        $nik = false;
        $unit = false;
        $userid = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $nik = $sess->user;
            $userid = $sess->user_id;
        }

        $induk = false;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        if(count($karya) > 0)
        {
            $unit = $karya->unit;
            $unit = Unit::where('no_unit', $unit)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
            }
        }

        $direksi = '';
        $dsmf = '';
        $nsmf = '';
        $sps = false;
        $dokter = false;
        $dr = Dokter::find($nik);
        if(count($dr) > 0)
        {
            $direksi = $dr->direksi;
            $sps = $dr->sps_id;
            $msmf = SMF::find($sps);
            if(count($msmf) > 0)
            {
                $nsmf = $msmf->nama;
                $dsmf = str_replace('Asesmen Awal Rawat ', 'form_soap_', $nsmf);
                $dsmf = str_replace(' ', '_', $dsmf);
                $dsmf = strtolower($dsmf);
            }
            $dokter = true;
        }

        $data = (object)array(
            'induk' => $induk,
            'dokter' => $dokter,
            'sps' => $sps,
            'nik' => $nik,
            'userid' => $userid,
            'unit' => $unit,
            'direksi' => $direksi,
        );

        return $data;
    }
    public function ro()
    {
        $view = 'report_ro';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $found   = false;
        $content = '';

        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function poli()
    {
        $view = 'report_poli';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $found   = false;
        $content = '';

        $data = array(
            'content' => $content,
            'akses' => self::akses(),
            'poli'    => self::list_poli(),
            'bangsal' => self::list_bangsal(),
            'dokter'  => self::list_dokter(),
            'view'    => $view,
            'assets'  => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    public function absen()
    {
        $this->load->model('user');
        $this->load->model('dokter');
        $this->load->model('dokter_spesialis');
        $this->load->model('praktek');
        $this->load->model('absen');

        $tanggal = date('Y-m-d');
        $hari = date('N', strtotime($tanggal));

        echo '<br><br>';
        $dokter_id = 'S187';
        $jam = date('H:i');
        $hari = date('N', strtotime($tanggal));
        $praktek = Praktek::join('dokter_spesialis as b', 'dokter_spesialis_id', '=', 'b.id')->where('hari', $hari)->where('b.dokter_id', $dokter_id)->orderBy('jam1', 'asc')->first(array('b.dokter_id', 'jam1', 'jam2'));
        if(count($praktek) > 0)
        {
            $jam1 = $praktek->jam1;
            $jam2 = $praktek->jam2;
        }

        $html = '<table>';
        $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal = '$tanggal' order by registered asc) a"))->join('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->join('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->groupBy('a.user_id')->orderBy('b.user', 'asc')->get();
        foreach($absen as $all)
        {
            $id = $all->id;
            $user_id = $all->user_id;
            $dokter_id = $all->dokter_id;
            $nama = $all->nama;
            $jam1 = $all->jam1;
            $jam2 = $all->jam2;
            $registered = date('H:i', strtotime($all->registered));
            $waktu = xTimeAgo($registered, $jam1, 'm');
            $tanggal = date('d-m-Y', strtotime($all->tanggal));
            $registered = date('d-m-Y H:i:s', strtotime($all->registered));
            $html .= "<tr><td>$id</td><td>$user_id</td><td>$dokter_id</td><td>$nama</td><td>$tanggal</td><td>$registered</td><td>$waktu</td></tr>";
        }
        $html .= '</table>';

        echo $html;
    }

    public function pendapatan_harian()
    {
        $this->load->model('source');
        $view = 'report_pendapatan_harian';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }

    public function aktivitas_pelayanan_hemodialisa()
    {
        $this->load->model('source');
        $view = 'report_aktivitas_pelayanan_hemodialisa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }

    public function aktivitas_pelayanan_jantung()
    {
        $this->load->model('source');
        $view = 'report_aktivitas_pelayanan_jantung';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }
    public function aktivitas_pelayanan_rehab_medik()
    {
        $this->load->model('source');
        $view = 'report_aktivitas_pelayanan_rehab_medik';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }

    public function aktivitas_pelayanan_spesialis()
    {
        $this->load->model('source');
        $view = 'report_aktivitas_pelayanan_spesialis';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }

    public function my_induk($nik) {
        $this->load->model('Karyawan');
        // $this->load->model('Unit');
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        return $induk;
    }
    public function pendapatan_harian_fisioterapi()
    {
        $this->load->model('source');
        $view = 'report_pendapatan_harian_fisioterapi';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }
    public function pendapatan_harian_jantung()
    {
        $this->load->model('source');
        $view = 'report_pendapatan_harian_jantung';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }
    public function kunjungan_rawat_jalan()
    {
        $this->load->model('source');
        $view = 'report_kunjungan_rawat_jalan';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }

    public function kunjungan_imc()
    {
        $this->load->model('source');
        $view = 'report_kunjungan_imc';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }


    public function bon_harian()
    {
        $this->load->model('source');
        $view = 'report_bon_harian';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }

    public function edukasi_hambatan()
    {
        include('report.controllers/edukasi_hambatan.report.php');
    }
    
    public function kelengkapan_data()
    {
        $this->load->model('source');
        $view = 'report_kelengkapan_data';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setJs('admisi', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('admisi', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'poli'  => self::list_poli(),
            'penunjang'  => self::list_penunjang(),
            'hd'  => self::list_hd(),
            'cathlab'  => self::list_poli(),
            'ugd'  => self::list_ugd(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }
    public function kelengkapan_data_ri()
    {
        include('report.controllers/lengkap_ri.report.php');
    }
    public function kelengkapan_data_ri_2()
    {
        include('report.controllers/lengkap_ri_2.report.php');
    }
    public function kelengkapan_data_hd()
    {
        include('report.controllers/lengkap_hd.report.php');
    }
    public function monitoring_hd()
    {
        include('report.controllers/monitoring_hd.report.php');
    }
    public function monitor_awal_medis()
    {
        include('report.controllers/monitor_awal_medis.report.php');
    }
    public function monitor_ibs()
    {
        include('report.controllers/monitoring_ibs.report.php');
    }
    
    public function antrol()
    {
        include('report.controllers/antrol.report.php');
    }
    
    public function antrol_bpjs()
    {
        include('report.controllers/antrol_bpjs.report.php');
    }
    
    public function surkon()
    {
        include('report.controllers/surkon.report.php');
    }
    public function kontrol()
    {
        include('report.controllers/kontrol.report.php');
    }
    public function kontrol_inap()
    {
        include('report.controllers/kontrol_inap.report.php');
    }
    public function inden()
    {
        include('report.controllers/inden.report.php');
    }


    public function pengguna_fisioterapi()
    {
        $this->load->model('source');
        $view = 'report_pengguna_fisioterapi';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }

    public function pengguna_jantung()
    {
        $this->load->model('source');
        $view = 'report_pengguna_jantung';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }

    public function pengguna_hemodialisa()
    {
        $this->load->model('source');
        $view = 'report_pengguna_hemodialisa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }

    public function antigen()
    {
        $this->load->model('source');
        $view = 'report_antigen';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function error()
    {
        $this->template->useAsset()->setJs(array('jquery.min'));
        $this->template->useAsset()->setCSS(array('bootstrap.min.theme4', 'error', 'responsive'));

        $data = array(
            'assets'  => $this->template->getMetadata(),
        );

        go('error', $data);
    }
    
    public function double_transaksi()
    {
        // $this->load->model('source');
        $view = 'report_double_transaksi';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function double_transaksi_hemodialisa()
    {
        // $this->load->model('source');
        $view = 'report_double_transaksi_hemodialisa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function no_transaksi_poliklinik()
    {
        // $this->load->model('source');
        $view = 'report_no_transaksi_poliklinik';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function no_transaksi_hemodialisa()
    {
        // $this->load->model('source');
        $view = 'report_no_transaksi_hemodialisa';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function pendapatan_harian_igd()
    {
        $this->load->model('source');
        $view = 'report_pendapatan_harian_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }
    public function aktivitas_pelayanan_igd()
    {
        $this->load->model('source');
        $view = 'report_aktivitas_pelayanan_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        $induk = ''; 
        if (!empty($karya)) {
            $unit_id = $karya->unit;
            $unit = Unit::where('no_unit', $unit_id)->first();
            $induk = $unit->induk;
        }
        /*
        if ($user_akses == 'CHUSNUN ARIFIN AL QODRI, AMD' || $user_akses == 'ANALIS HIMAWATI,AMK') {
        */
            $data = array(
                'view'   => $view,
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
                'induk' => $induk,
                'source' => $source,
            );
        /*    
        } else {
            $data = array(
                'view'   => 'report_blank',
                'akses' => self::akses(),
                'dokter'  => self::list_dokter(),
                'assets' => $this->template->getMetadata(),
            );

        }
        */
        go('index', $data);
    }
    public function pengguna_igd()
    {
        $this->load->model('source');
        $view = 'report_pengguna_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
        $induk = $this->my_induk($nik); 
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
    }
    public function double_transaksi_igd()
    {
        // $this->load->model('source');
        $view = 'report_double_transaksi_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }
    public function no_transaksi_igd()
    {
        // $this->load->model('source');
        $view = 'report_no_transaksi_igd';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);
    }

    public function waktu_tunggu_admisi() {
        include('report.controllers/waktu_tunggu_admisi.report.php');
    }
    public function sep_all() {
        include('report.controllers/sep_all.report.php');
    }
    public function sep_all_cek() {
        include('report.controllers/sep_all_cek.report.php');
    }
    public function non_sep_all() {
        include('report.controllers/non_sep_all.report.php');
    }
    public function askom() {
        include('report.controllers/askom.report.php');
    }
    public function monitor_inap_adm() {
        include('report.controllers/monitor_inap_adm.report.php');
    }
    public function monitor_inap_adm_gd() {
        include('report.controllers/monitor_inap_adm_gd.report.php');
    }
    public function resume_jalan_icd2() {
            include('report.controllers/resume_jalan_icd2.report.php');
    }
//     public function resume_jalan_icd2_dev() {
//         include('report.controllers/resume_jalan_icd2_dev.report.php');
// }
    public function resume_jalan_umum() {
        include('report.controllers/resume_jalan_umum.report.php');
    }
    public function resume_inap_umum() {
        include('report.controllers/resume_inap_umum.report.php');
    }
    public function coding_inap_smt() {
        include('report.controllers/coding_smt_inap.report.php');
    }
    public function rincian_bill_inap() {
        include('report.controllers/rincian_bill_inap.report.php');
    }
    public function resume_gd_icd() {
        include('report.controllers/resume_gd_icd.report.php');
    }
    public function resume_gd_icd2() {
        include('report.controllers/resume_gd_icd2.report.php');
    }
    public function sep_farm() {
        include('report.controllers/sep_farm.report.php');
    }
    public function apm_finger() {
        include('report.controllers/apm_finger.report.php');
    }
    public function mjkn() {
        include('report.controllers/mjkn.report.php');
    }

    public function diagnosa()
    {
        $this->load->model('diagnosa');
        $q = $this->input->get_post('q');

        $data     = array();
        $diagnosa = Diagnosa::where('icd', 'like', "%$q%")->orWhere('nmdg', 'like', "%$q%")->take(10)->get();
        foreach ($diagnosa as $all) {
            # code...
            $kode   = $all->icd;
            $nama   = $all->nmdg;
            $data[] = (object) array(
                'kode' => $kode,
                'nama' => $nama,
            );
        }
        echo json_encode($data);
    }

    public function tindakan()
    {
        $this->load->model('tindakan');
        $q = $this->input->get_post('q');

        $data    = array();
        $tindakan = Tindakan::where('kode', 'like', "%$q%")->orWhere('nama', 'like', "%$q%")->take(10)->get();
        foreach ($tindakan as $all) {
            # code...
            $kode   = $all->kode;
            $nama   = $all->nama;
            $data[] = (object) array(
                'kode' => $kode,
                'nama' => $nama,
            );
        }
        echo json_encode($data);
    }
}
