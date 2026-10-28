<?php 

$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
$halaman = "";
$halamanx = "";
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
    case 'PRINTSERVER1' : 
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break; 
     case 'PRINTSERVER2' : 
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
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
        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)
                            ->whereRaw("(tgl_masuk = '$tgl_masuk' or tgl_ri = '$tgl_masuk')")
                            ->whereNull('deleted')
                            // ->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))
                            ->orderBy('id', 'DESC')
                            ->first();
        // if ($no_reg=='0701334') pre($tgl_masuk);

        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->whereRaw("tgl_masuk='$tgl_masuk'")->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->whereRaw("tgl_masuk=date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
       
        if ($no_reg == '0304842') {
            // echo"<pre>";print_r($tgl_masuk);die();
        }

        $nama = ''; 
        $nik = ''; 
        $alamat = ''; 
        $umur = ''; 
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
            if (empty($row_bangsal)) $row_bangsal = Bangsal::where('induk', $row_mutasi_ri->bangsal)->selectRaw("induk_nama_pendaftaran as nama_pendaftaran")->first();
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

        $dokterArray=[];
        // if ($no_reg=='0701334') pre($row_mutasi_ri);

        if (!empty($row_mutasi_ri->kd_dr_ri1)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri2)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri2)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri3)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri3)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri4)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri4)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri5)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri5)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray, $row_dokter->nama2);
            }
        }
        // var_dump($dokterArray); die();
        $row_mutasi_ri->dokterArray = $dokterArray;
        if (empty($row_mutasi_ri)) {
            $kunjung = "";
        } 
        $tgl_masuk = $tgl_masuk; 
        $tgl_keluar = date("Y-m-d"); 
        $query = "select * from rsiklaten.bgs_register where no_reg='$no_reg' and tgl_daftar='$tgl_masuk' and kd_bangsal is not null";
        $rows_bgs_register = DB::select($query); 
        if (!empty($rows_bgs_register)) {
            foreach ($rows_bgs_register as $row_bgs_register) {
                $row_bgs_register = (object) $row_bgs_register; 
                switch ($row_bgs_register->status_pulang) {
                    case 1: 
                    case '1': 
                        $tgl_keluar = date("Y-m-d", strtotime($row_bgs_register->tgl_keluar));
                        break; 
                }
            }
        } 
        if ($no_reg=="") {
            $tgl_masuk  = date("Y-m-d");
            $tgl_keluar = date("Y-m-d");
        }
        $query = "
        SELECT 
            aa.kd_dr, aa.tanggal, aa.jam, ab.nama2 as nama, aa.trbgs, aa.freepkt, aa.no_perk 
        FROM 
            ( 
            SELECT 
                * 
            FROM (
                SELECT * FROM bill.rarofah_db5
                UNION ALL SELECT * FROM bill.rbedah_db5
                UNION ALL SELECT * FROM bill.ricu_db5 
                UNION ALL SELECT * FROM bill.rimc_db5
                UNION ALL SELECT * FROM bill.risolasi_db5
                UNION ALL SELECT * FROM bill.rjblnur_db5
                UNION ALL SELECT * FROM bill.rmarwah_db5
                UNION ALL SELECT * FROM bill.rmina_db5
                UNION ALL SELECT * FROM bill.rmtz_db5
                UNION ALL SELECT * FROM bill.rnamiroh_db5
                UNION ALL SELECT * FROM bill.rpicu_db5
                UNION ALL SELECT * FROM bill.rshofa_db5
                UNION ALL SELECT * FROM bill.rsiti_h_db5
                UNION ALL SELECT * FROM bill.rvip_db5
                UNION ALL SELECT * FROM bill.rvk_db5
                UNION ALL SELECT * FROM bill.rzam2_db5
                UNION ALL SELECT * FROM bill.rzam_db5            
                ) a 
            WHERE 
                a.no_reg = '$no_reg'
                AND a.deleted IS NULL 
                AND a.tanggal BETWEEN '$tgl_masuk' AND '$tgl_keluar'
                ORDER BY a.tanggal ASC, a.jam ASC
            ) aa
            LEFT JOIN rsiklaten.dokter ab
                ON aa.kd_dr = ab.no_dr 
        ";
        $rows_bill = DB::select($query); 
        $rows_visit = (array) null; 
        if (!empty($rows_bill)) {
            foreach ($rows_bill as $row_bill) {
                $row_bill = (object) $row_bill; 
                switch ($row_bill->kd_dr) {
                    case NULL : 
                    case '' :
                        break; 
                    default : 
                        $rows_visit[] = $row_bill;
                        break;
                }
            }
        } 
        // pre($rows_bgs_register); 
        // $pdf_type = "I";
        $umur = selisihymdhis($tgl_lahir, $tgl_masuk, "umur");
        
        //prosedur cara masuk
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
            "telp"          => $telp,
            "agama"         => $agama,
            "kawin"         => $kawin,
            "didik"         => $didik,
            "kerja"         => $kerja,
            "rujuk"         => $rujuk,
            "kunjung"       => $kunjung,
            "asuransi"      => $asuransi,
            "jenis_asal_rujukan"         => $jenis_asal_rujukan,
            "prosedur_cara_masuk"         => $prosedur_cara_masuk,
            "asal"          => $asal,
            "str_tgl_masuk" => $str_tgl_masuk,
            "bangsal"       => $bangsal,
            "nama_petugas"  => $nama_petugas,
            "visit"         => $rows_visit,
            'pdf_type'      => $pdf_type,
            'lp_print'      => $lp_print,
            'printer'       => $printer,
            'halaman'       => $halaman,
            'halamanx'      => $halaman,
            'waktu_cetak'      => date("d/m/Y H:i:s"),
            'ipclient'      => $ipclient
        );
        
        // if (ipclient()=='172.16.18.18') pre($data);
        if (ipclient()=='172.16.18.18') {
            // echo"<pre>";print_r($data);die();
            // go('pdf/sdp-vip', $data);
            go('pdf/sdp', $data);
        } else {
            go('pdf/sdp', $data);
        }