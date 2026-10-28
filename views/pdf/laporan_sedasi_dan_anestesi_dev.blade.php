<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO';
define('DOC_REVISI', '9');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/24.1'); 
define('DOC_TITLE', 'LAPORAN SEDASI DAN ANESTESI'); 
define('DOC_SUBJECT', 'Laporan Sedasi dan Anestesi'); 
define('DOC_FILE', 'Laporan-sedasi-dan-anestesi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 12, 9, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
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
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>'.DOC_TITLE.'</b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: '.DOC_REVISI.'</td><td align="right">Tanggal Terbit : '.DOC_TERBIT.'</td></tr></tbody></table>
');
$pdf->shrink_tables_to_fit = 0;
$pdf->use_kwt = true;
$pdf->SetFont('calibri', 13);
$html = '';
$html2 = '';
$html .= '
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
    .bg-burem {
      background-color: #9F9FA0;
      line-height:20px;
    }
    .bg-burem-unik {
      background-color: #D1D1D1;
      line-height:20px;
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
      /*
      page-break-inside: avoid;
      */
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
    .lnx {
      line-height:16px;
    }
    .bdl {
       border-left: 0.5px solid black;
    }
    .bdr {
       border-right: 0.5px solid black;
    }
    .bdr-unik {
      border-right: 0.5px solid #6C6C6C;
   }
    .bdt {
       border-top: 0.5px solid black;
    }
    .bdb {
       border-bottom: 0.5px solid black;
    }

    .bdl1 {
      border-left: 1px solid grey;
    }
    .bdr1 {
        border-right: 1px solid grey;
    }
    .bdt1 {
        border-top: 1px solid grey;
    }
    .bdb1 {
        border-bottom: 1px solid grey;
    }

    .bdl2 {
      border-left: 1px solid black;
    }
    .bdr2 {
        border-right: 1px solid black;
    }
    .bdt2 {
        border-top: 1px solid black;
    }
    .bdb2 {
        border-bottom: 1px solid black;
    }

    .bdl3 {
      border-left: 3px solid red;
    }
    .bdr3 {
        border-right: 3px solid red;
    }
    .bdt3 {
        border-top: 3px solid red;
    }
    .bdb3 {
        border-bottom: 3px solid red;
    }

    .bdl4 {
      border-left: 4px solid red;
    }
    .bdr4 {
        border-right: 4px solid red;
    }
    .bdt4 {
        border-top: 4px solid red;
    }
    .bdb4 {
        border-bottom: 4px solid red;
    }

    .bdlg {
      border-left: 0.5px solid grey;
    }
    .bdrg {
        border-right: 0.5px solid grey;
    }
    .bdtg {
        border-top: 0.5px solid grey;
    }
    .bdbg {
        border-bottom: 0.5px solid grey;
    }


    .bdg {
      border-left: 0.5px solid white;
      border-right: 0.5px solid white;
      border-top: 0.5px solid white;
      border-bottom: 0.5px solid white;
    }
    .bdh {
      border-bottom: 0.5px solid white;
      border-right: 0.5px solid white;
      border-left: 0.5px solid white;
    }
    .fns {
      font-weight:bold; 
    }
    .fnu {
      color:white;
    }
    .lns tr td, .lns tbody tr td, td.lns {
      line-height:12px;
    }
    .text-custom {
      font-size: 16px;
    }

    .valign-middle {
        vertical-align:middle;
    }
   
  </style>
'; 

$html .= '

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr>
      <td>Dokter Anestesi</td>
      <td>: ______________</td>
      <td width="180">Perawat/Penata Anestesi</td>
      <td>: ______________</td>
    </tr>
    <tr>
      <td>Dokter Bedah</td>
      <td>:1. ____________</td>
      <td>2. ____________</td>
      <td>3. ____________</td>
    </tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr class="bg-burem">
      <td class="b">ASESMEN PRA INDUKSI</td>
    </tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr>
      <td class="b">SUBJEKTIF</td>
      <td width="2">:</td>
      <td colspan="10">Riwayat penyakit/Operasi/Obat-obatan</td>
      
    </tr>
    <tr>
      <td class="b">OBYEKTIF</td>
      <td>:</td>
      <td width="100">Tekanan darah</td>
      <td>: ____</td>
      <td>Nadi</td>
      <td>: ____</td>
      <td>RR</td>
      <td>: ____</td>
      <td>Suhu</td>
      <td>: ____</td>
      <td>BB</td>
      <td>: ____</td>
    </tr>
    <tr>
      <td class="b"></td>
      <td></td>
      <td>Diagnosis</td>
      <td colspan="9">: ____________________________________________________________</td>
     
    </tr>
    <tr>
      <td class="b"></td>
      <td></td>
      <td>Tindakan</td>
      <td colspan="9">: ____________________________________________________________</td>
    </tr>
    <tr>
      <td class="b">ASESMEN</td>
      <td>:</td>
      <td>ASA</td>
      <td>: _____</td>
      <td colspan="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Dilanjutkan</td>
      <td colspan="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Di perbaiki</td>
      <td colspan="4"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Dibatalkan</td>
    </tr>
    <tr>
      <td class="b">PLAN</td>
      <td>:</td>
      <td>Jenis Anestesi</td>
      <td>: _____</td>
      <td colspan="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> General</td>
      <td colspan="6"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Regional Jenis : Spinal/epidural/blok</td>
    </tr>
    <tr>
      <td class="b"></td>
      <td></td>
      <td colspan="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Tehnik khusus jenis</td>
      <td colspan="8">, ______________________________</td>
    </tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr class="">
      <td width="200">Tanggal sedasi dan Anestesi</td>
      <td width="2">:</td>
      <td>______________________________</td>
      <td>Pukul Mulai : _____ s/d _____</td>
    </tr>
</tbody>
</table>
'; 

$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr class="bg-burem">
      <td class="b">TEKNIK SEDASI ANESTESI</td>
    </tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
    <tr>
        <td width="2">1.</td>
        <td width="100">Sedasi</td>
        <td width="2">:</td>
        <td colspan="7">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td>-</td>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td>Ringan</td>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td>Moderat</td>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td>Berat</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td width="2">2.</td>
        <td width="100">Regional</td>
        <td width="2">:</td>
        <td colspan="7">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td width="50">Spinal</td>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td width="50">epidural</td>
                        <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/></td>
                        <td width="50">blok</td>
                        <td width="10">Obat</td>
                        <td>: ______________________</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>'; 
$html .='';

// $html .= ''; 
$jumlah_kotak = '';
$jml_kotak = 2;
for($i=0; $i<$jml_kotak; $i++) { 
  $jumlah_kotak .='&nbsp;';
}
$width = 15;
$height = 15;

$html .='<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td class="txr">Sevo</td>
              <td class="bdt bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdt bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdt bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdt bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdt bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr">Iso</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr">O2</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr">N2O</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td></td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td></td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td></td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td></td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td></td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
                <td class="txr valign-middle" rowspan="2">240</td>

                <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            
            <tr>
              <td class="txr valign-middle" rowspan="2">220</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">200</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">180</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">160</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">140</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">120</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">100</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">80</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">60</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">40</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="txr valign-middle" rowspan="2">20</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>

            <tr>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
              <td class="txr valign-middle" rowspan="2">0</td>

              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>

              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
          </tbody>
        </table>
      </td>
      <td width="150" class="text-custom">
      <img src="'.IMG.'banner/lingkaran.png" style="margin-top:2px;" width="20px" height=""/> 
      Macam Obat<br>1.___________<br>2.___________<br>3.___________<br>4.___________<br>5.___________<br>6.___________<br>7.___________
      <br><br>
      <img src="'.IMG.'banner/segitiga.png" style="margin-top:2px;" width="20px" height=""/> Macam Cairan<br>1.___________<br>2.___________<br>3.___________<br>4.___________
      <br><br><br>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td class="txc text-custom">Dokter Anestesi<br><br><br>(_______________)</td>
          </tr>
        </tbody>
      </table><br><br>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <th class="text-custom">
              <img src="'.IMG.'banner/garis-tipis-grey.png" style="margin-top:2px;" width="35px" height=""/>
            </th>
            <td class="text-custom">: 5 menit</td>
          </tr>
          <tr>
            <th class="text-custom">
              <img src="'.IMG.'banner/garis-tebal-hitam.png" style="margin-top:2px;" width="35px" height=""/>
            </th>
            <td class="text-custom">: 15 menit</td>
          </tr>
          <tr>
            <th class="text-custom">
              <img src="'.IMG.'banner/garis-tebal-merah.png" style="margin-top:2px;" width="35px" height=""/>
            </th>
            <td class="text-custom">: 60 menit</td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
  </tbody>
</table>';

$html .='
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
              <td colspan="10">
                <table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
                  <tr class="bg-burem1">
                    <td width="180">Permulaan anastesi </td>
                    <td width="2">:</td>
                    <td width="30">C</td>
                    <td width="180">Tekanan darah sistole </td>
                    <td width="2">:</td>
                    <td><img src="'.IMG.'banner/Vtegak.png" style="margin-top:2px;" width="10px" height=""/></td>
                    <td>Tekanan darah diastole</td>
                    <td width="2">:</td>
                    <td><img src="'.IMG.'banner/Vbalik.png" style="margin-top:2px;" width="10px" height=""/></td>
                  </tr>
                  <tr class="bg-burem1">
                    <td>Permulaan Operasi</td>
                    <td>:</td>
                    <td>></td>
                    <td>Nadi</td>
                    <td>:</td>
                    <td><img src="'.IMG.'banner/lingkaran-biru.png" style="margin-top:2px;" width="10px" height=""/></td>
                    <td>Saturasi O₂</td>
                    <td>:</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td> Pengakhiran operasi </td>
                    <td>:</td>
                    <td><</td>
                    <td>Intubasi atau extubasi</td>
                    <td>:</td>
                    <td>T</td>
                    <td colspan="3">Posisi: terlentang/tengkurap/litotomi/miring</td>
                  </tr>
                  <tr class="bg-burem1">
                    <td>Respirasi</td>
                    <td>:</td>
                    <td><img src="'.IMG.'banner/lingkaran-border-biru.png" style="margin-top:2px;" width="10px" height=""/></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3"></td>
                  </tr>
                  
                </table>
              </td>
            </tr>
            </tbody>
            </table>
            
';

$html .='
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr class="bg-burem">
      <td width="100" class="b" colspan="3">CAIRAN MASUK</td>
      <td></td>
      <td></td>
      <td width="100" class="b " colspan="3">CAIRAN KELUAR</td>
      <td></td>
    </tr>
    <tr>
      <td>Kristaloid&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/segitiga-full.png" style="margin-top:2px;" width="15px" height=""/></td>
      <td width="2">:</td>
      <td>_______________________</td>
      <td>CC</td>
      <td></td>
      <td>Pendarahan</td>
      <td width="2">:</td>
      <td>_______________________</td>
      <td>CC</td>
    </tr>
    <tr>
      <td>Koloid&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/kotak-full.png" style="margin-top:2px;" width="12px" height=""/></td>
      <td>:</td>
      <td>_______________________</td>
      <td>CC</td>
      <td></td>
      <td>Urine Out put</td>
      <td>:</td>
      <td>_______________________</td>
      <td>CC</td>
    </tr>
    <tr>
      <td>Darah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/kotak-full-merah.png" style="margin-top:2px;" width="12px" height=""/></td>
      <td>:</td>
      <td>_______________________</td>
      <td>CC</td>
      <td></td>
      <td>Muntahan</td>
      <td>:</td>
      <td>_______________________</td>
      <td>CC</td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
    <td class="bg-burem b">KEJADIAN PENTING DURANTE SEDASI DAN ANESTESI</td>
  </tr>
  </tbody>
</table>';

$pdf->WriteHTML($html);
$pdf->SetFont('', '', 10);
foreach ($arr_page1 as $item) {
    foreach ($item as $value) {
        foreach ($value as $v) {
            if($v['tipe'] == 'Gambar') {
                //$pdf->Image(IMG.$v['nilai'], $v['x'], $v['y'], 2.3, 2.3);
            } else {
                //$pdf->Text($v['x'], $v['y'], $v['nilai']);
            }
        }
    }
}

foreach ($koord as $key => $value) {
    $pdf->Text($value['txt_x'], $value['txt_y'], 'X');
}

// Semi closed
$pdf->Image(IMG.'banner/square14_uncheck.png', 46, 105, 4, 4);

//$pdf->Text(21.5, 159.5, 'O');

//$pdf->Text(21.5, 156.5, 'X');
//$pdf->Text(24.5, 156.5, 'X');
//$pdf->Text(27.5, 156.5, 'X');
/*
$pdf->Text(21.5, 156.5, 'X');
$pdf->Text(24.5, 156.5, 'X');
$pdf->Text(27.5, 156.5, 'X');

$pdf->Text(30.5, 156.5, 'X');
$pdf->Text(33.5, 156.5, 'X');
$pdf->Text(36.5, 156.5, 'X');

$pdf->Text(40.5, 156.5, 'X');
$pdf->Text(43.5, 156.5, 'X');
$pdf->Text(46.5, 156.5, 'X');

$pdf->Text(49.5, 156.5, 'X');
$pdf->Text(52.5, 156.5, 'X');
$pdf->Text(55.5, 156.5, 'X');
*/
$pdf->AddPage();
$html2 .='
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr class="bg-burem">
            <td width="100" class="b" colspan="3">MONITORING DI RUANG PULIH SADAR</td>
        </tr>
        <tr class="">
            <td></td>
        </tr>
        <tr>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td class="">240</td>
                <td class="bdbg bdrg bdl3 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr2 bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdrg bdt" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg bdr3 bdt" width="'.$width.'" height="'.$height.'"></td>
          </tr>
          <tr>
              <td class=""></td>
              <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
          <tr>
            <td class="">220</td>
            <td class="bdbg  bdrg bdl3"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
          </tr>
            <tr>
              <td class=""></td>
              <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
              <td class="">200</td>
              <td class="bdbg bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
              <td class=""></td>
              <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
              <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">180</td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">160</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">140</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">120</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">100</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">80</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">60</td>
                <td class="bdbg  bdrg bdl3"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">40</td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class=""></td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">20</td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
            <tr>
                <td class="">0</td>
                <td class="bdbg  bdrg bdl3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr2" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdrg" width="'.$width.'" height="'.$height.'"></td>
                <td class="bdbg  bdr3" width="'.$width.'" height="'.$height.'"></td>
            </tr>
          </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="150">Tekanan darah sistole </td>
              <td width="2">:</td>
              <td><img src="'.IMG.'banner/Vtegak.png" style="margin-top:2px;" width="10px" height=""/></td>
              <td>Respirasi</td>
              <td width="2">:</td>
              <td><img src="'.IMG.'banner/lingkaran-border-biru.png" style="margin-top:2px;" width="10px" height=""/></td>
            </tr>
            <tr>
              <td width="150">Tekanan darah diastole  </td>
              <td width="2">:</td>
              <td><img src="'.IMG.'banner/Vbalik.png" style="margin-top:2px;" width="10px" height=""/></td>
              <td>Saturasi O2</td>
              <td width="2">:</td>
              <td>X</td>
            </tr>
            <tr>
              <td width="150">Denyut nadi </td>
              <td width="2">:</td>
              <td><img src="'.IMG.'banner/lingkaran-biru.png" style="margin-top:2px;" width="10px" height=""/></td>
              <td></td>
              <td width="2"></td>
              <td></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            
          </tbody>
        </table>
        
      </td>
      <td>&nbsp;</td>
      <td>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td colspan="4" width="350" class="b">STEWARD SCORE untuk pasien anak General Anestesi, boleh keluar score ≥ 5</td>
            </tr>
            <tr class="bg-burem">
              <td class="b bdr-unik">NO</td>
              <td class="b bdr-unik">STEWARD SCORE</td>
              <td class="b bdr-unik">MASUK</td>
              <td class="b">KELUAR</td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik txc">1</td>
              <td class="bdr-unik">Kesadaran</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr>
              <td class="bdr-unik txc">2</td>
              <td class="bdr-unik">Respirasi</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik txc">3</td>
              <td class="bdr-unik">Aktivitas Motorik</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr>
              <td class="bdr-unik"></td>
              <td class="bdr-unik">JUMLAH</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik"></td>
              <td class="bdr-unik">Waktu</td>
              <td class="bdr-unik">Jam:___</td>
              <td>Jam:___</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
          </tbody>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td colspan="4" width="350" class="b">ALDRETE SCORE untuk pasien dewasa General Anestesi, boleh keluar score ≥ 8</td>
            </tr>
           
            <tr class="bg-burem">
              <td class="b bdr-unik">NO</td>
              <td class="b bdr-unik">ALDRETE SCORE</td>
              <td class="b bdr-unik">MASUK</td>
              <td class="b">KELUAR</td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik txc">1</td>
              <td class="bdr-unik"> Aktifitas motorik</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr>
              <td class="bdr-unik txc">2</td>
              <td class="bdr-unik">Pernafasan</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik txc">3</td>
              <td class="bdr-unik">Tekanan darah</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr>
              <td class="bdr-unik txc">4</td>
              <td class="bdr-unik">Kesadaran</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik txc">5</td>
              <td class="bdr-unik">Warna Kulit</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr>
              <td class="bdr-unik"></td>
              <td class="bdr-unik">JUMLAH</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik"></td>
              <td class="bdr-unik">Waktu</td>
              <td class="bdr-unik">Jam:___</td>
              <td>Jam:___</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
          </tbody>
      </table>

      <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td colspan="4" width="350" class="b">BROMAGE SCORE untuk pasien regional anestesi, boleh keluar score ≤ 2</td>
            </tr>
           
            <tr class="bg-burem">
              <td class="b bdr-unik">NO</td>
              <td class="b bdr-unik">BROMAGE SCORE</td>
              <td class="b bdr-unik">MASUK</td>
              <td class="b">KELUAR</td>
            </tr>
            <tr>
              <td class="bdr-unik txc">1</td>
              <td class="bdr-unik">Gerakan kaki</td>
              <td class="bdr-unik"></td>
              <td></td>
            </tr>
            <tr class="bg-burem-unik">
              <td class="bdr-unik"></td>
              <td class="bdr-unik">Waktu</td>
              <td class="bdr-unik">Jam:___</td>
              <td>Jam:___</td>
            </tr>
          </tbody>
      </table>

      <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
           
            <tr class="">
              <td class="">Catatan selama di ruang pulih sadar :</td>
            </tr>
            <tr class="">
              <td class="">______________________________________________</td>
            </tr>
            <tr class="">
              <td class="">______________________________________________</td>
            </tr>
          </tbody>
      </table>
      </td>
    </tr>
  </tbody>
</table>';
$html2 .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr class="bg-burem">
<td width="100" class="b" colspan="5">INTRUKSI PASCA SEDASI DAN ANESTESI</td>
</tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Lanjutkan perawatan di</td>
      <td>:</td>
      <td>Ranap inap/HCU/Intensif/_____</td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Pemantauan </td>
      <td>:</td>
      <td>Tekanan darah, Nadi, Pernafasan, Suhu setiap _____ selama ____ jam<br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Infus </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Analgesik </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Anti Muntah </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Diet </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Mobilisasi </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Lain-lain </td>
      <td>:</td>
      <td><br><br></td>
    </tr>
</table>';
$html2 .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr>
    <td class="txc">Dokter Anestesi<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
    <td class="txc">Perawat/Penata Anestesi<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
    <td class="txc">Perawat Ruang Pemulihan<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
</tr>
</table>';
$pdf->WriteHTML($html2);
foreach ($arr_page2 as $item) {
    foreach ($item as $value) {
        foreach ($value as $v) {
            if($v['tipe'] == 'Gambar') {
                //$pdf->Image(IMG.$v['nilai'], $v['x'], $v['y'], 2.3, 2.3);
            } else {
                //$pdf->Text($v['x'], $v['y'], $v['nilai']);
            }
        }
    }
}

/*
$pdf->Text(22, 44.5, 'X');
$pdf->Text(26, 44.5, 'X');

$pdf->Text(22, 48.5, 'X');
$pdf->Text(26, 48.5, 'X');
*/
/*
$pdf->Image(IMG.'banner/lingkaran-biru.png', 21.5, 42.5, 2.3, 2.3);
$pdf->Image(IMG.'banner/lingkaran-biru.png', 25.5, 42.5, 2.3, 2.3);

$pdf->Image(IMG.'banner/lingkaran-biru.png', 21.5, 46.5, 2.3, 2.3);
$pdf->Image(IMG.'banner/lingkaran-biru.png', 25.5, 46.5, 2.3, 2.3);
*/
//$pdf->Image(IMG.'banner/lingkaran-biru.png', 21.5, 42.5, 2.3, 2.3);

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