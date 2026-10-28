<?php 
        // $this->load->model('Kunjung');
        $poli = $this->input->get('poli'); 
            // $kategori = $this->input->get('kategori'); 
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;
// if (ipclient()=='172.16.18.17') json($atanggal);
// if ($induk == 'RMD'){

    $query = "select ahm.id_askep_hd ,ah.no_reg,ah.nama,ah.tgl_masuk,d.nama2,min(case when ahm.id_askep_hd =ahm.id_askep_hd and ahm.deleted is null then time(ahm.waktu) End ) as jam_awal, max(case when ahm.id_askep_hd =ahm.id_askep_hd and ahm.deleted is null  then time(ahm.waktu) End ) as jam_akhir, TIMEDIFF(max(case when ahm.id_askep_hd =ahm.id_askep_hd and ahm.deleted is null  then time(ahm.waktu) End ),min(case when ahm.id_askep_hd =ahm.id_askep_hd  and ahm.deleted is null then time(ahm.waktu) End )) as lama from rme.askep_hd_monitoring ahm 
    left join rme.askep_hd ah on ahm.id_askep_hd = ah.id 
    left join rsiklaten.dokter d on d.no_dr= ah.dokter_id
    where ah.tgl_masuk ='$atanggal' and ah.deleted is null  group by id_askep_hd order by lama asc "; 


        //  pre($query);
        // $riwayat = DB::connection('slave')->select($query);
        $riwayat = DB::select($query);
        $rows = (array) null; 
        if (!empty($riwayat)) {
            $no = 1; 
            foreach ($riwayat as $row) {
                $row = (object) $row;
                $row->no = $no; 
                $row->no_reg = $row->no_reg  ;
                $row->nama = $row->nama ;
                $row->tgl_masuk = $row->tgl_masuk;
                $no++; 
                $rows[] = $row;   
            }
        }

         $total = count($rows);
        $grand_total = 0;
        if ($total_soap = 0) {
            $total_tjp = 0; 
        }
        


 
        // $total_waiting_rme = $total - $total_tjp - $total_waiting_koder - $total_lengkap;
        $data = array(
            "rows" => $rows, 
            "total" => $total,
            // "nik" => $nik
            // "grand_total" => $total." KUNJUNGAN PASIEN",
            // "total_admisi" => $total,
            // "total_askep" => $total_askep,
            // "total_lengkap" => $total_lengkap,
            // "total_tjp" => $total_tjp,
            // "total_waiting_koder" => $total_waiting_koder,
            // "total_waiting_rme" => $total_waiting_rme,
        );
        //  pre($data);
     
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));