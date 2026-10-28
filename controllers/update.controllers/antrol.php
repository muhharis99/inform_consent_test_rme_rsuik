<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$id            = $this->input->post('rowid');
$no_reg            = $this->input->post('no_reg');
$checkin            = $this->input->post('checkin');
$mulai_poli            = $this->input->post('mulai_poli');
$selesai_poli            = $this->input->post('selesai_poli');
$mulai_resep            = $this->input->post('mulai_resep');
$selesai_resep            = $this->input->post('selesai_resep');

$antri_task = Antri_task::find($id); 
if (!empty($antri_task)) {
    $tgl_periksa = $antri_task->tgl_masuk;
    $tgl_mulai_poli = $tgl_periksa." ".$mulai_poli;
    $tgl_selesai_poli = $tgl_periksa." ".$selesai_poli;
    $tgl_mulai_resep = $tgl_periksa." ".$mulai_resep;
    $tgl_selesai_resep = $tgl_periksa." ".$selesai_resep;
    $antri_task = Antri_task::where('id', $antri_task->id)
                            ->update(
                                array(
                                    'task_4'    => $tgl_mulai_poli, 
                                    'task_5'    => $tgl_selesai_poli,
                                    'task_6'    => $tgl_mulai_resep,
                                    'task_7'    => $tgl_selesai_resep,
                                    )
                                );
    $status = true;
}
$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
);
echo json_encode($data);