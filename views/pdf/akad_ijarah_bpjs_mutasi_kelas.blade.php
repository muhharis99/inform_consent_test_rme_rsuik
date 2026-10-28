<?php
// echo phpinfo(); die();
if ($no_reg=='0000000') {
  $no_reg = $nama = $nik = $tgl_lahir = $umur = $alamat = "";
}
define('DOC_REVISI', 'Revisi : 2');
define('DOC_TERBIT', 'Tanggal terbit : 5 September 2022');
define('DOC_NOMER', 'Form/KU-PRPP/12'); 
define('DOC_TITLE', 'AKAD IJARAH<br />PASIEN BPJS SESUAI KELAS <br>MUTASI NAIK KELAS'); 
define('DOC_SUBJECT', 'Akad Ijarah Pasien BPJS Sesuai Kelas');
define('DOC_FILE', 'Akad-Bpjs-Mutasi-Kelas.pdf'); 
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
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; background-color:white;">
  <tbody>
    <tr>
      <td colspan="4" class="txc"> Dengan menyebut nama <strong>Allah</strong> yang Maha Pengasih lagi Maha Penyayang. <br /> </td>
    </tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
    <tr>
      <td colspan="4" class="txj">Pada hari ini, '.(!empty($akad)?(get_day_name($ranap['tgl_ri']).' tanggal '.tampiltanggal($ranap['tgl_ri'])):'_________ tanggal ___________________________ ').' telah terjadi penanda tanganan akad ijarah pasien BPJS sesuai kelas mutasi naik kelas antara,</td>
    </tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
    <tr>
      <td width="50"> </td>
      <td width="100">Nama </td>
      <td width="10">:</td>
      <td width="">'.(!empty($akad)?$akad->pihak_pertama_nama:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>NIK </td>
      <td>:</td>
      <td>'.(!empty($akad)?$akad->pihak_pertama_nik:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Jabatan </td>
      <td>:</td>
      <td>'.(!empty($akad)?str_replace(["PENDAFTARAN"], ["ADMISI"], $akad->pihak_pertama_jabatan):'__________________________________________').'</td>
    </tr>
    <tr>
      <td colspan="4" class="txj">Bertindak untuk dan atas nama RSU. Islam Klaten, yang beralamat di Jl. Raya
                            Klaten - Solo Km. 4 Klaten, untuk Selanjutnya disebut sebagai PIHAK I (PERTAMA) /
                            <em>AJIR</em> dengan :</td>
    </tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
    <tr>
      <td> </td>
      <td>Nama </td>
      <td>:</td>
      <td>'.(!empty($akad)?$akad->pihak_kedua_nama:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Alamat </td>
      <td>:</td>
      <td>'.(!empty($akad)?$akad->pihak_kedua_alamat:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>NIK </td>
      <td>:</td>
      <td>'.(!empty($akad)?$akad->pihak_kedua_nik:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Pekerjaan </td>
      <td>:</td>
      <td>'.(!empty($akad)?$akad->pihak_kedua_pekerjaan:'__________________________________________').'</td>
    </tr>
    <tr><td colspan="4" class="txj">Bertindak atas nama sendiri, atau mewakili pasien atas nama:</td></tr>
    <tr>
      <td> </td>
      <td>No RM </td>
      <td>:</td>
      <td>'.(!empty($akad)?$no_reg:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Nama </td>
      <td>:</td>
      <td>'.(!empty($akad)?$nama:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Alamat </td>
      <td>:</td>
      <td>'.(!empty($akad)?$alamat:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Agama </td>
      <td>:</td>
      <td>'.(!empty($akad)?$agama:'__________________________________________').'</td>
    </tr>
    <tr>
      <td> </td>
      <td>Ruang </td>
      <td>:</td>
      <td>'.(!empty($akad)?($bangsal.'/'.$ranap['kelas']):'__________________________________________').'</td>
    </tr>
    <tr><td colspan="4" class="txj">Untuk selanjutnya disebut sebagai PIHAK II (KEDUA) /
                            <em>MUSTA\'JIR</em></td></tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
    <tr><td colspan="4" class="txj">Kedua belah pihak telah sepakat, memahami maksud dan isi dari akad <em>Ijarah&nbsp;</em>pasien BPJS sesuai
                        	kelas mutasi naik kelas tersebut di atas, dengan ketentuan dan syarat-syarat sebagai berikut: </td></tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
  </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tbody>
    <tr>
      <td width="35"> </td>
      <td width="15">1. </td>
      <td colspan="2" class="txj">PIHAK PERTAMA menyetujui untuk memberikan pelayanan kesehatan sesuai dengan
                      Standar Prosedur Operasional di RSU. Islam Klaten</td>
    </tr>
    <tr>
      <td> </td>
      <td>2. </td>
      <td colspan="2" class="txj">
        PIHAK KEDUA membayarkan imbal jasa kepada PIHAK PERTAMA apabila mutasi naik kelas sebesar :
                        	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:bold;">
                        		<tr>
                        			<td style="text-align: left; width:10mm;">&nbsp;a.&nbsp;</td>
                        			<td style="text-align: left;">
                        				selisih tarif INA-CBGS kelas I dengan kelas 2 untuk pasien naik kelas 1
                        			</td>
                        		</tr>                       		
                        		<tr>
                              <td style="text-align: left; width:10mm;">&nbsp;b.&nbsp;</td>
                              <td style="text-align: left;">
                                selisih tarif INA-CBGS kelas 2 dengan kelas 3 untuk pasien naik kelas 2
                              </td>
                            </tr>                    		
                            <tr>
                              <td style="text-align: left; width:10mm;">&nbsp;c.&nbsp;</td>
                        			<td style="text-align: left;">
                        				75% dari tarif INA-CBGS kelas I untuk pasien naik ke VIP
                        			</td>
                        		</tr>
                        	</table>
      </td>
    </tr>
    <tr>
      <td> </td>
      <td>3. </td>
      <td colspan="2" class="txj">PIHAK PERTAMA menerbitkan kuitansi penerimaan imbal jasa sesuai jumlah yang
                            diterima sebagai paket pelayanan tanpa perincian</td>
    </tr>
    <tr><td colspan="4" class="ln5"> &nbsp; </td></tr>
  </tbody>
