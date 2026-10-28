<?php

$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = "";
$printer = "";
$halaman = "";
$halamanx = "";

switch ((string) segment(6)) {
    case 'PRINT':
    case 'print':
        $pdf_type = "F";
        $lp_print = true;
        break;
    case 'FILE':
        $pdf_type = "F";
        $lp_print = false;
        break;
    case 'FILECLIENT':
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break;
    case 'PRINTSERVER':
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break;
    case 'PRINTSERVER1':
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break;
    case 'PRINTSERVER2':
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break;
}

$this->load->model('Pasien');
$this->load->model('Agama');
$this->load->model('Perkawinan');
$this->load->model('Pendidikan');
$this->load->model('Pekerjaan');
$this->load->model('Kunjung');
$this->load->model('Asuransi');
$this->load->model('Poli');
$this->load->model('Bangsal');
$this->load->model('Karyawan');
$this->load->model('Karya');
$this->load->model('Dokter');
$this->load->model('Pengkajian_kkb');

$no_reg = segment(4);
$tgl_rs = segment(5);

if ((string) $tgl_rs == "") {
    $tgl_rs = date("YmdHis");
}

$tgl_masuk = substr($tgl_rs, 0, 4) . "-" . substr($tgl_rs, 4, 2) . "-" . substr($tgl_rs, 6, 2);
$jam_masuk = substr($tgl_rs, 8, 2) . ":" . substr($tgl_rs, 10, 2) . ":" . substr($tgl_rs, 12, 2);

$row_kkb = null;
$row_kkb = Pengkajian_kkb::where('no_reg', $no_reg)
    ->where('pengkajian_kkb.tgl_masuk', $tgl_masuk)
    ->leftJoin('rsiklaten.pendidikan', 'pengkajian_kkb.hamb_tingkat_didik', '=', 'rsiklaten.pendidikan.kd_pendidikan')
    ->leftJoin('rsiklaten.bahasa', 'pengkajian_kkb.hamb_bahasa_sehari', '=', 'rsiklaten.bahasa.kd_bahasa')
    ->leftJoin('rsiklaten.hamb_emosi', 'pengkajian_kkb.hamb_emosi', '=', 'rsiklaten.hamb_emosi.id')
    ->leftJoin('rsiklaten.hamb_fisik', 'pengkajian_kkb.hamb_fisik', '=', 'rsiklaten.hamb_fisik.id')
    ->leftJoin('rsiklaten.hamb_kognitif', 'pengkajian_kkb.hamb_kognitif', '=', 'rsiklaten.hamb_kognitif.id')
    ->leftJoin('rsiklaten.hamb_motivasi', 'pengkajian_kkb.hamb_motivasi', '=', 'rsiklaten.hamb_motivasi.id')
    ->leftJoin('rsiklaten.user', 'pengkajian_kkb.writer', '=', 'rsiklaten.user.id')
    ->leftJoin('sdm.karya', 'rsiklaten.user.user', '=', 'sdm.karya.nik')
    ->select(
        'pengkajian_kkb.*',
        'sdm.karya.nama as nama_petugas',
        'rsiklaten.pendidikan.pendidikan as nama_pendidikan',
        'rsiklaten.bahasa.nama_bahasa as nama_bahasa',
        'rsiklaten.hamb_emosi.nama as nama_hamb_emosi',
        'rsiklaten.hamb_motivasi.nama as nama_hamb_motivasi',
        'rsiklaten.hamb_fisik.nama as nama_hamb_fisik',
        'rsiklaten.hamb_kognitif.nama as nama_hamb_kognitif'
    )
    ->whereNull('deleted')
    ->whereRaw("LEFT(jam_masuk, 5) = LEFT(?, 5)", [$jam_masuk])
    ->orderBy('pengkajian_kkb.id', 'DESC')
    ->first();

if (empty($row_kkb)) {
    $row_kkb = Pengkajian_kkb::where('no_reg', $no_reg)
        ->where('tgl_masuk', $tgl_masuk)
        ->whereNull('deleted')
        ->orderBy('id', 'DESC')
        ->first();
}

