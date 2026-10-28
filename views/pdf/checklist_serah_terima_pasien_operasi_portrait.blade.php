<?php
define('DOC_REVISI', 'Revisi : 1');
define('DOC_TERBIT', 'Tanggal Terbit : 26 April 2024');
define('DOC_NOMER', 'FM/RM/23.1'); 
define('DOC_FILE', 'CHECKLIST_SERAH_TERIMA_PASIEN_OPERASI.pdf'); 
define('DOC_TITLE', 'CHECKLIST SERAH TERIMA PASIEN OPERASI'); 
define('DOC_SUBJECT', 'Pemberian Informasi Tindakan Operasi Sectio Caesari'); 
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
    line-height:20px;
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
     border-left: 0.5px solid #505050;
  }
  .bdr {
     border-right: 0.5px solid #505050;
  }
  .bdt {
     border-top: 0.5px solid #505050;
  }
  .bdb {
     border-bottom: 0.5px solid #505050;
  }
  .tableinzero table tr td {
    padding:0px;
  }
  .p0 {
    padding:0px;
  }
  .size-custom {
    font-size :13px;
  }
  .size-custom2 {
    font-size :13px;
  }
  table {
      overflow: wrap;

  }
  .checked {
    margin-right:20px;
    background-image:url(\''.IMG.'banner/square_check.png\'); background-image-resize:2; background-repeat:no-repeat; background-size:100px 100px; background-position:top left;
  }
  </style>
'; 
$html .='';
$jml_row = 10;
for($i=0; $i<$jml_row; $i++) {
  $br_sticker.= '<br>'; 
}

$html .='
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="">
  <tbody>
    <tr class="b">
      <td colspan="16" class="txc bg-burem" style="font-size:17px"> SEBELUM OPERASI</td>
    </tr>
    <tr>
      <td width="2px"></td>
      <td width="147px" class="b" style="font-size:15px;">Situation</td>
      <td width="2px">:</td>
      <td colspan="13"><span style="color:white;">&</span>_________________________________________________________________</td>
    </tr>
    <tr>
      <td></td>
      <td class="b" style="font-size:15px;">Background</td>
      <td width="2px">:</td>
      <td colspan="13"><span style="color:white;">&</span>_________________________________________________________________</td>
    </tr>
    <tr>
      <td></td>
      <td>KU</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Baik</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Sedang</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Jelek</td>
              <td>
              <td>GCS</td>
              <td width="30px" class="txc">
                E:
              </td>
              <td>__________</td>
              <td width="30px" class="txc">
                M:
              </td>
              <td>__________</td>
              <td width="30px" class="txc">
                V:
              </td>
              <td>__________</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    
    <tr>
      <td></td>
      <td style="font-size:15px;">RPD</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Atsma</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Alergi</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Penicilin</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Vital Sign</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                TD:
              </td>
              <td width="150px">____  mmHg</td>
              <td width="30px">
                N:
              </td>
              <td width="150px">____ x/mnt</td>
              <td width="30px">
                R:
              </td>
              <td>____ x/mnt</td>
              <td width="30px">
                S:
              </td>
              <td>____ C</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">dr. Operator</td>
      <td width="2px">:</td>
      <td width="185px"><span style="color:white;">&</span>_____________</td>
      <td width="2px" colspan="12" style="font-size:15px;">dr. Anestesi : _____________</td>
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Identitasi Formulir</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Sesuai</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Gelang Pasien</td>
      <td width="2px">:</td>
      <td colspan="5">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="66px">ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td> 
      <td width="130px" style="font-size:15px;">Penandaan Lokasi</td>
      <td width="2px">:</td>
      <td colspan="5">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="66px">ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="66px">Tidak</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak Perlu</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Asesmen pra anastesi</td>
      <td width="2px">:</td>
      <td colspan="5">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td> 
      <td style="font-size:15px;">Asesmen pra bedah</td>
      <td width="2px">:</td>
      <td colspan="5">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="66px">Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Informasi Consent</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Bedah</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>

            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Anestesi</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Antibiotik Profilaksis</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Ya</td>
              <td width="50px">
                Jam
              </td>
              <td>: _____________</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Darah / Golongan</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="180px"><span style="color:white;">&</span>_____________</td>
              <td width="60px">Jumlah</td>
              <td width="10px">:</td>
              <td>_____________ Kolf</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>


    <tr>
      <td></td>
      <td style="font-size:15px;">Hb SAg</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Positif</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Negatif</td>
              <td></td>
              <td align="right">HCV :</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Positif</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Negatif</td>
              <td></td>
              <td align="right">HIV :</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Positif</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Negatif</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">RO</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td><span style="color:white;">&</span>____ Lembar</td>
              <td width="62px" class="txr">CT Scan</td>
              <td width="2px">:</td>
              <td width="150px">____ Lembar</td>
              <td class="txr">USG</td>
              <td width="2px">:</td>
              <td>____ Lembar</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Sholat terdekat yang belum di laksanakan</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Subuh</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Dzuhur</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Asar</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Maghrib</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Isya</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak Ada</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Lain-lain</td>
      <td width="2px">:</td>
      <td colspan="16"><span style="color:white;">&</span>_________________________________________________________________</td> 

    </tr>

    <tr>
      <td></td>
      <td style="font-size:15px;">Hasil Kritical</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:15px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">TTV</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">RO</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="30px">Lab</td>
              <td width="2">:</td>
              <td>________</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak ada</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>
    
    <tr>
      <td></td>
      <td class="b" style="font-size:15px;">Assesment</td>
      <td width="2px">:</td>
      <td colspan="16"><span style="color:white;">&</span>_________________________________________________________________</td> 
    </tr>
    <tr>
      <td></td>
      <td class="b" style="font-size:15px;">Recomendation</td>
      <td width="2px">:</td>
      <td colspan="16"><span style="color:white;">&</span>_________________________________________________________________</td> 
    </tr>

  </tbody>
</table>
';

$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
  <tbody>
   <tr>
      <td></td>
      <td class="txc" style="font-size:12px">Tanggal, ___/___/______ Pukul ___:___ WIB         </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td width="50%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td class="txc">Yang menyerahkan,</td>
            </tr>
            <tr>
              <td class="txc">Perawat Radar/Rajal/Ranap/Intensif</td>
            </tr>
            <tr>
              <td class="txc"><br>(__________________________)</td>
            </tr>
            <tr>
              <td class="txc">Tanda Tangan dan Nama Terang</td>
            </tr>
          </tbody>
        </table>
      </td>
      <td  width="50%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td class="txc">Yang menerima,</td>
            </tr>
            <tr>
              <td class="txc">Perawat IBS</td>
            </tr>
            <tr>
              <td class="txc"><br>(__________________________)</td>
            </tr>
            <tr>
              <td class="txc">Tanda Tangan dan Nama Terang</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>';

$html .='<hr>';
/* sesudah operasi */

$html .='
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
  <tbody>
    <tr class="b">
      <td colspan="16" class="txc bg-burem" style="font-size:14px"> SETELAH OPERASI</td>
    </tr>
    <tr>
      <td width="2px"></td>
      <td width="135px" class="b">Situation</td>
      <td width="2px">:</td>
      <td colspan="13"><span style="color:white;">&</span>_________________________________________________________________</td>
    </tr>
    <tr>
      <td></td>
      <td class="b">Background</td>
      <td width="2px">:</td>
      <td colspan="13"><span style="color:white;">&</span>_________________________________________________________________</td>
    </tr>
    <tr>
      <td></td>
      <td>KU</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Baik</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Sedang</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Jelek</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>Vital Sign</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                TD:
              </td>
              <td width="150px">____  mmHg</td>
              <td width="30px">
                N:
              </td>
              <td width="150px">____ x/mnt</td>
              <td width="30px">
                R:
              </td>
              <td>____ x/mnt</td>
              <td width="50px">
                SPO2:
              </td>
              <td>____ %</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Laporan Anestesi</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
              <td></td>
              <td>Instruksi post operasi dr.Anestesi :</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>Score pemulihan</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td>Aldrete : ___</td>
              <td>Steward : ___</td>
              <td>Bromage : ___</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak Perlu</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td class="">Laporan Operasi</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Ada/Label</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
              <td width="32px"></td>
              <td>Instruksi post operasi dr.Operator :</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <!-- <tr>
      <td></td>
      <td>Instruksi post operasi dr.Operator</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr> --> 
    <tr>
      <td></td>
      <td class="">Pengantar PA</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    

    <tr>
      <td></td>
      <td>Material Operasi</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Ada/Label</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>Sisa jaringan tubuh</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Perlu perawatan jenazah</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak perlu</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Askep Perioperatif</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Checklist Keselamatan Operasi</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Monitoring Fisiologis LA Anestesi</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Lengkap</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Resep</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Ada</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak</td>
              <td width="30px" class="txc">
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>Darah</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td>Dimasukkan : _________ kolf</td>
              <td>Diserahkan : _________ kolf</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak ada</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>RO</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td>_____ Lembar</td>
              <td>CT Scan : _____ Lembar</td>
              <td>USG : _____ Lembar</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak ada</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="">Sholat yang belum di laksanakan</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="50px">Subuh</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="50px">Dzuhur</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="50px">Asar</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="50px">Maghrib</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="50px">Isya`</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="70px">Tidak ada</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>Lain-lain</td>
      <td width="2px">:</td>
      <td colspan="13">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="150px">_________</td>
              <td width="150px"> </td>
              <td width="150px"></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td></td>
      <td>Hasil Kritical</td>
      <td width="2px">:</td>
      <td colspan="16">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TTV</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>RO</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Lab</td>
              <td width="2">:</td>
              <td>________</td>
              <td width="30px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == 2) ? 'square14_check.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="150px">Tidak ada</td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>
    
    <tr>
      <td></td>
      <td class="b">Assesment</td>
      <td width="2px">:</td>
      <td colspan="16"><span style="color:white;">&</span>_________________________________________________________________</td> 
    </tr>
    <tr>
      <td></td>
      <td class="b">Recomendation</td>
      <td width="2px">:</td>
      <td colspan="16"><span style="color:white;">&</span>_________________________________________________________________</td> 
    </tr>

  </tbody>
</table>
';

$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
  <tbody>
   <tr>
      <td></td>
      <td class="txc" style="font-size:12px">Tanggal, ___/___/______ Pukul ___:___ WIB         </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td width="50%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td class="txc">Yang menyerahkan,</td>
            </tr>
            <tr>
              <td class="txc">Perawat IBS</td>
            </tr>
            <tr>
              <td class="txc"><br>(__________________________)</td>
            </tr>
            <tr>
              <td class="txc">Tanda Tangan dan Nama Terang</td>
            </tr>
          </tbody>
        </table>
      </td>
      <td  width="50%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="" style="font-size:12px;">
          <tbody>
            <tr>
              <td class="txc">Yang menerima,</td>
            </tr>
            <tr>
              <td class="txc">Perawat Radar/Rajal/Ranap/Intensif</td>
            </tr>
            <tr>
              <td class="txc"><br>(__________________________)</td>
            </tr>
            <tr>
              <td class="txc">Tanda Tangan dan Nama Terang</td>
            </tr>
          </tbody>
        </table>
      </td>
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

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
}
$pdf->Output($file, $pdf_type);
?>