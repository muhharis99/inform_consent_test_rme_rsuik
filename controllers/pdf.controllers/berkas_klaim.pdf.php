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
        // if (ipclient()=='172.16.18.21') pre($reload_eklaim);
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        
        /** CARI JAM KUNJUNG YANG ASURANSINYA BPJS :: KADANG PERIKSA UMUM DAN BPJS DI HARI YANG SAMA */
        $rows_kunjung = DB::table('rsiklaten.kunjung')
							->where('no_reg', $no_reg)
							->where('tanggal', $tgl_masuk)
							->whereNotNull('kd_poli')
							->whereNotNull('kd_dr')
							->get();
        $kunjung = (object) null; 
        if (!empty($rows_kunjung)) {
            foreach ($rows_kunjung as $row_kunjung) {
                $row_kunjung = (object) $row_kunjung; 
                if ($row_kunjung->deletedstate==0 && in_array($row_kunjung->pasien, array('300', '301', '302', '303', '304', '305', '306'))) {
                    $tgl_rs = str_replace(array("-", ":"), "", $row_kunjung->tanggal.$row_kunjung->jam);
                    $jam_masuk = $row_kunjung->jam;
                }
            }
        }
        // if (ipclient()=='172.16.18.21') pre($tgl_rs);
        
        /** GET NO SEP */
        $sep = DB::table('bpjs.sep2')->where('noMr', $no_reg)->where('tglSEP', $tgl_masuk)->orderBy('id', 'desc')->first(array('noSEP'));
        $no_sep = $no_reg; 
        if (!empty($sep)) {
            $sep = (object) $sep; 
            $no_sep = $sep->noSEP; 
        }
        // pre($no_sep);
        $ip = ipclient();
        $dir = FCPATH . "assets/rme/pdf/$ip/";
        $pdf_name = (array) null; 
        
        /** SEP */
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/sep/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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

        /** RINGKASAN PULANG */
        /** cek dulu di soap   */
        $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('deleted')->orderBy('id', 'desc')->first();
        // if (ipclient()=='172.16.18.21') pre($tgl_masuk." ".$jam_masuk." ".$no_reg);
        if (ipclient()=='172.16.18.21') pre($soap);
        if (!empty($soap)) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/rme/pdf/ringkasan_pasien_keluar_rawat_jalan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
        $klaim = DB::table('rme.surat_klaim')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'desc')->first();
        if (!empty($klaim)) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/formulir_klaim/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
            $file = null;
            $file = file_get_contents($url);
            $file = json_decode($file);
            if (!empty($file->pdf)) {
                if (file_exists($file->pdf)) {
                    if (!empty($file->pdf_name)) {
                        // $pdf_name[] = $file->pdf_name;
                    }
                }
            }
        }
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
        /** Nota Rawat Jalan */
        
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/bill/pdf/nota_rawat_jalan/'.$no_reg.'/'.$tgl_rs.'/FILECLIENT/'.$ip;
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
            // if (ipclient()=='172.16.18.56') pre($file->pdf);

        /** HASIL RADIOLOGI */
        $hasil   = DB::table('rme.ro_hasilrj')->where('no_reg', $no_reg)->where('tgl_spm', $tgl_masuk)->first();
        if (empty($hasil)) {
            $hasil   = DB::table('rme.ro_hasilri')->where('no_reg', $no_reg)->where('tgl_spm', $tgl_masuk)->first();
        }
        if (empty($hasil)) {
            $hasil   = DB::table('rme.ro_hasilrl')->where('no_reg', $no_reg)->where('tgl_spm', $tgl_masuk)->first();
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
            
            // pre($file);
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