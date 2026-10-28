<?php

//——  Variables ——
$my_report = REPORT."resep.rpt";  //This must be the full path to the file
$my_pdf = "MyReport.pdf";

//—— Create a new COM Object of Crytal Reports 10 ——
$ObjectFactory = new COM("CrystalReports10.ObjectFactory.1");

//—— Create a instance of library Application ——-
$crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application.10");

//—— Open your rpt file ——
$creport = $crapp->OpenReport($my_report, 1);

//—— Set database logon info ——
$creport->Database->Tables(1)->SetLogOnInfo("MYSERVER", "Database", "user", "password");

//—— Suppress the Parameter field prompt or else report will hang ——
$creport->EnableParameterPrompting = 0;

//—— DiscardSavedData make a Refresh in your data ——-
$creport->DiscardSavedData;
$creport->ReadRecords();

//—— Pass formula fields ——–
$creport->FormulaFields->Item(1)->Text = ("My Report Title");
$creport->ParameterFields(1)->AddCurrentValue ("FirstParameter");
$creport->ParameterFields(2)->AddCurrentValue (2000);

//—— Export to PDF ——-
$creport->ExportOptions->DiskFileName=$my_pdf;
$creport->ExportOptions->FormatType=31;
$creport->ExportOptions->DestinationType=1;
$creport->Export(false);

//—— Release the variables ——
$creport = null;
$crapp = null;
$ObjectFactory = null;

//—— Embed the report in the webpage ——
print "";

?>