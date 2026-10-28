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
           Monitoring Pengkajian Awal Medis<br>
            (<=24 Jam)
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
                                            Tanggal Masuk :
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

                                    <div>
                                        <label class="col-sm-1 control-label hide" for="poli">
                                            Bangsal :
                                        </label>
                                        <!-- <div class="col-sm-5 hide">
                                            <select class="chosen-select" data-placeholder="Pilih bangsal" id="poli" name="poli" required="">
                                            <option value="SM">
                                                  SEMUA
                                                </option>
                                            <option value="ZM2">
                                                  ZAM-ZAM LT 2
                                                </option>
                                                <option value="PRS">
                                                    ROUDOLOH  
                                                </option>
                                                <option value="PRB">
                                                    ROUDOLOH BAYI 
                                                </option>
                                                <option value="ARO">
                                                  AROFAH
                                                </option>
                                                <option value="HJ">
                                                  SITI HAJAR
                                                </option>
                                                <option value="NMR">
                                                  NAMIROH
                                                </option>
                                                <option value="MNA">
                                                  MINA
                                                </option>
                                                
                                            </select>
                                                                               
                                        </div> -->
                              
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
                                                    <th data-width="50" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="80" data-valign="middle" data-align="center" data-field="no_reg" data-sortable="false" rowspan="2">
                                                        No RM
                                                    </th>
                                                    <th data-width="250" data-valign="middle" data-field="nama" data-visible="true" data-sortable="false" rowspan="2">
                                                        Nama
                                                    </th>
                                                    <th data-width="250" data-valign="center" data-field="nmdr" data-visible="true" data-sortable="false" rowspan="2">
                                                        Dokter Penanggung Jawab Pasien
                                                    </th>
                                                    <th data-width="80" data-align="center" data-valign="middle" data-field="bangsal" data-visible="true" data-sortable="false" rowspan="2">
                                                        Bangsal
                                                    </th>
                                                    <!-- <th data-width="35" data-align="center" data-valign="middle" data-field="umur" data-visible="true" data-sortable="false" rowspan="2">
                                                        Umur
                                                    </th> -->
                                                    <th data-width="150" data-align="center" data-valign="middle" data-field="tiba" data-visible="true" data-sortable="false" rowspan="2">
                                                        Tiba
                                                    </th>
                                                    <th data-width="150" data-align="center" data-valign="middle" data-field="awal_medis" data-sortable="false" rowspan="2" >
                                                        Awl Med
                                                    </th>
                                                    <th data-width="100" data-align="center" data-valign="middle" data-field="selisih" data-sortable="false" rowspan="2" >
                                                        Selisih
                                                    </th>
                                                    <th data-width="100" data-align="center" data-valign="middle" data-field="ket" data-sortable="false" rowspan="2" >
                                                        Ket
                                                    </th>
                                                    <!-- <th data-align="center" data-width="440" data-field="rawat_jalan" data-sortable="false" colspan="2" style="border-bottom-width:1px;">
                                                        RME
                                                    </th> -->

                                                </tr>
                                                <tr>
                                              
                                                 </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="10" data-footer-field="grand_total">Jumlah Data : <b class="grand_total" style="text-align:center;">.</b><br>
                                                    *Tiba berdasarkan Tanggal & Jam terima Transfer Pasien</th>
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
