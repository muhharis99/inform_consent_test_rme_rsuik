<?php
$this->load->model('Pasien');
$this->load->model('Askep_Resiko_Jatuh');
$this->load->model('Karya');
$this->load->model('User');

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

$pasien = Pasien::find($no_reg);

if ($pasien) {
    $nama      = $pasien->nama      ?? '';
    $nik       = $pasien->no_id     ?? '';
    $tgl_lahir = $pasien->tgl_lahir ?? '';
    $alamat    = $pasien->alamat    ?? '';
}

$morse_list = Askep_Resiko_Jatuh::from('rme.askep_resiko_jatuh as asj')
    ->join('rsiklaten.mutasi_ri as mri', function ($join) {
        $join->on('asj.no_reg', '=', 'mri.no_reg')
             ->on('asj.tgl_masuk', '=', 'mri.tgl_masuk')
             ->on('asj.jam_masuk', '=', 'mri.jam_masuk');
    })
    ->leftJoin('rsiklaten.user as usr', 'asj.writer', '=', 'usr.id')
    ->leftJoin('sdm.karya as kar', 'usr.user', '=', 'kar.nik')
    ->where('asj.no_reg', $no_reg)
    ->where('asj.tgl_masuk', $tgl_masuk)
    ->where('asj.jam_masuk', $jam_masuk)
    ->where(function ($q) {
        $q->whereNull('asj.deleted')
          ->orWhere('asj.deleted', '');
    })
    ->where(function ($q) {
        $q->whereNull('mri.deleted')
          ->orWhere('mri.deleted', '');
    })
    ->where(function ($q) {
        $q->whereNull('mri.deletedstate')
          ->orWhere('mri.deletedstate', '')
          ->orWhere('mri.deletedstate', 0);
    })
    ->orderBy('asj.waktu_pengkajian', 'ASC')
    ->select(
        'asj.*',
        'asj.writer',
        'kar.nama as nama_karya'
    )
    ->distinct()
    ->get();

if (!empty($morse_list)) {

    foreach ($morse_list as $m) {

        $writer = $m->writer;

        $perawat = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')
                        ->where('user.id', $writer)
                        ->first();

        if (!empty($perawat)) {

            $m->nama_karya  = $perawat->nama ?? '';
            $m->ttd_perawat = IMG . "ttd/" . $writer . ".jpg";

        } else {

            $m->nama_karya  = '';
            $m->ttd_perawat = '';
        }
    }
}

$view = $morse_list->count() > 0
    ? 'pdf/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp_dev'
    : 'pdf/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp';

$data = [
    'no_reg'     => $no_reg,
    'nama'       => $nama,
    'nik'        => $nik,
    'tgl_lahir'  => $tgl_lahir,
    'alamat'     => $alamat,
    'tgl_masuk'  => $tgl_masuk,
    'jam_masuk'  => $jam_masuk,
    'morse_list' => $morse_list,
    'pdf_type'   => 'I'
];

go($view, $data);