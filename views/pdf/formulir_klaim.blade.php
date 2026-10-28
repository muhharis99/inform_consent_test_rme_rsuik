<?php
// echo phpinfo(); die();
function change_jkel($val) {
  $sex = '';
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

define('DOC_REVISI', '2');
define('DOC_TERBIT', '1 Desember 2022');
define('DOC_NOMER', 'FORMULIR KLAIM'); 
define('DOC_FILE', 'FORMULIR-KLAIM.pdf');
// if (!empty($sep->noKartu))  
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', array(210, 148), 12, 'sans-serif', 5, 5, 8, 5, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Formulir Klaim');
$pdf->SetKeywords('RSU Islam Klaten, Formulir Klaim');

$pdf->shrink_tables_to_fit = 0;
$row_klaim = (object) null; 
if (!empty($klaim)) {
  foreach ($klaim as $row_klaim) {
    $row_klaim = (object) $row_klaim;
    break; 
  }
}
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
    table {
      font-family:serif;
      font-size:13px;
    }
  </style>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-family: arial;">
  <tbody>
    <tr>
      <td width="" style="font-size:15px; vertical-align:middle;" class="txc b">FORMULIR BPJS</td>
    </tr>
    <tr>
      <td> &nbsp; </td>
    </tr>
  </tbody>
</table>
'; 
$diagnosa = $soap->diagnosa;
if (counts(explode('@@,', $diagnosa, 2)) > 1) {
    $diags    = explode('@@,', $diagnosa, 2)[1];
    $diags    = explode('@@,', $diags);
    $diags  = array_filter($diags);
}
else
{
    $diags = array();
}
if (counts(explode('-', strstr(explode('@@,', $diagnosa, 2)[0], '<ord>', true))) > 0) {
    $diagp  = explode('@@,', $diagnosa, 2)[0];
    $kdiagp = strstr(strstr($diagp, '<ord>', true), '-', true);
} else {
    $diagp  = explode('@@,', $diagnosa, 2)[0];
    $kdiagp = '';
}
$diagnosa      = str_replace('@@,', ', ', $diagnosa);

$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-family: arial;">
  <tbody>
    <tr>
      <td colspan="7">FORMULIR VERIFIKASI</td>
    </tr>
    <tr>
      <td colspan="7">(INA CBG\'S)</td>
    </tr>
    <tr>
      <td class="txr" width="20">1</td>
      <td colspan="3">NO</td>
      <td width="10">:</td>
      <td colspan="2">'.($tanggal!=''?$row_klaim->nomor:'').'</td>
    </tr>
    <tr>
      <td class="txr">2</td>
      <td colspan="3">NAMA RS</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?'RUMAH SAKIT ISLAM KLATEN':'').'</td>
    </tr>
    <tr>
      <td class="txr">3</td>
      <td colspan="3">NOMOR KODE RS</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?'3310384':'').'</td>
    </tr>
    <tr>
      <td class="txr">4</td>
      <td colspan="3">KELAS RS</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?'MADYA / B':'').'</td>
    </tr>
    <tr>
      <td class="txr">5</td>
      <td colspan="3">NO REKAM MEDIS</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?$row_klaim->no_reg:'').'</td>
    </tr>
    <tr>
      <td class="txr">6</td>
      <td width="15">a.</td>
      <td colspan="2">NAMA PASIEN</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?$pasien->nama:'').'</td>
    </tr>
    <tr>
      <td></td>
      <td>b.</td>
      <td colspan="2">ALAMAT PASIEN</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?$pasien->alamat:'').'</td>
    </tr>
    <tr>
      <td class="txr">7</td>
      <td colspan="3">JENIS PERAWATAN</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?str_replace("R.JALAN", "RAWAT JALAN", strtoupper($rawat)):'').'</td>
    </tr>
    <tr>
      <td class="txr">8</td>
      <td colspan="3">TANGGAL MASUK</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?(isset($soap->tgl_masuk)?tampiltanggal($soap->tgl_masuk, 14):''):'').'</td>
    </tr>
    <tr>
      <td class="txr">9</td>
      <td colspan="3">TANGGAL LAHIR</td>
      <td>:</td>
      <td>'.($tanggal!=''?(isset($soap->tgl_lahir)?tampiltanggal($soap->tgl_lahir, 14):''):'').'</td>
      <td rowspan="6" width="200" class="txl" style="background-image:url(\''.IMG.'ttd/'.$row_klaim->dokter_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:left;height:50px;">
      Tanda Tangan
      <br />Dokter Yang Merawat
      <br />
      <br />
      <br />'.($tanggal!=''?getDokterByKode($row_klaim->dokter_id):'').'
      </td>
    </tr>
    <tr>
      <td class="txr">10</td>
      <td colspan="3">UMUR DALAM TAHUN</td>
      <td>:</td>
      <td>'.($tanggal!=''?(isset($soap->tgl_lahir) && isset($soap->tgl_masuk)?time_ago_by($soap->tgl_lahir, $soap->tgl_masuk, 'y').' TAHUN':''):'').'</td>
    </tr>
    <tr>
      <td class="txr">11</td>
      <td colspan="3">UMUR DALAM HARI</td>
      <td>:</td>
      <td>'.($tanggal!=''?(isset($soap->tgl_lahir)?time_ago_by($soap->tgl_lahir, $soap->tgl_masuk, 'd').' HARI':''):'').'</td>
    </tr>
    <tr>
      <td class="txr">12</td>
      <td colspan="3">JENIS KELAMIN</td>
      <td>:</td>
      <td>'.($tanggal!=''?strtoupper(gender($pasien->jenis_kel)):'').'</td>
    </tr>
    <tr>
      <td class="txr">13</td>
      <td colspan="3">CARA PULANG</td>
      <td>:</td>
      <td>'.($tanggal!=''?'':'').'</td>
    </tr>
    <tr>
      <td class="txr">14</td>
      <td colspan="3">BERAT LAHIR (GRAMS)</td>
      <td>:</td>
      <td>'.($tanggal!=''?'':'').'</td>
    </tr>
    <tr>
      <td class="txr">15</td>
      <td>A</td>
      <td width="10">:</td>
      <td width="180">DIAGNOSA UTAMA</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?$diagp:'').'</td>
    </tr>
    <tr>
      <td class="txr"></td>
      <td>B</td>
      <td width="10">:</td>
      <td>KODE DIAGNOSA UTAMA</td>
      <td>:</td>
      <td colspan="2">'.($tanggal!=''?$kdiagp:'').'</td>
    </tr>
    <tr>
      <td colspan="7">
        <table border="0" cellpadding="0" cellspacing="0" style="font-family: arial;">
          <tr>
            <th class="bdt bdr bdb bdl" width="50">No</th>
            <th class="bdt bdr bdb" width="100">Kode</th>
            <th class="bdt bdr bdb">Diagnosa</th>
          </tr>
          '; 

