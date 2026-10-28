<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12" id="report_resep">
        <h2 class="row-centered">
            Resep Obat
        </h2>
        <div class="col-md-3 col-xs-12 col-sm-12 form-horizontal">
            <form accept-charset="utf-8" action="{{ HOME }}search/soap" id="resep" method="post">
                <!--
                <h4 class="alert alert-success">
                    DATA PASIEN
                </h4>
                -->
                <!--
                <div class="">
                    <label class="control-label" for="dokter">
                        Dokter :
                    </label>
                    <select class="chosen-select" data-label="dokter" id="dokter" name="dokter">
                    </select>
                </div>
                -->
                <!--
                <div class="">
                    <label class="control-label" for="nama">
                        Nama :
                    </label>
                    <input autocomplete="off" class="form-control" id="nama" name="nama" placeholder="Nama" readonly="" required="" type="text" value="">
                    </input>
                </div>
                <div class="">
                    <label class="control-label" for="alamat">
                        Alamat :
                    </label>
                    <input autocomplete="off" class="form-control" id="alamat" name="alamat" placeholder="Alamat" readonly="" required="" type="text" value="">
                    </input>
                </div>
                <div class="">
                    <label class="control-label" for="tgl_lahir">
                        Tanggal Lahir :
                    </label>
                    <input autocomplete="off" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Keterangan" readonly="" required="" type="text" value="">
                    </input>
                </div>
                -->
                <h4 class="alert alert-success">
                    LIST PASIEN
                </h4>
                <div class="">
                    <label class="control-label" for="store">
                        Store :
                    </label>
                    <select class="chosen-select" data-label="store" id="store" name="store">
                        <option></option>
                        @foreach($store as $all)
                            @if($all->jenis == 'RI')
                            <option value="{{ $all->jenis }}" data-dokter="{{ $dokter->dokter_id }}" data-jenis="awal">{{ ucwords(str_replace('_', ' ', $all->jenis)) }} - Awal</option>
                            <option value="{{ $all->jenis }}" data-dokter="{{ $dokter->dokter_id }}" data-jenis="resume">{{ ucwords(str_replace('_', ' ', $all->jenis)) }} - Resume</option>
                            <option value="{{ $all->jenis }}" data-dokter="{{ $dokter->dokter_id }}" data-jenis="cppt">{{ ucwords(str_replace('_', ' ', $all->jenis)) }} - CPPT</option>
                            @else
                            <option value="{{ $all->jenis }}" data-dokter="{{ $dokter->dokter_id }}" data-jenis="">{{ ucwords(str_replace('_', ' ', $all->jenis)) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label class="control-label" for="trx">
                        No.RM :
                    </label>
                    <input autocomplete="off" class="form-control" id="trx" maxlength="7" name="trx" placeholder="No.Ref" required="" type="text" value="">
                    </input>
                    <input autocomplete="off" class="form-control" id="htrx" maxlength="7" name="htrx" placeholder="No.Ref" type="hidden" value="">
                    </input>
                </div>
                <div class="hide">
                    <label class="control-label" for="registered">
                        Registered :
                    </label>
                    <input autocomplete="off" class="form-control" id="registered" name="registered" placeholder="Registered" required="" type="text">
                    </input>
                </div>
                <div class="">
                    <label class="control-label" for="tanggal">
                        Tanggal :
                    </label>
                    <input autocomplete="off" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal" required="" type="text" value="{{ date('d-m-Y') }}">
                    </input>
                </div>
                <div class="hide">
                    <label class="control-label" for="no_reg">
                        No.RM :
                    </label>
                    <input autocomplete="off" class="form-control" id="no_reg" name="no_reg" placeholder="No.RM" readonly="" type="text" value="">
                    </input>
                </div>
                <div class="">
                    <label class="control-label" for="copy">
                        Jenis Resep :
                    </label>
                    <select class="chosen-select" data-label="copy" id="copy" name="copy">
                        <option value="1">
                            COPY
                        </option>
                        <option value="2">
                            ASLI
                        </option>
                    </select>
                </div>
                <div class="">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="showall" id="showall" value="true" checked>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        Tampilkan Semua
                        </label>
                    </div>
                </div>
                <div>
                    <table class="table" data-height="500" data-sort-name="nama" data-sort-order="desc" id="tapasien" style="display:inline; border-bottom:none;">
                        <thead>
                            <tr>
                                <th class="hide" data-align="right" data-field="soap_id" data-sortable="true">
                                    ID
                                </th>
                                <th class="" data-align="center" data-field="antrian" data-sortable="true">
                                    Antrian
                                </th>
                                <th class="" data-align="center" data-field="jenis" data-sortable="true">
                                    Jenis
                                </th>
                                <th class="" data-align="center" data-field="no_reg" data-sortable="true">
                                    No_Reg
                                </th>
                                <th data-align="left" data-field="nama" data-sortable="true">
                                    Nama
                                </th>
                                <th data-align="left" data-field="tgl_lahir" data-sortable="true">
                                    Tgl.Lahir
                                </th>
                                <th data-align="left" data-field="alamat" data-sortable="true">
                                    Alamat
                                </th>
                                <th data-align="center" data-field="registered" data-sortable="true">
                                    Registered
                                </th>
                                <th class="hide" data-align="center" data-field="dokter_id" data-sortable="true">
                                    Dokter
                                </th>
                                <th class="hide" data-align="center" data-field="pdf" data-sortable="true">
                                    PDF
                                </th>
                                <th class="hide" data-align="center" data-field="verif_id" data-sortable="true">
                                    Verif
                                </th>
                                <th class="hide" data-align="center" data-field="petugas1" data-sortable="true">
                                    Petugas 1
                                </th>
                                <th class="hide" data-align="center" data-field="petugas2" data-sortable="true">
                                    Petugas 2
                                </th>
                                <th class="hide" data-align="center" data-field="trx" data-sortable="true">
                                    trx
                                </th>
                            </tr>
                        </thead>
                        <tbody class="select" id="tbpasien">
                            @if(!empty($content))
                                @foreach($content as $all)
                                <tr>
                                    <td class='hide'>
                                        {{ $all->soap_id }}
                                    </td>
                                    <td class=''>
                                        {{ $all->jenis }}
                                    </td>
                                    <td>
                                        {{ $all->no_reg }}
                                    </td>
                                    <td>
                                        {{ $all->nama }}
                                    </td>
                                    <td>
                                        {{ $all->tgl_lahir }}
                                    </td>
                                    <td>
                                        {{ $all->alamat }}
                                    </td>
                                    <td>
                                        {{ $all->registered }}
                                    </td>
                                    <td class='hide'>
                                        {{ $all->pdf }}
                                    </td>
                                    <td class='hide'>
                                        {{ $all->verif_id }}
                                    </td>
                                    <td class='hide'>
                                        {{ $all->petugas1 }}
                                    </td>
                                    <td class='hide'>
                                        {{ $all->petugas2 }}
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div>
                        <label class="control-label col-md-6" for="resep_rj">
                            Jumlah RJ :
                        </label>
                        <div id="resep_rj" class="control-label txl col-md-6 col-xs-12">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 form-horizontal">
            <h4 class="alert alert-success">
                RESEP OBAT
            </h4>
            <div class="">
                <table class="table" data-height="299" data-sort-name="nama" data-sort-order="desc" id="taresep" style="display:inline; border-bottom:none;">
                    <thead>
                        <tr>
                            <th class="hide" data-align="right" data-field="no_reg" data-sortable="true">
                                No_Reg
                            </th>
                            <th data-align="left" data-field="nama" data-sortable="true">
                                Nama
                            </th>
                            <th data-align="left" data-field="perintah" data-sortable="true">
                                Perintah
                            </th>
                            <th data-align="left" data-field="jumlah" data-sortable="true">
                                Jumlah
                            </th>
                            <th data-align="left" data-field="signa" data-sortable="true">
                                Signa
                            </th>
                            <th data-align="left" data-field="sedia" data-sortable="true">
                                Sediaan
                            </th>
                            <th data-align="left" data-field="sbw" data-sortable="true">
                                SBW
                            </th>
                            <th data-align="left" data-field="keterangan" data-sortable="true">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="select" id="tbresep">
                        @if(!empty($content))
                            @foreach($content as $all)
                            <tr>
                                <td>
                                    {{ $all->no_reg }}
                                </td>
                                <td>
                                    {{ $all->nama }}
                                </td>
                                <td>
                                    {{ $all->perintah }}
                                </td>
                                <td>
                                    {{ $all->jumlah }}
                                </td>
                                <td>
                                    {{ $all->signa }}
                                </td>
                                <td>
                                    {{ $all->sedia }}
                                </td>
                                <td>
                                    {{ $all->sbw }}
                                </td>
                                <td>
                                    {{ $all->keterangan }}
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <br/>
                </div>
            </div>
            <div class="">
                <a class="btn btn-default cetak_resep" href="" id="rresep">
                    Cetak Resep LT 1
                </a>
                <a class="btn btn-default cetak_resep" href="" id="lresep">
                    Cetak Resep LT 2
                </a>
                <a class="btn btn-default cetak_resep" href="" id="bresep">
                    Cetak Resep LT 1.2
                </a>
                <a class="btn btn-default cetak_resep" href="" id="xresep">
                    Cetak Resep Executive
                </a>
                <a class="btn btn-default cetak_resep" href="" id="uresep">
                    Cetak Resep Executive U
                </a>
                <a class="btn btn-default cetak_resep" href="" id="gresep">
                    Cetak Resep UGD
                </a>
                <!--
                <a class="btn btn-default" href="" id="iresep">
                    Cetak Resep Inap
                </a>
                -->
                <a class="btn btn-default cetak_resep" href="" id="presep" target="blank">
                    Cetak Resep PDF
                </a>
                <!--
                <a class="btn btn-default" href="" id="hresep">
                    Cetak Resep EDP
                </a>
                -->
            </div>
            <form action="" method="post" id="verif" accept-charset="utf-8" novalidate="">
                <h4 class="alert alert-success">
                    TELAAH RESEP
                </h4>
                <div class="form-group" id="">
                    <div class="">
                        <label class="control-label col-md-2" for="antrian">
                            Antrian :
                        </label>
                        <div class="col-md-2">
                            <input autocomplete="off" class="form-control" id="soap_id" name="soap_id" placeholder="ID" type="hidden" value="">
                            </input>
                            <input autocomplete="off" class="form-control" id="jenis" name="jenis" placeholder="Jenis" type="hidden" value="">
                            </input>
                            <input autocomplete="off" class="form-control" id="antrian" name="antrian" placeholder="Antrian" required="" type="text" value="">
                            </input>
                        </div>
                    </div>
                    <div class="row"></div>
                    <div class="">
                        <label for="telaah_obat" class="control-label col-md-2">
                            Tepat Obat :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_obat" data-label="Tepat Obat" name="telaah_obat" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_dosis" class="control-label col-md-2">
                            Tepat Dosis :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_dosis" data-label="Tepat Dosis" name="telaah_dosis" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_waktu" class="control-label col-md-2">
                            Tepat Waktu :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_waktu" data-label="Tepat Waktu" name="telaah_waktu" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_rute" class="control-label col-md-2">
                            Tepat Rute :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_rute" data-label="Tepat Rute" name="telaah_rute" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_duplikasi" class="control-label col-md-2">
                            Duplikasi :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_duplikasi" data-label="Duplikasi" name="telaah_duplikasi" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_interaksi" class="control-label col-md-2">
                            Interaksi :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_interaksi" data-label="Interaksi" name="telaah_interaksi" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_bb" class="control-label col-md-2">
                            BB :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_bb" data-label="BB" name="telaah_bb" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="telaah_indikasi" class="control-label col-md-2">
                            Kontra Indikasi :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="telaah_indikasi" data-label="Kontra Indikasi" name="telaah_indikasi" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label class="col-md-2 col-xs-12 control-label" for="telaah_tinlan">
                            Tindak Lanjut :
                        </label>
                        <div class="col-md-2 col-xs-12">
                            <input autocomplete="off" class="form-control" id="telaah_tinlan" name="telaah_tinlan" type="text"/>
                        </div>
                    </div>
                </div>
                <h4 class="alert alert-success">
                    VERIF OBAT
                </h4>
                <div class="form-group" id="">
                    <div class="">
                        <label for="verif_obat" class="control-label col-md-2">
                            Tepat Obat :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="verif_obat" data-label="Tepat Obat" name="verif_obat" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="verif_dosis" class="control-label col-md-2">
                            Tepat Dosis :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="verif_dosis" data-label="Tepat Dosis" name="verif_dosis" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="verif_waktu" class="control-label col-md-2">
                            Tepat Waktu :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="verif_waktu" data-label="Tepat Waktu" name="verif_waktu" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="verif_rute" class="control-label col-md-2">
                            Tepat Rute :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="verif_rute" data-label="Tepat Rute" name="verif_rute" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="verif_pasien" class="control-label col-md-2">
                            Tepat Pasien :
                        </label>
                        <div class="col-md-2">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="verif_pasien" data-label="Tepat Pasien" name="verif_pasien" style="display: none;">
                                <option value="">
                                </option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label class="col-md-2 col-xs-12 control-label" for="verif_tinlan">
                            Tindak Lanjut :
                        </label>
                        <div class="col-md-2 col-xs-12">
                            <input autocomplete="off" class="form-control" id="verif_tinlan" name="verif_tinlan" type="text"/>
                        </div>
                    </div>
                </div>
                <h4 class="alert alert-success">
                    PETUGAS
                </h4>
                <div class="form-group" id="">
                    <div class="">
                        <label for="petugas1" class="control-label col-md-2">
                            Petugas I :
                        </label>
                        <div class="col-md-4">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="petugas1" data-label="Petugas 1" name="petugas1" style="display: none;">
                                <option value="">
                                </option>
                                @foreach($karyawan as $all)
                                    <option value="{{ $all->id }}">{{ $all->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="petugas2" class="control-label col-md-2">
                            Petugas II :
                        </label>
                        <div class="col-md-4">
                            <select class="chosen-select" data-placeholder="Silahkan Pilih..." id="petugas2" data-label="Petugas 2" name="petugas2" style="display: none;">
                                <option value="">
                                </option>
                                @foreach($karyawan as $all)
                                    <option value="{{ $all->id }}">{{ $all->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @if($induk == 'EDP' || $induk == 'FRM')
                <div>
                    <hr/>
                </div>
                <div class="form-group" id="sf7">
                    <div class="col-md-12">
                        <div class="col-md-12 alert-warning row-right">
                            <div class="row">
                                <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
<div class="navbar col-md-12">
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" data-backdrop="true" id="modal_dokter" role="dialog" style="display: none;" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    Kode Akses
                </h3>
            </div>
            <div class="modal-body">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>