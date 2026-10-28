<?php 
    $this->load->model('monitoring_adm_gd');

    $tanggal = $this->input->post('tanggal');
    $no_reg  = $this->input->post('no_reg');

    $catatan      = '';

    $datas =  Monitoring_adm_gd::where('tanggal',$tanggal)->where('no_reg',$no_reg)->where('status','1')->orderBy('id', 'desc')->first();

    if (count($datas) > 0) {
        $catatan      = $datas->catatan;
    }
    
    $data = array(
        "no_reg"  => $no_reg,
        "tanggal" => $tanggal,
        "catatan" => $catatan,
        "kelas" => !empty($datas['Kelas'])?$datas['Kelas']:null,
        "tgl_rencana_inap" => !empty($datas['rencana_inap'])?date("d-m-Y", strtotime($datas['rencana_inap'])):null
    );
    return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));