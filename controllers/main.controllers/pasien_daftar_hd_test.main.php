<?php 

$this->load->model('Jadwal_HD');
$jadwal_hd = $this->Jadwal_HD->get(); 
if (!empty($jadwal_hd)){
    foreach($jadwal_hd as $key => $row) {
        DB::table('rsiklaten.pasien')->where('no_reg', $row['no_reg'])->update([
            'tgl_masuk' => $row['tgl_ulang_1'],
            'jam_masuk' => substr($row['jam'], 0, 5),
            'kd_poli' => 'HD', 
            'kd_dr' => $row['kd_dr'],
            'rawat' => 'J', 
            'no_bed' => '', 
            'rujuk' => '', 
            'pasien' => '', 
            'pulang' => 1, 
            'tgl_keluar' => $row['tgl_ulang_1'], 
            'jam_keluar' => substr($row['jam'], 0, 5),
            'kelas' => '', 
            'bangsal' => '', 
            'ktp' => '', 
            'statusplg' => '',
            'umur' => isset($umur) ? $umur : null 
        ]);
    }
}
json($jadwal_hd);
?>
