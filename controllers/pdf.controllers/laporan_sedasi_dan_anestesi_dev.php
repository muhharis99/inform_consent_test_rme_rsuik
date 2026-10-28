<?php
    $this->load->model('operasi_laporan_anestesi');
    $this->load->model('operasi_laporan_anestesi_item');
    $this->load->model('pasien');

    $no_reg = segment(4);
    $tgl_kunjung = segment(5);
    $lap_anes = null;
    $lap_anes_id = 0;

    if($tgl_kunjung) {
        $tglFormat = getStrtotime($tgl_kunjung);
        if($tglFormat) {
            $cek_lap_anes = Operasi_laporan_anestesi::where(array('no_reg' => $no_reg, 'tgl_kunjung' => $tglFormat))->first();
            if(count($cek_lap_anes) > 0) {
                $lap_anes_id = $cek_lap_anes->id;
                $lap_anes = $cek_lap_anes;
            }
        }
    }

    $arrPage1 = array();
    $startY = 156;

    $listKoordTxt = array();
    for ($koordTxt = 21.5; $koordTxt <= 166; $koordTxt+=3) {
        array_push($listKoordTxt, $koordTxt);
    }

    $listKoordImg = array();
    for ($koordImg = 21; $koordImg <= 162.3; $koordImg+=3.1) {
        array_push($listKoordImg, $koordImg);
    }

    for ($indikator = 230; $indikator >= 0; $indikator-=10) {
        $listItem = array();
        $indexMinute = 0;
        for ($minute = 5; $minute <= 245; $minute+=5) {
            $getValue = DB::table('rme.operasi_laporan_anestesi_item as a')
                            ->join('rme.ref_operasi_laporan_anestesi as b', 'a.ref_operasi_laporan_anestesi_id', '=', 'b.id')
                            ->where(array(
                                'a.operasi_laporan_anestesi_id' => $lap_anes_id,
                                'a.menit' => $minute, 
                                'a.indikator' => $indikator,
                                'b.prefix' => 'page1'
                            ))
                            ->selectRaw('b.tipe, b.nilai')
                            ->first();

            if(count($getValue) > 0) {
                array_push($listItem, array(
                    'status' => 'Y',
                    'menit' => $minute,
                    'tipe' => $getValue['tipe'],
                    'nilai' => $getValue['nilai'],
                    'x' => $getValue['tipe'] == 'Teks' ? $listKoordTxt[$indexMinute] : $listKoordImg[$indexMinute],
                    'y' => $startY
                ));
            }
            $indexMinute++;
        }
        array_push($arrPage1, array($indikator => $listItem));
        $startY = $startY + 3.2;
    }

    /* ----------------------------------------------------------------------- */
    $arrPage2 = array();
    $startY2 = 42.5;
    $interval2 = 23;

    $listKoordTxt2 = array();
    $koordTxt2 = 21.5;
    for ($x = 0; $x <= $interval2; $x++) {
        array_push($listKoordTxt2, $koordTxt2);
        $koordTxt2 = $koordTxt2+4;
    }

    $listKoordImg2 = array();
    $koordImg2 = 19;
    for ($x = 0; $x <= $interval2; $x++) {
        array_push($listKoordImg2, $koordImg2);
        $koordImg2 = $koordImg2+4;
    }

    for ($indikator2 = 240; $indikator2 >= 20; $indikator2-=10) {
        $listItem2 = array();
        $indexMinute2 = 0;
        for ($minute2 = 5; $minute2 <= 110; $minute2+=5) {
            $getValue2 = DB::table('rme.operasi_laporan_anestesi_item as a')
                            ->join('rme.ref_operasi_laporan_anestesi as b', 'a.ref_operasi_laporan_anestesi_id', '=', 'b.id')
                            ->where(array(
                                'a.operasi_laporan_anestesi_id' => $lap_anes_id,
                                'a.menit' => $minute2, 
                                'a.indikator' => $indikator2,
                                'b.prefix' => 'page2'
                            ))
                            ->selectRaw('b.tipe, b.nilai')
                            ->first();
            $count2 = count($getValue2);
            if($count2 > 0) {
                array_push($listItem2, array(
                    'status' => 'Y',
                    'menit' => $minute2,
                    'tipe' => $getValue2['tipe'],
                    'nilai' => $getValue2['nilai'],
                    'x' => $getValue2['tipe'] == 'Teks' ? $listKoordTxt2[$indexMinute2] : $listKoordImg2[$indexMinute2],
                    'y' => $startY2
                ));
            }
            $indexMinute2++;
        }
        array_push($arrPage2, array($indikator2 => $listItem2));
        $startY2 = $startY2 + 4;
    }

    $pasien = Pasien::find($no_reg);
    $data = array(
        "no_reg" => $pasien->no_reg ?? '',
        "nama" => $pasien->nama ?? '',
        "tgl_lahir" => $pasien->tgl_lahir ?? '',
        'umur' => $pasien->umur ?? '',
        'alamat' => $pasien->alamat ?? '',
        'nik' => $pasien->no_id ?? '',
        'lap_anes' => $lap_anes,
        'arr_page1' => $arrPage1,
        'arr_page2' => $arrPage2,
        "pdf_type" => "I",
        'koord' => DB::table('rme.map_koord_sedasi_anestesi')->where('tipe', 'page1')->orderByRaw('menit')->get()
    );
    $view = 'pdf/laporan_sedasi_dan_anestesi_dev'; 
    go($view, $data);
    //pre($arrPage2);