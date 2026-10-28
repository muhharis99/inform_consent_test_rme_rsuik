<?php 

        $this->load->model('Kunjung');
        $this->load->helper('bpjs_bridge');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $total_fo = $total_admisi = $total_checkin = $total_mulai_poli = $total_selesai_poli = $total_mulai_resep = $total_selesai_resep = $total_menunggu_poli = $total_menunggu_dokter = $total_menunggu_obat = $total_batal = 0; 
        $data_post = [
			"sec"			=> "antreanrs",
			"method"		=> "GET",
			"url"			=> "antrean/pendaftaran/tanggal/".$atanggal
		];
		$result = antreanrs($data_post); 
		$result = json_decode($result);
        $total = !empty($result->response)?count($result->response):0;
        $grand_total = $total;
        $rows_subspesialis = DB::table('bpjs.antreanrs_ref_poli')->get();
        $arr_subspesialis = [];
        if (!empty($rows_subspesialis)) {
            foreach ($rows_subspesialis as $key => $row_subspesialis) {
                $arr_subspesialis[$row_subspesialis['kdsubspesialis']] = $row_subspesialis['nmsubspesialis'];
            }
        }
        $rows_dokter = DB::table('bpjs.antreanrs_ref_dokter')->get();
        $arr_dokter = [];
        if (!empty($rows_dokter)) {
            foreach ($rows_dokter as $key => $row_dokter) {
                $arr_dokter[$row_dokter['kodedokter']] = $row_dokter['namadokter'];
            }
        }
        function getNama($no_reg) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nama']);
            $res = !empty($pasien['nama'])?$pasien['nama']:''; 
            return $res; 
        }
        $total_mjkn = 0;
        $total_mjknb = 0; 
        // $rows = !empty($result->response)?$result->response:[];
        $rows = []; 
        if (!empty($result->response)) {
            $no_urut = 1; 
            foreach ($result->response as $key => $row) {
                $row = (object) $row; 
                // if ($row->kodepoli == 'THT') {
                    $row->no = $no_urut; 
                    $row->str_sumber = str_replace(["Mobile JKN", "Bridging Antrean"], ["MJKN", "SIMRS"], $row->sumberdata);
                    $str_poli = !empty($arr_subspesialis[$row->kodepoli])?$arr_subspesialis[$row->kodepoli]:'';
                    $str_poli .= !empty($arr_dokter[$row->kodedokter])?"<br />".$arr_dokter[$row->kodedokter]:'<br /> -';
                    $row->namapoli = !empty($arr_subspesialis[$row->kodepoli])?$arr_subspesialis[$row->kodepoli]:'';
                    $row->namadokter = !empty($arr_dokter[$row->kodedokter])?$arr_dokter[$row->kodedokter]:'';
                    $row->nama = getNama($row->norekammedis);
                    $row->task1 = $row->task2 = $row->task3 = $row->task4 = $row->task5 = $row->task6 = $row->task7 = ''; 
                    if ($row->str_sumber =="MJKN"  && $row->status !="Batal") { $total_mjkn++; }
                    if ($row->str_sumber =="MJKN"  && $row->status =="Batal") { $total_mjknb++; }
                    if ($row->ispeserta==true) {
                        // $data_post = [
                        //     "sec"			=> "antreanrs",
                        //     "method"		=> "POST",
                        //     "url"			=> "antrean/getlisttask", 
                        //     "data"          => [
                        //         "kodebooking"   => $row->kodebooking
                        //     ]
                        // ];
                        // $reslist = antreanrs($data_post); 
                        // $reslist = json_decode($reslist);
                        // if (!empty($reslist->response)) {
                        //     foreach ($reslist->response as $keylist => $rowlist) {
                        //         if ($rowlist->taskid == 1) $row->task1 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 2) $row->task2 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 3) $row->task3 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 4) $row->task4 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 5) $row->task5 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 6) $row->task6 = substr($rowlist->wakturs, 11, 8);
                        //         if ($rowlist->taskid == 7) $row->task7 = substr($rowlist->wakturs, 11, 8);
                        //     }
                        // }
                    }
                    $row->str_kodebooking = $row->kodebooking."<br />".(!empty($row->ispeserta)&&$row->ispeserta==true?"JKN":"-");
                    $row->str_namapoli = $str_poli;
                    $no_urut ++; 
                    $rows[] = $row;
                // }
            }
        }
    
        $data = array(
            "rows" => $rows, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => array(
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ), 
            "grand_total" => $grand_total." ANTRIAN",
            "total_fo" => $total_fo,
            "total_admisi" => $total_admisi,
            "total_checkin" => $total_checkin,
            "total_mulai_poli" => $total_mulai_poli,
            "total_selesai_poli" => $total_selesai_poli,
            "total_mulai_resep" => $total_mulai_resep,
            "total_selesai_resep" => $total_selesai_resep,
            "total_menunggu_poli" => $total_menunggu_poli,
            "total_menunggu_dokter" => $total_menunggu_dokter,
            "total_menunggu_obat" => $total_menunggu_obat,
            "total_batal" => $total_batal,
            "total_mjkn" =>$total_mjkn,
            "total_mjknb" =>$total_mjknb,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));