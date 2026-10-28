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
        // die($klinik." is segmen 4");
        $this->load->model('bangsal');
        $this->load->model('asuransi');
        $this->load->model('agama');
        $this->load->model('perkawinan');
        $agama = Agama::orderBy('no_urut', 'asc')->get(['kd_agama', 'agama']);
        $kawin = Perkawinan::orderBy('no_urut', 'asc')->get(['kd_perkawinan', 'nama_perkawinan']);

        $bangsal = Bangsal::where('status_pendaftaran', '1')->groupBy('nama_pendaftaran')->orderBy('nama_pendaftaran', 'asc')->get();
        $asuransi = Asuransi::whereRaw("NAMA not like 'ZZZ%' ")->orderBy('nama', 'asc')->get();
        $pekerjaan = DB::table('rsiklaten.pekerjaan')->orderBy('no_urut', 'ASC')->get();
        $rujuk = DB::table('rsiklaten.rujuk')->orderBy('no_urut', 'ASC')->get();
        $printer = DB::table('rsik.admisi_printer')->whereIn('kategori', array('admisi'))->groupBy('printer')->orderBy('nama', 'ASC')->get();
        if ($nik=='100952') $printer = DB::table('rsik.admisi_printer')->groupBy('printer')->orderBy('nama', 'ASC')->get();
        
        $view = 'form/rawat_inap';
        $this->template->useAsset()->setJs(array('jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect.jquery', 'jquery.idle', 'logout', 'jquery.inputmask', 'jquery.mask'));
        $this->template->useAsset()->setJs('admisi', array($view));
        $this->template->useAsset()->setCSS(array('theme4', 'bootstrap.min.theme4', 'jquery-ui', 'jquery.tag-editor', 'annotator-pro.min', 'imageselect'));
        $this->template->useAsset()->setJS(array('bootstrap-datepicker'));
        $this->template->useAsset()->setCSS(array('bootstrap-datepicker'));
        $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'ahad');
        // pre($asuransi);
        $ipclient = ipclient();
        $default_printer = "";
        if (!empty($printer)) {
            foreach ($printer as $row_printer) {
                $row_printer = (object) $row_printer; 
                if ($row_printer->ip == $ipclient) {
                    $default_printer = $row_printer->printer;
                } 
            }
        }
        // $default_printer = "AdmisiEpson";
        $data = array(
            'view'      => $view,
            'akses'     => self::akses(),
            'nik'       => $nik,
            'induk'     => $induk,
            'kd_poli'   => $kd_poli,
            'rows_agama'   => $agama,
            'rows_kawin'   => $kawin,
            'klinik'    => strtoupper($klinik),
            'kd_dokter' => $kd_dokter,
            'hari'      => $hari,
            'bangsal'      => $bangsal,
            'asuransi'      => $asuransi,
            'kerja'      => $pekerjaan,
            'printer'      => $printer,
            'default_printer'      => $default_printer,
            'rujuk'      => $rujuk,
            'dokter'    => self::dpjp(),
            'assets'    => $this->template->getMetadata(),
        );
        go('index', $data);