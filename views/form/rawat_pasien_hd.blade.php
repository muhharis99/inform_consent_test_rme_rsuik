<style>
    h4.alert {
        padding-top: 0.7em !important;
    }

    .danger.btn-warning {
        background-color: #f2dede;
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 1000px;
        height: 100%;
        transform: translate3d(0, 0, 0);
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

    .modal.left.fade .modal-dialog {
        left: -320px;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    .modal.right.fade .modal-dialog {
        right: -320px;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #eee;
        background-color: #fafafa;
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
        background-color: #fff;
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

    .swal-wide {
        width: 550px !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 0;
    }

    table, th, td {
        border: 0;
    }

    .nav-tabs {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .nav-tabs .nav-item {
        margin-right: 5px;
    }

    .nav-tabs .nav-link {
        display: block;
        padding: 10px 20px;
        color: #495057;
        text-decoration: none;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
        background-color: #e9ecef;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-tabs .nav-link.active {
        background-color: #fff;
        border-color: #389f6b #389f6b #fff;
    }

    .nav-tabs .nav-link:hover {
        color: #389f6b;
        background-color: #e2e6ea;
    }

    .tab-content .tab-pane {
        display: none;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-top: none;
        background-color: #fff;
    }

    .tab-content .tab-pane.active {
        display: block;
    }

    .form-group .col-md-12 .alert-warning .row .btn,
    .btn-nota {
        padding-top: 1.2em !important;
    }

    .text-left {
        text-align: left !important;
    }

    .text-right {
        text-align: right !important;
    }
</style>


<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            PENDAFTARAN PASIEN HEMODIALISA 
  
        </h2>
        <p class="row-centered col-md-12">

            <table width="100%" class="">
              <tr>
                <td>No</td>
                <td>Warning</td>
              </tr>
              <tr>
                <td>1.</td>
                <td>
                  Jika data Rekam Medis sudah di input dan klik simpan, jangan di inputkan kembali. Data sudah tersimpan di Skrining.
                </td>
              </tr>
              <tr>
                <td>2.</td>
                <td>
                  Bulan <b id="bulanDepan"></b> sampai tanggal <b id="tanggalAkhirDepan"></b>
                </td>
              </tr>
              <tr>
                <td><hr></td>
              </tr>
            </table>
            </b>
        </p>

        <div onclick="checkdr()" style="display:none; cursor:pointer; z-index:100; position: absolute;font-size: 2rem;color: red;font-weight: bold;margin-top: 50px;margin-left: 15px;text-align: center;">
            Antrian Sekarang : <span id="noantrian"></span>
        </div>
        <div class="text-right col-md-12"><b>Pengguna: </b><span id="user" nik="{{ $nik }}" poli="{{ $kd_poli }}" induk="{{ $induk }}" dokter="{{ $kd_dokter }}">{{ $akses }}</span></div>
        
        <div class="col-md-12 text-right hide">
            <a href="#" id="cek_plugin">
                <i class="fa fa-refresh"></i>
            </a>
            <i class="fa fa-print"></i>
            <a href="#" id="menu_printer">
                <i class="fa fa-cog"></i>
            </a>
            <span id="status_plugin" style="color:orange;"> Mendeteksi Plugin</span>
        </div>

        <div class="col-md-12">
            <div id="content">
                <form action="javascript:void(0)" class="form-horizontal" id="transaksi" method="post" name="transaksi">
                    <h4 class="alert alert-success">
                        <i class="fa fa-user" aria-hidden="true"></i> &nbsp;DATA PASIEN HEMODIALISIS
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
                                            <input class="form-control hide" id="ur_tgl_rs" name="ur_tgl_rs" type="text" value="">
                                            </input>
                                            <input id="id_jadwal_hd" name="id_jadwal_hd" type="hidden" value="">
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
                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="kd_daerah" name="kd_daerah" readonly="" title="" type="text" value="">
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
                                <label class="control-label col-md-1" for="agama">
                                    Agama :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12"> 
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="agama" name="agama" disabled="true" required="required">
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
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_pekerjaan" name="nama_pekerjaan" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="tanggal">
                                    Tanggal Periksa :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12 ">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tanggal" name="tanggal" readonly="" title="" type="text" value="" required>
                                     
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-md-2 hide" for="jam_periksa">
                                    Jam :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12 hide">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="jam_periksa" name="jam_periksa" title="" type="text" value="" readonly>
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="kawin">
                                    Perkawinan :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kawin" name="kawin" disabled="true" required="required">
                                        <option value=""></option>
                                        @foreach($rows_kawin as $kawin)
                                        <option value="{{$kawin['kd_perkawinan']}}">{{$kawin['nama_perkawinan']}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                

                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-sm-2 control-label hide" for="kode_dokter">
                                    Kunjungan :
                                </label>
                                <div class="col-sm-2 hide">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="kunjung" name="kunjung" title="" type="text" readonly>
                                </div>
                                <label class="control-label col-md-2" for="kd_dr">
                                    Dokter
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="">
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="kd_dr" name="kd_dr" disabled="true" required>
                                            <option value="">
                                            </option>
                                            @foreach($dokter as $row)
                                            <option value="{{$row['no_dr']}}">
                                                {{$row['nama2']}}
                                            </option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="control-label col-md-2" for="asuransi_id">
                                    Asuransi
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="asuransi_id" name="asuransi_id" title="" type="text" readonly>
                                    </input>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="asuransi_nama" title="" type="text" readonly>
                                    </input>
                                </div>
                                <label class="control-label col-md-2 hide" for="no_kartu">
                                    Nomor Kartu Asuransi / BPJS :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12 hide">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_kartu" name="no_kartu" title="" type="text" value=""  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2 hide">
                                    Nama Pemegang Kartu Askes :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12 hide">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama_pegang_akses" name="nama_pegang_akses" title="" type="text" value="" readonly="readonly" >
                                </div>
                                <label class="control-label col-md-2" for="hub_keluarga">
                                    Hub Keluarga dengan Peserta :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="hub_keluarga" name="hub_keluarga" title="" type="text" value=""  readonly="readonly" required>
                                </div>
                                
                                <label class="control-label col-md-2" for="ruang_pasien">
                                    Ruang Pasien :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="ruang_pasien" name="ruang_pasien" disabled="true">
                                        <option value=""></option>
                                        <option value="B">HD - BIR ALI</option>
                                        <option value="M">HD - MEKKAH</option>
                                    </select>
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                  
                        <div class="row hide">
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
                     
                        <div class="row hide">
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
                        <div class="row hide">
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
                             
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>



                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="col-md-2" for="">
                                    &nbsp; 
                                </label>
                            </div>
                        </div>
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="">
                                    Penerima Informasi Darurat :
                                </label>
                            </div>
                        </div>
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_2">
                                    &nbsp; 
                                </label>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="nama_darurat_3">
                                    &nbsp; 
                                </label>
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row hide">
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
                        <div class="row hide">
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
                        <div class="row hide">
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

                    <h4 class="alert alert-success">
                        <i class="fa fa-clipboard" aria-hidden="true"></i> &nbsp;RIWAYAT KESEHATAN PASIEN DAN JADWAL HEMODIALISIS
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="diagnosa">
                                    Diagnosa Penderita :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    
                                    <div class="input-group">
                                      
                                        <input autocomplete="off" class="form-control " data-original-title="" id="diagnosa" name="diagnosa" readonly="" title="" type="text" value="" style="width:1000px;">
                                     

                                    </div>
                                </div>
                                <label class="control-label col-md-2 hide" for="tgl_awal_1">
                                    Tanggal Tindakan Hemodialisis :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12 hide">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_awal_1" name="tgl_awal_1" title="" type="text" value="">
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-12">
                                <label class="control-label col-md-2" for="pengobatan">
                                    Pengobatan Penderita :
                                </label>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="pengobatan" name="pengobatan" disabled="true" required="required">
                                            <option value=""></option>
                                            <option value="1">HD</option>
                                            <option value="2">Cuci Darah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-12">

                                <label class="control-label col-md-2" for="diagnosa">
                                    Tanggal Hemodialisis <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Data yang ditampilkan adalah : Tanggal dan hari di bulan depan"></i> :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <table width="90%" class="responsive-table">
                                  

                                                <tr>
                                                    <td style="background-color:#eee; color: black;">Tanggal 1,<b><div id="hari_bulan_berikutnya_1"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 2,<b><div id="hari_bulan_berikutnya_2"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 3,<b><div id="hari_bulan_berikutnya_3"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 4,<b><div id="hari_bulan_berikutnya_4"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 5,<b><div id="hari_bulan_berikutnya_5"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 6,<b><div id="hari_bulan_berikutnya_6"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 7,<b><div id="hari_bulan_berikutnya_7"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 8,<b><div id="hari_bulan_berikutnya_8"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 9,<b><div id="hari_bulan_berikutnya_9"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 10,<b><div id="hari_bulan_berikutnya_10"></div></b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_1" name="tgl_ulang_1" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_1" name="hari_1" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_2" name="tgl_ulang_2" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_2" name="hari_2" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_3" name="tgl_ulang_3" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_3" name="hari_3" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_4" name="tgl_ulang_4" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_4" name="hari_4" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_5" name="tgl_ulang_5" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_5" name="hari_5" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_6" name="tgl_ulang_6" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_6" name="hari_6" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_7" name="tgl_ulang_7" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_7" name="hari_7" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_8" name="tgl_ulang_8" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_8" name="hari_8" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_9" name="tgl_ulang_9" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_9" name="hari_9" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_10" name="tgl_ulang_10" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_10" name="hari_10" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button id="input_tanggal_1" class="btn btn-primary" style="width:97px" >Jadwalkan HD</button>
                                                      
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_2" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_3" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_4" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_5" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_6" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_7" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_8" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_9" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_10" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="20"><hr></td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color:#eee; color: black;">Tanggal 11,<b><div id="hari_bulan_berikutnya_11"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 12,<b><div id="hari_bulan_berikutnya_12"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 13,<b><div id="hari_bulan_berikutnya_13"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 14,<b><div id="hari_bulan_berikutnya_14"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 15,<b><div id="hari_bulan_berikutnya_15"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 16,<b><div id="hari_bulan_berikutnya_16"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 17,<b><div id="hari_bulan_berikutnya_17"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 18,<b><div id="hari_bulan_berikutnya_18"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 19,<b><div id="hari_bulan_berikutnya_19"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 20,<b><div id="hari_bulan_berikutnya_20"></div></b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_11" name="tgl_ulang_11" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_11" name="hari_11" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_12" name="tgl_ulang_12" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_12" name="hari_12" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_13" name="tgl_ulang_13" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_13" name="hari_13" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_14" name="tgl_ulang_14" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_14" name="hari_14" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_15" name="tgl_ulang_15" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_15" name="hari_15" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_16" name="tgl_ulang_16" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_16" name="hari_16" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_17" name="tgl_ulang_17" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_17" name="hari_17" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_18" name="tgl_ulang_18" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_18" name="hari_18" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_19" name="tgl_ulang_19" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_19" name="hari_19" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_20" name="tgl_ulang_20" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_20" name="hari_20" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_11" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_12" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_13" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_14" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_15" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_16" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_17" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_18" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_19" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_20" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="20"><hr></td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color:#eee; color: black;">Tanggal 21,<b><div id="hari_bulan_berikutnya_21"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 22,<b><div id="hari_bulan_berikutnya_22"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 23,<b><div id="hari_bulan_berikutnya_23"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 24,<b><div id="hari_bulan_berikutnya_24"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 25,<b><div id="hari_bulan_berikutnya_25"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 26,<b><div id="hari_bulan_berikutnya_26"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 27,<b><div id="hari_bulan_berikutnya_27"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 28,<b><div id="hari_bulan_berikutnya_28"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 29,<b><div id="hari_bulan_berikutnya_29"></div></b></td>
                                                    <td>&nbsp;</td>
                                                    <td style="background-color:#eee; color: black;">Tanggal 30,<b><div id="hari_bulan_berikutnya_30"></div></b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_21" name="tgl_ulang_21" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_21" name="hari_21" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_22" name="tgl_ulang_22" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_22" name="hari_22" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_23" name="tgl_ulang_23" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_23" name="hari_23" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_24" name="tgl_ulang_24" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_24" name="hari_24" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_25" name="tgl_ulang_25" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_25" name="hari_25" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_26" name="tgl_ulang_26" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_26" name="hari_26" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_27" name="tgl_ulang_27" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_27" name="hari_27" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_28" name="tgl_ulang_28" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_28" name="hari_28" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_29" name="tgl_ulang_29" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_29" name="hari_29" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_30" name="tgl_ulang_30" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_30" name="hari_30" title="" type="text" value="" style="width:97px" readonly>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_21" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_22" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_23" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_24" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_25" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_26" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_27" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_28" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_29" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                    <td></td>
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_30" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="20"><hr></td>
                                                </tr>
                                                <tr class="hide">
                                                    <td style="background-color:#eee; color: black;">Tanggal 31,<br><b>Sabtu</div></b></td>
                                                </tr>
                                                <tr class="hide">
                                                    <td>
                                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_ulang_31" name="tgl_ulang_31" title="" type="text" value="" style="width:97px" readonly>
                                                        <input autocomplete="off" class="form-control has-spinner hide" data-original-title="" id="hari_31" name="hari_31" title="" type="text" value="selasa" style="width:97px" readonly>
                                                    </td>
                                                </tr>
                                                <tr class="hide">
                                                    <td style="size: 10px;">
                                                        <button id="input_tanggal_31" class="btn btn-primary" style="width:97px">Jadwalkan HD</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="size: 10px;">
                                                        <input class="btn btn-danger" type="reset" name="reset" value="Reset Tanggal">
                                                    </td>
                                                </tr>
                                            </table>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        
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
                 
                    
                    @if($nik == '200859' || $nik == '600098')
                    <div class="form-group form-button" id="sf7">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-warning text-right">
                                <div class="row">
                      
                                 
                                    <div class="col-md-2">&nbsp; </div>
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="hapus" name="hapus">
                                        Hapus Jadwal Pasien
                                    </button>
                                    
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        <i class="fa fa-save" aria-hidden="true"></i>  Simpan
                                    </button>
                                    

                                    <div data-url="rme/pdf/surat_keterangan_jadwal_hemodialisis" class="hide">
                                        <button class="col-xs-12 col-md-12 btn btn-danger btn-dok-preview">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Lihat Surat Keterangan Jadwal Hemodialisis
                                        </button>
                                    </div>

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
                    @endif
                    
                    
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
   

             


                    <div class="form-group form-cetak-dokumen" id="sf1">
                        <div class="row hide">
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

                    </div>
                </form>
            </div>
        </div>
        <div class="navbar col-md-12">
        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_cari_pasien" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-wd container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Kembali ke Menu Utama
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
                                    <th class="tanggal text-center" data-field="tanggal" data-width="35">
                                        Tgl Periksa
                                    </th>
                                    <th scope="col" class="kode_poli" data-field="kode_poli" data-width="70">
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
      
        </div>
    </div>
</div>



<script>
(function(){
  const tz = "Asia/Jakarta";
  const now = new Date();

  const nowID = new Date(
    now.toLocaleString("en-US", { timeZone: tz })
  );

  const nextMonthDate = new Date(nowID.getFullYear(), nowID.getMonth() + 1, 1);

  const bulanTahun = new Intl.DateTimeFormat("id-ID", {
    timeZone: tz,
    month: "long",
    year: "numeric"
  }).format(nextMonthDate);

  const lastDayNextMonth = new Date(
    nextMonthDate.getFullYear(),
    nextMonthDate.getMonth() + 1,
    0
  ).getDate();

  document.getElementById("bulanDepan").textContent =
    bulanTahun.charAt(0).toUpperCase() + bulanTahun.slice(1);
  document.getElementById("tanggalAkhirDepan").textContent = lastDayNextMonth;
})();
</script>