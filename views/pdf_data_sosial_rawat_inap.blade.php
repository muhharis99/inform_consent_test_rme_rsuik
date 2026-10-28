<?php
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 15, 5, 6, 'P');
$pdf->SetTitle('FM/RM/01 - '.$no_reg);
$pdf->SetSubject('Askep');
$pdf->SetKeywords('RSU Islam Klaten, Data Sosial');
$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300"></td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/16.3</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""><img height="67" width="70" src="'.IMG.'banner/rsui_k.png" alt=""></td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>DATA SOSIAL PASIEN <br />RAWAT INAP <br /></b></td>
        <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($ranap->registered)?$no_reg:'').'</td>
      </tr>
      <tr>
        <td>NAMA</td>
        <td>:</td><td>'.(!empty($ranap->registered)?$nama:'').'</td>
      </tr>
      <tr>
        <td>NIK</td>
        <td>:</td>
        <td>'.(!empty($ranap->registered)?$nik:'').'</td>
      </tr>
      <tr>
        <td>TGL LAHIR</td>
        <td>:</td><td>'.((!empty($ranap->registered) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)) : '').'</td>
      </tr>
      <tr>
        <td valign="top">ALAMAT</td>
        <td valign="top">:</td><td>'.(!empty($ranap->registered)?$alamat:' <br /> &nbsp; ').'</td>
      </tr>
      <tr>
        <td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td>
      </tr>
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 4</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2016</td></tr></tbody></table>
');

$pdf->SetFont('calibri', 13);
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #bebebe;
      line-height:20px;
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
  </style>
';

$html .='<table class="ln14" cellspacing="0" cellpadding="1" width="" style="">
<tbody>
    <tr>
      <td width="20" class=""> </td>
      <td colspan="2" class=""> </td>
    </tr> 
    <tr>
      <td class="bg-burem b"> A. </td>
      <td colspan="4" class="bg-burem b">IDENTITAS PASIEN</td>
    </tr>
    <tr class="">
      <td width="" class="ln5" colspan="4"> &nbsp; </td>
    </tr> 
    <tr>
      <td width="" > </td>
      <td width="200">Umur</td>
      <td width="10">:</td>
      <td>'.$ranap['umur'].' </td>
    </tr> 
    <tr>
      <td> </td>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $jenis_kel : '').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>No. Telepon/HP</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $telp:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Agama</td>
      <td>:</td><td>'.(!empty($ranap) ? $agama:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Status Perkawinan</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $kawin:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Pendidikan</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $didik:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Pekerjaan</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $kerja:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Jenis dan Asal Rujukan</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $rujuk:'').'</td>
      </tr> 
    <tr>
      <td> </td>
      <td>Jenis Kunjungan</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $kunjung:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Cara Pembayaran</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $asuransi:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Prosedur/Cara Masuk</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $asal:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Tanggal Masuk</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $str_tgl_masuk:'').'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Ruang</td>
      <td>:</td>
      <td>'.(!empty($ranap) ? $bangsal:'').'</td>
    </tr> 
    <tr>
      <td class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr>
      <td class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
    <tr>
      <td class="bg-burem b"> B. </td>
      <td colspan="4" class="bg-burem b">IDENTITAS PENANGGUNG JAWAB PASIEN MONDOK</td>
    </tr> 
    <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
    <tr>
      <td> </td>
      <td>Nama </td>
      <td>:</td>
      <td>'.$ranap['pjawab'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Umur </td>
      <td>:</td>
      <td>'.selisihymdhis($ranap['tgl_lahir_pjawab'], $tgl_masuk, 'umurtahun').'</td>
    </tr> 
    <tr>
      <td></td>
      <td>Alamat Lengkap</td>
      <td>:</td>
      <td>'.$ranap['almjawab'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>No. Telephon/HP </td>
      <td>:</td>
      <td>'.$ranap['no_telp_pjawab'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td>Hubungan dengan pasien </td>
      <td>:</td>
      <td>'.$ranap['hubjawab'].'</td>
    </tr> 
    <tr>
      <td class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr>
      <td class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
    <tr>
      <td class="bg-burem b"> C. </td>
      <td colspan="4" class="bg-burem b">IDENTITAS KELUARGA YANG DAPAT DIHUBUNGI SAAT EMERGENCY/PENERIMA INFORMASI</td>
    </tr> 
    </tbody>
    </table>
    <table>
    <tbody>
    <tr class="">
      <td width="" class="ln5" colspan="4"> &nbsp; </td>
    </tr>
    <tr>
      <td width="20"> </td>
      <td width="20">1. </td>
      <td width="200">Nama </td>
      <td width="10">:</td>
      <td>'.$ranap['nama_darurat_1'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Umur </td>
      <td>:</td>
      <td>'.$ranap['umur_darurat_1'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Alamat Lengkap </td>
      <td>:</td>
      <td>'.$ranap['alamat_darurat_1'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>No. Telephon/HP </td>
      <td>:</td>
      <td>'.$ranap['no_telp_darurat_1'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Hubungan dengan pasien </td>
      <td>:</td>
      <td>'.$ranap['hub_darurat_1'].'</td>
    </tr> 
    <tr>
      <td width="20" class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr>
      <td> </td>
      <td>2. </td>
      <td>Nama </td>
      <td>:</td>
      <td>'.$ranap['nama_darurat_2'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Umur </td>
      <td>:</td>
      <td>'.$ranap['umur_darurat_2'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Alamat Lengkap </td>
      <td>:</td>
      <td>'.$ranap['alamat_darurat_2'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>No. Telephon/HP </td>
      <td>:</td>
      <td>'.$ranap['no_telp_darurat_2'].'</td>
    </tr> 
    <tr>
      <td> </td>
      <td> </td>
      <td>Hubungan dengan pasien </td>
      <td>:</td>
      <td>'.$ranap['hub_darurat_2'].'</td>
    </tr> 
  <tbody>
  </table>';

$pdf->WriteHTML($html);

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