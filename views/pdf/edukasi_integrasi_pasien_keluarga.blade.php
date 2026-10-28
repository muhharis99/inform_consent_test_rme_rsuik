<?php

define('DOC_REVISI', 'Revisi : 4');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/19'); 
define('DOC_TITLE', 'FORMULIR EDUKASI TERINTEGRASI PASIEN DAN KELUARGA'); 
define('DOC_FILE', 'Formulir-Edukasi-Terintegrasi-Pasien-Dan-Keluarga.pdf'); 
define('DOC_SUBJECT', 'Formulir Edukasi Terintegrasi Pasien dan Keluarga'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 10, 'calibri', 15, 5, 50, 20, 5, 6, 'P');
$repHeader = '
<table border="0" cellpadding="0" cellspacing="0" style="margin-left:1px; margin-right:1px; font-size:14px;" width="100%">
  <thead>
    <tr class="bg-burem" style="background-color:#bebebe;">
              <td rowspan="2" class="txc bdt bdr bdb bdl b" width="55px">Tgl &<br /> Jam Edukasi</td>
              <td rowspan="2" class="txc bdt bdr bdb b" width="180px">Materi edukasi berdasarkan kebutuhan</td>
              <td rowspan="2" class="txc bdt bdr bdb b">Kode leaflet</td>
              <td rowspan="2" class="txc bdb bdr bdt b" width="50px">Lama edukasi (menit)</td>
              <td rowspan="2" class="txc bdb bdr bdt b" width="80px">Hasil Verifikasi</td>
              <td rowspan="2" class="txc bdb bdr bdt b" width="100px">Tgl Re-edukasi/<br />Re-demonstrasi</td>
              <td colspan="2" class="txc bdb bdr bdt b" width="">Paraf dan nama</td>
            </tr>
            <tr class="bg-burem" style="background-color:#bebebe;">
              <td class="bdb bdr txc b" width="70px">Pemberi edukasi</td>
              <td class="bdb bdr txc b" width="100px">Pasien/keluarga (hubungan)</td>
            </tr>
  </thead>
</table>';
$subHeader = '
<div style="font-size:10px;"><br /></div>'.$repHeader;
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$pdf->AddPage('P','','','','',15,5,35,20,5,6);

$css_style = '
  <style type="text/css">
  
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
  .lhs {
    line-height:14px;
  }
  .fl {
    float:left;
    border:0px solid #bebebe;
    margin-left:-1px;
  }
  .ml-0 {
    margin-left:0px;
  }
  .txc {
    text-align:center;
  }
  .txr {
    text-align:right;
  }
  .bg-s {
    background-color:#DC4D35;
  }
  .bg-y {
    background-color:yellow;
  }
  .bg-b {
    background-color:blue;
  }
  .pb-s {
    padding-bottom:5px;
  }
  .b {
    font-weight:bold;
  }
  .bg-row {
    background-color:#FEFAFB;
  }
  .fa { font-family: fontawesome; }
  .ct-num {
    font-weight:bold;
    text-decoration:underline;
  }
  .ct-var {
    font-weight:bold;
  }
  .ct-dot {
    font-weight:bold;
    width:5;
  }
  .def-table {
    // font-size:12px; line-height:12px;
  }
  .def-table tr td {
    vertical-align:top;
  }
  .def-table-del {
    font-size:12px; line-height:12px;
  }
  .def-table-del tr td {
    vertical-align:top; text-decoration: line-through !important;
  }
  .lnxs {
    line-height:10px !important;
  }
  .tvt {
    vertical-align:top !important;
  }
  table.ln-strike tr td, table.ln-strike tr td table tr td {
    text-decoration: line-through !important;
  }
  .bdt {
    border-top:0.5px solid black;
  }
  .bdr {
    border-right:0.5px solid black;
  }
  .bdb {
    border-bottom:0.5px solid black;
  }
  .bdl {
    border-left:0.5px solid black;
  }
  .b, .b td {
    font-weight:bold;
  }
  .lnx {
    line-height:15px;
  }
    .lnh td { line-height:25px; }
    .fn-main { font-size:15px; }
    .fam { font-size:11px; }
    .fa1 { padding-top:4px; }
  </style>';
