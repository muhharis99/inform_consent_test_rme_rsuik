<?php 
        $this->load->model('soap');
        // $this->load->model('diag_rj');

        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $rawat  = $this->input->get('rawat');
        $atanggal = $this->input->get('atanggal');
        $btanggal = $this->input->get('btanggal');

        $atanggal = $atanggal!='' ? date("Y-m-d", strtotime($atanggal)) : date("Y-m-d"); 
        $btanggal = $btanggal!='' ? date("Y-m-d", strtotime($btanggal)) : date("Y-m-d"); 

        $row = (array) null; 
        $rows = (array) null; 
        $total = (int) 0; 
        $condition = ''; 
        switch ($rawat) {
            case 'jalan' : 
                $condition .= "AND jnsPelayanan IN ('Rawat Jalan', 'R.Jalan') "; 
                break; 
            case 'inap' : 
                $condition .= "AND jnsPelayanan IN ('Rawat Inap', 'R.Inap') "; 
                break; 
            default : 
                // $condition .= "AND jnsPelayanan NOT IN ('Rawat Inap', 'R.Inap') "; 
                break; 
        }

        if (empty($rawat) || $rawat == 'all') {
            $query = "
            SELECT 
                a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_poli,a.kd_dr,a.jenis,
                #a.diagnosa,
                group_concat(a.diagnosa SEPARATOR ' ,') AS diagnosa,
                a.registered,
                b.noKartu,
                (SELECT b.noSEP FROM bpjs.sep2 b 
                WHERE b.noMr = a.no_reg 
                AND b.tglSEP = a.tgl_masuk and b.deletedstate=0 ORDER BY id DESC LIMIT 1) AS noSEP,
                #c.nama_poli,
                group_concat(c.nama_poli SEPARATOR ' ,') AS nama_poli,
                d.Id as done
            FROM 
                rme.soap a
            LEFT JOIN 
                bpjs.sep2 b ON a.no_reg = b.noMr AND a.tgl_masuk = b.tglSEP and b.deletedstate = 0
            JOIN
                rsiklaten.poli c ON a.kd_poli = c.kode_poli
            LEFT JOIN
            inacbg.diag_rj d ON a.no_reg = d.no_reg and a.tgl_masuk = d.tgl_masuk and a.jam_masuk = d.jam_masuk and d.deleted is null
            WHERE 
                a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal'
            AND 
                b.jnsPelayanan in ('Rawat Jalan', 'R.Jalan')
            AND
                a.kd_asuransi IN ('300','301','302','303','312','306')
            #AND 
	            #a.kd_poli NOT IN ('F002','F003')
            #GROUP BY a.id
            GROUP BY a.no_reg,a.tgl_masuk
            "; 
            // die($query);
        }else {
            $query = "
            SELECT 
                a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_poli,a.kd_dr,a.diagnosa,a.registered,a.jenis,
                b.noKartu,
                (SELECT b.noSEP FROM bpjs.sep2 b 
                WHERE b.noMr = a.no_reg 
                AND b.tglSEP = a.tgl_masuk ORDER BY id DESC LIMIT 1) AS noSEP,
                c.nama_poli,d.Id as done
            FROM 
                rme.soap a
            LEFT JOIN 
                bpjs.sep2 b ON a.no_reg = b.noMr AND a.tgl_masuk = b.tglSEP
            JOIN
                rsiklaten.poli c ON a.kd_poli = c.kode_poli
            LEFT JOIN
                inacbg.diag_rj d ON a.no_reg = d.no_reg and a.tgl_masuk = d.tgl_masuk and a.jam_masuk = d.jam_masuk and d.deleted is null
            WHERE 
                a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal'
            AND
                a.kd_poli = '$rawat'
            AND
             a.kd_asuransi IN ('300','301','302','303','312','306')
            AND 
                b.jnsPelayanan in ('Rawat Jalan', 'R.Jalan')
            GROUP BY a.id
            "; 
        }
        // ipclient()==IPC?pre($query):'';
        $soap = DB::select($query);

        $str_tgl_dirawat = "";
        $total_tjp = 0;
        if (!empty($soap)) {
            $no = 1; 
            
            foreach ($soap as $row) {
                $row = (object) $row; 
                $row->id        = $row->id;
                $row->no        = $no;
                $row->tanggal   = date('d-m-Y H:i:s', strtotime($row->registered));
                $row->nama      = strtoupper($row->nama);
                $row->no_reg    = $row->no_reg;
                $row->tgl_masuk = $row->tgl_masuk;
                $row->jam_masuk = $row->jam_masuk;
                $row->no_sep    = $row->noSEP;
                $row->no_kartu  = $row->noKartu;
                $row->nama_poli = $row->nama_poli;
                if ($row->jenis == '1'){
                    $jenis ='Baru';
                }else {
                    $jenis ='Lama';  
                }
                $row->jenis = $jenis;
                $row->diagnosa  = $row->diagnosa;
                if (!empty($row->done)) {
                    $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk' data-no_sep='$row->no_sep'> Edit ICD</a>";
                }else {
                    $tombol = "<a class='btn btn-sm btn-info text-light' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk' data-no_sep='$row->no_sep'> Edit ICD</a>";
                }
                $row->aksi = $tombol;
                $rows[] = $row;
                $no ++; 
            } 
            $total = count($rows);
        } else {
            $row = (object) null;  
            $rows[] = $row;
            $total = 0;
        }
        // echo"<pre>";print_r($soap);die();
        // pre($row->done);

        // $query = "
        // SELECT 
        //     aa.*,
        //     CASE WHEN ab.jumlah IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS BillingSPM, 
        //     CASE WHEN ac.registered IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS SoapRME
        // FROM (
        //     SELECT 
        //         a.id, a.tglSEP, a.noSEP, a.nama, a.noKartu, 
        //         a.noMr, a.jnsPelayanan, a.kdPoli AS kdPoliBPJS, a.nmPoli AS nmPoliBPJS, 
        //         a.namaDiagnosa
        //     FROM 
        //         bpjs.sep2 a
        //         LEFT JOIN bpjs.antreanrs_poli_map b 
        //         ON a.kdPoli = b.kdsubspesialis
        //     WHERE 
        //         a.tglSEP BETWEEN '$atanggal' AND '$btanggal'
        //         and a.deletedstate=0
        //         $condition
        //         AND LENGTH(a.noSEP) > 5
        //     GROUP BY 
        //         a.noSEP 
        //     ORDER BY 
        //         a.noSEP
        //     ) aa
        //     LEFT JOIN (
        //         SELECT aaa.* FROM (
        //         SELECT * FROM dbfile.spm WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
        //         UNION ALL SELECT * FROM dbfile.spmpjt WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
        //         UNION ALL SELECT * FROM dbfile.spmhd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
        //         UNION ALL SELECT * FROM dbfile.spmigd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
        //         UNION ALL SELECT * FROM dbfile.spmro WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
        //         ) aaa GROUP BY aaa.no_reg, aaa.tanggal 
        //     ) ab 
        //     ON aa.noMr = ab.no_reg 
        //     AND aa.tglSEP = ab.tanggal
        //     LEFT JOIN (
        //         SELECT * FROM rme.soap WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY no_reg, tgl_masuk
        //     ) ac
        //     ON aa.noMR = ac.no_reg
        //     AND aa.tglSEP = ac.tgl_masuk
        // ORDER BY aa.noSEP ASC
        // "; 
        // $rows_sep = DB::select($query);
        // pre($rows_sep);
        // $str_tgl_dirawat = "";
        // $total_tjp = 0;
        // if (!empty($rows_sep)) {
        //     $no = 1; 
            
        //     foreach ($rows_sep as $row) {
        //         $row = (object) $row; 
        //         $row->no = $no; 
        //         $row->nama = strtoupper($row->nama);
        //         $row->no_sep = $row->noSEP;
        //         $row->tanggal = tampiltanggal($row->tglSEP, 9);
        //         $row->strtglrs = str_replace("-", "", $row->tglSEP)."000000";
        //         $row->no_kartu = $row->noKartu;
        //         $row->no_reg = $row->noMr;
        //         $row->kd_poli = $row->kdPoliBPJS." - ".$row->nmPoliBPJS;
        //         $row->rawat = $row->jnsPelayanan;
        //         switch ($row->rawat) {
        //             case 'Rawat Jalan' : 
        //             case 'R.Jalan' :
        //                 $row->rawat = "R.JALAN";  
        //                 if ($row->BillingSPM=='TIDAK') $total_tjp ++;
        //                 break; 
        //             case 'Rawat Inap' : 
        //             case 'R.Inap' :
        //                 $row->rawat = "R.INAP";  
        //                 break; 
        //         }
        //         $row->bill = $row->BillingSPM;
        //         $row->diagnosa = $row->namaDiagnosa;
        //         $row->rme = $row->SoapRME;
        //         $rows[] = $row;
        //         $no ++; 
        //     } 
        //     $total = count($rows);
        // } else {
        //     $row = (object) null;  
        //     $rows[] = $row;
        //     $total = 0;
        // }
        
        $data = array(
            "rows"    => $rows,
            "total"   => $total,
            "grand_total"   => $total,
            "total_tjp"   => $total,
            "total_sep"   => $total,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));