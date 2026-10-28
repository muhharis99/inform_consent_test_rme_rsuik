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
if ($induk == 'RMD'){

    if ($poli == 'SM'){ 
    $query = "
    select pas.nama,pas.umur,kda.no_reg, kda.tgl_masuk,'HEMODIALISIS' as bangsal,'RAWAT JALAN' as kunj,kda.kep_hd,kda.ash_hd, if(mda.no_reg is not null,'V',' ') as med_aw, if(mda.no_reg is not null,'V',' ') as res_aw from 
    (select DISTINCT ah.no_reg,ah.tgl_masuk, ah.poli_id, ah.id, if(ah.no_reg is not null,'V',' ') as kep_hd , if( ahr.id is not null,'V',' ') as ash_hd  from rme.askep_hd ah 
    left join rme.askep_hd_ref ahr on ahr.id_askep_hd  = ah.id where ah.tgl_masuk ='$atanggal' and ah.deleted  is null ) kda
    left join 
    (select distinct sh.no_reg , sh.tgl_masuk , sh.poli_id from rme.soap_hd sh where sh.tgl_masuk = '$atanggal' and sh.deleted is null
    ) mda 
    on mda.no_reg = kda.no_reg and mda.tgl_masuk = kda.tgl_masuk
    left join 
    (select * from rsiklaten.pasien p) pas 
    on pas.no_reg = kda.no_reg
    "; 
}

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