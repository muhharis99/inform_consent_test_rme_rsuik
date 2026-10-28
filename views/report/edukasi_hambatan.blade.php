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
            Monitoring Hambatan dan Edukasi
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
                                    <div class="hide">
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
                                    <div class="hide">
                                        <div class="col-sm-12">
                                            <div class="small-box bg-warning kategori" data-kategori="admisi">
                                                <div class="inner">
                                                    <h3 class="xjumlah_admisi hide"></h3>

                                                    <p class="ket_inden"><br /><b>!! Baru pengkajian Hambatan</b>, untuk edukasi masih proses</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
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
                                        <style>
                                            th.th-hambatan {
                                                border-bottom:0px solid #ffffff; 
                                            }
                                            th.th-hambatan-a {
                                                border-top:0px solid #ffffff !important;
                                            }
                                        </style>
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
                                                    <th data-width="10" data-valign="middle" data-align="center" data-field="no" data-sortable="false" 
                                                        rowspan="10">
                                                        No
                                                    </th>
                                                    <th data-width="20" data-valign="middle" data-align="center" data-field="no_reg" data-sortable="false" data-visible="false" 
                                                        rowspan="10">
                                                        No RM
                                                    </th>
                                                    <th data-align="left" data-width="40" data-valign="middle" data-field="nama" data-visible="true" data-sortable="false" 
                                                        rowspan="10">
                                                        Pasien
                                                    </th>
                                                    <th data-width="25" data-align="left" data-valign="middle" data-field="str_tgl_masuk" data-visible="false" data-sortable="false" 
                                                        rowspan="10">
                                                        Tgl Masuk
                                                    </th>
                                                    <th data-width="50" data-align="left" data-valign="middle" data-field="dokter" data-sortable="false" 
                                                        rowspan="10">
                                                        DPJP
                                                    </th>
                                                    <th data-width="22" data-align="center" data-valign="middle" data-visible="false" data-field="bangsal" data-sortable="false" 
                                                        rowspan="10" >
                                                        Bgs
                                                    </th>
                                                    <th data-align="left" data-width="" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="10">
                                                        Pengkajian Hambatan
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="5" data-align="center" data-field="hambatan" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="9">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="9">
                                                        Orientasi Pasien Baru
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="opb" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="8">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="8">
                                                        DPJP 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="dpjp" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="7">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="7">
                                                        Manajemen Nyeri 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="nyeri" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="6">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="6">
                                                        Penggunaan Peralatan Medis yang Aman 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="alat" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="5">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="5">
                                                        Pedoman Nutriasi 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="gizi" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="4">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="4">
                                                        Farmasi (Penggunaan Obat yang Aman) 
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="farmasi" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="3">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan" 
                                                        colspan="3">
                                                        Teknik Rehabilitasi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="rehab" data-sortable="false" class="th-hambatan-a" 
                                                        rowspan="2">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="" data-align="left" data-field="soap" data-sortable="false" class="th-hambatan"  title="Edukasi Pemulangan (Asuhan Lanjutan di Rumah)"
                                                        colspan="2">
                                                        Edukasi Pemulangan
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th data-width="" data-align="center" data-field="pulang" data-sortable="false" class="th-hambatan-a" title="">
                                                        &nbsp; 
                                                    </th>
                                                    <th data-width="200" data-align="center" data-field="rujukan" data-sortable="false" title="Edukasi Rujukan">
                                                        Rujukan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="select" id="tbpengguna">
                                            </tbody>
                                            <tfoot>
                                                <!-- <tr>
                                                    <th colspan="10" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
                                                </tr> -->
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
<div class="modal right fade" id="modal_tampilan_layar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">TAMPILAN LAYAR</h4>
            </div>
            <div class="modal-body" style="padding:0px;">
                <iframe class="col-md-12 col-sm-12 col-xs-12 " id="frame_tampilan_layar" src="" style="border:none;height:100em; padding:0px;">
                </iframe>          
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    function pdf_edukasi(e) {
        var link = CI.base_url;
        var str_link = link.replace('/admisi', '');
        var url = str_link + 'admisi/pdf/edukasi_integrasi_pasien_keluarga' + '/' + e ;
        $('iframe#frame_tampilan_layar').attr('src', url);
        $('#modal_tampilan_layar').modal('show');
    }
    function pdf_cppt(e) {
        $('iframe#frame_tampilan_layar').attr('src', '');
        var link = CI.base_url;
        var str_link = link.replace('/admisi', '');
        var url = str_link + 'rme/pdf/catatan_perkembangan_pasien_terintegrasi' + '/' + e ;
        $('iframe#frame_tampilan_layar').attr('src', url);
        $('#modal_tampilan_layar').modal('show');
    }
    $('#modal_tampilan_layar').on('hidden.bs.modal', function () {
        $('iframe#frame_tampilan_layar').attr('src', 'http://192.168.0.16/serverx/admisi/prints/loading');
    })
</script>