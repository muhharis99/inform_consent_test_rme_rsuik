<!DOCTYPE html>
<html dir="ltr" lang="en" mozdisallowselectionprint="" moznomarginboxes="">
    <head>
        <meta charset="utf-8"/>
        <meta "="" content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
        <meta "="" content="Ardi Deny Setiyawan" name="author"/>
        <meta content="#4f8e45" name="theme-color"/>
        <meta content="rsi, rsiklaten, rsislamklaten" name="keywords"/>
        <meta content="Web Project" name="description"/>
        <meta content="PGHBSftgJ2Ub02OEHT1iZ0lbPtcJ-ukrnxmYYxHWg-c" name="google-site-verification"/>
        <link href="{{ IMG }}banner/rsi.png" rel="shortcut icon"/>
        {{ $assets; }}
        <script>
            var CI = {
                'base_url' : '<?=URL.segment(1)."/";?>'
            };
        </script>
        <style>

            *:focus{
            outline: none;
            }

            body {
            border: none;
            margin: 0;
            padding: 30px;
            background: #003e50;
            font: normal 16px/20px Lekton, sans-serif;
            }

            input, textarea, select, button {
            font-family: "helvetica neue", sans-serif !important;
            }

            h1{
            font-family: 'Lobster', cursive;
            text-shadow: 10px 10px 20px rgba(0, 0, 0, 0.30);
            color: #000000;
            font-weight: 200;
            text-align: center;
            font-size: 50px;
            }

            h2{
            font-family:  sans-serif;
            font-size: 32px;
            font-weight: 100;
            text-align: left;
            line-height: 1.5;
            }

            #wrapper{
            position: relative;
            min-width: 1180px;
            }

            .console{
            margin-top: 70px;
            text-align: center;
            }

            #debug {
            position: absolute;
            width: 450px;
            padding: 5px;
            height: 100%;
            top: 0;
            right: 0;
            background: rgba(0, 0, 0, .8);
            overflow: auto;
            color: #fff;
            font-size: 13px;
            z-index: 10000;
            }

            .dida{
            color: #fff;
            font-size: 20px;
            margin-top: 20px;
            }

            button, .button {
            transition: all .4s;
            display: inline-block;
            padding: 0px 10px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            background-color: rgba(248, 248, 248, 0.4);
            box-shadow: 0 0 4px rgba(0,0,0,0.4);
            color:#000;

            border: 1px solid transparent;

            text-decoration: none;
            line-height: 30px;
            margin: 3px;
            border-radius: 10px;
            }

            button:hover, .button:hover {
            background-color: rgb(0, 0, 0);
            color: #FFF;
            }

            #togglePlay{
            margin-top: 20px;
            font-size: 20px;
            width: 100px;
            height: 100px;
            line-height: 70px;
            border-radius: 100%;
            }

            #togglePlay.pause{
            background-color: rgb(0, 0, 0);
            color: #fff;
            }

            #togglePlay.pause:after{
            content:"pause"
            }

            #togglePlay.play:after{
            content:"play"
            }

            #togglePlay.pause:hover{
            background-color: #fff;
            color: #333;
            }

            #togglePlay.play{
            background-color: #fff;
            color: #333;
            }

            #togglePlay.play:hover{
            background-color: rgb(0, 0, 0);
            color: #fff;
            }

            .goto {
            position: absolute;
            left:0;
            top: 700px;
            right: 0;
            margin: auto;
            text-align: center;
            width: 100%;
            height: 50px;
            }

            .goto .button{
            font-size: 30px;
            font-family: 'Lobster', cursive;
            padding: 10px;
            text-transform: none;
            }

            #filtersControl{
            position: absolute;
            top:0;
            left: 10px;
            width: 350px;
            margin: 30px auto;
            z-index: 1000;
            }

            #changeVideo {
            position: absolute;
            top: 0;
            right: 10px;
            width: 350px;
            margin: 30px auto;
            z-index: 100;
            padding: 10px;
            border-radius: 10px;
            color: #FFFFFF;
            box-sizing: border-box;
            }

            #changeVideo label {
            padding: 10px;
            display: block;
            }

            #changeVideo input {
            padding: 10px;
            display: block;
            width: 250px;
            border-radius: 10px;
            border: none;
            font-size: 20px;
            color: #fff;
            font-weight: 700;
            background-color: rgba(168, 168, 168, 0.20);
            }

            #changeVideo input[type=number] {
            display: inline-block;
            width: 100px;
            }

            #changeVideo input[type=checkbox] {
            display: inline-block;
            width: 20px;
            }

            #loadBox{
            background-color: rgba(168, 168, 168, 0.20);
            border-radius: 10px;
            padding: 20px;
            }

            /*Slider START *******************************************************************************************/

            #filterScript {
            margin-top: 20px;
            padding: 10px;
            background-color: rgba(25, 34, 37, 0.35);
            color: #fff;
            border-radius: 10px;
            }

            .slider {
            position: relative;
            width: 100%;
            height: 25px;
            border: 0 solid transparent;
            background-color: rgba(255, 255, 255, 0.20);
            border-radius: 4px;
            margin-top: 10px;
            overflow: hidden;
            }

            .slider:hover {
            background-color: rgba(255, 255, 255, 0.46);
            }

            .slider .level {
            background-color: rgba(255, 255, 255, 0.80);
            height: 100%;
            border-right: 5px solid rgba(168, 168, 168, 0.60);
            }

            .slider .desc {
            position: absolute;
            right: 0;
            top: 0;
            padding: 5px;
            font-size: 12px;
            line-height: 18px;
            color: #222222;
            }

            .slider span {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            /*text-transform: uppercase;*/
            position: absolute;
            top: 0;
            font-size: 12px;
            line-height: 18px;
            color: #222222;
            padding: 4px;
            text-align: left;
            width: 100%;
            box-sizing: border-box;
            }

            /*Slider END ************************************************/

        </style>

        <script>

            var myPlayer;
            jQuery(function () {
            myPlayer = jQuery("#bgndVideo").YTPlayer({useOnMobile:true, mobileFallbackImage:"assets/mask-4.png"});

            /* DEBUG ******************************************************************************************/

            var YTPConsole = jQuery("#eventListener");
            // EVENTS: YTPReady YTPStart YTPEnd YTPPlay YTPLoop YTPPause YTPBuffering YTPMuted YTPUnmuted YTPChangeVideo
            myPlayer.on("YTPReady YTPStart YTPEnd YTPPlay YTPLoop YTPPause YTPBuffering YTPMuted YTPUnmuted YTPChangeVideo", function (e) {
                YTPConsole.append("event: " + e.type + " (" + jQuery("#bgndVideo").YTPGetPlayer().getPlayerState() + ") > time: " + e.time);
                YTPConsole.append("<br>");
            });

            // EVENT: YTPChanged
            myPlayer.on("YTPChanged", function (e) {
                YTPConsole.html("");
            });

            myPlayer.on("YTPChangeVideo", function(e){
                console.debug("YTPChangeVideo", e);

            });

            // EVENT: YTPData
            myPlayer.on("YTPData", function (e) {

                if(!e.prop.title)
                    return;

                $(".dida").html(e.prop.title + "<br>@" + e.prop.channelTitle);
                $("#videoData").show();

                YTPConsole.append("******************************");
                YTPConsole.append("<br>");
                YTPConsole.append(e.type);
                YTPConsole.append("<br>");
                YTPConsole.append(e.prop.title);
                YTPConsole.append("<br>");
                YTPConsole.append(e.prop.description.replace(/\n/g, "<br/>"));
                YTPConsole.append("<br>");
                YTPConsole.append("******************************");
                YTPConsole.append("<br>");
            });

            // EVENT: YTPTime
            myPlayer.on("YTPTime", function (e) {
                var currentTime = e.time;
                var traceLog = currentTime / 5 == Math.floor(currentTime / 5);

                if (traceLog && YTPConsole.is(":visible")) {
                YTPConsole.append(myPlayer.attr("id")+ " > " + e.type + " > actual time is: " + currentTime);
                YTPConsole.append("<br>");

                if(myPlayer.YTPGetFilters())
                    console.debug("filters: ", myPlayer.YTPGetFilters());
                }
            });

            /* END DEBUG ******************************************************************************************/

            /* FILTER SLIDERS ******************************************************************************************/
            // create sliders for filters adjustment
            $(".slider").each(function(){
                var $slider = $(this);
                $slider.simpleSlider({
                initialval: 0, //function (el) {return Math.random() * el.opt.scale},
                scale     : 100,
                callback  : function (el) {
                    var filter = $(el).data("filter");
                    myPlayer.YTPApplyFilter(filter, +(el.value).toFixed(0));
                    $("span",el).html(filter + "       (" + (+(el.value).toFixed(0)) + ")");
                    var applFilters = [];
                    var desc = "$(selector).YTPApplyFilters({";

                    for (var x=0; x < $(".slider").length; x++ ){
                    var slider = $(".slider").eq(x).get(0);
                    var $slaider = $(slider);
                    if(slider.value)
                        applFilters.push($slaider.data("filter") + ": " + (+(slider.value).toFixed(0)) );
                    };

                    for (var y in applFilters){
                    var comma = y < applFilters.length-1 ? "," : "<br>";
                    desc += "<br> &nbsp;&nbsp;&nbsp;" + applFilters[y] + comma;
                    }
                    desc += "})";
                    $("#filterScript").html(desc);
                }
                });
            });

            /* update applied filters */
            myPlayer.on("YTPFiltersApplied", function(){
                var filters = myPlayer.get(0).filters;

                for (var key in filters){
                $(".slider[data-filter="+key+"]").updateSliderVal(filters[key].value);
                }
            });

            myPlayer.on("YTPPlay", function(){
                // $("#togglePlay").removeClass("play pause");
                // $("#togglePlay").addClass("pause");
            });

            myPlayer.on("YTPPause", function(){
                // $("#togglePlay").removeClass("play pause");
                // $("#togglePlay").addClass("play");
            });
            /* END FILTER SLIDERS ******************************************************************************************/
            });

            /**
             *
             * @param val
             * @returns {*|number}
             */
            function checkForVal(val){
                return val || 0;
            }
        </script>
    </head>
<title>
    ANJUNGAN PENDAFTARAN MANDIRI
</title>
<body>
    @if (!empty($header))
        @include('header')
    @endif
        @include($view)
<script language="javascript">
</script>
</body>
</html>