<?php
ini_set('memory_limit', '-1');
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Board extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function bar() {
        $bar = $this->input->post('bar'); 
        $data = [
            "width" => 800,
            "height" => 400,
            "bar" => $bar,
            "bar_legend" => "Pencapaian Harian IGD 2023",
            "line" => [138, 138, 138, 138, 138, 138, 138, 138, 138, 138, 138, 138],
            "line_legend" => "Target 2023",  
            "x_title" => "", 
            "y_title" => "",
            "arr_bulan" => ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOP', 'DES'],
            "title" => "Rata-rata Kunjungan Harian Pasien IGD",
            "unit" => "Tim IT",
        ];
        go('img/bar', $data);
    }
    public function qr() {
        $this->load->library('ciqrcode');
        $data = urldecode(explode('img/qr/', $_SERVER['REQUEST_URI'])[1]??'');
        QRcode::png($data, $outfile=false, $level=QR_ECLEVEL_H, $size=10, $margin=2, $saveandprint=false);
    }
}
