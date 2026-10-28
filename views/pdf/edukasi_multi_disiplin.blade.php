<?php
define('DOC_REVISI', 'Revisi : 10');
define('DOC_TERBIT', 'Tanggal Terbit : 6 Januari 2025');
define('DOC_NOMER', 'FM/RM/19'); 
define('DOC_TITLE', 'KOMUNIKASI EDUKASI PASIEN TERINTEGRASI'); 
define('DOC_SUBJECT', 'Komunikasi Edukasi Pasien Terintegrasi'); 
define('DOC_FILE', 'Komunikasi-Edukasi-Pasien-Terintegrasi.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 8, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
/*
define('DOC_REVISI', '9');
define('DOC_TERBIT', '20 Agustus 2022');
define('DOC_NOMER', 'FM/RM/19'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.(($no_reg==''||$no_reg=='0000000')?'Edukasi Multi Disiplin':$no_reg));
$pdf->SetSubject('Edukasi Multi Disiplin');
$pdf->SetKeywords('RS Islam Klaten, Edukasi Multi Disiplin');
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
        <td class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:18px; line-height:18px; " ><b>KOMUNIKASI EDUKASI PASIEN TERINTEGRASI</b></td>
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
$pdf->SetFont('calibri', 13);
*/
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
    .txm {
      vertical-align:middle !important;
      padding:3px; 
    }
    td {
      text-align:left;
      vertical-align:top;
      padding:0 3px 0 3px;
    }
    .b {
      font-weight:bold;
    }
    .n {
      font-weight:normal;
    }
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
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
    .pr0 {
      padding-right:0px !important;
    }
  </style>
'; 

$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
          <td width="200">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td colspan="2" class="b">
                    Penerimaan pendidikan : 
                  </td>
                </tr>
                <tr>
                  <td width="10">1. </td>
                  <td>Pasien</td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Keluarga </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Lain-lain : ______________</td>
                </tr>
                <tr>
                  <td colspan="2" class="b">
                    Metode* : 
                  </td>
                </tr>
                <tr>
                  <td>1. </td>
                  <td>Audio </td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Demonstrasi </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Lisan </td>
                </tr>
                <tr>
                  <td>4. </td>
                  <td>Tulisan/leaflet* </td>
                </tr>
                <tr>
                  <td>5. </td>
                  <td>Visual </td>
                </tr>
                <tr>
                  <td colspan="2">*) Tulis nomor leaflet apabila diberikan </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td colspan="2" class="b">
                    Hambatan : 
                  </td>
                </tr>
                <tr>
                  <td width="10">0. </td>
                  <td>Tidak ada hambatan</td>
                </tr>
                <tr>
                  <td width="10">1. </td>
                  <td>Kemampuan membaca dan tingkat pendidikan</td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Bahasa </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Emosional dan motivasi</td>
                </tr>
                <tr>
                  <td>4. </td>
                  <td>Keterbatasan fisik dan kognitif</td>
                </tr>
                <tr>
                  <td>5. </td>
                  <td>Kesediaan pasien untuk menerima informasi</td>
                </tr>
                <tr>
                  <td>6. </td>
                  <td>Keyakinan dan nilai-nilai pasien dan keluarga</td>
                </tr>
              </tbody>
            </table>
          </td>
          <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td colspan="2" class="b">
                    Bahasa : 
                  </td>
                </tr>
                <tr>
                  <td width="10">1. </td>
                  <td>Indonesia</td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Jawa </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Inggris </td>
                </tr>
                <tr>
                  <td>4. </td>
                  <td>Lainnya : ______________</td>
                </tr>
                <tr>
                  <td colspan="2" class="b">
                    Evaluasi respon* : 
                  </td>
                </tr>
                <tr>
                  <td>1. </td>
                  <td>Tidak mengerti </td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Mengerti </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Mengerti, mengulang* </td>
                </tr>
                <tr>
                  <td>4. </td>
                  <td>Mengerti, mengulang, mendemonstrasi* </td>
                </tr>
                <tr>
                  <td colspan="2">*) Target pencapaian evaluasi respon</td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
    </tbody>
  </table>'; 
