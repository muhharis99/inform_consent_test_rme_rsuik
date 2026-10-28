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
<td colspan="8">INSTALASI ';
$html .= strtoupper($domain);
$html .= '</td>
</tr>
<tr>
<td colspan="8">Laporan Bon Harian';
$html .= '</td>
</tr>
<tr>
  <td colspan="8">Tanggal: ';
//$tgls = $tanggal;
//$tanggal = bulan(date('m', strtotime($tanggal))).' '.date('Y', strtotime($tanggal));
$html .= $tanggal1.' s/d '.$tanggal2;
$html .= '</td>
</tr>';
$html .= '
<tr>
  <td colspan="8"></td>
</tr>
<tr>
  <td class="bdb thd" width="25">No</td>
  <td class="bdb thd" width="50">No SPM</td>
  <td class="bdb thd" width="50">No RM</td>
  <td class="bdb thd txl" width="140">Nama Pasien</td>
  <td class="bdb thd txl" width="140">Poli</td>
  <td class="bdb thd txr" width="60">Nominal</td>
  <td class="bdb thd txl" width="200">Karyawan</td>
  <td class="bdb thd" width="0"> </td>
</tr>';
$i = 1; 
$total = 0; 
foreach ($content as $row) {
  $row = (object) $row;
  $bgcolor = 'style="background-color:#FFFFFF;"';
  if (($i % 2) == 1) {
    $bgcolor = 'style="background-color:#EFEFEF;"';
  }
  $bdb = '';
  $html .= '<tr '.$bgcolor.'>';
  $html .= '<td class="txr '.$bdb.'">'.$i.'</td>';
  $html .= '<td class="txr '.$bdb.'">'.$row->no_tran.'</td>';
  $html .= '<td class="txr '.$bdb.'">'.$row->no_reg.'</td>';
  $html .= '<td class="txl '.$bdb.'">'.$row->pasien.'</td>';
  $html .= '<td class="txl '.$bdb.'">'.strtoupper($row->poli).'</td>';
  $html .= '<td class="txr '.$bdb.'">'.number_format($row->nominal).'</td>';
  $html .= '<td class="txl '.$bdb.'">NIK : '.$row->nik.' <br />'.$row->karyawan.'</td>';
  $html .= '<td class="txr '.$bdb.'"> </td>';
  $html .= '</tr>';
  $i++;
  $total = $total + $row->nominal;
}

$html .= '
<tr>
  <td class="bdt thd" width="25"></td>
  <td class="bdt thd" width="50">TOTAL</td>
  <td class="bdt thd" width="50"></td>
  <td class="bdt thd txl" width="140"></td>
  <td class="bdt thd txl" width="140"></td>
  <td class="bdt thd txr" width="60">'.number_format($total).'</td>
  <td class="bdt thd txl" width="200"></td>
  <td class="bdt thd" width="0"> </td>
</tr>'; 
$html .= '
</table>';
$html = str_replace("background-color:gray","background-color:black", $html);
$pdf->writeHTML($html, true, false, true, false, '');
$file = "bon_harian.pdf";
$pdf->Output($file, 'I');
?>