<?php

$this->load->model('Pasien');
$this->load->model('Jadwal_HD');
$this->load->model('Kunjung');
$this->load->model('Kunjung_HD');

$akses = self::akses_menu();
$writer = $akses->userid;
$user = $akses->nik;
$status = false;

$no_reg = $this->input->post('no_reg');
$tgl_dirawat = date('Y-m-d', strtotime($this->input->post('tgl_dirawat')));
$jam_dirawat = $this->input->post('jam_dirawat');
$kd_dr = $this->input->post('kd_dr');

$nama_pegang_akses = $this->input->post('nama_pegang_akses');
$hub_keluarga = $this->input->post('hub_keluarga');
$diagnosa = $this->input->post('diagnosa');
$pengobatan = $this->input->post('pengobatan');
$no_kartu = $this->input->post('no_kartu');
$asuransi_id = $this->input->post('asuransi_id');
$tgl_awal_1 = $this->input->post('tgl_awal_1');
$tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));

$umur = $this->input->post('umur');
$kd_daerah = $this->input->post('kd_daerah');
$kunjung = $this->input->post('kunjung');
$antrian = $this->input->post('antrian');

$tanggal_ulangs = [];
for ($i = 1; $i <= 31; $i++) {
    $tgl_ulang = $this->input->post('tgl_ulang_' . $i);
    if (!empty($tgl_ulang)) {
        $tanggal_ulangs[$i] = date('Y-m-d', strtotime($tgl_ulang));
    }
}

$days = [];
for ($i = 1; $i <= 31; $i++) {
    $day = $this->input->post('hari_' . $i);
    if (!empty($day)) {
        $days[$i] = $day;
    }
}

DB::transaction(function () use ($no_reg, $tgl_dirawat, $jam_dirawat, $kd_dr, $user, $writer, $nama_pegang_akses, $hub_keluarga, $diagnosa, $pengobatan, $no_kartu, $asuransi_id, $tgl_awal_1, $tanggal_ulangs, $days, $umur, $kd_daerah, $kunjung) {
    // Hapus semua data kunjungan lama dengan nomor registrasi yang sama
    $bulan_depan = date('m', strtotime('+1 month'));
    $tahun_depan = date('Y', strtotime('+1 month'));

    DB::table('rsiklaten.kunjung')
        ->where('no_reg', $no_reg)
        ->whereRaw('MONTH(tanggal) = ?', [$bulan_depan])
        ->whereRaw('YEAR(tanggal) = ?', [$tahun_depan])
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deletedby' => $writer]);

    DB::table('rsiklaten.kunjung_hd')
        ->where('no_reg', $no_reg)
        ->whereRaw('MONTH(tanggal) = ?', [$bulan_depan])
        ->whereRaw('YEAR(tanggal) = ?', [$tahun_depan])
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deletedby' => $writer]);


    /*Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_dirawat)->delete();
    Kunjung_HD::where('no_reg', $no_reg)->where('tanggal', $tgl_dirawat)->delete();*/

    // Hapus data jadwal HD lama dengan nomor registrasi yang sama
    DB::table('rsiklaten.jadwal_hd')
        ->where('no_reg', $no_reg)
        ->where('tanggal', $tgl_dirawat)
        ->update(['deletedstate' => 1, 'deleted' => date('Y-m-d H:i:s'), 'deleteby' => $writer]);

    // Simpan data jadwal HD baru
    $jadwal_hd = Jadwal_HD::firstOrNew([
        'no_reg' => $no_reg,
        'tanggal' => $tgl_dirawat,
        'jam' => $jam_dirawat,
    ]);

    $jadwal_hd->status_daftar = 1;
    $jadwal_hd->tanggal = $tgl_dirawat;
    $jadwal_hd->jam = $jam_dirawat;
    $jadwal_hd->rawat = "J";
    $jadwal_hd->no_reg = $no_reg;
    $jadwal_hd->kd_poli = 'HD';
    $jadwal_hd->kd_dr = $kd_dr;
    $jadwal_hd->writer = $user;
    $jadwal_hd->nama_pegang_akses = $nama_pegang_akses;
    $jadwal_hd->hub_keluarga = $hub_keluarga;
    $jadwal_hd->diagnosa = $diagnosa;
    $jadwal_hd->pengobatan = $pengobatan;
    $jadwal_hd->no_kartu = $no_kartu;
    $jadwal_hd->asuransi_id = $asuransi_id;
    $jadwal_hd->tgl_awal_1 = $tgl_awal_1 ?: null;

    foreach ($tanggal_ulangs as $index => $tanggal_ulang) {
        $jadwal_hd->{'tgl_ulang_' . $index} = $tanggal_ulang;
    }

    foreach ($days as $index => $hari) {
        $jadwal_hd->{'hari_' . $index} = $hari;
    }

    // Simpan jadwal HD baru
    $jadwal_hd->save();
    $last_id = $jadwal_hd->id;

    foreach ($tanggal_ulangs as $tanggal_ulang) {
        // Buat data kunjungan baru
        $kunjung_item = new Kunjung();
        $kunjung_item->no_kjg = $last_id;
        $kunjung_item->tanggal = $tanggal_ulang;
        $kunjung_item->jam = $jam_dirawat;
        $kunjung_item->no_reg = $no_reg;
        $kunjung_item->rawat = "J";
        $kunjung_item->kd_poli = 'HD';
        $unique_code = 'HD' . str_pad(rand(0, 99999), 3, '0', STR_PAD_LEFT);
        $kunjung_item->antrian = $unique_code;
        $kunjung_item->kd_dr = $kd_dr;
        $kunjung_item->umur = $umur;
        $kunjung_item->pasien = $asuransi_id;
        $kunjung_item->kd_daerah = $kd_daerah;
        $kunjung_item->opr = $user;
        $kunjung_item->kunjung = $kunjung;

        // Simpan data kunjungan yang baru
        $kunjung_item->save();
    }
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