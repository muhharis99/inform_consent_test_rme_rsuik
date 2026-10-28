<?php 
/*khusus HD tak tampilkan hanya tanggal sekarang dan tanggal sebelumnya, haris*/
$no_reg = segment(4);
$this->load->model('Pasien'); 
$this->load->model('Kunjung'); 
$pasien = (object) null; 
$kunjung = (object) null;
$history = (array) null; 

if (!empty($no_reg)) {
    $pasien = Pasien::find($no_reg);
    $pasien = !empty($pasien) ? (object) $pasien : (object) null ;
    $pasien->tanggal_lahir = !empty($pasien->tgl_lahir) ? date("d-m-Y", strtotime($pasien->tgl_lahir)) : "";
    $pasien->tanggal_lahir_admisi = !empty($pasien->tgl_lahir) ? date("d/m/Y", strtotime($pasien->tgl_lahir)) : "";
    $pasien->tanggal_masuk = date("d-m-Y"); 
    $pasien->jam_masuk = date("H:i:s");
    $pasien->tgl_periksa = date("d/m/Y H:i:s"); 
    $pasien->jalan = !empty($pasien->alamat) ? $pasien->alamat : "";
    $pasien->dukuh = "";
    $pasien->rtrw = "";
    $pasien->kelurahan = "";
    $pasien->kecamatan = "";
    $pasien->kabupaten = "";
    $pasien->email = "";
    $pasien->ktp = !empty($pasien->no_id) ? $pasien->no_id : "";
    $pasien->no_kartu_bpjs = !empty($pasien->nopeserta) ? $pasien->nopeserta : ''; 
    
    $jam_praktek = 1; 
    $cara_datang = 1; 

    $th_bln_tgl_sekarang = date("Y-m");
    $kunjung = Kunjung::where('no_reg', $no_reg)
        ->where('deletedstate', '=', 0)
        ->where(function ($query) use ($th_bln_tgl_sekarang) {
            $query->where(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->where('kd_poli', 'HD')
                         ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '=', $th_bln_tgl_sekarang);
            })
            ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->where('kd_poli', '!=', 'HD')
                         ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '<=', $th_bln_tgl_sekarang);
            })
            ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->whereNull('kd_poli');
            });
        })
        ->leftJoin('rsiklaten.poli', function ($join) {
            $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        })
        ->leftJoin('rsiklaten.dokter', function ($join) {
            $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        })
        ->orderBy('kunjung.tanggal', 'DESC')
        ->selectRaw("id, no_reg, rawat, tanggal, jam, antrian, kd_poli, rsiklaten.kunjung.pasien as kd_asuransi, rsiklaten.poli.nama_poli as poli, rsiklaten.kunjung.kd_dr as kd_dokter, rsiklaten.dokter.nama2 as dokter")
        ->first();

    if (!empty($kunjung)) {
        $kunjung->str_tanggal = date("d-m-Y", strtotime($kunjung->tanggal)); 
        $kunjung->tgl_kunjung = str_replace("-", "", $kunjung->tanggal).str_replace(":", "", $kunjung->jam); 
        $kunjung->str_tgl_rs = strtotime($kunjung->tanggal." ".$kunjung->jam);
        $kunjung->jam_praktek = !empty($kunjung->daftar) ? substr($kunjung->daftar, 0, 1) : $jam_praktek;
        $kunjung->cara_datang = !empty($kunjung->rujuk) ? $kunjung->rujuk : $cara_datang;
    }

    $history = Kunjung::where('no_reg', $no_reg)
        ->where('deletedstate', '=', 0)
        ->where(function ($query) use ($th_bln_tgl_sekarang) {
            $query->where(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->where('kd_poli', 'HD')
                         ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '=', $th_bln_tgl_sekarang);
            })
            ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->where('kd_poli', '!=', 'HD')
                         ->where(DB::raw("DATE_FORMAT(tanggal, '%Y-%m')"), '<=', $th_bln_tgl_sekarang);
            })
            ->orWhere(function ($subquery) use ($th_bln_tgl_sekarang) {
                $subquery->whereNull('kd_poli');
            });
        })
        ->leftJoin('rsiklaten.poli', function ($join) {
            $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        })
        ->leftJoin('rsiklaten.dokter', function ($join) {
            $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        })
        ->orderBy('kunjung.tanggal', 'DESC')
        ->get(array(
            'id', 'no_reg', 'rawat', 'tanggal', 'jam', 'antrian', 
            DB::RAW('rsiklaten.poli.nama_poli as poli'), 
            DB::RAW('rsiklaten.dokter.nama2 as dokter')
        ));
}

