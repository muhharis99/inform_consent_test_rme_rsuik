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

        $tanggal = date("Y-m-d");
        $no_reg = segment(4); 
        $tgl_rs = segment(5); 
        if ($tgl_rs!='') {
            $tgl_masuk = date("Y-m-d", strtotime($tgl_rs)); 
            $jam_masuk = date("H:i:s", strtotime($tgl_rs)); 
            $tanggal = $tgl_masuk;
        }

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
        $soap = Soap::where('no_reg', $no_reg)->where('tgl_masuk', $tanggal)->where('kd_dr','S202')->orderBy('id','DESC')->limit(1)->first(['kd_dr','diagnosa','diagnosa_fungsional','periksa','tindakan','anamnese', 'tgl_masuk']);
        if (empty($soap)) $soap = Soap::where('no_reg', $no_reg)->whereRaw("tgl_masuk <= '$tanggal'")->where('kd_dr','S202')->orderBy('id','DESC')->limit(1)->first(['kd_dr','diagnosa','diagnosa_fungsional','periksa','tindakan','anamnese','tgl_masuk']);
        if (!empty($soap)) {
            $kesimpulan = render_strtopdf($soap->periksa);
            $diag_medis = str_replace('@@,', ', ', $soap->diagnosa);
            $diag_fungsi = str_replace('@@,', ', ', $soap->diagnosa_fungsional);
            $rekomendasi = str_replace('@@,', ', ', $soap->tindakan);
            $hal_yg_didapat = str_replace('@@,', ', ', $soap->anamnese);
            $kd_dr = $soap->kd_dr;
            $tanggal = $soap->tgl_masuk;
        }
        $tgl_periksa = tampiltanggal($tanggal, 9); 
        // pre($tgl_periksa);
        $surat = Surat_Fisioterapi::select(['anjuran','evaluasi', 'registered', 'tanggal'])->where('dokter_id', $kd_dr)->where('no_reg', $no_reg)->where('tanggal', $tanggal)->orderBy('id', 'desc')->first();
        if (ipclient()==IPC) json($kd_dr);
        $tanggal = ""; 
        if (!empty($surat)) {
            $anjuran      = str_replace('@@,', ', ', $surat->anjuran);
            $tanggal = tampiltanggal($surat->registered, 9);
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
            'anjuran'   => render_strtopdf($anjuran),
            'rekomendasi' => $rekomendasi,
            'dokter' => $dokter,
            'ttd_image' => IMG."ttd/$kd_dr.jpg",
            'hal_yg_didapat' => $hal_yg_didapat,
            'pdf_type'  => $pdf_type,
            'lp_print'  => $lp_print,
            'printer'   => $printer,
            'ipclient'  => $ipclient,
        ];
        // pre($data);
        // ipclient()==IPC?json($data):
        go('pdf/lembar_hasil_tindakan_uji_fungsi', $data);