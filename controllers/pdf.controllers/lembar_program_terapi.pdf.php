<?php 

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
        $this->load->model('pasien');
        $this->load->model('soap');
        $this->load->model('surat_fisioterapi');
        $this->load->model('Monitoring_fisioterapi');
        $xtgl_awal = null;
        $xtgl_akhir = null; 
        $tanggal = date("Y-m-d");
        $no_reg = segment(4); 
        $tgl_rs = segment(5); 
        
        
        if ($tgl_rs!='') {
            if(strpos($tgl_rs, "-") !== false){
                $exp_tgl_rs = explode("-", $tgl_rs); 
                if (isset($exp_tgl_rs[0])) {
                    $tgl_rs = $exp_tgl_rs[0];
                    $tgl_masuk = date("Y-m-d", strtotime($tgl_rs)); 
                    $jam_masuk = date("H:i:s", strtotime($tgl_rs));                     
                    $xtgl_awal = date("Y-m-d", strtotime($tgl_rs)); 
                }
                if (isset($exp_tgl_rs[1])) {
                    $tgl_rs = $exp_tgl_rs[1];
                    $tgl_masuk = date("Y-m-d", strtotime($tgl_rs)); 
                    $jam_masuk = date("H:i:s", strtotime($tgl_rs));                     
                    $xtgl_akhir = date("Y-m-d", strtotime($tgl_rs)); 
                }
                $tgl_masuk = date("Y-m-d", strtotime($tgl_rs)); 
                $jam_masuk = date("H:i:s", strtotime($tgl_rs)); 
                $tanggal = $tgl_masuk;
            } else {
//                if (ipclient()=="172.16.18.17") {
                    $tgl_masuk = date("Y-m-d", strtotime($tgl_rs)); 
                    $jam_masuk = date("H:i:s", strtotime($tgl_rs)); 
                    $tanggal = $tgl_masuk;
                    $surat_fisioterapi = Soap::where('no_reg', $no_reg)->where('kd_poli', 'RHMD')->whereRaw("tgl_masuk <= '$tgl_masuk'")->where('kd_dr', 'S202')->orderBy('id', 'desc')->first();
                    $xtgl_awal = !empty($surat_fisioterapi['tgl_masuk'])?$surat_fisioterapi['tgl_masuk']:date("Y-m-d", strtotime($tgl_rs));
                    $xtgl_akhir = date("Y-m-d", strtotime($tgl_rs)); 
                    // json($xtgl_awal);

//                }
            }
        }
        // pre($xtgl_awal." sd ".$xtgl_akhir);

        $nama_pasien = '';
        $alamat = '';
        $telp = '';
        $tgl_lahir = '';
        $umur = '';
        $kd_dr = '';
        $anjuran = '';
        $jenis_kel = '';
        $kesimpulan = '';
        $diag_medis = '';
        $diag_fungsi = '';
        $rekomendasi = '';
        $hal_yg_didapat = '';

        /*
        $diagnosa = '';
        $terapi = '';
        $dokter = '';
        $anjuran = '';
        $tgl_anjuran = '';
        $ttd_image = '';
        $program = array();
        $soap = Soap::leftJoin('rsiklaten.pasien', function ($join) {
                $join->on('soap.no_reg', '=', 'rsiklaten.pasien.no_reg');
            })->leftJoin('rsiklaten.dokter', function ($join){
                $join->on('soap.kd_dr', '=', 'rsiklaten.dokter.no_dr');
            })->where('soap.kd_poli', 'RHMD')->where('soap.no_reg', $no_reg)->orderBy('soap.registered','desc')->first(array('soap.id','soap.kd_dr','soap.tgl_masuk','soap.diagnosa','soap.tindakan','rsiklaten.pasien.no_reg', 'rsiklaten.pasien.nama','rsiklaten.dokter.nama2'));
        if ($soap->exists) {
            $surat = Surat_Fisioterapi::where('tanggal', $soap->tgl_masuk)->where('no_reg', $no_reg)->first(array('id','anjuran'));
            $nama_pasien = $soap->nama;
            $diagnosa = str_replace('@@,', ', ', $soap->diagnosa);
            $terapi = str_replace('@@,', ', ', $soap->tindakan);
            $anjuran = str_replace('@@,', ', ', $surat->anjuran);
            $tgl_anjuran = date('d-m-Y', strtotime($soap->tgl_masuk));
            $dokter = $soap->nama2;
            $ttd_image = IMG."ttd/$soap->kd_dr.jpg";
        };
        */
        // pre($tanggal);
        $pasien = Pasien::where('no_reg', $no_reg)->first(['nama','alamat','telp','tgl_lahir','umur','jenis_kel']);
        if (!empty($pasien)) {
            $nama_pasien = $pasien->nama;
            $alamat = $pasien->alamat;
            // $tgl_lahir = date('d-m-Y', strtotime($pasien->tgl_lahir));
            $tgl_lahir = tampiltanggal($pasien->tgl_lahir, 9);
            $telp = $pasien->telp;
            $umur = selisihymdhis($pasien->tgl_lahir, $tgl_masuk, "umur");
            $jenis_kel = $pasien->jenis_kel;
        }
        $soap = Soap::where('no_reg', $no_reg)->whereBetween('tgl_masuk', [$xtgl_awal, $xtgl_akhir])->where('kd_dr','S202')->orderBy('id','DESC')->limit(1)->first(['kd_dr','diagnosa','diagnosa_fungsional','periksa','tindakan','anamnese']);
        // if (ipclient()=="172.16.18.17") json($soap->kd_dr);
        if (!empty($soap)) {
            $kesimpulan = render_strtopdf($soap->periksa);
            $diag_medis = str_replace('@@,', ', ', $soap->diagnosa);
            $diag_fungsi = str_replace('@@,', ', ', $soap->diagnosa_fungsional);
            $rekomendasi = str_replace('@@,', ', ', $soap->tindakan);
            $hal_yg_didapat = str_replace('@@,', ', ', $soap->anamnese);
            $kd_dr = $soap->kd_dr;
        }
        $tgl_periksa = tampiltanggal($tanggal, 9); 
        $surat = Surat_Fisioterapi::select(['anjuran','evaluasi', 'registered', 'tanggal'])->where('dokter_id', $kd_dr)->where('no_reg', $no_reg)->whereBetween('tanggal', [$xtgl_awal, $xtgl_akhir])->orderBy('id', 'desc')->first();
        $tanggal = ""; 
        $tgl_anjuran = ""; 
        if (!empty($surat)) {
            $anjuran      = str_replace('@@,', ', ', $surat->anjuran);
            $tanggal = tampiltanggal($surat->registered, 9);
            $tgl_anjuran = tampiltanggal($surat->registered, 9);
        }
        $program = [];
        $monitoring = Monitoring_fisioterapi::where('no_reg', $no_reg)->whereBetween('tgl_masuk', [$xtgl_awal, $xtgl_akhir])->get();
        if (!empty($monitoring)) {
            foreach ($monitoring as $row) {
                $row = (object) $row; 
                $obj = (object) null; 
                $obj->tgl_masuk = tampiltanggal($row->tgl_masuk, 9); 
                $tanggal = tampiltanggal($row->tgl_masuk, 9); 
                $obj->program = $row->program;
                $obj->terapis = file_exists(FCPATH."assets/public/img/ttd/fis/$row->terapis.png")?IMG."ttd/fis/$row->terapis.png":(file_exists(FCPATH."assets/public/img/ttd/$row->terapis.jpg")?IMG."ttd/$row->terapis.jpg":'');
                // $obj = $row;
                $program[] = $obj;
            }
        }
        // $dokter = ""; 
        $dokter = $kd_dr != "" ? getDokterByKode($kd_dr) : "";
        // pre($surat);
        // $evaluasi     = $surat->evaluasi;
        // echo "<pre>".var_export($surat, TRUE)."</pre>";
        // $kesimpulan ="";
        $data = [
            'no_reg'    => $no_reg,
            'nama'      => $nama_pasien,
            'tanggal'   => $tanggal,
            'tgl_lahir' => $tgl_lahir,
            'alamat'    => $alamat,
            'umur'      => $umur,
            'telp'      => $telp,
            'jenis_kel' => $jenis_kel,
            'kesimpulan' => $kesimpulan,
            'diag_medis' => $diag_medis,
            'diag_fungsi' => $diag_fungsi,
            'anjuran'   => $anjuran,
            'tgl_anjuran'   => $tgl_anjuran,
            'rekomendasi' => $rekomendasi,
            'program' => $program,
            'dokter' => $dokter,
            // 'ttd_image' => file_exists(IMG."ttd/$kd_dr.jpg")?IMG."ttd/$kd_dr.jpg":"",
            'ttd_image' => IMG."ttd/$kd_dr.jpg",
            'hal_yg_didapat' => $hal_yg_didapat,
            'pdf_type'  => $pdf_type,
            'lp_print'  => $lp_print,
            'printer'   => $printer,
            'ipclient'  => $ipclient,
        ];
        // pre($data);
        // if (ipclient()=='172.16.18.21') json($data);
        go('pdf/monitoring_kunjungan_pelayanan_rehabilitasi_medik', $data);
