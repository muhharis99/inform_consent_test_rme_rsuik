<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/04.5'); 
define('DOC_FILE', 'Pengkajian-dan-Intervensi-Resiko-Jatuh-Pasien-Neonatus.pdf'); 
define('DOC_TITLE', 'PENGKAJIAN DAN INTERVENSI<br>RESIKO JATUH<br>PADA PASIEN <i>Neonatus</i>'); 
define('DOC_SUBJECT', 'Pengkajian dan Intervensi Resiko Jatuh Pasien Neonatus'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 6, 5, 6, 'P');
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
      page-break-inside: avoid;
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
      line-height:25px;
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
      font-size:15px;
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
    .custom-text {
      font-size:14px;
    }
    .tvm {
      vertical-align:middle;
    }
    .lns {
      line-height:14px; 
      padding:3px 3px;
      height:35px;
      vertical-align:middle;
    }
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}

$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <th class="custom-text" align="center">SEMUA NEONATUS DIKATEGORIKAN RESIKO TINGGI (RT)</th>
    </tr>
    <tr class="">
      <td class="" align="center"> &nbsp; </td>
    </tr>
</table>
';
$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="bdt bdr bdb bdl b txc tvm custom-text bg-burem" rowspan="2" colspan="2">INTERVENSI PENCEGAHAN PASIEN JATUH<br>Beri tanda (<img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) pada tindakan yang di lakukan</td>
      <td class="bdt bdr bdb b txc tvm bg-burem custom-text" colspan="9">TANGGAL / JAM</td>
    </tr>
    <tr class="">
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns" width="20">1.</td>
      <td class="bdr bdb lns custom-text" width="280">Orientasi ruangan pada orang tua / keluarga</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns custom-text">2.</td>
      <td class="bdr bdb lns custom-text">Dekatkan box bayi dengan ibu</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns custom-text">3.</td>
      <td class="bdr bdb lns custom-text">Pastikan selalu ada pendamping</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">4.</td>
      <td class="bdr bdb lns custom-text">Pastikan lantai dan alas kaki tidak licin</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">5.</td>
      <td class="bdr bdb lns custom-text">Kontrol rutin oleh petugas</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">6.</td>
      <td class="bdr bdb lns custom-text">Bila dirawat di inkubator pastikan semua jendela terkunci</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">7.</td>
      <td class="bdr bdb lns custom-text">Edukasi orang tua / keluarga</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr>
      <td colspan="11" class="ln5"><br />&nbsp;<br />&nbsp; </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="bdt bdr bdb bdl b txc tvm custom-text bg-burem" rowspan="2" colspan="2">EDUKASI YANG DIBERIKAN </td>
      <td class="bdt bdr bdb b txc tvm bg-burem custom-text" colspan="9">TANGGAL / JAM</td>
    </tr>
    <tr class="">
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns" width="20">1.</td>
      <td class="bdr bdb lns custom-text" width="280">Tempatkan bayi pada tempat yang aman</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns custom-text">2.</td>
      <td class="bdr bdb lns custom-text">Tehnik menggendong bayi</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl lns custom-text">3.</td>
      <td class="bdr bdb lns custom-text">Cara membungkus bayi</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">4.</td>
      <td class="bdr bdb lns custom-text">Segera instirahat bila mereka lelah dan tempatkan bayi pada boxnya</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr class="">
      <td class="bdb bdl  lns custom-text">5.</td>
      <td class="bdr bdb lns custom-text">Libatkan keluarga untuk mendampingi atau segera panggil perawat/bidan jika dibutuhkan</td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
      <td class="bdr bdb lns custom-text"> &nbsp; </td>
    </tr>
    <tr>
      <td colspan="11" class="ln5">&nbsp; </td>
    </tr>
</table>

<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="">&nbsp; <b>SASARAN EDUKASI</b></td>
      <td class="" colspan="4">
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ibu / Bapak <br>
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Keluarga lain <br>
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Wali <br>
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lainnya ______________
      </td>
    </tr>
    <tr><td colspan="5" class="ln5"><br />&nbsp; </td></tr>
    <tr class="">
      <td class="">&nbsp; <b>EVALUASI</b></td>
      <td class="" colspan="4">
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Memahami dan mampu mendemonstrasikan <br>
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Mengerti <br>
      &nbsp;<img src="'.IMG.'banner/'.(($pengkajian->rj == '2')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Perlu edukasi ulang <br>
      </td>
    </tr>
    <tr><td colspan="5" class="ln5"><br />&nbsp;<br />&nbsp;<br />&nbsp; </td></tr>
</table>
  ';
$dpjp_id = "";
$perawat_id = "";
$dpjp_nama = "";
$dpjp_nama = "";
$perawat = "";
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td width="200" class="txc" style="background-image:url(\''.IMG.'ttd/'.$dpjp_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
              Keluarga
              <br />
              <br />
              <br />
              '.($dpjp_nama!=''?$dpjp_nama:'_________________________________').'
              <br />
              Tanda tangan dan nama terang
            </td>
            <td width="" class="txc" style="background-image:url(\''.IMG.'ttd/'.$perawat_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
              
            </td>
            <td width="200" class="txc" style="background-image:url(\''.IMG.'ttd/'.$perawat_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
              Petugas
              <br />
              <br />
              <br />
              '.($perawat!=''?$perawat:'_________________________________').'
              <br />
              Tanda tangan dan nama terang
            </td>
        </tr>
    </tbody>
  </table>'; 

// $html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
// <tbody>
//   <tr class="">
//     <td class="" width="100px" hight="200px">Revisi: 1</td>
//     <td class="" colspan="2"> &nbsp; </td>
//     <td class="" colspan="3">Tanggal terbit : '.date('d-m-Y').'</td>
//   </tr>
// </tbody>
// </table>';

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

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
  $pdf->Output($file, $pdf_type);
  if (!empty($lp_print)) {
    $cmd = "lp $file -d $printer";
    shell_exec($cmd);
    $data=array(
      "status" => true, 
      "pdf" => $file, 
      "printer" => $printer
    );
    echo json_encode($data); die();
  }  
} else {
  $pdf->Output($file, $pdf_type);
}
?>