<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Save extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_akun');
        $this->load->model('user_register');
        $this->load->model('asuransi');
        $this->load->model('pasien');
        $this->load->model('pasien_poli');
        $this->load->model('poli');
        $this->load->model('dokter');
        $this->load->model('dokter_poli');
        $this->load->model('soap');
        $this->load->helper('post_url_bridge');
    }
    public function akses_menu()
    {
        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');
        $this->load->model('bangsal');
        $this->load->model('smf');
        $this->load->model('user');

        $nik = false;
        $unit = false;
        $userid = '';
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $nik = $sess->user;
            $userid = $sess->user_id;
        }

        $induk = false;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        if (count($karya) > 0) {
            $unit = $karya->unit;
            $unit = Unit::where('no_unit', $unit)->first();
            if (count($unit) > 0) {
                $induk = $unit->induk;
            }
        }

        $dsmf = '';
        $nsmf = '';
        $sps = false;
        $dokter = false;
        $dr = Dokter::find($nik);
        if (count($dr) > 0) {
            $sps = $dr->sps_id;
            $msmf = SMF::find($sps);
            if (count($msmf) > 0) {
                $nsmf = $msmf->nama;
                $dsmf = str_replace('Asesmen Awal Rawat ', 'form_soap_', $nsmf);
                $dsmf = str_replace(' ', '_', $dsmf);
                $dsmf = strtolower($dsmf);
            }
            $dokter = true;
        }

        $ttd = '';
        //TTD
        $field = array('id', 'ttd', 'reset', 'status');
        $user = User::where('user', $nik)->first($field);
        if(count($user) > 0)
        {
            $id = $user->id;
            $ttd = $user->ttd;
            $ttd_image = IMG."ttd/$nik.jpg";
        }

        $data = (object) array(
            'induk' => $induk,
            'dokter' => $dokter,
            'sps' => $sps,
            'nik' => $nik,
            'userid' => $userid,
            'unit' => $unit,
            'ttd' => $ttd,
        );

        return $data;
    }
    public function login_user()
    {
        $status   = false;
        $password = strtoupper($this->input->post('password'));
        if ($password) {
            $address = get_address();
            $mac     = $address->mac;

            $status = false;

            $akun = User_Akun::where('kode', $password)->first();
            if (count($akun)) {
                $id                = $akun->id;
                $register          = User_Register::firstOrNew(array('user' => $mac));
                $register->user    = $mac;
                $register->kd_akun = $id;
                DB::transaction(function () use ($register, &$status) {
                    $register->save();
                    $status = true;
                });
            }

            $data = array(
                'status' => $status,
            );

            echo json_encode($data);
        } else {
            redirect(URL, 'refresh');
        }
    }
    public function login()
    {
        $status   = false;
        $userid   = $this->input->post('userid');
        $password = strtoupper($this->input->post('password'));
        $datas    = array();
        if ($password) {

            $status = false;

            $akun = User_Akun::where('kode', $password)->first();
            if (count($akun)) {
                $id                = $akun->id;
                $register          = User_Register::firstOrNew(array('user' => $userid));
                $register->user    = $userid;
                $register->kd_akun = $id;
                DB::transaction(function () use ($register, &$status) {
                    $register->save();
                    $status = true;
                });

                if (strpos($akun->kode, 'BGS') !== false) {
                    $view = 'bangsal';
                } else {
                    $view = $akun->nama;
                }
                $view = 'home_' . strtolower($view);

                $data = array(
                    'view'   => go($view, $datas, true),
                    'status' => $status,
                );

                echo json_encode($data);
            } else {
                $data = array(
                    'view'   => go('form_login', $datas, true),
                    'status' => $status,
                );

                echo json_encode($data);
            }
        } else {
            $data = array(
                'view'   => go('form_login', $datas, true),
                'status' => $status,
            );

            echo json_encode($data);
        }
    }
    public function sync_no_perk()
    {
        $kategori = $this->input->post('kategori');
        switch ($kategori) {
            case 'GIGI': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_gigi",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_GIGI,
                        "sql" => SQL_NO_PERK_GIGI, 
                        "kategori" => "GIGI"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'SPS': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_sps",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_SPS,
                        "sql" => SQL_NO_PERK_SPS, 
                        "kategori" => "SPS"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'UMUM': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_umum",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_UMUM,
                        "sql" => SQL_NO_PERK_UMUM, 
                        "kategori" => "UMUM"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'RHMED': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_rhmed",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_RHMED,
                        "sql" => SQL_NO_PERK_RHMED, 
                        "kategori" => "RHMED"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'DOKTER': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_sps",
                    "data" => array(
                        "dbf" => DBF_DOKTER,
                        "sql" => SQL_DOKTER, 
                        "kategori" => "DOKTER"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'DS_TARIF': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "ds_tarif",
                    "data" => array(
                        "dbf" => DBF_DS_TARIF,
                        "sql" => SQL_DS_TARIF, 
                        "kategori" => "DS_TARIF"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'JANTUNG': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_jantung",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_JANTUNG,
                        "sql" => SQL_NO_PERK_JANTUNG, 
                        "kategori" => "JANTUNG"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
            case 'HD': 
                $data_post = array(
                    "section" => "sqlsync", 
                    "option" => "no_perk_hd",
                    "data" => array(
                        "dbf" => DBF_NO_PERK_HD,
                        "sql" => SQL_NO_PERK_HD, 
                        "kategori" => "HD"
                    )
                ); 
                $data_post = json_encode($data_post);
                $data_result = post_url_bridge($data_post); 
                break; 
        }


        $data = (object) array(
            'status' => true, 
            'data' => json_decode($data_result)
        );
        echo json_encode($data);
    }
    
    public function upload_ro()
    {
        $this->load->model('penunjang');

        $no_reg  = $this->input->post('no_reg');

        $capture = $_FILES;
        $dir     = FCPATH . "assets/100/rme/ro/$no_reg/";
        if (file_exists($dir)) { } else {
            mkdir($dir, 0777);
        }
        $config['upload_path'] = $dir;
        //$config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload', $config);

        $status  = false;
        $message = "STILL DID NOT MOVE";
        $ext     = '';

        if (isset($_FILES)) {
            $token = $this->input->post('token_foto');
            $path  = $this->input->post('path');
            $file  = $this->upload->data('file_name');

            $tempFile   = $_FILES['file']['tmp_name'];
            $file       = $_FILES['file']['name'];
            $ext        = ltrim(strstr($file, '.'), '.');
            $targetFile = $dir . date('YmdHis') . '.' . $ext;

            if (move_uploaded_file($tempFile, $targetFile) && is_writable($dir)) {
                $message = "file moved successfully";

                $image       = new Penunjang;
                $image->file = date('YmdHis') . '.' . $ext;
                $image->token = $token;
                $image->no_reg  = $no_reg;
                $image->dept    = 9;
                $image->tanggal = date('Y-m-d');
                DB::transaction(function () use ($image, &$status) {
                    $image->save();
                    $status = true;
                });
            }
        }

        $data = (object) array(
            'no_reg'   => $no_reg,
            'ext'      => $ext,
            'tempFile' => $path,
            'reg'      => $reg,
            'file'     => $file,
            'status'   => $status,
            'message'  => $message,
            'capture'  => $_FILES,
        );
        echo json_encode($data);
    }
    public function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }
    
    public function jadwal() {
        $kd_dr = $this->input->post('kd_dr');
        $kd_poli = $this->input->post('kd_poli');
        $hari = $this->input->post('hari'); 
        $waktu = $this->input->post('waktu'); 
        $mulai = $this->input->post('mulai'); 
        $selesai = $this->input->post('selesai'); 
        $praktek = $this->input->post('praktek'); 
        $kuota = $this->input->post('kuota');
        $this->load->model('Jadwal');
        $data = (array) null;
        if (!empty($kd_dr) && $kd_dr != '') {
            foreach ($hari as $key => $value) {
                if (!empty($mulai[$key]) || !empty($selesai[$key]) || !empty($praktek[$key]) || !empty($kuota[$key])) {
                    $data[] = array(
                        "hari" => $value, 
                        "waktu" => $waktu[$key], 
                        "mulai" => $mulai[$key], 
                        "selesai" => $selesai[$key], 
                        "praktek" => $praktek[$key], 
                        "kuota" => $kuota[$key], 
                    ); 
                    $jadwal = Jadwal::where('kd_dr', $kd_dr)->where('kd_poli', $kd_poli)->where('hari', strtoupper($value))->where('waktu', strtoupper($waktu[$key]))->whereNull('deleted')->first();
                    if (!empty($jadwal)) {
                        if ($jadwal->waktu == $waktu[$key] && substr($jadwal->awal, 0, 5) == $mulai[$key] && substr($jadwal->akhir, 0, 5) == $selesai[$key] && $jadwal->praktek == $praktek[$key] && $jadwal->kuota == $kuota[$key]) {

                        } else {
                            $id_jadwal = $jadwal->id; 
                            $deleted_by = null; 
                            $sess = sess_on('auth');
                            if (isset($sess->sessid)) {
                                $deleted_by= $sess->user_id;
                            } 
                            $jadwal = Jadwal::where('id', $id_jadwal)
                                            ->update(
                                                array(
                                                    'deleted'    => date("Y-m-d H:i:s"), 
                                                    'deleted_by'    => $deleted_by,
                                                    )
                                                );
                            $jadwal = new Jadwal; 
                            $jadwal->kd_dr = $kd_dr; 
                            $jadwal->kd_poli = $kd_poli; 
                            $jadwal->hari = strtoupper($value);
                            $jadwal->waktu = $waktu[$key]; 
                            $jadwal->awal = $mulai[$key]; 
                            $jadwal->akhir = $selesai[$key];
                            $jadwal->praktek = $praktek[$key]; 
                            if (empty($kuota[$key])) {
                                $jadwal->kuota = NULL;
                            } else {
                                $jadwal->kuota = $kuota[$key];
                            }
                            $jadwal->registered = date("Y-m-d H:i:s"); 
                            $sess = sess_on('auth');
                            if (isset($sess->sessid)) {
                                $jadwal->registered_by = $sess->user_id;
                            } 
                            $jadwal->save();
                        }
                    } else {
                        $jadwal = new Jadwal; 
                        $jadwal->kd_dr = $kd_dr; 
                        $jadwal->kd_poli = $kd_poli; 
                        $jadwal->hari = strtoupper($value);
                        $jadwal->waktu = $waktu[$key]; 
                        $jadwal->awal = $mulai[$key]; 
                        $jadwal->akhir = $selesai[$key];
                        $jadwal->praktek = $praktek[$key]; 
                        if (empty($kuota[$key])) {
                            $jadwal->kuota = NULL;
                        } else {
                            $jadwal->kuota = $kuota[$key];
                        }
                        $jadwal->registered = date("Y-m-d H:i:s"); 
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $jadwal->registered_by = $sess->user_id;
                        } 
                        $jadwal->save();
                    }
                }
            } 
        }
        echo json_encode($data); 
    }

    public function antrol() {
        include('save.controllers/antrol.save.php');
    }
    public function antrol_bpjs() {
        include('save.controllers/antrol_bpjs.save.php');
    }
    public function kontrol() {
        include('save.controllers/kontrol.save.php');
    }
    public function modsoap() {
        include('save.controllers/modsoap.save.php');
    }
    public function kontrol_date() {
        include('save.controllers/kontrol_date.save.php');
    }

    public function simpan_log($val) {
        $writer = "";
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        $this->load->model('System_log');
        $log = new System_log;
		$log->log = json_encode($val);
		$log->submitted = date("Y-m-d H:i:s");
		$log->submitted_by = $writer; 
		DB::transaction(function () use ($log) {
			$log->save();
		});
	}

    public function triase() {
        include('save.controllers/triase.php');
    }

    public function rawat_inap() {
        include('save.controllers/rawat_inap.save.php');
    }

    public function dbf() {
        include('save.controllers/dbf.save.php');
    }

    public function diag_rj() {
        include('save.controllers/diag_rj.save.php');
    }
    public function diag_rj_rm() {
        include('save.controllers/diag_rj_rm.save.php');
    }
    public function diag_ri_rm() {
        include('save.controllers/diag_ri_rm.save.php');
    }
    public function simpan_grouping()
    {
        include('save.controllers/simpan_grouping.save.php');
    }
    public function simpan_tarif()
    {
        include('save.controllers/simpan_tr_op.save.php');
    }
    public function monitoring_adm() {
        include('save.controllers/monitoring_adm.save.php');
    }
    public function monitoring_adm_gd() {
        include('save.controllers/monitoring_adm_gd.save.php');
    }

    public function pengkajian_kkb() {
        include('save.controllers/pengkajian_kkb.save.php');
    }

    public function ttd_pasien_admisi() 
    {
        include('save.controllers/ttd_pasien_admisi.save.php');
    }

    /*jadwal HD*/
    public function rawat_hd() {
        include('save.controllers/rawat_hd.save.php');
    }

}
