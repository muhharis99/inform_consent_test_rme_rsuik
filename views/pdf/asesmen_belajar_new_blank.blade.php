<?php
define('DOC_REVISI', '1');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/16.1'); 
define('DOC_TITLE', 'PENGKAJIAN KEBUTUHAN EDUKASI PASIEN DAN HAMBATAN PELAYANAN'); 
define('DOC_FILE', 'Pengkajian-Kebutuhan-Edukasi-Pasien-dan-Hambatan-Pelayanan.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan');
$pdf->SetKeywords('RSU Islam Klaten, Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan');

$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 1</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2022</td></tr></tbody></table>
');

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
       border-bottom: 0.5px solid #e8e8e8;
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
       border-bottom: 0.5px solid #e8e8e8;
    }
    .bdlw {
      border-left: 5px solid white;
    }
  </style>
'; 

$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
  <tbody>
    <tr class="bg-burem b">
      <td width="2px">A.</td>
      <td>Kemampuan membaca dan tingkat pendidikan</td>
      <td colspan="2">
        <!-- <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>YA</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_baca == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table> -->
      </td>
    </tr>';


    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Kemampuan membaca</td>
      <td class="bdb"> 
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_mampu_baca == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>Tidak/Buta Huruf</td>
              
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_mampu_baca == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>Ya</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb">Tingkat pendidikan</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>SD</td>

              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>SMA</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>SMP</td>

              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>Sarjana</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>Diploma</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tingkat_didik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/> 
              </td>
              <td>Pasca Sarjana</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Ada Hambatan Kemampuan membaca dan tingkat pendidikan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';


$html .= '<br>
    <tr class="bg-burem b">
      <td width="2px">B.</td>
      <td>Bahasa</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_bahasa == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_bahasa == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>';

if ($hamb_cek_bahasa == NULL) {
    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Bahasa sehari-hari</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">Indonesia</td>

              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Arab</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Jawa</td>

              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == 5) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Lainnya</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_bahasa_sehari == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Inggris</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb">Penerjemah Bahasa</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_penerjemah == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="93px">YA</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_penerjemah == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Ada Ada Hambatan Bahasa</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
} else {
  $html .= '
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Tidak Ada Hambatan Bahasa</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
}

$html .= '<br>
    <tr class="bg-burem b">
      <td>C. </td>
      <td>Hambatan emosional dan motivasi</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_emov == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_emov == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>';

if ($hamb_cek_emov == NULL) {
    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Hambatan Emosional</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_emosi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Cemas</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_emosi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Sedih</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_emosi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak ada gangguan emosional</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb">Hambatan Motivasi </td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_motivasi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Motivasi kurang/buruk</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_motivasi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Pasrah terhadap penyakitnya</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_motivasi == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak ada gangguan motivasi</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Ada Hambatan Hambatan Emosional dan Motivasi</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
} else {
  $html .= '
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Tidak Ada Hambatan Hambatan Emosional dan Motivasi</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
}

$html .= '<br>
    <tr class="bg-burem b">
      <td>D.</td>
      <td>Keterbatasan fisik dan kognitif</td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_fiko == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="94px">YA</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_fiko == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>';

if ($hamb_cek_fiko == NULL) {
    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Hambatan Fisik</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Pendengaran</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Bicara</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Fisik Lemah / MenggunakanAlat Bantu</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Gangguan Penglihatan</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_fisik == 5) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak Ada Gangguan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb">Hambatan kognitif </td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Memori Hilang / Lansia</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Perokok Aktif / Pasif</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Alkoholik / Sedang Konsumsi Alkohol</td>
            </tr>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_kognitif == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tidak Ada Gangguan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">3.</td>
      <td  class="bdb">Secara Fisiologis tidak mampu belajar</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_fisio == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
               <img src="'.IMG.'banner/'.(($hamb_tinlan_fisio == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Ada Hambatan Keterbatasan Fisik dan Kognitif</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
} else {
  $html .= '
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td>Kesimpulan</td>
              <td width="2px">:</td>
              <td>Tidak Ada Hambatan Keterbatasan Fisik dan Kognitif</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
}

