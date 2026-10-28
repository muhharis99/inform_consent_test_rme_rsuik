<?php 
// die('c');
$no_reg = $_POST['no_reg']; 
$nama = $_POST['nama']; 
$poli = $_POST['poli']; 
$alamat = $_POST['alamat']; 
$dokter = $_POST['dokter'];
$keterangan = $_POST['transaksi'];
$total = $_POST['jumlah'];
$terbilang = $_POST['terbilang'];
$tanggal = $_POST['tgl_spm'];
$no_transaksi = $_POST['no_transaksi'];
$petugas = $_POST['petugas'];
$txt_instalasi = $_POST['txt_instalasi'];
$txt_poli = $_POST['txt_poli'];
$txt_rawat = $_POST['txt_rawat'];
$kode_asuransi = $_POST['kode_asuransi'];
$nama_asuransi = $_POST['nama_asuransi'];
$chn = "chusnun";
function fchar($str, $len) {
    return substr($str."                                        ", 0, $len);
}
function rchar($str) {
    return substr("                                        ".$str, -14);
}
// $pesan=chr(27).chr(67).chr(0).chr(3);
$pesan = "";
$pesan.=chr(27).chr(64);
$pesan.=chr(27).chr(69);
    $pesan.=chr(27).chr(50)."  ".$txt_instalasi." RSU. ISLAM KLATEN";
    $pesan.=chr(10);
    $pesan.="       NOTA SPM : ".chr(27).chr(52).$txt_rawat."      ".chr(14)."POLI".chr(20).chr(27).chr(53);
    // $pesan.=chr(27).chr(49);
$pesan.=chr(27).chr(70);
$pesan.=chr(10).chr(10);
$pesan.="  No. RM : ".substr($no_reg, 0, 3)." ".substr($no_reg, 3, 2)." ".substr($no_reg, 5, 2)."      ";
$pesan.=chr(27).chr(69).chr(27).chr(52)."[No: ".$no_transaksi."]".chr(27).chr(53).chr(27).chr(70);
$pesan.=chr(10);
if (strlen(trim($nama)) > 30) {
    $pesan.="  Nama   : ".chr(15).substr(trim($nama), 0, 40).chr(18);
} else {
    $pesan.="  Nama   : ".substr(trim($nama), 0, 40);
}
$pesan.=chr(10);
$pesan.="  ".$txt_poli.": ".$poli;
$pesan.=chr(10);
$pesan.="  Alamat : ".chr(15).$alamat.chr(18);
$pesan.=chr(10);
$pesan.="  Dokter : ".trim($dokter);
$pesan.=chr(10);
$pesan.=chr(27).chr(49);
$pesan.="  =====================================";
$pesan.=chr(10);
$pesan.="  No. Keterangan           Q      Jml";
$pesan.=chr(10);
$pesan.="  -------------------------------------";
$pesan.=chr(15);
$pesan.=chr(27).chr(48);

$row_kosong = 15; 
$no = 1; 
foreach ($_POST['transaksi'] as $key => $value) {
    $no_kwt = $value['na_perk'];
    $nominal = $value['netto'];
    $satuan = $value['satuan'];
    $pesan.=chr(10)."     ".fchar($no.".", 5).fchar($no_kwt, 37).fchar($satuan, 2).rchar($nominal);
    $no++;
    $row_kosong --; 
}
for ($i=0; $i<$row_kosong; $i++) {
    $pesan.=chr(10);
}
$pesan.="\n".chr(18);
$pesan.="   [".$kode_asuransi."] ".$nama_asuransi;
$pesan.=chr(10);
$pesan.="  -------------------------------------";
$pesan.=chr(10);
$pesan.=chr(27).chr(50);
$pesan.="  ".fchar("T o t a l: ", 28).chr(27).chr(69).$total.chr(27).chr(70);
$pesan.=chr(10);
$pesan.=chr(15);
$pesan.=chr(27).chr(52);
$pesan.="   (".$terbilang.")";
$pesan.=chr(27).chr(53);
$pesan.=chr(18);
$pesan.=chr(10);
$pesan.="  -------------------------------------";
$pesan.=chr(10);
$pesan.=chr(15);
$pesan.=chr(27).chr(49);
$pesan.="                      ".fchar("Kasir ", 24).$tanggal;
$pesan.=chr(10);
$pesan.=chr(10);
$pesan.=chr(10);
$pesan.=chr(10);
$pesan.=chr(10);
$pesan.="                                      ".$petugas;
$pesan.=chr(10);
$pesan.=chr(27).chr(50);
$pesan.="\n".chr(12);


 $fp = fopen("LPT1", "w");
 fprintf($fp, $pesan);
 fclose($fp);
/*
 
$fp = fopen("/dev/lp0", "w");
fprintf($fp, $pesan);
fclose($fp);
*/

$data = array(
    "status" => true, 
    "message" => 'success', 
    "version" => '1.0.1'
);

echo json_encode($data); die();

?>
