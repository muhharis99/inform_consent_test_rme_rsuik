<?php 
    // $this->load->model('pasien_alergi');

    $grouping_jenis_no    = $this->input->post('grouping_jenis_no');
    $KL_I   = '';
    $KL_II  = '';
    $KL_III = '';
    $gruper = '';

    $query = "
    SELECT 
        a.*
    FROM 
        inacbg.INACBGI a 
    WHERE 
        a.NO = '$grouping_jenis_no'
    "; 
    $data1 = DB::select($query);
    if (!empty($data1)) {
        $KL_I   = $data1[0]['KL_I'];
        $KL_II  = $data1[0]['KL_II'];
        $KL_III = $data1[0]['KL_III'];
        $gruper = $data1[0]['GRUPER'];
        $KL_1   = 'Rp. '.number_format($data1[0]['KL_I']);
        $KL_2   = 'Rp. '.number_format($data1[0]['KL_II']);
        $KL_3   = 'Rp. '.number_format($data1[0]['KL_III']);
    }
// pre($data1);
    $data = array(
        'kl_I'   => $KL_I,
        'kl_II'  => $KL_II,
        'kl_III' => $KL_III,
        'kl_1'   => $KL_1,
        'kl_2'   => $KL_2,
        'kl_3'   => $KL_3,
        'gruper'   => $gruper,
    );

    echo json_encode($data);
    // pre($data);