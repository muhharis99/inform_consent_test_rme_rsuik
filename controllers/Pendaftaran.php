<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pendaftaran extends MY_Controller
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
        $view = 'home_'.$akses;

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

    public function rawat_jalan()
    {
        $this->load->model('Pekerjaan'); 
        $this->load->model('Pendidikan'); 
        $this->load->model('Perkawinan'); 
        $this->load->model('Bahasa'); 
        $this->load->model('Agama'); 
        $this->load->model('Etnis'); 
        $this->load->model('Asuransi'); 
        $this->load->model('Hubungan_keluarga'); 
        $this->load->model('Dokter'); 
        $this->load->model('Rujuk'); 
        $this->load->model('Antreanrs_ref_dokter'); 
        $this->load->model('Antreanrs_ref_poli'); 
        $this->load->model('Bpjs_propinsi'); 
        $this->load->model('Bpjs_kabupaten'); 
        $this->load->model('Bpjs_kecamatan'); 
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
    
        $view = 'pendaftaran_rawat_jalan';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
        // $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        // $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setJS(array('input-mask/jquery-1.10.2.min', 'input-mask/jquery.inputmask'));
        $this->template->useAsset()->setJS(array('input-mask/jquery.inputmask.date.extensions', 'input-mask/jquery.inputmask.extensions'));
        $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');
        $poli = self::list_poli();
        $pekerjaan = Pekerjaan::orderBy('no_urut', 'ASC')->get(array(DB::RAW('kd_pekerjaan AS kode'), DB::RAW('concat(no_urut, " - ", pekerjaan) AS nama')));
        $pendidikan = Pendidikan::orderBy('no_urut', 'ASC')->where('no_urut', '>', 0)->get(array(DB::RAW('kd_pendidikan AS kode'), DB::RAW('concat(no_urut, " - ", pendidikan) AS nama')));
        $perkawinan = Perkawinan::orderBy('no_urut', 'ASC')->get(array(DB::RAW('kd_perkawinan AS kode'), DB::RAW('concat(no_urut, " - ", nama_perkawinan) AS nama')));
        $bahasa = Bahasa::orderBy('no_urut', 'ASC')->get(array(DB::RAW('kd_bahasa AS kode'), DB::RAW('concat(no_urut, " - ", nama_bahasa) AS nama')));
        $agama = Agama::orderBy('no_urut', 'ASC')->get(array(DB::RAW('kd_agama AS kode'), DB::RAW('concat(no_urut, " - ", agama) AS nama')));
        $etnis = Etnis::orderBy('no_urut', 'ASC')->get(array(DB::RAW('kd_etnis AS kode'), DB::RAW('concat(no_urut, " - ", nama_etnis) AS nama')));
        $asuransi = Asuransi::orderBy('NAMA', 'ASC')->get(array(DB::RAW('NO_REL AS kode'), DB::RAW('concat(NO_REL, " - ", NAMA) AS nama')));
        $hubungan = Hubungan_keluarga::orderBy('no_urut', 'ASC')->get(array(DB::RAW('id AS kode'), DB::RAW('concat(no_urut, " - ", nama) AS nama')));
        $dokter = Dokter::orderBy('nama', 'ASC')->get(array(DB::RAW('no_dr AS kode'), DB::RAW('nama2 AS nama'), DB::RAW('"" AS praktek')));
        $rujuk = Rujuk::orderBy('no_urut', 'ASC')->get(array(DB::RAW('id_rujuk AS kode'), DB::RAW('concat(no_urut, " - ", rujuk) AS nama')));
        $bpjs_poli = Antreanrs_ref_poli::orderBy('nmsubspesialis', 'ASC')->get(array(DB::RAW('kdsubspesialis AS kode'), DB::RAW('concat(kdsubspesialis, " - ", nmsubspesialis) AS nama')));
        $bpjs_dokter = Antreanrs_ref_dokter::orderBy('namadokter', 'ASC')->get(array(DB::RAW('kodedokter AS kode'), DB::RAW('concat(namadokter, " (", kodedokter, ")") AS nama')));
        $bpjs_propinsi = Bpjs_propinsi::orderBy('nama', 'ASC')->get(array(DB::RAW('kode AS kode'), DB::RAW('concat(nama, " (", kode, ")") AS nama')));
        $bpjs_kabupaten = Bpjs_kabupaten::orderBy('nama', 'ASC')->get(array(DB::RAW('kode AS kode'), DB::RAW('concat(nama, " (", kode, ")") AS nama')));
        $bpjs_kecamatan = Bpjs_kecamatan::orderBy('nama', 'ASC')->get(array(DB::RAW('kode AS kode'), DB::RAW('concat(nama, " (", kode, ")") AS nama')));

        $data = array(
            'view'            => $view,
            'akses' => self::akses(),
            'poli'            => $poli,
            'nik'            => $nik,
            'induk'         => $induk,
            'kd_poli'   => $kd_poli, 
            'klinik' => strtoupper($klinik),
            'kd_dokter' => $kd_dokter,
            'hari' => $hari,
            'pekerjaan' => $pekerjaan,
            'pendidikan' => $pendidikan,
            'perkawinan' => $perkawinan,
            'bahasa' => $bahasa,
            'agama' => $agama,
            'etnis' => $etnis,
            'asuransi' => $asuransi,
            'hubungan' => $hubungan,
            'dokter' => $dokter,
            'rujuk' => $rujuk,
            'bpjs_poli' => $bpjs_poli,
            'bpjs_dokter' => $bpjs_dokter,
            'bpjs_propinsi' => $bpjs_propinsi,
            'bpjs_kabupaten' => $bpjs_kabupaten,
            'bpjs_kecamatan' => $bpjs_kecamatan,
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

    public function rawat_inap()
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
    
        $view = 'form_rawat_inap';
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
    private function list_poli_pendaftaran()
    {
        $this->load->model('poli');

        $poli = Poli::where('status_pendaftaran', '1')->orderBy('nama_poli', 'asc')->get();
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
}
