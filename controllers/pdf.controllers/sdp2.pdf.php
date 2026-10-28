<?php 
ini_set('memory_limit', '512M');
$format_baru = true;
$lp_print = false;
$pdf_type = "I";
$ipclient = ""; 
$printer = ""; 
$halaman = "";
$halamanx = "";
switch ((string) segment(6)) {
    case 'PRINT' : 
    case 'print' : 
        $pdf_type = "F";
        $lp_print = true;
        break; 
    case 'FILE' : 
        $pdf_type = "F";
        $lp_print = false;
        break; 
    case 'FILECLIENT' : 
        $pdf_type = "F";
        $lp_print = false;
        $ipclient = (string) segment(7);
        break; 
    case 'PRINTSERVER' : 
        $pdf_type = "F";
        $lp_print = true;
        $printer = (string) segment(7);
        break; 
    case 'PRINTSERVER1' : 
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break; 
     case 'PRINTSERVER2' : 
        $pdf_type = "F";
        $lp_print = true;
        $halaman = 1;
        $printer = (string) segment(7);
        break; 
}
        $this->load->model('Mutasi_ri');
        $this->load->model('Pasien');
        $this->load->model('Agama');
        $this->load->model('Perkawinan');
        $this->load->model('Pendidikan');
        $this->load->model('Pekerjaan');
        $this->load->model('Rujuk');
        $this->load->model('Perujuk');
        $this->load->model('Kunjung');
        $this->load->model('Asuransi');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $this->load->model('Karyawan');
        $this->load->model('Karya');
        $this->load->model('Dokter');

        $this->load->model('rme/Cppt');
        $this->load->model('rme/Bill_byl');
        $no_reg = segment(4);
        $tgl_rs = segment(5); 
        if ((string) $tgl_rs == "") {
            $tgl_rs = date("YmdHis");
        }
        $tgl_masuk = substr($tgl_rs, 0, 4)."-".substr($tgl_rs, 4, 2)."-".substr($tgl_rs, 6, 2);
        $jam_masuk = substr($tgl_rs, 8, 2).":".substr($tgl_rs, 10, 2).":".substr($tgl_rs, 12, 2);
        $row_mutasi_ri = null; 
        $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)
                            ->where('tgl_masuk', $tgl_masuk)
                            ->whereNull('deleted')
                            ->whereRaw(DB::RAW("LEFT(jam_masuk, 5) = LEFT('$jam_masuk', 5)"))
                            ->orderBy('id', 'DESC')
                            ->first();
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->whereRaw("tgl_masuk='$tgl_masuk'")->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        if (empty($row_mutasi_ri)) {
            $row_mutasi_ri = Mutasi_ri::where('no_reg', $no_reg)->whereRaw("tgl_masuk=date_add('$tgl_masuk', interval -1 day)")->whereNull('deleted')->orderBy('id', 'DESC')->first();
        }
        $nama = ''; 
        $nik = ''; 
        $alamat = ''; 
        $umur = ''; 
        $tgl_lahir = ''; 
        $jenis_kel = ''; 
        $telp = ''; 
        $agama = ''; 
        $kawin = ''; 
        $didik = ''; 
        $kerja = ''; 
        $rujuk = ''; 
        $kunjung = 'LAMA'; 
        $asuransi = ''; 
        $asal = ''; 
        $str_tgl_masuk = ''; 
        $bangsal = ''; 
        $nama_petugas = ''; 
        $pasien = null; 
        $pasien = Pasien::find($no_reg);
        if (!empty($pasien)) {
            $nama = $pasien->nama; 
            $nik = $pasien->no_id; 
            $tgl_lahir = $pasien->tgl_lahir; 
            $alamat = $pasien->alamat;
            switch ($pasien->jenis_kel) {
                case '1' : 
                case 1 : 
                case 'L' : 
                    $jenis_kel = 'LAKI-LAKI'; 
                    break; 
                case '2' : 
                case 2 : 
                case 'P' : 
                    $jenis_kel = 'PEREMPUAN'; 
                    break; 
            }
            $telp = $pasien->telp;
            if (!empty($pasien->telp2)) {
                $telp .= '/'.$pasien->telp2; 
            } 
            $row_agama = Agama::where('kd_agama', $pasien->agama)->first(); 
            if (!empty($row_agama)) {
                $agama = strtoupper($row_agama->agama);
            }
            $row_kawin = Perkawinan::where('kd_perkawinan', $pasien->kawin)->first(); 
            if (!empty($row_kawin)) {
                $kawin = strtoupper($row_kawin->nama_perkawinan);
            }
            $row_didik = Pendidikan::where('kd_pendidikan', $pasien->didik)->first(); 
            if (!empty($row_didik)) {
                $didik = strtoupper($row_didik->pendidikan);
            }
            $row_kerja = Pekerjaan::where('kd_pekerjaan', $pasien->pekerjaan)->first(); 
            if (!empty($row_kerja)) {
                $kerja = strtoupper($row_kerja->pekerjaan);
            }
        } 
        include('warning.pdf.php');
        $row_perujuk = Perujuk::where('no_reg', $no_reg)->where('tgl_masuk', $tgl_masuk)->where('deletedstate', '0')->orderBy('id', 'DESC')->first();
        if (!empty($row_perujuk)) {
            $rujuk = $row_perujuk->alamat;
        }
        $row_kunjung = Kunjung::where('no_reg', $no_reg)->where('tanggal', $tgl_masuk)->orderBy('id', 'ASC')->first();
        if (!empty($row_kunjung)) {
            switch($row_kunjung->kunjung) {
                case 'B' : 
                    $kunjung = 'BARU'; 
                    break; 
            }
        }
        if (!empty($row_mutasi_ri->asuransi)) {
            $row_asuransi = Asuransi::where('NO_REL', $row_mutasi_ri->asuransi)->first();
            if (!empty($row_asuransi->NAMA)) {
                $asuransi = $row_asuransi->NAMA;
            }
        }
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->asal)) {
            $row_poli = Poli::where('kode_poli', $row_mutasi_ri->asal)->first();
            if (!empty($row_poli->nama_poli)) {
                $asal = $row_poli->nama_poli;
            }
        }
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $str_tgl_masuk = $row_mutasi_ri->tgl_masuk." Jam : ". str_replace(":", ".", substr($jam_masuk, 0, 5));
        }
        if (!empty($row_mutasi_ri->bangsal)) {
            $row_bangsal = Bangsal::where('kd_bangsal', $row_mutasi_ri->bangsal)->first();
            if (!empty($row_bangsal->nama_pendaftaran)) {
                $bangsal = $row_bangsal->nama_pendaftaran;
            }
        }
        if (!empty($row_mutasi_ri->petugas)) {
            $row_karyawan = Karya::where('nik', $row_mutasi_ri->petugas)->first();
            if (!empty($row_karyawan->nama)) {
                $nama_petugas = $row_karyawan->nama;
            }
        }

        $dokterArray=[];
        // if ($no_reg=='0664049') pre($row_mutasi_ri);

        if (!empty($row_mutasi_ri->kd_dr_ri1)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri1)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri1 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri2)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri2)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri3)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri3)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri4)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri4)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        if (!empty($row_mutasi_ri->kd_dr_ri5)) {
            $row_dokter = Dokter::where('no_dr', $row_mutasi_ri->kd_dr_ri5)->first(array('nama2'));
            if (!empty($row_dokter->nama2)) {
                // $row_mutasi_ri->nm_dr_ri2 = $row_dokter->nama2;
                array_push($dokterArray,$row_dokter->nama2);
            }
        }
        $row_mutasi_ri->dokterArray=$dokterArray;
        

        if (empty($row_mutasi_ri)) {
            $kunjung = "";
        } 
        $tgl_masuk = $tgl_masuk; 
        $tgl_keluar = date("Y-m-d"); 
        $query = "select * from rsiklaten.bgs_register where no_reg='$no_reg' and tgl_daftar='$tgl_masuk' and kd_bangsal is not null";
        $rows_bgs_register = DB::select($query); 
        if (!empty($rows_bgs_register)) {
            foreach ($rows_bgs_register as $row_bgs_register) {
                $row_bgs_register = (object) $row_bgs_register; 
                switch ($row_bgs_register->status_pulang) {
                    case 1 : 
                    case '1' : 
                        $tgl_keluar = date("Y-m-d", strtotime($row_bgs_register->tgl_keluar));
                        break; 
                }
            }
        } 
        if ($no_reg=="") {
            $tgl_masuk  = date("Y-m-d");
            $tgl_keluar = date("Y-m-d");
        }

        if ($tgl_keluar == '1970-01-01'){
            $tgl_keluar = date("Y-m-d");
        }
        


        // $query = "
        // SELECT 
        //     aa.kd_dr, aa.tanggal, aa.jam, ab.nama2 as nama, aa.trbgs, aa.freepkt, aa.no_perk 
        // FROM 
        //     ( 
        //     SELECT 
        //         * 
        //     FROM (
        //         SELECT * FROM bill.rarofah_db5
        //         UNION ALL SELECT * FROM bill.rbedah_db5
        //         UNION ALL SELECT * FROM bill.ricu_db5 
        //         UNION ALL SELECT * FROM bill.rimc_db5
        //         UNION ALL SELECT * FROM bill.risolasi_db5
        //         UNION ALL SELECT * FROM bill.rjblnur_db5
        //         UNION ALL SELECT * FROM bill.rmarwah_db5
        //         UNION ALL SELECT * FROM bill.rmina_db5
        //         UNION ALL SELECT * FROM bill.rmtz_db5
        //         UNION ALL SELECT * FROM bill.rnamiroh_db5
        //         UNION ALL SELECT * FROM bill.rpicu_db5
        //         UNION ALL SELECT * FROM bill.rshofa_db5
        //         UNION ALL SELECT * FROM bill.rsiti_h_db5
        //         UNION ALL SELECT * FROM bill.rvip_db5
        //         UNION ALL SELECT * FROM bill.rvk_db5
        //         UNION ALL SELECT * FROM bill.rzam2_db5
        //         UNION ALL SELECT * FROM bill.rzam_db5            
        //         ) a 
        //     WHERE 
        //         a.no_reg = '$no_reg'
        //         AND a.deleted IS NULL 
        //         AND a.tanggal BETWEEN '$tgl_masuk' AND '$tgl_keluar'
        //         ORDER BY a.tanggal ASC, a.jam ASC
        //     ) aa
        //     LEFT JOIN rsiklaten.dokter ab
        //         ON aa.kd_dr = ab.no_dr 
        // ";

        //inisiasi data visite 
     

        // pre($tgl_visite);
    $billings = Bill_byl::where(function ($q) {
        $q->where('eklaim_kd', 'VIS')
          ->orWhereIn('no_perk', ['4171010','5171010']);
    })
    ->where('tanggal', '>=', $tgl_masuk)
    ->where('tanggal', '<=', $tgl_keluar)
    ->where('deleted', '0')
    ->get()
    ->groupBy(function ($b) {
        return $b->dokter . '|' . $b->tanggal . '|' . $b->no_reg ;
    });
    // ->groupBy(fn($b) => $b->dokter.'|'.$b->tanggal);



