<?php 

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

        $rows = (array) null; 
        $total = (int) 0; 

        
        $query_rsi_byl = "select id, no_reg, kode_unit, status_rawat, tgl_masuk, no_rel, tanggal from billing.transaksi where tanggal BETWEEN '$atanggal' AND '$btanggal' and deleted = 0 order by id desc"; $rows_transaksi = DB::connection('rsi_byl')->select($query_rsi_byl); $arr_transaksi = [];
        if (!empty($rows_transaksi)) { foreach ($rows_transaksi as $key => $row_transaksi) { $arr_transaksi[$row_transaksi['no_reg'].str_replace("-", "", $row_transaksi['tanggal'])] = $row_transaksi['no_reg']; } }

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

        $query = "
        SELECT 
            aa.*,
            CASE WHEN ab.jumlah IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS BillingSPM, 
            CASE WHEN abx.no_reg IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS BillingSPX,
            CASE WHEN ac.registered IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS SoapRME,
            CASE WHEN acx.ppdiagnosa <> ' ' THEN 'ADA' ELSE 'TIDAK' END AS SoapHD
        FROM (
            SELECT 
                a.id, a.tglSEP, a.noSEP, a.nama, a.noKartu, 
                a.noMr, a.jnsPelayanan, a.kdPoli AS kdPoliBPJS, a.nmPoli AS nmPoliBPJS, 
                a.namaDiagnosa
            FROM 
                bpjs.sep2 a
                LEFT JOIN bpjs.antreanrs_poli_map b 
                ON a.kdPoli = b.kdsubspesialis
            WHERE 
                a.tglSEP BETWEEN '$atanggal' AND '$btanggal'
                and a.deletedstate=0
                $condition
                AND LENGTH(a.noSEP) > 5
            GROUP BY 
                a.noSEP 
            ORDER BY 
                a.noSEP
            ) aa
            LEFT JOIN (
                SELECT aaa.* FROM (
                SELECT * FROM dbfile.spm WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                UNION ALL SELECT * FROM dbfile.spmpjt WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                UNION ALL SELECT * FROM dbfile.spmhd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                UNION ALL SELECT * FROM dbfile.spmigd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                UNION ALL SELECT * FROM dbfile.spmro WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                ) aaa GROUP BY aaa.no_reg, aaa.tanggal 
            ) ab 
            ON aa.noMr = ab.no_reg 
            AND aa.tglSEP = ab.tanggal
            LEFT JOIN (
                SELECT aax.* FROM (
                    SELECT no_reg, tanggal FROM bill.gigi_db5j WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                    UNION ALL SELECT no_reg, tanggal FROM bill.umum_db5j WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                    UNION ALL SELECT no_reg, tanggal FROM bill.sps_db5j WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                    UNION ALL SELECT no_reg, tanggal FROM bill.jantung_db5j WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
                    UNION ALL SELECT no_reg, tanggal FROM bill.rhmed_db5j WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal
             ) aax GROUP BY aax.no_reg, aax.tanggal 
            ) abx 
            ON aa.noMr = abx.no_reg 
            AND aa.tglSEP = abx.tanggal
            LEFT JOIN (
                SELECT ppdiagnosa, no_reg, tgl_masuk FROM rme.soap_hd WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY no_reg, tgl_masuk
            ) acx
            ON aa.noMR = acx.no_reg
            AND aa.tglSEP = acx.tgl_masuk  
            LEFT JOIN (
                SELECT * FROM rme.soap WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY no_reg, tgl_masuk
            ) ac
            ON aa.noMR = ac.no_reg
            AND aa.tglSEP = ac.tgl_masuk
        ORDER BY aa.noSEP ASC
        "; 
        $rows_sep = DB::select($query);

        // if (ipclient()==IPC) pre($query);
        $str_tgl_dirawat = "";
        $total_tjp = 0;
        $total_hdr = 0;
        $total_hd = 0;
        if (!empty($rows_sep)) {
            $no = 1; 
            
            foreach ($rows_sep as $row) {
                $row = (object) $row; 
                $key = $row->noMr.str_replace("-","",$row->tglSEP);
                $row->no = $no; 
                $row->nama = strtoupper($row->nama);
                $row->no_sep = $row->noSEP;
                $row->tanggal = tampiltanggal($row->tglSEP, 9);
                $row->strtglrs = str_replace("-", "", $row->tglSEP)."000000";
                $row->no_kartu = $row->noKartu;
                $row->no_reg = $row->noMr;
                $row->kd_poli = $row->kdPoliBPJS." - ".$row->nmPoliBPJS;
                $row->rawat = $row->jnsPelayanan;
                $row->BillingSPM = !empty($arr_transaksi[$key]) ? 'ADA' : $row->BillingSPM;
                switch ($row->rawat) {
                    case 'Rawat Jalan' : 
                    case 'R.Jalan' :
                        $row->rawat = "R.JALAN";  
                        // if ($row->BillingSPM=='TIDAK') $total_tjp ++;
                        if ($row->BillingSPM =='TIDAK' && $row->BillingSPX =='TIDAK') $total_tjp ++ ;
                        if ($row->SoapHD == 'TIDAK' && $row->kdPoliBPJS == 'HDL') $total_hdr ++;
                        if ($row->kdPoliBPJS == 'HDL') $total_hd ++;
                        break; 
                    case 'Rawat Inap' : 
                    case 'R.Inap' :
                        $row->rawat = "R.INAP";  
                        break; 
                }
               
                // switch ($row->rawat) {
                //     case 'Rawat Jalan' : 
                //     case 'R.Jalan' :
                //         $row->rawat = "R.JALAN";  
                //         // if ($row->BillingSPM =='TIDAK' && $row->BillingSPX =='TIDAK') $total_tjp++;
                //         if ($row->soapHD <> 'ADA') $total_hdr ++;
                //         break; 
                //     case 'Rawat Inap' : 
                //     case 'R.Inap' :
                //         $row->rawat = "R.INAP";  
                //         break; 
                // }               
                if ($row->BillingSPM == 'ADA'){
                    $row->bill = $row->BillingSPM;
                }else if($row->BillingSPX == 'ADA'){
                    $row->bill = $row->BillingSPX;
                }
                else {
                    $row->bill = 'TIDAK';
                }
                // $row->bill = $row->BillingSPM;
                $row->diagnosa = $row->namaDiagnosa;
                // $row->rme = $row->SoapRME;
                if ($row->kdPoliBPJS == 'HDL'){
                    $row->rme = $row->SoapHD;
                }else {
                    $row->rme = $row->SoapRME;
                
                }
                $rows[] = $row;
                $no ++; 
            } 
            $total = count($rows);
        } else {
            $row = (object) null;  
            $rows[] = $row;
            $total = 0;
        }
        
        $data = array(
            "rows"    => $rows,
            "total"   => $total,
            "grand_total"   => $total,
            "total_tjp"   => $total_tjp,
            "total_sep"   => $total,
            "total_hdr"   => $total_hdr,
            "total_hd"   => $total_hd,
            
        );
        // echo"<prev>".$data."</prev>";
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));