$html .= '<br>
    <tr class="bg-burem b">
      <td>E.</td>
      <td>Ketersediaan pasien untuk menerima informasi/edukasi </td>
      <td colspan="2"></td>
    </tr>';


    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Bersedia menerima edukasi</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_edu == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
               <img src="'.IMG.'banner/'.(($hamb_tinlan_edu == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb"> Cara edukasi</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cara_edu == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">Lisan</td>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cara_edu == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>Tulisan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td>Kesimpulan</td>
              <td width="2px">:</td>
              <td>Ada Ketersediaan pasien untuk menerima informasi/edukasi</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';

$html .= '<br>
    <tr class="bg-burem b">
      <td>F.</td>
      <td>Keyakinan dan nilai-nilai pasien dan keluarga yang perlu diperhatikan  </td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_cek_keyakinan == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
               <img src="'.IMG.'banner/'.(($hamb_cek_keyakinan == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>';



if ($hamb_cek_keyakinan == NULL) {
    $html .= '
    <tr>
      <td class="bdb">1.</td>
      <td class="bdb">Tidak memakan sesuatu jenis makanan</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td>'.$hamb_tinlan_makan.'</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">2.</td>
      <td class="bdb">Menolak dilayani petugas yang beda jenis kelamin</td>
      <td class="bdb">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="2px" class="txc">
                <img src="'.IMG.'banner/'.(($hamb_tinlan_beda_kelamin == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td width="92px">YA</td>
              <td width="2px" class="txc">
               <img src="'.IMG.'banner/'.(($hamb_tinlan_beda_kelamin == NULL) ? 'square14_uncheck.png' : 'square14_uncheck.png').'" style="margin-top:2px;" width="12" height=""/>
              </td>
              <td>TIDAK</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td class="bdb">3.</td>
      <td class="bdb">Menolak diberikan imunisasi pada anaknya</td>
      <td class="bdb"> 
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td>'.$hamb_tinlan_tolak_imun.'</td>
            </tr>
          </tbody>
        </table> 
      </td>
    </tr>
    <tr>
      <td class="bdb">4.</td>
      <td class="bdb"> Lainnya</td>
      <td class="bdb">'. ucwords(strtolower($hamb_keyakinan_lainnya)) .'</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td>Kesimpulan</td>
              <td width="2px">:</td>
              <td>Pasien Ada Keyakinan dan nilai-nilai pasien dan keluarga yang perlu diperhatikan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
} else {
  $html .= '
    <<tr>
      <td></td>
      <td colspan="2">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
          <tbody>
            <tr>
              <td width="100px">Kesimpulan</td>
              <td width="2px">:</td>
              <td>Pasien Tidak Ada Keyakinan dan nilai-nilai pasien dan keluarga yang perlu diperhatikan</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    ';
}

$html .= '
  </tbody>
</table>';


$html .= '<br>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td class="txc" >
              Klaten , '.(!empty($registered)?date('d-m-Y', strtotime($registered)):'___/___/_______ ').' Jam : '.(!empty($registered)?date('H:i:s', strtotime($registered)):'___/___ ').' WIB
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
          <td></td>
            <!-- <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$dpjp_id.'.jpg\'); display:none; background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
                Pasien/Keluarga
                <br />
                <br />
                <br />
                '.(!empty($nama)?'  '.$nama.'  ':'  __________________________________ <br />Tanda tangan & Nama terang').'
            </td> -->
            <td width="72"></td>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.$writer.'.jpg\'); opacity:0.5; background-image-resize:2; background-repeat:no-repeat; background-size:100px 100px; background-position:center;">
                Petugas
                <br />
                <br />
                <br />
                '.(!empty($nama_petugas)?' '.$nama_petugas.' ':' __________________________________ <br />Tanda tangan & Nama terang').'
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
       
    </tbody>
  </table>'; 

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