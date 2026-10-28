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
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <!--
        <div class="txr col-md-12"><a href="{{ URL }}rme/main/askep" class="btn btn-default">ASKEP Poli</a></div>
        -->
        <h2 class="row-centered col-md-12">
            PENDAFTARAN RAWAT INAP
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
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="ktp" name="ktp" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="jenis_kelamin">
                                    Jenis Kelamin :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="jenis_kelamin" name="jenis_kelamin" disabled="true" required="required">
                                        <option value="L">LAKI-LAKI</option>                                        
                                        <option value="P">PEREMPUAN</option>                                        
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
                                <label class="control-label col-md-1" for="nama_agama">
                                    Agama :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_agama" name="nama_agama" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="nama_pekerjaan">
                                    Pekerjaan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_pekerjaan" name="nama_pekerjaan" readonly="" title="" type="text" value="">
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
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_periksa" name="tgl_periksa" readonly="" title="" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="jam_periksa">
                                    Jam :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="jam_periksa" name="jam_periksa" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="nama_perkawinan">
                                    Perkawinan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_perkawinan" name="nama_perkawinan" readonly="" title="" type="text" value="">
                                    </input>
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
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="cara_datang" name="cara_datang" disabled="true">
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
                                            <select class="chosen-select" style="" data-placeholder="Silahkan Pilih..." id="praktek_rsi" name="praktek_rsi" disabled="true">
                                                <option value=""></option>
                                                <option value="Y">Ya</option>
                                                <option value="T">Tidak</option>
                                            </select>
                                        </div>
                                        <select class="chosen-select" style="width:100%;" data-placeholder="Silahkan Pilih..." id="kode_dokter_perujuk" name="kode_dokter_perujuk" disabled="true">
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
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_perujuk" name="nama_perujuk" title="" type="text" value="" readonly="true" />
                                </div>
                                <label class="control-label col-md-1" for="alamat_perujuk">
                                    Alamat  :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat_perujuk" name="alamat_perujuk" title="" type="text" value="" readonly="true" />
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
                                            {{ $row_bangsal->nama_pendaftaran }}
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
                                    
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dpjp_1" name="dpjp_1">
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
                                    <div class="col-md-2">&nbsp; </div>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="hapus" name="hapus">
                                        Hapus Data Inap
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        Simpan
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="ubah" name="ubah">
                                        Ubah
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="batal" name="batal">
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
                                    <div data-url="admisi/pdf/general_consent">
                                        <!--
                                        <button class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Persetujuan Umum (General Consent) &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
                                        -->
                                        <div class="col-md-6">&nbsp; </div>
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
                                        <button type="button" class="col-xs-12 col-md-4 btn btn-danger btn-dok-jenis text-right" disabled="true">
                                            Pengkajian Kebutuhan Edukasi Pasien dan Hambatan Pelayanan &nbsp; <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>  &nbsp; 
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat
                                        </button>
                                        <button type="button" class="col-xs-12 col-md-1 btn btn-danger btn-dok-cetak">
                                            <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Cetak 
                                        </button>
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