<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$this->load->helper('bpjs_bridge');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$id          = $this->input->post('rowid');
$no_reg      = $this->input->post('rm');
$tgl_kontrol = date("Y-m-d", strtotime($this->input->post('kontrol')));
$noSEP       = $this->input->post('sep');
$dokter      = $this->input->post('dokter');
$poli        = $this->input->post('poli');
$kd_poli        = $this->input->post('kd_poli');
$tgl_masuk        = $this->input->post('tgl_masuk');
$no_reg        = $this->input->post('no_reg');
$skdp        = $this->input->post('skdp');
$registered = date("Y-m-d H:i:s");
$res = (object) null;
$errCode = "";
if (!empty($skdp) && $skdp != "") {

} else {
    $soap = DB::table('rme.soap')->where('no_reg', $no_reg)->whereNotNull('kd_dr')->where('kd_poli', $kd_poli)->where('tgl_masuk', $tgl_masuk)->orderBy('id', 'desc')->first(['id', 'corrected', 'kd_dr', 'tgl_kontrol', 'tgl_masuk', 'no_reg']);
    if (!empty($soap)) {
        $soap = (object) $soap;
        $res = $soap->id; 
        $corrected = $soap->corrected;
        $row_sep = (object) (DB::select("select * from bpjs.sep2 where noMr='$no_reg' and tglSEP='$tgl_masuk' and noRujukan not like '%V%' order by id desc limit 1")[0]??null);
        // if (ipclient()==IPC) json("select * from bpjs.sep2 where noMr='$no_reg' and tglSEP='$tgl_masuk' and noRujukan not like '%V%' order by id desc limit 1");
        $row_dpjp = (object) (DB::select("select * from bpjs.antreanrs_dokter_map where no_dr = '$soap->kd_dr' and deleted is null order by id desc limit 1")[0]??null);
        if (!empty($row_sep->noSEP)) {
            $data_insert_surat_kontrol = [
                "request" => [
                    "noSEP" => $row_sep->noSEP, 
                    "kodeDokter" => $row_dpjp->kodedokter, 
                    "poliKontrol" => $row_sep->kdPoli, 
                    "tglRencanaKontrol" => $soap->tgl_kontrol, 
                    "user" => $user
                ]
            ];
            $data_post = [
                "sec" => "vclaim", 
                "method" => "POST", 
                "url" => "RencanaKontrol/insert", 
                "data" => $data_insert_surat_kontrol 
            ];
            // if (ipclient()==IPC) {
                $res_insert_surat_kontrol = json_decode(vclaim($data_post));
                $registered = date("Y-m-d H:i:s");
				$query = "insert into bpjs.surat_kontrol_req
				(
					tanggal, 
					no_reg, 
					noSEP, 
					kodeDokter, 
					poliKontrol, 
					tglRencanaKontrol, 
					user, 
					res_code, 
					res_message, 
					registered
				) 
				values 
				(
					".(!empty($soap->tgl_masuk)?"'".$soap->tgl_masuk."'":NULL).", 
					".(!empty($soap->no_reg)?"'".$soap->no_reg."'":NULL).", 
					".(!empty($row_sep->noSEP)?"'".$row_sep->noSEP."'":NULL).", 
					".(!empty($row_dpjp->kodedokter)?"'".$row_dpjp->kodedokter."'":NULL).",  
					".(!empty($row_sep->kdPoli)?"'".$row_sep->kdPoli."'":NULL).", 
					".(!empty($soap->tgl_kontrol)?"'".$soap->tgl_kontrol."'":NULL).", 
					".(!empty($user)?"'".$user."'":NULL).", 
					".(!empty($res_insert_surat_kontrol->code)?"'".$res_insert_surat_kontrol->code."'":NULL).", 
					".(!empty($res_insert_surat_kontrol->response->noSuratKontrol)?"'".$res_insert_surat_kontrol->response->noSuratKontrol."'":(!empty($res_insert_surat_kontrol->message)?"'".$res_insert_surat_kontrol->message."'":NULL)).",
					'$registered' 
				)";
                DB::insert($query);
                if (in_array($res_insert_surat_kontrol->code, ['200'])) $status = true;
                // $res = $res_insert_surat_kontrol->message;
                $res = [
                    "message" => $res_insert_surat_kontrol->message." (".$res_insert_surat_kontrol->code.")"
                ];
                $errCode = $res_insert_surat_kontrol->code;
                // json($res_insert_surat_kontrol);
                // if (ipclient()==IPC) json($res_insert_surat_kontrol);
            // }
        } else {
            $row_sep_inap = (object) (DB::select("select * from bpjs.sep2 where noMr='$no_reg' and tglSEP='$tgl_masuk' order by id desc limit 1")[0]??null);
            $res = "";
            if (!empty($row_sep_inap->noSEP)) {
                $res = [
                    "message" => "SEP : <b>".$row_sep_inap->noSEP."</b> (Indikasi Post Inap)"
                ];
            }
        }
        /** update modified di rme.soap agar ter generate ulang */
        // DB::table('rme.soap')->where('id', $soap->id)->update([
        //     'corrected' => $corrected,
        //     'modified' => date("Y-m-d H:i:s"),
        // ]);
        // $status = true;
    }
}

$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
    'message' => $res,
    'code' => $errCode,
    // 'request'        => $data_post,
    'response'        => $res,
);
json($data);

