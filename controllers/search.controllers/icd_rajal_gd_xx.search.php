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

        $query_lama = "
        SELECT 
            a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.poli_id,a.dokter_id,a.diagkerja,a.registered,
            b.noKartu,
            (SELECT b.noSEP FROM bpjs.sep2 b 
            WHERE b.noMr = a.no_reg 
            AND b.tglSEP = DATE_FORMAT(a.registered, '%Y-%m-%d') ORDER BY id DESC LIMIT 1) AS noSEP,
            c.nama_poli,d.Id as done
        FROM 
            rme.soap_gd a
        #LEFT JOIN 
        JOIN 
            bpjs.sep2 b ON a.no_reg = b.noMr AND DATE_FORMAT(a.registered, '%Y-%m-%d') = b.tglSEP
        JOIN
            rsiklaten.poli c ON a.poli_id = c.kode_poli
        LEFT JOIN
            inacbg.diag_rj d ON a.id = d.soap_id and d.deleted is null
        WHERE 
            DATE_FORMAT(a.registered, '%Y-%m-%d') BETWEEN '$atanggal' AND '$btanggal'
        AND
            a.tinlan IN ('1','2','3','4')
        #AND 
            #b.jnsPelayanan in ('Rawat Jalan', 'R.Jalan')
        GROUP BY a.id
        "; 

        $query = "
        SELECT 
            a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.tgl_lahir, a.poli_id,a.dokter_id,a.diagkerja,a.registered,
            '' as noKartu,
            '' as noSEP,
            c.nama_poli,d.Id as done, d.icd1, d.icd2, d.icd3, d.icd4, d.pd1, d.pd2, d.pd3, d.pd4, d.kd_sms
            FROM 
            rme.soap_gd a
                #LEFT JOIN bpjs.sep2 b 
                  #  ON a.no_reg == b.noMr 
                #AND b.tglSEP BETWEEN DATE(a.registered) AND DATE_ADD(a.registered, INTERVAL 1 DAY) 
                LEFT JOIN rsiklaten.poli c 
                    ON a.poli_id = c.kode_poli
                LEFT JOIN inacbg.diag_rj d 
                    ON a.id = d.soap_id and d.deleted is null and concat_ws(d.icd1, d.icd2, d.icd3, d.icd4, d.pd1, d.pd2, d.pd3, d.pd4, d.kd_sms)!=''
            WHERE 
            DATE(a.registered) BETWEEN '$atanggal' AND '$btanggal'
            AND a.no_reg > 100
            AND a.deleted IS NULL 
            #and a.no_reg = b.noMr 
            AND
            a.tinlan IN ('1','2','3','4')
            GROUP BY 
                a.id
            ORDER BY 
                a.no_reg ASC;
        "; 
        
        // ipclient()==IPC?die($query):'';
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
                $row->nama      = strtoupper($row->nama)."&nbsp;(".selisihymdhis($row->tgl_masuk, $row->tgl_lahir, "umur").")";
                $row->no_reg    = $row->no_reg;
                $row->tgl_masuk = $row->tgl_masuk;
                $row->jam_masuk = $row->jam_masuk;
                $row->no_sep    = $row->noSEP;
                $row->no_kartu  = $row->noKartu;
                $row->nama_poli = $row->nama_poli;
                $row->diagnosa  = $row->diagkerja;
                // if (!empty($row->done)&&$row->icd1!=''&&$row->icd2!=''&&$row->icd3!=''&&$row->icd4!=''&&$row->pd1!=''&&$row->pd2!=''&&$row->pd3!=''&&$row->pd4!=''&&$row->kd_sms!='') {
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

        $data = array(
            "rows"    => $rows,
            "total"   => $total,
            "grand_total"   => $total,
            "total_tjp"   => $total,
            "total_sep"   => $total,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));