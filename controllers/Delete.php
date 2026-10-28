<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Delete extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }
    public function akses()
    {
        $this->load->model('user_log');
        $this->load->model('user');

        $act = $this->input->post('action');

        $status = false;
        $data = array();

        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->sessid;
            //$user = $sess->user;
            $user = '';
            $user_id = '';
        }
        else
        {
            if(isset($act) && $act)
            {
                $sessid = session_id();
            }
            else
            {
                $sessid = $sess->sessid;
            }
            $user = '';
            $user_id = '';
        }

        if(isset($act) && $act)
        {
            $tanggal = date('Y-m-d');
            $minutes_to_add = 30;
            $registered = date('Y-m-d H:i:s');
            $time = new DateTime($registered);
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $ended = $time->format('Y-m-d H:i:s');

            $user_log          = User_Log::firstOrNew(array('token' => $sessid, 'tanggal' => $tanggal));
            $log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'));
            if(count($log->get()) > 0)
            {
                if(isset($logout))
                {
                    $user = '';
                    $user_id = '';
                }
            }
            else
            {
                $user = '';
                $user_id = '';
                $user_log->user_id    = '';
            }

            $user_log->user_id    = $user;
            $user_log->token    = $sessid;
            $user_log->tanggal    = $tanggal;
            $user_log->ended    = $ended;
            DB::transaction(function () use ($user_log, &$sessid, &$status) {
                $user_log->save();
                $status = true;
            });

            $data = array(
                'sessid' => $sessid,
                'user' => $user,
                'user_id' => $user_id,
                'date' => $tanggal,
                'registered' => $registered,
                'ended' => $ended,
            );
            sess_set('auth', $data);
        }

        $data = array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    public function user()
    {
        $this->load->model('user_log');

        $status = false;
        $sess = sess_on('auth');
        $userid = $sess->user_id;
        $register = User_Log::where('user_id', $userid)->where('tanggal', date('Y-m-d'));
        if(count($register) > 0)
        {           
            DB::transaction(function () use ($register, &$status) {
                $register->delete();
                $status = true;
            });
        }
        $data = array('userid' => $userid, 'status' => 'logout');
        echo json_encode($data);
    }
    public function akses_sess()
    {
        $this->load->model('user_log');
        $this->load->model('user');

        $act = true;

        $status = false;
        $data = array();

        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $sessid = $sess->sessid;
            //$user = $sess->user;
            $user = '';
            $user_id = '';
        }
        else
        {
            if(isset($act) && $act)
            {
                $sessid = session_id();
            }
            else
            {
                $sessid = $sess->sessid;
            }
            $user = '';
            $user_id = '';
        }

        if(isset($act) && $act)
        {
            $tanggal = date('Y-m-d');
            $minutes_to_add = 30;
            $registered = date('Y-m-d H:i:s');
            $time = new DateTime($registered);
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $ended = $time->format('Y-m-d H:i:s');

            $user_log          = User_Log::firstOrNew(array('token' => $sessid, 'tanggal' => $tanggal));
            $log = User_Log::where('token', $sessid)->where('ended', '>=', date('Y-m-d H:i:s'));
            if(count($log->get()) > 0)
            {
                if(isset($logout))
                {
                    $user = '';
                    $user_id = '';
                }
            }
            else
            {
                $user = '';
                $user_id = '';
                $user_log->user_id    = '';
            }

            $user_log->user_id    = $user;
            $user_log->token    = $sessid;
            $user_log->tanggal    = $tanggal;
            $user_log->ended    = $ended;
            DB::transaction(function () use ($user_log, &$sessid, &$status) {
                $user_log->save();
                $status = true;
            });

            $data = array(
                'sessid' => $sessid,
                'user' => $user,
                'user_id' => $user_id,
                'date' => $tanggal,
                'registered' => $registered,
                'ended' => $ended,
            );
            sess_set('auth', $data);
        }

        $data = array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function operasi() {
        $this->load->model('operasi');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $operasi = Operasi::where('id', $id);
        DB::transaction(function() use ($operasi, &$writer) {
            $operasi->update(array('deleted' => date('Y-m-d H:i:s'), 'deleter' => $writer));
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function uji_kultur() {
        $this->load->model('uji_kultur');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $uji = Uji_Kultur::where('token', $id);
        DB::transaction(function() use ($uji, &$writer) {
            $uji->update(array('deleted' => date('Y-m-d H:i:s'), 'deleter' => $writer));
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function uji_darah() {
        $this->load->model('uji_darah');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $uji = Uji_Darah::where('token', $id);
        DB::transaction(function() use ($uji, &$writer) {
            $uji->update(array('deleted' => date('Y-m-d H:i:s'), 'deleter' => $writer));
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function hasil_lab_klinik() {
        $this->load->model('hasil_lab_klinik');

        $no_sampel = $this->input->post('no_sampel');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $hasil = Hasil_Lab_Klinik::where('no_sampel', $no_sampel);
        DB::transaction(function() use ($hasil, &$writer) {
            $hasil->update(array('deleter' => $writer, 'deleted' => date('Y-m-d H:i:s')));
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function hasil_lab_mikro() {
        $this->load->model('hasil_lab_mikro');

        $no_sampel = $this->input->post('no_sampel');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $hasil = Hasil_Lab_Mikro::where('no_sampel', $no_sampel);
        DB::transaction(function() use ($hasil, &$writer) {
            $hasil->update(array('deleter' => $writer, 'deleted' => date('Y-m-d H:i:s')));
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function hasil_lab_pa() {
        $this->load->model('hasil_lab_pa');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $hasil = Hasil_Lab_PA::find($id);
        $hasil->deleted = date('Y-m-d H:i:s');
        $hasil->deleter = $writer;
        DB::transaction(function() use ($hasil) {
            $hasil->save();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function hasil_lab_kultur() {
        $this->load->model('hasil_lab_kultur');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $hasil = Hasil_Lab_Kultur::find($id);
        $hasil->deleted = date('Y-m-d H:i:s');
        $hasil->deleter = $writer;
        DB::transaction(function() use ($hasil) {
            $hasil->save();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function hasil_lab_morfologi() {
        $this->load->model('hasil_lab_morfologi');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $hasil = Hasil_Lab_Morfologi::find($id);
        $hasil->deleted = date('Y-m-d H:i:s');
        $hasil->deleter = $writer;
        DB::transaction(function() use ($hasil) {
            $hasil->save();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function treadmill() {
        $this->load->model('treadmill');

        $id = $this->input->post('id');

        $treadmill = Treadmill::find($id);

        DB::transaction(function() use ($treadmill) {
            $treadmill->delete();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function askep_poli() {
        $this->load->model('askep');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $askep = Askep::find($id);
        $askep->deleted = date('Y-m-d H:i:s');
        $askep->deleter = $writer;
        DB::transaction(function() use ($askep) {
            $askep->save();
        });

        //$hamil = Hamil::where('no_reg', '=', $no_reg)->delete();

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function askep_inap() {
        $this->load->model('askep_inap');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $askep = Askep_Inap::find($id);
        $askep->deleted = date('Y-m-d H:i:s');
        $askep->deleter = $writer;
        DB::transaction(function() use ($askep) {
            $askep->save();
        });

        //$hamil = Hamil::where('no_reg', '=', $no_reg)->delete();

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function askep_gd() {
        $this->load->model('askep_gd');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $askep = Askep_GD::find($id);
        $askep->deleted = date('Y-m-d H:i:s');
        $askep->deleter = $writer;
        DB::transaction(function() use ($askep) {
            $askep->delete();
        });

        $data = array(
            'status' => true,
            'today' => date('d-m-Y'),
            'yesterday' => date('d-m-Y', strtotime('-2 day')),
        );

        echo json_encode($data);
    }
    function askep_poli_inap() {
        $this->load->model('askep_poli_inap');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $askep = Askep_Poli_Inap::find($id);
        $askep->deleted = date('Y-m-d H:i:s');
        $askep->deleter = $writer;
        DB::transaction(function() use ($askep) {
            $askep->delete();
        });

        $data = array(
            'status' => true,
            'today' => date('d-m-Y'),
            'yesterday' => date('d-m-Y', strtotime('-2 day')),
        );

        echo json_encode($data);
    }
    function paket_soap()
    {
        $this->load->model('soap_paket');

        $id = $this->input->post('id');
        $poli = $this->input->post('poli');
        $soap = Soap_Paket::find($id);

        DB::transaction(function() use ($soap) {
            $soap->delete();
        });

        $opt = "<option value=''>";
        $soap = Soap_Paket::where('kd_poli', '=', $poli)->get();
        foreach ($soap as $all) {
            # code...
            $id = $all->id;
            $paket = $all->paket;
            $opt .= "<option value='$id'> $paket";
        }

        $data = array(
            'status' => true,
            'paket_soap' => $opt,
        );
        echo json_encode($data);
    }
    function paket_kontrol()
    {
        $this->load->model('kontrol_paket');

        $id = $this->input->post('id');
        $poli = $this->input->post('poli');
        $kontrol = Kontrol_Paket::find($id);

        DB::transaction(function() use ($kontrol) {
            $kontrol->delete();
        });

        $opt = "<option value=''>";
        $kontrol = Kontrol_Paket::where('poli_id', '=', $poli)->get();
        foreach ($kontrol as $all) {
            # code...
            $id = $all->id;
            $paket = $all->paket;
            $opt .= "<option value='$id'> $paket";
        }

        $data = array(
            'status' => true,
            'paket_kontrol' => $opt,
        );
        echo json_encode($data);
    }
    function obat_inap() {
        $this->load->model('pasien_resep_inap');

        $id = $this->input->post('id');

        $obat = Pasien_Resep_Inap::find($id);

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }
        $obat->deleted = date('Y-m-d H:i:s');
        $obat->deleter = $writer;
        DB::transaction(function() use ($obat) {
            $obat->save();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function obat() {
        $this->load->model('obat');

        $id = $this->input->post('id');

        $obat = Obat::find($id);

        DB::transaction(function() use ($obat) {
            $obat->delete();
        });

        $data = array(
            'status' => true,
        );

        echo json_encode($data);
    }
    function paket_obat()
    {
        $this->load->model('obat_paket');

        $id = $this->input->post('id');
        $obat = Obat_Paket::find($id);

        DB::transaction(function() use ($obat) {
            $obat->delete();
        });

        $data = array(
            'status' => true
        );
        echo json_encode($data);
    }
    function paket_pobat()
    {
        $this->load->model('obat_jnspaket');

        $id = $this->input->post('id');
        $poli = $this->input->post('poli');

        $status = false;

        $obat = Obat_Jnspaket::find($id);

        DB::transaction(function() use ($obat, &$status) {
            $obat->delete();
            $status = true;
        });

        $opt2 = "<option value=''>";
        $obat_paket = Obat_Jnspaket::where('kd_poli', '=', $poli)->get();
        foreach ($obat_paket as $all) {
            # code...
            $id = $all->id;
            $nama = $all->nama;
            $opt2 .= "<option value='$id'>$nama";
        }

        $data = array(
            'status' => $status,
            'paket_obat' => $opt2,
        );
        echo json_encode($data);
    }
    public function paket_labklinik()
    {
        $this->load->model('lab_jnspaket_klinik');

        $pemeriksaan = json_decode(stripslashes($this->input->post('pemeriksaan')));
        $id    = $this->input->post('id');
        $poli        = $this->input->post('poli');

        $jns_paket          = Lab_Jnspaket_Klinik::find($id);
        DB::transaction(function () use ($jns_paket) {
            $jns_paket->delete();
        });

        $opt3            = "<option value=''>";
        $opt4            = "<option value=''>";
        $paket_labklinik = Lab_Jnspaket_Klinik::whereIn('kd_poli', array($poli, 'ALL'))->get();
        foreach ($paket_labklinik as $all) {
            # code...
            $id   = $all->id;
            $nama = $all->nama;
            $labpoli = $all->kd_poli;
            if($labpoli != 'ALL')
            {
                $opt4 .= "<option value='$id' data-poli='$labpoli'>$nama";
            }
            $opt3 .= "<option value='$id' data-poli='$labpoli'>$nama";
        }

        $data = array(
            'status'          => true,
            'paket_plabklinik' => $opt3,
            'paket_labklinik' => $opt4,
        );
        echo json_encode($data);
    }
    function soap()
    {
        $this->load->model('demam');
        $this->load->model('soap');
        $this->load->model('pasien_resep');
        $this->load->model('hs_soap');
        $this->load->model('pasien_poli');

        $id = $this->input->post('id');

        $soap = Soap::find($id);
        $no_reg = $soap->no_reg;
        $kd_poli = $soap->kd_poli;
        $kd_dr = $soap->kd_dr;
        $trx = $soap->trx;
        $tanggal = date('Y-m-d', strtotime($soap->registered));

        DB::transaction(function() use ($soap) {
            $soap->delete();
        });

        $pasien_resep = Pasien_Resep::where('trx', $trx)->whereRaw("date(registered) = '$tanggal'")->delete();

        $hs_soap = HS_Soap::find($no_reg);
        $hs_soap->jumlah = $hs_soap->jumlah-1;
        DB::transaction(function() use ($hs_soap) {
            $hs_soap->save();
        });

        $demam = Demam::where('no_reg', $no_reg)->where('kd_poli', $kd_poli)->where('tgl_masuk', $tanggal)->delete();

        $pasien = Pasien_Poli::where('kd_poli', $kd_poli)->where('kd_dokter', $kd_dr)->where('no_reg', $no_reg);

        DB::transaction(function () use ($pasien, &$status, &$kontrol, &$tgl_kontrol) {
            $pasien->update(array('kontrol' => null, 'tgl_kontrol' => null));
            $status = true;
        });

        $data = array(
            'status' => true,
        );
        echo json_encode($data);
    }
    function soap_gd()
    {
        $this->load->model('soap_gd');
        $this->load->model('pasien_resep_gd');

        $id = $this->input->post('id');

        $soap = Soap_GD::find($id);
        $no_reg = $soap->no_reg;
        $kd_poli = $soap->poli_id;
        $dokter_id = $soap->dokter_id;
        $trx = $soap->trx;
        $tanggal = date('Y-m-d', strtotime($soap->registered));

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }
        $soap->deleted = date('Y-m-d H:i:s');
        $soap->deleter = $writer;
        DB::transaction(function() use ($soap) {
            $soap->save();
        });

        /*
        $dir = FCPATH . "assets/rme/img/anatomy/$no_reg/";
        $file = $dir . $no_reg . '_' . $dokter_id . '_*_' . date('Ymd') . ".png";
        array_map('unlink', glob("$file"));

        $pasien_resep = Pasien_Resep_GD::where('trx',  $trx)->whereRaw("date(registered) = '$tanggal'")->delete();
        */

        $data = array(
            'status' => true,
            'today' => date('d-m-Y'),
            'yesterday' => date('d-m-Y', strtotime('-2 day')),
        );
        echo json_encode($data);
    }
    function soap_poli_inap()
    {
        $this->load->model('soap_poli_inap');
        $this->load->model('pasien_resep_poli_inap');

        $id = $this->input->post('id');

        $soap = Soap_Poli_Inap::find($id);
        $no_reg = $soap->no_reg;
        $kd_poli = $soap->poli_id;
        $dokter_id = $soap->dokter_id;
        $trx = $soap->trx;
        $tanggal = date('Y-m-d', strtotime($soap->registered));

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }
        $soap->deleted = date('Y-m-d H:i:s');
        $soap->deleter = $writer;
        DB::transaction(function() use ($soap) {
            $soap->save();
        });

        /*
        $dir = FCPATH . "assets/rme/img/anatomy/$no_reg/";
        $file = $dir . $no_reg . '_' . $dokter_id . '_*_' . date('Ymd') . ".png";
        array_map('unlink', glob("$file"));

        $pasien_resep = Pasien_Resep_GD::where('trx',  $trx)->whereRaw("date(registered) = '$tanggal'")->delete();
        */

        $data = array(
            'status' => true,
            'today' => date('d-m-Y'),
            'yesterday' => date('d-m-Y', strtotime('-2 day')),
        );
        echo json_encode($data);
    }
    function soap_inap()
    {
        $this->load->model('soap_inap');
        $this->load->model('pasien_resep_inap');

        $id = $this->input->post('id');

        $soap = Soap_Inap::find($id);
        $no_reg = $soap->no_reg;
        $kd_poli = $soap->poli_id;
        $dokter_id = $soap->dokter_id;
        $trx = $soap->trx;
        $tanggal = date('Y-m-d', strtotime($soap->registered));

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }
        $soap->deleted = date('Y-m-d H:i:s');
        $soap->deleter = $writer;
        DB::transaction(function() use ($soap) {
            $soap->save();
        });

        /*
        $dir = FCPATH . "assets/rme/img/anatomy/$no_reg/";
        $file = $dir . $no_reg . '_' . $dokter_id . '_*_' . date('Ymd') . ".png";
        array_map('unlink', glob("$file"));

        $pasien_resep = Pasien_Resep_Inap::where('trx',  $trx)->whereRaw("date(registered) = '$tanggal'")->delete();
        */

        $data = array(
            'status' => true,
            'today' => date('d-m-Y'),
            'yesterday' => date('d-m-Y', strtotime('-2 day')),
        );
        echo json_encode($data);
    }
    public function checkham()
    {
        $this->load->model('resep_plus');

        $id = $this->input->post('id');

        $checkham = Resep_Plus::find($id);

        DB::transaction(function() use ($checkham) {
            $checkham->delete();
        });

        $data = array(
            'status' => true,
        );
        echo json_encode($data);
    }
    function salin()
    {
        $this->load->model('hamil');

        $id = $this->input->post('id');

        $writer = '';
        $user = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $writer = $sess->user_id;
            $user = $sess->user;
        }

        $anak = Hamil::find($id);
        $anak->deleted = date('Y-m-d H:i:s');
        $anak->deleter = $writer;
        DB::transaction(function() use ($anak) {
            $anak->save();
        });
        $data = array(
            'status' => true,
        );
        echo json_encode($data);
    }
    function echocardio()
    {
        $this->load->model('ekokardiografi');

        $id = $this->input->post('id');

        $echo = Ekokardiografi::find($id);

        DB::transaction(function() use ($echo) {
            $echo->delete();
        });

        $data = array(
            'status' => true,
        );
        echo json_encode($data);
    }
    function mcu()
    {
        $this->load->model('mcu');

        $id = $this->input->post('id');

        $treadmill = MCU::find($id);

        DB::transaction(function() use ($treadmill) {
            $treadmill->delete();
        });

        $data = array(
            'status' => true,
        );
        echo json_encode($data);
    }
    function upload_rm()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            //$dir = FCPATH . "assets/rme/img/rm/$no_reg/";
            $dir = "/var/www/html/storage100/rme/img/rm/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_lab()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir     = FCPATH . "assets/100/rme/lab/$no_reg/";
            // $dir = "/var/www/html/storage100/rme/img/lab/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_ro()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir     = FCPATH . "assets/100/rme/ro/$no_reg/";
            // $dir = "/var/www/html/storage100/rme/img/lab/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_ekg()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/ekg/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_pacs_ro()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/ro/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;

        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_kateterisasi()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/kateterisasi/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_dopler()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/dopler/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_echo()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/echo/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function upload_treadmill()
    {
        $this->load->model('penunjang');

        //Ambil token foto
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $no_reg = $this->input->post('no_reg');
        $status = false;

        //$foto=$this->db->get_where('foto',array('token'=>$token));
        if(isset($token))
        {
            $image = Penunjang::where('token', $token)->first();
        }
        else
        {
            $image = Penunjang::find($id);
        }
        if(count($image)>0){
            $no_reg = $image->no_reg;
            $file = $image->file;
            $dir = FCPATH . "assets/rme/img/treadmill/$no_reg/";
            if(file_exists($dir.$file)){
                unlink($dir.$file);
            }
            $image->delete();
            $status = true;
        }

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    public function surat_ijin()
    {
        $this->load->model('surat_ijin');
        $this->load->model('surat_ijin_rw');
        $this->load->model('surat_keluar');

        //Ambil token foto
        $id = $this->input->post('id');
        $status = true;

        $surat = Surat_Ijin::find($id);
        $nomor = $surat->nomor;
        $surat->deleted = date('Y-m-d H:i:s');
        DB::transaction(function() use ($surat) {
            $surat->save();
        });
        $surat = Surat_Ijin_RW::find($id);
        if(count($surat) > 0)
        {
            $surat->deleted = date('Y-m-d H:i:s');
            DB::transaction(function() use ($surat) {
                $surat->save();
            });
        }
        $surat = Surat_Keluar::where('nomor', $nomor);
        DB::transaction(function() use ($surat) {
            $surat->update(array('deleted' => date('Y-m-d H:i:s')));
        });

        $data = (object)array(
            'status' => $status,
        );
        echo json_encode($data);
    }
    function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }

    public function dbf() {
        include('delete.controllers/dbf.delete.php');
    }

}
