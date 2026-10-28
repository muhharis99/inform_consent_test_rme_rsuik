<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
define('DOC_NOMER', 'FM/RM/23.1'); 
define('DOC_TITLE', 'CHECK LIST KESELAMATAN PASIEN KATETERISASI JANTUNG'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle('FM/RM/23 - '.$no_reg);
$pdf->SetSubject('CHECK LIST
KESELAMATAN PASIEN
KATETERISASI JANTUNG
');
$pdf->SetKeywords('RS Islam Klaten, CHECKLIST KESELAMATAN OPERASI (SURGICAL SAFETY CHECKLIST)');

if (!empty($tgl_lahir)) {
  $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'');
  if (!empty($warning_sama)) {
    // if ($no_reg=='0620128') {

      $no_reg = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$no_reg.'</td><td> &nbsp; </td></tr></table>';
      $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir));
      $str_tgl_lahir = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$str_tgl_lahir.'</td><td>'.($umur!=''?' ( '.$umur.' )':'').'</td></tr></table>';
    // }
  }
}
// $pdf->SetHTMLHeader('
// <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
//   <tbody>
//     <tr>
//       <td align="left" width="300">RSU ISLAM KLATEN</td>
//       <td align="right" width="" style="text-align:right;"> <b>FM/RM/23.1</b></td>
//       <td align="right" width="100" style="">Hal {PAGENO}/ {nbpg}</td>
//     </tr>
//   </tbody>
// </table>
// <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
//   <tbody>
//     <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
//     <tr>
//     <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
//     <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>CHECK LIST
//     KESELAMATAN PASIEN
//     KATETERISASI JANTUNG</b></td>
//     <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
//     </tr>
//     <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
//     <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
//     <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? $str_tgl_lahir : '').'</td></tr>
//     <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
//     <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
//   </tbody>
// </table>
// ');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 4</td><td width="" align="right">Tanggal Terbit : 01 Agustus 2022</td></tr></tbody></table>
');
$pdf->SetFont('calibri', 13);
$pdf->AddPage('L');
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
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
    }
    .b td {
        font-weight:bold;
    }
    .bg-burem1 {
      background-color: rgb(245, 245, 245);
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .custom-text {
      font-size:14px;
    }

  </style>
'; 
$html .='';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
  ';
$html .='
';
$print_tr = '';
$jml_cm = 3;
for($i=0; $i<$jml_cm; $i++) {
  $cm .= '&nbsp;'; 
}
$html .='
<table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
    <tbody>
        <tr class="bg-burem">
            <td width="100" class="bdr">Sebelum induksi anestesi (SIGN IN)</td>
            <td width="350" class="bdr">Sebelum tindakan Puncture (TIME OUT)</td>
            <td width="300">Sebelum mencabut sheat (SIGN OUT)</td>
        </tr>
        <tr class="bg-burem">
            <td  class="bdr">Minimalnya oleh perawat  dan dokter anestesi</td>
            <td  class="bdr">Diisi oleh perawat,dokter anestesi & operator</td>
            <td>Diisi oleh perawat,dokter anestesi &dokter operator</td>
        </tr>
        <tr class="bg-burem">
            <td  class="bdr">Pukul :</td>
            <td  class="bdr">Pukul :</td>
            <td>Pukul :</td>
        </tr>
        <tr>
            <td  class="bdr">
                <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Pasien telah dikonfirmasikan</td>
                            <td width="20">Sudah</td>
                            <td width="20">Belum</td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>dentitas & gelang identitas</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Lokasi tindakan</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Prosedur</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Informed consent operasi</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Informed consent anestesi</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td class="ln15">Lokasi tindakan sudah diberitanda</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td class="ln15">Mesin  dan obat – obatan anestesi sudah dicek lengkap</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Pulse oximeter sudah terpasang dan berfungsi</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Apakah pasien mempunyai Riwayata alergi</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td class="ln15">Kesulitanbernafas/risiko aspirasi</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td class="ln15">Resiko kehilangan darah>500 ml (7ml/kg/BB pada anak)</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td class="ln15">Dua akses intravena/akses sentral dan rencana terapi cairan</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                    </tbody>
                </table>
            </td>


            <td class="bdr">
            <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Pasien telah dikonfirmasikan</td>
                            <td width="20">Sudah</td>
                            <td width="20">Belum</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>telah memperkenalkan nama</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>dan peran</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td class="ln15">Dokter operator,dokter anestesi dan perawat melakukan konfirmasi secara verbal</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Nama pasien</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Prosedur</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><ul><li>Lokasi dimana puncture akan dilakukan</li></ul> </td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Obat yang diberikan sebelumnya</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>_____________</td>
                                            <td>dosis _____________</td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>_____________</td>
                                            <td>dosis _____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Antisipasi kejadian klinis:</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                                    <tbody>
                                        <tr>
                                            <td>a.</td>
                                            <td class="ln15">Review dokter bedah : langkah apa yang akan dilakukan bila kondisi kritis atau kejadian yang tidak diharapkan,lamanya tindakan,antisipasi kehilangan darah?<br>__________________________________________<br>__________________________________________</td>
                                        </tr>
                                        <tr>
                                            <td>b.</td>
                                            <td class="ln15">Review anestesi: apakah ada hal yang khusus yang perlu diperhatikan pada pasien<br>__________________________________________<br>__________________________________________</td>
                                        </tr>
                                        <tr>
                                            <td>b.</td>
                                            <td class="ln15">Review tim perawat :apakah peralatan sudah steriil,alat – alat yang perlu diperhatikan khusus atau dalam masalah?<br>__________________________________________<br>__________________________________________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Apakah fotorontgen/CT-Scan dan MRI telah ditayangkan</td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                            <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                        </tr>
                    </tbody>
            </table>
            </td>



            <td>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                <tbody>
                <tr>
                    <td>1.</td>
                    <td class="ln15">Perawat melakukan konfirmasi secara verbal dengan tim :</td>
                    <td width="20">Sudah</td>
                    <td width="20">Belum</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                            <tbody>
                                <tr>
                                    <td>a.</td>
                                    <td>Nama prosedur tindakan telah dicatat</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                            <tbody>
                                <tr>
                                    <td>b.</td>
                                    <td class="ln15">Instrument,sponge dan jarum telah dihitung dengan benar</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                            <tbody>
                                <tr>
                                    <td>c.</td>
                                    <td class="ln15">Adakah masalah dengan peralatan selama tindakan</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td class="ln15">Dokter operator,dokter anestesi dan perawat melakukan review masalah utama apa yang harus diperhatikan untuk penyembuhan dan manajemen pasien selanjutnya</td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                    <td class="txc"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                </tr>
                <tr>
                    <td colspan="4">Hal yang perlu diperhatikan :<br>__________________________________________<br>__________________________________________</td>
                </tr>
                <tr>
                    <td class="txr" colspan="4">Klaten, ________________ </td>
                </tr>
                </tbody>
            </table>
            
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
            <tbody>
                <tr class="bg-burem">
                    <th class="bdt bdl">Tim</th>
                    <th class="bdt">Nama</th>
                    <th class="bdt bdr">Tandatangan</th>
                </tr>
                <tr class="bg-burem1">
                    <td class="bdl">dr. Operator<br>&nbsp;</td>
                    <td></td>
                    <td class="bdr"></td>
                </tr>
                <tr>
                    <td class="bdl">dr. Anestesi<br>&nbsp;</td>
                    <td></td>
                    <td class="bdr"></td>
                </tr>
                <tr class="bg-burem1">
                    <td class="bdl bdb">Perawat<br>&nbsp;</td>
                    <td class="bdb"></td>
                    <td class="bdr bdb"></td>
                </tr>
            </tbody>
        </table>
            
            </td>


            
            <td>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                    <tbody>
                        <tr class="bg-burem">
                            <th class="bdt bdl">Tim</th>
                            <th class="bdt">Nama</th>
                            <th class="bdt bdr">Tandatangan</th>
                        </tr>
                        <tr class="bg-burem1">
                            <td class="bdl">dr. Operator<br>&nbsp;</td>
                            <td></td>
                            <td class="bdr"></td>
                        </tr>
                        <tr>
                            <td class="bdl">dr. Anestesi<br>&nbsp;</td>
                            <td></td>
                            <td class="bdr"></td>
                        </tr>
                        <tr class="bg-burem1">
                            <td class="bdl bdb">Perawat<br>&nbsp;</td>
                            <td class="bdb"></td>
                            <td class="bdr bdb"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" style="border-collapse: collapse; font-size:14px;">
                    <tbody>
                        <tr class="bg-burem">
                            <th class="bdt bdl">Tim</th>
                            <th class="bdt">Nama</th>
                            <th class="bdt bdr">Tandatangan</th>
                        </tr>
                        <tr class="bg-burem1">
                            <td class="bdl">dr. Operator<br>&nbsp;</td>
                            <td></td>
                            <td class="bdr"></td>
                        </tr>
                        <tr>
                            <td class="bdl">dr. Anestesi<br>&nbsp;</td>
                            <td></td>
                            <td class="bdr"></td>
                        </tr>
                        <tr class="bg-burem1">
                            <td class="bdl bdb">Perawat<br>&nbsp;</td>
                            <td class="bdb"></td>
                            <td class="bdr bdb"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
';
$html .= ' 

';
// $html .= ' 

// ';
// $html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
// <tbody>
//   <tr class="">
//     <td class="" width="100px" hight="200px">Revisi: 1</td>
//     <td class="" colspan="2"> &nbsp; </td>
//     <td class="" colspan="3">Tanggal terbit : '.date('d-m-Y').'</td>
//   </tr>
// </tbody>
// </table>';

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