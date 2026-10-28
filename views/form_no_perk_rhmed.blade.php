<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            Master Nama Perkiraan (No Perk) REHAB MEDIK
        </h2>
        <div class="text-right col-md-12"><b>Welcome: </b><span id="user" nik="{{ $nik }}">{{ $akses }}</span></div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div id="content">
                <form action="" class="form-horizontal" id="askep" method="post" name="askep">
                    <!-- id will be unique, but class name will be same -->
                    <h4 class="alert alert-success">
                        NO PERK
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <input id="id" name="id" type="hidden"/>
                        <input type="hidden" name="mynik" id="mynik" value="{{$nik}}" />
                        <div class="">
                            <label class="col-sm-2 control-label" for="dbf_jumlah">
                                Data DBF :
                            </label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" id="dbf_jumlah" name="dbf_jumlah" readonly="" style="width:6em;" title="" type="text" value="{{$dbf_tipe}}">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="dbf_nama" name="dbf_nama" readonly="" title="" type="text" value="{{$dbf_nama}}">
                                    </input>
                                </div>
                            </div>
                        </div>
						<div class="">
                            <label class="control-label col-md-2" for="dbf_modifikasi">
                                Tanggal Modifikasi DBF :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="dbf_modifikasi" name="dbf_modifikasi" title="" type="text" readonly="true" value="{{$dbf_tgl}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="sql_jumlah">
                                Data SQL :
                            </label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" id="sql_jumlah" name="sql_jumlah" readonly="" style="width:6em;" title="" type="text" value="{{$sql_tipe}}">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="sql_nama" name="sql_nama" readonly="" title="" type="text" value="{{$sql_nama}}">
                                    </input>
                                </div>
                            </div>
                        </div>
						<div class="">
                            <label class="control-label col-md-2" for="sql_modifikasi">
                                Tanggal Modifikasi SQL :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="sql_modifikasi" name="sql_modifikasi" title="" type="text" value="{{$sql_tgl}}" readonly="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="form-group" id="">
                        <div class="col-md-12">
                            <div class="col-md-12 row-right">
                                <div class="row">
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="synchronize" type="button" name="synchronize">
                                        Synchronize
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="lihat_tgl_dbf" type="button" name="lihat_tgl_dbf">
                                        Lihat Tgl DBF/SQL
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <h4 class="alert alert-success">
                        INFORMASI
                    </h4>
                    <div class="table-responsive">
                        <style>
                            
                        </style>
                        <table id="tbinfo">
                            <thead>
                                <tr>
                                    <th width="100">
                                        Tipe
                                    </th>
                                    <th width="500">
                                        Database
                                    </th>
                                    <th width="100">
                                        Baris
                                    </th>
                                    <th width="200">
                                        Update
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbodyinfo">
                                
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="navbar col-md-12">
        </div>
    </div>
</div>
