<?php 
    $warning_sama = false;
    if (isset($_SERVER['HTTP_REFERER']) && isset($no_reg)) { 
        $nama = $pasien->nama;
        $frame_source = null; 
        $exp_referer = explode("main/", $_SERVER['HTTP_REFERER']); 
        if (!empty($exp_referer[1])) $frame_source = $exp_referer[1]; 
        $rows_kjg_mirip = (array) null; 
        switch ($frame_source) {
            case 'askep_poli_inap' :
            case 'screening_poli_dev' :
            case 'askep_inap_awal_hemodialisa' :
            case 'resume_medis_hd' :
            case 'operasi_edit' :
                $kd_poli = ''; 
                $row_kunjung = DB::table('rsiklaten.kunjung as a')->where('a.no_reg', $no_reg)->where('a.tanggal', $tgl_masuk)->whereNotNull('a.kd_dr')->whereNotNull('a.kd_poli')->first(array('a.kd_poli'));
                if (!empty($row_kunjung)) {
                    $row_kunjung = (object) $row_kunjung; 
                    $kd_poli = $row_kunjung->kd_poli;
                }
                $rows_kjg_mirip = DB::table('rsiklaten.kunjung as a')->leftJoin('rsiklaten.pasien as b', function($join){
                    $join->on('a.no_reg', '=', 'b.no_reg');
                })
                ->where('a.tanggal', $tgl_masuk)
                ->whereIn('a.kd_poli', array($kd_poli))
                ->whereRaw('a.kd_dr IS NOT NULL')
                ->where('a.deletedstate', 0) 
                ->get(array('b.nama', 'a.no_reg'));
                $arr_nama = explode(" ", $nama); 
                foreach ($arr_nama as $key=>$nama_mirip) {
                    if (strlen($nama_mirip) > 2) {
                        foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                            $row_kjg_mirip = (object) $row_kjg_mirip;
                            $arr_row_kjg_mirip = explode(" ", $row_kjg_mirip->nama);
                            foreach ($arr_row_kjg_mirip as $key=>$nama_kjg_mirip) {
                                if (strlen($nama_kjg_mirip) > 2) {
                                    $percent = 0;
                                    similar_text($nama_kjg_mirip, $nama_mirip, $percent);
                                    if ($percent >= 85 && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            }
                        }
                    } 
                } 
                break; 
            case 'soap_gd' :
            case 'askep_gd' :
            case 'pengkajian_keperawatan_gd' :
            case 'askep_gd_dev' :
                $rows_kjg_mirip = DB::table('rsiklaten.kunjung as a')->leftJoin('rsiklaten.pasien as b', function($join){
                    $join->on('a.no_reg', '=', 'b.no_reg');
                })
                ->where('a.tanggal', $tgl_masuk)
                ->whereIn('a.kd_poli', array('UGD', 'PNEK'))
                ->whereRaw('a.kd_dr IS NOT NULL')
                ->where('a.deletedstate', 0) 
                ->get(array('b.nama', 'a.no_reg'));
                $arr_nama = explode(" ", $nama); 
                foreach ($arr_nama as $key=>$nama_mirip) {
                    if (strlen($nama_mirip) > 2) {
                        foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                            $row_kjg_mirip = (object) $row_kjg_mirip;
                            $arr_row_kjg_mirip = explode(" ", $row_kjg_mirip->nama);
                            foreach ($arr_row_kjg_mirip as $key=>$nama_kjg_mirip) {
                                if (strlen($nama_kjg_mirip) > 2) {
                                    $percent = 0;
                                    similar_text($nama_kjg_mirip, $nama_mirip, $percent);
                                    if ($percent >= 85 && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            }
                        }
                    } 
                } 
                break; 
            case 'askep_inap_awal' :
            case 'pengkajian_awal_keperawatan_inap' :
            case 'askep_inap_summary' :
            case 'cppt_inap' :
            // case 'dokumen' :
            case 'askep_inap' :
            case 'soap_inap' :
            case 'soap_inap_summary' :
                $induk = ''; 
                $row_ranap_inap = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                    $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                })
                ->where('no_reg', $no_reg)->first(array('a.nama', 'a.no_reg', 'b.induk'));
                if (!empty($row_ranap_inap)) {
                    $row_ranap_inap = (object) $row_ranap_inap; 
                    $induk = $row_ranap_inap->induk;
                }
                $rows_kjg_mirip = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                    $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                }) 
                ->where('b.induk', $induk)
                ->get(array('a.nama', 'a.no_reg', 'b.induk'));
                $arr_nama = explode(" ", $nama); 
                foreach ($arr_nama as $key=>$nama_mirip) {
                    if (strlen($nama_mirip) > 2) {
                        foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                            $row_kjg_mirip = (object) $row_kjg_mirip;
                            $arr_row_kjg_mirip = explode(" ", $row_kjg_mirip->nama);
                            foreach ($arr_row_kjg_mirip as $key=>$nama_kjg_mirip) {
                                if (strlen($nama_kjg_mirip) > 2) {
                                    $percent = 0;
                                    similar_text($nama_kjg_mirip, $nama_mirip, $percent);
                                    if ($percent >= 85 && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            }
                        }
                    } 
                } 
                break; 
            case 'operasi_signin' :
            case 'operasi_timeout' :
            case 'operasi_signout' :
            case 'operasi_edit' :
            case 'checklist_serah_terima' :
                $rows_kjg_mirip = DB::table('ranap.bon_op as a')
                ->where('a.tanggal', $tgl_masuk)
                ->get(['a.nama', 'a.no_reg']);
                $arr_nama = explode(" ", $nama); 
                foreach ($arr_nama as $key=>$nama_mirip) {
                    if (strlen($nama_mirip) > 2) {
                        foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                            $row_kjg_mirip = (object) $row_kjg_mirip;
                            $arr_row_kjg_mirip = explode(" ", $row_kjg_mirip->nama);
                            foreach ($arr_row_kjg_mirip as $key=>$nama_kjg_mirip) {
                                if (strlen($nama_kjg_mirip) > 2) {
                                    $percent = 0;
                                    similar_text($nama_kjg_mirip, $nama_mirip, $percent);
                                    if ($percent >= 85 && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            }
                        }
                    } 
                } 
                break; 
            case 'operasi_signins' :
                $induk = ''; 
                $row_ranap_inap = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                    $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                })
                ->where('no_reg', $no_reg)->first(array('a.nama', 'a.no_reg', 'b.induk'));
                if (!empty($row_ranap_inap)) {
                    $row_ranap_inap = (object) $row_ranap_inap; 
                    $induk = $row_ranap_inap->induk;
                }
                $rows_kjg_mirip = DB::table('ranap.inap as a')->leftJoin('rme.bangsal as b', function($join){
                    $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
                }) 
                ->where('b.induk', $induk)
                ->get(array('a.nama', 'a.no_reg', 'b.induk'));
                $arr_nama = explode(" ", $nama); 
                foreach ($arr_nama as $key=>$nama_mirip) {
                    if (strlen($nama_mirip) > 2) {
                        foreach ($rows_kjg_mirip as $row_kjg_mirip) {
                            $row_kjg_mirip = (object) $row_kjg_mirip;
                            $arr_row_kjg_mirip = explode(" ", $row_kjg_mirip->nama);
                            foreach ($arr_row_kjg_mirip as $key=>$nama_kjg_mirip) {
                                if (strlen($nama_kjg_mirip) > 2) {
                                    $percent = 0;
                                    similar_text($nama_kjg_mirip, $nama_mirip, $percent);
                                    if ($percent >= 85 && $row_kjg_mirip->no_reg != $no_reg) {
                                        $warning_sama = true;
                                        break; 
                                    }
                                }
                            }
                        }
                    } 
                } 
                break; 
        }
    }