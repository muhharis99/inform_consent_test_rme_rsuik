<?php
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class MyTCPDF extends TCPDF {
    var $htmlHeader;
    var $htmlFooter;
    public function setHtmlHeader($htmlHeader) {
        $this->htmlHeader = $htmlHeader;
    }
    public function Header() {
        $this->writeHTMLCell(
            $w = 0, $h = 0, $x = '', $y = '',
            $this->htmlHeader, $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'top', $autopadding = true);
    }
    public function setHtmlFooter($htmlFooter) {
        $this->htmlFooter = $htmlFooter;
    }
    public function Footer() {
        $this->writeHTMLCell(
            $w = 0, $h = 0, $x = '', $y = '',
            $this->htmlFooter, $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'top', $autopadding = true);
    }
}
$pdf = new MyTCPDF("P", "mm", "A4", true, "UTF-8", false);

$pdf->SetTitle('FM/RM/01 - '.$no_reg);
$pdf->SetSubject('Askep');
$pdf->SetKeywords('RS Islam Klaten, Askep');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT-2, PDF_MARGIN_TOP-23, PDF_MARGIN_RIGHT-8);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
$pdf->setHtmlHeader('<table border="0" cellpadding="0" cellspacing="0" style="font-size:11px;" width="100%"><tbody><tr><td align="left" width="50%">RSU ISLAM KLATEN</td><td width="50%" bgcolor="" align="right" style="text-align:right;"> <font style="font-size:10px;">Hal '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages().' </font> <b>FM/RM/01</b></td></tr></tbody></table>');
$pdf->SetPrintHeader(true);
$pdf->setHtmlFooter('<table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;" width="100%"><tbody><tr><td align="left" width="50%">Revisi : 4</td><td width="50%" bgcolor="" align="right" style="text-align:right;"> Tanggal terbit : 14 Mei 2022</td></tr></tbody></table>');
$pdf->SetPrintFooter(true);

