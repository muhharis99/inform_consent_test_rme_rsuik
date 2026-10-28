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
<td colspan="14">INSTALASI JANTUNG TERPADU';
// $html .= strtoupper($domain);
$html .= '</td>
</tr>
<tr>
<td colspan="14">Laporan Pendapatan Harian';
$html .= '</td>
</tr>
<tr>
<td colspan="14">Tanggal: ';
//$tgls = $tanggal;
//$tanggal = bulan(date('m', strtotime($tanggal))).' '.date('Y', strtotime($tanggal));
$html .= $tanggal1.' s/d '.$tanggal2;
$html .= '</td>
</tr>';
if ($tanggal1 != $tanggal2) {
  $html .= '
  <tr>
  <td colspan="14"></td>
  </tr>
  <tr>
  <td class="bdb thd txl" colspan="6" width="300">Keterangan</td>
  <td class="bdb thd" width="50">Adm</td>
  <td class="bdb thd" width="60">Pemk. <br />Dokter</td>
  <td class="bdb thd" width="40">Tind. <br />Dokter</td>
  <td class="bdb thd" width="60">Tind. <br />Perawat</td>
  <td class="bdb thd" width="60">Bahan. <br />Alat</td>
  <td class="bdb thd" width="60">Bahan. <br />Khusus</td>
  <td class="bdb thd" width="65">Total</td>
  <td class="bdb thd" width="0"> </td>
  </tr>';
} else {
  $html .= '
  <tr>
  <td colspan="14"></td>
  </tr>
  <tr>
  <td class="bdb thd" width="20">No</td>
  <td class="bdb thd" width="40">No SPM</td>
  <td class="bdb thd" width="40">No RM</td>
  <td class="bdb thd" width="20">Rel</td>
  <td class="bdb thd" width="80">Nama Pasien</td>
  <td class="bdb thd" width="100">Dokter</td>
  <td class="bdb thd" width="60">Adm</td>
  <td class="bdb thd" width="60">Pemk. <br />Dokter</td>
  <td class="bdb thd" width="40">Tind. <br />Dokter</td>
  <td class="bdb thd" width="55">Tind. <br />Perawat</td>
  <td class="bdb thd" width="60">Bahan. <br />Alat</td>
  <td class="bdb thd" width="60">Bahan. <br />Khusus</td>
  <td class="bdb thd" width="60">Total</td>
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
    

  if (!empty($content) > 0) {
    foreach($content as $all) {
      $all = (object) $all;
      $html_grand = '';
      if ($all->category != $category) {
        if ($category != '') {
          $html_grand .= '<tr style="background-color:#bebebe; font-weight:bold;">';
          $html_grand .= '<td class="txr">***</td>';
          $html_grand .= '<td class="txl" colspan="5">TOTAL POLI '.$category.' (RI + RJ)</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom1).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom2).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom3).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom4).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom5).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_kom6).'</td>';
          $html_grand .= '<td class="txr">'.number_format($grand_netto).'</td>';
          $html_grand .= '<td class="txr"> </td>';
          $html_grand .= '</tr>';
          $html .= $html_grand;
          $html .= '<tr>
                      <td colspan="14"> </td>
                    </tr>';
        }
        $category = $all->category;
        $grand_kom1 = 0;
        $grand_kom2 = 0; 
        $grand_kom3 = 0; 
        $grand_kom4 = 0; 
        $grand_kom5 = 0; 
        $grand_kom6 = 0; 
        $grand_netto = 0; 
      }
      
      $rawat = $all->rawat;
      $sub_kom1 = 0;
      $sub_kom2 = 0; 
      $sub_kom3 = 0; 
      $sub_kom4 = 0; 
      $sub_kom5 = 0; 
      $sub_kom6 = 0; 
      $sub_netto = 0; 

      $html .= '
        <tr>
          <td colspan="14" style="font-weight:bold; padding-left:10px; padding-right:10px;">'.$all->title.'</td>
        </tr>';
      $data = (object) null; 
      $data = $all->data;

      if (!empty($data)) {
        $arr_summary = array();
        $arr_total = array(); 
        $arr_tepat = array(); 
        $arr_terlambat = array();
        // $menit_terlambat = "";
        $dokter_terlambat = 0;
        $debug = '';
        $row = null;
        $sub_kom1 = 0;
        $sub_kom2 = 0; 
        $sub_kom3 = 0; 
        $sub_kom4 = 0; 
        $sub_kom5 = 0; 
        $sub_kom6 = 0; 
        $sub_netto = 0; 
        $sel_tanggal = "";
        $row_kom1 = 0;
        $row_kom2 = 0; 
        $row_kom3 = 0; 
        $row_kom4 = 0; 
        $row_kom5 = 0; 
        $row_kom6 = 0; 
        $row_netto = 0; 
        $jumlah_row = count($data);
        $last_row = $jumlah_row - 1;
        $j = 1;
        foreach ($data as $key=>$row) {
          $bgcolor = 'style="background-color:#FFFFFF;"';
          if (($i % 2) == 1) {
            $bgcolor = 'style="background-color:#EFEFEF;"';
          } else {
            $bgcolor = 'style="background-color:#FFFFFF;"';
          }
          $row = (object) $row;
          $tanggal = date('d-m-Y', strtotime($row->tanggal));
          $bdb = '';
          
          // if(count($data) == $i) 
          // { 123
          //   $bdb = '';
          // } else {
          //   $bdb = '';
          // }
              if ($tanggal1 == $tanggal2) {
                $html .= '<tr '.$bgcolor.'>';
                $html .= '<td class="txr '.$bdb.'">'.$i.'</td>';
                $html .= '<td class="txr '.$bdb.'">'.$row->no_tran.'</td>';
                $html .= '<td class="txr '.$bdb.'">'.$row->no_reg.'</td>';
                $html .= '<td class="txl '.$bdb.'">'.$row->no_rel.'</td>';
                $html .= '<td class="txl '.$bdb.'">'.$row->nama.'</td>';
                $html .= '<td class="txl '.$bdb.'">'.strtoupper($row->dokter).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom1).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom2).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom3).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom4).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom5).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->kom6).'</td>';
                $html .= '<td class="txr '.$bdb.'">'.number_format($row->netto).'</td>';
                $html .= '<td class="txr '.$bdb.'"> </td>';
                $html .= '</tr>';
              } else {
                if (($j % 2) == 1) {
                  $bgcolor = 'style="background-color:#EFEFEF;"';
                } else {
                  $bgcolor = 'style="background-color:#FFFFFF;"';
                }
                if ($sel_tanggal == "") {
                  $sel_tanggal = date('Y-m-d', strtotime($tanggal1));
                }
                if ($key == $last_row) {
                  $row_kom1 = $row_kom1 + $row->kom1;
                  $row_kom2 = $row_kom2 + $row->kom2;
                  $row_kom3 = $row_kom3 + $row->kom3;
                  $row_kom4 = $row_kom4 + $row->kom4;
                  $row_kom5 = $row_kom5 + $row->kom5;
                  $row_kom6 = $row_kom6 + $row->kom6;
                  $row_netto = $row_netto + $row->netto;
                  $html .= '<tr '.$bgcolor.'>';
                  $html .= '<td class="txl '.$bdb.'" colspan="6">'.date('d-m-Y', strtotime($sel_tanggal)).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom1).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom2).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom3).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom4).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom5).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom6).'</td>';
                  $html .= '<td class="txr '.$bdb.'">'.number_format($row_netto).'</td>';
                  $html .= '<td class="txr '.$bdb.'"> </td>';
                  $html .= '</tr>';
                  $j++;
                } else { 
                  if ($sel_tanggal == $row->tanggal) {
                    $row_kom1 = $row_kom1 + $row->kom1;
                    $row_kom2 = $row_kom2 + $row->kom2;
                    $row_kom3 = $row_kom3 + $row->kom3;
                    $row_kom4 = $row_kom4 + $row->kom4;
                    $row_kom5 = $row_kom5 + $row->kom5;
                    $row_kom6 = $row_kom6 + $row->kom6;
                    $row_netto = $row_netto + $row->netto;
                  } else {                  
                    $html .= '<tr '.$bgcolor.'>';
                    $html .= '<td class="txl '.$bdb.'" colspan="6">'.date('d-m-Y', strtotime($sel_tanggal)).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom1).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom2).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom3).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom4).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom5).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_kom6).'</td>';
                    $html .= '<td class="txr '.$bdb.'">'.number_format($row_netto).'</td>';
                    $html .= '<td class="txr '.$bdb.'"> </td>';
                    $html .= '</tr>';
                    $j++;
                    $row_kom1 = 0;
                    $row_kom2 = 0; 
                    $row_kom3 = 0; 
                    $row_kom4 = 0; 
                    $row_kom5 = 0; 
                    $row_kom6 = 0; 
                    $row_netto = 0;
                    $sel_tanggal = $row->tanggal; 
                    $row_kom1 = $row_kom1 + $row->kom1;
                    $row_kom2 = $row_kom2 + $row->kom2;
                    $row_kom3 = $row_kom3 + $row->kom3;
                    $row_kom4 = $row_kom4 + $row->kom4;
                    $row_kom5 = $row_kom5 + $row->kom5;
                    $row_kom6 = $row_kom6 + $row->kom6;
                    $row_netto = $row_netto + $row->netto;
                  }
                }
              }

          $i++;
            
          $sub_kom1 = $sub_kom1 + $row->kom1;
          $sub_kom2 = $sub_kom2 + $row->kom2; 
          $sub_kom3 = $sub_kom3 + $row->kom3; 
          $sub_kom4 = $sub_kom4 + $row->kom4; 
          $sub_kom5 = $sub_kom5 + $row->kom5; 
          $sub_kom6 = $sub_kom6 + $row->kom6; 
          $sub_netto = $sub_netto + $row->netto;
          switch ($all->rawat) {
            case 'JALAN':
              switch ($row->no_rel) {
                case '300' :
                case '301' :
                case '302' :
                case '303' :
                case '306' :
                  $rajal_bpjs = $rajal_bpjs + $row->netto;
                  break;
                case '000' : 
                case '001' : 
                  $rajal_umum = $rajal_umum + $row->netto; 
                  break;
                default:
                  $rajal_askom = $rajal_askom + $row->netto; 
                  break;
              }
              $rajal_relasi = $rajal_relasi + $row->netto;
              break;
            
            case 'INAP':
              switch ($row->no_rel) {
                case '300' :
                case '301' :
                case '302' :
                case '303' :
                case '306' :
                  $ranap_bpjs = $ranap_bpjs + $row->netto;
                  break;
                case '000' : 
                case '001' : 
                  $ranap_umum = $ranap_umum + $row->netto; 
                  break;
                default:
                  $ranap_askom = $ranap_askom + $row->netto; 
                  break;
              }
              $ranap_relasi = $ranap_relasi + $row->netto;
              break;
          }
        }
        
        $grand_kom1 = $grand_kom1 + $sub_kom1;
        $grand_kom2 = $grand_kom2 + $sub_kom2; 
        $grand_kom3 = $grand_kom3 + $sub_kom3; 
        $grand_kom4 = $grand_kom4 + $sub_kom4; 
        $grand_kom5 = $grand_kom5 + $sub_kom5; 
        $grand_kom6 = $grand_kom6 + $sub_kom6; 
        $grand_netto = $grand_netto + $sub_netto;
        
        switch ($all->rawat) {
          case 'JALAN' : 
            $rajal_kom1 = $rajal_kom1 + $grand_kom1;
            $rajal_kom2 = $rajal_kom2 + $grand_kom2; 
            $rajal_kom3 = $rajal_kom3 + $grand_kom3; 
            $rajal_kom4 = $rajal_kom4 + $grand_kom4; 
            $rajal_kom5 = $rajal_kom5 + $grand_kom5; 
            $rajal_kom6 = $rajal_kom6 + $grand_kom6; 
            $rajal_netto = $rajal_netto + $grand_netto; 
            break; 
          case 'INAP' : 
            $ranap_kom1 = $ranap_kom1 + $grand_kom1;
            $ranap_kom2 = $ranap_kom2 + $grand_kom2; 
            $ranap_kom3 = $ranap_kom3 + $grand_kom3; 
            $ranap_kom4 = $ranap_kom4 + $grand_kom4; 
            $ranap_kom5 = $ranap_kom5 + $grand_kom5; 
            $ranap_kom6 = $ranap_kom6 + $grand_kom6; 
            $ranap_netto = $ranap_netto + $grand_netto; 
            break; 
        }
        $total_rawat_kom1 = $total_rawat_kom1 + $grand_kom1;
        $total_rawat_kom2 = $total_rawat_kom2 + $grand_kom2; 
        $total_rawat_kom3 = $total_rawat_kom3 + $grand_kom3; 
        $total_rawat_kom4 = $total_rawat_kom4 + $grand_kom4; 
        $total_rawat_kom5 = $total_rawat_kom5 + $grand_kom5; 
        $total_rawat_kom6 = $total_rawat_kom6 + $grand_kom6; 
        $total_rawat_netto = $total_rawat_netto + $grand_netto; 
      }
      $html .= '<tr style="background-color:#cccccc; font-weight:bold;">';
      $html .= '<td class="txr"> </td>';
      $html .= '<td class="txr" colspan="5">** Sub Total Rawat '.ucwords(strtolower($rawat)).' **</td>';
      $html .= '<td class="txr">'.number_format($sub_kom1).'</td>';
      $html .= '<td class="txr">'.number_format($sub_kom2).'</td>';
      $html .= '<td class="txr">'.number_format($sub_kom3).'</td>';
      $html .= '<td class="txr">'.number_format($sub_kom4).'</td>';
      $html .= '<td class="txr">'.number_format($sub_kom5).'</td>';
      $html .= '<td class="txr">'.number_format($sub_kom6).'</td>';
      $html .= '<td class="txr">'.number_format($sub_netto).'</td>';
      $html .= '<td class="txr"> </td>';
      $html .= '</tr>';
    }
    $html_grand .= '<tr style="background-color:#bebebe; font-weight:bold;">';
    $html_grand .= '<td class="txr">***</td>';
    $html_grand .= '<td class="txl" colspan="5">TOTAL POLI '.$category.' (RI + RJ)</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom1).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom2).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom3).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom4).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom5).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_kom6).'</td>';
    $html_grand .= '<td class="txr">'.number_format($grand_netto).'</td>';
    $html_grand .= '<td class="txr"> </td>';
    $html_grand .= '</tr>';
    $html .= $html_grand;
    $html .= '<tr>
                <td colspan="14"> </td>
              </tr>';
