<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; .
define('DOC_TITLE', 'CHECKLIST SERAH TERIMA PASIEN OPERASI');
define('DOC_NOMER', 'FM/RM/23.1'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
// require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle('FM/RM/23.1- '.$no_reg);
$pdf->SetSubject('CHECKLIST KESELAMATAN PASIEN (SURGICAL SAFETY CHECKLIST)');
$pdf->SetKeywords('RS Islam Klaten, CHECKLIST KESELAMATAN PASIEN (SURGICAL SAFETY CHECKLIST)');

if (!empty($tgl_lahir)) {
  $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'');
  if (!empty($warning_sama)) {
    // if ($no_reg=='0620128') {

      $no_reg = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$no_reg.'</td><td> &nbsp; </td></tr></table>';
      $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir));
      $str_tgl_lahir = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$str_tgl_lahir.'</td><td>'.($umur!=''?' ( '.$umur.' )':'').'</td></tr></table>';
    // }
  }
}
$pdf->SetHTMLHeader('
<table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
  <tbody>
    <tr>
      <td align="left" width="300">RSU ISLAM KLATEN</td>
      <td align="right" width="" style="text-align:right;"> <b>FM/RM/23.1</b></td>
      <td align="right" width="100" style="">Hal {PAGENO}/ {nbpg}</td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
  <tbody>
    <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
    <tr>
    <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
    <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>CHECKLIST SERAH TERIMA PASIEN OPERASI</b></td>
    <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
    </tr>
    <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').' '.(!empty($jenis_kel)?'('.$jenis_kel.')':'').'</td></tr>
    <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
    <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? $str_tgl_lahir : '').'</td></tr>
    <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
    <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
  </tbody>
</table>
  ');
  $pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 10</td><td width="" align="right">Tanggal Terbit : 01 Agustus 2022</td></tr></tbody></table>
  ');
  $pdf->AddPage('L');
