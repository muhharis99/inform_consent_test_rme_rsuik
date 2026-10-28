<?php
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
if(!empty(segment(4))&&!empty(segment(5))) {
    $no_reg = segment(4);
    $tgl_rs = segment(5);
    if(strlen((string) segment(4))==7&&strlen((string) segment(5))==14) {
        $format_baru = true;
        switch((string) segment(6)) {
            case 'PRINT';
            case 'print';
                $pdf_type = "F";
                $lp_print = true;
                break;
            case 'FILE';
                $pdf_type = "F";
                $lp_print = false;
                break;
        }
    }
    $tgl_rs = null;
}

$this->load->model('surat_klaim');

if(count($surat_klaim) > 0) {
    $no_reg = $surat_klaim->no_reg;
    $nama = $surat_klaim->nama;
    $telp = $surat_klaim->telp;
    switch($telp) {
        case TRUE :
            $telp = $surat_klaim->telp;
            break;
        case FALSE :
            $telp =  "-";
            break;
    }
    $alamat = $surat_klaim->alamat;
    $nomor = $surat_klaim->nomor;
    $sk_tgl = $surat_klaim->sk_tgl;
    $nm_dr = $surat_klaim->nm_dr;
    $nama_poli = $surat_klaim->nama_poli;
    $rawat = $surat_klaim->rawat;
    switch($rawat) {
        case 'J' :
            $rawat = "Rawat Jalan";
            break;
        case "I" :
            $rawat =  "Rawat Inap";
            break;
    }
    $kelas = $surat_klaim->kelas;
    $tgl_masuk = $surat_klaim->tgl_masuk;
    $tgl_lahir = $surat_klaim->tgl_lahir;
    $jenis_kel = $surat_klaim->jenis_kel;
    switch($jenis_kel) {
        case 'L' :
            $jenis_kel = "Laki-Laki";
            break;
        case "P" :
            $jenis_kel =  "Perempuan";
            break;
    }
    $berat = $surat_klaim->berat;   
    switch($berat) {
        case TRUE :
            $berat = $berat = $surat_klaim->berat; 
            break;
        case FALSE :
            $berat =  "-";
            break;
    }
    $diagnosa = $surat_klaim->diagnosa; 
    $daftar = $surat_klaim->DAFTAR;
    $umur_hr = $surat_klaim->tgl_lahir; 
    $no_dr = $surat_klaim->no_dr;
    $ttd = $surat_klaim->ttd;
    $ttd_image = IMG."ttd/$no_dr.jpg";
}

$data = array(
    'no_reg' => $no_reg,
    'nama' => $nama,
    'telp' => $telp,
    'nomor' => $nomor,
    'sk_tgl' => date('d-m-Y', strtotime($sk_tgl)),
    'alamat' => $alamat,
    'nm_dr' => $nm_dr,
    'nama_poli' => $nama_poli,
    'rawat' => $rawat,
    'kelas' => $kelas,
    'jenis_kel' => $jenis_kel,
    'tgl_masuk' => date('d-m-Y', strtotime($tgl_masuk)),
    'tgl_lahir' => date('d-m-Y', strtotime($tgl_lahir)),
    'umur_hr'   => time_ago_by($tgl_lahir, $tgl_masuk, 'd').' hari',
    'umur_th' => time_ago_by($tgl_lahir, $tgl_masuk, 'y').' tahun',
    'berat' => $berat,
    'diagnosa' => $diagnosa,
    'no_dr' => $no_dr,
    'ttd' => $ttd,
    'daftar' => $daftar,
    'ttd_image' => $ttd_image,
    'pdf_type' => 'I',
);

go('pdf/pdf_haris_test', $data);