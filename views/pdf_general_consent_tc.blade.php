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
// $pdf = new TCPDF("P", "mm", array("215", "297"), true, "UTF-8", false);

$pdf->SetTitle('FM/RM/16.3 - '.$no_reg);
$pdf->SetSubject('General Consent');
$pdf->SetKeywords('RS Islam Klaten, Genral Consent');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT-2, PDF_MARGIN_TOP-23, PDF_MARGIN_RIGHT-8);
// $pdf->SetMargins(PDF_MARGIN_LEFT+3, PDF_MARGIN_TOP-23, PDF_MARGIN_RIGHT-13);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
$pdf->setHtmlHeader('<table border="0" cellpadding="0" cellspacing="0" style="font-size:11px;" width="100%"><tbody><tr><td align="left" width="50%">RSU ISLAM KLATEN</td><td width="50%" bgcolor="" align="right" style="text-align:right;"> <font style="font-size:10px;">Hal '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages().' </font> <b>FM/RM/16.3</b></td></tr></tbody></table>');
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

function change_jkel($val) {
  $result = '';
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
/*
$html .= '<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10px;"><tbody><tr><td class="txl" width="350">RSU ISLAM KLATEN</td><td class="txr" width="330">FM/RM/<span class="b" style="font-size:9">16.3</span> Hal 1/2</td><td class="txr b" width="100">';
if(isset($copy) && $copy)
{
  $html .= 'COPY';
}
$html .= '</td></tr></tbody></table>';
*/
$html .= '<br /><br />
<table class="ln12" cellspacing="0" cellpadding="1" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:11px; "><tbody><tr>
<td class="txr" rowspan="5" width="65" bgcolor="" style="font-size:8px;"></td><td width="273" class="txc" rowspan="5" style="text-valign:middle; font-size:10px;" ><br /><br /><br /><span style="font-size:14px; line-height:18px; white-space:nowrap; "><b>PERSETUJUAN UMUM <br />(<i>GENERAL CONSENT</i>)</b></span></td><td class="" rowspan="5" width="5"></td>';
/*
$html .= '<br /><br />
<table class="ln12" cellspacing="0" cellpadding="1" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:11px; "><tbody><tr>
<td class="txr" rowspan="5" width="5" style="font-size:8px;"></td><td width="333" class="txc" rowspan="5" ><span style="font-size:14px; white-space:nowrap; "><br><br><b>PERSETUJUAN UMUM/<i>GENERAL CONSENT</i></b><br><span style="font-size:12px; font-weight:bold;"><i></i></span></span></td><td class="" rowspan="5" width="5"></td>';
*/
$html .= '<td width="70">NO.RM</td>';
$html .= '<td width="10">:</td><td width="250">';
(!empty($ranap)) ? $html .= $no_reg : '';
$html .= '</td></tr><tr>';
$html .= '<td>NAMA</td>';
$html .= '<td>:</td><td>';
(!empty($ranap)) ? $html .= $nama : '';
$html .= '</td></tr><tr>';
$html .= '<td>NIK</td>';
$html .= '<td>:</td><td>';
(!empty($ranap)) ? $html .= $nik : '';
$html .= '</td></tr><tr>';
$html .= '<td>TGL LAHIR</td>';
$html .= '<td>:</td><td>';
// $html .= $umur;
(!empty($ranap)) ? $html .= date("d-m-Y", strtotime($tgl_lahir)) : '';
$html .= '</td></tr><tr>';
$html .= '<td>ALAMAT</td>';
$html .= '<td>:</td><td rowspan="2">';
$html .= (!empty($ranap)) ? $alamat : '';
$html .= '</td></tr>';
$html .= '<tr><td colspan="6" class="bdb">&nbsp;</td></tr>';
/*
$html .= '<td width="70"> </td>';
$html .= '<td width="10"> </td><td width="250">';
// $html .= $no_reg;
$html .= '</td></tr><tr>';
$html .= '<td> </td>';
$html .= '<td> </td><td>';
// $html .= $nama;
$html .= '</td></tr><tr>';
$html .= '<td> </td>';
$html .= '<td> </td><td>';
// $html .= $nik;
$html .= '</td></tr><tr>';
$html .= '<td> </td>';
$html .= '<td> </td><td>';
// $html .= $umur;
// $html .= date("d-m-Y", strtotime($tgl_lahir));
$html .= '</td></tr><tr>';
$html .= '<td> </td>';
$html .= '<td> </td><td rowspan="2">';
// $html .= $alamat;
$html .= '</td></tr>';
$html .= '<tr><td colspan="6" class="bdb">&nbsp;</td></tr>';
*/
$html .= '</tbody></table>';
$html .= '<br /></br /><br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td colspan="3" class="">Yang bertanda tangan dibawah ini : </td></tr>'; 
$html .= '<tr><td width="110">Nama </td><td width="10">:</td><td>'.((!empty($ranap)) ? $ranap['pjawab'].' &nbsp; ('.change_jkel($ranap['jenis_kel_pjawab']).')' : '').'</td></tr>'; 
$html .= '<tr><td width="110">Tanggal Lahir </td><td width="10">:</td><td>'.tampiltanggal($ranap['tgl_lahir_pjawab']).'</td></tr>'; 
$html .= '<tr><td width="110">Alamat </td><td width="10">:</td><td width="553" >'.$ranap['almjawab'].'</td></tr>'; 
$html .= '<tr><td colspan="3" class="">Bertindak sebagai : '.$ranap['hubjawab'].' dari pasien berikut : </td></tr>'; 
$html .= '<tr><td width="110">No RM </td><td width="10">:</td><td>'.((!empty($ranap)) ? $no_reg : '').'</td></tr>'; 
$html .= '<tr><td width="110">Nama </td><td width="10">:</td><td>'.((!empty($ranap)) ? $nama : '').'</td></tr>'; 
$html .= '<tr><td width="110">Tanggal Lahir </td><td width="10">:</td><td>'.((!empty($ranap)) ? tampiltanggal($tgl_lahir) : '').'</td></tr>'; 
$html .= '<tr><td width="110">Alamat </td><td width="10">:</td><td width="553" >'.((!empty($ranap)) ? $alamat : '').'</td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<table class="ln14" cellspacing="0" cellpadding="1" width="" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> A. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="3" class="txj" width="633">Saya mengizinkan dokter dan profesi kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberi pengobatan medis, seperti yagn diperlukan dalam penilaian profesionalisme mereka. Prosedur diagnostik dan perawatan medis termasuk tetapi tidak terbatas pada : elektrokardiograf, x-ray, test darah, terapi fisik, pemberian obat, pemasangan infus, selang lambung/NGT, kateter urin, suntikan langsung dan medikasi. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">3.</td><td colspan="3" width="633">Saya sadar bahwa praktek kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada pasien. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">4.</td><td colspan="3" width="633">Saya mengerti dan memahami bahwa : </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">a. </td><td colspan="2" width="613">Pasien memiliki hak untuk mendapatkan penjelasan tentang kondisi klinis, rencana pengobatan/tindakan. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">b. </td><td colspan="2" width="613">Pasien memiliki hak untuk mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">c. </td><td colspan="2" width="613">Pasien memiliki hak untuk persetujuan atau menolak persetujuan untuk setiap prosedur/terapi. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">d. </td><td colspan="2" width="613">Banyak dokter pada staf medis rumah sakit yang bukan karyawan tetapi staf tamu yang telah diberikan hak untuk menggunakan fasilitas untuk perawatan dan pengobatan pasien mereka. </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> B. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PERLINDUNGAN ATAS HAK MILIK</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Saya telah memahami bahwa rumah sakit tidak bertanggung jawab atas semua kehilangan barang-barang milik pasien dan kami bertanggungjawab atas barang-barang berharga yang kami miliki termasuk namun tidak terbatas pada uang, perhiasan, buku cek, kartu kredit, handphone atau barang lainnya. Dan apabila saya membutuhkan saya dapat menitipkan barang-barang saya tersebut kepada rumah sakit. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Saya juga mengerti bahwa saya harus memberitahu/menitipkan pada RS jika pasien memiliki gigi palsu, kaca mata, lensa kontak prosthetics atau barang lainnya yang saya butuhkan untuk diamankan. </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> C. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PENGAJUAN KELUHAN</td></tr>'; 
$html .= '<tr><td width="20" class="b">  </td><td colspan="4" class="txj" width="653" class="">Saya menyatakan bahwa saya telah menerima informasi tentang adanya tata cara mengajukan keluhan dengan cara SMS ke No. 0815 673 3270, Email : informasi@rsuislamklaten.co.id atau bisa menulis langsung dan diserahkan kepada petugas RS. Saya setuju untuk mengikuti tatacara mengajukan keluhan sesuai prosedur yang ada</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> D. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PERLINDUNGAN ATAS PRIVASI PASIEN</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Saya memberi kuasa kepada RSU Islam Klaten untuk menjaga privasi dan kerahasiaan penyakit diri saya sendiri/suami/istri/anak/keluarga *) saya selama dalam perawatan. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="3" class="txj" width="633">Saya membutuhkan/tidak membutuhkan *) privasi khusus kepada RS untuk tidak memberi akses bagi pada orang bernama: </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">a. </td><td colspan="2" width="613">___________________________________</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">b. </td><td colspan="2" width="613">___________________________________</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> E. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PERSETUJUAN PELEPASAN INFORMASI</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Saya memahami Rumah Sakit Islam akan menjamin kerahasiaan informasi mengenai pasien termasuk diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan digunakan utnuk perawatan medis. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="3" class="txj" width="633">Saya memberi wewenang kepada RS untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan bila diperlukan untuk memproses klaim asuransi/BPJS/Perusahaan dan/atau lembaga pemerintahan. </td></tr>'; 
$html .= '<tbody></table>'; 


$html = str_replace("background-color:gray","background-color:black", utf8_encode($html));
$pdf->writeHTML($html, true, false, true, false, '');
/*
$pdf->SetY(-7);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 0, 'Revisi : 4', 0, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(0, 0, 'Tanggal terbit : 11 Mei 2022', 0, false, 'R', 0, '', 0, false, 'T', 'M');
*/
$pdf->SetFont('zapfdingbats', '', 14);
$pdf->AddPage();
$html = '';
$html .= $css;
/*
$html .= '<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 10px;"><tbody><tr><td class="txl" width="350">RSU ISLAM KLATEN</td><td class="txr" width="330">FM/RM/<span class="b" style="font-size:9">16.3</span> Hal 2/2</td><td class="txr b" width="100">';
if(isset($copy) && $copy)
{
  $html .= 'COPY';
}
$html .= '</td></tr></tbody></table>';
*/
$html .= '<br /></br /><br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td width="20"> </td><td width="20">3.</td><td colspan="3" class="txj" width="633">Saya memberi wewenang kepada RS untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan pasien kepada anggota keluarga saya, yaitu : </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">a. </td><td colspan="2" width="613">'.$ranap['nama_darurat_1'].' hubungan dengan pasien : '.$ranap['hub_darurat_1'].'</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td width="20">b. </td><td colspan="2" width="613">'.$ranap['nama_darurat_2'].' hubungan dengan pasien : '.$ranap['hub_darurat_2'].'</td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> F. </td><td colspan="4" class="txj" width="653" class="bg-burem b">INFORMASI TENTANG HAK DAN TANGGUNG JAWAB PASIEN</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Pasien memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit pasien, dan dalam hal perawatan medis dan rencana pengobatan. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="3" class="txj" width="633">Saya telah mendapat informasi tentang Hak dan Tanggung Jawab Pasien di RSU Islam Klaten melalui <i>leaflet</i>, <i>banner</i> dan penjelasan yang disampaikan oleh petugas. </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tr><td width="20" class="bg-burem b"> G. </td><td colspan="4" class="txj" width="653" class="bg-burem b">INFORMASI BIAYA</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="4" class="txj" width="653">Saya memahami tentang informasi biaya pengobatan atau biaya tindakan yang dijelaskan oleh petugas RS. </td></tr>'; 
$html .= '<tr><td width="20" class=""> </td><td colspan="4" class=""> </td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td width="20" class="bg-burem b"> H. </td><td colspan="6" class="txj" width="653" class="bg-burem b">INFORMASI RAWAT INAP</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="6" class="txj" width="633">Saya telah mendapatkan informasi tentang pelayanan yang akan dilakukan dan hasil pelayanan yang diharapkan. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="6" class="txj" width="633">Saya akan menjalani perawatan di rawat inap Rumah Sakit Umum Islam Klaten di ruang </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">3.</td><td colspan="6" class="txj" width="633">Saya akan menggunakan hak saya sebagai pihak pasien</td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">  </td>
            <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && $akad->akad == 'UMUM') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/></td>
            <td width="200">Umum dan tidak beralih ke BPJS </td>
            <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && substr($akad->akad, 0, 4) == 'BPJS') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/></td>
            <td width="130">'.((!empty($akad->akad) && substr($akad->akad, 0, 4) == 'BPJS') ? $akad->akad : 'BPJS').' </td>
            <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && $akad->akad == 'ASURANSI') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/></td>
            <td width="248">Asuransi lain : ____________________ </td>
          </tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">4.</td><td colspan="6" class="txj" width="633">Saya bersedia membayar seluruh baya perawatan, pengobatan dan biaya administrasi lainnya sesuai dnengan kelas yang saya kehendaki. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">5.</td><td colspan="6" class="txj" width="633">Saya bersedia melengkapi persyaratan asuransi penjamin biaya perawatan dalam waktu maksimal : <b> 3x24 jam untuk BPJS dan 2x24 jam untuk asuransi lainnya, </b> sejak persetujuan ini dibuat. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">6.</td><td colspan="6" class="txj" width="633">Khusus pasien BPJS, harus memenuhi persyaratan wajib sebagai pasien BPJS (KTP/KK/Kartu BPJS) pada saat menandatangani persetujuan ini, dan melengkapi persyaratan lainnya sesuai poin b). </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">7.</td><td colspan="6" class="txj" width="633">Apabila pasien telah diperkenankan pulang oleh dokter, maka bersedia untuk segera menyelesaikan administrasi dan <b> meninggalkan kamar dalam waktu maksimal 3 jam dari instruksi pulang dokter. </b> </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">8.</td><td colspan="6" class="txj" width="633">Jika waktu lebih dari 3 jam belum meninggalkan kamar, pasien/keluarga bersedia dikenakan biaya sebesar tarif akomodasi kamar yang ditempati. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">9.</td><td colspan="6" class="txj" width="633">Saya telah menerima informasi tentang peraturan yang diberlakukan oleh RS, dan saya beserta keluarga bersedia untuk mematuhinya termasuk mematuhi jam kunjung pasien sesuai dengan aturan RS. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">10.</td><td colspan="6" class="txj" width="633">Anggota keluarga/penunggu pasien bersedia untuk selalu memakai tanda pengenal khusus yang diberikan oleh RS dan demi keamanan seluruh pasien. Setiap keluarga dan siapapun yang akan mengunjungi pasien diluar jam berkunjung, bersedia untuk diminta/diperiksa identitasnya. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td colspan="6" class="txj" width="633"> </td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td width="20" class="bg-burem b"> I. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PELAYANAN SYARI\'AH UNTUK PASIEN MUSLIM/MUSLIMAH</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="4" class="txj" width="653">Bersama ini saya telah diberikan informasi mengenai pelayanan syari\'ah yang diberikan kepada pasien muslim/muslimah :  </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">1.</td><td colspan="3" class="txj" width="633">Penjagaan aurat dengan : menutup tirai saat tindakan, penyediaan hijab dan penutup dada ibu menyusui. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">2.</td><td colspan="3" class="txj" width="633">Bimbingan/pendampingan ibadah : wudhu/tayammum, sholat dan diingatkan waktu sholat. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">3.</td><td colspan="3" class="txj" width="633">Pada saat perawatan pasien ditunggu oleh keluarga (mahramnya). </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">4.</td><td colspan="3" class="txj" width="633">Penyediaan gizi halal dan tidak menggunakan peralatan makan untuk makanan selain yang disajikan dari rumah sakit. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20">5.</td><td colspan="3" class="txj" width="633">Pelayanan sakaratul maut (bimbingan talqin). </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td colspan="3" class="txj" width="633">  </td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td width="20" class="bg-burem b"> J. </td><td colspan="4" class="txj" width="653" class="bg-burem b">PENDIDIKAN DAN PELATIHAN</td></tr>'; 
