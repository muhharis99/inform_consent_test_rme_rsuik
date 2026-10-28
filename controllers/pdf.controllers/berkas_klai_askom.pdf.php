<?php 

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
    
        $no_reg = segment(4);
        $tgl_rs = segment(5);
        // $no_sep = segment(5);
        // if (ipclient()=='172.16.18.56') pre($no_sep);
        $tgl_masuk = null; 
        $jam_masuk = null;
        $kd_poli = null; 

        /** GET NO SEP */
        // $sep = DB::table('bpjs.sep2')->where('noMr', $no_reg)->where('noSEP', $no_sep)->orderBy('id', 'desc')->first();
        // $no_sep = $no_reg;
        // $rawat = []; 
        // $rawat = ["J", "G"]; 
        // $sep_kd_poli = null; 
        // if (!empty($sep)) {
        //     $sep = (object) $sep; 
        //     $no_sep = $sep->noSEP; 
        //     $tgl_masuk = $sep->tglSEP;
        //     switch ($sep->jnsPelayanan) {
        //         case 'R.Inap' :
        //         case 'Rawat Inap' :
        //         case 'Inap' :
        //         case 'INAP' :
        //             $rawat = ["I", "G"]; 
        //             break; 
        //     }
        //     if ($sep->kdPoli!='') $sep_kd_poli = $sep->kdPoli;
        // }
        // pre($no_sep);
        $ip = ipclient();
        $dir = FCPATH . "assets/rme/pdf/$ip/";
        $pdf_name = (array) null; 
        
        // if (ipclient()=='172.16.18.21') pre($sep->kdPoli);
        /** SEP */
        // $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/sep/'.$no_reg.'/'.$no_sep.'/FILECLIENT/'.$ip;
        // pre($url);
        // $file = null;
        // $file = file_get_contents($url);
        // $file = json_decode($file);
        // if (!empty($file->pdf)) {
        //     if (file_exists($file->pdf)) {
        //         if (!empty($file->pdf_name)) {
        //             $pdf_name[] = $file->pdf_name;
        //         }
        //     }
        // }
        // pre($url);
        /** CARI JAM KUNJUNG YANG ASURANSINYA BPJS :: KADANG PERIKSA UMUM DAN BPJS DI HARI YANG SAMA */
        // if (!empty($sep->kdPoli)) {
        //     switch ($sep->kdPoli) {
        //         case 'IGD' : 
        //             $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereIn('kd_poli', ['UGD', 'PNEK'])->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
        //             if (empty($rows_kunjung)) {
        //                 $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->whereRaw("DATE_ADD(tanggal, INTERVAL 1 DAY) >= '$tgl_masuk'")->whereIn('kd_poli', ['UGD', 'PNEK'])->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
        //             }
        //             break; 
        //         default : 
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
        //             $rows_kunjung = DB::table('rsiklaten.kunjung')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->orderBY('id', 'ASC')->get();
        //             break; 
                    
        //     }
        // }
        // if (ipclient()=='172.16.18.21') pre($rows_kunjung);
        // $kunjung = (object) null; 
        // if (!empty($rows_kunjung)) {
        //     foreach ($rows_kunjung as $row_kunjung) {
        //         $row_kunjung = (object) $row_kunjung; 
        //         if ($row_kunjung->deletedstate==0) {
        //             if (in_array($row_kunjung->rawat, $rawat)) {
        //                 $tgl_rs = str_replace(array("-", ":"), "", $row_kunjung->tanggal.$row_kunjung->jam);
        //                 $tgl_masuk = $row_kunjung->tanggal;
        //                 $jam_masuk = $row_kunjung->jam;
        //                 $kd_poli = $row_kunjung->kd_poli;
        //                 break; 
        //             }
        //         }
        //     }
        // }
        // if (ipclient()=='172.16.18.21') pre($kd_poli);
        // if ($no_reg=='0576833') pre($rows_kunjung);
        /** RINGKASAN PULANG */
        // switch ($kd_poli) {
        //     case 'UGD' : 
        //     case 'PNEK' : 
        //         /** cek dulu di soap gd*/
        //         $soap = DB::table('rme.soap_gd')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
        //         // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
        //         // if (ipclient()=='172.16.18.21') pre($soap);
        //         if (!empty($soap)) {
        //             $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_darurat/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
        //             $file = null;
        //             $file = file_get_contents($url);
        //             $file = json_decode($file);
        //             if (!empty($file->pdf)) {
        //                 if (file_exists($file->pdf)) {
        //                     if (!empty($file->pdf_name)) {
        //                         $pdf_name[] = $file->pdf_name;
        //                     }
        //                 }
        //             }
        //         }
        //         break; 
        //     default : 
        //         /** cek dulu di soap   */
        //         if ((string) $kd_poli != '') {
        //             $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->where('kd_poli', $kd_poli)->whereNull('deleted')->orderBy('id', 'desc')->first();
        //         } else {
        //             $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
        //         }
        //         // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
        //         if (!empty($soap)) {
        //             $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_jalan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
        //             $file = null;
        //             $file = file_get_contents($url);
        //             $file = json_decode($file);
        //             if (!empty($file->pdf)) {
        //                 if (file_exists($file->pdf)) {
        //                     if (!empty($file->pdf_name)) {
        //                         $pdf_name[] = $file->pdf_name;
        //                     }
        //                 }
        //             }
        //         }
        //         break; 
        // }
                // if (ipclient()=='172.16.18.21') pre($url);

        
        //resep
                 /** cek dulu di soap   */
                //  if ((string) $kd_poli != '') {
                //     $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->where('kd_poli', $kd_poli)->whereNull('deleted')->orderBy('id', 'desc')->first();
                // } else {
                //     $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
                // }
                // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
                // if (!empty($soap)) {
                //     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/resep_klaim/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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



        // /** cek surat pengantar fisioterapi */
        // switch ($kd_poli) {
        //     case 'F001' : 
        //     case 'F002' : 
        //     case 'F003' :
        //     case 'RHMD' :
        //         /** get soap rhmed terakhir */
        //         $surat_fisioterapi = DB::table('rme.surat_fisioterapi')->where('no_reg', $no_reg)->where('poli_id', 'RHMD')->whereRaw("tanggal <= '$tgl_masuk'")->orderBy('id', 'desc')->first();
        //         if (!empty($surat_fisioterapi)) {
        //             $surat_fisioterapi = (object) $surat_fisioterapi; 
        //             $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/lembar_hasil_tindakan_uji_fungsi/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
        //             $file = null;
        //             $file = file_get_contents($url);
        //             $file = json_decode($file);
        //             if (!empty($file->pdf)) {
        //                 if (file_exists($file->pdf)) {
        //                     if (!empty($file->pdf_name)) {
        //                         $pdf_name[] = $file->pdf_name;
        //                     }
        //                 }
        //             }
        //             $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/formulir_klaim_kedokteran_fisik_rehabilitasi/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'/FILECLIENT/'.$ip;
        //             $file = null;
        //             $file = file_get_contents($url);
        //             $file = json_decode($file);
        //             if (!empty($file->pdf)) {
        //                 if (file_exists($file->pdf)) {
        //                     if (!empty($file->pdf_name)) {
        //                         $pdf_name[] = $file->pdf_name;
        //                     }
        //                 }
        //             }

        //             $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/monitoring_kunjungan_pelayanan_rehabilitasi_medik/'.$no_reg.'/'.str_replace(array("-", ":", " "), "", $surat_fisioterapi->tanggal." 00:00:00").'-'.str_replace(array("-", ":", " "), "", $tgl_masuk." 00:00:00").'/FILECLIENT/'.$ip;
        //             $file = null;
        //             $file = file_get_contents($url);
        //             $file = json_decode($file);
        //             if (!empty($file->pdf)) {
        //                 if (file_exists($file->pdf)) {
        //                     if (!empty($file->pdf_name)) {
        //                         $pdf_name[] = $file->pdf_name;
        //                     }
        //                 }
        //             }
        //         }
        //         break; 
        // }

        /** BERKAS KLAIM */
        /** cek dulu di surat_klaim   */
        // $klaim = DB::table('rme.surat_klaim')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->where('poli_id', $kd_poli)->orderBy('id', 'desc')->first();
        // if (!empty($klaim)) {
        //     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/formulir_klaim/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
        // if (ipclient()=='172.16.15.203') pre($klaim);
        /** Berkas Klaim Individual E-Klaim */
        // if ($reload_eklaim===true) {
        //     DB::table('inacbg.claim_print')->where('nomor_sep', $no_sep)
        //         ->update(
        //             array(
        //                 'nomor_sep' => "XX".substr($no_sep, 2, strlen($no_sep))
        //             )
        //         );
        // }
        
        //     $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bpjs/pdf/klaim/'.$no_sep.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
        /** Nota Rawat Jalan */
        
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_farm_um/'.$no_reg.'/'.$tgl_rs;
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
            // if (ipclient()=='172.16.18.56') pre($url);
            // pre($rawat);
        /** HASIL RADIOLOGI */
        // $hasil = null;
        // pre($rawat);
        // if (in_array("J", $rawat)) {
        //     $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
        //     if (empty($hasil)) {
        //         $hasil   = DB::table('rme.ro_hasilrl')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
        //     }
        //     if (!empty($hasil)) {

        //         $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
        // } else {
        //     $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
        //     if (empty($hasil)) {
        //         $hasil   = DB::table('rme.ro_hasilri')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
        //     }
        //     if (empty($hasil)) {
        //         $hasil   = DB::table('rme.ro_hasilrl')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->first();
        //     }
        //     if (!empty($hasil)) {

        //         $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/hasro/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
        // }

    // if (ipclient()=='172.16.18.56') {
    //     pre($url);
    // }
            // pre($pdf_name);
        $this->zend->load('Zend/Pdf');
        $pdfMerged = new Zend_Pdf();
            // if (ipclient()=='172.16.18.21') pre($dir);
        
        if(count($pdf_name) > 0)
        {
            foreach ($pdf_name as $file) {
                # code...
                $pdf1 = Zend_Pdf::load($dir . $file);
                // ADD ALL PAGES FROM THE FIRST PDF TO OUR NEW DOCUMENT
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
        $pdfMerged->save($dir . $no_sep.'.pdf');
        $pdf = Zend_Pdf::load($dir . $no_sep.'.pdf');
        $file_merge = $no_sep.".pdf";
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename='.$file_merge);

        $pdfData = $pdf->render();
        echo $pdfData;
        if (file_exists($dir.$file_merge)) {
            unlink($dir.$file_merge);
        }