<?php 

$this->load->model('pasien');
$this->load->model('Antri');
$this->load->model('Kunjung');
$this->load->model('Mutasi_ri');
$this->load->model('Respon_time_admisi');
$this->load->model('Rsiklaten_inap');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$id_kunjung        = $this->input->post('id_kunjung');
$no_reg        = $this->input->post('no_reg');
$nama          = $this->input->post('nama');
$alamat        = $this->input->post('alamat');
$tgl_lahir     = substr($this->input->post('tgl_lahir'), 6, 4)."-".substr($this->input->post('tgl_lahir'), 3, 2)."-".substr($this->input->post('tgl_lahir'), 0, 2);
$umur          = $this->input->post('umur');
$ktp           = $this->input->post('ktp');
$jenis_kelamin = $this->input->post('jenis_kelamin');
$telp_1 = $this->input->post('telp_1');
$telp_2 = $this->input->post('telp_2');
$kode_agama = $this->input->post('kode_agama');
$kode_kerja = $this->input->post('kode_kerja');
$tgl_masuk = substr($this->input->post('tgl_periksa'), 6, 4)."-".substr($this->input->post('tgl_periksa'), 3, 2)."-".substr($this->input->post('tgl_periksa'), 0, 2);
$jam_masuk = $this->input->post('jam_periksa');
$kode_asuransi = $this->input->post('kode_asuransi');
$kode_poli = $this->input->post('kode_poli');
$kode_dokter = $this->input->post('kode_dokter');
$tgl_dirawat = substr($this->input->post('tgl_dirawat'), 6, 4)."-".substr($this->input->post('tgl_dirawat'), 3, 2)."-".substr($this->input->post('tgl_dirawat'), 0, 2);
$jam_dirawat = $this->input->post('jam_dirawat');
$tgl_mulai_admisi = substr($this->input->post('tgl_mulai_admisi'), 6, 4)."-".substr($this->input->post('tgl_mulai_admisi'), 3, 2)."-".substr($this->input->post('tgl_mulai_admisi'), 0, 2)." ".substr($this->input->post('tgl_mulai_admisi'), 11, 8);
$kode_bangsal = $this->input->post('kode_bangsal');
$no_bed = $this->input->post('no_bed');
$tgl_selesai_admisi = substr($this->input->post('tgl_selesai_admisi'), 6, 4)."-".substr($this->input->post('tgl_selesai_admisi'), 3, 2)."-".substr($this->input->post('tgl_selesai_admisi'), 0, 2)." ".substr($this->input->post('tgl_selesai_admisi'), 11, 8);
$kode_asuransi_ri = $this->input->post('kode_asuransi_ri');
$hak_kelas = $this->input->post('hak_kelas');
$dpjp_1 = $this->input->post('dpjp_1');
$dpjp_2 = $this->input->post('dpjp_2');
$dpjp_3 = $this->input->post('dpjp_3');
$dpjp_4 = $this->input->post('dpjp_4');
$dpjp_5 = $this->input->post('dpjp_5');
$nama_penanggung_jawab           = $this->input->post('nama_penanggung_jawab');
$alamat_penanggung_jawab         = $this->input->post('alamat_penanggung_jawab');
$tgl_lahir_penanggung_jawab      = substr($this->input->post('tgl_lahir_penanggung_jawab'), 6, 4)."-".substr($this->input->post('tgl_lahir_penanggung_jawab'), 3, 2)."-".substr($this->input->post('tgl_lahir_penanggung_jawab'), 0, 2);
$jenis_kelamin_penanggung_jawab  = $this->input->post('jenis_kelamin_penanggung_jawab');
$no_ktp_penanggung_jawab         = $this->input->post('no_ktp_penanggung_jawab');
$no_telp_penanggung_jawab        = $this->input->post('no_telp_penanggung_jawab');
$pekerjaan_penanggung_jawab      = $this->input->post('pekerjaan_penanggung_jawab');
$pekerjaan_penanggung_jawab_lain = $this->input->post('pekerjaan_penanggung_jawab_lain');
$hub_penanggung_jawab            = $this->input->post('hub_penanggung_jawab');
$nama_darurat_1       = $this->input->post('nama_darurat_1');
$alamat_darurat_1     = $this->input->post('alamat_darurat_1');
$umur_darurat_1       = $this->input->post('umur_darurat_1');
$telp_darurat_1       = $this->input->post('telp_darurat_1');
$hub_darurat_1        = $this->input->post('hub_darurat_1');
$nama_darurat_2       = $this->input->post('nama_darurat_2');
$alamat_darurat_2     = $this->input->post('alamat_darurat_2');
$umur_darurat_2       = $this->input->post('umur_darurat_2');
$telp_darurat_2       = $this->input->post('telp_darurat_2');
$hub_darurat_2        = $this->input->post('hub_darurat_2');
$nama_darurat_3       = $this->input->post('nama_darurat_3');
$alamat_darurat_3     = $this->input->post('alamat_darurat_3');
$umur_darurat_3       = $this->input->post('umur_darurat_3');
$telp_darurat_3       = $this->input->post('telp_darurat_3');
$hub_darurat_3        = $this->input->post('hub_darurat_3');
$registered           = date("Y-m-d H:i:s");
// pre($tgl_mulai_admisi);

