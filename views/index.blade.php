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
        @if(isset($userid))
        @else
        <?php $userid = null; ?>
        @endif
        {{ $assets; }}
        <script>
            var CI = {
                'base_url' : '<?=URL.segment(1)."/";?>', 
                'asset_url' : '<?=ASSETS;?>', 
                'audio_url' : '<?=AUDIO;?>', 
                'userid_soap' : '<?=$userid;?>',
            };
        </script>
    </head>
<title>
    {{ $title ?? 'ADMISI' }}
</title>
<body>
    @if (!empty($header))
        @include('header')
      @endif
    <div class="container bs-docs-container <?php /*panel-body*/?>" id="main">
        @if(!isset($home) || $home)
        <div class="triangle row" id="triangle">
            <a href="{{ URL.segment(0)."rme" }}">
                <h4>
                    Home
                </h4>
            </a>
        </div>
        @endif
        <div class="row" id="headoff">
        </div>
        @include($view)
    </div>
    <div class="clearfix">
    </div>
    <!-- Scroll to top -->
    <span class="totop" style="display: none;">
        <a href="#">
            <i class="fa fa-chevron-up">
            </i>
        </a>
    </span>
    @if(sess_on('auth')->user)
    <a class="fixed-nav fixed-nav-prev format- style-default" href="#" id="logout"><span class="arrow">Keluar</span>
    @endif
    <!--<div class="photo"><img width="80" height="80" src="" alt="" sizes="(max-width: 80px) 100vw, 80px"></div><div class="desc"><div>-</div><span class="date"><i class="fa fa-clock"></i></span></div>--></a>
    <!--<a class="fixed-nav fixed-nav-next format- style-default" href="#"><span class="arrow"><i class="fa fa-angle-right"></i></span>
    <div class="photo"><img width="80" height="80" src="#" class="attachment-blog-navi size-blog-navi wp-post-image" alt=""></div><div class="desc"><div>-</div><span class="date"><i class="fa fa-clock"></i></span></div></a>-->

<!-- Scroll to top -->
@if(!segment(3))
<div class="is-fixed" id="cd-nav">
    <a class="cd-nav-trigger" href="#0">
        <i class="fa fa-phone">
            <span class="totop">
            </span>
        </i>
    </a>
    <nav id="cd-main-nav">
        <ul class="has-transitions col-md-12">
            <li>
                <h4 class="alert alert-success">
                    KONTAK UNIT
                </h4>
                <table class="table table-condensed " id="takontak">
                    <thead>
                        <tr>
                            <th data-field="nama" data-sortable="true">
                                Nama
                            </th>
                            <th data-field="phone" data-sortable="true">
                                Phone
                            </th>
                        </tr>
                    </thead>
                    <tbody class="select">
                    </tbody>
                </table>
            </li>
            <div class="row">
                <br/>
                <br/>
                <br/>
            </div>
        </ul>
    </nav>
</div>
@endif
<div class="body-bottom">
</div>
<script language="javascript">
if(self==top) {
    // console.log('window'); 
} else {
    $('#logout').hide();
    $('#triangle').hide();
    $('#headoff').hide();
    $('#main').removeClass('container');
    $('#main').addClass('container-fluid');
}
</script>
</body>
</html>