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
        $this->load->model('m_daerah');
        $this->load->model('m_jenis_kelamin');
        $this->load->model('m_agama');
        $this->load->model('m_kawin');
        $this->load->model('m_kerja');
        $this->load->model('m_didik');
        $this->load->model('m_bahasa');
        $this->load->model('m_etnis');
        $this->load->model('m_gol_darah');
        $this->load->model('m_jam_praktek');
        $this->load->model('m_rujuk');
        $this->load->model('poli');
        

        $bangsal = Bangsal::where('status_pendaftaran', '1')->groupBy('nama_pendaftaran')->orderBy('nama_pendaftaran', 'asc')->get();
        $asuransi = Asuransi::whereRaw("NAMA not like 'ZZZ%' ")->orderBy('nama', 'asc')->get();
        $daerah = M_daerah::whereNull('deleted')->get(['kode', 'nama']);
        $jenis_kelamin = M_jenis_kelamin::whereNull('deleted')->get(['kode', 'nama']);
        $agama = M_agama::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $kerja = M_kerja::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $kawin = M_kawin::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $didik = M_didik::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $etnis = M_etnis::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $bahasa = M_bahasa::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $gol_darah = M_gol_darah::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $praktek = M_jam_praktek::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        $rujuk = M_rujuk::orderBy('urut', 'asc')->get(['kode', 'nama', 'deleted']);
        if ($nik=='100952') {
            $printer = DB::table('rsik.admisi_printer')->groupBy('printer')->orderBy('nama', 'ASC')->get();
        } else {
            $printer = DB::table('rsik.admisi_printer')->whereIn('kategori', array('admisi'))->groupBy('printer')->orderBy('nama', 'ASC')->get();
        }
        $poli = Poli::where('show', '1')->get(['kode_poli', 'nama_poli']);
        // $view = 'form_rawat_jalan_2';
        $view = 'form_rawat_jalan_xx';
        $view = 'form/rawat_jalan';
        if (ipclient()==IPC) $view = 'form/rawat_jalan';
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
            'view'            => $view,
            'akses'           => self::akses(),
            'nik'             => $nik,
            'induk'           => $induk,
            'kd_poli'         => $kd_poli,
            'klinik'          => strtoupper($klinik),
            'kd_dokter'       => $kd_dokter,
            'hari'            => $hari,
            'daerah'          => $daerah,
            'jenis_kelamin'   => $jenis_kelamin,
            'kawin'           => $kawin,
            'agama'           => $agama,
            'didik'           => $didik,
            'bahasa'          => $bahasa,
            'etnis'          => $etnis,
            'gol_darah'          => $gol_darah,
            'poli'         => $poli,
            'praktek'         => $praktek,
            'asuransi'        => $asuransi,
            'kerja'           => $kerja,
            'printer'         => $printer,
            'default_printer' => $default_printer,
            'rujuk'           => $rujuk,
            'dokter'          => self::dokter_poli(),
            'assets'          => $this->template->getMetadata(),
        );
        // json(self::dokter_poli());
        go('index', $data);