</table>
'; 
$html .= '
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3" class="txc" >Klaten, '.(!empty($akad)?(tampiltanggal($akad->tgl_dibuat)):'_______________________________').' </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url(\''.$ttd_pasien->ttd_pasien.'\'); background-image-resize:2;background-repeat:no-repeat; background-size:30px; background-position:center;">
              PIHAK II
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_kedua_nama!=''?$akad->pihak_kedua_nama:'_____________________________'):'_____________________________').'
            </td>
            <td width=""></td>
            <td width="300" class="txc" style="background-image:url(\''.(!empty($akad->pihak_pertama_nik)?IMG.'ttd/'.$akad->pihak_pertama_nik.'.jpg':'').'\'); background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
              PIHAK I
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->pihak_pertama_nama!=''?$akad->pihak_pertama_nama:'_____________________________'):'_____________________________').'
            </td>
        </tr>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td colspan="3" class="txc"> Saksi-saksi </td>
        </tr>
        <tr>
            <td width="300" class="txc" style="background-image:url('.(!empty($ttd_file) && $ttd_file!='' ? 'http://192.168.0.16/serverx/assets/rme/ttd_pasien/'.$ttd_file : (!empty($signature)?$signature:'')).'); opacity:0.5; background-image-resize:2; background-repeat:no-repeat; background-size:'.(!empty($ttd_file) && $ttd_file!='' ? '60px' : (!empty($signature)?'60px':'60px')).'; background-position:center;height:'.(!empty($ttd_file) && $ttd_file!='' ? '60px' : (!empty($signature)?'60px':'60px')).';">
              
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->saksi_satu!=''?$akad->saksi_satu:'_____________________________'):'_____________________________').'
            </td>
            <td width=""></td>
            <td width="300" class="txc" style="background-image:url(\''.IMG.'ttds/'.$no_reg.'.jpg\'); display:none; background-repeat:no-repeat; background-size:25% 25%; background-position:left;height:110px;">
              
                <br />
                <br />
                <br />
                <br />
                '.(!empty($akad)?($akad->saksi_dua!=''?$akad->saksi_dua:'_____________________________'):'_____________________________').'
            </td>
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