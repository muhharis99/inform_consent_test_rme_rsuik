<?php 

        $this->load->model('Kunjung');
        $this->load->helper('bpjs_bridge');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $strtgl = $kategori=='kontrol'?'Tgl Terbit':'Tgl Kontrol';
        // $kategori = $kategori=='kontrol'?2:1;
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $total_spri = $total_skdp = $total_terbit = $total_poli = $total_unclaim = $total_gagal = 0; 
        $result = (object) null; 
        $data_post = [
			"sec"			=> "vclaim",
			"method"		=> "GET",
			"url"			=> "RencanaKontrol/ListRencanaKontrol/tglAwal/".$atanggal."/tglAkhir/".$btanggal."/filter/".$kategori
		];
		// $result = vclaim($data_post); 
		// $result = json_decode($result);
        $total = !empty($result->response->list)?count($result->response->list):0;
        $grand_total = $total;
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
        function getNama($no_reg) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nama']);
            $res = !empty($pasien['nama'])?$pasien['nama']:''; 
            return $res; 
        }
        function getNoka($no_reg) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nopeserta']);
            $res = !empty($pasien['nopeserta'])?$pasien['nopeserta']:''; 
            return $res; 
        }
        function getDokter($kode) {
            $dokter = DB::table('bpjs.antreanrs_ref_dokter')->where('kodedokter', $kode)->first(['namadokter']);
            $res = !empty($dokter['namadokter'])?$dokter['namadokter']:''; 
            return $res; 
        }
        function getRM($noKartu, $tglSEP, $show=0) {
            $sep = DB::table('bpjs.sep2')->where('noKartu', $noKartu)->whereNotNUll('tglSEP')->orderBy('id', 'desc')->first(['noMr', 'submittedby', 'registered']);
            $kunjung = [];
            // if ($show==1 && !empty($sep['noMr'])) {
                $kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $sep['noMr'])->where('tanggal', $tglSEP)->whereNull('deleted')->orderBy('id', 'desc')->first(['jam', 'opr', 'pasien', 'kd_poli']);
            // }
            $res = !empty($sep['noMr'])?$sep['noMr'].(!empty($kunjung) ? ' - '.$kunjung['jam'] : ''):''; 
            return $res; 
        }
        function getSEP($noSEP) {
            $sep = DB::table('bpjs.sep2')->where('noSEP', $noSEP)->first();
            $polirujukan = null; 
            if (!empty($sep['noRujukan'])) {
                $polirujukan = DB::table('bpjs.sep2')->where('noRujukan', $sep['noRujukan'])->orderBy('id', 'asc')->first();
            }
            $res = !empty($sep['noSEP'])?$sep['noSEP'].' > '.$sep['noRujukan'].' '.(!empty($polirujukan['kdPoli'])?$polirujukan['kdPoli']:'').' '.tampiltanggal($sep['tglRujukan'], 9):''; 
            return $res; 
        }
        // $rows = !empty($result->response)?$result->response:[];
        $rows = $rows_surkon = $rows_gagal = []; 
        if ($kategori=='gagal') {
            $rows_surkon = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->where('res_code', '!=', '200')->whereNull('deleted')->get();
        } else {
            $rows_surkon = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->whereNull('deleted')->get();
        }
        // $total = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->whereNull('deleted')->count();
        // $rows_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ['300', '301', '302', '303', '304', '305', '306'])->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->get(['no_reg', 'tgl_kontrol', 'kd_poli', 'tgl_masuk']);
        // $rows_pulang = DB::table('dbfile.lunas')->whereNull('deleted')->where('tanggal', $atanggal)->whereIn('kelas', ['300', '301', '302', '303', '304', '305', '306'])->get();
        $xrows_pulang = DB::table('rsiklaten.bgs_register')->whereRaw("status_pulang = 1 and (kd_bangsal is null or kd_bangsal is not null) and date(tgl_keluar) = '$atanggal'")->groupBy('no_reg')->get();
        $rows_pulang = [];
        if (!empty($xrows_pulang)) {
            foreach ($xrows_pulang as $xrow_pulang) {
                $xrow_pulang = (object) $xrow_pulang; 
                $xrow_pulang->bangsal = $xrow_pulang->kd_bangsal;
                if (in_array($xrow_pulang->asuransi, ['300', '301', '302', '303', '304', '305', '306'])) $rows_pulang[] = $xrow_pulang;
            }
        }
        
        $total_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ['300', '301', '302', '303', '304', '305', '306'])->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->count();
        $rows_surat_kontrol = DB::table('bpjs.surat_kontrol')->whereNull('deleted')->where('jnsPelayanan', '=', 'Rawat Inap')->whereRaw("tglRencanaKontrol BETWEEN '$atanggal' AND DATE_ADD('$atanggal', INTERVAL 1 MONTH)")->get();
        // if (ipclient()==IPC) {
            if (!empty($rows_pulang)) {
                $no_urut = 1; 
                foreach ($rows_pulang as $row) {
                    $row = (object) $row; 
                    $row->nama = getNama($row->no_reg);
                    $row->tanggal = '';
                    $row->strTanggal = '';
                    $row->noka = getNoka($row->no_reg);
                    $row->kdpoli = $row->bangsal;
                    $row->strSEP = '';
                    $row->namadokter = '';
                    $row->ket = '';
                    if (!empty($rows_surat_kontrol)) {
                        foreach ($rows_surat_kontrol as $row_surat_kontrol) {
                            $row_surat_kontrol = (object) $row_surat_kontrol;
                            if ($row->noka==$row_surat_kontrol->noKartu) {
                                $row->ket = $row_surat_kontrol->noSuratKontrol;
                                $row->tanggal = date("d/m/Y", strtotime($row_surat_kontrol->tglRencanaKontrol));
                                $row->strTanggal = date("d-m-Y", strtotime($row_surat_kontrol->tglRencanaKontrol));
                                $row->kdpoli = $row_surat_kontrol->poliTujuan;
                                $row->namadokter = $row_surat_kontrol->namaDokter;
                            } 
                        }
                    }
                    $row->no = $no_urut;
                    $row->rm = $row->no_reg;
                    // if (substr($row->res_message, 0, 8) != '1123R001') $total_gagal++; 
                    // if (substr($row->res_message, 0, 8) != '1123R001') $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$row->res_message;
                    // foreach ($rows_surkon as $row_surkon) {
                    //     $row_surkon = (object) $row_surkon;
                    //     if (!empty($row->no_reg) && !empty($row->tgl_kontrol) && $row->no_reg == $row_surkon->no_reg && $row->tgl_kontrol == $row_surkon->tglRencanaKontrol) {
                    //         $row->tanggal = date("d/m/Y", strtotime($row_surkon->tglRencanaKontrol));
                    //         $row->strTanggal = date("d-m-Y", strtotime($row_surkon->tglRencanaKontrol));
                    //         $row->kdpoli = $row_surkon->poliKontrol;
                    //         $row->strSEP = getSEP($row_surkon->noSEP);
                    //         $row->namadokter = getDokter($row_surkon->kodeDokter);
                    //         $row->noka = getNoka($row_surkon->no_reg);
                    //         $row->ket = $row_surkon->res_message;
                    //         if (substr($row_surkon->res_message, 0, 8) != '1123R001') {
                    //             foreach ($rows_surat_kontrol as $row_surat_kontrol) {
                    //                 $row_surat_kontrol = (object) $row_surat_kontrol;
                    //                 if ($row->noka==$row_surat_kontrol->noKartu && $row->tgl_masuk==$row_surat_kontrol->tglTerbitKontrol && in_array($row_surat_kontrol->jnsPelayanan, ['Rawat Jalan'])) {
                    //                     $row->ket = $row_surat_kontrol->noSuratKontrol;
                    //                 } 
                    //             }
                    //             if (substr($row->ket, 0, 8) != '1123R001') { 
                    //                 $total_gagal++; 
                    //                 $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$row_surkon->res_message;
                    //             }
                    //         }
                    //     }
                    // }
                    if (substr($row->ket, 0, 8) != '1123R001') $rows_gagal[] = $row;
                    if (substr($row->ket, 0, 8) != '1123R001') $total_gagal++; 
                    $no_urut ++;
                    $rows[] = $row;
                }
            }
        // } else {
        //     if (!empty($rows_surkon)) {
        //         $no_urut = 1; 
        //         foreach ($rows_surkon as $row) {
        //             $row = (object) $row; 
        //             $row->nama = getNama($row->no_reg);
        //             $row->tanggal = date("d/m/Y", strtotime($row->tglRencanaKontrol));
        //             $row->strTanggal = date("d-m-Y", strtotime($row->tglRencanaKontrol));
        //             $row->no = $no_urut;
        //             $row->kdpoli = $row->poliKontrol;
        //             $row->strSEP = getSEP($row->noSEP);
        //             $row->namadokter = getDokter($row->kodeDokter);
        //             $row->noka = getNoka($row->no_reg);
        //             $row->rm = $row->no_reg;
        //             $row->ket = $row->res_message;
        //             if (substr($row->res_message, 0, 8) != '1123R001') $total_gagal++; 
        //             if (substr($row->res_message, 0, 8) != '1123R001') $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$row->res_message;
        //             $no_urut ++;
        //             $rows[] = $row;
        //         }
        //     }

        // }
        $rows = $kategori=="gagal"?$rows_gagal:$rows;
        $total = count($rows_pulang);
        $grand_total = $kategori=="gagal"?count($rows_gagal):count($rows_pulang);
    
        $data = [
            "rows" => $rows, 
            "rows_gagal" => $rows_gagal, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => [
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ], 
            "grand_total" => $grand_total." Pasien",
            "total_surat" => $total,
            "total_skdp" => $total_skdp,
            "total_spri" => $total_spri,
            "total_terbit" => $total_terbit,
            "total_gagal" => $total_gagal,
            "strtgl" => $strtgl,
        ];
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));