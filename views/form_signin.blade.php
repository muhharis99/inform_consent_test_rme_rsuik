<div class="col-lg-12 text-center">
    <h2>
        RME
    </h2>
    <hr class="star-primary">
    </hr>
</div>
<div class="panel-body grid effect-3" id="grid">
    <div class="clearfix">
        <br>
            <br>
            </br>
        </br>
    </div>
    <div class="col-md-offset-4">
        <div class="bs-example col-md-6" style="border: 3px solid #389f6b;">
            <form accept-charset="utf-8" action="{{ HOME }}main/auth" id="signin" method="post">
                <div class="form-horizontal">
                    <div class="text-head">
                        <h3>
                            Login RME
                        </h3>
                    </div>
                    <hr>
                        <div class="">
                            <label class="control-label" for="id_screen">
                                USERNAME :
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control" id="id_screen" name="id_screen" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label" for="kode_screen">
                                PASSWORD :
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control" id="kode_screen" name="kode_screen" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="">
                            <label class="control-label" for="submit">
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control btn btn-success" id="submit" name="submit" required="" type="submit" value="Login">
                                </input>
                            </div>
                        </div>
                        <div class="txr">
                            <a href="{{ SUBDOM }}main/reset">
                                <br/>
                                <p>
                                    Reset Password
                                </p>
                            </a>
                        </div>
                    </hr>
                </div>
            </form>
        </div>
    </div>
</div>
