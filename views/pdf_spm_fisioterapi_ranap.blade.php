<?php
$pdf = new TCPDF("P", "mm", array(110, 105), true, "UTF-8", false);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT-10, PDF_MARGIN_TOP-22, PDF_MARGIN_RIGHT-10);

// if($pdf_type == 'I') {
// $pdf = new TCPDF("P", "mm", "A4", true, "UTF-8", false);
// $pdf->SetMargins(PDF_MARGIN_LEFT+95, PDF_MARGIN_TOP-22, PDF_MARGIN_RIGHT);
// }
//(PDF_PAGE_ORIENTATION, PDF_UNIT, array(400, 300), true, 'UTF-8', false);
//$pdf->SetFont("dejavusans", "", 10);
//$pdf->SetFont("times", "", 7);

//$pdf->setHeaderData("",0,"","",array(0,0,0), array(255,255,255) );

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetAutoPageBreak(true, 2);
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,0,0), array(0,0,0));

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont('1979dotmatrix');
// $pdf->SetFont("petme642y", "", 9);
// $pdf->SetFont("petme2x", "", 6);
$pdf->SetFont("petme128", "", 7);
$pdf->SetFontSpacing(-0.3);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();

$html = <<<EOF

<div id="printpage">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
      text-align:center;
      font-weight:bold;
    }
    .tbh {
      text-align:center;
      font-size:14px;
      font-weight:bold;
    }
    .txl {
      text-align:left;
    }
    .txr {
      text-align:right;
    }
    .txc {
      text-align:center;
    }
    .txj {
      text-align:justify;
    }
    .alergi {
      font-weight: bold;
      font-size: 12px;
      color: red;
    }
    .excel {
    }
    .cbk {
      background-color: black;
      border: 0.5px solid black;
      height: 0.8em;
      width: 1em;
      display: block;
    }
    .cuk {
      background-color:#ddd;
      border: 0.5px solid black;
      height: 0.8em;
      width: 1em;
      display: block;
    }
    .bd2{
      line-height: 2px;
      border-top: 1px solid black;
      border-bottom: 2px solid black;
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
  .fontpet {
    font-family:VT323;
  }
  </style>
EOF;

$html .= 'RSU. ISLAM KLATEN';
$html .= '</div>';
$html = '';
// $pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTML("POLIKLINIK RSU. ISLAM KLATEN", true, false, true, false, '');
$pdf->writeHTML(' &nbsp; &nbsp; &nbsp; NOTA SPM : <i style="font-family:courier; font-weight:bold; font-size:12px; letter-spacing:2px;">R.Inap </i> &nbsp; &nbsp; &nbsp; <i style="font-family:courier; font-weight:bold; font-size:11; letter-spacing:3px;">&nbsp; &nbsp; &nbsp; POLI</i>', true, false, true, false, '');
$pdf->SetFont("petme128", "N", 6);
$pdf->writeHTML("", true, false, true, false, '');
$pdf->writeHTML('No. RM &nbsp;: '.substr($no_reg, 1, 2).' '.substr($no_reg, 3, 2).' '.substr($no_reg, 5, 2).'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i style="font-family:courier; font-weight:bold; font-size:10px; letter-spacing:0px;">[No: '.$no_kwt.']</i>', true, false, true, false, '');
$pdf->writeHTML('Nama  &nbsp; &nbsp;: '.$nama, true, false, true, false, '');
$pdf->writeHTML('Ruang&nbsp; &nbsp;: '.$poli, true, false, true, false, '');
$pdf->writeHTML('Alamat &nbsp;: <font style="font-family:petme642y; font-size:8px; letter-spacing:0.1px;">'.$alamat.'</font>', true, false, true, false, '');
$pdf->writeHTML('Dokter &nbsp;: '.$dokter, true, false, true, false, '');
$pdf->writeHTML("====================================================", true, false, true, false, '');
$html .= '<table width="100%" height="500px" border="0" cellpadding="0" cellspacing="0">'
      . ' <thead>'
      . '   <tr>'
      . '     <td style="font-size:7.5px;" width="30">No.</td>'
      . '     <td style="font-size:7.5px;" width="220">Keterangan</td>'
      . '     <td style="font-size:7.5px; text-align:right;" width="10">Q</td>'
      . '     <td style="font-size:7.5px; text-align:right;" width="75">Jml</td>'
      . '   </tr>'
      . '   <tr><td colspan="4">----------------------------------------------------</td></tr>'
      . ' </thead>';
$html .= '<tbody>';

$row_kosong = 15; 
$no = 1; 
$total = 0; 
foreach ($db5j as $row) {
  $html .= '<tr>';
  $html .= '<td width="30" style="font-family:petme642y; font-size:10px;">'.$no.'</td>';
  $html .= '<td width="220" style="font-family:petme642y; font-size:10px;">'.$row->na_perk.'</td>';
  $html .= '<td width="10" style="font-family:petme642y; font-size:10px; text-align:right;">'.number_format($row->kwanta).'</td>';
  $html .= '<td width="75" style="font-family:petme642y; font-size:10px; text-align:right;">'.number_format($row->netto).'</td>';
  $html .= '</tr>';
  $row_kosong --; 
  $no ++;
  $total += $row->netto;
}  
for ($i=0; $i<$row_kosong; $i++) {
  $html .= '<tr><td colspan="4"> &nbsp;</td></tr>'; 
  // $no++;
}
$html .= '<tr><td colspan="4">----------------------------------------------------</td></tr>'; 
$html .= '<tr>';
$html .= '<td width="260" colspan="3" style="font-family:petme128; font-size:8px; letter-spacing:0px;">Total</td>';
$html .= '<td width="75" style="font-family:petme642y; font-size:11px; text-align:right;">'.number_format($total).'</td>';
$html .= '</tr>';
$html .= '<tr><td colspan="4" style="font-family:courier; font-style:italic; font-size:11px;">('.strtolower(terbilang($total)).')</td></tr>'; 
$html .= '<tr><td colspan="4">----------------------------------------------------</td></tr>'; 
$html .= '<tr><td colspan="4" style="font-size:6px; text-align:right;">'.$tgl_spm.'</td></tr>'; 
$html .= '<tr><td colspan="4" style="font-size:6px; text-align:right;"> &nbsp; </td></tr>'; 
$html .= '<tr><td colspan="4" style="font-size:6px; text-align:right;"> &nbsp; </td></tr>'; 
$html .= '<tr><td colspan="4" style="font-size:6px; text-align:right;"> &nbsp; </td></tr>'; 
$html .= '<tr><td colspan="4" style="font-size:6px; text-align:right;"> &nbsp; </td></tr>'; 
$html .= '<tr><td colspan="4" style="font-family:petme642y; font-size:11px; text-align:right;">'.$petugas.'</td></tr>'; 
$html .= '</tbody>'; 

$html .= '</table>'; 
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetFont("petme642y", "I", 8);
$pdf->SetFontSpacing(-0.1);
// $pdf->writeHTML(json_encode($db5j), true, false, true, false, '');
// $pdf->writeHTML("Nama &nbsp; &nbsp; : CHUSNUN ARIFIN AL QODRI", true, false, true, false, '');

$file = "bill_rawat_jalan.pdf";
$pdf_type = "I";
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
      mkdir($dir);
  }
  $file = $dir."bill_rawat_jalan.pdf";
}
$pdf->Output($file, $pdf_type);

?>
