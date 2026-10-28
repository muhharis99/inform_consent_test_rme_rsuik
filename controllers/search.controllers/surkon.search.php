<?php 

        $this->load->model('Kunjung');
        $this->load->helper('bpjs_bridge');
        $poli = $this->input->get('poli'); 
        $bill = $this->input->get('bill'); 
        $kategori = $this->input->get('kategori'); 
        $strtgl = $kategori=='kontrol'?'Tgl Terbit':'Tgl Kontrol';
        $kategori = $kategori=='kontrol'?2:1;
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $total_spri = $total_skdp = $total_terbit = $total_poli = $total_unclaim = 0; 
        $data_post = [
			"sec"			=> "vclaim",
			"method"		=> "GET",
			"url"			=> "RencanaKontrol/ListRencanaKontrol/tglAwal/".$atanggal."/tglAkhir/".$btanggal."/filter/".$kategori
		];
		$result = vclaim($data_post); 
		$result = json_decode($result);
        $total = !empty($result->response->list)?count($result->response->list):0;
        $grand_total = $total;
        // pre($bill);
        // $rows_subspesialis = DB::table('bpjs.antreanrs_ref_poli')->get();
        // $arr_subspesialis = [];
        // if (!empty($rows_subspesialis)) {
        //     foreach ($rows_subspesialis as $key => $row_subspesialis) {
        //         $arr_subspesialis[$row_subspesialis['kdsubspesialis']] = $row_subspesialis['nmsubspesialis'];
        //     }
        // }
        // $rows_dokter = DB::table('bpjs.antreanrs_ref_dokter')->get();
        // $arr_dokter = [];
        // if (!empty($rows_dokter)) {
        //     foreach ($rows_dokter as $key => $row_dokter) {
        //         $arr_dokter[$row_dokter['kodedokter']] = $row_dokter['namadokter'];
        //     }
        // }
        function getNama($no_reg, $tanggal) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nama']);
            $res = !empty($pasien['nama'])?$pasien['nama']:''; 
            return $res; 
        }
 
        function getRM($noKartu, $tglSEP, $show=0) {
            $sep = DB::table('bpjs.sep2')->where('noKartu', $noKartu)->where('tglSEP', $tglSEP)->orderBy('id', 'desc')->first(['noMr', 'submittedby', 'registered']);
            $kunjung = [];
            if ($show==1 && !empty($sep['noMr'])) {
                $kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $sep['noMr'])->where('tanggal', $tglSEP)->whereNull('deleted')->orderBy('id', 'desc')->first(['jam', 'opr', 'pasien', 'kd_poli']);
            }
            $res = !empty($sep['noMr'])?$sep['noMr'].(!empty($kunjung) ? ' - '.$kunjung['jam'] : ''):''; 
            return $res; 
        }
        
        // $rows = !empty($result->response)?$result->response:[];
        $rows = []; 
        if (!empty($result->response->list)) {
            $no_urut = 1; 

            foreach ($result->response->list as $key => $row) {
                $filterPoli = $this->input->get('bill'); 
                // pre($filterPoli);
                // ===== FILTER POLI =====
                if ($filterPoli !== 'ALL') {
                    if (empty($row->poliAsal) || strtoupper($row->poliAsal) !== $filterPoli) {
                        continue; // skip selain poli yang dipilih
                    }
                }
                // =======================

                $row = (object) $row; 
                $row->no = $no_urut; 

                if ($row->jnsKontrol == 1) { $total_spri++; }
                if ($row->jnsKontrol == 2) { $total_skdp++; }

                $row->status = ""; 
                $show = 0;

                if ($row->tglTerbitKontrol == $row->tglRencanaKontrol && $row->jnsKontrol == 2) { 
                    $total_unclaim++;
                    $row->status = '<i class="fa fa-exclamation-triangle">SKDP = SEP</i>'; 
                    $show = 1;
                }

                $row->rm = getRM($row->noKartu, $row->tglTerbitKontrol, $show).'&nbsp'.$row->nama;

                if (strtoupper($row->terbitSEP) == "BELUM") { 
                    $total_terbit++; 
                }

                $row->str_namapoli = ucwords(strtolower($row->namaPoliTujuan));
                $row->tanggal = date("d/m/Y", strtotime(
                    $kategori == 2 ? $row->tglTerbitKontrol : $row->tglRencanaKontrol
                ));

                $no_urut++; 
                $rows[] = $row;
            }
        }

    
        $data = [
            "rows" => $rows, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => [
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ], 
            "grand_total" => $grand_total." Surat",
            "total_surat" => $grand_total,
            "total_skdp" => $total_skdp,
            "total_spri" => $total_spri,
            "total_terbit" => $total_terbit,
            "total_unclaim" => $total_unclaim,
            "strtgl" => $strtgl,
        ];
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));