$nama = '';
$nik = '';
$alamat = '';
$umur = '';
$tgl_lahir = '';
$jenis_kel = '';
$telp = '';
$agama = '';
$kawin = '';
$didik = '';
$kerja = '';
$kunjung = 'LAMA';
$asuransi = '';
$asal = '';
$str_tgl_masuk = '';
$bangsal = '';
$pasien = null;
$pasien = Pasien::find($no_reg);

if (!empty($pasien)) {
    $nama = $pasien->nama;
    $nik = $pasien->no_id;
    $tgl_lahir = $pasien->tgl_lahir;
    $alamat = $pasien->alamat;

    switch ($pasien->jenis_kel) {
        case '1':
        case 1:
        case 'L':
            $jenis_kel = 'LAKI-LAKI';
            break;
        case '2':
        case 2:
        case 'P':
            $jenis_kel = 'PEREMPUAN';
            break;
    }

    $telp = $pasien->telp;

    if (!empty($pasien->telp2)) {
        $telp .= '/' . $pasien->telp2;
    }

    $row_agama = Agama::where('kd_agama', $pasien->agama)->first();

    if (!empty($row_agama)) {
        $agama = strtoupper($row_agama->agama);
    }

    $row_kawin = Perkawinan::where('kd_perkawinan', $pasien->kawin)->first();

    if (!empty($row_kawin)) {
        $kawin = strtoupper($row_kawin->nama_perkawinan);
    }

    $row_didik = Pendidikan::where('kd_pendidikan', $pasien->didik)->first();

    if (!empty($row_didik)) {
        $didik = strtoupper($row_didik->pendidikan);
    }

    $row_kerja = Pekerjaan::where('kd_pekerjaan', $pasien->pekerjaan)->first();

    if (!empty($row_kerja)) {
        $kerja = strtoupper($row_kerja->pekerjaan);
    }
}

$umur = selisihymdhis($tgl_lahir, $tgl_masuk, "umur");

$hamb_cek_baca = !empty($row_kkb) ? $row_kkb->hamb_cek_baca : '';
$hamb_mampu_baca = !empty($row_kkb) ? $row_kkb->hamb_mampu_baca : '';


$nama_pendidikan = !empty($row_kkb) ? $row_kkb->nama_pendidikan : '';
$hamb_tingkat_didik = !empty($row_kkb) ? $row_kkb->hamb_tingkat_didik : '';

$hamb_cek_bahasa = !empty($row_kkb) ? $row_kkb->hamb_cek_bahasa : '';
$nama_bahasa = !empty($row_kkb) ? $row_kkb->nama_bahasa : '';
$hamb_bahasa_sehari = !empty($row_kkb) ? $row_kkb->hamb_bahasa_sehari : '';
$hamb_tinlan_penerjemah = !empty($row_kkb) ? $row_kkb->hamb_tinlan_penerjemah : '';

$hamb_cek_emov = !empty($row_kkb) ? $row_kkb->hamb_cek_emov : '';
$nama_hamb_emosi = !empty($row_kkb) ? $row_kkb->nama_hamb_emosi : '';
$hamb_emosi = !empty($row_kkb) ? $row_kkb->hamb_emosi : '';

$nama_hamb_motivasi = !empty($row_kkb) ? $row_kkb->nama_hamb_motivasi : '';
$hamb_motivasi = !empty($row_kkb) ? $row_kkb->hamb_motivasi : '';

$hamb_cek_fiko = !empty($row_kkb) ? $row_kkb->hamb_cek_fiko : '';
$nama_hamb_fisik = !empty($row_kkb) ? $row_kkb->nama_hamb_fisik : '';
$hamb_fisik = !empty($row_kkb) ? $row_kkb->hamb_fisik : '';

$nama_hamb_kognitif = !empty($row_kkb) ? $row_kkb->nama_hamb_kognitif : '';
$hamb_kognitif = !empty($row_kkb) ? $row_kkb->hamb_kognitif : '';

$hamb_tinlan_fisio = !empty($row_kkb) ? $row_kkb->hamb_tinlan_fisio : '';

$hamb_cek_sedif = !empty($row_kkb) ? $row_kkb->hamb_cek_sedif : '';
$hamb_tinlan_edu = !empty($row_kkb) ? $row_kkb->hamb_tinlan_edu : '';
$hamb_cara_edu = !empty($row_kkb) ? $row_kkb->hamb_cara_edu : '';
/*$hamb_cara_edu = ($hamb_cara_edu == 1) ? 'Lisan' : 'Tulisan';*/

