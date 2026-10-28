<?php 
// die();
$this->load->model('soap');
// $this->load->model('soap_gd');
// $this->load->model('soap_inap');
// $this->load->model('soap_poli_inap');
$this->load->model('pasien');
$this->load->model('asuransi');
$this->load->model('dokter');
$this->load->model('inap');
        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $rawat  = $this->input->get('rawat');
        $filter = $this->input->get('filter');
        $atanggal = $this->input->get('atanggal');
        $btanggal = $this->input->get('btanggal');

        $atanggal = $atanggal!='' ? date("Y-m-d", strtotime($atanggal)) : date("Y-m-d"); 
        $btanggal = $btanggal!='' ? date("Y-m-d", strtotime($btanggal)) : date("Y-m-d"); 

        $rows = (array) null; 
        $total = (int) 0; 
        $condition = ''; 
        switch ($rawat) {
            // case 'jalan' : 
            //     $condition .= "AND jnsPelayanan IN ('Rawat Jalan', 'R.Jalan') "; 
            //     break; 
            case 'inap' : 
                $condition .= "AND jnsPelayanan IN ('Rawat Inap', 'R.Inap') "; 
                break; 
            default : 
                // $condition .= "AND jnsPelayanan NOT IN ('Rawat Inap', 'R.Inap') "; 
                break; 
        }
        


        $query = "
        SELECT 
            a.tinlan AS tindak_lanjut, a.diagkerja AS diagnosa, a.anamnese, a.no_reg, a.tgl_masuk, a.jam_masuk,a.id AS soap_id,a.dokter_id AS kd_dr,
            rsiklaten.pasien.jenis_kel,
            rsiklaten.pasien.alamat, 
            rsiklaten.pasien.nama, 
            rsiklaten.pasien.tgl_lahir, 
            rsiklaten.pasien.telp, 
            left(rsiklaten.dokter.nama2,30) as nama2,
            rsiklaten.asuransi.nama AS nama_rel, 
            rsiklaten.mutasi_ri.tgl_ri, 
            rsiklaten.mutasi_ri.asal, 
            rsiklaten.mutasi_ri.bangsal,
            rsiklaten.pasien.telp,
            c.id AS done,
            c.kelas,
            c.catatan, 
            d.ke_ruang
        FROM 
            rme.soap_gd AS a
        LEFT JOIN 
            rsiklaten.mutasi_ri ON rsiklaten.mutasi_ri.no_reg = a.no_reg AND rsiklaten.mutasi_ri.tgl_ri >= a.tgl_masuk
        LEFT JOIN 
            rsiklaten.pasien ON rsiklaten.pasien.no_reg = a.no_reg
        LEFT JOIN 
            rsiklaten.dokter ON rsiklaten.dokter.no_dr = a.dokter_id
        LEFT JOIN 
            rsiklaten.asuransi ON rsiklaten.asuransi.no_rel = a.asuransi_id
        LEFT JOIN
            pendaftaran.monitoring_adm_gd c ON a.no_reg = c.no_reg AND a.tgl_masuk = c.tanggal
        LEFT JOIN 
            rsik.transfer_internal d ON rsiklaten.mutasi_ri.no_reg = d.no_reg AND rsiklaten.mutasi_ri.tgl_masuk = d.tgl_masuk AND rsiklaten.mutasi_ri.jam_masuk = d.jam_masuk AND rsiklaten.mutasi_ri.bangsal != d.ke_ruang
        WHERE 
            a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal' ";
        if ($filter!="") $query .= "AND a.nama like '%$filter%' ";
        $query .= "
            AND a.tinlan IN (5, 7, 8) 
            AND a.deleted IS NULL 
            AND rsiklaten.mutasi_ri.deleted IS NULL
        ORDER BY 
            a.tgl_masuk DESC, 
            a.jam_masuk ASC";
        // var_dump($query); die();
        $datas = DB::select($query);
        $inap = Inap::get(['no_reg', 'kd_bangsal', 'tgl_masuk', 'tgl_ri'])->toArray();
        // $inap = Inap::where('no_reg', '0317506')->get(['no_reg', 'kd_bangsal', 'tgl_masuk', 'tgl_ri'])->toArray();
        // json($inap);
        $total_tjp = 0;
        if (!empty($datas)) {
            $no = 1; 
            
            foreach ($datas as $row) {
                $row = (object) $row; 
                $row->no       = $no;
                $row->nama     = strtoupper($row->nama);
                $row->nama2    = strtoupper($row->nama2);
                $row->no_telp  = $row->telp;
                $row->tanggal  = date("d-m-Y", strtotime($row->tgl_masuk));
                if ($row->jam_masuk!="") $row->tanggal = $row->tanggal."<br />".$row->jam_masuk;

                if(!empty($row->kelas)){
                $row->nama_rel = $row->nama_rel.'<br>( Kelas &nbsp'.$row->kelas.' )';
                } else{
                    $row->nama_rel = $row->nama_rel;
                }
                $row->no_reg   = $row->no_reg;
                $row->kd_poli  = $row->asal;
                // if ($row->no_reg=='0584542') json($inap[array_search($row->no_reg,array_column($inap, 'no_reg'))]['kd_bangsal']);
                if ($row->no_reg=='0584542') {
                // if ($row->no_reg=='0545564') {
                    // var_dump(array_search($row->no_reg,array_column($inap, 'no_reg')));
                    // if (array_search($row->no_reg,array_column($inap, 'no_reg'))!==false){
                    //     echo "1"; die();
                    // } else {
                    //     echo "2"; die();
                    // }
                    // json(array_search($row->no_reg,array_column($inap, 'no_reg')));
                }
                // $row->bangsal  = $row->asal=='PNEK'?'PONEK':(!empty($inap)?$inap[array_search($row->no_reg,array_column($inap, 'no_reg'))]['kd_bangsal']:$row->bangsal);
                $row->bangsal  = !empty($inap)&&array_search($row->no_reg,array_column($inap, 'no_reg'))!==false&&!empty($inap[array_search($row->no_reg,array_column($inap, 'no_reg'))]['kd_bangsal'])&&(substr($inap[array_search($row->no_reg,array_column($inap, 'no_reg'))]['kd_bangsal'], 0, 3)!='IMC'&&in_array($row->asal, ['PNEK', 'UGD']))?$inap[array_search($row->no_reg,array_column($inap, 'no_reg'))]['kd_bangsal']:($row->asal=='PNEK'?'PONEK':$row->bangsal);
                $row->rawat    = $row->tindak_lanjut;
                $row->catatan  = $row->catatan;
                $row->telp  = $row->telp;
                $row->diagnosa = str_replace(['@@,'], [', '], $row->diagnosa);

                
                $tombol    = "<a class='btn btn-sm btn-info text-light fa fa-file-text-o' id='add_catatan' data-done='$row->done' data-soap_id='$row->soap_id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tanggal='$row->tgl_masuk' data-kd_dr='$row->kd_dr'> Catatan</a>";
                $row->aksi = $tombol;
                
                $row->nama2 = $row->nama2."<br /><br /><b><u>Diagnosa</u>:</b><br />".$row->diagnosa;
                
                if ($row->bangsal=='' ) {
                    $row->rme ='V';
                } else {
                    $row->bill ='V';
                    // $row->catatan = '-';
                }
                // if (in_array($row->bangsal, ['PONEK', 'IMCG'])) {
                if (in_array($row->bangsal, ['PONEK', 'IMCG']) && (!empty($row->ke_ruang) && in_array($row->ke_ruang, ['PONEK', 'IMCG']))) {
                    $row->rme = 'V'; 
                    $row->bill = '-';
                    $total_tjp ++;
                } else {
                    if ($row->bangsal=='' ) $total_tjp ++;
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
        // pre($datas);
        $data = array(
            "rows"        => $rows,
            "total"       => $total,
            "grand_total" => $total,
            "total_tjp"   => $total_tjp,
            "total_sep"   => $total,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));