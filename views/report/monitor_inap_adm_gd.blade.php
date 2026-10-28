
<style>
    .modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 1000px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

    /*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
    /*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

    #tbsep tr td {
       white-space: normal !important; 
       line-height: 12px !important;
       vertical-align: top !important;
    }
    
    #tbsep tr td:nth-child(2) {
       white-space: normal !important; // To consider whitespace.
       cursor: default !important; 
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
           PASIEN RENCANA INAP GD <br>
           (BPJS,ASKOM,UMUM,DLL) 
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome:
            </b>
            {{ $nama }}
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
                                                <div class="input-group-addon">
                                                    -
                                                </div>
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="filter" name="filter" placeholder="Nama pasien ..." type="text" />
                                        </div>
                                        <label class="col-sm-1 control-label hide" for="kategori">
                                            Kategori :
                                        </label>
                                        <div class="col-sm-2 hide">
                                            <select class="chosen-select" data-placeholder="Semua..." id="kategori" name="kategori" required="">
                                                <option value="all">
                                                </option> 
                                                <option value="karyawan">
                                                    Karyawan
                                                </option>
                                                <option value="keluarga">
                                                    Keluarga 
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 hide">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <!--
                                                    <b>&darr;&uarr;</b>
-->
                                                    Tampilkan
                                                </div>
                                                <select class="chosen-select" data-placeholder="Urutkan..." id="urut" name="urut" required="">
                                                    <option value="sensus">
                                                        Ringkasan
                                                    </option>
                                                    <option value="sensus_daftar">
                                                        Ringkasan dan Daftar Pasien
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="Cari">
                                            </input>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="small-box bg-warning kategori" data-kategori="">
                                                <div class="inner">
                                                    <h3 class="total_sep">0</h3>

                                                    <p class="ket_inden">Total Rencana INAP</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="small-box bg-danger kategori" data-kategori="tjp">
                                                <div class="inner">
                                                    <h3 class="total_tjp">0</h3>

                                                    <p>BELUM INAP</i></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-sm-1">
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
                                        -->
                                    </div>
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-sm-12 col-md-12">
                                            <table 
                                                class="table bootstrap-table header-fixed table-bordered xtable-striped xtable-condensed" 
                                                data-toggle="table" 
                                                data-pagination="false"
                                                data-page-size="250000"
                                                data-side-pagination="server"
                                                data-show-footer="true"
                                                data-sort-name="tanggal" 
                                                data-sort-order="asc" 
                                                data-show-footer="true"
                                                id="tasep">
                                                <thead>
                                                    <tr>
                                                        <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                            No
                                                        </th>
                                                        <th data-width="40" data-align="center" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false" rowspan="2" >
                                                            Tanggal
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama2" data-sortable="false" rowspan="2" data-width="70">
                                                            Dokter
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama" data-sortable="false" rowspan="2">
                                                            Nama
                                                        </th>
                                                        <th data-align="center" data-valign="middle" data-field="no_reg" data-sortable="false" rowspan="2" data-width="33">
                                                            No RM
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama_rel" data-sortable="false" rowspan="2" data-width="50">
                                                            Relasi / Kelas
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-visible="false" data-field="diagnosa" data-sortable="false" rowspan="2">
                                                            Diagnosa
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="telp" data-sortable="false" rowspan="2" data-width="50">
                                                            No Telp
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="bangsal" data-sortable="false" rowspan="2" data-width="40">
                                                            Bangsal
                                                        </th>
                                                        <th data-align="center" data-field="status" data-sortable="false" colspan="2" data-width="45" style="border-bottom-width:1px;">
                                                            INAP
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="catatan" data-sortable="false" rowspan="2" data-width="50">
                                                            Catatan
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="aksi" data-sortable="false" rowspan="2" data-width="50">
                                                            Aksi
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th data-align="center" data-field="bill" data-sortable="false" data-width="30">
                                                            SDH
                                                        </th>
                                                        <th data-align="center" data-field="rme" data-sortable="false" data-width="30">
                                                            BLM
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="select" id="tbsep">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="11" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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
                <iframe class="col-md-12 col-sm-12 col-xs-12 " id="frame_tampilan_layar" src="" style="border:none;height:46em; padding:0px;">
                </iframe>          
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_add_catatan" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <h3 class="modal-title">
                    Tambah Catatan
                </h3>
                <label class="idlabel no_reg" for="control-label">
                    <h3>
                    </h3>
                </label>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <!-- <form id="form_rajal_icd" novalidate=""> --> 
                        <input type="hidden" name="adm_no_reg" id="adm_no_reg">
                        <input type="hidden" name="adm_tanggal" id="adm_tanggal">
                        <input type="hidden" name="adm_soap_id" id="adm_soap_id">
                        <input type="hidden" name="adm_kd_dr" id="adm_kd_dr">
                        <input type="hidden" name="adm_done" id="adm_done">
                        <div>
                            <label for="adm_catatan">Catatan</label>
                            <textarea class="form-control" id="adm_catatan" rows="10"></textarea>
                        </div>
                        <div>
                            <br/>
                        </div>
                        <div>
                            <label for="adm_kelas">Kelas Rawat</label>
                            <select class="chosen-select" data-placeholder="Semua..." id="adm_kelas" name="adm_kelas" required="">
                                                <option value="">
                                                </option> 
                                                <!-- <option value="vip">
                                                    VIP
                                                </option> -->
                                                <option value="1">
                                                    1 
                                                </option>
                                                <option value="2">
                                                    2
                                                </option>
                                                <option value="3">
                                                   3
                                                </option>
                                                <!-- <option value="cu">
                                                   Intensif
                                                </option> -->
                                            </select>
                        </div>
                        <div>
                            <br/>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" id="batal_adm" title="">
                                    Batal
                                </button>
                                <button class="btn btn-default" id="simpan_adm" title="" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>