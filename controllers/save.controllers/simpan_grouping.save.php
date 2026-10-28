<?php 

$msg = '';

$this->load->model('rme/t_gruper');

$no_reg       = $this->input->post('grouping_no_reg');
$nama         = $this->input->post('grouping_nama');
$tarif_1      = $this->input->post('grouping_tarif_klI');
$tarif_2      = $this->input->post('grouping_tarif_klII');
$tarif_3      = $this->input->post('grouping_tarif_klIII');
$tgl_grouper  = $this->input->post('grouping_tgl');
$grouper      = $this->input->post('grouping_grouper');
$icd1      = $this->input->post('icd1');
$kelas        = $this->input->post('grouping_kelas');
$tarif_rs  = $this->input->post('grouping_tarif_rs');
$tgl_rs       = $this->input->post('tgl_rs');
$date_created = date('Y-m-d H:i:s');
$tgl_ri       = date('Y-m-d', strtotime($tgl_rs));
$tgl_grouper  = date('Y-m-d', strtotime($tgl_grouper));
// pre($icd1);
$params = array(
    'no_reg'       => $no_reg,
    'nama'         => $nama,
    'gruper'       => $grouper,
    'kelas'        => $kelas,
    'tgl_gruper'   => $tgl_grouper,
    'icd1'         => $icd1,
    'tgl_ri'       => $tgl_ri,
    'tarif_1'      => $tarif_1,
    'tarif_2'      => $tarif_2,
    'tarif_3'      => $tarif_3,
    'date_created' => $date_created,
    
);
// echo"<pre>";print_r($params);die();

// memasukkan data array ke dalam tabel
//cek data ada apa tidak

$t_grouper = T_gruper::where('no_reg', $no_reg)
->where('tgl_ri',$tgl_ri)
->where('deleted','0')
->first();

if ($t_grouper) {
    // update data lama
    $t_grouper = T_gruper::where('no_reg', $no_reg)
    ->where('tgl_ri',$tgl_ri)
    ->where('deleted','0')
    ->update(['deleted' => '1']);
    $t_grouper = T_gruper::insert($params);
} else {
    // insert data baru
    // $t_grouper = T_gruper::create($params);
    $t_grouper = T_gruper::insert($params);
}
// pre($t_grouper);
$status = 'ok';
$data = [
    'status' => $status,
    'data'   => $t_grouper
];


// $status = '';
// $t_grouper = T_gruper::insert($params);
// if ($t_grouper == true) {
//     $status = 'ok';
// }
// $data = array(
//     'status' => $status,
// );

echo json_encode($data);