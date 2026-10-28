<?php 
$arr_default = array('id', 'nama', 'tgl_lahir', 'umur', 'alamat', 'poli', 'dokter_id', 'dokter', 'triage', 'ntriage', 'trauma', 'tinlan', 'datang', 'rujuk', 'jatuh', 'njatuh', 'derajat_jatuh', 'subyektif', 'keluhan', 'riwayat_sekarang', 'riwayat_dahulu', 'e', 'v', 'm', 'nsadar', 'keadaan', 'bb', 'tb', 'imt', 'gstat', 'gds', 'td1', 'td2', 'td', 's', 'rr', 'n', 'nyeri', 'airway', 'nafas', 'sirkulasi', 'crt', 'oksigen', 'adl', 'cacat', 'protesa', 'alat', 'cemas', 'wajib_ibadah', 'thoharoh', 'sholat', 'thaharah', 'thaharoh', 'perawat_id', 'perawat', 'ttd', 'ttd_image', 'masalah', 'tindakan', 'registered', 'tunda', 'alasan', 'dpjp_id', 'dpjp_nama', 'ttd_dpjp', 'ass_nyeri', 'lok_nyeri', 'edukasi', 'penerima_edukasi', 'kes_keluarga', 'catatan_khusus', 'genetalia', 'nik',  'asesmen', 'lama_nyeri', 'poli_id', 'asuransi_id', 'keadaan_umum', 'keadaan_umum_lain', 'psikologi', 'iperawat', 'asal', 'sadar', 'sadar_lain', 'kepala', 'kepala_lain', 
'rambut', 'rambut_lain', 'wajah', 'wajah_lain', 'mata', 'mata_lain', 'hidung', 'hidung_lain', 'mulut', 'mulut_lain', 'telinga', 'telinga_lain', 'leher', 'leher_lain', 'gigi', 'gigi_lain', 
'lidah', 'lidah_lain', 'tenggorokan', 'tenggorokan_lain', 'dada', 'dada_lain', 'respirasi', 'respirasi_lain', 'jantung', 'jantung_lain', 'integumen', 'integumen_lain', 'abdomen', 'abdomen_lain', 
'ekstremitas', 'ekstremitas_lain', 'gentalia', 'genetalia_lain', 'anus', 'anus_lain', 'psikologis', 'psikologis_lain', 'sosial', 'sosial_lain', 'spiritual', 'spiritual_lain', 
'spiritual_agama', 'spiritual_agama_lain', 'spiritual_jenis', 'spiritual_jenis_lain', 'pekerjaan', 'pekerjaan_lain', 'skrinning_nyeri', 'asesmen_nyeri', 'skor_nyeri', 'faktor_nyeri', 
'skala_nyeri', 'lokasi_nyeri', 'kualitas_nyeri', 'asesmen_jatuh', 'kesimpulan_jatuh', 'asesmen_fungsi_hygiene', 'asesmen_fungsi_pakaian', 'asesmen_fungsi_makan', 'asesmen_fungsi_bab',
'asesmen_fungsi_mandi', 'asesmen_fungsi_bak', 'asesmen_fungsi_toilet', 'asesmen_fungsi_kasur', 'asesmen_fungsi_kursi_kasur', 'asesmen_fungsi_naik_turun', 'asesmen_fungsi_jalan', 'penurunanbb',
'asupanmakanan', 'diagkhusus', 'edukasi_lain', 'rencana_pemulangan', 'masalah_keperawatan', 'masalah_keperawatan_lain', 'riwayat_keluarga', 'alergi_makanan', 'alergi_obat', 'alergi_debu', 'alergi_lain', 'hubungan', 
'risiko_nutrisi', 'risiko_nutrisi_lain', 'tgl_tiba', 'riwayat_salin', 'usia_lahir', 'usia_lahir_lain', 'susu_bayi', 'usia_asi', 'usia_mpasi', 'usia_tengkurap', 'usia_duduk', 
'usia_berdiri', 'usia_berjalan', 'usia_bicara', 'usia_gigi', 'riwayat_imunisasi', 'riwayat_imunisasi_lain', 'kurus', 'penurunanbb_anak', 'asupanmakanan_anak', 'sakitmalnutrisi', 'wanita_hamil', 
'alat_kontrasepsi', 'waktu_kontrasepsi', 'jenis_kontrasepsi', 'riwayat_tranfusi', 'waktu_tranfusi', 'frekuensi_tt', 'unit', 'ttd_dokter', 'perawat1', 'ttd_perawat1', 
'status_alergi', 'alergi_makan', 'penerimaan_sakit', 'penerimaan_sakit_lain', 'ekspresi_pasien', 'ekspresi_pasien_lain', 'hub_keluarga', 'hub_keluarga_lain', 'wajib_ibadah_lain', 'thaharah', 'shalat', 'shalat_lain', 'fiqh_wanita', 'fiqh_wanita_lain', 'kerja', 'kerja_lani',
'skrining_nyeri', 'faktor_pencetus', 'risiko_jatuh_kondisi', 'risiko_jatuh_usia', 'risiko_jatuh_kategori', 'tanggal', 'tgl_masuk', 'jam_masuk', 'jenis_kelamin', 'kerja_lain', 'kunjung', 'asuransi', 'asisten', 'diagpre', 'ruang', 'dokter_bedah', 'diagpost', 'jaringan', 'pa', 'komplikasi', 'stanggal', 'sjam', 'etanggal', 'ejam', 'lama', 'laporan', 'instruksi_pasca', 'nm_dr', 'darah_hilang', 'darah_transfusi', 'jenis_kel', 'telp', 'cetaktanggal', 'cetakjam', 'intruksi_pasca', 'bon', 'operasi');
foreach ($arr_default as $key=>$value) {
    $$value = ''; 
}

$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
switch ((string) segment(6)) {
    case 'PRINT' : 
    case 'print' : 
        $pdf_type = "F";
        $lp_print = true;
        break; 
    case 'FILE' : 
        $pdf_type = "F";
        $lp_print = false;
        break; 
    case 'FILECLIENT' : 
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break; 
    case 'PRINTSERVER' : 
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break; 
}

$no_reg    = segment(4);
$tgl_rs    = segment(5);

if (!empty($tgl_rs)) {
    $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
    $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
}