<?php 
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
        $this->load->model('Karyawan');
        $this->load->model('Karya');
        $this->load->model('Dokter');
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
        
        
        $nama = ''; 
        $nik = ''; 
        $alamat = ''; 
        $tgl_lahir = ''; 
        $jenis_kel = ''; 
        $telp = ''; 
        $agama = ''; 
        $kawin = ''; 
        $didik = ''; 
        $kerja = ''; 
        $rujuk = ''; 
        $kunjung = 'LAMA'; 
        $asuransi = ''; 
        $asal = ''; 
        $str_tgl_masuk = ''; 
        $bangsal = ''; 
        $nama_petugas = ''; 
        $pasien = null; 
        $pasien = Pasien::find($no_reg);
        $warning_sama = false;
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
            
            if (isset($_SERVER['HTTP_REFERER'])) { 
                $exp_referer = explode("main/", $_SERVER['HTTP_REFERER']); $frame_source = $exp_referer[1]; 
                $rows_kjg_mirip = (array) null; 
                switch ($frame_source) {
                    case 'askep_poli_inap' :
                        $kd_poli = ''; 
                        $row_kunjung = DB::table('rsiklaten.kunjung as a')->where('a.no_reg', $no_reg)->where('a.tanggal', $tgl_masuk)->whereNotNull('a.kd_dr')->whereNotNull('a.kd_poli')->first(array('a.kd_poli'));
                        if (!empty($row_kunjung)) {
                            $row_kunjung = (object) $row_kunjung; 
                            $kd_poli = $row_kunjung->kd_poli;
                        }
                        $rows_kjg_mirip = DB::table('rsiklaten.kunjung as a')->leftJoin('rsiklaten.pasien as b', function($join){
                            $join->on('a.no_reg', '=', 'b.no_reg');
                        })
                        ->where('a.tanggal', $tgl_masuk)
                        ->whereIn('a.kd_poli', array($kd_poli))
                        ->whereRaw('a.kd_dr IS NOT NULL')
                        ->where('a.deletedstate', 0) 
                        ->get(array('b.nama', 'a.no_reg'));
                        $arr_nama = explode(" ", $nama); 
                        foreach ($arr_nama as $key=>$nama_mirip) {
                            if (strlen($nama_mirip) > 2) {
                                foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                                    $row_kjg_mirip = (object) $row_kjg_mirip;
                                    if (stripos($row_kjg_mirip->nama, $nama_mirip) && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            } 
                        } 
                        break; 
                    case 'askep_gd' :
                        $rows_kjg_mirip = DB::table('rsiklaten.kunjung as a')->leftJoin('rsiklaten.pasien as b', function($join){
                            $join->on('a.no_reg', '=', 'b.no_reg');
                        })
                        ->where('a.tanggal', $tgl_masuk)
                        ->whereIn('a.kd_poli', array('UGD', 'PNEK'))
                        ->whereRaw('a.kd_dr IS NOT NULL')
                        ->where('a.deletedstate', 0) 
                        ->get(array('b.nama', 'a.no_reg'));
                        $arr_nama = explode(" ", $nama); 
                        foreach ($arr_nama as $key=>$nama_mirip) {
                            if (strlen($nama_mirip) > 2) {
                                foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                                    $row_kjg_mirip = (object) $row_kjg_mirip;
                                    if (stripos($row_kjg_mirip->nama, $nama_mirip) && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            } 
                        } 
                        break; 
                    case 'askep_inap_awal' :
                        $induk = ''; 
                        $row_ranap_inap = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                            $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                        })
                        ->where('no_reg', $no_reg)->first(array('a.nama', 'a.no_reg', 'b.induk'));
                        if (!empty($row_ranap_inap)) {
                            $row_ranap_inap = (object) $row_ranap_inap; 
                            $induk = $row_ranap_inap->induk;
                        }
                        $rows_kjg_mirip = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                            $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                        }) 
                        ->where('b.induk', $induk)
                        ->get(array('a.nama', 'a.no_reg', 'b.induk'));
                        $arr_nama = explode(" ", $nama); 
                        foreach ($arr_nama as $key=>$nama_mirip) {
                            if (strlen($nama_mirip) > 2) {
                                foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                                    $row_kjg_mirip = (object) $row_kjg_mirip;
                                    if (stripos($row_kjg_mirip->nama, $nama_mirip) && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            } 
                        } 
                        break; 
                }
            }
        } 
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
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $str_tgl_masuk = $row_mutasi_ri->tgl_masuk." Jam : ". str_replace(":", ".", substr($jam_masuk, 0, 5));
        }
        if (!empty($row_mutasi_ri->bangsal)) {
            $row_bangsal = Bangsal::where('kd_bangsal', $row_mutasi_ri->bangsal)->first();
            if (!empty($row_bangsal->nama_pendaftaran)) {
                $bangsal = $row_bangsal->nama_pendaftaran;
            }
        }
        if (!empty($row_mutasi_ri->petugas)) {
            $row_karyawan = Karya::where('nik', $row_mutasi_ri->petugas)->first();
            if (!empty($row_karyawan->nama)) {
                $nama_petugas = $row_karyawan->nama;
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri1)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
            }
        }
        $akad = null; 
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $query = "
            SELECT 
                * 
            FROM 
                (
                    SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS mutasi kelas' as akad, kd_bangsal, pihak_pertama_nama, pihak_pertama_nik, pihak_pertama_jabatan, pihak_kedua_nama, pihak_kedua_alamat, pihak_kedua_nik, pihak_kedua_pekerjaan, saksi_satu, saksi_dua, tgl_dibuat FROM rsik.cetak_akad_bpjs_mutasi
                ) akad 
            WHERE 
                no_reg = '$no_reg'
                AND tgl_masuk = '$tgl_masuk'
                AND deleted IS NULL 
            ";
            $data_akad = DB::select($query); 
            $akad = self::obj($data_akad);
            // $akad 
        }
        include('warning.pdf.php');
        $data = array(
            "no_reg" => $no_reg,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tgl_rs" => $tgl_rs, 
            "ranap" => $row_mutasi_ri, 
            "nama" => $nama, 
            "warning_sama" => $warning_sama, 
            "nik" => $nik, 
            "jenis_kel" => $jenis_kel, 
            "alamat" => $alamat, 
            "tgl_lahir" => $tgl_lahir,
            "umur" => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"), 
            "telp" => $telp, 
            "agama" => $agama, 
            "kawin" => $kawin, 
            "didik" => $didik, 
            "kerja" => $kerja, 
            "rujuk" => $rujuk, 
            "kunjung" => $kunjung, 
            "asuransi" => $asuransi, 
            "asal" => $asal, 
            "str_tgl_masuk" => $str_tgl_masuk, 
            "bangsal" => $bangsal, 
            "nama_petugas" => $nama_petugas, 
            "akad" => $akad,
            "pdf_type" => "I", 
            "warning_sama" => isset($warning_sama)?$warning_sama:false 
        );
        $view = 'pdf/pengkajian_intervensi_resiko_pasien_dewasa_morse'; 
        go($view, $data);
        // var_dump($view); die();