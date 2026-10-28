<?php 
    // $this->load->model('soap');
    $this->load->model('diag_rj');

    $soap_id = $this->input->post('soap_id');
    $no_reg  = $this->input->post('no_reg');

    $icd1      = '';
    $icd2      = '';
    $icd3      = '';
    $icd4      = '';
    $kd_sms      = '';
    
    $tindakan1 = '';
    $tindakan2 = '';
    $tindakan3 = '';
    $tindakan4 = '';

    $diag_rj =  Diag_rj::where('soap_id',$soap_id)->where('no_reg',$no_reg)->whereNull('deleted')->orderBy('id', 'desc')->first();

    if (count($diag_rj) > 0) {
        $icd1      = $diag_rj->icd1;
        $icd2      = $diag_rj->icd2;
        $icd3      = $diag_rj->icd3;
        $icd4      = $diag_rj->icd4;
        $kd_sms      = $diag_rj->kd_sms;
        $tindakan1 = $diag_rj->pd1;
        $tindakan2 = $diag_rj->pd2;
        $tindakan3 = $diag_rj->pd3;
        $tindakan4 = $diag_rj->pd4;
    }
    
    $data = array(
        "icd1"      => $icd1,
        "icd2"      => $icd2,
        "icd3"      => $icd3,
        "icd4"      => $icd4,
        "kd_sms"      => $kd_sms,
        "tindakan1" => $tindakan1,
        "tindakan2" => $tindakan2,
        "tindakan3" => $tindakan3,
        "tindakan4" => $tindakan4,
        
    );
    return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));