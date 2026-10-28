<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            LAPORAN PENGGUNAAN BILLING BARU FISIOTERAPI
        </h2>
        <div class="text-right col-md-12">
            <b>
                Pengguna :
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
                                            data-show-footer="true"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="40" data-align="center" data-valign="middle" data-field="kode_poli" data-visible="false" data-sortable="true" rowspan="2">
                                                        Kode Poli
                                                    </th>
                                                    <th data-align="left" data-valign="middle" data-field="nama_poli" data-sortable="false" rowspan="2">
                                                        Nama Poli
                                                    </th>
                                                    <th data-align="center" data-field="rawat_jalan" data-sortable="false" colspan="4" style="border-bottom-width:1px;">
                                                        Rawat Jalan
                                                    </th>
                                                    <th data-align="center" data-field="rawat_inap" data-sortable="false" colspan="4" style="border-bottom-width:1px;">
                                                        Rawat Inap
                                                    </th>
                                                    <th data-width="40" data-align="right" data-valign="middle" data-field="total_pasien" data-sortable="false" rowspan="2" >
                                                        Total Billing
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-align="center" data-field="rajal_lama" data-sortable="false">
                                                        Lama
                                                    </th>
                                                    <th data-align="center" data-field="rajal_baru" data-sortable="false">
                                                        Baru
                                                    </th>
                                                    <th data-align="center" data-field="rajal_total" data-sortable="false">
                                                        Total
                                                    </th>
                                                    <th data-align="right" data-field="rajal_persen" data-sortable="false">
                                                        % &nbsp; 
                                                    </th>
                                                    <th data-align="center" data-field="ranap_lama" data-sortable="false">
                                                        Lama
                                                    </th>
                                                    <th data-align="center" data-field="ranap_baru" data-sortable="false">
                                                        Baru
                                                    </th>
                                                    <th data-align="center" data-field="ranap_total" data-sortable="false">
                                                        Total
                                                    </th>
                                                    <th data-align="right" data-field="ranap_persen" data-sortable="false">
                                                        % &nbsp; 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="10">Total</th>
                                                    <th data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
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
