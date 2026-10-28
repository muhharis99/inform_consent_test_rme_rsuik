<?php
$akses = self::akses_menu();
$nik = $akses->nik;
$unit = $akses->unit;
$induk = $akses->induk;

$this->load->model('pasien');

$no_reg = $this->input->get('no_reg');
$tgl_masuk = $this->input->get('tgl');

$view = 'form_drawpad_admisi';

$this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'socket.io', 'jquery.infinite.scroll', 'jquery.esn.autobrowse', 'jstorage', 'jquery-ias.min', 'validator.min', 'jquery.idle', 'logout', 'tabutils'));
$this->template->useAsset()->setJs('admisi', array($view));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
$this->template->useAsset()->setJS(array('bootstrap-datepicker','signature_pad'));
$this->template->useAsset()->setCSS(array('bootstrap-datepicker'));

$pasien = Pasien::find($no_reg);
if (!empty($pasien)) {
    $nama = $pasien->nama;
    $kode_poli = $pasien->kd_poli;
} else {
    $nama = '';
    $kode_poli = '';
}

$data = [
    'view'      => $view,
    'akses'     => self::akses(),
    'nik'       => $nik,
    'induk'     => $induk,
    'no_reg'    => $no_reg,
    'nama'      => $nama,
   /* 'bgs'       => $kode_poli,*/
    'tgl_masuk' => $tgl_masuk,
    'assets'    => $this->template->getMetadata(),
];

go('index', $data);