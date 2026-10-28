<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
$reload_eklaim = false; 
switch ((string) segment(6)) {
    case 'PRINT' : 
    case 'print' : 
        $pdf_type = "F";
        $lp_print = true;
        break; 
    case 'FILE' : 
        $pdf_type = "F";
        $lp_print = false;
        break; 
    case 'FILECLIENT' : 
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break; 
    case 'PRINTSERVER' : 
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break; 
    case 'reload-eklaim' :
        $reload_eklaim = true; 
        break; 
}

function cek_array_in_string($str = null, $arr = null) {
    if (!empty($arr) && !empty($str)) {
        foreach ($arr as $txt) {
            if (strpos($str, $txt) !== FALSE) { 
                return true;
            }
        }
    }
    return false;
}
    
        $no_reg = segment(4);
        $tgl_rs = null;
        $no_sep = segment(5);
        $tgl_masuk = null; 
        $jam_masuk = null;
        $kd_poli = null; 

        $pdf_nota = "";
        /** GET NO SEP */
        $sep = DB::table('bpjs.sep2')->where('noMr', $no_reg)->where('noSEP', $no_sep)->orderBy('id', 'desc')->first();
        
        $no_sep = $no_reg;
        $rawat = []; 
        $rawat = ["J", "G"]; 
        // if ($no_reg == '0212742') $rawat = ["J"]; 
        $sep_kd_poli = null; 
        if (!empty($sep)) {
            $sep = (object) $sep; 
            $no_sep = $sep->noSEP; 
            $tgl_masuk = $sep->backDate!=''?$sep->backDate:$sep->tglSEP;

            switch ($sep->jnsPelayanan) {
                case 'R.Inap' :
                case 'Rawat Inap' :
                case 'Inap' :
                case 'INAP' :
                    $rawat = ["I", "G"]; 
                    break; 
            }
            if ($sep->kdPoli!='') $sep_kd_poli = $sep->kdPoli;
        }
        $ip = ipclient();
        $dir = FCPATH . "assets/rme/pdf/$ip/";
        $pdf_name = (array) null; 
        
        if (in_array("I", $rawat)) {
            $row_mutasi_ri = (object) DB::table('rsiklaten.mutasi_ri')->whereNull('deleted')->where('no_reg', $no_reg)->whereRaw("(tgl_masuk = '$tgl_masuk' or tgl_ri = '$tgl_masuk')")->orderBy('id', 'DESC')->first();
            $tgl_rs = !empty($row_mutasi_ri->tgl_masuk)&&!empty($row_mutasi_ri->jam_masuk)?str_replace(array("-", ":"), "", $row_mutasi_ri->tgl_masuk.$row_mutasi_ri->jam_masuk):str_replace(array("-", ":"), "", $sep->tglSEP."00:00:00");
             /** Berkas Klaim Individual E-Klaim */
             if ($reload_eklaim===true) {
                DB::table('inacbg.claim_print')->where('nomor_sep', $no_sep)
                    ->update(
                        array(
                            'nomor_sep' => "XX".substr($no_sep, 2, strlen($no_sep))
                        )
                    );
            }

            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bpjs/pdf/klaim/'.$no_sep.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            $file = null;
            $file = file_get_contents($url);
            $file = json_decode($file);
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        $pdf_name[] = $file->pdf_name;
                    }
                }
            }
        }   
        $extra_hd_igd = 0; 
        $arr_diagnosa_hd_extra = [
            "Extracorporeal dialysis", 
            // "Dyspnoea", 
            "Chronic kidney disease",
            "Chronic kidney disease, stage 5",
            "Extracorporeal dialysis",
            "Chronic renal failure, unspecified",
            "Nausea and vomiting",
            "Unspecified renal failure"
        ];
        if (cek_array_in_string($sep->namaDiagnosa, $arr_diagnosa_hd_extra) === true && $sep->kdPoli == "IGD") {
            $extra_hd_igd = 1;
        } 
        
    
        /** SEP */
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/sep/'.$no_reg.'/'.$no_sep.'/FILECLIENT/'.$ip;
        $file = null;
        $file = file_get_contents($url);
        $file = json_decode($file);
        if (!empty($file->pdf)) {
            if (file_exists($file->pdf)) {
                if (!empty($file->pdf_name)) {
                    $pdf_name[] = $file->pdf_name;
                }
            }
        }
        /** CARI JAM KUNJUNG YANG ASURANSINYA BPJS :: KADANG PERIKSA UMUM DAN BPJS DI HARI YANG SAMA */
        if (!empty($sep->kdPoli)) {
            switch ($sep->kdPoli) {
                case 'IGD' : 
                    $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereIn('kd_poli', ['UGD', 'PNEK'])->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                    if (empty($rows_kunjung)) {
                        $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->whereRaw("DATE_ADD(tanggal, INTERVAL 1 DAY) >= '$tgl_masuk'")->whereIn('kd_poli', ['UGD', 'PNEK'])->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                    }
                    break; 
                case 'HDL' : 
                    $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereIn('kd_poli', ['HD'])->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                    break; 
                default : 
                    /*
                    if ($sep->kdPoli!='') {
                        $kd_poli_map = DB::table('bpjs.antreanrs_poli_map')->whereNull('deleted')->where('kdsubspesialis', $sep->kdPoli)->orderBy('id', 'desc')->first();
                        if (!empty($kd_poli_map)) {
                            $kd_poli_map = (object) $kd_poli_map; 
                            $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->where('kd_poli', $kd_poli_map->kode_poli)->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                        } else {
                            $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                        }
                    } else {
                        $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                    }
                    */
                    // if (ipclient()=='172.16.18.18') json($tgl_masuk);
                    $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
                    break; 
                    
            }
        }
        
        
        $kunjung = (object) null; 
        if (!empty($rows_kunjung)) {
            foreach ($rows_kunjung as $row_kunjung) {
                $row_kunjung = (object) $row_kunjung; 
                // if (ipclient()=='172.16.18.18') pre($row_kunjung->deletedstate);
                if ($row_kunjung->deletedstate==0 && in_array($row_kunjung->pasien, array('300', '301', '302', '303', '304', '305', '306'))) {
                    if (in_array($row_kunjung->rawat, $rawat)) {
                        $tgl_rs = str_replace(array("-", ":"), "", $row_kunjung->tanggal.$row_kunjung->jam);
                        $tgl_masuk = $row_kunjung->tanggal;
                        $jam_masuk = $row_kunjung->jam;
                        $kd_poli = $row_kunjung->kd_poli;
                        break; 
                    }
                }
            }
        }
        
        $row_mutasi_ri = null; 
        $tgl_keluar = null; 
        $tgl_ri = null;

        if (in_array("I", $rawat)) {
            $row_mutasi_ri = (object) DB::table('rsiklaten.mutasi_ri')->whereNull('deleted')->where('no_reg', $no_reg)->whereRaw("(tgl_masuk = '$tgl_masuk' or tgl_ri = '$tgl_masuk')")->orderBy('id', 'DESC')->first();

            $tgl_rs = !empty($row_mutasi_ri->tgl_masuk)&&!empty($row_mutasi_ri->jam_masuk)?str_replace(array("-", ":"), "", $row_mutasi_ri->tgl_masuk.$row_mutasi_ri->jam_masuk):str_replace(array("-", ":"), "", $sep->tglSEP."00:00:00");
            $tgl_masuk = !empty($row_mutasi_ri->tgl_masuk)?$row_mutasi_ri->tgl_masuk:$sep->tglSEP;
            $tgl_ri = !empty($row_mutasi_ri->tgl_ri)?$row_mutasi_ri->tgl_ri:$sep->tglSEP;
            
            $jam_masuk = !empty($row_mutasi_ri->jam_masuk)?$row_mutasi_ri->jam_masuk:'00:00:00'; 
            $dpjp = !empty($row_mutasi_ri->kd_dr_ri1)?$row_mutasi_ri->kd_dr_ri1:null; 
            $row_lunas = (object) DB::table('dbfile.lunas')->where('no_reg', $no_reg)->where('tanggal', '>=', $tgl_masuk)->whereNull('deleted')->orderBy('tanggal', 'ASC')->first();
            $tgl_keluar = !empty($row_lunas->tanggal)&&!empty($row_lunas->jam)?$row_lunas->tanggal." ".$row_lunas->jam:date("Y-m-d H:i:s");
            /** JIKA PASIEN RAWAT INAP TAMPILKAN SURAT PERINTAH MONDOK */

            $row_surat_mondok = DB::table('rme.surat_mondok')->where('no_reg', $no_reg)->where('tanggal', '>=', $tgl_masuk)->where('tanggal', '<=', $tgl_keluar)->orderBy('id', 'desc')->first();
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/mondok/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            $file = null;
            $file = file_get_contents($url);
            $file = json_decode($file);
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        $pdf_name[] = $file->pdf_name;
                    }
                }
            }
        }
        // if (ipclient()==IPC) json($rawat);
        if (in_array("J", $rawat)) {
            // $row_mutasi_ri = (object) DB::table('rsiklaten.mutasi_ri')->whereNull('deleted')->where('no_reg', $no_reg)->whereRaw("(tgl_masuk = '$tgl_masuk' or tgl_ri = '$tgl_masuk')")->orderBy('id', 'DESC')->first();
            // $tgl_rs = !empty($row_mutasi_ri->tgl_masuk)&&!empty($row_mutasi_ri->jam_masuk)?str_replace(array("-", ":"), "", $row_mutasi_ri->tgl_masuk.$row_mutasi_ri->jam_masuk):str_replace(array("-", ":"), "", $sep->tglSEP."00:00:00");
        //coba di naikan
             /** Berkas Klaim Individual E-Klaim */
            if ($reload_eklaim===true) {
                DB::table('inacbg.claim_print')->where('nomor_sep', $no_sep)
                    ->update(
                        array(
                            'nomor_sep' => "XX".substr($no_sep, 2, strlen($no_sep))
                        )
                    );
            }
            
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bpjs/pdf/klaim/'.$no_sep.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            $file = null;
            $file = file_get_contents($url);
            $file = json_decode($file);
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        $pdf_name[] = $file->pdf_name;
                    }
                }
            }
        } 
            
        if ($sep->kdPoli=="BTK" && $kd_poli=="UGD") $kd_poli = "";
        /** RINGKASAN PULANG */
        // if (ipclient()=="172.16.18.210") json($kd_poli);
        // if (ipclient()==IPC) json($kd_poli);
        if ($extra_hd_igd==1) $kd_poli='HD';
        
        if ($tgl_masuk >='2023-11-01'){
           
            // if (ipclient()=='172.16.18.210') json($url);
            switch ($kd_poli) {
                case 'UGD' : 
                case 'PNEK' : 
                    /** cek triase gd */
                    if (in_array("I", $rawat)) {
                        $triase = DB::table('rme.askep_gd_triase')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                        if (empty($triase))  $triase = DB::table('rme.askep_gd_triase')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                        $tgl_resume = !empty($triase['tgl_masuk'])?str_replace(["-", ":"], "", $triase['tgl_masuk'].$triase['jam_masuk']):$tgl_rs; 
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/triase_gd_all_x/'.$no_reg.'/'.$tgl_resume.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        // if (ipclient()=='172.16.18.168') 
                        // pre($file);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }     
                    }  
                    /** cek dulu di soap gd*/
                    if (in_array("J", $rawat)) {
                        $soap = DB::table('rme.soap_gd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                        // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                        // if (ipclient()=='172.16.18.21') pre($soap);
                        if (!empty($soap)) {
                            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_darurat/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                            $file = null;
                            $file = file_get_contents($url);
                            $file = json_decode($file);
                            if (!empty($file->pdf)) {
                                if (file_exists($file->pdf)) {
                                    if (!empty($file->pdf_name)) {
                                        $pdf_name[] = $file->pdf_name;
                                    }
                                }
                            }
                        }
                    }

                    
                    if (in_array("I", $rawat)) {
                        $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                        if (empty($soap))  $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                        $tgl_resume = !empty($soap['tgl_masuk'])?str_replace(["-", ":"], "", $soap['tgl_masuk'].$soap['jam_masuk']):$tgl_rs; 
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/resume_medis/'.$no_reg.'/'.$tgl_resume.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        // if (ipclient()=='172.16.18.168') pre($file);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        // if (ipclient()==IPC) json($url);
                        
                    }  

                    break; 
                case 'HD' : 
                    /** cek dulu di soap hd*/
                    $soap = DB::table('rme.soap_hd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                    // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                    // if (ipclient()=='172.16.18.210') pre($soap);
                    if (!empty($soap)) {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                    }
                    // if (ipclient()=='172.16.18.210') pre($url);

                    if (!empty($soap)) {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/asuhan_pasien_hemodialisis/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                    }
                    // if (ipclient()==IPC) json($soap);
                    // pre($file);
                    // pre($soap);
                    // pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                    break; 
                default : 
                    /** cek dulu di soap   */
                    $soap = null;
                    // if (ipclient()==IPC) json($rawat);
                    if (in_array("J", $rawat)) {
                        if ((string) $kd_poli != '') {
                            $soap = DB::table('rme.soap')
                                        ->where('no_reg', $no_reg)
                                        ->where('tgl_masuk', $tgl_masuk)
                                        ->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")
                                        ->where('kd_poli', $kd_poli)
                                        ->whereNull('deleted')
                                        ->orderBy('id', 'desc')
                                        ->first();
                        } else {
                            $soap = DB::table('rme.soap')
                                        ->where('no_reg', $no_reg)
                                        ->where('tgl_masuk', $tgl_masuk)
                                        ->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")
                                        ->whereNull('deleted')
                                        ->orderBy('id', 'desc')
                                        ->first();
                        }
                    }
                    
                    // if (ipclient()=='172.16.18.192') json($tgl_masuk);
                    if (!empty($soap)) {
                    // if (ipclient()=='172.16.18.192') json($tgl_rs);
                        
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_jalan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        // if (ipclient()=='172.16.18.18') json($url);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        
                    }
                    
                    // pre($url);
                    // if (ipclient()=='172.16.18.210') json($url);    
                    // if (ipclient()==IPC) {
                        // json ($kd_poli);
                        // if (ipclient()=='172.16.18.18') json($kd_poli);
                        if (empty($soap)&&(string)$kd_poli==""&&in_array("J", $rawat)) {
                            $soap = DB::table('rme.soap_gd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                            if (!empty($soap)) {
                            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_darurat/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                            $file = null;
                            $file = file_get_contents($url);
                            $file = json_decode($file);
                            if (!empty($file->pdf)) {
                                if (file_exists($file->pdf)) {
                                    if (!empty($file->pdf_name)) {
                                        $pdf_name[] = $file->pdf_name;
                                    }
                                }
                            }
                            $pdf_nota = "UGD";
                            }
                        }        // if (ipclient()=="172.16.18.210") json($pdf_name);

                    // }
                    if (in_array("I", $rawat)) {
                        $triase = DB::table('rme.askep_gd_triase')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                        if (empty($triase))  $triase = DB::table('rme.askep_gd_triase')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                        $tgl_resume = !empty($triase['tgl_masuk'])?str_replace(["-", ":"], "", $triase['tgl_masuk'].$triase['jam_masuk']):$tgl_rs; 
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/triase_gd_all_x/'.$no_reg.'/'.$tgl_resume.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        // if (ipclient()=='172.16.18.168') 
                        // pre($file);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }     
                    }  
                    if (in_array("I", $rawat)) {
                        $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                        if (empty($soap))  $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                        $tgl_resume = !empty($soap['tgl_masuk'])?str_replace(["-", ":"], "", $soap['tgl_masuk'].$soap['jam_masuk']):$tgl_rs; 
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/resume_medis/'.$no_reg.'/'.$tgl_resume.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        // if (ipclient()=='172.16.18.168') pre($file);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        // if (ipclient()==IPC) json($url);
                        
                    }  
                    // pre($pdf_name);
                        // if (ipclient()=="172.16.18.210") json($pdf_name);
                
                    // if (ipclient()=="172.16.18.56") json($file);
                    break; 
            }                   
        } else {
            switch ($kd_poli) {
                case 'UGD' : 
                case 'PNEK' : 
                    /** cek dulu di soap gd*/
                    $soap = DB::table('rme.soap_gd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                    // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                    // if (ipclient()=='172.16.18.21') pre($soap);
                    if (!empty($soap)) {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_darurat/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                    }
                    // break; 
                    // case 'HD' : 
                    //     /** cek dulu di soap gd*/
                    //     $soap = DB::table('rme.soap_hd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                    //     // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                    //     // if (ipclient()=='172.16.18.21') pre($soap);
                    //     if (!empty($soap)) {
                    //         $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                    //         $file = null;
                    //         $file = file_get_contents($url);
                    //         $file = json_decode($file);
                    //         if (!empty($file->pdf)) {
                    //             if (file_exists($file->pdf)) {
                    //                 if (!empty($file->pdf_name)) {
                    //                     $pdf_name[] = $file->pdf_name;
                    //                 }
                    //             }
                    //         }
                    //     }
                        // pre($url);
                        // pre($soap);
                        // pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                        break; 
                default : 
                    /** cek dulu di soap   */
                    if ((string) $kd_poli != '') {
                        $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->where('kd_poli', $kd_poli)->whereNull('deleted')->orderBy('id', 'desc')->first();
                    } else {
                        $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                    }
                    // if (ipclient()=='172.16.18.56') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                    // if (ipclient()=='172.16.18.21') pre($tgl_rs);
                   
                    if (!empty($soap)) {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_jalan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        // if (ipclient()=='172.16.18.18') json($url);
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }

                    }
                    if (empty($soap)&&$kd_poli=="") {
                        $soap = DB::table('rme.soap_gd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                        if (!empty($soap)) {
                            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_darurat/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                            $file = null;
                            $file = file_get_contents($url);
                            $file = json_decode($file);
                            if (!empty($file->pdf)) {
                                if (file_exists($file->pdf)) {
                                    if (!empty($file->pdf_name)) {
                                        $pdf_name[] = $file->pdf_name;
                                    }
                                }
                            }
                        }
                    }
                    break; 
            }
        }
        // if (ipclient()==IPC) pre($url);
             
               //lapo op
               if (in_array("I", $rawat)) {

                $row_mutasi_ri = null; 
                $row_mutasi_ri = DB::table('rsiklaten.mutasi_ri')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
                if (!empty($row_mutasi_ri)) {
                    $row_mutasi_ri = (object) $row_mutasi_ri;
                }
                $bgs_register = DB::table('rsiklaten.bgs_register as a')->where('a.no_reg', $no_reg)->where('a.tgl_daftar', $tgl_masuk)->whereNotNull('a.tgl_keluar')->selectRaw('a.tgl_keluar')->first(); 
                if (!empty($bgs_register)) {
                    $bgs_register = (object) $bgs_register;
                }
     
                $tanggal_mulai = !empty($row_mutasi_ri->tgl_masuk)?$row_mutasi_ri->tgl_masuk." ".$row_mutasi_ri->jam_masuk:null;
                $tanggal_selesai = !empty($bgs_register->tgl_keluar)?$bgs_register->tgl_keluar:null; 
                $rows_operasi = DB::table('rme.operasi')->where('no_reg', $no_reg)->whereNull('deleted')->whereBetween('start', [$tanggal_mulai, $tanggal_selesai])->get(['start']);
                // if (empty($rows_operasi)) {
                //     $rows_operasi = DB::table('rme.operasi')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->get();
                // }
                //  if (ipclient()=='172.16.18.18') pre($tanggal_selesai);
            //    if (ipclient()=="172.16.18.210") json($tanggal_mulai);
                if (!empty($rows_operasi)) {
                    foreach ($rows_operasi as $key=>$row_operasi) {
                    $row_operasi = (object) $row_operasi;
                    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/laporan_operasi_start/'.$no_reg.'/'.str_replace(["-", " ", ":"], "", $row_operasi->start).'/FILECLIENT/'.$ip;               
                    $file = null;
                    $file = file_get_contents($url);
                    $file = json_decode($file);
                   if (!empty($file->pdf)) {
                       if (file_exists($file->pdf)) {
                           if (!empty($file->pdf_name)) {
                               $pdf_name[] = $file->pdf_name;
                           }        
                       
                      } 
   
                   }
                }
               }
                // if (ipclient()=='172.16.18.89') pre($url);

            //    else{
            //     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/laporan_operasi/'.$no_reg.'/'.str_replace(["-", " ", ":"], "", $row_operasi->start).'/FILECLIENT/'.$ip;               
            //     $file = null;
            //     $file = file_get_contents($url);
            //     $file = json_decode($file);
            //    if (!empty($file->pdf)) {
            //        if (file_exists($file->pdf)) {
            //            if (!empty($file->pdf_name)) {
            //                $pdf_name[] = $file->pdf_name;
            //            }
            //        }
            //    }
            // }

            
           }                
        //    if (ipclient()=='172.16.18.56') pre($url);        
        
        /** cek surat pengantar fisioterapi */
        switch ($kd_poli) {
            case 'F001' : 
            case 'F002' : 
            case 'F003' :
            case 'RHMD' :
                /** get soap rhmed terakhir */
                // $surat_fisioterapi = DB::table('rme.surat_fisioterapi')->where('no_reg', $no_reg)->where('poli_id', 'RHMD')->whereRaw("tanggal <= '$tgl_masuk'")->orderBy('id', 'desc')->first();
                $surat_fisioterapi = DB::table('rme.soap')->where('no_reg', $no_reg)->where('kd_poli', 'RHMD')->whereRaw("tgl_masuk <= '$tgl_masuk'")->whereIN('kd_dr', ['S202','S563'])->orderBy('id', 'desc')->first();
                // if (ipclient()==IPC) json($surat_fisioterapi);
                if (!empty($surat_fisioterapi)) {
                    $surat_fisioterapi = (object) $surat_fisioterapi; 
                    $surat_fisioterapi->tanggal=$surat_fisioterapi->tgl_masuk;
                    
                    
                    if ($tgl_masuk >= '2025-11-01') {
                        // $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/formulir_rawat_jalan_kfr/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/formulir_rawat_jalan_kfr/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $tgl_masuk." 00:00:00").'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        // if (ipclient()==IPC) pre($url);
                        // if (ipclient()=='172.16.18.18') json($url);
                        // $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/lembar_pendampingan_sesi_rehab/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/lembar_pendampingan_sesi_rehab/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $tgl_masuk." 00:00:00").'/FILECLIENT/'.$ip;
                        // if (ipclient()=='172.16.18.18') json($url);
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/lembar_program_terapi/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'-'.str_replace(array("-", ":", " "), "", $tgl_masuk." 00:00:00").'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                    } else {
                        
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/lembar_hasil_tindakan_uji_fungsi/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/formulir_klaim_kedokteran_fisik_rehabilitasi/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
                        // $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/formulir_rawat_jalan_kfr/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }

                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/monitoring_kunjungan_pelayanan_rehabilitasi_medik/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'-'.str_replace(array("-", ":", " "), "", $tgl_masuk." 00:00:00").'/FILECLIENT/'.$ip;
                        $file = null;
                        // if (ipclient()=="172.16.18.17") json($url);
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                        
                    }
                }
                break; 
        }
        /** HASIL RADIOLOGI */
        // if (ipclient()==IPC) json($rawat);
        $hasil = null;
        if (in_array("J", $rawat)) {
            //permintaan mba ayu untuk poli bedah apabila ada SPM nya ambil pemeriksaan RO nya
            // if($kd_poli == 'B003'){
               
            if($sep_kd_poli != 'GND'&& $sep_kd_poli != 'KON'&& $sep_kd_poli != 'PTD'&& $sep_kd_poli != 'BDM'){
               
                $this->load->model('byl_billing_transaksi');
                //mencari billing ROnya
                $billing = Byl_billing_transaksi::join('master_tarip_ik_2026', 'master_tarip_ik_2026.no_perk', '=', 'transaksi.no_perk')->where('transaksi.no_reg', $no_reg)->where('transaksi.tanggal', $tgl_masuk)->where('transaksi.status_rawat', 'radiologi')->where('transaksi.deleted', '0')->get();
                // if($no_reg == '0633614'){
                //                 echo"<pre>";print_r($billing);die();
                //             }
                if(count($billing) > 0 && $no_reg != '0633614'){
                    foreach ($billing as $bill) {
                        $bill->na_perk = trim(preg_replace('/\s+/', ' ', $bill->na_perk));
                        $hasil  = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('periksa',$bill->na_perk)->orderBy('id', 'desc')->first();
                        if(count($hasil)> 0){
                            $hasilx = (object) $hasil;
                            // $tgl_ro = $hasilx->TANGGAL;
                            
                            // if (ipclient()==IPC) json($tgl_ro);  
                            if($bill->na_perk == 'JKN Vertebra 2 Posisi (L/S/C/Th)'){
                                $tgl_ro= $hasilx->TANGGAL;
                                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_ro.'/FILECLIENT/'.$ip;
                                
                            }else{
                                $tgl_ro = $hasilx->TANGGAL."/".rawurlencode($bill->na_perk);
                                $url    = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro_klaim/'.$no_reg.'/'.$tgl_ro.'/FILECLIENT/'.$ip;
                            }
                            // if($no_reg == '0417750'){
                            //     echo"<pre>";print_r($url);die();
                            // }
                            // if (ipclient()=='172.16.18.18') json($tgl_ro);
                            $file   = null;
                            $file   = file_get_contents($url);
                            $file   = json_decode($file);
                            // if ($no_reg == '0623675') {
                            //     echo"<pre>";print_r($file);die();
                            // }
                            // echo"<pre>";print_r($file);die();
                            
                            if (!empty($file->pdf)) {
                                if (file_exists($file->pdf)) {
                                    if (!empty($file->pdf_name)) {
                                        $pdf_name[] = $file->pdf_name;
                                    }
                                }
                            }
                        }
                       
                        // echo"<pre>";print_r($hasil);
                    }
                    //  if (ipclient()=='172.16.18.18'){
                    //         // die();
                    //     }
                }
                
                        // if (ipclient()==IPC) json($url);
                else{
                    $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
                    if (!empty($hasil)) {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                        $file = null;
                        $file = file_get_contents($url);
                        $file = json_decode($file);
                        if (!empty($file->pdf)) {
                            if (file_exists($file->pdf)) {
                                if (!empty($file->pdf_name)) {
                                    $pdf_name[] = $file->pdf_name;
                                }
                            }
                        }
                    }
                }
            //end permintaan
            }else{
                if ($sep_kd_poli == 'GND'|| $sep_kd_poli == 'KON'|| $sep_kd_poli == 'PTD'|| $sep_kd_poli == 'BDM') { 
                    $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->whereIN('periksa',['Gigi Biasa JKN','Panoramik JKN','JKN Panoramik','JKN Gigi Biasa'])->orderBy('id', 'desc')->first();
                    $hasilx = (object) $hasil;
                    $tgl_ro= $hasilx->TANGGAL;
                }
                else {
                    $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
                }
                
                if (empty($hasil)) {
                    $hasil   = DB::table('rme.ro_hasilrl')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
                }
               
                if (!empty($hasil)) {
                    if ($sep_kd_poli == 'GND'|| $sep_kd_poli == 'KON'|| $sep_kd_poli == 'PTD'|| $sep_kd_poli == 'BDM') { 
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_ro.'/FILECLIENT/'.$ip;
                    } else {
                        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                    }
                    // if (ipclient()==IPC) json($url);
                    $file = null;
                    $file = file_get_contents($url);
                    $file = json_decode($file);
                    if (!empty($file->pdf)) {
                        if (file_exists($file->pdf)) {
                            if (!empty($file->pdf_name)) {
                                $pdf_name[] = $file->pdf_name;
                            }
                        }
                    }
                }
            }

        } else {
            $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
            if (empty($hasil)) {
                $hasil   = DB::table('rme.ro_hasilri')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->first();
            }
            if (empty($hasil)) {
                $hasil   = DB::table('rme.ro_hasilrl')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
            }
            if (!empty($hasil)) {

                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                $file = null;
                $file = file_get_contents($url);
                $file = json_decode($file);
                if (!empty($file->pdf)) {
                    if (file_exists($file->pdf)) {
                        if (!empty($file->pdf_name)) {
                            $pdf_name[] = $file->pdf_name;
                        }
                    }
                }
            }
        }
        
        // LAPORAN TINDAKAN
        $lap_tindakan   = DB::table('rme.tindakan_laporan')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
        if (!empty($lap_tindakan)) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/laporan_tindakan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            $file = null;
            $file = file_get_contents($url);
            $file = json_decode($file);
            
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        $pdf_name[] = $file->pdf_name;
                    }
                }
            }
        }

        /** BERKAS KLAIM */
        /** cek dulu di surat_klaim   */
        /* DI TUTUP, INFORMASI DARI AYU ASURANSI SUDAH DIPERBOLEHKAN BPJS TIDAK PAKAI FORMULIR KLAIM 
            $klaim = DB::table('rme.surat_klaim')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->where('poli_id', $kd_poli)->orderBy('id', 'desc')->first();
            if (!empty($klaim)) {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/formulir_klaim/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                $file = null;
                $file = file_get_contents($url);
                $file = json_decode($file);
                if (!empty($file->pdf)) {
                    if (file_exists($file->pdf)) {
                        if (!empty($file->pdf_name)) {
                            $pdf_name[] = $file->pdf_name;
                        }
                    }
                }
            }
        */
            // if (ipclient()=='172.16.18.21') json($extra_hd_igd);
        /** Nota Rawat Jalan */
        if (in_array("J", $rawat)) {
            // $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (in_array($kd_poli, ['UGD', 'PNEK'])) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (in_array($kd_poli, ['HD']) || $extra_hd_igd==1 ) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (in_array($kd_poli, [''])&&$pdf_nota=="UGD") $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // // if (ipclient()==IPC) pre($url);
            //         // if (ipclient()==IPC) json($kd_poli);

            // $file = null;
            // $file = file_get_contents($url);
            // // if (ipclient()=='172.16.18.56')pre($url);
            // $file = json_decode($file);
            // if (!empty($file->pdf)) {
            //     if (file_exists($file->pdf)) {
            //         if (!empty($file->pdf_name)) {
            //             $pdf_name[] = $file->pdf_name;
            //         }
            //     }
            // }
            /** Nota Rawat Jalan */
            if ($tgl_masuk >='2025-04-23') {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rajal_newx/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                // if (in_array($kd_poli, ['UGD', 'PNEK'])) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                // if (in_array($kd_poli, ['HD']) || $extra_hd_igd==1 ) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                // if (in_array($kd_poli, [''])&&$pdf_nota=="UGD") $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                // if (ipclient()==IPC) pre($url);
                        // if (ipclient()==IPC) json($kd_poli);
                        
                $file = null;
                $file = file_get_contents($url);
                // if (ipclient()=='172.16.18.18') pre($url);
                $file = json_decode($file);
                if (!empty($file->pdf)) {
                    if (file_exists($file->pdf)) {
                        if (!empty($file->pdf_name)) {
                            $pdf_name[] = $file->pdf_name;
                        }
                    }
                }
        
            }
            // if (ipclient()=='172.16.18.56') 
            //     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rajal_newx/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            //     // if (in_array($kd_poli, ['UGD', 'PNEK'])) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            //     // if (in_array($kd_poli, ['HD']) || $extra_hd_igd==1 ) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            //     // if (in_array($kd_poli, [''])&&$pdf_nota=="UGD") $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            //     // if (ipclient()==IPC) pre($url);
            //             // if (ipclient()==IPC) json($kd_poli);
                        
            //     $file = null;
            //     $file = file_get_contents($url);
            //     // if (ipclient()=='172.16.18.56') pre($url);
            //     $file = json_decode($file);
            //     if (!empty($file->pdf)) {
            //         if (file_exists($file->pdf)) {
            //             if (!empty($file->pdf_name)) {
            //                 $pdf_name[] = $file->pdf_name;
            //             }
            //         }
            //     }
            
        }

        
        // if (ipclient()=='172.16.18.18') json($kd_poli);
        // if (ipclient()=='172.16.18.56') 
        // pre($tgl_masuk);
            // pre($rawat);
        
        
        // if (ipclient()==IPC) pre($url);
        //resep
        if (in_array("I", $rawat)) {
            // if (ipclient()==IPC) json($tgl_masuk);
            // if (ipclient()=='172.16.18.56') pre($tgl_masuk);
                 /** cek dulu di soap   */
                //  if ((string) $kd_poli != '') {
                //     $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->where('kd_poli', $kd_poli)->whereNull('deleted')->orderBy('id', 'desc')->first();
                // } else {
                    $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                    if (empty($soap)) $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                    if (empty($soap)) $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_ri)->whereNull('deleted')->orderBy('id', 'desc')->first();
                    $tgl_resep = !empty($soap['tgl_masuk'])?str_replace(["-", ":"], "", $soap['tgl_masuk'].$soap['jam_masuk']):$tgl_rs; 
            // if (ipclient()==IPC) json($soap);
                // }

                // if (ipclient()=='172.16.18.18') pre($tgl_masuk);
                if (!empty($soap)) {
                    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/resep_klaim_inap/'.$no_reg.'/'.$tgl_resep.'/FILECLIENT/'.$ip;
                    $file = null;
                    $file = file_get_contents($url);
                    $file = json_decode($file);
                    if (!empty($file->pdf)) {
                        if (file_exists($file->pdf)) {
                            if (!empty($file->pdf_name)) {
                                $pdf_name[] = $file->pdf_name;
                            }
                        }
                    }
                }
                // if (ipclient()=='10.10.102.252') pre($url);
            } 
            //resep gd
            // if (ipclient()=='172.16.18.18') pre($rawat);
        if (in_array("I", $rawat)) {
            // if (ipclient()==IPC) json($tgl_masuk);
            // if (ipclient()=='172.16.18.89') pre($tgl_masuk);
                 /** cek dulu di soap   */
                //  if ((string) $kd_poli != '') {
                //     $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->where('kd_poli', $kd_poli)->whereNull('deleted')->orderBy('id', 'desc')->first();
                // } else {
                    $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'desc')->first();
                    if (empty($soap))  $soap = DB::table('rme.soap_inap')->where('no_reg', $no_reg)->whereRaw("tgl_masuk = date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                    $tgl_resep = !empty($soap['tgl_masuk'])?str_replace(["-", ":"], "", $soap['tgl_masuk'].$soap['jam_masuk']):$tgl_rs; 
                // }
                // if (ipclient()=='172.16.18.18') pre($tgl_masuk);
                // if (ipclient()=='172.16.18.56') pre($tgl_masuk);
                if (!empty($soap)) {
                    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/resep_klaim_gd/'.$no_reg.'/'.$tgl_resep.'/FILECLIENT/'.$ip;
                    $file = null;
                    $file = file_get_contents($url);
                    $file = json_decode($file);
                    if (!empty($file->pdf)) {
                        if (file_exists($file->pdf)) {
                            if (!empty($file->pdf_name)) {
                                $pdf_name[] = $file->pdf_name;
                            }
                        }
                    }
                }
                // pre($rawat);
                // if (ipclient()=='172.16.18.89') pre($rawat);
                // if (ipclient()=='172.16.18.21') pre($url);
                #echo $ip;
                #die();
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_inap_simple/'.$no_reg.'/'.$tgl_masuk.'/FILECLIENT/'.$ip;
                // if ($no_reg =='0695247') pre($url);die();
                // if (ipclient()=='172.16.18.89') pre($url);
            // if (in_array($kd_poli, ['UGD', 'PNEK'])) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (in_array($kd_poli, ['HD']) || $extra_hd_igd==1 ) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (in_array($kd_poli, [''])&&$pdf_nota=="UGD") $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            // if (ipclient()==IPC) pre($url);
                    // if (ipclient()==IPC) json($kd_poli);
                    
                    // if (ipclient()=='172.16.18.210') pre($url);
            $file = null;
            $file = file_get_contents($url);
            
            $file = json_decode($file);
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        $pdf_name[] = $file->pdf_name;
                    }
                }
            }
                        // if (ipclient()=="172.16.18.210") json($url);
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/rinci_klaim/'.$no_reg.'/'.$tgl_masuk.'/FILECLIENT/'.$ip;
            
                     // if (in_array($kd_poli, ['UGD', 'PNEK'])) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                     // if (in_array($kd_poli, ['HD']) || $extra_hd_igd==1 ) $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan_bpjs_hd/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                     // if (in_array($kd_poli, [''])&&$pdf_nota=="UGD") $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_darurat_bpjs/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
                     // if (ipclient()==IPC) pre($url);
                             // if (ipclient()==IPC) json($kd_poli);                
                     $file = null;
                     $file = file_get_contents($url);
                    //  if (ipclient()=='172.16.18.56') pre($url);
                     $file = json_decode($file);
                     if (!empty($file->pdf)) {
                         if (file_exists($file->pdf)) {
                             if (!empty($file->pdf_name)) {
                                 $pdf_name[] = $file->pdf_name;
                             }
                         }
                     }
                    // if (ipclient()=='172.16.18.210') pre($url);
        } 
        // if (ipclient()==IPC) json($url);
