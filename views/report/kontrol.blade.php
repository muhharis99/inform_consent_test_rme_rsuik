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
            MONITORING TINDAK LANJUT KONTROL BPJS
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
                                                    Tanggal Dibuat
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
                                        <div class="col-sm-1">
                                            <input type="hidden" name="hidden_kategori" id="hidden_kategori" value="" />
                                            <button autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" >
                                                Tampilkan
                                            </button>
                                        </div>
                                        <div class="col-sm-1 hide">
                                            <button autocomplete="off" class="form-control btn btn-success" id="generate" name="generate" type="button" >
                                                reGenerate
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
                                            <div class="small-box bg-success kategori" data-kategori="total">
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
                                            <div class="small-box bg-danger kategori" data-kategori="gagal">
                                                <div class="inner">
                                                    <h3 class="total_gagal">0</h3>

                                                    <p class="ket_inden"><b>Gagal</b><br> &nbsp; </p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-danger kategori" data-kategori="belum">
                                                <div class="inner">
                                                    <h3 class="total_belum">0</h3>

                                                    <p class="ket_inden"><b>Kosong</b> <br /><i>belum update</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 hide">
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
                                        <div class="col-sm-4 hide">
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
                                                    <th data-width="10" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                        No
                                                    </th>
                                                    <th data-width="15" data-valign="left" data-align="center" data-field="rm" data-sortable="false" rowspan="2">
                                                        No RM
                                                    </th>
                                                    <th data-width="25" data-valign="left" data-align="center" data-field="noka" data-sortable="false" rowspan="2">
                                                        No Kartu
                                                    </th>
                                                    <th data-width="40" data-valign="left" data-align="left" data-field="nama" data-sortable="false" rowspan="2">
                                                        Nama
                                                    </th>
                                                    <th data-width="20" data-align="center" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false" rowspan="2">
                                                        Tanggal
                                                    </th>
                                                    <th data-width="15" data-align="left" data-valign="middle" data-field="kdpoli" data-visible="true" data-sortable="false" rowspan="2">
                                                        Poli
                                                    </th>
                                                    <th data-width="50" data-align="left" data-valign="middle" data-field="namadokter" data-visible="true" data-sortable="false" rowspan="2">
                                                        Dokter
                                                    </th>
                                                    <th data-width="" data-align="left" data-valign="middle" data-field="ket" data-visible="true" data-sortable="false" rowspan="2">
                                                        Keterangan
                                                    </th>
                                                    <th data-width="" data-align="left" data-valign="middle" data-field="sep" data-visible="false" data-sortable="false" rowspan="2">
                                                        SEP
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
                                                    <th colspan="8" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
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
                    Form SKDP
                </h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <form id="form_waktu">
                        <div class="row">
                            <label class="col-sm-3 control-label" for="rm">
                                No RM :
                            </label>
                            <div class="col-sm-9">
                                <input name="rm" type="text" autocomplete="off" class="form-control" id="rm" data-id="NoRM" readonly="readonly">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="sep">
                                No SEP :
                            </label>
                            <div class="col-sm-9">
                                <input name="strSEP" type="text" autocomplete="off" class="form-control" id="strSEP" data-id="SEP Complete" readonly="readonly">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="noka">
                                No Kartu :
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="rowid" id ="rowid" />
                                <input type="hidden" name="rm" id ="rm" />
                                <input type="hidden" name="sep" id ="sep" />
                                <input type="hidden" name="skdp" id ="skdp" />
                                <input type="hidden" name="tgl_masuk" id ="tgl_masuk" />
                                <input type="hidden" name="kd_poli" id ="kd_poli" />
                                <input type="hidden" name="no_reg" id ="no_reg" />
                                <input name="noka" type="text" autocomplete="off" class="form-control" id="noka" data-id="Kartu" readonly="readonly">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="nama">
                                Nama :
                            </label>
                            <div class="col-sm-9">
                                <input name="nama" type="text" autocomplete="off" class="form-control" id="nama" data-id="Pasien" readonly="readonly">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="dokter">
                                Dokter :
                            </label>
                            <div class="col-sm-9"> 
                                <select class="chosen-select" data-placeholder="Pilih dokter" id="dokter" name="dokter">
                                    <option value="">
                                        
                                    </option>
                                    @foreach($dokter as $row) 
                                    <option value="{{$row['kodedokter']}}">
                                        {{$row['namadokter']}}
                                    </option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="poli">
                                Poli :
                            </label>
                            <div class="col-sm-9"> 
                                <select class="chosen-select" data-placeholder="Pilih poli" id="poli" name="poli">
                                    <option value="">
                                        
                                    </option>
                                    @foreach($poli as $row) 
                                    <option value="{{$row['kdsubspesialis']}}">
                                        {{$row['nmsubspesialis']}}
                                    </option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 control-label" for="kontrol">
                                Tgl Kontrol :
                            </label>
                            <div class="col-sm-3">
                                <input name="kontrol" type="text" autocomplete="off" class="form-control" id="kontrol" data-id="Kontrol">
                                </input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-3 col-sm-9">
                                <br>
                                    <button class="btn btn-default" href="" id="batal_waktu" title="">
                                        Kembali
                                    </button>
                                    <button class="btn btn-default" href="" id="simpan_waktu" title="">
                                        Simpan
                                    </button>
                                    <button class="btn btn-danger pull-right" href="" id="update_mod" title="">
                                        Simpan Ulang SKDP
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
