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
        $this->load->model('Perawat');
        $this->load->model('Asuransi');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $this->load->model('Karyawan');
        $this->load->model('Karya');
        $this->load->model('Dokter');
        $this->load->model('User');
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)
                            ->where('tgl_masuk', $tgl_masuk)
                            ->whereNull('deleted')
                            ->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))
                            ->orderBy('id', 'DESC')
                            ->first();
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
        $operasi = DB::table('rme.operasi as a')
                        ->where('no_reg', $no_reg)
                        ->where('end', $tgl_masuk." ".$jam_masuk)
                        //->whereNotNull('deleted')
                        ->orderBy('id', 'DESC')
                        ->first() ;
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
            $dokter_bedah = array_filter(explode(',', $operasi->dokter_bedah));
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
                        $perawat_id = $v;
                        $k++;

                        $user = User::join('sdm.karya', 'sdm.karya.nik', '=', 'rsiklaten.user.user')
                                    ->where('rsiklaten.user.id', $v)
                                    ->first(array('rsiklaten.user.ttd', 'sdm.karya.nama'));
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
            //tgl op start
            $tgl_implan =date('Y-m-d', strtotime($operasi->start));
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
            // if(ipclient()==IPC) json($userid);

            //TTD
            $user = User::join('rsiklaten.dokter', 'rsiklaten.user.user', '=', 'rsiklaten.dokter.no_dr')
                            ->where('rsiklaten.user.id', $userid)
                            ->first(array('rsiklaten.user.ttd', 'rsiklaten.dokter.no_dr', 'rsiklaten.dokter.nama2 as nama'));
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

        $implan = DB::table('ranap.implan AS a')->where(array('no_reg' => $no_reg, 'tanggal' => $tgl_implan))->first();
    // pre($stanggal);
        include('warning.pdf.php');
        $data = array(
            "no_reg"    => $no_reg,
            "tanggal" => $tanggal,
            "jam" => $jam,
            "tgl_masuk" => $tgl_masuk,
            "jam_masuk" => $jam_masuk,
            "tgl_rs"    => str_replace(["-", " ", ":"], "", $tgl_masuk.$jam_masuk),
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
        // json($data);
        // ipclient()=='172.16.18.21'?json($data):
        $view = 'pdf/laporan_operasi_start'; 
        
        go($view, $data);
