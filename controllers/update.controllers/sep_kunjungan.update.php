<?php 

$this->load->model('pasien');
$this->load->model('Antri');
$this->load->model('Kunjung');
$this->load->model('Mutasi_ri');
$this->load->model('Respon_time_admisi');
$this->load->model('Rsiklaten_inap');
$this->load->model('Sep');
$this->load->model('Soap');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$no_reg = null;
$data = null; 
// $no_reg = !empty(segment(4))?segment(4):null;
$no_reg = $this->input->post('no_reg');
$tgl_sep = $this->input->post('tgl_sep');
$msg = [];
if (!empty($no_reg)) {
    $rows_sep = Sep::where('noMr', $no_reg)->where('tglSEP', $tgl_sep)->get();
    if (!empty($rows_sep)) {
        $arr_kdPoli = [];
        foreach ($rows_sep as $row_sep) {
            /** cek kode poli di sep2  */
            if (trim($row_sep['kdPoli'])=='') {
                $row_antreanrs_poli = DB::table('bpjs.antreanrs_ref_poli')->whereRaw("nmsubspesialis = '".$row_sep['nmPoli']."' or nmpoli = '".$row_sep['nmPoli']."'")->first(['kdPoli']);
                // json($row_antreanrs_poli);
                if (!empty($row_antreanrs_poli['kdPoli'])) 
                    Sep::where('id', $row_sep['id'])->update([
                        'kdPoli' => $row_antreanrs_poli['kdPoli']
                    ]);
                $msg[] = 'Kode poli berhasil diperbarui';
                $status = true;
            }
            /** cek kunjungan igd dan poliklinik */
            $arr_kdPoli[] = $row_sep['kdPoli'];
        }
    }
    if (!in_array('IGD', $arr_kdPoli)&&$status==false) {
        /** update relasi kunjung IGD jadi umum */
        $rows_kunjung_ugd = Kunjung::whereNull('deleted')->where('no_reg', $no_reg)->whereNotNull('kd_dr')->where('tanggal', $tgl_sep)->where('kd_poli', 'UGD')->get();
        if (!empty($rows_kunjung_ugd)) {
            $arr_relasi = [];
            foreach ($rows_kunjung_ugd as $key => $row_kunjung_ugd) {
                $arr_relasi[] = $row_kunjung_ugd['pasien'];
            }
            if (!in_array("001", $arr_relasi)) {
                Kunjung::whereNull('deleted')->where('no_reg', $no_reg)->whereNotNull('kd_dr')->where('tanggal', $tgl_sep)->where('kd_poli', 'UGD')->update([
                    "pasien" => "001"
                ]);
                $msg[] = "Ganti relasi kunjungan UGD jadi Umum";
                $status = true;
            }
        }
    }
    if ($status==false) {
        /** update jam kunjung sesuai soap */
        $rows_soap = Soap::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_sep)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->get();
        if (!empty($rows_soap)) {
            $jam_masuk = $kd_poli = $kd_dr = null; 
            foreach ($rows_soap as $key => $soap) {
                if (in_array($soap['kd_asuransi'], ['300', '301', '302', '303', '304', '305', '306'])) $jam_masuk = $soap['jam_masuk'];
                if (in_array($soap['kd_asuransi'], ['300', '301', '302', '303', '304', '305', '306'])) $kd_poli = $soap['kd_poli'];
                if (in_array($soap['kd_asuransi'], ['300', '301', '302', '303', '304', '305', '306'])) $kd_dr = $soap['kd_dr'];
            }
            if (!empty($jam_masuk)) {
                Kunjung::where('no_reg', $no_reg)->whereNull('deleted')->where('tanggal', $tgl_sep)->where('kd_poli', $kd_poli)->where('kd_dr', $kd_dr)->update(['jam' => $jam_masuk]);
                $status = true;
            }
        }
    }
    if ($status==false) {
        $rows_kunjung_poli = Kunjung::whereNull('deleted')->where('no_reg', $no_reg)->whereNotNull('kd_dr')->where('tanggal', $tgl_sep)->whereNotIn('kd_poli', ['UGD', 'PNEK'])->orderBy('id', 'desc')->get();
        if (!empty($rows_kunjung_poli)) {
            $kd_asuransi = $kd_poli = $kd_dr = $jam_masuk = null; 
            foreach ($rows_kunjung_poli as $key => $row_kunjung_poli) {
                if (in_array($row_kunjung_poli['pasien'], ['300', '301', '302', '303', '304', '305', '306'])) $kd_asuransi = $row_kunjung_poli['pasien'];
                if (in_array($row_kunjung_poli['pasien'], ['300', '301', '302', '303', '304', '305', '306'])) $kd_poli = $row_kunjung_poli['kd_poli'];
                if (in_array($row_kunjung_poli['pasien'], ['300', '301', '302', '303', '304', '305', '306'])) $kd_dr = $row_kunjung_poli['kd_dr'];
            }
            if (!empty($kd_asuransi)) {
                Soap::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_sep)->whereNotNull('kd_poli')->whereNotNull('kd_dr')->update(["kd_asuransi" => $kd_asuransi]);
                $status = true;
            }
        }
        // json($rows_kunjung_poli);
    }
}
$data = [
    "status" => $status, 
    "response" => "Selesai", 
    "message" => $msg
];
json($data); 