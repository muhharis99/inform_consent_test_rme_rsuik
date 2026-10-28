<style>
#countdown-circle {
    width: 100px;
    height: 100px;
    border: 5px solid #27ae60;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    background: #fff;
    color: #27ae60;
    font-size: 24px;
    font-weight: bold;
    box-sizing: border-box;
}

#countdown-label {
    /* font-size: 12px; */
    /* color: #666; */
}

#countdown-circle.finished {
    border-color: #999;
    color: #999;
}
</style>
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
                        <div class="row">
                            <div class="col-md-12">
                                Akun Anda terkunci sementara karena 3 kali gagal login berturut-turut.
                            </div>
                        </div>
                        <div class="hide">
                            <label class="control-label" for="id_screen">
                                USERNAME :
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control" id="id_screen" name="id_screen" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="hide">
                            <label class="control-label" for="kode_screen">
                                PASSWORD :
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control" id="kode_screen" name="kode_screen" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="hide">
                            <label class="control-label" for="submit">
                            </label>
                            <div class="">
                                <input autocomplete="off" class="form-control btn btn-success" id="submit" name="submit" required="" type="submit" value="Login">
                                </input>
                            </div>
                        </div>
                        <div class="txr hide">
                            <a href="{{ SUBDOM }}main/reset">
                                <br/>
                                <p>
                                    Reset Password
                                </p>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp; 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center" style="margin-top: 20px;">
                                    <div id="countdown-circle">
                                        <span id="countdown-time">03:00</span>
                                    </div>
                                    <br />&nbsp; <br />
                                    <p id="countdown-label" style="margin-top: 10px;">
                                        Silakan tunggu sebelum mencoba login kembali. <br />Atau hubungi TIM IT untuk membantu mempercepat akses pelayanan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </hr>
                </div>
            </form>
        </div>
    </div>
</div>
<script language="javascript">
    // $('.triangle').hide();

    $(document).ready(function () {
        var remaining = 180; // 3 menit

        function updateCountdown() {
            var minutes = Math.floor(remaining / 60);
            var seconds = remaining % 60;

            $('#countdown-time').text(
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0')
            );

            if (remaining <= 0) {
                clearInterval(timer);

                $('#countdown-circle').addClass('finished');
                $('#countdown-label').text(
                    'Waktu tunggu selesai. Silakan coba login kembali.'
                );

                return;
            }

            remaining--;
        }

        updateCountdown();

        var timer = setInterval(updateCountdown, 1000);
    });

</script>