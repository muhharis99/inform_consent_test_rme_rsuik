<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle('FM/RM/23 - '.$no_reg);
$pdf->SetSubject('CHECKLIST KESELAMATAN PASIEN (SURGICAL SAFETY CHECKLIST)');
$pdf->SetKeywords('RS Islam Klaten, CHECKLIST KESELAMATAN OPERASI (SURGICAL SAFETY CHECKLIST)');
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
    <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>CHECKLIST KESELAMATAN OPERASI<br><i>(SURGICAL SAFETY CHECKLIST)</i></b></td>
    <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
    </tr>
    <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
    <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
    <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)): '').'</td></tr>
    <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
    <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
  </tbody>
</table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 4</td><td width="" align="right">Tanggal Terbit : 01 Agustus 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
$pdf->AddPage('L');
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .custom-text {
      font-size:14px;
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
  ';
$html .='
';
$print_tr = '';
$jml_cm = 3;
for($i=0; $i<$jml_cm; $i++) {
  $cm .= '&nbsp;'; 
}
$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <th class="bdl custom-text bg-burem" width="350px" colspan="2"> Sebelum Pasien di Anestesi <i>(SIGN IN)</i></th>
      <th class="bdr custom-text bg-burem" width="350px" colspan="2"> Sebelum Insisi <i>(TIME OUT)</i></th>
      <th class="bdr custom-text bg-burem" width="350px" colspan="2"> Sebelum Pasien Keluar Kamar Operasi <i>(SIGN OUT)</i> </th>
  </tr>
  <tr class="">
    <td class="bdr bdl custom-text" width="350px" colspan="2"><b>Konfirmasi Atau Verifikasi</b> :</td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Kelengkapan tim operasi</b> :</td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Baca secara verbal</b> :</td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Identitasi dan Gelang Pasien, Inform Consent</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Lengkap</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Tindakan yang telah dilakukan, Kelengkapan jumlah kasa<br>'.$cm.'biji/darm dan jarum, Kelengkapan instrumen</td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Tanda daerah operasi</b> : Tidak Perlu</td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Baca secara verbal</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Tampon Tenggorokan</b></td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Rencana pasang implan</b> : Tidak Ada</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Tanggal Operasi, Nama dan Peran Tim Operasi, Identitas<br>'.$cm.'Pasien, Prosedur Operasi, Inform Consent</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Tidak Ada</td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Pemeriksaan Kelengkapan Anestesi</b> : IV Line</td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Apakah antibiotik profilaksis telah diberikan 60 menit sebelum operasi dimulai</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Jaringan atau Cairan Tubuh</b><br>'.$cm.'Sudah diberikan label</td>
  </tr>
   <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Penyakit Gangguan Nafas/Resiko Aspirasi</b></td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Tidak Menggunakan</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'</td>
  </tr>
   <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Tidak ada</td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Foto Radiologi</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Kelengkapan dokumen operasi sebelum pasien keluar dari kamar operasi</b></td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Riwayat alergi</b> : PENICILIN</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'-</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Sudah</td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Premidikasi</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Hal-hal yang harus diperhatikan</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Keterangan</b></td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">Tidak Perlu</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'-</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'-</td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Resiko Pendarahan > 500 cc ( 7 ml/kg bb pada anak )</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Menjaga Aurat</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"><b>Menjaga Aurat</b></td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Ya, Infus dan cairan tersedia</td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Ya </td>
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Ya </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Mengingatkan / Bimbingan sholat</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Ya </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Menjaga Aurat</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Ya </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2"><b>Bimbingan doa sebelum operasi ( Pasien beragama Islam )</b></td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="bdr custom-text" width="350px" colspan="2">'.$cm.'Hasbiyallahu wani`malwakill alallahi tawakkaltu Allahiah<br>'.$cm.'yang mencukupi segala kebutuhan kami dan Dialah,Tuhan<br>'.$cm.'yang paling tepat dipasrahi, dan hanya kepada Allahlah<br>'.$cm.'kami berserah diri </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
    <td class="bdr custom-text" width="350px" colspan="2"> &nbsp; </td>
  </tr>
  <tr class="bdl bdr">
    <td class="txc custom-text" width="100px">Tanggal : 30-05-2022<br>Perawat Ruang Penerimaan<br><br><br>TRI WIDIYASTUTI, AMD, KEP</td>
    <td class="bdr txc custom-text" width="50px">Jam : 18:00<br><br><br><br>DESI SULISTYOWATI, AMK</td>
    <td class="txc custom-text" width="50px">Tanggal : 30-05-2022</td>
    <td class="bdr txc custom-text" width="50px">Jam : 18:50</td>
    <td class="txc custom-text" width="50px">Tanggal : 30-05-2022<br>Perawat Instrumen<br><br><br>PUDJIATI S, AMK</td>
    <td class="bdr txc custom-text" width="50px">Jam : 20:20<br><br><br><br>TRI WIDIYASTUTI, AMD, KEP</td>
  </tr>
</table>
  ';

$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdl bdr bdt">
      <td class="txc custom-text bg-burem b" colspan="2"> Mengetahui </td>
  </tr>
    <tr class="bdl bdr bdt bdb">
      <td class="txc custom-text"> Dokter Anestesi<br><br><br>dr. Joko Purnomo, Sp.An</td>
      <td class="bdr txc custom-text"> Dokter Operator<br><br><br>dr. Wachid Fauzi R, Sp.B., KBD</td>
  </tr>
</table>
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