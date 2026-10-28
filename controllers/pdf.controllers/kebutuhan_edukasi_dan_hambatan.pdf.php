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
$this->load->model('edukasi_integrasi');
$this->load->model('ttd_pasien');

$no_reg = segment(4);
$tgl_rs = segment(5);

if ((string) $tgl_rs == "") {
    $tgl_rs = date("YmdHis");
}

$tgl_masuk = substr($tgl_rs, 0, 4) . "-" . substr($tgl_rs, 4, 2) . "-" . substr($tgl_rs, 6, 2);
$jam_masuk = substr($tgl_rs, 8, 2) . ":" . substr($tgl_rs, 10, 2) . ":" . substr($tgl_rs, 12, 2);

$umur = '';
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
$nama_petugas = $nama_ttd = $ttd_pasien_id = $ttd_file = $registered = $writer = ''; 

$pasien = null;
$pasien = Pasien::find($no_reg);
$nama = $pasien->nama ?? '';
$nik = $pasien->no_id ?? '';
$tgl_lahir = $pasien->tgl_lahir ?? '';
$alamat = $pasien->alamat ?? '';

if (!empty($pasien)) {

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

$row_kkb = null;
$row = DB::table(DB::raw('rme.edukasi_hambatan USE INDEX (no_reg)'))->where('no_reg', $no_reg)->where(DB::RAW("date(tanggal_masuk)"), $tgl_masuk)->whereNull('deleted')->first();

$inap_baru = DB::connection('rsi_byl')->table('rsi_byl.inap')->where('deleted', 0)->where('no_rm', $no_reg)->where('tgl_masuk_inap', $tgl_masuk)->orderBy('inap_id', 'desc')->first(['pj_ttd_id', 'pj_nama', 'created']);
$signature = null; 
$signature_nama = null;
$signature_petugas = null;
$signature_petugas_nama = null;
if (!empty($inap_baru)) {
    $signature = DB::connection('rsi_byl')->table('rsi_byl.master_signature_pasien')->where('id', $inap_baru['pj_ttd_id'])->orderBy('id', 'desc')->first();
	$signature_nama = $inap_baru['pj_nama'];
	// $signature_petugas = $inap_baru['created'];
	// $signature_petugas_nama = getNamaByUser($inap_baru['created']);
}
if (!empty($row)) {
    $signature_petugas_nama = getUserById($row['writer']);
    $signature_petugas = getKodeById($row['writer']);
    $writer = $row['writer'];
    // $signature_petugas = 
    // json(getKodeById($row['writer']));
    // include('warning.pdf.php');
    // $data = [
    //     "no_reg" => $no_reg,
    //     "tgl_masuk" => $tgl_masuk,
    //     "jam_masuk" => $jam_masuk,
    //     "tgl_rs" => $tgl_rs,
    //     "ranap" => $row_kkb,
    //     "nama" => $nama,
    //     "warning_sama" => isset($warning_sama) ? $warning_sama : false,
    //     "nik" => $nik,
    //     "jenis_kel" => $jenis_kel,
    //     "alamat" => $alamat,
    //     "tgl_lahir" => $tgl_lahir,
    //     "telp" => $telp,
    //     "agama" => $agama,
    //     "kawin" => $kawin,
    //     "didik" => $didik,
    //     "kerja" => $kerja,
    //     "kunjung" => $kunjung,
    //     "asuransi" => $asuransi,
    //     "asal" => $asal,
    //     "str_tgl_masuk" => $str_tgl_masuk,
    //     "bangsal" => $bangsal,
    //     "nama_petugas" => $nama_petugas,
    //     'pdf_type' => $pdf_type,
    //     'lp_print' => $lp_print,
    //     'printer' => $printer,
    //     'nama_ttd' => $nama_ttd,
    //     'signature' => !empty($signature['file']) ? $signature['file'] : null,
    //     'signature_nama' => $signature_nama,
    //     'signature_petugas' => $signature_petugas,
    //     'signature_petugas_nama' => $signature_petugas_nama,
    //     'ttd_pasien_id' => $ttd_pasien_id,
    //     'ttd_file' => $ttd_file,
    //     'registered' => $registered,
    //     "data" => $row,
    //     'ipclient' => $ipclient,
    //     'printer' => $printer,
    // ];
    // // json($data);
    // go('pdf/kebutuhan_edukasi_dan_hambatan', $data);
    // die();
}

if (empty($row_kkb)) {
    $row_kkb = edukasi_integrasi::where('edukasi_integrasi.no_reg', $no_reg)
        ->where('edukasi_integrasi.tgl_masuk', $tgl_masuk)
        ->leftJoin('rsiklaten.user', 'edukasi_integrasi.writer', '=', 'rsiklaten.user.id')
        ->leftJoin('sdm.karya', 'rsiklaten.user.user', '=', 'sdm.karya.nik')
        // ris ini harus di tambah on e tanggal masuk soale nek berdasarkan no rm tok dadi ambil asc
        // ->leftJoin('rme.ttd_pasien', 'edukasi_integrasi.no_reg', '=', 'rme.ttd_pasien.no_reg')
        ->leftJoin('rme.ttd_pasien', function ($join) {
            $join->on('edukasi_integrasi.no_reg', '=', 'rme.ttd_pasien.no_reg');
            $join->on('edukasi_integrasi.tgl_masuk', '=', 'rme.ttd_pasien.tgl_masuk');
        })
        ->select(
            'edukasi_integrasi.*',
            'sdm.karya.nama as nama_petugas',
            'rme.ttd_pasien.file as ttd_file',
            'rme.ttd_pasien.nama_ttd'
        )
        ->whereNull('edukasi_integrasi.deleted')
        ->orderBy('edukasi_integrasi.id', 'DESC')
        ->first();
}

    $row_kkb_data = !empty($row_kkb) ? $row_kkb->toArray() : [];

    $hamb_cek_baca = $row_kkb_data['hamb_cek_baca'] ?? '';
    $hamb_mampu_baca = $row_kkb_data['hamb_mampu_baca'] ?? '';
    $nama_pendidikan = $row_kkb_data['nama_pendidikan'] ?? '';
    $hamb_tingkat_didik = $row_kkb_data['hamb_tingkat_didik'] ?? '';
    $hamb_cek_bahasa = $row_kkb_data['hamb_cek_bahasa'] ?? '';
    $nama_bahasa = $row_kkb_data['nama_bahasa'] ?? '';
    $hamb_bahasa_sehari = $row_kkb_data['hamb_bahasa_sehari'] ?? '';
    $hamb_tinlan_penerjemah = $row_kkb_data['hamb_tinlan_penerjemah'] ?? '';
    $hamb_cek_emov = $row_kkb_data['hamb_cek_emov'] ?? '';
    $nama_hamb_emosi = $row_kkb_data['nama_hamb_emosi'] ?? '';
    $hamb_emosi = $row_kkb_data['hamb_emosi'] ?? '';
    $nama_hamb_motivasi = $row_kkb_data['nama_hamb_motivasi'] ?? '';
    $hamb_motivasi = $row_kkb_data['hamb_motivasi'] ?? '';
    $hamb_cek_fiko = $row_kkb_data['hamb_cek_fiko'] ?? '';
    $nama_hamb_fisik = $row_kkb_data['nama_hamb_fisik'] ?? '';
    $hamb_fisik = $row_kkb_data['hamb_fisik'] ?? '';
    $nama_hamb_kognitif = $row_kkb_data['nama_hamb_kognitif'] ?? '';
    $hamb_kognitif = $row_kkb_data['hamb_kognitif'] ?? '';
    $hamb_tinlan_fisio = $row_kkb_data['hamb_tinlan_fisio'] ?? '';
    $hamb_cek_sedif = $row_kkb_data['hamb_cek_sedif'] ?? '';
    $hamb_tinlan_edu = $row_kkb_data['hamb_tinlan_edu'] ?? '';
    $hamb_cara_edu = $row_kkb_data['hamb_cara_edu'] ?? '';
    /*$hamb_cara_edu = ($hamb_cara_edu == 1) ? 'Lisan' : 'Tulisan';*/
    $hamb_cek_keyakinan = $row_kkb_data['hamb_cek_keyakinan'] ?? '';
    $hamb_tinlan_makan = $row_kkb_data['hamb_tinlan_makan'] ?? '';
    $hamb_tinlan_beda_kelamin = $row_kkb_data['hamb_tinlan_beda_kelamin'] ?? '';
    $hamb_tinlan_tolak_imun = $row_kkb_data['hamb_tinlan_tolak_imun'] ?? '';
    $hamb_keyakinan_lainnya = $row_kkb_data['hamb_keyakinan_lainnya'] ?? '';
    /*tambahan edukasi*/
    $hamb_bpjs_cek_edukasi = $row_kkb_data['hamb_bpjs_cek_edukasi'] ?? '';
    $hamb_bpjs_penjaminan = $row_kkb_data['hamb_bpjs_penjaminan'] ?? '';
    $hamb_bpjs_iur_biaya = $row_kkb_data['hamb_bpjs_iur_biaya'] ?? '';
    $hamb_bpjs_pulang_paksa = $row_kkb_data['hamb_bpjs_pulang_paksa'] ?? '';

    $nama_ttd = $row_kkb_data['nama_ttd'] ?? '';
    $ttd_pasien_id = $row_kkb_data['ttd_pasien_id'] ?? '';
    $ttd_file = $row_kkb_data['ttd_file'] ?? '';
    $registered = $row_kkb_data['registered'] ?? '';
    $writer = $row_kkb_data['writer'] ?? $writer;
    $nama_petugas = $row_kkb_data['nama_petugas'] ?? '';
	
	/* TAMBAHAN : 15/05/2026 15:00 BY FRD */
	if(empty($nama_ttd)) {
		$ttd_psn = DB::table('rme.ttd_pasien')
					->where('no_reg', $no_reg)
					->whereNull('deleted')
					->orderBy('id', 'desc')
					->first();
					
		if($ttd_psn) {
			$nama_ttd = $ttd_psn['nama_ttd'];
			$ttd_file = $ttd_psn['file'];
		}
	}

    //if (ipclient()=="192.168.22.2") {
    /** SIGNATURE --- CHUSNUN */
        if (ipclient()=="192.168.22.2") {
            //json("chusnun");
        }
    /** SIGNATURE */
    //}
    /*
    $pdf_type = "I";
    */
    include('warning.pdf.php');
    $data = array(
        "no_reg" => $no_reg,
        "tgl_masuk" => $tgl_masuk,
        "jam_masuk" => $jam_masuk,
        "tgl_rs" => $tgl_rs,
        // "ranap" => $row_kkb,
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
        /**/
        'hamb_bpjs_cek_edukasi' => $hamb_bpjs_cek_edukasi,
        'hamb_bpjs_penjaminan' => $hamb_bpjs_penjaminan,
        'hamb_bpjs_iur_biaya' => $hamb_bpjs_iur_biaya,
        'hamb_bpjs_pulang_paksa' => $hamb_bpjs_pulang_paksa,
        /**/
        'hamb_tinlan_beda_kelamin' => $hamb_tinlan_beda_kelamin,
        'hamb_tinlan_tolak_imun' => $hamb_tinlan_tolak_imun,
        'hamb_keyakinan_lainnya' => $hamb_keyakinan_lainnya,
        'nama_ttd' => $nama_ttd,
        'signature' => !empty($signature['file']) ? $signature['file'] : null,
        'signature_nama' => $signature_nama,
        'signature_petugas' => $signature_petugas,
        'signature_petugas_nama' => $signature_petugas_nama,
        'ttd_pasien_id' => $ttd_pasien_id,
        'ttd_file' => $ttd_file,
        'registered' => $registered,
        'writer' => $writer,
        'waktu_cetak' => date("d/m/Y H:i:s"),
        'ipclient' => $ipclient,
        'data' => $row
    );

    // json($data);
    // if (ipclient()==IPC) json($data);
    go('pdf/kebutuhan_edukasi_dan_hambatan', $data);

        