/* cari kode kelas bangsal */ 
$bangsal = DB::table('rme.bangsal as a')->where('kd_bangsal', $kode_bangsal)->first(array('kd_kelas'));
$kode_kelas_bangsal = "";
$perujuk_nama       = "";
$perujuk_alamat     = "";
$asal               = '';
$kd_dr              = '';
$kode_poli_dpjp     = "";
$kode_rujuk         = 1;
// pre($bangsal);
if (!empty($bangsal)) {
    $bangsal = (object) $bangsal;
    $kode_kelas_bangsal = $bangsal->kd_kelas;
}
// pre((string) $id_kunjung);
/* cari asal kunjungan */ 
if ((string) $id_kunjung != "") {
    $kunjung = Kunjung::where('id', $id_kunjung);
    DB::transaction(function () use ($kunjung, &$registered, &$user) {
        $kunjung->update(array('rawat' => "J"));
    });
} else {
    $kunjung = Kunjung::where('tanggal', $tgl_masuk)->whereRaw("LEFT('$jam_masuk', 5)=LEFT(jam, 5)")->where('no_reg', $no_reg)->whereNull('deleted')->orderBy('id', 'desc')->first();
    if (!empty($kunjung)) {
        savelog($no_reg, "rsiklaten", "kunjung", $kunjung, $writer);
        $kunjung = (object) $kunjung; 
        $id_kunjung = $kunjung->id; 
        switch ($kunjung->rawat) {
            case 'G' : 
                DB::table('rsiklaten.kunjung')->where('id', $kunjung->id)
                    ->update(array(
                        'rawat' => 'J',
                    ));
                break; 
            case 'I' : 
                DB::table('rsiklaten.kunjung')->where('id', $kunjung->id)
                    ->update(array(
                        'deleted' => $registered, 
                        'deletedby' => $user, 
                        'deletedstate' => 1
                    ));
                break; 
        }
    }
    /*
    $kunjung->deletedstate = 1;
    $kunjung->deleted      = $registered;
    $kunjung->deletedby    = $user;
    DB::transaction(function () use ($kunjung, &$registered, &$user) {
        $kunjung->update(array('deletedstate' => 1, 'deleted' => $registered, 'deletedby' => $user));
    });
    */
}
// pre($tgl_masuk);
/* cari data di mutasi ri */ 
$mutasi_ri         = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted');
DB::transaction(function () use ($mutasi_ri, &$registered, &$user) {
    $mutasi_ri->update(array('deletedstate' => 1, 'deleted' => $registered, 'deletedby' => $user));
});
/* simpan respon time */
$respon_time_admisi         = Respon_time_admisi::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('jam_masuk', $jam_masuk)->whereNull('deleted');
DB::transaction(function () use ($respon_time_admisi, &$registered, &$user) {
    $respon_time_admisi->update(array('deleted' => $registered));
});

