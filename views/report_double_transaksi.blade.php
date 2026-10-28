<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            MONITORING PERKIRAAN DOUBLE TRANSAKSI (HARIAN)
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
                                        <label class="col-sm-2 control-label" for="tanggal">
                                            Tanggal Transaksi :
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
                                        <div class="col-sm-3 hide">
                                            <div class="small-box bg-warning kategori" data-kategori="">
                                                <div class="inner">
                                                    <h3 class="jumlah_inden">0</h3>

                                                    <p class="ket_inden">Pasien Meninggal</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 hide">
                                            <div class="small-box bg-danger kategori" data-kategori="COVID 19">
                                                <div class="inner">
                                                    <h3 class="jumlah_daftar">0</h3>

                                                    <p>Covid 19</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 hide">
                                            <div class="small-box bg-success kategori" data-kategori="NON COVID 19">
                                                <div class="inner">
                                                    <h3 class="jumlah_hasil">0</h3>

                                                    <p>Non Covid</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                            <br />
                                            <br />
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
                                            data-sort-name="nama_poli"
                                            data-sort-order="asc"
                                            data-show-footer="false"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="18" data-valign="middle" data-align="center" data-field="no" data-sortable="false">
                                                        No
                                                    </th>
                                                    <th data-width="32" data-align="center" data-valign="middle" data-field="no_reg" data-sortable="false" >
                                                        No RM
                                                    </th>
                                                    <th data-width="110" data-align="left" data-field="nama" data-sortable="false">
                                                        Nama
                                                    </th>
                                                    <th data-width="40" data-align="left" data-field="tgl_kunjung" data-sortable="false">
                                                        Tgl Masuk
                                                    </th>
                                                    <th data-width="30" data-align="left" data-field="jam_kunjung" data-sortable="false">
                                                        Jam 
                                                    </th>
                                                    <th data-width="70" data-align="left" data-field="poli_id" data-sortable="false">
                                                        Poli/Bangsal
                                                    </th>
                                                    <th data-width="150" data-align="left" data-field="no_transaksi" data-sortable="false">
                                                        Transaksi
                                                    </th>
                                                    <th data-width="120" data-align="left" data-field="petugas" data-sortable="false">
                                                        Petugas/Perawat
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
                                        <div class="col-sm-12 col-md-12">
                                            <br />
                                        </div>
                                    </div>
                                    
                                    <div class="" id="info_double">
                                        <div class="col-sm-12 col-md-12 text-left">
                                            <i>
                                                <strong>
                                                Mohon dihapus salah satu transaksi jika transaksi yang benar hanya 1 transaksi. 
                                                <br /> Hapus transaksi melalui menu "Transaksi". Pilih poli > pilih dokter > pilih billing > tgl transaksi > pilih nomor rekam medis. Klik nomor Transaksi dan klik "Hapus" untuk menghapus transaksi yang ditampilkan.
                                                 </strong>
                                            </i>
                                        </div>
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
    <div class="modal-dialog modal-dialog container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Tutup
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <iframe id="bill_frame" frameborder="0" height="700" scrolling="no" src="" width="100%">
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
