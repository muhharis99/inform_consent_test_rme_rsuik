<?php 

        header('Access-Control-Allow-Origin: *');
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $unit = $akses->unit;
        $induk = $akses->induk;
        $kd_poli = null; 
        $kd_dokter = null; 
        $klinik = segment(4);
        $kd_dokter = segment(5); 
    
        $view = 'form/inden';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
        $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');

        $data = [
            'view'      => $view,
            'akses'     => self::akses(),
            'nik'       => $nik,
            'induk'     => $induk,
            'kd_poli'   => $kd_poli,
            'klinik'    => strtoupper($klinik),
            'kd_dokter' => $kd_dokter,
            'hari'      => $hari,
            'assets'    => $this->template->getMetadata(),
        ];
        go('index', $data);