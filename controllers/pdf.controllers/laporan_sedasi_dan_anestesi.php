<?php 
    $this->load->model('operasi_laporan_anestesi');
    $this->load->model('operasi_laporan_anestesi_item');
    $this->load->model('pasien');
    $this->load->model('karyawan');

    $no_reg = segment(4);
    $tgl_kunjung = segment(5);
    $lap_anes = null;
    $lap_anes_id = 0;

    $dr_anes = null;
    $perawat = null;
    $dr_bedah_1 = null;
    $dr_bedah_2 = null;
    $dr_bedah_3 = null;

    if($tgl_kunjung) {
        $tglFormat = getStrtotime($tgl_kunjung);
        if($tglFormat) {
            $cek_lap_anes = Operasi_laporan_anestesi::where(array('no_reg' => $no_reg, 'tgl_kunjung' => $tglFormat))->first();
            if(count($cek_lap_anes) > 0) {
                $lap_anes_id = $cek_lap_anes->id;
                $lap_anes = $cek_lap_anes;

                $perawat = $cek_lap_anes->penata_anestesi != null ? Karyawan::where('nik', $cek_lap_anes->penata_anestesi)->first()->nama : null;
                $dr_anes = $cek_lap_anes->dr_anestesi != null ? getDokterByNip($cek_lap_anes->dr_anestesi)->nama2 : null;
                $dr_bedah_1 = $cek_lap_anes->dr_bedah_1 != null ? getDokterByNip($cek_lap_anes->dr_bedah_1)->nama2 : null;
                $dr_bedah_2 = $cek_lap_anes->dr_bedah_2 != null ? getDokterByNip($cek_lap_anes->dr_bedah_2)->nama2 : null;
                $dr_bedah_3 = $cek_lap_anes->dr_bedah_3 != null ? getDokterByNip($cek_lap_anes->dr_bedah_3)->nama2 : null;
            }
        }
    }

    $arrPage1 = DB::table('rme.operasi_laporan_anestesi_item as a')
                    ->join('rme.ref_operasi_laporan_anestesi as b', 'a.ref_operasi_laporan_anestesi_id', '=', 'b.id')
                    ->where(array(
                        'a.operasi_laporan_anestesi_id' => $lap_anes_id,
                        'b.prefix' => 'page1'
                    ))
                    ->selectRaw('b.tipe, b.nilai AS simbol, a.koord_txt_x, a.koord_txt_y, a.koord_img_x, a.koord_img_y')
                    ->get();

    $pasien = Pasien::find($no_reg);
        include('warning.pdf.php');
    $data = array(
        "no_reg" => $pasien->no_reg ?? '',
        "nama" => $pasien->nama ?? '',
        "jenis_kel" => $pasien->jenis_kel ?? '',
        "tgl_lahir" => $pasien->tgl_lahir ?? '',
        'umur' => $pasien->umur ?? '',
        'alamat' => $pasien->alamat ?? '',
        'nik' => $pasien->no_id ?? '',
        'lap_anes' => $lap_anes,
        'perawat' => $perawat,
        'dr_anes' => $dr_anes,
        'dr_bedah_1' => $dr_bedah_1,
        'dr_bedah_2' => $dr_bedah_2,
        'dr_bedah_3' => $dr_bedah_3,
        'arr_page1' => $arrPage1,
        'arr_page2' => array(),
        "pdf_type" => "I",
        'koord' => DB::table('rme.map_koord_sedasi_anestesi')->where('tipe', 'page1')->orderByRaw('menit')->get(),
            "warning_sama" => isset($warning_sama)?$warning_sama:false
    );
    $view = 'pdf/laporan_sedasi_dan_anestesi'; 
    go($view, $data);