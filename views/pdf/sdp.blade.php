<?php
// date_default_timezone_set("Asia/Jakarta");
define('DOC_REVISI', 'Revisi : 1');
define('DOC_TERBIT', 'Tanggal Terbit : 20 Juni 2022');
define('DOC_NOMER', 'FORM/KU-PRPP/11'); 
define('DOC_TITLE', 'STATUS DEBITUR PASIEN/SDP <br />RAWAT INAP'); 
define('DOC_SUBJECT', 'Status Debitur Pasien Rawat Inap'); 
define('DOC_FILE', 'Status-Debitur-Pasien.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P'); //L,R,T,B
$pdf->SetDefaultBodyCSS('background', "url('".IMG."stamp/bookmark2.png') no-repeat 485 -110");
$pdf->SetDefaultBodyCSS('background-image-resize', 0);
$pdf->debug = true;
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
      line-height:20px;
    }
    .bg0 {
      background-color: #FFFFFF;
    }
    .bg1 {
      background-color: #ECECEC;
    }
    .bg2 {
      background-color: #BEBEBE;
    }
    .bg3 {
      background-color: #9F9FA0;
    }
    .bg4 {
      background-color: #F8B14F;
    }
    .bg5 {
      background-color: #FAD59E;
    }
    .bg-burem td {
      line-height:20px;
    }
    .b td {
        font-weight:bold;
    }
    .bg-burem1 {
      background-color: rgb(245, 245, 245);
      line-height:20px;
    }
    .bg-white {
      background-color: #ffffff;
    }
    table {
      width:100%;
      font-size:14px;
    }
    .txr {
      text-align:right;
    }
    .txl {
      text-align:left;
    }
    .txj {
      text-align:justify;
    }
    .txc {
      text-align:center;
    }
    td {
      text-align:left;
      vertical-align:top;
      padding:0 3px 0 3px;
    }
    .b {
      font-weight:bold;
    }
    .ln5 {
      line-height:5px;
    }
    .ln23 {
      line-height:23px;
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
    .lnc td {
      line-height:20px;
    }
  </style>
'; 
// $pdf->WriteHTML($html);

$html .= '
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; background-color:white;">
  <tbody>
    <tr>
      <td width="180">No. Telepon/HP </td><td width="10">:</td><td width="188">'.$telp.'</td><td width="130">Agama</td><td width="10">:</td><td>'.$agama.'</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td><td>:</td><td>'.$jenis_kel.'</td><td>Pekerjaan </td><td>: </td><td>'.$kerja.'</td>
    </tr>
    <tr>
      <td>Status Perkawinan</td><td>:</td><td>'.$kawin.'</td><td>Pendidikan</td><td>: </td><td>'.$didik.'</td>
    </tr>
    <tr>
      <td></td><td> </td><td> </td><td></td><td> </td><td></td>
    </tr>
    <tr>
      <td>Jenis Kunjungan</td><td>:</td><td>'.$kunjung.' </td><td>Jenis/Asal Rujukan</td><td>: </td><td>'.$rujuk.'</td>
    </tr>
    <tr>
      <td>Cara Masuk </td><td>:</td><td>'.$prosedur_cara_masuk.'</td><td>Cara Pembayaran</td><td>: </td><td>'.$asuransi.' '.((isset($ranap['kelas']) && $ranap['kelas'] != '') ? '('.$ranap['kelas'].')' : '').'</td>
    </tr>
    <tr>
      <td colspan="6" class="ln5">&nbsp; </td>
    </tr>
  </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr>
      <td width="180">Nama penanggung jawab</td><td width="10">:</td><td colspan="4">'.$ranap['pjawab'].'</td>
    </tr>
    <tr>
      <td>No Telp penanggung jawab</td><td>: </td><td colspan="4">'.$ranap['no_telp_pjawab'].'</td>
    </tr> 
    <tr>
      <td>Alamat penanggung jawab</td><td>:</td><td colspan="4">'.$ranap['almjawab'].'</td>
    </tr>
    <tr>
      <td colspan="6" class="ln5">&nbsp; </td>
    </tr>
  </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr>
      <td width="20" class="bg-burem b"> A. </td><td colspan="4" class="txj" class="bg-burem b">MASUK RS</td>
    </tr> 
    <tr>
      <td> </td><td width="160">Tanggal </td><td width="10">:</td><td colspan="2" class="txl">'.($ranap['tgl_ri']!=''?(tampiltanggal($ranap['tgl_ri'], 14)):' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; ').',  &nbsp; &nbsp;  Pukul '.$ranap['jam_ri'].'  </td>
    </tr> 
    <tr>
      <td> </td><td>Ruang/Kelas </td><td>:</td><td colspan="2" class="txl">'.$bangsal.' '.($ranap['no_bed']!=''?' /'.$ranap['no_bed']:'').'</td>
    </tr> 
    <tr>
      <td> </td><td>Dokter yang merawat </td><td>:</td><td colspan="2" class="txl">';
        $numberDokter=1;
        if (!empty($ranap['dokterArray'])){
          foreach ($ranap['dokterArray'] as $x) {
            $html.=$numberDokter.'. '.$x.'<br />';
            $numberDokter=$numberDokter+1;
          }
        }
      // if (!empty($ranap['nm_dr_ri2'])) {
      //   $html.='1. ';
      // }
      // $html.=$ranap['nm_dr_ri1']; 
      // if (!empty($ranap['nm_dr_ri2'])) {
      //   $html.='<br />2. '.$ranap['nm_dr_ri2'];
      // }
      $html.='</td>
    </tr> 
    <tr>
      <td colspan="5" class="ln5">&nbsp; </td>
    </tr>
  </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr>
      <td width="20" class="bg-burem b"> B. </td><td colspan="4" class="txj" class="bg-burem b">TRANSAKSI-TRANSAKSI</td>
    </tr> 
    <tr>
      <td> </td><td width="160">Tindakan Operasi </td><td width="10">:</td><td colspan="2" class="txl"> &nbsp; &nbsp; &nbsp;</td>
    </tr>
    <tr>
      <td> </td><td>Tindakan Persalinan</td><td>:</td><td colspan="2" class="txl" ></td>
    </tr> 
    <tr>
      <td> </td><td>Rontgen </td><td>:</td><td colspan="2" class="txl" > </td>
    </tr>
    <tr>
      <td> </td><td>- Foto RO </td><td>:</td><td colspan="2" class="txl" > </td>
    </tr>
    <tr>
      <td> </td><td>- USG </td><td>:</td><td colspan="2" class="txl" > </td>
    </tr>
    <tr>
      <td> </td><td>- CT Scan </td><td>:</td><td colspan="2" class="txl" > </td>
    </tr> 
    <tr>
      <td> </td><td>Hemodialisa </td><td>:</td><td colspan="2" class="txl" ></td>
    </tr>
    <tr>
      <td colspan="5" class="ln5">&nbsp; </td>
    </tr>
    <tr>
      <td colspan="5" class="ln5">&nbsp; </td>
    </tr>
  </tbody>
</table>';
$html.='
<br />
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; font-size:12px;">
  <tr class="">
    <td colspan="2" class="b">Catatan : </td>
  </tr>
  <tr class="">
    <td width="20" class="txr "> </td>
    <td class=""> 
      Lembar 1 untuk rawat inap
      <br />Lembar 2 untuk penata rekening
      <br />Dicetak : '.$waktu_cetak.' WIB
    </td>
  </tr>
  <tr>
    <td class=""></td>
    <td class=""></td>
</tr>
</table>'; 
$pdf->WriteHTML($html);
if ($halaman=="") {

  if (!empty($tgl_lahir)) {
    $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'');
    if (!empty($warning_sama)) {
      // if ($no_reg=='0620128') {
        $str_tgl_lahir = date("d-m-Y", strtotime($tgl_lahir));
        $str_tgl_lahir = '<table cellpadding="0" cellspacing="0" border="0" style="margin:0 -3px; padding-bottom:-2px; line-height:12px;"><tr><td width="76" style="background-color:#F7C815; border:1px solid #F7C000;">'.$str_tgl_lahir.'</td><td>'.($umur!=''?' ( '.$umur.' )':'').'</td></tr></table>';
      // }
    }
  }
  $pdf->SetHTMLHeader('
    <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
      <tbody>
        <tr>
          <td align="left" width="300">RSU ISLAM KLATEN</td>
          <td align="right" width="300" style="text-align:right;"> <b>FORM/RANAP/041</b></td>
          <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
        </tr>
      </tbody>
    </table>  
    <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px; font-size:14px;" width="100%">
      <tbody>
        <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
        <tr>
          <td class="txr" rowspan="5" width="65" bgcolor="" style=""> </td>
          <td class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:18px; line-height:18px; " ><b>LAMPIRAN SDP<br />PASIEN RAWAT INAP</b></td>
          <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($nama)?$no_reg:'').'</td>
        </tr>
        <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
        <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
        <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? $str_tgl_lahir : '').'</td></tr>
        <tr><td valign="top">ALAMAT <br />&nbsp; </td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
        <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
      </tbody>
    </table>
  ');
  $pdf->addPage();
  $pdf->SetHTMLFooter('
    <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi : 4</td><td align="right">'.DOC_TERBIT.'</td></tr></tbody></table>
  ');
  $html=''; 
  $html.='
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr>
        <td width="20" class="bg-burem b"> C. </td><td colspan="5" class="txj" class="bg-burem b">JASA VISIT DOKTER JAGA/DOKTER GIGI</td>
      </tr>
      <tr class="">
        <td></td>
        <td colspan="5" style="padding-right:1px;">
          <div style="font-size:2px;"><br />&nbsp; </div>   
          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" class="bg0">
            <tbody>
              <tr class="bg1">
                <td width="25" class="bdt bdr bdl bdb">
                  No. 
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  Tanggal 
                </td>
                <td width="" class="bdt bdr bdb txc">
                  Nama Dokter 
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  TTD
                </td>
              </tr>'; 
              
              for ($i=0; $i<5; $i++) {
              $html.='
              <tr class="lnc">
                <td class="bdl bdr bdb"> 
                  &nbsp; 
                </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
              </tr>'; 
              }
              $html.='
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="6" class="ln5">&nbsp; </td>
      </tr>
    </tbody>
  </table>'; 
  $html.='
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr>
        <td width="20" class="bg-burem b"> D. </td><td colspan="7" class="txj" class="bg-burem b">JASA DOKTER SPESIALIS</td>
      </tr>    
      <tr class="">
        <td> </td>
        <td colspan="7" style="padding-right:1px;">  
          <div style="font-size:2px;"><br />&nbsp; </div>              
          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" class="bg0">
            <tbody>
              <tr class="bg1">
                <td rowspan="2" width="25" class="bdt bdr bdl bdb">
                  <font style="font-size:5px;"> <br /></font>No. 
                </td>
                <td rowspan="2" width="80" class="bdt bdr bdb txc">
                  <font style="font-size:5px;"> <br /></font>Tanggal 
                </td>
                <td rowspan="2" width="" class="bdt bdr bdb txc">
                  <font style="font-size:5px;"> <br /></font>Nama Dokter 
                </td>
                <td colspan="4" class="bdt bdr bdb txc">
                  TTD
                </td>
              </tr>
              <tr class="bg1">
                <td width="80" class="bdr bdb txc">
                  Visite
                </td>
                <td width="80" class="bdr bdb txc">
                  Konsul
                </td>
                <td width="80" class="bdr bdb txc">
                  Raber
                </td>
                <td width="80" class="bdr bdb txc">
                  Ket
                </td>
              </tr>
              '; 
              $visit = (array) null; 
              if (!empty($visit)) {
                $no = 1; 
                foreach ($visit as $row_visit) {
                  $html .= '
                <tr>
                  <td class="bdl bdr bdb"> '.$no.' </td>
                  <td class="bdr bdb"> '.date("d-m-Y", strtotime($row_visit->tanggal)).' </td>
                  <td class="bdr bdb"> '.$row_visit->nama.' </td>
                  <td class="bdr bdb txc"> '.substr($row_visit->jam, 0, 5).'</td>
                  <td class="bdr bdb">  </td>
                  <td class="bdr bdb">  </td>
                  <td class="bdr bdb">  </td>
                </tr>'; 
                $no ++;
                }
              } else {
                for ($i=0; $i<15; $i++) {
                  $html .= '
                  <tr class="lnc">
                    <td class="bdl bdr bdb"> 
                      &nbsp;
                    </td>
                    <td class="bdr bdb">  </td>
                    <td class="bdr bdb">  </td>
                    <td class="bdr bdb">  </td>
                    <td class="bdr bdb">  </td>
                    <td class="bdr bdb">  </td>
                    <td class="bdr bdb">  </td>
                  </tr>
                  ';  
                }
              } 
              $html .= '
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="8" class="ln5">&nbsp; </td>
      </tr>
    </tbody>
  </table>';
  $html.='

  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr>
        <td width="20" class="bg-burem b"> E. </td><td colspan="5" class="txj" class="bg-burem b">JASA ASUHAN KEPERAWATAN</td>
      </tr>
      <tr class="">
        <td></td>
        <td colspan="5" style="padding-right:1px;">
          <div style="font-size:2px;"><br />&nbsp; </div>   
          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" class="bg0">
            <tbody>
              <tr class="bg1">
                <td width="25" class="bdt bdr bdl bdb txc">
                  No. 
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  Tanggal 
                </td>
                <td width="266" class="bdt bdr bdb txc">
                  Nama Perawat 
                </td>
                <td class="bdt bdr bdb txc">
                  Nama Tindakan
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  TTD
                </td>
              </tr>'; 
              for ($i=0; $i<5; $i++) {
              $html.='
              <tr class="lnc">
                <td class="bdl bdr bdb"> 
                  &nbsp; 
                </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
              </tr>'; 
              }
              $html.='
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="6" class="ln5">&nbsp; </td>
      </tr>
    </tbody>
  </table>

  ';  
  $html.='
  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr>
        <td width="20" class="bg-burem b"> F. </td><td colspan="5" class="txj" class="bg-burem b">JASA TINDAKAN MEDIS DOKTER/EKG</td>
      </tr>
      <tr class="">
        <td></td>
        <td colspan="5" style="padding-right:1px;">
          <div style="font-size:2px;"><br />&nbsp; </div>   
          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" class="bg0">
            <tbody>
              <tr class="bg1">
                <td width="25" class="bdt bdr bdl bdb txc">
                  No. 
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  Tanggal 
                </td>
                <td width="266" class="bdt bdr bdb txc">
                  Nama Dokter 
                </td>
                <td class="bdt bdr bdb txc">
                  Nama Tindakan
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  TTD
                </td>
              </tr>
              '; 
                for ($i=0; $i<3; $i++) {
                $html .= '
                <tr class="lnc">
                  <td class="bdl bdr bdb"> 
                    &nbsp; 
                  </td>
                  <td class="bdr bdb">  </td>
                  <td class="bdr bdb">  </td>
                  <td class="bdr bdb">  </td>
                  <td class="bdr bdb">  </td>
                </tr>'; 
                }
              $html .= '
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="6" class="ln5">&nbsp; </td>
      </tr>
    </tbody>
  </table>'; 
  $html.='

  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr>
        <td width="20" class="bg-burem b"> G. </td><td colspan="5" class="txj" class="bg-burem b">PEMAKAIAN OKSIGEN</td>
      </tr>
      <tr class="">
        <td></td>
        <td colspan="5" style="padding-right:1px;">
          <div style="font-size:2px;"><br />&nbsp; </div>   
          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" class="bg0">
            <tbody>
              <tr class="bg1">
                <td width="25" class="bdt bdr bdl bdb txc">
                  No. 
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  Tanggal 
                </td>
                <td width="266" class="bdt bdr bdb txc">
                  Jam Pasang & Jam Selesai
                </td>
                <td class="bdt bdr bdb txc">
                  Jumlah (Jam)
                </td>
                <td width="80" class="bdt bdr bdb txc">
                  TTD
                </td>
              </tr>'; 
              for ($i=0; $i<5; $i++) {
              $html.='
              <tr class="lnc">
                <td class="bdl bdr bdb"> 
                  &nbsp; 
                </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
                <td class="bdr bdb">  </td>
              </tr>'; 
              }
              $html.='
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="6" class="ln5">&nbsp; </td>
      </tr>
    </tbody>
  </table>
    ';
  $pdf->WriteHTML($html);
}


$file = DOC_FILE;
if($pdf_type == 'F') {
  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');
  
  if($ip == '::1') $ip = '127.0.0.1';
  if($ipclient != '') { $ip = $ipclient; }

  $dir = FCPATH."assets/rme/pdf/$ip/";
  if(file_exists($dir)){
  }else{
      mkdir($dir,0777);
  }
  $file = $dir.DOC_FILE;
  $pdf->Output($file, $pdf_type);
  
  if (!empty($lp_print)) {
    if ($printer != "") {
      $cmd = "lp $file -d $printer";
      shell_exec($cmd);
    }
    $data=array(
      "status" => true, 
      "pdf" => $file, 
      "printer" => $printer
    );
    echo json_encode($data); 
  }  else {
    $data=array(
      "status" => true, 
      "pdf" => $file
    );
    echo json_encode($data); 
  }
} else {
  $pdf->Output($file, $pdf_type);
}
?>