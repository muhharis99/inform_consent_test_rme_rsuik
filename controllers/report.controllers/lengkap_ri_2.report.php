<?php 
$this->load->model('source');

        $view = 'report_kelengkapan_data_ri2';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setJs('admisi', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS('admisi', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $user_akses = self::akses();
        $source = Source::where('status', 1)->get(); 
        $xakses = self::akses_menu();
        $nik = $xakses->nik;
        $induk = ''; 
     
       
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'dokter'  => self::list_dokter(),
            'poli'  => self::list_poli(),
            'penunjang'  => self::list_penunjang(),
            'hd'  => self::list_hd(),
            'cathlab'  => self::list_poli(),
            'ugd'  => self::list_ugd(),
            'bangsal' => self::list_bangsal2(),
            'assets' => $this->template->getMetadata(),
            'induk' => $induk,
            'source' => $source,
        );
        go('index', $data);
        // pre($induk);