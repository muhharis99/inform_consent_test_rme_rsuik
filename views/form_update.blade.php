<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            UPDATE
        </h2>
        <div class="text-right col-md-12"><b>Welcome: </b><span id="user" nik="{{ $nik }}">{{ $akses }}</span></div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div id="content">
                <form action="" class="form-horizontal" id="askep" method="post" name="askep">
                    <!-- id will be unique, but class name will be same -->
                    <h4 class="alert alert-success">
                        SERVICE PRINTER RAWAT JALAN
                        <span class="pull-right call-antrian hide" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <input id="id" name="id" type="hidden"/>
                        <input type="hidden" name="mynik" id="mynik" value="{{$nik}}" />
                        <div class="">
                            <label class="col-sm-2 control-label" for="dbf_jumlah">
                                Server :
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" id="server_version" name="server_version" value="" readonly="" style="width:10em;" title="" type="text" value="">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="server_status" name="server_status" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="sql_jumlah">
                                Local :
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" id="local_version" name="local_version" value="" readonly="" style="width:10em;" title="" type="text" value="">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="local_status" name="local_status" readonly="" title="" type="text" value="">
                                    </input>
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
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="reload" type="button" name="reload">
                                        Reload
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="update" type="button" name="update">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <h4 class="alert alert-success hide">
                        INFORMASI
                    </h4>
                    <div class="table-responsive hide">
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
