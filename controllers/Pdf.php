<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pdf extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tampiltanggal');
    }

    private function obj($data) {
        return (object) collect($data)->first();
    }

    public function acc($by)
    {
        $this->load->model('koordinator');

        $koordinator = Koordinator::where('unit', $by)->first();
        $domain = $koordinator->domain;
        $jabatan_koordinator = $koordinator->jabatan_koordinator;
        $jabatan_manajer = $koordinator->jabatan_kabag;
        $manajer = $koordinator->kabag;
        $koordinator = $koordinator->nama;

        $data = array(
            'domain' => $domain,
            'jabatan_manajer' => $jabatan_manajer,
            'jabatan_koordinator' => $jabatan_koordinator,
            'manajer' => $manajer,
            'koordinator' => $koordinator,
        );

        return $data;
    }
    public function akses_menu()
    {
        $this->load->model('karyawan');
        $this->load->model('unit');
        $this->load->model('dokter');
        $this->load->model('bangsal');
        $this->load->model('smf');

        $nik = false;
        $unit = false;
        $userid = '';
        $sess = sess_on('auth');
        if(isset($sess->sessid))
        {
            $nik = $sess->user;
            $userid = $sess->user_id;
        }

        $induk = false;
        $field = array('karya.unit');
        $karya = Karyawan::join('unit', 'karya.unit', '=', 'unit.no_unit')->where('nik', $nik)->first($field);
        if(count($karya) > 0)
        {
            $unit = $karya->unit;
            $unit = Unit::where('no_unit', $unit)->first();
            if(count($unit) > 0)
            {
                $induk = $unit->induk;
            }
        }

        $dsmf = '';
        $nsmf = '';
        $sps = false;
        $dokter = false;
        $dr = Dokter::find($nik);
        if(count($dr) > 0)
        {
            $sps = $dr->sps_id;
            $msmf = SMF::find($sps);
            if(count($msmf) > 0)
            {
                $nsmf = $msmf->nama;
                $dsmf = str_replace('Asesmen Awal Rawat ', 'form_soap_', $nsmf);
                $dsmf = str_replace(' ', '_', $dsmf);
                $dsmf = strtolower($dsmf);
            }
            $dokter = true;
        }

        $data = (object)array(
            'induk' => $induk,
            'dokter' => $dokter,
            'sps' => $sps,
            'nik' => $nik,
            'userid' => $userid,
            'unit' => $unit,
        );

        return $data;
    }
    public function index()
    {
        $data = array(
            'header' => true,
            'view'   => 'form_home',
            'assets' => $this->template->getMetadata(),
        );

        go('index', $data);
    }

    public function diagnosa_pasien()
    {
        $this->load->model('diag_pasien');

        $reg = segments();
        //$poli = segments();

        $found = false;

        $pasien  = Pasien::find($reg);
        $diagpsn = Diag_Pasien::where('norm', '=', $reg)->get();
        if (!empty($diagpsn)) {
            foreach ($diagpsn as $all) {
                # code...
                $no_reg    = $all->Norm;
                $pasien    = Pasien::find($no_reg);
                $alamat    = $pasien->alamat;
                $jenis_kel = $pasien->jenis_kel;

                $umur      = $pasien->umur;
                $agama     = $pasien->agama;
                $jam_masuk = $pasien->jam_masuk;

                $nama      = $all->NamaPasien;
                $kel       = $all->JK;
                $tgl_lahir = $all->Tgllhr;

                $berat     = $all->Berat;
                $poli      = $all->Poli_bgs;
                $tgl_masuk = $all->Tglmsk;

                $tgl_keluar = $all->Tglklr;

                $tgl_keluar = $all->CaraPlg;
                $tin_lan    = $all->Tin_lan;
                $nopeserta  = $all->No_peserta;
                $nosep      = $all->SEP;
                $dpjp       = $all->kd_dr;
                $dokter     = Dokter::find($dpjp);
                if (count($dokter) > 0) {
                    # code...
                    $nm_dr = $dokter->nama2;
                } else {
                    $nm_dr = '';
                }

                $jns_perawatan = $all->Jnsrawat;
                $kls_perawatan = $all->Klsrawat;
                $relasi        = $all->Relasi;
                $jns_pbyrn     = $all->Jns_pbyrn;
                $bhp           = $all->Bhp;
                $srt_rujukan   = $all->Rujukan;
                $severity3     = $all->Severity3;
                $diag1         = $all->D1;
                $diag2         = $all->D2;
                $diag3         = $all->D3;
                $diag4         = $all->D4;
                $diag5         = $all->D5;
                $diag6         = $all->D6;
                $diag7         = $all->D7;
                $diag8         = $all->D8;
                $diag9         = $all->D9;
                $diag10        = $all->D10;
                $adl           = $all->adl;
                $proc1         = $all->P1;
                $proc2         = $all->P2;
                $proc3         = $all->P3;
                $proc4         = $all->P4;
                $proc5         = $all->P5;
                $proc6         = $all->P6;
                $proc7         = $all->P7;
                $proc8         = $all->P8;
                $proc9         = $all->P9;
                $proc10        = $all->P10;
                $tarif_rs      = $all->TarifRS;
                $tarifcbg      = $all->Tarif;

                $content = (object) array(
                    'no_reg'        => $no_reg,
                    'nama'          => $nama,
                    'kel'           => $kel,
                    'tgl_lahir'     => $tgl_lahir,
                    'berat'         => $berat,
                    'poli'          => $poli,
                    'tgl_masuk'     => $tgl_masuk,
                    'tgl_keluar'    => $tgl_keluar,
                    'tin_lan'       => $tin_lan,
                    'nopeserta'     => $nopeserta,
                    'nosep'         => $nosep,
                    'dpjp'          => $dpjp,
                    'nm_dr'         => $nm_dr,
                    'jns_perawatan' => $jns_perawatan,
                    'kls_perawatan' => $kls_perawatan,
                    'relasi'        => $relasi,
                    'jns_pbyrn'     => $jns_pbyrn,
                    'bhp'           => $bhp,
                    'srt_rujukan'   => $srt_rujukan,
                    'severity3'     => $severity3,
                    'diag1'         => $diag1,
                    'diag2'         => $diag2,
                    'diag3'         => $diag3,
                    'diag4'         => $diag4,
                    'diag5'         => $diag5,
                    'diag6'         => $diag6,
                    'diag7'         => $diag7,
                    'diag8'         => $diag8,
                    'diag9'         => $diag9,
                    'diag10'        => $diag10,
                    'adl'           => $adl,
                    'proc1'         => $proc1,
                    'proc2'         => $proc2,
                    'proc3'         => $proc3,
                    'proc4'         => $proc4,
                    'proc5'         => $proc5,
                    'proc6'         => $proc6,
                    'proc7'         => $proc7,
                    'proc8'         => $proc8,
                    'proc9'         => $proc9,
                    'proc10'        => $proc10,
                    'tarif_rs'      => $tarif_rs,
                    'tarifcbg'      => $tarifcbg,
                    'alamat'        => $alamat,
                    'tgl_lahir'     => $tgl_lahir,
                    'jenis_kel'     => $jenis_kel,
                    'umur'          => $umur,
                    'agama'         => $agama,
                    'jam_masuk'     => $jam_masuk,
                );

                $found = true;
            }
        }

        $data = array(
            'content' => $content,
            'pasien'  => $pasien,
            'diagpsn' => $diagpsn,
        );

        go('pdf_diagnosa', $data);
        //$pdf_filename = 'user_infs.pdf';
        //generate_pdf($output, $pdf_filename);

        //$pdf_filename = 'user_infs.pdf';
        //generate_pdf($output, $pdf_filename);
        //$pdf_filename = 'user_infs.pdf';
        //generate_pdf($output, $pdf_filename);
        $ip = getenv('HTTP_CLIENT_IP') ?:
        getenv('HTTP_X_FORWARDED_FOR') ?:
        getenv('HTTP_X_FORWARDED') ?:
        getenv('HTTP_FORWARDED_FOR') ?:
        getenv('HTTP_FORWARDED') ?:
        getenv('REMOTE_ADDR');

        $data = array(
            'ip'          => $ip,
            'printer'     => '\\\\192.168.0.16\\EPSON L120 Series 2',
            'orientation' => 'P',
            'paper'       => 9,
            'pdf'         => 'diagnosa.pdf',
        );
        go('pdfjs', $data);
    }
    public function kardio()
    {
        go('pdf_kardio');
    }
    public function antrian_farmasi()
    {
        $no_reg = segments();

        $pasien = Pasien::where('no_reg', '=', $no_reg)->get();
        foreach ($pasien as $all) {
            # code...
            $id        = $all->id;
            $no_reg    = $all->no_reg;
            $nama      = $all->nama;
            $alamat    = $all->alamat;
            $tgl_lahir = $all->tgl_lahir;
            $umur      = $all->umur;
            $kd_dr     = $all->kd_dr;
            $dokter    = Dokter::find($kd_dr);
            if (count($dokter) > 0) {
                # code...
                $nm_dr = $dokter->nama2;
            } else {
                $nm_dr = '';
            }
            $kd_poli = $all->kd_poli;
            $poli    = Poli::find($kd_poli);
            if (count($poli) > 0) {
                $nm_poli = $poli->nama_poli;
            } else {
                $nm_poli = '';
            }
            $tgl_masuk = $all->tgl_masuk;

            $content = (object) array(
                'id'        => $id,
                'no_reg'    => $no_reg,
                'nama'      => $nama,
                'alamat'    => $alamat,
                'tgl_lahir' => $tgl_lahir,
                'umur'      => $umur,
                'kd_dr'     => $kd_dr,
                'nm_dr'     => $nm_dr,
                'kd_poli'   => $kd_poli,
                'nm_poli'   => $nm_poli,
                'tgl_masuk' => $tgl_masuk,
            );
        }
        $data = array(
            'content' => $content,
        );

        go('pdf_antrian_farmasi', $data);
        //$pdf_filename = 'user_infs.pdf';
        //generate_pdf($output, $pdf_filename);
        $ip = getenv('HTTP_CLIENT_IP') ?:
        getenv('HTTP_X_FORWARDED_FOR') ?:
        getenv('HTTP_X_FORWARDED') ?:
        getenv('HTTP_FORWARDED_FOR') ?:
        getenv('HTTP_FORWARDED') ?:
        getenv('REMOTE_ADDR');

        $data = array(
            'ip'          => $ip,
            'orientation' => 'P',
            'paper'       => 9,
            'pdf'         => 'antrian_farmasi.pdf',
        );
        go('pdfjs', $data);
    }
    public function antrian_ro()
    {
        $no_reg = segments();

        $pasien = Pasien::where('no_reg', '=', $no_reg)->get();
        foreach ($pasien as $all) {
            # code...
            $id        = $all->id;
            $no_reg    = $all->no_reg;
            $nama      = $all->nama;
            $alamat    = $all->alamat;
            $tgl_lahir = $all->tgl_lahir;
            $umur      = $all->umur;
            $kd_dr     = $all->kd_dr;
            $dokter    = Dokter::find($kd_dr);
            if (count($dokter) > 0) {
                # code...
                $nm_dr = $dokter->nama2;
            } else {
                $nm_dr = '';
            }
            $kd_poli = $all->kd_poli;
            $poli    = Poli::find($kd_poli);
            if (count($poli) > 0) {
                $nm_poli = $poli->nama_poli;
            } else {
                $nm_poli = '';
            }
            $tgl_masuk = $all->tgl_masuk;

            $content = (object) array(
                'id'        => $id,
                'no_reg'    => $no_reg,
                'nama'      => $nama,
                'alamat'    => $alamat,
                'tgl_lahir' => $tgl_lahir,
                'umur'      => $umur,
                'kd_dr'     => $kd_dr,
                'nm_dr'     => $nm_dr,
                'kd_poli'   => $kd_poli,
                'nm_poli'   => $nm_poli,
                'tgl_masuk' => $tgl_masuk,
            );
        }
        $data = array(
            'content' => $content,
        );

        go('pdf_antrian_ro', $data);
        //$pdf_filename = 'user_infs.pdf';
        //generate_pdf($output, $pdf_filename);
        $ip = getenv('HTTP_CLIENT_IP') ?:
        getenv('HTTP_X_FORWARDED_FOR') ?:
        getenv('HTTP_X_FORWARDED') ?:
        getenv('HTTP_FORWARDED_FOR') ?:
        getenv('HTTP_FORWARDED') ?:
        getenv('REMOTE_ADDR');

        $data = array(
            'ip'          => $ip,
            'orientation' => 'P',
            'paper'       => 9,
            'pdf'         => 'antrian_ro.pdf',
        );
        go('pdfjs', $data);
    }
    public function pdfs()
    {
        $pdf = new Pdf("L", "mm", "F4", true, "UTF-8", false);

//$pdf->SetFont("dejavusans", "", 10);
        $pdf->SetFont("times", "", 7);

        $pdf->setHeaderData("", 0, "", "", array(0, 0, 0), array(255, 255, 255));
        $pdf->SetMargins(10, 10, 70, true);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        $html = 'hello';

        $pdf->writeHTML($html, true, false, true, false, "");
        $pdf->Output('My-File-Namef.pdf', 'I');
    }
    public function error()
    {
        $this->template->useAsset()->setJs(array('jquery.min'));
        $this->template->useAsset()->setCSS(array('bootstrap.min.theme4', 'error', 'responsive'));

        $data = array(
            'assets' => $this->template->getMetadata(),
        );

        go('error', $data);
    }

    public function rawat_jalan_all()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $no_reg = segment(4);
        $tanggal = segment(5);
        $jam_masuk = segment(6);
        $get_no_tran = null;
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        $no_kwt = "";
        
        /* GIGI */
        $this->load->model('Gigi_db5j');
		$this->load->model('Gigi_db5j_writer');
		$tgl_masuk = null; 
		$jam_masuk = null; 
		$tgl_spm = ""; 
		$row = null; 
		$kd_dr = ""; 
		$kd_poli = "";
		
		$kwitansi = []; 
		$db5j = [];
		$kwitansi = Gigi_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
		if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
			foreach ($kwitansi as $row) {
				$no_tran = $row->no_tran;
				if (!empty($get_no_tran)) {
					$no_tran = $get_no_tran;     
				}
				$xdb5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
					$join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
					})->where('gigi_db5j.no_reg', $no_reg)->where('gigi_db5j.no_tran', $no_tran)->where('gigi_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->get(
						array('gigi_db5j.netto', 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.kwanta', 'gigi_db5j.dokter', 'gigi_db5j.bangsal', 'gigi_db5j.tgl_masuk', 'gigi_db5j.jam_masuk', 'gigi_db5j.tanggal', 'gigi_db5j.jam', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
					);
				
				if (!empty($xdb5j)) {
					foreach ($xdb5j as $row) {
						$tgl_masuk = $row->tgl_masuk;
						$jam_masuk = $row->jam_masuk;
						$tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
						$jumlah = $jumlah + $row->netto;
						$kd_dr = $row->dokter;
						$kd_poli = $row->bangsal;
						$no_kwt = $row->no_tran;
					}
				}
				$db5j[] = $xdb5j;
			}
		}

		$db_writer = null; 
		$db_writer = Gigi_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
		if (!empty($db_writer)) {
			$writer = $db_writer->writer;
			$perawat = Perawat::where('user_id', $writer)->first();
			if (empty($perawat)) {
				$nik = User::find($writer);
				$karyawan = Karyawan::find($nik->user);
				$petugas = $karyawan->nama;
			} else {
				$petugas = $perawat->nama;
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
		
		$data_gigi = array(
			'no_reg' => $no_reg,
			'nama' => $pasien->nama,
			'alamat' => $pasien->alamat,
			'dokter' => $dokter,
			'poli' => $poli,
			'tgl_masuk' => $tgl_masuk,
			'tgl_spm' => $tgl_spm,
			'db5j' => $db5j,
			'jumlah' => $jumlah,
			'no_kwt' => $no_kwt,
			'petugas' => $petugas
		);
		
		/* SPS */
        $this->load->model('Sps_db5j');
		$this->load->model('Sps_db5j_writer');
		$tgl_masuk = null; 
		$jam_masuk = null; 
		$tgl_spm = ""; 
		$row = null; 
		$kd_dr = ""; 
		$kd_poli = "";
		$kwitansi = []; 
		$db5j = [];
		$kwitansi = Sps_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
		if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
			foreach ($kwitansi as $row) {
				$no_tran = $row->no_tran;
				if (!empty($get_no_tran)) {
					$no_tran = $get_no_tran;     
				}
				$xdb5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
					$join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
					})->where('sps_db5j.no_reg', $no_reg)->where('sps_db5j.no_tran', $no_tran)->where('sps_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->get(
						array('sps_db5j.netto', 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.kwanta', 'sps_db5j.dokter', 'sps_db5j.bangsal', 'sps_db5j.tgl_masuk', 'sps_db5j.jam_masuk', 'sps_db5j.tanggal', 'sps_db5j.jam', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
					);
				if (!empty($xdb5j)) {
					foreach ($xdb5j as $row) {
						$tgl_masuk = $row->tgl_masuk;
						$jam_masuk = $row->jam_masuk;
						$tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
						$jumlah = $jumlah + $row->netto;
						$kd_dr = $row->dokter;
						$kd_poli = $row->bangsal;
						$no_kwt = $row->no_tran;
					}
				}
				$db5j[] = $xdb5j;
			}
		}

		$db_writer = null; 
		$db_writer = Sps_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
		if (!empty($db_writer)) {
			$writer = $db_writer->writer;
			$perawat = Perawat::where('user_id', $writer)->first();
			if (empty($perawat)) {
				$nik = User::find($writer);
				$karyawan = Karyawan::find($nik->user);
				$petugas = $karyawan->nama;
			} else {
				$petugas = $perawat->nama;
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
		
		$data_sps = array(
			'no_reg' => $no_reg,
			'nama' => $pasien->nama,
			'alamat' => $pasien->alamat,
			'dokter' => $dokter,
			'poli' => $poli,
			'tgl_masuk' => $tgl_masuk,
			'tgl_spm' => $tgl_spm,
			'db5j' => $db5j,
			'jumlah' => $jumlah,
			'no_kwt' => $no_kwt,
			'petugas' => $petugas
		);
		
		/* UMUM */ 
		
		$this->load->model('Umum_db5j');
		$this->load->model('Umum_db5j_writer');
		$tgl_masuk = null; 
		$jam_masuk = null; 
		$tgl_spm = ""; 
		$row = null; 
		$kd_dr = ""; 
		$kd_poli = "";
		$kwitansi = []; 
		$db5j = [];
		$kwitansi = Umum_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
		if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
			foreach ($kwitansi as $row) {
				$no_tran = $row->no_tran;
				if (!empty($get_no_tran)) {
					$no_tran = $get_no_tran;     
				}
				$xdb5j = Umum_db5j::leftJoin('sps_no_perk', function ($join) {
					$join->on('umum_db5j.no_perk', '=', 'sps_no_perk.no_perk');
					})->where('umum_db5j.no_reg', $no_reg)->where('umum_db5j.no_tran', $no_tran)->where('umum_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->get(
						array('umum_db5j.netto', 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.kwanta', 'umum_db5j.dokter', 'umum_db5j.bangsal', 'umum_db5j.tgl_masuk', 'umum_db5j.jam_masuk', 'umum_db5j.tanggal', 'umum_db5j.jam', 'umum_db5j.no_tran', 'sps_no_perk.na_perk')
					);
				if (!empty($xdb5j)) {
					foreach ($xdb5j as $row) {
						$tgl_masuk = $row->tgl_masuk;
						$jam_masuk = $row->jam_masuk;
						$tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
						$jumlah = $jumlah + $row->netto;
						$kd_dr = $row->dokter;
						$kd_poli = $row->bangsal;
						$no_kwt = $row->no_tran;
					}
				}
				$db5j[] = $xdb5j;
			}
		}
		$db_writer = null; 
		$db_writer = Umum_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
		if (!empty($db_writer)) {
			$writer = $db_writer->writer;
			$perawat = Perawat::where('user_id', $writer)->first();
			if (empty($perawat)) {
				$nik = User::find($writer);
				$karyawan = Karyawan::find($nik->user);
				$petugas = $karyawan->nama;
			} else {
				$petugas = $perawat->nama;
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
		
		$data_umum = array(
			'no_reg' => $no_reg,
			'nama' => $pasien->nama,
			'alamat' => $pasien->alamat,
			'dokter' => $dokter,
			'poli' => $poli,
			'tgl_masuk' => $tgl_masuk,
			'tgl_spm' => $tgl_spm,
			'db5j' => $db5j,
			'jumlah' => $jumlah,
			'no_kwt' => $no_kwt,
			'petugas' => $petugas
		);
		
		$data = array(
			"gigi" => $data_gigi, 
			"sps" => $data_sps, 
			"umum" => $data_umum
		);
		go('pdf_rawat_jalan_all', $data);
        
    }
    
    public function rawat_jalan()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            case 'gigi' : 
                $this->load->model('Gigi_db5j');
                $this->load->model('Gigi_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Gigi_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Gigi_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('gigi_db5j.no_reg', $no_reg)->where('gigi_db5j.no_tran', $no_tran)->where('gigi_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('gigi_db5j.deleted')->get(
                                array('gigi_db5j.netto', 'gigi_db5j.no_perk', 'gigi_db5j.jumlah', 'gigi_db5j.kwanta', 'gigi_db5j.dokter', 'gigi_db5j.bangsal', 'gigi_db5j.tgl_masuk', 'gigi_db5j.jam_masuk', 'gigi_db5j.tanggal', 'gigi_db5j.jam', 'gigi_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Gigi_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_jalan', $data);
            break; 
            case 'sps' : 
                $this->load->model('Sps_db5j');
                $this->load->model('Sps_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Sps_db5j::select('sps_db5j.no_tran')->where('no_reg', $no_reg)->where('sps_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('sps_db5j.deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Sps_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('sps_db5j.no_reg', $no_reg)->where('sps_db5j.no_tran', $no_tran)->where('sps_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('sps_db5j.deleted')->get(
                                array('sps_db5j.netto', 'sps_db5j.no_perk', 'sps_db5j.jumlah', 'sps_db5j.kwanta', 'sps_db5j.dokter', 'sps_db5j.bangsal', 'sps_db5j.tgl_masuk', 'sps_db5j.jam_masuk', 'sps_db5j.tanggal', 'sps_db5j.jam', 'sps_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Sps_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_jalan', $data);
            break; 
            case 'umum' : 
                $this->load->model('Umum_db5j');
                $this->load->model('Umum_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Umum_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Umum_db5j::leftJoin('sps_no_perk', function ($join) {
                            $join->on('umum_db5j.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('umum_db5j.no_reg', $no_reg)->where('umum_db5j.no_tran', $no_tran)->where('umum_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('umum_db5j.deleted')->get(
                                array('umum_db5j.netto', 'umum_db5j.no_perk', 'umum_db5j.jumlah', 'umum_db5j.kwanta', 'umum_db5j.dokter', 'umum_db5j.bangsal', 'umum_db5j.tgl_masuk', 'umum_db5j.jam_masuk', 'umum_db5j.tanggal', 'umum_db5j.jam', 'umum_db5j.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Umum_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_jalan', $data);
            break; 
        }
        
    }

    public function rawat_inap()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            case 'gigi' : 
                $this->load->model('Gigi_db5');
                $this->load->model('Gigi_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Gigi_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Gigi_db5::leftJoin('sps_no_perk', function ($join) {
                            $join->on('gigi_db5.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('gigi_db5.no_reg', $no_reg)->where('gigi_db5.no_tran', $no_tran)->where('gigi_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('gigi_db5.deleted')->get(
                                array('gigi_db5.netto', 'gigi_db5.no_perk', 'gigi_db5.jumlah', 'gigi_db5.kwanta', 'gigi_db5.dokter', 'gigi_db5.bangsal', 'gigi_db5.tgl_masuk', 'gigi_db5.jam_masuk', 'gigi_db5.tanggal', 'gigi_db5.jam', 'gigi_db5.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Gigi_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_inap', $data);
            break; 
            case 'sps' : 
                $this->load->model('Sps_db5');
                $this->load->model('Sps_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Sps_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Sps_db5::leftJoin('sps_no_perk', function ($join) {
                            $join->on('sps_db5.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('sps_db5.no_reg', $no_reg)->where('sps_db5.no_tran', $no_tran)->where('sps_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('sps_db5.deleted')->get(
                                array('sps_db5.netto', 'sps_db5.no_perk', 'sps_db5.jumlah', 'sps_db5.kwanta', 'sps_db5.dokter', 'sps_db5.bangsal', 'sps_db5.tgl_masuk', 'sps_db5.jam_masuk', 'sps_db5.tanggal', 'sps_db5.jam', 'sps_db5.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Sps_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_inap', $data);
            break; 
            case 'umum' : 
                $this->load->model('Umum_db5');
                $this->load->model('Umum_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Umum_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Umum_db5::leftJoin('sps_no_perk', function ($join) {
                            $join->on('umum_db5.no_perk', '=', 'sps_no_perk.no_perk');
                            })->where('umum_db5.no_reg', $no_reg)->where('umum_db5.no_tran', $no_tran)->where('umum_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('umum_db5.deleted')->get(
                                array('umum_db5.netto', 'umum_db5.no_perk', 'umum_db5.jumlah', 'umum_db5.kwanta', 'umum_db5.dokter', 'umum_db5.bangsal', 'umum_db5.tgl_masuk', 'umum_db5.jam_masuk', 'umum_db5.tanggal', 'umum_db5.jam', 'umum_db5.no_tran', 'sps_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Umum_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_rawat_inap', $data);
            break; 
        }
    }

    public function spm_fisioterapi_rajal()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        if (!empty(segment(8))) {
            $get_status = segment(8);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Rhmed_db5j');
                $this->load->model('Rhmed_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Rhmed_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('rhmed_db5j.no_reg', $no_reg)->where('rhmed_db5j.no_tran', $no_tran)->where('rhmed_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('rhmed_db5j.deleted')->get(
                                array('rhmed_db5j.netto', 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.kwanta', 'rhmed_db5j.dokter', 'rhmed_db5j.bangsal', 'rhmed_db5j.tgl_masuk', 'rhmed_db5j.jam_masuk', 'rhmed_db5j.tanggal', 'rhmed_db5j.jam', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_fisioterapi_rajal', $data);
            break; 
        }
        
    }

    public function spm_fisioterapi_rajal_delete()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        if (!empty(segment(8))) {
            $get_deleted = date("Y-m-d H:i:s", segment(8));
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Rhmed_db5j');
                $this->load->model('Rhmed_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Rhmed_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->where('deleted', $get_deleted)->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Rhmed_db5j::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5j.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })
                            ->where('rhmed_db5j.no_reg', $no_reg)->where('rhmed_db5j.no_tran', $no_tran)
                            ->where('rhmed_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->where('rhmed_db5j.deleted', $get_deleted)
                            ->get(
                                array('rhmed_db5j.netto', 'rhmed_db5j.no_perk', 'rhmed_db5j.jumlah', 'rhmed_db5j.kwanta', 'rhmed_db5j.dokter', 'rhmed_db5j.bangsal', 'rhmed_db5j.tgl_masuk', 'rhmed_db5j.jam_masuk', 'rhmed_db5j.tanggal', 'rhmed_db5j.jam', 'rhmed_db5j.no_tran', 'rhmed_no_perk.na_perk')
                            );
                    }
                }
                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Rhmed_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->where('deleted', $get_deleted)->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_fisioterapi_rajal', $data);
            break; 
        }
        
    }

    public function spm_fisioterapi_ranap()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Rhmed_db5');
                $this->load->model('Rhmed_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Rhmed_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Rhmed_db5::leftJoin('rhmed_no_perk', function ($join) {
                            $join->on('rhmed_db5.no_perk', '=', 'rhmed_no_perk.no_perk');
                            })->where('rhmed_db5.no_reg', $no_reg)->where('rhmed_db5.no_tran', $no_tran)->where('rhmed_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('rhmed_db5.deleted')->get(
                                array('rhmed_db5.netto', 'rhmed_db5.no_perk', 'rhmed_db5.jumlah', 'rhmed_db5.kwanta', 'rhmed_db5.dokter', 'rhmed_db5.bangsal', 'rhmed_db5.tgl_masuk', 'rhmed_db5.jam_masuk', 'rhmed_db5.tanggal', 'rhmed_db5.jam', 'rhmed_db5.no_tran', 'rhmed_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Rhmed_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        // $perawat = Perawat::where('user_id', $writer)->first();
                        // if (empty($perawat)) {
                            $nik = User::find($writer);
                            $karyawan = Karyawan::find($nik->user);
                            $petugas = $karyawan->nama;
                        // } else {
                        //     $petugas = $perawat->nama;
                        // }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_fisioterapi_ranap', $data);
            break; 
        }
    }


    public function spm_hd_rajal()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Hd_db5j');
                $this->load->model('Hd_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Hd_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Hd_db5j::leftJoin('hd_no_perk', function ($join) {
                            $join->on('hd_db5j.no_perk', '=', 'hd_no_perk.no_perk');
                            })->where('hd_db5j.no_reg', $no_reg)->where('hd_db5j.no_tran', $no_tran)->where('hd_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('hd_db5j.deleted')->get(
                                array('hd_db5j.netto', 'hd_db5j.no_perk', 'hd_db5j.jumlah', 'hd_db5j.kwanta', 'hd_db5j.dokter', 'hd_db5j.bangsal', 'hd_db5j.tgl_masuk', 'hd_db5j.jam_masuk', 'hd_db5j.tanggal', 'hd_db5j.jam', 'hd_db5j.no_tran', 'hd_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Hd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->first(array('writed', 'writer'));
                if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    // $perawat = Perawat::where('user_id', $writer)->first();
                    // if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    // } else {
                    //     $petugas = $perawat->nama;
                    // }
                }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // if ($no_reg == '0590501') {
                //     echo json_encode($no_reg); 
                // } else {
                    go('pdf_spm_hd_rajal', $data);
                // }
                
            break; 
        }
        
    }

    public function spm_hd_ranap()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Hd_db5');
                $this->load->model('Hd_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Hd_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Hd_db5::leftJoin('hd_no_perk', function ($join) {
                            $join->on('hd_db5.no_perk', '=', 'hd_no_perk.no_perk');
                            })->where('hd_db5.no_reg', $no_reg)->where('hd_db5.no_tran', $no_tran)->where('hd_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('hd_db5.deleted')->get(
                                array('hd_db5.netto', 'hd_db5.no_perk', 'hd_db5.jumlah', 'hd_db5.kwanta', 'hd_db5.dokter', 'hd_db5.bangsal', 'hd_db5.tgl_masuk', 'hd_db5.jam_masuk', 'hd_db5.tanggal', 'hd_db5.jam', 'hd_db5.no_tran', 'hd_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Hd_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_hd_ranap', $data);
            break; 
        }
    }

    public function spm_jantung_rajal()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Jantung_db5j');
                $this->load->model('Jantung_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Jantung_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Jantung_db5j::leftJoin('jantung_no_perk', function ($join) {
                            $join->on('jantung_db5j.no_perk', '=', 'jantung_no_perk.no_perk');
                            })->where('jantung_db5j.no_reg', $no_reg)->where('jantung_db5j.no_tran', $no_tran)->where('jantung_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('jantung_db5j.deleted')->get(
                                array('jantung_db5j.netto', 'jantung_db5j.no_perk', 'jantung_db5j.jumlah', 'jantung_db5j.kwanta', 'jantung_db5j.dokter', 'jantung_db5j.bangsal', 'jantung_db5j.tgl_masuk', 'jantung_db5j.jam_masuk', 'jantung_db5j.tanggal', 'jantung_db5j.jam', 'jantung_db5j.no_tran', 'jantung_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Jantung_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    $perawat = Perawat::where('user_id', $writer)->first();
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    } else {
                        $petugas = $perawat->nama;
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_jantung_rajal', $data);
            break; 
        }
        
    }

    public function spm_jantung_ranap()
    {
        $this->load->model('Spm');
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Jantung_db5');
                $this->load->model('Jantung_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Jantung_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Jantung_db5::leftJoin('jantung_no_perk', function ($join) {
                            $join->on('jantung_db5.no_perk', '=', 'jantung_no_perk.no_perk');
                            })->where('jantung_db5.no_reg', $no_reg)->where('jantung_db5.no_tran', $no_tran)->where('jantung_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('jantung_db5.deleted')->get(
                                array('jantung_db5.netto', 'jantung_db5.no_perk', 'jantung_db5.jumlah', 'jantung_db5.kwanta', 'jantung_db5.dokter', 'jantung_db5.bangsal', 'jantung_db5.tgl_masuk', 'jantung_db5.jam_masuk', 'jantung_db5.tanggal', 'jantung_db5.jam', 'jantung_db5.no_tran', 'jantung_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Jantung_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_jantung_ranap', $data);
            break; 
        }
    }

    public function aktivitas_pelayanan_spesialis()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Rhmed_db5');
        $this->load->model('Rhmed_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($source) {
            case 'umum' :
                $ttd_jabatan = "Manager Sistem Rawat Jalan";
                $ttd_nama = "Drg. Owin Bambang W. Sp.Pros";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.umum_db5 a 
                            LEFT JOIN bill.umum_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.umum_db5j a 
                            LEFT JOIN bill.umum_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
            case 'gigi' :
                $ttd_jabatan = "Manager Sistem Rawat Jalan";
                $ttd_nama = "Drg. Owin Bambang W. Sp.Pros";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.gigi_db5 a 
                            LEFT JOIN bill.sps_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.gigi_db5j a 
                            LEFT JOIN bill.sps_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
            default :
                $ttd_jabatan = "Manager Sistem Rawat Jalan";
                $ttd_nama = "Drg. Owin Bambang W. Sp.Pros";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.sps_db5 a 
                            LEFT JOIN bill.sps_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.sps_db5j a 
                            LEFT JOIN bill.sps_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'source'     => $source,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_aktivitas_pelayanan_poliklinik', $data);
    }

    public function aktivitas_pelayanan_hemodialisa()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Hd_db5');
        $this->load->model('Hd_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($source) {
            default :
                $ttd_jabatan = "Ka. Instalasi Hemodialisa";
                $ttd_nama = "dr. Erna Fitrisia Kristina,Sp.PD";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.hd_db5 a 
                            LEFT JOIN bill.hd_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.hd_db5j a 
                            LEFT JOIN bill.hd_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'source'     => $source,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_aktivitas_pelayanan_hemodialisa', $data);
    }

    public function aktivitas_pelayanan_jantung()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Jantung_db5');
        $this->load->model('Jantung_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($source) {
            default :
                $ttd_jabatan = "Manager Sistem Jantung Terpadu";
                $ttd_nama = "dr. Dewi Hapsari, Sp.JP";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.jantung_db5 a 
                            LEFT JOIN bill.jantung_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.jantung_db5j a 
                            LEFT JOIN bill.jantung_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'source'     => $source,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_aktivitas_pelayanan_jantung', $data);
    }

    public function aktivitas_pelayanan_rehab_medik()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Rhmed_db5');
        $this->load->model('Rhmed_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($source) {
            default :
                $ttd_jabatan = "Ka. Bidang Penunjang Medis";
                $ttd_nama = "Dr. H.M. Mustofa, S.U.Sp.M.K.(K)";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.rhmed_db5 a 
                            LEFT JOIN bill.rhmed_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.rhmed_db5j a 
                            LEFT JOIN bill.rhmed_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'source'     => $source,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_aktivitas_pelayanan_rehab_medik', $data);
    }

    public function pendapatan_harian()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Rhmed_db5');
        $this->load->model('Rhmed_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($induk) {
            case 'FIS' : 

                $ttd_jabatan = "Ka. Bidang Penunjang Medis";
                $ttd_nama = "Dr. H.M. Mustofa, S.U.Sp.M.K.(K)";

                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    
                } else {
                    $rhmed_db5 = DB::table('bill.rhmed_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $rhmed_db5j = DB::table('bill.rhmed_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                }
                
                $content = array(
                    array(
                        "title" => "RAWAT INAP",
                        "category" => "REHABMEDIK",
                        "rawat" => "INAP",
                        "data" => $rhmed_db5->get() 
                    ),
                    array(
                        "title" => "RAWAT JALAN",
                        "category" => "REHABMEDIK",
                        "rawat" => "JALAN",
                        "data" => $rhmed_db5j->get()
                    )  
                ); 
                break; 
            case 'PLY' :
                $ttd_jabatan = "Manager Sistem Rawat Jalan";
                $ttd_nama = "Drg. Owin Bambang W. Sp.Pros";
                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    // $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'a.jam1', 'a.jam2', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal between '$atanggal' and '$btanggal' and dokter_id='$dokter' order by registered asc) a"))->leftJoin('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->leftJoin('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->where('a.jam1', '<>', '')->orderBy('a.tanggal', 'asc')->orderBy('b.user', 'asc')->get();
                } else {
                    $umum_db5 = DB::table('bill.umum_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $umum_db5j = DB::table('bill.umum_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $sps_db5 = DB::table('bill.sps_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $sps_db5j = DB::table('bill.sps_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $gigi_db5 = DB::table('bill.gigi_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $gigi_db5j = DB::table('bill.gigi_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    // $content = $umum_db5->get();
                    // $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'a.jam1', 'a.jam2', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal between '$atanggal' and '$btanggal' order by registered asc) a"))->leftJoin('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->leftJoin('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->where('a.jam1', '<>', '')->whereRaw("a.dokter_id NOT IN ('S145', 'S151', 'S226', 'S207')")->orderBy('a.tanggal', 'asc')->orderBy('b.user', 'asc')->get();
                }
                
                $content = array(
                    array(
                        "title" => "POLIKLINIK UMUM RAWAT INAP",
                        "category" => "UMUM",
                        "rawat" => "INAP",
                        "data" => $umum_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK UMUM RAWAT JALAN",
                        "category" => "UMUM",
                        "rawat" => "JALAN",
                        "data" => $umum_db5j->get()
                    ),
                    array(
                        "title" => "POLIKLINIK SPESIALIS RAWAT INAP",
                        "category" => "SPESIALIS",
                        "rawat" => "INAP",
                        "data" => $sps_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK SPESIALIS RAWAT JALAN",
                        "category" => "SPESIALIS",
                        "rawat" => "JALAN",
                        "data" => $sps_db5j->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK GIGI RAWAT INAP",
                        "category" => "GIGI",
                        "rawat" => "INAP",
                        "data" => $gigi_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK GIGI RAWAT JALAN",
                        "category" => "GIGI",
                        "rawat" => "JALAN",
                        "data" => $gigi_db5j->get() 
                    )       
                ); 
                break; 
            default : 
                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    // $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'a.jam1', 'a.jam2', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal between '$atanggal' and '$btanggal' and dokter_id='$dokter' order by registered asc) a"))->leftJoin('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->leftJoin('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->where('a.jam1', '<>', '')->orderBy('a.tanggal', 'asc')->orderBy('b.user', 'asc')->get();
                } else {
                    $umum_db5 = DB::table('bill.umum_db5 as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $umum_db5j = DB::table('bill.umum_db5j as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $sps_db5 = DB::table('bill.sps_db5 as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $sps_db5j = DB::table('bill.sps_db5j as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $gigi_db5 = DB::table('bill.gigi_db5 as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $gigi_db5j = DB::table('bill.gigi_db5j as a')->select($arr_select)->whereRaw("tanggal >= '$atanggal' and tanggal <= '$btanggal'")->whereNull('deleted')->orderBy('jam', 'asc')->groupBy(array('no_tran', 'no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('rsiklaten.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    // $content = $umum_db5->get();
                    // $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'a.jam1', 'a.jam2', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal between '$atanggal' and '$btanggal' order by registered asc) a"))->leftJoin('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->leftJoin('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->where('a.jam1', '<>', '')->whereRaw("a.dokter_id NOT IN ('S145', 'S151', 'S226', 'S207')")->orderBy('a.tanggal', 'asc')->orderBy('b.user', 'asc')->get();
                }
                
                $content = array(
                    array(
                        "title" => "POLIKLINIK UMUM RAWAT INAP",
                        "category" => "UMUM",
                        "rawat" => "INAP",
                        "data" => $umum_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK UMUM RAWAT JALAN",
                        "category" => "UMUM",
                        "rawat" => "JALAN",
                        "data" => $umum_db5j->get()
                    ),
                    array(
                        "title" => "POLIKLINIK SPESIALIS RAWAT INAP",
                        "category" => "SPESIALIS",
                        "rawat" => "INAP",
                        "data" => $sps_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK SPESIALIS RAWAT JALAN",
                        "category" => "SPESIALIS",
                        "rawat" => "JALAN",
                        "data" => $sps_db5j->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK GIGI RAWAT INAP",
                        "category" => "GIGI",
                        "rawat" => "INAP",
                        "data" => $gigi_db5->get() 
                    ),
                    array(
                        "title" => "POLIKLINIK GIGI RAWAT JALAN",
                        "category" => "GIGI",
                        "rawat" => "JALAN",
                        "data" => $gigi_db5j->get() 
                    )       
                );
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_pendapatan_harian', $data);
    }


    public function pendapatan_harian_fisioterapi()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Rhmed_db5');
        $this->load->model('Rhmed_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($induk) {
            default : 

                $ttd_jabatan = "Ka. Bidang Penunjang Medis";
                $ttd_nama = "Dr. H.M. Mustofa, S.U.Sp.M.K.(K)";

                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    
                } else {
                    $rhmed_db5 = DB::table('bill.rhmed_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $rhmed_db5j = DB::table('bill.rhmed_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                }
                
                $content = array(
                    array(
                        "title" => "RAWAT INAP",
                        "category" => "REHABMEDIK",
                        "rawat" => "INAP",
                        "data" => $rhmed_db5->get() 
                    ),
                    array(
                        "title" => "RAWAT JALAN",
                        "category" => "REHABMEDIK",
                        "rawat" => "JALAN",
                        "data" => $rhmed_db5j->get()
                    )  
                ); 
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        go('pdf_pendapatan_harian_fisioterapi', $data);
    }

    public function pendapatan_harian_jantung()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Jantung_db5');
        $this->load->model('Jantung_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($induk) {
            default : 

                $ttd_jabatan = "Ka. Bidang Jantung Terpadu";
                $ttd_nama = "dr. Dewi Hapsari, Sp.JP";
                $ttd_nama = " ";

                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    
                } else {
                    $jantung_db5 = DB::table('bill.jantung_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $jantung_db5j = DB::table('bill.jantung_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                }
                
                $content = array(
                    array(
                        "title" => "RAWAT INAP",
                        "category" => "JANTUNG",
                        "rawat" => "INAP",
                        "data" => $jantung_db5->get() 
                    ),
                    array(
                        "title" => "RAWAT JALAN",
                        "category" => "JANTUNG",
                        "rawat" => "JALAN",
                        "data" => $jantung_db5j->get()
                    )  
                ); 
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'domain'        => "JANTUNG TERPADU",
            'content'    => $content,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        go('pdf_pendapatan_harian_jantung', $data);
    }

    public function kunjungan_rawat_jalan()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Hd_db5');
        $this->load->model('Hd_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($induk) {
            default : 

                $ttd_jabatan = "Ka. Instalasi Rawat Jalan";
                $ttd_nama = "dr. Erna Fitrisia Kristina,Sp.PD";
                // $ttd_nama = " ";
                $rows_group = DB::select("SELECT report_order as no, report_nama as report FROM rsiklaten.poli where report_status = 1 group by report_nama ORDER BY report_order ASC
                ");
                if (!empty($rows_group)) {
                    foreach ($rows_group as $row_group) {
                        $row_group = (object) $row_group; 
                        $rows_poli = DB::select("SELECT kode_poli, nama_poli from rsiklaten.poli where report_nama = '$row_group->report' order by kode_poli asc");
                        $row_group->poli = (array) null; 
                        if (!empty($rows_poli)) {
                            foreach ($rows_poli as $row_poli) {
                                $row_poli = (object) $row_poli;
                                $rows_dokter = DB::select("SELECT a.kd_dokter as kode_dokter, b.nama2 AS nama_dokter FROM rme.dokter a LEFT JOIN rsiklaten.dokter b ON a.kd_dokter = b.no_dr WHERE a.kd_poli = '$row_poli->kode_poli'");
                                $row_poli->dokter = (array) null; 
                                if (!empty($rows_dokter)) {
                                    foreach ($rows_dokter as $row_dokter) {
                                        $row_dokter = (object) $row_dokter;
                                        $row_dokter->pasien = (array) null; 
                                        $jumlah_antrian = 0;
                                        $jumlah_inden = 0;
                                        $jumlah_register = 0; 
                                        $rows_pasien = DB::select(" SELECT 
                                                                        a.NO_REG AS no_reg,
                                                                        b.nama,
                                                                        date(b.tgl_lahir) AS tgl_lahir, 
                                                                        a.DAFTAR AS antrian, 
                                                                        a.TANGGAL AS tgl_inden, 
                                                                        a.JAM AS jam_inden, 
                                                                        c.tanggal AS tgl_daftar, 
                                                                        c.jam AS jam_daftar
                                                                    FROM 
                                                                        rsiklaten.antri2 a
                                                                        LEFT JOIN rsiklaten.pasien b 
                                                                        ON a.NO_REG = b.no_reg
                                                                        LEFT JOIN rsiklaten.kunjung c 
                                                                        ON a.NO_REG = c.no_reg
                                                                        AND c.tanggal = a.T_PERIKSA
                                                                        AND c.deletedstate = 0 
                                                                    WHERE 
                                                                        a.KD_DR = '$row_dokter->kode_dokter' 
                                                                        AND a.POLI = '$row_poli->kode_poli'
                                                                        AND a.T_PERIKSA BETWEEN '$atanggal' AND '$btanggal'
                                                                        AND a.deletedstate = 0
                                                                    ORDER BY 
                                                                        CONCAT(LEFT(a.DAFTAR, 1), RIGHT(a.DAFTAR, 3)) ASC
                                                                    ");
                                        if (!empty($rows_pasien)) {
                                            foreach ($rows_pasien as $row_pasien) {
                                                $row_pasien = (object) $row_pasien;
                                                $row_pasien->umur = selisihymdhis($row_pasien->tgl_lahir, $row_pasien->tgl_inden, "umur");
                                                if (!empty($row_pasien->tgl_daftar)) {
                                                    $row_pasien->umur = selisihymdhis($row_pasien->tgl_lahir, $row_pasien->tgl_daftar, "umur");
                                                }
                                                if (!empty($row_pasien->tgl_lahir)) {
                                                    $row_pasien->tgl_lahir = date("d-m-Y", strtotime($row_pasien->tgl_lahir));
                                                }
                                                if (!empty($row_pasien->tgl_inden)) {
                                                    $row_pasien->tgl_inden = date("d-m-Y", strtotime($row_pasien->tgl_inden));
                                                }
                                                if (!empty($row_pasien->tgl_daftar)) {
                                                    $row_pasien->tgl_daftar = date("d-m-Y", strtotime($row_pasien->tgl_daftar));
                                                } 
                                                $row_dokter->pasien[] = $row_pasien;
                                                if ($row_pasien->tgl_inden != $row_pasien->tgl_daftar) {
                                                    $jumlah_inden ++;
                                                }
                                                if (!empty($row_pasien->tgl_daftar)) {
                                                    $jumlah_register ++;
                                                }
                                                $jumlah_antrian ++;
                                            }
                                        }
                                        $row_dokter->antrian = $jumlah_antrian; 
                                        $row_dokter->inden = $jumlah_inden; 
                                        $row_dokter->register = $jumlah_register;
                                        $row_poli->dokter[] = $row_dokter;
                                    }
                                }
                                $row_group->poli[] = $row_poli;
                            }
                        } 
                        $content[] = $row_group;
                    }
                }
                break; 
        }
        if ($atanggal=='2022-01-10') {
            // echo (json_encode($content)); die();
        }

        $data1 = array(
            'nik'        => $nik,
            'domain'        => "RAWAT JALAN",
            'content'    => $content,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);
        // if ($atanggal=='2022-01-03') {
        //     go('pdf_kunjungan_rawat_jalan_primitive', $data);
        // } else {
            // echo (json_encode($content)); die();
            go('pdf_kunjungan_rawat_jalan', $data);
        // }
    }

    public function bon_harian()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Gigi_db5');
        $this->load->model('Gigi_db5j');
        $this->load->model('Sps_db5');
        $this->load->model('Sps_db5j');
        $this->load->model('Umum_db5');
        $this->load->model('Umum_db5j');
        $this->load->model('Bon');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;

        
        $hari = date('N', strtotime($atanggal));
        $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
        if ($source<>'') {
            // $absen = Absen::select('a.id', 'a.user_id', 'a.dokter_id', 'a.jam1', 'a.jam2', 'c.nama2 as nama', 'a.tanggal', 'a.registered')->from(DB::raw("(select * from rme.absen where tanggal between '$atanggal' and '$btanggal' and dokter_id='$dokter' order by registered asc) a"))->leftJoin('rsiklaten.user as b', 'a.user_id', '=', 'b.id')->leftJoin('rsiklaten.dokter as c', 'b.user', '=', 'c.no_dr')->where('a.jam1', '<>', '')->orderBy('a.tanggal', 'asc')->orderBy('b.user', 'asc')->get();
        } else {
            $bons = Bon::whereRaw("tgl_masuk >= '$atanggal' and tgl_masuk <= '$btanggal'")->whereNull('deleted')->get();
            $rows = (array) null;
            if (!empty($bons)) {
                if (count($bons)) {
                    foreach ($bons as $bon) {
                        $bon = (object) $bon; 
                        switch ($bon->bill) {
                            case 'SPSRJ' :
                                $table = "sps_db5j"; 
                                break; 
                            
                        }
                        $db5 = Bon::from("$table as a")->where('a.no_tran', $bon->no_tran)->where('a.no_reg', $bon->no_reg)->where('a.tgl_masuk', $bon->tgl_masuk)
                                ->groupBy(array('a.no_tran', 'a.no_reg', 'a.tgl_masuk'))
                                ->leftJoin('rsiklaten.dokter as b ', function($join) {
                                    $join->on('a.kd_dr', '=', 'b.no_dr');
                                })
                                ->leftJoin('rsiklaten.poli as c', function($join) {
                                    $join->on('a.bangsal', '=', 'c.kode_poli');
                                })
                                ->leftJoin('rsiklaten.pasien as d', function($join) {
                                    $join->on('a.no_reg', '=', 'd.no_reg');
                                })
                                ->first(array(
                                    'a.no_tran',
                                    'a.kd_dr',
                                    DB::Raw("sum(a.netto) as nominal"), 
                                    DB::Raw('b.nama2 as dokter'), 
                                    DB::Raw('d.no_reg as no_reg'), 
                                    DB::Raw('d.nama as pasien'), 
                                    DB::Raw('c.nama_poli as poli')
                                ));
                        if (!empty($db5)) {
                            $sdm = Bon::from('sdm.karya as e')->where('e.nik', $bon->nip)
                                    ->leftJoin('sdm.unit as f', function($join) {
                                        $join->on('e.unit', '=', 'f.no_unit');
                                    })
                                    ->first(array('e.nik', 'e.nama', DB::Raw('f.nm_unit as nama_unit'), DB::Raw('f.no_unit as kode_unit')));
                            if (!empty($sdm)) {
                                $db5->nik = $sdm->nik; 
                                $db5->karyawan = $sdm->nama; 
                                $db5->unit = $sdm->nama_unit;
                            }
                            $rows[] = $db5;
                        } 
                    }
                    // echo json_encode($rows); 
                    // die();
                } else {
                    // die('kosong');
                }
            }
        }
        $data1 = array(
            'nik'        => $nik,
            'content'    => $rows,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);
        go('pdf_bon_harian', $data);
    }
    public function label_stiker() {
        $no_reg = segment(4);
        $this->load->model('Pasien');
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
        } 
        // die(json_encode($data));
        go('pdf_label_stiker', $data);
    }
    public function spm_igd_rajal()
    {
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Ugd_db5j');
                $this->load->model('Ugd_db5j_writer');
                $kwitansi = []; 
                $db5j = [];
                $kwitansi = Ugd_db5j::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5j = Ugd_db5j::leftJoin('ugd_no_perk', function ($join) {
                            $join->on('ugd_db5j.no_perk', '=', 'ugd_no_perk.no_perk');
                            })->where('ugd_db5j.no_reg', $no_reg)->where('ugd_db5j.no_tran', $no_tran)->where('ugd_db5j.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('ugd_db5j.deleted')->get(
                                array('ugd_db5j.netto', 'ugd_db5j.no_perk', 'ugd_db5j.jumlah', 'ugd_db5j.kwanta', 'ugd_db5j.dokter', 'ugd_db5j.bangsal', 'ugd_db5j.tgl_masuk', 'ugd_db5j.jam_masuk', 'ugd_db5j.tanggal', 'ugd_db5j.jam', 'ugd_db5j.no_tran', 'ugd_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5j) > 0) {
                    foreach ($db5j as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Ugd_db5j_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->whereNull('deleted')->first(array('writed', 'writer'));
                if (!empty($db_writer)) {
                    $writer = $db_writer->writer;
                    // $perawat = Perawat::where('user_id', $writer)->first();
                    // if (empty($perawat)) {
                        $nik = User::find($writer);
                        $karyawan = Karyawan::find($nik->user);
                        $petugas = $karyawan->nama;
                    // } else {
                    //     $petugas = $perawat->nama;
                    // }
                }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    $poli = $poli->nama_poli; 
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5j,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // if ($no_reg == '0590501') {
                //     echo json_encode($no_reg); 
                // } else {
                    go('pdf_spm_igd_rajal', $data);
                // }
                
            break; 
        }
        
    }

    public function spm_igd_ranap()
    {
        $this->load->model('Pasien');
        $this->load->model('User');
        $this->load->model('Perawat');
        $this->load->model('Karyawan');
        $this->load->model('Dokter');
        $this->load->model('Poli');
        $this->load->model('Bangsal');
        $source = segment(4);
        $no_reg = segment(5);
        $tanggal = segment(6);
        $jam_masuk = '';
        $get_no_tran = null;
        if (!empty(segment(7))) {
            $get_no_tran = segment(7);
        }
        // $akses = self::akses();
        $pasien = Pasien::find($no_reg); 
        $db5j = []; 
        $jumlah = 0; 
        $tgl_spm = "";
        $petugas = "";
        $dokter = ""; 
        $poli = "";
        switch (strtolower($source)) {
            default : 
                $this->load->model('Ugd_db5');
                $this->load->model('Ugd_db5_writer');
                $kwitansi = []; 
                $db5 = [];
                $kwitansi = Ugd_db5::select('no_tran')->where('no_reg', $no_reg)->where('tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('deleted')->groupBy(array('tanggal', 'no_reg', 'no_tran'))->get();
                if (count($kwitansi) > 0) { /* persiapn kwitansi lebih dari 1 */
                    foreach ($kwitansi as $row) {
                        $no_tran = $row->no_tran;
                        if (!empty($get_no_tran)) {
                            $no_tran = $get_no_tran;     
                        }
                        $db5 = Ugd_db5::leftJoin('ugd_no_perk', function ($join) {
                            $join->on('ugd_db5.no_perk', '=', 'ugd_no_perk.no_perk');
                            })->where('ugd_db5.no_reg', $no_reg)->where('ugd_db5.no_tran', $no_tran)->where('ugd_db5.tanggal', date("Y-m-d", strtotime($tanggal)))->whereNull('ugd_db5.deleted')->get(
                                array('ugd_db5.netto', 'ugd_db5.no_perk', 'ugd_db5.jumlah', 'ugd_db5.kwanta', 'ugd_db5.dokter', 'ugd_db5.bangsal', 'ugd_db5.tgl_masuk', 'ugd_db5.jam_masuk', 'ugd_db5.tanggal', 'ugd_db5.jam', 'ugd_db5.no_tran', 'ugd_no_perk.na_perk')
                            );
                    }
                }

                $tgl_masuk = null; 
                $jam_masuk = null; 
                $tgl_spm = ""; 
                $row = null; 
                $kd_dr = ""; 
                $kd_poli = "";
                if (count($db5) > 0) {
                    foreach ($db5 as $row) {
                        $tgl_masuk = $row->tgl_masuk;
                        $jam_masuk = $row->jam_masuk;
                        $tgl_spm = date("d-m-Y; H:i:s", strtotime($row->tanggal." ".$row->jam));
                        $jumlah = $jumlah + $row->netto;
                        $kd_dr = $row->dokter;
                        $kd_poli = $row->bangsal;
                        $no_kwt = $row->no_tran;
                    }
                }
                $db_writer = null; 
                $db_writer = Ugd_db5_writer::where('no_reg', $no_reg)->where('tgl_masuk', date("Y-m-d", strtotime($tgl_masuk)))->where('jam_masuk', $jam_masuk)->whereNull('deleted')->first(array('writed', 'writer'));
                // if (!empty($db_writer)) {
                    $writer = "";
                    $petugas = "";
                    if (!empty($db_writer)) {
                        $writer = $db_writer->writer;
                        $perawat = Perawat::where('user_id', $writer)->first();
                    }
                    if (empty($perawat)) {
                        $nik = User::find($writer);
                        if (!empty($nik)) {
                            $karyawan = Karyawan::find($nik->user);
                        }
                        if (!empty($karyawan)) {
                            $petugas = $karyawan->nama;
                        }
                    }
                // }
                if ($kd_dr != '') {
                    $dokter = Dokter::find($kd_dr); 
                    $dokter = $dokter->nama2;
                }
                if ($kd_poli != '') {
                    $poli = Poli::find($kd_poli);
                    if (!empty($poli)) {
                        $poli = $poli->nama_poli; 
                    } else {
                        $poli = Bangsal::find($kd_poli); 
                        if (!empty($poli)) {
                            $poli = $poli->nama_bangsal;
                        }
                    }
                }
                
                $data = array(
                    'no_reg' => $no_reg,
                    'nama' => $pasien->nama,
                    'alamat' => $pasien->alamat,
                    'dokter' => $dokter,
                    'poli' => $poli,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_spm' => $tgl_spm,
                    'db5j' => $db5,
                    'jumlah' => $jumlah,
                    'no_kwt' => $no_kwt,
                    'petugas' => $petugas
                );
                // echo json_encode($data); die();
                go('pdf_spm_igd_ranap', $data);
            break; 
        }
    }
    public function pendapatan_harian_igd()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Ugd_db5');
        $this->load->model('Ugd_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($induk) {
            default : 

                $ttd_jabatan = "Ka. Instalasi Gawat Darurat";
                // $ttd_nama = "dr. Erna Fitrisia Kristina,Sp.PD";
                // $ttd_nama = " ";

                $arr_select = array('a.no_tran', 'a.no_reg', DB::RAW("sum(a.kom1) as kom1"), DB::RAW("sum(a.kom2) as kom2"), DB::RAW("sum(a.kom3) as kom3"), DB::RAW("sum(a.kom4) as kom4"), DB::RAW("sum(a.kom5) as kom5"), DB::RAW("sum(a.kom6) as kom6"), 'a.tanggal', 'a.jam', 'a.no_rel', 'b.nama', DB::RAW("c.nama as dokter"), DB::RAW("sum(a.jumlah) as jumlah"), DB::RAW("sum(a.netto) as netto"));
                if ($source<>'') {
                    
                } else {
                    $db5 = DB::table('bill.ugd_db5 as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                    $db5j = DB::table('bill.ugd_db5j as a')->select($arr_select)->whereRaw("a.tanggal >= '$atanggal' and a.tanggal <= '$btanggal'")->whereNull('a.deleted')->orderBy('a.no_tran', 'asc')->groupBy(array('a.no_tran', 'a.no_reg'))
                        ->leftJoin('rsiklaten.pasien as b', function ($join) {
                                $join->on('a.no_reg', '=', 'b.no_reg');
                            })
                        ->leftJoin('bill.dokter as c', function ($join) {
                                $join->on('a.kd_dr', '=', 'c.no_dr');
                                $join->on(DB::RAW('c.deleted = 0'), DB::RAW(''), DB::RAW(''));
                            });
                }
                
                $content = array(
                    array(
                        "title" => "RAWAT INAP",
                        "category" => "GAWAT DARURAT",
                        "rawat" => "INAP",
                        "data" => $db5->get() 
                    ),
                    array(
                        "title" => "RAWAT JALAN",
                        "category" => "GAWAT DARURAT",
                        "rawat" => "JALAN",
                        "data" => $db5j->get()
                    )  
                ); 
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'domain'        => "GAWAT DARURAT",
            'content'    => $content,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        go('pdf_pendapatan_harian_igd', $data);
    }

    public function aktivitas_pelayanan_igd()
    {
        $this->load->model('User');
        $this->load->model('source');
        $this->load->model('Hd_db5');
        $this->load->model('Hd_db5j');

        $atanggal = date('Y-m-d', strtotime(segment(4)));
        $btanggal = date('Y-m-d', date(strtotime("+0 day", strtotime(segment(5)))));
        $source = segment(6);
        $content  = array();

        $akses = self::akses_menu();
        $nik = $akses->nik;
        $induk = $akses->induk;

        $hari = date('N', strtotime($atanggal));
        $ttd_jabatan = ""; 
        $ttd_nama = ""; 

        switch ($source) {
            default :
                $ttd_jabatan = "Ka. Instalasi Gawat Darurat";
                // $ttd_nama = "dr. Erna Fitrisia Kristina,Sp.PD";
                $arr_select = array('a.no_tran', 'a.no_reg', 'a.tanggal', 'a.jam', 'a.no_rel', 'a.no_perk', 'b.nama', DB::RAW("c.na_perk as na_perk"));
                $content = DB::select("
                    SELECT 
                    aa.no_perk, aa.na_perk, SUM(inap) AS inap, SUM(jalan) AS jalan
                    FROM (
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 1 as inap, 0 as jalan
                        FROM 
                            bill.ugd_db5 a 
                            LEFT JOIN bill.ugd_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'    
                        UNION ALL
                        SELECT
                            a.no_tran, a.no_reg, a.tanggal, a.no_perk, b.na_perk, 0 as inap, 1 as jalan
                        FROM 
                            bill.ugd_db5j a 
                            LEFT JOIN bill.ugd_no_perk b  
                                ON a.no_perk = b.no_perk  
                        WHERE 
                            a.deleted IS NULL
                            AND a.tanggal BETWEEN '$atanggal' AND '$btanggal'      
                        ) aa
                    GROUP BY aa.no_perk
                    ORDER BY aa.no_perk ASC
                    ");
                break; 
        }



        $data1 = array(
            'nik'        => $nik,
            'content'    => $content,
            'source'     => $source,
            'tanggal'    => segment(4),
            'tanggal1'   => date('d-m-Y', strtotime(segment(4))),
            'tanggal2'   => date('d-m-Y', strtotime(segment(5))),
            'ttd_jabatan' => $ttd_jabatan, 
            'ttd_nama' => $ttd_nama
        );
        // die(json_encode($data1));
        $data2 = self::acc('RJ');
        $data = array_merge($data1, $data2);

        if ($nik=='100952') {
            // die(json_encode($data));
        }
        go('pdf_aktivitas_pelayanan_igd', $data);
    }

    public function data_sosial_rawat_inap()
    {
        include('pdf.controllers/data_sosial_rawat_inap.pdf.php');
    }

    public function general_consent()
    {
        include('pdf.controllers/general_consent.pdf.php');
    }
    public function general_consent_sat()
    {
        include('pdf.controllers/general_consent_sat.pdf.php');
    }

    public function sdp()
    {
       include('pdf.controllers/sdp.pdf.php');
    }
    public function sdp2()
    {
       include('pdf.controllers/sdp2.pdf.php');
    }

    public function akad_ijarah_bpjs_i_naik_kelas_vip()
    {
       include('pdf.controllers/akad_ijarah_bpjs_i_naik_kelas_vip.pdf.php');
    }
    public function akad_ijarah_bpjs_ii_naik_kelas_vip()
    {
       include('pdf.controllers/akad_ijarah_bpjs_ii_naik_kelas_vip.pdf.php');
    }
    public function akad_ijarah_bpjs_naik_kelas_vip()
    {
       include('pdf.controllers/akad_ijarah_bpjs_naik_kelas_vip.php');
    }
    public function akad_ijarah_bpjs_naik_kelas_i()
    {
       include('pdf.controllers/akad_ijarah_bpjs_naik_kelas_i.php');
    }
    public function akad_ijarah_bpjs_naik_kelas_ii()
    {
       include('pdf.controllers/akad_ijarah_bpjs_naik_kelas_ii.php');
    }
    public function akad_ijarah_bpjs_sesuai_kelas()
    {
       include('pdf.controllers/akad_ijarah_bpjs_sesuai_kelas.php');
    }
    public function akad_ijarah_bpjs_mutasi_kelas()
    {
       include('pdf.controllers/akad_ijarah_bpjs_mutasi_kelas.php');
    }
    public function akad_ijarah_umum()
    {
       include('pdf.controllers/akad_ijarah_umum.php');
    }
    public function akad_ijarah_asuransi()
    {
       include('pdf.controllers/akad_ijarah_asuransi.php');
    }
    public function akad_ijarah_all()
    {
       include('pdf.controllers/akad_ijarah_all.pdf.php');
    }
    public function edukasi_jkn()
    {
       include('pdf.controllers/edukasi_jkn.pdf.php');
    }
    public function pencatatan_dpjp()
    {
       include('pdf.controllers/pencatatan_dpjp.pdf.php');
    }
    public function analisa_keperawatan()
    {
       include('pdf.controllers/analisa_keperawatan.pdf.php');
    }
    public function implementasi_keperawatan()
    {
       include('pdf.controllers/implementasi_keperawatan.php');
    }
    public function asesmen_belajar()
    {
        include('pdf.controllers/asesmen_belajar.php');
    }

    public function asesmen_belajar_new()
    {
        include('pdf.controllers/asesmen_belajar_new.php');
    }
    public function kebutuhan_edukasi_dan_hambatan()
    {
        include('pdf.controllers/kebutuhan_edukasi_dan_hambatan.pdf.php');
    }

    public function asesmen_belajar_new_blank()
    {
        include('pdf.controllers/asesmen_belajar_new_blank.php');
    }

    public function edukasi_integrasi_pasien_keluarga()
    {
        include('pdf.controllers/edukasi_integrasi_pasien_keluarga.pdf.php');
    }

    public function form_edukasi_integrasi_pasien_keluarga()
    {
        include('pdf.controllers/form_edukasi_integrasi_pasien_keluarga.php');
    }

    public function form_edukasi_integrasi_pasien_keluarga_blank()
    {
        include('pdf.controllers/form_edukasi_integrasi_pasien_keluarga_blank.php');
    }

    public function evaluasi_perkembangan_pasien()
    {
       include('pdf.controllers/evaluasi_perkembangan_pasien.php');
    }
    public function catatan_observasi_khusus_intervensi_dan_pengkajian_ulang_nyeri()
    {
       include('pdf.controllers/catatan_observasi_khusus_intervensi_dan_pengkajian_ulang_nyeri.php');
    } 
    public function hasil_pemeriksaan_penunjang_lab_dan_rd()
    {
       include('pdf.controllers/hasil_pemeriksaan_penunjang_lab_dan_rd.php');
    }
    public function asesmen_ulang_spiritual()
    {
       include('pdf.controllers/asesmen_ulang_spiritual.php');
    }
    public function informasi_obat_pulang()
    {
       include('pdf.controllers/informasi_obat_pulang.php');
    }
    public function catatan_perkembangan_pasien_terintegrasi()
    {
       include('pdf.controllers/catatan_perkembangan_pasien_terintegrasi.php');
    }
    public function komunikasi_edukasi_harian_pd_pasien_dan_keluarga()
    {
       include('pdf.controllers/komunikasi_edukasi_harian_pd_pasien_dan_keluarga.php');
    }
    public function pemberian_informasi_pelayanan_rawat_inap_persetujuan()
    {
       include('pdf.controllers/pemberian_informasi_pelayanan_rawat_inap_persetujuan.pdf.php');
    }
    public function pemberian_informasi_pelayanan_rawat_inap_penolakan()
    {
       include('pdf.controllers/pemberian_informasi_pelayanan_rawat_inap_penolakan.pdf.php');
    }
    public function form_pendaftaran_pasien_baru()
    {
       include('pdf.controllers/form_pendaftaran_pasien_baru.php');
    }
    public function form_pendaftaran_pasien_baru_xx()
    {
       include('pdf.controllers/form_pendaftaran_pasien_baru_xx.php');
    }
    public function se_peserta_rsi_klaten()
    {
       include('pdf.controllers/se_peserta_rsi_klaten.pdf.php');
    }
    public function pengkajian_intervensi_resiko_pasien_dewasa_morse()
    {
        include('pdf.controllers/pengkajian_intervensi_resiko_pasien_dewasa_morse.php');
    }
    public function pengkajian_intervensi_resiko_pasien_dewasa_morse_blank()
    {
        include('pdf.controllers/pengkajian_intervensi_resiko_pasien_dewasa_morse_blank.php');
    }
    public function pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp()
    {
        include('pdf.controllers/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp.php');
    }
    public function pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp_blank()
    {
        include('pdf.controllers/pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp_blank.php');
    }
    public function pengkajian_risiko_jatuh_pasien_geriatri()
    {
        include('pdf.controllers/pengkajian_risiko_jatuh_pasien_geriatri.php');
    }
    public function pengkajian_risiko_jatuh_pasien_geriatri_blank()
    {
        include('pdf.controllers/pengkajian_risiko_jatuh_pasien_geriatri_blank.php');
    }
    public function pengkajian_dan_intervensi_resiko_jatuh_pada_pasien_neonotus()
    {
        include('pdf.controllers/pengkajian_dan_intervensi_resiko_jatuh_pada_pasien_neonotus.php');
    }
    public function pengkajian_dan_intervensi_resiko_jatuh_pada_pasien_neonotus_blank()
    {
        include('pdf.controllers/pengkajian_dan_intervensi_resiko_jatuh_pada_pasien_neonotus_blank.php');
    }
    public function intervensi_risiko_jatuh_pasien_geriatri()
    {
        include('pdf.controllers/intervensi_risiko_jatuh_pasien_geriatri.php');
    }
    public function resume_keperawatan_ringkasan_pasien_pulang()
    {
        include('pdf.controllers/resume_keperawatan_ringkasan_pasien_pulang.pdf.php');
    }
    public function asuhan_keperawatan_perioperatif()
    {
        include('pdf.controllers/asuhan_keperawatan_perioperatif.php');
    }
    public function catatan_balance_cairan()
    {
        include('pdf.controllers/catatan_balance_cairan.pdf.php');
    }
    public function laporan_sedasi_dan_anestesi()
    {
        include('pdf.controllers/laporan_sedasi_dan_anestesi.php');
    }
    public function laporan_sedasi_dan_anestesi_dev()
    {
        include('pdf.controllers/laporan_sedasi_dan_anestesi_dev.php');
    }
    public function laporan_operasi()
    {
        include('pdf.controllers/laporan_operasi.pdf.php');
    }
    public function laporan_operasi2()
    {
        include('pdf.controllers/laporan_operasi2.pdf.php');
    }
    public function laporan_operasi_start()
    {
        include('pdf.controllers/laporan_operasi_start.pdf.php');
    }
    public function laporan_operasi_end()
    {
        include('pdf.controllers/laporan_operasi_end.pdf.php');
    }
    public function pemberian_informasi_tindakan_kedokteran_operasi()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_kedokteran_operasi.php');
    }
    public function pemberian_informasi_tindakan_kedokteran_operasi_odontektomy()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_kedokteran_operasi_odontektomy.php');
    }
    public function pemberian_informasi_tindakan_kedokteran_operasi_non_odontektomy()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_kedokteran_operasi_non_odontektomy.php');
    }
    public function pemberian_informasi_tindakan_kedokteran_intubasi()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_kedokteran_intubasi.php');
    }
    public function pemberian_informasi_tindakan_regional_anestesi()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_regional_anestesi.pdf.php');
    }
    public function pemberian_informasi_tindakan_general_anestesi()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_general_anestesi.pdf.php');
    }
    public function pemberian_informasi_tindakan_tindakan_operasi_section_caesaria()
    {
        include('pdf.controllers/pemberian_informasi_tindakan_tindakan_operasi_section_caesaria.pdf.php');
    }
    public function persetujuan_tindakan_kedokteran()
    {
        include('pdf.controllers/persetujuan_tindakan_kedokteran.php');
    }
    public function pemesanan_prosthesa_gigi()
    {
        include('pdf.controllers/pemesanan_prosthesa_gigi.php');
    }
    public function kunjung_vaksinasi_dewasa()
    {
        include('pdf.controllers/kunjung_vaksinasi_dewasa.php');
    }
    public function permohonan_vaksin()
    {
        include('pdf.controllers/permohonan_vaksin.php');
    }
    public function check_list_keselamatan_operasi()
    {
        include('pdf.controllers/check_list_keselamatan_operasi.php');
    }
    public function check_list_keselamatan_operasi_frd()
    {
        include('pdf.controllers/check_list_keselamatan_operasi_frd.php');
    }
    public function checklist_serah_terima_pasien_operasi()
    {
        include('pdf.controllers/checklist_serah_terima_pasien_operasi.php');
    }
    public function checklist_serah_terima_pasien_operasi_portrait()
    {
        include('pdf.controllers/checklist_serah_terima_pasien_operasi_portrait.pdf.php');
    }
    public function assesmen_pra_sedasi_dan_anestesi()
    {
        include('pdf.controllers/assesmen_pra_sedasi_dan_anestesi.php');
    }
    public function penolakan_tindakan_kedokteran()
    {
        include('pdf.controllers/penolakan_tindakan_kedokteran.php');
    }
    public function edukasi_multi_disiplin()
    {
        include('pdf.controllers/edukasi_multi_disiplin.pdf.php');
    }
    public function pemberian_informasi_penundaan_pelayanan()
    {
        include('pdf.controllers/pemberian_informasi_penundaan_pelayanan.php');
    }
    public function perencanaan_pulang_dp()
    {
        include('pdf.controllers/perencanaan_pulang_dp.php');
    }
    public function persetujuan_tindakan_vaksin()
    {
        include('pdf.controllers/persetujuan_tindakan_vaksin.php');
    }
    public function label_12()
    {
        include('pdf.controllers/label_12.pdf.php');
    }
   
    public function label_penyimpanan()
    {
        include('pdf.controllers/label_penyimpanan.pdf.php');
    }

    public function waktu_tunggu_admisi()
    {
        include('pdf.controllers/waktu_tunggu_admisi.pdf.php');
    }
    
    public function sep()
    {
        include('pdf.controllers/sep.pdf.php');
    }
    public function checklist_serah_terima_pasien_operasi_bc()
    {
        include('pdf.controllers/checklist_serah_terima_pasien_operasi_bc.pdf.php');
    }
    public function sensus_mjkn()
    {
        include('pdf.controllers/sensus_mjkn.pdf.php');
    }
    public function checklist_keselamatan_pasien_keteteriasi_jantung()
    {
        include('pdf.controllers/checklist_keselamatan_pasien_keteteriasi_jantung.pdf.php');
    }

    public function sep_all()
    {
        include('pdf.controllers/sep_all.pdf.php');
    }

    public function formulir_klaim()
    {
        include('pdf.controllers/formulir_klaim.pdf.php');
    }
    
    public function berkas_klaim()
    {
        include('pdf.controllers/berkas_klaim.pdf.php');
    }

    public function berkas_klaim_sep()
    {
        include('pdf.controllers/berkas_klaim_sep.pdf.php');
    }
    public function berkas_klaim_sep3()
    {
        include('pdf.controllers/berkas_klaim_sep3.pdf.php');
    }


    public function berkas_klaim_sep2()
    {
        include('pdf.controllers/berkas_klaim_sep2.pdf.php');
    }

    public function berkas_klaim_farm()
    {
        include('pdf.controllers/berkas_klaim_farm.php');
    }
    public function berkas_klaim_askom()
    {
        include('pdf.controllers/berkas_klai_askom.pdf.php');
    }
    public function formulir_rawat_jalan_kfr()
    {
        include('pdf.controllers/formulir_rawat_jalan_kfr.pdf.php');
    }
    public function lembar_pendampingan_sesi_rehab()
    {
        include('pdf.controllers/lembar_pendampingan_sesi_rehab.pdf.php');
    }
    public function lembar_program_terapi()
    {
        include('pdf.controllers/lembar_program_terapi.pdf.php');
    }
}
