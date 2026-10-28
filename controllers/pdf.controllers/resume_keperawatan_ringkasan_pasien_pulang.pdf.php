<?php 
include('init.pdf.php');
$this->load->model('Mutasi_ri');
$this->load->model('Pasien');
$this->load->model('Agama');
$this->load->model('Perkawinan');
$this->load->model('Pendidikan');
$this->load->model('Pekerjaan');
$this->load->model('Rujuk');
$this->load->model('Perujuk');
$this->load->model('Kunjung');
$this->load->model('Asuransi');
$this->load->model('Poli');
$this->load->model('Bangsal');
$this->load->model('Karyawan');
$this->load->model('Karya');
$this->load->model('Dokter');
$this->load->model('Bangsal');
$this->load->model('User');
$this->load->model('Perawat');

$ttd_pasien      = '';
$ttd_pasien_nama = '';

$row_mutasi_ri          = null;
$str_tgl_masuk          = '';
$bangsal                = '';
$nama_petugas           = '';
$signature_nama         = '';
$signature_petugas      = '';
$signature_petugas_nama = '';

$row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)
					->where('tgl_masuk', $tgl_masuk)
					->whereNull('deleted')
					->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))
					->orderBy('id', 'DESC')
					->first();
if (empty($row_mutasi_ri)) {
    $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)
						->where('tgl_masuk', $tgl_masuk)
						->whereNull('deleted')
						->orderBy('id', 'DESC')
						->first();
}
if (!empty($row_mutasi_ri)) {
    $row_mutasi_ri = (object) $row_mutasi_ri;
}
$pasien = null; 
$pasien = Pasien::find($no_reg);
if (!empty($pasien)) {
    $pasien = (object) $pasien;
    $nama = $pasien->nama; 
    $nik = $pasien->no_id; 
    $tgl_lahir = $pasien->tgl_lahir; 
    $alamat = $pasien->alamat;
    switch ($pasien->jenis_kel) {
        case '1' : 
        case 1 : 
        case 'L' : 
            $jenis_kel = 'LAKI-LAKI'; 
            break; 
        case '2' : 
        case 2 : 
        case 'P' : 
            $jenis_kel = 'PEREMPUAN'; 
            break; 
    }
    $telp = $pasien->telp;
    if (!empty($pasien->telp2)) {
        $telp .= '/'.$pasien->telp2; 
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
$row_perujuk = Perujuk::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('deletedstate', '0')->orderBy('id', 'DESC')->first();
if (!empty($row_perujuk)) {
    $rujuk = $row_perujuk->alamat;
}
$row_kunjung = Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'ASC')->first();
if (!empty($row_kunjung)) {
    switch($row_kunjung->kunjung) {
        case 'B' : 
            $kunjung = 'BARU'; 
            break; 
    }
}
if (!empty($row_mutasi_ri->asuransi)) {
    $row_asuransi = Asuransi::where('NO_REL', $row_mutasi_ri->asuransi)->first();
    if (!empty($row_asuransi->NAMA)) {
        $asuransi = $row_asuransi->NAMA;
    }
}
if (!empty($row_mutasi_ri->asal)) {
    $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
    if (!empty($row_poli->nama_poli)) {
        $asal = $row_poli->nama_poli;
    }
}
if (!empty($row_mutasi_ri->asal)) {
    $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
    if (!empty($row_poli->nama_poli)) {
        $asal = $row_poli->nama_poli;
    }
}
if (!empty($row_mutasi_ri->tgl_masuk)) {
    $str_tgl_masuk = $row_mutasi_ri->tgl_masuk." Jam : ". str_replace(":", ".", substr($jam_masuk, 0, 5));
}
if (!empty($row_mutasi_ri->bangsal)) {
    $row_bangsal = Bangsal::where('kd_bangsal', $row_mutasi_ri->bangsal)->first();
    if (!empty($row_bangsal->nama_pendaftaran)) {
        $bangsal = $row_bangsal->nama_pendaftaran;
    }
}
if (!empty($row_mutasi_ri->petugas)) {
    $row_karyawan = Karya::where('nik', $row_mutasi_ri->petugas)->first();
    if (!empty($row_karyawan->nama)) {
        $nama_petugas = $row_karyawan->nama;
    }
}
if (!empty($row_mutasi_ri->kd_dr_ri1)) {
    $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
    if (!empty($row_dokter->nama2)) {
        $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
    }
}

$askep = DB::table('rme.askep_inap_summary as a')
    ->leftJoin('rme.bangsal as b', function($join) {
        $join->on('a.poli_id', '=', 'b.kamar');
    })
    ->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereNull('a.deleted')->orderBy('a.id', 'DESC')
    ->selectRaw('a.*, b.induk_nama')
    ->first();
    
if (!empty($askep)) {
    $askep = (object) $askep;
    $nama  = $askep->nama;
    
    $askep->unit      = $askep->induk_nama;
    $askep->diagnosa  = strip_tags(str_replace('@@,', ', ', $askep->diagmedis));
    $askep->tindakan  = render_strtopdf(strip_tags(str_replace('@@,', ', ', $askep->tindmedis)));
    
    if (!empty($askep->luka)) {
        $luka = ['','Bersih','Kering','Ada cairan dari luka','4'];
        $askep->luka = $luka[$askep->luka];
    }
    if (!empty($askep->ku)) {
        $ku = ['','Cukup','Sedang','Baik','4','<b>Meninggal</b>'];
        $askep->ku = $ku[$askep->ku];
    }
    
    if (!empty($askep->alat)) {
        $alter = ['','DC','NGT','IV Cateter','4'];
        if (in_array($askep->alat, [1,2,3,4])) {
            $askep->alter = $askep->alat == 4 ? $askep->alat_lain : $alter[$askep->alat];
        } else {
            $askep->alter = str_replace('@@,', ', ', $askep->alat);
        }
    }
    
    if (!empty($askep->mobilisasi)) {
        $tm = ['','Mandiri','Dibantu Sebagian','Dibantu Penuh'];
        $askep->tm = $tm[$askep->mobilisasi];
    }
    $alban            = $askep->alat_bantu;
    if (!empty($askep->alat_bantu)) {
        $alban = ['','Tongkat','Kursi Roda','Brancard','4'];
        $askep->alban = $alban[$askep->alat_bantu];
    }
    $askep->alban_lain = $askep->alat_bantu_lain;
    $askep->diagnosa_dirawat = str_replace('@@,', ', ', $askep->diagperawat);
    $askep->edukasi          = str_replace('@@,', ', ', $askep->keb_edukasi);
    if (!empty($askep->thaharoh)) {
        $thaharah = ['','Berwudlu','Tayamum'];
        $askep->thaharah = $thaharah[$askep->thaharoh];
    }
    if (!empty($askep->sholat)) {
        $sholat = ['','Berdiri','Duduk','Berbaring','Isyarat'];
        $askep->sholat = $sholat[$askep->sholat];
    }
    if (!empty($askep->fikih_wanita)) {
        $fikih = ['','Fikih Darah Wanita / Nifas','Fikih Ibu Hamil, Melahirkan, Menyusui dan KB'];
        $askep->fikih = $fikih[$askep->fikih_wanita];
    }
    if (!empty($askep->doa_sakit)) {
        $doa = ['','Ya','Tidak'];
        $askep->doa = $doa[$askep->doa_sakit];
    }
    $askep->obat_nyeri       = $askep->obat_diminum;
    $askep->efek             = $askep->efek_samping;
    $askep->nyeri_tambah     = $askep->bila_nyeri;
    if (!empty($askep->hasil_lab)) {
        $has_lab = ['','Ada','Tidak Ada'];
        $askep->has_lab = $has_lab[$askep->hasil_lab];
    }
    if (!empty($askep->hasil_ro)) {
        $has_ro = ['','Ada','Tidak Ada'];
        $askep->has_ro = $has_ro[$askep->hasil_ro];
    }
    if (!empty($askep->surat_istirahat)) {
        $surat_istirahat = ['','Ada','Tidak Ada'];
        $askep->surat_istirahat = $surat_istirahat[$askep->surat_istirahat];
    }
    if (!empty($askep->resume_medis)) {
        $resume_medis = ['','Ada','Tidak Ada'];
        $askep->resume_medis = $resume_medis[$askep->resume_medis];
    }
    if (!empty($askep->resume_perawat)) {
        $resume_perawat = ['','Ada','Tidak Ada'];
        $askep->resume_perawat = $resume_perawat[$askep->resume_perawat];
    }
    if (!empty($askep->surat_rujukan)) {
        $rujukan = ['','Ada','Tidak Ada'];
        $askep->rujukan = $rujukan[$askep->surat_rujukan];
    }
    if (!empty($askep->surat_lahir)) {
        $surat_ket_lahir = ['','Ada','Tidak Ada'];
        $askep->surat_ket_lahir = $surat_ket_lahir[$askep->surat_lahir];
    }
    if (!empty($askep->kms)) {
        $kms = ['','Ada','Tidak Ada'];
        $askep->kms = $kms[$askep->kms];
    }
    $perawat_id = $askep->writer;
    $askep->ttd = '';
    $askep->perawat = '';
    $askep->ttd_image = '';
    $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('rsiklaten.user.id', $perawat_id)->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
    if(count($user) > 0) {
        $askep->ttd = $user->ttd;
        $askep->perawat = $user->nama;
        $askep->ttd_image = IMG."ttd/$perawat_id.jpg";
    } else {
        $nurse = Perawat::find($perawat_id);
        if(count($nurse) > 0) {
            $askep->ttd = $nurse->ttd;
            $askep->perawat = $nurse->nama;
            $askep->ttd_image = IMG."ttd/$perawat_id.jpg";
        }
    }
    
    // TTD Pasien
    $ttd_psn = DB::table('rme.ttd_pasien')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('bangsal', $askep->poli_id)->first();
    if (empty($ttd_psn))$ttd_psn = DB::table('rme.ttd_pasien')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->first();
    // pre($ttd_psn);
    if (!empty($ttd_psn)) {
        $ttd_psn = (object) $ttd_psn;
        $askep->nama_ttd = $ttd_psn->nama_ttd;
        $askep->ttd_pasien = IMG_RME."ttd_pasien/$ttd_psn->file";
		
		$ttd_pasien = IMG_RME."ttd_pasien/$ttd_psn->file";
		$ttd_pasien_nama = $ttd_psn->nama_ttd;
    } else {
        $inap_baru = DB::connection('rsi_byl')
						->table('rsi_byl.inap')
						->where('deleted', 0)
						->where('no_rm', $no_reg)
						->where('tgl_masuk_inap', $tgl_masuk)
						->orderBy('inap_id', 'desc')
						->selectRaw('pj_ttd_id, pj_nama, created')
						->first();
        $signature = null; 
        $signature_nama = null;
        $signature_petugas = null;
        $signature_petugas_nama = null;
        if (!empty($inap_baru)) {
            $signature = DB::connection('rsi_byl')
							->table('rsi_byl.master_signature_pasien')
							->where('id', $inap_baru['pj_ttd_id'])
							->orderBy('id', 'desc')
							->first();
            $signature_nama = $inap_baru['pj_nama'];
            $signature_petugas = $inap_baru['created'];
            $signature_petugas_nama = getNamaByUser($inap_baru['created']);
            
        }
	}
    // if ($no_reg == '0503374') {
    // }
    // pre($ttd_pasien_nama);
    // echo $ttd_pasien;
    // exit;
    $tanggal = tampiltanggal($askep->tanggal, 9);
    $jam = date("H:i", strtotime($askep->tanggal));

}
// $jam = "";
// if ($no_reg=='0129171') pre($askep->ttd_pasien);
include('warning.pdf.php');
// pre($askep->ttd_image);
// echo"<pre>";print_r($tanggal);die();

$data = array(
    "no_reg"        => $no_reg,
    "tgl_masuk"     => $tgl_masuk,
    "jam_masuk"     => $jam_masuk,
    "tgl_rs"        => $tgl_rs,
    "ranap"         => $row_mutasi_ri,
    "nama"          => $nama,
    "nik"           => $nik,
    "jenis_kel"     => $jenis_kel,
    "alamat"        => $alamat,
    "tgl_lahir"     => $tgl_lahir,
    "tanggal"       => $tanggal,
    "jam"           => $jam,
    "umur"          => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"),
    "telp"          => $telp,
    "agama"         => $agama,
    "kawin"         => $kawin,
    "didik"         => $didik,
    "kerja"         => $kerja,
    "rujuk"         => $rujuk,
    "kunjung"       => $kunjung,
    "asuransi"      => $asuransi,
    "asal"          => $asal,
    "str_tgl_masuk" => $str_tgl_masuk,
    "bangsal"       => $bangsal,
    "nama_petugas"  => $nama_petugas,
    "row_mutasi_ri" => $row_mutasi_ri,
    "askep"         => $askep,
    'pdf_type'      => $pdf_type,
    'lp_print'      => $lp_print,
    'printer'       => $printer,
    'ipclient'      => $ipclient,
	'ttd_pasien' 	=> $ttd_pasien,
	'ttd_pasien_nama' => $ttd_pasien_nama,
	'signature' => !empty($signature['file']) ? $signature['file'] : null,
    'signature_nama' => $signature_nama,
    'signature_petugas' => $signature_petugas,
    'signature_petugas_nama' => $signature_petugas_nama,
    "warning_sama" => isset($warning_sama)?$warning_sama:false
);
// if (ipclient()==IPC) json($data);
/*json($data);*/
//if ($no_reg = '0479014') {
    // echo"<pre>";print_r($data);die();
    // echo"<pre>";print_r($askep);die();
// pre($data);
/*json($data);*/
if ($no_reg == '0691813') {
        // echo"<pre>";print_r($data);die();
    }
$view = 'pdf/resume_keperawatan_ringkasan_pasien_pulang'; 
go($view, $data);
// var_dump($view); die();