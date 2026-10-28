<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO';
define('DOC_REVISI', ' ');
define('DOC_TERBIT', 'Dicetak : '.date("d/m/Y H:i:s"));
define('DOC_NOMER', ''); 
define('DOC_TITLE', 'SENSUS WAKTU TUNGGU <br />ADMISI RAWAT INAP'); 
define('DOC_SUBJECT', 'Sensus Label Triase GD'); 
define('DOC_FILE', 'Sensus-Label-Triase-GD.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 9, 'calibri', 5, 5, 30, 14, 5, 6, 'P'); 
$pdf->SetTitle('Sensus Label Triase GD');
$pdf->SetSubject(DOC_SUBJECT);
$pdf->SetKeywords('RS Islam Klaten, '.DOC_SUBJECT);
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txc" style="text-align:left; vertical-align:middle; font-size:13px; line-height:13px; " ><b>'.DOC_TITLE.'</b></td>
      </tr>
      <tr>
        <td class="txc" style="text-align:left; vertical-align:middle; font-size:14px; line-height:13px; " ><b>Tanggal : '.$tanggal1.' s.d '.$tanggal2.'</b></td>
      </tr>
      <tr><td style="line-height:3px; border-bottom:0px solid black;"> &nbsp; </td></tr>
    </tbody>
  </table>
  <table border="0" cellpadding="1" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:1px; border-bottom:0px solid black;"> &nbsp; </td></tr>
      <tr>
        <th width="28" style="border:1px solid black; border-width:1px 0;">NO</th>
        <th width="65" style="border:1px solid black; border-width:1px 0 1px 0;">TANGGAL</th>
        <th width="150" style="border:1px solid black; border-width:1px 0 1px 0; text-align:left;">TOTAL WAKTU TUNGGU</th>
        <th width="150" style="border:1px solid black; border-width:1px 0 1px 0; text-align:right; padding-right:15px;">JUMLAH PASIEN</th>
        <th style="border:1px solid black; border-width:1px 0 1px 0; text-align:left;">RATA-RATA WAKTU TUNGGU</th>
        <th style="border:1px solid black; border-width:1px 0 1px 0; text-align:left;">KETERANGAN </th>
      </tr>
      <tr><td colspan="6" style="line-height:1px; border-bottom:0px solid black;"> &nbsp; </td></tr>
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">'.DOC_REVISI.'</td><td align="right">'.DOC_TERBIT.'</td></tr></tbody></table>
');
$pdf->shrink_tables_to_fit = 1;
// $pdf->SetFont('calibri', 11);
$pdf->AddPage();
// $pdf->WriteCell(0, 4, 'DAFTAR PASIEN', 'B', 2, "L", FALSE); $pdf->Ln(3);

$arr_header = array(  'NO', 'TANGGAL',  'WAKTU TUNGGU',  'TOTAL', '', 'RATA-RATA');
$arr_width = array(    8,    16,         50,              27,      2,  21,      23,       24,      32);
$num_headers = count($arr_header);
$pdf->SetFillColor(190, 190, 190);
/*
for($i = 0; $i < $num_headers; ++$i) {
  $pdf->WriteCell($arr_width[$i], 0, $arr_header[$i], '0', 0, "L", TRUE);
}
*/
// $pdf->WriteCell(0, 0, " ", 'B', 0, "L", FALSE);
// $pdf->Ln(4);
$no = 1; 
/*
foreach ($content as $row) {
  $pdf->SetFillColor(WHITE);
  $row = (object) $row;
  $nama_1 = " "; 
  if (substr($row->nama_pasien, 0, 20)) {
    $nama_1 = SUBSTR(ucwords(strtoupper($row->nama_pasien)), 0, 20);
  } else {
    $nama_1 = $row->nama_pasien; 
  }
  $pdf->WriteCell($arr_width[0], 0, "$no.", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[1], 0, "$row->no_reg", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[2], 0, "$nama_1", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[3], 0, "$row->str_tgl_lahir", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[4], 0, "$row->str_tgl_kunjung", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[5], 0, "$row->str_tgl_triase", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[6], 0, strtoupper("$row->label"), 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[7], 0, strtoupper("$row->tinlan"), 0, 0, "L", FALSE);  
  $pdf->Ln(3);
  $nama_2 = " "; 
  $nama_perawat = " "; 
  if (substr($row->nama_pasien, 20, 22)) {
    $nama_2 = TRIM(SUBSTR(ucwords(strtoupper($row->nama_pasien)), 20, 22));
  }
  if ($row->perawat != '') {  
    $nama_perawat = "PERAWAT : $row->perawat"; 
  }
  $pdf->WriteCell($arr_width[0], 0, " ", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[1], 0, " ", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[2], 0, "$nama_2", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[3], 0, "$row->umur", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[4], 0, " ", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[5], 0, "$nama_perawat", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[6], 0, " ", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[7], 0, " ", 0, 0, "L", FALSE);  
  $pdf->Ln(4);
  $no ++; 
}
*/
// $pdf->WriteCell(0, 0, 'NO', 0, 2, "L", FALSE);

foreach ($rows_sensus as $row) {
  $pdf->SetFillColor(WHITE);
  $row = (object) $row;
  $nama_1 = " "; 
  if (substr($row->nama_pasien, 0, 20)) {
    $nama_1 = SUBSTR(ucwords(strtoupper($row->nama_pasien)), 0, 20);
  } else {
    $nama_1 = $row->nama_pasien; 
  }
  $pdf->WriteCell($arr_width[0], 0, "$no.", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[1], 0, "$row->tanggal", 0, 0, "R", FALSE); 
  $pdf->WriteCell($arr_width[2], 0, "$row->waktu MENIT", 0, 0, "L", FALSE); 
  $pdf->WriteCell($arr_width[3], 0, "$row->pasien", 0, 0, "R", FALSE);  
  $pdf->WriteCell($arr_width[4], 0, " ", 0, 0, "R", FALSE);  
  $pdf->WriteCell($arr_width[5], 0, "$row->rata MENIT", 0, 0, "L", FALSE);  
  $pdf->Ln(4);
  $no ++; 
}
/* daftar pasien */ 
if ($kategori=='sensus_daftar') {
  $pdf->SetHTMLHeader('
    <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
      <tbody>
        <tr>
          <td align="left" width="300">RSU ISLAM KLATEN</td>
          <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
          <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
      <tbody>
        <tr><td style="line-height:5px;"> &nbsp; </td></tr>
        <tr>
          <td class="txc" style="text-align:left; vertical-align:middle; font-size:13px; line-height:13px; " ><b>DAFTAR PASIEN <br />ADMISI RAWAT INAP</b></td>
        </tr>
        <tr>
          <td class="txc" style="text-align:left; vertical-align:middle; font-size:14px; line-height:13px; " ><b>Tanggal : '.$tanggal1.' s.d '.$tanggal2.'</b></td>
        </tr>
        <tr><td style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
      <tbody>
        <tr><td colspan="8" style="line-height:1px; border-bottom:0px solid black;"> &nbsp; </td></tr>
        <tr>
          <th width="28">No</th>
          <th width="55" align="left">No RM</th>
          <th width="150" align="left">Nama Pasien</th>
          <th width="70" align="left">Tanggal</th>
          <th width="120" align="left">Mulai Admisi</th>
          <th width="122" align="left">Selesai Admisi</th>
          <th width="100" align="left">Respon Time</th>
          <th align="left">Keterangan</th>
        </tr>
        <tr><td colspan="8" style="line-height:1px; border-bottom:1px solid black;"> &nbsp; </td></tr>
      </tbody>
    </table>
  ');
  $pdf->SetHTMLFooter('
    <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">'.DOC_REVISI.'</td><td align="right">'.DOC_TERBIT.'</td></tr></tbody></table>
  ');
  $pdf->AddPage();
  $arr_header = array(  'NO', 'NO RM',  'NAMA', 'TGL LAHIR',  'DAFTAR', 'TRIASE', 'LABEL',  'TIND. LANJUT');
  $arr_width = array(   8,    13,       40,     18,           32,       32,       12,       25);
  $num_headers = count($arr_header);

  $no = 1; 
  foreach ($content as $row) {
    $pdf->SetFillColor(WHITE);
    $row = (object) $row;
    $nama_1 = " "; 
    if (substr($row->nama_pasien, 0, 20)) {
      $nama_1 = SUBSTR(ucwords(strtoupper($row->nama_pasien)), 0, 20);
    } else {
      $nama_1 = $row->nama_pasien; 
    }
    $pdf->WriteCell($arr_width[0], 0, "$no.", 0, 0, "R", FALSE); 
    $pdf->WriteCell($arr_width[1], 0, "$row->no_reg", 0, 0, "R", FALSE); 
    $pdf->WriteCell($arr_width[2], 0, "$nama_1", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[3], 0, "$row->str_tgl_kunjung", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[4], 0, "$row->str_tgl_mulai", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[5], 0, "$row->str_tgl_selesai", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[6], 0, strtoupper("$row->str_respon_time"), 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[7], 0, strtoupper(""), 0, 0, "L", FALSE);  
    $pdf->Ln(3);
    $nama_2 = " "; 
    $nama_perawat = " "; 
    if (substr($row->nama_pasien, 20, 22)) {
      $nama_2 = TRIM(SUBSTR(ucwords(strtoupper($row->nama_pasien)), 20, 22));
    }
    if ($row->perawat != '') {  
      $nama_perawat = "PERAWAT : $row->perawat"; 
    }
    $pdf->WriteCell($arr_width[0], 0, " ", 0, 0, "R", FALSE); 
    $pdf->WriteCell($arr_width[1], 0, " ", 0, 0, "R", FALSE); 
    $pdf->WriteCell($arr_width[2], 0, "$nama_2", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[3], 0, "$row->umur", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[4], 0, " ", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[5], 0, " ", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[6], 0, "$row->petugas", 0, 0, "L", FALSE); 
    $pdf->WriteCell($arr_width[7], 0, " ", 0, 0, "L", FALSE);  
    $pdf->Ln(4);
    $no ++; 
  }

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