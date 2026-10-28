<?php
// $no_reg = '0000000'; 
// $nama = 'MR X'; 
// $registered = date("Y-m-d H:i:s");
// $alamat = 'KRESAN 01/06 WARU BAKI, SUKOHARJO'; 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 11, 6, 6, 12, 12, 60, 'P');
$pdf->SetTitle('FM/RM/20.1 - '.$no_reg);
$pdf->SetSubject('Formulir Pendaftaran Pasien Baru');
$pdf->SetKeywords('RS Islam Klaten, Formulir Pendaftaran Pasien Baru');
$pdf->SetHTMLHeader('

');
$pdf->SetHTMLFooter(' ');
$pdf->SetFont('calibri', 13);
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
      page-break-inside: avoid;
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
    .ln1 {
      line-height:1px;
    }
    .ln2 {
      line-height:2px;
    }
    .ln3 {
      line-height:9px;
    }
    .ln4 {
      line-height:4px;
    }
    .ln5 {
      line-height:5px;
    }
    .ln6 {
      line-height:6px;
    }
    .ln7 {
      line-height:7px;
    }
    .ln8 {
      line-height:8px;
    }
    .ln9 {
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
    .ln15 {
      line-height:15px;
    }
    .ln16 {
      line-height:16px;
    }
    .ln17 {
      line-height:17px;
    }
    .ln18 {
      line-height:18px;
      font-size:12px;
    }
    .ln19 {
      line-height:19px;
      font-size:14px;
    }
    .ln20 {
      line-height:20px;
      font-size:14px;
    }
    .ln21 {
      line-height:21px;
    }
    .ln22 {
      line-height:22px;
    }
    .ln23 {
      line-height:23px;
    }
    .ln24 {
      line-height:24px;
    }
    .ln25 {
      line-height:25px;
    }
    .ln26 {
      line-height:26px;
    }
    .ln27 {
      line-height:27px;
    }
    .ln28 {
      line-height:28px;
    }
    .ln29 {
      line-height:29px;
    }
    .ln30 {
      line-height:30px;
    }
    .ln33 {
      line-height:33px;
    }
    .ln50 {
      line-height:50px;
    }
    .title td {
      line-height:0px;
      font-weight:bold;
    }
    .bdl {
       border-left: 0.5px solid #505050;
    }
    .bdr {
       border-right: 0.5px solid #505050;
    }
    .bdt {
       border-top: 0.5px solid #505050;
    }
    .bdb {
       border-bottom: 0.5px solid #505050;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .size-custom {
      font-size :11px;
    }
    .size-custom2 {
      font-size :16px;
    }
  </style>
'; 
// $html .='<br>';
// $print_tr = '';
$jml_row_spasi = 20;
for($i=0; $i<$jml_row_spasi; $i++) {
  $spasi .= '&nbsp;'; 
}
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>FM/RM/20.1</b></td>
        <td align="right"  style="">Hal 1/1 </td>
      </tr>
    </tbody>
  </table>
  <table border="0" class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <th class="txc ln18 bg-burem">FORMULIR PENDAFTARAN PASIEN BARU</th>
    </tr>
  </table>
';

$html .= '
<table border="0" class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
   <tr class="">
      <td class="ln18">Poli yang dituju</td>
      <td class="ln18">:</td>
      <td class="ln18">__________________________</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18" align="right">Nomor Rekam Medis</td>
      <td class="ln18">:</td>
      <td class="ln18">________________________________</td>
    </tr>
    <tr class="">
      <td class="ln18">Tanggal pendaftaran</td>
      <td class="ln18">:</td>
      <td class="ln18">__________________________</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
    </tr>
</table>
  ';
$html .= '<br>
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
      <th class="txc ln18 bg-burem">IDENTITAS PASIEN</th>
    </tr>
</table>
';
$html .= '  
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  
    <tr>
      <td class="ln18" width="160px">Nama</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" colspan="3">______________________________________</td>
    </tr>
    <tr>
      <td class="ln18">NIK</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" colspan="3">______________________________________</td>
    </tr>
    <tr>
      <td class="ln18" width="107px">Tempat, tanggal lahir</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">______ , ___ / ___ / _____</td>
      <td class="ln18">Jenis kelmin :</td>
      <td class="ln18">laki-laki / perempuan *)</td>
    </tr>
    <tr>
      <td class="ln18">Pekerjaan</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">______________________________________</td>
      <td class="ln18">Status :</td>
      <td class="ln18">nikah / belum nikah *)</td>
    </tr>
</table>
';
$html .= '
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln18" width="170px">Pendidikan **)</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tidak sekolah</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Belum sekolah</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> SD</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> SMP</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> SMA</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Diploma</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Sarjana</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Pascasarjana</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">Bahasa **)</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Indonesia</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Jawa</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Inggris</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lainnya: _________</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">Agama **)</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Islam</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Kristen</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Katolik</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Hindu</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Budha</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lainnya: _________</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">Etnis</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Jawa</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Sunda</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Madura</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Tionghoa</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lainnya: _________</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
      <td class="ln18">&nbsp;</td>
    </tr>
