<?php 
$view  = 'report_waktu_tunggu_admisi';
$akses = self::akses_menu();
$nama = self::akses();
$nik   = $akses->nik;
$unit  = $akses->unit;
$induk = $akses->induk;
$this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
$this->template->useAsset()->setJs('admisi', array($view));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
$data = array(
    'view'   => $view,
    'akses'  => $akses,
    'unit'   => $unit,
    'nama'   => $nama,
    'assets' => $this->template->getMetadata(),
);
// pre($akses);    
go('index', $data);