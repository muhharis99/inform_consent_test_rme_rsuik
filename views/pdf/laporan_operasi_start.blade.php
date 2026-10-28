<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/25'); 
define('DOC_TITLE', 'LAPORAN OPERASI'); 
define('DOC_SUBJECT', 'Laporan Operasi'); 
define('DOC_FILE', 'Laporan-Operasi-'.$tgl_rs.'.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
/*
define('DOC_REVISI', '1');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/25'); 
define('DOC_FILE', 'Laporan-Operasi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Laporan Operasi');
$pdf->SetKeywords('RS Islam Klaten, Laporan Operasi');
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
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>LAPORAN OPERASI</b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 5</td><td width="" align="right">Tanggal Terbit : 01 Agustus 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
*/

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
      text-align:left !important;
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
    .p-1 {
      padding:3px !important;
    }

  </style>
'; 
// $html .='<br>';
$jml_row = 5;
for($i=0; $i<$jml_row; $i++) {
  $br_sticker.= '<br>'; 
}
$html .= '
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bg-burem b">
        <td width="20" class="">A. </td>
        <td class="txl" colspan="3">DIAGNOSA PRA OPERASI </td>
    </tr>
    <tr class="">
        <td> </td>
        <td class="" colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($diagpre!=''?$diagpre:'-'):'___________________________________________________________________________________________________ ___________________________________________________________________________________________________').'</td>
    </tr>
    <tr class="">
        <td class="" colspan="4">&nbsp; </td>
    </tr>
    <tr class="">
        <td class=""></td>
        <td class="txl bg-burem b" colspan="3">DIAGNOSA PASCA OPERASI </td>
    </tr>
    <tr class="">
        <td> </td>
        <td class="" colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($diagpost!=''?$diagpost:'-'):'___________________________________________________________________________________________________ ___________________________________________________________________________________________________').'</td>
    </tr>
    <tr class="">
        <td class="ln5" colspan="4">&nbsp; </td>
    </tr>
    <tr class=" bg-burem">
        <td class="b">B. </td>
        <td class=""><b>NAMA DOKTER </b></td>
        <td class=""><b>NAMA ASISTEN </b></td>
        <td class=""><b>NAMA PERAWAT INSTRUMENT </b></td>
    </tr>
    <tr class="">
        <td> </td>
        <td class="" width="240" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($dokter_bedah!=''?$dokter_bedah:'-'):'1. ___________________________<br />2. ___________________________ <br />3. ___________________________').'
      </td>
      <td class="" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($asisten!=''?$asisten:'-'):'1. ___________________________ <br />2. ___________________________ <br />3. ___________________________').'
      </td>
      <td class="" style="'.($tanggal!=''?'line-height:13px;':'').'">
        '.($tanggal!=''?($perawat!=''?$perawat:'-'):'
        1. ___________________________ 
        <br />2. ___________________________ 
        <br />3. ___________________________
        ').'
      </td>
    </tr>
    <tr class="">
        <td class="" colspan="4">&nbsp; </td>
    </tr>
    <tr class="bg-burem b">
        <td>C. </td>
        <td class="txl" colspan="3">NAMA PROSEDUR </td>
    </tr>
    <tr class="">
        <td> </td>
        <td class=" " colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($tindakan!=''?$tindakan:'-'):'___________________________________________________________________________________________________ ___________________________________________________________________________________________________').'</td>
    </tr>
    <tr class="">
        <td class="ln5" colspan="4">&nbsp; </td>
    </tr>
