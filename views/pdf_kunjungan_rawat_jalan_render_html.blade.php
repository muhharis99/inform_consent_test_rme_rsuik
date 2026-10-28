<?php

$pdf = new TCPDF("P", "mm", "A4", true, "UTF-8", false);

$pdf->SetAuthor('RSU Islam Klaten');
//$pdf->SetTitle('BPJS');
$pdf->SetSubject('ANC');
$pdf->SetKeywords('RSU Islam Klaten, BPJS');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetDefaultMonospacedFont('1979dotmatrix');
// $pdf->SetFont("petme642y", "", 9);
// $pdf->SetFont("petme2x", "", 6);
$pdf->SetFont("petme642y", "", 8);
$pdf->SetFontSpacing(-0.2);

// set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT-8, PDF_MARGIN_TOP-20, PDF_MARGIN_RIGHT-8);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
$pdf->Cell(20, 5, sprintf('Page %d of %s', $pdf->PageNo(), $pdf->getAliasNbPages()), 0, 0, 'C');
 // Page number
  $pdf->Cell(0, 12, ' '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->SetPrintHeader(false);
//$pdf->SetPrintFooter(false);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER-3);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-17);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$html = <<<EOF
  <style type="text/css">
  @media print {
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
    .bda {
       border: 0.5px solid black;
    }
    .thd {
      text-align: center;
      font-weight:bold;
    }
    .txc {
      text-align: center;
    }
    .txl {
      text-align: left;
    }
    .txr {
      text-align: right;
    }
    .txj {
      text-align: justify;
    }
    .excel {
      border: 0.5px solid black;
    }
    .phead {
      background-color: black; /* uses a solid color at worst 
      background-image: url("http://media02.hongkiat.com/code-fallback-methods/fallback-gradient.png");
      background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2F2727), to(#1a82f7));
      background-image: -webkit-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -moz-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -ms-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -o-linear-gradient(top, #2F2727, #1a82f7);
      background-color: red;
      background-blend-mode: multiply;*/
      color: white !important;
    }
    @page 
    {
        page-break-after: always;
        size:8.27in 11.69in; 
        margin: 0.2cm; 
    }
    * {
        margin: 0;
    }
    html {
       max-width: 100%;
       border-top: 0;
    }
    body > #printpage {
        display: block;
        border: none;
        max-width: 100%;
        width: 100%;
        height: 100%;
        position: relative;
        margin: 0; /* I tried to set negative margin/padding eg. here */
        padding: 0;
    }
    .bd2{
      line-height: 2px;
      border-top: 1px solid black;
      border-bottom: 2px solid black;
    }
  }
  @media screen {
    .bdl {
       border-left:1px solid black;
    }
    .bdr {
       border-right:1px solid black;
    }
    .bdt {
       border-top:1px solid black;
    }
    .bdb {
       
    }
    .phead {
      background-color: black; /* uses a solid color at worst 
      background-image: url("http://media02.hongkiat.com/code-fallback-methods/fallback-gradient.png");
      background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2F2727), to(#1a82f7));
      background-image: -webkit-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -moz-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -ms-linear-gradient(top, #2F2727, #1a82f7);
      background-image: -o-linear-gradient(top, #2F2727, #1a82f7);
      background-color: red;
      background-blend-mode: multiply;*/
      color: white !important;
    }
  }
  
  table tr td {
    font-family:petme642y; font-size:9px; letter-spacing:-0.1px;
  }
  </style>
EOF;

