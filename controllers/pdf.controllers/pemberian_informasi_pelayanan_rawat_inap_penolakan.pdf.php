<?php 
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
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
    case 'FILECLIENT' : 
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break; 
    case 'PRINTSERVER' : 
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break; 
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
        $this->load->model('Karyawan');
        $this->load->model('Karya');
        $this->load->model('Dokter');
        $this->load->model('soap_pemberian_info_ranap');
        $this->load->model('user');
        $this->load->model('bangsal_jenis');
        $this->load->model('ttd_pasien');

        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        // $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2);
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))->orderBy('id', 'DESC')->first();
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        if (segment(4) == '0000003') {
            // $row_mutasi_ri = Mutasi_ri::orderBy('id', 'DESC')->first();
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
        $warning_sama = false;

        
        $asal                            = '';
        $info_ranap_kebutuhan            = '';
        $info_ranap_preventif            = '';
        $info_ranap_kuratif              = '';
        $info_ranap_rehabilitatif        = '';
        $info_ranap_paliatif             = '';
        $info_ranap_isian                = '';
        $info_ranap_keterangan           = '';
        $info_ranap_hasil_pelayanan      = '';
        $info_ranap_hasil_pelayanan_lain = '';
        $info_ranap_dpjp1_jadwal         = '';
        $info_ranap_dpjp2_jadwal         = '';
        $info_ranap_dpjp3_jadwal         = '';
        $info_ranap_dpjp1_permintaan     = '';
        $info_ranap_dpjp2_permintaan     = '';
        $info_ranap_dpjp3_permintaan     = '';
        $info_ranap_bangsal              = '';
        $info_ranap_menerangkan          = '';
        $info_ranap_menyatakan           = '';
        $info_ranap_status_layanan       = '';
        $info_ranap_penerima_info        = '';
        $info_ranap_penerima_jenkel      = '';
        $info_ranap_penerima_alamat      = '';
        $info_ranap_hubungan             = '';
        $info_ranap_saksi                = '';
        $info_ranap_penerima_umur        = '';
        $nama_info_ranap_saksi           = '';
        $nama_dr                         = '';
        $kd_dr                           = '';
        $ttd                             = '';
        $registered_tgl                  = '';
        $registered_jam                  = '';
        $batas                           = '';
        $bangsal_jenis                   = '';
        $pasien = Pasien::find($no_reg);

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

            if (isset($_SERVER['HTTP_REFERER']) && isset($no_reg)) { 
                if (!empty($pasien->nama)) $nama = $pasien->nama;
                $exp_referer = explode("main/", $_SERVER['HTTP_REFERER']); 
                $frame_source = null; 
                if (!empty($exp_referer[1])) $frame_source = $exp_referer[1]; 
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
                // $nama_petugas = $row_karyawan->nama;
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

        $info_ranap = Soap_pemberian_info_ranap::where('no_reg', $no_reg)
						->where('tgl_masuk', $tgl_masuk)
						->whereRaw("LEFT(jam_masuk, 5) = LEFT('".$jam_masuk."', 5)")
						//->where('jam_masuk', $jam_masuk)
						->where('info_ranap_status_layanan', '2')
						->whereNull('deleted')
						->orderBy('id', 'desc')
						->first();
        if (count($info_ranap)> 0) {
            $asal                            = $info_ranap->asal;
            $info_ranap_kebutuhan            = $info_ranap->info_ranap_kebutuhan;
            $info_ranap_preventif            = $info_ranap->info_ranap_preventif;
            $info_ranap_kuratif              = $info_ranap->info_ranap_kuratif;
            $info_ranap_rehabilitatif        = $info_ranap->info_ranap_rehabilitatif;
            $info_ranap_paliatif             = $info_ranap->info_ranap_paliatif;
            $info_ranap_isian                = $info_ranap->info_ranap_isian;
            $info_ranap_keterangan           = $info_ranap->info_ranap_keterangan;
            $info_ranap_hasil_pelayanan      = $info_ranap->info_ranap_hasil_pelayanan;
            $info_ranap_hasil_pelayanan_lain = $info_ranap->info_ranap_hasil_pelayanan_lain;
            $info_ranap_dpjp1_jadwal         = $info_ranap->info_ranap_dpjp1_jadwal;
            $info_ranap_dpjp2_jadwal         = $info_ranap->info_ranap_dpjp2_jadwal;
            $info_ranap_dpjp3_jadwal         = $info_ranap->info_ranap_dpjp3_jadwal;
            $info_ranap_dpjp1_permintaan     = $info_ranap->info_ranap_dpjp1_permintaan;
            $info_ranap_dpjp2_permintaan     = $info_ranap->info_ranap_dpjp2_permintaan;
            $info_ranap_dpjp3_permintaan     = $info_ranap->info_ranap_dpjp3_permintaan;
            $info_ranap_bangsal_a            = $info_ranap->info_ranap_bangsal;

            // $info_ranap_bangsal              = ['','Umum','Bedah','Kebidanan','Isolasi Covid','Anak','ICU-ICCU','Unit Stroke','PICU-NICU','KBRT','HCU-UGD','Medikal','Rawat Gabung','VK','Isolasi Non Covid'];
            // $info_ranap_bangsal              = $info_ranap_bangsal[$info_ranap_bangsal_a];
            $bangsal_jenis = Bangsal_jenis::where('id', '=', $info_ranap_bangsal_a)->first();
            if (!empty($bangsal_jenis)) {
                $bangsal_jenis = $bangsal_jenis->jenis_bangsal;
            }

            $info_ranap_bangsal              = $bangsal_jenis;

            $info_ranap_menerangkan          = $info_ranap->info_ranap_menerangkan;
            $info_ranap_menyatakan           = $info_ranap->info_ranap_menyatakan;
            $info_ranap_status_layanan       = $info_ranap->info_ranap_status_layanan;
            $info_ranap_penerima_info        = $info_ranap->info_ranap_penerima_info;
            $info_ranap_penerima_umur        = $info_ranap->info_ranap_penerima_umur;
            $info_ranap_penerima_umur        = $info_ranap_penerima_umur.' Th';
            $info_ranap_penerima_jenkel      = $info_ranap->info_ranap_penerima_jenkel;
            if ($info_ranap_penerima_jenkel == 'L') {
                $info_ranap_penerima_jenkel = 'Laki-Laki';
            }elseif ($info_ranap_penerima_jenkel == 'P') {
                $info_ranap_penerima_jenkel = 'Perempuan';
            }else {
                $info_ranap_penerima_jenkel = '';
            }
            $info_ranap_penerima_alamat = $info_ranap->info_ranap_penerima_alamat;
            $info_ranap_hubungan_a      = $info_ranap->info_ranap_hubungan;
            $info_ranap_hubungan        = ['','Suami','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Lainnya','Diri Sendiri','Wali'];
            $info_ranap_hubungan        = $info_ranap_hubungan[$info_ranap_hubungan_a];
            $info_ranap_saksi           = $info_ranap->info_ranap_saksi;
            $writer                     = $info_ranap->writer;
            $registered_tgl             = date('d-m-Y', strtotime($info_ranap->registered));
            $registered_jam             = date('H:i', strtotime($info_ranap->registered));

            // mencari data dokter pembuat
            $users  = User::where('id', $writer)->where('status', 1)->first();
            $dokter = Dokter::find($users->user);
            if (count($dokter) > 0) {
                $nama_dr = $dokter->nama2;
                $kd_dr   = $dokter->no_dr;
                $ttd     = $dokter->ttd;
            }

            //mencari dpjp1 jadwal
            $dpjp1_jad = Dokter::find($info_ranap_dpjp1_jadwal);
            if (count($dpjp1_jad) > 0) {
                $info_ranap_dpjp1_jadwal = $dpjp1_jad->nama2;
            }

            //mencari dpjp2 jadwal
            $dpjp2_jad = Dokter::find($info_ranap_dpjp2_jadwal);
            if (count($dpjp2_jad) > 0) {
                $info_ranap_dpjp2_jadwal = $dpjp2_jad->nama2;
            }

            //mencari dpjp3 jadwal
            $dpjp3_jad = Dokter::find($info_ranap_dpjp3_jadwal);
            if (count($dpjp3_jad) > 0) {
                $info_ranap_dpjp3_jadwal = $dpjp3_jad->nama2;
            }

            //mencari dpjp1 permintaan
            $dpjp1_per = Dokter::find($info_ranap_dpjp1_permintaan);
            if (count($dpjp1_per) > 0) {
                $info_ranap_dpjp1_permintaan = $dpjp1_per->nama2;
            }

            //mencari dpjp2 permintaan
            $dpjp2_per = Dokter::find($info_ranap_dpjp2_permintaan);
            if (count($dpjp2_per) > 0) {
                $info_ranap_dpjp2_permintaan = $dpjp2_per->nama2;
            }

             //mencari dpjp3 permintaan
            $dpjp3_per = Dokter::find($info_ranap_dpjp3_permintaan);
            if (count($dpjp3_per) > 0) {
                $info_ranap_dpjp3_permintaan = $dpjp3_per->nama2;
            }

            // mencari saksi rs
            $saksi_dokter = Dokter::find($info_ranap_saksi);
            // cari nik perwat berdasarkan usernya
            $user_perawat  = User::where('id', $info_ranap_saksi)->where('status', 1)->first();
            $saksi_perawat = Karyawan::where('nik', $user_perawat->user)->first();
            
            if (count($saksi_dokter) > 0) {
                $nama_info_ranap_saksi = $saksi_dokter->nama2;
            }elseif (count($saksi_perawat) > 0) {
                $nama_info_ranap_saksi = $saksi_perawat->nama;
            }
        }
           //khususttd 
    $ttd_psn = DB::table('rme.ttd_pasien')
    ->where('no_reg', $no_reg)
    ->where('tgl_masuk',$tgl_masuk)
    ->where('bangsal','=','Infor')
    ->whereNull('deleted')
    ->orderBy('id', 'desc')
    ->first();
    
    $ttd_pasien = (object) null;
    if (!empty($ttd_psn)) {
        $ttd_psn = (object) $ttd_psn;
        $ttd_pasien->nama_ttd = $ttd_psn->nama_ttd;
        $ttd_pasien->ttd_pasien = IMG_RME."ttd_pasien/$ttd_psn->file";
        $ttd_file= $ttd_psn->file;
    } 
        
        $warning_sama = false; 
        include('warning.pdf.php');
        $data = array(
            "no_reg"        => $no_reg,
            "tgl_masuk"     => $tgl_masuk,
            "jam_masuk"     => $jam_masuk,
            "tgl_rs"        => $tgl_rs,
            "ranap"         => $row_mutasi_ri,
            "nama"          => $nama,
            "warning_sama"         => isset($warning_sama)?$warning_sama:false,
            "nik"           => $nik,
            "jenis_kel"     => $jenis_kel,
            "alamat"        => $alamat,
            "tgl_lahir"     => $tgl_lahir,
            "umur"          => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"),
            "telp"          => $telp,
            "agama"         => $agama,
            "kawin"         => $kawin,
            "didik"         => $didik,
            "kerja"         => $kerja,
            "rujuk"         => $rujuk,
            "kunjung"       => $kunjung,
            "asuransi"      => $asuransi,
            // "asal"          => $asal,
            "str_tgl_masuk" => $str_tgl_masuk,
            "bangsal"       => $bangsal,
            "nama_petugas"  => $nama_petugas,
            "akad"          => $akad,
            'pdf_type'      => $pdf_type,
            'lp_print'      => $lp_print,
            'printer'       => $printer,
            'ipclient'      => $ipclient,

            'asal'            => $asal,
            'info_ranap_kebutuhan'            => $info_ranap_kebutuhan,
            'info_ranap_preventif'            => $info_ranap_preventif,
            'info_ranap_kuratif'              => $info_ranap_kuratif,
            'info_ranap_rehabilitatif'        => $info_ranap_rehabilitatif,
            'info_ranap_paliatif'             => $info_ranap_paliatif,
            'info_ranap_isian'                => $info_ranap_isian,
            'info_ranap_keterangan'           => $info_ranap_keterangan,
            'info_ranap_hasil_pelayanan'      =>  explode(',',$info_ranap_hasil_pelayanan),
            'info_ranap_hasil_pelayanan_lain' => $info_ranap_hasil_pelayanan_lain,
            'info_ranap_dpjp1_jadwal'         => $info_ranap_dpjp1_jadwal,
            'info_ranap_dpjp2_jadwal'         => $info_ranap_dpjp2_jadwal,
            'info_ranap_dpjp3_jadwal'         => $info_ranap_dpjp3_jadwal,
            'info_ranap_dpjp1_permintaan'     => $info_ranap_dpjp1_permintaan,
            'info_ranap_dpjp2_permintaan'     => $info_ranap_dpjp2_permintaan,
            'info_ranap_dpjp3_permintaan'     => $info_ranap_dpjp3_permintaan,
            'info_ranap_bangsal'              => $info_ranap_bangsal,
            'info_ranap_menerangkan'          => $info_ranap_menerangkan,
            'info_ranap_menyatakan'           => $info_ranap_menyatakan,
            'info_ranap_status_layanan'       => $info_ranap_status_layanan,
            'info_ranap_penerima_info'        => $info_ranap_penerima_info,
            'info_ranap_penerima_umur'        => $info_ranap_penerima_umur,
            'info_ranap_penerima_jenkel'      => $info_ranap_penerima_jenkel,
            'info_ranap_penerima_alamat'      => $info_ranap_penerima_alamat,
            'info_ranap_hubungan'             => $info_ranap_hubungan,
            'info_ranap_saksi'                => $info_ranap_saksi,
            'nama_info_ranap_saksi'           => $nama_info_ranap_saksi,
            'nama_dr'        => $nama_dr,
            'registered_tgl' => $registered_tgl,
            'registered_jam' => $registered_jam,
            'kd_dr'          => $kd_dr,
            'ttd'            => $ttd,
            'ttd_pasien'     => $ttd_pasien,
            'ttd_file'       => $ttd_file,
        );
        //echo"<pre>";print_r($data);die();
        $view = 'pdf/pemberian_informasi_pelayanan_rawat_inap_penolakan'; 
        go($view, $data);
        // var_dump($view); die();