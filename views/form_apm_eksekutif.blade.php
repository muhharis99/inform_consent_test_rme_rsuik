<style>
     button.btn-command {
          font-size:5em !important;
     }
     .txt-command {
          /* background-color: rgba(248, 248, 248, 0.4) !important; */
          text-align: center; 
          font-weight:bold;
          display:table-cell !important; 
          vertical-align:middle !important;
     }
     .h-150 {
          height:150px !important;
     }
     .h-100 {
          height:80px !important;
          padding-bottom:20px !important;
     }
     .h-80 {
          height:80px !important;
          padding-bottom:20px !important;
     }
     .font-transparent {
          text-shadow: 0 0 4px rgba(0,0,0,0.4) !important;
          color: rgba(248, 248, 248, 0.4) !important;
     }
     .font-white {
          text-shadow: 0 0 4px rgba(0,0,0,0.4) !important;
          color:white; 
     }
     .norm {
          display: table-cell !important;
          font-weight:bold !important;
          padding:0 !important;
          margin:0 !important;
          height:310px !important;
          width:100% !important;
          /* background-color:blue !important; */
          vertical-align:middle !important;
          text-align:center !important;
     }
     .font-8 {
          font-size:8em !important; 
          line-height:1em !important;
     }
     .font-6 {
          font-size:6em !important; 
          line-height:1em !important;
     }
     .font-5 {
          font-size:5em !important; 
          line-height:1em !important;
     }
     .font-4 {
          font-size:4em !important; 
          line-height:1em !important;
     }
     .font-3 {
          font-size:3.5em !important; 
          line-height:1em !important;
     }
     .font-25 {
          font-size:2.5em !important; 
          line-height:1em !important;
     }
     .font-2 {
          font-size:2em !important; 
          line-height:1em !important;
     }
     .font-tinggi {
          transform: scale(1, 2);
               -webkit-transform: scale(1, 2); /* Safari and Chrome */
               -moz-transform: scale(1, 2); /* Firefox */
               -ms-transform: scale(1, 2); /* IE 9+ */
               -o-transform: scale(1, 2); /* Opera */
     }
     .blink_me {
          animation: blinker 1.5s linear infinite;
     }
     @keyframes blinker {  
          10% { opacity: 0; }
     }
     .align-left {
          text-align:left !important; 
     }
     table.tbkonfirmasi tr td {
          vertical-align:top;
          padding-top:8px; 
     }
     .pilih-dokter {
          width: 100%;
          padding: 10px 0; 
          font-size: 3vw;
          line-height: 3vw;
          margin-top:15px;
     }
     .pilih-dokter span {
          font-size: 2vw;
     }
     .pilih-asuransi {
          width: 100%;
          padding: 32px 0; 
          font-size: 3vw;
          line-height: 3vw;
          margin-top:15px;
     }
     .pilih-asuransi span {
          font-size: 2vw;
     }
