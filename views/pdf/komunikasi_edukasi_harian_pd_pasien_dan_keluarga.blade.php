<?php
define('DOC_REVISI', 'Revisi : 3');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/40.1'); 
define('DOC_FILE', 'Komunikasi-Edukasi-Harian-Pada-Pasien-dan-Keluarga.pdf'); 
define('DOC_TITLE', 'KOMUNIKASI EDUKASI HARIAN <br />PADA PASIEN DAN KELUARGA'); 
define('DOC_SUBJECT', 'Komunikasi Edukasi Harian Pada Pasien dan Keluarga'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
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
    .size-custom12 {
      font-size:13px;
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
    .custom-size {
      font-size:14px;
    }
    tbody tr td:nth-child(2) {
      padding-left:10px;
    }
  </style>
'; 
$html .='<br>';
$jml_row = 20;
for($i=0; $i<$jml_row; $i++) {
  $br .= '<br>'; 
}
$jml_row = 2;

$xhtml = '';
$xhtml .= '
<table class="size-custom12" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt">
      <th class="bdr ln19 custom-size bg-burem" width="80">TGL,<br>JAM</th>
      <th class="bdr ln19 custom-size bg-burem" width="" colspan="2">URAIAN PENJELASAN/ISI KOMUNIKASI</th>
      <th class="bdr ln19 custom-size bg-burem" width="100">PEMBERI PENJELASAN<br>Nama & Paraf</th>
      <th class="bdr ln19 custom-size bg-burem" width="100">PASIEN/<br>KELUARGA<br>Nama & Paraf</th>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln23" colspan="2">
        <b>Pasien Muslim :</b>
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr  bg-burem1 bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23" width="20">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Memotivasi pasien/keluarga tentang penerimaan kondisi sakit
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Mengajarkan tata cara thaharah orang sakit
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Mengajarkan tata cara sholat orang sakit
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Do`a orang sakit
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Manajemen nyeri syariah
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23 bg-burem1">
        Terapi dzikir
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Qur`an healing
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Ruqyah syar`iyyah
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Terapi tahajud
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bdb bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Pendampingan talqin
        <br /> &nbsp;
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr">
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln23" colspan="2">
        <b>Pasien Non Muslim :</b>
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23" width="20">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Memotivasi tentang kesembuhanpasiendan penerimaan kondisi sakitnya
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23" width="20">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Menyarankan pasien/keluarga untuk berdoa, beribadah menurut agamanya
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bdb">
      <td class="bdr ln19">&nbsp;</td>
      <td class="ln23" width="20">
        <img src="'.IMG.'banner/'.(($komunikasi->edu == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/>
      </td> 
      <td class="bdr ln23">
        Memfasilitasi/menyetujui pasien/keluarganya untuk mendatangkan rohaniawan sesuai agamanya, bila diperlukan
        <br /> &nbsp;
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln23" colspan="2">
        <b>Lain-lain :</b>
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
    <tr class="bdl bdr bdb bg-burem1">
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln23" colspan="2">
        &nbsp; 
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
    </tr>
  </tbody>
</table>';

$html .= '
<table class="size-custom12" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr class="bdl bdr bdt bdb">
      <th class="bdr ln19 custom-size bg-burem" width="80">TGL,<br>JAM</th>
      <th class="bdr ln19 custom-size bg-burem" width="" colspan="2">URAIAN PENJELASAN/ISI KOMUNIKASI</th>
      <th class="bdr ln19 custom-size bg-burem" width="100">PEMBERI PENJELASAN<br>Nama & Paraf</th>
      <th class="bdr ln19 custom-size bg-burem" width="100">PASIEN/<br>KELUARGA<br>Nama & Paraf</th>
    </tr>
    <tr class="bdl bdr bdb">
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln23" colspan="2">
        &nbsp;';
        for($i=0; $i<35; $i++) {
          $html .= '<br />&nbsp; ';
        }
$html .= ' 
      </td> 
      <td class="bdr ln19">&nbsp;</td>
      <td class="bdr ln19">&nbsp;</td>
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
      "pdf" => $file
    );
    echo json_encode($data); 
  }
} else {
  $pdf->Output($file, $pdf_type);
}
?>