<?php

$this->load->model('ttd_pasien');

$no_reg = $this->input->post('no_reg');
$asal = $this->input->post('asal');
$tgl_rs = $this->input->post('tgl_masuk');
$tgl_masuk = date('Y-m-d', strtotime($tgl_rs));
$jam_masuk = date('H:i', strtotime($tgl_rs));
$nama_ttd = $this->input->post('nama_ttd');
$uri_image = $this->input->post('uri_image');

$status = false;

$ttd = Ttd_Pasien::firstOrNew(array(
    'no_reg' => $no_reg,
    'asal' => $asal,
    'tgl_masuk' => $tgl_masuk,
    'jam_masuk' => $jam_masuk
));

$ttd->no_reg = $no_reg;
$ttd->nama_ttd = $nama_ttd;
$ttd->asal = $asal;
$ttd->tgl_masuk = $tgl_masuk;
$ttd->jam_masuk = $jam_masuk;

$dir = FCPATH . "assets/rme/ttd_pasien/";

if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$encoded_image = explode(",", $uri_image)[1];
$decoded_image = base64_decode($encoded_image);
$nama_file = $no_reg . "_" . $asal . "_" . "$tgl_masuk" . ".png";
file_put_contents($dir . "/" . $nama_file, $decoded_image);
$ttd->file = $nama_file;

DB::transaction(function () use ($ttd, &$status) {
    $ttd->save();
    $status = true;
});

$data = (object) array(
    'nama_file' => $nama_file,
    'dir' => $dir . "/" . $nama_file,
    'status' => $status,
);

echo json_encode($data);