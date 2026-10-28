<?php 

$rawat = segment(4);
$no_reg = segment(5);
$result = null;
$status = false;
if (!empty($rawat)&&strtolower($rawat)=='pasien') {
	if (!empty($no_reg)) {  
		$xdata=[
			"sec"  => "sync",
			"opt"  => "pasien",
			"xht"  => "1",
			"norm" => "$no_reg"
		];

		$url='http://192.168.0.11/pendaftaran/service.php';
		$data=json_encode($xdata);
		$headers= array('auth:4NN4B3L', 'Content-type: application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$xresult_pasien = curl_exec($ch);
		curl_close($ch);

		$result = [
			'no_reg' => $no_reg,
			'pasien' => $xresult_pasien,
		];
		$status = true;
	}

} else if (!empty($rawat)&&strtolower($rawat)=='inap') {
	if (!empty($no_reg)) {  
		
		$xdata=[
			"sec"  => "sync",
			"opt"  => "batalinap",
			"xht"  => "1",
			"norm" => "$no_reg"
		];

		$data=json_encode($xdata);
		$headers= array('auth:4NN4B3L', 'Content-type: application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$xresult_inap = curl_exec($ch);
		curl_close($ch);

		$result = [
			'no_reg' => $no_reg,
			'pasien' => $xresult_pasien,
			'inap' => $xresult_inap
		];
		$status = true;
	}
}
json([
	"status" => $status,
	"data" => $result
]);
