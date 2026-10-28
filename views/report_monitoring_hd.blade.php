<style>
.small-box {
  border-radius: .25rem;
  box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
  display: block;
  margin-bottom: 20px;
  position: relative;
}
.kategori {
    cursor:pointer;
}
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12 title-h2">
            MONITORING WAKTU HD <br>
        </h2>
        <div class="text-right col-md-12 title-welcome">
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
                                            Tanggal Keluar :
                                        </label>
                                            <div class="col-sm-2">
                                            <div class="input-group">
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="atanggal" name="atanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                               
                                                <div class="input-group-addon hide">
                                                    s/d
                                                </div>
                                                <input class="form-control hide" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                            </div>

                                        </div>
                                       
                                    </div>

                                    <!-- <div>
                                        <label class="col-sm-1 control-label" for="poli">
                                            Bangsal :
                                        </label>
                                        <div class="col-sm-5">
                                            <select class="chosen-select" data-placeholder="Pilih bangsal" id="poli" name="poli" required="">
                                            <option value="SM">
                                                  SEMUA
                                                </option>
                                                                                    
                                            </select>
                                                                               
                                        </div>
                               -->
                                        <div class="col-sm-2">
                                       <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="CEK">                                            
                                 
                                    </div>
                                    </div>
                                    <div>
                                        <div class="col-sm-1">
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
                                    <div class="hide">
                                        <div class="col-sm-3">
                                            <div class="small-box bg-warning kategori" data-kategori="admisi">
                                                <div class="inner">
                                                    <h3 class="jumlah_admisi">0</h3>

                                                    <p class="ket_inden">Kunjungan Pasien (Admisi)</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="tjp">
                                                <div class="inner">
                                                    <h3 class="jumlah_tjp">0</h3>

                                                    <p class="ket_inden">Tidak ada berkas (TJP)</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="koder">
                                                <div class="inner">
                                                    <h3 class="jumlah_waiting_koder">0</h3>

                                                    <p class="ket_inden">Menunggu Koder</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-success " data-kategori="rme">
                                                <div class="inner">
                                                    <h3 class="jumlah_waiting_rme">0</h3>

                                                    <p class="ket_inden">Data Belum Update</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="small-box bg-success kategori" data-kategori="lengkap">
                                                <div class="inner">
                                                    <h3 class="jumlah_lengkap">0</h3>

                                                    <p class="ket_inden">Data Lengkap</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table 
                                            class="table bootstrap-table table-bordered table-striped xtable-condensed" 
                                            data-toggle="table" 
                                            data-pagination="false"
                                            data-page-size="150"
                                            data-side-pagination="server"
                                            data-sort-name="nama_poli" 
                                            data-sort-order="asc" 
                                            data-show-footer="true"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                <th data-width="40" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="100" data-valign="middle" data-align="center" data-field="no_reg" data-sortable="false" rowspan="2">
                                                        No RM
                                                    </th>
                                                    <th data-width="250" data-valign="middle" data-field="nama" data-visible="true" data-sortable="false" rowspan="2">
                                                        Nama
                                                    </th>
                                                   <th data-width="100" data-align="left" data-valign="middle" data-field="tgl_masuk" data-visible="true" data-sortable="false" rowspan="2">
                                                        Tanggal
                                                    </th>
                                                    <th data-width="250" data-align="left" data-valign="middle" data-field="nama2" data-visible="true" data-sortable="false" rowspan="2">
                                                        Nama Dokter
                                                    </th>
                                                    <th data-width="120" data-align="left" data-valign="middle" data-field="jam_awal" data-visible="true" data-sortable="false" rowspan="2">
                                                        Jam Awal (0)
                                                    </th>
                                                    <th data-width="120" data-align="Center" data-valign="middle" data-field="jam_akhir" data-sortable="false" rowspan="2">
                                                        Jam Akhir (5)
                                                    </th>
                                                    <th data-width="120" data-align="center" data-valign="middle" data-field="lama" data-sortable="false" rowspan="2" >
                                                        Lama Waktu
                                                    </th>
                                                    <!-- <!-- <th data-width="120" data-align="center" data-valign="middle" data-field="med_aw" data-sortable="false" rowspan="2" >
                                                        Pengkaijan Med
                                                    </th> -->
                                                    <!-- <th data-width="120" data-align="center" data-valign="middle" data-field="res_aw" data-sortable="false" rowspan="2" >
                                                      Keterangan
                                                    </th>  -->

                                                </tr>
                                                <tr>
                                              
                                                 </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="10" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
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