</table>';
$html .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bg-burem">
        <td class="b" width="20">D. </td>
        <td class="" colspan="6"><b>KOMPLIKASI</b></td>
    </tr>
    <tr class="">
        <td class="b"></td>
        <td colspan="6" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($komplikasi!=''?$komplikasi:'-'):'______________________________________________________<br />______________________________________________________ ').' </td>
    </tr>
    <tr class="bg-burem">
        <td class="b" width="20">E. </td>
        <td class="" colspan="3"><b>JARINGAN YANG DI EKSISI/INSISI </b></td>
        <td class="" colspan="3"><b>DIKIRIM UNTUK PEMERIKSAAN PA </b></td>
    </tr>
    <tr class="">
        <td> </td>
        <td colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($jaringan!=''?$jaringan:'-'):'_________________________________________ <br />_________________________________________ ').' </td>
        <td colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($pa!=''?($pa==1?'YA':'TIDAK'):'-'):'___________________________________ <br />___________________________________').' </td>
    </tr>
    <tr class="bg-burem">
        <td class="b" width="20">F. </td>
        <td class="" colspan="6"><b>DARAH MASUK / KELUAR</b></td>
    </tr>
    <tr class="">
        <td class="b"></td>
        <td width=""><b>JUMLAH DARAH YANG HILANG </b></td>
        <td width="10">:</td>
        <td colspan="4" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($darah_hilang!=''?$darah_hilang.' cc':'-'):'_________________________________________________ <br />_________________________________________________ ').' </td>
    </tr>
    <tr class="">
        <td> </td>
        <td width=""><b>JUMLAH DARAH YANG MASUK LEWAT TRANSFUSI </b></td>
        <td width="10">:</td>
        <td colspan="4" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($darah_transfusi!=''?$darah_transfusi.' cc':'-'):'_________________________________________________ <br />_________________________________________________ ').' </td>
    </tr>
    <tr class="bg-burem">
        <td class="b" width="20">G. </td>
        <td class="" colspan="6"><b>NO BATCH IMPLAN</b></td>
    </tr>
    <tr>
        <td class="b" width="20"></td>
        <td class="" colspan="6">'.$implan.'</td>
    </tr>
    <tr class="">
        <td class="b"></td>
        <td class="bdt bdr bdl bdb" colspan="6">
            Tempel sticker implan (Jika perlu silahkan tempel di halaman sebaliknya) '.$br_sticker.' 
            <br />
            <br />
        </td>
    </tr>
    <tr class="">
        <td class="ln5" colspan="7">&nbsp; </td>
    </tr>
    <tr class="bg-burem">
        <td class="b" width="20">H. </td>
        <td class="" colspan="6"><b>WAKTU OPERASI</b></td>
    </tr>
    <tr class="">
        <td class="2 b"></td>
        <td><b>TGL OPERASI </b></td>
        <td width="10">:</td>
        <td>'.($tanggal!=''?$stanggal:'___/___/______').'</td>
        <td width="150"><b>LAMA OPERASI </b></td>
        <td width="10">:</td>
        <td>'.($tanggal!=''?$lama:'____________').'</td>
    </tr>
    <tr class="">
        <td> </td>
        <td><b>JAM MULAI OPERASI</b></td>
        <td>:</td>
        <td>'.($tanggal!=''?$sjam:'___:___').' WIB</td>
        <td><b>JAM SELESAI OPERASI </b></td>
        <td>:</td>
        <td>'.($tanggal!=''?$ejam:'___:___').' WIB</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bg-burem b">
        <td width="20">I. </td>
        <td class="txl" colspan="3">RINCIAN PROSEDUR </td>
    </tr>
    <tr class="">
        <td> </td>
        <td class=" " colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($laporan!=''?$laporan:'-'):'___________________________________________________________________________________________________ ___________________________________________________________________________________________________').' </td>
    </tr>
    <tr class="">
        <td class="ln5" colspan="4">&nbsp; </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bg-burem b">
        <td width="20">J. </td>
        <td class="txl" colspan="3">INSTRUKSI PASCA OPERASI </td>
    </tr>
    <tr class="">
        <td> </td>
        <td colspan="3" style="'.($tanggal!=''?'line-height:13px;':'').'">'.($tanggal!=''?($intruksi_pasca!=''?$intruksi_pasca:'-'):'___________________________________________________________________________________________________ ___________________________________________________________________________________________________ ___________________________________________________________________________________________________').'</td>
    </tr>
    <tr class="">
        <td class="ln5" colspan="4">&nbsp; </td>
    </tr>
</table>';
$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttds/'.$dpjp_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
            </td>
            <td width="72"></td>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$dokter_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;height:50px;">
                '.($cetaktanggal!=''?$cetaktanggal:'___/___/______').' Pukul '.($cetakjam!=''?$cetakjam:'___:___').' WIB
                <br>
                Dokter
                <br />
                <br />
                <br />
                '.($dokter!=''?$dokter:'_________________________________<br />Tanda tangan & Nama terang').'
            </td>
        </tr>
    </tbody>
</table>'; 
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