$hamb_cek_keyakinan = !empty($row_kkb) ? $row_kkb->hamb_cek_keyakinan : '';
$hamb_tinlan_makan = !empty($row_kkb) ? $row_kkb->hamb_tinlan_makan : '';
$hamb_tinlan_beda_kelamin = !empty($row_kkb) ? $row_kkb->hamb_tinlan_beda_kelamin : '';
$hamb_tinlan_tolak_imun = !empty($row_kkb) ? $row_kkb->hamb_tinlan_tolak_imun : '';
$hamb_keyakinan_lainnya = !empty($row_kkb) ? $row_kkb->hamb_keyakinan_lainnya : '';

$registered = !empty($row_kkb) ? $row_kkb->registered : '';
$writer = !empty($row_kkb) ? $row_kkb->writer : '';
$nama_petugas = !empty($row_kkb) ? $row_kkb->nama_petugas : '';

include('warning.pdf.php');
$pdf_type = "I";

$data = array(
    "no_reg" => $no_reg,
    "tgl_masuk" => $tgl_masuk,
    "jam_masuk" => $jam_masuk,
    "tgl_rs" => $tgl_rs,
    "ranap" => $row_kkb,
    "nama" => $nama,
    "warning_sama" => isset($warning_sama) ? $warning_sama : false,
    "nik" => $nik,
    "jenis_kel" => $jenis_kel,
    "alamat" => $alamat,
    "tgl_lahir" => $tgl_lahir,
    "telp" => $telp,
    "agama" => $agama,
    "kawin" => $kawin,
    "didik" => $didik,
    "kerja" => $kerja,

    "kunjung" => $kunjung,
    "asuransi" => $asuransi,
    "asal" => $asal,
    "str_tgl_masuk" => $str_tgl_masuk,
    "bangsal" => $bangsal,
    "nama_petugas" => $nama_petugas,
    'pdf_type' => $pdf_type,
    'lp_print' => $lp_print,
    'printer' => $printer,
    'halaman' => $halaman,
    'halamanx' => $halaman,

    'hamb_cek_baca' => $hamb_cek_baca,
    'hamb_mampu_baca' => $hamb_mampu_baca,
    'nama_pendidikan' => $nama_pendidikan,
    'hamb_tingkat_didik' => $hamb_tingkat_didik,

    'hamb_cek_bahasa' => $hamb_cek_bahasa,
    'nama_bahasa' => $nama_bahasa,
    'hamb_bahasa_sehari' => $hamb_bahasa_sehari,
    'hamb_tinlan_penerjemah' => $hamb_tinlan_penerjemah,

    'hamb_cek_emov' => $hamb_cek_emov,
    'nama_hamb_emosi' => $nama_hamb_emosi,
    'hamb_emosi' => $hamb_emosi,
    'nama_hamb_motivasi' => $nama_hamb_motivasi,
    'hamb_motivasi' => $hamb_motivasi,

    'hamb_cek_fiko' => $hamb_cek_fiko,
    'nama_hamb_fisik' => $nama_hamb_fisik,
    'hamb_fisik' => $hamb_fisik,
    'nama_hamb_kognitif' => $nama_hamb_kognitif,
    'hamb_kognitif' => $hamb_kognitif,
    'hamb_tinlan_fisio' => $hamb_tinlan_fisio,

    'hamb_cek_sedif' => $hamb_cek_sedif,
    'hamb_tinlan_edu' => $hamb_tinlan_edu,
    'hamb_cara_edu' => $hamb_cara_edu,

    'hamb_cek_keyakinan' => $hamb_cek_keyakinan,
    'hamb_tinlan_makan' => $hamb_tinlan_makan,
    'hamb_tinlan_beda_kelamin' => $hamb_tinlan_beda_kelamin,
    'hamb_tinlan_tolak_imun' => $hamb_tinlan_tolak_imun,
    'hamb_keyakinan_lainnya' => $hamb_keyakinan_lainnya,

    'registered' => $registered,
    'writer' => $writer,

    'waktu_cetak' => date("d/m/Y H:i:s"),
    'ipclient' => $ipclient
);

go('pdf/asesmen_belajar_new_blank', $data);