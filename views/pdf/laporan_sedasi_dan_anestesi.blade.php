<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO';
define('DOC_REVISI', '9');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/24.1'); 
define('DOC_TITLE', 'LAPORAN SEDASI DAN ATAU ANESTESI'); 
define('DOC_SUBJECT', 'Laporan Sedasi dan atau Anestesi'); 
define('DOC_FILE', 'Laporan-sedasi-dan-anestesi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 12, 9, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject(DOC_SUBJECT);
$pdf->SetKeywords('RS Islam Klaten, '.DOC_SUBJECT);
// $pdf->SetHTMLHeader('
//   <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//     <tbody>
//       <tr>
//         <td align="left" width="300">RSU ISLAM KLATEN</td>
//         <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
//         <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
//       </tr>
//     </tbody>
//   </table>
//   <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//     <tbody>
//       <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//       <tr>
//         <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
//         <td class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>'.DOC_TITLE.'</b></td>
//         <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
//       </tr>
//       <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//       <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//       <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
//       <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
//       <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//     </tbody>
//   </table>
// ');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: '.DOC_REVISI.'</td><td align="right">Tanggal Terbit : '.DOC_TERBIT.'</td></tr></tbody></table>
');
$pdf->shrink_tables_to_fit = 0;
$pdf->use_kwt = true;
$pdf->SetFont('calibri', 13);
$html = '';
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
   
  </style>'; 
$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr class="">
            <td width="173">Tanggal sedasi dan atau Anestesi</td>
            <td width="2">:</td>
            <td>_______________</td>
            <td></td>
            <td width="">Ruang</td>
            <td width="2">:</td>
            <td>_________</td>
            <td width="50"></td>
            <td>Pukul Mulai : _____ s/d _____</td>
        </tr>
    </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td>Dokter Anestesi / Dokter</td>
            <td>: '.($dr_anes ?? '____________').'</td>
            <td width="180">
                <img src="'.IMG.'banner/square14_uncheck.png" width="12" /> Perawat
                &nbsp;&nbsp;&nbsp;
                <img src="'.IMG.'banner/square14_uncheck.png" width="12" /> Penata Anestesi
            </td>
            <td>: '.($perawat ?? '____________').'</td>
        </tr>
        <tr>
            <td>Dokter Bedah</td>
            <td>: &nbsp;1. '.($dr_bedah_1 ?? '____________').'</td>
            <td>2. '.($dr_bedah_2 ?? '____________').'</td>
            <td>3. '.($dr_bedah_2 ?? '____________').'</td>
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
            <td width="90">Tekanan darah</td>
            <td colspan="9">: ________ mm/hg &nbsp;&nbsp;&nbsp;&nbsp;
                Nadi : ______ x/m &nbsp;&nbsp;&nbsp;&nbsp;
                RR : ___ x/m &nbsp;&nbsp;&nbsp;&nbsp;
                Suhu : ______ °C &nbsp;&nbsp;&nbsp;&nbsp;
                BB : ______ kg
            </td>
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
            <td colspan="9">: ____ 
                <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Dilanjutkan &nbsp;&nbsp;&nbsp;&nbsp;
                <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Di perbaiki &nbsp;&nbsp;&nbsp;&nbsp;
                <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Dibatalkan
            </td>
        </tr>
        <tr>
            <td class="b">PLAN</td>
            <td>:</td>
            <td>Jenis Anestesi</td>
            <td colspan="3" width="300">: <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> General : <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>TIVA <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>Face Mask <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> LMA <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>Intubasi
            </td>
            <td colspan="6">
                <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Regional Jenis : <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Spinal <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> Epidural <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>Blok
            </td>
        </tr>
        <tr>
            <td class="b"></td>
            <td></td>
            <td></td>
            <td colspan="9">&nbsp;&nbsp;<img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>
                Tehnik khusus jenis, ______________________________________
            </td>
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
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->sedasi == '-' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> - 
                &nbsp;&nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->sedasi == 'Ringan' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Ringan 
                &nbsp;&nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->sedasi == 'Moderat' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Moderat
                &nbsp;&nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->sedasi == 'Dalam' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Dalam
            </td>
        </tr>
        <tr>
            <td width="2">2.</td>
            <td width="100">Regional</td>
            <td width="2">:</td>
            <td width="210">
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->regional == 'Spinal' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Spinal 
                &nbsp;&nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->regional == 'Epidural' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Epidural 
                &nbsp;&nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->regional == 'Blok' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Blok
            </td>
            <td width="50">Obat</td>
            <td width="2">:</td>
            <td colspan="4">_________________</td>
        <tr>
        <tr>
            <td width="2">3.</td>
            <td width="100">General</td>
            <td>:</td>
            <td>Premidikasi</td>
            <td width="50">Obat</td>
            <td width="2">:</td>
            <td>_________________</td>
            <td width="100"></td>
            <td width="2"></td>
            <td></td>
        </tr>
        <tr>
            <td width="2"></td>
            <td width="100"></td>
            <td></td>
            <td>Induksi : <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> IV &nbsp;&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/> IM</td>
            <td width="50">Obat</td>
            <td width="2">:</td>
            <td>_________________</td>
            <td width="100">Inhalasi Obat</td>
            <td width="2">:</td>
            <td>_________________</td>
        </tr>
        <tr>
            <td width="2"></td>
            <td width="100"></td>
            <td></td>
            <td></td>
            <td width="50">Obat</td>
            <td width="2">:</td>
            <td>_________________</td>
            <td width="100"></td>
            <td width="2"></td>
            <td></td>
        </tr>
        <tr>
            <td width="2"></td>
            <td width="100"></td>
            <td></td>
            <td></td>
            <td width="50">Obat</td>
            <td width="2">:</td>
            <td>_________________</td>
            <td width="100"></td>
            <td width="2"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3">
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->general == 'Semi Closed' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Semi Closed
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->general == 'Semi Open' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Semi Open 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->general == 'Closed' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Closed 
            </td>
            <td colspan="4">
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->alat == 'LMA' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> LMA 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->alat == 'ET' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> ET 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->alat == 'NT' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> NT 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->alat == 'Masker' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Masker
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                No :&nbsp;'.($lap_anes ? ($lap_anes->alat_masker_no != null ? $lap_anes->alat_masker_no : '_________________') : '_________________').'
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Respirasi</td>
            <td width="2" colspan="3">:
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->respirasi == 'Spontan' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Spontan 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->respirasi == 'Kontrol' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Kontrol
            </td>
            <td colspan="3">
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->respirasi_cara == 'Mesin' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Mesin 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->respirasi_cara == 'Manual' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Manual
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Maintenance</td>
            <td width="2" colspan="6">:
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->maintenance == 'Isofurane' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Isofurane 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->maintenance == 'Sevoflurane' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> Sevoflurane 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->maintenance == 'N2O' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> N2O 
                &nbsp;
                <img src="'.IMG.'banner/'.($lap_anes ? ($lap_anes->maintenance == 'O2' ? 'square14_check.png' : 'square14_uncheck.png') : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> O2
            </td>
        </tr>
    </tbody>
</table>';
// $html .= ''; 
$jumlah_kotak = '';
$jml_kotak = 2;
for($i=0; $i<$jml_kotak; $i++) { 
  $jumlah_kotak .='&nbsp;';
}
$width = 15;
$height = 15;

$html .='<br>
<table border="" cellpadding="0" cellspacing="0" width="100%">
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
              <td class="txr" rowspan="2" style="vertical-align:middle;">240</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">220</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">200</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">180</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">160</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">140</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">120</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">100</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">80</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">60</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">40</td>

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
              <td class="txr" rowspan="2" style="vertical-align:middle;">20</td>

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
              <td class="txr">0</td>

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
            </tr>0
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
                        <td>Respirasi</td>
                        <td>:</td>
                        <td><img src="'.IMG.'banner/lingkaran-border-biru.png" style="margin-top:2px;" width="10px" height=""/></td>
                    </tr>
                    <tr class="bg-burem1">
                        <td colspan="4">Posisi: 
                        <img src="'.IMG.'banner/square14_uncheck.png" width="12" />terlentang &nbsp;&nbsp;
                        <img src="'.IMG.'banner/square14_uncheck.png" width="12" />tengkurap &nbsp;&nbsp;
                        <img src="'.IMG.'banner/square14_uncheck.png" width="12" />litotomi &nbsp;&nbsp;
                        <img src="'.IMG.'banner/square14_uncheck.png" width="12" />miring : </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>';

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
            <td>'.($lap_anes ? $lap_anes->cairan_kristaloid : '_______________________').'</td>
            <td>CC</td>
            <td></td>
            <td>Pendarahan</td>
            <td width="2">:</td>
            <td>'.($lap_anes ? $lap_anes->cairan_pendarahan : '_______________________').'</td>
            <td>CC</td>
        </tr>
        <tr>
            <td>Koloid&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/kotak-full.png" style="margin-top:2px;" width="12px" height=""/></td>
            <td>:</td>
            <td>'.($lap_anes ? $lap_anes->cairan_koloid : '_______________________').'</td>
            <td>CC</td>
            <td></td>
            <td>Urine Out put</td>
            <td>:</td>
            <td>'.($lap_anes ? $lap_anes->cairan_urine : '_______________________').'</td>
            <td>CC</td>
        </tr>
        <tr>
            <td>Darah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.IMG.'banner/kotak-full-merah.png" style="margin-top:2px;" width="12px" height=""/></td>
            <td>:</td>
            <td>'.($lap_anes ? $lap_anes->cairan_darah : '_______________________').'</td>
            <td>CC</td>
            <td></td>
            <td>Muntahan</td>
            <td>:</td>
            <td>'.($lap_anes ? $lap_anes->cairan_muntahan : '_______________________').'</td>
            <td>CC</td>
        </tr>
    </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
    <td class="bg-burem b">KEJADIAN PENTING DURANTE SEDASI DAN ATAU ANESTESI</td>
  </tr>
  </tbody>
</table>';
$pdf->WriteHTML($html);
foreach ($koord as $key => $item) {
    //$pdf->Text($item['txt_x'], $item['txt_y'], 'x');
    //$pdf->Image(IMG.'banner/Vbalik.png', $item['img_x'], $item['img_y'], 2.3, 2.3);
    if($item['txt_y_lain'] != null) {
      //$pdf->Text($item['txt_x'], $item['txt_y_lain'], 'o');
      //$pdf->Image(IMG.'banner/Vbalik.png', $item['img_x'],  $item['img_y'], 2.3, 2.3);
    }
}

//$pdf->Text('21.5', '175', 'o');
//$pdf->Image(IMG.'banner/Vbalik.png', '21', '173', 2.3, 2.3);

foreach ($arr_page1 as $item) {
    if($item['tipe'] == 'Teks') {
        //$pdf->Text($item['koord_txt_x'], $item['koord_txt_y'], $item['simbol']);
    } else {
        //$pdf->Image(IMG.$item['simbol'], $item['koord_img_x'], $item['koord_img_y'], 2.3, 2.3);
    }
}
/* Halaman 2 */
$pdf->addPage();
$html2 = '';
$html2 .='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr class="bg-burem">
    <td width="100" class="b" colspan="3">MONITORING DI RUANG PULIH SADAR</td>
  </tr>
  <tr class="">
  <td></td>
</tr>
    <tr>
      <td><br>

      <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        

        <tr>
          <td class="txr" rowspan="2" style="vertical-align:middle;">240</td>

          <td class="bdbg bdrg bdtg bdl3" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>

          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr3 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>

          <td class="bdbg bdr2 bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdrg bdtg" width="'.$width.'" height="'.$height.'"></td>
          <td class="bdbg bdr3 bdtg" width="'.$width.'" height="'.$height.'"></td>
         
      
          
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
          
        </tr>
        
        <tr>
          <td class="txr" rowspan="2" style="vertical-align:middle;">220</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">200</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">180</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">160</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">140</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">120</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">100</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">80</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">60</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">40</td>

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
          <td class="txr" rowspan="2" style="vertical-align:middle;">20</td>

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
          <td class="txr">0</td>

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
      </tbody>
    </table>
<br>
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
            <td>&nbsp;&nbsp;</td>
            </tr>
            
          </tbody>
        </table>  
      </td>
      <td>&nbsp;&nbsp;</td>
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
            <td>&nbsp;&nbsp;</td>
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
            <td>&nbsp;&nbsp;</td>
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
<td width="100" class="b" colspan="5">INTRUKSI PASCA SEDASI DAN ATAU ANESTESI</td>
</tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Lanjutkan perawatan di</td>
      <td>:</td>
      <td>
      <img src="'.IMG.'banner/square14_uncheck.png" width="12" />Ranap inap &nbsp;&nbsp;
      <img src="'.IMG.'banner/square14_uncheck.png" width="12" />HCU &nbsp;&nbsp;
      <img src="'.IMG.'banner/square14_uncheck.png" width="12" />Intensif &nbsp;&nbsp;
      <img src="'.IMG.'banner/square14_uncheck.png" width="12" />_____</td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Pemantauan </td>
      <td>:</td>
      <td>Tekanan darah, Nadi, Pernafasan, Suhu setiap _____ selama ____ jam<br><br><br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Infus </td>
      <td>:</td>
      <td><br><br><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Analgesik </td>
      <td>:</td>
      <td><br><br><br><br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Anti Muntah </td>
      <td>:</td>
      <td><br><br><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Diet </td>
      <td>:</td>
      <td><br><br><br><br></td>
    </tr>
    <tr class="bg-burem1">
      <td><li><ul></ul></li></td>
      <td>Mobilisasi </td>
      <td>:</td>
      <td><br><br><br><br></td>
    </tr>
    <tr>
      <td><li><ul></ul></li></td>
      <td>Lain-lain </td>
      <td>:</td>
      <td><br><br><br><br><br><br></td>
    </tr>
</table>';
$html2 .='
<table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tr>
    <td class="txc">Dokter<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
    <td class="txc">Perawat/Penata Anestesi<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
    <td class="txc">Perawat Ruang Pemulihan<br><br><br>(________________________)<br>Tanda tangan dan nama terang</td>
</tr>
</table>';
$pdf->WriteHTML($html2);

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