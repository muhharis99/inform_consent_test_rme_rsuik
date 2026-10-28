<?php 

        $this->load->model('Kunjung');
        $this->load->helper('bpjs_bridge');
        $kodebooking = $this->input->get('kodebooking'); 
        
        $data_post = [
            "sec"			=> "antreanrs",
            "method"		=> "POST",
            "url"			=> "antrean/getlisttask", 
            "data"          => [
                "kodebooking"   => $kodebooking
            ]
        ];
        $result = antreanrs($data_post); 
        $result = json_decode($result);
        $rows = []; 
        if (!empty($result->response)) {
            foreach ($result->response as $row) {
                $row = (object) $row; 
                $row->jam = substr($row->wakturs, 11, 8); 
                $rows[] = $row;
            }
        }
        // json($result);
        $data = array(
            "rows" => !empty($rows)?$rows:[], 
            "total" => !empty($rows)?count($rows):0, 
        );
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));