$html .= '
<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10.5px;">
<tr>
<td colspan="9">INSTALASI RAWAT JALAN';
// $html .= strtoupper($domain);
$html .= '</td>
</tr>
<tr>
<td colspan="9">Laporan Kunjungan Harian';
$html .= '</td>
</tr>
<tr>
<td colspan="9">Tanggal: ';
//$tgls = $tanggal;
//$tanggal = bulan(date('m', strtotime($tanggal))).' '.date('Y', strtotime($tanggal));
$html .= $tanggal1.' s/d '.$tanggal2;
$html .= '</td>
</tr>';
if ($tanggal1 != $tanggal2) {
  $html .= '
  <tr>
  <td colspan="9"></td>
  </tr>';
} else {
  $html .= '
  <tr>
  <td colspan="9"></td>
  </tr>
  <tr>
  <td class="bdb thd" width="30">No</td>
  <td class="bdb thd" width="40">No RM</td>
  <td class="bdb thd" width="210">Pasien</td>
  <td class="bdb thd" width="60">Tgl Lahir</td>
  <td class="bdb thd" width="80">Umur</td>
  <td class="bdb thd" width="50">Antrian</td>
  <td class="bdb thd" width="100">Inden</td>
  <td class="bdb thd" width="100">Daftar</td>
  <td class="bdb thd" width="0"> </td>
  </tr>';
}
  $jml_umum_rj = 0;
  $i = 1;
  $bdb = '';
  
	$arr_summary = array();
	$arr_total = array(); 
	$arr_tepat = array(); 
  $arr_terlambat = array();
  $menit_terlambat = 0;
  $dokter_terlambat = 0;
  
  $category = "";
  $rawat = "";

  $total_kom1 = 0;
  $total_kom2 = 0; 
  $total_kom3 = 0; 
  $total_kom4 = 0; 
  $total_kom5 = 0; 
  $total_kom6 = 0; 
  $total_netto = 0; 
  
  $grand_kom1 = 0;
  $grand_kom2 = 0; 
  $grand_kom3 = 0; 
  $grand_kom4 = 0; 
  $grand_kom5 = 0; 
  $grand_kom6 = 0; 
  $grand_netto = 0; 

  $sub_kom1 = 0;
  $sub_kom2 = 0; 
  $sub_kom3 = 0; 
  $sub_kom4 = 0; 
  $sub_kom5 = 0; 
  $sub_kom6 = 0; 
  $sub_netto = 0; 
  
  $rajal_kom1 = 0;
  $rajal_kom2 = 0; 
  $rajal_kom3 = 0; 
  $rajal_kom4 = 0; 
  $rajal_kom5 = 0; 
  $rajal_kom6 = 0; 
  $rajal_netto = 0; 

  $ranap_kom1 = 0;
  $ranap_kom2 = 0; 
  $ranap_kom3 = 0; 
  $ranap_kom4 = 0; 
  $ranap_kom5 = 0; 
  $ranap_kom6 = 0; 
  $ranap_netto = 0; 

  $total_rawat_kom1 = 0;
  $total_rawat_kom2 = 0; 
  $total_rawat_kom3 = 0; 
  $total_rawat_kom4 = 0; 
  $total_rawat_kom5 = 0; 
  $total_rawat_kom6 = 0; 
  $total_rawat_netto = 0; 

  $rajal_bpjs = 0; 
  $rajal_askom = 0; 
  $rajal_umum = 0; 
  $rajal_relasi = 0; 

  $ranap_bpjs = 0; 
  $ranap_askom = 0; 
  $ranap_umum = 0; 
  $ranap_relasi = 0; 

  $total_bpjs = 0; 
  $total_askom = 0; 
  $total_umum = 0; 
  $total_relasi = 0; 
  
  $i = 0; 
  if (!empty($content) > 0) {
    foreach($content as $all) {
      $all = (object) $all;
      
      $bgcolor = 'style="background-color:#FFFFFF;"';
      if (($i % 2) == 1) {
        $bgcolor = 'style="background-color:#EFEFEF;"';
      } else {
        $bgcolor = 'style="background-color:#FFFFFF;"';
      }
      $html_grand = '';
      
      
      
      $sub_kom1 = 0;
      $sub_kom2 = 0; 
      $sub_kom3 = 0; 
      $sub_kom4 = 0; 
      $sub_kom5 = 0; 
      $sub_kom6 = 0; 
      $sub_netto = 0; 

      
      $rows_poli = (object) null; 
      $rows_poli = $all->poli;
      if (!empty($rows_poli)) {
        foreach ($rows_poli as $row_poli) {
          $row_poli = (object) $row_poli;
          $rows_dokter = $row_poli->dokter;
          if (!empty($rows_dokter)) {
            foreach ($rows_dokter as $row_dokter) {
              $row_dokter = (object) $row_dokter;
              if ($row_dokter->antrian > 0) {
                $html .= '
                <tr>
                  <td colspan="9" style="font-weight:bold; padding-left:10px; padding-right:10px;" class="txc">:: '.$row_poli->nama_poli.' ['.$row_poli->kode_poli.'] :: </td>
                </tr>';
                $html .= '<tr style="background-color:#cccccc; font-weight:bold;">';
                $html .= '<td class="txr">'.$row_dokter->kode_dokter.'</td>';
                $html .= '<td class="txl" colspan="3">'.$row_dokter->nama_dokter.'  </td>';
                $html .= '<td class="txr"> </td>';
                $html .= '<td class="txr">'.number_format($row_dokter->antrian).' PSN</td>';
                $html .= '<td class="txr">'.number_format($row_dokter->inden).' PSN</td>';
                $html .= '<td class="txr">'.number_format($row_dokter->register).' PSN</td>';
                $html .= '<td class="txr"> &nbsp; </td>';
                $html .= '</tr>';
                $rows_pasien = $row_dokter->pasien;
                // $rows_pasien = null; 
                if (!empty($rows_pasien)) {
                  $j = 1;
                  foreach ($rows_pasien as $row_pasien)  {
                    $row_pasien = (object) $row_pasien;
                    $bgcolor = 'style="background-color:#FFFFFF;"';                  
                    if (($j % 2) == 1) {
                      $bgcolor = 'style="background-color:#EFEFEF;"';
                    } 
                    if (empty($row_pasien->tgl_daftar)) {
                      $row_pasien->tgl_daftar = ''; 
                      $row_pasien->jam_daftar = ''; 
                    } else {
                      if ($row_pasien->tgl_daftar == $row_pasien->tgl_inden) {
                        $row_pasien->tgl_inden = ''; 
                        $row_pasien->jam_inden = ''; 
                      }
                    }

                    $html .= '<tr '.$bgcolor.'>';
                    $html .= '<td class="txr">'.$j.'</td>';
                    $html .= '<td class="txr">'.$row_pasien->no_reg.'</td>';
                    $html .= '<td class="txl">'.$row_pasien->nama.'  </td>';
                    $html .= '<td class="txl">'.$row_pasien->tgl_lahir.'  </td>';
                    $html .= '<td class="txl">'.$row_pasien->umur.'  </td>';
                    $html .= '<td class="txr">'.$row_pasien->antrian.'</td>';
                    $html .= '<td class="txr">'.$row_pasien->tgl_inden.' '.$row_pasien->jam_inden.'</td>';
                    $html .= '<td class="txr">'.$row_pasien->tgl_daftar.' '.$row_pasien->jam_daftar.'</td>';
                    $html .= '<td class="txr"> &nbsp; </td>';
                    $html .= '</tr>';
                    $j ++;
                  }
                }
              }
            }
          }
        }
      }
      
    }
    $html .= '<tr>
                <td colspan="9"> </td>
              </tr>';

    $html .= '<tr>
                <td colspan="9"> </td>
              </tr>';
  }
