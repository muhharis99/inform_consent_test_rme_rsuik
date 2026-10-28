<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 15, 5, 6, 'P');
$pdf->SetTitle('FM/RM/06.3.1 - '.$no_reg);
$pdf->SetSubject('PENGKAJIAN PRA SEDASI DAN ANESTESI');
$pdf->SetKeywords('RS Islam Klaten, PENGKAJIAN PRA SEDASI DAN ANESTESI');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/06.3.1</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PENGKAJIAN PRA SEDASI DAN ANESTESI</b></td>
        <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
      </tr>
      <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
      <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
      <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
      <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
      <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 23 Juni 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
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
      font-size:14px;
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .text2 {
     writing-mode: vertical-lr;
    }
    .custom-text {
      font-size:14px;
    }

  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 4;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= '&nbsp;'; 
}
$html .= '
<table cellspacing="0" border="" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdt bdl bdr">
      <th class="txc custom-text bg-burem bdr" rowspan="8" width="30px"> S </th>
      <td class="ln21" width="10px">'.$print_tr.'Riwayat Penyakit Dahulu </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Jantung</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Hipertensi</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Stroke</td>
      <td class="ln21" width="50px"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> DM</td>
      <td class="ln21" colspan="4" align="left"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Asma</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21"> &nbsp; </td>
      <td class="ln21"> &nbsp; </td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Kejang</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> kanker</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> TBC</td>
      <td class="ln21" colspan="5"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lain-lain ____________</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21"> &nbsp; </td>
      <td class="ln21"> &nbsp; </td>
      <td class="ln21" colspan="8"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak ada</td>
  </tr>
  <tr class="bdl bdr">
      <td class="ln21" width="200px">'.$print_tr.'Riwayat Penyakit Keluarga </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
 <tr class="bdl bdr">
      <td class="ln21" width="200px">'.$print_tr.'Riwayat Anestesi/Sedasi </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8"> _______________________________________________________</td>
  </tr>
  <tr class="bdl bdr">
      <td class="ln21" width="200px">'.$print_tr.'Riwayat Alergi </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya </td>
      <td class="ln21" colspan="6"> Jenis : __________________________</td>
  </tr>
  <tr class="bdl bdr">
      <td class="ln21" width="200px">'.$print_tr.'Riwayat Merokok </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak </td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Ya </td>
  </tr>
  <tr class="bdl bdr">
      <td class="ln21" width="200px">'.$print_tr.'Makan Terakhir, Jam </td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>


  <tr class="bdt bdl bdr">
    <td class="bdr bg-burem">&nbsp;</td>
      <td class="ln21 bg-burem1" colspan="11">'.$print_tr.'<b>PEMERIKSAAN FISIK</b></td>
  </tr>
    <tr class="bdl bdr">
    <th class="ln21 txc bg-burem bdr" rowspan="18" width="20px"> O </th>
      <td class="ln21">'.$print_tr.'Gigi</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Jalan Nafas</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
    </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Jantung</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Paru</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Ekstremitas</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'BB</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_____________, TB: _____________ </td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Lain-lain</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
  <tr class="bdl bdr">
      <td class="ln21 bg-burem1" colspan="10">'.$print_tr.'<b>PEMERIKSAAN TANDA VITAL</b></td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Tekanan Darah</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Nadi</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Respirasi</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Suhu</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Score Nyeri</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
  <tr class="bdl bdr">
      <td class="bg-burem1" colspan="10">'.$print_tr.'<b>PEMERIKSAAN PENUNJANG</b></td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Laboratorium</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'EKG</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class="bdl bdr">
      <td class="ln21">'.$print_tr.'Radiologi</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Normal</td>
      <td class="ln21" colspan="7"> <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Abnormal</td>
  </tr>
    <tr class=" bdl bdr">
      <td class="ln21">'.$print_tr.'Lain-lain</td>
      <td class="ln21" width="2px"> :</td>
      <td class="ln21" colspan="8">_______________________________________________________</td>
  </tr>
  <tr class="bdt  bdl bdr">
      <th class="ln21 txc bg-burem bdr" width="20px"> A </th>
      <td class="ln30" width="200px" colspan="5">'.$print_tr.'
      <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Setuju &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak Setuju,__________________________ </td>
      <td class="ln30" colspan="5">Klasifikasi ASA : _____________ &nbsp;</td>
  </tr>
<tr class="bdt  bdl bdr">
  <th class="ln21 txc bg-burem bdr" width="20px" rowspan="2"> P </th>
  <td class="ln30 bdr">Jenis Anestesi</td>
  <td class="ln30" colspan="9">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
      <tr>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>General</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Sedasi Ringan</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Sedasi Moderat</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Sedasi Dalam</td>
      </tr>
      <tr>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Regional</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Spinal</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Spidural</td>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td>Blok</td>
      </tr>
      <tr>
        <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> </td>
        <td colspan="7">Teknik khusus jenis : ________________________________</td>
      </tr>
    </table>
  </td>
</tr>
<tr class="bdt  bdl bdr">
  <td class="ln30" colspan="10">
  <table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
      <td>Puasa</td>
      <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
      <td>Pemberian sedasi secara aman</td>
    </tr>
    <tr>
      <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
      <td>Kebutuhan Darah</td>
      <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
      <td>Monitoring selama tindakan</td>
    </tr>
    <tr>
      <td width="2"><img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/></td>
      <td>Kebutuhan Ruang ICU</td>
      <td colspan="2">
        <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>Tidak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="'.IMG.'banner/'.(($assesmen->sedasi == '4')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>Ya
      </td>
    </tr>
  </table>
  
  </td>
  
</tr>
<tr class="bdl bdr bdt bdb">
<td class="bdr ln21 txc" colspan="4">Catatan Khusus : ______________________</td>
<td class="bdr ln21 txc" colspan="7">Klaten, ______ Pukul _______ <br>Dokter Anestesi<br><br><br>(______________________________)<br>Tanda Tangan dan Nama Lengkap</td>
</tr>
  







</table>
  ';
$html .='

  ';
$html .='

';
$html .='

';
// $html .= ' 
// <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
//   <tr class="bdl bdr bdt bdb">
//       <td class="bdr" text-rotate="90" width="5px" rowspan="7"> RISIKO RENDAH (RR) </td>
//       <td class="bdr"> 1 </td>
//       <td class="bdr" colspan="2" width="300px"> Orientasi Lingkungan </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//       <td class="bdr"> &nbsp; </td>
//   </tr>
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