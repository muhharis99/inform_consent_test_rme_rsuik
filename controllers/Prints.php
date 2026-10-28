<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prints extends MY_Controller
{
    function __construct() {
        parent::__construct();

        $this->load->model('user_register');
    }
    function index() {
        $data = array(
            'header' => true,
            'view' => 'form_home',
            'assets' => $this->template->getMetadata()
        );

        go('index', $data);
    }
    function escprint()
    {
        $connector = new NetworkPrintConnector("192.168.0.169", 9100);
        $printer = new Escpos($connector);

        /* Initialize */
        $printer -> initialize();

        /* Text */
        $printer -> text("Hello world\n");
        $printer -> cut();

        /* Line feeds
        $printer -> text("ABC");
        $printer -> feed(7);
        $printer -> text("DEF");
        $printer -> feedReverse(3);
        $printer -> text("GHI");
        $printer -> feed();
        $printer -> cut();*/
    }
    function csr()
    {
        $this->load->model('dokter');

        $COM_Object = "CrystalReports13.ObjectFactory.1";

        //------  Variables ------
        $my_report = "file:///".FCPATH."assets/rme/csr.rpt";
        echo $my_report;
        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
        $dir = "D:\\RME\\$ip\\";
        if(file_exists($dir)){
        }else{
            mkdir($dir,0777);
        }
        $my_pdf = $dir."csr.pdf";

        //------ Create a new COM Object of Crytal Reports XI ------
        $ObjectFactory= New COM($COM_Object);

        //------ Create a instance of library Application -------
        $crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application.13");

        //------ Open your rpt file ------
        $creport = $crapp->OpenReport($my_report, 1);

        //$creport->Database->Tables(1)->SetLogOnInfo("192.168.0.252", "rsiklaten", "admin", "admin3dp");

        //—— Suppress the Parameter field prompt or else report will hang ——
        $creport->EnableParameterPrompting = 0;

        $creport->DiscardSavedData();
        $creport->ReadRecords();

        $creport->ParameterFields(1)->SetCurrentValue('5');

        $dokter = Dokter::all();
        $i = 1;
        foreach ($dokter as $alld) {
             # code...
            $nm_dr = $alld->nama;
            $creport->ParameterFields(2)->SetCurrentValue($nm_dr)[$i];
            $i++;
        }

        $creport->ExportOptions->DestinationType = 1;
        $creport->ExportOptions->DiskFileName=$my_pdf;
        $creport->ExportOptions->PDFExportAllPages=true;
        $creport->ExportOptions->DestinationType=1;
        $creport->ExportOptions->FormatType=31;
        $creport->DisplayProgressDialog = false;
        $creport->Export(false);
        //$creport->PrintOut(false);


        $filename = "csr.pdf";
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($my_pdf));
        header('Accept-Ranges: bytes');
        @readfile($my_pdf);


        $creport = null;
        $crapp = null;
        $ObjectFactory = null;
//------ Embed the report in the webpage ------
    }
    function ipaddress()
    {
        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
        echo $ip;
    }
    function loading()
    {
        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
        echo "<div>".$ip . " Please wait ...</div>";
    }
    function listprinter()
    {
         $stack = new DOTNET("mscorlib", "System.Drawing");

    }
    function list_printer()
    {
        $printerList = printer_list(PRINTER_ENUM_LOCAL);
        var_dump($printerList);
        $printerName = $printerList[0]['NAME'];
        echo $printerName;
        $printer = $printerName;
        /*
        http://pascal-id.krosser.com/viewtopic.php?f=18&t=14
        if($ph = printer_open($printer)) {
           $content = "hello";

           // Set print mode to RAW and send PDF to printer
           printer_set_option($ph, PRINTER_MODE, "RAW");
           printer_write($ph, $content);
           printer_close($ph);
        }
        else
        {
            echo "Couldn't connect...";
        }*/
    }
    function printIssue()
    {
        $your_printer_name = "EPSON_LX300";
        $handle=printer_open($your_printer_name);
        //set the font characteristics here
        $font_face = "Draft Condensed";
        $font_height = 20;
        $font_width = 6;
        $font=printer_create_font($font_face,$font_height,$font_width,PRINTER_FW_THIN,false,false,false,0);
        printer_select_font($handle,$font);
        printer_write($handle,"My PDF file content below");
        //here loop through your pdf file and print the line by line or else get the entire content inside the string at once and print
        $your_pdf_file = "somethng.pdf";
        $name = "http://192.168.0.16/rme/pdf/lab/1";
        if(!eof($file_handle))
        {
            //do something
            printer_write($handle,$name);
        }
        printer_delete_font($font);
        printer_close($handle);
    }
    function print_page()
    {
        $page = FCPATH.'assets\\report\\pdf\\192.168.0.16\\senranap.pdf';

        $printer = "\\\\192.168.0.169\\EL100";
        if($ph = printer_open($printer))
        {

            $content = file_get_contents($page);
           // Set print mode to RAW and send PDF to printer
           printer_set_option($ph, PRINTER_MODE, "RAW");
           printer_write($ph, $content);
           printer_close($ph);
        }
        else "Couldn't connect...";
    }

    function fastreport()
    {
        $COM_Object = "Fastreport.Report";

        //------  Variables ------
        $my_report = FCPATH."assets/rme/antrian.frx";
        $my_pdf = "C:\\test.pdf";

        //------ Create a new COM Object of Crytal Reports XI ------
        $ObjectFactory= New DOTNET($COM_Object);

        //------ Create a instance of library Application -------
        $crapp = $ObjectFactory->CreateObject("Fastreport.Report");

        //------ Open your rpt file ------
        $creport = $crapp->Load($my_report, 1);

    }
    function ip()
    {
        echo $this->ip_in_range('192.168.0.16', '/24');
    }
    /**
     * Check if a given ip is in a network
     * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
     * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
     * @return boolean true if the ip is in this range / false if not.
     */
    function ip_in_range( $ip, $range ) {
        if ( strpos( $range, '/' ) == false ) {
            $range .= '/32';
        }
        // $range is in IP/CIDR format eg 127.0.0.1/24
        list( $range, $netmask ) = explode( '/', $range, 2 );
        $range_decimal = ip2long( $range );
        $ip_decimal = ip2long( $ip );
        $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
        $netmask_decimal = ~ $wildcard_decimal;
        return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
    }
    function crystal()
    {
        $this->load->model('dokter');
        $this->load->model('poli');
        $this->load->model('pasien');

        /*
        $crapp = new COM("CrystalRuntime.Application.13");
        $creport = $crapp->OpenReport("D:\\CrystalReport1.rpt", 1);

        $creport->DiscardSavedData();
        $creport->ReadRecords();

        echo 'Driver Name : ' . $creport->DriverName.' **<br>';
        echo 'Printer Name : ' . $creport->PrinterName.' **<br>';
        echo 'Port Name : ' . $creport->PortName.' **<br>';

        $creport->SelectPrinter("HP LaserJet 1100(MS)", "HPLocal", "LPT1:");
        $creport->PaperOrientation = 0;

        $creport->PrintOut(False);
        echo 'creport->PrintingStatus->Progress : ' . $creport->PrintingStatus->Progress . '<br>';
        */

        $pasien = Pasien::find('0091202');
        $no_reg = $pasien->no_reg;
        $nama = $pasien->nama;
        $alamat = $pasien->alamat;
        $tgl_lahir = $pasien->tgl_lahir;
        $kd_poli = $pasien->kd_poli;
        $poli = Poli::where('kode_poli', $kd_poli)->get();
        foreach($poli as $all)
        {
            $nm_poli = $all->nama_poli;;
        }
        $kd_dr = $pasien->kd_dr;
        $dokter = Dokter::where('no_dr', $kd_dr)->get();
        foreach ($dokter as $all) {
            # code...
            $nm_dr = $all->nama;
        }
        $today = date('d').' '.bulan(date('m')).' '.date('Y');

        $COM_Object = "CrystalReports13.ObjectFactory.1";

        //------  Variables ------
        $my_report = FCPATH."assets/rme/antrian_2.rpt";
        $my_pdf = "C:\\test.pdf";

        //------ Create a new COM Object of Crytal Reports XI ------
        $ObjectFactory = New COM($COM_Object);

        //------ Create a instance of library Application -------
        $crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application.13");

        //------ Open your rpt file ------
        $creport = $crapp->OpenReport($my_report, 1);

        //—— Suppress the Parameter field prompt or else report will hang ——
        $creport->EnableParameterPrompting = 0;

        //—— DiscardSavedData make a Refresh in your data ——-
        $creport->DiscardSavedData;
        $creport->ReadRecords(); // attention!
        $creport->ParameterFields(1)->SetCurrentValue($no_reg);
        $creport->ParameterFields(2)->SetCurrentValue($nama);
        $creport->ParameterFields(3)->SetCurrentValue($alamat);
        $creport->ParameterFields(4)->SetCurrentValue($tgl_lahir);
        $creport->ParameterFields(5)->SetCurrentValue($nm_poli);
        $creport->ParameterFields(6)->SetCurrentValue($nm_dr);
        $creport->ParameterFields(7)->SetCurrentValue($today);
        //------ Connect to DB2 DataBase ------
        //$crapp->LogOnServer('TEST','db2admin','');

        //------ Put the values that you want --------
        //$creport->RecordSelectionFormula="{test.no}='ANY_VALUE'";

        //—— Pass formula fields ——–
        //$creport->FormulaFields->Item(1)->Text = ("My Report Title");
        //$creport->ParameterFields(2)->AddCurrentValue (2000);

        //------ Export to PDF -------
        $creport->ExportOptions->DiskFileName = $my_pdf; //Export to pdf
        $creport->ExportOptions->PDFExportAllPages = true;
        $creport->ExportOptions->DestinationType = 1;  //Export to file
        $creport->ExportOptions->FormatType = 31; // PDF type
        $creport->Export(false);
        /* Format Types:

        4 - RTF
        31 - PDF
        30 - xls
        36 - xls
        14 - doc
        */

    }

    function bill() {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Asuransi');
        $no_reg = segment(4);
        $tgl_masuk = segment(5);
        $jam_masuk = '';
        $no_kwt = '';
        if (!empty(segment(6))) {
            $no_kwt = segment(6);
        }
        // $akses = self::akses();
        $no_reg  = $this->input->post('no_reg');
        $tgl_rs  = $this->input->post('tgl_rs');
        $bill  = $this->input->post('bill');
        $nota  = $this->input->post('nota');
        $kd_dokter  = $this->input->post('dokter');
        $sel_poli  = $this->input->post('poli');
        $tgl_masuk = date("Y-m-d", strtotime($tgl_rs));
        $jam_masuk = date("H:i", strtotime($tgl_rs));
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $total = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        $terbilang = ""; 
        $txt_rawat = "";

        $kode_asuransi = ""; 
        $nama_asuransi = "";
        switch ($bill) {
            case 'GIGIRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Gigi_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        /*
                        $db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('gigi_db5j.kd_dr', $kd_dokter)->where('gigi_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('gigi_db5j.no_tran', $nota)->get(
                                array('gigi_db5j.netto', DB::Raw('floor(gigi_db5j.kwanta) as satuan'), 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.no_rel', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                        */
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.gigi_db5j.netto,
                                    floor(bill.gigi_db5j.kwanta) as satuan, 
                                    bill.gigi_db5j.no_perk,
                                    bill.gigi_db5j.jumlah,
                                    bill.gigi_db5j.dokter,
                                    bill.gigi_db5j.no_rel, 
                                    bill.gigi_db5j.bangsal, 
                                    bill.gigi_db5j.no_tran
                                from 
                                    bill.gigi_db5j 
                                where 
                                    bill.gigi_db5j.no_reg='$no_reg'
                                    and bill.gigi_db5j.dokter = '$kd_dokter' 
                                    and bill.gigi_db5j.no_tran = '$nota'
                                    and bill.gigi_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.gigi_db5j.deleted is null 
                                ) a 
                            left join bill.sps_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('gigi_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                array('gigi_db5j.netto', DB::Raw('floor(gigi_db5j.kwanta) as satuan'), 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.no_rel', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.gigi_db5j.netto,
                                    floor(bill.gigi_db5j.kwanta) as satuan, 
                                    bill.gigi_db5j.no_perk,
                                    bill.gigi_db5j.jumlah,
                                    bill.gigi_db5j.dokter,
                                    bill.gigi_db5j.no_rel, 
                                    bill.gigi_db5j.bangsal, 
                                    bill.gigi_db5j.no_tran
                                from 
                                    bill.gigi_db5j 
                                where 
                                    bill.gigi_db5j.no_reg='$no_reg'
                                    and bill.gigi_db5j.dokter = '$kd_dokter' 
                                    and bill.gigi_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.gigi_db5j.deleted is null 
                                ) a 
                            left join bill.sps_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                // echo json_encode($db5j); die();

                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('gigi_db5j.dokter', $kd_dokter)->where('gigi_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('gigi_db5j.deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                array('gigi_db5j.netto', DB::Raw('floor(gigi_db5j.kwanta) as satuan'), 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.no_rel', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('gigi_db5j.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('gigi_db5j.deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                array('gigi_db5j.netto', DB::Raw('floor(gigi_db5j.kwanta) as satuan'), 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.no_rel', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 

                    $this->load->model('Gigi_db5j_writer'); 
                    $db5j_writer = Gigi_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'GIGI' :
                            $this->load->model('Gigi_db5j'); 
                            $gigi_db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                                $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                    array('gigi_db5j.netto', 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $gigi_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            case 'GIGIRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "POLIKLINIK GIGI";
                $this->load->model('Gigi_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Gigi_db5::leftJoin('sps_no_perk', function ($join) {
                    $join->on('gigi_db5.no_perk', '=', 'sps_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('gigi_db5.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('gigi_db5.deleted')->where('gigi_db5.no_tran', '<>', '""')->get(
                        array('gigi_db5.netto', 'gigi_db5.no_perk', DB::Raw('floor(gigi_db5.kwanta) as satuan'), 'gigi_db5.jumlah', 'gigi_db5.dokter', 'gigi_db5.bangsal', 'gigi_db5.no_tran', 'sps_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Gigi_db5_writer'); 
                    $db5_writer = Gigi_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('gigi_db5.deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            
            case 'SPSRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Sps_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        /*
                        $db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('sps_db5j.kd_dr', $kd_dokter)->where('sps_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('sps_db5j.no_tran', '<>', '""')->get(
                                array('sps_db5j.netto', DB::Raw('floor(sps_db5j.kwanta) as satuan'), 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.dokter', 'sps_db5j.no_rel',  'sps_db5j.bangsal', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                        */
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.sps_db5j.netto,
                                    floor(bill.sps_db5j.kwanta) as satuan, 
                                    bill.sps_db5j.no_perk,
                                    bill.sps_db5j.jumlah,
                                    bill.sps_db5j.dokter,
                                    bill.sps_db5j.no_rel, 
                                    bill.sps_db5j.bangsal, 
                                    bill.sps_db5j.no_tran
                                from 
                                    bill.sps_db5j 
                                where 
                                    bill.sps_db5j.no_reg='$no_reg'
                                    and bill.sps_db5j.dokter = '$kd_dokter' 
                                    and bill.sps_db5j.no_tran = '$nota'
                                    and bill.sps_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.sps_db5j.deleted is null 
                                ) a 
                            left join bill.sps_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('sps_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('sps_db5j.no_tran', '<>', '""')->get(
                                array('sps_db5j.netto', DB::Raw('floor(sps_db5j.kwanta) as satuan'), 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.dokter', 'sps_db5j.no_rel', 'sps_db5j.bangsal', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.sps_db5j.netto,
                                    floor(bill.sps_db5j.kwanta) as satuan, 
                                    bill.sps_db5j.no_perk,
                                    bill.sps_db5j.jumlah,
                                    bill.sps_db5j.dokter,
                                    bill.sps_db5j.no_rel, 
                                    bill.sps_db5j.bangsal, 
                                    bill.sps_db5j.no_tran
                                from 
                                    bill.sps_db5j 
                                where 
                                    bill.sps_db5j.no_reg='$no_reg'
                                    and bill.sps_db5j.dokter = '$kd_dokter' 
                                    and bill.sps_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.sps_db5j.deleted is null 
                                ) a 
                            left join bill.sps_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('sps_db5j.dokter', $kd_dokter)->where('sps_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('sps_db5j.deleted')->where('sps_db5j.no_tran', '<>', '""')->get(
                                array('sps_db5j.netto', DB::Raw('floor(sps_db5j.kwanta) as satuan'), 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.dokter', 'sps_db5j.no_rel',  'sps_db5j.bangsal', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('sps_db5j.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('sps_db5j.deleted')->where('sps_db5j.no_tran', '<>', '""')->get(
                                array('sps_db5j.netto', DB::Raw('floor(sps_db5j.kwanta) as satuan'), 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.dokter', 'sps_db5j.no_rel', 'sps_db5j.bangsal', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 
                    $this->load->model('Sps_db5j_writer'); 
                    $db5j_writer = Sps_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'GIGI' :
                            $this->load->model('Sps_db5j'); 
                            $sps_db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                                $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('sps_db5j.no_tran', '<>', '""')->get(
                                    array('sps_db5j.netto', 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.dokter', 'sps_db5j.bangsal', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $sps_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            case 'SPSRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "POLIKLINIK GIGI";
                $this->load->model('Sps_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Sps_db5::leftJoin('sps_no_perk', function ($join) {
                    $join->on('sps_db5.no_perk', '=', 'sps_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('sps_db5.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('sps_db5.deleted')->where('sps_db5.no_tran', '<>', '""')->get(
                        array('sps_db5.netto', 'sps_db5.no_perk', DB::Raw('floor(sps_db5.kwanta) as satuan'), 'sps_db5.jumlah', 'sps_db5.dokter', 'sps_db5.bangsal', 'sps_db5.no_tran', 'sps_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Sps_db5_writer'); 
                    $db5_writer = Sps_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('sps_db5.deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 

            case 'UMUMRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Umum_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        /*
                        $db5j = Umum_db5j::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5j.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5j.kd_dr', $kd_dokter)->where('umum_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                array('umum_db5j.netto', DB::Raw('floor(umum_db5j.kwanta) as satuan'), 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.no_rel', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'umum_no_perk.na_perk')
                            );
                        */
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.umum_db5j.netto,
                                    floor(bill.umum_db5j.kwanta) as satuan, 
                                    bill.umum_db5j.no_perk,
                                    bill.umum_db5j.jumlah,
                                    bill.umum_db5j.dokter,
                                    bill.umum_db5j.no_rel, 
                                    bill.umum_db5j.bangsal, 
                                    bill.umum_db5j.no_tran
                                from 
                                    bill.umum_db5j 
                                where 
                                    bill.umum_db5j.no_reg='$no_reg'
                                    and bill.umum_db5j.dokter = '$kd_dokter' 
                                    and bill.umum_db5j.no_tran = '$nota'
                                    and bill.umum_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.umum_db5j.deleted is null 
                                ) a 
                            left join bill.umum_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Umum_db5j::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5j.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                array('umum_db5j.netto', DB::Raw('floor(umum_db5j.kwanta) as satuan'), 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.no_rel', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'umum_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.umum_db5j.netto,
                                    floor(bill.umum_db5j.kwanta) as satuan, 
                                    bill.umum_db5j.no_perk,
                                    bill.umum_db5j.jumlah,
                                    bill.umum_db5j.dokter,
                                    bill.umum_db5j.no_rel, 
                                    bill.umum_db5j.bangsal, 
                                    bill.umum_db5j.no_tran
                                from 
                                    bill.umum_db5j 
                                where 
                                    bill.umum_db5j.no_reg='$no_reg'
                                    and bill.umum_db5j.dokter = '$kd_dokter' 
                                    and bill.umum_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.umum_db5j.deleted is null 
                                ) a 
                            left join bill.umum_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Umum_db5j::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5j.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5j.kd_dr', $kd_dokter)->where('umum_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('umum_db5j.deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                array('umum_db5j.netto', DB::Raw('floor(umum_db5j.kwanta) as satuan'), 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.no_rel', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'umum_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Umum_db5j::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5j.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('umum_db5j.deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                array('umum_db5j.netto', DB::Raw('floor(umum_db5j.kwanta) as satuan'), 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.no_rel', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'umum_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 
                    $this->load->model('Umum_db5j_writer'); 
                    $db5j_writer = Umum_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'UMUM' :
                            $this->load->model('Umum_db5j'); 
                            $umum_db5j = Umum_db5j::leftJoin('sps_no_perk', function ($join) {
                                $join->on('umum_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                    array('umum_db5j.netto', 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'sps_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $umum_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            case 'UMUMRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "POLIKLINIK UMUM";
                $this->load->model('Umum_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Umum_db5::leftJoin('umum_no_perk', function ($join) {
                    $join->on('umum_db5.no_perk', '=', 'umum_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('umum_db5.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('umum_db5.deleted')->where('umum_db5.no_tran', '<>', '""')->get(
                        array('umum_db5.netto', 'umum_db5.no_perk', DB::Raw('floor(umum_db5.kwanta) as satuan'), 'umum_db5.jumlah', 'umum_db5.dokter', 'umum_db5.bangsal', 'umum_db5.no_tran', 'umum_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Umum_db5_writer'); 
                    $db5_writer = Umum_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            
            case 'UMUMRL' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Umum_db5l'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        /*
                        $db5j = Umum_db5l::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5l.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5l.kd_dr', $kd_dokter)->where('umum_db5l.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('umum_db5l.no_tran', '<>', '""')->get(
                                array('umum_db5l.netto', DB::Raw('floor(umum_db5l.kwanta) as satuan'), 'umum_db5l.no_perk', 'umum_db5l.jumlah', 'umum_db5l.dokter', 'umum_db5l.no_rel', 'umum_db5l.bangsal', 'umum_db5l.no_tran', 'umum_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.umum_db5l.netto,
                                    floor(bill.umum_db5l.kwanta) as satuan, 
                                    bill.umum_db5l.no_perk,
                                    bill.umum_db5l.jumlah,
                                    bill.umum_db5l.dokter,
                                    bill.umum_db5l.no_rel, 
                                    bill.umum_db5l.bangsal, 
                                    bill.umum_db5l.no_tran
                                from 
                                    bill.umum_db5l 
                                where 
                                    bill.umum_db5l.no_reg='$no_reg'
                                    and bill.umum_db5l.dokter = '$kd_dokter' 
                                    and bill.umum_db5l.no_tran = '$nota'
                                    and bill.umum_db5l.tgl_masuk = '$tgl_masuk'
                                    and bill.umum_db5l.deleted is null 
                                ) a 
                            left join bill.umum_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = umum_db5l::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5l.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5l.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('umum_db5l.no_tran', '<>', '""')->get(
                                array('umum_db5l.netto', DB::Raw('floor(umum_db5l.kwanta) as satuan'), 'umum_db5l.no_perk', 'umum_db5l.jumlah', 'umum_db5l.dokter', 'umum_db5l.no_rel', 'umum_db5l.bangsal', 'umum_db5l.no_tran', 'umum_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.umum_db5l.netto,
                                    floor(bill.umum_db5l.kwanta) as satuan, 
                                    bill.umum_db5l.no_perk,
                                    bill.umum_db5l.jumlah,
                                    bill.umum_db5l.dokter,
                                    bill.umum_db5l.no_rel, 
                                    bill.umum_db5l.bangsal, 
                                    bill.umum_db5l.no_tran
                                from 
                                    bill.umum_db5l 
                                where 
                                    bill.umum_db5l.no_reg='$no_reg'
                                    and bill.umum_db5l.dokter = '$kd_dokter' 
                                    and bill.umum_db5l.tgl_masuk = '$tgl_masuk'
                                    and bill.umum_db5l.deleted is null 
                                ) a 
                            left join bill.umum_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Umum_db5l::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5l.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5l.kd_dr', $kd_dokter)->where('umum_db5l.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('umum_db5l.deleted')->where('umum_db5l.no_tran', '<>', '""')->get(
                                array('umum_db5l.netto', DB::Raw('floor(umum_db5l.kwanta) as satuan'), 'umum_db5l.no_perk', 'umum_db5l.jumlah', 'umum_db5l.dokter', 'umum_db5l.no_rel', 'umum_db5l.bangsal', 'umum_db5l.no_tran', 'umum_no_perk.na_perk')
                            );
                    } else {
                        $db5j = umum_db5l::leftJoin('umum_no_perk', function ($join) {
                            $join->on('umum_db5l.no_perk', '=', 'umum_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('umum_db5l.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('umum_db5l.deleted')->where('umum_db5l.no_tran', '<>', '""')->get(
                                array('umum_db5l.netto', DB::Raw('floor(umum_db5l.kwanta) as satuan'), 'umum_db5l.no_perk', 'umum_db5l.jumlah', 'umum_db5l.dokter', 'umum_db5l.no_rel', 'umum_db5l.bangsal', 'umum_db5l.no_tran', 'umum_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 
                    $this->load->model('Umum_db5l_writer'); 
                    $db5j_writer = Umum_db5l_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'UMUM' :
                            $this->load->model('Umum_db5j'); 
                            $umum_db5j = Umum_db5j::leftJoin('sps_no_perk', function ($join) {
                                $join->on('umum_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('umum_db5j.no_tran', '<>', '""')->get(
                                    array('umum_db5j.netto', 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.dokter', 'umum_db5j.bangsal', 'umum_db5j.no_tran', 'sps_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $umum_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            
            case 'RHMDRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Rhmed_db5j'); 
                // echo $no_reg.":".$kd_dokter.":".$nota.":".$tgl_masuk;
                // die('c is here'.$nota.'s');
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        /*
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('rhmed_db5j.kd_dr', $kd_dokter)->where('rhmed_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('rhmed_db5j.no_tran', '<>', '""')->get(
                                array('rhmed_db5j.netto', DB::Raw('floor(rhmed_db5j.kwanta) as satuan'), 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.dokter', 'rhmed_db5j.no_rel',  'rhmed_db5j.bangsal', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                        */
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.rhmed_db5j.netto,
                                    floor(bill.rhmed_db5j.kwanta) as satuan, 
                                    bill.rhmed_db5j.no_perk,
                                    bill.rhmed_db5j.jumlah,
                                    bill.rhmed_db5j.dokter,
                                    bill.rhmed_db5j.no_rel, 
                                    bill.rhmed_db5j.bangsal, 
                                    bill.rhmed_db5j.no_tran
                                from 
                                    bill.rhmed_db5j 
                                where 
                                    bill.rhmed_db5j.no_reg='$no_reg'
                                    and bill.rhmed_db5j.no_tran = '$nota'
                                    and bill.rhmed_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.rhmed_db5j.deleted is null 
                                ) a 
                            left join bill.rhmed_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('rhmed_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('rhmed_db5j.no_tran', '<>', '""')->get(
                                array('rhmed_db5j.netto', DB::Raw('floor(rhmed_db5j.kwanta) as satuan'), 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.dokter', 'rhmed_db5j.no_rel', 'rhmed_db5j.bangsal', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.rhmed_db5j.netto,
                                    floor(bill.rhmed_db5j.kwanta) as satuan, 
                                    bill.rhmed_db5j.no_perk,
                                    bill.rhmed_db5j.jumlah,
                                    bill.rhmed_db5j.dokter,
                                    bill.rhmed_db5j.no_rel, 
                                    bill.rhmed_db5j.bangsal, 
                                    bill.rhmed_db5j.no_tran
                                from 
                                    bill.rhmed_db5j 
                                where 
                                    bill.rhmed_db5j.no_reg='$no_reg'
                                    and bill.rhmed_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.rhmed_db5j.deleted is null 
                                ) a 
                            left join bill.rhmed_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('rhmed_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('rhmed_db5j.deleted')->where('rhmed_db5j.no_tran', '<>', '""')->get(
                                array('rhmed_db5j.netto', DB::Raw('floor(rhmed_db5j.kwanta) as satuan'), 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.dokter', 'rhmed_db5j.no_rel',  'rhmed_db5j.bangsal', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('rhmed_db5j.deleted')->where('rhmed_db5j.no_tran', '<>', '""')->get(
                                array('rhmed_db5j.netto', DB::Raw('floor(rhmed_db5j.kwanta) as satuan'), 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.dokter', 'rhmed_db5j.no_rel', 'rhmed_db5j.bangsal', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 
                    $this->load->model('Rhmed_db5j_writer'); 
                    $db5j_writer = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        if (!empty($poli)) {
                            $poli = $poli->nama_poli; 
                        }
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                break; 
            case 'RHMDRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "POLIKLINIK REHAB MEDIK";
                $this->load->model('Rhmed_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Rhmed_db5::leftJoin('rhmed_no_perk', function ($join) {
                    $join->on('rhmed_db5.no_perk', '=', 'rhmed_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('rhmed_db5.deleted')->where('rhmed_db5.no_tran', '<>', '""')->get(
                        array('rhmed_db5.netto', 'rhmed_db5.no_perk', DB::Raw('floor(rhmed_db5.kwanta) as satuan'), 'rhmed_db5.jumlah', 'rhmed_db5.dokter', 'rhmed_db5.bangsal', 'rhmed_db5.no_tran', 'rhmed_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Rhmed_db5_writer'); 
                    $db5_writer = Rhmed_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            case 'CATHRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Poli   ";
                $txt_instalasi = "INSTALASI RAWAT JALAN";
                $this->load->model('Jantung_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.jantung_db5j.netto,
                                    floor(bill.jantung_db5j.kwanta) as satuan, 
                                    bill.jantung_db5j.no_perk,
                                    bill.jantung_db5j.jumlah,
                                    bill.jantung_db5j.dokter,
                                    bill.jantung_db5j.no_rel, 
                                    bill.jantung_db5j.bangsal, 
                                    bill.jantung_db5j.no_tran
                                from 
                                    bill.jantung_db5j 
                                where 
                                    bill.jantung_db5j.no_reg='$no_reg'
                                    and bill.jantung_db5j.dokter = '$kd_dokter' 
                                    and bill.jantung_db5j.no_tran = '$nota'
                                    and bill.jantung_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.jantung_db5j.deleted is null 
                                ) a 
                            left join bill.jantung_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Jantung_db5j::leftJoin('jantung_no_perk', function ($join) {
                            $join->on('jantung_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('jantung_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('jantung_db5j.no_tran', '<>', '""')->get(
                                array('jantung_db5j.netto', DB::Raw('floor(jantung_db5j.kwanta) as satuan'), 'jantung_db5j.no_perk', 'jantung_db5j.jumlah', 'jantung_db5j.dokter', 'jantung_db5j.no_rel', 'jantung_db5j.bangsal', 'jantung_db5j.no_tran', 'jantung_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.jantung_db5j.netto,
                                    floor(bill.jantung_db5j.kwanta) as satuan, 
                                    bill.jantung_db5j.no_perk,
                                    bill.jantung_db5j.jumlah,
                                    bill.jantung_db5j.dokter,
                                    bill.jantung_db5j.no_rel, 
                                    bill.jantung_db5j.bangsal, 
                                    bill.jantung_db5j.no_tran
                                from 
                                    bill.jantung_db5j 
                                where 
                                    bill.jantung_db5j.no_reg='$no_reg'
                                    and bill.jantung_db5j.dokter = '$kd_dokter' 
                                    and bill.jantung_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.jantung_db5j.deleted is null 
                                ) a 
                            left join bill.jantung_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                // echo json_encode($db5j); die();

                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Jantung_db5j::leftJoin('jantung_no_perk', function ($join) {
                            $join->on('jantung_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('jantung_db5j.dokter', $kd_dokter)->where('jantung_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('jantung_db5j.deleted')->where('jantung_db5j.no_tran', '<>', '""')->get(
                                array('jantung_db5j.netto', DB::Raw('floor(jantung_db5j.kwanta) as satuan'), 'jantung_db5j.no_perk', 'jantung_db5j.jumlah', 'jantung_db5j.dokter', 'jantung_db5j.no_rel', 'jantung_db5j.bangsal', 'jantung_db5j.no_tran', 'jantung_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Jantung_db5j::leftJoin('jantung_no_perk', function ($join) {
                            $join->on('jantung_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('jantung_db5j.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('jantung_db5j.deleted')->where('jantung_db5j.no_tran', '<>', '""')->get(
                                array('jantung_db5j.netto', DB::Raw('floor(jantung_db5j.kwanta) as satuan'), 'jantung_db5j.no_perk', 'jantung_db5j.jumlah', 'jantung_db5j.dokter', 'jantung_db5j.no_rel', 'jantung_db5j.bangsal', 'jantung_db5j.no_tran', 'jantung_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 

                    $this->load->model('Jantung_db5j_writer'); 
                    $db5j_writer = Jantung_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'GIGI' :
                            $this->load->model('Gigi_db5j'); 
                            $gigi_db5j = Gigi_db5j::leftJoin('jantung_no_perk', function ($join) {
                                $join->on('gigi_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                    array('gigi_db5j.netto', 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'jantung_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $gigi_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            case 'CATHRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "POLIKLINIK JANTUNG";
                $this->load->model('Jantung_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Jantung_db5::leftJoin('jantung_no_perk', function ($join) {
                    $join->on('jantung_db5.no_perk', '=', 'jantung_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('jantung_db5.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('jantung_db5.deleted')->where('jantung_db5.no_tran', '<>', '""')->get(
                        array('jantung_db5.netto', 'jantung_db5.no_perk', DB::Raw('floor(jantung_db5.kwanta) as satuan'), 'jantung_db5.jumlah', 'jantung_db5.dokter', 'jantung_db5.bangsal', 'jantung_db5.no_tran', 'jantung_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Jantung_db5_writer'); 
                    $db5_writer = Jantung_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            case 'HDRJ' : 
                $txt_rawat = "R.Jalan";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "HAEMODIALISA";
                $this->load->model('Hd_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.hd_db5j.netto,
                                    floor(bill.hd_db5j.kwanta) as satuan, 
                                    bill.hd_db5j.no_perk,
                                    bill.hd_db5j.jumlah,
                                    bill.hd_db5j.dokter,
                                    bill.hd_db5j.no_rel, 
                                    bill.hd_db5j.bangsal, 
                                    bill.hd_db5j.no_tran
                                from 
                                    bill.hd_db5j 
                                where 
                                    bill.hd_db5j.no_reg='$no_reg'
                                    and bill.hd_db5j.dokter = '$kd_dokter' 
                                    and bill.hd_db5j.no_tran = '$nota'
                                    and bill.hd_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.hd_db5j.deleted is null 
                                ) a 
                            left join bill.hd_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        /*
                        $db5j = Hd_db5j::leftJoin('hd_no_perk', function ($join) {
                            $join->on('hd_db5j.no_perk', '=', 'hd_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('hd_db5j.kd_dr', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->where('hd_db5j.no_tran', '<>', '""')->get(
                                array('hd_db5j.netto', DB::Raw('floor(hd_db5j.kwanta) as satuan'), 'hd_db5j.no_perk', 'hd_db5j.jumlah', 'hd_db5j.dokter', 'hd_db5j.no_rel', 'hd_db5j.bangsal', 'hd_db5j.no_tran', 'hd_no_perk.na_perk')
                            );
                        */

                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.hd_db5j.netto,
                                    floor(bill.hd_db5j.kwanta) as satuan, 
                                    bill.hd_db5j.no_perk,
                                    bill.hd_db5j.jumlah,
                                    bill.hd_db5j.dokter,
                                    bill.hd_db5j.no_rel, 
                                    bill.hd_db5j.bangsal, 
                                    bill.hd_db5j.no_tran
                                from 
                                    bill.hd_db5j 
                                where 
                                    bill.hd_db5j.no_reg='$no_reg'
                                    and bill.hd_db5j.dokter = '$kd_dokter' 
                                    and bill.hd_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.hd_db5j.deleted is null 
                                ) a 
                            left join bill.hd_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                // echo json_encode($db5j); die();

                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Hd_db5j::leftJoin('hd_no_perk', function ($join) {
                            $join->on('hd_db5j.no_perk', '=', 'hd_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('hd_db5j.dokter', $kd_dokter)->where('hd_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('hd_db5j.deleted')->where('hd_db5j.no_tran', '<>', '""')->get(
                                array('hd_db5j.netto', DB::Raw('floor(hd_db5j.kwanta) as satuan'), 'hd_db5j.no_perk', 'hd_db5j.jumlah', 'hd_db5j.dokter', 'hd_db5j.no_rel', 'hd_db5j.bangsal', 'hd_db5j.no_tran', 'hd_no_perk.na_perk')
                            );
                    } else {
                        $db5j = hd_db5j::leftJoin('hd_no_perk', function ($join) {
                            $join->on('hd_db5j.no_perk', '=', 'hd_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('hd_db5j.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereNull('hd_db5j.deleted')->where('hd_db5j.no_tran', '<>', '""')->get(
                                array('hd_db5j.netto', DB::Raw('floor(hd_db5j.kwanta) as satuan'), 'hd_db5j.no_perk', 'hd_db5j.jumlah', 'hd_db5j.dokter', 'hd_db5j.no_rel', 'hd_db5j.bangsal', 'hd_db5j.no_tran', 'hd_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 

                    $this->load->model('Hd_db5j_writer'); 
                    $db5j_writer = Hd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }

                /*
                $spm = Spm::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->orderBy('writed', 'asc')->first();
                if (!empty($spm)) {
                    $kd_dr = ""; 
                    $kd_poli = "";
                    switch ($spm->kode) {
                        case 'GIGI' :
                            $this->load->model('Hd_db5j'); 
                            $gigi_db5j = Hd_db5j::leftJoin('jantung_no_perk', function ($join) {
                                $join->on('gigi_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                                })->where('no_reg', $no_reg)->where('tgl_masuk', $spm->tgl_masuk)->where('jam_masuk', $spm->jam_masuk)->whereNull('deleted')->where('gigi_db5j.no_tran', '<>', '""')->get(
                                    array('gigi_db5j.netto', 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.dokter', 'gigi_db5j.bangsal', 'gigi_db5j.no_tran', 'jantung_no_perk.na_perk')
                                );
                            $jam_masuk = $spm->jam_masuk; 
                            $db5j = $gigi_db5j;
                        break; 
                    }
                    $jumlah = number_format($spm->jumlah);
                    $terbilang = strtolower(terbilang($spm->jumlah));
                    $tgl_spm = date("d-m-Y; H:i:s", strtotime($spm->tanggal." ".$spm->jam));
                    $writer = $spm->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    }
                    if (count($db5j) > 0) {
                        foreach ($db5j as $row) {
                            $kd_dr = $row->dokter;
                            $kd_poli = $row->bangsal;
                            $row->netto = number_format($row->netto);
                            $no_kwt = $row->no_tran;
                        }
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    }
                }
                */
                break; 
            case 'HDRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "INSTALASI HEMODIALISA";
                $this->load->model('Hd_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Hd_db5::leftJoin('hd_no_perk', function ($join) {
                    $join->on('hd_db5.no_perk', '=', 'hd_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('hd_db5.dokter', $kd_dokter)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('hd_db5.deleted')->where('hd_db5.no_tran', '<>', '""')->get(
                        array('hd_db5.netto', 'hd_db5.no_perk', DB::Raw('floor(hd_db5.kwanta) as satuan'), 'hd_db5.jumlah', 'hd_db5.dokter', 'hd_db5.bangsal', 'hd_db5.no_tran', 'hd_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Hd_db5_writer'); 
                    $db5_writer = Hd_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    /*
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    */
                    // $no_reg='0560968'; 
                    // $tanggal = '2020-08-12 12:45:00';
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            case 'UGDRJ' : 
                /*
                if ($no_reg == '0463121') {
                    $data = array(
                        "no_reg" => $no_reg,
                        "dokter" => $kd_dokter, 
                        "nota" => $nota, 
                        "tgl_masuk" => $tgl_masuk
                    );
                    var_dump($data);
                    die('chusnun');
                }
                */
                $txt_rawat = "R.Jalan";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "UGD";
                $this->load->model('Ugd_db5j'); 
                do {
                    usleep(1000);
                    if (!empty($nota)) {
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.ugd_db5j.netto,
                                    floor(bill.ugd_db5j.kwanta) as satuan, 
                                    bill.ugd_db5j.no_perk,
                                    bill.ugd_db5j.jumlah,
                                    bill.ugd_db5j.dokter,
                                    bill.ugd_db5j.no_rel, 
                                    bill.ugd_db5j.bangsal, 
                                    bill.ugd_db5j.no_tran
                                from 
                                    bill.ugd_db5j 
                                where 
                                    bill.ugd_db5j.no_reg='$no_reg'
                                    and bill.ugd_db5j.no_tran = '$nota'
                                    and bill.ugd_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.ugd_db5j.deleted is null 
                                ) a 
                            left join bill.ugd_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    } else {
                        $db5j = DB::select("
                            select 
                                a.*, 
                                b.na_perk
                            from (
                                select 
                                    bill.ugd_db5j.netto,
                                    floor(bill.ugd_db5j.kwanta) as satuan, 
                                    bill.ugd_db5j.no_perk,
                                    bill.ugd_db5j.jumlah,
                                    bill.ugd_db5j.dokter,
                                    bill.ugd_db5j.no_rel, 
                                    bill.ugd_db5j.bangsal, 
                                    bill.ugd_db5j.no_tran
                                from 
                                    bill.ugd_db5j 
                                where 
                                    bill.ugd_db5j.no_reg='$no_reg'
                                    and bill.ugd_db5j.tgl_masuk = '$tgl_masuk'
                                    and bill.ugd_db5j.deleted is null 
                                ) a 
                            left join bill.ugd_no_perk b 
                                on a.no_perk = b.no_perk  
                                ");
                    }
                } while (count($db5j) <= 0);
                // echo json_encode($db5j); die();

                if (count($db5j) > 0) {
                    usleep(3000);
                    if (!empty($nota)) {
                        $db5j = Ugd_db5j::leftJoin('ugd_no_perk', function ($join) {
                            $join->on('ugd_db5j.no_perk', '=', 'ugd_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('ugd_db5j.no_tran', $nota)->where('tgl_masuk', $tgl_masuk)->whereNull('ugd_db5j.deleted')->where('ugd_db5j.no_tran', '<>', '""')->get(
                                array('ugd_db5j.netto', DB::Raw('floor(ugd_db5j.kwanta) as satuan'), 'ugd_db5j.no_perk', 'ugd_db5j.jumlah', 'ugd_db5j.dokter', 'ugd_db5j.no_rel', 'ugd_db5j.bangsal', 'ugd_db5j.no_tran', 'ugd_no_perk.na_perk')
                            );
                    } else {
                        $db5j = Ugd_db5j::leftJoin('ugd_no_perk', function ($join) {
                            $join->on('ugd_db5j.no_perk', '=', 'ugd_no_perk.no_perk');
                            })->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereNull('ugd_db5j.deleted')->where('ugd_db5j.no_tran', '<>', '""')->get(
                                array('ugd_db5j.netto', DB::Raw('floor(ugd_db5j.kwanta) as satuan'), 'ugd_db5j.no_perk', 'ugd_db5j.jumlah', 'ugd_db5j.dokter', 'ugd_db5j.no_rel', 'ugd_db5j.bangsal', 'ugd_db5j.no_tran', 'ugd_no_perk.na_perk')
                            );
                    }
                    $db5 = $db5j; 

                    $this->load->model('Ugd_db5j_writer'); 
                    $db5j_writer = Ugd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    if (!empty($db5j_writer)) {
                        $writer = $db5j_writer->writer; 
                        $writed = $db5j_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5j as $row) {
                        $kd_dr = $row->dokter;
                        $kode_asuransi = $row->no_rel;
                        $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->kwanta;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }
                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    if ($kode_asuransi != '') {
                        $asuransi = Asuransi::find($kode_asuransi); 
                        $nama_asuransi = $asuransi->NAMA;
                    }
                    if ($kd_poli != '') {
                        $poli = Poli::find($kd_poli);
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Poli::find($sel_poli);
                        $poli = $poli->nama_poli; 
                    }
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
            case 'UGDRI' : 
                $txt_rawat = "R.Inap"; 
                // $txt_poli = "Bangsal";
                $txt_poli = "Ruang  ";
                $txt_instalasi = "UGD";
                $this->load->model('Ugd_db5'); 
                $this->load->model('Bangsal'); 
                $this->load->model('Bgs_register'); 
                $this->load->model('Inap'); 
                $db5 = Ugd_db5::leftJoin('ugd_no_perk', function ($join) {
                    $join->on('ugd_db5.no_perk', '=', 'ugd_no_perk.no_perk');
                    })->where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('ugd_db5.deleted')->where('ugd_db5.no_tran', '<>', '""')->get(
                        array('ugd_db5.netto', 'ugd_db5.no_perk', DB::Raw('floor(ugd_db5.kwanta) as satuan'), 'ugd_db5.jumlah', 'ugd_db5.dokter', 'ugd_db5.bangsal', 'ugd_db5.no_tran', 'ugd_no_perk.na_perk')
                    );
                $db5 = $db5; 
                if (count($db5) > 0) {
                    $this->load->model('Ugd_db5_writer'); 
                    $db5_writer = Ugd_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->whereRaw("LEFT(jam_masuk, 5) = '$jam_masuk'")->whereNull('deleted')->orderBy('id', 'desc')->first(array('writer', 'writed'));
                    $writer = ""; 
                    $writed = ""; 
                    $perawat = ""; 
                    $tanggal = "";
                    if (!empty($db5_writer)) {
                        $writer = $db5_writer->writer; 
                        $writed = $db5_writer->writed; 
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    } else {
                        $sess = sess_on('auth');
                        if (isset($sess->sessid)) {
                            $writer = $sess->user_id;
                        }
                        if (!empty($writer)) {
                            $perawat = Perawat::where('user_id', $writer)->first();
                            if (empty($perawat)) {
                                $nik = User::find($writer);
                                $karyawan = Karyawan::find($nik->user);
                                $petugas = $karyawan->nama;
                            } else {
                                $petugas = $perawat->nama;
                            }
                        }
                    }
                    $total = 0; 
                    $kd_dr = ""; 
                    $kd_poli = ""; 
                    $no_kwt = ""; 
                    $kode_asuransi = ""; 
                    $nama_asuransi = "";
                    foreach ($db5 as $row) {
                        $kd_dr = $row->dokter;
                        // $kd_poli = $row->bangsal;
                        $total = $total + $row->netto;
                        $satuan = $row->satuan;
                        $row->netto = number_format($row->netto);
                        $no_kwt = $row->no_tran;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $tanggal = date("Y-m-d H:i:s", strtotime($row->tanggal." ".$row->jam));
                    }

                    if ($kd_dr != '') {
                        $dokter = Dokter::find($kd_dr); 
                        $dokter = $dokter->nama2;
                    }
                    $bgs_register = Bgs_register::select(array('kd_bangsal'))->where('no_reg', $no_reg)->whereRaw("(('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_pinke) or ('$tanggal' >= concat(tgl_daftar, ' ', jam_masuk) and '$tanggal' <= tgl_keluar))")->groupBy('kd_bangsal', 'no_reg')->orderBy('id', 'asc')->first();
                    if (!empty($bgs_register)) {
                        $kd_bangsal = $bgs_register->kd_bangsal;
                        $bangsal = Bangsal::find($kd_bangsal);
                        $poli = $bangsal->nama_pendaftaran." / ".$bgs_register->no_bed;
                    } else {
                        $inap = Inap::select(array('kd_bangsal', 'no_bed'))->where('no_reg', $no_reg)->first();
                        if (!empty($inap)) {
                            $kd_bangsal = $inap->kd_bangsal; 
                            $bangsal = Bangsal::find($kd_bangsal);
                            $poli = $bangsal->nama_pendaftaran." / ".$inap->no_bed;
                        }
                    }
                    // $poli = $kd_poli;
                    $jumlah = number_format($total);
                    $terbilang = strtolower(terbilang($total));
                }
                break; 
        }
        

        $data = array(
            'no_reg' => $no_reg,
            'nota' => $nota, 
            'nama' => $pasien->nama,
            'alamat' => $pasien->alamat,
            'dokter' => $dokter,
            'poli' => $poli,
            'tgl_masuk' => $tgl_masuk,
            'jam_masuk' => $jam_masuk,
            'tgl_spm' => $tgl_spm,
            'transaksi' => $db5,
            'total' => $total,
            'jumlah' => $jumlah,
            'no_transaksi' => $no_kwt,
            'terbilang' => $terbilang,
            'petugas' => $petugas, 
            'txt_poli' => $txt_poli,
            'txt_rawat' => $txt_rawat,
            'txt_instalasi' => $txt_instalasi,
            'kode_asuransi' => $kode_asuransi,
            'nama_asuransi' => $nama_asuransi,
        );
        if (!empty(segment(3))&&(segment(3)=='bill_bon_kasir' || segment(3)=='bill_bhp_kasir')) {
            return $data;
        } else {
            echo json_encode($data); die();        
        }
    }

    function bill_bon_kasir() {

        $this->load->model('Bon');
        $this->load->helper('post_print_kasir'); 
        $nip = $this->input->post('nip');
        $bill  = $this->input->post('bill');
        $karyawan = collect(\DB::select("
            SELECT a.nama, a.nik, a.unit, b.nm_unit
            FROM 
                sdm.karya a 
                LEFT JOIN sdm.unit b 
                ON a.unit = b.no_unit
            WHERE nik='$nip'
        "))->first();
        $data = (array) null;
        $sdm_nama = ""; 
        $sdm_unit = "";
        if (!empty($karyawan)) {
            $karyawan = (object) $karyawan;
            $sdm_nama = $karyawan->nama;
            $sdm_unit = $karyawan->unit;
        }
        $result_bill = $this->bill();
        $result_bill['kode_asuransi'] = $nip;
        $result_bill['nama_asuransi'] = $sdm_nama;

        $writed = date("Y-m-d H:i:s"); 
        $writer = "";
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        $bon = Bon::where('no_reg', $result_bill['no_reg'])->where('tgl_masuk', $result_bill['tgl_masuk'])->where('no_tran', $result_bill['no_transaksi'])->where('bill', $bill)->first(array('id'));
        // var_dump($bon); die();
        if (!empty($bon)) {
            $bon = Bon::where('id', $bon->id)
                ->update(
                    array(
                        'deleted'    => $writed, 
                        'deleter'    => $writer,
                        )
                    );
        }
        $bon = new Bon;
        $bon->bill = $bill; 
        $bon->no_tran = $result_bill['no_transaksi']; 
        $bon->no_reg = $result_bill['no_reg'];
        $bon->tgl_masuk = $result_bill['tgl_masuk'];
        $bon->jam_masuk = $result_bill['jam_masuk']; 
        $bon->nip = $nip;
        $bon->nominal = $result_bill['total'];    
        $bon->writed = $writed;    
        $bon->writer = $writer;    
        DB::transaction(function () use ($bon) {
            $bon->save();
        });
        $data = json_encode($result_bill); 
        // $result_bill = json_encode(json_decode($result_bill), true);
        // if ($result_bill['no_reg'] == '0000001') {
        //     $result_print = ""; 
        // } else {
            $result_print = post_print_kasir($data);
        // }
        $data = array(
            "status" => "OK"
        );
        // echo json_encode($data); die();      
    }

    function bill_bhp_kasir() {

        // $this->load->model('Bon');
        $this->load->helper('post_print_bhp_kasir'); 
        // $nip = $this->input->post('nip');
        $bill  = $this->input->post('bill');
        /*
        $karyawan = collect(\DB::select("
            SELECT a.nama, a.nik, a.unit, b.nm_unit
            FROM 
                sdm.karya a 
                LEFT JOIN sdm.unit b 
                ON a.unit = b.no_unit
            WHERE nik='$nip'
        "))->first();
        */
        $data = (array) null;
        $sdm_nama = ""; 
        $sdm_unit = "";
        /*
        if (!empty($karyawan)) {
            $karyawan = (object) $karyawan;
            $sdm_nama = $karyawan->nama;
            $sdm_unit = $karyawan->unit;
        }
        */
        $result_bill = $this->bill();
        /*
        $result_bill['kode_asuransi'] = $nip;
        $result_bill['nama_asuransi'] = $sdm_nama;
        */
        $writed = date("Y-m-d H:i:s"); 
        $writer = "";
        $sess = sess_on('auth');
        if (isset($sess->sessid)) {
            $writer = $sess->user_id;
        }
        /*
        $bon = Bon::where('no_reg', $result_bill['no_reg'])->where('tgl_masuk', $result_bill['tgl_masuk'])->where('no_tran', $result_bill['no_transaksi'])->where('bill', $bill)->first(array('id'));
        // var_dump($bon); die();
        if (!empty($bon)) {
            $bon = Bon::where('id', $bon->id)
                ->update(
                    array(
                        'deleted'    => $writed, 
                        'deleter'    => $writer,
                        )
                    );
        }
        $bon = new Bon;
        $bon->bill = $bill; 
        $bon->no_tran = $result_bill['no_transaksi']; 
        $bon->no_reg = $result_bill['no_reg'];
        $bon->tgl_masuk = $result_bill['tgl_masuk'];
        $bon->jam_masuk = $result_bill['jam_masuk']; 
        $bon->nip = $nip;
        $bon->nominal = $result_bill['total'];    
        $bon->writed = $writed;    
        $bon->writer = $writer;    
        DB::transaction(function () use ($bon) {
            $bon->save();
        });
        */
        $data = json_encode($result_bill); 
        // $result_bill = json_encode(json_decode($result_bill), true);
        $result_print = post_print_bhp_kasir($data);
        $data = array(
            "status" => "OK"
        );
        // echo json_encode($data); die();      
    }
    
    function label_stiker() {
        $no_reg  = $this->input->post('no_reg');
        $query = "
        SELECT 
            a.no_reg, a.nama, a.alamat, a.no_id, a.umur, date(a.tgl_lahir) as tgl_lahir, b.NAMA as asuransi
        FROM 
            rsiklaten.pasien a 
            LEFT JOIN rsiklaten.asuransi b 
            ON a.pasien = b.NO_REL
        WHERE 
            a.no_reg = '$no_reg' 
        "; 
        // $pasien = Pasien::find($no_reg);
        $pasien = DB::select($query);
        $data = (array) null;
        if (!empty($pasien)) {
            $data = (array) collect($pasien)->first();
            $data['lahir'] = date("d-m-Y", strtotime($data['tgl_lahir']));
        } 
        echo json_encode($data); die();
    }
}
