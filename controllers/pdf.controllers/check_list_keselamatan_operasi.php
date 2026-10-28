<?php
include ('init.pdf.php');
$this->load->model('operasi_selamat');
$this->load->model('dokter');
$this->load->model('pasien');
$this->load->model('bangsal');
$this->load->model('user');
$this->load->model('perawat');
$this->load->model('bon_op');

$no_reg = segment(4);
$tgl_rs = segment(5);
if(!empty($tgl_rs)) {
	$tgl_op = date('Y-m-d H:i', strtotime(getStrtotime($tgl_rs)));
	if($tgl_op) {
		$bon = Bon_op::whereRaw("CONCAT(tanggal,' ', LEFT(jam, 5)) = ?", array($tgl_op))->first();
	}
	/*
	if(strlen($tgl_rs) == 14) {
		$tanggal = date('Y-m-d', strtotime($tgl_rs));
		$jam = date('H:i:s', strtotime($tgl_rs));
		// $bon = Bon_op::where(array('no_reg' => $no_reg, 'tanggal' => $tanggal, 'jam' => $jam))->first();
		$bon = Bon_op::where(array('no_reg' => $no_reg))->whereRaw("tanggal >= '$tanggal'")->orderBy('id', 'asc')->first();
	}
	*/
}
$pasien = Pasien::find($no_reg);
if (!empty($bon->Id)) {
    $operasi  = Operasi_Selamat::where('bon_id', $bon->Id)->first();
}
// if ($no_reg=='0448947') pre($operasi);

$bon_tindakan = '-';
$bon_tindakan_check = 'T';
$bon_diagnosa = '-';
$bon_diagnosa_check = 'T';
if(!empty($bon)) {
    if($bon->dx1 != null && $bon->dx2 != null) {
        $bon_diagnosa_check = 'Y';
        $bon_diagnosa = $bon->dx1.', '.$bon->dx2;
    } else if ($bon->dx1 != null && $bon->dx2 == null) {
        $bon_diagnosa_check = 'Y';
        $bon_diagnosa = $bon->dx1;
    }

    if($bon->pd1 != null && $bon->pd2 != null) {
        $bon_tindakan_check = 'Y';
        $bon_tindakan = $bon->pd1.', '.$bon->pd2;
    } else if ($bon->pd1 != null && $bon->pd2 == null) {
        $bon_tindakan_check = 'Y';
        $bon_tindakan = $bon->pd1;
    }
}
if (!empty($pasien)) {
    $nama= $pasien->nama;
    $tgl_lahir= $pasien->tgl_lahir;
    $alamat= $pasien->alamat;
    $umur= $pasien->umur;
    $nik= $pasien->no_id;
}

$data = array(
    "no_reg" => $no_reg,
    "nama" => $nama,
    "tgl_lahir" => $tgl_lahir,
    'umur' => $umur,
    'alamat' => $alamat,
    'nik' => $nik,
    'operasi' => $operasi,
    'bon_tindakan' => $bon_tindakan,
    'bon_tindakan_check' => $bon_tindakan_check,
    'bon_diagnosa' => $bon_diagnosa,
    'bon_diagnosa_check' => $bon_diagnosa_check,
    'tgl_signin' => (!empty($operasi) && !empty($operasi->tgl_signin)) ? 'Tanggal: '.date('d/m/Y', strtotime($operasi->tgl_signin)).' Pukul '.date('H:i', strtotime($operasi->tgl_signin)).' WIB' : 'Tanggal : ___/___/______ &nbsp; Pukul ___:___ WIB',
    'tgl_insisi' => (!empty($operasi) && !empty($operasi->tgl_insisi)) ? 'Tanggal: '.date('d/m/Y', strtotime($operasi->tgl_insisi)).' Pukul '.date('H:i', strtotime($operasi->tgl_insisi)).' WIB' : 'Tanggal : ___/___/______ &nbsp; Pukul ___:___ WIB',
    'tgl_signout' => (!empty($operasi) && !empty($operasi->tgl_signout)) ? 'Tanggal: '.date('d/m/Y', strtotime($operasi->tgl_signout)).' Pukul '.date('H:i', strtotime($operasi->tgl_signout)).' WIB' : 'Tanggal : ___/___/______ &nbsp; Pukul ___:___ WIB',
    'perawat_terima' => (!empty($operasi) && !empty($operasi->perawat_terima)) > 0 ? getUserById($operasi->perawat_terima) : '',
    'perawat_anestesi' => (!empty($operasi) && !empty($operasi->perawat_anestesi)) > 0 ? getUserById($operasi->perawat_anestesi) : '',
    'perawat_rr' => (!empty($operasi) && !empty($operasi->perawat_rr)) > 0 ? getUserById($operasi->perawat_rr) : '',
    'perawat_instrumen' => (!empty($operasi) && !empty($operasi->perawat_instrumen)) > 0 ? getUserById($operasi->perawat_instrumen) : '',
    'petugas_pembaca' => (!empty($operasi) && !empty($operasi->timeout_petugas_pembaca)) > 0 ? getUserById($operasi->timeout_petugas_pembaca) : '',
    'dr_bedah' => (!empty($operasi) && !empty($operasi->dokter_bedah)) > 0 ? getDokterByKode($operasi->dokter_bedah) : '',
    'dr_anestesi' => (!empty($operasi) && !empty($operasi->dokter_anestesi)) > 0 ? getDokterByKode($operasi->dokter_anestesi) : '',
    "pdf_type" => "I"
);

$view = 'pdf/checklist_keselamatan_operasi'; 
go($view, $data);