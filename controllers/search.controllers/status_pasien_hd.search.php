<?php 

$this->load->model('Kunjung');
$userid  = $this->input->get('userid');
$no_reg  = $this->input->get('no_reg');
$take    = $this->input->get('limit');
$offset  = $this->input->get('offset');
$sort    = $this->input->get('sort');
$order   = $this->input->get('order');
$search  = $this->input->get('search');
$tanggal = $this->input->get('tanggal');

$rows = [];
$total = 0;
$str_tgl_dirawat = "";

$pasien = DB::table("rsiklaten.pasien as a")
    ->leftJoin('rsiklaten.kawin as b', 'a.kawin', '=', 'b.id_kawin')
    ->where('a.no_reg', $no_reg)
    ->first(['a.no_reg', 'b.nama_kawin']);

$kunjung = DB::table('rsiklaten.kunjung as a')
    ->leftJoin('rsiklaten.poli as b', 'a.kd_poli', '=', 'b.kode_poli')
    ->leftJoin('rsiklaten.dokter as c', 'a.kd_dr', '=', 'c.no_dr')
    ->where('a.no_reg', $no_reg)
    ->whereRaw("a.deleted IS NULL AND CONCAT(a.tanggal, ' ', a.jam) > DATE_ADD(NOW(), INTERVAL -1 DAY)")
    ->orderBy('a.id', 'desc')
    ->first([
        "a.id", 
        "a.tanggal", 
        "a.jam",
        "b.nama_poli", 
        "a.rujuk",
        DB::raw("c.nama2 as nama_dokter")
    ]);

if (!empty($kunjung)) {
    $kunjung = (object) $kunjung;
    
    $kunjung->spm_dokter = null;
    $kunjung->spm_tanggal = null;
    $kunjung->spm_dpjp = null;
    $kunjung->spm_bangsal = null;
    $kunjung->spm_str_tanggal = null;
    $kunjung->spm_str_jam = null;
    
    $surat_mondok = DB::table('rme.surat_mondok as a')
        ->whereRaw("a.no_reg='$no_reg' AND a.tanggal >= '$kunjung->tanggal'")
        ->orderBy('id', 'DESC')
        ->first();
    
    if (!empty($surat_mondok)) {
        $surat_mondok = (object) $surat_mondok;
        $kunjung->spm_dokter = $surat_mondok->dokter_id;
        $kunjung->spm_tanggal = $surat_mondok->tanggal;
        $kunjung->spm_dpjp = $surat_mondok->dokter_ri;
        $kunjung->spm_str_tanggal = tampiltanggal($surat_mondok->tanggal, 9);
        $kunjung->spm_str_jam = tampiltanggal($surat_mondok->registered, 7);
    }
}

$status_kawin = !empty($pasien->nama_kawin) ? $pasien->nama_kawin : '';

$data = [
    "rows"         => $rows,
    "total"        => $total,
    "status_kawin" => $status_kawin,
    "kunjung"      => $kunjung,
];

return $this->output
    ->set_status_header(200)
    ->set_content_type('application/json')
    ->set_output(json_encode($data));