/*
    $html .= '<tr style="background-color:#cccccc; font-weight:bold;">';
    $html .= '<td class="txr bdt"> *** </td>';
    $html .= '<td class="txl bdt" colspan="5">PENDAPATAN RAWAT JALAN</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom1).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom2).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom3).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom4).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom5).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_kom6).'</td>';
    $html .= '<td class="txr bdt">'.number_format($rajal_netto).'</td>';
    $html .= '<td class="txr bdt"> </td>';
    $html .= '</tr>';
    $html .= '<tr style="background-color:#cccccc; font-weight:bold;">';
    $html .= '<td class="txr"> *** </td>';
    $html .= '<td class="txl" colspan="5">PENDAPATAN RAWAT INAP</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom1).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom2).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom3).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom4).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom5).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_kom6).'</td>';
    $html .= '<td class="txr">'.number_format($ranap_netto).'</td>';
    $html .= '<td class="txr"> </td>';
    $html .= '</tr>';
    $html .= '<tr style="background-color:#bebebe; font-weight:bold;">';
    $html .= '<td class="txr bdb"> *** </td>';
    $html .= '<td class="txl bdb" colspan="5">TOTAL PENDAPATAN</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom1).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom2).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom3).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom4).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom5).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_kom6).'</td>';
    $html .= '<td class="txr bdb">'.number_format($total_rawat_netto).'</td>';
    $html .= '<td class="txr bdb"> </td>';
    $html .= '</tr>';
  */
    $html .= '<tr>
                <td colspan="14"> </td>
              </tr>';
  }