$i = 1;
if(counts($diags) > 0)
{
  foreach($diags as $all) {
    if(counts(explode(' - ', $all)) > 1)
    {
      $kdiags = explode(' - ', $all)[0];
      $diags = ltrim($all, $kdiags.' - ');
    }
    else
    {
      $kdiags = '';
      $diags = explode(' - ', $all)[0];
    }
    $html .= '
    <tr>
    <td class="bdr bdb bdl txc">';
    $html .= $i;
    $html .= '</td>
    <td class="bdr bdb txc">';
    $html .= $kdiags;
    $html .= '</td>
    <td class="bdr bdb txj">';
    $html .= $diags;
    $html .= '</td>
    </tr>';
    $i++;
  }
} else {
          $html.='
          <tr>
            <td class="bdr bdb bdl"> &nbsp; </td>
            <td class="bdr bdb"></td>
            <td class="bdr bdb"></td>
          </tr>'; 

}
          $html.='
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="7" class="ln5">&nbsp;</td>
    </tr>
    <tr>
      <td class="txr">16</td>
      <td colspan="3">KODE TINDAKAN</td>
      <td>:</td>
      <td colspan="2"> </td>
    </tr>
    <tr>
      <td colspan="7">
        <table border="0" cellpadding="0" cellspacing="0" style="font-family: arial;">
          <tr>
            <th class="bdt bdr bdb bdl" width="50">No</th>
            <th class="bdt bdr bdb" width="100">Kode</th>
            <th class="bdt bdr bdb">Tindakan</th>
          </tr>
          '; 

$i = 1;
$tindakan      = $soap->tindakan;
$tindakan      = explode('@@,', $tindakan);
if(counts($tindakan) > 0)
{
  foreach($tindakan as $all) {
    if(counts(explode(' - ', $all)) > 1)
    {
      $kode = explode(' - ', $all)[0];
      $tind = explode(' - ', $all)[1];
    }
    else
    {
      $kode = '';
      $tind = explode(' - ', $all)[0];
    }
    $html .= '
    <tr>
    <td class="bdr bdb bdl txc">';
    $html .= $i;
    $html .= '</td>
    <td class="bdr bdb txc">';
    $html .= $kode;
    $html .= '</td>
    <td class="bdr bdb txj">';
    $html .= $tind;
    $html .= '</td>
    </tr>';
    $i++;
  }
} else {
          $html.='
          <tr>
            <td class="bdr bdb bdl"> &nbsp; </td>
            <td class="bdr bdb"></td>
            <td class="bdr bdb"></td>
          </tr>
          <tr>
            <td class="bdr bdb bdl"> &nbsp; </td>
            <td class="bdr bdb"></td>
            <td class="bdr bdb"></td>
          </tr>'; 

}
          $html.='
        </table>
      </td>
    </tr>
  </tbody>
</table>
'; 
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
      "pdf" => $file, 
      "pdf_name" => DOC_FILE
    );
    echo json_encode($data); 
  }
} else {
  $pdf->Output($file, $pdf_type);
}
?>