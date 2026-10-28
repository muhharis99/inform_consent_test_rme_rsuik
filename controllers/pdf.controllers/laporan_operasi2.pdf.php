<?php 
        include ('init.pdf.php');
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
        $this->load->model('User');
        $this->load->model('Operasi');
        // if (ipclient()==IPC) {
            
            $ip = ipclient();
            $dir = FCPATH . "assets/rme/pdf/$ip/";
            $pdf_name = (array) null; 
            $row_mutasi_ri = null; 
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))->orderBy('id', 'DESC')->first();
        //    if($no_reg=="0330600"){
        //         echo"<pre>";print_r($row_mutasi_ri);die();
        //     }
            if (empty($row_mutasi_ri)) {
                $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
            }
            $bgs_register = DB::table('rsiklaten.bgs_register as a')->where('a.no_reg', $no_reg)->where('a.tgl_daftar', $tgl_masuk)->whereNotNull('a.tgl_keluar')->selectRaw('a.tgl_keluar')->first(); 
            if (!empty($bgs_register)) {
                $bgs_register = (object) $bgs_register;
            }
            $tanggal_mulai = !empty($row_mutasi_ri->tgl_masuk)?$row_mutasi_ri->tgl_masuk." ".$row_mutasi_ri->jam_masuk:null;
            $tanggal_selesai = !empty($bgs_register->tgl_keluar)?$bgs_register->tgl_keluar:null; 
            $rows_operasi = Operasi::where('no_reg', $no_reg)->whereNull('deleted')->whereBetween('start', [$tanggal_mulai, $tanggal_selesai])->get(['start']);
            // if (ipclient()==IPC) json($rows_operasi);

          //di tewaskan dulu koding nya
        //   if (!empty($rows_operasi)) {
        //     foreach ($rows_operasi as $key=>$row_operasi) {
        //         $row_operasi = (object) $row_operasi;
        //         $url = 'http://' . $_SERVER['HTTP_HOST'] . '/serverx/admisi/pdf/laporan_operasi_start/'.$no_reg.'/'.str_replace(["-", " ", ":"], "", $row_operasi->start).'/FILECLIENT/'.$ip;
        //         $file = null;
        //         $file = file_get_contents($url);
        //         $file = json_decode($file);
        //         if (!empty($file->pdf)) {
        //             if (file_exists($file->pdf)) {
        //                 if (!empty($file->pdf_name)) {
        //                     $pdf_name[] = $file->pdf_name;
        //                 }
        //             }
        //         }
        //     }
        // }
        // // if (ipclient()=='172.16.18.18') pre($url);
        // // if (ipclient()==IPC) json($ur);

        // if (!empty($pdf_name)) {
        //     $this->zend->load('Zend/Pdf');
        //     $pdfMerged = new Zend_Pdf();
        //         // if (ipclient()=='172.16.18.21') pre($dir);
            
        //     if(count($pdf_name) > 0)
        //     {
        //         foreach ($pdf_name as $file) {
        //             # code...
        //             $pdf1 = Zend_Pdf::load($dir . $file);
        //             // ADD ALL PAGES FROM THE FIRST PDF TO OUR NEW DOCUMENT
        //             foreach ($pdf1->pages as $page) {
        //                 $clonedPage         = clone $page;
        //                 $pdfMerged->pages[] = $clonedPage;
        //             }
        //             if (file_exists($dir.$file)) {
        //                 // unlink($dir.$file);
        //             }
        //         }
        //     }
        //     // if($no_reg=='0661549') json($pdf_name);

        //     unset($clonedPage);
        //     $pdfMerged->save($dir . 'Laporan-Operasi.pdf');
        //     $pdf = Zend_Pdf::load($dir . 'Laporan-Operasi.pdf');
        //     $file_merge = "Laporan-Operasi.pdf";
        //     header('Content-type: application/pdf');
        //     header('Content-Disposition: inline; filename='.$file_merge);

        //     $pdfData = $pdf->render();
        //     echo $pdfData;
        //     if (file_exists($dir.$file_merge)) {
        //         unlink($dir.$file_merge);
        //     }
        //     die();
        // }
        //sampai sini
        // }
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))->orderBy('id', 'DESC')->first();
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        $tanggal = ""; 
        $jam = ""; 
        $pasien = null; 
        $kawin = "";

        $pasien = Pasien::find($no_reg);
        if (!empty($pasien)) {
            $nama = $pasien->nama; 
            $nik = $pasien->no_id; 
            $tgl_lahir = $pasien->tgl_lahir; 
            $alamat = $pasien->alamat;
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
        include('warning.pdf.php');
        $row_perujuk = Perujuk::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('deletedstate', '0')->orderBy('id', 'DESC')->first();
        if (!empty($row_perujuk)) {
            $rujuk = $row_perujuk->alamat;
        }
        /*
        $row_kunjung = Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'ASC')->first();
        if (!empty($row_kunjung)) {
            switch($row_kunjung->kunjung) {
                case 'B' : 
                    $kunjung = 'BARU'; 
                    break; 
            }
        }
        */
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
        // pre($row_kunjung);
        /* cari tanggal_keluar */
        $tgl_keluar = null; 
        $bgs_register = DB::table('rsiklaten.bgs_register as a')->where('a.no_reg', $no_reg)->where('a.tgl_daftar', $tgl_masuk)->whereNotNull('a.tgl_keluar')->selectRaw('a.tgl_keluar')->first(); 
        if (!empty($bgs_register)) {
            $bgs_register = (object) $bgs_register;
            $tgl_keluar = $bgs_register->tgl_keluar;
        }
        if (empty($tgl_keluar)) {
            $tgl_keluar = date("Y-m-d H:i:s");
        }

        $row_kunjung = null; 
        $row_kunjung = DB::table('rsiklaten.kunjung')->whereNull('deleted')->where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->where('jam', $jam_masuk)->orderBy('id', 'desc')->first();
        // if ($no_reg=='0617697') pre($row_kunjung);
        if (!empty($row_kunjung)) {
            $row_kunjung = (object) $row_kunjung; 
            $operasi = DB::table('rme.operasi as a')->where('no_reg', $no_reg)->whereRaw("date(start) = '$tgl_masuk'")->orderBy('id', 'DESC')->first();
            if (empty($operasi)) $operasi = DB::table('rme.operasi as a')->where('no_reg', $no_reg)->whereRaw("date(start) >= '$tgl_masuk'")->orderBy('id', 'ASC')->first();
            // if (ipclient()==IPC) json($row_kunjung); 
            // pre($operasi);
            if (!empty($operasi)) {
                $operasi = (object) $operasi; 
                $id = $operasi->id;
                $no_reg = $operasi->no_reg;
                $pasien = Pasien::find($no_reg);
                $nama = $pasien->nama;
                $nik = $pasien->no_id;
                $alamat    = $pasien->alamat;
                $tgl_lahir = date('d-m-Y', strtotime($pasien->tgl_lahir));
                $jenis_kel = $pasien->jenis_kel;
                $umur      = age($pasien->tgl_lahir, $operasi->registered);

                $bangsal_id = $operasi->bangsal_id;
                $bangsal   = Bangsal::where('induk', $bangsal_id)->first();
                if (count($bangsal) > 0) {
                    $ruang = $bangsal->induk_nama;
                }

                $bon_id = $operasi->bon_id;
                $dokter_bedah       = array_filter(explode(',', $operasi->dokter_bedah));
                if(count($dokter_bedah) > 0)
                {
                    $dokter_bedah = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = Dokter::find($v);
                            if(count($user) > 0)
                            {
                                $v = $user->nama2;
                            }
                            return $k.'. '.$v;
                        },
                        $dokter_bedah,
                        array_keys($dokter_bedah)
                    ));
                }
                else
                {
                    $dokter_bedah = '';
                }
                $asisten       = array_filter(explode(',', $operasi->asisten));
                if(count($asisten) > 0)
                {
                    $asisten = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('rsiklaten.user.id', $v)->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
                            if(count($user) > 0)
                            {
                                $v = $user->nama;
                            }
                            else
                            {
                                $nurse = Perawat::find($perawat_id);
                                if(count($nurse) > 0)
                                {
                                    $v = $nurse->nama;
                                }
                            }
                            return $k.'. '.$v;
                        },
                        $asisten,
                        array_keys($asisten)
                    ));
                }
                else
                {
                    $asisten = '';
                }
                $perawat       = array_filter(explode(',', $operasi->perawat));
                if(count($perawat) > 0)
                {
                    $perawat = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('rsiklaten.user.id', $v)->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
                            if(count($user) > 0)
                            {
                                $v = $user->nama;
                            }
                            else
                            {
                                $nurse = Perawat::find($perawat_id);
                                if(count($nurse) > 0)
                                {
                                    $v = $nurse->nama;
                                }
                            }
                            return $k.'. '.$v;
                        },
                        $perawat,
                        array_keys($perawat)
                    ));
                }
                else
                {
                    $perawat = '';
                }
                $diagpre       = $operasi->diagpre;
                $diagpre = str_replace('@@,', ', ', $diagpre);
                $diagpost      = $operasi->diagpost;
                $diagpost = str_replace('@@,', ', ', $diagpost);
                $tindakan    = $operasi->tindakan;
                $tindakan = str_replace('@@,', ', ', $tindakan);
                $tindakan       = explode(',', $tindakan);
                $tindakan = implode('<br>', array_map(
                    function ($v, $k) {
                        $k++;
                        return $k.'. '.$v;
                    },
                    $tindakan,
                    array_keys($tindakan)
                ));
                $jaringan = $operasi->jaringan;
                $pa      = $operasi->pa;
                $komplikasi      = $operasi->komplikasi;
                $stanggal      = date('d-m-Y', strtotime($operasi->start));
                $sjam      = date('H:i:s', strtotime($operasi->start));
                $etanggal           = date('d-m-Y', strtotime($operasi->end));
                $ejam           = date('H:i:s', strtotime($operasi->end));
                $cetaktanggal           = $operasi->cetak!=''?date('d-m-Y', strtotime($operasi->cetak)):date('d-m-Y', strtotime($operasi->registered));
                $cetakjam           = $operasi->cetak!=''?date('H:i:s', strtotime($operasi->cetak)):date('H:i:s', strtotime($operasi->registered));
                $lama = TimeLine($operasi->start, $operasi->end, 'h');
                $laporan      = nl2br($operasi->laporan);
                $intruksi_pasca = nl2br($operasi->intruksi_pasca);
                $registered    = date('Y-m-d H:i:s', strtotime($operasi->registered));
                $tanggal = date('d/m/Y', strtotime($operasi->registered));
                $jam = date('H:i', strtotime($operasi->registered));
                $userid = $operasi->writer;
                $darah_hilang = $operasi->darah_hilang;
                $darah_transfusi = $operasi->darah_transfusi;
                
                //cari timeout
                $selamat = DB::table('rme.operasi_selamat as os')->where('no_reg',$no_reg)->where('bon_id',$operasi->bon_id)->orderBy('id', 'DESC')->first();
                if(count($selamat) > 0)
                {
                    $selamat = (object) $selamat; 
                $tgl_mulai = date('Y-m-d', strtotime($selamat->tgl_insisi));
                $jam_mulai = date('H:i:s', strtotime($selamat->tgl_insisi.'+2 minutes'));
                }else{
                    $tgl_mulai = '';
                    $jam_mulai = '';
                }
                // pre($jam_mulai);


                //TTD
                $user = User::join('rsiklaten.dokter', 'rsiklaten.user.user', '=', 'rsiklaten.dokter.no_dr')->where('rsiklaten.user.id', $userid)->first(array('rsiklaten.user.ttd', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2 as nama'));
                if(count($user) > 0)
                {
                    $dokter_id = $user->no_dr;
                    $nm_dr = $user->nama;
                    $ttd = $user->ttd;
                    $ttd_image = IMG."ttd/$dokter_id.jpg";
                } else {
                    $dokter_id = '';
                    $nm_dr = '';
                    $ttd   = '';
                    $ttd_image   = '';
                }
            }
        } else {
            $operasi = DB::table('rme.operasi as a')->where('no_reg', $no_reg)->whereRaw("registered='$tgl_masuk $jam_masuk'")->orderBy('id', 'DESC')->first();
            // pre($operasi);
            if (!empty($operasi)) {
                $operasi = (object) $operasi; 
                $id = $operasi->id;

                $no_reg = $operasi->no_reg;
                $pasien = Pasien::find($no_reg);
                $nama = $pasien->nama;
                $nik = $pasien->no_id;
                $alamat    = $pasien->alamat;
                $tgl_lahir = date('d-m-Y', strtotime($pasien->tgl_lahir));
                $jenis_kel = $pasien->jenis_kel;
                $umur      = age($pasien->tgl_lahir, $operasi->registered);

                $bangsal_id = $operasi->bangsal_id;
                $bangsal   = Bangsal::where('induk', $bangsal_id)->first();
                if (count($bangsal) > 0) {
                    $ruang = $bangsal->induk_nama;
                }

                $bon_id = $operasi->bon_id;
                $dokter_bedah       = array_filter(explode(',', $operasi->dokter_bedah));
                if(count($dokter_bedah) > 0)
                {
                    $dokter_bedah = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = Dokter::find($v);
                            if(count($user) > 0)
                            {
                                $v = $user->nama2;
                            }
                            return $k.'. '.$v;
                        },
                        $dokter_bedah,
                        array_keys($dokter_bedah)
                    ));
                }
                else
                {
                    $dokter_bedah = '';
                }
                $asisten       = array_filter(explode(',', $operasi->asisten));
                if(count($asisten) > 0)
                {
                    $asisten = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('rsiklaten.user.id', $v)->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
                            if(count($user) > 0)
                            {
                                $v = $user->nama;
                            }
                            else
                            {
                                $nurse = Perawat::find($perawat_id);
                                if(count($nurse) > 0)
                                {
                                    $v = $nurse->nama;
                                }
                            }
                            return $k.'. '.$v;
                        },
                        $asisten,
                        array_keys($asisten)
                    ));
                }
                else
                {
                    $asisten = '';
                }
                $perawat       = array_filter(explode(',', $operasi->perawat));
                if(count($perawat) > 0)
                {
                    $perawat = implode('<br>', array_map(
                        function ($v, $k) {
                            $k++;

                            $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')->where('rsiklaten.user.id', $v)->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
                            if(count($user) > 0)
                            {
                                $v = $user->nama;
                            }
                            else
                            {
                                $nurse = Perawat::find($perawat_id);
                                if(count($nurse) > 0)
                                {
                                    $v = $nurse->nama;
                                }
                            }
                            return $k.'. '.$v;
                        },
                        $perawat,
                        array_keys($perawat)
                    ));
                }
                else
                {
                    $perawat = '';
                }
                $diagpre       = $operasi->diagpre;
                $diagpre = str_replace('@@,', ', ', $diagpre);
                $diagpost      = $operasi->diagpost;
                $diagpost = str_replace('@@,', ', ', $diagpost);
                $tindakan    = $operasi->tindakan;
                $tindakan = str_replace('@@,', ', ', $tindakan);
                $tindakan       = explode(',', $tindakan);
                $tindakan = implode('<br>', array_map(
                    function ($v, $k) {
                        $k++;
                        return $k.'. '.$v;
                    },
                    $tindakan,
                    array_keys($tindakan)
                ));
                $jaringan = $operasi->jaringan;
                $pa      = $operasi->pa;
                $komplikasi      = $operasi->komplikasi;
                $stanggal      = date('d-m-Y', strtotime($operasi->start));
                $sjam      = date('H:i:s', strtotime($operasi->start));
                $etanggal           = date('d-m-Y', strtotime($operasi->end));
                $ejam           = date('H:i:s', strtotime($operasi->end));
                $cetaktanggal           = $operasi->cetak!=''?date('d-m-Y', strtotime($operasi->cetak)):date('d-m-Y', strtotime($operasi->registered));
                $cetakjam           = $operasi->cetak!=''?date('H:i:s', strtotime($operasi->cetak)):date('H:i:s', strtotime($operasi->registered));
                $lama = TimeLine($operasi->start, $operasi->end, 'h');
                $laporan      = nl2br($operasi->laporan);
                $intruksi_pasca = nl2br($operasi->intruksi_pasca);
                $registered    = date('Y-m-d H:i:s', strtotime($operasi->registered));
                $tanggal = date('d/m/Y', strtotime($operasi->registered));
                $jam = date('H:i', strtotime($operasi->registered));
                $userid = $operasi->writer;
                $darah_hilang = $operasi->darah_hilang;
                $darah_transfusi = $operasi->darah_transfusi;
                // if ($no_reg=='0617697') pre($tanggal);
                //cari timeout
                $selamat = DB::table('rme.operasi_selamat as os')->where('no_reg',$no_reg)->where('bon_id',$operasi->bon_id)->orderBy('id', 'DESC')->first();
                if(count($selamat) > 0)
                {
                    $selamat = (object) $selamat; 
                $tgl_mulai = date('Y-m-d', strtotime($selamat->tgl_insisi));
                $jam_mulai = date('H:i:s', strtotime($selamat->tgl_insisi.'+2 minutes'));
                }else{
                    $tgl_mulai = '';
                    $jam_mulai = '';
                }
                

                //TTD
                $user = User::join('rsiklaten.dokter', 'rsiklaten.user.user', '=', 'rsiklaten.dokter.no_dr')->where('rsiklaten.user.id', $userid)->first(array('rsiklaten.user.ttd', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2 as nama'));
                if(count($user) > 0)
                {
                    $dokter_id = $user->no_dr;
                    $nm_dr = $user->nama;
                    $ttd = $user->ttd;
                    $ttd_image = IMG."ttd/$dokter_id.jpg";
                } else {
                    $dokter_id = '';
                    $nm_dr = '';
                    $ttd   = '';
                    $ttd_image   = '';
                }
            }
        }
        //jam rampung
        $prosese = DB::table('ranap.jad_op')->where('no_reg',$no_reg)->where('bon_id',$bon_id)->first();
        if($prosese > 0){
            $prosese = (object) $prosese;
            $tgl_sel = $prosese->tanggal_sel;
            $jam_sel = $prosese->jam3;
        }else{
            $tgl_sel = '';
            $jam_sel = '';
        }
        // pre($jam_sel);

        // cek waktu mulai dari inisi + 2 menit
        if(!empty($jam_mulai))
            {
                $sjam = $jam_mulai;
            }else{
                $sjam = $sjam;
            }

         // cek jam selesai
         if(!empty($jam_sel))
         {
             $ejam = $jam_sel;
         } else{
             $ejam = $ejam;
         }   

        $implan = DB::table('ranap.implan AS a')->where(array('no_reg' => $no_reg, 'tanggal' => $tgl_masuk))->first();
        // pre($operasi);
        include('warning.pdf.php');
        $data = array(
            "no_reg"    => $no_reg,
            "tanggal" => $tanggal,
            "jam" => $jam,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tgl_rs"    => $tgl_rs,
            "ranap"     => $row_mutasi_ri,
            "nama"      => $nama,
            "warning_sama" => isset($warning_sama)?$warning_sama:false, 
            "nik"       => $nik,
            "jenis_kel" => $jenis_kel,
            "alamat"    => $alamat,
            "tgl_lahir" => $tgl_lahir,
            "umur"      => selisihymdhis($tgl_lahir, $tgl_masuk, "umur"),
            "telp"      => $telp,
            "agama"     => $agama,
            "kawin"     => $kawin,
            "didik"     => $didik,
            "kerja"     => $kerja,
            "rujuk"     => $rujuk,
            "kunjung"   => $kunjung,
            "asuransi"  => $asuransi,

            'ruang'           => $ruang,
            'dokter_bedah'    => $dokter_bedah,
            'asisten'         => $asisten,
            'perawat'         => $perawat,
            'diagpre'         => $diagpre,
            'diagpost'        => $diagpost,
            'tindakan'        => $tindakan,
            'jaringan'        => $jaringan,
            'pa'              => $pa,
            'komplikasi'      => $komplikasi,
            'stanggal'        => $stanggal,
            'sjam'            => $sjam,
            'etanggal'        => $etanggal,
            'ejam'            => $ejam,
            'cetaktanggal'    => $cetaktanggal,
            'cetakjam'        => $cetakjam,
            'lama'            => $lama,
            'laporan'         => $laporan,
            'intruksi_pasca'  => $intruksi_pasca,
            'ttd'             => $ttd,
            'ttd_image'       => $ttd_image,
            'dokter_id'       => $dokter_id,
            'dokter'          => $nm_dr,
            'registered'      => $registered,
            'darah_hilang'    => $darah_hilang,
            'darah_transfusi' => $darah_transfusi,
            'pdf_type'        => $pdf_type,
            'lp_print'        => $lp_print,
            'printer'         => $printer,
            'ipclient'        => $ipclient,
            'implan'          => count($implan) > 0 ? $implan['batch'] : '-',
            "warning_sama" => isset($warning_sama)?$warning_sama:false
        );
        // pre($data);
        // ipclient()=='172.16.18.56'?json($data):
        // ipclient()=='172.16.18.214'?json($data):
        // pre($data);
        $view = 'pdf/laporan_operasi'; 
        
        go($view, $data);
        // var_dump($view); die();
       