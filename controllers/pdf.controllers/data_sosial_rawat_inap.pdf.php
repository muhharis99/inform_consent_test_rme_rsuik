<?php 
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = "";
if (!empty(segment(4))&&!empty(segment(5))) {
    $no_reg = segment(4); 
    $tgl_rs = segment(5); 
    if (strlen((string) segment(4))==7&&strlen((string) segment(5))==14) {
        $format_baru = true;
        switch ((string) segment(6)) {
            case 'PRINT' : 
            case 'print' : 
                $pdf_type = "F";
                $lp_print = true;
                break; 
            case 'FILE' : 
                $pdf_type = "F";
                $lp_print = false;
                break; 
            case 'PRINTSERVER' : 
                $pdf_type = "F";
                $lp_print = true;
                $printer = (string) segment(7);
                break; 
        }
    }
    // $no_reg = null; 
    // $tgl_rs = null; 
}

        $this->load->model('Mutasi_ri');
        $this->load->model('Pasien');
        $this->load->model('Agama');
        $this->load->model('Perkawinan');
        $this->load->model('Pendidikan');
        $this->load->model('Pekerjaan');
        $this->load->model('Rujuk');
        $this->load->model('Perujuk');
        $this->load->model('Kunjung');
        $this->load->model('Asuransi');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))->orderBy('id', 'DESC')->first();
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        // if (ipclient()==IPC) json($tgl_masuk);
        $nama          = '';
        $nik           = '';
        $alamat        = '';
        $tgl_lahir     = '';
		$umur 		   = '';
        $jenis_kel     = '';
        $telp          = '';
        $agama         = '';
        $kawin         = '';
        $didik         = '';
        $kerja         = '';
        $rujuk         = '';
        $kunjung       = 'LAMA';
        $asuransi      = '';
        $asal          = '';
        $str_tgl_masuk = '';
        $str_tgl_ri = '';
        $bangsal       = '';
        $pasien        = null;
        $pasien        = Pasien::find($no_reg);
        if (!empty($pasien)) {
            $nama = $pasien->nama; 
            $nik = $pasien->no_id; 
            $tgl_lahir = $pasien->tgl_lahir; 
            $alamat = $pasien->alamat;
            switch ($pasien->jenis_kel) {
                case '1' : 
                case 1 : 
                case 'L' : 
                    $jenis_kel = 'LAKI-LAKI'; 
                    break; 
                case '2' : 
                case 2 : 
                case 'P' : 
                    $jenis_kel = 'PEREMPUAN'; 
                    break; 
            }
            $telp = $pasien->telp;
            if (!empty($pasien->telp2)) {
                $telp .= '/'.$pasien->telp2; 
            } 
            $row_agama = Agama::where('kd_agama', $pasien->agama)->first(); 
            if (!empty($row_agama)) {
                $agama = strtoupper($row_agama->agama);
            }
            $row_kawin = Perkawinan::where('kd_perkawinan', $pasien->kawin)->first(); 
            if (!empty($row_kawin)) {
                $kawin = strtoupper($row_kawin->nama_perkawinan);
            }
            $row_didik = Pendidikan::where('kd_pendidikan', $pasien->didik)->first(); 
            if (!empty($row_didik)) {
                $didik = strtoupper($row_didik->pendidikan);
            }
            $row_kerja = Pekerjaan::where('kd_pekerjaan', $pasien->pekerjaan)->first(); 
            if (!empty($row_kerja)) {
                $kerja = strtoupper($row_kerja->pekerjaan);
            }
        } 
        include('warning.pdf.php');
        $row_perujuk = Perujuk::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('deletedstate', '0')->orderBy('id', 'DESC')->first();
        if (!empty($row_perujuk)) {
            $rujuk = $row_perujuk->alamat;
        }
        $row_kunjung = Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'ASC')->first();
        if (!empty($row_kunjung)) {
            switch($row_kunjung->kunjung) {
                case 'B' : 
                    $kunjung = 'BARU'; 
                    break; 
            }
        }
        if (!empty($row_mutasi_ri->asuransi)) {
            $row_asuransi = Asuransi::where('NO_REL', $row_mutasi_ri->asuransi)->first();
            if (!empty($row_asuransi->NAMA)) {
                $asuransi = $row_asuransi->NAMA;
            }
        }
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $str_tgl_masuk = $row_mutasi_ri->tgl_masuk." Jam : ". str_replace(":", ".", substr($jam_masuk, 0, 5))." WIB";
        }
        if (!empty($row_mutasi_ri->tgl_ri)) {
            $str_tgl_ri = date("d/m/Y", strtotime($row_mutasi_ri->tgl_ri))." Jam : ". str_replace(":", ".", substr($row_mutasi_ri->jam_ri, 0, 5))." WIB";
        }
        $umur_penanggung_jawab = ""; 
        if (!empty($row_mutasi_ri->bangsal)) {
            $row_bangsal = Bangsal::where('kd_bangsal', $row_mutasi_ri->bangsal)->first();
            if (!empty($row_bangsal->nama_pendaftaran)) {
                $bangsal = $row_bangsal->nama_pendaftaran;
            }
            $umur_penanggung_jawab = selisihymdhis($row_mutasi_ri->tgl_masuk, $row_mutasi_ri->tgl_lahir_pjawab, "umur");
        }
        $jenis_asal_rujukan = ""; 
        $prosedur_cara_masuk = ""; 
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $row_kunjung = DB::table('rsiklaten.kunjung as a')
            ->leftJoin('rsiklaten.rujuk as b', function($join) {
                $join->on('a.rujuk', '=', 'b.id_rujuk');
            })
            ->leftJoin('rsiklaten.poli as c', function($join) {
                $join->on('a.kd_poli', '=', 'c.kode_poli');
            })
            ->where('a.no_reg', $no_reg)->where('a.tanggal', $row_mutasi_ri->tgl_masuk)->whereNull('a.deleted')->orderBy('a.id', 'DESC')
            ->first(array('b.rujuk', 'c.nama_poli'));
            if (!empty($row_kunjung)) {
                $row_kunjung = (object) $row_kunjung;
                $jenis_asal_rujukan = strtoupper($row_kunjung->rujuk);
                $prosedur_cara_masuk = strtoupper($row_kunjung->nama_poli);
            }
        }

        $data = array(
            "no_reg"        => $no_reg,
            "tgl_masuk"     => $tgl_masuk,
            "jam_masuk"     => $jam_masuk,
            "tgl_rs"        => $tgl_rs,
            "ranap"         => $row_mutasi_ri,
            "nama"          => $nama,
            "warning_sama" => isset($warning_sama)?$warning_sama:false, 
            "nik"           => $nik,
            "jenis_kel"     => $jenis_kel,
            "alamat"        => $alamat,
            "tgl_lahir"     => $tgl_lahir,
			"umur"			=> selisihymdhis($tgl_lahir, ($row_mutasi_ri ? $row_mutasi_ri->tgl_ri : $tgl_masuk), "umur"),
            "telp"          => $telp,
            "agama"         => $agama,
            "kawin"         => $kawin,
            "didik"         => $didik,
            "kerja"         => $kerja,
            "jenis_asal_rujukan"         => $jenis_asal_rujukan,
            "prosedur_cara_masuk"         => $prosedur_cara_masuk,
            "umur_penanggung_jawab"         => $umur_penanggung_jawab,
            "rujuk"         => $rujuk,
            "kunjung"       => $kunjung,
            "asuransi"      => $asuransi,
            "asal"          => $asal,
            "str_tgl_masuk" => $str_tgl_masuk,
            "str_tgl_ri"    => $str_tgl_ri,
            "bangsal"       => $bangsal,
            'pdf_type'      => $pdf_type,
            'lp_print'      => $lp_print,
            'printer'       => $printer,
            'ipclient'      => $ipclient
        );
        // pre($data);
        // if (ipclient()==IPC) json($data);
        go('pdf/data_sosial_rawat_inap', $data);            
        