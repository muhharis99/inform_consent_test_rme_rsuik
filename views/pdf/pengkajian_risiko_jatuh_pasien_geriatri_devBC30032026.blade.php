<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/04.6'); 
define('DOC_FILE', 'Pengkajian-Resiko-Jatuh-Pasien-Geriatri.pdf'); 
define('DOC_TITLE', 'PENGKAJIAN RESIKO JATUH<br>PASIEN GERIATRI <i>(Ontario Modified Stratify - Sidney Score)</i>'); 
define('DOC_SUBJECT', 'Pengkajian Resiko Jatuh Pasien Geriatri'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 6, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
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
      line-height:25px;
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
       border-left: 0.5px solid black;
    }
    .bdr{
       border-right: 0.5px solid black;
    }
    .bdt {
       border-top: 0.5px solid black;
    }
    .bdb{
       border-bottom: 0.5px solid black;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;

    .sc14 {
      font-size :14px;
    }
    .sc13 {
      font-size :13px;
    }
    .bg-rendah {
      background-color: #ffd34d;
    }
    .bg-sedang {
      background-color: #57ff6d;
    }
    .bg-tinggi {
      background-color: #eb444c;
    }
    .p-3 {
     padding:3px;
    }
  </style>
'; 
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .='<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
  <tr>
    <td class="ln13 p-3">Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi dan ketika tiba diruangan baru dan atau setelah pasien jatuh</td>
  </tr>
</tbody>
</table>';

function cek($val){
  return !empty($val)
    ? '<img src="'.IMG.'banner/blank_check.png" width="10">'
    : '-';
}

$morse_array = is_array($morse_list) ? $morse_list : $morse_list->all();
$chunks = array_chunk($morse_array, 5);

foreach ($chunks as $chunk) {

  $kolom = $chunk;
  $kosong = 5 - count($kolom);
  for ($i = 0; $i < $kosong; $i++) {
    $kolom[] = null;
  }

  /* tanggal dan jam */
  $kolom_tgl = '';
  $kolom_jam = '';

  foreach ($kolom as $m) {
    $tgl = '-';
    $jam = '-';

    if ($m && !empty($m->registered)) {
      $exp = explode(' ', str_replace('T',' ',$m->registered));
      $tgl = $exp[0] ?? '-';
      $jam = isset($exp[1]) ? substr($exp[1],0,5) : '-';
    }

    $kolom_tgl .= '<td width="72px" class="bg-burem b">'.$tgl.'</td>';
    $kolom_jam .= '<td width="72px" class="bg-burem b">'.$jam.'</td>';
  }

  $html .= '
  <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; table-layout:fixed;">

      <tr>
        <th class="bg-burem" rowspan="3" width="20px">NO</th>
        <th class="bg-burem" colspan="4" rowspan="3">FAKTOR RESIKO</th>
        <th class="bg-burem" width="30px">TANGGAL</th>
        '.implode('', array_map(function($m){
            $tgl = '-';
            if ($m && !empty($m->registered)) {
                $exp = explode(' ', str_replace('T',' ',$m->registered));
                $tgl = !empty($exp[0]) ? date('d-m-Y', strtotime($exp[0])) : '-';
            }
            return '<td width="72px" class="bg-burem b">'.$tgl.'</td>';
        }, $kolom)).'
      </tr>

      <tr>
        <th class="bg-burem">JAM</th>
        '.$kolom_jam.'
      </tr>

      <tr class="bg-burem">
        <th>KET</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td rowspan="2">1</td>
        <td rowspan="2" width="20px"><b>Riwayat Jatuh</b></td>
        <td colspan="4">Pasien masuk karena jatuh</td>';
          foreach ($kolom as $m) {
            // Ya = 6, Tidak = 0
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_riw_masuk_jatuh ? '6' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Pasien pernah jatuh &lt; 2 bulan</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_riw_jatuh_2bulan ? '6' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td rowspan="3">2</td>
        <td rowspan="3"><b>Status Mental</b></td>
        <td colspan="4">Pasien dellirium ( tidak dapat membuat keputusan, pola pikir tidak terorganisir,gangguan daya ingat )</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mental_delirium ? '14' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td colspan="4">Pasien disorientasi ( tidak bisa menyebutkan waktu, tempat, orang )</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mental_disorientasi ? '14' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td colspan="4">Pasien agitasi ( ketakutan, cemas, dan gelisah )</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mental_agitasi ? '14' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr>
        <td rowspan="3">3</td>
        <td rowspan="3"><b>Penglihatan</b></td>
        <td colspan="4">Pasien memakai kaca mata</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_lihat_kacamata ? '1' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Pasien mengeluh penglihatan buram</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_lihat_buram ? '1' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Pasien katarak / glaukoma / de generasi macula / (umur &gt; 60 th)</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_lihat_katarak ? '1' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td>4</td>
        <td><b>Kebiasaan berkemih</b></td>
        <td colspan="4">Ada perubahan perilaku berkemih (frekuensi,urgensi,inkontensia, nokturia)</td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_kemih_perubahan ? '2' : '0') : '-') . '</td>';
          }
    $html .= '
      </tr>

      <tr>
        <td rowspan="4">5</td>
        <td rowspan="4"><b>Transfer dari TT ke kursi &amp; ke TT</b></td>
        <td colspan="4">Mandiri ( boleh dengan alat bantu jalan )</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_transfer == 0 ? '0' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Perlu sedikit bantuan ( 1 orang dalam pengawasan )</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_transfer == 1 ? '1' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Butuh bantuan ( 2 orang )</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_transfer == 2 ? '2' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr>
        <td colspan="4">Tidak dapat duduk dengan seimbang (bantuan total)</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_transfer == 3 ? '3' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td rowspan="4">6</td>
        <td rowspan="4"><b>Mobilitass</b></td>
        <td colspan="4">Mandiri ( boleh dengan alat bantu jalan )</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mobilitas == 0 ? '0' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td colspan="4">Berjalan dengan bantuan 1 orang (verbal/fisik)</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mobilitas == 1 ? '1' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td colspan="4">Menggunakan kursi roda</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mobilitas == 2 ? '2' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr class="bg-burem1">
        <td colspan="4">Imobilisasi</td>';
      foreach ($kolom as $m) {
        $html .= '<td class="txc">' . ($m && $m->registered ? ($m->geri_mobilitas == 3 ? '3' : '-') : '-') . '</td>';
      }
    $html .= '
      </tr>

      <tr class="bg-burem">
        <td colspan="6"><b>TOTAL SCORE</b></td>';
          foreach ($kolom as $m) {
            $html .= '<td class="txc">'.($m->geri_total_skor ?? '-').'</td>';
          }
    $html .= '
      </tr>
  </table>
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="bg-burem">
      <td class="lns custom-text2"><b>Keterangan score :</b></td>
      <td class="lns custom-text2 bg-rendah"> 0 - 5 : resiko rendah </td>
      <td class="lns custom-text2 bg-sedang"> 6 - 16 : resiko sedang </td>
      <td class="lns custom-text2 bg-tinggi"> 17 - 30 : resiko tinggi </td>
    </tr>
  </table>
  ';

  /* ================= TABEL INTERVENSI ================= */

  $intervensi = [
    'RISIKO RENDAH (RR)' => [
      'Orientasi lingkungan' => 'interv_g_rr_orientasi',
      'Pastikan bel mudah dijangkau' => 'interv_g_rr_bel',
      'Roda tempat tidur berada pada posisi terkunci' => 'interv_g_rr_roda_kunci',
      'Posisikan tempat tidur pada posisi terendah' => 'interv_g_rr_bed_rendah',
      'Naikkan pagar pengaman tempat tidur' => 'interv_g_rr_pagar_bed',
      'Pastikan lampu tidur hidup saat malam hari' => 'interv_g_rr_lampu_malam',
      'Berikan edukasi pasien' => 'interv_g_rr_edukasi'
    ],
    'RISIKO SEDANG (RS)' => [
      'Lakukan semua pedoman pencegahan jatuh risiko rendah' => 'interv_g_rs_semua_rr',
      'Beri tanda segitiga warna kuning pada bed pasien, pintu atau RM pasien' => 'interv_g_rs_tanda_kuning',
      'Pasangkan gelang kuning pada pasien' => 'interv_g_rs_gelang_kuning'
    ],
    'RISIKO TINGGI (RT)' => [
      'Lakukan semua pedoman pencegahan jatuh risiko rendah dan sedang' => 'interv_g_rt_semua_rr_rs',
      'Kunjungi dan monitor pasien setiap jam' => 'interv_g_rt_monitor_jam',
      'Tempatkan pasien di kamar yang paling dekat dengan nurse station (bila mungkin)' => 'interv_g_rt_dekat_nurse',
      'Pastikan pasien di kamar menggunakan alat bantu jalan' => 'interv_g_rt_alat_bantu',
      'Libatkan keluarga untuk mengawasi pasien' => 'interv_g_rt_keluarga_awasi'
    ]
  ];

  $html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; table-layout:fixed;">
  <tr>
    <th class="bg-burem" rowspan="2" width="20px"></th>
    <th class="bg-burem" width="" colspan="2" rowspan="2">Intervensi</th>
    <th class="bg-burem" width="">Tanggal</th>';

    foreach ($kolom as $m) {
      $tgl = '-';

      if ($m && !empty($m->registered)) {
        $exp = explode(' ', str_replace('T',' ',$m->registered));
        $tgl = !empty($exp[0]) ? date('d-m-Y', strtotime($exp[0])) : '-';
      }

      $html .= '<th class="bg-burem" width="72px">'.$tgl.'</th>';
    }

  $html .= '
  </tr>
  <tr>
    <th class="bg-burem">Jam</th>';

    foreach ($kolom as $m) {
      $jam = '-';
      if ($m && !empty($m->registered)) {
        $exp = explode(' ', str_replace('T',' ',$m->registered));
        $jam = isset($exp[1]) ? substr($exp[1],0,5) : '-';
      }
      $html .= '<th class="bg-burem">'.$jam.'</th>';
    }

  $html .= '</tr>';

  foreach ($intervensi as $judul => $items) {
    $no = 1;
    foreach ($items as $label => $field) {

      $html .= '<tr>
        '.($no==1?'<th style="text-rotate:90" class="bg-burem" rowspan="'.count($items).'">'.$judul.'</th>':'').'
        <td width="20px">'.$no.'</td>
        <td colspan="2">'.$label.'</td>';

      foreach ($kolom as $m) {
        $html .= '<td class="txc">'.cek($m->$field ?? null).'</td>';
      }

      $html .= '</tr>';
      $no++;
    }
  }

    $html .= '

  <tr>
    <td colspan="4" class="bg-burem b">Ttd dan Nama yang melakukan pengkajian</td>
    ';
  foreach ($kolom as $m) {

    $isi = '-';

    if ($m) {

        $ttd = '';
        $nama = $m->nama_karya ?? '';

        if (!empty($m->writer)) {
            $ttd = '<img src="'.IMG.'ttd/'.$m->writer.'.jpg" width="35" style="opacity:0.45;"><br>';
        }

        $isi = '
        <div style="text-align:center;">
            '.$ttd.'
            <span style="font-size:10px;font-weight:bold">'.$nama.'</span>
        </div>';
    }

    $html .= '<td class="txc bg-burem">'.$isi.'</td>';
}

$html .= '
</tr>
';

  $html .= '</table>';
}

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