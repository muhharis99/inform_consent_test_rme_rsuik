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
        $this->load->model('soap_pemberian_info_ranap');

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
        $this->load->model('user');

        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        // $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2);
        $row_mutasi_ri = (object) null; 
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
        $registered_tgl = ''; 
        $registered_jam = ''; 
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
            
        } 

        $asal            = '';
        $info_ranap_kebutuhan            = '';
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
        $nama_dr = '';
        $kd_dr   = '';
        $ttd     = '';
        $registered_tgl             = '';
        $registered_jam             = '';

        // if($no_reg == '0534494'){
            //mencari data soap_pemberia_info_ranap
            $info_ranap = Soap_pemberian_info_ranap::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->where('info_ranap_status_layanan', '1')->orderBy('id', 'desc')->first();
            if (count($info_ranap)> 0) {
                $asal            = $info_ranap->asal;
                $info_ranap_kebutuhan            = $info_ranap->info_ranap_kebutuhan;
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
                if ($info_ranap_bangsal_a == '') {
                    /* ambil di surat mondok */ 
                    $surat_mondok = DB::table('rme.surat_mondok')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'DESC')->first();
                    if (!empty($surat_mondok)) {
                        $surat_mondok = (object) $surat_mondok; 
                        $info_ranap_bangsal_a = $surat_mondok->bangsal;
                    }
                }
                $info_ranap_bangsal              = ['','Umum','Bedah','Kebidanan','Isolasi Covid','Anak','ICU-ICCU','Unit Stroke','PICU-NICU','KBRT','HCU-UGD','Medikal','Rawat Gabung','VK','Isolasi Non Covid'];
                $info_ranap_bangsal              = $info_ranap_bangsal[$info_ranap_bangsal_a];
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
                if (empty($info_ranap_hubungan_a)) {
                    $info_ranap_hubungan_a = 0;
                }
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
                $nama_info_ranap_saksi = '';
                if (count($saksi_dokter) > 0) {
                    $nama_info_ranap_saksi = $saksi_dokter->nama2;
                }elseif (count($saksi_perawat) > 0) {
                    $nama_info_ranap_saksi = $saksi_perawat->nama;
                }

                
            }
    
            // echo"<pre>";print_r($info_ranap_bangsal);die();
            
        // }

        $data = array(
            "no_reg"       => $no_reg,
            "tgl_masuk"    => $tgl_masuk,
            "jam_masuk"    => $jam_masuk,
            "tgl_rs"       => $tgl_rs,
            "ranap"        => $row_mutasi_ri,
            "nama"         => $nama,
            "nik"          => $nik,
            "jenis_kel"    => $jenis_kel,
            "alamat"       => $alamat,
            "tgl_lahir"    => $tgl_lahir,
            "umur"         => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"),
            "asal"         => $asal,
            "bangsal"      => $bangsal,
            "nama_petugas" => $nama_petugas,

            'asal'            => $asal,
            'info_ranap_kebutuhan'            => $info_ranap_kebutuhan,
            'info_ranap_isian'                => $info_ranap_isian,
            'info_ranap_keterangan'           => $info_ranap_keterangan,
            'info_ranap_hasil_pelayanan'      => $info_ranap_hasil_pelayanan,
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
            'pdf_type'       => $pdf_type,
            'lp_print'       => $lp_print,
            'printer'        => $printer,
            'ipclient'       => $ipclient
        );
        // if ($no_reg=='0309480') pre($data);
        $view = 'pdf/pemberian_informasi_pelayanan_rawat_inap_persetujuan'; 
        go($view, $data);
        // var_dump($view); die();