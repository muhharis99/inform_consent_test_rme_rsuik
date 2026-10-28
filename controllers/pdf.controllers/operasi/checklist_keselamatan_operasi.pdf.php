<?php
$no_reg = segment(4);
$tgl_rs = segment(5);
$tgl_masuk = date('Y-m-d', strtotime($tgl_rs));
$jam_masuk = date('H:i', strtotime($tgl_rs));
$tgl_op = date('Y-m-d H:i', strtotime($tgl_rs));

$tgl_keluar = date("Y-m-d H:i:s"); 
$bgs_register = DB::table("bgs_register")
					->where('no_reg', $no_reg)
					->where('tgl_daftar', $tgl_masuk)
					->whereNotNull('tgl_keluar')
					->orderBy('id', 'desc')
					->first();
if (!empty($bgs_register)) {
	$bgs_register = (object) $bgs_register; 
	$tgl_keluar = $bgs_register->tgl_keluar; 
}

$result = [];
$op_bon = DB::connection('rme')
			->table('operasi_bon')
			->whereRaw("CONCAT(tgl_kunjung,' ', LEFT(jam_kunjung, 5)) = ?", [$tgl_op])
			->whereNotNull('bon_id')
			->selectRaw('bon_id')
			->get();
			
if(count($op_bon) > 0) {
	foreach($op_bon as $item) {
		$ranap_bon_op = DB::connection('ranap')
						->table('bon_op')
						->where('Id', $item['bon_id'])
						->first();
						
		$selamat = DB::connection('rme')
						->table('operasi_selamat')
						->where('bon_id', $item['bon_id'])
						->selectRaw('tgl_signin, tgl_insisi, tgl_signout, signin_konfirmasi, signin_tanda, signin_implan, signin_lengkap, signin_nafas, signin_alergi, signin_premidikasi, signin_darah, signin_sholat, signin_aurat, signin_doa, perawat_terima, perawat_anestesi, timeout_lengkap, timeout_verbal, timeout_profilaksis, timeout_foto, timeout_petugas_pembaca, timeout_jenis_petugas_pembaca, signout_verbal, signout_tampon, signout_sholat, signout_jaringan, signout_dokumen, signout_peralatan_perbaikan, perawat_instrumen, perawat_rr, dokter_anestesi, dokter_bedah')
						->first();
						
		if(count($ranap_bon_op) > 0 && count($selamat) > 0) {
			if($ranap_bon_op['dx1'] != null && $ranap_bon_op['dx2'] != null) {
				$bon_diagnosa_check = 'Y';
				$bon_diagnosa = $ranap_bon_op['dx1'].', '.$ranap_bon_op['dx2'];
			} else if ($ranap_bon_op['dx1'] != null && $ranap_bon_op['dx2'] == null) {
				$bon_diagnosa_check = 'Y';
				$bon_diagnosa = $ranap_bon_op['dx1'];
			}

			if($ranap_bon_op['pd1'] != null && $ranap_bon_op['pd2'] != null) {
				$bon_tindakan_check = 'Y';
				$bon_tindakan = $bon->pd1.', '.$ranap_bon_op['pd2'];
			} else if ($ranap_bon_op['pd1'] != null && $ranap_bon_op['pd2'] == null) {
				$bon_tindakan_check = 'Y';
				$bon_tindakan = $ranap_bon_op['pd1'];
			}
			
			$result[] = [
				'bon_id' => $item['bon_id'],
				'bon_diagnosa_check' => $bon_diagnosa_check,
				'bon_diagnosa' => $bon_diagnosa,
				'tgl_signin' => 'Tanggal: '.date('d/m/Y', strtotime($selamat['tgl_signin'])).' Pukul '.date('H:i', strtotime($selamat['tgl_signin'])).' WIB',
				'tgl_insisi' => 'Tanggal: '.date('d/m/Y', strtotime($selamat['tgl_insisi'])).' Pukul '.date('H:i', strtotime($selamat['tgl_insisi'])).' WIB',
				'tgl_signout' => 'Tanggal: '.date('d/m/Y', strtotime($selamat['tgl_signout'])).' Pukul '.date('H:i', strtotime($selamat['tgl_signout'])).' WIB',
				'signin_konfirmasi' => $selamat['signin_konfirmasi'],
				'signin_tanda' => $selamat['signin_tanda'],
				'signin_implan' => $selamat['signin_implan'],
				'signin_lengkap' => $selamat['signin_lengkap'],
				'signin_nafas' => $selamat['signin_nafas'],
				'signin_alergi' => $selamat['signin_alergi'],
				'signin_premidikasi' => $selamat['signin_premidikasi'],
				'signin_darah' => $selamat['signin_darah'],
				'signin_sholat' => $selamat['signin_sholat'],
				'signin_aurat' => $selamat['signin_aurat'],
				'signin_doa' => $selamat['signin_doa'],
				'perawat_terima' => $selamat['perawat_terima'],
				'perawat_terima_nama' => getUserById($selamat['perawat_terima']),
				'perawat_anestesi' => $selamat['perawat_anestesi'],
				'perawat_anestesi_nama' => getUserById($selamat['perawat_anestesi']),
				'timeout_lengkap' => $selamat['timeout_lengkap'],
				'timeout_verbal' => $selamat['timeout_verbal'],
				'timeout_profilaksis' => $selamat['timeout_profilaksis'],
				'timeout_foto' => $selamat['timeout_foto'],
				'timeout_petugas_pembaca' => $selamat['timeout_petugas_pembaca'],
				'timeout_petugas_pembaca_nama' => $selamat['timeout_petugas_pembaca'] != null ? ($selamat['timeout_jenis_petugas_pembaca'] == 1 ? getDokterByNip($selamat['timeout_petugas_pembaca'])->nama2 : getUserById($selamat['timeout_petugas_pembaca'])) : '',
				'signout_verbal' => $selamat['signout_verbal'],
				'signout_tampon' => $selamat['signout_tampon'],
				'signout_sholat' => $selamat['signout_sholat'],
				'signout_jaringan' => $selamat['signout_jaringan'],
				'signout_dokumen' => $selamat['signout_dokumen'],
				'signout_peralatan_perbaikan' => $selamat['signout_peralatan_perbaikan'],
				'perawat_instrumen' => $selamat['perawat_instrumen'],
				'perawat_instrumen_nama' => getUserById($selamat['perawat_instrumen']),
				'perawat_rr' => $selamat['perawat_rr'],
				'perawat_rr_nama' => getUserById($selamat['perawat_rr']),
				'dokter_anestesi' => $selamat['dokter_anestesi'],
				'dokter_anestesi_nama' => getDokterByKode($selamat['dokter_anestesi']),
				'dokter_bedah' => $selamat['dokter_bedah'],
				'dokter_bedah_nama' => getDokterByKode($selamat['dokter_bedah'])
			];
		}
	}
}
			
$pasien = Pasien::find($no_reg);
$data = array(
	"no_reg" => $pasien->no_reg ?? '',
	"nama" => $pasien->nama ?? '',
	"tgl_lahir" => $pasien->tgl_lahir ?? '',
	'umur' => $pasien->umur ?? '',
	'alamat' => $pasien->alamat ?? '',
	'nik' => $pasien->no_id ?? '',
	'data' => $result,
	"pdf_type" => "I"
);
go('pdf/operasi_selamat_portrait_dev', $data);