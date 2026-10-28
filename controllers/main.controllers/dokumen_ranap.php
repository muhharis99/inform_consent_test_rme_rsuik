<?php 
    $akses = self::akses_menu();
    $nik = $akses->nik;
    $unit = $akses->unit;
    $induk = $akses->induk;

    $view = 'report/dokumen_ranap';
    $this->template->useAsset()->setJs(array('jquery.idle', 'logout'));
    $this->template->useAsset()->setJs('admisi', array($view));
    $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4'));
    $data = array(
        'view'   => $view,
        'induk' => $induk,
        'akses' => self::akses(),
        'assets' => $this->template->getMetadata(),
    );
    go('index', $data);