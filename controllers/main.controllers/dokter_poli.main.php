<?php 
$this->load->model('dokter');
        $this->load->model('dokter_poli');

        $field  = ['rme.dokter.kd_dokter', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2'];
        $dokter = Dokter_Poli::join('rsiklaten.dokter', 'rme.dokter.kd_dokter', '=', 'rsiklaten.dokter.no_dr')->groupBy('rme.dokter.kd_dokter')->get($field);