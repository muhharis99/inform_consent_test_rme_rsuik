<?php 
$this->load->model('poli');
$this->load->model('diagnosa');
$this->load->model('tindakan');
$view  = 'report/resume_gd_icd2';
$akses = self::akses_menu();
$nama = self::akses();
$nik   = $akses->nik;
$unit  = $akses->unit;
$induk = $akses->induk;

$poli = Poli::where('show', '1')->orderBy('nama_poli', 'asc')->get();
$diagnosa = Diagnosa::where('status_deleted', '0')->get();
$tindakan = Tindakan::where('kode', '!=', '')->get();
$this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
$this->template->useAsset()->setJs('admisi', array($view));

$this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
$this->template->useAsset()->setCSS('bill', array('bootstrap-table.min'));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
$this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
$data = array(
    'view'     => $view,
    'akses'    => $akses,
    'unit'     => $unit,
    'nama'     => $nama,
    'diagnosa' => $diagnosa,
    'tindakan' => $tindakan,
    'poli'     => $poli,
    'assets'   => $this->template->getMetadata(),
);
// pre($akses);    
go('index', $data);