<?php 
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$atanggal = $btanggal = null;
if (!empty(segment(4))&&!empty(segment(5))) {
    $atanggal = date('Y-m-d', strtotime(segment(4)));
    $btanggal = date('Y-m-d', strtotime(segment(5)));
}

        $this->load->model('User');

        // $atanggal = date('Y-m-d', strtotime(segment(4)));
        // $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
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
                a.*
            FROM 
                bpjs.token_log a
            WHERE
				a.registered BETWEEN '$atanggal 00:00:00' AND '$btanggal 23:59:59'
                AND a.request like '%antrian_simpan%'
            ORDER BY
                a.registered ASC
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
                $xrow = (object) null;
                if (str_contains($row->result, 'melebihi kapasitas')) { 
                    $req = json_decode($row->request);
                    // json($req);
                    $res = json_decode($row->result);
                    $xrow->no_reg = !empty($req->data->no_rm)?$req->data->no_rm:''; 
                    $xrow->no_peserta = !empty($req->data->no_peserta)?$req->data->no_peserta:''; 
                    $xrow->nik = !empty($req->data->nik)?$req->data->nik:''; 
                    $xrow->tgl_masuk = !empty($req->data->tgl_masuk)?$req->data->tgl_masuk:''; 
                    $xrow->kd_poli_bpjs = !empty($req->data->kd_poli_bpjs)?$req->data->kd_poli_bpjs:''; 
                    $xrow->kd_dr_bpjs = !empty($req->data->kd_dokter_bpjs)?$req->data->kd_dokter_bpjs:''; 
                    $xrow->nm_dr_bpjs = ''; 
                    if ($xrow->kd_dr_bpjs != '') {
                        $row_dokter = DB::table('bpjs.dpjp as a')->where('a.kode', $xrow->kd_dr_bpjs)->where('a.deletedstate', '0')->orderBy('id', 'desc')->first(['nama', 'kd_dr']);
                        json($row_dokter);
                        if (!empty($row_dokter['nama'])) $xrow->nm_dr_bpjs = $row_dokter['nama'];
                    }
                    $xrow->message = !empty($res->metadata->message)?$res->metadata->message:''; 
                    $rows[] = $xrow;
                }
            }
        }
        json($rows); 

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
        