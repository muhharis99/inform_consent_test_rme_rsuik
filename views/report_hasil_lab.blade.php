<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            BILLING - RSU ISLAM KLATEN
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome:
            </b>
            <span id="user">{{ $akses }}</span>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <form class="form-horizontal" id="haslab" method="post" name="haslab">
                        <!-- id will be unique, but class name will be same -->
                        <h4 class="alert alert-success">
                            DATA PASIEN
                        </h4>
                        <div class="frm form-group" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="">
                                    <label class="control-label col-md-3" for="no_reg">
                                        No RM :
                                    </label>
                                    <div class="col-md-9 no_reg_spinner">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_reg" maxlength="7" name="no_reg" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="control-label col-md-3" for="nama">
                                        Nama :
                                    </label>
                                    <div class="col-md-9">
                                        <input autocomplete="off" class="form-control" data-original-title="" id="nama" name="nama" readonly="" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="control-label col-md-3" for="alamat">
                                        Alamat :
                                    </label>
                                    <div class="col-md-9">
                                        <input autocomplete="off" class="form-control" data-original-title="" id="alamat" name="alamat" readonly="" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="form-horizontal" id="sf1">
                        <!--  user name field will be here with next button -->
                        <h4 class="alert alert-success">
                            RIWAYAT TRANSAKSI
                        </h4>
                        <div class="form-group">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#menu1">
                                            Rawat Jalan
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="menu1">
                                        <table class="table bootstrap-table header-fixed table-striped" data-sort-name="nama" data-sort-order="desc" id="tahisklinik">
                                            <thead>
                                                <tr>
                                                    <th data-align="center" data-field="tanggal" data-sortable="true">
                                                        Tanggal
                                                    </th>
                                                    <th data-align="center" data-field="no_sampel" data-sortable="true">
                                                        No Kwitansi
                                                    </th>
                                                    @if($induk == 'LAB')
                                                    <th class='' data-align="center" data-field="aksi" data-sortable="true">
                                                    </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbhisklinik">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 form-horizontal thumbnail-group" id="hasil">
            <div class="form-horizontal" id="sf1">
                <!--  user name field will be here with next button -->
                <h4 class="alert alert-success">
                    RINCIAN
                </h4>
                <div class="form-group">
                    <div class="col-md-12 hide">
                        <table class="table bootstrap-table header-fixed table-striped" data-sort-name="nama" data-sort-order="desc" id="tahaslab">
                            <thead>
                                <tr>
                                    <th data-align="center" data-field="kd_pemeriksaan" data-sortable="true">
                                        Pemeriksaan
                                    </th>
                                    <th data-align="center" data-field="hasil" data-sortable="true">
                                        Hasil
                                    </th>
                                    <th data-align="center" data-field="normal" data-sortable="true">
                                        Normal
                                    </th>
                                    <th data-align="center" data-field="satuan" data-sortable="true">
                                        Satuan
                                    </th>
                                    <th data-align="center" data-field="flag" data-sortable="true">
                                        Flag
                                    </th>
                                    <th data-align="center" data-field="ket" data-sortable="true">
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="select" id="tbhaslab">
                            </tbody>
                        </table>
                    </div>
                    <iframe class="col-md-12 col-sm-12 col-xs-12 " id="report" src="" style="border:none;height:50em;">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