</table>
';
$html .= ' 
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln18" width="160px">Alamat lengkap</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="100px">Jl.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px" align="left">__________________</td>
      <td class="ln18" width="100px">'.$spasi.'Dk</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
    <tr>
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18" width="60px">RT/RW</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px">__________________</td>
      <td class="ln18" width="60px">'.$spasi.'Kel.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
    <tr>
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18" width="60px">Kec.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px">__________________</td>
      <td class="ln18" width="60px">'.$spasi.'Kab.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln18" width="159px">No. Telp/HP</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" colspan="3">_________</td>
    </tr>
    <tr class="">
      <td class="ln18" width="107px">Nama ibu kandung</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">_________________________</td>
      <td class="ln18" width="100px">Nama Ayah :</td>
      <td class="ln18">_________________________</td>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="">
      <td class="ln18" width="169px">Akan menggunakan hak sebagai pasien **)</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="90px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Umum</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> BPJS PBI/(Jamkesmas)</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> BPJS Mandiri</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> BPJS non mandiri<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(PNS, POLRI, swasta)</td>
    </tr>
    <tr class="">
      <td class="ln18" width="127px"></td>
      <td class="ln18" width="2px"></td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Asuransi lain</td>
      <td class="ln18" width="145px"></td>
      <td class="ln18" width="145px"></td>
      <td class="ln18" width="145px"><br></td>
    </tr>
</table><br>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
      <th class="txc ln18 bg-burem">IDENTITAS PENGANTAR</th>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  
    <tr class="">
      <td class="ln18" width="160px">Nama</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" colspan="3">______________________________________</td>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln18" width="160px">Alamat lengkap</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="100px">Jl.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px" align="left">__________________</td>
      <td class="ln18" width="100px">'.$spasi.'Dk</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
    <tr>
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18" width="60px">RT/RW</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px">__________________</td>
      <td class="ln18" width="60px">'.$spasi.'Kel.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
    <tr>
      <td class="ln18" width="107px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18" width="60px">Kec.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="50px">__________________</td>
      <td class="ln18" width="60px">'.$spasi.'Kab.</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18">__________________</td>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  
    <tr class="">
      <td class="ln18" width="160px">No. Telp/HP</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" colspan="3">_________________________</td>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr class="">
      <td class="ln18" width="170px">Hubungan dengan pasien **)</td>
      <td class="ln18" width="2px">:</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Diri sendiri</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Suami</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Istri</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Anak</td>
    </tr>
    <tr class="">
      <td class="ln18" width="127px">&nbsp;</td>
      <td class="ln18" width="2px">&nbsp;</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Orang tua</td>
      <td class="ln18" width="145px"><img src="'.IMG.'banner/'.(($pendaftaran->psn == '1')?'square14_check':'square14_uncheck').'.png" style="margin-top:2px;" width="12" height=""/> Lainnya: _________</td>
      <td class="ln18" width="145px">&nbsp;</td>
      <td class="ln18" width="145px">&nbsp;</td>
    </tr>
</table><br>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
      <th class="txc ln18 bg-burem">GENERAL <i>CONSENT</i> PASIEN RAWAT JALAN</th>
    </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tr>
      <td class="ln18" width="2px">1</td>
      <td class="ln18">Setuju dan memberi Izin kepada dokter yang bersangkutan untuk merawat, mengobati sesuai dengan prosedur diagnostik yang berlaku di Rumah Sakit Islam Klaten.</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">2</td>
      <td class="ln18">Setuju dengan tindakan-tindakan yang lazim dilakukan di Rumah Sakit Islam Klaten, seperti pemasangan Infus, selang lambung/NGT, selang kateter, suntikan langsung dan medikasi.</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">3</td>
      <td class="ln18">Sanggup/bersedia membayar seluruh biaya perawatan, pengobatan dan biaya administrasi.</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">4</td>
      <td class="ln18">Khusus pasien BPJS, harus memenuhi persyaratan wajib sebagai pasien BPJS (KTP/KK/Kartu BPJS) pada saat mendatangani persetujuan ini.</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">5</td>
      <td class="ln18">Memberi kuasa kepada dokter/pihak Rumah Sakit Islam Klaten untuk memberikan keterangan secukupnya yang diperlukan oleh penanggung biaya perawatan saya/pasien tersebut diatas.</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">6</td>
      <td class="ln18">Saya akan menjaga barang-barang milik saya dan secara pribadi bertanggung jawab atas semua barang-barang berharga yang saya miliki</td>
    </tr>
    <tr>
      <td class="ln18" width="2px">7</td>
      <td class="ln18">Saya menyatakan bahwa saya telah menerima informasi dan mengetahui tentang adanya tata cara mengajukan keluhan dengan cara SMS ke No. 0815 673 3270, Email : informasi@rsislamklaten.co.id atau bisa menulis langsung dan diserahkan kepada petugas RS.</td>
    </tr>
    <tr>
    <td class="ln18" width="2px">8</td>
    <td class="ln18">Saya memberi wewenang kepada RS untuk mengirimkan Rekam Medis ke <b>Kementrian Kesehatan Melalui Platform Satu Sehat</b></td>
  </tr>
    </table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td class="ln18" width="50%"><br>Data sudah diverifikasi oleh :</td>
    <td class="ln18" align="center" width="50%"><br>Klaten, ____ /____ / 20 ____  Jam: ____:____ WIB</td>
  </tr>
</table>
';
$html .='
<table class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td class="ln18 txc" width="50%">Petugas<br><br><br>(...............................................)<br>Tanda tangan dan nama terang</td>
    <td class="ln18 txc" width="50%">Yang menyatakan,<br><br><br>(...............................................)<br>Tanda tangan dan nama terang</td>
  </tr>
</table>
';
$html .='
<table border="0" class="size-custom" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr>
    <td class="ln18" width="50%">Keterangan :*) :coret yang tidak perlu</td>
    <td class="ln18" width="50%">'.$spasi.'**): berikan tanda centang (V) sesuai pilihan</td>
  </tr>
</table>
';
$html .='<table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 8</td><td width="" align="right">Tanggal Terbit : 20 Juli 2023</td></tr></tbody></table>';
$pdf->WriteHTML($html);


$file = "Pendaftaran_pasien_baru.pdf";
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
  $file = $dir."soap_inap_resume_20220618.pdf";
}
$pdf->Output($file, $pdf_type);
?>