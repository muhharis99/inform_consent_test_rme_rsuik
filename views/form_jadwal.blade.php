<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12" id="report_kartu">
        <h2 class="row-centered">
            JADWAL PRAKTEK {{ $klinik }}
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome:
            </b>
            {{ $akses }}
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <h4 class="alert alert-success" style="padding-top:10px !important;">
                DAFTAR JADWAL
            </h4>
            <style>
                .table-no {
                    width:20px !important; 
                }
                .tableFixHead          { overflow: auto; height: 100px; }
                .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
                .tableFixHead  { border-collapse: collapse; width: 100%; }
                .tableFixHead th, .tableFixHead td { padding: 8px 16px; }
                .tableFixHead th     { background:#eee; }
                .tableFixHead,
                .tableFixHead th {
                    box-shadow: inset 0px 0 #bebebe;
                }
            </style>
            <input name="txtno_reg" type="hidden" value="0000001">
                
                <table class="table tableFixHead" data-height="299" data-sort-name="nama_dokter" data-sort-order="desc" data-klinik="{{ $klinik }}" id="tapasien" style="display:inline; border-bottom:none;">
                    <thead>
                        <tr>
                            <th data-align="right" data-field="no" class="table-no" data-sortable="false">
                                No
                            </th>
                            <th data-align="justify" data-field="nama_dokter" data-sortable="false">
                                Nama Dokter
                            </th>
                            <th data-align="justify" data-field="nama_poli" data-sortable="false">
                                Poliklinik
                            </th>
                            <th data-align="center" data-field="senin" data-sortable="false">
                                Senin
                            </th>
                            <th data-align="center" data-field="selasa" data-sortable="false">
                                Selasa
                            </th>
                            <th data-align="center" data-field="rabu" data-sortable="false">
                                Rabu
                            </th>
                            <th data-align="center" data-field="kamis" data-sortable="false">
                                Kamis
                            </th>
                            <th data-align="center" data-field="jumat" data-sortable="false">
                                Jum'at
                            </th>
                            <th data-align="center" data-field="sabtu" data-sortable="false">
                                Sabtu
                            </th>
                            <th data-align="center" data-field="ahad" data-sortable="false">
                                Ahad
                            </th>
                        </tr>
                    </thead>
                    <tbody class="select" id="tbpasien">
                    </tbody>
                </table>
            </input>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" data-backdrop="true" id="modal_tutorial" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    Cara Penggunaan
                </h3>
            </div>
            <div class="modal-body">
                Klik dokter yang akan diperbaharui, untuk memperbaharui jadwal
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<style>
    .input-group-btn .chosen-container {
        width:15em !important;
    }
</style>
<div aria-hidden="true" aria-labelledby="" class="modal fade" id="modal_kartu" role="dialog" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <h3 class="modal-title">
                    Pengaturan Jadwal Praktek
                </h3>
            </div>
            <div class="modal-body form-group">
                <div class="col-md-12">
                    <form id="form_kartu">
                        <div class="row">
                            <label class="col-sm-2 control-label" for="kd_dr">
                                Kode :
                            </label>
                            <div class="col-sm-10">
                                <input name="kd_dr" type="text" autocomplete="off" class="form-control" id="kd_dr" data-id="Kode Dokter">
                                </input>
                            </div>
                            <label class="col-sm-2 control-label" for="nm_dr">
                                Nama :
                            </label>
                            <div class="col-sm-10">
                                <input name="nm_dr" type="text" autocomplete="off" class="form-control" id="nm_dr" data-id="Nama Dokter">
                                </input>
                            </div>
                            <label class="col-sm-2 control-label" for="poli">
                                Poli :
                            </label>
                            <div class="col-sm-10 col-12">
                                <div class="input-group">
                                    <input name="nm_poli" type="text" class="form-control" autocomplete="off" class="form-control" id="nm_poli" data-id="Nama Poli">
                                    </input>
                                    
                                    <div class="input-group-btn">
                                        <input name="kd_poli" type="text" style="width:6em;" class="form-control" autocomplete="off" class="form-control" id="kd_poli" data-id="Kode Poli">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            @foreach ($hari as $key => $value)
                            <label class="col-sm-2 control-label" for="{{ $value }}_pagi_mulai">
                                {{ ucwords($value) }} :
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input name="waktu[]" type="text" autocomplete="off" class="form-control text-center" id="{{ $value }}_pagi_waktu" data-id="Pagi" placeholder="-" readonly="" value="PAGI" style="width:3.5em;">
                                        </input>
                                    </div>
                                    <input type="hidden" name="hari[]" id="{{ $value }}_pagi_hari" value="{{ $value }}" />
                                    <input name="mulai[]" style="width:5em;" type="text" autocomplete="off" class="form-control timemask" id="{{ $value }}_pagi_mulai" data-id="Jam Mulai" placeholder="HH:MM">
                                    </input>
                                    <div class="input-group-btn">
                                        <input name="sd[]" type="text" autocomplete="off" class="form-control text-center" id="{{ $value }}_pagi_sd" data-id="Jam SD" placeholder="-" readonly="" value="-" style="width:3.5em;">
                                        </input>
                                    </div>
                                    <input name="selesai[]" style="width:5em;" type="text" autocomplete="off" class="form-control timemask" id="{{ $value }}_pagi_selesai" data-id="Jam Selesai" placeholder="HH:MM">
                                    </input>
                                    <div class="input-group-btn">
                                        <select class="praktek chosen-select" style="width:20em !important;" data-placeholder="Silahkan pilih" id="{{ $value }}_pagi_praktek" name="praktek[]" >
                                            <option value=""></option>
                                            <option value="PRAKTEK">PRAKTEK</option>
                                            <option value="TIDAK PRAKTEK">TIDAK PRAKTEK</option>
                                        </select>
                                    </div>
                                    <input name="kuota[]" style="width:6.3em;" type="number" autocomplete="off" class="form-control" id="{{ $value }}_pagi_kuota" data-id="Kuota" placeholder="Kuota">
                                    </input>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label" for="{{ $value }}_sore_mulai">
                                &nbsp; 
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input name="waktu[]" type="text" autocomplete="off" class="form-control text-center" id="{{ $value }}_sore_waktu" data-id="Sore" placeholder="-" readonly="" value="SORE" style="width:3.5em;">
                                        </input>
                                    </div>
                                    <input type="hidden" name="hari[]" id="{{ $value }}_sore_hari" value="{{ $value }}" />
                                    <input name="mulai[]" style="width:5em;" type="text" autocomplete="off" class="form-control timemask" id="{{ $value }}_sore_mulai" data-id="Jam Mulai" placeholder="HH:MM">
                                    </input>
                                    <div class="input-group-btn">
                                        <input name="sd[]" type="text" autocomplete="off" class="form-control text-center" id="{{ $value }}_sore_sd" data-id="Jam SD" placeholder="-" readonly="" value="-" style="width:3.5em;">
                                        </input>
                                    </div>
                                    <input name="selesai[]" style="width:5em;" type="text" autocomplete="off" class="form-control timemask" id="{{ $value }}_sore_selesai" data-id="Jam Selesai" placeholder="HH:MM">
                                    </input>
                                    <div class="input-group-btn">
                                        <select class="praktek chosen-select" style="width:20em !important;" data-placeholder="Silahkan pilih" id="{{ $value }}_sore_praktek" name="praktek[]" >
                                            <option value=""></option>
                                            <option value="PRAKTEK">PRAKTEK</option>
                                            <option value="TIDAK PRAKTEK">TIDAK PRAKTEK</option>
                                        </select>
                                    </div>
                                    <input name="kuota[]" style="width:6.3em;" type="number" autocomplete="off" class="form-control" id="{{ $value }}_sore_kuota" data-id="Kuota" placeholder="Kuota">
                                    </input>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-offset-2 col-sm-10">
                                <br>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="batal" name="batal">
                                        Batal
                                    </button>
                                    <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
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
<script language="javascript">
    $('.timemask').inputmask('h:s', { 'placeholder': 'HH:MM' })
</script>
