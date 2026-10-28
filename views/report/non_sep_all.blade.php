
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
       white-space: normal !important; // To consider whitespace.
    }
    
    #tbsep tr td:nth-child(2) {
       white-space: normal !important; // To consider whitespace.
       cursor: default !important; 
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
           PASIEN BPJS ALL <br>
           (TJP,NON SEP) 
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
                                        <!--
                                        <label class="col-sm-1 control-label" for="Unit">
                                            Unit :
                                        </label>
                                        <div class="col-sm-3">
                                            <select class="chosen-select" data-placeholder="Semua..." id="unit" multiple="" name="unit" required="">
                                                <option value="all">
                                                </option> 
                                                @foreach($unit as $all)
                                                    <option class="" value="{{ $all->no_unit }}">{{ $all->nm_unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        -->
                                        <label class="col-sm-1 control-label" for="rawat">
                                            Rawat :
                                        </label>
                                        <div class="col-sm-2">
                                            <select class="chosen-select" data-placeholder="Semua..." id="rawat" name="rawat" required="">
                                                <option value="all">
                                                </option> 
                                                <option value="jalan">
                                                    Jalan 
                                                </option>
                                                <option value="inap">
                                                    Inap 
                                                </option>
                                            </select>
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

                                                    <p class="ket_inden">Total SEP</p>
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

                                                    <p>Tidak Jadi Periksa <i>(Tidak ada billing/rme dokter)</i></p>
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
                                                class="table bootstrap-table header-fixed table-bordered table-striped xtable-condensed" 
                                                data-toggle="table" 
                                                data-pagination="false"
                                                data-page-size="200000"
                                                data-side-pagination="server"
                                                data-sort-name="no_sep" 
                                                data-sort-order="asc" 
                                                data-show-footer="true"
                                                id="tasep">
                                                <thead>
                                                    <tr>
                                                        <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false" rowspan="2">
                                                            No
                                                        </th>
                                                        <th data-width="35" data-align="center" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false" rowspan="2">
                                                            Tanggal
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="no_sep" data-sortable="false" rowspan="2" data-width="70">
                                                            No SEP
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama" data-sortable="false" rowspan="2">
                                                            Nama
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="no_kartu" data-sortable="false" rowspan="2" data-width="49">
                                                            No Kartu
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="no_reg" data-sortable="false" rowspan="2" data-width="33">
                                                            No RM
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="rawat" data-sortable="false" rowspan="2" data-width="33">
                                                            Rawat
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="kd_poli" data-sortable="false" rowspan="2">
                                                            Poli
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="diagnosa" data-sortable="false" rowspan="2">
                                                            Diagnosa
                                                        </th>
                                                        <th data-align="center" data-field="status" data-sortable="false" colspan="2" data-width="45" style="border-bottom-width:1px;">
                                                            Status
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th data-align="center" data-field="bill" data-sortable="false" data-width="25">
                                                            Billing
                                                        </th>
                                                        <th data-align="center" data-field="rme" data-sortable="false" data-width="20">
                                                            RME
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