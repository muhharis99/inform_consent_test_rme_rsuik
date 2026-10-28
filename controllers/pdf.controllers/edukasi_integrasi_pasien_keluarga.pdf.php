<?php

ini_set('max_execution_time', 120);
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = "";
$printer = "";
$halaman = "";
$halamanx = "";

switch ((string) segment(6)) {
    case 'PRINT':
    case 'print':
        $pdf_type = "F";
        $lp_print = true;
        break;
    case 'FILE':
        $pdf_type = "F";
        $lp_print = false;
        break;
    case 'FILECLIENT':
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break;
    case 'PRINTSERVER':
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break;
    case 'PRINTSERVER1':
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break;
    case 'PRINTSERVER2':
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break;
}

$this->load->model('Pasien');
$this->load->model('Agama');
$this->load->model('Perkawinan');
$this->load->model('Pendidikan');
$this->load->model('Pekerjaan');
$this->load->model('Kunjung');
$this->load->model('Asuransi');
$this->load->model('Poli');
$this->load->model('Bangsal');
$this->load->model('Karyawan');
$this->load->model('Karya');
$this->load->model('Dokter');
$this->load->model('edukasi_integrasi');
$this->load->model('edukasi_hambatan');
$this->load->model('edukasi_hambatan_list');
$this->load->helper('validateImage');

$no_reg = segment(4);
$tgl_rs = segment(5);

if ((string) $tgl_rs == "") {
    $tgl_rs = date("YmdHis");
}

$tgl_masuk = substr($tgl_rs, 0, 4) . "-" . substr($tgl_rs, 4, 2) . "-" . substr($tgl_rs, 6, 2);
$jam_masuk = substr($tgl_rs, 8, 2) . ":" . substr($tgl_rs, 10, 2) . ":" . substr($tgl_rs, 12, 2);
$tanggal_masuk = substr($tgl_rs, 0, 4) . "-" . substr($tgl_rs, 4, 2) . "-" . substr($tgl_rs, 6, 2)." ".substr($tgl_rs, 8, 2) . ":" . substr($tgl_rs, 10, 2) . ":" . substr($tgl_rs, 12, 2);

//json($tgl_rs);

$edukasi = DB::table(DB::raw('rme.edukasi_hambatan USE INDEX (no_reg)'))->where('no_reg', $no_reg)->where(DB::RAW("date(tanggal_masuk)"), $tgl_masuk)->whereNull('deleted')->first();

$rows_edukasi = Edukasi_hambatan_list::where('no_reg', $no_reg)->whereRaw("date(tanggal_masuk) = date('$tanggal_masuk')")->whereNull('deleted')->orderBy('registered', 'asc')->get();
$petugas = array_column(DB::table('sdm.karya')->get(['nik', 'nama']), 'nama', 'nik');
$dokter = array_column(DB::table('rsiklaten.dokter')->get(['no_dr', 'nama2']), 'nama2', 'no_dr');
$writer = array_column(DB::table('rsiklaten.user')->get(['user', 'id']), 'id', 'user');
// if (ipclient()==IPC) json($tanggal_masuk);

