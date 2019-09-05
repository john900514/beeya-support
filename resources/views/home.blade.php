@extends('beeya.global.layouts.beeya')

@section('extra-header-stuff')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.7.16/libphonenumber-js.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        main {
            width: 100%;
            height: 100%;

            display: flex;
            flex-flow: column;
        }

        #bannerSection {
            background-color: lightgrey;
            border-top: 3px solid gray;
            border-bottom: 3px solid gray;
        }

        #mainContentSection {
            width: 100%;
            height: 100%;

            border-bottom: 3px solid gray;
        }

        #innerBanner {
            margin: 3em 5%
        }
        #verbiageSection > h2 {
            color: navy;
        }

        #verbiageSection > p {
            font-size: 1.2em;
            color: gray;
            word-spacing: 0.5em;
            line-height: 2em;
        }

        @media screen and (max-width: 999px) {
            #bannerSection {
                margin-top: 1em;
            }

            #verbiageSection {
                text-align: center;
            }
        }

        @media screen and (min-width: 1000px) {
            #verbiageSection > p {
                width: 50%;
            }

        }
    </style>

    @if(env('APP_ENV') == 'production')
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '563907877293963');
            fbq('track', 'PageView');
            console.log('Facebook pixel tracker enabled.');
            let facebookPixel = true;
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id=563907877293963&ev=PageView&noscript=1"
            />
        </noscript>
        <!-- End Facebook Pixel Code -->

    @else
        <script>
            console.log('Facebook pixel tracker disabled');
            let facebookPixel = false;
        </script>
    @endif
@endsection

@section('content')
<main>
    <div id="bannerSection">
        <div id="innerBanner">
            <div id="verbiageSection">
                <h2>Be it, with Beeya</h2>
                <p>Our world class algorithm learns your job preferences and
                    combs through 11 million jobs to apply for. Get started
                    now by training your algorithm.
                </p>
            </div>
        </div>

    </div>
    <!-- Insert vueJS Component here -->
    <div id="mainContentSection">
        <search-page
            gameid="{!! $game_token !!}"
            gamerounds="{!! $game_rounds !!}"
            reqclicks="{!! $reqd_clicks !!}"
            fb="facebookPixel"
        ></search-page>
    </div>
</main>
@endsection

@section('footscripts')

@endsection
