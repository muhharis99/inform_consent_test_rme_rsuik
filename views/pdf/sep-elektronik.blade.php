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

define('DOC_REVISI', '4');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/16.3'); 
define('DOC_FILE', 'SEP-BPJS.pdf');
if (!empty($sep->noKartu))  
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', array(210, 99), 12, 'calibri', 5, 5, 5, 0, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('General Consent');
$pdf->SetKeywords('RSU Islam Klaten, General Consent');

$pdf->SetFont('calibri', 13);
$pdf->shrink_tables_to_fit = 0;
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
      font-size:13px;
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
    font-family:arial;
    font-size:15px;
    }
    .barcode {
        padding: 0;
        border: 0 !important;
        margin: 0;
        vertical-align: top;
        color: #000044;
    }
    .ln20 {
      line-height:17px !important;
    }
  </style>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr>
      <td width="220"><img width="200" src="http://192.168.0.16/serverx/assets/public/img/banner/logo-bpjs.png"></td>
      <td width="" style="font-size:20px; vertical-align:middle;">SURAT ELEGIBILITAS PESERTA<br />RSI KLATEN</td>
      <td class=""></td>
    </tr>
  </tbody>
</table>
'; 
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; margin-top:15px; margin-left:-2px; margin-right:-2px;">
  <tbody>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. SEP</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->noSEP)?$sep->noSEP:'').' '.(!empty($sep->backDate)&&$sep->backDate!=''?'(BACKDATE)':'').'</td>
      <td class="size-custom ln20">&nbsp;</td>
      <td class="size-custom ln20">&nbsp;</td>
      <td class="size-custom ln20">&nbsp;</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Tgl. SEP</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->backDate)&&$sep->backDate!=''?$sep->str_tglBackDate:(!empty($sep->str_tgl_sep)?$sep->str_tgl_sep:'')).'</td>
      <td class="size-custom ln20" width="100px">Peserta</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->nmJenisPeserta)?$sep->nmJenisPeserta:'').'</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. kartu</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->noKartu)?$sep->noKartu:'').' (MR: '.(!empty($sep->noMr)?$sep->noMr:'-').')</td>
      <td class="size-custom ln20" width="100px">&nbsp;<!--COB--></td>
      <td class="size-custom ln20" width="2px"><!--:--></td>
      <td class="size-custom ln20"><!--'.(!empty($sep->cob)?$sep->cob:'&nbsp;-').'--></td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Nama Peserta</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->nama)?$sep->nama:'').'</td>
      <td class="size-custom ln20" width="100px">Jns. Rawat</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->jnsPelayanan)?$sep->jnsPelayanan:'').'</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Tgl. Lahir</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->str_tglLahir)?$sep->str_tglLahir:'').' &nbsp;&nbsp;&nbsp;&nbsp;Kelamin : '.(!empty($sep->sex)?change_jkel($sep->sex):'').'</td>
      <td class="size-custom ln20" width="100px">Jns.Kunjungan</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20" rowspan="2"></td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. Telepon</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->noTelp)?$sep->noTelp:'').'</td>
      <td class="size-custom ln20" width="100px"></td>
      <td class="size-custom ln20" width="2px"> </td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Sub/Spesialis</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->nmPoli)?$sep->nmPoli:'').'</td>
      <td class="size-custom ln20" width="100px">Poli Perujuk</td>
      <td class="size-custom ln20" width="2px">: </td>
      <td class="size-custom ln20">-</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Dokter</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->nmDpjp)?$sep->nmDpjp:'').'</td>
      <td class="size-custom ln20" width="100px">Kls.Hak</td>
      <td class="size-custom ln20" width="2px">: </td>
      <td class="size-custom ln20">'.(!empty($sep->nmKelasTanggungan)?$sep->nmKelasTanggungan:'').'</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Faskes Perujuk</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">'.(!empty($sep->nmProviderRujukan)?$sep->nmProviderRujukan:'').'</td>
      <td class="size-custom ln20" width="100px">Kls.Rawat</td>
      <td class="size-custom ln20" width="2px">: </td>
      <td class="size-custom ln20">'.(!empty($sep->nmKelasRawat)?$sep->nmKelasRawat:($sep->kdKelasRawat!=""?"Kelas ".$sep->kdKelasRawat:'')).'</td>
     
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Diagnosa Awal</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20" colspan="4">'.(!empty($sep->namaDiagnosa)?$sep->namaDiagnosa:'').'</td>
     
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Catatan</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20" style="line-height:12px; padding-top:3px;" colspan="3">'.(!empty($sep->catatan)?$sep->catatan:'&nbsp;-').'</td>
      <td class="size-custom ln20 txc" rowspan="2">
        Pasien/Keluarga Pasien<br>'.(!empty($sep->nama)?'<barcode code="'.$sep->noKartu.'" type="QR" class="" size="0.5" error="M" disableborder="1" border="0" /><br />'.$sep->nama:'<br><br><br />___________________').'
      </td>
    </tr>
    <tr>
      <td colspan="5" style="font-size:10px;"><br />
        <table border="0" cellpadding="0" cellspacing="0" style="line-height:8px; font-size:8px;">
          <tr><td width="5">*</td><td><i>Saya Menyetujui BPJS Kesehatan menggunakan informasi medis pasien jika diperlukan.</i></td></tr>
          <tr><td>*</td><td><i>SEP bukan sebagai bukti penjaminan peserta.</i></td></tr>
          <tr><td>**</td><td><i>Dengan tampilnya luaran SEP elektronik ini merupakan hasil validasi terhadap elegibilitas Pasien secara elektronik 
          <br />(validasi fingerprint atau biometrik/sistem validasi lain) 
          <br />dan selanjutnya Pasien dapat mengakses pelayanan kesehatan rujukan sesuai ketentuan berlaku.
          <br />Kebenaran dan keaslian atas informasi data Pasien menjadi tanggung jawab penuh FKRTL.</i></td></tr>
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