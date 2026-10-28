<?php 

$this->load->model('pasien');
$this->load->model('Antri_task');
$this->load->helper('bpjs_bridge');
$akses  = self::akses_menu();
$writer = $akses->userid;
$user   = $akses->nik;
$status = false;
$id            = $this->input->post('rowid');
$no_reg        = $this->input->post('no_reg');
$kode_booking  = $this->input->post('kodebooking');
$checkin       = $this->input->post('checkin');
$mulai_poli    = $this->input->post('mulai_poli');
$selesai_poli  = $this->input->post('selesai_poli');
$mulai_resep   = $this->input->post('mulai_resep');
$selesai_resep = $this->input->post('selesai_resep');
$batal_periksa = $this->input->post('batal_periksa');
$tgl_masuk = substr($kode_booking, 0, 4)."-".substr($kode_booking, 4, 2)."-".substr($kode_booking, 6, 2);
$kode_dokter = substr($kode_booking, 8, 4); 
$jam_masuk = $checkin;
$kunjung = DB::table('rsiklaten.kunjung')->whereNull('deleted')->where('tanggal', $tgl_masuk)->where('no_reg', $no_reg)->where('kd_dr', $kode_dokter)->whereNotNull('kd_poli')->orderBy('id', 'desc')->first();
if (empty($kunjung)) $kunjung = DB::table('rsiklaten.kunjung')->whereNull('deleted')->where('tanggal', $tgl_masuk)->where('no_reg', $no_reg)->whereNotNull('kd_dr')->whereNotNull('kd_poli')->orderBy('id', 'desc')->first();
// json($kode_dokter);
// $antri_task = Antri_task::find($id); 
$antri_task = Antri_task::where('kode_booking', $kode_booking)->first(); 
if (!empty($antri_task)) {
    $antri_task = (object) $antri_task;
    $tgl_periksa = $antri_task->tgl_masuk;
    $tgl_mulai_poli = $mulai_poli!=''?$tgl_periksa." ".$mulai_poli:NULL;
    $tgl_selesai_poli = $selesai_poli!=''?$tgl_periksa." ".$selesai_poli:NULL;
    $tgl_mulai_resep = $mulai_resep!=''?$tgl_periksa." ".$mulai_resep:NULL;
    $tgl_selesai_resep = $selesai_resep!=''?$tgl_periksa." ".$selesai_resep:NULL;
    $update_antri_task = Antri_task::where('id', $antri_task->id)
                            ->update(
                                array(
                                    'task_4'    => $tgl_mulai_poli, 
                                    'task_5'    => $tgl_selesai_poli,
                                    'task_6'    => $tgl_mulai_resep,
                                    'task_7'    => $tgl_selesai_resep,
                                    )
                                );
    if ($batal_periksa == "1") {
        $tgl_batal_periksa = $tgl_periksa." ".$checkin;
        $tgl_batal_periksa = $mulai_poli!=''?$tgl_periksa." ".$mulai_poli:$tgl_batal_periksa;
        $tgl_batal_periksa = $selesai_poli!=''?$tgl_periksa." ".$selesai_poli:$tgl_batal_periksa;
        $tgl_batal_periksa = $mulai_resep!=''?$tgl_periksa." ".$mulai_resep:$tgl_batal_periksa;
        $tgl_batal_periksa = $selesai_resep!=''?$tgl_periksa." ".$selesai_resep:$tgl_batal_periksa;
        // die($tgl_batal_periksa);
        $update_antri_task = Antri_task::where('id', $antri_task->id)
                            ->update(
                                array(
                                    'task_99'    => $tgl_batal_periksa
                                    )
                                );
    }
    $status = true;
}
$deleted = date("Y-m-d H:i:s");
function update_task($kode_booking, $task_id, $waktu) {
    $task_waktu = strtotime($waktu) * 1000;
    $data_post = [
        "sec" => "antreanrs", 
        "method" => "POST", 
        "url" => "antrean/updatewaktu",
        "data" => [
            "kodebooking" => $kode_booking, 
            "taskid" => $task_id, 
            "waktu" => $task_waktu, 
        ] 
    ];
    $rows = (array) null; 
    $result = antreanrs($data_post); 
    $result = json_decode($result);
    return $result;
}
if ($checkin!='') {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 3)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$checkin) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 3, 
                'waktu' => $tgl_masuk." ".$checkin
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 3, 
            'waktu' => $tgl_masuk." ".$checkin
        ]);
    }
	update_task($kode_booking, 3, $tgl_masuk." ".$checkin);
}
if ($mulai_poli!='') {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 4)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$mulai_poli) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 4, 
                'waktu' => $tgl_masuk." ".$mulai_poli
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 4, 
            'waktu' => $tgl_masuk." ".$mulai_poli
        ]);
    }
	update_task($kode_booking, 4, $tgl_masuk." ".$mulai_poli);
}
if ($selesai_poli!='') {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 5)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$selesai_poli) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 5, 
                'waktu' => $tgl_masuk." ".$selesai_poli
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 5, 
            'waktu' => $tgl_masuk." ".$selesai_poli
        ]);
    }
	update_task($kode_booking, 5, $tgl_masuk." ".$selesai_poli);
}
if ($mulai_resep!='') {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 6)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$mulai_resep) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 6, 
                'waktu' => $tgl_masuk." ".$mulai_resep
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 6, 
            'waktu' => $tgl_masuk." ".$mulai_resep
        ]);
    }
	update_task($kode_booking, 6, $tgl_masuk." ".$mulai_resep);
}
if ($selesai_resep!='') {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 7)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$selesai_resep) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 7, 
                'waktu' => $tgl_masuk." ".$selesai_resep
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 7, 
            'waktu' => $tgl_masuk." ".$selesai_resep
        ]);
    }
	update_task($kode_booking, 7, $tgl_masuk." ".$selesai_resep);
}
if ($batal_periksa == "1") {
    $antri_task_list = DB::table('rsiklaten.antri_task_list')->whereNull('deleted')->where('task', 99)->where('no_reg', $no_reg)->where('kode_booking', $kode_booking)->first();
    if (!empty($antri_task_list)) {
        $antri_task_list = (object) $antri_task_list; 
        if ($antri_task_list->waktu!=$tgl_masuk." ".$jam_masuk) {
            DB::table('rsiklaten.antri_task_list')->where('id', $antri_task_list->id)->update(['deleted' => $deleted]);
            DB::table('rsiklaten.antri_task_list')->insert([
                'no_reg' => $no_reg, 
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk, 
                'kode_booking' => $kode_booking, 
                'task' => 99, 
                'waktu' => $tgl_masuk." ".$jam_masuk
            ]);
        }
    } else {
        DB::table('rsiklaten.antri_task_list')->insert([
            'no_reg' => $no_reg, 
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk, 
            'kode_booking' => $kode_booking, 
            'task' => 99, 
            'waktu' => $tgl_masuk." ".$jam_masuk
        ]);
    }
	update_task($kode_booking, 99, $tgl_masuk." ".$jam_masuk);
}
$data = array(
    'no_reg'        => $no_reg,
    'status'        => $status,
);
echo json_encode($data);