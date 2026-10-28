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
            KELENGKAPAN DATA PASIEN
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
                                        <label class="col-sm-1 control-label" for="tanggal">
                                            Tanggal :
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
                                        <label class="col-sm-1 control-label" for="poli">
                                            Poli :
                                        </label>
                                        <div class="col-sm-7">
                                            <select class="chosen-select" data-placeholder="Semua..." id="poli" multiple="" name="poli" required="">
                                                <option value="">
                                                </option>
                                                <optgroup class="poli" label="POLI">
                                                    @foreach($poli as $all)
                                                        <option class="" value="{{ $all->report_nama }}">{{ $all->report_nama }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup class="fisio" label="PENUNJANG MEDIS">
                                                    @foreach($penunjang as $all)
                                                        <option class="" value="{{ $all->report_nama }}">{{ $all->report_nama }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup class="fisio" label="IGD">
                                                    @foreach($ugd as $all)
                                                        <option class="" value="{{ $all->report_nama }}">{{ $all->report_nama }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @foreach ($hd as $all)
                                                <option value="{{ $all->report_nama }}">
                                                    {{ $all->report_nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-sm-1">
                                            <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="CEK">                                            
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
                                    <div class="">
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
                                            class="table bootstrap-table header-fixed table-bordered table-striped xtable-condensed" 
                                            data-toggle="table" 
                                            data-pagination="false"
                                            data-page-size="100"
                                            data-side-pagination="server"
                                            data-sort-name="nama_poli" 
                                            data-sort-order="asc" 
                                            data-show-footer="true"
                                            id="tpengguna">
                                            <thead>
                                                <tr>
                                                    <th data-width="10" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="20" data-valign="middle" data-align="center" data-field="no_reg" data-sortable="false" rowspan="2">
                                                        No RM
                                                    </th>
                                                    <th data-align="left" data-valign="middle" data-field="nama" data-visible="true" data-sortable="false" rowspan="2">
                                                        Nama
                                                    </th>
                                                    <th data-width="40" data-align="left" data-valign="middle" data-field="poli" data-visible="true" data-sortable="false" rowspan="2">
                                                        Poli
                                                    </th>
                                                    <th data-width="40" data-align="left" data-valign="middle" data-field="dokter" data-sortable="false" rowspan="2">
                                                        Dokter
                                                    </th>
                                                    <th data-width="22" data-align="center" data-valign="middle" data-field="jam" data-sortable="false" rowspan="2" >
                                                        Admisi
                                                    </th>
                                                    <th data-align="center" data-width="44" data-field="rawat_jalan" data-sortable="false" colspan="2" style="border-bottom-width:1px;">
                                                        RME
                                                    </th>
                                                    <th data-width="22" data-align="center" data-valign="middle" data-field="bill" data-sortable="false" rowspan="2" >
                                                        Bill
                                                    </th>
                                                    <th data-width="22" data-align="center" data-valign="middle" data-field="koder" data-sortable="false" rowspan="2" >
                                                        Koder
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="22" data-align="center" data-field="askep" data-sortable="false">
                                                        Askep
                                                    </th>
                                                    <th data-width="22" data-align="center" data-field="soap" data-sortable="false">
                                                        Soap
                                                    </th>
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
