<?php

$this->load->model('Pasien');
$this->load->model('Askep_Resiko_Jatuh');
$this->load->model('Karya');

$no_reg = segment(4);
$tgl_rs = segment(5);

if (empty($tgl_rs) || strlen($tgl_rs) < 14) {
    $tgl_rs = date('YmdHis');
}

$tgl_masuk = substr($tgl_rs, 0, 4) . '-' .
             substr($tgl_rs, 4, 2) . '-' .
             substr($tgl_rs, 6, 2);

$jam_masuk = substr($tgl_rs, 8, 2) . ':' .
             substr($tgl_rs, 10, 2) . ':' .
             substr($tgl_rs, 12, 2);

$nama      = '';
$nik       = '';
$tgl_lahir = '';
$alamat    = '';
$writer    = '';

$pasien = Pasien::find($no_reg);

if ($pasien) {
    $nama      = $pasien->nama ?? '';
    $nik       = $pasien->no_id ?? '';
    $tgl_lahir = $pasien->tgl_lahir ?? '';
    $alamat    = $pasien->alamat ?? '';
}

$morse_list = Askep_Resiko_Jatuh::from('rme.askep_resiko_jatuh as asj')
    ->leftJoin('rsiklaten.user as usr', 'asj.writer', '=', 'usr.id')
    ->leftJoin('sdm.karya as kar', 'usr.user', '=', 'kar.nik')
    ->where('asj.no_reg', $no_reg)
    ->whereNull('asj.deleted')
    ->orderBy('asj.registered', 'ASC')
    ->select(
        'asj.*',
        'usr.user as nama_writer',
        'usr.inisial',
        'usr.ttd',
        'kar.nama as nama_karya',
        'usr.paraf'
    )
    ->get();
$view = $morse_list->count() > 0
    ? 'pdf/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp'
    : 'pdf/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp';

$data = [
    'no_reg'     => $no_reg,
    'nama'       => $nama,
    'nama_karya' => $nama_karya,
    'nik'        => $nik,
    'writer'     => $writer,
    'tgl_lahir'  => $tgl_lahir,
    'alamat'     => $alamat,
    'tgl_masuk'  => $tgl_masuk,
    'jam_masuk'  => $jam_masuk,
    'morse_list' => $morse_list,
    'pdf_type'   => 'I'
];

go($view, $data);