<?php 
// $this->load->model('log_perubahan');
// $this->load->model('soap');
$this->load->model('diag_rj');

$soap_id   = $this->input->post('soap_id');
$no_reg    = $this->input->post('no_reg');
$tgl_masuk = $this->input->post('tgl_masuk');
$jam_masuk = $this->input->post('jam_masuk');
$no_sep    = $this->input->post('no_sep');
$icd1      = $this->input->post('icd1');
$icd2      = $this->input->post('icd2');
$icd3      = $this->input->post('icd3');
$icd4      = $this->input->post('icd4');
$kd_sms    = $this->input->post('kd_sms');
$pd1       = $this->input->post('tindakan1');
$pd2       = $this->input->post('tindakan2');
$pd3       = $this->input->post('tindakan3');
$pd4       = $this->input->post('tindakan4');

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
Diag_rj::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted')->update([
    'deleted' => date("Y-m-d H:i:s")
]);
$diag_rj            = Diag_rj::firstOrNew(array('no_reg' => $no_reg,'soap_id' => $soap_id,'tgl_masuk' => $tgl_masuk,'jam_masuk' => $jam_masuk,'icd1' => $icd1,'icd2' => $icd2,'icd3' => $icd3,'icd4' => $icd4,'pd1' => $pd1,'pd2' => $pd2,'pd3' => $pd3,'pd4' => $pd4, 'deleted'=> null));
// $diag_rj            = Diag_rj::firstOrNew(array('no_reg' => $no_reg,'soap_id' => $soap_id,'tgl_masuk' => $tgl_masuk,'jam_masuk' => $jam_masuk));
$diag_rj->soap_id   = $soap_id;
$diag_rj->no_reg    = $no_reg;
$diag_rj->tgl_masuk = $tgl_masuk;
$diag_rj->jam_masuk = $jam_masuk;
$diag_rj->no_sep    = $no_sep;
$diag_rj->icd1      = $icd1;
$diag_rj->icd2      = $icd2;
$diag_rj->icd3      = $icd3;
$diag_rj->icd4      = $icd4;
$diag_rj->pd1       = $pd1;
$diag_rj->pd2       = $pd2;
$diag_rj->pd3       = $pd3;
$diag_rj->pd4       = $pd4;
$diag_rj->kd_sms       = $kd_sms;
$diag_rj->date_registered  = date('Y-m-d H:i:s');

// echo"<pre>";print_r($diag_rj);die();

DB::transaction(function () use ($diag_rj, &$status) {
    $diag_rj->save();
    // $soao_id = $diag_rj->id;
    $status = true;
});

$data = (object)array(
    'status' => $status,
);
echo json_encode($data);