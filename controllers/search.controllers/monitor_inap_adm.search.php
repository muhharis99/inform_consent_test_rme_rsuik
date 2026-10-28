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
        $atanggal = $this->input->get('atanggal');
        $btanggal = $this->input->get('btanggal');
        $filter = $this->input->get('filter');

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
        

        // $query = DB::table('rme.soap as a')
        // ->leftJoin('rsiklaten.mutasi_ri',function($xx){
        //     $xx->on('rsiklaten.mutasi_ri.no_reg','=','a.no_reg')
        //     ->on('rsiklaten.mutasi_ri.tgl_ri','>=','a.tgl_masuk');
        // })
        // ->leftJoin('rsiklaten.pasien', 'rsiklaten.pasien.no_reg', '=', 'a.no_reg')
        // ->leftjoin('rsiklaten.dokter','rsiklaten.dokter.no_dr','=','a.kd_dr')
        // ->leftjoin('rsiklaten.asuransi','rsiklaten.asuransi.no_rel','=','a.kd_asuransi')
        // ->whereBetween('a.tgl_masuk', array($atanggal, $btanggal))
        // ->where('a.tindak_lanjut',2)
        // ->whereNull('a.deleted')
        // ->whereNUll('rsiklaten.mutasi_ri.deleted')
        // ->select('a.tindak_lanjut', 'a.diagnosa', 'a.anamnese', 'rsiklaten.pasien.jenis_kel', 'rsiklaten.pasien.alamat', 'rsiklaten.pasien.nama', 'rsiklaten.pasien.tgl_lahir', 'rsiklaten.pasien.telp', 'a.no_reg', 'a.tgl_masuk', 'a.jam_masuk','rsiklaten.dokter.nama2','rsiklaten.asuransi.nama as nama_rel','rsiklaten.mutasi_ri.tgl_ri','rsiklaten.mutasi_ri.asal','rsiklaten.mutasi_ri.bangsal')
        // ->orderBy('a.tgl_masuk', 'desc')
        // ->orderBy('a.jam_masuk', 'asc');
        // $rows_sep = $query->get();

        $query = "
        SELECT 
            a.tindak_lanjut,a.diagnosa,a.anamnese,a.no_reg,a.tgl_masuk,a.jam_masuk,a.id AS soap_id,a.kd_dr,
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
            c.rencana_inap
        FROM 
            rme.soap AS a
        LEFT JOIN 
            rsiklaten.mutasi_ri ON rsiklaten.mutasi_ri.no_reg = a.no_reg AND rsiklaten.mutasi_ri.tgl_ri >= a.tgl_masuk AND rsiklaten.mutasi_ri.kd_dr_ri1 = a.kd_dr AND rsiklaten.mutasi_ri.deleted IS NULL
        LEFT JOIN 
            rsiklaten.pasien ON rsiklaten.pasien.no_reg = a.no_reg
        LEFT JOIN 
            rsiklaten.dokter ON rsiklaten.dokter.no_dr = a.kd_dr
        LEFT JOIN 
            rsiklaten.asuransi ON rsiklaten.asuransi.no_rel = a.kd_asuransi
        LEFT JOIN
            pendaftaran.monitoring_adm c ON a.no_reg = c.no_reg AND a.tgl_masuk = c.tanggal
        WHERE 
            a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal' ";
        if ($filter!="") $query .= "AND a.nama like '%$filter%' ";
        $query .= "
            AND a.tindak_lanjut = '2' 
            AND a.deleted IS NULL 
            AND rsiklaten.mutasi_ri.deleted IS NULL
        ORDER BY 
            a.tgl_masuk DESC, 
            a.jam_masuk ASC";
        $datas = DB::select($query);
        $inap = Inap::get(['no_reg', 'kd_bangsal', 'tgl_masuk', 'tgl_ri'])->toArray();
        if (ipclient()==IPC){
            $no_reg = '0675174';
            $bgs = array_search($no_reg,array_column($inap, 'no_reg'))!==false?$inap[array_search($no_reg,array_column($inap, 'no_reg'))]['kd_bangsal']:'';
            // $urut = array_search($no_reg,array_column($inap, 'no_reg'));
            // $inap = json_decode(json_encode($inap));
            // json($bgs);
        } 
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

                if(!empty($row->kelas)){
                    $row->nama_rel = $row->nama_rel.'<br>( Kelas &nbsp'.$row->kelas.' )';
                }
                else{
                    $row->nama_rel = $row->nama_rel;
                }
                $row->no_reg   = $row->no_reg;
                $row->kd_poli  = $row->asal;
                $row->bangsal2=$row->bangsal;

                // if ($row->no_reg=='X0675174') {
                    $row->bangsal  = !empty($inap)&&array_search($no_reg,array_column($inap, 'no_reg'))!==false?$inap[array_search($no_reg,array_column($inap, 'no_reg'))]['kd_bangsal']:$row->bangsal;
                // } else {
                //     $row->bangsal = $row->bangsal;
                // }
                $row->diagnosa  = tagString($row->diagnosa);
                $row->rawat    = $row->tindak_lanjut;
                $row->catatan  = $row->catatan;
                $row->rencana_inap  = !empty($row->rencana_inap)?date("d-m-Y", strtotime($row->rencana_inap)):'';
                $row->telp  = $row->telp;
                $row->nama2 = $row->nama2."<br /><br /><b><u>Diagnosa</u>:</b><br />".$row->diagnosa;
                
                $tombol    = "<a class='btn btn-sm btn-info text-light fa fa-file-text-o' id='add_catatan' data-done='$row->done' data-soap_id='$row->soap_id' data-rencana='$row->rencana_inap'' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tanggal='$row->tgl_masuk' data-kd_dr='$row->kd_dr'> Catatan</a>";
                $row->aksi = $tombol;
                // pre($row->bangsal);
                if ($row->bangsal2=='' ) $total_tjp ++;
                if ($row->bangsal2=='' ) {
                    $row->rme ='V';
                }
                else {
                    $row->bill ='V';
                    $row->catatan = '-';
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
            "rows"        => $rows,
            "total"       => $total,
            "grand_total" => $total,
            "total_tjp"   => $total_tjp,
            "total_sep"   => $total,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));