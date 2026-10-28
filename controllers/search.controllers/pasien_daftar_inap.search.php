<?php 

        $this->load->model('Kunjung');
        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $tanggal = $this->input->get('tanggal');
        $rows = (array) null; 
        $grand_total = 0;
        if (ipclient()=="172.16.18.21X") {
        $sort = "tgl_masuk";
        $rows_data = DB::select("select * from rsiklaten.pasien a where a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' or a.no_id like '%$search%' or a.nopeserta like '%$search%' or a.tgl_lahir like '%$search%' order by $sort $order limit $offset, $take");
        $total = array_column(DB::select("select count(no_reg) as total from rsiklaten.pasien a where a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' or a.no_id like '%$search%' or a.nopeserta like '%$search%' or a.tgl_lahir like '%$search%'"), 'total')[0];
        $pekerjaan = array_column(DB::table('rsiklaten.pekerjaan')->get(['kd_pekerjaan', 'pekerjaan']), 'pekerjaan', 'kd_pekerjaan');
        $agama = array_column(DB::table('rsiklaten.agama')->get(['kd_agama', 'agama']), 'agama', 'kd_agama');
        $perkawinan = array_column(DB::table('rsiklaten.perkawinan')->get(['kd_perkawinan', 'nama_perkawinan']), 'nama_perkawinan', 'kd_perkawinan');
        $bahasa = array_column(DB::table('rsiklaten.bahasa')->get(['kd_bahasa', 'nama_bahasa']), 'nama_bahasa', 'kd_bahasa');
        $etnis = array_column(DB::table('rsiklaten.etnis')->get(['kd_etnis', 'nama_etnis']), 'nama_etnis', 'kd_etnis');
        $rows = [];
        foreach ($rows_data as $row) {
            $row = (object) $row;
            $arr_default = array('kode_poli', 'nama_poli', 'kode_dokter', 'nama_dokter', 'ktp', 'str_tgl_periksa', 'str_jam_periksa', 'str_tgl_jam_periksa', 'tgl_periksa', 'jam_periksa', 'umur', 'nama_asuransi', 'kode_asuransi', 'nama_agama', 'telp_1', 'telp_2', 'nama_pekerjaan', 'nama_agama', 'nama_bahasa', 'kode_bangsal', 'nama_bangsal', 'kode_dpjp_1', 'nama_dpjp_1'); 
            foreach ($arr_default as $key=>$value) {
                // $row->$value = ''; 
            }
            $row->str_tgl_lahir = strtoupper(tampiltanggal($row->tgl_lahir, 9));
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->alamat = $row->alamat;
            $row->ktp = $row->ktp;
            $row->nama_pekerjaan = !empty($pekerjaan[$row->pekerjaan])?$pekerjaan[$row->pekerjaan]:"";
            $row->nama_bahasa = !empty($bahasa[$row->bahasa])?$bahasa[$row->bahasa]:"";
            $row->nama_agama = !empty($agama[$row->agama])?$agama[$row->agama]:"";
            $row->jenis_kelamin = in_array($row->jenis_kel, ['L', '1']) ? "LAKI-LAKI" : (in_array($row->jenis_kel, ['P', '2']) ? "PEREMPUAN" : "");
            $row->jenis_kel = in_array($row->jenis_kel, ['L', '1']) ? "L" : (in_array($row->jenis_kel, ['P', '2']) ? "P" : "");
            // $kunjung = DB::table('rsiklaten.kunjung as a')
            //         ->leftJoin('rsiklaten.poli as b', function($join) {
            //             $join->on('a.kd_poli', '=', 'b.kode_poli'); 
            //         })
            //         ->leftJoin('rsiklaten.dokter as c', function($join) {
            //             $join->on('a.kd_dr', '=', 'c.no_dr'); 
            //         })
            //         ->leftJoin('rsiklaten.asuransi as d', function($join) {
            //             $join->on('a.pasien', '=', 'd.no_rel'); 
            //         })
            //         ->whereNull('a.deleted')
            //         ->whereNotNull('a.tanggal')
            //         ->where('a.no_reg', $row->no_reg)
            //         ->orderBy('a.tanggal', 'DESC')
            //         ->orderBy('a.jam', 'DESC')
            //         ->first(array(
            //             'b.nama_poli', 
            //             'b.kode_poli', 
            //             'a.tanggal', 
            //             'a.jam', 
            //             'c.nama2', 
            //             'c.no_dr', 
            //             DB::raw('a.pasien as kode_asuransi'),
            //             DB::raw('d.nama as nama_asuransi')
            //         ));
            $row->umur = $row->umur; 
            $row->tgl_lahir = $row->tgl_lahir;
            if (!empty($kunjung)) {
                $kunjung = (object) $kunjung; 
                $row->kode_poli   = $kunjung->kode_poli;
                $row->nama_poli   = $kunjung->nama_poli;
                $row->kode_dokter = $kunjung->no_dr;
                $row->nama_dokter = $kunjung->nama2;
                $row->str_tgl_periksa = tampiltanggal($kunjung->tanggal, 9);
                $row->str_jam_periksa = substr($kunjung->jam, 0, 5);
                $row->str_tgl_jam_periksa = tampiltanggal($kunjung->tanggal, 9)." ".substr($kunjung->jam, 0, 5);
                $row->tgl_periksa = $kunjung->tanggal; 
                $row->jam_periksa = $kunjung->jam; 
                $row->umur = selisihymdhis($row->tgl_periksa, $row->tgl_lahir, "umur"); 
                $row->nama_asuransi = $kunjung->nama_asuransi;
                $row->kode_asuransi = $kunjung->kode_asuransi;
            }
            // $inap = DB::table('ranap.inap as a')
            //         ->leftJoin('rme.bangsal as b', function($join) {
            //             $join->on('a.kd_bangsal', '=', 'b.kd_bangsal'); 
            //         })
            //         ->leftJoin('rsiklaten.dokter as c', function($join) {
            //             $join->on('a.dpjp1', '=', 'c.no_dr'); 
            //         })
            //         ->where('no_reg', $row->no_reg)
            //         ->first(array('a.no_reg', DB::raw("a.kd_bangsal as kode_bangsal"), DB::raw("b.nama_pendaftaran as nama_bangsal"), DB::raw("c.nama2 as nama_dpjp_1"), DB::raw("a.dpjp1 as kode_dpjp_1")));
            if (!empty($inap)) {
                $inap = (object) $inap; 
                $row->kode_bangsal = $inap->kode_bangsal;
                $row->nama_bangsal = $inap->nama_bangsal;
                $row->kode_dpjp_1 = $inap->kode_dpjp_1;
                $row->nama_dpjp_1 = $inap->nama_dpjp_1;
            }
            $rows[] = $row;
        }
        $data = array(
            "rows" => $rows, 
            "total" => $total, 
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
        die();
        }
        $rows_data = DB::table("rsiklaten.pasien as a")
            ->leftJoin('rsiklaten.pekerjaan as b', function($join) {
                $join->on('a.pekerjaan', '=', 'b.kd_pekerjaan'); 
            })
            ->leftJoin('rsiklaten.agama as c', function($join) {
                $join->on('a.agama', '=', 'c.kd_agama'); 
            })
            ->leftJoin('rsiklaten.perkawinan as d', function($join) {
                $join->on('a.kawin', '=', 'd.kd_perkawinan'); 
            })
            ->leftJoin('rsiklaten.pendidikan as e', function($join) {
                $join->on('a.didik', '=', 'e.kd_pendidikan'); 
            })
            ->leftJoin('rsiklaten.bahasa as f', function($join) {
                $join->on('a.bahasa', '=', 'f.kd_bahasa'); 
            })
            ->leftJoin('rsiklaten.etnis as g', function($join) {
                $join->on('a.etnis', '=', 'g.kd_etnis'); 
            })
            ->whereRaw("a.no_reg like '%$search%' or a.nama like '%$search%' ")
            // ->whereRaw("a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' or a.no_id like '%$search%' or a.nopeserta like '%$search%' or a.tgl_lahir like '%$search%' ")
            ->take($take)
            ->offset($offset)
            ->orderBy('a.tgl_masuk', 'DESC')
            ->orderBy($sort, $order)
            ->get(array(
                "a.no_reg", 
                "a.nama", 
                "a.tgl_lahir", 
                "a.umur", 
                DB::RAW("a.no_id as ktp"), 
                DB::RAW("a.telp as telp_1"), 
                DB::RAW("a.telp2 as telp_2"), 
                "a.alamat", 
                DB::RAW("a.pekerjaan as kode_pekerjaan"), 
                DB::RAW("b.pekerjaan as nama_pekerjaan"), 
                DB::RAW("a.agama as kode_agama"), 
                DB::RAW("c.agama as nama_agama"), 
                DB::RAW("a.kawin as kode_perkawinan"), 
                DB::RAW("d.nama_perkawinan as nama_perkawinan"), 
                DB::RAW("a.didik as kode_pendidikan"), 
                DB::RAW("e.pendidikan as nama_pendidikan"), 
                DB::RAW("a.bahasa as kode_bahasa"), 
                DB::RAW("f.nama_bahasa as nama_bahasa"), 
                DB::RAW("a.etnis as kode_etnis"), 
                DB::RAW("g.nama_etnis as nama_etnis"), 
                "a.jenis_kel", 
                "a.tgl_masuk", 
                "a.kd_poli", 
            ));
        $rows = [];
        // pre($rows_data);
        foreach ($rows_data as $row) {
            $row = (object) $row;
            $arr_default = array('kode_poli', 'nama_poli', 'kode_dokter', 'nama_dokter', 'ktp', 'str_tgl_periksa', 'str_jam_periksa', 'str_tgl_jam_periksa', 'tgl_periksa', 'jam_periksa', 'umur', 'nama_asuransi', 'kode_asuransi', 'nama_agama', 'telp_1', 'telp_2', 'nama_pekerjaan', 'nama_agama', 'nama_bahasa', 'kode_bangsal', 'nama_bangsal', 'kode_dpjp_1', 'nama_dpjp_1'); 
            foreach ($arr_default as $key=>$value) {
                // $row->$value = ''; 
            }
            $row->str_tgl_lahir = strtoupper(tampiltanggal($row->tgl_lahir, 9));
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->alamat = $row->alamat;
            $row->ktp = $row->ktp;
            $row->nama_pekerjaan = $row->nama_pekerjaan;
            $row->nama_bahasa = $row->nama_bahasa;
            $row->nama_agama = $row->nama_agama;
            switch ($row->jenis_kel) {
                case 'L' : 
                case '1' : 
                    $row->jenis_kelamin = "LAKI-LAKI";
                    $row->jenis_kel = "L"; 
                    break; 
                case 'P' : 
                case '2' : 
                    $row->jenis_kelamin = "PEREMPUAN";
                    $row->jenis_kel = "P"; 
                    break;  
            }
            
            $kunjung = DB::table('rsiklaten.kunjung as a')
                    ->leftJoin('rsiklaten.poli as b', function($join) {
                        $join->on('a.kd_poli', '=', 'b.kode_poli'); 
                    })
                    ->leftJoin('rsiklaten.dokter as c', function($join) {
                        $join->on('a.kd_dr', '=', 'c.no_dr'); 
                    })
                    ->leftJoin('rsiklaten.asuransi as d', function($join) {
                        $join->on('a.pasien', '=', 'd.no_rel'); 
                    })
                    ->whereNull('a.deleted')
                    ->whereNotNull('a.tanggal')
                    ->where('a.no_reg', $row->no_reg)
                    ->orderBy('a.tanggal', 'DESC')
                    ->orderBy('a.jam', 'DESC')
                    ->first(array(
                        'b.nama_poli', 
                        'b.kode_poli', 
                        'a.tanggal', 
                        'a.jam', 
                        'c.nama2', 
                        'c.no_dr', 
                        DB::raw('a.pasien as kode_asuransi'),
                        DB::raw('d.nama as nama_asuransi')
                    ));
            // pre($kunjung); 
            $row->umur = $row->umur; 
            $row->tgl_lahir = $row->tgl_lahir;
            // $kunjung = null; 
            if (!empty($kunjung)) {
                $kunjung = (object) $kunjung; 
                $row->kode_poli   = $kunjung->kode_poli;
                $row->nama_poli   = $kunjung->nama_poli;
                $row->kode_dokter = $kunjung->no_dr;
                $row->nama_dokter = $kunjung->nama2;
                $row->str_tgl_periksa = tampiltanggal($kunjung->tanggal, 9);
                $row->str_jam_periksa = substr($kunjung->jam, 0, 5);
                $row->str_tgl_jam_periksa = tampiltanggal($kunjung->tanggal, 9)." ".substr($kunjung->jam, 0, 5);
                $row->tgl_periksa = $kunjung->tanggal; 
                $row->jam_periksa = $kunjung->jam; 
                $row->umur = selisihymdhis($row->tgl_periksa, $row->tgl_lahir, "umur"); 
                $row->nama_asuransi = $kunjung->nama_asuransi;
                $row->kode_asuransi = $kunjung->kode_asuransi;
            }
            $inap = DB::table('ranap.inap as a')
                    ->leftJoin('rme.bangsal as b', function($join) {
                        $join->on('a.kd_bangsal', '=', 'b.kd_bangsal'); 
                    })
                    ->leftJoin('rsiklaten.dokter as c', function($join) {
                        $join->on('a.dpjp1', '=', 'c.no_dr'); 
                    })
                    ->where('no_reg', $row->no_reg)
                    ->first(array('a.no_reg', DB::raw("a.kd_bangsal as kode_bangsal"), DB::raw("b.nama_pendaftaran as nama_bangsal"), DB::raw("c.nama2 as nama_dpjp_1"), DB::raw("a.dpjp1 as kode_dpjp_1")));
            // $inap = DB::table('rsiklaten.inap as a')
            //         ->leftJoin('rme.bangsal as b', function($join) {
            //             $join->on('a.bangsal', '=', 'b.kd_bangsal'); 
            //         })
            //         ->leftJoin('rsiklaten.dokter as c', function($join) {
            //             $join->on('a.kd_dr_ri1', '=', 'c.no_dr'); 
            //         })
            //         ->where('no_reg', $row->no_reg)
            //         ->first(array('a.no_reg', DB::raw("a.bangsal as kode_bangsal"), DB::raw("b.nama_pendaftaran as nama_bangsal"), DB::raw("c.nama2 as nama_dpjp_1"), DB::raw("a.kd_dr_ri1 as kode_dpjp_1")));
            if (!empty($inap)) {
                $inap = (object) $inap; 
                $row->kode_bangsal = $inap->kode_bangsal;
                $row->nama_bangsal = $inap->nama_bangsal;
                $row->kode_dpjp_1 = $inap->kode_dpjp_1;
                $row->nama_dpjp_1 = $inap->nama_dpjp_1;
            }
            $rows[] = $row;
        }
        $total = DB::table("rsiklaten.pasien as a")
            ->whereRaw("a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' ")
            // ->whereRaw("a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' or a.no_id like '%$search%' or a.nopeserta like '%$search%' or a.tgl_lahir like '%$search%' ")
            ->count();

        $data = array(
            "rows" => $rows, 
            "total" => $total, 
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));