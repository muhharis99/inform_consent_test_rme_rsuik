<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
include APPPATH . 'controllers/construct.php';

class Export extends Construct
{
    function __construct() {
        parent::__construct();
    }
    
    function diag_psn() {
        // Database Connection
        $diag_psn = Diag_Pasien::where('Tglmsk2', '=', '2015-05-17')->get();
        //mnshankar\CSV::fromArray($diag_psn)->render();

        $this->tocsv($diag_psn, 'diag_psn', false, true);
    }

    function tocsv($query, $file, $attachment = false, $header = true)
    {
        if($attachment)
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename='.$file);
            $fp = fopen('php://output', 'w');
        }
        else
        {
            $fp = fopen($file, 'w');
        }

        $res = mysql_query($query);

        if($header)
        {
            $row = mysql_fetch_assoc($res);
            if($row)
            {
                fputcsv($fp, array_keys($row));
                mysql_data_seek($res, 0);
            }
        }

        while($row = mysql_fetch_assoc($res))
        {
            fputcsv($fp, $row);
        }

        fclose($fp);
        exit;
    }
}
