
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
        Coding Sementara Pasien Inap
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
                                    <!-- <div class="">
                                        <label class="col-sm-2 control-label" for="tanggal">
                                            Tanggal Masuk :
                                        </label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="atanggal" name="atanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                                <div class="input-group-addon">
                                                    -
                                                </div>
                                                <input class="form-control" data-date-format="DD-MM-YYYY" id="btanggal" name="btanggal" placeholder="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off"/>
                                            </div>
                                        </div> -->
                                        <label class="col-sm-1 control-label" for="poli">
                                            Bangsal :
                                        </label>
                                        <div class="col-sm-2">
                                            <select class="chosen-select" data-placeholder="Semua..." id="rawat" name="rawat" required="">
                                                <option value=""></option> 
                                                <option value="all">All</option>
                                                @foreach($poli as $all)
                                                    <option class="" value="{{ $all->induk }}">{{ $all->induk_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <input autocomplete="off" class="form-control btn btn-success" id="cari" name="cari" required="" type="button" value="Cari">
                                            </input>
                                        </div>
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
                                                        <th data-width="20" data-valign="middle" data-align="center" data-field="no" data-sortable="false">
                                                            No
                                                        </th>
                                                        <th data-width="45" data-align="left" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false">
                                                            Tgl Masuk
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="no_reg" data-sortable="false" data-width="33">
                                                            No RM
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama" data-sortable="false">
                                                            Nama
                                                        </th>
                                                        <th data-width="30" data-valign="middle" data-field="umur" data-sortable="false">
                                                            Umur
                                                        </th>
                                                        <th data-width="30" data-valign="middle" data-field="asuransi_id" data-sortable="false">
                                                            Relasi
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="nama_dr" data-sortable="false" data-width="70">
                                                            Dokter
                                                        </th>
                                                        <th data-width="50" data-align="left" data-valign="middle" data-field="nama_poli" data-sortable="false">
                                                            Bangsal
                                                        </th>
                                                        <th data-align="left" data-valign="middle" data-field="icd1" data-width="35" data-sortable="false">
                                                            Diagnosa
                                                        </th>
                                                        <th data-align="center" data-field="gruper" data-sortable="false" data-width="45" style="border-bottom-width:1px;">
                                                            Gruoping
                                                        </th>
                                                        <th data-align="center" data-field="aspek_koding" data-sortable="false" data-width="50" style="border-bottom-width:1px;">
                                                            Aspek Koding
                                                        </th>
                                                        <th data-align="center" data-field="perhatian" data-sortable="false" data-width="45" style="border-bottom-width:1px;">
                                                            Perhatian
                                                        </th>
                                                        <th data-align="center" data-field="jumlah" data-sortable="false" data-width="45" style="border-bottom-width:1px;">
                                                            Tarif RS
                                                        </th>
                                                        <th data-align="center" data-field="tr_grouper" data-sortable="false" data-width="45" style="border-bottom-width:1px;">
                                                            Tarif Inacbg
                                                        </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="select" id="tbsep">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="8" data-footer-field="grand_total"><b class="grand_total" style="text-align:center;">.</b></th>
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
<p><b>*Pilih tanggal masuk pasien,pastikan pasien sudah ada pengkajian awal medis, cukup isikan kolom grouping saja sesuai hasil gruping pada aplikasi e-Klaim</b></p>
<div aria-hidden="true" aria-labelledby="" class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_grouping" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content form-horizontal">
            <form id="form_grouping" novalidate="">
                <div class="modal-header">
                    <h3 class="modal-title">
                        GROUPING 
                        <br><label id="label_no_reg_grouping"><label>
                    </h3>
                </div>
                <div class="modal-body form-group">
                    <div class="col-md-12">
                        <input type="hidden" id='grouping_no_reg'>
                        <input type="hidden" id='grouping_nama'>
                        <input type="hidden" id='tgl_rs'>
                        <input type="hidden" id='grouping_tarif_klI'>
                        <input type="hidden" id='grouping_tarif_klII'>
                        <input type="hidden" id='grouping_tarif_klIII'>
                        <input type="hidden" id='grouping_grouper'>
                        <input type="hidden" id='grouping_kelas'>
                        <input type="hidden" id='grouping_tarif_rs'>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping_tgl">
                            Tanggal:
                        </label>
                        <input autocomplete="off" class="form-control" id="grouping_tgl" name="grouping_tgl" placeholder="Tanggal" required="" type="text" value="">
                        </input>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping_tarif_rs_rupiah">
                            Diagnosa:
                        </label>
                        <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd1" id="icd1">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping">
                            Grouping:
                        </label>
                        <!-- <h6 id="grouping_jenis"></h6> -->
                        <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="grouping_jenis" name="grouping_jenis" required>
                            <option value="">
                            </option>
                            @foreach ($inacbg as $ina)
                            <option value="{{ $ina->NO }}">
                                {{ $ina->GRUPER }} {{ $ina->DESKRIPSI }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping_tarif_kl1">
                            Tarif Kelas 1:
                        </label>
                        <input autocomplete="off" class="form-control" id="grouping_tarif_kl1" name="grouping_tarif_kl1" placeholder="Tarif Kelas 1" type="text" value="" readonly>
                        </input>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping_tarif_kl2">
                            Tarif Kelas 2:
                        </label>
                        <input autocomplete="off" class="form-control" id="grouping_tarif_kl2" name="grouping_tarif_kl2" placeholder="Tarif Kelas 2" type="text" value="" readonly>
                        </input>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label" for="grouping_tarif_kl3">
                            Tarif Kelas 3:
                        </label>
                        <input autocomplete="off" class="form-control" id="grouping_tarif_kl3" name="grouping_tarif_kl3" placeholder="Tarif Kelas 3" type="text" value="" readonly>
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" data-toggle="modal">
                        <i class="fa fa-times"></i> Keluar
                    </button>
                    <button type="button" class="btn btn-sm btn-success" id="simpan_grouping" title="">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

