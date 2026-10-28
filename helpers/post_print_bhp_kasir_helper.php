<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('post_print_bhp_kasir')) {
	function post_print_bhp_kasir($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_KASIR."/print_nota_bhp_rajal.php"); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
        
    }
}