// array_push($petugas, $dokter);
$arr_user = array_column(DB::select("
        select 
            a.user as kode, 
            case when c.sps_id is not null and c.sps_id != '' then true else false end as dokter,
            case when b.nama is not null then b.nama else c.nama2 end as nama
        from rsiklaten.user a 
            left join sdm.karya b 
                on a.user = b.nik
            left join rsiklaten.dokter c
                on a.user = c.no_dr 
        where a.status = 1 
        "), 'nama', 'kode');

// $materi = array_column(DB::table('rme.edukasi_hambatan_map_field')->get(['kolom', 'ket']), 'ket', 'kolom');
// function get_materi($row, $materi, $arr_user) {
//     $result = '<table cellpadding="0" cellspacing="0" border="0">';
//     foreach ($materi as $key=>$edu) {
//         if ($key=='edu_perawat' && !empty($row[$key])) {
//             $result.= !empty($row[$key])?'<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$edu.' <font size="1">'.($arr_user[$row['edu_perawat_nip']??'']??'').'</font></td></tr>':'' ;
//         } else if ($key=='edu_dpjp' && !empty($row[$key])) {
//             $result.= !empty($row[$key])?'<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$edu.' <font size="1">'.($arr_user[$row['edu_dpjp_kode']??'']??'').'</font></td></tr>':'' ;
//         } else if ($key=='edu_alat_lain' && !empty($row[$key])) {
//             $result.= !empty($row[$key])?'<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$edu.' <font size="2">'.($row['edu_alat_lain_text']??'').'</font></td></tr>':'' ;
//         } else {
//             $result.= !empty($row[$key])?'<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$edu.'</td></tr>':'' ;
//         }
//     }
//     $result .='</table>';
//     return $result;
// }

$rows_materi = DB::table('rme.edukasi_hambatan_map_field')->get(['kolom', 'ket', 'jenis', 'grup', 'deleted']);
$arr_materi = [];
foreach ($rows_materi as $parent) {
    if ($parent['jenis']=='parent') {
        $arr_child = [];
        foreach ($rows_materi as $child) {
            if ($child['jenis']=="child" && $child['grup']==$parent['kolom']) $arr_child[] = ["kode" => $child["kolom"], "materi" => $child["ket"]];
        }
        $arr_materi[] = [
            "kode" => $parent['kolom'],
            "group" => $parent['ket'], 
            "list" => $arr_child
        ];
    }
}

function formatNamePerawat($key) {
    return ucwords(strtolower($key));
}

function get_materi_group($row, $arr_materi, $arr_user) {
    $result = '<table cellpadding="0" cellspacing="0" border="0">';
    foreach ($arr_materi as $key => $parent) {
        $show_par = false;
        foreach ($parent['list'] as $key => $child) {
            if (!empty($row[$child['kode']])) {
                $result .= $show_par === false ? '<tr><td colspan="2" style="line-height:12px; padding-top:2px; padding-left:2px; font-weight:bold;"> '.$parent['group'].'</td></tr>' : '';
                $show_par = $show_par === false ? true : $show_par;
                
                switch ($child['kode']) {
                    case 'edu_perawat' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.(formatNamePerawat($arr_user[$row['edu_perawat_nip']??'']??'')).'</td></tr>'; break; 
                    case 'edu_dpjp' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($arr_user[$row['edu_dpjp_kode']??'']??'').'</td></tr>'; break; 
                    case 'edu_ppa_lain' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($row['edu_ppa_lain_text']??'').'</td></tr>'; break; 
                    case 'edu_alat_lain' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($row['edu_alat_lain_text']??'').'</td></tr>'; break; 
                    case 'edu_opb_lain' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($row['edu_opb_lain_text']??'').'</td></tr>'; break; 
                    case 'edu_diet_lain' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($row['edu_diet_lain_text']??'').'</td></tr>'; break; 
                    case 'edu_farm_lain' : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].' '.($row['edu_farm_lain_text']??'').'</td></tr>'; break; 
                    default : $result .= '<tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '.$child['materi'].'</td></tr>'; break; 
                }
            }
        }
    }
    $result .='</table>';
    return $result;
}

$res_edu_partisipasi = $res_edu_penunjang = $res_edu_kondisi = $res_edu_informed = $res_edu_efek_samping = $res_edu_alat = $res_edu_diet = $res_edu_nyeri = $res_edu_rehab = $res_edu_cuci = $res_edu_rujukan = $res_edu_lainnya = false;
$kebutuhan_edukasi = "";
$kebutuhan_edukasi_lain = "";
$rows = [];
$rows_debug = [];
if (!empty($rows_edukasi)) {
    foreach ($rows_edukasi as $row) {
        $row['str_tgl_pengkajian'] = date("d-m-Y H:i:s", strtotime($row['registered']));
        $row['materi'] = get_materi_group($row, $arr_materi, $arr_user);
            if (!empty($row['edu_lain_text'])&&trim($row['edu_lain_text'])!='-') $row['materi'] .= '<table cellpadding="0" cellspacing="0" border="0"><tr><td width="20" style="vertical-align:top;">&nbsp;<font class="fa fam"> &#xf046; </font> </td><td style="line-height:12px; padding-top:2px;"> '. $row['edu_lain_text'].'</td></tr></table>';
        $row['userttd'] = $writer[$row['petugas']]??$row['petugas'];
        $row['petugas'] = !empty($petugas[$row['petugas']])?formatNamePerawat($petugas[$row['petugas']]):($dokter[$row['petugas']]??$row['petugas']);
        $row['str_hasil'] = '';
        $row['leaflet'] = str_replace('@@,', ', ', $row['leaflet']);
        $row['str_tgl_hasil'] = '';
        if (!empty($row['hasil_ngerti'])) { 
            $row['str_hasil'].='<font class="fa fam"> &#xf046; </font> Sudah mengerti'; 
        } else {
            if (!empty($row['hasil_re_edukasi'])) $row['str_hasil'].='<font class="fa fam"> &#xf046; </font> Re-edukasi'; 
            if (!empty($row['hasil_re_edukasi'])) $row['str_tgl_hasil'].=date("d-m-Y H:i:s", strtotime($row['tgl_re_edukasi'])); 
            if (!empty($row['hasil_re_demo'])) $row['str_hasil'].=($row['str_hasil']!=''?'<br />':'').'<font class="fa fam"> &#xf046; </font> Re-demonstrasi'; 
            if (!empty($row['hasil_re_demo'])) $row['str_tgl_hasil'].=($row['str_hasil']!=''?'<br />':'').date("d-m-Y H:i:s", strtotime($row['tgl_re_demo'])); 
        }
        $row['str_tgl_re_edukasi'] = !empty($row['tgl_re_edukasi'])?date("d-m-Y", strtotime($row['tgl_re_edukasi'])):'';
        $row['str_tgl_re_demo'] = !empty($row['tgl_re_demo'])?date("d-m-Y", strtotime($row['tgl_re_demo'])):'';
        $row['hasil'] = $row['hasil_ngerti'] == 1 ? 'Sudah mengerti' : (($row['hasil_re_edukasi'] == 1 ? 're-Edukasi'.(trim($row['tgl_re_edukasi']??'')!=''?" (".date("d-m-Y", strtotime($row['tgl_re_edukasi'])).")":''):'').($row['hasil_re_demo'] == 1 ? ($row['hasil_re_edukasi']==1?'<br />':'').'re-Demonstrasi'.(trim($row['tgl_re_demo']??'')!=''?" (".date("d-m-Y", strtotime($row['tgl_re_demo'])).")":''):''));
        $row['action'] = '<button class="btn btn-primary btn-koreksi-edukasi" data-waktu="'.$row['registered'].'" data-no_reg="'.$row['no_reg'].'" data-row=\''.json_encode($row, JSON_UNESCAPED_UNICODE).'\' onClick="koreksiEdukasi($(this))" type="button">Koreksi</button>';

        // $res_edu_partisipasi = trim($row['edu_partisipasi']??''.$row['edu_sarpras']??''.$row['edu_hak']??''.$row['edu_dpjp']??''.$row['edu_perawat']??''.$row['edu_tatib']??''.$row['edu_kunjung']??''.$row['edu_gelang']??''.$row['edu_batuk']??''.$row['edu_sampah']??''.$row['edu_jatuh']??''.$row['edu_asuransi']??'')!=''?true:$res_edu_partisipasi;
        // $res_edu_penunjang = trim($row['edu_penunjang']??'')!=''?true:$res_edu_penunjang;
        // $res_edu_kondisi = trim($row['edu_kondisi']??''.$row['edu_asuhan']??''.$row['edu_pengobatan']??''.$row['edu_tidak_harap']??''.$row['edu_harapan']??''.$row['edu_antisipasi']??'')!=''?true:$res_edu_kondisi;
        
        $kebutuhan_edukasi .= trim($row['edu_partisipasi']??''.$row['edu_sarpras']??''.$row['edu_hak']??''.$row['edu_dpjp']??''.$row['edu_perawat']??''.$row['edu_tatib']??''.$row['edu_kunjung']??''.$row['edu_gelang']??''.$row['edu_batuk']??''.$row['edu_sampah']??''.$row['edu_jatuh']??''.$row['edu_asuransi']??'')!=''?',edu_partisipasi':'';
        $kebutuhan_edukasi .= trim($row['edu_penunjang']??'')!=''?',edu_penunjang':'';
        $kebutuhan_edukasi .= trim($row['edu_kondisi']??''.$row['edu_asuhan']??''.$row['edu_pengobatan']??''.$row['edu_tidak_harap']??''.$row['edu_harapan']??''.$row['edu_antisipasi']??'')!=''?',edu_kondisi':'';
        $kebutuhan_edukasi .= trim($row['edu_informed']??'')!=''?',edu_informed':'';
        $kebutuhan_edukasi .= trim($row['edu_efek_samping']??''.$row['edu_pemberian_obat']??''.$row['edu_interaksi']??''.$row['edu_ppa_lain']??'')!=''?',edu_efek_samping':'';
        $kebutuhan_edukasi .= trim($row['edu_infus']??''.$row['edu_kateter']??''.$row['edu_ngt']??''.$row['edu_alat_lain']??'')!=''?',edu_alat':'';
        $kebutuhan_edukasi .= trim($row['edu_gizi']??''.$row['edu_diet_rawat']??''.$row['edu_diet_rumah']??''.$row['edu_diet_lain']??'')!=''?',edu_diet':'';
        $kebutuhan_edukasi .= trim($row['edu_farmakologi']??''.$row['edu_non_farmakologi']??'')!=''?',edu_nyeri':'';
        $kebutuhan_edukasi .= trim($row['edu_ft']??''.$row['edu_ot']??''.$row['edu_tw']??''.$row['edu_rehab_lain']??'')!=''?',edu_rehab':'';
        $kebutuhan_edukasi .= trim($row['edu_cuci']??'')!=''?',edu_cuci':'';
        $kebutuhan_edukasi .= trim($row['edu_rokok']??'')!=''?',edu_rokok':'';
        $kebutuhan_edukasi .= trim($row['edu_rujukan']??'')!=''?',edu_rujukan':'';
        $kebutuhan_edukasi_lain .= trim($row['edu_lain']??'')!=''?','.$row['edu_lain']:'';
        $rows[] = $row;
        // $row['sign'] = strlen($row['sign']) >= 57000 && strlen($row['sign']) <= 65600 ? null : $row['sign'];
    }
}
// json($kebutuhan_edukasi); 101029
// if (ipclient()==IPC) json($rows_debug);

$row_kkb = null;

$nama = '';
$nik = '';
$alamat = '';
$umur = '';
$tgl_lahir = '';
$jenis_kel = '';
$telp = '';
$agama = '';
$kawin = '';
$didik = '';
$kerja = '';
$kunjung = 'LAMA';
$asuransi = '';
$asal = '';
$str_tgl_masuk = '';
$bangsal = '';
$pasien = null;
$pasien = Pasien::find($no_reg);

if (!empty($pasien)) {
    $nama = $pasien->nama;
    $nik = $pasien->no_id;
    $tgl_lahir = $pasien->tgl_lahir;
    $alamat = $pasien->alamat;

    switch ($pasien->jenis_kel) {
        case '1':
        case 1:
        case 'L':
            $jenis_kel = 'LAKI-LAKI';
            break;
        case '2':
        case 2:
        case 'P':
            $jenis_kel = 'PEREMPUAN';
            break;
    }

    $telp = $pasien->telp;

    if (!empty($pasien->telp2)) {
        $telp .= '/' . $pasien->telp2;
    }

    $row_agama = Agama::where('kd_agama', $pasien->agama)->first();

    if (!empty($row_agama)) {
        $agama = strtoupper($row_agama->agama);
    }

    $row_kawin = Perkawinan::where('kd_perkawinan', $pasien->kawin)->first();

    if (!empty($row_kawin)) {
        $kawin = strtoupper($row_kawin->nama_perkawinan);
    }

    $row_didik = Pendidikan::where('kd_pendidikan', $pasien->didik)->first();

    if (!empty($row_didik)) {
        $didik = strtoupper($row_didik->pendidikan);
    }

    $row_kerja = Pekerjaan::where('kd_pekerjaan', $pasien->pekerjaan)->first();

    if (!empty($row_kerja)) {
        $kerja = strtoupper($row_kerja->pekerjaan);
    }
}

$umur = selisihymdhis($tgl_lahir, $tgl_masuk, "umur");


$registered = !empty($row_kkb) ? $row_kkb->registered : '';
$writer = !empty($row_kkb) ? $row_kkb->writer : '';
$nama_petugas = !empty($row_kkb) ? $row_kkb->nama_petugas : '';

$nama = ipclient()==IPC?asteriskNama($nama):$nama;
$nik = ipclient()==IPC?asteriskNama($nik):$nik;

include('warning.pdf.php');
$pdf_type = "I";
$data = array(
    "no_reg" => $no_reg,
    "tgl_masuk" => $tgl_masuk,
    "jam_masuk" => $jam_masuk,
    "tgl_rs" => $tgl_rs,
    "ranap" => $row_kkb,
    "nama" => $nama,
    "warning_sama" => isset($warning_sama) ? $warning_sama : false,
    "nik" => $nik,
    "jenis_kel" => $jenis_kel,
    "alamat" => $alamat,
    "tgl_lahir" => $tgl_lahir,
    "telp" => $telp,
    "agama" => $agama,
    "kawin" => $kawin,
    "didik" => $didik,
    "kerja" => $kerja,

    "kunjung" => $kunjung,
    "asuransi" => $asuransi,
    "asal" => $asal,
    "str_tgl_masuk" => $str_tgl_masuk,
    "bangsal" => $bangsal,
    "nama_petugas" => $nama_petugas,
    'pdf_type' => $pdf_type,
    'lp_print' => $lp_print,
    'printer' => $printer,
    'halaman' => $halaman,
    'halamanx' => $halaman,

    'registered' => $registered,
    'writer' => $writer,
    'rows' => $rows,
    'edukasi' => $edukasi,
    'kebutuhan_edukasi' => $kebutuhan_edukasi,
    'kebutuhan_edukasi_lain' => substr($kebutuhan_edukasi_lain, 1, strlen($kebutuhan_edukasi_lain)),

    'waktu_cetak' => date("d/m/Y H:i:s"),
    'ipclient' => $ipclient
);
// json($data);
// if (ipclient()==IPC) json($data);

go('pdf/edukasi_integrasi_pasien_keluarga', $data);