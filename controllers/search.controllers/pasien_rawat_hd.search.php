<?php

$this->load->model('Kunjung_hd');
$this->load->model('Jadwal_HD');

$userid  = $this->input->get('userid');
$no_reg  = $this->input->get('no_reg');
$take    = $this->input->get('limit');
$offset  = $this->input->get('offset');
$sort    = $this->input->get('sort');
$order   = $this->input->get('order');
$search  = $this->input->get('search');
$tanggal = $this->input->get('tanggal');
$rows = [];
$grand_total = 0;

/*if (ipclient() == "172.16.18.21X") {
    $sort = "tgl_masuk";
    $rows_data = DB::select("
        SELECT * 
        FROM rsiklaten.pasien a 
        WHERE a.no_reg LIKE '%$search%' 
        OR a.nama LIKE '%$search%' 
        OR a.alamat LIKE '%$search%' 
        OR a.no_id LIKE '%$search%' 
        OR a.nopeserta LIKE '%$search%' 
        OR a.tgl_lahir LIKE '%$search%' 
        ORDER BY $sort $order 
        LIMIT $offset, $take
    ");
    
    $total = array_column(DB::select("
        SELECT COUNT(no_reg) AS total 
        FROM rsiklaten.pasien a 
        WHERE a.no_reg LIKE '%$search%' 
        OR a.nama LIKE '%$search%' 
        OR a.alamat LIKE '%$search%' 
        OR a.no_id LIKE '%$search%' 
        OR a.nopeserta LIKE '%$search%' 
        OR a.tgl_lahir LIKE '%$search%'
    "), 'total')[0];
    
    $pekerjaan = array_column(DB::table('rsiklaten.pekerjaan')->get(['kd_pekerjaan', 'pekerjaan']), 'pekerjaan', 'kd_pekerjaan');
    $agama = array_column(DB::table('rsiklaten.agama')->get(['kd_agama', 'agama']), 'agama', 'kd_agama');
    $perkawinan = array_column(DB::table('rsiklaten.perkawinan')->get(['kd_perkawinan', 'nama_perkawinan']), 'nama_perkawinan', 'kd_perkawinan');
    $bahasa = array_column(DB::table('rsiklaten.bahasa')->get(['kd_bahasa', 'nama_bahasa']), 'nama_bahasa', 'kd_bahasa');
    $etnis = array_column(DB::table('rsiklaten.etnis')->get(['kd_etnis', 'nama_etnis']), 'nama_etnis', 'kd_etnis');
    
    foreach ($rows_data as $row) {
        $row = (object) $row;
        $arr_default = ['kode_poli', 'nama_poli', 'kode_dokter', 'nama_dokter', 'ktp', 'str_tgl_periksa', 'str_jam_periksa', 'str_tgl_jam_periksa', 'tgl_periksa', 'jam_periksa', 'umur', 'nama_asuransi', 'kode_asuransi', 'nama_agama', 'telp_1', 'telp_2', 'nama_pekerjaan', 'nama_agama', 'nama_bahasa', 'kode_bangsal', 'nama_bangsal', 'kode_dpjp_1', 'nama_dpjp_1'];
        
        $row->str_tgl_lahir = strtoupper(tampiltanggal($row->tgl_lahir, 9));
        $row->nama_pekerjaan = $pekerjaan[$row->pekerjaan] ?? "";
        $row->nama_bahasa = $bahasa[$row->bahasa] ?? "";
        $row->nama_agama = $agama[$row->agama] ?? "";
        $row->jenis_kelamin = in_array($row->jenis_kel, ['L', '1']) ? "LAKI-LAKI" : (in_array($row->jenis_kel, ['P', '2']) ? "PEREMPUAN" : "");
        $row->jenis_kel = in_array($row->jenis_kel, ['L', '1']) ? "L" : (in_array($row->jenis_kel, ['P', '2']) ? "P" : "");

        if (!empty($kunjung_hd)) {
            $kunjung_hd = (object) $kunjung_hd;
            $row->kode_poli = $kunjung_hd->kode_poli;
            $row->nama_poli = $kunjung_hd->nama_poli;
            $row->kode_dokter = $kunjung_hd->no_dr;
            $row->nama_dokter = $kunjung_hd->nama2;
            $row->str_tgl_periksa = tampiltanggal($kunjung_hd->tanggal, 9);
            $row->str_jam_periksa = substr($kunjung_hd->jam, 0, 5);
            $row->str_tgl_jam_periksa = tampiltanggal($kunjung_hd->tanggal, 9) . " " . substr($kunjung_hd->jam, 0, 5);
            $row->tgl_periksa = $kunjung_hd->tanggal;
            $row->jam_periksa = $kunjung_hd->jam;
            $row->umur = selisihymdhis($row->tgl_periksa, $row->tgl_lahir, "umur");
            $row->nama_asuransi = $kunjung_hd->nama_asuransi;
            $row->kode_asuransi = $kunjung_hd->kode_asuransi;
        }

        $rows[] = $row;
    }

    $data = [
        "rows" => $rows,
        "total" => $total,
    ];
    
    return $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    die();
}*/
$rows_data = DB::table("rsiklaten.pasien as a")
    ->leftJoin('rsiklaten.pekerjaan as b', 'a.pekerjaan', '=', 'b.kd_pekerjaan')
    ->leftJoin('rsiklaten.agama as c', 'a.agama', '=', 'c.kd_agama')
    ->leftJoin('rsiklaten.perkawinan as d', 'a.kawin', '=', 'd.kd_perkawinan')
    ->leftJoin('rsiklaten.pendidikan as e', 'a.didik', '=', 'e.kd_pendidikan')
    ->leftJoin('rsiklaten.bahasa as f', 'a.bahasa', '=', 'f.kd_bahasa')
    ->leftJoin('rsiklaten.etnis as g', 'a.etnis', '=', 'g.kd_etnis')
    ->leftJoin('rsiklaten.asuransi as h','a.pasien','=','h.NO_REL')
    ->where(function($query) use ($search) {
        $query->where('a.no_reg', 'like', "%$search%")
              ->orWhere('a.nama', 'like', "%$search%");
    })
    ->take($take)
    ->offset($offset)
    ->orderBy('a.tgl_masuk', 'DESC')
    ->orderBy($sort, $order)
    ->select([
        "a.no_reg as no_reg",
        "a.nama",
        "a.tgl_lahir",
        "a.umur",
        "a.jenis_kel",
        "a.tgl_masuk as tanggal",
        "a.tgl_masuk as ur_tgl_rs",
        "a.kd_poli as kode_poli",
        "a.alamat",
        "a.kd_daerah",
        DB::raw("h.NAMA as asuransi_nama"),
        DB::raw("a.pasien as asuransi_id"),
        DB::raw("a.nopeserta as no_kartu"),
        DB::raw("a.no_id as ktp"),
        DB::raw("a.telp as telp_1"),
        DB::raw("a.telp2 as telp_2"),
        DB::raw("a.pekerjaan as kode_pekerjaan"),
        DB::raw("b.pekerjaan as nama_pekerjaan"),
        DB::raw("a.agama as kode_agama"),
        DB::raw("c.agama as nama_agama"),
        DB::raw("a.kawin as kode_perkawinan"),
        DB::raw("d.nama_perkawinan as nama_perkawinan"),
        DB::raw("a.didik as kode_pendidikan"),
        DB::raw("e.pendidikan as nama_pendidikan"),
        DB::raw("a.bahasa as kode_bahasa"),
        DB::raw("f.nama_bahasa as nama_bahasa"),
        DB::raw("a.etnis as kode_etnis"),
        DB::raw("g.nama_etnis as nama_etnis"),
    ])
    ->get();

