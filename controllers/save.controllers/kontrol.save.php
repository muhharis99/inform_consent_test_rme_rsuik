<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$this->load->helper('bpjs_bridge');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$id          = $this->input->post('rowid');
$no_reg      = $this->input->post('no_reg');
$tgl_kontrol = date("Y-m-d", strtotime($this->input->post('kontrol')));
$strSEP       = $this->input->post('strSEP');
$noSEP       = $this->input->post('sep');
$tgl_masuk       = $this->input->post('tgl_masuk');
$dokter      = $this->input->post('dokter');
$poli        = $this->input->post('poli');
$skdp        = $this->input->post('skdp');
$registered = date("Y-m-d H:i:s");
$res_insert_surat_kontrol = (object) null;
// if (ipclient()==IPC) json($no_reg);
if (!empty($skdp) && $skdp != "") {

} else {
    if ($noSEP=="" && strlen(trim($strSEP)) == 19) $noSEP = trim($strSEP);
    $data_post = [
        "sec" => "vclaim", 
        "method" => "POST", 
        "url" => "RencanaKontrol/insert", 
        "data" => [
            "request" => [
                "noSEP" => $noSEP, 
                "kodeDokter" => $dokter, 
                "poliKontrol" => $poli, 
                "tglRencanaKontrol" => $tgl_kontrol, 
                "user" => $user
            ]
        ] 
    ];
    $res_insert_surat_kontrol = json_decode(vclaim($data_post));
    // if (!empty($res_insert_surat_kontrol->code) && $res_insert_surat_kontrol->code=='200') {
    //     $row_surkon = DB::table('bpjs.surat_kontrol_req')->where('id', $id)->first();
    //     DB::table('bpjs.surat_kontrol_req')->where('id', $id)->update(['deleted' => $registered, 'deleter' => $writer]);
    //     DB::table('bpjs.surat_kontrol_req')->insert([
    //         'tanggal' => !empty($row_surkon['tanggal'])?$row_surkon['tanggal']:$tgl_kontrol,
    //         'no_reg' => $no_reg,
    //         'noSEP' => $noSEP,
    //         'kodeDokter' => $dokter,
    //         'poliKontrol' => $poli,
    //         'tglRencanaKontrol' => $tgl_kontrol,
    //         'user' => $user,
    //         'res_code' => !empty($res_insert_surat_kontrol->code)?$res_insert_surat_kontrol->code:NULL,
    //         'res_message' => !empty($res_insert_surat_kontrol->response->noSuratKontrol)?$res_insert_surat_kontrol->response->noSuratKontrol:(!empty($res_insert_surat_kontrol->message)?$res_insert_surat_kontrol->message:NULL),
    //         'registered' => $registered,
    //     ]);
    //     $status = true;
    // }
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
        ".(!empty($tgl_masuk)?"'".$tgl_masuk."'":NULL).", 
        ".(!empty($no_reg)?"'".$no_reg."'":NULL).", 
        ".(!empty($noSEP)?"'".$noSEP."'":NULL).", 
        ".(!empty($dokter)?"'".$dokter."'":NULL).",  
        ".(!empty($poli)?"'".$poli."'":NULL).", 
        ".(!empty($tgl_kontrol)?"'".$tgl_kontrol."'":NULL).", 
        ".(!empty($user)?"'".$user."'":NULL).", 
        ".(!empty($res_insert_surat_kontrol->code)?"'".$res_insert_surat_kontrol->code."'":NULL).", 
        ".(!empty($res_insert_surat_kontrol->response->noSuratKontrol)?"'".$res_insert_surat_kontrol->response->noSuratKontrol."'":(!empty($res_insert_surat_kontrol->message)?"'".$res_insert_surat_kontrol->message."'":NULL)).",
        '$registered' 
    )";
    DB::insert($query);
}

$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
    'request'        => $data_post,
    'response'        => $res_insert_surat_kontrol,
    'query' => $query
);
json($data);

