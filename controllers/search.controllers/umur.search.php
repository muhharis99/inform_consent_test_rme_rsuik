<?php 

        $tgl_lahir     = substr($this->input->get('tgl_lahir'), 6, 4)."-".substr($this->input->get('tgl_lahir'), 3, 2)."-".substr($this->input->get('tgl_lahir'), 0, 2);
        $tgl_dirawat = substr($this->input->get('tgl_dirawat'), 6, 4)."-".substr($this->input->get('tgl_dirawat'), 3, 2)."-".substr($this->input->get('tgl_dirawat'), 0, 2);
        $data = array(
            "status" => true, 
            "tgl_lahir" => $tgl_lahir,
            "tgl_dirawat" => $tgl_dirawat,
            "umur" => selisihymdhis($tgl_lahir, $tgl_dirawat, "umur")
        ); 
        echo json_encode($data); 