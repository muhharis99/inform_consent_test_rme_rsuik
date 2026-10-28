<?php 
        $this->load->model('soap');

        $soap_id = $this->input->post('soap_id');

        $soap = '';
        // $soap = Soap::find($soap_id);
        $query = "
            SELECT 
                * 
            FROM 
                rme.soap a
            WHERE 
                a.id = '$soap_id'
            "; 
        $soap = DB::select($query);
        if (!empty($soap)) {
            $soap = $soap[0];
        }
        // $soap = (object) $soap; 
        // echo"<pre>";print_r($soap[0]);die();
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($soap));