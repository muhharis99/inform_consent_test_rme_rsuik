<?php
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Agustus 2022');
define('DOC_NOMER', 'FM/RM/04.3'); 
define('DOC_TITLE', 'PENGKAJIAN DAN INTERVENSI<br>RISIKO JATUH PASIEN ANAK<br><i>(HUPMPTY DUMPTY)</i>'); 
define('DOC_SUBJECT', 'Pengkajian dan Intervensi Risiko Jatuh Pasien Anak Humpty Dumpty'); 
define('DOC_FILE', 'Pengkajian-Dan-Intevensi-Resiko-Jatuh-Pasien-Anak-Humpty-Dumpty.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 33, 10, 5, 6, 'P');
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
    .ln26 {
      line-height:26px;
      font-size :20px;
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
    .{
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

    .sc14 {
      font-size :14px;
    }
    .sc13 {
      font-size :13px;
    }
    .lnx {
      line-height:29px;
    }
  </style>
'; 
$html .='';
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}

$hump_usia = '';
$hump_jenkel = '';
$hump_diagnosa = '';
$hump_gkof = '';
$hump_flingkungan = '';
$hump_respon_anes = '';
$hump_medika = '';
$user = '';
$nama = '';

/* intervensi */
$interv_a_minta_bantuan = '';
$interv_a_bel_jangkau = '';
$interv_a_barang_dekat = '';
$interv_a_bed_rendah_kunci = '';
$interv_a_pakaian_aman = '';
$interv_a_transfer = '';
$interv_a_pengaman_bed = '';
$interv_a_gelang_kuning = '';
$interv_a_tanda_risiko = '';
$interv_a_restrain = '';
$interv_a_toileting = '';
$interv_a_edukasi_obat = '';
$interv_a_orientasi_ruang = '';
$interv_a_orientasi_kamar = '';
$interv_a_bel = '';
$interv_a_pakaian = '';
$interv_a_eliminasi = '';
$interv_a_barang_aman = '';
$interv_a_libatkan_keluarga = '';
$interv_a_penerangan = '';
$interv_a_dokumentasi = '';

if (!empty($morse_list)) {
    if (is_array($morse_list)) {
        $first = $morse_list[0];
    } else {
        $first = $morse_list->first();
    }

    if (!empty($first)) {
        $hump_usia         = $first->hump_usia;
        $hump_jenkel       = $first->hump_jenkel;
        $hump_diagnosa     = $first->hump_diagnosa;
        $hump_gkof         = $first->hump_gkof;
        $hump_flingkungan  = $first->hump_flingkungan;
        $hump_respon_anes  = $first->hump_respon_anes;
        $hump_medika       = $first->hump_medika;
        $user              = $first->user;
        $nama              = $first->nama;

        /* intervensi */
        $interv_a_minta_bantuan     = $first->interv_a_minta_bantuan;
        $interv_a_bel_jangkau       = $first->interv_a_bel_jangkau;
        $interv_a_barang_dekat      = $first->interv_a_barang_dekat;
        $interv_a_bed_rendah_kunci  = $first->interv_a_bed_rendah_kunci;
        $interv_a_pakaian_aman      = $first->interv_a_pakaian_aman;
        $interv_a_transfer          = $first->interv_a_transfer;
        $interv_a_pengaman_bed      = $first->interv_a_pengaman_bed;
        $interv_a_gelang_kuning     = $first->interv_a_gelang_kuning;
        $interv_a_tanda_risiko      = $first->interv_a_tanda_risiko;
        $interv_a_restrain          = $first->interv_a_restrain;
        $interv_a_toileting         = $first->interv_a_toileting;
        $interv_a_edukasi_obat      = $first->interv_a_edukasi_obat;
        $interv_a_orientasi_ruang   = $first->interv_a_orientasi_ruang;
        $interv_a_orientasi_kamar   = $first->interv_a_orientasi_kamar;
        $interv_a_bel               = $first->interv_a_bel;
        $interv_a_pakaian           = $first->interv_a_pakaian;
        $interv_a_eliminasi         = $first->interv_a_eliminasi;
        $interv_a_barang_aman       = $first->interv_a_barang_aman;
        $interv_a_libatkan_keluarga = $first->interv_a_libatkan_keluarga;
        $interv_a_penerangan        = $first->interv_a_penerangan;
        $interv_a_dokumentasi       = $first->interv_a_dokumentasi;
    }
}

$morse_array = is_array($morse_list) ? $morse_list : $morse_list->all();
$chunks = array_chunk($morse_array, 5);

/* fungsi skor */
function skorUsia($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorJenkel($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorDiagnosa($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorGkof($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorFlingkungan($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorResponAnes($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
function skorMedika($nilai, $target) {
    return ((int)$nilai === (int)$target) ? $target : '-';
}
/*fungsi intervensi*/
function cekIntervensi($nilai) {
    return ((int)$nilai === 1) ? '<img src="'.IMG.'banner/blank_check.png" width="10">' : '';
}

$html .='
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
<tbody>
<tr>
<td class="ln18">
Pengkajian resiko jatuh dilakukan saat pasien masuk, ketika terjadi perubahan kondisi
dan ketika tiba diruangan baru dan atau setelah pasien jatuh
</td>
</tr>
</tbody>
</table>';

foreach ($chunks as $index => $chunk) {

    $kolom = $chunk;
    $kosong = 5 - count($kolom);
    for ($i = 0; $i < $kosong; $i++) {
        $kolom[] = null;
    }

    $total_kolom = [];
    foreach ($kolom as $m) {
        if ($m) {
            $total =
                (int)$m->hump_usia +
                (int)$m->hump_jenkel +
                (int)$m->hump_diagnosa +
                (int)$m->hump_gkof +
                (int)$m->hump_flingkungan +
                (int)$m->hump_respon_anes +
                (int)$m->hump_medika;
        } else {
            $total = '-';
        }
        $total_kolom[] = $total;
    }

    $html .= '
    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
    <tr class="bg-burem">
      <th style="text-rotate:90" class="txc" rowspan="26" width="20">FAKTOR RISIKO</th>
      <th class="txc" colspan="2" rowspan="3">FAKTOR RISIKO</th>
      <th class="bg-burem">Tgl<br>Jam</th>';

    foreach ($kolom as $m) {
    $tgl = '-';
    $jam = '';

    if ($m && !empty($m->waktu_pengkajian)) {
        $dt = str_replace('T',' ', $m->waktu_pengkajian);

        $tgl = date('d-m-Y', strtotime($dt));
        $jam = date('H:i:s', strtotime($dt));
    }

    $html .= '<td class="txc bg-burem b" style="width:60px;">'.$tgl.'<br>'.$jam.'</td>';
}

    $html .= '</tr>
    <tr class="bg-burem"></tr>
    <tr>
      <th class="bg-burem">SKOR</th>
      <th class="bg-burem" colspan="5"></th>
    </tr>';

    /*USIA*/
    $html .= '
    <tr>
    <td rowspan="4" width="80">USIA</td>
    <td width="275">&nbsp;1 bulan-3 tahun</td>
    <td class="txc" width="40">4</td>';

    foreach ($kolom as $m) {
        $nilai = ($m ? skorUsia($m->hump_usia,4) : '-');
        $html .= '<td class="txc" width="60">'.$nilai.'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td width="275">&nbsp;4-7 tahun</td>
    <td class="txc" width="40">3</td>';

    foreach ($kolom as $m) {
        $nilai = ($m ? skorUsia($m->hump_usia,3) : '-');
        $html .= '<td class="txc" width="60">'.$nilai.'</td>';
    }
    $html .= '</tr>';


    $html .= '
    <tr>
    <td>&nbsp;8-12 tahun</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorUsia($m->hump_usia,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;13-14 tahun</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorUsia($m->hump_usia,1) : '-').'</td>';
    }
    $html .= '</tr>';

    /*JENIS KELAMIN*/
    $html .= '
    <tr class="bg-burem1">
    <td rowspan="2">JENIS KELAMIN</td>
    <td>&nbsp;LAKI-LAKI</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorJenkel($m->hump_jenkel,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem1">
    <td>&nbsp;PEREMPUAN</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorJenkel($m->hump_jenkel,1) : '-').'</td>';
    }
    $html .= '</tr>';

    /*DIAGNOSIS*/
    $html .= '
    <tr>
    <td rowspan="4">DIAGNOSIS</td>
    <td>&nbsp;Diagnosis neurologi dan atau gelisah</td>
    <td class="txc">4</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorDiagnosa($m->hump_diagnosa,4) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Perubahan oksigenasi (diagnosis respiratorik, dehisrasi, anemia, anoreksia,sinkop, pusing, dll)</td>
    <td class="txc">3</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorDiagnosa($m->hump_diagnosa,3) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Gangguan perilaku/psikiatri</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorDiagnosa($m->hump_diagnosa,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Diagnosis lain</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorDiagnosa($m->hump_diagnosa,1) : '-').'</td>';
    }
    $html .= '</tr>';

    /*GANGGUAN KOGNITIF*/
    $html .= '
    <tr class="bg-burem1">
    <td rowspan="3">GANGGUAN KOGNITIF</td>
    <td>&nbsp;Tidak sadar akan keterbatasannya (contoh: umur < 5 th, gangguan mental, DLL)</td>
    <td class="txc">3</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorGkof($m->hump_gkof,3) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem1">
    <td>&nbsp;Lupa akan keterbatasannya</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorGkof($m->hump_gkof,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem1">
    <td>&nbsp;Orientasi/sadar penuh</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorGkof($m->hump_gkof,1) : '-').'</td>';
    }
    $html .= '</tr>';

    /*FAKTOR LINGKUNGAN*/
    $html .= '
    <tr>
    <td rowspan="4">FAKTOR LINGKUNGAN</td>
    <td>&nbsp;Riwayat jatuh < 3 th atau saat bayi/anak usia todler diletakkan di bed dewasa</td>
    <td class="txc">4</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorFlingkungan($m->hump_flingkungan,4) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Pasien menggunakan alat bantu atau bayi/anak usia todler dalam box</td>
    <td class="txc">3</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorFlingkungan($m->hump_flingkungan,3) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Pasien di tempat tidur saat perawatan</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorFlingkungan($m->hump_flingkungan,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Pasien dapat melakukan aktivitas diluar ruang rawat</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorFlingkungan($m->hump_flingkungan,1) : '-').'</td>';
    }
    $html .= '</tr>';

    /*RESPON TERHADAP PEMBEDAHAN/ SEDASI / ANESTESI*/
    $html .= '
    <tr class="bg-burem1">
    <td rowspan="3">RESPON TERHADAP PEMBEDAHAN/ SEDASI / ANESTESI</td>
    <td>&nbsp;Dalam 24 jam</td>
    <td class="txc">3</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorResponAnes($m->hump_respon_anes,3) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem1">
    <td>&nbsp;Dalam 48 jam</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorResponAnes($m->hump_respon_anes,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem1">
    <td>&nbsp;> 48 jam/tidak menjalani pembedahan/sedasi/anestesi</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorResponAnes($m->hump_respon_anes,1) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td rowspan="3">PENGGUNAAN MEDIKAMENTOSA</td>
    <td>&nbsp;Penggunaan multiple : sedative, obat hipnotis, barbitutas, fenoatiazin, antidepresan, pencahar, diuretik, narkose</td>
    <td class="txc">3</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorMedika($m->hump_medika,3) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Menggunakan salah satu obat-obatan diatas</td>
    <td class="txc">2</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorMedika($m->hump_medika,2) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td>&nbsp;Menggunakan obat lain</td>
    <td class="txc">1</td>';
    foreach ($kolom as $m) {
        $html .= '<td align="center">'.($m ? skorMedika($m->hump_medika,1) : '-').'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem">
    <td colspan="4"><b>TOTAL SKOR (7-11 = RESIKO RENDAH; 12-23 = RESIKO TINGGI)</b></td>';
    foreach ($total_kolom as $t) {
        $html .= '<td class="txc b">'.$t.'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem">
    <td colspan="4"><b>HASIL SKOR JATUH</b></td>';
    foreach ($total_kolom as $t) {
        $label = '-';
        if ($t !== '-' && is_numeric($t)) {
            if ($t >= 7 && $t <= 11) $label = 'RR';
            elseif ($t >= 12 && $t <= 23) $label = 'RT';
        }
        $html .= '<td class="txc b">'.$label.'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr class="bg-burem">
    <td colspan="4"><b>TTD DAN NAMA PENGKAJI</b></td>';
        foreach ($kolom as $m) {

        $isi = '-';

        if ($m) {

            $ttd = '';
            $nama = $m->nama_karya ?? '';

            if (!empty($m->ttd_perawat)) {
                $ttd = '<img src="'.$m->ttd_perawat.'" width="45" style="opacity:0.85;"><br>';
            }

            $isi = '
            <div style="text-align:center;">
                '.$ttd.'
                <span style="font-size:10px;font-weight:bold">'.$nama.'</span>
            </div>';
        }

        $html .= '<td align="center">'.$isi.'</td>';
    }
    $html .= '</tr>
    </tbody>
    </table><br>';

    $html .='
    <table border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse: collapse; table-layout:fixed;">
      <tr>
          <td class="txc bg-burem" colspan="2"><b>PENCEGAHAN PASIEN JATUH<br>
          Beri tanda ( <img src="'.IMG.'banner/blank_check.png" width="12"> ) pada tindakan yang dilakukan</b></td>
          <th class="bg-burem" style="width:60px;">Tgl<br>Jam</th>';

    foreach ($kolom as $m) {
    $tgl = '-';
    $jam = '';

    if ($m && !empty($m->waktu_pengkajian)) {
        $dt = str_replace('T',' ', $m->waktu_pengkajian);
        $time = strtotime($dt);

        if ($time) {
            $tgl = date('d-m-Y', $time);
            $jam = date('H:i:s', $time);
        }
    }

    $html .= '<td class="txc bg-burem b" style="width:60px;">'.$tgl.'<br>'.$jam.'</td>';
}

    $html .= '</tr>';

    $html .= '<tr>
    <td colspan="8" class="lnx bg-burem"><b>&nbsp;Resiko Tinggi intervensi setiap 4 jam</b></td>
    </tr>';

    /*RISIKO TINGGI*/ 
    $html .= '<tr>
    <td class="txc">1.</td>
    <td>Saran kepada pasien / keluarga untuk meminta bantuan</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_minta_bantuan)) ? $m->interv_a_minta_bantuan : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';

    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">2.</td>
    <td>Tempatkan bel panggilan dalam jangkauan tangan (bila tersedia)</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_bel_jangkau)) ? $m->interv_a_bel_jangkau : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">3.</td>
    <td>Tempatkan benda-benda milik pasien di dekat pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_barang_dekat)) ? $m->interv_a_barang_dekat : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">4.</td>
    <td>Pastikan tempat tidur dalam posisi rendah dan roda terkunci</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_bed_rendah_kunci)) ? $m->interv_a_bed_rendah_kunci : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">5.</td>
    <td>Pastikan pakaian pasien diatas mata kaki</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_pakaian_aman)) ? $m->interv_a_pakaian_aman : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">6.</td>
    <td>Bantu pasien saat transfer/ambulansi</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_transfer)) ? $m->interv_a_transfer : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">7.</td>
    <td>Pasang pengaman sistem tempat tidur</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_pengaman_bed)) ? $m->interv_a_pengaman_bed : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">8.</td>
    <td>Pastikan pasien terpasang gelang kuning</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_gelang_kuning)) ? $m->interv_a_gelang_kuning : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">9.</td>
    <td>Pastikan tanda pasien risiko jatuh terpasang di tempat tidur pasien/kamar pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_tanda_risiko)) ? $m->interv_a_tanda_risiko : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">10.</td>
    <td>Pasang restrain bila perlu</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_pakaian_aman)) ? $m->interv_a_pakaian_aman : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">11.</td>
    <td>Monitor kebutuhan toileting pasien secara kontinyu dan berikan bantuan segera bila diperlukan</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_restrain)) ? $m->interv_a_restrain : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">12.</td>
    <td>Beritahukan efek dari obat / anestesi kepada pasien / keluarga</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_edukasi_obat)) ? $m->interv_a_edukasi_obat : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">13.</td>
    <td>Beritahukan orientasi ruangan sekitar kepada pasien/penunggu pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_orientasi_ruang)) ? $m->interv_a_orientasi_ruang : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '
    <tr>
    <td colspan="'.(3 + count($kolom)).'" class="lnx bg-burem">
    <b>&nbsp;Resiko Rendah : dinilai ulang tiap 2 hari jika tidak ada perubahan kondisi</b>
    </td>
    </tr>';

    $html .= '<tr>
    <td class="txc">1.</td>
    <td>Orientasikan pasien dan keluarga tentang kamar pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_orientasi_kamar)) ? $m->interv_a_orientasi_kamar : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">2.</td>
    <td>Dekatkan bell ke pasien dan ajarkan cara penggunaanya (bila tersedia)</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_bel)) ? $m->interv_a_bel : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">3.</td>
    <td>Anjurkan pasien menggunakan sandal saat turun, anjurkan pasien menggunakan pakaian yang tidak menimbulkan cidera</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_pakaian)) ? $m->interv_a_pakaian : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">4.</td>
    <td>Kaji kebutuhan eliminasi pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_eliminasi)) ? $m->interv_a_eliminasi : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">5.</td>
    <td>Hindarkan barang-barang yang berbahaya di dekat pasien</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_barang_aman)) ? $m->interv_a_barang_aman : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">6.</td>
    <td>Ajaklah keluarga/penunggu pasien untuk ikut mencegah risiko jatuh</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_libatkan_keluarga)) ? $m->interv_a_libatkan_keluarga : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr>
    <td class="txc">7.</td>
    <td>Usahakan penerangan cukup pada pagi dan siang hari</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_penerangan)) ? $m->interv_a_penerangan : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem1">
    <td class="txc">8.</td>
    <td>Dokumentasikan tindakan perawat dan tindakan lanjut</td>
    <td></td>';
    foreach ($kolom as $m) {
        $nilai = ($m && isset($m->interv_a_dokumentasi)) ? $m->interv_a_dokumentasi : 0;
        $html .= '<td style="text-align:center; vertical-align:middle; height:25px;">'.cekIntervensi($nilai).'</td>';
    }
    $html .= '</tr>';

    $html .= '<tr class="bg-burem">
    <td class="b" colspan="3">Ttd dan Nama yang melakukan intervensi pencegahan risiko jatuh</td>';
    foreach ($kolom as $m) {

        $isi = '-';

        if ($m) {

            $ttd = '';
            $nama = $m->nama_karya ?? '';

            if (!empty($m->ttd_perawat)) {
                $ttd = '<img src="'.$m->ttd_perawat.'" width="45" style="opacity:0.85;"><br>';
            }

            $isi = '
            <div style="text-align:center;">
                '.$ttd.'
                <span style="font-size:10px;font-weight:bold">'.$nama.'</span>
            </div>';
        }

        $html .= '<td align="center">'.$isi.'</td>';
    }
    $html .= '</tr>';

    $html .= '</table><br>';

    if ($index < count($chunks) - 1) {
        $html .= '<pagebreak />';
    }
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
}
$pdf->Output($file, $pdf_type);
?>