<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 22, 15, 10, 10, 'P');
$pdf->SetTitle('FM/RM/06.2.1 - '.$no_reg);
$pdf->SetSubject('Surat Elegibilitas Peserta RSI Klaten');
$pdf->SetKeywords('RS Islam Klaten, Surat Elegibilitas Peserta RSI Klaten');
$pdf->SetHTMLHeader('
  
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr>
        <td width="30px"><img width="24%" src="http://192.168.0.16/serverx/assets/public/img/banner/logo-bpjs.png"></td>
        <td width="2px">&nbsp;</td>
        <td><br>SURAT ELEGIBILITAS PESERTA<br>RSI KLATEN</td>
        <td align="center"><br><br><br><br>Potensi PRB</td>
        <td align="center" width="90px" style=""><br><b>No ANTRIAN</b><br><br><h1>1A011</h1></td>
        
      </tr>
      
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350"></td><td width="" align="right">Tanggal Terbit : 02 Agustus 2022</td></tr></tbody></table>
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
    }
    .ln26 {
      line-height:26px;
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
    .font-kecil {
      font-size:10px;
    } 
    .size-custom {
      font-size :14px;
    }
  </style>
'; 
$html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ' '; 
}
$html .= '
<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. SEP</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $kd_bangsal; $html .= '</td>
      <td class="size-custom ln20">&nbsp;</td>
      <td class="size-custom ln20">&nbsp;</td>
      <td class="size-custom ln20">&nbsp;</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Tgl. SEP</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">xx-xx-xxx</td>
      <td class="size-custom ln20" width="100px">&nbsp;Peserta</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">xxxxxxxx xxxxxx xxxxxx</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. kartu</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">00000xxxxxxxx (MR: 04xxxxx)</td>
      <td class="size-custom ln20" width="100px">&nbsp;COB</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">-</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Nama Peserta</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $nama; $html .= '</td>
      <td class="size-custom ln20" width="100px">&nbsp;Jns. Rawat</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">&nbsp;';$html .= $rawat; $html .= '</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Tgl. Lahir</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $tgl_lahir; $html .= ' &nbsp;&nbsp;&nbsp;&nbsp;Kelamin : ';$html .= $jenis_kel; $html .= '</td>
      <td class="size-custom ln20" width="100px">&nbsp;Kls. Rawat</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $kelas; $html .= '</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;No. Telepon</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $telp; $html .= '</td>
      <td class="size-custom ln20" width="100px">&nbsp;Penjamin</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">xxxxxx</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="90px">&nbsp;Poli Tujuan</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $nama_poli; $html .='</td>
      <td class="size-custom ln20" width="100px">&nbsp;Dokter</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">';$html .= $kd_dr; $html .='</td>
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Faskes Perujuk</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20" colspan="4">RSU PKx XXXXXXXX XXXXXXXXXXXXXXX</td>
     
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Diagnosa Awal</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20" colspan="4">RSU PKx XXXXXXXX XXXXXXXXXXXXXXX xxxxxx xxxxxxx</td>
     
    </tr>
    <tr class="">
      <td class="size-custom ln20" width="120px">&nbsp;Catatan</td>
      <td class="size-custom ln20" width="2px">:</td>
      <td class="size-custom ln20">-</td>
      <td class="size-custom ln20" width="100px">&nbsp;</td>
      <td class="size-custom ln20" width="2px">&nbsp;</td>
      <td class="size-custom ln20">&nbsp;</td>
    </tr>
  </tbody>
</table>
  ';
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td class="font-kecil ln15" width="120px" colspan="3"><br><br><br><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi medis pasien jika diperlukan.<br>&nbsp;&nbsp;SEP bukan sebagai bukti penjaminan peserta<br>&nbsp;&nbsp;Cetakan {datetime}</i></td>
    <td class="ln20" width="2px">&nbsp;</td>
    <td class="ln20" width="2px">&nbsp;</td>
    <td class="ln20"><br>Pasien/Keluarga Pasien<br><br><br>___________________</td>
  </tr>
</table>
';

$html .= '
<hr>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr>
  <td class="txc">FORMULIR BPJS</td>
</tr>
</table>

<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr>
  <td>FORMULIR VERIFIKASI.</td>
</tr>
<tr>
  <td>( INA CBG`S )</td>
</tr>
</table>

<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr>
  <td width="15px">1</td>
  <td width="200px">NO</td>
  <td>';$html .= $nomor; $html .='</td>
</tr>
<tr>
  <td width="15px">2</td>
  <td width="200px">NAMA RS</td>
  <td>RUMAH SAKIT ISLAM KLATEN</td>
</tr>
<tr>
  <td width="15px">3</td>
  <td width="200px">NOMOR KODE RS</td>
  <td>3310384</td>
</tr>
<tr>
  <td width="15px">4</td>
  <td width="200px">KELAS RS</td>
  <td>MADYA / B</td>
</tr>
<tr>
  <td width="15px">5</td>
  <td width="200px">NO REKAM MEDIS</td>
  <td>';$html .= $no_reg; $html .='</td>
</tr>
<tr>
  <td width="15px">6</td>
  <td width="200px">a. NAMA PASIEN</td>
  <td>';$html .= $nama; $html .='</td>
</tr>
<tr>
  <td width="15px">&nbsp;</td>
  <td width="200px">b. ALAMAT PASIEN</td>
  <td>';$html .= $alamat; $html .='</td>
</tr>
<tr>
  <td width="15px">7</td>
  <td width="200px">JENIS PERAWATAN</td>
  <td>';$html .= $rawat; $html .='</td>
</tr>
<tr>
  <td width="15px">8</td>
  <td width="200px">TANGGAL MASUK</td>
  <td>';$html .= $tgl_masuk; $html .='</td>
</tr>
<tr>
  <td width="15px">9</td>
  <td width="200px">TANGGAL LAHIR</td>
  <td>';$html .= $tgl_lahir; $html .='</td>
</tr>
<tr>
  <td width="15px">10</td>
  <td width="200px">UMUR DALAM TAHUN </td>
  <td>';$html .= $umur; $html .='</td>
</tr>
<tr>
  <td width="15px">11</td>
  <td width="200px">UMUR DALAM HARI</td>
  <td>-</td>
</tr>
<tr>
  <td width="15px">12</td>
  <td width="200px">JENIS KELAMIN</td>
  <td>';$html .= $jenis_kel; $html .='</td>
</tr>
<tr>
  <td width="15px">13</td>
  <td width="200px">CARA PULANG</td>
  <td>';$html .= $pulang; $html .='</td>
</tr>
<tr>
  <td width="15px">14</td>
  <td width="200px">BERAT LAHIR (GRAMS)</td>
  <td>';$html .= $berat; $html .='</td>
</tr>
<tr>
  <td width="15px">15</td>
  <td width="200px">A: BERAT LAHIR (GRAMS)</td>
  <td>-</td>
</tr>
<tr>
  <td width="15px">16</td>
  <td width="200px">B: KODE DIAGNOSA UTAMA</td>
  <td>-</td>
</tr>
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