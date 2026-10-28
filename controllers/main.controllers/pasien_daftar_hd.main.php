<?php

header('Access-Control-Allow-Origin: *');

$akses   = self::akses_menu();
$nik     = $akses->nik;
$unit    = $akses->unit;
$induk   = $akses->induk;

$kd_poli    = null;
$kd_dokter  = segment(5);
$klinik     = segment(4);

$this->load->model(['bangsal', 'asuransi', 'agama', 'perkawinan']);

$agama     = Agama::orderBy('no_urut', 'asc')->get(['kd_agama', 'agama']);
$kawin     = Perkawinan::orderBy('no_urut', 'asc')->get(['kd_perkawinan', 'nama_perkawinan']);
$bangsal   = Bangsal::where('status_pendaftaran', '1')->groupBy('nama_pendaftaran')->orderBy('nama_pendaftaran', 'asc')->get();
$asuransi  = Asuransi::whereRaw("NAMA not like 'ZZZ%'")->orderBy('nama', 'asc')->get();
$pekerjaan = DB::table('rsiklaten.pekerjaan')->orderBy('no_urut', 'asc')->get();
$rujuk     = DB::table('rsiklaten.rujuk')->orderBy('no_urut', 'asc')->get();

$dokter = DB::table('rsiklaten.dokter')
    ->select('no_dr', 'nama2')
    ->whereIn('no_dr', ['S177', 'S035', 'S023','S464'])
    ->orderBy('no_dr', 'asc')
    ->get();

$printer = DB::table('rsik.admisi_printer')
    ->whereIn('kategori', ['admisi'])
    ->groupBy('printer')
    ->orderBy('nama', 'asc')
    ->get();

if ($nik == '100952') {
    $printer = DB::table('rsik.admisi_printer')
        ->groupBy('printer')
        ->orderBy('nama', 'asc')
        ->get();
}

$view = 'form/rawat_pasien_hd';

$this->template->useAsset()->setJs([
    'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min',
    'imageselect.jquery', 'jquery.idle', 'logout',
    'jquery.inputmask', 'jquery.mask'
]);

$this->template->useAsset()->setJs('admisi', [$view]);
$this->template->useAsset()->setCSS([
    'theme4', 'bootstrap.min.theme4', 'jquery-ui',
    'jquery.tag-editor', 'annotator-pro.min', 'imageselect'
]);

$this->template->useAsset()->setJS(['bootstrap-datepicker']);
$this->template->useAsset()->setCSS(['bootstrap-datepicker']);

$hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad'];

$ipclient        = ipclient();
$default_printer = '';

if (!empty($printer)) {
    foreach ($printer as $row_printer) {
        $row_printer = (object) $row_printer;
        if ($row_printer->ip == $ipclient) {
            $default_printer = $row_printer->printer;
        }
    }
}

$data = [
    'title'           => 'PENDAFTARAN PASIEN HEMODIALISA',
    'view'            => $view,
    'akses'           => self::akses(),
    'nik'             => $nik,
    'induk'           => $induk,
    'kd_poli'         => $kd_poli,
    'rows_agama'      => $agama,
    'rows_kawin'      => $kawin,
    'klinik'          => strtoupper($klinik),
    'kd_dokter'       => $kd_dokter,
    'hari'            => $hari,
    'bangsal'         => $bangsal,
    'asuransi'        => $asuransi,
    'kerja'           => $pekerjaan,
    'printer'         => $printer,
    'default_printer' => $default_printer,
    'rujuk'           => $rujuk,
    'dokter'          => $dokter,
    'assets'          => $this->template->getMetadata(),
];

go('index', $data);