$pdf->WriteHtml($css_style);
/**
 * <font class="fa" size="2"> &#xf046; </font> checked
 * <font class="fa" size="2"> &#xf096; </font> unchecked
 * http://192.168.0.16/serverx/admisi/pdf/edukasi_integrasi_pasien_keluarga/0705914/20260213101639
 */
$html_hambatan = $css_style.'
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="fn-main" style="background-color:white;">
  <tbody>
    <tr class="bg3 b lnh">
      <td width="30">&nbsp; A.</td>
      <td colspan="4">PENGKAJIAN KEBUTUHAN EDUKASI</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="4">
        <u>Data Pasien :</u>
      </td>
    </tr>
    <tr>
      <td>
      </td>
      <td>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="tvt" style="">
          <tbody>
            <tr>
              <td width="26">1. </td><td width="164">Tinggal bersama</td><td width="10">:</td> 
                <td width="20" class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['tinggal']??'', 'anak')!==false?'4':'9').'6; </font> </td><td width="160">Anak</td>
                <td width="20" class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['tinggal']??'', 'orang tua')!==false?'4':'9').'6; </font></td><td width="160">Orang tua</td>
                <td width="20" class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['tinggal']??'', 'sendiri')!==false?'4':'9').'6; </font> </td><td width="">Diri sendiri</td>
            </tr>
            <tr>
              <td>&nbsp; </td><td> &nbsp;</td><td>&nbsp; </td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['tinggal']??'', 'suami')!==false?'4':'9').'6; </font> </td><td>Suami/istri</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['tinggal']??'', 'lain')!==false?'4':'9').'6; </font></td><td colspan="3">Lainnya : '.(stripos($edukasi['tinggal']??'', 'lain')!==false?$edukasi['tinggal_lain']??'':'').'</td>
            </tr>
            <tr>
              <td>2. </td><td> Hambatan</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(strlen($edukasi['fiko']??'')>0?'4':'9')).'6; </font> </td><td>Ada</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(strlen($edukasi['fiko']??'')>0?'9':'4')).'6; </font></td><td colspan="3">Tidak </td>
            </tr>
            <tr>
              <td>&nbsp; </td><td> &nbsp;</td><td>&nbsp; </td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'gangguan pendengaran')!==false?'4':'9').'6; </font> </td><td>Gangguan pendengaran</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'gangguan penglihatan')!==false?'4':'9').'6; </font> </td><td>Gangguan penglihatan</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'gangguan bicara')!==false?'4':'9').'6; </font> </td><td>Gangguan bicara</td>
            </tr>
            <tr>
              <td>&nbsp; </td><td> &nbsp;</td><td>&nbsp; </td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'gangguan emosi')!==false?'4':'9').'6; </font> </td><td>Gangguan emosi</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'motivasi buruk')!==false?'4':'9').'6; </font> </td><td>Motivasi kurang/buruk</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'memori hilang')!==false?'4':'9').'6; </font> </td><td>Memori hilang</td>
            </tr>
            <tr>
              <td>&nbsp; </td><td> &nbsp;</td><td>&nbsp; </td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'fisik lemah')!==false?'4':'9').'6; </font> </td><td>Fisik lemah</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'perokok')!==false?'4':'9').'6; </font> </td><td>Perokok aktif/pasif</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['fiko']??'', 'alkohol')!==false?'4':'9').'6; </font> </td><td>Alkoholik</td>
            </tr>
            <tr>
              <td>3. </td><td> Kondisi fisiologis</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['fiko']??'', 'tidak mampu belajar')!==false?'9':'4')).'6; </font> </td><td>Mampu belajar</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['fiko']??'', 'tidak mampu belajar')!==false?'4':'9')).'6; </font></td><td colspan="3">Tidak mampu belajar </td>
            </tr>
            <tr>
              <td>4. </td><td> Edukasi diberikan kepada</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['kepada']??'', 'anak')!==false?'4':'9').'6; </font> </td><td>Anak</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['kepada']??'', 'orang tua')!==false?'4':'9').'6; </font> </td><td>Orang tua</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['kepada']??'', 'sendiri')!==false?'4':'9').'6; </font> </td><td>Diri sendiri</td>
            </tr>
            <tr>
              <td>&nbsp; </td><td> &nbsp;</td><td>&nbsp; </td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['kepada']??'', 'suami')!==false?'4':'9').'6; </font> </td><td>Suami/istri</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['kepada']??'', 'lainnya')!==false?'4':'9').'6; </font></td><td colspan="3">Lainnya : '.(stripos($edukasi['kepada']??'', 'lain')!==false?$edukasi['kepada_lain']??'':'').'</td>
            </tr>
            <tr>
              <td>5. </td><td> Kemampuan bahasa</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['bahasa_hari']??'', 'indonesia')!==false?'4':'9').'6; </font> </td><td>Indonesia</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['bahasa_hari']??'', 'jawa')!==false?'4':'9').'6; </font> </td><td>Daerah</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['bahasa_hari']??'', 'lain')!==false?'4':'9').'6; </font> </td><td>Asing</td>
            </tr>
            <tr>
              <td>6. </td><td> Perlu penerjemah</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['bahasa_penerjemah']??'', 'ya')!==false?'4':'9')).'6; </font> </td><td>Ya</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['bahasa_penerjemah']??'', 'tidak')!==false?'4':'9')).'6; </font> </td><td colspan="3">Tidak</td>
            </tr>
            <tr>
              <td>7. </td><td> Baca dan tulis</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['badik_baca']??'', 'tidak')!==false?'9':'4')).'6; </font> </td><td>Ya</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(empty($edukasi)?'9':(stripos($edukasi['badik_baca']??'', 'tidak')!==false?'4':'9')).'6; </font> </td><td colspan="3">Tidak</td>
            </tr>
            <tr>
              <td>8. </td><td> Kepercayaan lainnya</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['nilai_ada']??'', 'ya')!==false?'4':'9').'6; </font> </td><td>Ya</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['nilai_ada']??'', 'tidak')!==false?'4':'9').'6; </font> </td><td colspan="3">Tidak</td>
            </tr>
            <tr>
              <td>9. </td><td> Kesediaan menerima edukasi</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['infedu_sedia']??'', 'ya')!==false?'4':'9').'6; </font> </td><td>Ya</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['infedu_sedia']??'', 'tidak')!==false?'4':'9').'6; </font> </td><td colspan="3">Tidak</td>
            </tr>
            <tr>
              <td>10. </td><td> Cara menerima edukasi</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['infedu_cara']??'', 'lisan')!==false?'4':'9').'6; </font> </td><td>Lisan</td>
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($edukasi['infedu_cara']??'', 'tulis')!==false?'4':'9').'6; </font> </td><td colspan="3">Tulisan</td>
            </tr>
            <tr>
              <td>11. </td><td> Kebutuhan edukasi</td><td>:</td> 
                <td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_partisipasi')!==false?'4':'9').'6; </font> </td><td colspan="5">Hak untuk berpartisipasi pada proses pelayanan</td>wa
            </tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_penunjang')!==false?'4':'9').'6; </font> </td><td colspan="5">Prosedur pemeriksaan penunjang</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_kondisi')!==false?'4':'9').'6; </font> </td><td colspan="5">Kondisi kesehatan, diagnosis pasti dan penatalaksanaanya</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_informed')!==false?'4':'9').'6; </font> </td><td colspan="5">Proses pemberian <i>informed consent</i></td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_efek_samping')!==false?'4':'9').'6; </font> </td><td colspan="5">Penggunaan obat secara efektif dan aman, efek samping serta interaksinya</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_alat')!==false?'4':'9').'6; </font> </td><td colspan="5">Penggunaan alat medis yang aman</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_diet')!==false?'4':'9').'6; </font> </td><td>Diet dan nutrisi</td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_rehab')!==false?'4':'9').'6; </font> </td><td>Teknik rehabilitasi</td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_rokok')!==false?'4':'9').'6; </font> </td><td>Bahaya merokok</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_nyeri')!==false?'4':'9').'6; </font> </td><td>Manajemen nyeri</td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_cuci')!==false?'4':'9').'6; </font> </td><td>Cuci tangan yang benar</td><td class="fa1"><font class="fa fam"> &#xf0'.(stripos($kebutuhan_edukasi??'', 'edu_rujukan')!==false?'4':'9').'6; </font> </td><td>Rujukan edukasi</td></tr>
            <tr><td colspan="3"> &nbsp; </td><td class="fa1"><font class="fa fam"> &#xf0'.(trim($kebutuhan_edukasi_lain??'')!=''?'4':'9').'6; </font> </td><td colspan="5">Lainnya : '.($kebutuhan_edukasi_lain??'').'</td></tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr><td colspan="5">&nbsp; </td></tr>
    <tr><td colspan="5">&nbsp; </td></tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="fn-main" style="background-color:white;">
  <tbody>
    <tr class="bg3 b lnh">
      <td width="30">&nbsp; B.</td>
      <td colspan="4">EDUKASI</td>
    </tr>
    <tr><td colspan="5">&nbsp; </td></tr>
  </tbody>
