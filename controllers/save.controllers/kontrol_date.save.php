<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$this->load->helper('bpjs_bridge');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$atanggal = date("Y-m-d", strtotime($this->input->post('atanggal')??date("d-m-Y")));
$btanggal = date("Y-m-d", strtotime($this->input->post('btanggal')??date("d-m-Y")));

$unit = $akses->unit->nama ?? null;
$tanggal = $atanggal;
json(['atanggal' => $atanggal, 'btanggal' => $btanggal]);
$registered = date("Y-m-d H:i:s");
$res_insert_surat_kontrol = (object) null;
if (!empty($skdp) && $skdp != "") {

} else {
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
    if (!empty($res_insert_surat_kontrol->code) && $res_insert_surat_kontrol->code=='200') {
        $row_surkon = DB::table('bpjs.surat_kontrol_req')->where('id', $id)->first();
        DB::table('bpjs.surat_kontrol_req')->where('id', $id)->update(['deleted' => $registered, 'deleter' => $writer]);
        DB::table('bpjs.surat_kontrol_req')->insert([
            'tanggal' => !empty($row_surkon['tanggal'])?$row_surkon['tanggal']:$tgl_kontrol,
            'no_reg' => $no_reg,
            'noSEP' => $noSEP,
            'kodeDokter' => $dokter,
            'poliKontrol' => $poli,
            'tglRencanaKontrol' => $tgl_kontrol,
            'user' => $user,
            'res_code' => !empty($res_insert_surat_kontrol->code)?$res_insert_surat_kontrol->code:NULL,
            'res_message' => !empty($res_insert_surat_kontrol->response->noSuratKontrol)?$res_insert_surat_kontrol->response->noSuratKontrol:(!empty($res_insert_surat_kontrol->message)?$res_insert_surat_kontrol->message:NULL),
            'registered' => $registered,
        ]);
        $status = true;
    }
}

$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
    'request'        => $data_post,
    'response'        => $res_insert_surat_kontrol,
);
json($data);

