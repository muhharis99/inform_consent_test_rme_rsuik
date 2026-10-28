<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            SPM REHAB MEDIK
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
                                            data-sort-name="no_kwt" 
                                            data-sort-order="asc" 
                                            data-show-footer="true"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="10" data-valign="middle" data-align="center" data-field="no" data-sortable="false">
                                                        No
                                                    </th>
                                                    <th data-width="1" data-visible="false" data-align="right" data-field="tanggal" data-sortable="false">
                                                        
                                                    </th>
                                                    <th data-width="1" data-visible="false" data-align="right" data-field="kode_dokter" data-sortable="false">
                                                        
                                                    </th>
                                                    <th data-width="1" data-visible="false" data-align="right" data-field="kode_poli" data-sortable="false">
                                                        
                                                    </th>
                                                    <th data-width="20" data-align="right" data-field="no_kwt" data-sortable="false">
                                                        No SPM
                                                    </th>
                                                    <th data-width="20" data-align="right" data-field="no_reg" data-sortable="false">
                                                        No RM
                                                    </th>
                                                    <th data-align="left" data-field="nama" data-sortable="false">
                                                        Nama
                                                    </th>
                                                    <th data-width="60" data-align="left" data-field="dokter" data-sortable="false">
                                                        Dokter 
                                                    </th>
                                                    <th data-width="50" data-align="left" data-field="poli" data-sortable="false">
                                                        Poli/Bangsal
                                                    </th>
                                                    <th data-width="30" data-align="right" data-field="nominal" data-sortable="false">
                                                        Nominal
                                                    </th>
                                                    <th data-width="25" data-align="right" data-field="status" data-sortable="false">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6">Total</th>
                                                    <th data-footer-field="grand_total" colspan="2"><b class="grand_total" style="text-align:center;">.</b></th>
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

<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_bill_frame" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-md container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Kembali
                </button> 
                &nbsp; 
                <button class="btn btn-default" id="status_spm" data-notran="" data-noreg="" data-tanggal="" data-nama="" data-poli="" data-kodepoli="" data-dokter="" data-kodedokter="" data-source="" data-nominal="" data-status="" data-dihapus="" type="button">
                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Aktifkan
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <iframe id="bill_frame" frameborder="0" height="450" scrolling="no" src="" width="100%">
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