// $query = "select cr.no_reg , cr.ppa as kd_dr, cr.form, cr.registered, dr.nama2 as nama , dr.bagian from rme.cppt_ri cr 
// left join rsiklaten.dokter dr on dr.no_dr=cr.ppa  
// where cr.no_reg ='$no_reg' and date(registered)  BETWEEN '$tgl_masuk' AND '$tgl_keluar' and cr.ppa like 'S%' and cr.form <>'daily' and cr.deleted is null and dr.sps not in ('UMUM','GIGI','GIZI','APT')";
//         $rows_bill = DB::select($query); 
//         $rows_visit = (array) null; 
//         if (!empty($rows_bill)) {
//             foreach ($rows_bill as $row_bill) {
//                 $row_bill = (object) $row_bill; 
//                 switch ($row_bill->kd_dr) {
//                     case NULL : 
//                     case '' :
//                         break; 
//                     default : 
//                         $rows_visit[] = $row_bill;
//                         break;
//                 }
//             }
//         } 
$query = "select * from (select si.no_reg , u.user as kd_dr, 'Awal' as form,si.writed as registered,date(si.writed) as tgl_cppt,dr.nama2 as nama,
dr.bagian
from rme.soap_inap si 
left join rsiklaten.user u on u.id = si.writer 
left join rsiklaten.dokter dr on dr.no_dr = u.user
where si.resume<>'1' and u.user = si.dpjp1 and si.deleted is null and si.no_reg ='$no_reg' and date(si.writed) between '$tgl_masuk' and '$tgl_keluar' or si.resume<>'1' and u.user = si.dpjp2 and si.deleted is null and si.no_reg ='$no_reg' and date(si.writed) between '$tgl_masuk' and '$tgl_keluar'
union all
select 
    cr.no_reg,
    cr.ppa as kd_dr,
    'cppt' as form,
    cr.registered,
    DATE(cr.registered) as tgl_cppt,
    dr.nama2 as nama,
    dr.bagian
  from rme.cppt_ri cr 
  left join rsiklaten.dokter dr on dr.no_dr = cr.ppa  
  where cr.no_reg ='$no_reg'