$pdf->SetHeaderMargin(4);
$pdf->SetFooterMargin(7);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$css = <<<EOF
  <style type="text/css">
  @media print {
    .hide {
       color: white;
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
       border-bottom: 0.5px solid black;
    }
    .bda {
       border: 0.5px solid black;
    }
    .u {
      text-decoration: underline;
    }
    .b {
      font-weight: bold;
    }
    .txc {
      text-align: center;
    }
    .txl {
      text-align: left;
    }
  .fwb {
    font-weight: bold;
  }
  .ln09 {
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
    .bg-burem {
      background-color: #bebebe;
      line-height:20px;
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


$html = '';
$html .= $css;
/*
$html .= '<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10px;"><tbody><tr><td class="txl" width="350">RSU ISLAM KLATEN</td><td class="txr" width="330">FM/RM/<span class="b" style="font-size:9">01</span></td><td class="txr b" width="100">';
if(isset($copy) && $copy)
{
  $html .= 'COPY';
}
$html .= '</td></tr></tbody></table>';
*/
$html .= '<br /><br />
<table class="ln12" cellspacing="0" cellpadding="1" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:11px; "><tbody><tr>
<td class="txr" rowspan="5" width="65" bgcolor="" style="font-size:8px;"></td><td width="273" class="txc" rowspan="5" style="text-valign:middle; font-size:10px;" ><br /><br /><br /><span style="font-size:14px; line-height:18px; white-space:nowrap; "><b>DATA SOSIAL PASIEN <br />RAWAT INAP</b><span style="font-size:12px; font-weight:bold;"><i></i></span></span></td><td class="" rowspan="5" width="5"></td>';
$html .= '<td width="70">NO.RM</td>';
$html .= '<td width="10">:</td><td width="250">';
$html .= !empty($ranap) ? $no_reg : '';
$html .= '</td></tr><tr>';
$html .= '<td>NAMA</td>';
$html .= '<td>:</td><td>';
$html .= !empty($ranap) ? $nama : '';
$html .= '</td></tr><tr>';
$html .= '<td>NIK</td>';
$html .= '<td>:</td><td>';
$html .= !empty($ranap) ? $nik : '';
$html .= '</td></tr><tr>';
$html .= '<td>TGL LAHIR</td>';
$html .= '<td>:</td><td>';
// $html .= $umur;
$html .= !empty($ranap) ? date("d-m-Y", strtotime($tgl_lahir)) : '';
$html .= '</td></tr><tr>';
$html .= '<td>ALAMAT</td>';
$html .= '<td>:</td><td rowspan="2">';
$html .= !empty($ranap) ? $alamat : '';
$html .= '</td></tr>';
$html .= '<tr><td colspan="6" class="bdb">&nbsp;</td></tr>';
// $html .= '<tr><td class="bda txc b" colspan="6" style="background-color: rgb(245, 245, 245);">DIISI OLEH DOKTER</td></tr><tr style="line-height: 10%;"><td class="bda txc b" colspan="6"></td></tr>'; 
$html .= '</tbody></table>';

$html .= '<table class="ln14" cellspacing="0" cellpadding="1" width="" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:13px; "><tbody>';
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> A. </td><td colspan="4" width="653" class="bg-burem b">IDENTITAS PASIEN</td></tr>'; 
// $html .= '<tr><td width="20"> </td><td colspan="2" width="200">No. RM</td><td width="10">:</td><td>'.$no_reg.'</td></tr>'; 
// $html .= '<tr><td width="20"> </td><td colspan="2" width="200">Nama Pasien</td><td width="10">:</td><td>'.$nama.'</td></tr>'; 
// $html .= '<tr><td width="20"> </td><td colspan="2" width="200">Tgl. Lahir/Umur</td><td width="10">:</td><td>'.date("d-m-Y", strtotime($tgl_lahir)).' ('.$ranap['umur'].') </td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Umur</td><td width="10">:</td><td>'.$ranap['umur'].' </td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Jenis Kelamin</td><td width="10">:</td><td>'.(!empty($ranap) ? $jenis_kel : '').'</td></tr>'; 
// $html .= '<tr><td width="20"> </td><td colspan="2" width="200">Alamat Lengkap</td><td width="10">:</td><td width="450">'.$alamat.'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">No. Telepon/HP</td><td width="10">:</td><td>'.(!empty($ranap) ? $telp:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Agama</td><td width="10">:</td><td>'.(!empty($ranap) ? $agama:'').'</td></tr>'; 
// $html .= '<tr><td width="20"> </td><td colspan="2" width="200">No. KTP</td><td width="10">:</td><td>'.$nik.'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Status Perkawinan</td><td width="10">:</td><td>'.(!empty($ranap) ? $kawin:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Pendidikan</td><td width="10">:</td><td>'.(!empty($ranap) ? $didik:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Pekerjaan</td><td width="10">:</td><td>'.(!empty($ranap) ? $kerja:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Jenis dan Asal Rujukan</td><td width="10">:</td><td>'.(!empty($ranap) ? $rujuk:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Jenis Kunjungan</td><td width="10">:</td><td>'.(!empty($ranap) ? $kunjung:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Cara Pembayaran</td><td width="10">:</td><td>'.(!empty($ranap) ? $asuransi:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Prosedur/Cara Masuk</td><td width="10">:</td><td>'.(!empty($ranap) ? $asal:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Tanggal Masuk</td><td width="10">:</td><td>'.(!empty($ranap) ? $str_tgl_masuk:'').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Ruang</td><td width="10">:</td><td>'.(!empty($ranap) ? $bangsal:'').'</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> B. </td><td colspan="4" width="653" class="bg-burem b">IDENTITAS PENANGGUNG JAWAB PASIEN MONDOK</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Nama </td><td width="10">:</td><td>'.$ranap['pjawab'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Umur </td><td width="10">:</td><td>'.selisihymdhis($ranap['tgl_lahir_pjawab'], $tgl_masuk, 'umurtahun').'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Alamat Lengkap</td><td width="10">:</td><td>'.$ranap['almjawab'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">No. Telephon/HP </td><td width="10">:</td><td>'.$ranap['no_telp_pjawab'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="2" width="200">Hubungan dengan pasien </td><td width="10">:</td><td>'.$ranap['hubjawab'].'</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> C. </td><td colspan="4" width="653" class="bg-burem b">IDENTITAS KELUARGA YANG DAPAT DIHUBUNGI SAAT EMERGENCY/PENERIMA INFORMASI</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1. </td><td width="180">Nama </td><td width="10">:</td><td>'.$ranap['nama_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Umur </td><td width="10">:</td><td>'.$ranap['umur_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Alamat Lengkap </td><td width="10">:</td><td>'.$ranap['alamat_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">No. Telephon/HP </td><td width="10">:</td><td>'.$ranap['no_telp_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Hubungan dengan pasien </td><td width="10">:</td><td>'.$ranap['hub_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2. </td><td width="180">Nama </td><td width="10">:</td><td>'.$ranap['nama_darurat_2'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Umur </td><td width="10">:</td><td>'.$ranap['umur_darurat_2'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Alamat Lengkap </td><td width="10">:</td><td>'.$ranap['alamat_darurat_2'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">No. Telephon/HP </td><td width="10">:</td><td>'.$ranap['no_telp_darurat_2'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="180">Hubungan dengan pasien </td><td width="10">:</td><td>'.$ranap['hub_darurat_2'].'</td></tr>'; 
$html .= '<tbody></table>'; 


$html = str_replace("background-color:gray","background-color:black", utf8_encode($html));
$pdf->writeHTML($html, true, false, true, false, '');
/*
$pdf->SetY(-7);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 0, 'Revisi : 4', 0, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(0, 0, 'Tanggal terbit : 11 Mei 2022', 0, false, 'R', 0, '', 0, false, 'T', 'M');
*/
$file = "data_sosial_rawat_inap.pdf";
$pdf_type = 'I';
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
  $file = $dir."data_sosial_rawat_inap.pdf";
}
$pdf->Output($file, $pdf_type);
?>