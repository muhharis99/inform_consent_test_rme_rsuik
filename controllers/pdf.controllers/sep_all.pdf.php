<?php 
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
if (!empty(segment(4))&&!empty(segment(5))) {
    $no_reg = segment(4); 
    $kategori = segment(5); 
    if (strlen((string) segment(4))==7&&strlen((string) segment(5))==14) {
        $format_baru = true;
        switch ((string) segment(6)) {
            case 'PRINT' : 
            case 'print' : 
                $pdf_type = "F";
                $lp_print = true;
                break; 
            case 'FILE' : 
                $pdf_type = "F";
                $lp_print = false;
                break; 
            case 'FILECLIENT' : 
                $pdf_type = "F";
                $lp_print = false;
                $ipclient = segment(7);
                break; 
        }
    }
}

        $this->load->model('User');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        /*
		$kategori = segment(6);
        // $unit = segment(7);
        $unit = "all";
        $rawat = segment(7);
        $urut = segment(8);
		*/
		$kategori = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 
        $where_kategori = "";
        
        $query = "
            SELECT
				a.*, b.nama as nama_pasien, d.nama as petugas  
			FROM 
				rsik.respon_time_admisi a
                LEFT JOIN rsiklaten.pasien b 
                    ON a.no_reg = b.no_reg  
                LEFT JOIN rsiklaten.user c 
                    ON a.writer = c.id 
                LEFT JOIN sdm.karya d
                    ON c.user = d.nik
            WHERE
				a.tgl_masuk BETWEEN '$atanggal' AND '$btanggal'
                AND a.deleted IS NULL
            ORDER BY
                a.tgl_masuk ASC, 
                a.jam_masuk ASC
        ";
        $data = DB::select($query);
        $text_waktu     = "";
        $text_pasien     = "";
        $text_rata    = "";
        $bgcolor       = "";
        $text_keterangan   = "";
        $bg_color   = "";
        $int_waktu  = 0;
        $int_pasien = 0;
        $int_rata   = 0;
        $rows = (array) null; 
        $rows_sensus = (array) null; 
        if (!empty($data)) {
            $i_tanggal = ""; 
            $i_waktu  = 0;
            $i_pasien = 0;
            $i_rata = 0;
            $i_array = 0; 
            foreach ($data as $row) {
                $row = (object) $row;
                $text_wpss     = "";
                $text_pacs     = "";
                $text_label    = "";
                $bgcolor       = "";
                $text_respon   = "";
                $text_tinlan   = ""; 
                $row->color = $bg_color; 
                // $row->str_tgl_kunjung = tampiltanggal($row->tgl_masuk.' '.$row->jam_masuk, 9)." ".tampiltanggal($row->tgl_masuk.' '.$row->jam_masuk, 7);
                // $row->str_tgl_triase = tampiltanggal($row->waktu_triase, 9)." ".tampiltanggal($row->waktu_triase, 7);
                $row->str_tgl_kunjung = tampiltanggal($row->tgl_masuk, 9);
                $row->str_tgl_mulai = tampiltanggal($row->mulai_admisi, 9)." ".tampiltanggal($row->mulai_admisi, 7);
                $row->str_tgl_selesai = tampiltanggal($row->mulai_admisi, 9)." ".tampiltanggal($row->mulai_admisi, 7);
                $row->str_respon_time  = (string) selisihymdhis($row->mulai_admisi, $row->selesai_admisi, "jumlahmenit")." MENIT";
                $rows[] = $row;
                $row_sensus = (object) null; 
                if ($i_tanggal != $row->tgl_masuk) {
                    $i_tanggal = $row->tgl_masuk; 
                    $row_sensus->tanggal = tampiltanggal($row->tgl_masuk, 9);
                    $i_pasien  = 1;
                    $i_waktu  = (int) selisihymdhis($row->mulai_admisi, $row->selesai_admisi, "jumlahmenit");
                    $i_array ++; 
                } else {
                    $i_pasien  = $i_pasien + 1;
                    $i_waktu  = (int) $i_waktu + (int) selisihymdhis($row->mulai_admisi, $row->selesai_admisi, "jumlahmenit");
                }
                $i_rata = floor($i_waktu/$i_pasien); 
                $row_sensus->tanggal = $i_tanggal;
                $row_sensus->waktu   = $i_waktu;
                $row_sensus->pasien  = $i_pasien;
                $row_sensus->rata  = $i_rata;
                $row_sensus->keterangan   = "";
                
                $rows_sensus[$i_array - 1] = $row_sensus; 
            }
        }
        // pre($rows_sensus);

        $data = array(
            'nik'         => $nik,
            'domain'      => "ADMISI",
            'content'     => $rows,
            'rows_sensus' => $rows_sensus,
            'tanggal'     => segment(4),
            'tanggal1'    => date('d/m/Y', strtotime(segment(4))),
            'tanggal2'    => date('d/m/Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan,
            'ttd_nama'    => $ttd_nama,
            'pdf_type'    => "I",
            'lp_print'    => false,
            'printer'     => "",
            'kategori'    => $kategori,
            'ipclient'    => ""
        );
        // pre($data);
        go('pdf/waktu_tunggu_admisi', $data);
        