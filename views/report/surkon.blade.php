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
            MONITORING SURAT KONTROL ONLINE BPJS
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
                            SKDP/SPRI
                        </h4>
                        <div class="frm" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 control-label" for="kategori">
                                            Berdasarkan :
                                        </label>
                                        <div class="col-sm-2">
                                            <select class="chosen-select" data-placeholder="Semua..." id="kategori" name="kategori">
                                                <option value="entri">
                                                    Tanggal Entri
                                                </option>
                                                <option value="kontrol">
                                                    Tanggal Kontrol
                                                </option>
                                            </select>
                                        </div>
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
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                            <select class="chosen-select" data-placeholder="Pilih bangsal" id="billz" name="billz" required="">
                                            <option value="HDL">
                                                  HD
                                                </option>
                                                <option value="ALL">
                                                  ALL
                                                </option>
                                            </select>      
                                        </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="hidden" name="hidden_kategori" id="hidden_kategori" val="" />
                                            <button autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" >
                                                Tampilkan
                                            </button>
                                        </div>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div>
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
                                        <div class="col-sm-2">
                                            <div class="small-box bg-success kategori" data-kategori="admisi">
                                                <div class="inner">
                                                    <h3 class="total_surat">0</h3>

                                                    <p class="ket_inden"><b>TOTAL</b><br> &nbsp; </p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="admisi">
                                                <div class="inner">
                                                    <h3 class="total_skdp">0</h3>

                                                    <p class="ket_inden"><b>SKDP</b><br>Rawat Jalan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="menunggu_poli">
                                                <div class="inner">
                                                    <h3 class="total_spri">0</h3>

                                                    <p class="ket_inden"><b>SPRI</b> <br /><i>Rawat Inap</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="menunggu_dokter">
                                                <div class="inner">
                                                    <h3 class="total_terbit">0</h3>

                                                    <p class="ket_inden">SEP<br /><i>Sudah terbit SEP</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="small-box bg-success kategori" data-kategori="menunggu_obat">
                                                <div class="inner">
                                                    <h3 class="total_unclaim">0</h3>

                                                    <p class="ket_inden">Hari Sama<br /><i>SKDP Tanggal terbit sama dengan Tanggal rencana kontrol</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 
                                        <div class="col-sm-2">
                                            <div class="small-box bg-success kategori" data-kategori="batal_periksa">
                                                <div class="inner">
                                                    <h3 class="batal_periksa">0</h3>

                                                    <p class="ket_inden">Batal Periksa<br /><i>Klik disini untuk memfilter</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div> -->
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
                                                    <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="60" data-valign="left" data-align="center" data-field="noSuratKontrol" data-sortable="false" rowspan="2">
                                                        No Surat
                                                    </th>
                                                    <th data-width="35" data-align="left" data-valign="middle" data-field="namaJnsKontrol" data-visible="true" data-sortable="false" rowspan="2">
                                                        Jenis
                                                    </th>
                                                    <th data-width="30" data-align="left" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false" rowspan="2">
                                                        Tanggal
                                                    </th>
                                                    <th data-width="55" data-align="left" data-valign="middle" data-field="noKartu" data-visible="true" data-sortable="false" rowspan="2">
                                                        No Kartu
                                                    </th>
                                                    <th data-width="120" data-align="left" data-valign="middle" data-field="rm" data-visible="true" data-sortable="false" rowspan="2">
                                                        RM
                                                    </th>
                                                    <th data-width="70" data-align="left" data-valign="middle" data-field="str_namapoli" data-visible="true" data-sortable="false" rowspan="2">
                                                        Poli/Dokter
                                                    </th>
                                                    <th data-align="left" data-valign="middle" data-field="status" data-sortable="false" rowspan="2">
                                                        Status
                                                    </th>
                                                    <th data-width="22" data-align="center" data-valign="middle" data-visible="false" data-field="checkin" data-sortable="false" rowspan="2" >
                                                        Admisi
                                                    </th>
                                                    <th data-align="center" data-width="44" data-field="poliklinik" data-visible="false" data-sortable="false" colspan="2" style="border-bottom-width:1px;">
                                                        Poliklinik
                                                    </th>
                                                    <th data-align="center" data-width="44" data-field="farmai" data-visible="false" data-sortable="false" colspan="2" style="border-bottom-width:1px;">
                                                        Farmasi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="22" data-align="center" data-field="mulai_poli" data-visible="false" data-sortable="false">
                                                        Mulai
                                                    </th>
                                                    <th data-width="22" data-align="center" data-field="selesai_poli" data-visible="false" data-sortable="false">
                                                        Selesai
                                                    </th>
                                                    <th data-width="22" data-align="center" data-field="mulai_resep" data-visible="false" data-sortable="false">
                                                        Mulai
                                                    </th>
                                                    <th data-width="22" data-align="center" data-field="selesai_resep" data-visible="false" data-sortable="false">
                                                        Selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="7" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
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

