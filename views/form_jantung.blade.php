<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <!--
        <div class="txr col-md-12"><a href="{{ URL }}rme/main/askep" class="btn btn-default">ASKEP Poli</a></div>
        -->
        <h2 class="row-centered col-md-12">
            BILLING POLI JANTUNG
        </h2>
        <div onclick="checkdr()" style="cursor:pointer; z-index:100; position: absolute;font-size: 2rem;color: red;font-weight: bold;margin-top: 50px;margin-left: 15px;text-align: center;">
            Antrian Sekarang : <span id="noantrian"></span>
        </div>
        <div class="text-right col-md-12"><b>Pengguna: </b><span id="user" nik="{{ $nik }}" poli="{{ $kd_poli }}" induk="{{ $induk }}" dokter="{{ $kd_dokter }}">{{ $akses }}</span></div>
        <div class="frm col-md-3 col-sm-12 col-xs-12" id="sf0">
            <!--  user name field will be here with next button -->
            <div>
                <form method="post" name="transfer_askep">
                    <h4 class="alert alert-success">
                        UNIT/POLIKLINIK
                    </h4>
                    <div class="form-group">
                        <label for="poli" class="control-label">
                            Poli :
                        </label>
                        <div class="">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="poli" name="poli">
                                <option value="">
                                </option>
                                @foreach ($poli as $all)
                                <option value="{{ $all->kode_poli }}">
                                    {{ $all->nama_poli }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dokter" class="control-label">
                            Dokter :
                        </label>
                        <div class="">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." disabled="" id="dokter" name="dokter">
                                <option value="">
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bill" class="control-label">
                            Billing :
                        </label>
                        <div class="">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="bill" name="bill">
                                <option value="">
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <input autocomplete="off" class="form-control" data-date-format="DD-MM-YYYY" id="stanggal" name="stanggal" type="hidden" value="{{ date('d-m-Y') }}">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <button class="btn btn-primary" id="caskep" name="caskep" type="submit" />
                            <i class="fa fa-refresh"></i> Refresh
                        </button>
                    </div>
                </form>
                <h4 class="alert alert-success">
                    LIST PASIEN
                </h4>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="showall" id="showall" value="true" checked>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Tampilkan Semua
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <input class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                </div>
                <input class="form-control" id="spasien" name="spasien" placeholder="Search..." type="text" autocomplete="off">
                </input>
                <div class="table-responsive" id="dpasien" style="overflow-x: scroll;overflow-y: scroll;height: 250px;">
                    <table class="table bootstrap-table header-fixed table-striped table-bordered table-hover" id="tapasien">
                        <thead>
                            <tr>
                                <th class="hide" data-field="id_soap_rajal" data-sortable="true">
                                    ID SOAP
                                </th>
                                <th class="hide" data-field="id_soap_ranap" data-sortable="true">
                                    ID SOAP
                                </th>
                                <th class="hide" data-field="id_askep_rajal" data-sortable="true">
                                    ID Askep
                                </th>
                                <th class="hide" data-field="id_askep_ranap" data-sortable="true">
                                    ID Askep
                                </th>
                                <th class="hide" data-field="id_bill_rajal" data-sortable="true">
                                    ID Bill
                                </th>
                                <th class="hide" data-field="id_bill_ranap" data-sortable="true">
                                    ID Bill
                                </th>
                                <th data-field="antrian" class='xantrian' data-sortable="true">
                                    Antrian
                                </th>
                                <th data-field="no_reg" data-sortable="true">
                                    No.RM
                                </th>
                                <th data-field="nama" data-sortable="true">
                                    Nama
                                </th>
                                <th data-field="tgl_lahir" data-sortable="true">
                                    Tgl Lahir
                                </th>
                                <th data-field="tgl_rs" data-sortable="true">
                                    Tgl Masuk
                                </th>
                                <th data-field="asuransi" class="hide" data-sortable="true">
                                    Asuransi
                                </th>
                                <th data-field="agama" class="hide" data-sortable="true">
                                    Agama
                                </th>
                            </tr>
                        </thead>
                        <tbody class="select" id="tbpasien">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12 col-sm-12">
            <div id="content">
                <form action="javascript:void(0)" class="form-horizontal" id="transaksi_bill" method="post" name="transaksi_bill">
                    <!-- id will be unique, but class name will be same -->
                    <h4 class="alert alert-success">
                        DATA PASIEN
                        <span class="pull-right call-antrian" style="background-color: #fd7c55;padding: 7px 10px;cursor: pointer;margin: -7px;" id="call" antrian="" nik="{{$nik}}" style="cursor:pointer;"><i class="fa fa-phone"></i> CALL</span>
                    </h4>
                    <div class="form-group" id="sf1">
                        <input id="id" name="id" type="hidden"/>
                        <div class="">
                            <label class="control-label col-md-2" for="no_reg">
                                No.RM :
                            </label>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control" disabled="" id="hispx" name="hispx" readonly="readonly" required="" type="hidden" value="">
                                        </input>
                                        <input autocomplete="off" class="form-control has-spinner" id="no_reg" maxlength="7" name="no_reg" readonly="" style="width:6em;" title="" type="text" value="">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="nama" name="nama" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="tgl_lahir">
                                Tanggal Lahir :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_lahir" name="tgl_lahir" readonly="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-4" for="tgl_rs">
                                Tanggal Masuk :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_rs" name="tgl_rs" readonly="" title="" type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="asuransi">
                                Asuransi :
                            </label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" id="asuransi_id" name="asuransi_id" readonly="" style="width:6em;" title="" type="text" value="">
                                        </input>
                                    </div>
                                    <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="asuransi" name="asuransi" readonly="" title="" type="text" value="">
                                    </input>
                                </div>
                            </div>
                        </div>
						<div class="hide">
                            <label class="control-label col-md-2" for="tgl_pemeriksaan">
                                Tanggal Pemeriksaan :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="tgl_pemeriksaan" name="tgl_pemeriksaan" title="" type="text">
										<input type="hidden" name="mynik" id="mynik" value="{{$nik}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label col-md-2" for="status">
                                Status :
                            </label>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="status" name="status" readonly="" title="" type="text">
                            </div>
                        </div>
                    </div>
                    <h4 class="alert alert-success">
                        TRANSAKSI &nbsp; &nbsp; &nbsp; <span class="title-nota" data-nota=""></span>
                    </h4>
                    <div class="table-responsive">
                        <style>
                            #form_transaksi_rawat_jalan tbody tr td, #form_transaksi_rawat_jalan thead tr th {
                                vertical-align:top;
                                padding-left:0px !important;
                                padding-right:0px !important;
                                padding-top:0px !important;
                                padding-bottom:0px !important;
                            }
                            #form_transaksi_rawat_jalan tfoot tr td {
                                vertical-align:top;
                                padding-left:0px !important;
                                padding-right:0px !important;
                                padding-bottom:0px !important;
                            }
                            #noperk___chosen.chosen-with-drop {
                                width: 350px !important;
                                position:absolute !important;
                            }
                            #kddr___chosen.chosen-with-drop {
                                width: 400px !important;
                                position:absolute !important;
                            }
                        </style>
                        <table class="table" id="form_transaksi_rawat_jalan" data-nota="">
                            <thead>
                                <tr>
                                    <th class="nomor" width="30">
                                        &nbsp; No
                                    </th>
                                    <th class="noperk text-left">
                                        Kd Rek/Nama Perkiraan
                                    </th>
                                    <th class="satuan text-center" width="50">
                                        @n
                                    </th>
                                    <th class="dokter text-center">
                                        Dr
                                    </th>
                                    <th class="jumlah text-center" width="100">
                                        Jumlah @
                                    </th>
                                    <!--
                                    <th class="persen text-center" width="50">
                                        Pot %
                                    </th>
                                    <th scope="col" class="keterangan text-center" width="100">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="rupiah text-center" width="100">
                                        Pot (Rp)
                                    </th>
                                    -->
                                    <th class="persen text-center" width="90">
                                        Js Dokter
                                    </th>
                                    <th scope="col" class="keterangan text-center" width="70">
                                        Js Perawat
                                    </th>
                                    <th scope="col" class="rupiah text-center" width="90">
                                        BHP
                                    </th>
                                    <th scope="col" class="total text-center" width="100">
                                        Jumlah
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr name="trow[]" id="trow[]" class="master" style="display:none;">
                                    <td class="inpnumber">
                                    
                                    </td>
                                    <td class="selnoperk">
                                    
                                    </td>
                                    <td class="inpsatuan">
                                        
                                    </td>
                                    <td class="selkddr" width="80">
                                    
                                    </td>
                                    <td class="inpjumlah">
                                    
                                    </td>
                                    <td class="inppersen">
                                    
                                    </td>
                                    <td class="inpketerangan">
                                    
                                    </td>
                                    <td class="inprupiah">
                                    
                                    </td>
                                    <td class="inptotal">
                                    
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="">
                                        <h3 class="title-nota" style="font-weight:bold; font-style:italic;" data-nota=""></h3>
                                            <div class="form-check check-bon">
                                                <input type="checkbox" class="form-check-input" id="bonCheck">
                                                <label class="form-check-label" style="font-weight:normal !important;" for="bonCheck"> &nbsp; Cetak kwitansi <b>BON</b> di Kasir (khusus Bon karyawan/keluarga karyawan RSI)</label>
                                            </div>
                                            <div class="form-check check-bhp">
                                                <input type="checkbox" class="form-check-input" id="bhpCheck">
                                                <label class="form-check-label" style="font-weight:normal !important;" for="bhpCheck"> &nbsp; Cetak kwitansi <b>BHP</b> di Kasir</label>
                                            </div>
                                    </td>
                                    <td colspan="2" class="text-right">
                                        <label class="control-label">
                                            Total :
                                        </label>
                                    </td>
                                    <td>
                                        <input type="number" name="total_transaksi" class="total_transaksi form-control" id="total_transaksi" style="text-align:right;" readonly="true" />
                                        <input type="hidden" name="nota_transaksi" id="nota_transaksi" value="" />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group" id="">
                        <div class="col-md-12">
                            <div class="col-md-12 row-right">
                                <div class="row">
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="tambah" type="button" name="tambah">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    @if(!$direksi)
                    <div class="form-group form-nota-spm" id="sf8">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-default">
                                <div class="row">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="sf7">
                        <div class="col-md-12">
                            <div class="col-md-12 alert-warning row-right">
                                <div class="row">
                                    <!--
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="ubah" name="ubah">
                                        Ubah
                                    </button>
                                    -->
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="hapus" name="hapus">
                                        Hapus
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger hide" id="batal" name="batal">
                                        Batal
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                        Simpan
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak" name="cetak">
                                        Cetak Ulang
                                    </button>
                                    @if($nik=='100952') 
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="cetak_bon" name="cetak_bon">
                                        Cetak BON Kasir
                                    </button>
                                    @endif
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="batal_nota_baru" name="batal_nota_baru" style="display:none;">
                                        Batal
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan_nota_baru" name="simpan_nota_baru" style="display:none;">
                                        Simpan Nota Baru
                                    </button>
                                    <span class="col-xs-12 col-md-4">
                                        &nbsp; 
                                    </span>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="nota_baru" name="nota_baru">
                                        Buat Nota SPM Baru
                                    </button>
                                    @if($nik == 100869)
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="covid" name="covid">
                                        Covid
                                    </button>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="navbar col-md-12">
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_double_check" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-md container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
				<h3>
					&nbsp; <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; &nbsp; PERKIRAAN DOUBLE TRANSAKSI
				</h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12 double_check_pesan">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times" aria-hidden="true"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_empty_check" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-lg container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
				<h3>
					&nbsp; <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; &nbsp; PERKIRAAN BELUM DIBUATKAN BILLING
				</h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12 double_check_pesan">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times" aria-hidden="true"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_spm_check" role="dialog" style="display: none; margin:0px;">
    <div class="modal-dialog modal-lg container-fluid">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
				<h3>
					&nbsp; <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; &nbsp; PERKIRAAN BEDA NOMINAL BILLING DAN KASIR
				</h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12 spm_check_pesan">
                    ...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times" aria-hidden="true"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>