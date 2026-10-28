<?php 

        $this->load->model('Kunjung');
        $poli = $this->input->get('poli'); 
        $kategori = $this->input->get('kategori'); 
        $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
        $btanggal = $atanggal;
        $query = "
        select id, no_reg, date(tgl_masuk) as tgl_masuk, jam_masuk, date(tgl_keluar) as tgl_keluar, resume, dpjp1, bangsal_id as bangsal from rme.soap_inap use index(no_reg_3) where resume = 1 and deleted is null and date(tgl_keluar) = '$atanggal' group by no_reg, tgl_masuk
        "; 
        $rows_resume = DB::connection('slave')->select($query);
        // json($rows_resume);
        $total_askep = 0; 
        $total_soap = 0; 
        $total_lengkap = 0; 
        $total_tjp = 0; 
        $total_waiting_koder = 0; 
        $total_waiting_rme = 0; 
        $rows = [];
        $arr_no_reg = [];
        if (!empty($rows_resume)) {
            foreach ($rows_resume as $row) {
                $arr_no_reg[] = $row['no_reg'];
            }
        }
        $arr_dpjp = array_column(DB::connection('rsik')->select("select no_dr, nama2 from rsiklaten.dokter"), 'nama2', 'no_dr');
        $imp_no_reg = implode("', '", $arr_no_reg);
        $query = "select no_reg, nama, date(tgl_lahir) as tgl_lahir, jenis_kel from rsiklaten.pasien where no_reg in ('$imp_no_reg')"; 
        $rows_pasien = DB::connection('slave')->select($query);
        $arr_nama = $arr_tgl_lahir = $arr_umur = $arr_jenis_kel = [];
        if (!empty($rows_pasien)) {
            foreach ($rows_pasien as $key => $pasien) {
                $pasien = (object) $pasien;
                $arr_nama[$pasien->no_reg] = $pasien->nama;
                $arr_tgl_lahir[$pasien->no_reg] = $pasien->tgl_lahir;
                $arr_jenis_kel[$pasien->no_reg] = $pasien->jenis_kel;
            }
        }
        
        // if (ipclient()==IPC) json($arr_dpjp['S558']);
        $query = "select no_reg, tanggal_masuk, deleted, date(registered) as tgl_pengkajian, writer, writed from rme.edukasi_hambatan where no_reg in ('$imp_no_reg') and deleted is null and date(tanggal_masuk) between date_add('$atanggal', interval -2 month) and '$atanggal'"; 
        // $rows_hambatan = DB::connection('slave')->select($query);
        $arr_hambatan = array_column(DB::connection('slave')->select($query), 'tgl_pengkajian', 'no_reg');
        $arr_parent = array_column(DB::connection('slave')->select("select grup, group_concat(kolom) as kolom from rme.edukasi_hambatan_map_field where deleted is null and jenis = 'child' and grup is not null group by grup"), 'kolom', 'grup');
        $arr_grup = array_column(DB::connection('slave')->select("select kolom, ket from rme.edukasi_hambatan_map_field where jenis = 'parent'"), 'ket', 'kolom');
        // json($arr_parent);
        $query = "select no_reg, tanggal_masuk, registered, deleted, date(registered) as tanggal,
            edu_partisipasi, edu_sarpras, edu_hak, edu_dpjp, edu_perawat, edu_tatib, edu_kunjung, edu_keluhan, edu_gelang, edu_batuk, edu_sampah, edu_halal, edu_jatuh, edu_asuransi, edu_aurat, edu_penunggu, edu_opb_lain, edu_opb_lain_text, edu_penunjang, edu_kondisi, edu_asuhan, edu_pengobatan, edu_tidak_harap, edu_harapan, edu_antisipasi, edu_informed, edu_efek_samping, edu_pemberian_obat, edu_interaksi, edu_farm_lain_text, edu_ppa_lain_text, edu_infus, edu_kateter, edu_ngt, edu_alat_lain_text, edu_gizi, edu_diet_rawat, edu_diet_rumah, edu_diet_lain_text, edu_farmakologi, edu_non_farmakologi, edu_ft, edu_ot, edu_tw, edu_rehab_lain_text, edu_cuci, edu_rokok, edu_rujukan, edu_plg_diit, edu_plg_obat, edu_plg_luka, edu_plg_kontrol, edu_plg_thaharah, edu_lain_text 
        from rme.edukasi_hambatan_list where no_reg in ('$imp_no_reg') and deleted is null and date(tanggal_masuk) between date_add('$atanggal', interval -2 month) and '$atanggal'"; 
        $rows_edukasi = DB::connection('slave')->select($query);
        function get_edukasi($no_reg, $tgl_masuk, $tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, $param){
            $result = '';
            $arr_kolom = explode(',', $arr_parent[$param]??[]);
            if (!empty($rows_edukasi)) {
                foreach ($rows_edukasi as $row_edukasi) {
                    if ($row_edukasi['no_reg'] == $no_reg && $row_edukasi['registered'] >= $tgl_masuk.' 00:00:00' && $row_edukasi['registered'] <= $tgl_keluar.' 23:59:59') {
                        if (!empty($arr_kolom)) {
                            foreach ($arr_kolom as $key => $kolom) {
                                $key = $row_edukasi['no_reg']."/".str_replace(["-", " ", ":"], "", $row_edukasi['tanggal_masuk']);
                                if (!empty($row_edukasi[$kolom])) $result = '<i class="fa fa-check-square-o btn-prev-edukasi" onClick="pdf_edukasi(\''.$key.'\')" aria-hidden="true" title="'.($arr_grup[$param]??'').'"></i>';
                            }
                        }
                    }
                }
            }
            return $result;
        }
        // json($rows_edukasi);
        if (!empty($rows_resume)) {
            $no = 1; 
            foreach ($rows_resume as $row) {
                $row = (object) $row;
                $row->no = $no;
                $row->str_tgl_keluar = date("d-m-Y", strtotime($row->tgl_keluar)); 
                $row->str_tgl_masuk = date("d-m-Y", strtotime($row->tgl_masuk)); 
                $row->str_tgl_lahir = date("d-m-Y", strtotime($arr_tgl_lahir[$row->no_reg]??'')); 
                $row->umur = selisihymdhis($row->tgl_masuk, $arr_tgl_lahir[$row->no_reg]??$row->tgl_masuk, "umur");
                $row->nama = "<b>".$row->no_reg." ".($arr_jenis_kel[$row->no_reg]??'')."</b><br />".($arr_nama[$row->no_reg]??'')."<br />".(!empty($arr_tgl_lahir[$row->no_reg])?$row->str_tgl_lahir:'')." &nbsp; &nbsp; &nbsp;  (".$row->umur.")";
                $row->dokter = "<b>".$row->str_tgl_masuk."</b>&nbsp; &nbsp; <badge class=\"badge badge-success\" style=\"padding-top:1px; font-size:11px;\" onClick=\"pdf_cppt('".$row->no_reg."/".str_replace(["-", " ", ":"], "", $row->tgl_masuk.$row->jam_masuk)."')\">cppt</badge><br />".$row->bangsal."<br />".(!empty($row->dpjp1)?$arr_dpjp[$row->dpjp1]??'':'');
                // $row->dokter = "<b>".$row->str_tgl_masuk."</b>&nbsp; &nbsp; <badge class=\"badge badge-success\" style=\"padding-top:1px; font-size:11px;\" onClick=\"pdf_cppt('".$row->no_reg."/".str_replace(["-", " ", ":"], "", $row->tgl_masuk.$row->jam_masuk)."')\">cppt</badge><br />".$row->bangsal."<br />".$row->dpjp1??'';
                $row->hambatan = $arr_hambatan[$row->no_reg]??''>=$row->tgl_masuk?'<i class="fa fa-check-square-o" aria-hidden="true"></i>':($row->umur=='0HR'?'<i class="fa fa-child" aria-hidden="true"></i>':null);
                $row->opb = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_orientasi');
                $row->dpjp = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_dpjp');
                $row->nyeri = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_nyeri');
                $row->alat = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_alat');
                $row->gizi = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_gizi');
                $row->farmasi = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_farmasi');
                $row->rehab = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_rehab');
                $row->pulang = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_pulang');
                $row->rujukan = get_edukasi($row->no_reg, $row->tgl_masuk, $row->tgl_keluar, $rows_edukasi, $arr_parent, $arr_grup, 'par_rujukan');
                $rows[] = $row;
                $arr_no_reg[] = $row->no_reg;
                $no ++;
            }
        }
        // json ($rows_pasien);
        $total = count($rows);
        $temp_rows = $rows; 
        $grand_total = 0;
        if ($total_soap = 0) {
            $total_tjp = 0; 
        }
        $total_waiting_rme = $total - $total_tjp - $total_waiting_koder - $total_lengkap;
        $data = array(
            "rows" => $rows, 
            "total" => $total, 
            "totalNotFiltered" => 0,
            "footer" => array(
                "id" => "grand_total", 
                "grand_total" => "grand_total", 
                "_id_colspan" => 2
            
            ), 
            "grand_total" => $total." KUNJUNGAN PASIEN",
            "total_admisi" => $total,
            "total_askep" => $total_askep,
            "total_lengkap" => $total_lengkap,
            "total_tjp" => $total_tjp,
            "total_waiting_koder" => $total_waiting_koder,
            "total_waiting_rme" => $total_waiting_rme,
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));