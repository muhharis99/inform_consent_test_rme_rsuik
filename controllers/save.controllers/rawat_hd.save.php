<?php

$this->load->model('Pasien');
$this->load->model('Jadwal_HD');
$this->load->model('Kunjung');
$this->load->model('Kunjung_HD');
$this->load->model('Antri2');
/* tambahan untuk simpan di temp_hd */
$this->load->model('Temp_hd');

$akses             = self::akses_menu();
$writer            = $akses->userid;
$user              = $akses->nik;
$status            = false;
$no_reg            = $this->input->post('no_reg');
$tgl_dirawat       = date('Y-m-d', strtotime($this->input->post('tgl_dirawat')));
$jam_dirawat       = $this->input->post('jam_dirawat');
$kd_dr             = $this->input->post('kd_dr');
$nama_pegang_akses = $this->input->post('nama_pegang_akses');
$hub_keluarga      = $this->input->post('hub_keluarga');
$diagnosa          = $this->input->post('diagnosa');
$pengobatan        = $this->input->post('pengobatan');
$no_kartu          = $this->input->post('no_kartu');
$asuransi_id       = $this->input->post('asuransi_id');
$tgl_awal_1        = $this->input->post('tgl_awal_1');
$tanggal           = date('Y-m-d', strtotime($this->input->post('tanggal')));
$umur              = $this->input->post('umur');
$kd_daerah         = $this->input->post('kd_daerah');
$kunjung           = $this->input->post('kunjung');
$antrian           = $this->input->post('antrian');
$rujuk             = $this->input->post('rujuk');
$ruang_pasien      = $this->input->post('ruang_pasien');

$tanggal_ulangs    = [];
for ($i = 1; $i <= 31; $i++) 
{
    $tgl_ulang = $this->input->post('tgl_ulang_' . $i);
    if (!empty($tgl_ulang)) 
    {
        $tanggal_ulangs[$i] = date('Y-m-d', strtotime($tgl_ulang));
    }
}

$days               = [];
for ($i = 1; $i <= 31; $i++) 
{
    $day = $this->input->post('hari_' . $i);
    if (!empty($day)) 
    {
        $days[$i] = $day;
    }
}

