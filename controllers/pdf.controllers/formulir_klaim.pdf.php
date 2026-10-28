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
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $kd_poli = null; 
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $sep = DB::table('bpjs.sep2 as a')->where('noMr', $no_reg)->where('tglSEP', $tgl_masuk)->orderBy('id', 'DESC')->first();
        if (!empty($sep)) {
            $sep = (object) $sep; 
            $sep->str_tgl_sep = date("d-m-Y", strtotime($sep->tglSEP));
            $sep->str_tglLahir = date("d-m-Y", strtotime($sep->tglLahir));
        }
        if (empty($sep) && $jam_masuk > '21:00:00') {
            $sep = DB::table('bpjs.sep2 as a')->where('noMr', $no_reg)->whereRaw("date_add('$tgl_masuk', interval 1 day) = tglSEP")->orderBy('id', 'DESC')->first();
        }
        $tanggal = ''; 
        $jam = ''; 
        $rawat = "RAWAT INAP";
        $soap = DB::table('rme.soap as a')->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 8)=LEFT('$jam_masuk', 8)")->whereNull('a.deleted')->orderBy('id', 'desc')->first();
        if (empty($soap)) {
            $soap = DB::table('rme.soap as a')->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('a.deleted')->orderBy('id', 'desc')->first();
        }
        if (empty($soap)) {
            $soap = DB::table('rme.soap as a')->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereNull('a.deleted')->orderBy('id', 'desc')->first();
        }
        if (!empty($soap)) {
            $soap = (object) $soap; 
            $kd_poli = $soap->kd_poli;
            $rawat = "RAWAT JALAN";
        } else {
            $soap = DB::table('rme.soap_gd as a')->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5)=LEFT('$jam_masuk', 5)")->whereNull('a.deleted')->orderBy('id', 'asc')->first();
            if (empty($soap)) {
                $soap = DB::table('rme.soap_gd as a')->where('a.no_reg', $no_reg)->where('a.tgl_masuk', $tgl_masuk)->whereNull('a.deleted')->orderBy('id', 'asc')->first();
            }
            if (!empty($soap)) {
                $soap = (object) $soap; 
                $kd_poli = $soap->poli_id;
                $rawat = "RAWAT JALAN";
            }
        }
        $klaim = DB::table('rme.surat_klaim as a')->where('a.no_reg', $no_reg)->where('a.tanggal', $tgl_masuk)->where('poli_id', $kd_poli)->orderBy('id', 'asc')->get();
        if (!empty($klaim)) {
            foreach($klaim as $row) {
                $row = (object) $row; 
                $tanggal = tampiltanggal($row->tanggal, 9);
                break;
            }
        }
        $pasien = DB::table('rsiklaten.pasien')->where('no_reg', $no_reg)->first(); 
        if (!empty($pasien)) $pasien = (object) $pasien;
        $data = array(
            "no_reg"    => $no_reg,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tanggal" => $tanggal,
            "jam" => $jam,
            "rawat" => $rawat,
            "sep"       => $sep,
            "soap"       => $soap,
            "klaim"       => $klaim,
            "pasien"       => $pasien,
            'pdf_type'  => $pdf_type,
            'lp_print'  => $lp_print,
            'printer'   => $printer,
            'ipclient'  => $ipclient
        );
        // pre($data);
        // ipclient()=='172.16.18.21'?pre($data):'';
            go('pdf/formulir_klaim', $data);  