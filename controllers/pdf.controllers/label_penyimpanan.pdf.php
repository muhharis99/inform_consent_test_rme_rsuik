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
        $nama_dokter = ""; 
        if (!empty($row_mutasi_ri->kd_dr_ri1)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
                $nama_dokter = $row_dokter->nama2; 
            }
        }
        $akad = null; 
        if ($no_reg=='0616688') {
            // pre($akad);
        }
        $data = array(
            "no_reg" => $no_reg,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tgl_rs" => $tgl_rs, 
            "ranap" => $row_mutasi_ri, 
            "nama" => $nama, 
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
            'pdf_type'          => $pdf_type,
            'lp_print'          => $lp_print,
            'printer'           => $printer,
            'ipclient'           => $ipclient
        );
        /*
        switch ($akad->akad) {
            case 'ASURANSI' : $view = 'pdf/akad_ijarah_asuransi'; break; 
            case 'BPJS sesuai kelas' : $view = 'pdf/akad_ijarah_bpjs_sesuai_kelas'; break; 
            case 'BPJS naik kelas I' : $view = 'pdf/akad_ijarah_bpjs_naik_kelas_i'; break; 
            case 'BPJS naik kelas II' : $view = 'pdf/akad_ijarah_bpjs_naik_kelas_ii'; break; 
            case 'BPJS mutasi kelas' : $view = 'pdf/akad_ijarah_bpjs_mutasi_kelas'; break; 
            case 'BPJS naik kelas VIP' : $view = 'pdf/akad_ijarah_bpjs_naik_kelas_vip'; break; 
            case 'BPJS naik kelas VVIP' : $view = 'pdf/akad_ijarah_asuransi'; break; 
            case 'UMUM' : $view = 'pdf/akad_ijarah_umum'; break; 
            default : $view = 'pdf/akad_ijarah_umum'; break; 
        }
        */
        /*
        $view = 'pdf/label_12'; 
        // pre($view);
        go($view, $data);
        // var_dump($view); die();
        */
        
 $url="http://192.168.0.16/cprint/index.php";
 $xdata=array("printer"=>"penyimpanankanan", "tglperiksa"=>tampiltanggal($tgl_masuk), "nomorantrian"=>"", "norm"=>$no_reg, "namapasien"=>$nama, "alamat"=>$alamat, "poliklinik"=>"", "namadokter"=>$nama_dokter, "asuransi"=>$asuransi); 
 $data=json_encode($xdata);
 $headers= array('auth:annabel', 'Content-type:application/json');
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url); 
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_POST, 1); 
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_ENCODING, "");
 curl_setopt($ch, CURLOPT_SAFE_UPLOAD, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
 $xresult = curl_exec($ch);
 //print_r($xresult);
 curl_close($ch);

        $data=array(
            "status" => true, 
            "pdf" => $data
        );
        echo json_encode($data); 