/*
$html .= '
<tr>
  <td colspan="6"></td>
</tr>
<tr>
  <td width="30"></td>
  <td width="370"> Total Keterlambatan</td>
  <td colspan="4"> '.number_format($menit_terlambat,0,",",".").' Menit</td>
</tr>
<tr>
  <td width="30"></td>
  <td width="370"> Total Dokter Terlambat</td>
  <td colspan="4"> '.$dokter_terlambat.' Dokter</td>
</tr>
<tr>
  <td width="30"></td>
  <td width="370"> Waktu Tunggu</td>
  <td colspan="4"> '.$waktu_tunggu.' Menit/Pasien</td>
</tr>'; 
*/
$html .= '
</table>';
$html .= '
<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10.5px; page-break-inside:avoid;">';
$html .= '
  <tr style="background-color:#BEBEBE;">
    <td class="bdt bdb thd" width="80">RAWAT</td>
    <td class="bdt bdb thd" width="80">BPJS</td>
    <td class="bdt bdb thd" width="80">ASKOM</td>
    <td class="bdt bdb thd" width="80">UMUM</td>
    <td class="bdt bdb thd" width="80">TOTAL</td>
  </tr>';

$html .= '<tr style="background-color:#cccccc; font-weight:bold;">
            <td class="txl">RANAP</td>
            <td class="txr">'.number_format($ranap_bpjs).'</td>
            <td class="txr">'.number_format($ranap_askom).'</td>
            <td class="txr">'.number_format($ranap_umum).'</td>
            <td class="txr">'.number_format($ranap_relasi).'</td>
          </tr>';
