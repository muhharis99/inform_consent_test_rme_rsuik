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
        $rows = (array) null; 
        $total = (int) 0; 
        $str_tgl_dirawat = "";
        $pasien = DB::table("rsiklaten.pasien as a")
            ->leftJoin('rsiklaten.kawin as b', function($join) {
                $join->on('a.kawin', '=', 'b.id_kawin');
            })
            ->where('a.no_reg', $no_reg)->first(['a.no_reg', 'b.nama_kawin']);
        $inap = DB::table('ranap.inap as a')
            ->leftJoin('rme.bangsal as b', function ($join) {
                $join->on('a.kd_bangsal', '=', 'b.kd_bangsal');
            })
            ->leftJoin('rsiklaten.mutasi_ri as c', function ($join) {
                $join->on('a.no_reg', '=', 'c.no_reg');
                $join->on('a.tgl_ri', '=', 'c.tgl_ri');
                $join->on(DB::raw("c.tgl_masuk != '1970-01-01'"), DB::raw(''), DB::raw(''));
                $join->on(DB::raw("c.deleted IS NULL"), DB::raw(''), DB::raw(''));
            })
            ->leftJoin('dbfile.karya as d', function ($join) {
                $join->on('c.petugas', '=', 'd.nik');
            })
            ->leftJoin('rsik.respon_time_admisi as e', function ($join) {
                $join->on('a.no_reg', '=', 'e.no_reg');
                $join->on('a.tgl_masuk', '=', 'e.tgl_masuk');
                $join->on(DB::raw("LEFT(a.jam_masuk, 5) = LEFT(e.jam_masuk, 5)"), DB::raw(''), DB::raw(''));
                $join->on(DB::raw("e.deleted is NULL"), DB::raw(''), DB::raw(''));
            })
            ->where('a.no_reg', $no_reg)
            ->whereNull('c.deleted')
            ->first(array(
                'a.no_reg', 
                'a.tgl_ri', 
                'a.jam_ri', 
                'a.no_bed',
                'a.rujuk',
                'a.tgl_lahir',
                'a.kd_asuransi',
                'c.kd_dr_ri1',
                'c.kd_dr_ri2',
                'c.kd_dr_ri3',
                'c.kd_dr_ri4',
                'c.kd_dr_ri5',
                'c.ruang',
                'c.pjawab',
                'c.almjawab',
                'c.hubjawab',
                'c.tgl_lahir_pjawab',
                'c.jenis_kel_pjawab',
                'c.no_telp_pjawab',
                'c.no_ktp_pjawab',
                'c.pekerjaan_pjawab',
                'c.pjamin',
                'c.almjamin',
                'c.hubjamin',
                'c.tgl_lahir_pjamin',
                'c.jenis_kel_pjamin',
                'c.no_telp_pjamin',
                'c.nama_darurat_1',
                'c.alamat_darurat_1',
                'c.tgl_lahir_darurat_1',
                'c.umur_darurat_1',
                'c.no_telp_darurat_1',
                'c.hub_darurat_1',
                'c.nama_darurat_2',
                'c.alamat_darurat_2',
                'c.tgl_lahir_darurat_2',
                'c.umur_darurat_2',
                'c.no_telp_darurat_2',
                'c.hub_darurat_2',
                'c.nama_darurat_3',
                'c.alamat_darurat_3',
                'c.tgl_lahir_darurat_3',
                'c.umur_darurat_3',
                'c.no_telp_darurat_3',
                'c.hub_darurat_3',
                'c.petugas',
                'c.tgl_masuk', 
                'c.jam_masuk',
                'c.id_kunjung',
                'e.mulai_admisi',
                'e.selesai_admisi',
                DB::raw("c.tgl_ri as tgl_dirawat"),
                DB::raw("c.jam_ri as jam_dirawat"),
                DB::raw("d.nama as nama_petugas"),
                DB::raw("b.nama_pendaftaran as nama_bangsal"),
                DB::raw("a.kd_bangsal as kode_bangsal"),
                DB::raw("c.kelas as hak_kelas"),
                DB::raw("c.kelas_perawatan as kelas_perawatan"),
            ));
        // if (ipclient()==IPC) json($inap);
        if (!empty($inap)) {
            $inap = (object) $inap; 
            $inap->ur_tgl_rs = str_replace("-", "", $inap->tgl_masuk).str_replace(":", "", $inap->jam_masuk);
            if ($inap->tgl_dirawat=='' || $inap->tgl_dirawat=='0000-00-00') {
                $inap->tgl_dirawat = $inap->tgl_masuk;
            } 
            if ($inap->tgl_dirawat!='' && $inap->tgl_dirawat != '0000-00-00') {
                $inap->str_tgl_dirawat = date("d/m/Y", strtotime($inap->tgl_dirawat));
            } else {
                $inap->str_tgl_dirawat = date("d/m/Y", strtotime($inap->tgl_lahir));
            }
            if ($inap->mulai_admisi=='') {
                $inap->mulai_admisi=date("Y-m-d H:i:s");
            }
            if ($inap->selesai_admisi=='') {
                $inap->selesai_admisi=date("Y-m-d H:i:s");
            }
            $inap->str_mulai_admisi = date("d/m/Y H:i:s", strtotime($inap->mulai_admisi));
            $inap->str_selesai_admisi = "";
            if ($inap->selesai_admisi!="" && $inap->selesai_admisi != "0000-00-00 00:00:00") {
                $inap->str_selesai_admisi = date("d/m/Y H:i:s", strtotime($inap->selesai_admisi));
            }
            if ($inap->tgl_lahir_pjawab != '' && $inap->tgl_lahir_pjawab!='0000-00-00' ) {
                $inap->str_tgl_lahir_pjawab = date("d/m/Y", strtotime($inap->tgl_lahir_pjawab));
            } else {
                $inap->str_tgl_lahir_pjawab = "";
            }
        }
        $kunjung = DB::table('rsiklaten.kunjung as a')->where('a.no_reg', $no_reg)
            ->leftJoin('rsiklaten.poli as b', function ($join) {
                $join->on('a.kd_poli', '=', 'b.kode_poli');
            })
            ->leftJoin('rsiklaten.dokter as c', function ($join) {
                $join->on('a.kd_dr', '=', 'c.no_dr');
            })
            ->whereRaw("a.deleted IS NULL and concat(a.tanggal, ' ', a.jam) > date_add(now(), interval -1 day)")->orderBy('a.id', 'desc')
            ->first(array(
                "a.id", 
                "a.tanggal", 
                "a.jam",
                "b.nama_poli", 
                "a.rujuk",
                DB::raw("c.nama2 as nama_dokter")
            ));
        $pasien_bayi = DB::table('rsiklaten.ibu_anak as a')
            ->whereRaw("a.no_reg_anak = '$no_reg' AND a.submitted > DATE_ADD(NOW(), interval -14 DAY)")->orderBy('a.id', 'desc')
            ->first(array(
                "a.id", 
                "a.submitted"
            ));
        if (!empty($kunjung)) {
            $kunjung = (object) $kunjung;
            /* cek surat mondok */
            $kunjung->spm_dokter = null; 
            $kunjung->spm_tanggal = null; 
            $kunjung->spm_dpjp = null; 
            $kunjung->spm_bangsal = null; 
            $kunjung->spm_str_tanggal = null; 
            $kunjung->spm_str_jam = null; 
            $surat_mondok = DB::table('rme.surat_mondok as a')->whereRaw("a.no_reg='$no_reg' AND a.tanggal >= '$kunjung->tanggal'")->orderBy('id', 'DESC')->first();
            if (!empty($surat_mondok)) {
                $surat_mondok = (object) $surat_mondok;
                $kunjung->spm_dokter = $surat_mondok->dokter_id;
                $kunjung->spm_tanggal = $surat_mondok->tanggal;
                $kunjung->spm_dpjp = $surat_mondok->dokter_ri;
                $kunjung->spm_str_tanggal = tampiltanggal($surat_mondok->tanggal, 9);
                $kunjung->spm_str_jam = tampiltanggal($surat_mondok->registered, 7);
            } 
        }
        $status_kawin = !empty($pasien['nama_kawin'])?$pasien['nama_kawin']:'';
        $data = array(
            "rows"    => $rows,
            "total"   => $total,
            "inap"    => $inap,
            "status_kawin"    => $status_kawin,
            "kunjung" => $kunjung,
            "pasien_bayi" => $pasien_bayi,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));