<?php 

$this->load->model('dokter');
$rows_dokter = Dokter::whereNotNull('nip')->get(['no_dr', 'nama2', 'nip', 'sip']);
$status = true;
if (!empty($rows_dokter)) {
    foreach ($rows_dokter as $row_dokter) {
        $row_dokter = (object) $row_dokter;
        // echo "<br />".$row_dokter->nama2."|nip:".$row_dokter->nip."|ex:".$row_dokter->sip."|new:";
        $content = file_get_contents('http://192.168.0.16:555/api/sdm/sip_karyawan?nip='.$row_dokter->nip);
        // pre($content);
        $res_content = json_decode($content); 
        if (!empty($res_content->data->no_dokumen)) {
            if (strlen($res_content->data->no_dokumen) > 3) {
                // echo $res_content->data->no_dokumen;
                DB::update("update rsiklaten.dokter set sip = '".$res_content->data->no_dokumen."' where no_dr = '".$row_dokter->no_dr."'");
            }
        }
    }
}
// die();
$data = array(
    'status'        => $status,
);
echo json_encode($data);