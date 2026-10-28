<?php 
        $this->load->model('soap_inap');
        // $this->load->model('diag_ri');

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
            SELECT a.id,a.no_reg,a.tgl_keluar,a.nama,a.tgl_masuk,a.jam_masuk,a.bangsal_id ,a.dpjp1 ,a.asuransi_id,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
       a.diagkerja as diagnosa,
       a.registered,
       b.nama2 as nama_dr,
       c.induk_nama as nama_poli,
       max(d.Id) as done
            FROM rme.soap_inap a      
            LEFT JOIN 
                rsiklaten.dokter b ON a.dpjp1 = b.no_dr
            LEFT JOIN
                rme.bangsal c ON a.bangsal_id  = c.induk
            LEFT JOIN
                inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
            WHERE 
            date(a.tgl_keluar) >= '$atanggal' AND date(a.tgl_keluar) <='$btanggal'
            #AND
                #a.asuransi_id NOT IN ('300','301','302','303')
            AND a.resume='1' 
            AND a.deleted is null
            GROUP BY a.no_reg,a.tgl_masuk
            "; 
            // if (ipclient()==IPC) pre($query);
        }else {
            $query = "
            SELECT a.id,a.no_reg,a.nama,a.tgl_keluar,a.tgl_masuk,a.jam_masuk,a.bangsal_id as kd_poli,a.dpjp1 ,a.asuransi_id,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
       a.diagkerja as diagnosa ,
       a.registered,
       b.nama2 as nama_dr,
       c.induk_nama as nama_poli,
       d.Id as done
            FROM rme.soap_inap a      
            LEFT JOIN 
                rsiklaten.dokter b ON a.dpjp1 = b.no_dr
            JOIN
                rme.bangsal c ON a.bangsal_id  = c.induk
            LEFT JOIN
                inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
            WHERE 
                date(a.tgl_keluar) >= '$atanggal' AND date(a.tgl_keluar) <='$btanggal'
            #AND
             #a.asuransi_id NOT IN ('300','301','302','303')
                AND
                 a.resume='1' 
                AND
                 a.deleted is null
                AND
                a.bangsal_id = '$rawat'
            #AND 
	            #a.kd_poli NOT IN ('F002','F003')
            #GROUP BY a.id
            GROUP BY a.no_reg,a.tgl_masuk
            "; 
        }
        // ipclient()==IPC?die($query):'';
        $soap = DB::select($query);
        // pre($soap);
        $str_tgl_dirawat = "";
        $total_tjp = 0;
        if (!empty($soap)) {
            $no = 1; 
            
            foreach ($soap as $row) {
                $row = (object) $row; 
                $row->id        = $row->id;
                $row->no        = $no;
                $row->tanggal   = date('d-m-Y H:i:s', strtotime($row->tgl_keluar));
                // $row->tanggal   = $row->tgl_keluar;
                $row->nama      = strtoupper($row->nama);
                $row->no_reg    = $row->no_reg;
                $row->umur    = $row->umur;
                $row->tgl_masuk = $row->tgl_masuk;
                $row->jam_masuk = $row->jam_masuk;
                $row->nama_dr   = $row->nama_dr;
                $row->nama_poli = $row->nama_poli;
                $row->asuransi_id    = $row->asuransi_id;

                switch ($row->asuransi_id){
                  case '300':
                  case '301':
                  case '302':
                  case '303':
                  case '304':
                  $rel = "BPJS";
                  break;
                  case '001';
                  $rel ="UMUM";
                  break;
                  default: 
                  $rel='ASKOM';
                }
                $row->asuransi_id=$rel;
                // if ($row->jenis == '1'){
                //     $jenis ='Baru';
                // }else {
                //     $jenis ='Lama';  
                // }
                // $row->jenis = $jenis;
                $row->diagnosa  = $row->diagnosa;
                if (!empty($row->done)) {
                    $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
                }else {
                    $tombol = "<a class='btn btn-sm btn-danger text-light fa fa-close' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
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