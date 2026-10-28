<?php 

        $this->load->model('Kunjung');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $query = "
        SELECT 
            * 
        FROM 
            (
            SELECT 
                a.id, 
                a.bridged,
                a.bridged_task,
                a.kode_booking AS kodebooking, 
                left(b.nama, 20) AS nama, 
                LEFT(c.nama2, 30) AS dokter,
                d.antrian,
                RIGHT(LEFT(a.kode_booking, 13), 1) AS waktu, 
                d.pasien AS kd_asuransi,
                CASE d.pasien 
                    when '300' then 'JKN'
                    when '301' then 'JKN'
                    when '302' then 'JKN'
                    when '303' then 'JKN'
                    when '304' then 'JKN'
                    when '306' then 'JKN'
                    ELSE 'NON JKN'
                END AS jenispasien,  
                CASE d.pasien 
                    when '300' then e.noKartu
                    when '301' then e.noKartu
                    when '302' then e.noKartu
                    when '303' then e.noKartu
                    when '304' then e.noKartu
                    when '306' then e.noKartu
                    ELSE ''
                END AS nomorkartu,  
                CASE d.pasien 
                    when '300' then e.nik
                    when '301' then e.nik
                    when '302' then e.nik
                    when '303' then e.nik
                    when '304' then e.nik
                    when '306' then e.nik
                    ELSE ''
                END AS nik,  
                case when trim(e.noTelp) != '' then e.noTelp ELSE b.telp END AS nohp,
                d.kd_poli,
                case
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S013' then 'PTD'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S084' then '025'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS084' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S014' then '007'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS014' then 'INT'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S012' then 'URO'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S204' then 'MAT'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S086' then 'ANA'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S053' then '152'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS053' then 'ORT'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S044' then '157'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS044' then 'ORT'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS223' then 'BED'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S223' then '018'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S455' then 'BTK'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S170' AND f.bpjs_kode = 'RAD' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S170' AND f.bpjs_kode = 'LAB' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S216' AND f.bpjs_kode = 'RAD' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S027' AND f.bpjs_kode = 'RAD' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S216' AND f.bpjs_kode = 'LAB' then 'OBG'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S111' AND f.bpjs_kode = 'LAB' then 'INT'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S187' AND d.kd_poli = 'P023' then 'INT'
                    ELSE f.bpjs_kode
                END AS kodepoli,
                case
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S013' then 'GIGI PRSOSTHODONTI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S084' then 'Fertilitas dan endokrinologi reproduksi'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS084' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S014' then 'Ginjal-Hipertensi'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS014' then 'PENYAKIT DALAM'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S012' then 'Urologi'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S204' then 'Mata'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S086' then 'ANAK'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S053' then 'Spine'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS053' then 'ORTHOPEDI DAN TRAUMATOLOGY'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S044' then 'Hip and knee'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS044' then 'ORTHOPEDI DAN TRAUMATOLOGY'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'XS223' then 'BEDAH'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S223' then 'Bedah Digestif'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S455' then 'BEDAH THORAX KARDIAK DAN VASKULER'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S170' AND f.bpjs_kode = 'RAD' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S170' AND f.bpjs_kode = 'LAB' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S216' AND f.bpjs_kode = 'RAD' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S027' AND f.bpjs_kode = 'RAD' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S216' AND f.bpjs_kode = 'LAB' then 'OBSTETRI DAN GINEKOLOGI'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S111' AND f.bpjs_kode = 'LAB' then 'Penyakit Dalam'
                    when RIGHT(LEFT(a.kode_booking, 12), 4) = 'S187' AND d.kd_poli = 'P023' then 'Penyakit Dalam'
                    ELSE f.bpjs_nama
                END AS namapoli,
                a.pasien_baru AS pasienbaru,
                a.no_reg AS norm, 
                a.tgl_masuk AS tanggalperiksa, 
                a.jam_masuk,
                RIGHT(LEFT(a.kode_booking, 12), 4) AS kd_dr,
                case when h.kodedokter IS NOT NULL then h.kodedokter when i.kode IS NOT NULL then i.kode ELSE (case when f.bpjs_kode = 'IRM' then 726 ELSE i.kode END) END AS kodedokter, 
                case when h.kodedokter IS NOT NULL then h.namadokter when i.nama IS NOT NULL then i.nama ELSE (case when f.bpjs_kode = 'IRM' then 'dr. Ahmad Fuath, Sp.KFR' ELSE i.nama END) END AS namadokter, 
                CONCAT (j.jam1, '-', j.jam2) AS jampraktek,
                CONCAT (j.jam1, ':00') AS jammulai,
                '' AS jeniskunjungan, 
                CASE d.pasien 
                    when '300' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    when '301' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    when '302' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    when '303' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    when '304' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    when '306' then case when e.noRujukan = '' then k.noSuratKontrol ELSE e.noRujukan END
                    ELSE ''
                END AS nomorreferensi,  
                d.antrian AS nomorantrean, 
                CAST(RIGHT(d.antrian, 3) AS INT) AS angkaantrean,
                '' AS estimasidilayani, 
                j.kuota AS kuota,
                TIME(a.task_1) AS fo, 
                TIME(a.task_2) AS admisi, 
                TIME(a.task_3) AS checkin, 
                TIME(a.task_4) AS mulai_poli, 
                TIME(a.task_5) AS selesai_poli, 
                TIME(a.task_6) AS mulai_resep, 
                TIME(a.task_7) AS selesai_resep 
            FROM 
                (
                SELECT 
                    * 
                FROM 
                    rsiklaten.antri_task 
                WHERE 
                    deleted IS NULL 
                    AND tgl_masuk = '$atanggal'
                    AND RIGHT(LEFT(kode_booking, 12), 4) NOT IN ('P007', 'L001', 'R001', 'L002', 'S052', 'S023', 'S177', 'S035', 'S195')
                    AND (bridged IS NULL OR bridged IS NOT NULL)
                ) a
                LEFT JOIN 
                    rsiklaten.pasien b 
                    ON a.no_reg = b.no_reg 
                LEFT JOIN rsiklaten.dokter c 
                    ON RIGHT(LEFT(a.kode_booking, 12), 4) = c.no_dr
                LEFT JOIN rsiklaten.kunjung d 
                    ON a.no_reg = d.no_reg 
                    AND a.tgl_masuk = d.tanggal
                    AND a.jam_masuk = d.jam 
                    AND RIGHT(LEFT(a.kode_booking, 12), 4) = d.kd_dr
                    AND d.deletedstate = 0  
                LEFT JOIN bpjs.sep2 e 
                    ON a.no_reg = e.noMr 
                    AND a.tgl_masuk = e.tglSEP
                LEFT JOIN rsiklaten.poli f
                    ON d.kd_poli = f.kode_poli
                LEFT JOIN bpjs.antreanrs_dokter_map g
                    ON RIGHT(LEFT(a.kode_booking, 12), 4) = g.no_dr
                    AND g.deleted IS NULL 
                LEFT JOIN bpjs.antreanrs_ref_dokter h 
                    ON g.kodedokter = h.kodedokter
                LEFT JOIN bpjs.dpjp i 
                    ON RIGHT(LEFT(a.kode_booking, 12), 4) = i.kd_dr
                LEFT JOIN (
                    SELECT 
                        aa.id,
                        aa.hari, 
                        aa.waktu, 
                        aa.jam1, 
                        aa.jam2, 
                        aa.kuota, 
                        aa.ijin_praktek,
                        aa.dokter_id,
                        aa.dokter_spesialis_id,
                        ab.dokter_id AS kode_dokter
                    FROM 
                        pendaftaran.praktek aa
                        LEFT JOIN pendaftaran.dokter_spesialis ab
                        ON aa.dokter_spesialis_id = ab.id
                    WHERE 
                        aa.hari = WEEKDAY('$atanggal') + 1
                    ) j 
                    ON RIGHT(LEFT(a.kode_booking, 12), 4) = j.kode_dokter
                    AND RIGHT(LEFT(a.kode_booking, 13), 1) = j.waktu			
                LEFT JOIN bpjs.surat_kontrol k 
                    ON e.noKartu = k.noKartu 
                    AND e.tglSEP = k.tglRencanaKontrol
                    AND k.deleted IS NULL
            WHERE 
                d.pasien IS NOT NULL 
            ORDER BY LEFT(a.kode_booking, 13) ASC, RIGHT(a.kode_booking, 3) ASC
            ) xxx 
        WHERE 
            xxx.kodepoli NOT IN ('IRM', 'AKP')
            AND xxx.kd_poli NOT IN ('GCU')
            AND xxx.nomorkartu IS NOT NULL 
            AND xxx.kuota IS NOT NULL
            AND (xxx.jenispasien = 'NON JKN' OR (xxx.jenispasien = 'JKN' AND xxx.nomorreferensi != ''))
        "; 
        $antrol = DB::select($query);
        $rows = (array) null; 
        $total_antrian = 0; 
        $total_fo = 0; 
        $total_admisi = 0; 
        $total_checkin = 0; 
        $total_mulai_poli = 0; 
        $total_selesai_poli = 0; 
        $total_mulai_resep = 0; 
        $total_selesai_resep = 0; 
        $total_menunggu_poli = 0; 
        $total_menunggu_dokter = 0; 
        $total_menunggu_obat = 0; 
        if (!empty($antrol)) {
            $no = 1; 
            foreach ($antrol as $row) {
                $row = (object) $row;
                $row->str_tanggal = date("d-m-Y", strtotime($row->tanggalperiksa)); 
                $row->str_jam = $row->jam_masuk;
                $row->str_tgl_rs = strtotime($row->tanggalperiksa." ".$row->jam_masuk);
                if (!empty($row->fo)) { $total_fo++; }
                if (!empty($row->admisi)) { $total_admisi++; }
                if (!empty($row->checkin)) { $total_checkin++; }
                if (!empty($row->mulai_poli)) { $total_mulai_poli++; }
                if (!empty($row->selesai_poli)) { $total_selesai_poli++; }
                if (!empty($row->mulai_resep)) { $total_mulai_resep++; }
                if (!empty($row->selesai_resep)) { $total_selesai_resep++; }
                if (!empty($row->checkin) && empty($row->mulai_poli)) { $total_menunggu_poli ++; }
                if (!empty($row->mulai_poli) && empty($row->selesai_poli)) { $total_menunggu_dokter ++; }
                if (!empty($row->mulai_resep) && empty($row->selesai_resep)) { $total_menunggu_obat ++; }
                $rows[] = $row;
            }
        }
        $total = count($rows);
        $temp_rows = $rows; 
        $rows = (array) null;
        if (!empty($temp_rows)) {
            $no = 1; 
            foreach ($temp_rows as $row) {
                switch ($kategori) {
                    case 'menunggu_poli' :
                        if (!empty($row->checkin) && empty($row->mulai_poli)) { 
                            $row->no = $no; 
                            $rows[] = $row;
                            $no ++;
                        }
                        break; 
                    case 'menunggu_dokter' :
                        if (!empty($row->mulai_poli) && empty($row->selesai_poli)) { 
                            $row->no = $no; 
                            $rows[] = $row;
                            $no ++;
                        }
                        break; 
                    case 'menunggu_obat' :
                        if (!empty($row->mulai_resep) && empty($row->selesai_resep)) { 
                            $row->no = $no; 
                            $rows[] = $row;
                            $no ++;
                        }
                        break; 
                    default : 
                        $row->no = $no; 
                        $rows[] = $row;
                        $no ++;
                        break; 
                }
            }
        }
        $grand_total = 0;
        $grand_total = count($rows);
        $data = array(
            "rows" => $rows, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => array(
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ), 
            "grand_total" => $grand_total." KUNJUNGAN PASIEN",
            "total_fo" => $total_fo,
            "total_admisi" => $total_admisi,
            "total_checkin" => $total_checkin,
            "total_mulai_poli" => $total_mulai_poli,
            "total_selesai_poli" => $total_selesai_poli,
            "total_mulai_resep" => $total_mulai_resep,
            "total_selesai_resep" => $total_selesai_resep,
            "total_menunggu_poli" => $total_menunggu_poli,
            "total_menunggu_dokter" => $total_menunggu_dokter,
            "total_menunggu_obat" => $total_menunggu_obat,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));