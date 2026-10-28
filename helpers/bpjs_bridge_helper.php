<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('vclaim')) {
	function vclaim($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_BRIDGE_BPJS_VCLAIM); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
    }
}

if (!function_exists('antreanrs')) {
	function antreanrs($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_BRIDGE_BPJS_ANTREAN); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
    }
}

if (!function_exists('aplicares')) {
	function aplicares($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_BRIDGE_BPJS_APLICARES); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
    }
}

