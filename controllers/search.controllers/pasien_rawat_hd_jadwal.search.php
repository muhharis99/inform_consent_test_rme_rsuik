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

$currentMonth = date('m');
$currentYear = date('Y');

$rows_data = DB::table("rsiklaten.kunjung_hd as a")
    ->leftJoin('rsiklaten.pasien as b', 'a.no_reg', '=', 'b.no_reg')
    ->leftJoin('rsiklaten.jadwal_hd as jad', 'a.no_reg', '=', 'jad.no_reg')
    ->leftJoin('rsiklaten.agama as c', 'b.agama', '=', 'c.kd_agama')
    ->leftJoin('rsiklaten.perkawinan as d', 'b.kawin', '=', 'd.kd_perkawinan')
    ->leftJoin('rsiklaten.pendidikan as e', 'b.didik', '=', 'e.kd_pendidikan')
    ->leftJoin('rsiklaten.bahasa as f', 'b.bahasa', '=', 'f.kd_bahasa')
    ->leftJoin('rsiklaten.etnis as g', 'b.etnis', '=', 'g.kd_etnis')
    ->leftJoin('rsiklaten.asuransi as h','b.pasien','=','h.NO_REL')
    ->where(function($query) use ($search) {
        $query->where('a.no_reg', 'like', "%$search%");
    })
    ->where(function($query) {
        $query->whereNull('jad.deleted')
              ->orWhere('jad.deleted', '=', '');
    })
    ->where('a.kd_poli','=','HD')
    ->where('b.kd_poli', '=', 'HD')
    /*->whereRaw('MONTH(a.tanggal) = ?', [$currentMonth])
    ->whereRaw('YEAR(a.tanggal) = ?', [$currentYear])*/
    /*->distinct()*/
    ->take($take)
    ->offset($offset)
    ->orderBy('a.tanggal', 'DESC')
    ->orderBy($sort, $order)
    ->select([
        "a.no_reg",
        "a.tanggal as tanggal",
        "b.nama",
        "b.tgl_lahir",
        "b.jenis_kel",
        "b.kd_poli as kode_poli",
        "b.alamat",
        "b.kd_daerah",
        "jad.status_daftar",
        "jad.kd_dr",

        DB::raw("h.NAMA as asuransi_nama"),
        DB::raw("b.pasien as asuransi_id"),
        DB::raw("b.nopeserta as no_kartu"),
        DB::raw("b.no_id as ktp"),


        DB::raw("b.telp as telp_1"),
        DB::raw("b.telp2 as telp_2"),
        DB::raw("b.no_id as ktp"),
        DB::raw("b.agama as kode_agama"),
        DB::raw("c.agama as nama_agama"),
        DB::raw("b.kawin as kode_perkawinan"),
        DB::raw("d.nama_perkawinan as nama_perkawinan"),
        DB::raw("b.didik as kode_pendidikan"),
        DB::raw("e.pendidikan as nama_pendidikan"),

        DB::raw("b.bahasa as kode_bahasa"),
        DB::raw("f.nama_bahasa as nama_bahasa"),
        DB::raw("b.etnis as kode_etnis"),
        DB::raw("g.nama_etnis as nama_etnis"),
    ])
    ->get();

$rows = [];

foreach ($rows_data as $row) {
    $row = (object) $row;

    $row->str_tgl_lahir = strtoupper(tampiltanggal($row->tgl_lahir, 9));
    $row->tanggal = strtoupper(tampiltanggal($row->tanggal, 9));
    $row->no_reg = $row->no_reg;
    $row->nama = $row->nama;
    $row->kode_poli = $row->kode_poli;
    $row->alamat = $row->alamat;
    $row->kd_daerah = $row->kd_daerah;
    $row->status_daftar = $row->status_daftar;

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

    $rows[] = $row;
}

$total = DB::table("rsiklaten.pasien as a")
    ->where(function($query) use ($search) {
        $query->where('a.no_reg', 'like', "%$search%")
              ->orWhere('a.nama', 'like', "%$search%");
    })
    ->count();

$data = [
    "rows" => $rows,
    "total" => $total,
];

return $this->output
    ->set_status_header(200)
    ->set_content_type('application/json')
    ->set_output(json_encode($data));