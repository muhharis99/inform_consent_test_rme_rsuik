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
  </style>
EOF;

$html .= '
<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10.5px;">
<tr>
<td colspan="14">INSTALASI RAWAT JALAN (REHAB MEDIK)';
// $html .= strtoupper($domain);
$html .= '</td>
</tr>
<tr>
<td colspan="14">Laporan Aktifitas Pelayanan';
$html .= '</td>
</tr>
<tr>
<td colspan="14">Tanggal: ';
//$tgls = $tanggal;
//$tanggal = bulan(date('m', strtotime($tanggal))).' '.date('Y', strtotime($tanggal));
$html .= $tanggal1.' s/d '.$tanggal2;
$html .= '</td>
</tr>';
// $html .= '</table>'; 
// $html .= '<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10.5px;">';
$html .= '
  <thead>
  <tr>
  <td colspan="7"> &nbsp; </td>
  </tr>
  <tr>
  <td rowspan="2" class="bdb thd" width="25">No</td>
  <td rowspan="2" class="bdb thd txr" width="80">No.Rek</td>
  <td rowspan="2" class="bdb thd txl" width="350">Perkiraan</td>
  <td colspan="3" class="thd" width="180">Aktifitas</td>
  <td rowspan="2" class="bdb thd txr" width="60">Total Aktif</td>
  </tr>
  <tr>
  <td class="bdb thd txr" width="60">R.Inap</td>
  <td class="bdb thd txr" width="60">R.Jalan</td>
  <td class="bdb thd txr" width="60">Luar</td>
  </tr>
  </thead>
  ';

  if (!empty($content) > 0) {
    $no = 1;
    $total_inap = 0; 
    $total_jalan = 0; 
    $total_luar = 0; 
    $total_aktif = 0; 
    foreach($content as $all) {
      $row = (object) $all;
      $row->total = 0; 
      $row->total = $row->inap + $row->jalan; 
      $bdb = '';
      $bgcolor = 'style="background-color:#FFFFFF;"';
      if (($no % 2) == 1) {
        $bgcolor = 'style="background-color:#EFEFEF;"';
      }
      $html .= '<tr '.$bgcolor.'>';
      $html .= '<td class="txr '.$bdb.'" width="25">'.$no.'</td>';
      $html .= '<td class="txr '.$bdb.'" width="80">'.$row->no_perk.'</td>';
      $html .= '<td class="txl '.$bdb.'" width="350">'.$row->na_perk.'</td>';
      $html .= '<td class="txr '.$bdb.'" width="60">'.number_format($row->inap).'</td>';
      $html .= '<td class="txr '.$bdb.'" width="60">'.number_format($row->jalan).'</td>';
      $html .= '<td class="txr '.$bdb.'" width="60">'.number_format(0).'</td>';
      $html .= '<td class="txr '.$bdb.'" width="60">'.number_format($row->total).'</td>';
      $html .= '</tr>';
      $total_inap = $total_inap + $row->inap;
      $total_jalan = $total_jalan + $row->jalan;
      $total_aktif = $total_aktif + $row->total;
      $no ++;
    }
    
    $html .= '<tr style="background-color:#bebebe; font-weight:bold;">';
    $html .= '<td class="txr bdt bdb"> </td>';
    $html .= '<td class="txl bdt bdb" colspan="2"> </td>';
    $html .= '<td class="txr bdt bdb">'.number_format($total_inap).'</td>';
    $html .= '<td class="txr bdt bdb">'.number_format($total_jalan).'</td>';
    $html .= '<td class="txr bdt bdb">'.number_format($total_luar).'</td>';
    $html .= '<td class="txr bdt bdb">'.number_format($total_aktif).'</td>';
    $html .= '</tr>';
    $html .= '<tr>
                <td colspan="7"> </td>
              </tr>';
  } else {
    $html .= '<tr style="background-color:#bebebe; font-weight:bold;">';
    $html .= '<td class="txr bdt bdb" width="25"> </td>';
    $html .= '<td class="txr bdt bdb" width="80"> </td>';
    $html .= '<td class="txr bdt bdb" width="350"> </td>';
    $html .= '<td class="txr bdt bdb" width="60"> </td>';
    $html .= '<td class="txr bdt bdb" width="60"> </td>';
    $html .= '<td class="txr bdt bdb" width="60"> </td>';
    $html .= '<td class="txr bdt bdb" width="60"> </td>';
    $html .= '</tr>';
    $html .= '<tr>
                <td colspan="7"> </td>
              </tr>';
  }
$html .= '
</table>';
$html .= '
<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10.5px; page-break-inside:avoid;">';
/*
$html .= '
  <tr style="background-color:#BEBEBE;">
    <td class="bdt bdb thd" width="80">RAWAT</td>
    <td class="bdt bdb thd" width="80">BPJS</td>
    <td class="bdt bdb thd" width="80">ASKOM</td>
    <td class="bdt bdb thd" width="80">UMUM</td>
    <td class="bdt bdb thd" width="80">TOTAL</td>
  </tr>';
*/
$html .= '<tr>
            <td class="txc" colspan="3">
              <br />
              <br />
              '.$ttd_jabatan.'
              <br />
              <br />
              <br />
              '.$ttd_nama.'
            </td>
            <td colspan="4"> &nbsp; </td>
          </tr>'; 

$html .= '
</table>
';
$xhtml = '';
$html = str_replace("background-color:gray","background-color:black", $html);
$pdf->writeHTML($html, true, false, true, false, '');
if ($xhtml<>'') {
	// $pdf->AddPage();
	// $pdf->writeHTML($xhtml, true, false, true, false, '');
}
//$pdf->Output('print.pdf', 'F');

$file = "aktifitas_pelayanan_poliklinik.pdf";
$pdf->Output($file, 'I');
?>