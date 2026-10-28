<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            LAPORAN SENSUS M-JKN
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome: 
            </b>
            {{ $nama }}
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="">
                <div id="content">
                    <div class="form-horizontal">
                        <h4 class="alert alert-success">
                            CARI
                        </h4>
                        <div class="frm" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="form-group">
                                    <div class="">
                                        <label class="col-sm-1 control-label" for="tanggal">
                                            Tanggal :
                                        </label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="atanggal" name="atanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                                <div class="input-group-addon">
                                                    -
                                                </div>
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <!--
                                        <label class="col-sm-1 control-label" for="Unit">
                                            Unit :
                                        </label>
                                        <div class="col-sm-3">
                                            <select class="chosen-select" data-placeholder="Semua..." id="unit" multiple="" name="unit" required="">
                                                <option value="all">
                                                </option> 
                                            </select>
                                        </div>
                                        -->
                                        <!--
                                        <label class="col-sm-1 control-label hide" for="rawat">
                                            Rawat :
                                        </label>
                                        <div class="col-sm-2 hide">
                                            <select class="chosen-select" data-placeholder="Semua..." id="rawat" name="rawat" required="">
                                                <option value="all">
                                                </option> 
                                                <option value="jalan">
                                                    Jalan (isoman di rumah)
                                                </option>
                                                <option value="inap">
                                                    Inap (isoman di rsi)
                                                </option>
                                            </select>
                                        </div>
                                        -->
                                        <div class="col-sm-2"> &nbsp; </div>
                                        <div class="col-sm-2">
                                            <div class="checkbox hide">
                                                <label>
                                                <input type="checkbox" name="showpasien" id="showpasien" value="true">
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                Tampilkan Pasien
                                                </label>
                                            </div>
                                        </div>
                                        <label class="col-sm-1 control-label hide" for="poli">
                                            Poli :
                                        </label>
                                        <div class="col-sm-2 hide">
                                            <select class="chosen-select" data-placeholder="Semua..." id="poli" name="poli" required="">
                                                <option value="all">
                                                </option> 
                                                @foreach ($poli as $all)
                                                <option data-kode="{{ $all->kode_poli }}" value="{{ $all->kode_poli }}" data-jenis="{{ $all->group_poli }}">
                                                    {{ $all->nama_poli }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2 hide">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <b>&darr;&uarr;</b>
                                                </div>
                                                <select class="chosen-select" data-placeholder="Urutkan..." id="urut" name="urut" required="">
                                                    <option value="no_reg">
                                                        No RM
                                                    </option>
                                                    <option value="tgl_jadi">
                                                        Tgl Swab
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="Tampilkan">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                            <hr>
                                            </hr>
                                        </div>
                                    </div>
                                    <div class="">
                                        <iframe class="col-md-12 col-sm-12 col-xs-12 " id="report" src="" style="border:none;height:50em;">
                                        </iframe>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
