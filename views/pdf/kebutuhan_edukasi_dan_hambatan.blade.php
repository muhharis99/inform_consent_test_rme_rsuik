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
    .lnh, .lnh td {
      line-height:20px;
    }
  </style>
'; 


$html .= '
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="lnx">
  <tbody>
    <!--
    <tr class="b lnh">
      <td colspan="2" class="txl"> PENGKAJIAN</td>
      <td colspan="2" class="txl bdlw"> TINDAK LANJUT &nbsp;</td>
    </tr>
    -->
    <tr class="b lnh">
      <td class="bg3" width="19px">A.</td>
      <td class="bg3" width="480px" style="padding-left:6px;">KEMAMPUAN MEMBACA DAN TINGKAT PENDIDIKAN</td>
      <td width="5px" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="150">Kemampuan membaca</td>
              <td width="2px">:</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Tidak' === ($data['badik_baca'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="140px"> Tidak bisa</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Ya' === ($data['badik_baca'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width=""> bisa</td>
            </tr>
            <tr class="">
              <td>Tingkat Pendidikan</td>
              <td>:</td>
              <td><img
                  src="'.IMG.'banner/'.('Tidak sekolah' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td colspan="3" class="lnx"> Tidak Sekolah/belum sekolah</td>
            </tr>
            <tr class="">
              <td> &nbsp; </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.('SD' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> SD</td>
              <td><img
                  src="'.IMG.'banner/'.('Diploma' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Diploma</td>
            </tr>
            <tr class="">
              <td> &nbsp; </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.('SMP' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> SMP</td>
              <td><img
                  src="'.IMG.'banner/'.('Sarjana' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Sarjana</td>
            </tr>
            <tr class="">
              <td> &nbsp; </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.('SMA' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> SMA</td>
              <td><img
                  src="'.IMG.'banner/'.('Pasca Sarjana' === ($data['badik_didik'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Pasca Sarjana</td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['badik_simpul']) && $data['badik_simpul'] != '')?$data['badik_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['badik_tinlan'] ?? '', 'Edukasi sesuai kondisi pasien') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Edukasi sesuai kondisi pasien</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['badik_tinlan'] ?? '', 'Pendampingan keluarga/wali') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Pendampingan keluarga/wali</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    
    <tr class="b lnh">
      <td class="bg3" width="">B.</td>
      <td class="bg3" width="" style="padding-left:6px;">BAHASA</td>
      <td width="" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="150">Bahasa sehari-hari</td>
              <td width="2px">:</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Bahasa jawa' === ($data['bahasa_hari'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="140px"> Bahasa Jawa</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Bahasa indonesia' === ($data['bahasa_hari'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width=""> Bahasa Indonesia</td>
            </tr>
            <tr class="">
              <td> &nbsp; </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.('Bahasa inggris' === ($data['bahasa_hari'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> Bahasa Inggris</td>
              <td><img
                  src="'.IMG.'banner/'.('Bahasa lain' === ($data['bahasa_hari'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Lainnya </td>
            </tr>
            <tr class="">
              <td colspan="6">Perlu penerjemah (jika jawaban bahasa inggris atau lainnya) : </td>
            </tr>
            <tr class="">
              <td> &nbsp; </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.('Tidak' === ($data['bahasa_penerjemah'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> Tidak</td>
              <td><img
                  src="'.IMG.'banner/'.('Ya' === ($data['bahasa_penerjemah'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Ya</td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['bahasa_simpul']) && $data['bahasa_simpul'] != '')?$data['bahasa_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['bahasa_tinlan'] ?? '', 'Edukasi dengan bahasa yang dipahami pasien') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Edukasi dengan bahasa yang dipahami pasien</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['bahasa_tinlan'] ?? '', 'Penerjemah bahasa') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Penerjemah bahasa</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    
    <tr class="b lnh">
      <td class="bg3" width="">C.</td>
      <td class="bg3" width="" style="padding-left:6px;">HAMBATAN EMOSIONAL DAN MOTIVASI</td>
      <td width="" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="150">Gangguan emosional</td>
              <td width="2px">:</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Tidak' === ($data['emmo_emosi'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="140px"> Tidak</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.('Ya' === ($data['emmo_emosi'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width=""> Ya</td>
            </tr>
            <tr class="">
              <td>Hambatan motivasi </td>
              <td>: </td>
              <td><img
                  src="'.IMG.'banner/'.('Tidak' === ($data['emmo_motiv'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> Tidak</td>
              <td><img
                  src="'.IMG.'banner/'.('Ya, Motivasi kurang/buruk' === ($data['emmo_motiv'] ?? '')?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Ya, Motivasi kurang/buruk </td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['emmo_simpul']) && $data['emmo_simpul'] != '')?$data['emmo_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['emmo_tinlan'] ?? '', 'Pendampingan keluarga/wali') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Pendampingan keluarga/wali</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['emmo_tinlan'] ?? '', 'Motivasi/dukungan keluarga') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Motivasi/dukungan keluarga</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr class="b lnh">
      <td class="bg3" width="">D.</td>
      <td class="bg3" width="" style="padding-left:6px;">KETERBATASAN FIKTIF DAN KOGNITIF </td>
      <td width="" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['fiko_ada'] ?? '', 'Tidak') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="180"><b>Tidak ada</b></td>
              <td width="2px"> </td>
              <td width="" colspan="3"> </td>
            </tr>
            <tr class="">
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Gangguan pendengaran') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="180">Gangguan pendengaran</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Memori hilang/lansia') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" colspan="3"> Memori hilang/lansia</td>
            </tr>
            <tr class="">
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Gangguan bicara') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="">Gangguan bicara</td>
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Perokok aktif/pasif') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" colspan="3"> Perokok aktif/pasif</td>
            </tr>
            <tr class="">
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Gangguan penglihatan') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="">Gangguan penglihatan</td>
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Alkoholik') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" colspan="3"> Alkoholik</td>
            </tr>
            <tr class="">
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Fisik lemah') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="">Fisik lemah</td>
              <td width=""><img
                  src="'.IMG.'banner/'.(stripos($data['fiko'] ?? '', 'Secara fisiologis tidak mampu belajar') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" colspan="3"> Secara fisiologis tidak mampu belajar</td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['fiko_simpul']) && $data['fiko_simpul'] != '')?$data['fiko_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['fiko_tinlan'] ?? '', 'Bantuan mobilisasi') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Bantuan mobilisasi</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['fiko_tinlan'] ?? '', 'Pendampingan keluarga/wali') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Pendampingan keluarga/wali</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    
    <tr class="b lnh">
      <td class="bg3" width="">E.</td>
      <td class="bg3" width="" style="padding-left:6px;">KESEDIAAN PASIEN UNTUK MENERIMA INFORMASI/EDUKASI</td>
      <td width="" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="190">Bersedia menerima edukasi</td>
              <td width="2px">:</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['infedu_sedia'] ?? '', 'Tidak') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="100px"> Tidak</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['infedu_sedia'] ?? '', 'Ya') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width=""> Ya</td>
            </tr>
            <tr class="">
              <td>Cara edukasi </td>
              <td>: </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['infedu_cara'] ?? '', 'Lisan') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx"> Lisan</td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['infedu_cara'] ?? '', 'Tulisan') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td> Tulisan </td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['infedu_simpul']) && $data['infedu_simpul'] != '')?$data['infedu_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['infedu_tinlan'] ?? '', 'Pendampingan keluarga/wali') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Pendampingan keluarga/wali</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr class="b lnh">
      <td class="bg3" width="">F.</td>
      <td class="bg3" width="" style="padding-left:6px;">NILAI-NILAI DAN PILIHAN PASIEN</td>
      <td width="" class=""> </td>
      <td class="bg3" style="padding-left:10px;"> TINDAK LANJUT</td>
    </tr>
    <tr>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td width="150" rowspan="2">Nilai tertentu yang dianut pasien</td>
              <td width="2px">:</td>
              <td width="2px"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ada'] ?? '', 'Tidak') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="140px"> Tidak ada</td>
              <td width="2px"> </td>
              <td width=""> </td>
            </tr>
            <tr class="">
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ada'] ?? '', 'Ya') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx" colspan="3"> Ya, </td>
            </tr>
            <tr class="">
              <td> </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ya'] ?? '', 'Tidak memakan suatu jenis makanan') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx" colspan="3"> Tidak memakan suatu jenis makanan</td>
            </tr>
            <tr class="">
              <td> </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ya'] ?? '', 'Menolak dilayani petugas yang beda jenis kelamin') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx" colspan="3"> Menolak dilayani petugas yang beda jenis kelamin</td>
            </tr>
            <tr class="">
              <td> </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ya'] ?? '', 'Menolak diberikan imunisasi pada anaknya') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx" colspan="3"> Menolak diberikan imunisasi pada anaknya</td>
            </tr>
            <tr class="">
              <td> </td>
              <td> </td>
              <td><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ya'] ?? '', 'Lainnya') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td class="lnx" colspan="3"> Lainnya : '.(!empty($data['nilai_lain'])?$data['nilai_lain']:'________________').' </td>
            </tr>
            <tr class="">
              <td colspan="6"> <u><b>KESIMPULAN :</b></u><br />
                '.((!empty($data['nilai_simpul']) && $data['nilai_simpul'] != '')?$data['nilai_simpul']:'').'
              </td>
            </tr>
            <tr>
              <td colspan="6" style="font-size:2px;">&nbsp; </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td></td>
      <td>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="">
          <tbody>
            <tr class="">
              <td colspan="2">Komunikasi dengan PPA</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ppa'] ?? '', 'DPJP') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">DPJP</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ppa'] ?? '', 'Perawat') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Perawat</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ppa'] ?? '', 'gizi') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Ahli gizi</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ppa'] ?? '', 'Farmasi') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Farmasi</td>
            </tr>
            <tr class="">
              <td width="10" class="bdlw"><img
                  src="'.IMG.'banner/'.(stripos($data['nilai_ppa'] ?? '', 'Lainnya') !== false?'square14_check':'square14_uncheck').'.png"
                  width="12" height="" /></td>
              <td width="" class="">Lainnya : '.(!empty($data['nilai_ppa_lain'])?$data['nilai_ppa_lain']:'________________').'</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
'; 

/*tanda tangan*/
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td></td>
            <td class="txc" >
              Klaten , '.(!empty($data['registered'])?date('d-m-Y', strtotime($data['registered'])):'___/___/_______ ').' Jam : '.(!empty($data['registered'])?date('H:i:s', strtotime($data['registered'])):'___/___ ').' WIB
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
          <td></td>
            <td width="300" class="txc" style="background-image:url('.(!empty($ttd_file) && $ttd_file!='' ? 'http://192.168.0.16/serverx/assets/rme/ttd_pasien/'.$ttd_file : (!empty($signature)?$signature:'')).'); opacity:0.5; background-image-resize:2; background-repeat:no-repeat; background-size:'.(!empty($ttd_file) && $ttd_file!='' ? '60px' : (!empty($signature)?'60px':'60px')).'; background-position:center;height:'.(!empty($ttd_file) && $ttd_file!='' ? '60px' : (!empty($signature)?'60px':'60px')).';">
                Pasien/Keluarga
                <br />
                <br />
                <br />

                '.(!empty($nama_ttd)?' '.$nama_ttd.' ': (!empty($signature_nama)?$signature_nama:' __________________________________ <br />Tanda tangan & Nama terang')).'
            </td>
            <td width="72"></td>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttd/'.($writer!=""?$writer:(!empty($signature_petugas)?$signature_petugas:'')).'.jpg\'); opacity:0.5; background-image-resize:2; background-repeat:no-repeat; background-size:60px; background-position:center;height:60px;">
                Petugas
                <br />
                <br />
                <br />

                '.(!empty($nama_petugas)?' '.$nama_petugas.' ':(!empty($signature_petugas_nama)?$signature_petugas_nama:' __________________________________ <br />Tanda tangan & Nama terang')).'
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
       
    </tbody>
  </table>'; 
/*end tanda tangan*/

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