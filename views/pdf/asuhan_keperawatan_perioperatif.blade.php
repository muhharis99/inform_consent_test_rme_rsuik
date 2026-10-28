<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 30, 15, 1, 6, 'P');
$pdf->SetTitle('FM/RM/07.7 - '.$no_reg);
$pdf->SetSubject('ASUHAN KEPERAWATAN PERIOPERATIF');
$pdf->SetKeywords('RS Islam Klaten, ASUHAN KEPERAWATAN PERIOPERATIF');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/07.7</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>ASUHAN KEPERAWATAN<br>PERIORATIF</b></td>
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
      background-color: #bebebe;
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
    .ln22 {
      line-height:20px;
      font-size:15px;
    }
    .ln21 {
      line-height:21px;
    }
 
    .ln23 {
      line-height:23px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln22 {
      line-height:22px;
      font-size:15px;
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

  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 3;
for($i=0; $i<$jml_row; $i++) {
  $spasi1 .= '&nbsp;'; 
}

$jml_check = 1;
for($i=0; $i<$jml_check; $i++) {
  $checkbox .= '<img src="'.IMG.'banner/'.(($belajar->kooperatif == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>'; 
}
$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bdl bdr bdt">
      <td class="ln22">&nbsp; Tanggal Operasi </td>
      <td class="ln22" width="2px"> : </td>
      <td class="ln22" colspan="8">&nbsp;  30-05-2022 </td>
    </tr>
    <tr class="bdl bdr bdt">
      <th class="ln22 bg-burem" colspan="10"> Data Struktural </th>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22 bg-burem1" colspan="10">&nbsp;  Catatan perkembangan pasien </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22" width="150px">&nbsp;  dr. Anesthesi </td>
      <td class="ln22" width="2px"> : </td>
      <td class="bdr ln22"> XXX </td>
      <td class="bdr txc ln22" colspan="4"> Jenis Anesthesi </td>
      <td class="bdr ln22"> Mulai : </td>
      <td class="bdr ln22"> 18:35 </td>
      <td class="bdr ln22"> ASA </td>
      
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22">&nbsp;  Perawat Anesthesi </td>
      <td class="ln22" width="2px"> : </td>
      <td class="bdr ln22"> XXX </td>
      <td class="ln22"> '.$checkbox.' GA </td>
      <td class="ln22"> '.$checkbox.' RA </td>
      <td class="ln22"> '.$checkbox.' LA </td>
      <td class="bdr ln22"> '.$checkbox.' lain2... </td>
      <td class="bdr ln22"> Selesai : </td>
      <td class="bdr ln22"> 20 : 20 </td>
      <td class="bdr ln22"> C </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22" colspan="10"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22">&nbsp;   dr. Bedah 1 </td>
      <td class="ln22" width="2px"> : </td>
      <td class="bdr ln22"> XXX </td>
      <td class="ln22" width="90px"> Asisten 1 </td>
      <td class="bdr ln22">: xx </td>
      <td class="ln22"> Instrumentator </td>
      <td class="bdr ln22">: xx </td>
      <td class="bdr ln22"> Mulai : </td>
      <td class="bdr ln22"> 20 : 20 </td>
      <td class="bdr ln22"> OK </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22">&nbsp;   dr. Bedah 2 </td>
      <td class="ln22" width="2px"> : </td>
      <td class="bdr ln22"> XXX </td>
      <td class="ln22"> Asisten 2 </td>
      <td class="bdr ln22">: xx </td>
      <td class="ln22"> Sirkuler </td>
      <td class="bdr ln22">: xx </td>
      <td class="bdr ln22"> Selesai : </td>
      <td class="bdr ln22"> 20 : 20 </td>
      <td class="bdr ln22"> C </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22" colspan="10"> &nbsp; </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdl ln22" colspan="3" width="15px">&nbsp;   Diagnosis pre operasi </td>
      <td class="ln22" width="2px" align="right"> : </td>
      <td class="bdr ln22" colspan="6"> Cholelihans </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22" colspan="3">&nbsp;   Tindakan Operasi </td>
      <td class="ln22" width="2px" align="right"> : </td>
      <td class="bdr ln22" colspan="6"> Cholelihans </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22" colspan="3">&nbsp;   Diagnosis pasca operasi </td>
      <td class="ln22" width="2px" align="right"> : </td>
      <td class="bdr ln22" colspan="6"> Cholelihans </td>
    </tr>
    <tr class="bdl bdr bdt">
      <th class="ln22 bg-burem" colspan="10"> ASUHAN KEPERAWATAN PRA BEDAH </th>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22" colspan="10">&nbsp; '.$checkbox.' Verifikasi Check List Keselamatan Operasi / <i>Surgical safety checklist</i> '.$spasi1.'</td>
    </tr>
</table>
  ';
$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdl bdr bdt">
      <th class="bdr ln22 bg-burem" width="350px"> 1. Resiko cedera b/d transport dan transfer </th>
      <th class="bdr ln22 bg-burem"> 2. Resiko cemas d/b kurang pengetahuan dan stress akan pembedahan </th>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22"> &nbsp;  
      '.$checkbox.' Identifikasi pasien '.$spasi1.'
      '.$checkbox.' Persetujuan 
      '.$spasi1.'
      '.$checkbox.' Lokasi<br>
      &nbsp; Alergi : 
      '.$checkbox.' Tidak '.$spasi1.'
      '.$checkbox.' Ya '.$spasi1.'
      '.$checkbox.' Penitilin <br>
      &nbsp; Puasa _______ jam 
      </td>
      <td class="bdr ln22" width="2px">&nbsp;  Status psikologis : <br>
      &nbsp; '.$checkbox.' Tenang '.$spasi1.''.$checkbox.' Gelisah '.$spasi1.''.$checkbox.' Banyak bicara '.$spasi1.''.$checkbox.' Nangis <br>
      &nbsp; '.$checkbox.' Lelah '.$spasi1.''.$checkbox.' lain2...</td>
    </tr>

    <tr class="bdl bdr bdt">
      <td class="bdr ln22"> 
        &nbsp; kesadaran : <br>&nbsp; '.$checkbox.' sadar '.$spasi1.''.$checkbox.' ngantuk '.$spasi1.''.$checkbox.' sedasi tidur<br>
        &nbsp; '.$checkbox.' tidak respon '.$spasi1.''.$checkbox.' disorientasi <br>
        &nbsp; '.$checkbox.' Lain2... 
      </td>
      <td class="bdr ln22" rowspan="3">&nbsp;  '.$checkbox.' Berikan penjelasan sesuai umur <br>
      &nbsp; '.$checkbox.' Komunikaasikan perhatian pasien pada tim op <br>
      &nbsp; '.$checkbox.' Beritahu urutan dan kegiatan perioperatif <br>
      &nbsp; '.$checkbox.' Evaluasi respon atas penjelasan  </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="ln22">&nbsp;  Kulit : <br>&nbsp; '.$checkbox.' dingin '.$spasi1.''.$checkbox.' hangat '.$spasi1.''.$checkbox.' utuh '.$spasi1.''.$checkbox.' kering<br>
        &nbsp; '.$checkbox.' lembab '.$spasi1.''.$checkbox.' perhiasan di lepas <br>
        &nbsp; '.$checkbox.' Tato... </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22" rowspan="2">&nbsp;  Kerusakan sensori : <br>&nbsp; '.$checkbox.' tidak ada '.$spasi1.''.$checkbox.' bahasa<br>&nbsp; '.$checkbox.' pendengaran '.$spasi1.''.$checkbox.' penglihatan</td>
    </tr>
    <tr class="bdl bdr bdt">
       <th class="ln15 bg-burem">3. Resiko nyeri akut/kronik</th>
    </tr>

    <tr class="bdl bdr bdt">
      <td class="bdr ln22"> 
        &nbsp;  Status muskuloskelatal : <br>&nbsp; '.$checkbox.' normal '.$spasi1.''.$checkbox.' traksi '.$spasi1.''.$checkbox.' palaris 
      </td>
      <td class="bdr ln22" rowspan="3">&nbsp; '.$checkbox.' Instruksikan penggunaan nyeri <br>
      &nbsp; '.$checkbox.' Pengkajian nyeri, skala nyeri.....<br>&nbsp;  Lokasi.....<br>&nbsp; Keluaran <br>
      &nbsp; '.$checkbox.' Menggunakan/indikasi penurunan kecemasan,<br>&nbsp;  kemampuan koping, prosedur operasi bisa di pahami <br>
      &nbsp; '.$checkbox.' Manajemen nyeri adekuat <br>
      &nbsp; '.$checkbox.' Menyatakan kenyamanan transfer/transport </td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22">&nbsp; Prostesa/alat bantu : <br>&nbsp; '.$checkbox.' alat dengar '.$spasi1.''.$checkbox.' kaca mata <br>&nbsp;  '.$checkbox.' prostesa 
        '.$spasi1.' '.$checkbox.' tidak ada</td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln22">&nbsp;  Status cardiopulmonal Edema perifer : <br>&nbsp; '.$checkbox.' tidak '.$spasi1.''.$checkbox.' ya lokasi...</td>
    </tr>
    <tr class="bdl bdr bdt bdb">
      <td class="bdr ln22">&nbsp;  Respirasi : <br>&nbsp; '.$checkbox.' tracheostomi '.$spasi1.''.$checkbox.' intubasi '.$spasi1.''.$checkbox.' WSD <br>&nbsp; '.$checkbox.' sesak '.$spasi1.''.$checkbox.' Normal '.$spasi1.''.$checkbox.' lain2...</td>
      <td class="bdr ln22">&nbsp;  Transfer ke kamar operasi dengan : <br>&nbsp; '.$checkbox.' brankard '.$spasi1.''.$checkbox.' kursi roda '.$spasi1.''.$checkbox.' bed <br>&nbsp; '.$checkbox.' Lain2...</td>
    </tr>
</table>
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