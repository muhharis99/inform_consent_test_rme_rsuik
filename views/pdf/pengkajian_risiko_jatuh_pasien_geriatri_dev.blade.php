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

    .centang {
      font-family: "DejaVu Sans", sans-serif;
      font-size: 13px;
    }

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
    .txr { text-align:right; }
    .txl { text-align:left; }
    .txj { text-align:justify; }
    .txc { text-align:center; }
    td {
      text-align:left;
      vertical-align:top;
      padding:0 3px 0 3px;
    }
    .b   { font-weight:bold; }
    .ln1  { line-height:1px; }
    .ln2  { line-height:2px; }
    .ln3  { line-height:9px; }
    .ln4  { line-height:4px; }
    .ln5  { line-height:5px; }
    .ln6  { line-height:6px; }
    .ln7  { line-height:7px; }
    .ln8  { line-height:8px; }
    .ln9  { line-height:9px; }
    .ln10 { line-height:10px; }
    .ln11 { line-height:11px; }
    .ln12 { line-height:12px; }
    .ln13 { line-height:13px; }
    .ln14 { line-height:14px; }
    .ln15 { line-height:15px; }
    .ln16 { line-height:16px; }
    .ln17 { line-height:17px; }
    .ln18 { line-height:18px; }
    .ln19 { line-height:19px; }
    .ln20 { line-height:20px; }
    .ln21 { line-height:21px; }
    .ln22 { line-height:22px; }
    .ln23 { line-height:23px; }
    .ln24 { line-height:24px; }
    .ln25 { line-height:25px; }
    .ln26 { line-height:26px; }
    .ln27 { line-height:27px; }
    .ln28 { line-height:28px; }
    .ln29 { line-height:29px; }
    .ln30 { line-height:30px; }
    .ln33 { line-height:33px; }
    .ln50 { line-height:50px; }
    .lns  { line-height:16px; }
    .title td {
      line-height:20px;
      font-weight:bold;
    }
    .bdl { border-left:   0.5px solid black; }
    .bdr { border-right:  0.5px solid black; }
    .bdt { border-top:    0.5px solid black; }
    .bdb { border-bottom: 0.5px solid black; }
    .tableinzero table tr td { padding:0px; }
    .p0  { padding:0px; }
    .p-3 { padding:3px; }
    .sc14 { font-size:14px; }
    .sc13 { font-size:13px; }
    .bg-rendah { background-color: #ffd34d; }
    .bg-sedang { background-color: #57ff6d; }
    .bg-tinggi { background-color: #eb444c; }
  </style>
';

function cek($val) {
    return !empty($val)
        ? '<span class="centang"><b>&#10003;</b></span>'
        : '&nbsp;';
}

function hitungSkorGeriatri($m) {
    if (!$m || empty($m->waktu_pengkajian)) return null;

    $skor = 0;

    if (!empty($m->geri_riw_masuk_jatuh) || !empty($m->geri_riw_jatuh_2bulan)) {
        $skor += 6;
    }

    if (!empty($m->geri_mental_delirium) || !empty($m->geri_mental_disorientasi) || !empty($m->geri_mental_agitasi)) {
        $skor += 14;
    }

    if (!empty($m->geri_lihat_kacamata) || !empty($m->geri_lihat_buram) || !empty($m->geri_lihat_katarak)) {
        $skor += 1;
    }

    if (!empty($m->geri_kemih_perubahan)) {
        $skor += 2;
    }

    $total_tm = intval($m->geri_transfer) + intval($m->geri_mobilitas);
    if ($total_tm >= 4) {
        $skor += 7;
    }

    return $skor;
}

function bgSkor($skor) {
    if ($skor === null) return '';
    if ($skor <= 5)  return 'bg-rendah';
    if ($skor <= 16) return 'bg-sedang';
    return 'bg-tinggi';
}

function tdYaTdk($val) {
    $ya   = (!empty($val)) ? '<span class="centang"><b>&#10003;</b></span>' : '&nbsp;';
    $tdk  = (empty($val))  ? '<span class="centang"><b>&#10003;</b></span>' : '&nbsp;';
    return ['ya' => $ya, 'tdk' => $tdk];
}

$morse_array = is_array($morse_list) ? $morse_list : $morse_list->all();
$chunks = array_chunk($morse_array, 5);

foreach ($chunks as $chunk) {

    $kolom = $chunk;
    $kosong = 5 - count($kolom);
    for ($i = 0; $i < $kosong; $i++) {
        $kolom[] = null;
    }

    $th_tgl = '';
    $td_jam = '';
    $td_ket = '';

    foreach ($kolom as $m) {
        $tgl = '&nbsp;';
        $jam = '&nbsp;';
        if ($m && !empty($m->waktu_pengkajian)) {
            $exp = explode(' ', str_replace('T', ' ', $m->waktu_pengkajian));
            $tgl = !empty($exp[0]) ? date('d-m-Y', strtotime($exp[0])) : '&nbsp;';
            $jam = isset($exp[1]) ? substr($exp[1], 0, 5) : '&nbsp;';
        }
        $th_tgl .= '<th class="bdt bdr bdb lns bg-burem txc" width="30px">' . $tgl . '</th>';
        $td_jam .= '<td class="bdr bdb lns txc" width="30px">' . $jam . '</td>';
        $td_ket .= '<td class="bdr bdb lns txc" width="30px">&nbsp;</td>';
    }

    $latest = null;
    foreach ($kolom as $m) {
        if ($m && !empty($m->waktu_pengkajian)) {
            $latest = $m;
            break;
        }
    }

    $tbl = '';
    $tbl .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
    <!-- <tr>
      <td colspan="10">
        <b>Tanggal Masuk :</b> '.$tgl_masuk.' &nbsp;&nbsp; <b>Jam :</b> '.$jam_masuk.'
      </td>
    </tr> -->
      <tr>
        <td colspan="11" class="ln13 p-3">Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi 
        dan ketika tiba diruangan baru dan atau setelah pasien jatuh</td>
      </tr>
    </tbody>
    <tr>
      <th class="bdt bdr bdb bdl lns bg-burem txc" width="25" rowspan="3">NO</th>
      <th class="bdt bdr bdb lns bg-burem" colspan="2" rowspan="3" width="150px">FAKTOR RESIKO</th>
      <th class="bdt bdr bdb lns bg-burem txc" width="50px" rowspan="3">YA</th>
      <th class="bdt bdr bdb lns bg-burem txc" width="50px" rowspan="3">TIDAK</th>
      <th class="bdt bdr bdb lns bg-burem txc">TANGGAL</th>
      ' . $th_tgl . '
    </tr>
    <tr>
      <th class="bdr bdb lns bg-burem txc">JAM</th>
      ' . $td_jam . '
    </tr>
    <tr>
      <th class="bdr bdb lns bg-burem txc">KETERANGAN</th>
      ' . $td_ket . '
    </tr>';

    $v_masuk = tdYaTdk($latest ? ($latest->geri_riw_masuk_jatuh ?? null) : null);
    $v_2bln  = tdYaTdk($latest ? ($latest->geri_riw_jatuh_2bulan ?? null) : null);

    $tbl .= '
    <tr class="bdl bdr">
      <td class="bdr lns txc" rowspan="2">1</td>
      <td class="bdr lns" rowspan="2" width="20px"><b>Riwayat<br>Jatuh</b></td>
      <td class="bdr lns">Pasien masuk karena jatuh</td>
      <td class="bdr lns txc">' . $v_masuk['ya'] . '</td>
      <td class="bdr lns txc">' . $v_masuk['tdk'] . '</td>
      <td class="bdr ln12 p-3" rowspan="2">salah satu jawaban ya = 6</td>';
        foreach ($kolom as $m) {
            if (!$m || empty($m->waktu_pengkajian)) {
                $tbl .= '<td class="bdr lns txc" rowspan="2">&nbsp;</td>';
            } else {
                $skor_riw = (!empty($m->geri_riw_masuk_jatuh) || !empty($m->geri_riw_jatuh_2bulan)) ? '<b>6</b>' : '0';
                $tbl .= '<td class="bdr lns txc" rowspan="2">' . $skor_riw . '</td>';
            }
        }
    $tbl .= '
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns">Pasien pernah jatuh &lt; 2 bulan</td>
      <td class="bdr lns txc">' . $v_2bln['ya'] . '</td>
      <td class="bdr lns txc">' . $v_2bln['tdk'] . '</td>
    </tr>';

    $v_del  = tdYaTdk($latest ? ($latest->geri_mental_delirium     ?? null) : null);
    $v_dis  = tdYaTdk($latest ? ($latest->geri_mental_disorientasi ?? null) : null);
    $v_agi  = tdYaTdk($latest ? ($latest->geri_mental_agitasi      ?? null) : null);

    $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc" rowspan="3">2</td>
      <td class="bdr lns" rowspan="3"><b>Status<br>Mental</b></td>
      <td class="bdr ln12 p-3">Pasien dellirium ( tidak dapat membuat keputusan, pola pikir tidak terorganisir, gangguan daya ingat )</td>
      <td class="bdr lns txc">' . $v_del['ya'] . '</td>
      <td class="bdr lns txc">' . $v_del['tdk'] . '</td>
      <td class="bdr ln12 p-3" rowspan="3">salah satu jawaban ya = 14</td>';
        foreach ($kolom as $m) {
            if (!$m || empty($m->waktu_pengkajian)) {
                $tbl .= '<td class="bdr lns txc" rowspan="3">&nbsp;</td>';
            } else {
                $skor_mental = (!empty($m->geri_mental_delirium) || !empty($m->geri_mental_disorientasi) || !empty($m->geri_mental_agitasi)) ? '<b>14</b>' : '0';
                $tbl .= '<td class="bdr lns txc" rowspan="3">' . $skor_mental . '</td>';
            }
        }
    $tbl .= '
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">Pasien disorientasi ( tidak bisa menyebutkan waktu, tempat, orang )</td>
      <td class="bdr lns txc">' . $v_dis['ya'] . '</td>
      <td class="bdr lns txc">' . $v_dis['tdk'] . '</td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">Pasien agitasi ( ketakutan, cemas, dan gelisah )</td>
      <td class="bdr lns txc">' . $v_agi['ya'] . '</td>
      <td class="bdr lns txc">' . $v_agi['tdk'] . '</td>
    </tr>';

    $v_kaca  = tdYaTdk($latest ? ($latest->geri_lihat_kacamata ?? null) : null);
    $v_buram = tdYaTdk($latest ? ($latest->geri_lihat_buram    ?? null) : null);
    $v_katar = tdYaTdk($latest ? ($latest->geri_lihat_katarak  ?? null) : null);

    $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc" rowspan="3">3</td>
      <td class="bdr lns" rowspan="3"><b>Penglihatan</b></td>
      <td class="bdr lns">Pasien memakai kaca mata</td>
      <td class="bdr lns txc">' . $v_kaca['ya'] . '</td>
      <td class="bdr lns txc">' . $v_kaca['tdk'] . '</td>
      <td class="bdr lns" rowspan="3">Salah satu jawaban ya = 1</td>';
        foreach ($kolom as $m) {
            if (!$m || empty($m->waktu_pengkajian)) {
                $tbl .= '<td class="bdr lns txc" rowspan="3">&nbsp;</td>';
            } else {
                $skor_lihat = (!empty($m->geri_lihat_kacamata) || !empty($m->geri_lihat_buram) || !empty($m->geri_lihat_katarak)) ? '<b>1</b>' : '0';
                $tbl .= '<td class="bdr lns txc" rowspan="3">' . $skor_lihat . '</td>';
            }
        }
    $tbl .= '
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr lns">Pasien mengeluh penglihatan buram</td>
      <td class="bdr lns txc">' . $v_buram['ya'] . '</td>
      <td class="bdr lns txc">' . $v_buram['tdk'] . '</td>
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">Pasien katarak / glaukoma / de generasi macula / (umur &gt; 60 th)</td>
      <td class="bdr lns txc">' . $v_katar['ya'] . '</td>
      <td class="bdr lns txc">' . $v_katar['tdk'] . '</td>
    </tr>';

    $v_kemih = tdYaTdk($latest ? ($latest->geri_kemih_perubahan ?? null) : null);

    $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc">4</td>
      <td class="bdr lns"><b>Kebiasaan berkemih</b></td>
      <td class="bdr ln12 p-3">Ada perubahan perilaku berkemih (frekuensi, urgensi, inkontensia, nokturia)</td>
      <td class="bdr lns txc">' . $v_kemih['ya'] . '</td>
      <td class="bdr lns txc">' . $v_kemih['tdk'] . '</td>
      <td class="bdr lns">&nbsp;Ya = 2</td>';
        foreach ($kolom as $m) {
            if (!$m || empty($m->waktu_pengkajian)) {
                $tbl .= '<td class="bdr lns txc">&nbsp;</td>';
            } else {
                $skor_kemih = !empty($m->geri_kemih_perubahan) ? '<b>2</b>' : '0';
                $tbl .= '<td class="bdr lns txc">' . $skor_kemih . '</td>';
            }
        }
    $tbl .= '
    </tr>';

    $transfer_latest = $latest ? intval($latest->geri_transfer ?? -1) : -1;

    $transfer_opts = [
        0 => 'Mandiri ( boleh dengan alat bantu jalan )',
        1 => 'Perlu sedikit bantuan ( 1 orang dalam pengawasan )',
        2 => 'Butuh bantuan ( 2 orang )',
        3 => 'Tidak dapat duduk dengan seimbang (bantuan total)',
    ];

    $first_transfer = true;
    foreach ($transfer_opts as $val => $label) {
        if ($first_transfer) {
            $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc" rowspan="4">5</td>
      <td class="bdr lns" rowspan="4"><b>Transfer<br>dari TT ke<br>kursi &amp;<br>ke TT</b></td>
      <td class="bdr lns">' . $label . '</td>
      <td class="bdr lns txc">' . ($transfer_latest === $val ? '<b>' . $val . '</b>' : '&nbsp;') . '</td>
      <td class="bdr lns txc">&nbsp;</td>
      <td class="bdr lns" rowspan="8">jumlahkan nilai transfer &amp; mobilitas. Jika nilai total 0-3 maka score = 0 jumlahkan nilai total 4-6 maka score = 7</td>';
                foreach ($kolom as $m) {
                    if (!$m || empty($m->waktu_pengkajian)) {
                        $tbl .= '<td class="bdr lns txc" rowspan="8">&nbsp;</td>';
                    } else {
                        $total_tm = intval($m->geri_transfer) + intval($m->geri_mobilitas);
                        $skor_tm  = ($total_tm >= 4) ? '<b>7</b>' : '0';
                        $tbl .= '<td class="bdr lns txc" rowspan="8">' . $skor_tm . '</td>';
                    }
                }
            $tbl .= '
    </tr>';
            $first_transfer = false;
        } else {
            $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">' . $label . '</td>
      <td class="bdr lns txc">' . ($transfer_latest === $val ? '<b>' . $val . '</b>' : '&nbsp;') . '</td>
      <td class="bdr lns txc">&nbsp;</td>
    </tr>';
        }
    }

    $mobilitas_latest = $latest ? intval($latest->geri_mobilitas ?? -1) : -1;

    $mobilitas_opts = [
        0 => 'Mandiri ( boleh dengan alat bantu jalan )',
        1 => 'Berjalan dengan bantuan 1 orang (verbal/fisik)',
        2 => 'Menggunakan kursi roda',
        3 => 'Imobilisasi',
    ];

    $first_mob = true;
    foreach ($mobilitas_opts as $val => $label) {
        if ($first_mob) {
            $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns txc" rowspan="4">6</td>
      <td class="bdr lns" rowspan="4"><b>Mobilitas</b></td>
      <td class="bdr lns">' . $label . '</td>
      <td class="bdr lns txc">' . ($mobilitas_latest === $val ? '<b>' . $val . '</b>' : '&nbsp;') . '</td>
      <td class="bdr lns txc">&nbsp;</td>
    </tr>';
            $first_mob = false;
        } else {
            $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr ln12 p-3">' . $label . '</td>
      <td class="bdr lns txc">' . ($mobilitas_latest === $val ? '<b>' . $val . '</b>' : '&nbsp;') . '</td>
      <td class="bdr lns txc">&nbsp;</td>
    </tr>';
        }
    }

    $tbl .= '
    <tr class="bdl bdr bdt">
      <td class="bdr lns b" colspan="6"><b>TOTAL SCORE</b></td>';
        foreach ($kolom as $m) {
            if (!$m || empty($m->waktu_pengkajian)) {
                $tbl .= '<td class="bdr lns txc">&nbsp;</td>';
            } else {
                $total = hitungSkorGeriatri($m);
                $bg    = bgSkor($total);
                $tbl .= '<td class="bdr lns txc b ' . $bg . '">' . $total . '</td>';
            }
        }
    $tbl .= '
    </tr>

</table>';

    $tbl .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bdl bdr bdt bdb">
    <td class="bdr lns"><b>Keterangan score :</b></td>
    <td class="lns bg-rendah txc">&nbsp;0 - 5 : resiko rendah&nbsp;</td>
    <td class="lns bg-sedang txc">&nbsp;6 - 16 : resiko sedang&nbsp;</td>
    <td class="lns bg-tinggi txc">&nbsp;17 - 30 : resiko tinggi&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" class="ln5">&nbsp;</td>
  </tr>
</table>
';

    $html .= $tbl;

    $th_tgl_interv = '';
    $td_jam_interv = '';
    foreach ($kolom as $m) {
        $tgl = '&nbsp;';
        $jam = '&nbsp;';
        if ($m && !empty($m->waktu_pengkajian)) {
            $exp = explode(' ', str_replace('T', ' ', $m->waktu_pengkajian));
            $tgl = !empty($exp[0]) ? date('d-m-Y', strtotime($exp[0])) : '&nbsp;';
            $jam = isset($exp[1]) ? substr($exp[1], 0, 5) : '&nbsp;';
        }
        $th_tgl_interv .= '<th class="bdt bdr bdb lns txc" width="30px">' . $tgl . '</th>';
        $td_jam_interv .= '<th class="bdr bdb lns txc">' . $jam . '</th>';
    }

    $html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">

  <tr>
    <th class="bdt bdb bdl lns bg-burem" rowspan="2" width="20">&nbsp;</th>
    <th class="bdt bdr bdb lns bg-burem" colspan="2" rowspan="2">
      Intervensi pencegahan risiko jatuh, beri tanda centang 
      ( <span class="centang">&#10003;</span> )
    </th>
    <th class="bdt bdr bdb lns bg-burem txc" width="60">Tanggal</th>
    ' . $th_tgl_interv . '
  </tr>
  <tr>
    <th class="bdt bdr bdb lns bg-burem txc">Jam</th>
    ' . $td_jam_interv . '
  </tr>

  <tr class="bdl bdr">
    <th class="bdr lns bg-burem" rowspan="7" width="30" style="font-size:12px; text-align:center; vertical-align:middle; text-rotate:90;">
      Risiko Rendah (RR)
    </th>
    <td class="bdr lns" width="20">1</td>
    <td class="bdr lns" colspan="2">Orientasi lingkungan</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_orientasi ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">2</td>
    <td class="bdr lns" colspan="2">Pastikan bel mudah dijangkau</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_bel ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">3</td>
    <td class="bdr lns" colspan="2">Roda tempat tidur berada pada posisi terkunci</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_roda_kunci ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">4</td>
    <td class="bdr lns" colspan="2">Posisikan tempat tidur pada posisi terendah</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_bed_rendah ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">5</td>
    <td class="bdr lns" colspan="2">Naikkan pagar pengaman tempat tidur</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_pagar_bed ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">6</td>
    <td class="bdr lns" colspan="2">Pastikan lampu tidur hidup saat malam hari</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_lampu_malam ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">7</td>
    <td class="bdr lns" colspan="2">Berikan edukasi pasien</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rr_edukasi ?? null) . '</td>';
        }
    $html .= '
  </tr>

  <tr><td class="bdt bdr bdb bdl lns" colspan="' . (4 + count($kolom)) . '">&nbsp;</td></tr>

  <tr class="bdl bdr bdt">
    <th class="bdr lns bg-burem" rowspan="3" style="font-size:12px; text-align:center; vertical-align:middle; text-rotate:90;">
      Risiko Sedang (RS)
    </th>
    <td class="bdr lns">1</td>
    <td class="bdr ln12 p-3" colspan="2">Lakukan semua pedoman pencegahan jatuh risiko rendah</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rs_semua_rr ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">2</td>
    <td class="bdr ln12 p-3" colspan="2">Beri tanda segitiga warna kuning pada bed pasien, pintu atau RM pasien</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rs_tanda_kuning ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">3</td>
    <td class="bdr ln12 p-3" colspan="2">Pasangkan gelang kuning pada pasien<br/><br/><br/><br/><br/></td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rs_gelang_kuning ?? null) . '</td>';
        }
    $html .= '
  </tr>

  <tr><td class="bdl bdr bdt bdb lns" colspan="' . (4 + count($kolom)) . '">&nbsp;</td></tr>

  <tr class="bdl bdr bdt">
    <th class="bdr lns bg-burem" rowspan="5" style="font-size:12px; text-align:center; vertical-align:middle; text-rotate:90;">
      Risiko Tinggi (RT)
    </th>
    <td class="bdr lns">1</td>
    <td class="bdr ln12 p-3" colspan="2">Lakukan semua pedoman pencegahan jatuh risiko rendah dan sedang</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rt_semua_rr_rs ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">2</td>
    <td class="bdr lns" colspan="2">Kunjungi dan monitor pasien setiap jam</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rt_monitor_jam ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">3</td>
    <td class="bdr ln12 p-3" colspan="2">Tempatkan pasien di kamar yang paling dekat dengan <i>nurse station</i> (bila mungkin)</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rt_dekat_nurse ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">4</td>
    <td class="bdr lns" colspan="2">Pastikan pasien di kamar menggunakan alat bantu jalan</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rt_alat_bantu ?? null) . '</td>';
        }
    $html .= '
  </tr>
  <tr class="bdl bdr bdt">
    <td class="bdr lns">5</td>
    <td class="bdr lns" colspan="2">Libatkan keluarga untuk mengawasi pasien</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="bdr lns txc">' . cek($m->interv_g_rt_keluarga_awasi ?? null) . '</td>';
        }
    $html .= '
  </tr>

  <tr class="bdl bdr bdt bdb bg-burem">
    <td class="bdr ln15 b" colspan="4">Nama dan paraf melakukan intervensi pencegahan risiko jatuh</td>';
        foreach ($kolom as $m) {
            $isi = '&nbsp;';
            if ($m) {
                $ttd  = '';
                $nama = $m->nama_karya ?? '';
                if (!empty($m->writer)) {
                    $ttd = '<img src="' . IMG . 'ttd/' . $m->writer . '.jpg" width="65"><br>';
                }
                $isi = '<div style="text-align:center;">'
                     . $ttd
                     . '<span style="font-size:10px; font-weight:bold;">' . $nama . '</span>'
                     . '</div>';
            }
            $html .= '<td class="bdr lns bg0 txc">' . $isi . '</td>';
        }
    $html .= '
  </tr>

</table>
';

}

$pdf->WriteHTML($html);

$file = DOC_FILE;
if ($pdf_type == 'F') {
    $ip = getenv('HTTP_CLIENT_IP')       ?:
          getenv('HTTP_X_FORWARDED_FOR') ?:
          getenv('HTTP_X_FORWARDED')     ?:
          getenv('HTTP_FORWARDED_FOR')   ?:
          getenv('HTTP_FORWARDED')       ?:
          getenv('REMOTE_ADDR');

    if ($ip == '::1') $ip = '127.0.0.1';

    $dir = FCPATH . "assets/rme/pdf/$ip/";
    if (!file_exists($dir)) {
        mkdir($dir, 0777);
    }
    $file = $dir . DOC_FILE;
    $pdf->Output($file, $pdf_type);

    if (!empty($lp_print)) {
        $cmd  = "lp $file -d $printer";
        shell_exec($cmd);
        $data = [
            "status"  => true,
            "pdf"     => $file,
            "printer" => $printer,
        ];
        echo json_encode($data);
        die();
    }
} else {
    $pdf->Output($file, $pdf_type);
}
?>