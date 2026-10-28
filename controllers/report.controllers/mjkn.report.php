<?php 
       
$view = 'report/mjkn';
$akses = self::akses_menu();
$nik   = $akses->nik;
$unit  = $akses->unit;
$induk = $akses->induk;
$nama = !empty($akses->userid)?getUserById($akses->userid):'';
$this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
$this->template->useAsset()->setJs('admisi', array($view));
$this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
$this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
$user_akses = self::akses();
$source = null;

$akses = self::akses_menu();
$nik = $akses->nik;
$data = array(
    'view'   => $view,
    'akses'  => $akses,
    'unit'   => $unit,
    'nik'    => $nik,
    'nama'    => $nama,
    'induk'  => $induk,
    'assets' => $this->template->getMetadata(),
    'source' => $source,
);
go('index', $data);