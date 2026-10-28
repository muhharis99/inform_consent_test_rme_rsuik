<?php 

        $atanggal  = $this->input->get('atanggal');
        $btanggal  = $this->input->get('btanggal');
        $offset  = $this->input->get('offset');
        $limit  = $this->input->get('limit');
        $start = date('Y-m-d', strtotime($atanggal));
        $end = date('Y-m-d', strtotime($btanggal));
        $xdata = [];
        $total = $grand_total = $jumlah_gagal = $jumlah_sukses =  0; 
        $rows = DB::table('rsiklaten.apm_log')->whereRaw("mesin is not NULL AND DATE(registered) between '$start' and '$end'")->orderBy('id', 'desc')->get();
        if (!empty($rows)) {
            $no = 1; 
            $arr_sukses = [];
            foreach ($rows as $row) {
                $row = (object) $row;
                // if (in_array($row->validasi, ['Cetak SEP'])) $arr_sukses[] = $row->nosurat;
            }
            foreach ($rows as $row) {
                $row = (object) $row;
                if (strlen($row->nosurat) > 4) {
                    $row->no = $no; 
                    $row->nama = ""; 
                    if (strlen($row->nosurat)<=7) {
                        $pasien = DB::table('rsiklaten.pasien')->where('no_reg', substr('0000000'.$row->nosurat, -7))->first();
                        if (!empty($pasien['nama'])) $row->nama = $pasien['nama'];
                    }
                    $row->no_reg = $row->nosurat;
                    if (in_array($row->validasi, ['Cetak SEP'])) $jumlah_sukses ++;
                    if (!in_array($row->validasi, ['Cetak SEP'])) $jumlah_gagal ++;
                    $row->validasi = str_replace(['Cek', 'Generate'], ['Gagal', 'Gagal membuat'], $row->validasi);
                    $row->waktu = date("d/m/Y H:i:s", strtotime($row->registered));
                    $row->ket = ""; 
                    if (substr($row->info, 0, 8)=='1123R001') { $row->ket = $row->info; } else {
                        $bpjs = json_decode(str_replace('\"', '"', substr(strstr($row->info, '}{'), 1)));
                        if (!empty($bpjs->message)) $row->ket = $bpjs->message;
                    }
                    $xdata[] = $row;
                    $total ++;
                    $grand_total ++;
                    $no ++;
                }
            }
        }
        $data = array(
            "rows" => $xdata,
            "total" => $total,
            "totalNotFiltered" => 0,
            "footer" => array(
                "id" => "grand_total",
                "grand_total" => "grand_total",
                "_id_colspan" => 2

            ),
            "grand_total" => $grand_total,
            "jumlah_total" => $grand_total,
            "jumlah_sukses" => $jumlah_sukses,
            "jumlah_gagal" => $jumlah_gagal
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));