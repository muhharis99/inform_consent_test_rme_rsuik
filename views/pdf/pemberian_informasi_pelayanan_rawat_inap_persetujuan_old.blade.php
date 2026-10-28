<?php
function change_jkel($val) {
  $result = '';
  switch ($val) {
    case 'L' : 
      $result = "LAKI-LAKI"; 
      break; 
    case 'P' : 
      $result = "PEREMPUAN"; 
      break; 
  }
  return $result; 
}
define('DOC_REVISI', 'Revisi : 4');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Juni 2022');
define('DOC_NOMER', 'FM/RM/16.2'); 
define('DOC_FILE', 'Pemberian-Informasi-Pelayanan-RI-Persetujuan.pdf'); 
define('DOC_TITLE', 'PEMBERIAN INFORMASI<br>PELAYANAN RAWAT INAP'); 
define('DOC_SUBJECT', 'Pemberian Informasi Pelayanan Rawat Inap'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
      line-height:20px;
    }
    .bg0 {
      background-color: #FFFFFF;
    }
    .bg1 {
      background-color: #ECECEC;
    }
    .bg2 {
      background-color: #BEBEBE;
    }
    .bg3 {
      background-color: #9F9FA0;
    }
    .bg4 {
      background-color: #F8B14F;
    }
    .bg5 {
      background-color: #FAD59E;
    }
    .bg-burem td {
      line-height:20px;
    }
    .b td {
        font-weight:bold;
    }
    .bg-burem1 {
      background-color: rgb(245, 245, 245);
      line-height:20px;
    }
    .bg-white {
      background-color: #ffffff;
    }
    table {
      width:100%;
      font-size:14px;
    }
    .txr {
      text-align:right;
    }
    .txl {
      text-align:left;
    }
    .txj {
      text-align:justify;
    }
    .txc {
      text-align:center;
    }
    td {
      text-align:left;
      vertical-align:top;
      padding:0 3px 0 3px;
    }
    .b {
      font-weight:bold;
    }
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
    }
    .bdl {
       border-left: 0.5px solid black;
    }
    .bdr {
       border-right: 0.5px solid black;
    }
    .bdt {
       border-top: 0.5px solid black;
    }
    .bdb {
       border-bottom: 0.5px solid black;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .ln1 {
      line-height:1px;
    }
    .ln2 {
      line-height:2px;
    }
    .ln3 {
      line-height:9px;
    }
    .ln4 {
      line-height:4px;
    }
    .ln5 {
      line-height:5px;
    }
    .ln6 {
      line-height:6px;
    }
    .ln7 {
      line-height:7px;
    }
    .ln8 {
      line-height:8px;
    }
    .ln9 {
      line-height:9px;
    }
    .ln10 {
      line-height:10px;
    }
    .ln11 {
      line-height:11px;
    }
    .ln12 {
      line-height:12px;
    }
    .ln13 {
      line-height:13px;
    }
    .ln14 {
      line-height:14px;
    }
    .ln15 {
      line-height:15px;
    }
    .ln16 {
      line-height:16px;
    }
    .ln17 {
      line-height:17px;
    }
    .ln18 {
      line-height:18px;
    }
    .ln19 {
      line-height:19px;
    }
    .ln20 {
      line-height:20px;
    }
    .ln21 {
      line-height:21px;
    }
    .ln22 {
      line-height:22px;
    }
    .ln23 {
      line-height:23px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:20px;
    }
    .ln26 {
      line-height:26px;
    }
    .ln27 {
      line-height:27px;
    }
    .ln28 {
      line-height:28px;
    }
    .ln29 {
      line-height:29px;
    }
    .ln30 {
      line-height:30px;
    }
    .ln33 {
      line-height:33px;
    }
    .ln50 {
      line-height:50px;
    }
    .title td {
      line-height:20px;
      font-weight:bold;
    }
    .bdl {
       border-left: 0.5px solid #505050;
    }
    .bdr {
       border-right: 0.5px solid #505050;
    }
    .bdt {
       border-top: 0.5px solid #505050;
    }
    .bdb {
       border-bottom: 0.5px solid #505050;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .size-custom {
      font-size :14px;
    }
    .size-custom2 {
      font-size :16px;
    }
    table {
        overflow: wrap;
    }
    .checked {
      margin-right:20px;
      background-image:url(\''.IMG.'banner/square_check.png\'); background-image-resize:2; background-repeat:no-repeat; background-size:100px 100px; background-position:top left;
    }
  </style>
'; 
// $html .='<br>';
$print_tr = '';
$jml_row_spasi = 37;
for($i=0; $i<$jml_row_spasi; $i++) {
  $spasi .= '&nbsp;'; 
}


$html .= '
<table class="size-custom " cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <td width="190px">Pelayanan </td>
      <td width="10">:</td>
      <td>&nbsp; <img src="'.IMG.'banner/'.(($asal == 'POLI')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Poliklinik</td>
      <td colspan="3">&nbsp; <img src="'.IMG.'banner/'.(($asal == 'UGD')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> IGD</td>
    </tr>
    <tr>
      <td>Dokter pemberi Informasi</td>
      <td>: </td>
      <td colspan="4">'.(($nama_dr != '')?$nama_dr:'&nbsp;').'</td>
    </tr>
    <tr>
      <td>Penerima Informasi</td>
      <td>: </td>
      <td colspan="4">'.(($info_ranap_penerima_info != '')?$info_ranap_penerima_info:'&nbsp;').'</td>
    </tr>
    <tr>
      <td>Hubungan dengan pasien</td>
      <td>: </td>
      <td colspan="4">'.(($info_ranap_hubungan != '')?$info_ranap_hubungan:'diri sendiri / orang tua kandung / anak kandung / suami / istri / wali *)').'</td>
    </tr>
    <tr>
      <td colspan="6" style="font-size:8px;"> &nbsp; &nbsp; </td>
    </tr>
</table>
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem">
    <th class="txc" width="150" colspan="2"> &nbsp; JENIS INFORMASI</th>
    <th class="txc" colspan="3" style="border-left:3px solid white; padding-left:3px;"> ISI INFORMASI</th>
    <th class="txc" width="110" style="border-left:3px solid white; padding-left:3px;"> TANDA( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/> )/<br>TANDA TANGAN</th>
  </tr>
  <tr class="">
    <td rowspan="2">1. </td>
    <td class="" rowspan="2">Pelayanan yang ditawarkan</td>
    <td class="" colspan="3">Rawat Inap untuk kebutuhan :</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td class=""><img src="'.IMG.'banner/'.((strpos($info_ranap_kebutuhan,'1') !== false)?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Preventif </td>
    <td class="" colspan="2">: '.((strpos($info_ranap_kebutuhan,'1') !== false)? $info_ranap_isian:'__________________________________').'<td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class=" ">
    <td class="">&nbsp;</td>
    <td class="">&nbsp;</td>
    <td class=""><img src="'.IMG.'banner/'.((strpos($info_ranap_kebutuhan,'2') !== false)?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Kuratif</td>
    <td class="" colspan="2">: '.((strpos($info_ranap_kebutuhan,'2') !== false)?$info_ranap_isian:'__________________________________').'</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class=" ">
    <td class="">&nbsp;</td>
    <td class="">&nbsp;</td>
    <td class=""><img src="'.IMG.'banner/'.((strpos($info_ranap_kebutuhan,'3') !== false)?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Rehabilitatif</td>
    <td class="" colspan="2">: '.((strpos($info_ranap_kebutuhan,'3') !== false)?$info_ranap_isian:'__________________________________').'</td>
    <td class=" ">&nbsp;</td>
  </tr>
  <tr class=" ">
    <td class="">&nbsp;</td>
    <td class="">&nbsp;</td>
    <td class=""><img src="'.IMG.'banner/'.((strpos($info_ranap_kebutuhan,'4') !== false)?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Paliatif</td>
    <td class="" colspan="2">: '.((strpos($info_ranap_kebutuhan,'4') !== false)?$info_ranap_isian:'__________________________________').'</td>
    <td class=" ">&nbsp;</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="">&nbsp;</td>
    <td class="">Keterangan </td>
    <td class="" colspan="2">: '.(($info_ranap_keterangan != '')?$info_ranap_keterangan:'__________________________________').'</td>
    <td class=" ln33">&nbsp;</td>
  </tr>
  
  <tr class="">
    <td class="bdt" rowspan="3">2. </td>
    <td class="bdt" rowspan="3">Hasil pelayanan yang diharapkan</td>
    <td class=" bdt"><img src="'.IMG.'banner/'.(($info_ranap_hasil_pelayanan == '1')?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Perbaikan Kondisi</td>
    <td class="bdt" colspan="2"> </td>
    <td class="bdt">&nbsp;</td>
  </tr>
  <tr class="">
    <td class=""><img src="'.IMG.'banner/'.(($info_ranap_hasil_pelayanan == '2')?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Pencegahan Perburukan</td>
    <td class="" colspan="2"> </td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td class=""><img src="'.IMG.'banner/'.(($info_ranap_hasil_pelayanan_lain != '')?'square14_check':'square14_uncheck').'.png" width="12" height=""/> Lainnya</td>
    <td class="" colspan="2">: '.(($info_ranap_hasil_pelayanan_lain != '')?$info_ranap_hasil_pelayanan_lain:'__________________________________').'</td>
    <td class="ln33">&nbsp;</td>
  </tr>
  <tr class="">
    <td class="bdt" rowspan="8">3. </td>
    <td class="bdt" style="" rowspan="8">
      DPJP<br />(Dokter Penanggung Jawab Pelayanan)
    </td>
    <td class="bdt ">
      <u>Sesuai Jadwal</u>
    </td>
    <td class="bdt " colspan="2"> </td>
    <td class="bdt ">&nbsp;</td>
  </tr>
  <tr class="">
    <td style="padding-left:50px;">
      DPJP Utama
    </td>
    <td class="" colspan="2">: &nbsp;'.(($info_ranap_dpjp1_jadwal != '')?$info_ranap_dpjp1_jadwal:'_______________________________').'</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td style="padding-left:50px;">DPJP Lain</td>
    <td class="" colspan="2">: 1. '.(($info_ranap_dpjp2_jadwal != '')?$info_ranap_dpjp2_jadwal:'_______________________________').'</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td >&nbsp;</td>
    <td class="" colspan="2">&nbsp; 2. '.(($info_ranap_dpjp3_jadwal != '')?$info_ranap_dpjp3_jadwal:'_______________________________').'</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td class="">
      <u>Permintaan keluarga</u>
    </td>
    <td class="" colspan="2"> </td>
    <td class=" ">&nbsp;</td>
  </tr>
  <tr class="">
    <td style="padding-left:50px;">
      DPJP Utama
    </td>
    <td class="" colspan="2">: &nbsp;'.(($info_ranap_dpjp1_permintaan != '')?$info_ranap_dpjp1_permintaan:'_______________________________').'</td>
    <td class=" ">&nbsp;</td>
  </tr>
  <tr class="">
    <td style="padding-left:50px;">DPJP Lain</td>
    <td class="" colspan="2">: 1. '.(($info_ranap_dpjp2_permintaan != '')?$info_ranap_dpjp2_permintaan:'_______________________________').'</td>
    <td class="">&nbsp;</td>
  </tr>
  <tr class="">
    <td >&nbsp;</td>
    <td class="" colspan="2">&nbsp; 2. '.(($info_ranap_dpjp3_permintaan != '')?$info_ranap_dpjp3_permintaan:'_______________________________').'</td>
    <td class="ln33">&nbsp;</td>
  </tr>
  <tr class="">
    <td class="bdt ln25">4. </td>
    <td class="bdt ln25">Ruang rawat inap</td>
    <td class="bdt" colspan="3">'.(($info_ranap_bangsal != '')?$info_ranap_bangsal:'Medikal / Bedah / Isolasi / Anak / Rawat Gabung / Kamar Bersalin /<br />PICU-NICU/ ICU-ICCU / Umum*)').'</td>
    <td class="bdt ln25">&nbsp;</td>
  </tr>
