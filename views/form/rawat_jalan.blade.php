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
    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
    }
    .chosen-single abbr {
        right:20px !important; 
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <!--
        <div class="txr col-md-12"><a href="{{ URL }}rme/main/askep" class="btn btn-default">ASKEP Poli</a></div>
        -->
        <h2 class="row-centered col-md-12">
            PENDAFTARAN RAWAT JALAN
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
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div id="content">
                <form action="javascript:void(0)" class="form-horizontal" id="transaksi" method="post" name="transaksi">
                    <h4 class="alert alert-success">
                        <i class="fa fa-user" aria-hidden="true"></i> &nbsp;DATA PASIEN
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <div class="row">
                            <label class="control-label col-md-2" for="no_reg">
                                No.RM :
                            </label>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-12" style="padding-right:30px !important;">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <input id="id" name="id" type="hidden"/>
                                                <input id="hispx" name="hispx" readonly="readonly" required="" type="hidden" value="">
                                                </input>
                                                <input id="ur_tgl_rs" name="ur_tgl_rs" type="hidden" value="">
                                                <input id="ino_reg" name="ino_reg" type="hidden" value="">
                                                </input>
                                                <input id="id_kunjung" name="id_kunjung" type="hidden" value="">
                                                <input id="status_bayi" name="status_bayi" type="hidden" value="">
                                                </input>
                                                <input autocomplete="off" class="form-control has-spinner" id="no_reg" maxlength="7" name="no_reg" inputmode="numeric" style="width:6em;" title="" placeholder="Nomor RM" type="text" value="">
                                                </input>
                                            </div>
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama" name="nama" title="" placeholder="Nama lengkap pasien (sesuai KTP)" type="text" value="">
                                            </input>
                                            <div class="input-group-btn">
                                                <span class="button btn btn-danger" id="btn_cari_pasien" value="CARI PASIEN" style="width:100px; padding-bottom:9px; padding-top:13px;">
                                                    CARI PASIEN
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="control-label col-md-2" for="alamat">
                                        Alamat :
                                    </label>
                                    <div class="col-md-10" style="padding-right:30px !important;">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat" placeholder="Alamat lengkap pasien (sesuai KTP)" name="alamat" maxlength="65" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label col-md-6" for="daerah">
                                            Kode Daerah :
                                        </label>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="daerah" name="daerah" required="required">
                                                <option value=""></option> 
                                                @foreach($daerah as $row) 
                                                <option value="{{$row->kode}}">{{$row->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="control-label col-md-6" for="ktp">
                                            KTP :
                                        </label>
                                        <div class="col-md-6">
                                            <input autocomplete="off" class="form-control" data-original-title="" id="ktp" name="ktp" title="" placeholder="Nomer KTP" type="text" value="" />
                                        </div>
                                        <label class="control-label col-md-6" for="jenis_kelamin">
                                            Jenis Kelamin :
                                        </label>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="jenis_kelamin" name="jenis_kelamin" required="required">
                                                <option value=""></option> 
                                                @foreach($jenis_kelamin as $row) 
                                                <option value="{{$row->kode}}">{{$row->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="control-label col-md-6" for="tgl_lahir">
                                            Tanggal Lahir :
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <input autocomplete="off" class="form-control has-spinner datemask" data-original-title="" id="tgl_lahir" name="tgl_lahir" title="" type="text" value="" placeholder="DD/MM/YYYY" data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                                    </input>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="umur" name="umur" placeholder="Umur" readonly="" title="" type="text" value="">
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="padding-left:40px !important;">
                                        <label class="control-label col-md-5" for="telp_1">
                                            WA/HP/Telp :
                                        </label>
                                        <div class="col-md-7">
                                            <input autocomplete="off" class="form-control" id="telp_1" name="telp_1" title="" placeholder="08*************" type="text" inputmode="numeric" value="" />
                                            <input autocomplete="off" class="form-control" id="telp_2" name="telp_2" title="" placeholder="08*************" type="text" inputmode="numeric" value="" />
                                            <input autocomplete="off" class="form-control" id="telp_3" name="telp_3" title="" placeholder="08*************" type="text" inputmode="numeric" value="" />
                                        </div>
                                        <label class="control-label col-md-5" for="email">
                                            e-Mail :
                                        </label>
                                        <div class="col-md-7">
                                            <input autocomplete="off" class="form-control" data-original-title="" id="email" name="email" title="" placeholder="email" type="text" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label col-md-4" for="agama">
                                            Agama :
                                        </label>
                                        <div class="col-md-5 col-sm-12 col-xs-12"> 
                                            <select class="chosen-select" style="width:10em;" data-placeholder="Silahkan Pilih..." id="agama" name="agama" required="required" novalidate>
                                                <option value=""></option>
                                                @foreach($agama as $row)
                                                <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="control-label col-md-4" for="kawin">
                                            Status Perkawinan :
                                        </label>
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kawin" name="kawin" required="required">
                                                <option value=""></option> 
                                                @foreach($kawin as $row) 
                                                <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="control-label col-md-4" for="pekerjaan">
                                            Pekerjaan :
                                        </label>
                                        <div class="col-md-8 col-sm-12 col-xs-12"> 
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="pekerjaan" name="pekerjaan" required="required" data-lainnya="pekerjaan_lain">
                                                        <option value=""></option>
                                                        @foreach($kerja as $row)
                                                        <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input disabled="true" autocomplete="off" class="form-control has-spinner" data-original-title="" id="pekerjaan_lain" name="pekerjaan_lain" title="" placeholder="Lainnya" type="text" value="">
                                                </input>
                                            </div>
                                        </div>
                                        <label class="control-label col-md-4" for="pendidikan">
                                            Pendidikan :
                                        </label>
                                        <div class="col-md-8 col-sm-12 col-xs-12"> 
                                            <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="pendidikan" name="pendidikan" required="required">
                                                <option value=""></option>
                                                @foreach($didik as $row)
                                                <option value="{{$row->kode}}"
                                                    @if(!empty($row->deleted))
                                                    disabled="true"
                                                    @endif
                                                    >{{$row->nama}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="control-label col-md-4" for="bahasa">
                                            Bahasa :
                                        </label>
                                        <div class="col-md-8 col-sm-12 col-xs-12"> 
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="bahasa" name="bahasa" required="required" data-lainnya="bahasa_lain">
                                                        <option value=""></option>
                                                        @foreach($bahasa as $row)
                                                        <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input disabled="true"  autocomplete="off" class="form-control has-spinner" data-original-title="" id="bahasa_lain" name="bahasa_lain" title="" placeholder="Lainnya" type="text" value="">
                                                </input>
                                            </div>
                                        </div>
                                        <label class="control-label col-md-4" for="etnis">
                                            Etnis :
                                        </label>
                                        <div class="col-md-8 col-sm-12 col-xs-12"> 
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="etnis" name="etnis" required="required" data-lainnya="etnis_lain">
                                                        <option value=""></option>
                                                        @foreach($etnis as $row)
                                                        <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input disabled="true"  autocomplete="off" class="form-control has-spinner" data-original-title="" id="etnis_lain" name="etnis_lain" title="" placeholder="Lainnya" type="text" value="">
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label col-md-6" for="bb">
                                            Berat Badan :
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="bb" name="bb" placeholder="" inputmode="numeric" title="" type="text" value="">
                                                </input>
                                                <div class="input-group-btn">
                                                    <span autocomplete="off" class="form-control has-spinner" maxlength="3" data-original-title="" id="kg" style="width:3.5em;" name="kg" placeholder="" title="" type="text" value="KG" readonly="true">Kg
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="control-label col-md-6" for="gol_darah">
                                            Gol. Darah :
                                        </label>
                                        <div class="col-md-6">
                                            <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="gol_darah" name="gol_darah" required="">
                                                <option value=""></option>
                                                @foreach($gol_darah as $row) 
                                                        <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="control-label col-md-2" for="bb">
                                            Tgl/Jam Masuk :
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input autocomplete="off" class="form-control has-spinner datetimemask" data-original-title="" id="tgl_periksa" name="tgl_periksa" title="" type="text" value="" placeholder="DD/MM/YYYY HH:MM:SS" data-inputmask-alias="datetimefull">
                                                </input>
                                                <div class="input-group-btn hide">
                                                    <span autocomplete="off" class="form-control has-spinner" maxlength="3" data-original-title="" id="wib" style="width:3.5em;" name="wib" placeholder="" title="" type="text" value="WIB" readonly="true">WIB
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label col-md-2" for="poli">
                                                    Poli :
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="poli" name="poli" required="">
                                                        <option value=""></option>
                                                        @foreach($poli as $row)
                                                        <option value="{{$row->kode_poli}}">{{$row->nama_poli}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="control-label col-md-2" for="dokter">
                                                    Dokter :
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="dokter" name="dokter" required="">
                                                        <option value=""></option>
                                                        @foreach ($dokter as $row_dokter)
                                                        <option value="{{ $row_dokter->no_dr }}">
                                                            {{ $row_dokter->nama2 }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="control-label col-md-2" for="praktek">
                                                    Praktek :
                                                </label>
                                                <div class="col-md-3">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="praktek" name="praktek" required="">
                                                        <option value=""></option>
                                                        @foreach($praktek as $row) 
                                                        <option value="{{$row->kode}}"
                                                            @if(!empty($row->deleted))
                                                            disabled="true"
                                                            @endif
                                                            >{{$row->nama}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> &nbsp; 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-7" style="padding-left:40px !important;">
                                        <label class="control-label col-md-3" for="asuransi">
                                            Asuransi :
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="chosen-select" style="width:10em;"  data-placeholder="Silahkan Pilih..." id="asuransi" name="asuransi" required="required">
                                                        <option value=""></option>
                                                        @foreach ($asuransi as $row_asuransi)
                                                        <option value="{{ $row_asuransi->NO_REL }}">
                                                            {{ $row_asuransi->NAMA }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label col-md-4" for="no_kartu_bpjs">
                                                    No Kartu BPJS :
                                                </label>
                                                <div class="col-md-8">
                                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_kartu_bpjs" name="no_kartu_bpjs" placeholder="" inputmode="numeric" title="" type="text" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label col-md-4" for="no_kartu_asuransi_lain">
                                                    No Kartu Penjamin Lain :
                                                </label>
                                                <div class="col-md-8">
                                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_kartu_asuransi_lain" name="no_kartu_asuransi_lain" placeholder="" inputmode="numeric" title="" type="text" value="">
                                                </div>
                                            </div>
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
                            <div class="col-md-12" style="padding-left:0px !important;">
                                <label class="control-label col-md-2" for="cara_datang">
                                    Rujukan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="cara_datang" name="cara_datang" >
                                        <option value="">
                                        </option>
                                        @foreach($rujuk as $row)
                                        <option value="{{$row->kode}}"
                                            @if(!empty($row->deleted))
                                            disabled="true"
                                            @endif
                                            >{{$row->nama}}</option> 
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
                                        <select class="chosen-select" style="width:100%;" data-placeholder="Silahkan Pilih..." id="kode_dokter_perujuk" name="kode_dokter_perujuk" >
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
                            <div class="col-md-12" style="padding-left:0px !important;">
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
                                    <div class="col-md-2" style="margin-right:-10px !important;">&nbsp; </div>
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="hapus" name="hapus">
                                        Hapus Data Inap
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        Simpan
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
                    
                </form>
                
            </div>
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