and date(registered) BETWEEN '$tgl_masuk' and '$tgl_keluar'
and cr.ppa like 'S%'
and cr.form <> 'daily'
and cr.deleted is null
and dr.sps not in ('UMUM','GIGI','GIZI','APT')
union all 
select abn.no_reg, u.user as kd_dr,'Pra Bedah' as form ,abn.bedah_writed as registered,date(abn.bedah_writed) as tgl_cppt,dr.nama2, dr.bagian from rme.operasi_asesmen_pra_anastesi abn 
left join rsiklaten.user u on u.id = abn.bedah_writer 
left join rsiklaten.dokter dr on dr.no_dr = u.user
where abn.no_reg ='$no_reg' and date(abn.bedah_writed) between '$tgl_masuk' and '$tgl_keluar' and abn.deleted is null 
union all 
select abn.no_reg, u.user as kd_dr,'Pra Anes' as form ,abn.anes_writed as registered, date(abn.anes_writed) as tgl_cppt,dr.nama2, dr.bagian from rme.operasi_asesmen_pra_anastesi abn 
left join rsiklaten.user u on u.id = abn.anes_writer 
left join rsiklaten.dokter dr on dr.no_dr = u.user
where abn.no_reg ='$no_reg' and date(abn.anes_writed) between '$tgl_masuk' and '$tgl_keluar' and abn.deleted is null
) as bill group by bill.kd_dr, bill.tgl_cppt";


