<?php 

$msg = '';

$this->load->model('tarif_ibs');

$no_reg       = $this->input->post('grouping_no_reg');
$nama         = $this->input->post('grouping_nama');
// $tarif_1      = $this->input->post('grouping_tarif_klI');
// $tarif_2      = $this->input->post('grouping_tarif_klII');
// $tarif_3      = $this->input->post('grouping_tarif_klIII');
$tgl_grouper  = $this->input->post('grouping_tgl');
// $grouper      = $this->input->post('grouping_grouper');
$kelas        = $this->input->post('grouping_kelas');
$tarif_op_rs  = $this->input->post('tarif_op_rs');
$tarif_ob_op_rs  = $this->input->post('tarif_ob_op_rs');
$tgl_rs       = $this->input->post('tgl_rs');
$registered = date('Y-m-d H:i:s');
$tgl_ri       = date('Y-m-d', strtotime($tgl_rs));
$tgl_grouper  = date('Y-m-d', strtotime($tgl_grouper));
$jumlah = $tarif_op_rs + $tarif_ob_op_rs; 

$params = array(
    'no_reg'          => $no_reg,
    // 'nama'            => $nama,
    'tanggal'      => $tgl_grouper,
    'tarif_op_rs'     => $tarif_op_rs,
    'tarif_ob_op_rs'  => $tarif_ob_op_rs,
    'tgl_masuk'          => $tgl_ri,
    'kelas'  =>$kelas,
    'registered' => $registered,
    'jumlah' => $jumlah,
);
// echo"<pre>";print_r($params);die();

// memasukkan data array ke dalam tabel
$status = '';
$t_grouper = Tarif_ibs::insert($params);
if ($t_grouper == true) {
    $status = 'ok';
}
$data = array(
    'status' => $status,
);

echo json_encode($data);