<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            LAPORAN INDEN PEMERIKSAAN ANTIGEN
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
                        <h4 class="alert alert-success">
                            CARI
                        </h4>
                        <div class="frm" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="form-group">
                                    <div class="">
                                        <label class="col-sm-2 control-label" for="tanggal">
                                            Tanggal Periksa :
                                        </label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="atanggal" name="atanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                                <div class="input-group-addon hide">
                                                    s/d
                                                </div>
                                                <input class="form-control hide" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
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
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table 
                                            class="table bootstrap-table header-fixed table-bordered table-striped xtable-condensed" 
                                            data-toggle="table" 
                                            data-pagination="false"
                                            data-page-size="300"
                                            data-side-pagination="server"
                                            data-sort-name="nama_poli" 
                                            data-sort-order="asc" 
                                            data-show-footer="false"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false">
                                                        No
                                                    </th>
                                                    <th data-width="40" data-align="center" data-valign="middle" data-field="antrian" data-sortable="true" >
                                                        Antrian
                                                    </th>
                                                    <th data-width="40" data-align="center" data-valign="middle" data-field="no_reg" data-sortable="false" >
                                                        No RM
                                                    </th>
                                                    <th data-width="200" data-align="left" data-field="nama" data-sortable="false">
                                                        Nama
                                                    </th>
                                                    <th data-width="60" data-align="left" data-field="telp" data-sortable="false">
                                                        Telp
                                                    </th>
                                                    <th data-align="left"  data-width="150" data-field="email" data-sortable="false">
                                                        Email
                                                    </th>
                                                    <th data-width="40" data-align="left" data-field="tgl_inden" data-sortable="false">
                                                        Tgl Inden
                                                    </th>
                                                    <th data-width="40" data-align="left" data-field="tgl_kunjung" data-sortable="false">
                                                        Tgl Daftar
                                                    </th>
                                                    <th data-width="40" data-align="left" data-field="jam_kunjung" data-sortable="false">
                                                        Jam Daftar
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
                                                </tr>
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
