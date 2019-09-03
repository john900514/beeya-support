<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta property="og:title" content="Beeya">
    <meta property="og:description" content="Beeya">
    <meta property="og:image" content="{!! env('APP_URL') !!}/img/Hero-BG.jpg">
    <meta property="og:url" content="{!! Request::url() !!}"> -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf

    <title>{!! env('APP_NAME') !!}</title>
    <!-- <link rel="shortcut icon" type="image/png" href="/img/the-blue-faviconz.png"/> -->

    <!-- Fonts -->
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

    <!-- pixels -->

    <!-- end pixels -->
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
