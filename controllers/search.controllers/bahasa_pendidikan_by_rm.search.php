<?php 
    // $this->load->model('soap');
    $this->load->model('bahasa');
    $this->load->model('pendidikan');
    $this->load->model('pasien');

    $no_reg  = $this->input->post('no_reg');

    $bahasa     = '';
    $pendidikan = '';
    $pasien     = Pasien::find($no_reg);

    if (count($pasien) > 0) {
        $bahasa     = $pasien->bahasa;
        $pendidikan = $pasien->didik;
    }
    
    $data = array(
        "bahasa"     => $bahasa,
        "pendidikan" => $pendidikan,
        
        
    );
    return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));