$default_jumlah_obat=5;


$default_jumlah_obat=5;
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr class="bg-burem b">
            <td colspan="10" class="bdt bdl bdr txc">PELAKSANAAN PEMBERIAN INFORMASI DAN EDUKASI</td>
        </tr>
        <tr class="bg2">
          <td text-rotate="90" class="bdl bdr txc txm b" rowspan="2"> Tanggal & Jam </td>
          <td text-rotate="90" class="bdr  txc txm b" rowspan="2"> Penerima pendidikan </td>
          <td text-rotate="90" class="bdr  txc txm b" rowspan="2"> Hambatan </td>
          <td text-rotate="90" class="bdr txc txm b" rowspan="2"> Bahasa </td>
          <td colspan="2" class="bdr txc txm b" rowspan="2" width="300">  INFORMASI DAN EDUKASI </td>
          <td class="bdr txc txm b" rowspan="2"> Metode/no.leaflet </td>
          <td class="bdr txc txm b" width="60" rowspan="2"> Evaluasi respon </td>
          <td class="bdr txc txm b" colspan="2"> Nama & tanda <br />tangan </td>
        </tr>
        <tr class="bg2">
          <td class="bdt bdr txc b txm" width="60">Pemberi <br />edukasi</td>
          <td class="bdt bdr txc b txm" width="60">Penerima <br />edukasi</td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Orientasi pasien baru</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Orientasi ruangan, sarana dan prasarana</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"></td>
          <td class="bdr" width="200">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td width="5px">a.</td>
                  <td>Fasilitas kamar</td>
                </tr>
                <tr>
                  <td width="5px">b.</td>
                  <td>Sarana ibadah, letak mushola, dan perpustakaan islami</td>
                </tr>
              </tbody>
            </table>
          </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>

        <!-- <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"></td>
          <td class="bdr" width="200">b. Sarana ibadah, letak mushola, dan perpustakaan syariah</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr> -->
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Hak pasien dan keluarga</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">DPJP : ________________________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Perawat Penanggungjawab : ______________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Tata tertib penunggu dan pengunjung </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Jam kunjung pasien </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Cara menyampaikan keluhan</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Cara cuci tangan yang aman</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Fungsi gelang</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Etika batuk</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Cara membuang sampah yang benar</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Edukasi kehalalan obat</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Pencegahan risiko jatuh </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Persyaratan pengurusan asuransi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Penjagaan aurat pasien (pemakaian hijab atau pedasui, ikhtilat, khalwat)</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>

        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Penunggu pasien keluarga/mahram</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>

        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb" style="line-height:5px;"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">DPJP </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
        <td class="bdr bdl"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
        <td class="bdr" width="200">Hasil pengkajian/Kondisi medis </td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        </tr>
        <tr>
        <td class="bdr bdl"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
        <td class="bdr" width="200">Diagnosis </td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        <td class="bdr"></td>
        </tr>
        <tr>
        <td class="bdr bdl"></td>
        <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Rencana asuhan</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
        <td class="bdr bdl"></td>
        <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Hasil pengobatan</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Hasil pengobatan yang tidak diharapkan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Hasil perawatan yang diharapkan dan tata laksana yang direncanakan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Kemungkinan hasil yang tidak dapat diantisipasi dari terapi dan perawatan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb" style="line-height:5px;"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        
      </tbody>
  </table>';
$pdf->WriteHTML($html);
// $pdf->AddPage();
// $html1.='
//   <table border="0" cellpadding="0" cellspacing="0" width="100%">
//     <tbody>
      // <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr b" colspan="2">Manajemen Nyeri </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
      //     <td class="bdr" width="200">Farmakologi </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
      //     <td class="bdr" width="200">Non farmakologi </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdb bdl"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb" style="line-height:5px;"> &nbsp; </td>
      //     <td class="bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr b" colspan="2">Penggunaan peralatan medis yang aman</td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
      //     <td class="bdr" width="200">Infus </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
      //     <td class="bdr" width="200">Kateter urin </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdl"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
      //     <td class="bdr" width="200">Lainnya : __________________ </td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //     <td class="bdr"></td>
      //   </tr>
      //   <tr>
      //     <td class="bdr bdb bdl"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"> &nbsp; </td>
      //     <td class="bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //     <td class="bdr bdb"></td>
      //   </tr>
        // <tr class="">
        //     <td class="ln5" colspan="10"> &nbsp; </td>
        // </tr>