</table>
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%">
    <tr class="">
      <td class="bdt" width="500">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan atau berdiskusi.</td>
      <td class="bdt txc" style="background-image:url(\''.IMG.'ttd/'.$kd_dr.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;height:55;">
        Pemberi Informasi<br /><br />'.(($nama_dr != '') ? $nama_dr : '________________________<br />Tanda tangan & Nama Terang').'
      </td>
    </tr>
    <tr class="">
      <td class="bdt bdb">Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana di atas yang saya beri  tanda (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) / paraf di kolom kanannya, dan telah memahaminya.</td>
      <td class="bdt bdb txc">Penerima Informasi<br /><br />'.((!empty($info_ranap_penerima_info)) ? $info_ranap_penerima_info : '________________________<br />Tanda tangan & Nama Terang').'</td>
    </tr>
</table>
  ';
  $html .= '
<br /><font style="font-size:11px;">&nbsp; <br /><br /></font>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <th class="ln25 bg-burem" colspan="4">PERSETUJUAN PELAYANAN RAWAT INAP</th>
    </tr>
    <tr class="">
      <td class="" colspan="4"><font style="font-size:4px;">&nbsp; <br /></font>Yang bertandatangan dibawah ini, saya : </td>
    </tr>
    <tr class="">
      <td class="" width="188px">Nama</td>
      <td class="" colspan="3">: '.(!empty($info_ranap_penerima_info)?$info_ranap_penerima_info:'_______________________________________________________').'</td>
    </tr>
    <tr class="">
      <td class="">Jenis Kelamin</td>
      <td  colspan="2">: '.(!empty($info_ranap_penerima_jenkel)?$info_ranap_penerima_jenkel:'LAKI-LAKI / PEREMPUAN *)').'</td>
      <td class="" width="150">Umur : '.(!empty($info_ranap_penerima_umur)?$info_ranap_penerima_umur:'_____ thn').'</td>
    </tr>
    <tr>
      <td class="">Alamat</td>
      <td class="" colspan="3">: '.(!empty($info_ranap_penerima_alamat)?$info_ranap_penerima_alamat:'_______________________________________________________').'</td>
    </tr>
    <tr>
      <td class="">Hubungan dengan pasien</td>
      <td class="" colspan="3">: '.(!empty($info_ranap_hubungan)?$info_ranap_hubungan:'diri sendiri / orang tua kandung / anak kandung / suami / istri / wali *)').'</td>
    </tr>
    <tr>
      <td class="" colspan="4">Dengan ini menyatakan <b>PERSETUJUAN</b> terhadap pelayanan yang digunakan.</td>
    </tr>
