<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Search extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_register');

        $this->load->model('soap');
        $this->load->model('pasien');
        $this->load->model('poli');
        $this->load->model('dokter');
        $this->load->model('askep');
        $this->load->model('dokter_poli');
        $this->load->helper('post_url_bridge');
    }
    private function obj($data) {
        return (object) collect($data)->first();
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

        $dsmf = '';
        $nsmf = '';
        $sps = false;
        $dokter = false;
        $dr = Dokter::find($nik);
        if(count($dr) > 0)
        {
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
        );

        return $data;

    }
    public function get_sess()
    {

        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');
        $this->load->model('bangsal');
        $this->load->model('smf');

        $nik = false;
        $unit = false;
        $userid = '';
        $nama = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $nik = $sess->user;
            $userid = $sess->user_id;
        }

        $induk = false;
        $field = array('karya.unit', 'karya.nama');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        if(count($karya) > 0)
        {
            $unit = $karya->unit;
            $nama = $karya->nama;
            $unit = Unit::where('no_unit', $unit)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
            }
        }

        $dsmf = '';
        $nsmf = '';
        $sps = false;
        $dokter = false;
        $dr = Dokter::find($nik);
        if(count($dr) > 0)
        {
            $sps = $dr->sps_id;
            $nama = $dr->nama2;
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
            'nama' => $nama,
            'userid' => $userid,
            'unit' => $unit,
        );

        echo json_encode($data);
    }
    public function akses()
    {
        $this->load->model('user_log');
        $this->load->model('user');
        $this->load->model('dokter');
        $this->load->model('karyawan');
        $this->load->model('dokter_spesialis');
        $this->load->model('praktek');
        $this->load->model('absen');

        $userid  = $this->input->post('id');
        $kode    = $this->input->post('kode');
        $userid  = strtoupper($userid);
        $dpass   = '';
        $tanggal = date('Y-m-d');
        $sess    = sess_on('auth');

        $status = false;
        $nama   = '';
        $data   = array();
        $field  = array('id', 'user', 'pass', 'skey', 'domain');
        $users  = User::where('user', $userid)->where('status', 1)->first($field);
        if (count($users) > 0) {
            $id    = $users->id;
            $user  = $users->user;
            $pass  = $users->pass;
            $skey  = $users->skey;
            $domain  = $users->domain;
            $dpass = deco($pass, $skey);
            if (strtoupper($kode) == $dpass)
            //$dpass     = dny(strtoupper($kode), $skey);
            //if($pass == $dpass->epassword)
            {
                $minutes_to_add = 15;
                $registered     = date('Y-m-d H:i:s');
                $time           = new DateTime($registered);
                $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $ended = $time->format('Y-m-d H:i:s');

                if (isset($sess->sessid)) {
                    $sessid = $sess->sessid;
                }


                $user_log             = User_Log::firstOrNew(array('token' => $sessid, 'tanggal' => $tanggal));
                $user_log->user_id    = $id;
                $user_log->token      = $sessid;
                $user_log->tanggal    = $tanggal;
                $user_log->registered = $registered;
                $user_log->ended      = $ended;
                DB::transaction(function () use ($user_log, &$sessid, &$status) {
                    $user_log->save();
                    $status = true;
                });

                /*
                $user_log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'));
                if(count($user_log) > 0)
                {
                DB::transaction(function () use ($user_log, &$sessid, &$tanggal, &$registered, &$ended, &$status) {
                $user_log->update(array('user_id' => $id, 'token' => $sessid, 'tanggal' => $tanggal, 'registered' => $registered, 'ended' => $ended));
                $status = true;
                });
                }
                else
                {
                $user_log = new User_log();
                $user_log->user_id    = $id;
                $user_log->token    = $sessid;
                $user_log->tanggal    = $tanggal;
                $user_log->registered    = $registered;
                $user_log->ended    = $ended;
                DB::transaction(function () use ($user_log, &$sessid, &$status) {
                $user_log->save();
                $status = true;
                });
                }
                 */

                $data = array(
                    'sessid'     => $sessid,
                    'user'       => $user,
                    'user_id'    => $id,
                    'date'       => $tanggal,
                    'registered' => $registered,
                    'ended'      => $ended,
                    'domain' => $domain,
                );
                sess_set('auth', $data);

                $user = '';
                $sess = sess_on('auth');
                if (isset($sess->sessid)) {
                    $user = $sess->user;
                }

                $izin = '';
                $jam1 = '';
                $jam2 = '';
                $sjam1 = '';
                $hari = date('N', strtotime($registered));
                $praktek = Praktek::join('dokter_spesialis as b', 'dokter_spesialis_id', '=', 'b.id')->where('hari', $hari)->where('b.dokter_id', $userid)->orderBy('jam1', 'asc')->get(array('b.dokter_id', 'jam1', 'jam2'));


                $karyawan = Karyawan::find($user);
                if (count($karyawan) > 0) {
                    $nama = $karyawan->nama;
                } else {
                    $dokter = Dokter::find($user);
                    if (count($dokter) > 0) {
                        $nama = $dokter->nama2;

                        if(count($praktek) > 0)
                        {
                            foreach ($praktek as $prkt) {
                                $izin = $prkt->izin;
                                $jam1 = $prkt->jam1;
                                $jam2 = $prkt->jam2;
                                $sjam1 = date('H', strtotime('-1 hour',strtotime($jam1)));
                                if(date('H', strtotime($registered)) >= $sjam1)
                                //if ($jam1<>'')
                                {
                                    $absen             = Absen::firstOrNew(array('user_id' => $id, 'tanggal' => $tanggal, 'jam1' => $jam1));
                                    if($absen->exists)
                                    {
                                    }
                                    else
                                    {
                                        $absen->user_id    = $id;
                                        $absen->dokter_id    = $userid;
                                        $absen->izin    = $izin;
                                        $absen->tanggal    = $tanggal;
                                        $absen->hari    = $hari;
                                        $absen->jam1      = $jam1;
                                        $absen->jam2      = $jam2;
                                        $absen->registered      = $registered;
                                        DB::transaction(function () use ($absen, &$status) {
                                            $absen->save();
                                            $status = true;
                                        });
                                    }
                                }
                            }
                        }


                    }
                }
            }
        }

        $data = array(
            'status' => $status,
            'user'   => $nama,
            'userid' => $userid,
            'dpass'  => $dpass,
        );
        echo json_encode($data);
    }
    public function jadwal() {

        $klinik  = $this->input->get('klinik');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $this->load->model('Jadwal'); 
        $datas   = array();
        $total  = 0;
    
        
        $sessid = '';
        $akses = '';
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $sessid = $sess->user;
        }

        switch ($klinik) {
            case 'eksekutif' :
                $query = "  SELECT 
                                a.kode_poli, 
                                a.nama_poli, 
                                c.no_dr AS kode_dokter,
                                c.nama2 AS nama_dokter 
                            FROM 
                                rsiklaten.poli a 
                                RIGHT JOIN rme.dokter b 
                                    ON a.kode_poli = b.kd_poli
                                LEFT JOIN rsiklaten.dokter c 
                                    ON b.kd_dokter = c.no_dr 
                            WHERE 
                                a.report_nama = 'EKSEKUTIF'"; 
                if (!empty($search)) {
                    $query .= " and (c.nama2 like '%$search%' or c.no_dr like '%$search%')"; 
                }
                $query .= " ORDER BY 
                                a.nama_poli ASC,
                                c.nama2 ASC"; 
                $rows = DB::select($query); 
                if (!empty($rows)) {
                    $no = 1; 
                    foreach ($rows as $row) {
                        $row = (object) $row;
                        $row->no = $no;  
                        $arr_hari = ["SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU", "AHAD"];
                        $arr_waktu = ["PAGI", "SORE"];
                        foreach ($arr_hari as $key=>$hari) {
                            foreach ($arr_waktu as $key=>$waktu) {
                                $str_waktu = strtolower($hari)."_".strtolower($waktu)."_waktu"; 
                                $str_mulai = strtolower($hari)."_".strtolower($waktu)."_mulai"; 
                                $str_selesai = strtolower($hari)."_".strtolower($waktu)."_selesai"; 
                                $str_praktek = strtolower($hari)."_".strtolower($waktu)."_praktek"; 
                                $str_kuota = strtolower($hari)."_".strtolower($waktu)."_kuota"; 
                                $str_hari = strtolower($hari); 
                                $row->{$str_waktu} = "";
                                $row->{$str_mulai} = "";
                                $row->{$str_selesai} = "";
                                $row->{$str_praktek} = "";
                                $row->{$str_kuota} = "";
                                $row->{$str_hari} = "";
                            }
                        }
                        $rows_jadwal = Jadwal::where('kd_poli', $row->kode_poli)->where('kd_dr', $row->kode_dokter)->whereNull('deleted')->get();
                        if (!empty($rows_jadwal)) {
                            foreach ($arr_hari as $key=>$hari) {
                                foreach ($arr_waktu as $key=>$waktu) {
                                    foreach ($rows_jadwal as $row_jadwal) {
                                        $row_jadwal = (object) $row_jadwal;
                                        if ($row_jadwal->hari == $hari && $row_jadwal->waktu == $waktu) {
                                            $str_waktu = strtolower($hari)."_".strtolower($waktu)."_waktu"; 
                                            $str_mulai = strtolower($hari)."_".strtolower($waktu)."_mulai"; 
                                            $str_selesai = strtolower($hari)."_".strtolower($waktu)."_selesai"; 
                                            $str_praktek = strtolower($hari)."_".strtolower($waktu)."_praktek"; 
                                            $str_kuota = strtolower($hari)."_".strtolower($waktu)."_kuota"; 
                                            $str_hari = strtolower($hari); 
                                            $row->{$str_waktu} = $row_jadwal->awal;
                                            $row->{$str_mulai} = $row_jadwal->awal;
                                            $row->{$str_selesai} = $row_jadwal->akhir;
                                            $row->{$str_praktek} = $row_jadwal->praktek;
                                            $row->{$str_kuota} = $row_jadwal->kuota;
                                            $row->{$str_hari} .= substr($row_jadwal->awal, 0, 5)."-".substr($row_jadwal->akhir, 0, 5);
                                            if (!empty($row_jadwal->kuota)) {
                                                $row->{$str_hari} .= "(".$row_jadwal->kuota.")";
                                            }
                                            $row->{$str_hari} .= "<br />";
                                        }
                                    }
                                }
                            }
                        }
                        $datas[] = $row;
                        $no ++;
                    }
                }
                break; 
        }
        $total = count($datas); 
        $data = array(
            "total" => $total,
            "rows"  => $datas,
        );
        echo json_encode($data);
    }
    public function pasien() {
        include('search.controllers/pasien.search.php');
    }

    public function umur() {
        include('search.controllers/umur.search.php');
    }

    public function riwayat() {
        /*khusus HD tak tampilkan hanya tanggal sekarang dan tanggal sebelumnya, haris*/
        $this->load->model('Kunjung');
        $no_reg                 = $this->input->get('no_reg');
        $th_bln_tgl_sekarang    = date("Y-m-d");

        $riwayat = Kunjung::where('no_reg', $no_reg)
            ->where('deletedstate', '=', 0)
            ->where('rawat', '!=', '')
            ->where(function ($query) use ($th_bln_tgl_sekarang) {
                $query->where(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->where('kd_poli', 'HD')
                             ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m-%d')"), '<=', $th_bln_tgl_sekarang);
                })
                ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->where('kd_poli', '!=', 'HD')
                             ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m-%d')"), '<=', $th_bln_tgl_sekarang);
                })
                ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->whereNull('kd_poli');
                });
            })
            ->leftJoin('rsiklaten.poli', function ($join) {
                $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
            })
            ->leftJoin('rsiklaten.dokter', function ($join) {
                $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
            })
            ->leftJoin('rsiklaten.asuransi', function ($join) {
                $join->on('kunjung.pasien', '=', 'rsiklaten.asuransi.no_rel');
            })
            ->orderBy('kunjung.tanggal', 'DESC')
            ->orderBy('kunjung.jam', 'DESC')
            ->get(array(
                'id', 'no_reg', 'rawat', 'tanggal', 'jam', 'antrian',
                DB::RAW('rsiklaten.poli.nama_poli as poli'),
                DB::RAW('rsiklaten.dokter.nama2 as dokter'),
                DB::RAW('rsiklaten.asuransi.nama as asuransi')
            ));
        // json($riwayat);
        $total = Kunjung::where('no_reg', $no_reg)
            ->where('deletedstate', '=', 0)
            ->where('rawat', '!=', '')
            ->where(function ($query) use ($th_bln_tgl_sekarang) {
                $query->where(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->where('kd_poli', 'HD')
                             ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '=', $th_bln_tgl_sekarang);
                })
                ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->where('kd_poli', '!=', 'HD')
                             ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '<=', $th_bln_tgl_sekarang);
                })
                ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                    $subquery->whereNull('kd_poli');
                });
            })
            ->leftJoin('rsiklaten.poli', function ($join) {
                $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
            })
            ->leftJoin('rsiklaten.dokter', function ($join) {
                $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
            })
            ->orderBy('kunjung.tanggal', 'DESC')->count();

        $rows = (array) null; 
        if (!empty($riwayat)) {
            foreach ($riwayat as $row) {
                $row = (object) $row;
                $row->str_tanggal = date("d-m-Y", strtotime($row->tanggal)); 
                $row->tgl_kunjung = str_replace("-", "", $row->tanggal).str_replace(":", "", $row->jam); 
                $row->str_tgl_rs = strtotime($row->tanggal." ".$row->jam);
                $rawat = 'JALAN'; 
                switch ($row->rawat) {
                    case 'G' : 
                    case 'I' :
                        $rawat = 'INAP';  
                        break;
                }
                $row->str_rawat = $rawat;
                $rows[] = $row;
            }
        }
        $data = array(
            "total" => $total, 
            "rows" => $rows
        );
        echo json_encode($data); 

        // $this->load->model('Kunjung');
        // $no_reg = $this->input->get('no_reg');
        // $riwayat = Kunjung::where('no_reg', $no_reg)->where('deletedstate', '=', 0)->where('rawat', '!=', '')
        //     ->leftJoin('rsiklaten.poli', function ($join) {
        //         $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        //     })
        //     ->leftJoin('rsiklaten.dokter', function ($join) {
        //         $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        //     })
        //     ->leftJoin('rsiklaten.asuransi', function ($join) {
        //         $join->on('kunjung.pasien', '=', 'rsiklaten.asuransi.no_rel');
        //     })
        //     ->orderBy('kunjung.tanggal', 'DESC')
        //     ->get(array('id', 'no_reg', 'rawat', 'tanggal', 'jam', 'antrian', DB::RAW('rsiklaten.poli.nama_poli as poli'), DB::RAW('rsiklaten.dokter.nama2 as dokter'), DB::RAW('rsiklaten.asuransi.nama as asuransi')));
        // $total = Kunjung::where('no_reg', $no_reg)->where('deletedstate', '=', 0)->where('rawat', '!=', '')
        //     ->leftJoin('rsiklaten.poli', function ($join) {
        //         $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        //     })
        //     ->leftJoin('rsiklaten.dokter', function ($join) {
        //         $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        //     })
        //     ->orderBy('kunjung.tanggal', 'DESC')->count();
        // $rows = (array) null; 
        // if (!empty($riwayat)) {
        //     foreach ($riwayat as $row) {
        //         $row = (object) $row;
        //         $row->str_tanggal = date("d-m-Y", strtotime($row->tanggal)); 
        //         $row->tgl_kunjung = str_replace("-", "", $row->tanggal).str_replace(":", "", $row->jam); 
        //         $row->str_tgl_rs = strtotime($row->tanggal." ".$row->jam);
        //         $rawat = 'JALAN'; 
        //         switch ($row->rawat) {
        //             case 'G' : 
        //             case 'I' :
        //                 $rawat = 'INAP';  
        //                 break;
        //         }
        //         $row->str_rawat = $rawat;
        //         $rows[] = $row;
                
        //     }
        // }
        // $data = array(
        //     "total" => $total, 
        //     "rows" => $rows
        // );
        // echo json_encode($data); 
    } 
    public function kelengkapan_data() {
        include('search.controllers/kelengkapan_data.search.php');
    }
    public function monitoring_edukasi_hambatan() {
        include('search.controllers/monitoring_edukasi_hambatan.search.php');
    }
    public function kelengkapan_data_ri() {
        include('search.controllers/kelengkapan_data_ri.search.php');
    }
    public function monitor_awal_medis() {
        include('search.controllers/monitor_awal_medis.search.php');
    }
    public function kelengkapan_data_ri_2() {
        include('search.controllers/kelengkapan_data_ri_2.search.php');
    }
    public function monitor_ibs() {
        include('search.controllers/monitor_ibs.search.php');
    }
    public function kelengkapan_data_hd() {
        include('search.controllers/kelengkapan_data_hd.search.php');
    }
    public function monitoring_hd() {
        include('search.controllers/monitoring_hd.search.php');
    }
    public function antrol_farmasi() {
        include('search.controllers/antrol_farmasi.php');
    }
    public function antrol() {
        include('search.controllers/antrol.search.php');
    }
    public function surkon() {
        include('search.controllers/surkon.search.php');
    }
    public function kontrol() {
        include('search.controllers/kontrol.search.php');
    }
    public function kontrol_inap() {
        include('search.controllers/kontrol_inap.search.php');
    }
    public function inden() {
        include('search.controllers/inden.search.php');
    }
    public function antrol_bpjs() {
        include('search.controllers/antrol_bpjs.search.php');
    }
    public function antrol_bpjs_list() {
        include('search.controllers/antrol_bpjs_list.search.php');
    }

    public function pasien_daftar_inap() {
        include('search.controllers/pasien_daftar_inap.search.php');
    }
    public function pasien_daftar_darurat() {
        include('search.controllers/pasien_daftar_darurat.search.php');
    }
    public function status_pasien_inap() {
        include('search.controllers/status_pasien_inap.search.php');
    }
    public function sep_all() {
        include('search.controllers/sep_all.search.php');
    }
    public function sep_all_cek() {
        include('search.controllers/sep_all_cek.search.php');
    }
    public function non_sep_all() {
        include('search.controllers/non_sep_all.search.php');
    }
    public function askom() {
        include('search.controllers/askom.search.php');
    }
    public function monitor_inap_adm() {
        include('search.controllers/monitor_inap_adm.search.php');
    }
    public function monitor_inap_adm_gd() {
        include('search.controllers/monitor_inap_adm_gd.search.php');
    }
    public function icd_rajal_all() {
        include('search.controllers/icd_rajal_all.search.php');
    }
    public function icd_rajal_umum() {
        include('search.controllers/icd_rajal_umum.search.php');
    }
    public function icd_ranap_umum() {
        include('search.controllers/icd_ranap_umum.search.php');
    }
    public function icd_ranap_smt() {
        include('search.controllers/icd_ranap_smt.search.php');
    }
    public function bill_ranap() {
        include('search.controllers/bill_ranap.search.php');
    }
    public function get_data_inacbg() {
        include('search.controllers/get_data_inacbg.search.php');
    }
    public function kelas_ranap_by_no_reg() {
        include('search.controllers/kelas_ranap_by_no_reg.search.php');
    }

    public function icd_rajal_gd_all() {
        include('search.controllers/icd_rajal_gd_all.search.php');
    }
    public function icd_rajal_gd_xx() {
        include('search.controllers/icd_rajal_gd_xx.search.php');
    }
    public function soap_by_id() {
        include('search.controllers/soap_by_id.search.php');
    }
    public function diag_rj_by_soap_id() {
        include('search.controllers/diag_rj_by_soap_id.search.php');
    }
    public function diag_ri_by_soap_id() {
        include('search.controllers/diag_ri_by_soap_id.search.php');
    }
    public function monitoring_adm() {
        include('search.controllers/monitoring_adm.search.php');
    }
    public function monitoring_adm_gd() {
        include('search.controllers/monitoring_adm_gd.search.php');
    }
    public function apm_finger() {
        include('search.controllers/apm_finger.search.php');
    }
    public function cek_session() {
        include('search.controllers/cek_session.search.php');
    }
    public function bahasa_pendidikan_by_rm() {
        include('search.controllers/bahasa_pendidikan_by_rm.search.php');
    }
    public function pin_repair() {
        include('search.controllers/pin_repair.search.php');
    }

    /*jadwal HD*/
    public function pasien_rawat_hd_jadwal() {
        include('search.controllers/pasien_rawat_hd_jadwal.search.php');
    }
    public function pasien_rawat_hd() {
        include('search.controllers/pasien_rawat_hd.search.php');
    }
    public function status_pasien_hd() {
        include('search.controllers/status_pasien_hd.search.php');
    }

    public function diagnosa()
    {
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
}
