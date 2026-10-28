<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$this->load->model('Antri');
$this->load->model('Kunjung');
$data = Antri::where('no_reg', '0000001')->orderBy('id', 'DESC')->first();
for($i=6; $i<101; $i++) {
    $no = $i;
    $no_reg = substr('00000000'.$no, -7);
    $daftar = '0A'.substr('000'.$no, -3);
    $antri = new Antri;
    $antri->TANGGAL = '2022-09-01';
    $antri->JAM = '11:00:00';
    $antri->T_PERIKSA = '2022-09-01';
    $antri->J_PERIKSA = '11:00:00'; 
    $antri->KD_DR = 'P007'; 
    $antri->NO_REG = $no_reg; 
    $antri->DAFTAR = $daftar; 
    $antri->ANTRIAN = $no; 
    $antri->POLI = 'UGD'; 
    $antri->PETUGAS = '100000'; 
    $antri->STATUS = 'SELESAI'; 
    $antri->deletedstate = 0; 
    DB::transaction(function () use ($antri) {
        $antri->save();
    });
    $kunjung = new Kunjung;
    $kunjung->tanggal = '2022-09-01';
    $kunjung->jam = '11:00:00';
    $kunjung->no_kjg = '0';
    $kunjung->rawat = 'J'; 
    $kunjung->kd_dr = 'P007'; 
    $kunjung->kd_poli = 'UGD'; 
    $kunjung->no_reg = $no_reg; 
    $kunjung->antrian = $daftar; 
    $kunjung->rujuk = '1'; 
    $kunjung->pasien = '001'; 
    $kunjung->opr = '100000'; 
    $kunjung->deletedstate = 0; 
    DB::transaction(function () use ($kunjung) {
        $kunjung->save();
    });
}
pre($data);