<div aria-hidden="true" aria-labelledby="" class="modal fade" id="modal_waktu" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <h3 class="modal-title">
                    Form Waktu Pelayanan
                </h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <form id="form_waktu">
                        <div class="row">
                            <label class="col-sm-3 control-label" for="kodebooking">
                                Kode Booking :
                            </label>
                            <div class="col-sm-9">
                                <input name="kodebooking" type="text" autocomplete="off" class="form-control" id="kodebooking" data-id="Kode Booking">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="no_reg">
                                No RM :
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="rowid" value="" id ="rowid" />
                                <input name="no_reg" type="text" autocomplete="off" class="form-control" id="no_reg" data-id="No RM">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="nama">
                                Nama :
                            </label>
                            <div class="col-sm-9">
                                <input name="nama" type="text" autocomplete="off" class="form-control" id="nama" data-id="Nama Pasien">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="dokter">
                                Dokter :
                            </label>
                            <div class="col-sm-9"> 
                                <input name="dokter" type="text" autocomplete="off" class="form-control" id="dokter" data-id="Dokter">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="poli">
                                Poli :
                            </label>
                            <div class="col-sm-9"> 
                                <input name="poli" type="text" autocomplete="off" class="form-control" id="poli" data-id="Poli">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="checkin">
                                Checkin :
                            </label>
                            <div class="col-sm-3">
                                <input name="checkin" type="text" autocomplete="off" class="form-control" id="checkin" data-id="Checkin">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="mulai_poli">
                                Mulai Poli :
                            </label>
                            <div class="col-sm-3">
                                <input name="mulai_poli" type="text" autocomplete="off" class="form-control" id="mulai_poli" data-id="Mulai Poliklinik">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="selesai_poli">
                                Selesai Poli :
                            </label>
                            <div class="col-sm-3">
                                <input name="selesai_poli" type="text" autocomplete="off" class="form-control" id="selesai_poli" data-id="Selesai Poliklinik">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="mulai_resep">
                                Mulai Pelayanan Farmasi :
                            </label>
                            <div class="col-sm-3">
                                <input name="mulai_resep" type="text" autocomplete="off" class="form-control" id="mulai_resep" data-id="Mulai Pelayanan Farmasi">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="selesai_resep">
                                Selesai Pelayanan Farmasi :
                            </label>
                            <div class="col-sm-3">
                                <input name="selesai_resep" type="text" autocomplete="off" class="form-control" id="selesai_resep" data-id="Selesai Pelayanan Farmasi">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-5 control-label" for="batal_periksa">
                                Periksa :
                            </label>
                            <div class="col-sm-7">
                                <select name="batal_periksa" class="chosen-select">
                                    <option value="0">Ya</option>
                                    <option value="1">Tidak, pasien TJP (tidak jadi periksa)</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-2 col-sm-10">
                                <br>
                                    <button class="btn btn-default" href="" id="batal_waktu" title="">
                                        Kembali
                                    </button>
                                    <button class="btn btn-default" href="" id="simpan_waktu" title="">
                                        Simpan
                                    </button>
                                </br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
