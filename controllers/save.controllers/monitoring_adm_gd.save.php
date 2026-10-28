<?php 
$this->load->model('monitoring_adm_gd');

$soap_id = $this->input->post('soap_id');
$no_reg  = $this->input->post('no_reg');
$tanggal = $this->input->post('tanggal');
$kd_dr   = $this->input->post('kd_dr');
$catatan = $this->input->post('catatan');
$done   = $this->input->post('done');
$kelas   = $this->input->post('kelas');

$sess = sess_on('auth');
$writer = '';
if (!empty($sess)) {
    $writer = $sess->user_id;
}
$status = 'kosong';
if(!empty($done)){
    Monitoring_adm_gd::where('no_reg', $no_reg)->where('tanggal', $tanggal)->where('status','1')->update([
        'catatan' => $catatan,'writer' => $writer
    ]);
    $status = true;
}else{

}

$monitoring          = Monitoring_adm_gd::firstOrNew(array('no_reg' => $no_reg,'tanggal' => $tanggal));
$monitoring->soap_id = $soap_id;
$monitoring->no_reg  = $no_reg;
$monitoring->tanggal = $tanggal;
$monitoring->kd_dr   = $kd_dr;
$monitoring->catatan = $catatan;
$monitoring->kelas = $kelas;
$monitoring->writer  = $writer;
$monitoring->registered  = date('Y-m-d H:i:s');

DB::transaction(function () use ($monitoring, &$status) {
    $monitoring->save();
    $status = true;
});

$data = (object)array(
    'status' => $status,
);
echo json_encode($data);