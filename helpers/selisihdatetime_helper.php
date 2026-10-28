<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('selisih_datetime')) {
	function selisih_datetime ( $a, $b , $c='') {
		$start_date 	= $a;
		$end_date		= $b;
		
		$birthdate = new DateTime(date("Y-m-d H:i:s",  strtotime(implode('-', array_reverse(explode('/', $a))))));
					$today = new DateTime(date("Y-m-d H:i:s",  strtotime(implode('-', array_reverse(explode('/', $b))))));           
					$selisih_year = $birthdate->diff($today)->y;
					$selisih_month = $birthdate->diff($today)->m;
					$selisih_day = $birthdate->diff($today)->d;
					$selisih_hour = $birthdate->diff($today)->h;
					$selisih_minute = $birthdate->diff($today)->i;
					$selisih_second = $birthdate->diff($today)->s;
					
		$val="";
		switch ($c) {
			case 'masakerja' : 
				if ($selisih_year) { $val.=$selisih_year." Tahun "; }
				if ($selisih_month) { $val.=$selisih_month." Bulan "; }
				if ($selisih_day) { $val.=$selisih_day." Hari "; }
				break; 
			case 'jamkerja' : $val=$selisih_hour; 
				break; 
			case 'umur' :
				$selisih_day = (int) $selisih_day; 
				$selisih_month = (int) $selisih_month; 
				$selisih_year = (int) $selisih_year; 

				if ($selisih_year) { $val.="/".$selisih_year."TH"; }
				if ($selisih_month) { $val.="/".$selisih_month."BL"; }
				if ($selisih_day) { $val.="/".$selisih_day."HR"; } 
				$val=substr($val, 1, strlen($val));
				if ($val=='') {
					$val="0HR";
				}
				break; 
			case 'umurtahun' :
				if ($selisih_year) { $val.='/'.$selisih_year."TH"; }
				$val=substr($val, 2, strlen($val));
				break;
			case 'jam' :
				$second = "00";
				if ($selisih_second) { 
					$second.=$selisih_second; 
				}
				$second = ":".substr($second, -2);
				$minute = "00"; 
				if ($selisih_minute) { 
					$minute.=$selisih_minute; 
				}
				$minute = ":".substr($minute, -2);
				$hour = "00"; 
				if ($selisih_hour) { 
					$hour.=$selisih_hour; 
				}
				$hour = substr($hour, -2);
				$val .= $hour.$minute.$second;
				break;
			case 'jumlah_jam' :
				$val = $selisih_hour;
				break;
			
			default :
				if ($selisih_year) { $val.=$selisih_year." Tahun "; }
				if ($selisih_month) { $val.=$selisih_month." Bulan "; }
				if ($selisih_day) { $val.=$selisih_day." Hari "; }
				if ($selisih_hour) { $val.=$selisih_hour." Jam "; }
				if ($selisih_minute) { $val.=$selisih_minute." Menit "; }
				if ($selisih_second) { $val.=$selisih_second." Detik "; }
				break; 
			
		}
		return $val;
		}			
}