$rows_bill  = DB::select($query);
// pre($query);
$rows_visit = [];

if (!empty($rows_bill)) {
    foreach ($rows_bill as $row_bill) {

        $row_bill = (object) $row_bill;

        if (empty($row_bill->kd_dr)) {
            continue;
        }

        //  KEY SAMA DENGAN groupBy BILLING
        $key = $row_bill->kd_dr . '|' . $row_bill->tgl_cppt  . '|' . $row_bill->no_reg  ;

        //  AMBIL BILLING (JIKA ADA)
        $billing = isset($billings[$key]) ? $billings[$key][0] : null;

        //  TEMPEL KE OBJECT CPPT
        $row_bill->billing_ada = $billing ? 'Sudah' : 'Belum';
        $row_bill->no_bill     = $billing->id ?? null;
        $row_bill->tarif       = $billing->js_dokter1 ?? 0;

        $rows_visit[] = $row_bill;
    }
}

    
       
        // pre($bill_b);

        $query = "select cr.no_reg , cr.ppa as kd_dr, cr.form, cr.registered, dr.nama2 as nama , dr.bagian from rme.cppt_ri cr 
        left join rsiklaten.dokter dr on dr.no_dr=cr.ppa  
        where cr.no_reg ='$no_reg' and date(registered)  BETWEEN '$tgl_masuk' AND '$tgl_keluar' and cr.ppa like 'S%' and cr.form <>'daily' and cr.deleted is null and dr.bagian in ('GIZI','APOTEKER') ";
        $rows_bill3 = DB::select($query); 
        $rows_visit3 = (array) null; 
        if (!empty($rows_bill3)) {
            foreach ($rows_bill3 as $row_bill3) {
                $row_bill3 = (object) $row_bill3; 
                switch ($row_bill3->kd_dr) {
                    case NULL : 
                    case '' :
                        break; 
                    default : 
                        $rows_visit3[] = $row_bill3;
                        break;
                }
            }
        } 
        // pre($rows_visit3);

        // $query = "select cr.no_reg , cr.ppa as kd_dr, cr.form, cr.registered, dr.nama2 as nama , dr.bagian from rme.cppt_ri cr 
        // left join rsiklaten.dokter dr on dr.no_dr=cr.ppa  
        // where cr.no_reg ='$no_reg' and date(registered)  BETWEEN '$tgl_masuk' AND '$tgl_keluar' and cr.ppa like 'S%' and cr.form <>'daily' and cr.deleted is null and dr.sps in ('UMUM','GIGI') 
 
        // ";
        // $rows_bill2 = DB::select($query); 
        // $rows_visit2 = (array) null; 
        // if (!empty($rows_bill2)) {
        //     foreach ($rows_bill2 as $row_bill2) {
        //         $row_bill2 = (object) $row_bill2; 
        //         switch ($row_bill2->kd_dr) {
        //             case NULL : 
        //             case '' :
        //                 break; 
        //             default : 
        //                 $rows_visit2[] = $row_bill2;
        //                 break;
        //         }
        //     }
        // } 
        // pre($rows_visite); 
        $query2 = "select 
            cr.no_reg,
            cr.ppa as kd_dr,
            cr.form,
            cr.registered,
            DATE(cr.registered) as tgl_cppt,
            dr.nama2 as nama,
            dr.bagian
          from rme.cppt_ri cr 
          left join rsiklaten.dokter dr on dr.no_dr = cr.ppa  
          where cr.no_reg ='$no_reg'
            and date(registered) BETWEEN '$tgl_masuk' AND '$tgl_keluar'
            and cr.ppa like 'S%'
            and cr.form <> 'daily'
            and cr.deleted is null
            and dr.sps in ('UMUM','GIGI')
            group by cr.ppa, date(cr.registered)";

            $rows_bill2  = DB::select($query2);
            $rows_visit2 = [];

            if (!empty($rows_bill2)) {
        foreach ($rows_bill2 as $row_bill2) {

        $row_bill2 = (object) $row_bill2;

        if (empty($row_bill2->kd_dr)) {
            continue;
        }

        //  KEY SAMA DENGAN groupBy BILLING
        $key = $row_bill2->kd_dr . '|' . $row_bill2->tgl_cppt  . '|' . $row_bill2->no_reg  ;

        //  AMBIL BILLING (JIKA ADA)
        $billing = isset($billings[$key]) ? $billings[$key][0] : null;

        //  TEMPEL KE OBJECT CPPT
        $row_bill2->billing_ada = $billing ? 'Sudah' : 'Belum';
        $row_bill2->no_bill     = $billing->id ?? null;
        $row_bill2->tarif       = $billing->jumlah ?? 0;

        $rows_visit2[] = $row_bill2;
         }
        }

        $query4 ="select tr.no_reg, tr.tanggal,tr.kwanta , tr.jumlah, mt.na_perk, tr.no_perk, tr.registered from billing.transaksi_rsik tr 
        left join billing.master_tarip_inap_2026 mt on mt.no_perk = tr.no_perk 
        where tr.no_reg ='$no_reg' and tr.tanggal BETWEEN '$tgl_masuk' and '$tgl_keluar' and (mt.na_perk like '%O2%' or mt.na_perk like '%VENTI%') and tr.deleted='0'";
        $rows_bill4 = DB::connection('billing_byl')->select($query4); 
                $rows_visit4 = (array) null; 
        if (!empty($rows_bill4)) {
            foreach ($rows_bill4 as $row_bill4) {
                $row_bill4 = (object) $row_bill4; 
                switch ($row_bill4->no_perk) {
                    case NULL : 
                    case '' :
                        break; 
                    default : 
                        $rows_visit4[] = $row_bill4;
                        break;
                }
            }
            // if (ipclient()=='172.16.18.89') pre($rows_bill4);
        }

        $query5 ="select tr.no_reg, tr.tanggal,d.nama, tr.kwanta , tr.jumlah, mt.na_perk, tr.no_perk, tr.registered from billing.transaksi_rsik tr 
        left join billing.master_tarip_inap_2026 mt on mt.no_perk = tr.no_perk 
        left join rsi_byl.dokter d on d.no_dr = tr.dokter 
        where tr.no_reg ='$no_reg' and tr.tanggal BETWEEN '$tgl_masuk' and '$tgl_keluar' and mt.na_perk not like '%O2%' and mt.na_perk not like '%VENTI%' and mt.eklaim_kd not in ('VIS','KMR','ICU') and tr.deleted='0'";
        $rows_bill5 = DB::connection('billing_byl')->select($query5); 
                $rows_visit5 = (array) null; 
        if (!empty($rows_bill5)) {
            foreach ($rows_bill5 as $row_bill5) {
                $row_bill5 = (object) $row_bill5; 
                switch ($row_bill5->no_perk) {
                    case NULL : 
                    case '' :
                        break; 
                    default : 
                        $rows_visit5[] = $row_bill5;
                        break;
                }
            }
            // if (ipclient()=='172.16.18.89') pre($rows_bill5);
        }

        // $pdf_type = "I";
        $umur = selisihymdhis($tgl_lahir, $tgl_masuk, "umur");
        
        //prosedur cara masuk
        $jenis_asal_rujukan = ""; 
        $prosedur_cara_masuk = ""; 
        if (!empty($row_mutasi_ri->tgl_masuk)) {
            $row_kunjung = DB::table('rsiklaten.kunjung as a')
            ->leftJoin('rsiklaten.rujuk as b', function($join) {
                $join->on('a.rujuk', '=', 'b.id_rujuk');
            })
            ->leftJoin('rsiklaten.poli as c', function($join) {
                $join->on('a.kd_poli', '=', 'c.kode_poli');
            })
            ->where('a.no_reg', $no_reg)->where('a.tanggal', $row_mutasi_ri->tgl_masuk)->whereNull('a.deleted')->orderBy('a.id', 'DESC')
            ->first(array('b.rujuk', 'c.nama_poli'));
            if (!empty($row_kunjung)) {
                $row_kunjung = (object) $row_kunjung;
                $jenis_asal_rujukan = strtoupper($row_kunjung->rujuk);
                $prosedur_cara_masuk = strtoupper($row_kunjung->nama_poli);
            }
        }
        

        $data = array(
            "no_reg"        => $no_reg,
            "tgl_masuk"     => $tgl_masuk,
            "jam_masuk"     => $jam_masuk,
            "tgl_rs"        => $tgl_rs,
            "ranap"         => $row_mutasi_ri,
            "nama"          => $nama,
            "warning_sama" => isset($warning_sama)?$warning_sama:false, 
            "nik"           => $nik,
            "jenis_kel"     => $jenis_kel,
            "alamat"        => $alamat,
            "tgl_lahir"     => $tgl_lahir,
            "telp"          => $telp,
            "agama"         => $agama,
            "kawin"         => $kawin,
            "didik"         => $didik,
            "kerja"         => $kerja,
            "rujuk"         => $rujuk,
            "kunjung"       => $kunjung,
            "asuransi"      => $asuransi,
            "jenis_asal_rujukan"         => $jenis_asal_rujukan,
            "prosedur_cara_masuk"         => $prosedur_cara_masuk,
            "asal"          => $asal,
            "str_tgl_masuk" => $str_tgl_masuk,
            "bangsal"       => $bangsal,
            "nama_petugas"  => $nama_petugas,
            "visit"         => $rows_visit,
            "visit2"         => $rows_visit2,
            "visit3"         => $rows_visit3,
            "visit4"         => $rows_visit4,
            "visit5"         => $rows_visit5,
            'pdf_type'      => $pdf_type,
            'lp_print'      => $lp_print,
            'printer'       => $printer,
            'halaman'       => $halaman,
            'halamanx'      => $halaman,
            'waktu_cetak'      => date("d/m/Y H:i:s"),
            'ipclient'      => $ipclient
        );
        // pre($rows_visit);
        // if (ipclient()=='172.16.18.89') 
        // pre($rows_visit4);
        // if (ipclient()=='172.16.18.21') 
        // pre($data);
        if (ipclient()=='172.16.18.89') {
            // go('pdf/sdp-vip', $data);
            go('pdf/sdp2', $data);
        } else {
            go('pdf/sdp2', $data);
        }