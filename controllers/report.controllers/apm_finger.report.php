<?php 

        $view = 'report/apm_finger';
        $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setJs('bill', array('bootstrap-table.min'));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
        $this->template->useAsset()->setCSS('bill', array('adminlte.extra-components.min', 'bootstrap-table.min'));
        $user_akses = self::akses();
        $source = null;
        // $source = Source::where('status', 1)->get();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $data = array(
            'view'   => $view,
            'akses' => self::akses(),
            'nik'   => $nik,
            'dokter'  => self::list_dokter(),
            'assets' => $this->template->getMetadata(),
            'source' => $source,
        );
        go('index', $data);