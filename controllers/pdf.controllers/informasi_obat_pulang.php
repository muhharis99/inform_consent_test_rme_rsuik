<?php 
        $this->load->model('Mutasi_ri');
        $this->load->model('Pasien');
        $this->load->model('Agama');
        $this->load->model('Perkawinan');
        $this->load->model('Pendidikan');
        $this->load->model('Pekerjaan');
        $this->load->model('Rujuk');
        $this->load->model('Perujuk');
        $this->load->model('Kunjung');
        $this->load->model('Asuransi');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $this->load->model('Karyawan');
        $this->load->model('Karya');
        $this->load->model('Dokter');
        $this->load->model('soap_inap');
        $this->load->model('pasien_resep_inap');
        $this->load->model('pasien_alergi');
        $this->load->model('byl_billing_farm_ri');
        $this->load->model('obat_byl');
        $this->load->model('sbw_byl');

        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))->orderBy('id', 'DESC')->first();
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        if (segment(4) == '0000003') {
            $row_mutasi_ri = Mutasi_ri::orderBy('id', 'DESC')->first();
        }

        $nama          = '';
        $nik           = '';
        $alamat        = '';
        $tgl_lahir     = '';
        $jenis_kel     = '';
        $telp          = '';
        $agama         = '';
        $kawin         = '';
        $didik         = '';
        $kerja         = '';
        $rujuk         = '';
        $kunjung       = 'LAMA';
        $asuransi      = '';
        $asal          = '';
        $str_tgl_masuk = '';
        $bangsal       = '';
        $nama_petugas  = '';
        $alergi        = '';
        $tb            = '';
        $bb            = '';
        $pasien        = null;
        $pasien        = Pasien::find($no_reg);
        if (!empty($pasien)) {
            $nama      = $pasien->nama;
            $nik       = $pasien->no_id;
            $tgl_lahir = $pasien->tgl_lahir;
            $alamat    = $pasien->alamat;
            switch ($pasien->jenis_kel) {
                case '1' : 
                case 1 : 
                case 'L' : 
                    $jenis_kel = 'LAKI-LAKI'; 
                    break; 
                case '2' : 
                case 2 : 
                case 'P' : 
                    $jenis_kel = 'PEREMPUAN'; 
                    break; 
            }
            $telp = $pasien->telp;
            if (!empty($pasien->telp2)) {
                $telp .= '/'.$pasien->telp2; 
            } 
            $row_agama = Agama::where('kd_agama', $pasien->agama)->first(); 
            if (!empty($row_agama)) {
                $agama = strtoupper($row_agama->agama);
            }
            $row_kawin = Perkawinan::where('kd_perkawinan', $pasien->kawin)->first(); 
            if (!empty($row_kawin)) {
                $kawin = strtoupper($row_kawin->nama_perkawinan);
            }
            $row_didik = Pendidikan::where('kd_pendidikan', $pasien->didik)->first(); 
            if (!empty($row_didik)) {
                $didik = strtoupper($row_didik->pendidikan);
            }
            $row_kerja = Pekerjaan::where('kd_pekerjaan', $pasien->pekerjaan)->first(); 
            if (!empty($row_kerja)) {
                $kerja = strtoupper($row_kerja->pekerjaan);
            }
        } 
        $row_perujuk = Perujuk::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('deletedstate', '0')->orderBy('id', 'DESC')->first();
        if (!empty($row_perujuk)) {
            $rujuk = $row_perujuk->alamat;
        }
        $row_kunjung = Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'ASC')->first();
        if (!empty($row_kunjung)) {
            switch($row_kunjung->kunjung) {
                case 'B' : 
                    $kunjung = 'BARU'; 
                    break; 
            }
        }
        if (!empty($row_mutasi_ri->asuransi)) {
            $row_asuransi = Asuransi::where('NO_REL', $row_mutasi_ri->asuransi)->first();
            if (!empty($row_asuransi->NAMA)) {
                $asuransi = $row_asuransi->NAMA;
            }
        }
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $str_tgl_masuk = $row_mutasi_ri->tgl_masuk." Jam : ". str_replace(":", ".", substr($jam_masuk, 0, 5));
        }
        if (!empty($row_mutasi_ri->bangsal)) {
            $row_bangsal = Bangsal::where('kd_bangsal', $row_mutasi_ri->bangsal)->first();
            if (!empty($row_bangsal->nama_pendaftaran)) {
                $bangsal = $row_bangsal->nama_pendaftaran;
            }
        }
        if (!empty($row_mutasi_ri->petugas)) {
            $row_karyawan = Karya::where('nik', $row_mutasi_ri->petugas)->first();
            if (!empty($row_karyawan->nama)) {
                $nama_petugas = $row_karyawan->nama;
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri1)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
            }
        }
        $akad = null; 
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $query = "
            SELECT 
                * 
            FROM 
                (
                    SELECT no_reg, tgl_masuk, jam_masuk, deleted, 'BPJS mutasi kelas' as akad, kd_bangsal, pihak_pertama_nama, pihak_pertama_nik, pihak_pertama_jabatan, pihak_kedua_nama, pihak_kedua_alamat, pihak_kedua_nik, pihak_kedua_pekerjaan, saksi_satu, saksi_dua, tgl_dibuat FROM rsik.cetak_akad_bpjs_mutasi
                ) akad 
            WHERE 
                no_reg = '$no_reg'
                AND tgl_masuk = '$tgl_masuk'
                AND deleted IS NULL 
            ";
            $data_akad = DB::select($query); 
            $akad = self::obj($data_akad);
            // $akad 
        }

        $obat_pulang = [];
        //mencari obat pulang di pasien resep inap
        $soap_inap = Soap_Inap::where('no_reg', $no_reg)->where('resume', '1')->where('tgl_masuk', $tgl_masuk)->orderBy('id', 'desc')->first(['id','bb','tb']);
        if (count($soap_inap) > 0) {
            $tb = $soap_inap->tb." Cm";
            $bb = $soap_inap->bb." Kg";
            //resep dari billing apotek ri
            $resep_inap_pulang_billing = Byl_billing_farm_ri::where('no_rm', $no_reg)->where('tanggal','>', $tgl_masuk)->where('obat_rumah', '1')->where('deleted', '0')->where('obat_kd', 'not like', 'A%')->orderBy('obat_nama', 'ASC')->get();
            if (!empty($resep_inap_pulang_billing)) {
                foreach ($resep_inap_pulang_billing as $data_obat) {
                    $arr   = explode('-', $data_obat->psrm);
                    $pagi  = $arr[0] ?? '0';
                    $siang = $arr[1] ?? '0';
                    $sore  = $arr[2] ?? '0';
                    $malam = $arr[3] ?? '0';
                    //mencari sbw pada master obat gudang nya
                    $sbw = '';
                    $indikasi = '';
                    $obat_byl = Obat_byl::where('obat_gudang.obat_kd', $data_obat->obat_kd)
                    ->leftJoin('obat_indikasi', 'obat_gudang.obat_kd', '=', 'obat_indikasi.obat_kd')
                    ->first(['obat_gudang.sbw','obat_indikasi.indikasi']);
                    if (!empty($obat_byl)) {
                        $sbw = $obat_byl->sbw;
                        if (!empty($sbw)) {
                            $master_sbw = Sbw_byl::where('kode', $sbw)->first(['nama']);
                            if (!empty($master_sbw)) {
                                $sbw = $master_sbw->nama;
                            }
                        }
                        $indikasi = $obat_byl->indikasi;
                    }

                    $obat_pulang []= array(
                        'nama_obat'    => $data_obat->obat_nama,
                        'aturan_pakai' => $data_obat->psrm,
                        'indikasi'     => $indikasi,
                        'pagi'         => $pagi,
                        'siang'        => $siang,
                        'sore'         => $sore,
                        'malam'        => $malam,
                        'jml'          => $data_obat->kwanta,
                        'sbw'          => $sbw,
                        'keterangan'   => $data_obat->keterangan,
                        
                    );
                }
            }
            //resep dari resume
            // $resep_inap_pulang = Pasien_Resep_Inap::where('soap_id', $soap_inap->id)->where('dari', 2)->where('kode', 'not like', 'A%')->groupBy('nama')->orderBy('nama', 'ASC')->get();
            // if (count($resep_inap_pulang)) {
            //     foreach ($resep_inap_pulang as $data_obat) {
            //         $arr   = explode('-', $data_obat->psrm);
            //         $pagi  = $arr[0] ?? '0';
            //         $siang = $arr[1] ?? '0';
            //         $sore  = $arr[2] ?? '0';
            //         $malam = $arr[3] ?? '0';

            //         $obat_pulang []= array(
            //             'nama_obat'    => $data_obat->nama,
            //             'aturan_pakai' => $data_obat->psrm,
            //             'indikasi'     => '',
            //             'pagi'         => $pagi,
            //             'siang'        => $siang,
            //             'sore'         => $sore,
            //             'malam'        => $malam,
            //             'jml'          => $data_obat->jumlah,
            //             'sbw'          => $data_obat->sbw,
            //             'keterangan'   => $data_obat->keterangan,
                        
            //         );
            //     }
            // }
        }

        $pasien_alergi = Pasien_Alergi::where('no_reg', $no_reg)->whereRaw("(tgl_masuk = '$tgl_masuk' or tgl_masuk < '$tgl_masuk')")->orderBy('registered', 'desc')->first();
        if (!empty($pasien_alergi)) {
            $alergi       = $pasien_alergi->alergi;
            $alergi_makan = $pasien_alergi->alergi_makan;
            $alergi_obat  = $pasien_alergi->alergi_obat;
            $alergi_debu  = $pasien_alergi->alergi_debu;
            $alergi_lain  = $pasien_alergi->alergi_lain;
        }

        $status_alergi = 0;
        if (empty($alergi)) {
            if ($alergi_makan != '') {
                $alergi .= ''.$alergi_makan.', ';
                $status_alergi = 1; 
            }  
            if ($alergi_obat != '') {
                $alergi .= ''.$alergi_obat.', ';
                $status_alergi = 1; 
            }
            if ((string) $alergi_debu != '') {
                $status_alergi = 1;
                switch ((string) $alergi_debu) {
                case '0' : 
                    break; 
                case '1' : 
                    $alergi .= 'Alergi debu, ';
                    break; 
                }
            }
            if ($alergi_lain != '') {
                $alergi .= ''.$alergi_lain;
                $status_alergi = 1;
            }
        }

        if(empty($alergi)){
            $alergi = 'Tidak Ada';
        }
        // echo"<pre>";print_r($obat_pulang);die();

        $data = array(
            "no_reg"        => $no_reg,
            "tgl_masuk"     => $tgl_masuk,
            "jam_masuk"     => $jam_masuk,
            "tgl_rs"        => $tgl_rs,
            "ranap"         => $row_mutasi_ri,
            "nama"          => $nama,
            "nik"           => $nik,
            "jenis_kel"     => $jenis_kel,
            "alamat"        => $alamat,
            "tgl_lahir"     => $tgl_lahir,
            "umur"          => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"),
            "telp"          => $telp,
            "agama"         => $agama,
            "kawin"         => $kawin,
            "didik"         => $didik,
            "kerja"         => $kerja,
            "rujuk"         => $rujuk,
            "kunjung"       => $kunjung,
            "asuransi"      => $asuransi,
            "asal"          => $asal,
            "str_tgl_masuk" => $str_tgl_masuk,
            "bangsal"       => $bangsal,
            "nama_petugas"  => $nama_petugas,
            "akad"          => $akad,
            "obat_pulang"   => $obat_pulang,
            "alergi"        => $alergi,
            "tb"            => $tb,
            "bb"            => $bb,
            "pdf_type"      => "I"
        );
        // $view = 'pdf/informasi_obat_pulang'; 
        $view = 'pdf/informasi_obat_pulang_new'; 
        go($view, $data);
        // var_dump($view); die();