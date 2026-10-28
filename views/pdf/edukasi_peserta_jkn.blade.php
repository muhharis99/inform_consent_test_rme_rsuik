<?php
// echo phpinfo(); die();
if ($no_reg=='0000000') {
  $no_reg = $nama = $nik = $tgl_lahir = $umur = $alamat = "";
}
define('DOC_REVISI', 'Revisi : 0');
define('DOC_TERBIT', 'Tanggal terbit : 01 Agustus 2024');
define('DOC_NOMER', 'Form/KU-PRPP/14'); 
define('DOC_TITLE', 'LEMBAR EDUKASI<br />PASIEN ASURANSI BPJS'); 
define('DOC_SUBJECT', 'Edukasi Pasien BPJS'); 
define('DOC_FILE', 'Edukasi-BPJS.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
// $pdf->SetWatermarkImage(IMG.'stamp/bookmark2.png', 1, array(0, 0));
// $pdf->Image(IMG.'stamp/bookmark2.png', 5, 6, 210, 28.5, 'png', '', true, true);
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject(DOC_SUBJECT);
$pdf->SetKeywords('RS Islam Klaten, '.DOC_SUBJECT);
$pdf->SetDefaultBodyCSS('background', "url('".IMG."stamp/bookmark2.png') no-repeat 485 -110");
$pdf->SetDefaultBodyCSS('background-image-resize', 0);
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
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
  </style>
'; 
$html .= '
<br />
<table cellspacing="0" cellpadding="0" width="100%" style="" >
  <tbody>
    <tr>
      <td colspan="4" class="txj"> <i>*Harap dibaca dengan saksama dan dipahami, sebelum diceklis serta ditandatangani.</i> <br /> </td>
    </tr>
       <tr>
      <td colspan="4" class="txj">Menyatakan bahwa saya sebagai pasien atau / *Istri / *Suami/ *Orangtua / *Anak / *Wali dari pasien:</td>
    </tr>
    <tr>
    <td> </br></td>
    <td>Nama </td>
    <td width="30">:</td>
    <td>'.(!empty($akad)?$nama:'__________________________________________').'</td>
  </tr>
    <tr> 
      <td> </td>
      <td>No.JKN-KIS/NIK </td>
      <td>:</td>
      <td>'.(!empty($akad)?$nik:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Alamat </td>
      <td>:</td>
      <td>'.(!empty($akad)?$alamat:'__________________________________________').'</td>
    </tr>
    <tr>
    <td><br></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
    <tr><td colspan="4" class="txj">Telah diberikan <b>edukasi/informasi</b> dari petugas rumah sakit terkait <b>pengurusan/penjaminan</b> BPJS
    Kesehatan terhadap pelayanan yang akan didapatkan selama berada di rumah sakit dan diberikan kesempatan
    untuk bertanya atau berdiskusi, serta diberikan waktu selambat-lambatnya <b>3x24 Jam hari kerja</b> sejak yang
    bersangkutan (pasien) dirawat atau sebelum pasien pulang/meninggal/dirujuk (bila pasien dirawat kurang dari
    3 hari). Sehingga saya <b>memahami dan mengerti</b> bahwa:</td></tr>   
    <tr>
<td><br></td>
<td></td>
<td></td>
<td></td>
</tr>
  </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;" >
  <tbody>
  <tr><td colspan ="4" class="txl"><li>
  Penjaminan tidak dapat berubah di tengah perawatan</li>
  <li>Tidak adanya iur biaya apabila sesuai indikasi medis menggunakan Jaminan BPJS Kesehatan</li>
  <li>Telah mendapatkan edukasi/informasi terkait pulang paksa/ APS</li>
  <li>Mendapatkan edukasi/informasi dalam keadaan sehat, sadar, tidak panik</li><br/><br/></td>
  <td colspan ="0" class="txc"><ul><img src="' . IMG . 'banner/square14_check' . '.png" style="margin-top:2px;" width="12" height=""/></ul>
  <ul><img src="' . IMG . 'banner/square14_check'  . '.png" style="margin-top:2px;" width="12" height=""/></ul>
  <ul><img src="' . IMG . 'banner/square14_check' . '.png" style="margin-top:2px;" width="12" height=""/></ul>
  <ul><img src="' . IMG . 'banner/square14_check' . '.png" style="margin-top:2px;" width="12" height=""/></ul>
  </td>
  <td></td>
  </tr>
  <tr>
  <td colspan="4" class="txj">Sebagaimana yang disampaikan oleh petugas rumah sakit:</td>
</tr>
<tr>
<td> </td>
<td>Nama </td>
<td width="30">:</td>
<td>'.(!empty($akad)?$nama_petugas :'__________________________________________').'</td>
</tr>
<tr> 
  <td> </td>
  <td>Jabatan </td>
  <td>:</td>
  <td>Petugas Pendaftaran </td>
</tr>
<tr> 
  <td> </td>
  <td>Tanggal/Hari </td>
  <td>:</td>
  <td>'.(!empty($tgl_masuk)?(tampiltanggal($tgl_masuk)):'__________________________________________').'</td>
</tr>
<tr>
  <td> </td>
  <td>Tempat Edukasi </td>
  <td>:</td>
  <td>Pendaftaran RSU ISLAM KLATEN</td>
</tr>
<tr><td colspan="4" class="txj"><br/>
Dengan menandatangani lembar edukasi ini, maka dinyatakan bahwa petugas rumah sakit telah memberikan
edukasi/ informasi dan pasien/ peserta telah mendapatkan edukasi/ informasi dengan jelas, sehingga
penjaminan tidak dapat <b>berubah di tengah perawatan</b> dan memahami ketentuan pulang paksa.
</td>
</tr>
<tr>
<td><br></td>
<td></td>
<td></td>
<td></td>
</tr>
  </tbody>
</table>
'; 
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%" >
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3" class="txr" >Klaten, '.(!empty($tgl_masuk)?(tampiltanggal($tgl_masuk)):'_______________________________').' </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url(\''.$ttd_pasien->ttd_pasien.'\'); background-image-resize:2;background-repeat:no-repeat; background-size:30px; background-position:center;">
            Pasien/Anggota Keluarga
                <br />
            (Yang Menerima Edukasi)
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_kedua_nama!=''?$akad->pihak_kedua_nama:'_____________________________'):'_____________________________').'
            </td>
            <td width=""></td>
            <td width="300" class="txc" style="background-image:url(\''.(!empty($akad->pihak_pertama_nik)?IMG.'ttd/'.$akad->pihak_pertama_nik.'.jpg':'').'\'); background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
            Petugas Rumah Sakit
                <br />
            (Pemberi Edukasi/Informasi)
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_pertama_nama!=''?$akad->pihak_pertama_nama:'_____________________________'):'_____________________________').'
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
            </tbody>
  </table>
  ';
$pdf->WriteHTML($html);

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