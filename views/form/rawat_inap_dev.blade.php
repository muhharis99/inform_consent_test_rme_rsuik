<style>
    h4.alert{
        padding-top:0.7em !important;
    }
</style>

<style>
    .modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 1000px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

    /*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
    /*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    /* ----- v CAN BE DELETED v ----- */
    xbody {
        background-color: #78909C;
    }

    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .btn-demo {
        margin: 15px;
        padding: 10px 15px;
        border-radius: 0;
        font-size: 16px;
        background-color: #FFFFFF;
    }

    .btn-demo:focus {
        outline: 0;
    }

    .demo-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 15px;
        background-color: #212121;
        text-align: center;
    }

    .demo-footer > a {
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        color: #fff;
    }
    .swal-wide{
        width:550px !important;
    }
    #nama_poli_div {
        background-color: #ce4141;
        color: white;
        padding: 10px;
        border-radius: 5px;
        position: fixed;
        top: 10px;
        right: 112px;
        z-index: 1000;
        display: none; 
        animation: kedip 1s infinite;
      }

      @keyframes kedip {
        0%, 100% {
          opacity: 1;
        }
        50% {
          opacity: 0;
        }
      }
</style>
<style>
    .modal-header {
        background-color: #009688;
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <!--
        <div class="txr col-md-12"><a href="{{ URL }}rme/main/askep" class="btn btn-default">ASKEP Poli</a></div>
        -->
        <h2 class="row-centered col-md-12">
            PENDAFTARAN RAWAT INAP
            <!-- <br>
            <h5 align="center">(RM uji coba = 0000003 , 0000004 , 0000005)</h5> -->
        </h2>
        <div onclick="checkdr()" style="display:none; cursor:pointer; z-index:100; position: absolute;font-size: 2rem;color: red;font-weight: bold;margin-top: 50px;margin-left: 15px;text-align: center;">
            Antrian Sekarang : <span id="noantrian"></span>
        </div>
        <div class="text-right col-md-12"><b>Pengguna: </b><span id="user" nik="{{ $nik }}" poli="{{ $kd_poli }}" induk="{{ $induk }}" dokter="{{ $kd_dokter }}">{{ $akses }}</span></div>
        
        <div class="col-md-12 text-right">
            <a href="#" id="cek_plugin">
                <i class="fa fa-refresh"></i>
            </a>
            <i class="fa fa-print"></i>
            <a href="#" id="menu_printer">
                <i class="fa fa-cog"></i>
            </a>
            <span id="status_plugin" style="color:orange;"> Mendeteksi Plugin</span>
        </div>
        <!-- <div class="col-md-12 col-xs-12 col-sm-12"> -->
        <div class="col-md-12">
            <div id="content">
                <form action="javascript:void(0)" class="form-horizontal" id="transaksi" method="post" name="transaksi">
                    <h4 class="alert alert-success">
                        <i class="fa fa-user" aria-hidden="true"></i> &nbsp;DATA PASIEN
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div id="nama_poli_div"></div>
                    <div class="form-group" id="sf1">
                        <input id="id" name="id" type="hidden"/>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="no_reg">
                                    No.RM :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input id="hispx" name="hispx" readonly="readonly" required="" type="hidden" value="">
                                            </input>
                                            <input id="ur_tgl_rs" name="ur_tgl_rs" type="hidden" value="">
                                            </input>
                                            <input id="id_kunjung" name="id_kunjung" type="hidden" value="">
                                            <input id="status_bayi" name="status_bayi" type="hidden" value="">
                                            </input>
                                            <input autocomplete="off" class="form-control has-spinner" id="no_reg" maxlength="7" name="no_reg" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama" name="nama" readonly="" title="" type="text" value="">
                                        </input>
                                        <div class="input-group-btn">
                                            <button class="button btn btn-danger" id="btn_cari_pasien" value="CARI PASIEN" type="button" style="width:100px; padding-bottom:9px; padding-top:13px;">
                                                CARI PASIEN
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="alamat">
                                    Alamat :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat" name="alamat" maxlength="65" readonly="" title="" type="text" value="">
                                        </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="tgl_lahir">
                                    Tanggal Lahir :
                                </label>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_lahir" style="width:10em;" name="tgl_lahir" readonly="" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="umur" name="umur" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <label class="control-label col-md-1" for="ktp">
                                    KTP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="ktp" name="ktp" title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="jenis_kelamin">
                                    Jenis Kelamin :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="jenis_kelamin" name="jenis_kelamin" required="required">
                                        <option value="L">LAKI-LAKI</option>                                        
                                        <option value="P">PEREMPUAN</option>                                        
                                        <option value="K">TIDAK DIKETAHUI</option>                                        
                                        <option value="T">TIDAK DITENTUKAN</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="telp_1">
                                    No Telp :
                                </label>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="telp_1" style="width:10em;" name="telp_1" readonly="" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="telp_2" name="telp_2" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <label class="control-label col-md-1" for="agama">
                                    Agama :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12"> 
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="agama" name="agama"  required="required">
                                        <option value=""></option>
                                        @foreach($rows_agama as $agama)
                                        <option value="{{$agama['kd_agama']}}">{{$agama['agama']}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-md-2" for="nama_pekerjaan">
                                    Pekerjaan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_pekerjaan" name="nama_pekerjaan" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="tgl_periksa">
                                    Tanggal Periksa :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_periksa" name="tgl_periksa" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="jam_periksa">
                                    Jam :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="jam_periksa" name="jam_periksa"  title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="kawin">
                                    Perkawinan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kawin" name="kawin" required="required">
                                        <option value=""></option>
                                        @foreach($rows_kawin as $kawin)
                                        <option value="{{$kawin['kd_perkawinan']}}">{{$kawin['nama_perkawinan']}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="ibu_kandung">
                                    Ibu Kandung :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="ibu_kandung" name="ibu_kandung">
                                                <option value=""></option>
                                                <option value="1">Ya</option>
                                                <option value="2">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label" for="asuransi">
                                    Asuransi :
                                </label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="kode_asuransi" name="kode_asuransi" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="asuransi" name="asuransi" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label" for="kode_poli">
                                    Poli/UGD :
                                </label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="kode_poli" name="kode_poli" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_poli" name="nama_poli" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label" for="kode_dokter">
                                    Dokter :
                                </label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="kode_dokter" name="kode_dokter" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_dokter" name="nama_dokter" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="cara_datang">
                                    Rujukan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="cara_datang" name="cara_datang">
                                        <option value="">
                                        </option>
                                        @foreach($rujuk as $row)
                                        <option value="{{$row['id_rujuk']}}">
                                            {{$row['rujuk']}}
                                        </option> 
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-md-2" for="praktek_rsi">
                                    Praktek RSI :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <select class="chosen-select" style="" data-placeholder="Silahkan Pilih..." id="praktek_rsi" name="praktek_rsi">
                                                <option value=""></option>
                                                <option value="Y">Ya</option>
                                                <option value="T">Tidak</option>
                                            </select>
                                        </div>
                                        <select class="chosen-select" style="width:100%;" data-placeholder="Silahkan Pilih..." id="kode_dokter_perujuk" name="kode_dokter_perujuk">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_perujuk">
                                    Nama Perujuk :
                                </label>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_perujuk" name="nama_perujuk" title="" type="text" value="" />
                                </div>
                                <label class="control-label col-md-1" for="alamat_perujuk">
                                    Alamat  :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_perujuk" name="alamat_perujuk" title="" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="tgl_dirawat">
                                    Tanggal Dirawat :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_dirawat" name="tgl_dirawat" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="jam_dirawat">
                                    Jam Dirawat :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="jam_dirawat" name="jam_dirawat" title="" type="text" value="">
                                    </input>
                                </div>
                                
                                <label class="control-label col-md-2" for="tgl_mulai_admisi">
                                    Waktu Mulai Admisi :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_mulai_admisi" name="tgl_mulai_admisi" readonly="" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="kode_bangsal">
                                    Ruang Perawatan :
                                </label>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kode_bangsal" name="kode_bangsal">
                                        <option value="">
                                        </option>
                                        @foreach ($bangsal as $row_bangsal)
                                        <option value="{{ $row_bangsal->kd_bangsal }}">
                                            @if(substr($row_bangsal->nama_pendaftaran, 0, 3)=="ZAM") 
                                            {{ $row_bangsal->induk_nama_pendaftaran." - ".$row_bangsal->kd_kelas_pendaftaran }}
                                            @else
                                            {{ $row_bangsal->nama_pendaftaran }}
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-md-1" for="no_bed">
                                    No Bed :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_bed" name="no_bed" title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="tgl_selesai_admisi">
                                    Waktu Selesai Admisi :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_selesai_admisi" name="tgl_selesai_admisi" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label" for="kode_asuransi_ri">
                                    Asuransi Rawat Inap :
                                </label>
                                <div class="col-sm-3">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kode_asuransi_ri" name="kode_asuransi_ri">
                                        <option value="">
                                        </option>
                                        @foreach ($asuransi as $row_asuransi)
                                        <option value="{{ $row_asuransi->NO_REL }}">
                                            {{ $row_asuransi->NAMA }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-md-1" for="hak_kelas">
                                    Hak Kelas :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hak_kelas" name="hak_kelas">
                                        <option value=""></option>
                                        <option value="I">KELAS I</option>
                                        <option value="II">KELAS II</option>
                                        <option value="III">KELAS III</option>
                                        <option value="VIP">KELAS VIP</option>
                                        <option value="VVIP">KELAS VVIP</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-2" for="kelas_perawatan">
                                    Kelas Perawatan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kelas_perawatan" name="kelas_perawatan" required="required">
                                        <option value="">
                                        
                                        </option>
                                        <option value="I">KELAS I</option>
                                        <option value="II">KELAS II</option>
                                        <option value="III">KELAS III</option>
                                        <option value="VIP">KELAS VIP</option>
                                        <option value="VVIP">KELAS VVIP</option>
                                        <option value="MUTASI">MUTASI KELAS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="dpjp_1">
                                    DPJP 1 :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_1" name="dpjp_1" required="">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="dpjp_2">
                                    DPJP 2 :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_2" name="dpjp_2">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="dpjp_3">
                                    DPJP 3 :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_3" name="dpjp_3">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="dpjp_4">
                                    DPJP 4 :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_4" name="dpjp_4">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="dpjp_5">
                                    DPJP 5 :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_5" name="dpjp_5">
                                            <option value="">
                                            </option>
                                            @foreach ($dokter as $row_dokter)
                                            <option value="{{ $row_dokter->no_dr }}">
                                                {{ $row_dokter->nama2 }}
                                            </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_penanggung_jawab">
                                    Penanggung Jawab :
                                </label>
                                <label class="control-label col-md-1" for="nama_penanggung_jawab">
                                    Nama :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_penanggung_jawab" name="nama_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="alamat_penanggung_jawab">
                                    Alamat :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_penanggung_jawab" name="alamat_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="tgl_lahir_penanggung_jawab">
                                    Tgl Lahir :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_lahir_penanggung_jawab" name="tgl_lahir_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="jenis_kelamin_penanggung_jawab">
                                    Jenis Kelamin :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="jenis_kelamin_penanggung_jawab" name="jenis_kelamin_penanggung_jawab">
                                        <option value=""></option>                                        
                                        <option value="L">LAKI-LAKI</option>                                        
                                        <option value="P">PEREMPUAN</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="no_ktp_penanggung_jawab">
                                    No KTP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_ktp_penanggung_jawab" name="no_ktp_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="no_telp_penanggung_jawab">
                                    No Telp/HP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_telp_penanggung_jawab" name="no_telp_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="pekerjaan_penanggung_jawab">
                                    Pekerjaan :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="pekerjaan_penanggung_jawab" name="pekerjaan_penanggung_jawab">
                                            <option value="">
                                            </option>
                                            @foreach($kerja as $row)
                                            <option value="{{$row['kd_pekerjaan']}}">
                                                {{$row['pekerjaan']}}
                                            </option> 
                                            @endforeach
                                        </select>
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control" style="width:310px;" id="pekerjaan_penanggung_jawab_lain" name="pekerjaan_penanggung_jawab_lain" readonly="readonly" type="text" value="">
                                            </input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="hub_penanggung_jawab">
                                    Hubungan dgn pasien:
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="hub_penanggung_jawab" name="hub_penanggung_jawab" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="">
                                    Penerima Informasi Darurat :
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_1">
                                    1.
                                </label>
                                <label class="control-label col-md-1" for="nama_darurat_1">
                                    Nama :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_darurat_1" name="nama_darurat_1" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="alamat_darurat_1">
                                    Alamat :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_darurat_1" name="alamat_darurat_1" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="umur_darurat_1">
                                    Umur :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="umur_darurat_1" name="umur_darurat_1" title="" type="text" value="">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner thn" style="width:50px;" readonly="true" data-original-title="" id="" name="" title="" type="text" value="THN">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-1" for="telp_darurat_1">
                                    Telp/HP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="telp_darurat_1" name="telp_darurat_1" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="hub_darurat_1">
                                    Hub. dengan pasien:
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="hub_darurat_1" name="hub_darurat_1" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_2">
                                    &nbsp; 
                                </label>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_2">
                                    2.
                                </label>
                                <label class="control-label col-md-1" for="nama_darurat_2">
                                    Nama :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_darurat_2" name="nama_darurat_2" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="alamat_darurat_2">
                                    Alamat :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_darurat_2" name="alamat_darurat_2" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="umur_darurat_2">
                                    Umur :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="umur_darurat_2" name="umur_darurat_2" title="" type="text" value="">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner thn" style="width:50px;" readonly="true" data-original-title="" id="" name="" title="" type="text" value="THN">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-1" for="telp_darurat_2">
                                    Telp/HP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="telp_darurat_2" name="telp_darurat_2" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="hub_darurat_2">
                                    Hub. dengan pasien:
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="hub_darurat_2" name="hub_darurat_2" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_3">
                                    &nbsp; 
                                </label>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_3">
                                    3.
                                </label>
                                <label class="control-label col-md-1" for="nama_darurat_3">
                                    Nama :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_darurat_3" name="nama_darurat_3" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="alamat_darurat_3">
                                    Alamat :
                                </label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_darurat_3" name="alamat_darurat_3" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-3" for="umur_darurat_3">
                                    Umur :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="umur_darurat_3" name="umur_darurat_3" title="" type="text" value="">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner thn" style="width:50px;" readonly="true" data-original-title="" id="" name="" title="" type="text" value="THN">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-1" for="telp_darurat_3">
                                    Telp/HP :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="telp_darurat_3" name="telp_darurat_3" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="hub_darurat_3">
                                    Hub. dengan pasien:
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="hub_darurat_3" name="hub_darurat_3" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group form-nota-spm" id="sf8">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-default">
                                <div class="row">
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .form-group .col-md-12 .alert-warning .row .btn, .btn-nota {
                            padding-top:1.2em !important;
                        }
                    </style>
                    <div class="form-group form-button" id="sf7">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-warning text-right">
                                <div class="row">
                                    <!--
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak_label_stiker" data-type="" name="cetak_label_stiker">
                                        Cetak Label - Pita
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak_label" data-type="print_pdf" data-url="http://192.168.0.16/serverx/bill/pdf/label_stiker/0000001" name="cetak_label">
                                        Cetak Label - Tinta
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak" name="cetak">
                                        Cetak Ulang
                                    </button>
                                    -->
                                    <div class="col-md-3">&nbsp; </div>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        <i class="fa fa-save" aria-hidden="true"></i> &nbsp; Simpan
                                    </button>

                                    <!-- <button class="col-xs-12 col-md-2 btn btn-danger" onclick="window.location.href='{{ URL }}admisi/main/drawpad_admisi'" id="ttd_pasien" title="">
                                      <i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Tanda Tangan Pasien
                                    </button> -->
                                    <a class="col-xs-12 col-md-2 btn btn-danger" href="{{ URL }}admisi/main/drawpad_admisi" id="ttd_pasien" title=""><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;Tanda Tangan Pasien</a>

                                    <div class="col-md-3">&nbsp; </div>
                                    
                                    <button class="col-xs-8 col-md-2 btn btn-danger" id="hapus" name="hapus">
                                        <i class="fa fa-trash" aria-hidden="true"></i> &nbsp; Hapus Data Inap
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="ubah" name="ubah">
                                        Ubah
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="batal" name="batal">
                                        Batal
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" id="">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-default">
                                <div class="row">
                                    <br />&nbsp;
                                    <br />&nbsp;
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal">
                    <h4 class="alert alert-success">
                        <i class="fa fa-file" aria-hidden="true"></i> &nbsp;DOKUMEN PASIEN 
                    </h4>
                    <style>
                        .text-left {
                            text-align:left !important;
                        }
                        .text-right {
                            text-align:right !important;
                        }
                    </style>
                    <div class="form-group form-cetak-dokumen" id="sf1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label col-md-2" for="printer_default">
                                        Pilih Printer :
                                    </label>
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="printer_default" name="printer_default">
                                            <option value="">
                                            </option>
                                            @foreach($printer as $row)
                                            <option
                                                <?php 
                                                if ($row['printer']==$default_printer) {
                                                    echo 'selected';
                                                }
                                                ?> 
                                                value="{{$row['printer']}}">
                                                {{$row['nama']}}
                                            </option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <input id="printer_default2" name="printer_default2" value="mbk_atik" hidden>
                                </div>  
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;  
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"> 
                                    <div data-url="admisi/pdf/data_sosial_rawat_inap">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Data Sosial Pasien Rawat Inap &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <div data-url="admisi/pdf/akad_ijarah_all">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Akad Ijarah &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div data-url="admisi/pdf/general_consent">
                                        <button class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Persetujuan Umum (General Consent) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <div data-url="admisi/pdf/sdp">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            SDP (Status Debitur Pasien) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div data-url="admisi/pdf/asesmen_belajar_new">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan (NEW) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>

                                    <div data-url="admisi/pdf/form_edukasi_integrasi_pasien_keluarga">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Formulir Edukasi Terintegrasi Pasien dan Keluarga (NEW) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>


                                    


                                    <div data-url="admisi/pdf/sdp">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            SDP Rekening &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak" data-halaman="1">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"> 
                                    <div data-url="admisi/pdf/label_penyimpanan">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Cetak Label di Penyimpanan RM &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" disabled="disabled" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <div data-url="admisi/pdf/sdp">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            SDP Bangsal/UGD &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak" data-halamanx="1" >
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <div data-url="admisi/pdf/label_12">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Label Stiker (12) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"> 
                                    <div data-url="admisi/pdf/pemberian_informasi_pelayanan_rawat_inap_persetujuan">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pemberian Informasi & Persetujuan Rawat Inap &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <div data-url="admisi/pdf/pemberian_informasi_pelayanan_rawat_inap_penolakan">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pemberian Informasi & Penolakan Rawat Inap &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"> 
                                    <div data-url="admisi/pdf/asesmen_belajar">
                                        <!-- <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button> -->
                                    </div>
                                    <div data-url="admisi/pdf/catatan_perkembangan_pasien_terintegrasi">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Catatan Perkembangan Pasien Terintegrasi (CPPT) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12"> 
                                    <div data-url="admisi/pdf/pencatatan_dpjp">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pencatatan DPJP &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    <!--
                                    <div data-url="admisi/pdf/asesmen_belajar">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak" disabled="disabled">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <!-- 
                                    <div data-url="admisi/pdf/asesmen_belajar">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak" disabled="disabled">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    -->
                                    <!--
                                    <div data-url="admisi/pdf/catatan_perkembangan_pasien_terintegrasi">
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Catatan Perkembangan Pasien Terintegrasi (CPPT) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak" disabled="disabled">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="navbar col-md-12">
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_double_check" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-md container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
				<h3>
					&nbsp; <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; &nbsp; PERKIRAAN DOUBLE TRANSAKSI
				</h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12 double_check_pesan">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times" aria-hidden="true"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_cari_pasien" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-wd container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Kembali ke Admisi
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="tapasien" data-row-style="rowStyle" data-response-handler="responseHandler">
                            <thead>
                                <tr>
                                    <th class="no_reg" data-field="no_reg" data-width="25">
                                        No RM
                                    </th>
                                    <th class="tgl_lahir" data-field="str_tgl_lahir" data-width="25">
                                        Tgl Lahir
                                    </th>
                                    <th class="nama" data-field="nama" width="200">
                                        Nama
                                    </th>
                                    <th class="alamat text-left" data-field="alamat">
                                        Alamat
                                    </th>
                                    <th class="jenis_kelamin text-left" data-field="jenis_kelamin" data-width="35">
                                        Jns Kelamin
                                    </th>
                                    <th class="tgl_periksa text-center" data-field="str_tgl_jam_periksa" data-width="35">
                                        Tgl Periksa
                                    </th>
                                    <th scope="col" class="nama_poli" data-field="nama_poli" data-width="70">
                                        Poli
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="select" id="tbpasien">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <i>"Ketik No RM/Nama Pasien pada kolom "<b>Search</b>", kemudian Klik pasien" </i>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="modal-footer hide">
                            
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Kembali ke Askep
                </button>
            </div>
            -->
        </div>
    </div>
</div>
<div class="modal right fade" id="modal_tampilan_layar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">TAMPILAN LAYAR</h4>
            </div>
            <div class="modal-body" style="padding:0px;">
                <iframe class="col-md-12 col-sm-12 col-xs-12 " id="frame_tampilan_layar" src="" style="border:none;height:100em; padding:0px;">
                </iframe>          
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<div aria-hidden="true" tabindex="-1" aria-labelledby="" class="modal fade" data-keyboard="false" id="modal_hambatan" role="dialog" style="display: none; margin: 0px;">
    <div class="modal-dialog container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <h3>Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan</h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <form action="" id="kkb" name="kkb">
                    <!-- <form action="" id="kkb" name="kkb"> -->
                        <table border="0" width="100%">
                            <tr class="hide">
                                <td colspan="5">
                                    No RM :<input autocomplete="off" class="form-control " id="no_reg_hamb" maxlength="7" name="no_reg" readonly="" style="width:6em;" title="" type="text" value="">
                                    Nama : <input autocomplete="off" class="form-control " data-original-title="" id="nama_hamb" name="nama" readonly="" title="" type="text" value="">
                                    Poli : <input autocomplete="off" class="form-control " id="kd_poli_hamb" maxlength="7" name="poli_id" readonly="" style="width:6em;" title="" type="text" value="">
                                    Bangsal : <input autocomplete="off" class="form-control " id="kd_bangsal_hamb" maxlength="7" name="kd_bangsal" readonly="" style="width:6em;" title="" type="text" value="">
                                    Dokter : <input autocomplete="off" class="form-control " id="kd_dokter_hamb" maxlength="7" name="dokter_id" readonly="" style="width:6em;" title="" type="text" value="">
                                    Asuransi : <input autocomplete="off" class="form-control " id="kd_asuransi_hamb" maxlength="7" name="asuransi_id" readonly="" style="width:6em;" title="" type="text" value="">


                                    Tgl/Jam Masuk<input autocomplete="off" class="form-control " data-original-title="" id="tgl_periksa_hamb" name="tgl_masuk" title="" type="text" value="">
                                    <input autocomplete="off" class="form-control " data-original-title="" id="jam_periksa_hamb" name="jam_masuk" readonly="" title="" type="text" value="">
                                </td>
                            </tr>
                            <tr style="background-color: #389f6b70;">
                                <td width="20" align="center"><label>&nbsp;A.&nbsp;</label></td>
                                <td width="350" align="left">
                                    <label>Kemampuan membaca dan tingkat pendidikan</label>
                                </td>
                                <td width="10" colspan ="2"><label>:</label></td>
                            </tr>
                            <!-- <tr class="wadah_membaca"> -->
                            <tr class="">
                                <td width="" align="right"></td>
                                <td width="" align="left">
                                    <label for="hamb_mampu_baca">1. Kemampuan membaca</label>
                                </td>
                                <td width=""><label>:&nbsp;</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_mampu_baca" name="hamb_mampu_baca">
                                        <option value=""></option>
                                        <option value="1" selected>Tidak Buta huruf</option>
                                        <option value="2">Buta huruf</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- Tambahan baris yang diperlukan -->
                            <!-- <tr class="wadah_membaca"> -->
                            <tr class="">
                                <td width="" align="right"></td>
                                <td width="" align="left">
                                    <label for="hamb_tingkat_didik">2. Tingkat pendidikan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_tingkat_didik" name="hamb_tingkat_didik">
                                        <option value=""></option>
                                        @foreach ($pendidikan as $all)
                                            <option value="{{ $all->kd_pendidikan }}">
                                                {{ $all->pendidikan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <!-- Akhir tambahan -->
                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;B.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Bahasa</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td></td>
                            </tr>
                            <!-- Tambahan baris yang diperlukan -->
                            <tr class="">
                                <td width="" align="right"></td>
                                <td width="" align="left">
                                    <label for="hamb_bahasa_sehari">1. Bahasa sehari-hari</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_bahasa_sehari" name="hamb_bahasa_sehari">
                                        <option value=""></option>
                                        @foreach ($bahasa as $all)
                                            <option value="{{ $all->kd_bahasa }}" @if($all->kd_bahasa == 1) selected @endif>
                                                {{ $all->nama_bahasa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <!-- Akhir tambahan -->
                            <tr class="">
                                <td></td>
                                <td><label>2. Penerjemah bahasa</label></td>
                                <td width=""><label>:</label></td>
                                <td colspan="2">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_penerjemah_tidak" name="hamb_tinlan_penerjemah[]" value="2"><label for="hamb_tinlan_penerjemah_tidak">&nbsp;Perlu</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_penerjemah_ya" name="hamb_tinlan_penerjemah[]" value="1"><label for="hamb_tinlan_penerjemah_ya">&nbsp;Tidak Perlu</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;C.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Hambatan emosional dan motivasi</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_cek_emov_tidak" name="hamb_cek_emov[]" value="2"><label for="hamb_cek_emov_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_cek_emov_ya" name="hamb_cek_emov[]" value="1"><label for="hamb_cek_emov_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="wadah_emov">
                                <td></td>
                                <td width="" align="left">
                                    <label>1. Hambatan Emosional dan Penerimaan Sakit</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_emosi" name="hamb_emosi">
                                        <option value=""></option>
                                        @foreach ($hamb_emosi as $all)
                                            <option value="{{ $all->id }}">
                                                {{ $all->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="wadah_emov">
                                <td></td>
                                <td width="" align="left">
                                    <label>2. Hambatan Motivasi dan Hubungan dengan Keluarga</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_motivasi" name="hamb_motivasi">
                                        <option value=""></option>
                                        @foreach ($hamb_motivasi as $all)
                                            <option value="{{ $all->id }}">
                                                {{ $all->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            
                            <!--  -->
                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;D.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Keterbatasan fisik dan kognitif</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_cek_fiko_tidak" name="hamb_cek_fiko[]" value="2"><label for="hamb_cek_fiko_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_cek_fiko_ya" name="hamb_cek_fiko[]" value="1"><label for="hamb_cek_fiko_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="wadah_fiko">
                                <td></td>
                                <td width="" align="left">
                                    <label>1. Hambatan Fisik</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_fisik" name="hamb_fisik">
                                        <option value=""></option>
                                        @foreach ($hamb_fisik as $all)
                                            <option value="{{ $all->id }}">
                                                {{ $all->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="hamb_fisik_lemah_banget">
                                        <select class="chosen-select" id="hamb_fisik_lemah" name="hamb_fisik_lemah" data-placeholder="Silahkan Pilih Alat Bantu...">
                                            <option value=""></option>
                                            <option value="1">Kruk</option>
                                            <option value="2">Tripot</option>
                                            <option value="3">Walker</option>
                                            <option value="4">Kursi Roda</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr class="wadah_fiko">
                                <td></td>
                                <td width="" align="left">
                                    <label>2. Hambatan kognitif</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_kognitif" name="hamb_kognitif">
                                        <option value=""></option>
                                        @foreach ($hamb_kognitif as $all)
                                            <option value="{{ $all->id }}">
                                                {{ $all->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    
                                </td>
                            </tr>

                            <tr class="wadah_fiko">
                                <td></td>
                                <td><label>3. Secara Fisiologis ada hambatan kemampuan belajar</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_fisio_tidak" name="hamb_tinlan_fisio[]" value="2"><label for="hamb_tinlan_fisio_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_fisio_ya" name="hamb_tinlan_fisio[]" value="1"><label for="hamb_tinlan_fisio_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!--  -->
                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;E.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Ketersediaan pasien untuk menerima informasi/edukasi</label>
                                </td>
                                <td width="" colspan="2"><label>:</label></td>
                                <!-- <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_cek_sedif_tidak" name="hamb_cek_sedif[]" value="2"><label for="hamb_cek_sedif_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_cek_sedif_ya" name="hamb_cek_sedif[]" value="1"><label for="hamb_cek_sedif_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td> -->
                            </tr>
                            <!-- <tr class="wadah_sedif"> -->
                            <tr class="">
                                <td></td>
                                <td><label>1. Bersedia Menerima Edukasi</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_edu_tidak" name="hamb_tinlan_edu[]" value="2"><label for="hamb_tinlan_edu_tidak">&nbsp;Tidak</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_edu_ya" name="hamb_tinlan_edu[]" value="1"><label for="hamb_tinlan_edu_ya">&nbsp;Ya</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- <tr class="wadah_sedif"> -->
                            <tr class="">
                                <td width="" align="right"></td>
                                <td width="" align="left">
                                    <label for="">2. Cara Edukasi</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_cara_edu" name="hamb_cara_edu">
                                        <option value=""></option>
                                        <option value="1">Lisan</option>
                                        <option value="2">Tulisan</option>
                                    </select>
                                </td>
                            </tr>

                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;F.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Keyakinan dan nilai-nilai pasien dan keluarga yang perlu diperhatikan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_cek_keyakinan_tidak" name="hamb_cek_keyakinan[]" value="2"><label for="hamb_cek_keyakinan_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_cek_keyakinan_ya" name="hamb_cek_keyakinan[]" value="1"><label for="hamb_cek_keyakinan_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="wadah_keyakinan">
                                <td></td>
                                <td><label>1. Tidak memakan sesuatu jenis makanan</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <input type="text" class="form-control" id="hamb_tinlan_makan" name="hamb_tinlan_makan"  value="" title="" autocomplete="="off>
                                    <!-- <textarea autocomplete="off" class="form-control " data-original-title="" id="hamb_tinlan_makan" name="hamb_tinlan_makan" title=""value=""></textarea> -->
                                    <!-- <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_makan_tidak" name="hamb_tinlan_makan[]" value="2"><label for="hamb_tinlan_makan_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_makan_ya" name="hamb_tinlan_makan[]" value="1"><label for="hamb_tinlan_makan_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table> -->
                                </td>
                            </tr>
                            <tr class="wadah_keyakinan">
                                <td></td>
                                <td><label>2. Menolak dilayani petugas yang beda jenis kelamin</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_beda_kelamin_tidak" name="hamb_tinlan_beda_kelamin[]" value="2"><label for="hamb_tinlan_beda_kelamin_tidak">&nbsp;Tidak</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_beda_kelamin_ya" name="hamb_tinlan_beda_kelamin[]" value="1"><label for="hamb_tinlan_beda_kelamin_ya">&nbsp;Ya</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="wadah_keyakinan">
                                <td></td>
                                <td><label>3. Menolak diberikan imunisasi pada anaknya</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <textarea autocomplete="off" class="form-control " data-original-title="" id="hamb_tinlan_tolak_imun" name="hamb_tinlan_tolak_imun" title=""value=""></textarea>
                                    <!-- <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_tolak_imun_tidak" name="hamb_tinlan_tolak_imun[]" value="2"><label for="hamb_tinlan_tolak_imun_tidak">&nbsp;Tidak Ada</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_tinlan_tolak_imun_ya" name="hamb_tinlan_tolak_imun[]" value="1"><label for="hamb_tinlan_tolak_imun_ya">&nbsp;Ada</label>
                                            </td>
                                        </tr>
                                    </table> -->
                                </td>
                            </tr>
                            <tr class="wadah_keyakinan">
                                <td></td>
                                <td><label>4. Lainnya</label></td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <textarea autocomplete="off" class="form-control " data-original-title="" id="hamb_keyakinan_lainnya" name="hamb_keyakinan_lainnya" title=""value=""></textarea>
                                </td>
                                
                            </tr>

                            <tr style="background-color: #389f6b70;">
                                <td width="" align="center">
                                    <label>&nbsp;G.&nbsp;</label>
                                </td>
                                <td width="" align="left">
                                    <label>Edukasi BPJS Kesehatan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="radio" id="bpjs_cek_edukasi_tidak" name="hamb_bpjs_cek_edukasi[]" value="1"><label for="bpjs_cek_edukasi_tidak">&nbsp;Tidak</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="hamb_bpjs_cek_edukasi_ya" name="hamb_bpjs_cek_edukasi[]" value="2"><label for="hamb_bpjs_cek_edukasi_ya">&nbsp;Ya</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="wadah_edukasi">
                                <td></td>
                                <td width="" align="left">
                                    <label>1. Pemahaman tentang penjaminan tidak dapat berubah di tengah perawatan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_bpjs_penjaminan" name="hamb_bpjs_penjaminan">
                                        <option value=""></option>
                                        <option value="1">Mengerti</option>
                                        <option value="2">Tidak Mengerti</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="wadah_edukasi">
                                <td></td>
                                <td width="" align="left">
                                    <label>2. Pemahaman tentang tidak adanya iur biaya apabila sesuai indikasi medis menggunakan jaminan BPJS Kesehatan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_bpjs_iur_biaya" name="hamb_bpjs_iur_biaya">
                                        <option value=""></option>
                                        <option value="1">Mengerti</option>
                                        <option value="2">Tidak Mengerti</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="wadah_edukasi">
                                <td></td>
                                <td width="" align="left">
                                    <label>3. Pemahaman tentang Pulang Paksa/APS tidak dijamin oleh BPJS Kesehatan</label>
                                </td>
                                <td width=""><label>:</label></td>
                                <td>
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="hamb_bpjs_pulang_paksa" name="hamb_bpjs_pulang_paksa">
                                        <option value=""></option>
                                        <option value="1">Mengerti</option>
                                        <option value="2">Tidak Mengerti</option>
                                    </select>
                                </td>
                            </tr>



                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <!-- Akhir tambahan -->
                            <tr>
                                <td width="280" align="right" colspan="4">
                                    <a class="btn btn-danger" id="simpan_hambatan"><i class="fa fa-save"></i> Simpan Data Rawat Inap dan Hambatan</a>
                                    <a class="btn btn-danger hide" id="keluar_hambatan"><i class="fa fa-close"></i> Keluar. Hanya Simpan Rawat Inap</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