$rows = [];

foreach ($rows_data as $row) {
    $row = (object) $row;
    $arr_default = ['no_reg', 'kode_poli', 'nama_poli', 'kode_dokter', 'nama_dokter', 'ktp', 'str_tgl_periksa', 'str_jam_periksa', 'str_tgl_jam_periksa', 'tgl_periksa', 'jam_periksa', 'umur', 'nama_agama', 'telp_1', 'telp_2', 'nama_pekerjaan', 'nama_agama', 'nama_bahasa', 'kode_bangsal', 'nama_bangsal', 'kode_dpjp_1', 'nama_dpjp_1','no_kertu','asuransi_nama'];

    foreach ($arr_default as $key => $value) {
        // $row->$value = '';
    }

    $row->str_tgl_lahir = strtoupper(tampiltanggal($row->tgl_lahir, 9));
    $row->no_reg = $row->no_reg;
    $row->nama = $row->nama;
    $row->alamat = $row->alamat;
    $row->kd_daerah = $row->kd_daerah;
    $row->ktp = $row->ktp;
    $row->nama_pekerjaan = $row->nama_pekerjaan;
    $row->nama_bahasa = $row->nama_bahasa;
    $row->nama_agama = $row->nama_agama;
    $row->no_kartu = $row->no_kartu;
    $row->asuransi_id = $row->asuransi_id;

    $row->asuransi_nama = $row->asuransi_nama;

    switch ($row->jenis_kel) {
        case 'L':
        case '1':
            $row->jenis_kelamin = "LAKI-LAKI";
            $row->jenis_kel = "L";
            break;
        case 'P':
        case '2':
            $row->jenis_kelamin = "PEREMPUAN";
            $row->jenis_kel = "P";
            break;
    }

    $kunjung_hd = DB::table('rsiklaten.kunjung_hd as a')
        ->leftJoin('rsiklaten.poli as b', 'a.kd_poli', '=', 'b.kode_poli')
        ->leftJoin('rsiklaten.dokter as c', 'a.kd_dr', '=', 'c.no_dr')
        ->leftJoin('rsiklaten.asuransi as d', 'a.pasien', '=', 'd.no_rel')
        ->leftJoin('rsiklaten.jadwal_hd as jd', 'a.no_reg', '=', 'jd.no_reg')
        ->where(function($query) {
            $query->whereNull('jd.deleted')
                  ->orWhere('jd.deleted', '');
        })
        ->whereNull('a.deleted')
        ->whereNotNull('a.tanggal')
        ->where('a.no_reg', $row->no_reg)
        ->orderBy('a.tanggal', 'DESC')
        ->orderBy('a.jam', 'DESC')
        ->first([
            'b.nama_poli',
            'b.kode_poli',
            'a.tanggal as tanggal',
            'a.tanggal as tgl_rs',
            'a.jam',
            'c.nama2',
            'c.no_dr',
            'jd.kd_dr',
            'jd.tanggal as tanggal_jadwal',
            'jd.jam as jam_jadwal',
            'jd.asuransi_id',
    
            'jd.nama_pegang_akses',
            'jd.hub_keluarga',
            'jd.diagnosa',
            'jd.pengobatan',
            'jd.ruang_pasien',
            'jd.tgl_awal_1',
            'jd.tgl_ulang_1',
            'jd.tgl_ulang_2',
            'jd.tgl_ulang_3',
            'jd.tgl_ulang_4',
            'jd.tgl_ulang_5',
            'jd.tgl_ulang_6',
            'jd.tgl_ulang_7',
            'jd.tgl_ulang_8',
            'jd.tgl_ulang_9',
            'jd.tgl_ulang_10',
            'jd.tgl_ulang_11',
            'jd.tgl_ulang_12',
            'jd.tgl_ulang_13',
            'jd.tgl_ulang_14',
            'jd.tgl_ulang_15',
            'jd.tgl_ulang_16',
            'jd.tgl_ulang_17',
            'jd.tgl_ulang_18',
            'jd.tgl_ulang_19',
            'jd.tgl_ulang_20',
            'jd.tgl_ulang_21',
            'jd.tgl_ulang_22',
            'jd.tgl_ulang_23',
            'jd.tgl_ulang_24',
            'jd.tgl_ulang_25',
            'jd.tgl_ulang_26',
            'jd.tgl_ulang_27',
            'jd.tgl_ulang_28',
            'jd.tgl_ulang_29',
            'jd.tgl_ulang_30',
            'jd.tgl_ulang_31',

            'jd.hari_1',
            'jd.hari_2',
            'jd.hari_3',
            'jd.hari_4',
            'jd.hari_5',
            'jd.hari_6',
            'jd.hari_7',
            'jd.hari_8',
            'jd.hari_9',
            'jd.hari_10',
            'jd.hari_11',
            'jd.hari_12',
            'jd.hari_13',
            'jd.hari_14',
            'jd.hari_15',
            'jd.hari_16',
            'jd.hari_17',
            'jd.hari_18',
            'jd.hari_19',
            'jd.hari_20',
            'jd.hari_21',
            'jd.hari_22',
            'jd.hari_23',
            'jd.hari_24',
            'jd.hari_25',
            'jd.hari_26',
            'jd.hari_27',
            'jd.hari_28',
            'jd.hari_29',
            'jd.hari_30',
            'jd.hari_31',
            'jd.deleted',

            'jd.status_daftar',
            DB::raw('a.pasien as asuransi_id'),
            DB::raw('d.nama as asuransi_nama')
        ]);

    $row->umur = $row->umur;
    $row->tgl_lahir = $row->tgl_lahir;

    if (!empty($kunjung_hd)) {
        $kunjung_hd = (object) $kunjung_hd;
        $row->kode_poli = $kunjung_hd->kode_poli;
        $row->nama_poli = $kunjung_hd->nama_poli;
        $row->kode_dokter = $kunjung_hd->no_dr;
        $row->nama_dokter = $kunjung_hd->nama2;
        $row->str_tgl_periksa = tampiltanggal($kunjung_hd->tanggal, 9);
        $row->str_jam_periksa = substr($kunjung_hd->jam, 0, 5);

        /*JADWAL*/
        $row->tanggal_jadwal = empty($kunjung_hd->tanggal_jadwal) ? '' : date('Y-m-d', strtotime($kunjung_hd->tanggal_jadwal));
        $row->jam_jadwal = $kunjung_hd->jam_jadwal;
        /**/
        $row->str_tgl_jam_periksa = tampiltanggal($kunjung_hd->tanggal, 9) . " " . substr($kunjung_hd->jam, 0, 5);
        $row->tgl_periksa = $kunjung_hd->tanggal;
        $row->jam_periksa = $kunjung_hd->jam;
        $row->umur = selisihymdhis($row->tgl_periksa, $row->tgl_lahir, "umur");
        $row->kd_dr = $kunjung_hd->kd_dr;
        /*$row->nama_asuransi = $kunjung_hd->nama_asuransi;
        $row->kode_asuransi = $kunjung_hd->kode_asuransi;*/

        $row->asuransi_id = $kunjung_hd->asuransi_id;
 
        $row->nama_pegang_akses = $kunjung_hd->nama_pegang_akses;
        $row->hub_keluarga = $kunjung_hd->hub_keluarga;
        $row->diagnosa = $kunjung_hd->diagnosa;
        $row->pengobatan = $kunjung_hd->pengobatan;
        $row->ruang_pasien = $kunjung_hd->ruang_pasien;

        $row->tgl_ulang_1 = empty($kunjung_hd->tgl_ulang_1) ? '' : date('Y-m-d', strtotime($kunjung_hd->tgl_ulang_1));
        $row->tgl_ulang_2 = empty($kunjung_hd->tgl_ulang_2) ? '' : date('Y-m-d', strtotime($kunjung_hd->tgl_ulang_2));
        $row->tgl_ulang_31 = empty($kunjung_hd->tgl_ulang_31) ? '' : date('Y-m-d', strtotime($kunjung_hd->tgl_ulang_31));

        for ($i = 1; $i <= 31; $i++) {
            $property_name = "tgl_ulang_$i";
            $date_value = empty($kunjung_hd->$property_name) ? '' : date('Y-m-d', strtotime($kunjung_hd->$property_name));
            $row->$property_name = $date_value;
        }

        $row->tgl_awal_1 = empty($kunjung_hd->tgl_awal_1) ? '' : date('Y-m-d', strtotime(tampiltanggal($kunjung_hd->tgl_awal_1, 9)));


        $row->hari_1 = $kunjung_hd->hari_1;
        $row->hari_2 = $kunjung_hd->hari_2;
        $row->hari_3 = $kunjung_hd->hari_3;
        $row->hari_4 = $kunjung_hd->hari_4;
        $row->hari_5 = $kunjung_hd->hari_5;
        $row->hari_6 = $kunjung_hd->hari_6;
        $row->hari_7 = $kunjung_hd->hari_7;
        $row->hari_8 = $kunjung_hd->hari_8;
        $row->hari_9 = $kunjung_hd->hari_9;
        $row->hari_10 = $kunjung_hd->hari_10;
        $row->hari_11 = $kunjung_hd->hari_11;
        $row->hari_12 = $kunjung_hd->hari_12;
        $row->hari_13 = $kunjung_hd->hari_13;
        $row->hari_14 = $kunjung_hd->hari_14;
        $row->hari_15 = $kunjung_hd->hari_15;
        $row->hari_16 = $kunjung_hd->hari_16;
        $row->hari_17 = $kunjung_hd->hari_17;
        $row->hari_18 = $kunjung_hd->hari_18;
        $row->hari_19 = $kunjung_hd->hari_19;
        $row->hari_20 = $kunjung_hd->hari_20;

        $row->hari_21 = $kunjung_hd->hari_21;
        $row->hari_22 = $kunjung_hd->hari_22;
        $row->hari_23 = $kunjung_hd->hari_23;
        $row->hari_24 = $kunjung_hd->hari_24;
        $row->hari_25 = $kunjung_hd->hari_25;
        $row->hari_26 = $kunjung_hd->hari_26;
        $row->hari_27 = $kunjung_hd->hari_27;
        $row->hari_28 = $kunjung_hd->hari_28;
        $row->hari_29 = $kunjung_hd->hari_29;
        $row->hari_30 = $kunjung_hd->hari_30;
        $row->hari_31 = $kunjung_hd->hari_31;

        $row->deleted = $kunjung_hd->deleted;


        $row->status_daftar = $kunjung_hd->status_daftar;
    }

    $rows[] = $row;
}

$total = DB::table("rsiklaten.pasien as a")
    ->whereRaw("a.no_reg like '%$search%' or a.nama like '%$search%' or a.alamat like '%$search%' ")
    ->count();

$data = [
    "rows" => $rows,
    "total" => $total,
];

return $this->output
    ->set_status_header(200)
    ->set_content_type('application/json')
    ->set_output(json_encode($data));