<?php 
$view  = 'report/non_sep_all';
$akses = self::akses_menu();
$nama = self::akses();
$nik   = $akses->nik;
$unit  = $akses->unit;
$induk = $akses->induk;
$this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
$this->template->useAsset()->setJs('admisi', array($view));

$this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
$this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
$this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
$data = array(
    'view'   => $view,
    'akses'  => $akses,
    'unit'   => $unit,
    'nama'   => $nama,
    'assets' => $this->template->getMetadata(),
);
// pre($akses);    
go('index', $data);