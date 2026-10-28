<?php 

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