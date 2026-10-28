<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO';
define('DOC_REVISI', '5');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/23'); 
define('DOC_TITLE', 'CHECK LIST KESELAMATAN OPERASI<br><i>(SURGICAL SAFETY CHECLIST)</i>'); 
define('DOC_SUBJECT', 'Check List Keselamatan Operasi <i>(Surgical Safety Checklist)</i>'); 
define('DOC_FILE', 'Check-List-Keselamata-Operasi-Surgical-Safety-Checklist.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject(DOC_SUBJECT);
$pdf->SetKeywords('RS Islam Klaten, '.DOC_SUBJECT);
$pdf->SetHTMLHeader('
<table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
  <tbody>
    <tr>
      <td align="left" width="300">RSU ISLAM KLATEN</td>
      <td align="right" width="" style="text-align:right;"><b>'.DOC_NOMER.'</b></td>
      <td align="right" width="100" style="">Hal {PAGENO}/ {nbpg}</td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
  <tbody>
    <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
    <tr>
    <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
    <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>'.DOC_TITLE.'</b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: '.DOC_REVISI.'</td><td align="right">Tanggal Terbit : '.DOC_TERBIT.'</td></tr></tbody></table>
');
$pdf->AddPage('L');
$pdf->SetFont('calibri', 13);
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
      font-size:14px;
    }
    .ln21 {
      line-height:21px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:25px;
      font-size :14px;
    }
    .ln26 {
      line-height:26px;
      font-size :14px;
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
      font-size:14px;
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .custom-text {
      font-size:15px;
      line-height:21px;
    }
    .custom-text2 {
      font-size:16px;
   
    }
  </style>
'; 

$html .= '
<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
    <tbody>
        <tr>
            <th class="bg-burem b" width="360">Sebelum Pasien di Anestesi (SIGN IN)</th>
            <td width="2">&nbsp;</td>
            <th class="bg-burem b" >Sebelum Insisi (TIME OUT)</th>
            <td width="2">&nbsp;</td>
            <th class="bg-burem b" width="360">Sebelum Pasien Keluar Kamar Operasi (SIGN OUT)</th>
        </tr>
        <tr class="">
            <td>
                <table border="0" width="100%" cellpadding="0" cellspacing="0" class="lnx">
                    <tbody>
                        <tr class="b">
                            <td colspan="5">Konfirmasi Atau Verifikasi</td>
                        </tr>
                        <tr class="">
                            <td width="15">
                            '.(strpos($operasi->signin_konfirmasi, 'Identitas dan Gelang Pasien') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'
                            </td>
                            <td colspan="4">Identitas dan Gelang Pasien '.(strpos($operasi->signin_konfirmasi, 'Inform Consent') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Inform consent</td>
                        </tr>
                        <tr class="">
                            <td>'.($bon_tindakan_check == 'Y' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="4">Nama Prosedur : '.$bon_tindakan.'</td>
                        </tr>
                        <tr class="">
                            <td>'.($bon_diagnosa_check == 'Y' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="4">Diagnosis Operasi : '.$bon_diagnosa.'</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <b>Tanda daerah operasi</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_tanda == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ada &nbsp;&nbsp;&nbsp;'.($operasi->signin_tanda == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak Perlu
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="4">
                                <b>Rencana pasang implan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_implan == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak Ada
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="4">'.($operasi->signin_implan == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ada : Motivasi pasien / keluarga, bila ada perubahan alamat harus memberitahu RS.
                            </td>
                        </tr>
                        <tr class="b">
                            <td colspan="4">Pemeriksaan kelengkapan anestesi </td>
                        </tr>
                        <tr class="">
                            <td>'.(strpos($operasi->signin_lengkap, 'IV Line') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td>IV Line</td>
                            <td>'.(strpos($operasi->signin_lengkap, 'Obat-obatan') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Obat-obatan</td>
                            <td></td>
                        </tr>
                        <tr class="b">
                            <td colspan="4">Penyakit gangguan nafas/resiko aspirasi</td>
                        </tr>
                        <tr class="">
                            <td>'.($operasi == null ? '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />' : ($operasi->signin_nafas != null || $operasi->signin_nafas != '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />')).'</td>
                            <td>Ada '.($operasi->signin_nafas != null || $operasi->signin_nafas != '' ? $operasi->signin_nafas : '____').' </td>
                            <td>'.($operasi->signin_nafas == null || $operasi->signin_nafas == '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak Ada</td>
                            <td></td>
                        </tr>
                        <tr class="">
                            <td colspan="4">
                            <b>Riwayat alergi </b> &nbsp;&nbsp;'.($operasi->signin_alergi != null || $operasi->signin_alergi != '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ada '.($operasi->signin_alergi != null || $operasi->signin_alergi != '' ? $operasi->signin_alergi : '_____________').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;'.($operasi->signin_alergi == null || $operasi->signin_alergi == '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak Ada
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="4">
                                <b>Premidikasi</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_premidikasi == '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak Ada &nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_premidikasi != '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ada '.($operasi->signin_premidikasi != '' ? $operasi->signin_premidikasi : '____').' Jam:'.($operasi->signin_premidikasi_jam != '' ? $operasi->signin_premidikasi_jam : '___').'
                            </td>
                        </tr>
                        <tr class="b">
                            <td colspan="4">Resiko perdarahan > 500 cc ( 7 ml/kg bb pada anak )</td>
                        </tr>
                        <tr class="">
                            <td colspan="2">'.($operasi->signin_darah == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak
                            </td>
                            <td colspan="2">'.($operasi->signin_darah == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ya,Infus dan cairan tersedia
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="4">
                                <b>Mengingatkan sholat</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_sholat == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ya&nbsp;&nbsp;&nbsp;&nbsp; '.($operasi->signin_sholat == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="4">
                            <b>Menjaga aurat</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($operasi->signin_aurat == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Ya&nbsp;&nbsp;&nbsp;&nbsp; '.($operasi->signin_aurat == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').' Tidak
                            </td>
                        </tr>
                        <tr class="b">
                            <td colspan="4">Bimbingan doa sebelum operasi (pasien beragama islam)</td>
                        </tr>
                        <tr class="">
                            <td>
                                '.($operasi->signin_doa == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'
                            </td>
                            <td colspan="4">Hasbiyallaahu wani’malwakiil álallaahi tawakkaltu</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="2">&nbsp;</td>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
                    <tbody>
                        <tr class="b">
                            <td colspan="6">Kelengkapan tim operasi</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->timeout_lengkap == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Lengkap</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Baca secara verbal :</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.(strpos($operasi->timeout_verbal, 'Tanggal Operasi') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Tanggal operasi</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.(strpos($operasi->timeout_verbal, 'Nama dan Peran Tim Operasi') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Nama dan peran tim operasi</td>
                        </tr>
                        <tr>
                            <td width="2">'.(strpos($operasi->timeout_verbal, 'Identitas Pasien') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                                <td colspan="5">Identitas pasien
                            </td>
                        </tr>
                        <tr>
                            <td width="2">'.($bon_tindakan_check == 'Y' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                                <td colspan="5">Prosedur operasi : '.$bon_tindakan.'
                            </td>
                        </tr>
                        <tr>
                            <td width="2"><img src="'.IMG.'banner/'.($bon_diagnosa_check == 'Y' ? 'square14_check.png' : 'square14_uncheck.png').'" width="12" /></td>
                            <td colspan="5">Diagnosis operasi '.$bon_diagnosa.'</td>
                        </tr>
                        <tr>
                            <td width="2">'.(strpos($operasi->timeout_verbal, 'Inform Consent') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                                <td colspan="5">Inform consent</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Apakah antibiotik profilaksis telah diberikan 60 menit sebelum operasi di mulai</td>
                        </tr>
                        <tr>
                            <td width="2">'.($operasi->timeout_profilaksis == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Ya</td>
                        </tr>
                        <tr>
                            <td width="2">'.($operasi->timeout_profilaksis == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Tidak menggunakan</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Foto Radiologi</td>
                        </tr>
                        <tr>
                            <td width="2">'.($operasi->timeout_foto == '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                                <td colspan="5">Dipasang</td>
                            </tr>
                        <tr>
                            <td width="2">'.($operasi->timeout_foto != '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                                <td colspan="5">Tidak dipasang, keterangan : '.($operasi->timeout_foto != '' ? $operasi->timeout_foto : '________').'
                            </td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Hal-hal yang harus diperhatikan :</td>
                        </tr>
                        <tr class="">
                            <td colspan="6">
                              '.$operasi->timeout_catatan.'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="2">&nbsp;</td>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
                    <tbody>
                        <tr class="b">
                            <td colspan="6">Baca secara verbal :</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.(strpos($operasi->signout_verbal, 'Tindakan yang telah dilakukan') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Tindakan yang telah dilakukan</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.(strpos($operasi->signout_verbal, 'Kelengkapan jumlah kasa biji/darm dan jarum') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Kelengkapan jumlah kasa biji/darm dan jarum</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.(strpos($operasi->signout_verbal, 'Kelengkapan instrumen') !== false ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Kelengkapan instrumen</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Tampon tenggorakan</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_tampon == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Ada</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_tampon == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Tidak ada</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Jaringan atau cairan tubuh</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_jaringan == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Ada</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_jaringan == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Sudah diberikan label</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_jaringan == 3 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Tidak ada jaringan/cairan tubuh</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Kelengkapan dokumen operasi sebelum pasien keluar dari kamar operasi</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_dokumen == 1 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Sudah</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_dokumen == 2 ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Belum</td>
                        </tr>
                        <tr class="b">
                            <td colspan="6">Peralatan yang perlu perbaikan</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_peralatan_perbaikan != '' ? ($operasi->signout_peralatan_perbaikan != '-' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />') : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />').'</td>
                            <td colspan="5">Ada : '.($operasi->signout_peralatan_perbaikan == '' ? '________' : ($operasi->signout_peralatan_perbaikan == '-' ? '________' : $operasi->signout_peralatan_perbaikan)).'</td>
                        </tr>
                        <tr class="">
                            <td width="2">'.($operasi->signout_peralatan_perbaikan == '' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : ($operasi->signout_peralatan_perbaikan == '-' ? '<img src="'.IMG.'banner/square14_check.png" width="12" />' : '<img src="'.IMG.'banner/square14_uncheck.png" width="12" />')).'</td>
                            <td colspan="5">Tidak</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td width="360">
                <table border="0" cellpadding="0" cellspacing="0" class="lnx">
                    <tbody>
                        <tr class="">
                            <td colspan="2" class="txr">'.$tgl_signin.'</td>
                        </tr>
                        <tr class="">
                            <td class="txc" style="background-image:url(\''.IMG.'ttd/'.$operasi->perawat_terima.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                              Perawat Ruang Penerimaan
                              <br><br>_________________
                              <br />
                              '.($perawat_terima == '' ? 'Ttd & Nama terang' : $perawat_terima).'
                            </td>
                            <td class="txc" style="background-image:url(\''.IMG.'ttd/'.$operasi->perawat_anestesi.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                              Perawat Anestesi
                              <br><br>_________________
                              <br />
                              '.($perawat_anestesi == '' ? 'Ttd & Nama terang' : $perawat_anestesi).'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="2">&nbsp;</td>
            <td>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="">
                            <td class="txr">'.$tgl_insisi.'</td>
                        </tr>
                        <tr class="">
                            <td class="txc" style="background-image:url(\''.IMG.'ttd/'.$operasi->timeout_petugas_pembaca.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                                Petugas yang membacakan
                                <br><br>_________________
                                <br />
                                '.($petugas_pembaca == '' ? 'Ttd & Nama terang' : $petugas_pembaca).'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="2">&nbsp;</td>
            <td width="360">
                <table border="0" cellpadding="0" cellspacing="0" class="lnx">
                    <tbody>
                        <tr class="">
                            <td colspan="2" class="txr">'.$tgl_signout.'</td>
                        </tr>
                        <tr class="">
                            <td class="txc" style="background-image:url(\''.IMG.'ttd/'.$operasi->perawat_instrumen.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                                Perawat Instrumen
                                <br><br>_________________
                                <br />
                                '.($perawat_instrumen == '' ? 'Ttd & Nama terang' : $perawat_instrumen).'
                            </td>
                            <td class="txc" style="background-image:url(\''.IMG.'ttd/'.$operasi->perawat_rr.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                                Perawat RR
                                <br><br>_________________
                                <br />
                                '.($perawat_rr == '' ? 'Ttd & Nama terang' : $perawat_rr).'
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx" style="font-size:13px;">
    <tbody>
        <tr>
            <td class="txc ln5">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" class="txc custom-text2">Mengetahui</td>
        </tr>
        <tr>
            <td class="txc custom-text2" style="background-image:url(\''.IMG.'ttd/'.$operasi->dokter_anestesi.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                Dokter Anestesi
                <br /><br />
                ______________________
                <br />
                '.$dr_anestesi.'
            </td>
            <td class="txc custom-text2" style="background-image:url(\''.IMG.'ttd/'.$operasi->dokter_bedah.'.jpg\'); background-size: 100%; background-image-resize: 2; background-repeat:no-repeat; background-position:center;">
                Dokter Operator
                <br /><br />
                ______________________
                <br />
                '.$dr_bedah.'
            </td>
        </tr>
    </tbody>
</table>';
$html .= ''; 
$html .= ''; 
$html .= ''; 
$html .= '';
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