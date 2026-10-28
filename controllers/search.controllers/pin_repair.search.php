<?php 
    $row_kunjung_sep = (object) DB::table('rsik.config')->where('nama', 'AksesKunjungSEP')->first(['nilai']);
    $pin_kunjung_sep = !empty($row_kunjung_sep->nilai)?$row_kunjung_sep->nilai:212;
    json([
        "status" => true,
        "isConfirmed" => !empty(segment(4))&&segment(4)==$pin_kunjung_sep?true:false
    ]);