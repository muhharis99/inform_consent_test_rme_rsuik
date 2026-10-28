<?php
define('DOC_REVISI', 'Revisi: 5');
define('DOC_TERBIT', 'Tanggal Terbit : 1 Agustus 2022');
define('DOC_NOMER', 'FM/RM/08'); 
define('DOC_FILE', 'Pencatatan-DPJP.pdf'); 
define('DOC_TITLE', 'ANALISA DATA KEPERAWATAN'); 
define('DOC_SUBJECT', 'Analisa Data Keperawatan'); 
require_once dirname(__FILE__) . '/mpdf/mpdf.php';
$pdf = new mPDF('', 'A4', 12, 'calibri', 15, 5, 35, 10, 5, 6, 'P');
require_once dirname(__FILE__) . '/mpdf/hfrm.php';
$html = '';
$html .= '
  <style type="text/css">
    .bg-burem {
      background-color: #9F9FA0;
      line-height:23px;
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
      line-height:25px;
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
    .ln14 {
      line-height:14px;
    }
    .ln15 {
      line-height:15px;
    }
    .ln30 {
      line-height:30px;
    }
    .title td {
      line-height:20px;
      font-weight:bold;
    }
    .bdl {
       border-left: 1px solid #000000;
    }
    .bdr {
       border-right: 1px solid #000000;
    }
    .bdt {
       border-top: 1px solid #000000;
    }
    .bdb {
       border-bottom: 1px solid #000000;
    }
    .bdbb {
       border-bottom: 1px solid #000000;
    }
    .tableinzero table tr td {
      padding:0px;
    }
    .p0 {
      padding:0px;
    }
    .size-custom {
      font-size:14px;
    }
  </style>
'; 
$html .='<br>';
$html .= '

<table cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; line-height:22px;">
  <tbody>
   
 
    <tr class="bdl bdr bdt bdb bg-burem b">
      <td class="bdr txc" width="10px"> NO </td>
      <td class="bdr txc b size-custom" width="250px"> DATA </td>
      <td class="bdr txc b size-custom" width="250px"> MASALAH </td>
      <td class="bdr txc b size-custom" width="250px"> KEMUNGKINAN PENYEBAB </td>
    </tr>
    <tr class="bdl bdr">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bg1">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr"> &nbsp; </td>
    
    </tr>
    <tr class="bdl bdr bdt bdb">
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      <td class="bdr size-custom"> &nbsp; </td>
      
      <td class="bdr size-custom"> &nbsp; </td>
    
    </tr>
  </tbody>
</table>

  ';
  $html .= '<br>';
  $html .= '
  <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse;">
    <tbody>
      <tr><td colspan="4" class="ln5 size-custom"> &nbsp; </td></tr>
      <tr>
        <td colspan="4" class="txj size-custom">Prioritas Diagnosa Keperawatan :</td>
      </tr>
      <tr><td colspan="4" class="ln14 size-custom"> &nbsp; </td></tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">1</td>
        <td colspan="3" class="ln23 bdbb size-custom"> &nbsp; </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">&nbsp;</td>
        <td colspan="3" class="ln23 bdbb size-custom" width="7px"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">2</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">&nbsp;</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">3</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">&nbsp;</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">4</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">&nbsp;</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">5</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
      <tr>
        <td width="50" class="ln23 size-custom" align="center">&nbsp;</td>
        <td colspan="3" class="ln23 bdbb size-custom"> </td>
      </tr>
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
            <td colspan="3"> &nbsp; </td>
        </tr>
        <tr>
            <td width="300" class="txc size-custom" style="background-image:url(\''.IMG.'ttd/'.$dpjp_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:100px; background-position:center;height:110px;">
            &nbsp;
                
            </td>
            <td width="72"></td>
            <td width="300" class="txc ln23 size-custom" style="background-image:url(\''.IMG.'ttd/'.$perawat_id.'.jpg\'); background-image-resize:2;  background-repeat:no-repeat; background-size:25% 25%; background-position:center;height:110px;">
                Klaten, ___/___/______ &nbsp; Pukul ___:___ WIB
                <br />
                <!--'.($ttd=='1'?'<img height="50" width="75" src="'.IMG.'ttd/'.$perawat_id.'.jpg" alt="">':'<br /><br />').'-->
                <br />
                <br />
                <br />
                '.($perawat!=''?$perawat:'______________________________').'
                <br />
                <div>
                Tanda tangan & Nama terang
                </div>
            </td>
            
        </tr>
    </tbody>
  </table>'; 

$pdf->WriteHTML($html);


$file = "soap_inap_resume_20220618.pdf";
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