<?php 

$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
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
}
    
        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        $tgl_masuk = null; 
        $jam_masuk = null;
        $no_sep = null; 
        if (strlen($tgl_rs)>=19) {
            $no_sep = segment(5);
            $sep = DB::table('bpjs.sep2 as a')->where('noMr', $no_reg)->where('noSEP', $no_sep)->orderBy('id', 'DESC')->first();
            if (!empty($sep)) {
                $sep = (object) $sep; 
                $sep->str_tgl_sep = date("d-m-Y", strtotime($sep->tglSEP));
                $sep->str_tglLahir = date("d-m-Y", strtotime($sep->tglLahir));
                $sep->str_tglBackDate = date("d-m-Y", strtotime($sep->backDate));
                $tgl_masuk = $sep->tglSEP;
            }
        } else {
            if ((string) $tgl_rs == "") {
                $tgl_rs = date("YmdHis");
            }
            $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
            $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
            
            $sep = DB::table('bpjs.sep2 as a')->where('noMr', $no_reg)->where('tglSEP', $tgl_masuk)->orderBy('id', 'DESC')->first();
            // if (ipclient()==IPC) json($tgl_masuk);
            /** cek kunjungan inap */
            // if (ipclient()==IPC) {
            $mutasi_ri = DB::select("select * from rsiklaten.mutasi_ri use index (tgl_masuk_3) where no_reg = '$no_reg' and deleted is null and tgl_masuk = '$tgl_masuk' and jam_masuk is not null");
            if (!empty($mutasi_ri)) {
                $sep = DB::select("select * from bpjs.sep2 use index(tglSEP_2) where noMr='$no_reg' and tglSEP between '$tgl_masuk' and date_add('$tgl_masuk', interval 3 day) and jnsPelayanan like '%inap%'");
                if (!empty($sep)) $sep = (object) $sep[0];
                // json($sep);
            }
            // $rawat = !empty($mutasi_ri) ? "inap" : "jalan"; 
            // json ($rawat);
            // }
            if (!empty($sep)) {
                $sep = (object) $sep; 
                $sep->str_tgl_sep = date("d-m-Y", strtotime($sep->tglSEP));
                $sep->str_tglLahir = date("d-m-Y", strtotime($sep->tglLahir));
                $sep->str_tglBackDate = date("d-m-Y", strtotime($sep->backDate));
            } 
        }
        $data = array(
            "no_reg"    => $no_reg,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "sep"       => $sep,
            'pdf_type'  => $pdf_type,
            'lp_print'  => $lp_print,
            'printer'   => $printer,
            'ipclient'  => $ipclient
        );
        // ipclient()==IPC?json($tgl_rs):'';
        $tgl_masuk>='2023-04-01'?
        go('pdf/sep-elektronik', $data):
        // json($data):
        go('pdf/sep', $data);  