//     </tbody>
//   </table>';
// $pdf->WriteHTML($html1);
   
$html2 .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr class="bg2">
          <td text-rotate="90" class="bdt bdl bdr  txc txm b" rowspan="2"> Tanggal & Jam </td>
          <td text-rotate="90" class="bdt bdr  txc txm b" rowspan="2"> Penerima pendidikan </td>
          <td text-rotate="90" class="bdt bdr  txc txm b" rowspan="2"> Hambatan </td>
          <td text-rotate="90" class="bdt bdr txc txm b" rowspan="2"> Bahasa </td>
          <td colspan="2" class="bdt bdr  txc txm b" rowspan="2" width="300">  INFORMASI DAN EDUKASI </td>
          <td class="bdt bdr bdb txc txm b" rowspan="2"> Metode/no.leaflet </td>
          <td class="bdt bdr  txc txm b" rowspan="2" width="60"> Evaluasi respon </td>
          <td class="bdt bdr  txc txm b" colspan="2"> Nama & tanda <br />tangan </td>
        </tr>
        <tr class="bg2">
          <td class="bdt bdr txc b txm" width="60">Pemberi <br />edukasi</td>
          <td class="bdt bdr  txc b txm" width="60">Penerima <br />edukasi</td>
        </tr>
        
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Manajemen Nyeri </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Farmakologi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Non farmakologi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb" style="line-height:5px;"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Penggunaan peralatan medis yang aman</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Infus </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Kateter urin </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Pedoman Nutrisi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Status gizi dan pelayanan makanan RS </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Diet selama perawatan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Diet untuk dirumah </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb" style="line-height:5px;"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Farmasi (Penggunaan Obat yang Aman)</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Obat yang diberikan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Aturan pemakaian, efek samping dan interaksi obat/obat-makanan </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr b" colspan="2">Teknik Rehabilitasi</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td width="8" class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Fisioterapi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Okupasi Terapi </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Terapi Wicara </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Lainnya : __________________ </td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> &nbsp; </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr" colspan="2"><b>Edukasi Pemulangan (Asuhan Lanjutan di Rumah)</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Diit (jika ada diit khusus sesuai PPA ahli gizi)</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Cara minum obat/penggunaan obat suntik sesuai PPA farmasi</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Perawatan luka</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Jadwal kontrol dan kondisi mendesak sebelum jadwal kontrol segera ke RS atau Fakses terdekat</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdl"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="txc pr0"><img src="'.IMG.'banner/square14_uncheck.png" width="12" /></td>
          <td class="bdr" width="200">Pelaksanaan thaharah dan sholat (khusus pasien muslim)</td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
          <td class="bdr"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> 
        
            
          </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> 
            &nbsp; <br /> 
            &nbsp; <br /> 
             &nbsp; <br /> 
            &nbsp; <br /> 
          </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> 
            &nbsp; <br /> 
            &nbsp; <br /> 
            &nbsp; <br /> 
             &nbsp; <br /> 

          </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr>
          <td class="bdr bdb bdl"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"> 
            &nbsp; <br /> 
            &nbsp; <br /> 
            &nbsp; <br /> 
            &nbsp; <br /> 

          </td>
          <td class="bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
          <td class="bdr bdb"></td>
        </tr>
        <tr class="">
            <td class="ln5" colspan="10"> &nbsp; </td>
        </tr>
    </tbody>
  </table>'; 
$pdf->WriteHTML($html2);


$file = "Edukasi-Multi-Disiplin.pdf";
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
  $file = $dir."Edukasi-Multi-Disiplin.pdf";
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