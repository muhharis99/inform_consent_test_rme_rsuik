<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/04.5'); 
define('DOC_FILE', 'Pengkajian-dan-Intervensi-Resiko-Jatuh-Pasien-Neonatus.pdf'); 
define('DOC_TITLE', 'PENGKAJIAN DAN INTERVENSI<br>RESIKO JATUH<br>PADA PASIEN <i>Neonatus</i>'); 
define('DOC_SUBJECT', 'Pengkajian dan Intervensi Resiko Jatuh Pasien Neonatus'); 

require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 6, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';

$html = '';
$html .= '
<style type="text/css">
  .bg-burem {
    background-color: #9F9FA0;
    line-height:20px;
  }
  .bg0 { background-color: #FFFFFF; }
  .bg1 { background-color: #ECECEC; }
  .bg2 { background-color: #BEBEBE; }
  .bg3 { background-color: #9F9FA0; }
  .bg4 { background-color: #F8B14F; }
  .bg5 { background-color: #FAD59E; }
  .bg-burem td { line-height:20px; }
  .b td { font-weight:bold; }
  .bg-burem1 {
    background-color: rgb(245, 245, 245);
    line-height:20px;
  }
  .bg-white { background-color: #ffffff; }
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
  .b { font-weight:bold; }
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
  .ln30 { line-height:30px; font-size:15px; }
  .ln33 { line-height:33px; }
  .ln50 { line-height:50px; }
  .title td { line-height:20px; font-weight:bold; }
  .bdl { border-left: 0.5px solid black; }
  .bdr { border-right: 0.5px solid black; }
  .bdt { border-top: 0.5px solid black; }
  .bdb { border-bottom: 0.5px solid black; }
  .tableinzero table tr td { padding:0px; }
  .p0 { padding:0px; }
  .custom-text { font-size:14px; }
  .tvm { vertical-align:middle; }
  .lns {
    line-height:14px; 
    padding:3px 3px;
    height:35px;
    vertical-align:middle;
  }
</style>
'; 

$morse_array = is_array($morse_list) ? $morse_list : $morse_list->all();

$neo_sasaran_edu      = '';
$neo_sasaran_edu_lain = '';
$neo_evaluasi         = '';
$neo_evaluasi_lain    = '';
$id_user              = '';

if (!empty($morse_array)) {
    $last = end($morse_array);
    if ($last) {
        $neo_sasaran_edu      = $last->neo_sasaran_edu ?? '';
        $neo_sasaran_edu_lain = $last->neo_sasaran_edu_lain ?? '';
        $neo_evaluasi         = $last->neo_evaluasi ?? '';
        $neo_evaluasi_lain    = $last->neo_evaluasi_lain ?? '';
        $id_user              = $last->id_user ?? '';
    }
}

$chunks      = array_chunk($morse_array, 5);
$total_chunk = count($chunks);

function cek($val) {
    return !empty($val)
        ? '<img src="' . IMG . 'banner/blank_check.png" width="10">'
        : '-';
}

foreach ($chunks as $index => $chunk) {

    $kolom  = $chunk;
    $kosong = 5 - count($kolom);
    for ($i = 0; $i < $kosong; $i++) {
        $kolom[] = null;
    }

    $html .= '
    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
        <tr>
            <th class="b">
                SEMUA NEONATUS DIKATEGORIKAN RESIKO TINGGI (RT)
            </th>
        </tr>
    </table>
    <br>';

    $html .= '
    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="350px" class="txc b bg-burem" rowspan="2" colspan="2" style="vertical-align: middle;">
                INTERVENSI PENCEGAHAN PASIEN JATUH<br>
                Beri tanda (<img src="' . IMG . 'banner/blank_check.png" style="margin-top:2px;" width="8" height=""/>) pada tindakan yang di lakukan
            </td>
            <td class="txc b bg-burem" colspan="5">TANGGAL / JAM</td>
        </tr>
        <tr>';

    foreach ($kolom as $m) {
        $tgljam = '-';
        if ($m && !empty($m->waktu_pengkajian)) {
            $tgljam = date('d/m/Y H:i', strtotime($m->waktu_pengkajian));
        }
        $html .= '<td class="txc bg-burem b" width="70px">' . $tgljam . '</td>';
    }

    $html .= '</tr>';

    $intervensi = [
        'Orientasi ruangan pada orang tua / keluarga' => 'interv_n_rt_orientasi_ruang',
        'Dekatkan box bayi dengan ibu'                => 'interv_n_rt_box_dekat_ibu',
        'Pastikan selalu ada pendamping'              => 'interv_n_rt_pendamping',
        'Pastikan lantai tidak licin'                 => 'interv_n_rt_lantai_aman',
        'Kontrol rutin oleh petugas'                  => 'interv_n_rt_kontrol_rutin',
        'Inkubator terkunci'                          => 'interv_n_rt_inkubator_kunci',
        'Edukasi orang tua / keluarga'                => 'interv_n_rt_edukasi_ortu'
    ];

    $no = 1;
    foreach ($intervensi as $label => $field) {
        $row_bg = ($no % 2 == 0) ? 'bg-burem1' : '';
        $html .= '
        <tr class="' . $row_bg . '">
            <td class="txc">' . $no . '.</td>
            <td width="200px">' . $label . '</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="txc" width="50px">' . ($m ? cek($m->$field ?? null) : '') . '</td>';
        }
        $html .= '</tr>';
        $no++;
    }

    

    $html .= '</table><hr>';

    $html .= '
    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="350px" class="txc b bg-burem" rowspan="2" colspan="2" style="vertical-align: middle;">
                EDUKASI YANG DIBERIKAN
            </td>
            <td class="txc b bg-burem" colspan="5">
                TANGGAL / JAM
            </td>
        </tr>
        <tr>';

    foreach ($kolom as $m) {
        $tgljam = '-';
        if ($m && !empty($m->waktu_pengkajian)) {
            $tgljam = date('d/m/Y H:i', strtotime($m->waktu_pengkajian));
        }
        $html .= '<td class="txc bg-burem b" width="70px">' . $tgljam . '</td>';
    }

    $html .= '</tr>';

    $edukasi = [
        'Tempatkan bayi pada tempat aman' => 'interv_n_ed_tempat_aman',
        'Teknik menggendong bayi'         => 'interv_n_ed_cara_gendong',
        'Cara membungkus bayi'            => 'interv_n_ed_cara_bungkus',
        'Istirahat bila lelah'            => 'interv_n_ed_istirahat_ortu',
        'Libatkan keluarga'               => 'interv_n_ed_libatkan_keluarga'
    ];

    $no = 1;
    foreach ($edukasi as $label => $field) {
        $row_bg = ($no % 2 == 0) ? 'bg-burem1' : '';
        $html .= '
        <tr class="' . $row_bg . '">
            <td class="txc">' . $no . '.</td>
            <td width="200px">' . $label . '</td>';
        foreach ($kolom as $m) {
            $html .= '<td class="txc" width="50px">' . ($m ? cek($m->$field ?? null) : '') . '</td>';
        }
        $html .= '</tr>';
        $no++;
    }

    // Baris WRITER / PETUGAS (TTD + Nama)
    $html .= '
    <tr class="bg-burem">
        <td class="b" colspan="2" style="vertical-align:middle;">Ttd dan Nama yang melakukan pengkajian</td>';
    foreach ($kolom as $m) {
        if ($m) {
            $ttd_src = IMG . 'ttd/' . ($m->id_user ?? '') . '.jpg';
            $html .= '
            <td class="txc" width="70px" style="vertical-align:middle; padding:3px 2px;">
                <img src="' . $ttd_src . '" width="50" style="display:block; margin:0 auto;"><br>
                <span style="font-size:8px;">' . ($m->nama_karya ?? '-') . '</span>
            </td>';
        } else {
            $html .= '<td class="txc" width="70px"></td>';
        }
    }
    $html .= '</tr>';

    $html .= '</table><hr>';

    $html .= '
    <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="200"><b>SASARAN EDUKASI</b></td>
            <td>
                <img src="' . IMG . 'banner/' . ($neo_sasaran_edu == '1'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Ibu / Bapak<br>
                <img src="' . IMG . 'banner/' . ($neo_sasaran_edu == '2'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Keluarga lain<br>
                <img src="' . IMG . 'banner/' . ($neo_sasaran_edu == '3'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Wali<br>
                <img src="' . IMG . 'banner/' . ($neo_sasaran_edu == '99' ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Lainnya
                ' . ($neo_sasaran_edu == '99' ? ' : ' . $neo_sasaran_edu_lain : '') . '
            </td>
        </tr>
        <tr><td colspan="2" height="10"></td></tr>
        <tr>
            <td><b>EVALUASI</b></td>
            <td>
                <img src="' . IMG . 'banner/' . ($neo_evaluasi == '1'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Memahami dan mampu mendemonstrasikan<br>
                <img src="' . IMG . 'banner/' . ($neo_evaluasi == '2'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Mengerti<br>
                <img src="' . IMG . 'banner/' . ($neo_evaluasi == '3'  ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Perlu edukasi ulang<br>
                <img src="' . IMG . 'banner/' . ($neo_evaluasi == '99' ? 'square14_check' : 'square14_uncheck') . '.png" width="12"> Lainnya
                ' . ($neo_evaluasi == '99' ? ' : ' . $neo_evaluasi_lain : '') . '
            </td>
        </tr>
        
    </table>
    <br><br>';

    // $html .= '
    // <table border="0" cellpadding="0" cellspacing="0" width="100%">
    //     <tbody>
    //         <tr>
    //             <td width="200" class="txc" style="background-image:url(\'' . IMG . 'ttd/' . $dpjp_id . '.jpg\'); background-image-resize:2; background-repeat:no-repeat; background-size:100px; background-position:center; height:110px;">
    //                 Keluarga
    //                 <br /><br /><br />
    //                 ' . ($dpjp_nama != '' ? $dpjp_nama : '_________________________________') . '
    //                 <br />
    //                 Tanda tangan dan nama terang
    //             </td>
    //             <td width="" class="txc" style="height:110px;">
    //                 &nbsp;
    //             </td>
    //             <td width="200" class="txc" style="background-image:url(\'' . IMG . 'ttd/' . $id_user . '.jpg\'); background-image-resize:2; background-repeat:no-repeat; background-size:25% 25%; background-position:center; height:110px;">
    //                 Petugas
    //                 <br /><br /><br />
    //                 ' . ($nama_karya != '' ? $nama_karya : '_________________________________') . '
    //                 <br />
    //                 Tanda tangan dan nama terang
    //             </td>
    //         </tr>
    //     </tbody>
    // </table>';

    if ($index < $total_chunk - 1) {
        $html .= '<div style="page-break-after: always;"></div>';
    }
}

$pdf->WriteHTML($html);

$file = DOC_FILE;
$pdf->Output($file, $pdf_type);
?>