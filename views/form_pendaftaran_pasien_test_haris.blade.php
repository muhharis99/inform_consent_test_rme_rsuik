<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            Pendaftaran Pasien
        </h2>
        <div class="text-right col-md-12"><b>Welcome: </b><span id="user" nik="{{ $nik }}">{{ $akses }}</span></div>
        <div class="frm col-md-5 col-sm-12 col-xs-12" id="sf0">
            <!--  user name field will be here with next button -->
            <div>
                <form id="warning" method="post" name="">
                    <h4 class="alert alert-success">
                        DATA PASIEN
                    </h4>
                    <div class="form-horizontal" id="sf1">
                        <!--  user name field will be here with next button -->
                        <div class="form-group">
                            <input class="form-control" id="id" name="id" type="hidden"/>
                            <div class="">
                                <label class="control-label col-md-2" for="no_reg">
                                    No.RM :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="no_reg" maxlength="7" name="no_reg" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama" name="nama" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label class="control-label col-md-2" for="tgl_lahir">
                                    Tgl Lahir :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="umur" name="umur" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_lahir" name="tgl_lahir" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label class="control-label col-md-2" for="alamat">
                                    Alamat :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="alamat" name="alamat" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>



                    <h4 class="alert alert-success">
                        DATA ENTRI
                    </h4>
                    <div class="form-horizontal" id="entri">
                        <!--  user name field will be here with next button -->
                        <div class="form-group">
                            <div class="">
                                <label class="control-label col-md-2" for="isi">
                                    Pesan :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="isi" name="isi" readonly="" title="" type="text" value="" required>
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label class="control-label col-md-2" for="durasi">
                                    Durasi :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <select required name="durasi" id="durasi" data-placeholder="Silahkan Pilih..." class="chosen-select">
                                      <option value=""></option>
                                      <option value="1">30 Hari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hide">
                                <label class="control-label col-md-2" for="start">
                                    Start :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="start" name="start" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label class="control-label col-md-2" for="end">
                                    End :
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <div class="">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="end" name="end" readonly="" title="" type="text" value="" required>
                                        </input>
                                    </div>
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
