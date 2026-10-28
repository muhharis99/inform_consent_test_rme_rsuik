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
$pdf->SetFont("petme642y", "", 9);
$pdf->SetFontSpacing(-0.2);
$pdf->setCellHeightRatio(1.2);

// set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT-12, PDF_MARGIN_TOP-24, PDF_MARGIN_RIGHT-5);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
// $pdf->Cell(20, 5, sprintf('Page %d of %s', $pdf->PageNo(), $pdf->getAliasNbPages()), 0, 0, 'C');
 // Page number
  // $pdf->Cell(0, 12, ' '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER-3);

// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-17);

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
$content = '<font style="letter-spacing: 0.5px;">'.$no_reg.'</font> &nbsp; &nbsp; &nbsp; ('.$asuransi.')
<br /><font size="8">'.$nama.'</font>
<br />'.$no_id.'
<br />'.tampiltanggal($tgl_lahir, 9).' &nbsp; &nbsp; &nbsp; '.$umur.'
<br /><font size="7">'.$alamat.'</font>
'; 
$html = '
<table border="0" cellpadding="4" cellspacing="4" >
  <tbody>
    <tr>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
    </tr>
    <tr><td colspan="3"> &nbsp;<br />&nbsp; </td></tr>
    <tr>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
    </tr>
    <tr><td colspan="3"> &nbsp;<br />&nbsp; </td></tr>
    <tr>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
    </tr>
    <tr><td colspan="3"> &nbsp;<br />&nbsp; </td></tr>
    <tr>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
      <td>'.$content.'</td>
    </tr>
  </tbody>
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->Output('print.pdf', 'F');

$file = "label_stiker.pdf";
$pdf->Output($file, 'I');
?>