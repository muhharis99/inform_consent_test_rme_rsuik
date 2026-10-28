<?php

header('Access-Control-Allow-Origin: *');

$akses = self::akses_menu();
$nik = $akses->nik;
$unit = $akses->unit;
$induk = $akses->induk;
$kd_poli = null;
$kd_dokter = null;
$klinik = segment(4);
$kd_dokter = segment(5);

$this->load->model('bangsal');
$this->load->model('asuransi');
$this->load->model('agama');
$this->load->model('perkawinan');
$this->load->model('pendidikan');
$this->load->model('bahasa');
$this->load->model('hamb_emosi');
$this->load->model('hamb_motivasi');
$this->load->model('hamb_fisik');
$this->load->model('hamb_kognitif');



$agama = Agama::orderBy('no_urut', 'asc')->get(['kd_agama', 'agama']);
$kawin = Perkawinan::orderBy('no_urut', 'asc')->get(['kd_perkawinan', 'nama_perkawinan']);
$kd_pendidikan_daftar = [2, 3, 4, 15, 9, 16];

// $pendidikan = Pendidikan::whereIn('kd_pendidikan', $kd_pendidikan_daftar)
$pendidikan = Pendidikan::whereNotIn('no_urut', [0])
    ->orderBy('no_urut', 'asc')
    ->get(['kd_pendidikan', 'pendidikan']);
$bahasa = Bahasa::where('no_urut', '!=', '0')->orderBy('no_urut', 'asc')->get(['kd_bahasa', 'nama_bahasa']);
$hamb_emosi = Hamb_emosi::where('urut', '!=', '0')->orderBy('urut', 'asc')->get(['id', 'nama']);
$hamb_motivasi = Hamb_motivasi::where('urut', '!=', '0')->orderBy('urut', 'asc')->get(['id', 'nama']);
$hamb_fisik = Hamb_fisik::where('urut', '!=', '0')->orderBy('urut', 'asc')->get(['id', 'nama']);
$hamb_kognitif = Hamb_kognitif::where('urut', '!=', '0')->orderBy('urut', 'asc')->get(['id', 'nama']);
$bangsal = Bangsal::where('status_pendaftaran', '1')->groupBy('nama_pendaftaran')->orderBy('induk_nama_pendaftaran', 'asc')->orderBy('kd_kelas_pendaftaran', 'asc')->get();
$asuransi = Asuransi::whereRaw("NAMA not like 'ZZZ%'")->orderBy('nama', 'asc')->get();
$pekerjaan = DB::table('rsiklaten.pekerjaan')->orderBy('no_urut', 'ASC')->get();
$rujuk = DB::table('rsiklaten.rujuk')->orderBy('no_urut', 'ASC')->get();
$printer = DB::table('rsik.admisi_printer')->whereIn('kategori', array('admisi'))->groupBy('printer')->orderBy('nama', 'ASC')->get();

if ($nik == '100952') {
    $printer = DB::table('rsik.admisi_printer')->groupBy('printer')->orderBy('nama', 'ASC')->get();
}

$view = 'form/rawat_inap_dev';

$this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
$this->template->useAsset()->setJs('admisi', array($view));
$this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
$this->template->useAsset()->setJS(array('bootstrap-datepicker'));
$this->template->useAsset()->setCSS(array('bootstrap-datepicker'));

$hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');

$ipclient = ipclient();
$default_printer = "";

if (!empty($printer)) {
    foreach ($printer as $row_printer) {
        $row_printer = (object) $row_printer;
        if ($row_printer->ip == $ipclient) {
            $default_printer = $row_printer->printer;
        }
    }
}

$data = array(
    'view' => $view,
    'akses' => self::akses(),
    'nik' => $nik,
    'induk' => $induk,
    'kd_poli' => $kd_poli,
    'rows_agama' => $agama,
    'rows_kawin' => $kawin,
    'klinik' => strtoupper($klinik),
    'kd_dokter' => $kd_dokter,
    'hari' => $hari,
    'bangsal' => $bangsal,
    'asuransi' => $asuransi,
    'kerja' => $pekerjaan,
    'printer' => $printer,
    'default_printer' => $default_printer,
    'rujuk' => $rujuk,
    'pendidikan' => $pendidikan,
    'bahasa' => $bahasa,
    'hamb_emosi' => $hamb_emosi,
    'hamb_motivasi' => $hamb_motivasi,
    'hamb_fisik' => $hamb_fisik,
    'hamb_kognitif' => $hamb_kognitif,
    'dokter' => self::dpjp(),
    'assets' => $this->template->getMetadata(),
);

go('index', $data);