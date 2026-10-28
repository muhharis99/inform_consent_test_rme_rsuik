<?php 

        $this->load->model('Kunjung');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $query = "
        SELECT
            a.no_reg, a.rawat, a.tanggal, a.kd_poli, a.jam, a.jam as admisi, TIME(b.registered) as askep, TIME(c.registered) as soap, d.jam as bill, e.kd_diag as diag, f.nama, g.nama as dokter, h.nama_poli as poli, case when h.report_nama != '' then h.report_nama else h.nama_poli end as report_poli, i.nama as asuransi
        FROM 
            rsiklaten.kunjung a
            LEFT JOIN (
                SELECT 
                    x_askep.* 
                FROM 
                    (
                        SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.askep 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.askep_gd
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.askep_poli_inap 
                    ) x_askep
                WHERE 
                    x_askep.deleted IS NULL
                    AND x_askep.tgl_masuk = '$atanggal' 
                GROUP BY 
                    x_askep.no_reg, x_askep.tgl_masuk, x_askep.jam_masuk
            ) b 
                ON a.no_reg = b.no_reg
                AND a.tanggal = b.tgl_masuk 
                AND a.jam = b.jam_masuk 
            LEFT JOIN (
                SELECT 
                    x_soap.* 
                FROM 
                    (
                        SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.soap 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.soap_gd
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, registered, deleted FROM rme.soap_poli_inap 
                    ) x_soap
                WHERE 
                    x_soap.deleted IS NULL
                    AND x_soap.tgl_masuk = '$atanggal' 
                GROUP BY 
                    x_soap.no_reg, x_soap.tgl_masuk, x_soap.jam_masuk
            ) c 
                ON a.no_reg = c.no_reg
                AND a.tanggal = c.tgl_masuk 
                AND a.jam = c.jam_masuk 
            LEFT JOIN (
                SELECT 
                    x_bill.* 
                FROM 
                    (
                        SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.ugd_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.ugd_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.sps_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.sps_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.gigi_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.gigi_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.umum_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.umum_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.rhmed_db5  
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.rhmed_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.jantung_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.jantung_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.hd_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.hd_db5j 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.eeg_db5 
                        UNION ALL SELECT no_reg, tgl_masuk, jam_masuk, tanggal, jam, no_rel, deleted FROM bill.eeg_db5j 
                    ) x_bill 
                WHERE 
                    x_bill.deleted IS NULL 
                    AND x_bill.tgl_masuk = '$atanggal'
                GROUP BY 
                    x_bill.no_reg, x_bill.tgl_masuk, x_bill.jam_masuk
            ) d 
                ON a.no_reg = d.no_reg
                AND a.tanggal = d.tgl_masuk 
                AND a.jam = d.jam_masuk 
            LEFT JOIN dbfile.rm_icd e 
                ON a.no_reg = e.no_reg 
                AND a.tanggal = e.tgl_masuk
                AND a.kd_poli = e.poli
            LEFT JOIN rsiklaten.pasien f
                ON a.no_reg = f.no_reg 
            LEFT JOIN rsiklaten.dokter g 
                ON a.kd_dr = g.no_dr
            LEFT JOIN rsiklaten.poli h 
                ON a.kd_poli = h.kode_poli
            LEFT JOIN rsiklaten.asuransi i 
                ON a.pasien = i.no_rel
        WHERE 
            a.tanggal = '$atanggal'
            AND a.deleted IS NULL
        ORDER BY 
            a.NO_REG asc
        "; 
        // pre($query);
        $riwayat = DB::connection('slave')->select($query);
        
        $rows = (array) null; 
        $total_askep = 0; 
        $total_soap = 0; 
        $total_lengkap = 0; 
        $total_tjp = 0; 
        $total_waiting_koder = 0; 
        $total_waiting_rme = 0; 
        if (!empty($riwayat)) {
            $no = 1; 
            foreach ($riwayat as $row) {
                $row = (object) $row;
                $row->str_tanggal = date("d-m-Y", strtotime($row->tanggal)); 
                $row->tgl_kunjung = str_replace("-", "", $row->tanggal).str_replace(":", "", $row->jam); 
                $row->str_tgl_rs = strtotime($row->tanggal." ".$row->jam);
                $row->koder = $row->diag;
                $rawat = 'JALAN'; 
                switch ($row->rawat) {
                    case 'G' : 
                    case 'I' :
                        $rawat = 'INAP';  
                        break;
                    default : 
                        $row->str_rawat = $rawat;
                        if (empty($poli)) {
                            if (!empty($row->askep)) {
                                $total_askep ++; 
                            }
                            if (!empty($row->soap)) {
                                $total_soap ++; 
                            }
                            if (!empty($row->askep)&&!empty($row->soap)&&!empty($row->diag)) {
                                $total_lengkap ++; 
                            }
                            if (empty($row->askep)&&empty($row->soap)&&empty($row->bill)) {
                                $total_tjp ++; 
                            }
                            if ((!empty($row->askep)||!empty($row->soap)||!empty($row->bill))&&empty($row->diag)) {
                                $total_waiting_koder ++; 
                            }
                            if ((!empty($row->askep)||!empty($row->soap)||!empty($row->bill))) {
                                $total_waiting_rme ++; 
                            }
                            $row->no = $no; 
                            $no++; 
                            $rows[] = $row;
                        } else {
                            if (in_array($row->report_poli, $poli)) {
                                if (!empty($row->askep)) {
                                    $total_askep ++; 
                                }
                                if (!empty($row->soap)) {
                                    $total_soap ++; 
                                }
                                if (!empty($row->askep)&&!empty($row->soap)&&!empty($row->diag)) {
                                    $total_lengkap ++; 
                                }
                                if (empty($row->askep)&&empty($row->soap)&&empty($row->bill)) {
                                    $total_tjp ++; 
                                }
                                if ((!empty($row->askep)||!empty($row->soap)||!empty($row->bill))&&empty($row->diag)) {
                                    $total_waiting_koder ++; 
                                }
                                if ((!empty($row->askep)||!empty($row->soap)||!empty($row->bill))) {
                                    $total_waiting_rme ++; 
                                }
                                $row->no = $no; 
                                $no++; 
                                $rows[] = $row;
                            }
                        }     
                        break; 
                }
                   
                
            }
        }
        $total = count($rows);
        $temp_rows = $rows; 
        $rows = (array) null;
        if (!empty($temp_rows)) {
            $no = 1; 
            foreach ($temp_rows as $row) {
                switch ($kategori) {
                    case 'tjp' : 
                        if (empty($row->askep)&&empty($row->soap)&&empty($row->bill)) {
                            $row->no = $no; 
                            $rows[] = $row;
                            $no ++; 
                        }
                        // $total_askep = 0; 
                        // $total_soap = 0; 
                        // $total_lengkap = 0; 
                        // $total_tjp = 0; 
                        // $total_waiting_koder = 0; 
                        // $total_waiting_rme = 0; 
                        break; 
                    case 'koder' : 
                        if ((!empty($row->askep)||!empty($row->soap)||!empty($row->bill))&&empty($row->diag)) {
                            $row->no = $no; 
                            $rows[] = $row;
                            $no ++; 
                        }
                        // $total_askep = 0; 
                        // $total_soap = 0; 
                        // $total_lengkap = 0; 
                        // $total_tjp = 0; 
                        // $total_waiting_koder = 0; 
                        // $total_waiting_rme = 0; 
                        break; 
                    case 'lengkap' : 
                        if (!empty($row->askep)&&!empty($row->soap)&&!empty($row->diag)) {
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
        if ($total_soap = 0) {
            $total_tjp = 0; 
        }
        $total_waiting_rme = $total - $total_tjp - $total_waiting_koder - $total_lengkap;
        $data = array(
            "rows" => $rows, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => array(
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ), 
            "grand_total" => $total." KUNJUNGAN PASIEN",
            "total_admisi" => $total,
            "total_askep" => $total_askep,
            "total_lengkap" => $total_lengkap,
            "total_tjp" => $total_tjp,
            "total_waiting_koder" => $total_waiting_koder,
            "total_waiting_rme" => $total_waiting_rme,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));