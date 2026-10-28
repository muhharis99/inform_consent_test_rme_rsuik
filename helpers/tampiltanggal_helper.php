<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_day_name')) {
	function get_day_name($val) {
		if ($val!="") {
			$day = date("D", strtotime($val)); 
			$new_day = "";
			switch ($day) {
				case "Fri" : 
					$new_day = "JUM'AT";
				break; 
				case "Sat" : 
					$new_day = "SABTU";
				break; 
				case "Sun" : 
					$new_day = "AHAD";
				break; 
				case "Mon" : 
					$new_day = "SENIN"; 
				break;
				case "Tue" : 
					$new_day = "SELASA";
				break;
				case "Wed" : 
					$new_day = "RABU";
				break;
				case "Thu" : 
					$new_day = "KAMIS"; 
				break; 
			}
			return $new_day;
		} else {
			return "";
		}
	}
}
if (!function_exists('tampiltanggal')) {
	function tampiltanggal( $datestr, $time=0 ) {
		$bulan 	= (int) strftime("%m", strtotime($datestr));
		$thn 	= (int) strftime("%Y", strtotime($datestr));
		$enbulan 	= (int) strftime("%b", strtotime($datestr));
		$bln="";

		switch ( $bulan ) {
		case "01": $bln="Januari"; $ebln="Jan"; break;
		case "02": $bln="Februari"; $ebln="Feb"; break;
		case "03": $bln="Maret"; $ebln="Mar"; break;
		case "04": $bln="April"; $ebln="Apr"; break;
		case "05": $bln="Mei"; $ebln="Mei"; break;
		case "06": $bln="Juni"; $ebln="Jun"; break;
		case "07": $bln="Juli"; $ebln="Jul"; break;
		case "08": $bln="Agustus"; $ebln="Agu"; break;
		case "09": $bln="September"; $ebln="Sep"; break;
		case "10": $bln="Oktober"; $ebln="Okt"; break;
		case "11": $bln="November"; $ebln="Nop"; break;
		case "12": $bln="Desember"; $ebln="Des"; break;
		}
		$zbulan=substr('00'.$bulan, -2); 
		$tgl = substr( $datestr, 8, 2 );
		$ztgl = substr('00'.$tgl, -2);
		$jam = substr( $datestr, 11, 2 );
		$mnt = substr( $datestr, 14, 2 );
		$dtk = substr( $datestr, 17, 2 );

		if ( $tgl!="00" && $bln!="00" && $thn!="0000" && $tgl!="" && $bln!="" && $thn!="" ) {
			switch ( $time ) {
				case 0: 
					return "$tgl $bln $thn";
					break;
				case 1: 
					return "$tgl $bln $thn $jam:$mnt:$dtk";
					break;
				case 2: 
					return "$tgl-$zbulan-$thn";
					break;
				case 3: 
					return "$tgl-$bulan-$thn $jam:$mnt:$dtk";
					break;
				case 4: 
					return "$tgl $ebln $thn";
					break;
				case 5: 
					return "$tgl $ebln $thn $jam:$mnt:$dtk";
					break;
				case 6: 
					return "$thn-$bulan-$tgl";
					break;
				case 7: 
					return "$jam:$mnt:$dtk";
					break;
				case 8: 
					return "$bln $thn";
					break;
				case 9: 
					return $tgl."/".substr("00".$bulan, -2)."/".$thn; 
					break; 
				case 10: 
					return "$tgl-$zbulan-$thn";
					break;
				case 11: 
					return "$thn-$zbulan-$tgl";
					break;
				case 12: 
					return "$jam:$mnt";
					break;
				case 13: 
					return $tgl."-".substr("00".$bulan, -2)."-".substr("00".$thn, -2); 
					break; 
				case 14: 
					return "$ztgl-$zbulan-$thn";
					break;
				case 15: 
					return "$enbulan $ztgl $jam:$mnt:$dtk $thn";
					break;
				case 16: 
					return "$datestr";
					break;
				case 17: 
					return "$thn";
					break;
				default:
					return "$tgl $bln $thn";
					break;
			}
		} else {
			return "";
		}
	}
}
