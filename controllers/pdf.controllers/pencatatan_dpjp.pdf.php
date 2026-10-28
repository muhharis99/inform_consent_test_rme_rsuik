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
        if (empty($row_mutasi_ri)) $row_mutasi_ri = (object) null;
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
            // $query = "
            // SELECT 
            //     * 
            // FROM 
            //     (
            //         SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS mutasi kelas' as akad, kd_bangsal, pihak_pertama_nama, pihak_pertama_nik, pihak_pertama_jabatan, pihak_kedua_nama, pihak_kedua_alamat, pihak_kedua_nik, pihak_kedua_pekerjaan, saksi_satu, saksi_dua, tgl_dibuat FROM rsik.cetak_akad_bpjs_mutasi
            //     ) akad 
            // WHERE 
            //     no_reg = '$no_reg'
            //     AND tgl_masuk = '$tgl_masuk'
            //     AND deleted IS NULL 
            // ";
            // $data_akad = DB::select($query); 
            // $akad = self::obj($data_akad);
            // $akad 
        }
        include('warning.pdf.php');
        $arr_dokter = array_column(DB::select("select no_dr as kode, nama2 as nama from rsiklaten.dokter"), "nama", "kode");
        $arr_id = array_column(DB::select("select id, user from rsiklaten.user"), "id", "user");
        if (!empty($row_mutasi_ri)) {
            $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $row_mutasi_ri->tgl_ri??'')->where('writer', $arr_id[$row_mutasi_ri->kd_dr_ri1??'']??'')->first(['diagkerja', 'writer', 'writed', 'dpjp1']);
        }
        $rows_diagnosa = DB::select("select no_reg, registered, ppa, diag_utama, diag_tambahan, diag_banding, verif from rme.cppt_ri use index (no_reg) where no_reg = '$no_reg' and length(ppa) = 4 and ppa not in ('S037', 'S067', 'S074', 'S129', 'S148', 'S149', 'S153', 'S193', 'S410', 'S435', 'S436', 'S469', 'S474', 'S503', 'S525', 'S531') and deleted is null and form != 'daily' and registered between '$row_mutasi_ri->tgl_ri' and now() GROUP BY verif, ppa order by registered asc");
        $row_mutasi_ri->nama_dpjputama = $arr_dokter[$row_mutasi_ri->kd_dr_ri1??''] ?? '';
        $row_mutasi_ri->nama_dpjp1 = $arr_dokter[$row_mutasi_ri->kd_dr_ri2??''] ?? '';
        $row_mutasi_ri->nama_dpjp2 = $arr_dokter[$row_mutasi_ri->kd_dr_ri3??''] ?? '';
        $row_mutasi_ri->nama_dpjp3 = $arr_dokter[$row_mutasi_ri->kd_dr_ri4??''] ?? '';
        $diagnosa = [];
        if (!empty($soap)) {
            $diagnosa[] = [
                    "status" => !empty($rows_diagnosa[0]['verif']) && ($arr_id[$rows_diagnosa[0]['verif']]??'')!=$soap['writer'] ? 'dpjp' : 'utama', 
                    "diagnosa" => tagString($soap['diagkerja']),
                    "mulai" => date("d/m/Y", strtotime($soap['writed'])), 
                    "selesai" => NULL, 
                    "nama" => $arr_dokter[$soap['dpjp1']] 
                ];
        }
        if (!empty($rows_diagnosa)) {
            foreach ($rows_diagnosa as $row_diagnosa) {
                $diagnosa[] = [
                    "status" => $row_diagnosa['ppa'] == $row_diagnosa['verif'] ? 'utama' : 'dpjp', 
                    "diagnosa" => tagString($row_diagnosa['diag_utama']),
                    "mulai" => date("d/m/Y", strtotime($row_diagnosa['registered'])), 
                    "selesai" => NULL, 
                    "nama" => $arr_dokter[$row_diagnosa['ppa']] 
                ];
            }
        }
        $data = array(
            "no_reg" => $no_reg,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tgl_rs" => $tgl_rs, 
            "diagnosa" => tagString($soap['diagkerja']??''), 
            "ranap" => $row_mutasi_ri, 
            "nama" => $nama, 
            "warning_sama" => isset($warning_sama)?$warning_sama:false, 
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
            "diagnosa" => $diagnosa,
            "akad" => $akad,
            'pdf_type'      => $pdf_type,
            'lp_print'      => $lp_print,
            'printer'       => $printer,
            'ipclient'      => $ipclient,
            "warning_sama" => isset($warning_sama)?$warning_sama:false
        );
        $view = 'pdf/pencatatan_dpjp'; 
        // $view = 'pdf/pencatatan_dpjp_kosong'; 
        // if (ipclient()==IPC) $view = 'pdf/pencatatan_dpjp'; 

        go($view, $data);