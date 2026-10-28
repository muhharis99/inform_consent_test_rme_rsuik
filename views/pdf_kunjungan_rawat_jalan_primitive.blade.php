<?php
function chango($val) { return str_replace('0', 'O', $val); }
$pdf = new TCPDF("P", "mm", "A4", true, "UTF-8", false);

$pdf->SetAuthor('RSU Islam Klaten');
$pdf->SetTitle('Kunjungan Rawat Jalan');
$pdf->SetSubject('Kunjungan Rawat Jalan');
$pdf->SetKeywords('RSU Islam Klaten, Kunjungan Pasien');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetFont("petme642y", "", 7, "", true);
$pdf->SetFontSpacing(0);

// set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT-12, PDF_MARGIN_TOP-19, PDF_MARGIN_RIGHT-12);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetAutoPageBreak(true, 15);
$pdf->Cell(20, 5, sprintf('Page %d of %s', $pdf->PageNo(), $pdf->getAliasNbPages()), 0, 0, 'C');
 // Page number
$pdf->Cell(0, 12, ' '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
$pdf->SetPrintHeader(false);
//$pdf->SetPrintFooter(false);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER-4);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-23);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();
$pdf->SetFillColor(190, 190, 190);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(128, 0, 0);
$pdf->SetLineWidth(0);
// $pdf->SetCellHeightRatio(8);
$pdf->SetCellPaddings(0.5, 0, 0, 0.5);
$pdf->Cell(0, 4, "INSTALASI RAWAT JALAN", 0, true, 'L', 0, '', 0, true, 'B', 'M'); $pdf->Ln();
$pdf->Cell(0, 4, "Laporan Kunjungan Harian", 0, true, 'L', 0, '', 0, true, 'B', 'M'); $pdf->Ln();
$pdf->Cell(0, 4, chango("Tanggal : $tanggal1 s/d $tanggal2"), 0, true, 'L', 0, '', 0, true, 'B', 'M'); $pdf->Ln();
$pdf->Ln();
// $pdf->SetFont('', 'B');
$header = array('NO', 'NO RM', 'NAMA', 'TGL LAHIR', 'UMUR', 'POLI', 'ANTRIAN', 'TGL. INDEN', 'TGL. DAFTAR');
$w = array(6, 10, 65, 15, 18, 30, 10, 25, 25);
foreach ($content as $row) {
  $row = (object) $row; 
  $pdf->SetFillColor(190, 190, 190);
  $pdf->Cell(0, 4, chango($row->report), 0, true, 'R', 1, '', 0, true, 'B', 'M'); $pdf->Ln();
  $rows_poli = $row->poli; 
  if (!empty($rows_poli)) {
    foreach ($rows_poli as $row_poli) {
      $row_poli = (object) $row_poli; 
      $rows_dokter = $row_poli->dokter;
      if (!empty($rows_dokter)) {
        foreach ($rows_dokter as $row_dokter) {
          $row_dokter = (object) $row_dokter;
          // $pdf->Cell(0, 4, chango($row_dokter->kode_dokter." - ".strtoupper($row_dokter->nama_dokter)." "), 0, false, 'L', 0, '', 0, true, 'B', 'M'); 
          $pdf->Cell(80, 4, chango($row_dokter->kode_dokter." - ".strtoupper($row_dokter->nama_dokter)), 0, false, 'L', 0, '', 0, true, 'B', 'M');
          $pdf->Cell(50, 4, chango($row_poli->kode_poli).":".chango($row_poli->nama_poli), 0, false, 'L', 0, '', 0, true, 'B', 'M');
          $pdf->Cell(38, 4, "ANTRIAN:".chango($row_dokter->antrian)." PASIEN", 0, false, 'L', 0, '', 0, true, 'B', 'M');
          $pdf->Cell(36, 4, "KUNJUNGAN:".chango($row_dokter->register)." PASIEN", 0, false, 'L', 0, '', 0, true, 'B', 'M');
          $pdf->Ln();
        
          $num_headers = count($header);
          $pdf->SetFillColor(190, 190, 190);
          for($i = 0; $i < $num_headers; ++$i) {
              $pdf->Cell($w[$i], 4, $header[$i], 0, false, 'L', 1, '', 0, true, 'B', 'M');
          }
          $pdf->Ln();
          $rows_pasien = $row_dokter->pasien;
          if (!empty($rows_pasien)) {
            $p = 1; 
            
            foreach ($rows_pasien as $row_pasien) {
              $row_pasien = (object) $row_pasien;
              if (empty($row_pasien->tgl_daftar)) {
                $row_pasien->tgl_daftar = ''; 
                $row_pasien->jam_daftar = ''; 
              } else {
                if ($row_pasien->tgl_daftar == $row_pasien->tgl_inden) {
                  $row_pasien->tgl_inden = ''; 
                  $row_pasien->jam_inden = ''; 
                }
              }
              $pdf->SetFillColor(239, 239, 239);
              if (($p % 2) == 1) { 
                $pdf->SetFillColor(255, 255, 255);
              }
              $pdf->Cell($w[0], 4, chango($p).".", 0, false, 'R', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[1], 4, chango($row_pasien->no_reg)." ", 0, false, 'R', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[2], 4, chango($row_pasien->nama), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[3], 4, chango($row_pasien->tgl_lahir), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[4], 4, chango($row_pasien->umur), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[5], 4, chango($row_poli->nama_poli), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[6], 4, chango($row_pasien->antrian), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[7], 4, chango($row_pasien->tgl_inden." ".$row_pasien->jam_inden), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Cell($w[8], 4, chango($row_pasien->tgl_daftar." ".$row_pasien->jam_daftar), 0, false, 'L', 1, '', 0, true, 'B', 'M');
              $pdf->Ln();
              $p ++;
            }
          } else {
            $pdf->Cell($w[0], 4, chango("- ")." ", 0, false, 'R', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[1], 4, chango("- ")." ", 0, false, 'R', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[2], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[3], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[4], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[5], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[6], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[7], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Cell($w[8], 4, chango("- "), 0, false, 'L', 0, '', 0, true, 'B', 'M');
            $pdf->Ln();
          }
          
            $pdf->Ln();
        }
      }
    }
  }
}
$num_headers = count($header);
for($i = 0; $i < $num_headers; ++$i) {
    $pdf->Cell($w[$i], 4, $header[$i], 0, false, 'L', 1, '', 0, true, 'B', 'M');
}
$pdf->Ln();

//$pdf->Output('print.pdf', 'F');

$file = "kunjungan_rawat_jalan.pdf";
$pdf->Output($file, 'I');
?>