</table>
';
$html .= '
<table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <td class="" align="right"><br />Klaten, '.(!empty($registered_tgl)?$registered_tgl.' Jam  '.$registered_jam." WIB":'___ / ___ / ___ &nbsp; Jam : __ : ___ WIB ').' &nbsp;&nbsp;&nbsp; </td>
    </tr>
</table>
';
$info_ranap_penerima_info2 = "________________________"; 
$html .= ' 
<table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class=" " align="center">Saksi pihak RS</td>
      <td class="" align="center">'.
      // 'Saksi pihak pasien'.
      '</td>
      <td class="" align="center">Yang menyatakan,</td>
    </tr>
    <tr class="">
      <td class="" align="center" style="background-image:url(\''.IMG.'ttd/'.$info_ranap_saksi.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;height:50px;">
      <br /><br />'.((!empty($nama_info_ranap_saksi)) ? '<br />'.$nama_info_ranap_saksi.'<br />&nbsp; ' : '________________________<br />Tanda tangan & Nama Terang').'</td>
      <td class="" align="center">'.
      // '<br /><br />'.((!empty($info_ranap_penerima_info)) ? '<br />'.$info_ranap_penerima_info2 : '________________________<br />Tanda tangan & Nama Terang').' '.
      '</td>
      <td class="" align="center" style="background-image:url(\''.IMG.'ttdz/'.$kd_dr.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;height:55;"><br /><br />'.((!empty($info_ranap_penerima_info)) ? '<br />'.$info_ranap_penerima_info : '________________________<br />Tanda tangan & Nama Terang').'</td>
    </tr>
    <tr class="">
      <td class="" align="left" colspan="3"><b>Keterangan : </b><br />*) coret yang tidak perlu <br /><br /></td>
    </tr>
