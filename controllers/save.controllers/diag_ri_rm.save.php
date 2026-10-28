<?php 
// $this->load->model('log_perubahan');
// $this->load->model('soap');
$this->load->model('diag_ri');

$soap_id   = $this->input->post('soap_id');
$no_reg    = $this->input->post('no_reg');
$tgl_masuk = $this->input->post('tgl_masuk');
$jam_masuk = $this->input->post('jam_masuk');
$no_sep    = $this->input->post('no_sep');
$icd1      = $this->input->post('icd1');
$icd2      = $this->input->post('icd2');
$icd3      = $this->input->post('icd3');
$icd4      = $this->input->post('icd4');
$icd5      = $this->input->post('icd5');
$icd6      = $this->input->post('icd6');
$icd7      = $this->input->post('icd7');
$icd8      = $this->input->post('icd8');
$icd9      = $this->input->post('icd9');
$icd10      = $this->input->post('icd10');
// $kd_sms    = $this->input->post('kd_sms');
$pd1       = $this->input->post('tindakan1');
$pd2       = $this->input->post('tindakan2');
$pd3       = $this->input->post('tindakan3');
$pd4       = $this->input->post('tindakan4');
$pd5       = $this->input->post('tindakan5');
$pd6       = $this->input->post('tindakan6');
$pd7       = $this->input->post('tindakan7');
$pd8       = $this->input->post('tindakan8');
$notes      = $this->input->post('notes');

$sess = sess_on('auth');
// $soap_old = Soap::find($soap_id);
// $tgl_masuk = $soap_old->tgl_masuk;
// $jam_masuk = $soap_old->jam_masuk;
// $no_reg = $soap_old->no_reg;
// $status = false;

// $log = Log_perubahan::firstOrNew(array('nama_tabel' => 'soap'));
// $log->nama_tabel = 'soap';
// $log->data_awal  = json_encode($soap_old);
// $log->writer     = $sess->user_id;
// $log->registered = date('Y-m-d H:i:s');
// DB::transaction(function () use ($log, &$status) {
//     $log->save();
//     $status = true;
// });
Diag_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->update([
    'deleted' => date("Y-m-d H:i:s")
]);
$diag_ri            = Diag_ri::firstOrNew(array('no_reg' => $no_reg,'soap_id' => $soap_id,'tgl_masuk' => $tgl_masuk,'jam_masuk' => $jam_masuk,'icd1' => $icd1,'icd2' => $icd2,'icd3' => $icd3,'icd4' => $icd4,'pd1' => $pd1,'pd2' => $pd2,'pd3' => $pd3,'pd4' => $pd4, 'deleted'=> null));
// $diag_ri            = Diag_rj::firstOrNew(array('no_reg' => $no_reg,'soap_id' => $soap_id,'tgl_masuk' => $tgl_masuk,'jam_masuk' => $jam_masuk));
$diag_ri->soap_id   = $soap_id;
$diag_ri->no_reg    = $no_reg;
$diag_ri->tgl_masuk = $tgl_masuk;
$diag_ri->jam_masuk = $jam_masuk;
$diag_ri->no_sep    = $no_sep;
$diag_ri->icd1      = $icd1;
$diag_ri->icd2      = $icd2;
$diag_ri->icd3      = $icd3;
$diag_ri->icd4      = $icd4;
$diag_ri->icd5      = $icd5;
$diag_ri->icd6      = $icd6;
$diag_ri->icd7      = $icd7;
$diag_ri->icd8      = $icd8;
$diag_ri->icd9      = $icd9;
$diag_ri->icd10     = $icd10;
$diag_ri->pd1       = $pd1;
$diag_ri->pd2       = $pd2;
$diag_ri->pd3       = $pd3;
$diag_ri->pd4       = $pd4;
$diag_ri->pd5       = $pd5;
$diag_ri->pd6       = $pd6;
$diag_ri->pd7       = $pd7;
$diag_ri->pd8       = $pd8;
$diag_ri->notes       = $notes;
// $diag_ri->kd_sms       = $kd_sms;
$diag_ri->date_registered  = date('Y-m-d H:i:s');

// echo"<pre>";print_r($diag_rj);die();

DB::transaction(function () use ($diag_ri, &$status) {
    $diag_ri->save();
    // $soao_id = $diag_ri->id;
    $status = true;
});

$data = (object)array(
    'status' => $status,
);
echo json_encode($data);