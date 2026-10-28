<?php 

        $this->load->model('Kunjung');
        $this->load->helper('bpjs_bridge');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $strtgl = $kategori=='kontrol'?'Tgl Terbit':'Tgl Kontrol';
        // $kategori = $kategori=='kontrol'?2:1;
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $total_spri = $total_skdp = $total_terbit = $total_poli = $total_unclaim = $total_gagal = $total_belum = 0;
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
        $total_kunjung = 0; 
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
        // if (ipclient()==IPC) {
        //     $this->load->model('Kunjung_hd');
        //     $tanggal = $atanggal; 
        //     $poli = 'HD'; 
        //     $kd_dr = '';
        //     $pasien = Kunjung_hd::select(
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.id), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as soap_id"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.deleted), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.dokter_id = a.kd_dr and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as deleted"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.writer), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as writer"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.approve), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as approve"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.no_trx_resep_hd), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as no_trx_resep_hd"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.pendamping_internal), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as pendamping_internal"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.tinlan), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as tinlan"),
        //     DB::raw("(select SUBSTRING_INDEX(group_concat(rme.soap_hd.paket_ppsoap), ',', -1) 
        //         from 
        //         rme.soap_hd where rme.soap_hd.no_reg = a.no_reg and 
        //         rme.soap_hd.poli_id = a.kd_poli and 
        //         rme.soap_hd.tgl_masuk = a.tanggal and 
        //         TIME_FORMAT(rme.soap_hd.jam_masuk, '%H:%i') = TIME_FORMAT(a.jam, '%H:%i')) as paket_ppsoap"),
        //     'a.no_reg',
        //     'a.tanggal',
        //     'a.jam',
        //     'a.registered',
        //     'a.status_hd',
        //     'rsiklaten.pasien.nama',
        //     'a.pasien as asuransi_id',
        //     'rsiklaten.asuransi.NAMA as asuransi',
        //     'rsiklaten.pasien.tgl_lahir',
        //     'rsiklaten.antri2.daftar as antrian',
        //     'rsiklaten.pasien.telp',
        //     'rme.askep_hd.writed as writed_askep_hd',
        //     'rme.skrining_poli.writed as writed_skrining',
        //     'rme.skrining_poli.bb as bb',
        //     'rme.skrining_poli.tb as tb',
        //     'rme.skrining_poli.s as s',
        //     'rme.skrining_poli.rr as rr',
        //     'rme.skrining_poli.n as n',
        //     'rme.skrining_poli.gds as gds',
        //     'rme.skrining_poli.td1 as td1',
        //     'rme.skrining_poli.td2 as td2',
        //     'rme.skrining_poli.oksigen as oksigen',
        //     'rme.skrining_poli.e as e',
        //     'rme.skrining_poli.v as v',
        //     'rme.skrining_poli.m as m',
        //     'rme.skrining_poli.imt as imt',
        //     'rme.skrining_poli.status_gizi as status_gizi'
        //     /*'bpjs.sep2.tglRujukan as tgl_rujukan'*/
        // )
        // ->from(DB::raw("(select * from kunjung_hd where tanggal = '$tanggal' and kd_poli = '$poli'  and antrian <> '' and deletedstate = '0' order by id desc) a"))
        // ->leftJoin('rsiklaten.antri2', function ($join) use ($poli, $kd_dr, $tanggal) {
        //     $join->on('rsiklaten.antri2.t_periksa', '=', 'a.tanggal')
        //         ->on('rsiklaten.antri2.poli', '=', 'a.kd_poli');
        //     // if ($kd_dr) {
        //     //     $join->on('rsiklaten.antri2.kd_dr', '=', 'a.kd_dr');
        //     // }
        //     $join->on('rsiklaten.antri2.no_reg', '=', 'a.no_reg')
        //         ->where('rsiklaten.antri2.deletedstate', '=', DB::raw("'0'"));
        // })
        // ->leftJoin('rme.askep_hd', function ($join) use ($tanggal, $poli, $kd_dr) {
        //     $join->on('rme.askep_hd.no_reg', '=', 'a.no_reg')
        //          ->on('rme.askep_hd.tgl_masuk', '=', 'a.tanggal')
        //          ->on(DB::raw("TIME_FORMAT(rme.askep_hd.jam_masuk, '%H:%i')"), '=', DB::raw("TIME_FORMAT(a.jam, '%H:%i')"));
        // })
        // ->leftJoin('rme.skrining_poli', function ($join) use ($tanggal, $poli, $kd_dr) {
        //     $join->on('rme.skrining_poli.no_reg', '=', 'a.no_reg')
        //          ->on('rme.skrining_poli.tgl_masuk', '=', 'a.tanggal')
        //          ->on(DB::raw("TIME_FORMAT(rme.skrining_poli.jam_masuk, '%H:%i')"), '=', DB::raw("TIME_FORMAT(a.jam, '%H:%i')"));
        // })
        // ->join('rsiklaten.pasien', 'a.no_reg', '=', 'rsiklaten.pasien.no_reg')
        // ->join('rsiklaten.asuransi', 'a.pasien', '=', 'rsiklaten.asuransi.no_rel')
        // /*->join('bpjs.sep2','a.no_reg','=','bpjs.sep2.noMr')*/
        // /*start tgl : 08/06/2024*/
        // ->whereNotNull('rme.skrining_poli.writed')
        // /*end tgl : 08/06/2024*/

        // ->whereRaw("CONCAT(rsiklaten.pasien.no_reg,rsiklaten.pasien.nama) like '%$search%'")
        // /*->orderBy('bpjs.sep2.id', 'desc')*/
        // /*->orderBy(DB::raw('concat(substring(rsiklaten.antri2.daftar, 1, 1), substring(rsiklaten.antri2.daftar, 3, 3))'), 'asc')*/
        // ->groupBy(['a.no_reg', 'a.kd_poli', 'a.kd_dr', 'a.jam'])
        // ->get();
        // json($pasien);
        // }
        function getNama($no_reg) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nama']);
            $res = !empty($pasien['nama'])?$pasien['nama']:''; 
            return $res; 
        }
        function getNoka($no_reg) {
            $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(['nopeserta']);
            $res = !empty($pasien['nopeserta'])?$pasien['nopeserta']:''; 
            if ($res == '') {
                $sep2 = DB::table('bpjs.sep2')->where('noMr', $no_reg)->orderBy('id', 'desc')->first(['noKartu']);
                $res = !empty($sep2['noKartu'])?$sep2['noKartu']:''; 
            }
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
        function getSEPDate($tglSEP, $noMr) {
            // $sep = DB::table('bpjs.sep2')->where('tglSEP', $tglSEP)->where('noMr', $noMr)->first();
            // $res = !empty($sep['noSEP'])
        }
        // $rows = !empty($result->response)?$result->response:[];
        $rows = $rows_surkon = $rows_gagal = $rows_belum = $rows_debug = []; 
        if ($kategori=='gagal') {
            $rows_surkon = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->where('res_code', '!=', '200')->whereNull('deleted')->get();
        } else {
            $rows_surkon = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->whereNull('deleted')->get();
        }
        $akses = self::akses_menu();
        $unit = $akses->unit->nama ?? null;
        $tgl_kontrol_hd = date("Y-m-d", strtotime("+ 3 day"));
        $arr_gagal = [];
        $arr_belum = [];
        $arr_no_reg = [];
        $arr_asuransi = [];
        $arr_skrining = [];
        // $total = DB::table('bpjs.surat_kontrol_req')->where('tanggal', $atanggal)->whereNull('deleted')->count();
		
        // $rows_soap = !empty($unit) && $unit == "HD" ? DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ['300', '301', '302', '303', '304', '305', '306'])->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', DB::RAW("'$tgl_kontrol_hd' as tgl_kontrol"), DB::RAW("poli_id as kd_poli"), 'tgl_masuk']) : DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ['300', '301', '302', '303', '304', '305', '306'])->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', 'tgl_kontrol', 'kd_poli', 'tgl_masuk']);
        // $total_soap = !empty($unit) && $unit == "HD" ? DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ['300', '301', '302', '303', '304', '305', '306'])->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->count() : DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ['300', '301', '302', '303', '304', '305', '306'])->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->count();
        
        $arr_dokter = array_column(DB::select("select no_dr, concat(kode_nama, '-', no_dr) as dr from rsiklaten.dokter where nama2 != ''"), 'dr', 'no_dr');


        if (in_array($unit, ['HD'])) {
            $rows_kunjung = DB::select("select id, no_reg, pasien from rsiklaten.kunjung use index (tanggal) where tanggal = '$atanggal' and deleted is null and kd_poli = 'HD' group by no_reg, tanggal");
            $arr_no_reg = array_column($rows_kunjung, 'no_reg');
            $arr_asuransi = array_column($rows_kunjung, 'pasien', 'no_reg');
            $total_kunjung = count($rows_kunjung);
            $rows_skrining = DB::select("select id, no_reg, poli_id from rme.skrining_poli use index (tgl_masuk) where tgl_masuk = '$atanggal' and deleted is null and poli_id = 'HD' group by no_reg");
            $arr_skrining = array_column($rows_skrining, 'no_reg');
            // $arr_asuransi = array_column($rows_skrining, 'pasien', 'no_reg');
            $rows_soap = DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ARR_KODE_BPJS)->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', DB::RAW("'$tgl_kontrol_hd' as tgl_kontrol"), DB::RAW("poli_id as kd_poli"), DB::RAW("dokter_id as kd_dr"), 'tgl_masuk']);
            $total_soap = DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ARR_KODE_BPJS)->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->count();
        } else {
            // if (ipclient()==IPC) {
            //     $rows_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('no_reg', ['0283640'])->whereIn('kd_asuransi', ARR_KODE_BPJS)->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', 'tgl_kontrol', 'kd_poli', 'tgl_masuk']);
            //     $total_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('no_reg', ['0283640'])->whereIn('kd_asuransi', ARR_KODE_BPJS)->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->count();
            // } else {            
                $rows_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ARR_KODE_BPJS)->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', 'tgl_kontrol', 'kd_poli', 'kd_dr', 'tgl_masuk']);
                $total_soap = DB::table('rme.soap')->where('tgl_masuk', $atanggal)->whereIn('kd_asuransi', ARR_KODE_BPJS)->where('tgl_kontrol', '!=', '')->whereNotIn('kd_poli', ['F001', 'F002', 'F003'])->count();
            // }
        }

        if (in_array($unit, ['ASURANSI', 'EDP'])) {
            $rows_soap_hd = DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ARR_KODE_BPJS)->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->orderBy('writed', 'asc')->get(['no_reg', DB::RAW("'$tgl_kontrol_hd' as tgl_kontrol"), DB::RAW("poli_id as kd_poli"), DB::RAW("dokter_id as kd_dr"), 'tgl_masuk']);
            $total_soap_hd = DB::table('rme.soap_hd')->where('tgl_masuk', $atanggal)->whereIn('asuransi_id', ARR_KODE_BPJS)->whereNotIn('poli_id', ['F001', 'F002', 'F003'])->count();
            $rows_soap = array_merge($rows_soap, $rows_soap_hd);
            $total_soap += $total_soap_hd;
        }
        
        $rows_surat_kontrol = DB::table('bpjs.surat_kontrol')->whereNull('deleted')->where('noKartu', '!=', '')->where('tglTerbitKontrol', $atanggal)->get();
        // if (ipclient()==IPC) json($rows_soap);
        // json($rows_soap);
        // if (ipclient()==IPC) {
        // if (ipclient()==IPC) json($rows_soap);
            if (!empty($rows_soap)) {
                $no_urut = 1; 
                foreach ($rows_soap as $row) {
                    $row = (object) $row; 
                    if (($key = array_search($row->no_reg, $arr_no_reg)) !== false) {
                        unset($arr_no_reg[$key]);
                    }

                    $row->nama = getNama($row->no_reg);
                    if (ipclient()=="172.16.18.210") $row->nama = asteriskNama($row->nama);
                    $row->tanggal = !empty($row->tgl_kontrol)?date("d/m/Y", strtotime($row->tgl_kontrol)):'';
                    $row->strTanggal = !empty($row->tgl_kontrol)?date("d-m-Y", strtotime($row->tgl_kontrol)):'';
                    $row->no = $no_urut;
                    $row->kdpoli = $row->kd_poli;
                    $row->strSEP = '';
                    $row->noSEP = '';
                    $row->namadokter = '';
                    $row->noka = getNoka($row->no_reg);
                    $row->rm = $row->no_reg;
                    $row->ket = '';
                    // if (substr($row->res_message, 0, 8) != '1123R001') $total_gagal++; 
                    // if (substr($row->res_message, 0, 8) != '1123R001') $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$row->res_message;
                    foreach ($rows_surkon as $row_surkon) {
                        $row_surkon = (object) $row_surkon;
                        // if ($row_surkon->no_reg == '0392374') $rows_debug[] = $row_surkon;
                        if (!empty($row->no_reg) && !empty($row->tgl_kontrol) && $row->no_reg == $row_surkon->no_reg) {
                            $row->tanggal = date("d/m/Y", strtotime($row_surkon->tglRencanaKontrol));
                            $row->strTanggal = date("d-m-Y", strtotime($row_surkon->tglRencanaKontrol));
                            $row->kdpoli = $row_surkon->poliKontrol;
                            $row->strSEP = getSEP($row_surkon->noSEP);                            
                            $row->noSEP = $row_surkon->noSEP;
                            $row->namadokter = getDokter($row_surkon->kodeDokter);
                            $row->noka = getNoka($row_surkon->no_reg);
                            $row->ket = $row_surkon->res_message;
                            if (substr($row_surkon->res_message, 0, 8) != '1123R001' && substr($row->ket, 0, 8) != '') {
                                foreach ($rows_surat_kontrol as $row_surat_kontrol) {
                                    $row_surat_kontrol = (object) $row_surat_kontrol;
                                    if ($row->noka==$row_surat_kontrol->noKartu && $row->tgl_masuk==$row_surat_kontrol->tglTerbitKontrol && in_array($row_surat_kontrol->jnsPelayanan, ['Rawat Jalan'])) {
                                        array_diff($arr_gagal, [$row->noka]);
                                        $row->ket = $row_surat_kontrol->noSuratKontrol;
                                    } 
                                }
                                if (substr($row->ket, 0, 8) != '1123R001' && substr($row->ket, 0, 8) != '') { 
                                    $total_gagal++; 
                                    if (!in_array($row->noka, $arr_gagal)) $arr_gagal[] = $row->noka;
                                    $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$row_surkon->res_message;
                                }
                            }
                        } else {
                            // array_diff($arr_belum, [$row->noka]);
                        }
                    }
                    if (substr($row->ket, 0, 8) != '1123R001' && substr($row->ket, 0, 8) != '') $rows_gagal[] = $row;
                    if (substr($row->ket, 0, 8) != '1123R001' && substr($row->ket, 0, 8) == '') $rows_belum[] = $row;
                    if ($row->ket==''&&$kategori!='gagal') {                                                                                                                                                                                                                                 
                        $row->namadokter = $arr_dokter[$row->kd_dr]??'';
                        $total_belum++; 
                        if (!in_array($row->noka, $arr_belum)&&!in_array($row->noka, $arr_gagal)) $arr_belum[] = $row->noka;
                        // $row->ket = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ';
                    }
                    $no_urut ++;
                    $rows[] = $row;
                    // if ($row->no_reg == '0392374') $rows_debug[] = $row;
                    
                }
            }
            // if (ipclient()==IPC) json($rows);
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
        $arr_rm_gagal = [];
        if (!empty($arr_no_reg)) {
            foreach ($arr_no_reg as $key => $value) {
                $arr_rm_gagal[] = (object) [
                    "no_reg" => $value, 
                    "kd_asuransi" => $arr_asuransi[$value] ?? "",
                    "skrining" => $arr_skrining[$value] ?? "Belum skrining",
                ];
            }
        }
        $rows = $kategori=="gagal"?$rows_gagal:($kategori=="belum"?$rows_belum:$rows);
        $total = count($rows_soap);
        $grand_total = $kategori=="gagal"?count($rows_gagal):($kategori=="belum"?count($rows_belum):count($rows_soap));
    
        $data = [
            "rows" => $rows, 
            "rows_gagal" => $rows_gagal, 
            "rows_belum" => $rows_belum, 
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
            "total_admisi" => $total_kunjung,
            "total_gagal" => count($arr_gagal),
            "total_belum" => count($arr_belum),
            "strtgl" => $strtgl,
            "arr_gagal" => $arr_gagal,
            "arr_belum" => $arr_belum,
            "arr_not_rme" => $arr_rm_gagal,
            "total_not_rme" => count($arr_rm_gagal),
        ];
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));