</table>

'.$repHeader;
$pdf->WriteHtml($html_hambatan); 

$width = [
  'tanggal'    => 19,
  'ppa'        => 19,
  'kode'       => 6,
  'mark'       => 68,
  'instruksi'  => 46,
  'verifikasi' => 32
];
$h = 4;
$pdf->SetMargins(15, 5, 49.5, 20);        // left, right, top

$pdf->text_input_as_HTML = true;
$pdf->use_kwt = true;
$pdf->autoPageBreak = true;
$pdf->shrink_tables_to_fit=0;
$pdf->SetFont('calibri', 13);

if (!empty($rows)) {
  $no = 1; 
  foreach ($rows as $key=>$row) {
    $pdf->SetFillColor(255,255,255);
    if ($no % 2 == 0) $pdf->SetFillColor(240,255,240);
    $catatan = $instruksi = $verifikasi = $materi = $hasil = $leaflet = $tgl_re = $lama = $penerima = ''; 
    $materi .= $row['materi'];
    $lama .= $row['lama'];
    $leaflet .= $row['leaflet'];
    // $hasil .= $row['hasil'];
    $hasil .= $row['str_hasil'];
    $tgl_re .= $row['str_tgl_hasil']!=""?$row['str_tgl_hasil']:"-";
    $penerima .= $row['penerima'];
    // $row['sign']= null;
    $pdf->WriteHtml('
    <table class="'.($no % 2 == 0?'bg-row':'').' '.(!empty($row['deleted'])&&$row['deleted']!=''?'ln-strike':'').'" style="padding-top:0px; paddin-bottom:5px; page-break-inside: auto; font-size:14px; margin-left:1px; margin-right:1px;" cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
    <td class="lhs tvt txc fl ml-0" width="55" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0.5px; font-size:10px;">'.substr($row['str_tgl_pengkajian'], 0, 10).'<br />'.substr($row['str_tgl_pengkajian'],  -8).'</td>
    <td class="lhs tvt txl fl" width="180" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; ">'.$materi.'</td>
    <td class="lhs tvt txl fl" width="80" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; padding:2px;">'.(implode('<br />', str_split($leaflet, 9))).'</td>
    <td class="lhs tvt txc fl" width="51" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; ">'.$lama.'</td>
    <td class="lhs tvt txl fl" width="80" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; padding:2px;" >'.$hasil.'</td>
    <td class="lhs tvt txc fl" width="100" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; padding:2px;">'.$tgl_re.'</td>
    <td class="lhs tvt txl fl" width="73" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; padding:2px; font-size:10px; ">'.(!empty($row['petugas'])?''.$row['petugas']:'&nbsp; ').(!empty($row['userttd'])?'<br /><img src="'.ASSETS.'public/img/ttd/'.($row['userttd']??'no-ttd').'.jpg" width="50" />':'').'<br />'.($row['userttdx']??'').'</td>
    
    <td class="lhs tvt txl fl" width="" style="border:0.5px solid black; border-width:0 0.5px 0.5px 0; padding:2px;">'.$penerima.'<br />'.(!empty($row['sign'])?(safeBase64Image($row['sign'])?'<img src="'.$row['sign'].'" width="50" />':''):'').'</td>
    </tr></table>
    ');
    $no ++;
  }
}


if (safeBase64Image($image)) {
    $html .= '<img src="'.$image.'" width="120">';
} else {
    $html .= '<div>No Image</div>';
}
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