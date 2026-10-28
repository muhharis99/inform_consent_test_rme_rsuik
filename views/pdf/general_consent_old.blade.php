<?php
// echo phpinfo(); die();
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

define('DOC_REVISI', '4');
define('DOC_TERBIT', '1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/16.3'); 
define('DOC_FILE', 'General-Consent.pdf'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4S', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
$pdf->SetTitle(DOC_NOMER.' - '.$no_reg);
$pdf->SetSubject('General Consent');
$pdf->SetKeywords('RSU Islam Klaten, General Consent');

$pdf->SetHTMLHeader('
  <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;" width="100%">
    <tbody>
      <tr>
        <td align="left" width="300">RSU ISLAM KLATEN</td>
        <td align="right" width="300" style="text-align:right;"> <b>'.DOC_NOMER.'</b></td>
        <td align="right"  style="">Hal {PAGENO}/ {nbpg}</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="line-height:12px;" width="100%">
    <tbody>
      <tr><td colspan="6" style="line-height:5px;"> &nbsp; </td></tr>
      <tr>
        <td class="txr" rowspan="5" width="75" bgcolor="" style=""> </td>
        <td width="" class="txc" rowspan="5" style="text-align:center; vertical-align:middle; font-size:16px; line-height:18px; " ><b>PERSETUJUAN UMUM <br />( GENERAL CONSENT ) <br /></b></td>
        <td class="" rowspan="5" width="5"></td><td width="70">NO.RM</td><td width="10">:</td><td width="250">'.(!empty($no_reg)?$no_reg:'').'</td>
      </tr>
      <tr><td>NAMA</td><td>:</td><td>'.(!empty($nama)?$nama:'').'</td></tr>
      <tr><td>NIK</td><td>:</td><td>'.(!empty($nik)?$nik:'').'</td></tr>
      <tr><td>TGL LAHIR</td><td>:</td><td>'.((!empty($tgl_lahir) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)).($umur!=''?' ( '.$umur.' )':'') : '').'</td></tr>
      <tr><td valign="top">ALAMAT</td><td valign="top">:</td><td>'.(!empty($alamat)?$alamat:'<br /> &nbsp; ').'</td></tr>
      <tr><td colspan="6" style="line-height:3px; border-bottom:1px solid black;"> &nbsp; </td></tr>
    </tbody>
  </table>
');
$pdf->SetHTMLFooter('
  <table style="font-size:12px;" width="100%"><tbody><tr><td width="350">Revisi: 4</td><td width="" align="right">Tanggal Terbit : 1 Agustus 2022</td></tr></tbody></table>
');

$pdf->SetFont('calibri', 13);
$pdf->shrink_tables_to_fit = 0;
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
  </style>
'; 
$html .= '
<br />
<table class="" width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:white;" >
<tbody>
  <tr>
    <td colspan="3" class="">Yang bertanda tangan dibawah ini : </td>
  </tr> 
  <tr>
    <td width="110">Nama </td>
    <td width="10">:</td> 
    <td>'.((!empty($ranap)) ? $ranap['pjawab'].' &nbsp; ('.change_jkel($ranap['jenis_kel_pjawab']).')' : '').'</td>
  </tr> 
  <tr>
    <td width="110">Tanggal Lahir </td>
    <td width="10">:</td>
    <td>'.tampiltanggal($ranap['tgl_lahir_pjawab']).'</td>
  </tr> 
  <tr>
    <td width="110">Alamat </td>
    <td width="10">:</td>
    <td width="553" >'.$ranap['almjawab'].'</td>
  </tr> 
  <tr>
    <td colspan="3">Bertindak sebagai &nbsp;&nbsp;:&nbsp;&nbsp;'.((string) $ranap['hubjawab'] != ""?$ranap['hubjawab']:'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ').'  dari pasien berikut : </td>
  </tr> 
  <tr>
    <td >No RM </td>
    <td>:</td>
    <td>'.(!empty($ranap->registered)?$no_reg:'').'</td>
  </tr> 
  <tr>
    <td >Nama </td>
    <td>:</td>
    <td>'.(!empty($ranap->registered)?$nama:'').'<td>
  </tr> 
  <tr>
    <td >Tanggal Lahir </td>
    <td>:</td>
    <td>'.((!empty($ranap->registered) && $tgl_lahir != '') ? date("d-m-Y", strtotime($tgl_lahir)) : '').'</td>
  </tr> 
  <tr>
    <td >Alamat </td>
    <td>:</td>
    <td>'.(!empty($ranap->registered)?$alamat:' <br /> &nbsp; ').'</td>
  </tr> 
  <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
</tbody>
</table> 
<table class="" cellspacing="0" cellpadding="1" width="" style="">
  <tbody>
    <tr>
      <td width="20" class=""> </td>
      <td colspan="4" class=""> </td>
    </tr> 
    <tr>
      <td class="bg-burem b"> A. </td>
      <td colspan="6" class="txj" class="bg-burem b">PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</td>
    </tr> 
    <tr>
      <td> </td>
      <td width="20">1.</td>
      <td colspan="6" class="txj">Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis. </td>
    </tr>
  <tr>
    <td> </td>
    <td>2.</td>
    <td colspan="6" class="txj" >Saya mengizinkan dokter dan profesi kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberi pengobatan medis, seperti yagn diperlukan dalam penilaian profesionalisme mereka. Prosedur diagnostik dan perawatan medis termasuk tetapi tidak terbatas pada : elektrokardiograf, x-ray, test darah, terapi fisik, pemberian obat, pemasangan infus, selang lambung/NGT, kateter urin, suntikan langsung dan medikasi.
    </td>
  </tr> 
  <tr>
    <td> </td>
    <td>3.</td>
    <td colspan="6" class="txj">Saya sadar bahwa praktek kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada pasien. </td>
  </tr> 
  <tr>
    <td></td>
    <td>4.</td>
    <td colspan="6" class="txj">Saya mengerti dan memahami bahwa : </td>
  </tr> 
  <tr>
   <td></td>
   <td></td>
      <td width="20">a. </td>
      <td width="653" class="txj">Pasien memiliki hak untuk mendapatkan penjelasan tentang kondisi klinis, rencana pengobatan/tindakan.</td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td>b. </td>
    <td class="txj">Pasien memiliki hak untuk mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat. </td>
  </tr> 
  <tr>
    <td></td>
    <td> </td>
    <td>c. </td>
    <td class="txj">Pasien memiliki hak untuk persetujuan atau menolak persetujuan untuk setiap prosedur/terapi. </td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td>d. </td>
  <td class="txj">Banyak dokter pada staf medis rumah sakit yang bukan karyawan tetapi staf tamu yang telah diberikan hak untuk menggunakan fasilitas untuk perawatan dan pengobatan pasien mereka. </td>
  </tr>   
  <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
  <tr>
    <td class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr>
    <td class="bg-burem b"> B. </td>
    <td colspan="6" class="txj" class="bg-burem b">PERLINDUNGAN ATAS HAK MILIK</td>
  </tr>   
  <tr>
    <td> </td>
    <td>1.</td>
    <td colspan="6" class="txj">Saya telah memahami bahwa rumah sakit tidak bertanggung jawab atas semua kehilangan barang-barang milik pasien dan kami bertanggungjawab atas barang-barang berharga yang kami miliki termasuk namun tidak terbatas pada uang, perhiasan, buku cek, kartu kredit, handphone atau barang lainnya. Dan apabila saya membutuhkan saya dapat menitipkan barang-barang saya tersebut kepada rumah sakit. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>2.</td>
    <td colspan="6" class="txj">Saya juga mengerti bahwa saya harus memberitahu/menitipkan pada RS jika pasien memiliki gigi palsu, kaca mata, lensa kontak prosthetics atau barang lainnya yang saya butuhkan untuk diamankan. </td>
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
    <td colspan="6" class="txj" class="bg-burem b">PENGAJUAN KELUHAN</td>
  </tr> 
  <tr>
    <td class="b"></td>
    <td colspan="6" class="txj" class="">Saya menyatakan bahwa saya telah menerima informasi tentang adanya tata cara mengajukan keluhan dengan cara SMS ke No. 0815 673 3270, Email : informasi@rsuislamklaten.co.id atau bisa menulis langsung dan diserahkan kepada petugas RS. Saya setuju untuk mengikuti tatacara mengajukan keluhan sesuai prosedur yang ada</td>
  </tr> 
  <tr>
    <td width="20" class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr> 
  <tr>
    <td class="bg-burem b"> D. </td>
    <td colspan="6" class="txj" class="bg-burem b">PERLINDUNGAN ATAS PRIVASI PASIEN</td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20">1.</td>
    <td colspan="3" class="txj" width="633">Saya memberi kuasa kepada RSU Islam Klaten untuk menjaga privasi dan kerahasiaan penyakit diri saya sendiri/suami/istri/anak/keluarga *) saya selama dalam perawatan. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>2.</td>
    <td colspan="3" class="txj" width="633">Saya membutuhkan/tidak membutuhkan *) privasi khusus kepada RS untuk tidak memberi akses bagi pada orang bernama: </td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20"> </td>
    <td width="20">a. </td>
    <td width="613">___________________________________</td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td>b. </td>
    <td>___________________________________</td>
    </tr> 
  <tr>
    <td width="20" class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
  <tr>
    <td class="bg-burem b"> E. </td>
    <td colspan="6" class="txj" class="bg-burem b">PERSETUJUAN PELEPASAN INFORMASI</td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20">1.</td>
    <td colspan="6" class="txj">Saya memahami Rumah Sakit Islam akan menjamin kerahasiaan informasi mengenai pasien termasuk diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan digunakan utnuk perawatan medis. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>2.</td>
    <td colspan="6" class="txj">Saya memberi wewenang kepada RS untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan bila diperlukan untuk memproses klaim asuransi/BPJS/Perusahaan dan/atau lembaga pemerintahan. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>3.</td>
    <td colspan="6" class="txj">Saya memberi wewenang kepada RS untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan pasien kepada anggota keluarga saya, yaitu : </td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20"> </td>
    <td width="20">a. </td>
    <td colspan="3" width="613">'.((string) $ranap['nama_darurat_1'] != ""?$ranap['nama_darurat_1']:'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ').' hubungan dengan pasien : '.$ranap['hub_darurat_1'].'</td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td>b.</td><td colspan="3">'.((string) $ranap['nama_darurat_2'] != ""?$ranap['nama_darurat_2']:'<u>&nbsp; - &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u> ').' hubungan dengan pasien : '.((string) $ranap['hub_darurat_2'] != ""?$ranap['hub_darurat_2']:'<u> &nbsp; - &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </u> ').'</td>
  </tr> 
  <tr>
    <td width="20" class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr class="">
  <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
  <tr>
    <td class="bg-burem b"> F. </td>
    <td colspan="6" class="txj" class="bg-burem b">INFORMASI TENTANG HAK DAN TANGGUNG JAWAB PASIEN</td>
  </tr> 
  <tr>
    <td> </td>
    <td>1.</td>
    <td colspan="6" class="txj">Pasien memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit pasien, dan dalam hal perawatan medis dan rencana pengobatan. </td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20">2.</td>
    <td colspan="6" class="txj">Saya telah mendapat informasi tentang Hak dan Tanggung Jawab Pasien di RSU Islam Klaten melalui <i>leaflet</i>, <i>banner</i> dan penjelasan yang disampaikan oleh petugas. </td>
  </tr> 
  <tr>
    <td width="20" class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr class="">
  <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
  <tr>
    <td width="20" class="bg-burem b"> G. </td>
    <td colspan="6" class="txj" class="bg-burem b">INFORMASI BIAYA</td>
    </tr> 
  <tr>
    <td> </td>
    <td colspan="6" class="txj">Saya memahami tentang informasi biaya pengobatan atau biaya tindakan yang dijelaskan oleh petugas RS. </td>
  </tr> 
  <tr>
    <td width="20" class=""> </td>
    <td colspan="4" class=""> </td>
  </tr> 
  <tr class="">
  <td width="" class="ln5" colspan="4"> &nbsp; </td>
  </tr>
  <tr>
    <td width="20" class="bg-burem b"> H. </td>
    <td colspan="6" class="txj" class="bg-burem b">INFORMASI RAWAT INAP</td>
  </tr> 
  <tr>
    <td> </td>
    <td>1.</td>
    <td colspan="6" class="txj">Saya telah mendapatkan informasi tentang pelayanan yang akan dilakukan dan hasil pelayanan yang diharapkan. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>2.</td>
    <td colspan="6" class="txj">Saya akan menjalani perawatan di rawat inap Rumah Sakit Umum Islam Klaten di ruang '.$bangsal.' / '.$ranap['no_bed'].' 
  </td>
  </tr> 
  <tr>
    <td> </td>
    <td>3.</td>
    <td colspan="6" class="txj">Saya akan menggunakan hak saya sebagai pihak pasien</td>
  </tr> 
  </tbody>
</table>
<table class="" cellspacing="0" cellpadding="1" width="" style="">
  <tbody>
  <tr>
    <td width="20"> </td>
    <td width="20">  </td>
    <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && $akad->akad == 'UMUM') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/>
    </td>
    <td width="200">Umum dan tidak beralih ke BPJS </td>
    <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && substr($akad->akad, 0, 4) == 'BPJS') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/></td>
    <td width="130">'.((!empty($akad->akad) && substr($akad->akad, 0, 4) == 'BPJS') ? $akad->akad : 'BPJS').' </td>
    <td width="18"><img src="'.IMG.'banner/'.((!empty($akad->akad) && $akad->akad == 'ASURANSI') ? 'square14_check' : 'square14_uncheck').'.png" width="12" height=""/></td>
    <td width="248">Asuransi lain : ____________________ </td>
  </tr> 
  <tr>
    <td> </td>
    <td>4.</td>
    <td colspan="6" class="txj">Saya bersedia membayar seluruh baya perawatan, pengobatan dan biaya administrasi lainnya sesuai dnengan kelas yang saya kehendaki. </td>
  </tr> 

  <tr>
    <td> </td>
    <td>5.</td>
    <td colspan="6" class="txj" >Saya bersedia melengkapi persyaratan asuransi penjamin biaya perawatan dalam waktu maksimal : <b> 3x24 jam untuk BPJS dan 2x24 jam untuk asuransi lainnya, </b> sejak persetujuan ini dibuat. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>6.</td>
    <td colspan="6" class="txj" >Khusus pasien BPJS, harus memenuhi persyaratan wajib sebagai pasien BPJS (KTP/KK/Kartu BPJS) pada saat menandatangani persetujuan ini, dan melengkapi persyaratan lainnya sesuai poin b). </td>
  </tr> 
  <!--
  <tr>
    <td> </td>
    <td>7.</td>
    <td colspan="6" class="txj" >Apabila pasien telah diperkenankan pulang oleh dokter, maka bersedia untuk segera menyelesaikan administrasi dan <b> meninggalkan kamar dalam waktu maksimal 1 jam dari instruksi pulang dokter. </b> </td>
  </tr> 
  <tr>
    <td> </td>
    <td>8.</td><td colspan="6" class="txj" >Jika waktu lebih dari 1 jam belum meninggalkan kamar, pasien/keluarga bersedia dikenakan biaya sebesar tarif akomodasi kamar yang ditempati. </td>
  </tr> 
  -->
  <tr>
    <td> </td>
    <td>7.</td>
    <td colspan="6" class="txj" >Apabila pasien telah diperkenankan pulang oleh dokter, maka bersedia untuk segera menyelesaikan administrasi dan <b> meninggalkan kamar dalam waktu maksimal 1 jam dari dinyatakan <i>check out</i> oleh Rumah Sakit. </b> </td>
  </tr> 
  <tr>
    <td> </td>
    <td>8.</td><td colspan="6" class="txj" >Jika waktu lebih dari 1 jam belum meninggalkan kamar, pasien/keluarga bersedia dikenakan biaya sebesar tarif akomodasi kamar yang ditempati. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>9.</td>
    <td colspan="6" class="txj" >Saya telah menerima informasi tentang peraturan yang diberlakukan oleh RS, dan saya beserta keluarga bersedia untuk mematuhinya termasuk mematuhi jam kunjung pasien sesuai dengan aturan RS. </td>
  </tr> 
  <tr>
    <td> </td>
    <td>10.</td>
    <td colspan="6" class="txj">Anggota keluarga/penunggu pasien bersedia untuk selalu memakai tanda pengenal khusus yang diberikan oleh RS dan demi keamanan seluruh pasien. Setiap keluarga dan siapapun yang akan mengunjungi pasien diluar jam berkunjung, bersedia untuk diminta/diperiksa identitasnya. </td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td colspan="6" class="txj"> </td>
  </tr> 
  <tr class="">
  <td width="" class="ln5" colspan="4"> &nbsp; </td>  
  </tr>
  </tbody>
  </table>
  <table class="" cellspacing="0" cellpadding="1" width="" style="">
  <tbody>
  <tr>
    <td class="bg-burem b"> I. </td>
    <td colspan="6" class="txj" class="bg-burem b">PELAYANAN SYARI\'AH UNTUK PASIEN MUSLIM/MUSLIMAH</td>
  </tr>   
  <tr>
    <td></td>
    <td colspan="6" class="txj">Bersama ini saya telah diberikan informasi mengenai pelayanan syari\'ah yang diberikan kepada pasien muslim/muslimah:  </td>
  </tr> 
  <tr>
    <td width="20"> </td>
    <td width="20">1.</td>
    <td colspan="6" class="txj">Penjagaan aurat dengan : menutup tirai saat tindakan, penyediaan hijab dan penutup dada ibu menyusui. </td>
  </tr> 
  <tr>
    <td> </td>
   <td>2.</td>
    <td colspan="6" class="txj">Bimbingan/pendampingan ibadah : wudhu/tayammum, sholat dan diingatkan waktu sholat.</td>
  </tr> 
  <tr>
    <td> </td>
    <td>3.</td>
    <td colspan="6" class="txj">Pada saat perawatan pasien ditunggu oleh keluarga (mahramnya).</td>
  </tr> 
  <tr>
    <td> </td>
    <td>4.</td>
    <td colspan="6" class="txj">Penyediaan gizi halal dan tidak menggunakan peralatan makan untuk makanan selain yang disajikan dari rumah sakit.</td>
  </tr> 
  <tr>
    <td> </td>
    <td>5.</td>
    <td colspan="4" class="txj">Pelayanan sakaratul maut (bimbingan talqin).</td>
  </tr> 
  <tr class="">
    <td width="" class="ln5" colspan="4"> &nbsp; </td>  
  </tr>
  <tr>
    <td class="bg-burem b">J. </td>
    <td colspan="6" class="txj" class="bg-burem b">PENDIDIKAN DAN PELATIHAN</td>
  </tr>   
  <tr>
    <td></td>
    <td colspan="6" class="txj"> Saya dengan ini memberikan persetujuan atas keberadaan peserta didik dalam proses pelayanan dan penggunaan data untuk pembelajaran dan penelitian. </td>
  </tr>
  <tr class="">
  <td width="" class="ln5" colspan="6"> &nbsp; </td>  
  </tr>
    <tr>
    <td colspan="6" class="txj">Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah membaca dan memahami item pada Persetujuan Umum/<i>General Consent.</i></td>
  </tr> 
  <tr>
    <td> </td>
    <td> </td>
    <td colspan="2" class="txj">  </td>
  </tr>
  </tbody>
</table>
<table>
<tbody>
  <tr>
    <td class="txc" width="300"> </td>
    <td width="73"> </td>
    <td class="txc" width="300"> Klaten, '.($ranap['tgl_ri']!=''?tampiltanggal($ranap['tgl_ri'], 9).' Jam '.substr($ranap['jam_ri'], 0, 5):'___/___/______ &nbsp; Jam ___:___ WIB').' </td>
  </tr> 
  <tr>
    <td class="txc" width="300"> Yang membuat pernyataan </td>
    <td width="73"> </td><td class="txc" width="300"> Petugas </td>
    </tr> 
  <tr>
    <td class="txc" width="300">  </td>
    <td width="73"> <br /><br /><br /> </td>
    <td class="txc" width="300">  </td>
  </tr> 
  <tr>
    <td class="txc" width="300">  '.((!empty($ranap)) ? $ranap['pjawab'] : '________________________<br />Tanda tangan & Nama Terang').'  </td>
    <td width="73"> </td>
    <td class="txc" width="300">  '.((!empty($ranap)) ? $nama_petugas : '________________________<br />Tanda tangan & Nama Terang').'  </td>
    </tr>
</tbody>
</table>';
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