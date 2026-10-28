<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            DASHBOARD APM FINGER
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome:
            </b>
            {{ $akses }}
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="">
                <div id="content">
                    <div class="form-horizontal">
                        <h4 class="alert alert-success hide">
                            CARI
                        </h4>
                        <div class="frm" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="form-group">
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="">
                                        <label class="col-sm-1 control-label" for="tanggal">
                                            Tanggal :
                                        </label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="atanggal" name="atanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                                <div class="input-group-addon">
                                                    s/d
                                                </div>
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="Tampilkan">
                                            </input>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="small-box bg-warning kategori" data-kategori="">
                                                <div class="inner">
                                                    <h3 class="jumlah_total">0</h3>

                                                    <p class="ket_inden">Total Scan/Entry</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="COVID 19">
                                                <div class="inner">
                                                    <h3 class="jumlah_sukses">0</h3>

                                                    <p>Berhasil Cetak <i>e</i>-SEP</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-success kategori" data-kategori="NON COVID 19">
                                                <div class="inner">
                                                    <h3 class="jumlah_gagal">0</h3>

                                                    <p>Gagal</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="hide">
										<label class="control-label col-md-1">
											Billing :
										</label>
										<div class="col-md-4">
											<select class="chosen-select" data-placeholder="Silahkan Pilih..." id="bill" name="bill" style="width:100%">
												<option value="">
												</option>
												@foreach($source as $all)
												<option value="{{ $all->kode }}">
													{{ $all->nama }}
												</option>
												@endforeach
											</select>
										</div>
									</div>
                                    <div class="hide">
                                        <div class="col-sm-12 col-md-12">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <style>
                                            .xtable-condensed{
                                                font-size: 12px !important;
                                            }
                                        </style>
                                        <table
                                            class="table bootstrap-table header-fixed table-bordered table-striped xtable-condensed"
                                            data-toggle="table"
                                            data-pagination="false"
                                            data-page-size="200"
                                            data-side-pagination="server"
                                            data-sort-name="id"
                                            data-sort-order="desc"
                                            data-show-footer="false"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="18" data-valign="middle" data-align="center" data-field="no" data-sortable="false">
                                                        No
                                                    </th>
                                                    <th data-width="20" data-align="center" data-valign="middle" data-field="no_reg" data-sortable="false" >
                                                        No RM
                                                    </th>
                                                    <th data-width="40" data-align="left" data-field="nama" data-sortable="false">
                                                        Nama
                                                    </th>
                                                    <th data-width="32" data-align="left" data-field="waktu" data-sortable="false">
                                                        Waktu
                                                    </th>
                                                    <th data-width="60" data-align="left" data-field="validasi" data-sortable="false">
                                                        Validasi
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="ket" data-sortable="false">
                                                        Keterangan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="">
                                        <iframe class="col-md-12 col-sm-12 col-xs-12 " id="Xreport" src="" alt="loading..." style="border:none;height:39em;">

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
