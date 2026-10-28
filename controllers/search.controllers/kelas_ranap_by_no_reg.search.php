<?php 
    // $this->load->model('inacbgi');

    $no_reg     = $this->input->post('no_reg');
    $nama       = '';
    $kelas      = '';
    $kd_bangsal = '';

    $query = "
    SELECT 
        a.no_reg,a.nama,a.kelas,a.kd_bangsal
    FROM 
        ranap.inap a
    WHERE 
        a.no_reg = '$no_reg'
    ORDER BY a.id DESC LIMIT 1
    "; 
    $dat = DB::select($query);

    if (!empty($dat)) {
        $nama       = $dat[0]['nama'];
        $kelas      = $dat[0]['kelas'];
        $kd_bangsal = $dat[0]['kd_bangsal'];
    }

    $data = array(
        'no_reg'     => $no_reg,
        'nama'       => $nama,
        'kelas'      => $kelas,
        'kd_bangsal' => $kd_bangsal,
        // 'inacbg' => $inacbg,
    );
    // pre($data);
    echo json_encode($data);