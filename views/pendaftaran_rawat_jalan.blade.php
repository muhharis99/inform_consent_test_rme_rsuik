<style>
    h4.alert{
        padding-top:0.7em !important;
    }
    .p-0 {
        padding-left:0 !important;
        padding-right:0 !important;
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <!--
        <div class="txr col-md-12"><a href="{{ URL }}rme/main/askep" class="btn btn-default">ASKEP Poli</a></div>
        -->
        <h2 class="row-centered col-md-12">
            FORM PENDAFTARAN PASIEN
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
                <form action="javascript:void(0)" class="form-horizontal" id="pendaftaran" method="post" name="pendaftaran">
                    <!-- id will be unique, but class name will be same -->
                    <h4 class="alert alert-success">
                        RAWAT JALAN
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <input id="id" name="id" type="hidden"/>
                        <div class="">
                            <div class="col-md-6">
                                &nbsp; 
                            </div>
                            <label class="control-label col-md-4" for="no_reg">
                                No.RM :
                            </label>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <input autocomplete="off" class="form-control has-spinner" placeholder="Kosongi untuk pasien baru .." id="no_reg" maxlength="7" name="no_reg" readonly="" style="" title="" type="text" value=""></input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="poli">
                                Poli yang dituju :
                            </label>
                            <div class="col-md-10 col-sm-12 col-xs-12">                                
                                <div class="col-md-4 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="poli" name="poli">
                                        <option value="">
                                        </option>
                                        @foreach ($poli as $all)
                                        <option value="{{ $all->kode_poli }}">
                                            {{ $all->nama_poli }} ({{ $all->kode_poli }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-md-1" for="dokter">
                                    Dokter :
                                </label>                    
                                <div class="col-md-7 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="dokter" name="dokter">
                                        <option value="">
                                        </option>
                                        @foreach ($dokter as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }} ({{ $all->kode }}) || {{ $all->praktek }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="tanggal_masuk">
                                Tanggal Pendaftaran :
                            </label>
                            
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" placeholder="Tanggal periksa" class="form-control has-spinner datemask" data-original-title="" id="tanggal_masuk" name="tanggal_masuk" title="" type="text" value="">
                                    </input>
                                </div> 
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" placeholder="Jam periksa" class="form-control has-spinner timemask" data-original-title="" id="jam_masuk" name="jam_masuk" title="" type="text" value="">
                                    </input>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="row"></div>

                    <h4 class="alert alert-success">
                        IDENTITAS PASIEN
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <div class="">
                            <label class="col-sm-2 control-label" for="asuransi">
                                Nama :
                            </label>
                            <div class="col-sm-10">
                                <input autocomplete="off" placeholder="Nama pasien"  class="form-control has-spinner" data-original-title="" id="nama" name="nama" title="" type="text">
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="asuransi">
                                NIK :
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group col-sm-2">
                                    <div class="input-group-btn ">
                                        <input autocomplete="off" placeholder="Nomor induk kependudukan" maxlength="16" class="form-control has-spinner" data-original-title="" id="nik" name="nik" title="" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="tempat_lahir">
                                Tempat, tanggal lahir :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <input autocomplete="off" placeholder="Kota tempat lahir"  class="form-control has-spinner" id="tempat_lahir" name="tempat_lahir" title="" type="text" value="">
                                    </input>
                                </div>
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control has-spinner datemask" placeholder="Tanggal lahir" data-original-title="" id="tanggal_lahir" name="tanggal_lahir" title="" type="text" value="">
                                </div>
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control has-spinner" placeholder="Umur ..." data-original-title="" id="umur" name="umur" title="" type="text" value="">
                                </div>
                                <label class="control-label col-md-3" for="jenis_kelamin">
                                    Jenis Kelamin :
                                </label>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">
                                            
                                        </option>
                                        <option value="L">
                                            LAKI-LAKI
                                        </option>
                                        <option value="P">
                                            PEREMPUAN
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="pekerjaan">
                                Pekerjaan :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="pekerjaan" name="pekerjaan">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($pekerjaan as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" maxlength="16"  class="form-control has-spinner hide" data-original-title="" id="pekerjaan_lain" name="pekerjaan_lain" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="perkawinan">
                                    Status perkawinan :
                                </label>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="perkawinan" name="perkawinan">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($perkawinan as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="pendidikan">
                                Pendidikan :
                            </label>
                            <div class="col-md-10 col-xs-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="pendidikan" name="pendidikan">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($pendidikan as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" maxlength="16" class="form-control has-spinner hide" data-original-title="" id="pendidikan_lain" name="pendidikan_lain" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="bahasa">
                                Bahasa :
                            </label>
                            <div class="col-md-10 col-xs-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="bahasa" name="bahasa">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($bahasa as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" maxlength="16" class="form-control has-spinner hide" data-original-title="" id="bahasa_lain" name="bahasa_lain" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="agama">
                                Agama :
                            </label>
                            <div class="col-md-10 col-xs-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="agama" name="agama">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($agama as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" maxlength="16" class="form-control has-spinner hide" data-original-title="" id="agama_lain" name="agama_lain" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="etnis">
                                Etnis :
                            </label>
                            <div class="col-md-10 col-xs-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih Etnis..." id="etnis" name="etnis">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($etnis as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" maxlength="16" class="form-control has-spinner hide" data-original-title="" id="etnis_lain" name="etnis_lain" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="jalan">
                                Alamat lengkap :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <label class="control-label col-md-1" for="jalan">
                                    Jl :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Jalan ..." class="form-control" data-original-title="" id="jalan" name="jalan" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="dukuh">
                                    Dk :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Dukuh ..." class="form-control" data-original-title="" id="dukuh" name="dukuh" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="rtrw">
                                    RT/RW :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="RT/RW ..." class="form-control" data-original-title="" id="rtrw" name="rtrw" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kelurahan">
                                    Kel. :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kelurahan ..." class="form-control" data-original-title="" id="kelurahan" name="kelurahan" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kecamatan">
                                    Kec :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kecamatan ..." class="form-control" data-original-title="" id="kecamatan" name="kecamatan" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kabupaten">
                                    Kab. :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kabupaten ..." class="form-control" data-original-title="" id="kabupaten" name="kabupaten" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="telp1">
                                No. Telp/Hp :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control" placeholder="Telp 1"  id="telp1" name="telp1" title="" type="text">
                                    </input>
                                </div>
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control" placeholder="Telp 2"  id="telp2" name="telp2" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="email">
                                Email :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-4 p-0">
                                    <input autocomplete="off" class="form-control" placeholder="Email"  id="email" name="email" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="ibu">
                                Nama ibu kandung :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Nama ibu kandung ..." class="form-control" data-original-title="" id="ibu" name="ibu" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="ayah">
                                    Nama ayah :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Nama ayah ..." class="form-control" data-original-title="" id="ayah" name="ayah" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="suami">
                                Nama suami :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Nama suami (jika sudah menikah) ..." class="form-control" data-original-title="" id="suami" name="suami" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-3" for="asuransi">
                                Akan menggunakan hak sebagai pasien :
                            </label>
                            <div class="col-md-9 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih penjamin..." id="asuransi" name="asuransi">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($asuransi as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 p-0">
                                    <input autocomplete="off" placeholder="Nomor kartu jaminan peserta" class="form-control" data-original-title="" id="nokartu" name="nokartu" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-2" for="sep">
                                    Pembuatan SEP :
                                </label>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="sep" name="sep">
                                        <option value="bridging">
                                            BRIDGING 
                                        </option>
                                        <option value="vclaim">
                                            WEBSITE VCLAIM
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row"></div>
                    <h4 class="alert alert-success">
                        IDENTITAS PENGANTAR
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <div class="">
                            <label class="col-md-2 control-label" for="nama_pengantar">
                                Nama :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-12 p-0">
                                    <input autocomplete="off" placeholder="Nama pengantar pasien"  class="form-control has-spinner" data-original-title="" id="nama_pengantar" name="nama_pengantar" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="jalan_pengantar">
                                Alamat lengkap pengantar : 
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <label class="control-label col-md-1" for="jalan_pengantar">
                                    Jl :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Jalan ..." class="form-control" data-original-title="" id="jalan_pengantar" name="jalan_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="dukuh_pengantar">
                                    Dk :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Dukuh ..." class="form-control" data-original-title="" id="dukuh_pengantar" name="dukuh_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="rtrw_pengantar">
                                    RT/RW :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="RT/RW ..." class="form-control" data-original-title="" id="rtrw_pengantar" name="rtrw_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kelurahan_pengantar">
                                    Kel. :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kelurahan ..." class="form-control" data-original-title="" id="kelurahan_pengantar" name="kelurahan_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kecamatan_pengantar">
                                    Kec :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kecamatan ..." class="form-control" data-original-title="" id="kecamatan_pengantar" name="kecamatan_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <label class="control-label col-md-1" for="kabupaten_pengantar">
                                    Kab. :
                                </label>
                                <div class="col-md-5 p-0">
                                    <input autocomplete="off" placeholder="Kabupaten ..." class="form-control" data-original-title="" id="kabupaten_pengantar" name="kabupaten_pengantar" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="telp1_pengantar">
                                No. Telp/Hp :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control" placeholder="Telp 1"  id="telp1_pengantar" name="telp1_pengantar" title="" type="text">
                                    </input>
                                </div>
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" class="form-control" placeholder="Telp 2"  id="telp2_pengantar" name="telp2_pengantar" title="" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-sm-2" for="hubungan_pengantar">
                                Hubungan dengan pasien :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih hubungan..." id="hubungan_pengantar" name="hubungan_pengantar">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($hubungan as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row"></div>
                    <h4 class="alert alert-success">
                        RUJUKAN PASIEN
                    </h4>
                    <div class="form-group" id="sf1">
                        <div class="hide">
                            <label class="col-md-2 control-label" for="perujuk">
                                Nomer rujukan  :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-2 p-0">
                                    <input autocomplete="off" disabled placeholder="Nomer rujukan ..."  class="form-control has-spinner" data-original-title="" id="perujuk_nomer" name="perujuk_nomer" title="" type="text">
                                </div>
                                <div class="col-md-2 p-0">
                                    <input type="button" class="btn btn-danger" value="Ambil Rujukan BPJS" />
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="perujuk">
                                Rujukan  :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih jenis rujukan ..." id="perujuk" name="perujuk">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($rujuk as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ strtoupper($all->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="perujuk_praktek_rsi">
                                Praktek RSI :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-1 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih jenis rujukan ..." id="perujuk_praktek_rsi" name="perujuk_praktek_rsi">
                                        <option value="T">
                                            Tidak
                                        </option>
                                        <option value="Y">
                                            Ya
                                        </option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="perujuk_dokter_rsi">
                                    Kode Dokter RSI :
                                </label>
                                <div class="col-md-9 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih dokter perujuk dan praktek di RSI ..." id="perujuk_dokter_rsi" name="perujuk_dokter_rsi">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($dokter as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }} ({{ $all->kode }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="perujuk_nama">
                                Nama (perujuk) :
                            </label>
                            <div class="col-md-10">
                                <div class="col-md-12 p-0">
                                    <input autocomplete="off" placeholder="Nama perujuk ..."  class="form-control has-spinner" data-original-title="" id="perujuk_nama" name="perujuk_nama" title="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="perujuk_alamat">
                                Alamat (perujuk) :
                            </label>
                            <div class="col-sm-10">
                                <input autocomplete="off" placeholder="Alamat perujuk ..."  class="form-control has-spinner" data-original-title="" id="perujuk_alamat" name="perujuk_alamat" title="" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row"></div>
                    <h4 class="alert alert-success">
                        SEP BPJS KESEHATAN
                    </h4>
                    <div class="form-group" id="sf1">
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_nomor_kartu">
                                No. Kartu :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <input placeholder="Nomor kartu " readonly="true" class="form-control" id="sep_nomor_kartu" name="sep_nomor_kartu" title="" type="text">
                                </div>
                                <input type="button" class="col-md-1 btn btn-danger" name="sep_cek_status" id="sep_cek_status" value="Cek Kartu" />
                                <label class="col-md-4 control-label" for="sep_nomor">
                                    No. SEP :
                                </label>
                                <div class="col-md-3 p-0">
                                    <input placeholder="Nomer SEP " readonly="true" class="form-control" id="sep_nomor" name="sep_nomor" title="" type="text">
                                </div>
                                <div class="col-md-1 p-0">
                                    <input placeholder="Tgl SEP " readonly="true" class="form-control" id="sep_tanggal" name="sep_tanggal" title="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_no_rm">
                                Peserta :
                            </label>
                            <div class="col-md-10">
                                <div class="col-md-1 p-0">
                                    <input placeholder="No RM " readonly="true" class="form-control" id="sep_no_rm" name="sep_no_rm" title="" type="text">
                                </div>
                                <div class="col-md-7 p-0">
                                    <input placeholder="Nama " readonly="true" class="form-control" id="sep_detil_peserta" name="sep_detil_peserta" title="" type="text">
                                </div>
                                <div class="col-md-3 p-0">
                                    <input placeholder="Status " readonly="true" class="form-control" id="sep_status" name="sep_status" title="" type="text">
                                </div>
                                <div class="col-md-1 p-0">
                                    <input placeholder="Kelas " readonly="true" class="form-control" id="sep_kelas_hak" name="sep_kelas_hak" title="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_nomor_rujukan">
                                Rujukan :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <input placeholder="Nomor rujukan " readonly="true" class="form-control" id="sep_nomor_rujukan" name="sep_nomor_rujukan" title="" type="text">
                                    <input type="hidden" name="sep_asal_rujukan" id="sep_asal_rujukan" />
                                    <input type="hidden" name="sep_ppk_rujukan" id="sep_ppk_rujukan" />
                                </div>
                                <div class="col-md-1 p-0">
                                    <input placeholder="Tgl Rujukan" readonly="true" class="form-control" id="sep_tgl_rujukan" name="sep_tgl_rujukan" title="" type="text">
                                </div>
                                <div class="col-md-5 p-0">
                                    <input placeholder="PPK Perujuk " readonly="true" class="form-control" id="sep_nama_ppk_perujuk" name="sep_nama_ppk_perujuk" title="" type="text">
                                </div>
                                <input type="button" class="col-md-3 btn btn-danger" name="sep_get_rujukan" id="sep_get_rujukan" value="Ambil Rujukan" />
                                <div class="col-md-12 p-0">
                                    <input placeholder="Diagnosa rujukan ... " readonly="true" class="form-control" id="sep_diagnosa_rujukan" name="sep_diagnosa_rujukan" title="" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_rujukan_poli">
                                Poli :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <select class="chosen-select" data-placeholder="" id="sep_rujukan_poli" name="sep_rujukan_poli">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($bpjs_poli as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="sep_poli_eksekutif">
                                    Eksekutif :
                                </label>
                                <div class="col-md-1 p-0">
                                    <select class="chosen-select" disabled data-placeholder="" id="sep_poli_eksekutif" name="sep_poli_eksekutif">
                                        <option value="1">
                                            YA
                                        </option>
                                        <option value="0" selected>
                                            TIDAK
                                        </option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="sep_cob">
                                    COB :
                                </label>
                                <div class="col-md-1 p-0">
                                    <select class="chosen-select" disabled data-placeholder="" id="sep_cob" name="sep_cob">
                                        <option value="1">
                                            TA
                                        </option>
                                        <option value="0" selected>
                                            TIDAK
                                        </option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="sep_katarak">
                                    Katarak :
                                </label>
                                <div class="col-md-1 p-0">
                                    <select class="chosen-select" disabled data-placeholder="" id="sep_katarak" name="sep_katarak">
                                        <option value="1">
                                            YA
                                        </option>
                                        <option value="0" selected>
                                            TIDAK
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_laka_lantas">
                                KLL :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-5 p-0">
                                    <select class="chosen-select" data-placeholder="" id="sep_laka_lantas" name="sep_laka_lantas">
                                        <option value="0" selected>
                                            BUKAN KECELAKAAN LALU LINTAS
                                        </option>
                                        <option value="1">
                                            LAKA LANTAS DAN BUKAN KECELAKAAN KERJA
                                        </option>
                                        <option value="2">
                                            KECELAKAAN LALU LINTAS DAN KECELAKAAN KERJA
                                        </option>
                                        <option value="3">
                                            KECELAKAAN KERJA
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-7 p-0">
                                    <input placeholder="No LP" readonly="true" class="form-control" id="sep_kll_no_lp" name="sep_kll_no_lp" title="" type="text">
                                </div>
                                <div class="col-md-1 p-0">
                                    <input placeholder="Tgl Kejadian" readonly="true" class="form-control" id="sep_kll_tgl" name="sep_kll_tgl" title="" type="text">
                                </div>
                                <div class="col-md-11 p-0">
                                    <input placeholder="Keterangan" readonly="true" class="form-control" id="sep_kll_keterangan" name="sep_kll_keterangan" title="" type="text">
                                </div>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" disabled data-placeholder="Suplesi ..." id="sep_kll_suplesi" name="sep_kll_suplesi">
                                        <option value="" selected>
                                            
                                        </option>
                                        <option value="1">
                                            YA
                                        </option>
                                        <option value="0">
                                            TIDAK
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 p-0">
                                    <input placeholder="No SEP suplesi ..." readonly="true" class="form-control" id="sep_kll_no_sep_suplesi" name="sep_kll_no_sep_suplesi" title="" type="text">
                                </div>
                                
                                <label class="col-md-1 control-label" for="sep_laka_propinsi">
                                    Lokasi :
                                </label>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" disabled data-placeholder="Propinsi ..." id="sep_kll_suplesi" name="sep_kll_suplesi">
                                        <option value="" selected>
                                            
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" disabled data-placeholder="Kabupaten ..." id="sep_kll_suplesi" name="sep_kll_suplesi">
                                        <option value="" selected>
                                            
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" disabled data-placeholder="Kecamatan ..." id="sep_kll_suplesi" name="sep_kll_suplesi">
                                        <option value="" selected>
                                            
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_skdp_no">
                                SKDP :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-3 p-0">
                                    <input placeholder="No SKDP ..." readonly="true" class="form-control" id="sep_skdp_no" name="sep_skdp_no" title="" type="text">
                                </div>
                                <div class="col-md-9 p-0">
                                    <select class="chosen-select" disabled data-placeholder="DPJP SKDP ..." id="sep_skdp_dpjp" name="sep_skdp_dpjp">
                                        <option value="">
                                            
                                        </option>
                                        @foreach ($bpjs_dokter as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_dpjp_layan">
                                DPJP Pelayanan :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-12 p-0">
                                    <select class="chosen-select" data-placeholder="DPJP Pelayanan ..." id="sep_dpjp_layan" name="sep_dpjp_layan">
                                        <option value="" selected>
                                            
                                        </option>
                                        @foreach ($bpjs_dokter as $all)
                                        <option value="{{ $all->kode }}">
                                            {{ $all->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_tujuan_kunjungan">
                                Tujuan Kunjungan :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih tujuan kunjungan ..." id="sep_tujuan_kunjungan" name="sep_tujuan_kunjungan">
                                        <option value="0">
                                            NORMAL
                                        </option>
                                        <option value="1">
                                            PROSEDUR
                                        </option>
                                        <option value="2">
                                            KONSULTASI DOKTER
                                        </option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="sep_flag_procedure">
                                    Prosedur :
                                </label>
                                <div class="col-md-4 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan pilih prosedur ..." id="sep_flag_procedure" name="sep_flag_procedure">
                                        <option value="">

                                        </option>
                                        <option value="0">
                                            PROSEDUR TIDAK BERKELANJUTAN
                                        </option>
                                        <option value="1">
                                            PROSEDUR DAN TERAPI BERKELANJUTAN
                                        </option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="sep_penunjang">
                                    Penunjang :
                                </label>
                                <div class="col-md-2 p-0">
                                    <select class="chosen-select" data-placeholder="Penunjang ..." id="sep_penunjang" name="sep_penunjang">
                                        <option value="">

                                        </option>
                                        <option value="1">
                                            RADIOTERAPI
                                        </option>
                                        <option value="2">
                                            KEMOTERAPI
                                        </option>
                                        <option value="3">
                                            REHAB MEDIK
                                        </option>
                                        <option value="4">
                                            REHAB PSIKOSOSIAL
                                        </option>
                                        <option value="5">
                                            TRANSFUSI DARAH
                                        </option>
                                        <option value="6">
                                            PELAYANAN GIGI
                                        </option>
                                        <option value="7">
                                            LABORATORIUM
                                        </option>
                                        <option value="8">
                                            USG
                                        </option>
                                        <option value="9">
                                            FARMASI
                                        </option>
                                        <option value="10">
                                            LAIN-LAIN
                                        </option>
                                        <option value="11">
                                            MRI
                                        </option>
                                        <option value="12">
                                            HEMODIALISA
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="sep_asesmen_pelayanan">
                                Asesmen Pelayanan :
                            </label>
                            <div class="col-md-10 col-sm-12">
                                <div class="col-md-12 p-0">
                                    <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="sep_asesmen_pelayanan" name="sep_asesmen_pelayanan">
                                        <option value="1">
                                            POLI SPESIALIS TIDAK TERSEDIA PADA HARI SEBELUMNYA
                                        </option>
                                        <option value="2">
                                            JAM POLI TELAH BERAKHIR PADA HARI SEBELUMNYA
                                        </option>
                                        <option value="3">
                                            DOKTER SPESIALIS YANG DIMAKSUD TIDAK PRAKTEK PADA HARI SEBELUMNYA
                                        </option>
                                        <option value="4">
                                            ATAS INSTRUKSI RS
                                        </option>
                                        <option value="5">
                                            TUJUAN KONTROL
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-md-2 control-label" for="sep_catatan">
                                Catatan :
                            </label>
                            <div class="col-md-10">
                                <div class="col-md-12 p-0">
                                    <input placeholder="Catatan ..." class="form-control" id="sep_catatan" name="sep_catatan" title="" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"></div>
                    <br />
                    <br />
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
                    <div class="form-group" id="sf7">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-warning row-right">
                                <div class="row">
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="batal" name="batal">
                                        Batal
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        Simpan
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak" name="cetak">
                                        Cetak Ulang
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

<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_asesmen_awal_frame" role="dialog" style="display: none; margin:0px;">
    <div class="modal-wd container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> KEMBALI KE OPERASI IBS
                </button>
            </div>
            <div class="modal-body form-group" style="padding-left:0px !important; padding-right:0px !important; padding-bottom:0px !important;">
                <div class="col-md-12">
                    <iframe id="asesmen_awal_frame" frameborder="0" height="520" scrolling="yes" src="" width="100%">
                    </iframe>
                    <!--
                    <h4 class="alert alert-success">RESEP</h4>
                    <div class="text-right">
                    </div>
                    -->
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