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
                $condition .= "R.JALAN"; 
                break; 
            case 'inap' : 
                $condition .= "R.INAP"; 
                break; 
            default : 
                // $condition .= "AND jnsPelayanan NOT IN ('Rawat Inap', 'R.Inap') "; 
                break; 
        }
        if ($condition == "R.JALAN"){
        $query = "
        SELECT xx.narel,xx.no_reg,xx.tanggal,xx.kd_poli,xx.pasien, ax.nama,'R.JALAN' as jnsPelayanan,ac.diagnosa,xx.napol,

        CASE WHEN ab.jumlah IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS BillingSPM, 

        CASE WHEN ac.registered IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS SoapRME

    FROM (
         select kunjung.*, rsiklaten.asuransi.nama as narel,rsiklaten.poli.nama_poli as napol from rsiklaten.kunjung 
         left join rsiklaten.asuransi on asuransi.no_rel = kunjung.pasien
         left join rsiklaten.poli on poli.kode_poli = kunjung.kd_poli
         where kunjung.tanggal BETWEEN '$atanggal' AND '$btanggal' and deletedstate = 0 and kunjung.rawat <>'I' and kunjung.pasien not in ('300','301','302','303','304','305','001') 
             ) xx
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

            SELECT rme.soap.no_reg,rme.soap.tgl_masuk, rme.soap.jam_masuk,rme.soap.diagnosa,rme.soap.tindakan, rme.soap.registered FROM rme.soap WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY no_reg, tgl_masuk
            union all 
            select rme.soap_gd.no_reg,rme.soap_gd.tgl_masuk, rme.soap_gd.jam_masuk,rme.soap_gd.diagkerja as diagnosa,rme.soap_gd.tindakan,rme.soap_gd.registered from rme.soap_gd WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' GROUP BY no_reg, tgl_masuk
        ) ac

        ON xx.no_reg = ac.no_reg
        AND xx.tanggal = ac.tgl_masuk
             LEFT JOIN (

            SELECT no_reg,nama FROM rsiklaten.pasien 

        ) ax

        ON xx.no_reg = ax.no_reg
    ORDER BY xx.narel,xx.kd_poli ASC
        "; 
             }
    else{
        $query = "
        SELECT xx.narel,xx.no_reg,xx.tanggal,xx.kd_poli,xx.pasien, ax.nama,'R.INAP' as jnsPelayanan,ac.diagnosa,xx.napol,
        CASE WHEN ab.bill>'0' THEN 'ADA' ELSE 'TIDAK' END AS BillingSPM, 
          CASE WHEN ac.registered IS NOT NULL THEN 'ADA' ELSE 'TIDAK' END AS SoapRME

    FROM (
         select kunjung.*, rsiklaten.asuransi.nama as narel,rsiklaten.poli.nama_poli as napol from rsiklaten.kunjung 
         left join ranap.inap on kunjung.no_reg = ranap.inap.no_reg
         left join rsiklaten.asuransi on asuransi.no_rel = ranap.inap.kd_asuransi
         left join rsiklaten.poli on poli.kode_poli = kunjung.kd_poli
         where kunjung.tanggal BETWEEN '$atanggal' AND '$btanggal' and deletedstate = 0 and kunjung.rawat in ('I','G') and ranap.inap.kd_asuransi not in ('300','301','302','303','304','305','001') 
             ) xx
         LEFT JOIN (

                SELECT aaa.* FROM (
    
                SELECT * FROM inacbg.rklaim WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal'  GROUP BY no_reg, tgl_masuk
    
            ) aaa GROUP BY aaa.no_reg, aaa.tgl_masuk 
    
        ) ab 
    
            ON xx.no_reg = ab.no_reg 
    
            AND xx.tanggal = ab.tgl_masuk
    
    
        LEFT JOIN (

                   select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk, rme.soap_inap.jam_masuk,rme.soap_inap.diagkerja as diagnosa,rme.soap_inap.tindakan,rme.soap_inap.registered from rme.soap_inap WHERE tgl_masuk BETWEEN '$atanggal' AND '$btanggal' and resume='1' GROUP BY no_reg, tgl_masuk
        ) ac

        ON xx.no_reg = ac.no_reg
        AND xx.tanggal = ac.tgl_masuk
             LEFT JOIN (

            SELECT no_reg,nama FROM rsiklaten.pasien 

        ) ax

        ON xx.no_reg = ax.no_reg
    ORDER BY xx.narel,xx.kd_poli ASC
        "; 
         }
       
        $rows_sep = DB::select($query);
        // pre($rows_sep);
        $str_tgl_dirawat = "";
        $total_tjp = 0;
        if (!empty($rows_sep)) {
            $no = 1; 
            
            foreach ($rows_sep as $row) {
                $row = (object) $row; 
                $row->no = $no; 
                $row->nama = strtoupper($row->nama);
                $row->narel= $row->narel;
                $row->strtgx =  $row->tanggal;
                $row->tanggal = tampiltanggal($row->tanggal, 9);
                $row->strtglrs = str_replace("-", "", $row->strtgx);
                // $row->strtglrs = 'xxxx';
                                //  $row->no_kartu = $row->nopeserta;
                $row->no_reg = $row->no_reg;
                $row->kd_poli = $row->napol;
            
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
                $row->diagnosa = $row->diagnosa;
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