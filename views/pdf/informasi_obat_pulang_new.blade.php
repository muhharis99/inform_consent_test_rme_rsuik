<?php

define('DOC_NOMER', 'FORM/FAR/17'); 
define('DOC_TITLE', 'FORM EDUKASI OBAT PULANG'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 15, 5, 6, 'L');
require_once dirname(__FILE__) . '/mpdf/hfrm_logo.php';
$pdf->SetTitle(''.$no_reg);
$pdf->SetSubject('Informasi Edukasi Obat Pulang');
$pdf->SetKeywords('RS Islam Klaten, Edukasi Obat Pulang');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 23 Juni 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
$pdf->AddPage('L');
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
    // table {
    //   width:100%;
    //   font-size:12px;
    //   page-break-inside: avoid;
    // }
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
    .custom-text {
      font-size :14px;
    }
  </style>
'; 
// $html .='<br>';

$jml_td = 15;
for($i=0; $i<$jml_td; $i++) {
  $print_td .= '<td width=""> &nbsp; </td>'; 
}

$jml_row = 7;
if (!empty($obat_pulang)) {
  $no = 1;
  foreach ($obat_pulang as $obat) {
    $print_tr .= '<tr class="bdl bdr bdb">
    <td class="bdr ln30 custom-text txc">'.$no.'</td>
    <td class="bdr ln30 custom-text">'.$obat['nama_obat'].'</td>
    <td class="bdr ln30 custom-text txc">'.$obat['aturan_pakai'].'</td>
    <td class="bdr ln30 custom-text">'.$obat['indikasi'].'</td>
    <td class="bdr ln30 custom-text txc">'.$obat['jml'].'</td>
    <td class="bdr ln30 custom-text txc">'.($obat['pagi'] == 1 ? 'V' : '').'</td>
    <td class="bdr ln30 custom-text txc">'.($obat['siang'] == 1 ? 'V' : '').'</td>
    <td class="bdr ln30 custom-text txc">'.($obat['sore'] == 1 ? 'V' : '').'</td>
    <td class="bdr ln30 custom-text txc">'.($obat['malam'] == 1 ? 'V' : '').'</td>
    <td class="bdr ln30 txc custom-text">'.$obat['sbw'].'</td>
    <td class="bdr ln30 custom-text">'.$obat['keterangan'].'</td>
  </tr>'; 
  $no++;
  }
}else{
  for($i=0; $i<$jml_row; $i++) {
    $print_tr .= '<tr class="bdl bdr bdb">
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
    <td class="bdr ln30 txc custom-text"> S/B/W</td>
    <td class="bdr ln30 custom-text">&nbsp;</td>
  </tr>'; 
  }
}

$null = 40;
for($i=0; $i<$null; $i++) {
  $print_null .= '&nbsp;'; 
}
$html .= '
<table border="0" style="font-size:12px;" cellspacing="0" cellpadding="0">
    <tr>
      <td class="txl b custom-text" width="220">Berat / Tinggi : '.$tb.' / '.$bb.'</td>
      <td class="txl b custom-text"style="color:red" width="750">Alergi : <i style="color:red">'.$alergi.'</i></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
</table>
<table border="0" style="font-size:9px;" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt">
      <th class="bdr ln23 bg-burem custom-text" width="25">NO</th>
      <th class="bdr bg-burem custom-text custom-text" width="240px">NAMA OBAT</th>
      <th class="bdr bg-burem custom-text" width="100px">ATURAN PAKAI</th>
      <th class="bdr bg-burem custom-text" width="150px">INDIKASI</th>
      <th class="bdr bg-burem custom-text" width="80px">JUMLAH</th>
      <th class="bdr bg-burem custom-text" width="50px">Pagi</th>
      <th class="bdr ln30 bg-burem custom-text" width="50px">Siang</th>
      <th class="bdr bg-burem custom-text" width="50px">Sore</th>
      <th class="bdr bg-burem custom-text" width="50px">Malam</th>
      <th class="bdr bg-burem custom-text" width="130px">WAKTU PEMAKAIAN</th>
      <th class="bdr bg-burem custom-text" width="125px">INSTRUKSI KHUSUS</th>
    </tr>
    '.$print_tr.'
    
</tr>
  </tbody>
</table>
  ';

  $html .= '<br>
  <table border="0" style="font-size:12px;" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td> &nbsp; </td>
            <td> &nbsp; </td>
            <td class="ln30 txl custom-text">'.$print_null.'Klaten, ______________</td>
        </tr>
        <tr>
            <td width="300" class="txc custom-text">PETUGAS FARMASI YG MENYERAHKAN</td>
            <td width="380"> &nbsp; </td>
            <td width="300" class="txl custom-text">'.$print_null.'YANG MENERIMA</td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttds/'.$no_reg.'.jpgx\'); display:none; background-repeat:no-repeat; background-size:100px; background-position:left;height:110px;">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_kedua_nama!=''?$akad->pihak_kedua_nama:'(_____________________________)'):'(_____________________________)').'
            </td>
            <td> &nbsp; </td>
            <td width="300" class="txr" style="background-image:url(\''.IMG.'ttds/'.$no_reg.'.jpg\'); display:none; background-repeat:no-repeat; background-size:25% 25%; background-position:left;height:110px;">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />'.$print_null.'
                '.(!empty($akad)?($akad->pihak_pertama_nama!=''?$akad->pihak_pertama_nama:'(_____________________________)'):'(_____________________________)').'
            </td>
        </tr>
    </tbody>
  </table>
  ';

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