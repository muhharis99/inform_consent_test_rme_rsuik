<?php
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class MyTCPDF extends TCPDF {
    var $htmlHeader;
    var $htmlFooter;
    public function setHtmlHeader($htmlHeader) {
        $this->htmlHeader = $htmlHeader;
    }
    public function Header() {
        // $this->Image(IMG.'stamp/bookmark.png', 176, -15, 27, 36, '', 'http://www.murviana.com', '', true, 200);
        // $this->Image(IMG.'stamp/bookmark.png', 193, -10, 10, 36, '', 'http://www.murviana.com', '', true, 200);
        $this->Image(IMG.'stamp/bookmark2.png', 166, 0, 45, 12, '', 'http://www.murviana.com', '', true, 200);
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
    .bg-burem1 {
      background-color: #efefef;
    }
    .tw {
      color: white !important;
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
$pdf = new MyTCPDF("P", "mm", "A4", true, "UTF-8", false);
// $pdf = new TCPDF("P", "mm", array("215", "297"), true, "UTF-8", false);

$pdf->SetTitle('Form/KU-PRPP/08 - '.$no_reg);
$pdf->SetSubject('General Consent');
$pdf->SetKeywords('RS Islam Klaten, Genral Consent');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT-2, PDF_MARGIN_TOP+3, PDF_MARGIN_RIGHT-8);
// $pdf->SetMargins(PDF_MARGIN_LEFT+3, PDF_MARGIN_TOP-23, PDF_MARGIN_RIGHT-13);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
$html_header = '<table border="0" cellpadding="0" cellspacing="0" style="font-size:11px;" width="100%"><tbody><tr><td align="left" width="50%">RSU ISLAM KLATEN</td><td width="50%" bgcolor="" align="right" style="text-align:right;"> <font style="font-size:10px;">Hal '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages().' </font> <b>Form/KU-PRPP/08</b></td></tr></tbody></table>';
$html_header .= $css;
$html_header .= '<br /><br /><table border="0" cellpadding="0" cellspacing="1" style="font-size: 12px; line-height:11px;" width="100%"><tbody><tr><td class="txr" rowspan="5" width="65" bgcolor="" style="font-size:8px;"></td><td width="265" class="txc" rowspan="5" style="text-valign:middle; font-size:10px;" ><br /><br /><br /><span style="font-size:14px; line-height:18px; white-space:nowrap; "><b>AKAD IJARAH<br />PASIEN <br /></b></span></td><td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250"> </td></tr>
  <tr><td>NAMA</td><td>:</td><td> </td></tr>
  <tr><td>NIK</td><td>:</td><td> </td></tr>
  <tr><td>TGL LAHIR</td><td>:</td><td> </td></tr>
  <tr><td>ALAMAT</td><td>:</td><td> </td></tr>
  <tr><td colspan="6" class="bdb" style="font-size:5px;">&nbsp;</td></tr>
</tbody></table>'; 
$pdf->setHtmlHeader($html_header);
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

function change_jkel($val) {
  switch ($val) {
    case 'L' : 
      $result = "LAKI-LAKI"; 
      break; 
    case 'P' : 
      $result = "PEREMPUAN"; 
      break; 
  }
  return $result; 
}

$html = '';
$html .= $css;
$html .= '<br /></br /><br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td colspan="4" class="txc"> <br /><br />Dengan menyebut nama <strong>Allah</strong> yang Maha Pengasih lagi Maha Penyayang. <br /> </td></tr>'; 
$html .= '<tr><td colspan="4" class="txj">Pada hari ini, _________ tanggal ___________________________ telah terjadi penanda tanganan akad ijarah pasien BPJS naik kelas VIP antara,</td></tr>';
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Nama </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>';
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">NIK </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Jabatan </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr><td colspan="4" class="txj">Bertindak untuk dan atas nama RSU. Islam Klaten, yang beralamat di Jl. Raya
                            Klaten - Solo Km. 4 Klaten, untuk Selanjutnya disebut sebagai PIHAK I (PERTAMA) /
                            <em>AJIR</em> dengan :</td></tr>';
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Nama </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Alamat </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Jabatan </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Jabatan </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr><td colspan="4" class="txj">Bertindak atas nama sendiri, atau mewakili pasien atas nama:</td></tr>';
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">No RM </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Nama </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Alamat </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr>
            <td width="50"> </td>
            <td width="100">Ruang </td>
            <td width="10">:</td>
            <td width="510"> </td>
          </tr>'; 
$html .= '<tr><td colspan="4" class="txj">Untuk selanjutnya disebut sebagai PIHAK II (KEDUA) /
                            <em>MUSTA\'JIR</em></td></tr>';
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr><td colspan="4" class="txj">Kedua belah pihak telah sepakat, memahami maksud dan isi dari akad <em>Ijarah&nbsp;</em>pasien BPJS naik kelas
                        	VIP tersebut di atas, dengan ketentuan dan syarat-syarat sebagai berikut: </td></tr>';
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr>
            <td width="35"> </td>
            <td width="15">1. </td>
            <td colspan="2" width="620" class="txj">PIHAK PERTAMA menyetujui untuk memberikan pelayanan kesehatan sesuai dengan
                            Standar Prosedur Operasional di RSU. Islam Klaten.</td>
          </tr>'; 
$html .= '<tr>
            <td width="35"> </td>
            <td width="15">2. </td>
            <td colspan="2" width="620" class="txj">PIHAK KEDUA membayarkan imbal jasa kepada PIHAK PERTAMA sebesar <b>50 % atau 75% dari tarif INA-CBGS kelas I</b></td>
          </tr>'; 
$html .= '<tr>
            <td width="35"> </td>
            <td width="15">3. </td>
            <td colspan="2" width="620" class="txj">PIHAK PERTAMA menerbitkan kuitansi penerimaan imbal jasa sesuai jumlah yang
                            diterima sebagai paket pelayanan tanpa perincian.</td>
          </tr>'; 
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr><td colspan="4" class="txc"> Klaten, ___________________________ </td></tr>'; 
$html .= '<tr>
            <td width="210" class="txc">
              PIHAK II
              <br />
              <br />
              <br />
              <br />
              <div>_____________________________</div>
            </td>
            <td width="250" colspan="2">  </td>
            <td width="210" class="txc">
              PIHAK I
              <br />
              <br />
              <br />
              <br />
              <div>______________________________</div>
            </td>
          </tr>'; 
$html .= '<tr><td colspan="4" class="txj"> </td></tr>';
$html .= '<tr><td colspan="4" class="txc"> Saksi-saksi </td></tr>'; 
$html .= '<tr>
            <td width="210" class="txc">
               
              <br />
              <br />
              <br />
              <br />
              <div>_____________________________</div>
            </td>
            <td width="250" colspan="2">  </td>
            <td width="210" class="txc">
               
              <br />
              <br />
              <br />
              <br />
              <div>_____________________________</div>
            </td>
          </tr>'; 
$html .= '<tbody></table>'; 

$html = str_replace("background-color:gray","background-color:black", utf8_encode($html));
$pdf->writeHTML($html, true, false, true, false, '');

$file = "general_consent.pdf";
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
  $file = $dir."general_consent.pdf";
}
$pdf->Output($file, $pdf_type);
?>