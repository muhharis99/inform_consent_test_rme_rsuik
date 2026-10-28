<?php
$this->load->model('Edukasi_integrasi');

$akses = self::akses_menu();
$writer = $akses->userid;
$registered = date('Y-m-d H:i:s');
$writed = date('Y-m-d H:i:s');

$no_reg = $this->input->post('no_reg');
$nama = $this->input->post('nama');
$poli_id = $this->input->post('poli_id');
$kd_bangsal = $this->input->post('kd_bangsal');
$dokter_id = $this->input->post('dokter_id');
$asuransi_id = $this->input->post('asuransi_id');
$rujuk = $this->input->post('rujuk');
$tgl_masuk_rs = $this->input->post('tgl_masuk');
$tgl_masuk = date('Y-m-d', strtotime($tgl_masuk_rs));
$jam_masuk_rs = $this->input->post('jam_masuk');
$jam_masuk = date('H:i:s', strtotime($jam_masuk_rs));

/*hmabatan*/
/*$hamb_cek_baca = $this->input->post('hamb_cek_baca');*/
$hamb_mampu_baca = $this->input->post('hamb_mampu_baca');
$hamb_tingkat_didik = $this->input->post('hamb_tingkat_didik');

$hamb_cek_bahasa = $this->input->post('hamb_cek_bahasa');
$hamb_bahasa_sehari = $this->input->post('hamb_bahasa_sehari');
$hamb_tinlan_penerjemah = $this->input->post('hamb_tinlan_penerjemah');

$hamb_cek_emov = $this->input->post('hamb_cek_emov');
$hamb_emosi = $this->input->post('hamb_emosi');
$hamb_motivasi = $this->input->post('hamb_motivasi');

$hamb_cek_fiko = $this->input->post('hamb_cek_fiko');
$hamb_tinlan_fisio = $this->input->post('hamb_tinlan_fisio');
$hamb_fisik = $this->input->post('hamb_fisik');
$hamb_kognitif = $this->input->post('hamb_kognitif');
$hamb_fisik_lemah = $this->input->post('hamb_fisik_lemah');

/*$hamb_cek_sedif = $this->input->post('hamb_cek_sedif');*/
$hamb_tinlan_edu = $this->input->post('hamb_tinlan_edu');
$hamb_cara_edu = $this->input->post('hamb_cara_edu');

$hamb_cek_keyakinan = $this->input->post('hamb_cek_keyakinan');
$hamb_tinlan_makan = $this->input->post('hamb_tinlan_makan');
$hamb_tinlan_beda_kelamin = $this->input->post('hamb_tinlan_beda_kelamin');
$hamb_tinlan_tolak_imun = $this->input->post('hamb_tinlan_tolak_imun');
$hamb_keyakinan_lainnya = $this->input->post('hamb_keyakinan_lainnya');

/*tambahan edukasi*/
$hamb_bpjs_cek_edukasi = $this->input->post('hamb_bpjs_cek_edukasi');
$hamb_bpjs_penjaminan = $this->input->post('hamb_bpjs_penjaminan');
$hamb_bpjs_iur_biaya = $this->input->post('hamb_bpjs_iur_biaya');
$hamb_bpjs_pulang_paksa = $this->input->post('hamb_bpjs_pulang_paksa');
/**/

$kkb = Edukasi_integrasi::firstOrNew(array('no_reg' => $no_reg, 'tgl_masuk' => $tgl_masuk, 'jam_masuk' => $jam_masuk));
$kkb->no_reg = $no_reg;
$kkb->nama = $nama;
$kkb->poli_id = $poli_id;
$kkb->kd_bangsal = $kd_bangsal;
$kkb->dokter_id = $dokter_id;
$kkb->asuransi_id = $asuransi_id;
$kkb->rujuk = $rujuk;
$kkb->tgl_masuk = $tgl_masuk;
$kkb->jam_masuk = $jam_masuk;

/*hambatan*/
/*$kkb->hamb_cek_baca = $hamb_cek_baca;*/
$kkb->hamb_mampu_baca = $hamb_mampu_baca;
$kkb->hamb_tingkat_didik = $hamb_tingkat_didik;

$kkb->hamb_cek_bahasa = $hamb_cek_bahasa;
$kkb->hamb_bahasa_sehari = $hamb_bahasa_sehari;
$kkb->hamb_tinlan_penerjemah = $hamb_tinlan_penerjemah;

$kkb->hamb_cek_emov = $hamb_cek_emov;
$kkb->hamb_emosi = $hamb_emosi;
$kkb->hamb_motivasi = $hamb_motivasi;

$kkb->hamb_cek_fiko = $hamb_cek_fiko;
$kkb->hamb_tinlan_fisio = $hamb_tinlan_fisio;
$kkb->hamb_fisik = $hamb_fisik;
$kkb->hamb_kognitif = $hamb_kognitif;
$kkb->hamb_fisik_lemah = $hamb_fisik_lemah;

/*$kkb->hamb_cek_sedif = $hamb_cek_sedif;*/
$kkb->hamb_tinlan_edu = $hamb_tinlan_edu;
$kkb->hamb_cara_edu = $hamb_cara_edu;

$kkb->hamb_cek_keyakinan = $hamb_cek_keyakinan;
$kkb->hamb_tinlan_makan = $hamb_tinlan_makan;
$kkb->hamb_tinlan_beda_kelamin = $hamb_tinlan_beda_kelamin;
$kkb->hamb_tinlan_tolak_imun = $hamb_tinlan_tolak_imun;
$kkb->hamb_keyakinan_lainnya = $hamb_keyakinan_lainnya;

/*tambahan edukasi*/
$kkb->hamb_bpjs_cek_edukasi = $hamb_bpjs_cek_edukasi;
$kkb->hamb_bpjs_penjaminan = $hamb_bpjs_penjaminan;
$kkb->hamb_bpjs_iur_biaya = $hamb_bpjs_iur_biaya;
$kkb->hamb_bpjs_pulang_paksa = $hamb_bpjs_pulang_paksa;
/**/
$kkb->writer = $writer;
$kkb->registered = $registered;
$kkb->writed = $writed;

DB::transaction(function () use ($kkb) {
    $kkb->save();
});

$data = array(
    'no_reg' => $no_reg,
    'status' => true,
);
echo json_encode($data);