$pdf->SetFont('calibri', 13);
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
      font-size:14px;
    }
    .ln21 {
      line-height:21px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:25px;
      font-size :14px;
    }
    .ln26 {
      line-height:26px;
      font-size :14px;
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
      font-size:14px;
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
       border-left: 0.5px solid grey;
    }
    .bdr {
       border-right: 0.5px solid grey;
    }
    .bdt {
       border-top: 0.5px solid grey;
    }
    .bdb {
       border-bottom: 0.5px solid grey;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .custom-text {
      font-size:15px;
      line-height:21px;
    }

  </style>
'; 
// $html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
  ';
$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
     <td class="custom-text bg-burem txc b">SEBELUM OPERASI</td>
      <td class="custom-text bg-burem txc b">SETELAH OPERASI</td>
  </tr>
</table>
';
$html .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
     <td class="custom-text" width="150px">&nbsp; <i><b>Situation</b></i></td>
      <td class="custom-text" width="2px">:</td>
      <td class="bdr custom-text" colspan="3">____________________________________________</td>
      <td class="custom-text" width="150px">&nbsp; <i><b>Situation</b></i></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3">____________________________________________</td>
  </tr>
  <tr class="">
      <td class="custom-text" width="100px">&nbsp; <i><b>Background</b></i></td>
      <td class="custom-text" width="2px">:</td>
      <td class="bdr custom-text" colspan="3">____________________________________________</td>
      <td class="custom-text" width="100px">&nbsp; <i><b>Background</b></i></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3">____________________________________________</td>
  </tr>
  <tr class="">
     <td class="">&nbsp; KU</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Baik</td>
      <td class="custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Sedang</td>
      <td class="bdr custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Jelek</td>
      <td class="custom-text">&nbsp; KU</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Baik</td>
      <td class="custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Sedang</td>
      <td class="custom-text" width="140px"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Jelek</td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; GCS</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">E : __</td>
      <td class="custom-text">M : __</td>
      <td class="bdr custom-text">V: __</td>
      <td class="custom-text">&nbsp; Laporan Anestesi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lengkap</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak___________</td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; RPD</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Atsma</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Alergi</td>
      <td class="bdr custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Penicilin</td>
      <td class="custom-text">&nbsp; Score Pemulihan</td>
      <td class="" width="2px">:</td>
      <td class="custom-text"> Aldrete : ______</td>
      <td class="custom-text"> Steward : ______</td>
      <td class="custom-text"> Bromage : ______</td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Vital Sign</td>
      <td class="custom-text" width="2px">:</td>
      <td class="bdr custom-text" colspan="3">TD : ____ mmHg, N : ____ x/mnt, R : ____ x/mnt, S : ____ °C</td>
      <td class="custom-text">&nbsp; Vital Sign</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3">TD : ____ mmHg, N : ____ x/mnt, R : ____ x/mnt, Spo2 : ____ </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; dr. Operator</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="bdr custom-text" colspan="2">dr. Anestesi : _____________</td>
      <td class="custom-text">&nbsp; Askep Perioperatif</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> lengkap</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Identitasi Formulir</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Sesuai</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
      <td class="bdr custom-text">( RM dan Form IBS )</td>
      <td class="custom-text">&nbsp; Checklist Keselamatan</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> lengkap</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Gelang Pasien</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> ada</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text">&nbsp; Operasi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Penandaan Lokasi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> ada</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak Ada</td>
      <td class="bdr custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak Perlu </td>
      <td class="custom-text">&nbsp; Laporan Operasi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> lengkap</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Asesmen pra anastesi<br>&nbsp; Asesmen pra bedah<br>&nbsp; Informasi Consent</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Lengkap<br>
      <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>  Lengkap<br>
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Bedah</td>


      <td class="custom-text">
      <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>  Tidak<br>
      <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>  Tidak<br>
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> lengkap</td>
      <td class="bdr custom-text"> &nbsp;<br>&nbsp;<br>
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text">&nbsp; Pengantar PA</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ada</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text" width="2px"> &nbsp; </td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Anestesi</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> lengkap</td>
      <td class="bdr custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text">&nbsp; Material Operasi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ada/Label</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp;  Antibiotik Profilaksis</td>
      <td class="custom-text" width="2px"> :</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya</td>
      <td class="bdr custom-text">Jam : _____________</td>
      <td class="custom-text">&nbsp; Sisa Jaringan Tubuh</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="2"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Perlu Perawatan Jenazah</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>Tidak Perlu</td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Darah / Golongan </td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="bdr custom-text" colspan="2">Jumlah _____________ Kolf</td>
      <td class="custom-text">&nbsp; Resep</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ada</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Hb SAg</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Positif</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Negatif</td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text">&nbsp; Instruksi Post Operasi</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="">&nbsp; HCV</td>
      <td class="" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Positif</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Negatif</td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text" style="padding-left:10px;"><li> dr. Operator</li></td>
      <td class="custom-text"> : </td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ada</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; HIV</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Positif</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Negatif</td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text" style="padding-left:10px;"><li> dr. Anestesi</li></td>
      <td class="custom-text"> : </td>
      <td class="custom-text">  <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ada</td>
      <td class="custom-text"> <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak</td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; RO</td>
      <td class="custom-text" width="2px">:</td>
      <td class="bdr custom-text" colspan="3">
        ____ Lembar, CT Scan : ______ Lembar, USG : ____ Lembar
      </td>
      <td class="custom-text">&nbsp; Darah</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3"> Dimasukkan _____________ kolf, Diserahkan : _____________ kolf</td>
  </tr>
  
  <tr class="">
      <td class="custom-text">&nbsp; Sholat yang terdekat</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3"> 


      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Subuh &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Dzuhur &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> `Asar &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Magrib &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Isya &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak Ada

      </td>
    
      <td class="bdl custom-text">&nbsp; RO</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3"> ____ Lembar, CT Scan : _____ Lembar, USG : ___ Lembar</td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp;</td>
      <td class="custom-text" width="2px">:</td>
      <td class="bdr custom-text" colspan="3">
      </td>
      <td class="custom-text">&nbsp; Sholat yg ditinggalkan </td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text" colspan="3"> 


      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Subuh &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Dzuhur &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> `Asar &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Magrib &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Isya &nbsp;&nbsp;
      <img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak Ada

      </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Lain-lain</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"> _____________ </td>
      <td class="custom-text"> &nbsp; </td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text">&nbsp; Lain-lain</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"> _____________ </td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text">&nbsp; Hasil Kritical</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> TTV</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> RO</td>
      <td class="bdr custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lab : ________</td>
      <td class="custom-text">&nbsp; Hasil Kritical</td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> TTV</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> RO</td>
      <td class="custom-text"><img src="'.IMG.'banner/'.(($checklist->serahterima == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lab : ________</td>
  </tr>
  <tr class="">
      <td class="custom-text"><b>&nbsp; Assesment</b></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text"><b>&nbsp; Assesment</b></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="custom-text"><b>&nbsp; Recomendation</b></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="bdr custom-text"> &nbsp; </td>
      <td class="custom-text"><b>&nbsp; Recomendation</b></td>
      <td class="custom-text" width="2px">:</td>
      <td class="custom-text">_____________</td>
      <td class="custom-text"> &nbsp; </td>
      <td class="custom-text"> &nbsp; </td>
  </tr>
  <tr class="">
      <td class="bdr custom-text txr" colspan="5" style="padding-right:10px;">Tanggal, ___/___/______ &nbsp; Pukul ___:___ WIB </td>
      <td class="custom-text txr" colspan="5" style="padding-right:10px;">Tanggal, ___/___/______ &nbsp; Pukul ___:___ WIB </td>
  </tr>
  <tr class="">
      <td class="txc custom-text" colspan="3">Yang menyerahkan,<br>Perawat Radar/Rajal/Ranap/Intensif<br><br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
      <td class="bdr txc custom-text" colspan="2">Yang menerima<br>Perawat IBS<br><br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
      <td class="txc custom-text" colspan="3">Yang menyerahkan,<br>Perawat IBS<br><br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
      <td class="txc custom-text" colspan="2">Yang menerima<br>Perawat Radar/Rajal/Ranap/Intensif<br><br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
  </tr>
</table>
  ';

$html .='

';
// $html .= ' 
// <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  // <tr class="bdl bdr bdt bdb">
  //     <td class="bdr" text-rotate="90" width="5px" rowspan="7"> RISIKO RENDAH (RR) </td>
  //     <td class="bdr"> 1 </td>
  //     <td class="bdr" colspan="2" width="300px"> Orientasi Lingkungan </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  //     <td class="bdr"> &nbsp; </td>
  // </tr>
//     <tr class="bdl bdr bdt bdb">
//       <td class="bdr"> 2 </td>
//       <td class="bdr" colspan="2"> Pastikan Bel mudah dijangkau </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr" width="39px"> &nbsp; </td>
//   </tr>
//   <tr class="bdl bdr bdt bdb">
//       <td class="bdr"> 2 </td>
//       <td class="bdr" colspan="2"> Pastikan Bel mudah dijangkau </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//   </tr>
// </table>
// ';
$html .= ' 

';
// $html .= ' 

// ';
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


$file = "soap_inap_resume_20220618.pdf";
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
  $file = $dir."soap_inap_resume_20220618.pdf";
}
$pdf->Output($file, $pdf_type);
?>