if ($dokter_terlambat != 0) {
  $waktu_tunggu = floor($menit_terlambat/$dokter_terlambat);
} else {
  $waktu_tunggu = 0;
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
	$xhtml .= '
	<div style="padding-left:50px; float:left;">
		<table class="" cellspacing="0" cellpadding="2" style="border-collapse: collapse;  font-family: sans-serif; font-size: 11px;">
			<tr>
				<td colspan="5">PERSENTASE KETEPATAN PRAKTEK </td>
			</tr>
			<tr>
				<td colspan="5">
					Tanggal '.$tanggal1.' s/d '.$tanggal2.'
				</td>
			</tr>
			<tr>
				<td colspan="5">
					&nbsp;
				</td>
			</tr>
			';
	$arr_tepat_count = array_count_values($arr_tepat);
	$arr_terlambat_count = array_count_values($arr_terlambat);
	$arr_total_count = array_count_values($arr_total); 
	ksort($arr_total_count);
	switch (count($arr_total_count)) {
		case 1 : 
			$xhtml .= '
					<tr>
						<td class="bdb thd txj" colspan="2" width="460">Dokter</td>
						<td class="bdb thd txr" width="70">Tepat</td>
						<td class="bdb thd txr" width="70">Praktek</td>
						<td class="bdb thd txr" width="90">Persentase</td>
					</tr>
			';
			$no=1; 
			foreach ($arr_total_count as $key => $value) {
				$tepat = 0; 
				foreach ($arr_tepat_count as $nkey => $nvalue) {
					if ($nkey == $key) {
						$tepat = $nvalue; 
					}
				}
				$total = $value; 
				$persentase = $tepat / $total * 100; 
				$persentase = round($persentase, 0)." %"; 
				$xhtml .= '
					<tr>
						<td class="txj" colspan="2">'.$key.'</td>
						<td class="txr">'.$tepat.'</td>
						<td class="txr">'.$total.'</td>
						<td class="txr">'.$persentase.'</td>
						'; 
				$xhtml .= '
					</tr>';
				$no++;
			}

			break; 
		default : 
			$xhtml .= '
					<tr>
						<td class="bdb thd" width="30">No</td>
						<td class="bdb thd" width="430">Dokter</td>
						<td class="bdb thd txr" width="70">Tepat</td>
						<td class="bdb thd txr" width="70">Praktek</td>
						<td class="bdb thd txr" width="90">Persentase</td>
					</tr>
			';
      $sum_persentase = 0;
      $total_dokter_praktek = 0;
			$no=1; 
			foreach ($arr_total_count as $key => $value) {
				$tepat = 0; 
				foreach ($arr_tepat_count as $nkey => $nvalue) {
					if ($nkey == $key) {
						$tepat = $nvalue; 
					}
				}
				$total = $value; 
        $persentase = $tepat / $total * 100; 
        $sum_persentase = $sum_persentase + $persentase;
				$persentase = round($persentase, 0)." %"; 
				$xhtml .= '
					<tr>
						<td class="txr">'.$no.'</td>
						<td class="txj">'.$key.'</td>
						<td class="txr">'.$tepat.'</td>
						<td class="txr">'.$total.'</td>
						<td class="txr">'.$persentase.'</td>
						'; 
				$xhtml .= '
          </tr>';
        $total_dokter_praktek = $no;
				$no++;
      }
      if ($total_dokter_praktek != 0) {
        $rata2 = floor($sum_persentase/$total_dokter_praktek);
      } else {
        $rata2 = 0;
      }
      /*
      $xhtml .= '
        <tr>
          <td colspan="5"></td>
        </tr>
        <tr>
          <td></td>
          <td> Jumlah Persentase </td>
          <td class="txl">'.floor($sum_persentase).' %</td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td></td>
          <td> Jumlah Dokter </td>
          <td class="txl">'.$total_dokter_praktek.' Dokter</td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td></td>
          <td> Rata-rata </td>
          <td class="txl">'.$rata2.' %</td>
          <td colspan="2"></td>
        </tr>';
      */
			break; 
	}
	

	
	$xhtml .= '
		</table>
	</div>';
//}

$html = str_replace("background-color:gray","background-color:black", $html);
$pdf->writeHTML($html, true, false, true, false, '');
if ($xhtml<>'') {
	// $pdf->AddPage();
	// $pdf->writeHTML($xhtml, true, false, true, false, '');
}
//$pdf->Output('print.pdf', 'F');

$file = "absen_dokter.pdf";
$pdf->Output($file, 'I');
?>