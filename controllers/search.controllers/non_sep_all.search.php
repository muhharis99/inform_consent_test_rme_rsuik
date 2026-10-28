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
        $query_rsi_byl = "select id, no_reg, kode_unit, status_rawat, tgl_masuk, no_rel, tanggal from billing.transaksi where tanggal BETWEEN '$atanggal' AND '$btanggal' and deleted = 0 order by id desc";
        $rows_transaksi = DB::connection('rsi_byl')->select($query_rsi_byl);
        $arr_transaksi = [];
        if (!empty($rows_transaksi)) {
            foreach ($rows_transaksi as $key => $row_transaksi) {
                $arr_transaksi[$row_transaksi['no_reg'].str_replace("-", "", $row_transaksi['tanggal'].$row_transaksi['kode_unit'])] = $row_transaksi['no_reg'];
            }
        }
        // if (ipclient()=="172.16.18.210") json($arr_transaksi['055571920250721HD']);
        $query = "
        SELECT aa.tglSep,aa.noSEP, aa.noKartu, aa.jnsPelayanan, aa.nmPoliBPJS, xx.no_reg,xx.tanggal,xx.kd_poli,xx.pasien, ax.nama,

            CASE WHEN ab.jumlah IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS BillingSPM, 

            CASE WHEN ac.registered IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS SoapRME

        FROM (
             select * from rsiklaten.kunjung where tanggal BETWEEN '$atanggal' AND '$btanggal' and deletedstate = 0 and rawat <>'I' and kd_poli not in ('UGD','PNEK') and pasien in ('300','301','302','303','304','305') 
                 ) xx
        LEFT JOIN ( 

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
            on xx.no_reg = aa.noMr 
            AND aa.tglSEP = xx.tanggal  
              
            LEFT JOIN (

                SELECT aaa.* FROM (

                SELECT * FROM dbfile.spm WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal

                UNION ALL SELECT * FROM dbfile.spmpjt WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal

                UNION ALL SELECT * FROM dbfile.spmhd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal

                UNION ALL SELECT * FROM dbfile.spmigd WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal

                UNION ALL SELECT * FROM dbfile.spmro WHERE tanggal BETWEEN '$atanggal' AND '$btanggal' AND deleted IS NULL GROUP BY no_reg, tanggal

                ) aaa GROUP BY aaa.no_reg, aaa.tanggal 

            ) ab 

            ON xx.no_reg = ab.no_reg 

            AND xx.tanggal = ab.tanggal

            LEFT JOIN (

                SELECT rme.soap.no_reg, rme.soap.tgl_masuk, rme.soap.registered FROM rme.soap WHERE rme.soap.tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY rme.soap.no_reg, rme.soap.tgl_masuk
                UNION ALL 
                SELECT rme.soap_hd.no_reg, rme.soap_hd.tgl_masuk, rme.soap_hd.registered FROM rme.soap_hd WHERE rme.soap_hd.tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY rme.soap_hd.no_reg, rme.soap_hd.tgl_masuk

            ) ac

            ON xx.no_reg = ac.no_reg
            AND xx.tanggal = ac.tgl_masuk
                 LEFT JOIN (

                SELECT no_reg,nama FROM rsiklaten.pasien 

            ) ax

            ON xx.no_reg = ax.no_reg
           where aa.noSEP is null  
        ORDER BY aa.noSEP,xx.kd_poli ASC
        "; 
        $rows_sep = DB::select($query);
        // pre($rows_sep);
        $str_tgl_dirawat = "";
        $total_tjp = 0;
        if (!empty($rows_sep)) {
            $no = 1; 
            
            foreach ($rows_sep as $row) {
                $row = (object) $row; 
                $key = $row->no_reg.str_replace("-","",$row->tanggal).$row->kd_poli;
                $row->no = $no; 
                $row->nama = strtoupper($row->nama);
                $row->no_sep = $row->noSEP;
                $row->tanggal = tampiltanggal($row->tanggal, 9);
                $row->strtglrs = str_replace("-", "", $row->tanggal)."000000";
                $row->no_kartu = $row->noKartu;
                $row->no_reg = $row->no_reg;
                $row->kd_poli = $row->kd_poli;
                $row->BillingSPM = !empty($arr_transaksi[$key]) ? 'ADA' : $row->BillingSPM;
                $row->rawat = $row->jnsPelayanan;
                switch ($row->rawat) {
                    case 'Rawat Jalan' : 
                    case 'R.Jalan' :
                        $row->rawat = "R.JALAN";  
                        if ($row->BillingSPM=='TIDAK') $total_tjp ++;
                        break; 
                    case 'Rawat Inap' : 
                    case 'R.Inap' :
                        $row->rawat = "R.INAP";  
                        break; 
                }
                $row->bill = $row->BillingSPM;
                // $row->diagnosa = $row->namaDiagnosa;
                $row->rme = $row->SoapRME;
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
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));