$html .= '<tr style="background-color:#cccccc; font-weight:bold;">
            <td class="txl">RAJAL</td>
            <td class="txr">'.number_format($rajal_bpjs).'</td>
            <td class="txr">'.number_format($rajal_askom).'</td>
            <td class="txr">'.number_format($rajal_umum).'</td>
            <td class="txr">'.number_format($rajal_relasi).'</td>
          </tr>';
$total_bpjs = $rajal_bpjs + $ranap_bpjs; 
$total_askom = $rajal_askom + $ranap_askom; 
$total_umum = $rajal_umum + $ranap_umum; 
$total_relasi = $rajal_relasi + $ranap_relasi; 
$html .= '<tr style="background-color:#BEBEBE; font-weight:bold;">
            <td class="txl bdt bdb">TOTAL</td>
            <td class="txr bdt bdb">'.number_format($total_bpjs).'</td>
            <td class="txr bdt bdb">'.number_format($total_askom).'</td>
            <td class="txr bdt bdb">'.number_format($total_umum).'</td>
            <td class="txr bdt bdb">'.number_format($total_relasi).'</td>
          </tr>';
          
$html .= '<tr>
            <td class="txc" colspan="5">
              <br />
              <br />
              '.$ttd_jabatan.'
              <br />
              <br />
              <br />
              '.$ttd_nama.'
            </td>
          </tr>'; 

$html .= '
</table>
';
$xhtml = '';
//if ($nik=='200501') {
$xhtml = <<<EOF
  <style type="text/css">
  @media print {
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
    .bda {
       border: 0.5px solid black;
    }
    .thd {
      text-align: center;
      font-weight:bold;
    }
    .txc {
      text-align: center;
    }
    .txl {
      text-align: left;
    }
    .txr {
      text-align: right;
    }
    .txj {
      text-align: justify;
    }
    .excel {
      border: 0.5px solid black;
    }
    .phead {
      background-color: black; /* uses a solid color at worst 
  background-image: url("http://media02.hongkiat.com/code-fallback-methods/fallback-gradient.png");
  background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2F2727), to(#1a82f7));
  background-image: -webkit-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -moz-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -ms-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -o-linear-gradient(top, #2F2727, #1a82f7);
  background-color: red;
  background-blend-mode: multiply;*/
      color: white !important;
    }
    @page 
    {
        page-break-after: always;
        size:8.27in 11.69in; 
        margin: 0.4cm; 
    }
    * {
        margin: 0;
    }
    html {
       max-width: 100%;
       border-top: 0;
    }
    body > #printpage {
        display: block;
        border: none;
        max-width: 100%;
        width: 100%;
        height: 100%;
        position: relative;
        margin: 0; /* I tried to set negative margin/padding eg. here */
        padding: 0;
    }
    .bd2{
      line-height: 2px;
      border-top: 1px solid black;
      border-bottom: 2px solid black;
    }
  }
  @media screen {
    .bdl {
       border-left:1px solid black;
    }
    .bdr {
       border-right:1px solid black;
    }
    .bdt {
       border-top:1px solid black;
    }
    .bdb {
       
    }
    .phead {
      background-color: black; /* uses a solid color at worst 
  background-image: url("http://media02.hongkiat.com/code-fallback-methods/fallback-gradient.png");
  background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2F2727), to(#1a82f7));
  background-image: -webkit-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -moz-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -ms-linear-gradient(top, #2F2727, #1a82f7);
  background-image: -o-linear-gradient(top, #2F2727, #1a82f7);
  background-color: red;
  background-blend-mode: multiply;*/
      color: white !important;
    }
  }
  </style>
EOF;

$html = str_replace("background-color:gray","background-color:black", $html);
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->Output('print.pdf', 'F');

$file = "pendapatan_harian_hemodialisa.pdf";
$pdf->Output($file, 'I');
?>