<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends MY_Controller
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
        // pre($sess); 
    }
    public function home()
    {
        
        $client = get_address();
        $mac    = $client->mac;

        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $register = User_Register::where('user', $mac)->first();
        if (count($register) > 0) {
            $view = 'form_home';
            $this->template->useAsset()->setJs(array('jquery.textfill.min', 'jquery.idle', 'logout'));
            $this->template->useAsset()->setJs('bill', array($view));
            $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
            $id   = $register->kd_akun;
            $akun = User_Akun::find($id);
            if (strpos($akun->kode, 'BGS') !== false) {
                $view = 'bangsal';
            } else {
                $view = $akun->nama;
            }
            $view = 'home_' . strtolower($view);
            $data = array(
                'header' => true,
                'view'   => $view,
                'nik' => $nik,
                'akses' => self::akses(),
                'assets' => $this->template->getMetadata(),
            );
            go('index', $data);
        } else {
            $this->load->model('user_akun');

            $view = 'form_login';
            $this->template->useAsset()->setJs('bill', array($view));
            $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
            $data = array(
                'header' => true,
                'view'   => $view,
                'akses' => self::akses(),
                'assets' => $this->template->getMetadata(),
            );

            go('index', $data);
        }
    }
    /*
    public function index()
    {
        $id = session_id();

        $this->delete_capture_resep();

        $view = 'form_home';
        $this->template->useAsset()->setJs('bill', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'header' => true,
            'view'   => $view,
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }
    */
    
    public function signin()
    {
        $view = 'form_signin';
        $this->template->useAsset()->setJs('rme', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $data = array(
            'home'   => true,
            'header' => false,
            'view'   => $view,
            'akses' => self::akses(),
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
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
            $domain = $sess->domain;
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

        if($domain == 2) $direksi = true;

        $data = (object)array(
        	'induk' => $induk,
        	'dokter' => $dokter,
        	'sps' => $sps,
        	'nik' => $nik,
        	'userid' => $userid,
        	'unit' => $unit,
            'direksi' => $direksi,
            'domain' => $domain,
        );

        return $data;
    }
    public function poli()
    {
        $this->load->model('poli');

        $poli = Poli::where('show', '1')->orderBy('nama_poli', 'asc')->get();
        return $poli;
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
    public function index()
    {
        $this->load->model('bangsal');
        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');

        $sessid = '';
        $akses = '';
        $domain = '';
        $induk = null;
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->user;
            $domain = $sess->domain;
            if($sessid == '')
            {
                $user_log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'))->first();
                $sessid = $user_log->user_id;
            }
            if($domain == 2) $direksi = true;
        }

        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $akses = '';
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
                    elseif($induk == 'FOR')
                    {
                        $akses = 'fo';
                    }
                    elseif($induk == 'SKR')
                    {
                        $akses = 'sekretariat';
                    }
                    elseif($induk == 'KAS')
                    {
                        $akses = 'kassa';
                    }
                    elseif($induk == 'AKT')
                    {
                        $akses = 'akuntansi';
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
                    elseif($induk == 'IBS')
                    {
                        $akses = 'ibs';
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
                        switch ($unit->nm_unit) {
                            case 'CATHLAB' : 
                                $akses = 'jantung';
                                break; 
                            case 'HD' : 
                                $akses = 'hemodialisa';
                                break; 
                            default : 
                                $akses = 'poli';
                                break; 
                        }
                    }
                    elseif($induk == 'HD')
                    {
                        $akses = 'hemodialisa';
                    }
                    elseif($induk == 'FIS')
                    {
                        $akses = 'fisioterapi';
                    }
                    elseif($induk == 'FRM')
                    {
                        $akses = 'farmasi';
                    }
                    elseif($induk == 'UGD')
                    {
                        $akses = 'ugd';
                    }
                    elseif($induk == 'IMC')
                    {
                        $akses = 'ponek';
                    }
                    elseif($domain == 2)
                    {
                        $akses = 'direksi';
                    }
                    elseif($domain == 3)
                    {
                        $akses = 'auditor';
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
                $direksi = $dokter->direksi;
                if($direksi) $akses = 'direksi';
            }
        }
        $view = 'home_'.$akses; // home_edp.blade.php

        //$view = 'form_home';
        $this->template->useAsset()->setJs(array('jquery.textfill.min', 'jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('bill', array('form_home'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'customs'));
        $data = array(
            'header' => false,
            'view'   => $view,
            'akses' => self::akses(),
            'nik' => $nik,
            'induk' => $induk,
            'assets' => $this->template->getMetadata(),
        );
        go('index', $data);
        /*
    }
     */
    }
    

    public function jadwal()
    {
        header('Access-Control-Allow-Origin: *');
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;
        $kd_poli = null; 
        $kd_dokter = null; 
        $klinik = segment(4);
        $kd_dokter = segment(5); 
        // die($klinik." is segmen 4");
    
        $view = 'form_jadwal';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
        $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');

        $data = array(
            'view'            => $view,
            'akses' => self::akses(),
            // 'poli'            => $poli,
            'nik'            => $nik,
            'induk'         => $induk,
            'kd_poli'   => $kd_poli, 
            'klinik' => strtoupper($klinik),
            'kd_dokter' => $kd_dokter,
            'hari' => $hari,
            // 'direksi' => $direksi,
            'assets'          => $this->template->getMetadata(),
        );
        /*
        if ($nik=='100800') {
            echo "<pre>"; 
            var_dump($unit->no_unit); 
            echo "</pre>";
            die(); 
        }
        */
        go('index', $data);
    }

    private function my_induk($nik) {
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
    private function list_poli()
    {
        $this->load->model('poli');

        $poli = Poli::where('show', '1')->orderBy('nama_poli', 'asc')->get();
        return $poli;
    }
    private function list_bangsal()
    {
        $this->load->model('bangsal');

        $bangsal = Bangsal::all();
        return $bangsal;
    }
    private function list_dokter()
    {
        $this->load->model('dokter');
        $this->load->model('dokter_poli');

        $field  = array('rme.dokter.kd_dokter', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2');
        $dokter = Dokter_Poli::join('rsiklaten.dokter', 'rme.dokter.kd_dokter', '=', 'rsiklaten.dokter.no_dr')->groupBy('rme.dokter.kd_dokter')->get($field);
        return $dokter;
    }

    public function loading()
    {
        include('main.controllers/loading.main.php');
    }

    public function pasien()
    {
        include('main.controllers/pasien.main.php');
    }

    public function rawat_inap()
    {
        include('main.controllers/rawat_inap.main.php');
    }

    public function rawat_inap_dev()
    {
        include('main.controllers/rawat_inap_dev.main.php');
    }

    public function rawat_jalan()
    {
        include('main.controllers/rawat_jalan.main.php');
    }

    public function rawat_darurat()
    {
        include('main.controllers/rawat_darurat.main.php');
    }

    public function dpjp()
    {
        $this->load->model('dokter');
        $this->load->model('dokter_poli');

        $field  = array('rme.dokter.kd_dokter', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2');
        $dokter = Dokter_Poli::join('rsiklaten.dokter', 'rme.dokter.kd_dokter', '=', 'rsiklaten.dokter.no_dr')->groupBy('rme.dokter.kd_dokter')->where('rsiklaten.dokter.status_dpjp', '=', 1)->get($field);
        return $dokter;
    }

    public function dokter_poli()
    {
        include('main.controllers/dokter_poli.main.php');
        return !empty($dokter)?$dokter:null;
    }

    public function dokumen_ranap()
    {
        include('main.controllers/dokumen_ranap.php');
    }

    public function inden()
    {
        include('main.controllers/inden.main.php');
    }

    public function drawpad_admisi()
    {
        include ('main.controllers/drawpad_admisi.main.php');
    }

    /*jadwal HD*/
    public function pasien_daftar_hd()
    {
        include('main.controllers/pasien_daftar_hd.main.php');
    }

    public function pasien_daftar_hd_test()
    {
        include('main.controllers/pasien_daftar_hd_test.main.php');
    }

}
