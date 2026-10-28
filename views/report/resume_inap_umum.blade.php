
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
        ICD Resume Pasien Ranap
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
                                        <label class="col-sm-2 control-label" for="tanggal">
                                            Tanggal Keluar :
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
                                        <label class="col-sm-1 control-label" for="poli">
                                            Poli :
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
                                                        <th data-width="35" data-align="center" data-valign="middle" data-field="tanggal" data-visible="true" data-sortable="false">
                                                            Tanggal
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
                                                        <th data-align="left" data-valign="middle" data-field="diagnosa" data-sortable="false">
                                                            Diagnosa
                                                        </th>
                                                        <th data-align="center" data-field="aksi" data-sortable="false" data-width="45" style="border-bottom-width:1px;">
                                                            Koding
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
            <div class="modal-header">
                <h2 class="modal-title">
                   KODING
                </h2>
                <label class="idlabel no_reg" for="control-label">
                    <h3>
                    </h3>
                </label>
            </div>
                <div class="modal-body form-group">
                <div class="col-md-12">
                    <!-- <form id="form_rajal_icd" novalidate=""> -->
                        <input type="hidden" name="icd_no_reg" id="icd_no_reg">
                        <input type="hidden" name="icd_tgl_masuk" id="icd_tgl_masuk">
                        <input type="hidden" name="icd_jam_masuk" id="icd_jam_masuk">
                        <input type="hidden" name="icd_soap_id" id="icd_soap_id">
                        <input type="hidden" name="icd_no_sep" id="icd_no_sep">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 1</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd1" id="icd1">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 2</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd2" id="icd2">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 3</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd3" id="icd3">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 4</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd4" id="icd4">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 5</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd5" id="icd5">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 6</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd6" id="icd6">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 7</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd7" id="icd7">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 8</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd8" id="icd8">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 9</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd9" id="icd9">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">ICD 10</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="icd10" id="icd10">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">Kode SMS</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select icd" data-placeholder="Silahkan Pilih..." name="kd_sms" id="kd_sms">
                                    <option value=""></option>
                                    @foreach ($diagnosa as $diag)
                                    <option value="{{ $diag->icd }}">
                                    {{ $diag->icd }} - {{ str_replace('.','',$diag->icd) }} - {{ $diag->nmdg }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div>
                            <br/>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 1</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan1" id="tindakan1">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 2</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan2" id="tindakan2">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 3</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan3" id="tindakan3">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 4</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan4" id="tindakan4">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 5</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan5" id="tindakan5">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 6</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan6" id="tindakan6">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 7</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan7" id="tindakan7">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">PX 8</label>
                            </div>
                            <div class="col-md-8">
                                <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="tindakan8" id="tindakan8">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="control-label">Catatan</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class ="control-label" rows="4" cols="50" type ="text" placeholder ="Isi Catatan untuk Verifikator" id="notes" name="notes"></textarea>
                                <!-- <select class="chosen-select tindakan" data-placeholder="Silahkan Pilih..." name="notes" id="notes">
                                    <option value=""></option>
                                    @foreach ($tindakan as $tind)
                                    <option value="{{ $tind->kode }}">
                                    {{ $tind->kode }} - {{ $tind->nama }} {{ str_replace('.','',$tind->kode) }}
                                    </option>
                                    @endforeach
                                </select> -->
                            </div>
                        </div>
                        <div>
                            <br/>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <button class="btn btn-default" id="batal_rajal_icd" title="">
                                    Batal
                                </button> -->
                                <button class="btn btn-default btn-lg" id="simpan_rajal_icd" title="" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        <div>
                            <br/>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div><!-- modal-content -->
        
    </div><!-- modal-dialog -->
</div><!-- modal -->

