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
                a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_poli,a.kd_dr, FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
                a.diagnosa,
                a.registered,a.jenis,
                b.nama2 as nama_dr,
                c.nama_poli,
                d.Id as done
            FROM 
                rme.soap a
            LEFT JOIN 
                rsiklaten.dokter b ON a.kd_dr = b.no_dr
            JOIN
                rsiklaten.poli c ON a.kd_poli = c.kode_poli
            LEFT JOIN
                inacbg.diag_rj d ON a.id = d.soap_id and d.deleted is null
                #inacbg.diag_rj d ON a.no_reg = d.no_reg and a.tgl_masuk = d.tgl_masuk and a.jam_masuk = d.jam_masuk
            WHERE 
                a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal'
            AND
                a.kd_asuransi NOT IN ('300','301','302','303')
            #AND 
	            #a.kd_poli NOT IN ('F002','F003')
                and a.deleted is null
            #GROUP BY a.id
            GROUP BY a.no_reg,a.tgl_masuk, a.jam_masuk
            "; 
        }else {
            $query = "
            SELECT 
                a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_poli,a.kd_dr,a.diagnosa,a.registered, FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
                b.nama2 as nama_dr,a.jenis,
                c.nama_poli,d.Id as done
            FROM 
                rme.soap a
            LEFT JOIN 
                rsiklaten.dokter b ON a.kd_dr = b.no_dr
            JOIN
                rsiklaten.poli c ON a.kd_poli = c.kode_poli
            LEFT JOIN
                inacbg.diag_rj d ON a.id = d.soap_id and d.deleted is null
              #inacbg.diag_rj d ON a.no_reg = d.no_reg and a.tgl_masuk = d.tgl_masuk and a.jam_masuk = d.jam_masuk
            WHERE 
                a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal'
            AND
                a.kd_poli = '$rawat'
            AND
               a.kd_asuransi NOT IN ('300','301','302','303')
               and a.deleted is null
            #AND 
               # b.jnsPelayanan in ('Rawat Jalan', 'R.Jalan')
            GROUP BY a.no_reg,a.tgl_masuk, a.jam_masuk
            "; 
        }
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
                $row->nama      = strtoupper($row->nama);
                $row->no_reg    = $row->no_reg;
                $row->umur    = $row->umur;
                $row->tgl_masuk = $row->tgl_masuk;
                $row->jam_masuk = $row->jam_masuk;
                $row->nama_dr   = $row->nama_dr;
                $row->nama_poli = $row->nama_poli;
                if ($row->jenis == '1'){
                    $jenis ='Baru';
                }else {
                    $jenis ='Lama';  
                }
                $row->jenis = $jenis;
                $row->diagnosa  = $row->diagnosa;
                if (!empty($row->done)) {
                    $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'> Edit ICD</a>";
                }else {
                    $tombol = "<a class='btn btn-sm btn-info text-light' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'> Edit ICD</a>";
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