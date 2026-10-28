<?php
define('DOC_REVISI', 'Revisi : 5');
define('DOC_TERBIT', 'Tanggal Terbit : 23 Juni 2022');
define('DOC_NOMER', 'FM/RM/03'); 
define('DOC_FILE', 'Resume-Keperawatan-Ringkasan-Pasien-Pulang.pdf'); 
define('DOC_TITLE', 'RESUME KEPERAWATAN'); 
define('DOC_SUBJECT', 'Resume Keperawatan Ringkasan Pasien Pulang'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
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
    .bg-burem td, .bg-burem th {
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
    }
    .ln19 {
      line-height:19px;
    }
    .ln20 {
      line-height:20px;
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
      font-size:14px;
    }
    .ln26 {
      line-height:26px;
      font-size :14px;
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
      line-height:20px;
      font-weight:bold;
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
    .sc14 {
      font-size :14px;
    }
    .sc2 {
      font-size :13px;
    }
    .text2 {
     writing-mode: vertical-lr;
    }

  </style>
'; 
$print_tr = '';
$jml_row = 30;
for($i=0; $i<$jml_row; $i++) {
  $print_tr .= ''; 
}
$html .= '
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem b">
    <td class="" width="20">A.</td>
    <td class="txl" colspan="6"> KEADAAN PASIEN SAAT PULANG </td>
  </tr>
  <tr class=" ">
    <td>&nbsp;</td>
    <td width="203" class="b">Diagnosa Medis </td>
    <td width="10" class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->diagnosa!=""?$askep->diagnosa:'-'):'_________________________________________________________________________ <br />_________________________________________________________________________').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Tindakan Medis </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->tindakan!=""?$askep->tindakan:'-'):'_________________________________________________________________________ <br />_________________________________________________________________________').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> <u>Kondisi Pasien</u> </td>
    <td class="b">  </td>
    <td colspan="4"> </td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Vital Sign </td>
    <td class="b"> : </td>
    <td class=""> Suhu : '.($tanggal!=""?($askep->s!=""?$askep->s:"-"):"___").' °C </td>
    <td class=""> Nadi : '.($tanggal!=""?($askep->n!=""?$askep->n:"-"):"___").' x/mnt </td>
    <td class=""> Pernafasan : '.($tanggal!=""?($askep->rr!=""?$askep->rr:"-"):"___").' x/mnt </td>
    <td class=""> Tensi : '.($tanggal!=""?($askep->td1!=""?$askep->td1."/".$askep->td2:"-"):"___").' mmHg </td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Keadaan Umum Pasien </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->ku!=""?($askep->ku == '4' ? $askep->ku_lain : $askep->ku):'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Luka / Lukis Operasi </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->luka!=""?($askep->luka == '4' ? $askep->luka_lain : $askep->luka):'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Alat Yang Terpasang </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->alter!=""?$askep->alter:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Transfer & Mobilisasi </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->tm!=""?$askep->tm:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Alat Bantu </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->alban!=""?($askep->alban == '4' ? $askep->alban_lain : $askep->alban):'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="b">
    <td class=""> </td>
    <td class="txl" colspan="6"> <u>Diagnosa Keperawatan Selama Dirawat</u> </td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td colspan="6"> '.($tanggal!=""?($askep->diagnosa_dirawat!=""?ucwords(strtolower($askep->diagnosa_dirawat)):'-'):'___________________________________________________________________________________________________ <br />___________________________________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="b">
    <td class=""> </td>
    <td class="txl" colspan="6"> <u>Edukasi/Penyuluhan Kesehatan Yang Sudah Diberikan</u> </td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td colspan="6"> '.($tanggal!=""?($askep->edukasi!=""?ucwords(strtolower($askep->edukasi)):'-'):'___________________________________________________________________________________________________ <br />___________________________________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="b">
    <td class=""> </td>
    <td class="txl" colspan="6"> <u>Bimbingan Spiritual (Pasien Muslim)</u> </td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Thaharah </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->thaharah!=""?$askep->thaharah:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Sholat </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->sholat!=""?$askep->sholat:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Fikih Wanita  </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->fikih!=""?$askep->fikih:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Do`a Orang Sakit  </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->doa!=""?$askep->doa:'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
</table>
  ';
$html .='
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem b">
    <td class="" width="20">B.</td>
    <td class="txl" colspan="6"> MANAJEMEN NYERI </td>
  </tr>
  <tr class=" ">
    <td>&nbsp;</td>
    <td width="203" class="b">Obat Diminum / Anti Nyeri  </td>
    <td width="10" class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->obat_nyeri!=""?ucwords(strtolower($askep->obat_nyeri)):'-'):'_________________________________________________________________________ <br />_________________________________________________________________________').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Efek Samping Yang Mungkin Timbul </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->efek!=""?ucwords(strtolower($askep->efek)):'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
  <tr class="">
    <td class="">&nbsp;</td>
    <td class="b"> Bila Nyeri Bertambah Berat Segera Ke RS </td>
    <td class="b"> : </td>
    <td colspan="4"> '.($tanggal!=""?($askep->nyeri_tambah!=""?ucwords(strtolower($askep->nyeri_tambah)):'-'):'_________________________________________________________________________ ').'</td>
  </tr>
  <tr><td colspan="7" class="ln5">&nbsp; </td></tr>
</table>
  ';
$html .='

<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
  <tr class="bg-burem b">
    <td class="" width="20">C.</td>
    <td class="txl" colspan="8"> SURAT DAN HASIL PEMERIKSAAN YANG DISERAHKAN PADA KELUARGA </td>
  </tr>
  <tr>
    <td></td>
    <td width="15" class="b">1. </td>
    <td width="130" class="b">Hasil Lab</td>
    <td width="10" class="b">: </td>
    <td width="200">'.($tanggal!=""?($askep->has_lab!=""?$askep->has_lab:"-"):'_______________________').'</td>
    <td width="15" class="b">6. </td>
    <td width="150" class="b">Rujukan</td>
    <td width="10" class="b">: </td>
    <td width="">'.($tanggal!=""?($askep->rujukan!=""?$askep->rujukan:"-"):'_______________________').'</td>
  </tr>
  <tr>
    <td></td>
    <td class="b">2. </td>
    <td class="b">Hasil Radiologi</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->has_ro!=""?$askep->has_ro:"-"):'_______________________').'</td>
    <td class="b">7. </td>
    <td class="b">Surat Keterangan Lahir</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->surat_ket_lahir!=""?$askep->surat_ket_lahir:"-"):'_______________________').'</td>
  </tr>
  <tr>
    <td></td>
    <td class="b">3. </td>
    <td class="b">Surat Istirahat</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->surat_istirahat!=""?$askep->surat_istirahat:"-"):'_______________________').'</td>
    <td class="b">8. </td>
    <td class="b">KMS</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->kms!=""?$askep->kms:"-"):'_______________________').'</td>
  </tr>
  <tr>
    <td></td>
    <td class="b">4. </td>
    <td class="b">Resume Medis</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->resume_medis!=""?$askep->resume_medis:"-"):'_______________________').'</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td class="b">5. </td>
    <td class="b">Resume Perawat</td>
    <td class="b">: </td>
    <td>'.($tanggal!=""?($askep->resume_perawat!=""?$askep->resume_perawat:"-"):'_______________________').'</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
';

$html .='
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="" > </td>
            <td width="" > </td>
            <td width="" class="txc" >Klaten, '.($tanggal!=""?$tanggal.", Pukul ".$jam." WIB":"___/___/______, Pukul ___:___ WIB ").' </td>
        </tr>
        <tr>';
            // <td width="300 ln20" class="txc" style="background-image:url(\''.$ttd_pasien_nama.'\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;">
            //     Pasien/Keluarga
            //     <br />
            //     <br />
            //     <br />
            //     '.($tanggal!=""?($ttd_pasien!=""?$ttd_pasien:"_____________________________"):'_____________________________<br /> Tanda tangan dan Nama terang').'
            // </td>
            $html .='
            <td width="300 ln20" class="txc" style="background-image:url('.(!empty($ttd_pasien) && $ttd_pasien!='' ? $ttd_pasien : (!empty($signature)?$signature:'')).'); opacity:0.5; background-image-resize:2; background-repeat:no-repeat; background-size:'.(!empty($ttd_pasien) && $ttd_pasien!='' ? '60px' : (!empty($signature)?'60px':'60px')).'; background-position:center;height:'.(!empty($ttd_pasien) && $ttd_pasien!='' ? '60px' : (!empty($signature)?'60px':'60px')).';">
                Pasien/Keluarga
                <br />
                <br />
                <br />
                '.(!empty($ttd_pasien_nama)?' '.$ttd_pasien_nama.' ': (!empty($signature_nama)?$signature_nama:' __________________________________ <br />Tanda tangan & Nama terang')).'
            </td>';
            $html .='
            <td width="72"></td>
            <td width="300" class="txc" style="background-image:url(\''.$askep->ttd_image.'\'); background-image-resize:2;  background-repeat:no-repeat; background-size:50px; background-position:center;">
                Perawat Penanggung Jawab Asuhan,
                <br />
                <br />
                <br />
                '.($tanggal!=""?($askep->perawat!=""?$askep->perawat:"_____________________________"):'_____________________________<br /> Tanda tangan dan Nama terang').'
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
    $cmd = "lp $file -d $printer";
    shell_exec($cmd);
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