/* update data pasien */ 
$pasien = Pasien::find($no_reg); 
savelog($no_reg, "rsiklaten", "pasien", $pasien, $writer);
$pasien->tgl_masuk        = $tgl_masuk;
$pasien->jam_masuk        = $jam_masuk;
$pasien->tgl_ri           = NULL;
$pasien->jam_ri           = NULL;
$pasien->kd_dr_ri1        = NULL;
$pasien->kd_dr_ri2        = NULL;
$pasien->rawat            = 'J';
$pasien->kelas            = NULL;
$pasien->bangsal          = NULL;
$pasien->no_bed           = NULL;
$pasien->pulang           = 1;
$pasien->tgl_keluar       = NULL;
$pasien->jam_keluar       = NULL;
$pasien->umur             = $umur;
$pasien->perujuk          = NULL;
$pasien->alamat_perujuk   = NULL;
$pasien->pj               = NULL;
$pasien->alamat_pj        = NULL;
$pasien->pjdarurat        = NULL;
$pasien->alamat_pjdarurat = NULL;
$pasien->pasien           = NULL;
$pasien->no_kp            = "";
DB::transaction(function () use ($pasien) {
    $pasien->save();
});

/* insert update rsiklaten.inap */
/*
$rsiklaten_inap = Rsiklaten_inap::firstOrNew(array('no_reg' => $no_reg, 'tgl_masuk' => $tgl_masuk, 'jam_masuk' => $jam_masuk));
$rsiklaten_inap->nama      = $nama;
$rsiklaten_inap->tgl_lahir  = $tgl_lahir;
$rsiklaten_inap->tgl_masuk  = $tgl_masuk;
$rsiklaten_inap->jam_masuk  = $jam_masuk;
$rsiklaten_inap->no_reg     = $no_reg;
$rsiklaten_inap->tgl_ri     = $tgl_dirawat;
$rsiklaten_inap->jam_ri     = $jam_dirawat;
$rsiklaten_inap->kd_poli    = $kode_poli_dpjp;
$rsiklaten_inap->kd_dr      = $dpjp_1;
$rsiklaten_inap->kd_dr_ri1  = $dpjp_1;
$rsiklaten_inap->kd_dr_ri2  = $dpjp_2;
$rsiklaten_inap->kd_dr_ri3  = $dpjp_3;
$rsiklaten_inap->kelas      = $kode_kelas_bangsal;
$rsiklaten_inap->bangsal    = $kode_bangsal;
$rsiklaten_inap->no_bed     = $no_bed;
$rsiklaten_inap->rujuk      = $kode_rujuk;
$rsiklaten_inap->nmrujuk    = $perujuk_nama;
$rsiklaten_inap->pasien     = $kode_asuransi_ri;
$rsiklaten_inap->inapke     = 1;
$rsiklaten_inap->tgl_keluar = NULL;
$rsiklaten_inap->jam_keluar = NULL;
$rsiklaten_inap->pjawab     = $nama_penanggung_jawab;
$rsiklaten_inap->almjawab   = $alamat_penanggung_jawab;
$rsiklaten_inap->hubjawab   = $hub_penanggung_jawab;
$rsiklaten_inap->pjamin     = $nama_darurat_1;
$rsiklaten_inap->almjamin   = $alamat_darurat_1;
$rsiklaten_inap->hubjamin   = $hub_darurat_1;
$rsiklaten_inap->kodebu     = $kelas_askes;
$rsiklaten_inap->pulang     = 0;
$rsiklaten_inap->statusplg  = NULL;
$rsiklaten_inap->lunas      = NULL;
DB::transaction(function () use ($rsiklaten_inap) {
    $rsiklaten_inap->save();
});
*/
$status = true; 


$xdata=array(
	"sec"=>"sync", 
	"opt"=>"batalinap", 
	"xht"=>"1",
	"norm"=>"$no_reg");

$url='http://192.168.0.11/pendaftaran/service.php';
$data=json_encode($xdata);
$headers= array('auth:4NN4B3L', 'Content-type: application/json');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
// $xresult = curl_exec($ch);
curl_close($ch);

$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
    'ur_tgl_rs'    => str_replace("-", "", $tgl_masuk).str_replace(":", "", $jam_masuk) 
);
echo json_encode($data);