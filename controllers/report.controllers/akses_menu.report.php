<?php 

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