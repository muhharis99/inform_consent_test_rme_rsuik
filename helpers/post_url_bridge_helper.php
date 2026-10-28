<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('post_url_bridge')) {
	function post_url_bridge($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_BRIDGE); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
    }
}

if (!function_exists('post_url_bridge_pasien')) {
	function post_url_bridge_pasien($data_post) {
        $headers= array('auth:4NN4B3L', 'Content-type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, URL_BRIDGE_PENDAFTARAN); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data_result = curl_exec($ch);
        curl_close($ch);
        return $data_result;
    }
}

