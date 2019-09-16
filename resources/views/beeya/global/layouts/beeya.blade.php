<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="Beeya">
    <meta property="og:description" content="Try! Beeya FREE | Job Search | Use A.I. to match you with the perfect job today!">
    <meta property="og:image" content="{!! env('APP_URL') !!}/img/favicon.png">
    <meta property="og:url" content="{!! Request::url() !!}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! env('APP_NAME') !!}</title>
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>

    <!-- Fonts -->
    <style>
        @font-face {
            font-family: 'Isidora Alt';
            src: url('/css/IsidoraAlt/Isidora Alt W00 Black It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Black.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Bold It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Bold.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Light It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Medium It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Medium.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 SemiBold It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 SemiBold.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Thin It.otf') format('opentype'),
            url('/css/IsidoraAlt/Isidora Alt W00 Thin.otf') format('opentype');
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <link href="{{ env('APP_URL') }}/css/font-awesome/css/all.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.3/mobile-detect.min.js"></script>

    @include('beeya.global.css.header')

    <style>
        body {
            height: 100%;
            width: 100%;
            margin: 0;
        }

        #app {
            display: flex;
            flex-flow: column;
            font-family: 'Roboto', sans-serif;
        }

    </style>

    <script>
        function importLink(fileName) {
            let head  = document.getElementsByTagName('head')[0];
            let link  = document.createElement('link');

            link.rel  = 'stylesheet';
            link.type = 'text/css';
            link.href = fileName;//';
            head.appendChild(link);
        }

        let md = new MobileDetect(window.navigator.userAgent);

        if(md.phone()) {
            if(md.os() !== 'iOS') {
                console.log('Android/Generic Mode Enabled');
                //importLink('assets/css/cellphone.css')
            } else {
                console.log('iOS Mode Enabled');
                //importLink('assets/css/cellphone.css');
            }
        }
        else if(md.tablet()) {
            console.log('Tablet Mode Enabled');
            //importLink('assets/css/tablet.css');
        }
        else {
            console.log('Default Mode Enabled');
            //importLink('assets/css/desktop.css');
        }
    </script>

    <!-- pixels -->
    @if(env('APP_ENV') == 'production')
        <!-- Hotjar Tracking Code for https://beeya.capeandbay.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:1470342,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

        <script type="text/javascript">
            adroll_adv_id = "TPKESJXCX5HDPCEFV53NSY";
            adroll_pix_id = "FWI2EDL4HJFWFJTZP76UHU";

            (function () {
                var _onload = function(){
                    if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
                    if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
                    var scr = document.createElement("script");
                    var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
                    scr.setAttribute('async', 'true');
                    scr.type = "text/javascript";
                    scr.src = host + "/j/roundtrip.js";
                    ((document.getElementsByTagName('head') || [null])[0] ||
                        document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
                };
                if (window.addEventListener) {window.addEventListener('load', _onload, false);}
                else {window.attachEvent('onload', _onload)}
            }());
        </script>
    @endif
    <!-- end pixels -->

    @yield('extra-header-stuff')
</head>
<body>
<div id="app">
    @include('beeya.global.header')
    <div id="contentWrapper">
        @yield('content')
    </div>
    @include('beeya.global.footer')
    @yield('footscripts')
</div>

</body>
</html>
