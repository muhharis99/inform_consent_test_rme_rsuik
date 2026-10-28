<?php
define('DOC_REVISI', '1');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/19'); 
define('DOC_TITLE', 'FORMULIR EDUKASI TERINTEGRASI PASIEN DAN KELUARGA'); 
define('DOC_FILE', 'Formulir-Edukasi-Terintegrasi-Pasien-Dan-Keluarga.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Formulir Edukasi Terintegrasi Pasien dan Keluarga');
$pdf->SetKeywords('RSU Islam Klaten, Formulir Edukasi Terintegrasi Pasien dan Keluarga');

$pdf->SetHTMLFooter('<table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 1</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2022</td></tr></tbody></table>');

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
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
    }
    .lnx {
      line-height:15px;
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
    .bdlw {
      border-left: 5px solid white;
    }
  </style>
'; 


$html .= '<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
  <tbody>
    <tr class="bg-burem b">
      <td width="2px">A.</td>
      <td colspan="4">PENGKAJIAN KEBUTUHAN EDUKASI</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="4"><u>Data Pasien</u></td>
    </tr>
    <tr>
      <td></td>
      <td width="2px">1.</td>
      <td>Tinggal Bersama</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($tinggal_bersama) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Anak</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($tinggal_bersama) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="139px">Orang tua</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($tinggal_bersama) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Sendiri</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($tinggal_bersama) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Suami/Istri</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($tinggal_bersama) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="3">Lainnya</td>
            </tr>
          </tbody>
        </table>
      </td>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">2.</td>
      <td>Hambatan</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_emov == 1 && $hamb_cek_fiko == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Ada</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_emov == 2 && $hamb_cek_fiko == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="3">Tidak</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="151px">Gangguan Pendengaran</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == 3) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Penglihatan</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Bicara</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_emosi == 1 && $hamb_emosi == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Emosi</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_motivasi == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Motivasi kurang/buruk</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Memori hilang</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == 4) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Fisik Lemah</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Perokok Aktif / Pasif</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == 3) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Alkoholik</td>
            </tr>
          </tbody>
        </table>
      </td>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">3.</td>
      <td>Kondisi Fisiologis</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_bahasa == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Mampu Belajar</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_bahasa == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak Mampu Belajar</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">4.</td>
      <td>Edukasi diberikan kepada</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($edukasi_kepada) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Anak</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($edukasi_kepada) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Orang tua</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($edukasi_kepada) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Suami</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($edukasi_kepada) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Istri</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">5.</td>
      <td>Kemampuan Bahasa</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Indonesia</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Jawa</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 3) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Inggris</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 4) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Arab</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 5) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Lainnya</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">6.</td>
      <td>Perlu Penerjemah</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_penerjemah == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Ya</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_penerjemah == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">7.</td>
      <td>Baca dan Tulis</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_mampu_baca == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Ya</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_mampu_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">8.</td>
      <td>Kepercayaan lainnya</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_keyakinan == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Ya</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_keyakinan == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">9.</td>
      <td>Kesediaan menerima edukasi</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_edu == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Ya</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_edu == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">10.</td>
      <td>Cara edukasi</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cara_edu == 1) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="152px">Lisan</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cara_edu == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tulisan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td width="2px">11.</td>
      <td>Kebutuhan edukasi</td>
      <td width="2px">:</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Hak untuk berpartisipasi pada proses pelayanan</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Prosedur pemeriksaan penunjang</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Kondisi kesehatan, diagnosis pasti dan penatalaksananya</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Proses pemberian <i>informed consent</i></td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Penggunaan obat secara efektif dan aman, efek samping serta interaksinya</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Penggunaan alat medis yang aman</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Diet dan nutrisi</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Teknik rehabilitasi</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Bahaya merokok</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Manajemen nyeri</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Cuci tangan yang benar</td>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Rujukan edukasi</td>
            </tr>
            <tr>
              <td width="10px" class="txc">
                <img src="'.IMG.'banner/'.(($keb_edukasi) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td colspan="5">Lainnya : _______________________</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    
  </tbody>
</table>
';