//jadwal hd
// $soap = DB::table('rme.soap_hd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
// if (!empty($soap)) {
//     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/surat_keterangan_jadwal_hemodialisis/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
//     $file = null;
//     $file = file_get_contents($url);
//     $file = json_decode($file);
//     if (!empty($file->pdf)) {
//         if (file_exists($file->pdf)) {
//             if (!empty($file->pdf_name)) {
//                 $pdf_name[] = $file->pdf_name;
//             }
//         }
//     }
// }
// pre($url);
    //   pre($pdf_name);

            // pre($pdf_name);
        // $this->zend->load('Zend/Pdf');
        // $pdfMerged = new Zend_Pdf();
        //     // if (ipclient()=='172.16.18.18') pre($url);
        //                 // if (ipclient()=='172.16.18.56')
        //                 //  pre($pdf_name);
        // /*if (ipclient()=='172.16.18.213') pre($url);*/
        // if(count($pdf_name) > 0)
        // {
        //     foreach ($pdf_name as $file) {
        //         # code...
        //         $pdf1 = Zend_Pdf::load($dir . $file);
        //         // ADD ALL PAGES FROM THE FIRST PDF TO OUR NEW DOCUMENT
        //         foreach ($pdf1->pages as $page) {
        //             $clonedPage         = clone $page;
        //             $pdfMerged->pages[] = $clonedPage;
        //         }
        //         if (file_exists($dir.$file)) {
        //             unlink($dir.$file);
        //         }
        //     }
        // }

        // unset($clonedPage);
        // $pdfMerged->save($dir . $no_sep.'.pdf');
        // $pdf = Zend_Pdf::load($dir . $no_sep.'.pdf');
        // $file_merge = $no_sep.".pdf";
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename='.$file_merge);

        // $pdfData = $pdf->render();
        // echo $pdfData;
        // if (file_exists($dir.$file_merge)) {
        //     unlink($dir.$file_merge);
        // }
        
        $this->zend->load('Zend/Pdf');
        $pdfMerged = new Zend_Pdf();

        if(count($pdf_name) > 0)
        {
            foreach ($pdf_name as $file) {
                $pdf1 = Zend_Pdf::load($dir . $file);

                foreach ($pdf1->pages as $page) {
                    $clonedPage         = clone $page;
                    $pdfMerged->pages[] = $clonedPage;
                }

                if (file_exists($dir.$file)) {
                    unlink($dir.$file);
                }
            }
        }

        unset($clonedPage);

        $file_merge = $no_sep.".pdf";
        $file_path  = $dir.$file_merge;

        $pdfMerged->save($file_path);

        if (file_exists($file_path)) {

            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            clearstatcache(true, $file_path);

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.$file_merge.'"');
            header('Content-Length: '.filesize($file_path));
            header('Accept-Ranges: bytes');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');

            readfile($file_path);

            unlink($file_path);
            exit;
        }
        