$data = array(
    "pasien" => $pasien,
    "riwayat" => $kunjung,
    "history" => $history
);
echo json_encode($data); 

        // $no_reg = segment(4);
        // $this->load->model('Pasien'); 
        // $this->load->model('Kunjung'); 
        // $pasien = (object) null; 
        // $kunjung = (object) null;
        // $history = (array) null; 
        // if (!empty($no_reg)) {
        //     $pasien = Pasien::find($no_reg);
        //     $pasien = !empty($pasien) ? (object) $pasien : (object) null ;
        //         $pasien->tanggal_lahir = !empty($pasien->tgl_lahir) ? date("d-m-Y", strtotime($pasien->tgl_lahir)) : "";
        //         $pasien->tanggal_lahir_admisi = !empty($pasien->tgl_lahir) ? date("d/m/Y", strtotime($pasien->tgl_lahir)) : "";
        //         $pasien->tanggal_masuk = date("d-m-Y"); 
        //         $pasien->jam_masuk = date("H:i:s");
        //         $pasien->tgl_periksa = date("d/m/Y H:i:s"); 
        //         $pasien->jalan = !empty($pasien->alamat) ? $pasien->alamat : "";
        //         $pasien->dukuh = "";
        //         $pasien->rtrw = "";
        //         $pasien->kelurahan = "";
        //         $pasien->kecamatan = "";
        //         $pasien->kabupaten = "";
        //         $pasien->email = "";
        //         $pasien->ktp = !empty($pasien->no_id) ? $pasien->no_id : "";
        //         $pasien->no_kartu_bpjs = !empty($pasien->nopeserta) ? $pasien->nopeserta : ''; 
        //     $jam_praktek = 1; 
        //     $cara_datang = 1; 
        //     $kunjung = Kunjung::where('no_reg', $no_reg)->where('deletedstate', '=', 0)
        //         ->leftJoin('rsiklaten.poli', function ($join) {
        //             $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        //         })
        //         ->leftJoin('rsiklaten.dokter', function ($join) {
        //             $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        //         })
        //         ->orderBy('kunjung.tanggal', 'DESC')
        //         ->selectRaw("id, no_reg, rawat, tanggal, jam, antrian, kd_poli, rsiklaten.kunjung.pasien as kd_asuransi, rsiklaten.poli.nama_poli as poli, rsiklaten.kunjung.kd_dr as kd_dokter, rsiklaten.dokter.nama2 as dokter")->first();
        //     if (!empty($kunjung)) {
        //         $kunjung->str_tanggal = date("d-m-Y", strtotime($kunjung->tanggal)); 
        //         $kunjung->tgl_kunjung = str_replace("-", "", $kunjung->tanggal).str_replace(":", "", $kunjung->jam); 
        //         $kunjung->str_tgl_rs = strtotime($kunjung->tanggal." ".$kunjung->jam);
        //         $kunjung->jam_praktek = !empty($kunjung->daftar) ? substr($kunjung->daftar, 0, 1) : $jam_praktek;
        //         $kunjung->cara_datang = !empty($kunjung->rujuk) ? $kunjung->rujuk : $cara_datang;
        //     }
        //     $history = Kunjung::where('no_reg', $no_reg)->where('deletedstate', '=', 0)
        //         ->leftJoin('rsiklaten.poli', function ($join) {
        //             $join->on('kunjung.kd_poli', '=', 'rsiklaten.poli.kode_poli');
        //         })
        //         ->leftJoin('rsiklaten.dokter', function ($join) {
        //             $join->on('kunjung.kd_dr', '=', 'rsiklaten.dokter.no_dr');
        //         })
        //         ->orderBy('kunjung.tanggal', 'DESC')
        //         ->get(array('id', 'no_reg', 'rawat', 'tanggal', 'jam', 'antrian', DB::RAW('rsiklaten.poli.nama_poli as poli'), DB::RAW('rsiklaten.dokter.nama2 as dokter')));
        // }
        // $data = array(
        //     "pasien" => $pasien,
        //     "riwayat" => $kunjung,
        //     "history" => $history
        // );
        // echo json_encode($data); 