DB::transaction(function () use ($no_reg, $tgl_dirawat, $jam_dirawat, $kd_dr, $user, $writer, $nama_pegang_akses, $hub_keluarga, $diagnosa, $pengobatan, $no_kartu, $asuransi_id, $tgl_awal_1, $tanggal_ulangs, $days, $umur, $kd_daerah, $kunjung, $ruang_pasien) {

    /*$bulan_depan = date('m', strtotime('+0 month'));
    $tahun_depan = date('Y', strtotime('+0 month'));*/

    /*DB::table('rsiklaten.kunjung')
        ->where('no_reg', $no_reg)
        ->where('tanggal', $tgl_dirawat)
        ->where('jam', $jam_dirawat)
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deletedby' => $writer]);*/

    /*DB::table('rsiklaten.kunjung_hd')
        ->where('no_reg', $no_reg)
        ->whereRaw('MONTH(tanggal) = ?', [$bulan_depan])
        ->whereRaw('YEAR(tanggal) = ?', [$tahun_depan])
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deletedby' => $writer]);*/

    /*DB::table('rsiklaten.jadwal_hd')
        ->where('no_reg', $no_reg)
        ->where('tanggal', $tgl_dirawat)
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deleteby' => $writer]);*/

    $jadwal_hd = Jadwal_HD::firstOrNew([
        'no_reg' => $no_reg,
        'tanggal' => $tgl_dirawat,
        'jam' => $jam_dirawat,
    ]);

    $jadwal_hd->status_daftar     = 1;
    $jadwal_hd->tanggal           = $tgl_dirawat;
    $jadwal_hd->jam               = $jam_dirawat;
    $jadwal_hd->rawat             = "J";
    $jadwal_hd->no_reg            = $no_reg;
    $jadwal_hd->kd_poli           = 'HD';
    $jadwal_hd->kd_dr             = $kd_dr;
    $jadwal_hd->writer            = $user;
    $jadwal_hd->nama_pegang_akses = $nama_pegang_akses;
    $jadwal_hd->hub_keluarga      = $hub_keluarga;
    $jadwal_hd->diagnosa          = $diagnosa;
    $jadwal_hd->pengobatan        = $pengobatan;
    $jadwal_hd->no_kartu          = $no_kartu;
    $jadwal_hd->asuransi_id       = $asuransi_id;
    $jadwal_hd->tgl_awal_1        = $tgl_awal_1 ?: null;
    $jadwal_hd->ruang_pasien      = $ruang_pasien;

    foreach ($tanggal_ulangs as $index => $tanggal_ulang) {
        $jadwal_hd->{'tgl_ulang_' . $index} = $tanggal_ulang;
    }

    foreach ($days as $index => $hari) {
        $jadwal_hd->{'hari_' . $index} = $hari;
    }

    $jadwal_hd->save();
    $last_id = $jadwal_hd->id;
    $ruangan = $jadwal_hd->ruang_pasien;

    /*-------------- PISAH BARIS --------------*/
    foreach ($tanggal_ulangs as $tanggal_ulang) {

        $buat_kode_antri           = Kunjung::where('tanggal', $tanggal_ulang)->where('kd_poli', '=' ,'HD')->where('kd_dr', $kd_dr)->count();
        $hasil_kode_antri          = '1A' . str_pad($buat_kode_antri + 1, 3, '0', STR_PAD_LEFT) . $ruangan;

        /*-------------- SIMPAN KUNJUNG --------------*/
        $kunjung_item              = new Kunjung();
        $kunjung_item->no_kjg      = $last_id;
        $kunjung_item->tanggal     = $tanggal_ulang;
        $kunjung_item->jam         = $jam_dirawat;
        $kunjung_item->no_reg      = $no_reg;
        $kunjung_item->rawat       = "J";
        $kunjung_item->rujuk       = '1';
        $kunjung_item->kd_poli     = 'HD';
        $kunjung_item->antrian     = $hasil_kode_antri;
        $kunjung_item->kd_dr       = $kd_dr;
        $kunjung_item->umur        = $umur;
        $kunjung_item->pasien      = $asuransi_id;
        $kunjung_item->kd_daerah   = $kd_daerah;
        $kunjung_item->opr         = $user;
        $kunjung_item->kunjung     = $kunjung;
        
        $kunjung_item->save();
        /*-------------------------------------*/
        
        /*-------------- SIMPAN ANTRI 2 --------------*/
        /*-------------- (NOTE : MENGIKUTI FORMAT DATA YANG SUDAH ADA SEBELUMNYA) --------------*/
        $antri_item                = new Antri2();
        $antri_item->TANGGAL       = $tanggal_ulang;
        $antri_item->JAM           = $jam_dirawat;
        $antri_item->T_PERIKSA     = $tanggal_ulang; 
        $antri_item->J_PERIKSA     = $jam_dirawat; 
        $antri_item->KD_DR         = $kd_dr;
        $antri_item->NO_REG        = $no_reg;
        $antri_item->NO_KJG        = $last_id;
        $antri_item->DAFTAR        = $hasil_kode_antri; 
        $antri_item->KETERANGAN    = ''; 
        $antri_item->ANTRIAN       = '1';
        $antri_item->POLI          = 'HD';
        $antri_item->PETUGAS       = $user;
        $antri_item->STATUS        = 'SELESAI'; 
        $antri_item->NOREFF        = 'DF0000'; 
        $antri_item->POST_INAP     = ''; 
        $antri_item->RELASI        = ''; 
        $antri_item->BARCODE       = ''; 

        $antri_item->save();
        /*-------------------------------------*/

        /*-------------- SIMPAN TEMP HD --------------*/
        /*-------------- (NOTE : MENGIKUTI FORMAT DATA YANG SUDAH ADA SEBELUMNYA) --------------*/
        $temp_hd              = new Temp_hd();
        $temp_hd->no_kjg      = $last_id;
        $temp_hd->tanggal   = $tanggal_ulang;
        $temp_hd->jam   = $jam_dirawat;
        $temp_hd->no_reg      = $no_reg;
        $temp_hd->rawat       = "J";
        $temp_hd->rujuk       = '1';
        $temp_hd->kd_poli     = 'HD';
        $temp_hd->antrian     = $hasil_kode_antri;
        $temp_hd->kd_dr       = $kd_dr;
        $temp_hd->umur        = $umur;
        $temp_hd->pasien = $asuransi_id;
        $temp_hd->kd_daerah   = $kd_daerah;
        $temp_hd->writer      = $user;
        $temp_hd->kunjung     = $kunjung;
        
        $temp_hd->save();        
        /*-------------------------------------*/
    }
    /*-------------- SLESAI PISAH BARIS --------------*/
});

$tgl_masuk = $tgl_dirawat ?: null;
$jam_masuk = $jam_dirawat ?: null;

$row_pasien = Pasien::find($no_reg);

$data = array(
    'no_reg' => $no_reg,
    'status' => $status,
    'ur_tgl_rs' => str_replace("-", "", $tgl_masuk) . str_replace(":", "", $jam_masuk)
);

echo json_encode($data);