</table>
';

// $html .= '
// <br /><font style="font-size:11px;">&nbsp; <br /><br /></font>
// <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
//     <tr class="">
//       <th class="ln25 bg-burem" colspan="4">PERSETUJUAN PELAYANAN RAWAT INAP</th>
//     </tr>
//     <tr class="">
//       <td class="" colspan="4"><font style="font-size:4px;">&nbsp; <br /></font>Yang bertandatangan dibawah ini, saya : </td>
//     </tr>
//     <tr class="">
//       <td class="" width="188px">Nama</td>
//       <td class="" colspan="3">: '.(!empty($ranap)?$ranap['pjawab']:'_______________________________________________________').'</td>
//     </tr>
//     <tr class="">
//       <td class="">Jenis Kelamin</td>
//       <td  colspan="2">: '.(!empty($ranap)?change_jkel($ranap['jenis_kel_pjawab']):'LAKI-LAKI / PEREMPUAN *)').'</td>
//       <td class="" width="150">Umur : '.(!empty($ranap)?$ranap['umur_pjawab']:'_____ thn').'</td>
//     </tr>
//     <tr>
//       <td class="">Alamat</td>
//       <td class="" colspan="3">: '.(!empty($ranap)?$ranap['almjawab']:'_______________________________________________________').'</td>
//     </tr>
//     <tr>
//       <td class="">Hubungan dengan pasien</td>
//       <td class="" colspan="3">: '.(!empty($ranap)?$ranap['hubjawab']:'diri sendiri / orang tua kandung / anak kandung / suami / istri / wali *)').'</td>
//     </tr>
//     <tr>
//       <td class="" colspan="4">Dengan ini menyatakan <b>PERSETUJUAN</b> terhadap pelayanan yang digunakan.</td>
//     </tr>
// </table>
// ';
// $html .= '
// <table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
//     <tr>
//       <td class="" align="right"><br />Klaten, '.(!empty($ranap)?tampiltanggal($ranap['tgl_ri'], 9).' Jam  '.substr($ranap['jam_ri'], 0, 5)." WIB":'___ / ___ / ___ &nbsp; Jam : __ : ___ WIB ').' &nbsp;&nbsp;&nbsp; </td>
//     </tr>
// </table>
// ';
// $html .= ' 
// <table class="" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
//     <tr class="">
//       <td class=" " align="center">Saksi pihak RS</td>
//       <td class="" align="center">Saksi pihak pasien</td>
//       <td class="" align="center">Yang menyatakan,</td>
//     </tr>
//     <tr class="">
//       <td class="" align="center"><br /><br />'.((!empty($ranap)) ? '<br />'.$nama_petugas.'<br />&nbsp; ' : '________________________<br />Tanda tangan & Nama Terang').'</td>
//       <td class="" align="center"><br /><br />'.((!empty($ranap)) ? '<br /> &nbsp; ' : '________________________<br />Tanda tangan & Nama Terang').'</td>
//       <td class="" align="center"><br /><br />'.((!empty($ranap)) ? '<br />'.$ranap['pjawab'].'<br />&nbsp; ' : '________________________<br />Tanda tangan & Nama Terang').'</td>
//     </tr>
//     <tr class="">
//       <td class="" align="left" colspan="3"><b>Keterangan : </b><br />*) coret yang tidak perlu <br /><br /></td>
//     </tr>
// </table>
// ';



$pdf->WriteHTML($html);

$file = DOC_FILE;
if($pdf_type == 'F') {
  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');
  
  if($ip == '::1') $ip = '127.0.0.1';
  if($ipclient != '') { $ip = $ipclient; }

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
  $pdf->Output($file, $pdf_type);
  
  if (!empty($lp_print)) {
    if ($printer != "") {
      $cmd = "lp $file -d $printer";
      shell_exec($cmd);
    }
    $data=array(
      "status" => true, 
      "pdf" => $file, 
      "printer" => $printer
    );
    echo json_encode($data); 
  }  else {
    $data=array(
      "status" => true, 
      "pdf" => $file
    );
    echo json_encode($data); 
  }
} else {
  $pdf->Output($file, $pdf_type);
}
?>