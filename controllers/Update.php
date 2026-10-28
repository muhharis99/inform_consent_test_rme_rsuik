<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Update extends MY_Controller
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
    
    public function bill() {
        $this->load->model('gigi_db5j');
        $this->load->model('gigi_db5j_writer');
        $this->load->model('gigi_db5');
        $this->load->model('gigi_db5_writer');
        $this->load->model('sps_db5j');
        $this->load->model('sps_db5j_writer');
        $this->load->model('sps_db5');
        $this->load->model('sps_db5_writer');
        $this->load->model('umum_db5j');
        $this->load->model('umum_db5j_writer');
        $this->load->model('umum_db5');
        $this->load->model('umum_db5_writer');
        $this->load->model('umum_db5l');
        $this->load->model('umum_db5l_writer');
        $this->load->model('rhmed_db5j');
        $this->load->model('rhmed_db5j_writer');
        $this->load->model('rhmed_db5');
        $this->load->model('rhmed_db5_writer');
        $this->load->model('jantung_db5j');
        $this->load->model('jantung_db5j_writer');
        $this->load->model('jantung_db5');
        $this->load->model('jantung_db5_writer');
        $this->load->model('hd_db5j');
        $this->load->model('hd_db5j_writer');
        $this->load->model('hd_db5');
        $this->load->model('hd_db5_writer');
        $this->load->model('ugd_db5j');
        $this->load->model('ugd_db5j_writer');
        $this->load->model('ugd_db5');
        $this->load->model('ugd_db5_writer');
        $this->load->model('spm');
        $this->load->model('spmpjt');
        $this->load->model('spmhd');
        $this->load->model('spmigd');
        $no_reg = $this->input->post('no_reg');
        $dokter = $this->input->post('dokter');
        $bill = $this->input->post('bill');
        $tgl_rs = $this->input->post('tgl_rs');
        $tgl_masuk = date("Y-m-d", strtotime($tgl_rs));
        $jam_masuk = date("H:i:s", strtotime($tgl_rs)); 
        $nota = $this->input->post('nota_transaksi');
        $tanggal = date("Y-m-d"); 
        $jam = date("H:i:s");
        $noperk = $this->input->post('noperk');
        $satuan = $this->input->post('satuan');
        $persen = $this->input->post('persen');
        $rupiah = $this->input->post('rupiah');
        $tarip = $this->input->post('tarip');
        $total = $this->input->post('total');
        $kddr = $this->input->post('kddr');
        $jasa_dr = $this->input->post('jasa_dr');
        $jasa_dr_rp = $this->input->post('jasa_dr_rp');
        $kom1 = $this->input->post('kom1');
        $kom2 = $this->input->post('kom2');
        $kom3 = $this->input->post('kom3');
        $kom4 = $this->input->post('kom4');
        $kom5 = $this->input->post('kom5');
        $kom6 = $this->input->post('kom6');
        $kom7 = $this->input->post('kom7');
        $kom8 = $this->input->post('kom8');
        $kom9 = $this->input->post('kom9');
        $kom10 = $this->input->post('kom10');
        $jasmed_dr = $this->input->post('jasmed_dr');
        $jasmed_pr = $this->input->post('jasmed_pr');
        $bhp = $this->input->post('bhp');
        $kwanta = 1; 
        $no_rel = "";
        $no_rel = $this->input->post('asuransi_id');
        $bangsal = "";
        $bangsal = $this->input->post('poli');
        $pot = ""; 
        $lunas = ""; 
        $inapke = "";
        $operator = ""; 
        $kode = ""; 
        $pulang = "";
        $cetak = ""; 
        $sistem = "";
        $no_rek = "k4netjs";
        $writed = date("Y-m-d H:i:s"); 
        $writer = "";
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        $registered = date("Y-m-d H:i:s");
        $id_db5j = null;
        $xdb5j = [];
        $xdr = [];
        $xkey = [];
        
        $zunit = ""; 
        $zpath = ""; 
        $source = "";
        $db5_exist = null;
        $spm_exist = null;
        switch ($bill) {
            case 'GIGIRJ' : 
                $zunit = "P_GIGI"; 
                $zpath = "GIGI";
                $source = "gigi_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Gigi_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Gigi_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Gigi_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Gigi_db5j_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Gigi_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 
            case 'GIGIRI' : 
                $zunit = "P_GIGI"; 
                $zpath = "GIGI";
                $source = "gigi_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Gigi_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Gigi_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Gigi_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Gigi_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Gigi_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

            case 'SPSRJ' : 
                $zunit = "P_SPS"; 
                $zpath = "SPS";
                $source = "sps_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Sps_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Sps_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Sps_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Sps_db5j_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Sps_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 
            case 'SPSRI' : 
                $zunit = "P_SPS"; 
                $zpath = "SPS";
                $source = "sps_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Sps_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Sps_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Sps_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Sps_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Sps_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

            case 'UMUMRJ' : 
                $zunit = "P_UMUM"; 
                $zpath = "UMUM";
                $source = "umum_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Umum_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Umum_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Umum_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Umum_db5j_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Umum_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 
            case 'UMUMRI' : 
                $zunit = "P_UMUM"; 
                $zpath = "UMUM";
                $source = "umum_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Umum_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Umum_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Umum_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Umum_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Umum_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 
            case 'UMUMRL' : 
                $zunit = "P_UMUM"; 
                $zpath = "UMUM";
                $source = "umum_db5l";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Umum_db5l::where('no_reg', $no_reg)->where('dokter', $dokter)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Umum_db5l::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Umum_db5l::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Umum_db5l_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Umum_db5l_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

            case 'RHMDRJ' : 
                $zunit = "RHMED"; 
                $zpath = "RHMED";
                $source = "rhmed_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Rhmed_db5j::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Rhmed_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Rhmed_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Rhmed_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 

            case 'RHMDRI' : 
                $zunit = "RHMED"; 
                $zpath = "RHMED";
                $source = "rhmed_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Rhmed_db5::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Rhmed_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Rhmed_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Rhmed_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Rhmed_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

            case 'CATHRJ' : 
                $zunit = "PJANTUNG"; 
                $zpath = "PJANTUNG";
                $source = "jantung_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Jantung_db5j::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Jantung_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Jantung_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Jantung_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Jantung_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 
                        
                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmpjt where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 

                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmpjt where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 

            case 'CATHRI' : 
                $zunit = "PJANTUNG"; 
                $zpath = "PJANTUNG";
                $source = "jantung_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Jantung_db5::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Jantung_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Jantung_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Jantung_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Jantung_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 
            case 'HDRJ' : 
                $zunit = "HD"; 
                $zpath = "HD";
                $source = "hd_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Hd_db5j::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Hd_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Hd_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Hd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Hd_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 
                        
                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmhd where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 
                        
                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmhd where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break; 

            case 'HDRI' : 
                $zunit = "HD"; 
                $zpath = "HD";
                $source = "hd_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Hd_db5::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Hd_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Hd_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Hd_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Hd_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

            case 'UGDRJ' : 
                $zunit = "UGD"; 
                $zpath = "UGD";
                $source = "ugd_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Ugd_db5j::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5j_exist = Ugd_db5j::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->get();
                }
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    foreach($db5j_exist as $row) {
                        $db5j_update = Ugd_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5j_writer_exist = Ugd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->get();
                if (count($db5j_writer_exist) > 0) {
                    foreach($db5j_writer_exist as $row) {
                        $db5j_update = Ugd_db5j_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* hapus data di spm rawat jalan */
                if (!empty($nota)) {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 
                        
                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmigd where no_reg='$no_reg' and no_kwt = '$nota' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                } else {
                    // $spm_exist = Spm::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('kode', $zpath)->whereNull('deleted')->get();
                    $spm_exist = DB::select("select * from dbfile.spm where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    if (count($spm_exist) > 0) { 
                        
                    } else {
                        $spm_exist = DB::select("select * from dbfile.spmigd where no_reg='$no_reg' and tanggal='$tgl_masuk' and kode='$zpath' and deleted is null ");
                    }
                }
                if (count($spm_exist) > 0) {
                    $this->simpan_log($spm_exist); 
                    foreach($spm_exist as $row) {
                        $row = (object) $row;
                        $db5j_update = Spm::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                $db5_exist = $db5j_exist;
                break;

            case 'UGDRI' : 
                $zunit = "UGD"; 
                $zpath = "UGD";
                $source = "ugd_db5";
                /* 
                cari di db5 tgl dan jam masuk,
                jika ada di deleted 
                */
                if (!empty($nota)) {
                    $db5_exist = Ugd_db5::where('no_reg', $no_reg)->where('no_tran', $nota)->whereNull('deleted')->get();
                } else {
                    $db5_exist = Ugd_db5::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                }
                if (count($db5_exist) > 0) {
                    $this->simpan_log($db5_exist); 
                    foreach($db5_exist as $row) {
                        $db5_update = Ugd_db5::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                /* simpan writer */
                $db5_writer_exist = Ugd_db5_writer::where('no_reg', $no_reg)->where('dokter', $dokter)->where('tgl_masuk', $tgl_masuk)->get();
                if (count($db5_writer_exist) > 0) {
                    foreach($db5_writer_exist as $row) {
                        $db5_update = Ugd_db5_writer::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                    }
                }
                // die(json_encode($db5_exist));
                $db5_exist = $db5_exist;
                break; 

        }
        if (!empty($db5_exist)) {

            $data_post = array(
                "section" => "dbf", 
                "option" => "delete",
                "data" => array(
                    "source" => $source,
                    "db5" => $db5_exist,
                    "tanggal_masuk" => $tgl_masuk,
                    "spm" => $spm_exist
                )
            ); 
            $data_post = json_encode($data_post);
            $data_post_result = post_url_bridge($data_post); 
        }

        $data = array(
            "status" => true,
            "no_reg" => $no_reg,
        );
        echo json_encode($data); 
    }

    public function bill_delete() {
        $this->load->model('gigi_db5j');
        $this->load->model('gigi_db5j_writer');
        $this->load->model('gigi_db5');
        $this->load->model('gigi_db5_writer');
        $this->load->model('sps_db5j');
        $this->load->model('sps_db5j_writer');
        $this->load->model('sps_db5');
        $this->load->model('sps_db5_writer');
        $this->load->model('umum_db5j');
        $this->load->model('umum_db5j_writer');
        $this->load->model('umum_db5');
        $this->load->model('umum_db5_writer');
        $this->load->model('umum_db5l');
        $this->load->model('umum_db5l_writer');
        $this->load->model('rhmed_db5j');
        $this->load->model('rhmed_db5j_writer');
        $this->load->model('rhmed_db5');
        $this->load->model('rhmed_db5_writer');
        $this->load->model('spm');
        $no_reg = $this->input->post('no_reg');
        $poli = $this->input->post('poli');
        $dokter = $this->input->post('dokter');
        $bill = $this->input->post('bill');
        $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
        $nota = $this->input->post('nota');
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        $registered = date("Y-m-d H:i:s");
        $id_db5j = null;
        $xdb5j = [];
        $xdr = [];
        $xkey = [];
        
        $zunit = ""; 
        $zpath = ""; 
        $source = "";
        $db5_exist = null;
        $spm_exist = null;
        $tgl_masuk = ""; 
        $jam_masuk = "";
        switch ($bill) {
            case 'RHMDRJ' : 
                $zunit = "RHMED"; 
                $zpath = "RHMED";
                $source = "rhmed_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Rhmed_db5j::where('no_reg', $no_reg)->where('tanggal', $tanggal)->where('no_tran', $nota)->where('kd_dr', $dokter)->whereNull('deleted')->get();
                } 
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    $tgl_masuk = ""; 
                    $jam_masuk = "";
                    $db5_dokter = "";
                    $db5_noperk = "";
                    foreach($db5j_exist as $row) {
                        $db5j_update = Rhmed_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => $registered, 
                                                'deleter'    => $writer,
                                                )
                                            );
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk; 
                        $db5_dokter = $row->dokter; 
                        $db5_noperk = $row->no_perk; 
                    }
                    /* simpan writer */
                    $db5j_writer_exist = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('dokter', $db5_dokter)->where('no_perk', $db5_noperk)->get();
                    if (count($db5j_writer_exist) > 0) {
                        foreach($db5j_writer_exist as $row) {
                            $db5j_update = Rhmed_db5j_writer::where('id', $row->id)
                                            ->update(
                                                array(
                                                    'deleted'    => $registered, 
                                                    'deleter'    => $writer,
                                                    )
                                                );
                        }
                    }
                    /* hapus data di spm rawat jalan */
                    if (!empty($nota)) {
                        $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                        if (count($spm_exist) > 0) {
                            $this->simpan_log($spm_exist); 
                            foreach($spm_exist as $row) {
                                $db5j_update = Spm::where('id', $row->id)
                                                ->update(
                                                    array(
                                                        'deleted'    => $registered, 
                                                        'deleter'    => $writer,
                                                        )
                                                    );
                            }
                        }
                    }
                }
               
                
                $db5_exist = $db5j_exist;
                break; 
        }
        if (!empty($db5_exist)) {

            $data_post = array(
                "section" => "dbf", 
                "option" => "delete",
                "data" => array(
                    "source" => $source,
                    "db5" => $db5_exist,
                    "tanggal_masuk" => $tgl_masuk,
                    "spm" => $spm_exist
                )
            ); 
            $data_post = json_encode($data_post);
            $data_post_result = post_url_bridge($data_post); 
        }

        $data = array(
            "status" => true,
            "no_reg" => $no_reg,
        );
        echo json_encode($data); 
    }

    public function bill_undelete() {
        $this->load->model('gigi_db5j');
        $this->load->model('gigi_db5j_writer');
        $this->load->model('gigi_db5');
        $this->load->model('gigi_db5_writer');
        $this->load->model('sps_db5j');
        $this->load->model('sps_db5j_writer');
        $this->load->model('sps_db5');
        $this->load->model('sps_db5_writer');
        $this->load->model('umum_db5j');
        $this->load->model('umum_db5j_writer');
        $this->load->model('umum_db5');
        $this->load->model('umum_db5_writer');
        $this->load->model('umum_db5l');
        $this->load->model('umum_db5l_writer');
        $this->load->model('rhmed_db5j');
        $this->load->model('rhmed_db5j_writer');
        $this->load->model('rhmed_db5');
        $this->load->model('rhmed_db5_writer');
        $this->load->model('spm');
        $no_reg = $this->input->post('no_reg');
        $poli = $this->input->post('poli');
        $dokter = $this->input->post('dokter');
        $bill = $this->input->post('bill');
        $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
        $get_deleted = date("Y-m-d H:i:s", $this->input->post('dihapus'));
        $nota = $this->input->post('nota');
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        $registered = date("Y-m-d H:i:s");
        $id_db5j = null;
        $xdb5j = [];
        $xdr = [];
        $xkey = [];
        
        $zunit = ""; 
        $zpath = ""; 
        $source = "";
        $db5_exist = null;
        $spm_exist = null;
        $tgl_masuk = ""; 
        $jam_masuk = "";
        switch ($bill) {
            case 'RHMDRJ' : 
                $zunit = "RHMED"; 
                $zpath = "RHMED";
                $source = "rhmed_db5j";
                /* 
                cari di db5j tgl dan jam masuk,
                jika ada dideleted 
                */
                if (!empty($nota)) {
                    $db5j_exist = Rhmed_db5j::where('no_reg', $no_reg)->where('tanggal', $tanggal)->where('no_tran', $nota)->where('kd_dr', $dokter)->where('deleted', $get_deleted)->get();
                } 
                if (count($db5j_exist) > 0) {
                    $this->simpan_log($db5j_exist); 
                    $tgl_masuk = ""; 
                    $jam_masuk = "";
                    $db5_dokter = "";
                    $db5_noperk = "";
                    foreach($db5j_exist as $row) {
                        $db5j_update = Rhmed_db5j::where('id', $row->id)
                                        ->update(
                                            array(
                                                'deleted'    => NULL, 
                                                'deleter'    => $writer,
                                                'modified'   => $registered
                                                )
                                            );
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk; 
                        $db5_dokter = $row->dokter; 
                        $db5_noperk = $row->no_perk; 
                    }
                    /* simpan writer */
                    $db5j_writer_exist = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('dokter', $db5_dokter)->where('no_perk', $db5_noperk)->whereNotNull('deleted')->get();
                    if (count($db5j_writer_exist) > 0) {
                        foreach($db5j_writer_exist as $row) {
                            $db5j_update = Rhmed_db5j_writer::where('id', $row->id)
                                            ->update(
                                                array(
                                                    'deleted'    => NULL, 
                                                    'deleter'    => $writer,
                                                    'modified'   => $registered
                                                    )
                                                );
                        }
                    }
                    /* hapus data di spm rawat jalan */
                    if (!empty($nota)) {
                        $spm_exist = Spm::where('no_reg', $no_reg)->where('no_kwt', $nota)->where('kode', $zpath)->where('tgl_masuk', $tgl_masuk)->get();
                        if (count($spm_exist) > 0) {
                            $this->simpan_log($spm_exist); 
                            foreach($spm_exist as $row) {
                                $db5j_update = Spm::where('id', $row->id)
                                                ->update(
                                                    array(
                                                        'deleted'    => NULL, 
                                                        'deleter'    => $writer,
                                                        'modified'   => $registered
                                                        )
                                                    );
                            }
                        }
                    }
                }
               
                
                $db5_exist = $db5j_exist;
                break; 
        }
        if (!empty($db5_exist)) {

            $data_post = array(
                "section" => "dbf", 
                "option" => "undelete",
                "data" => array(
                    "source" => $source,
                    "db5" => $db5_exist,
                    "tanggal_masuk" => $tgl_masuk,
                    "spm" => $spm_exist
                )
            ); 
            $data_post = json_encode($data_post);
            $data_post_result = post_url_bridge($data_post); 
        }

        $data = array(
            "status" => true,
            "no_reg" => $no_reg,
        );
        echo json_encode($data); 
    }


    public function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
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
    
    public function service() {
        $name = segment(4);
        if (empty($name)) {
            die('ToT'); 
        } else {
            $file_path = FCPATH."application/modules/bill/views/".$name.".php";
            if (file_exists($file_path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: '.mime_content_type($file_path));
                header('Content-Disposition: attachment; filename='.basename($file_path));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_path));
                ob_clean();
                flush();
                readfile($file_path);
                exit;
            } else {
                die('service '.$name.' not available'); 
            }
        }
    }
    
    public function rawat_inap() {
        include('update.controllers/rawat_inap.update.php');
    }
    public function sip_dokter() {
        include('update.controllers/sip_dokter.update.php');
    }
    public function sep_kunjungan() {
        include('update.controllers/sep_kunjungan.update.php');
    }
}
