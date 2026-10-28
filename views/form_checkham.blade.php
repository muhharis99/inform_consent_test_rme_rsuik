<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            Double Checkham HAM
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome:
            </b>
            <span id="user">{{ $akses }}</span>
        </div>
        <div class="frm col-md-3 col-sm-12 col-xs-12" id="sf0">
            <!--  user name field will be here with next button -->
            <div>
                <form id="pasien" method="post" name="pasien">
                    <h4 class="alert alert-success">
                        POLI
                    </h4>
                    <div class="form-group">
                        <label class="control-label" for="poli">
                            Poli :
                        </label>
                        <div class="txtno_reg_spinner">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="poli" name="poli" required="">
                                <option value="null">
                                </option>
                                @foreach ($poli as $all)
                                <option value="{{ $all->kode_poli }}">
                                    {{ $all->nama_poli }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="dokter">
                            Dokter :
                        </label>
                        <div class="no_reg_spinner">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." disabled="" id="dokter" name="dokter" required="">
                                <option value="">
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <input autocomplete="off" class="form-control" data-date-format="DD-MM-YYYY" id="stanggal" name="stanggal" required="" type="text" value="{{ date('d-m-Y') }}">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" id="refresh" name="refresh" required="" type="submit" value="Refresh"/>
                    </div>
                </form>
                <h4 class="alert alert-success">
                    LIST PASIEN
                </h4>
                <input class="form-control" id="spasien" name="spasien" placeholder="Search..." type="text">
                    <div class="table-responsive" id="dpasien" style="overflow-x: scroll;overflow-y: scroll;height: 250px;">
                        <table class="table bootstrap-table header-fixed table-striped table-bordered" id="tapasien">
                            <thead>
                                <tr>
                                    <th class="hide" data-field="id" data-sortable="true">
                                        ID
                                    </th>
                                    <th class="hide" data-field="registered" data-sortable="true">
                                        Registered
                                    </th>
                                    <th data-field="no_reg" data-sortable="true">
                                        No.RM
                                    </th>
                                    <th data-field="nama" data-sortable="true">
                                        Nama
                                    </th>
                                    <th data-field="tgl_lahir" data-sortable="true">
                                        Tgl Lahir
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="select" id="tbpasien">
                            </tbody>
                        </table>
                    </div>
                </input>
            </div>
        </div>
        <div class="col-md-9 col-xs-12 col-sm-12">
            <div id="content">
                <form action="" class="form-horizontal" id="checkham" method="post" name="checkham">
                    <!-- id will be unique, but class name will be same -->
                    <h4 class="alert alert-success">
                        DATA REKAM
                    </h4>
                    <div class="form-group">
                        <!--  user name field will be here with next button -->
                        <fieldset>
                            <input class="form-control" id="id" name="id" type="hidden"/>
                            <div class="">
                                <label class="control-label col-md-2" for="nm_dr">
                                    Dokter :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control" data-original-title="" id="kd_dr" name="kd_dr" readonly="" required="" style="width:4em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control" id="nm_dr" name="nm_dr" readonly="readonly" required="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="">
                                <label class="control-label col-md-2" for="no_reg">
                                    No.RM :
                                </label>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <input autocomplete="off" class="form-control has-spinner" id="no_reg" maxlength="7" name="no_reg" readonly="" style="width:6em;" title="" type="text" value="">
                                            </input>
                                        </div>
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama" name="nama" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <h4 class="alert alert-success">
                        DATA DOUBLE CHECK HAM
                    </h4>
                    <div class="form-group" id="">
                        <div class="">
                            <div class="">
                                <label class="control-label col-md-2 col-xs-12" for="obat">
                                    Obat :
                                </label>
                                <div class="col-md-4 col-xs-12">
                                    <input autocomplete="off" class="form-control" id="obat" name="obat" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="">
                        <hr>
                        </hr>
                    </div>
                    <div class="form-group" id="sf7">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-warning row-right">
                                <div class="row">
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="hapus_checkham" name="hapus_checkham">
                                        Hapus
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="batal_checkham" name="batal_checkham">
                                        Batal
                                    </button>
                                    <input class="col-xs-12 col-md-2 btn btn-danger" id="submit_checkham" name="submit_checkham" type="submit" value="Simpan"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>