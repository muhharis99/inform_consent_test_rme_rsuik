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
        $this->load->model('ttd_pasien');
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
        if (segment(4) == '0000003') {
            $row_mutasi_ri = Mutasi_ri::orderBy('id', 'DESC')->first();
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
        $akad = null; 
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $query = "
            SELECT 
                * 
            FROM 
                (
                    SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'ASURANSI' as akad FROM rsik.cetak_akad_asuransi
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS sesuai kelas' as akad FROM rsik.cetak_akad_bpjs
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS naik kelas I' as akad FROM rsik.cetak_akad_bpjs_i
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS naik kelas II' as akad FROM rsik.cetak_akad_bpjs_ii
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS mutasi kelas' as akad FROM rsik.cetak_akad_bpjs_mutasi
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS naik kelas VIP' as akad FROM rsik.cetak_akad_bpjs_vip
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS kelas II naik kelas VIP' as akad FROM rsik.cetak_akad_bpjs_ii_vip
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS naik kelas VVIP' as akad FROM rsik.cetak_akad_bpjs_vvip
                    UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'UMUM' as akad FROM rsik.cetak_akad_umum
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
        //khususttd admisi
    $ttd_psn = DB::table('rme.ttd_pasien')
    ->where('no_reg', $no_reg)
    ->where('tgl_masuk',$tgl_masuk)
   /* ->where('asal','=','ADMISI')*/
    ->whereNull('deleted')
    ->orderBy('id', 'desc')
    ->first();
    
    $ttd_pasien = (object) null;
    if (!empty($ttd_psn)) {
        $ttd_psn = (object) $ttd_psn;
        $ttd_pasien->nama_ttd = $ttd_psn->nama_ttd;
        $ttd_pasien->ttd_pasien = IMG_RME."ttd_pasien/$ttd_psn->file";
    } 
    
    $inap_baru = DB::connection('rsi_byl')->table('rsi_byl.inap')->where('deleted', 0)->where('no_rm', $no_reg)->where('tgl_masuk_inap', $tgl_masuk)->orderBy('inap_id', 'desc')->first(['pj_ttd_id', 'pj_nama', 'created', 'privasi_penyakit', 'privasi_status', 'privasi_nama1', 'privasi_nama2']);
    $signature = !empty($inap_baru) ? DB::connection('rsi_byl')->table('rsi_byl.master_signature_pasien')->where('id', $inap_baru['pj_ttd_id'])->orderBy('id', 'desc')->first() : null;

    $data = array(
        "no_reg"        => $no_reg,
        "tgl_masuk"     => $tgl_masuk,
        "jam_masuk"     => $jam_masuk,
        "tgl_rs"        => $tgl_rs,
        "ranap"         => $row_mutasi_ri,
        "nama"          => $nama,
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
        "asal"          => $asal,
        "ttd_pasien"    => $ttd_pasien,
        "str_tgl_masuk" => $str_tgl_masuk,
        "bangsal"       => $bangsal,
        "nama_petugas"  => $nama_petugas,
        'signature' => !empty($signature['file']) ? $signature['file'] : null,
        'signature_nama' => !empty($inap_baru['pj_nama']) ? $inap_baru['pj_nama'] : null,
        'signature_petugas' => !empty($inap_baru['created']) ? $inap_baru['created'] : null,
        'signature_petugas_nama' => !empty($inap_baru['created']) ? getNamaByUser($inap_baru['created']) : null,
        'privasi_penyakit' => !empty($inap_baru['privasi_penyakit']) ? $inap_baru['privasi_penyakit'] : null,
        'privasi_status' => !empty($inap_baru['privasi_status']) ? $inap_baru['privasi_status'] : null,
        'privasi_nama1' => !empty($inap_baru['privasi_nama1']) ? $inap_baru['privasi_nama1'] : null,
        'privasi_nama2' => !empty($inap_baru['privasi_nama2']) ? $inap_baru['privasi_nama2'] : null,
        'inap_baru' => !empty($inap_baru) ? $inap_baru : null,
        'ttd_pasien' => $ttd_pasien,
        "akad"          => $akad,
        'pdf_type'      => $pdf_type,
        'lp_print'      => $lp_print,
        'printer'       => $printer,
        'ipclient'      => $ipclient
    );
    // if(ipclient()==IPC) json($data);

    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '';

    if ($client_ip == '172.16.18.186XXXXXX') {
        header('Content-Type: application/json');
        echo json_encode([
            "no_reg"        => $no_reg,
            "tgl_masuk"     => $tgl_masuk,
            "jam_masuk"     => $jam_masuk,

            'signature' => !empty($signature['file']) ? $signature['file'] : null,
            'signature_nama' => !empty($inap_baru['pj_nama']) ? $inap_baru['pj_nama'] : null,
            'ttd_pasien' => $ttd_pasien
        ]);
        exit;
    }
    if ($tgl_masuk <= '2025-03-03') {
        go('pdf/general_consent', $data);
    } else {
        if ($tgl_masuk >= '2026-06-10') {
            go('pdf/general_consent_byl-2026-06-10', $data);
        } else {
            go('pdf/general_consent_byl', $data);
        }
    }
    