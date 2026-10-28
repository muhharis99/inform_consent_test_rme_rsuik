<style>
    .signature-pad {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        font-size: 10px;
        width: 100vw;
        height: 40vh;
        max-width: 100%;
        max-height: 40%;
        border: 1px solid #e8e8e8;
        background-color: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
        border-radius: 4px;
        padding: 5px;
    }

    .signature-pad::before,
    .signature-pad::after {
        position: absolute;
        z-index: -1;
        content: "";
        width: 40%;
        height: 10px;
        bottom: 10px;
        background: transparent;
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
    }

    .signature-pad::before {
        left: 20px;
        -webkit-transform: skew(-3deg) rotate(-3deg);
        transform: skew(-3deg) rotate(-3deg);
    }

    .signature-pad::after {
        right: 20px;
        -webkit-transform: skew(3deg) rotate(3deg);
        transform: skew(3deg) rotate(3deg);
    }

    .signature-pad--body {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        border: 1px solid #f4f4f4;
    }

    .signature-pad--body canvas {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
    }

    .signature-pad--footer {
        color: #C3C3C3;
        text-align: center;
        font-size: 1.2em;
        margin-top: 8px;
    }

    .signature-pad--actions {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-top: 8px;
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <h2 class="row-centered col-md-12">
            Tanda Tangan Pasien
        </h2>
        <div class="text-right col-md-12">
            <b>
                Welcome
            </b>: {{ $akses }}
           
        </div>
        <div class="col-md-4 col-xs-12 col-sm-12 form-horizontal">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 class="alert alert-success">
                        Data Pasien
                    </h4>
                    <div class="form-group">
                        <div class="">
                            <label class="col-sm-2 control-label" for="no_reg">
                                No RM :
                            </label>
                            <div class="col-sm-10">
                                <input autocomplete="off" class="form-control" id="no_reg" name="no_reg" value="{{ $no_reg }}" readonly="" type="text" required="">
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="nama">
                                Nama :
                            </label>
                            <div class="col-sm-10">
                                <input autocomplete="off" class="form-control" id="nama" name="nama" value="{{ $nama }}" readonly="" type="text" required="">
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="bangsal">
                                Asal:
                            </label>
                            <div class="col-sm-10">
                                <input type="" id="asal" class="form-control" value="ADMISI" readonly="" required="">
                            </div>
                        </div>
                        <div class="">
                            <label class="col-sm-2 control-label" for="tgl_masuk">
                                Tanggal:
                            </label>
                            <div class="col-sm-10">
                                <input autocomplete="off" class="form-control" id="tgl_masuk" name="tgl_masuk" value="{{ $tgl_masuk }}" readonly="" type="text" required="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 form-horizontal">
            <h4 class="alert alert-success">
                Tanda Tangan Disini
            </h4>
            <div class="form-group">
                <div class="">
                    <label class="col-sm-3 control-label" for="nama_ttd">
                        Nama Pasien/Keluarga :
                    </label>
                    <div class="col-sm-9">
                        <input autocomplete="off" class="form-control" id="nama_ttd" name="nama_ttd" placeholder="Nama yang tanda tangan" type="text">
                    </div>
                </div>
                <br><br>
                <div class="" style="padding: 0px 15px 0px 15px;">
                    <div id="signature-pad" class="signature-pad">
                        <div class="signature-pad--body">
                            <canvas id="sign"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <div class="col-sm-12 col-xs-12 alert-warning">
                        <div class="row">
                            <!--<button class="col-xs-12 col-md-2 btn btn-danger" id="cetak_ulang_resume_keperawatan" name="cetak_ulang_resume_keperawatan">
                                Persetujuan
                            </button> -->
                            <button class="col-xs-12 col-md-2 btn btn-danger" id="simpan" name="simpan">
                                Simpan
                            </button>
                            <button class="col-xs-12 col-md-2 btn btn-danger" id="batal" name="batal">
                                Batal
                            </button>
                        </div>
                    </div>
                    </hr>
                </div>
            </div>
        </div>
    </div>
</div>