$html .= '<br><table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
  <tbody>
    <tr class="bg-burem b">
      <td width="2px">B.</td>
      <td colspan="4">EDUKASI</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td class=""></td>
      <td colspan="4">
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr class="bg-burem">
              <td rowspan="2" class="txc bdb bdr bdt bdl b">Tgl & Jam Edukasi</td>
              <td rowspan="2" class="txc bdb bdr bdt b" width="150px">Materi edukasi berdasarkan kebutuhan</td>
              <td rowspan="2" class="txc bdb bdr bdt b">Kode leaflet</td>
              <td rowspan="2" class="txc bdb bdr bdt b">Lama edukasi (menit)</td>
              <td rowspan="2" class="txc bdb bdr bdt b">Hasil Verifikasi</td>
              <td rowspan="2" class="txc bdb bdr bdt b">Tgl Re-edukasi/Re-demonstrasi</td>
              <td colspan="2" class="txc bdb bdr bdt b">Paraf dan nama</td>
            </tr>
            <tr class="bg-burem">
              <td class="bdb bdr txc b">Pemberi edukasi</td>
              <td class="bdb bdr txc b">Pasien/keluarga (hubungan)</td>
            </tr>';

$Datadiulangi = [
  'Sudah mengerti',
  're-edukasi',
  're-demonstrasi'
];

for ($i = 0; $i < 7; $i++) {
  $html .= '<tr>
              <td class="bdl bdr bdb"></td>
              <td class="bdr bdb"></td>
              <td class="bdr bdb"></td>
              <td class="bdr bdb"></td>
              <td class="bdr bdb"></td>
              <td class="bdr bdb">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td width="10px" class="txc"><img src="' . IMG . 'banner/' . (($tgl_redukasi) ? 'square14_check.png' : 'square14_uncheck.png') . '" style="margin-top:2px;" width="12" height=""/></td>
                    <td>' . $Datadiulangi[0] . '</td>
                  </tr>
                  <tr>
                    <td width="10px" class="txc"><img src="' . IMG . 'banner/' . (($tgl_redukasi) ? 'square14_check.png' : 'square14_uncheck.png') . '" style="margin-top:2px;" width="12" height=""/></td>
                    <td>' . $Datadiulangi[1] . '</td>
                  </tr>
                  <tr>
                    <td width="10px" class="txc"><img src="' . IMG . 'banner/' . (($tgl_redukasi) ? 'square14_check.png' : 'square14_uncheck.png') . '" style="margin-top:2px;" width="12" height=""/></td>
                    <td>' . $Datadiulangi[2] . '</td>
                  </tr>
                </table>
              </td>
              <td class="bdr bdb"></td>
              <td class="bdr bdb"></td>
            </tr>';
}

$html .= '</tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>';


// $html .= '<br><br>
//   <table border="0" cellpadding="0" cellspacing="0" width="100%">
//     <tbody>
//         <tr>
//             <td colspan="3"> &nbsp; </td>
//         </tr>
//         <tr>
//             <td> </td>
//             <td> </td>
//             <td class="txc" >
//               Klaten , '.(!empty($registered)?date('d-m-Y', strtotime($registered)):'___/___/_______ ').' Jam : '.(!empty($registered)?date('H:i:s', strtotime($registered)):'___/___ ').' WIB
//             </td>
//         </tr>
//         <tr>
//             <td colspan="3"> &nbsp; </td>
//         </tr>
//         <tr>
//           <td></td>
//             <!-- <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$dpjp_id.'.jpg\'); display:none; background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
//                 Pasien/Keluarga
//                 <br />
//                 <br />
//                 <br />
//                 <br />
//                 '.(!empty($nama)?'  '.$nama.'  ':'  __________________________________ <br />Tanda tangan & Nama terang').'
//             </td> -->
//             <td width="72"></td>
//             <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$writer.'.jpg\'); background-image-resize:2; background-repeat:no-repeat; background-size:100px 100px; background-position:center;">
//                 Petugas
//                 <br />
//                 <br />
//                 <br />
//                 <br />
//                 '.(!empty($nama_petugas)?' '.$nama_petugas.' ':' __________________________________ <br />Tanda tangan & Nama terang').'
//             </td>
//         </tr>
//         <tr>
//             <td colspan="3"> &nbsp; </td>
//         </tr>
       
//     </tbody>
//   </table>'; 

// $html .= '
//  <tr>
//             <td colspan="3" style="font-size:11px;">Catatan: 
//             <br />- Beri tanda checklist ( <img src="'.IMG.'banner/blank_check.png" style="margin-top:2px;" width="12" height=""/> ) pada kotak ( <img src="'.IMG.'banner/square14_uncheck.png" style="margin-top:2px;" width="12" height=""/>) yang dipilih/sesuai
//             <br />- Coret yang tidak perlu
//             </td>
//         </tr>

// ';
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