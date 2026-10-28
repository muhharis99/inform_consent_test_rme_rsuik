<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle('FM/RM/23.1- '.$no_reg);
$pdf->SetSubject('CHECKLIST KESELAMATAN PASIEN (SURGICAL SAFETY CHECKLIST)');
$pdf->SetKeywords('RS Islam Klaten, CHECKLIST KESELAMATAN PASIEN (SURGICAL SAFETY CHECKLIST)');
$pdf->SetHTMLHeader('
<table border="1" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
  <tbody>
    <tr>
      <td align="left" width="300">RSU ISLAM KLATEN</td>
      <td align="right" width="" style="text-align:right;"> <b>FM/RM/23.1</b></td>
      <td align="right" width="100" style="">Hal {PAGENO}/ {nbpg}</td>
    </tr>
  </tbody>
</table>
<table border="1" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
  <tbody>
    <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
    <tr>
    <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
    <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>CHECKLIST SERAH TERIMA PASIEN OPERASI</b></td>
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
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 10</td><td width="" align="right">Tanggal Terbit : 01 Agustus 2022</td></tr></tbody></table>
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

  </style>
'; 
// $html .='<br>';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
  ';
$html .='
<table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
<tbody>
  <tr class="">
     <th class="" width="200">SEBELUM OPERASI</th>
      <th class="" width="200">SETELAH OPERASI</th>
  </tr>
</tbody>
</table>
<table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
    <tbody>
        <tr class="">
            <td width="200">
                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                    <tbody>
                        <tr>
                            <td width="140" class="b">Situation</td>
                            <td width="2">:</td>
                            <td>____________________________________________</td>
                        </tr>
                        <tr>
                            <td class="b">Background</td>
                            <td>:</td>
                            <td>____________________________________________</td>
                        </tr>
                        <tr>
                            <td>KU</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Baik</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Sedang</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Jelek</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>GCS</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="125">E : __</td>
                                            <td>M : __</td>
                                            <td>V: __</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>RPD</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Atsma</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Alergi</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Penicilin</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>dr. Operator</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="125">_____________</td>
                                            <td>dr. Anestesi : _____________ </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>dentitasi Formulir</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Sesuai</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td>( RM dan Form IBS )</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Gelang Pasien </td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Penandaan Lokasi </td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak Ada </td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak Perlu </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Asesmen pra anastesi</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak Lengkap</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Asesmen pra bedah</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Informasi Consent</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Bedah</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                        </tr>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Anestesi</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Antibiotik Profilaksis</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">Tidak</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ya, Jam _______ </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Darah / Golongan</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="129">_______</td>
                                            <td>Jumlah _______ Kolf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Antibiotik Profilaksis</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="110">Positif</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Negatif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>HCV</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Positif</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Negatif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>HIV</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Positif</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Negatif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>RO</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>___ Lembar</td>
                                            <td>CT Scan: ___ Lembar</td>
                                            <td>USG: ___ Lembar</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Sholat yang terdekat</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Lain-lain</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Hasil Kritical</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td width="106">TTV</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>RO</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lab : ________ </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="b">Assesment</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="b">Recomendation</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="3">
                            <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="txr">Tanggal, ___/___/______ Pukul ___:___ WIB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="txc">Yang menyerahkan,<br>Perawat IBS<br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
                                        <td class="txc">Yang menerima,<br>Perawat Radar/Rajal/Ranap/Intensif<br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>






            <td width="200">
                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                    <tbody>
                        <tr>
                            <td width="140" class="b">Situation</td>
                            <td width="2">:</td>
                            <td>____________________________________________</td>
                        </tr>
                        <tr>
                            <td class="b">Background</td>
                            <td>:</td>
                            <td>____________________________________________</td>
                        </tr>
                        <tr>
                            <td>KU</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Baik</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Sedang</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Jelek</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Laporan Anestesi</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak___________</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Score Pemulihan</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Aldrete : ______ </td>
                                            <td>Steward : ______</td>
                                            <td>Bromage : ______</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Vital Sign</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>TD : ____ mmHg</td>
                                            <td>N : ____ x/mn</td>
                                            <td>R : ____ x/mnt</td>
                                            <td>Spo2 : ____</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Askep Perioperatif</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Checklist Keselamatan</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Operasi</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Laporan Operasi</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lengkap</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Pengantar PA</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Material Operasi </td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ada/Label</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Sisa Jaringan Tubuh</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Perlu Perawatan Jenazah</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak Perlu</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Resep</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Instruksi Post Operasi</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><ul><li>dr. Operator</li></ul></td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><ul><li>dr. Anestesi</li></ul></td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Ada</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Tidak</td>
                                            <td width="2">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Darah</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Dimasukkan _______ kolf,</td>
                                            <td>Diserahkan : _______ kolf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>RO</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>___ Lembar</td>
                                            <td>CT Scan: ___ Lembar</td>
                                            <td>USG: ___ Lembar</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Lain-lain</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Hasil Kritical </td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>TTV</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>RO</td>
                                            <td width="2"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
                                            <td>Lab : ________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="b">Assesment</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="b">Recomendation</td>
                            <td>:</td>
                            <td>
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>_____________</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="txr">Tanggal, ___/___/______ Pukul ___:___ WIB</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table cellspacing="0" border="1" cellpadding="0" width="100%" style="border-collapse: collapse;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="txc">Yang menyerahkan,<br>Perawat IBS<br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
                                            <td class="txc">Yang menerima,<br>Perawat Radar/Rajal/Ranap/Intensif<br><br>(__________________________)<br>Tanda Tangan dan Nama Terang</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
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