$html .= '<tr><td width="20"> </td><td colspan="4" class="txj" width="653"> Saya dengan ini memberikan persetujuan atas keberadaan peserta didik dalam proses pelayanan dan penggunaan data untuk pembelajaran dan penelitian. </td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td colspan="3" class="txj" width="633">  </td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td colspan="4" class="txj" width="673">Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah membaca dan memahami item pada Persetujuan Umum/<i>General Consent.</i></td></tr>'; 
$html .= '<tr><td width="20"> </td><td width="20"> </td><td colspan="2" class="txj" width="633">  </td></tr>'; 
$html .= '<tbody></table>'; 
$html .= '<br /><table class="ln14" cellspacing="0" cellpadding="1" width="100%" style="border-collapse: collapse;  font-family: sans-serif;  font-size: 12px; line-height:14px; "><tbody>';
$html .= '<tr><td class="txc" width="300"> </td><td width="73"> </td><td class="txc" width="300"> Klaten, '.tampiltanggal($ranap['tgl_ri']).' Jam : '.substr($ranap['jam_ri'], 0, 5).' </td></tr>'; 
$html .= '<tr><td class="txc" width="300"> Yang membuat pernyataan </td><td width="73"> </td><td class="txc" width="300"> Petugas </td></tr>'; 
$html .= '<tr><td class="txc" width="300">  </td><td width="73"> <br /><br /><br /> </td><td class="txc" width="300">  </td></tr>'; 
$html .= '<tr><td class="txc" width="300"> ( '.((!empty($ranap)) ? $ranap['pjawab'] : '_____________________').' ) </td><td width="73"> </td><td class="txc" width="300"> ( '.((!empty($ranap)) ? $nama_petugas : '_____________________').' ) </td></tr>'; 
$html .= '<tbody></table>'; 
$html = str_replace("background-color:gray","background-color:black", utf8_encode($html));
$pdf->writeHTML($html, true, false, true, false, '');
/*
$pdf->SetY(-7);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 0, 'Revisi : 4', 0, false, 'L', 0, '', 0, false, 'T', 'M');
$pdf->Cell(0, 0, 'Tanggal terbit : 11 Mei 2022', 0, false, 'R', 0, '', 0, false, 'T', 'M');
*/
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