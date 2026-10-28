<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }

    public function test()
    {
        /*
        $id = 49;
        $indikator = 0;
        $txtY = 242.8;
        $data = DB::table('rme.map_koord_sedasi_anestesi')
                    ->where(array('tipe' => 'page1', 'indikator' => '240'))
                    ->orderByRaw('menit')
                    ->get();
        foreach ($data as $key => $value) {
            DB::table('rme.map_koord_sedasi_anestesi')->insert(array(
                'id' => $indikator.$value['menit'],
                'tipe' => 'page1',
                'indikator' => $indikator,
                'menit' => $value['menit'],
                'txt_x' => $value['txt_x'],
                'txt_y' => $txtY
            ));
            $id++;
        }
        */
        $data = DB::table('rme.map_koord_sedasi_anestesi')
                    ->where(array('tipe' => 'page1', 'indikator' => '240'))
                    ->orderByRaw('menit')
                    ->get();
        foreach ($data as $key => $value) {
            echo $value['nilai_fix'].'<br>';
        }
    }
}
