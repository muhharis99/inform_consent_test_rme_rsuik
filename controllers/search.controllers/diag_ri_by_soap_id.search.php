<?php 
    // $this->load->model('soap');
    $this->load->model('diag_ri');

    $soap_id = $this->input->post('soap_id');
    $no_reg  = $this->input->post('no_reg');

    $icd1      = '';
    $icd2      = '';
    $icd3      = '';
    $icd4      = '';
    $icd5      = '';
    $icd6      = '';
    $icd7      = '';
    $icd8      = '';
    // $kd_sms      = '';
    
    $tindakan1 = '';
    $tindakan2 = '';
    $tindakan3 = '';
    $tindakan4 = '';
    $tindakan5 = '';
    $tindakan6 = '';
    $tindakan7 = '';
    $tindakan8 = '';
    $notes = '';

    $diag_ri =  Diag_ri::where('soap_id',$soap_id)->where('no_reg',$no_reg)->whereNull('deleted')->orderBy('id', 'desc')->first();

    if (count($diag_ri) > 0) {
        $icd1      = $diag_ri->icd1;
        $icd2      = $diag_ri->icd2;
        $icd3      = $diag_ri->icd3;
        $icd4      = $diag_ri->icd4;
        $icd5      = $diag_ri->icd5;
        $icd6      = $diag_ri->icd6;
        $icd7      = $diag_ri->icd7;
        $icd8      = $diag_ri->icd8;
        $tindakan1 = $diag_ri->pd1;
        $tindakan2 = $diag_ri->pd2;
        $tindakan3 = $diag_ri->pd3;
        $tindakan4 = $diag_ri->pd4;
        $tindakan5 = $diag_ri->pd5;
        $tindakan6 = $diag_ri->pd6;
        $tindakan7 = $diag_ri->pd7;
        $tindakan8 = $diag_ri->pd8;
        $notes = $diag_ri->notes;
    }
    
    $data = array(
        "icd1"      => $icd1,
        "icd2"      => $icd2,
        "icd3"      => $icd3,
        "icd4"      => $icd4,
        "icd5"      => $icd5,
        "icd6"      => $icd6,
        "icd7"      => $icd7,
        "icd8"      => $icd8,
        "tindakan1" => $tindakan1,
        "tindakan2" => $tindakan2,
        "tindakan3" => $tindakan3,
        "tindakan4" => $tindakan4,
        "tindakan5" => $tindakan5,
        "tindakan6" => $tindakan6,
        "tindakan7" => $tindakan7,
        "tindakan8" => $tindakan8,
        "notes" => $notes,
        
    );
    // pre($data);
    return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));