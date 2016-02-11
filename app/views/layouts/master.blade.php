
        <!DOCTYPE HTML>
        <html lang="en" xmlns="http://www.w3.org/1999/html">
        <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        {{--<script type="application/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>--}}
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="distribution" content="web">
        <link href="https://plus.google.com/+technothlon" rel="publisher"/>

        <meta property="og:title" name="og:title" content="@yield('title', 'Technothlon | Home')"/>
        <title>@yield('title', 'Technothlon | Home')</title>
        <meta name="title" content="@yield('title', 'Technothlon | Home')"/>
                <meta name="description"
                      content="@yield('description', 'An international school championship &#x2013; organized by the students of IIT Guwahati.')"/>

                <meta property="og:description" name="og:description"
                      content="@yield('description', 'An international school championship &#x2013; organized by the students of IIT Guwahati.')"/>

        <link rel="image_src" href="@yield('image', asset('images/logo.png'))"/>
        <meta property="og:image" name="og:image" content="@yield('image', asset('images/logo.png'))"/>
        <link rel="shortcut icon" href="{{ asset('logo.ico') }}" type="image/x-icon"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('CSS/core.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('CSS/menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('sprites/landing.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('sprites/home.css') }}">
        <script src="{{ asset('js/core.js') }}"></script>    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    @yield('head');
</head>
<body style="background: url('{{ asset('images/1920x1080.jpg') }}') no-repeat; background-size: 100%; background-repeat: repeat-y">
    <noscript style="display: block !important">
        <div
            style="line-height: 14px; color: #d03100; text-align: center; font-size: 12px; margin:4px auto; width: 90%">
            If
            your browser supports JavaScript, then please enable it or you can download latest version of <a
                href="http://www.google.com/chrome" target="_blank">Google Chrome</a> or <a
                href="http://www.mozilla.org/en-US/firefox/all/" target="_blank">Mozilla Firefox</a> .
        </div>
    </noscript>
    <a style="display: none" target="_blank" href="https://plus.google.com/+technothlon" rel="publisher"></a>
<div id="view-port">
    <div id="header">
        <div id="main-navigation">
            <div style="float: left; width: 20%;height: 100%;text-align: center;white-space: nowrap">
                <span style="display: inline-block;height: 100%;vertical-align: middle"></span>
                <img src="{{ asset('images/mascot-white.png') }}" style="height: 90%;vertical-align: middle">
            </div>
            <div style="float: right; width: 20%;height: 100%; text-align: center; white-space: nowrap">
                <span style="display: inline-block;height: 100%;vertical-align: middle"></span>
                <img src="{{ asset('images/techniche-leaf.png') }}" style="height: 60%;vertical-align: middle">
            </div>
            <div style="overflow: hidden;height: 100%">
    <div class="nav-wrapper" style="height: 60%">
        <div class="nav node hide-on-phone" style="float: right;width: 20%;max-height: 100%;text-align: right">
            <a class="nav fade" href="http://robomart.com" target="_blank" style="max-height: 100%">
                <div style="max-height: 100%;float: right;;margin-top: -5%">
                    <img src="{{ asset('images/techniche-nav-logo.png') }}" style="max-width: 90%;float: right">
                </div>
            </a>
        </div>
        <div class="nav node hide-on-phone" style="float: left;width: 20%;max-height: 100%">
            <a class="nav fade" href="http://robomart.com" target="_blank" style="max-height: 100%">
                <div style="max-height: 100%;margin-top: 2%">
                    <img src="{{ asset('images/partners/logo-robomart.png') }}" style="max-width: 60%">
                    <p style="margin-top: -8%;text-align: center;font-size: 70%;max-width: 100%">presents</p>
                </div>
            </a>
        </div>
        <div style="overflow: hidden;text-align: center">
        <div class="nav node hide-on-phone" style="overflow: hidden;max-height: 100%;text-align: center">
            <a class="nav fade" href="{{ route('home') }}" style="max-height: 100%">
                <div style="max-height: 100%;margin-top: -5%">
                    <img src="{{ asset('images/technothlon-nav-logo.png') }}" style="max-width: 150%">
                </div>
            </a>
        </div>
            </div>
        </div>
    <div style="overflow: hidden;text-align: center;display: flex;justify-content: space-between">
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('home') }}">Home</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('about') }}">About</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('technopedia') }}">Technopedia</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('registrations') }}">Registrations</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('led') }}">LED</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('videos') }}">Videos</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('faqs') }}">FAQs</a></div>
        <div class="nav node" style="text-align: center"><a class="nav" href="{{ route('contact') }}">Contact Us</a></div>
        </div>
    </div>
    </div>
    </div>
    <div id="body">
    @yield('body')
    </div>
        <div class="container">
            <div style="clear: both">
    <div class="text" style="text-align: center; color: #999; font-size: 12px; margin:0 auto;">
        <noscript style="line-height: 14px; color: #d03100">If your browser supports JavaScript, then please enable it
            or you can download latest version of <a href="http://www.google.com/chrome" target="_blank">Google
                Chrome</a> or <a href="http://www.mozilla.org/en-US/firefox/all/" target="_blank">Mozilla Firefox</a> .
        </noscript>

        <div style="text-align: center">
            <div style="vertical-align: top; margin-top: 0; margin-right: 4px" class="fb-like"
                 data-href="http://www.facebook.com/technothlon.techniche" data-layout="button_count" data-action="like"
                 data-show-faces="false" data-share="false"></div>
            <div style="text-align: center"><a
                    href="https://twitter.com/TheTechnothlon" class="twitter-follow-button" data-show-count="true"
                    data-size="large"
                    data-show-screen-name="true" data-dnt="true"></a></div>
            <iframe class="btn" frameborder="0" border="0" scrolling="no" allowtransparency="true" height="24"
                    width="160"
                    src="http://platform.tumblr.com/v1/follow_button.html?button_type=1&tumblelog=technothlon&color_scheme=dark"></iframe>
            <div class="g-follow" data-annotation="bubble" data-height="24"
                 data-href="//plus.google.com/100939774615480713285" data-rel="publisher"></div>
            <div data-height="24" class="g-plusone"
                 data-href="https://plus.google.com/+technothlon"></div>
        </div>
        <div style="font-size: 0.7rem; text-align: center">
            <a class="foo" href="{{ route('downloads') }}">Downloads</a> &nbsp;
            <a class="foo" href="{{ route('feedback') }}">Send
                Feedback</a>
        </div>
    </div>
</div> </div>
<script src="{{ asset('js/menu.js') }}" type="text/javascript"></script>   {{--script for drop down menu--}}
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs'));

//    code for drop down menu starts
    $(function () {
        $('nav li ul').hide().removeClass('fallback');
        $('nav li').hover(function () {
            $('ul', this).stop().slideToggle(200);
        });
    });
    //code ends
</script>
<div id="fb-root"></div>
<script type="text/javascript" async="async" src="https://apis.google.com/js/platform.js"></script>        </div>
    </div>
    <div id="footer">
        Technothlon &copy; 2015. All rights reserved    </div>
</div>
</body>
        </html>