</style>
<div id="wrapper" style="position:relative; padding:10px 0;z-index:10">
  <!--

  <a href='#' style='position:absolute;top:0;z-index:1000'><img id='logo' border='0' src='logo.png' alt='APM.RSU.ISLAM.KLATEN'></a>
  <div class="console hide">
    <button onclick="jQuery('#bgndVideo').YTPToggleVolume()">Mute/Unmute</button>
    <button onclick="jQuery('#bgndVideo').YTPFullscreen()">Fullscreen</button>
    <button id="debugBtn" class="command" onclick="jQuery('#debug').toggle()"> show/hide the console</button>
  </div>
  -->
     <form id="form_apm_eksekutif" style="display:none;">
          <input type="hidden" name="no_reg" value="" />
          <input type="hidden" name="nama" value="" />
          <input type="hidden" name="tgl_lahir" value="" />
          <input type="hidden" name="no_id" value="" />
          <input type="hidden" name="alamat" value="" />
          <input type="hidden" name="kd_poli" value="" />
          <input type="hidden" name="poli" value="" />
          <input type="hidden" name="kd_dokter" value="" />
          <input type="hidden" name="dokter" value="" />
          <input type="hidden" name="hari" value="" />
          <input type="hidden" name="jam" value="" />
          <input type="hidden" name="jadwal" value="" />
          <input type="hidden" name="asuransi" value="" />
          <input type="hidden" name="kd_asuransi" value="" />
          <input type="hidden" name="pilih_dokter_hal" value="" />
          <input type="hidden" name="pilih_asuransi_hal" value="" />
     </form>
     <div style="display:table !important; width:100%; "><h2 style="" class="txt-command blink_me font-white font-5 h-150">TEKAN NOMER RM</h2></div>
     <div style="display:table !important; width:100%; "><h2 style="color:white;" class="norm font-tinggi font-transparent font-8">POLI EKSEKUTIF</h2></div>

  <div id="filtersControl" class="hide">

    <button id="toggleFilters"
            onclick="jQuery('#bgndVideo').YTPToggleFilters(function(a){if(!a) {$('#toggleFilters').html('enable filters')} else {$('#toggleFilters').html('disable filters')}})">
      disable all filters
    </button>
    <script>
      function rFCallback(f){
        $(".slider[data-filter="+f+"]").updateSliderVal(0);
      }
    </script>
    <button id="removeFilters"
            onclick="jQuery('#bgndVideo').YTPRemoveFilter(rFCallback)">
      remove all filters
    </button>

    <div class="slider"
         data-filter="grayscale"><span>grayscale</span>
    </div>

    <div class="slider"
         data-filter="sepia"><span>sepia</span>
    </div>

    <div class="slider"
         data-filter="hue_rotate"
         data-scale="360"><span>hue rotate</span>
    </div>

    <div class="slider"
         data-filter="invert"><span>invert</span>
    </div>

    <div class="slider"
         data-filter="opacity"><span>opacity</span>
    </div>

    <div class="slider"
         data-filter="saturate"
         data-scale="1000"><span>saturate</span>
    </div>

    <div class="slider"
         data-filter="brightness"
         data-scale="200"><span>brightness</span>
    </div>

    <div class="slider"
         data-filter="contrast"
         data-scale="500"><span>contrast</span>
    </div>

    <div class="slider"
         data-filter="blur"
         data-scale="50"><span>blur</span>
    </div>

    <div id="filterScript"></div>

  </div>


  <div class="goto" style="">
    <button id="togglePlay" class="btn-command">0</button>
    <button id="togglePlay" class="btn-command">1</button>
    <button id="togglePlay" class="btn-command">2</button>
    <button id="togglePlay" class="btn-command">3</button>
    <button id="togglePlay" class="btn-command">4</button>
    <button id="togglePlay" class="btn-command">5</button>
    <button id="togglePlay" class="btn-command">6</button>
    <button id="togglePlay" class="btn-command">7</button>
    <button id="togglePlay" class="btn-command">8</button>
    <button id="togglePlay" class="btn-command">9</button>
    <i class="loading fa fa-spinner fa-spin font-transparent" style="font-size:80px; display:none;"></i>
    <!--
    <button id="togglePlay" class="command" onclick="jQuery('#bgndVideo').YTPTogglePlay()">X</button>
    -->
    <br>
    <br>
    <br>
    <button class="button btn-ulangi" href="#" target="_blank" style="margin-right:20px; width:500px;">&nbsp; &nbsp; ULANGI &nbsp; &nbsp; </button>
    <button class="button btn-lanjutkan" href="#" target="_blank" style="margin-left:20px; width:500px;">LANJUTKAN</button>
    <button class="button btn-refresh" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;">  &nbsp; BUKAN DIRI SAYA,  &nbsp; <br /> &nbsp;  ULANGI PENCARIAN!  &nbsp; </button>
    <button class="button btn-pilih-dokter" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;">  &nbsp; YA DIRI SAYA,  &nbsp; <br />  &nbsp; LANJUT DAFTAR! &nbsp;  </button>
    <button class="button btn-oke" href="#" target="_blank" style="display:none;">  &nbsp; &nbsp;  OK  &nbsp; &nbsp; </button>
    
    <button class="button btn-sebelumnya" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;"> SEBELUMNYA </button>
    <button class="button btn-selanjutnya" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;"> SELANJUTNYA </button>
    <button class="button btn-batal" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;"> BATAL/KELUAR </button>
    <button class="button btn-lainnya" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;"> DOKTER LAINNYA </button>
    
    <button class="button btn-kembali-pilih-dokter" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;"> ULANGI PILIH DOKTER </button>
    <button class="button btn-asuransi" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;"> VERIFIKASI DATA </button>

    <button class="button btn-asuransi-batal" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;"> BATAL/KELUAR </button>
    <button class="button btn-asuransi-lainnya" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;"> PENJAMIN LAINNYA </button>
    
    <button class="button btn-asuransi-kembali-pilih" href="#" target="_blank" style="display:none; margin-right:20px; width:500px;"> ULANGI PILIH PENJAMIN </button>
    <button class="button btn-daftar" href="#" target="_blank" style="display:none; margin-left:20px; width:500px;"> SIMPAN PENDAFTARAN </button>
  </div>


  <!--7SnmCUwOsts--><!--BsekcY04xvQ--><!--r1xohS2u69E--><!--Fk9EBOOAYiU--><!--sEuXfDtrco8--><!--9d8wWcJLnFI--><!--Fk9EBOOAYiU--><!-- VHcAusNO3L4 --><!--Fk9EBOOAYiU-->
  <div id="bgndVideo" class="player hide" data-property="{videoURL:'mEKSQ2N85wA',containment:'body', showControls:false, autoPlay:true, loop:true, vol:0, mute:false, startAt:2,  stopAt:110, opacity:1, addRaster:true, quality:'large', optimizeDisplay:true, addFilters: {grayscale: 50,sepia: 80,opacity: 30}}">My video</div>

</div>
