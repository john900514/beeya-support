@extends('beeya.global.layouts.beeya')

@section('extra-header-stuff')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.7.16/libphonenumber-js.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @switch($search_mode)
        @case('google')
        <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;libraries=weather,geometry,visualization,places,drawing&amp;key=AIzaSyDkq3oJJjiylINQYBnoG8imBiTR7uN52WQ"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;libraries=weather,geometry,visualization,places,drawing&amp;key={!! env('GOOGLE_MAPS_API_KEY') !!}"></script>
        <script>console.log('Google Search mode enabled...')</script>
        @break

        @default
        <script>console.log('No Search mode selected...')</script>
    @endswitch


    @tablet
        <style>
            @media screen {
                .beeya-font {
                    font-family: 'Isidora Alt', sans-serif;
                }

                .beeya-orange {
                    color: #EE7229 !important;
                }

                main {
                    width: 100%;
                    height: 100%;

                    display: flex;
                    flex-flow: column;
                }

                #bannerSection {
                    border-top: 3px solid transparent;
                    border-bottom: 3px solid transparent;
                }

                #centeredCopy > p {
                    color: gray;
                    font-weight: 400;
                }

                #rulesSection {
                    width: 100%;
                }

                #rulesHeader {
                    color: gray;
                    font-weight: 300;
                }

                .number-circle {
                    border-radius: 50%;
                    width: 1.1em;
                    height: 1.1em;
                    padding: 2px;
                    background: #fff;
                    border: 3px solid #EE7229;
                    text-align: center;
                    font-size: 1.1em;
                    font-weight: 600;
                }

                #rulesActualSegment {
                    width: 100%;
                }

                #mainContentSection {
                    width: 100%;
                    height: 100%;

                    border-top: 3px solid transparent;
                    border-bottom: 3px solid transparent;
                }
            }

            @media screen and (max-width: 999px) {
                #bannerSection {
                    padding-top: 3em;
                }

                #innerBanner {
                    display: grid;
                    grid-template-columns: 50% 50%;
                    grid-template-rows: auto;
                }

                #verbiageSection {
                    display: flex;
                    flex-flow: column;
                }

                .silly-right-margin {
                    margin-right: 15%;
                }

                #bigFrickenLogoWrapper {
                    width: 100%;
                }

                #bigFrickenLogoContainer {
                    width: 100%;
                }

                #bigFrickenLogo {
                    width: 100%;
                    height: auto;
                }

                #centeredCopySegment.silly-right-margin {
                    margin-right: 12.5%;
                }

                #centeredCopyWrapper {
                    margin-left: 27.5%;
                }

                #centeredCopy > p {
                    font-size: 1em;
                    line-height: 1.95em;
                    font-weight: 400;
                }

                #rulesContainer {
                    display: flex;
                    flex-flow: column;
                }

                #rulesActualSegment {
                    width: 100%;
                }

                #rulesHeader {
                    font-size: 1.75em;
                }

                #rulesHeaderWrapper {
                    margin-left: 1em;
                    margin-right: 5%;
                }

                #rulesActualWrapper {
                    margin: 2em 1em;
                }

                #rulesActualContainer {
                    margin-right: 1em;
                }

                .rules-actual-paragraph {
                    height: auto;
                }

                .rule-actual {
                    display: grid;
                    grid-template-columns: 10% 90%;
                    margin: 1em 0 2em 0;
                }

                .rule-actual > p {
                    font-size: 1.35em;
                    line-height: 1.25em;
                    margin: 0 0 0 0.75em;
                }

                #searchComponentSection {
                    display: flex;
                    flex-flow: column;
                }

                .search-wrapper {
                    width: 100%;
                    margin: 0.1em 0;
                }

                .search-input {
                    display:flex;
                    flex-flow: column;
                    margin: 1em 12%;
                }

                .search-input > label {
                    margin-bottom: 0.75em;
                    color: #787878;
                    font-weight: 600;
                    font-size: 1.1em;
                }

                .search-input > label > span {
                    margin-left: 0.5em;
                }

                .search-input > input {
                    border-radius: 0.25em;
                    height: 3em;
                    background-color: #F5F5F5;
                    border-color: transparent;
                    font-size: 1em;
                    padding-left: 1em;
                }

                ::placeholder {
                    color: #909090;
                }


                .search-ctrl-panel {
                    margin-left: 1em;
                    margin-top: 1.9em;
                }

                .search-ctrl-panel > button {
                    width: 12em;
                    background-color: #EE7229;
                    height: 3em;
                    border-radius: 0.25em;
                    color: #fff;
                    font-size: 1.15em;
                    font-weight: 600;
                    text-transform: uppercase;
                }

                .search-ctrl-panel > button > i {
                    font-weight: bold;
                }

                .search-ctrl-panel > button:hover {
                    background-color: coral;
                }
            }

            @media screen and (min-width: 1000px) {
                main {
                    display: grid;
                    grid-template-columns: 15em auto;
                    grid-template-rows: 20em;
                }

                #bannerSection {
                    width: 100%;
                    height: 100%;
                    overflow-x: scroll;
                    border-right: 1px solid gainsboro;
                    border-bottom: 1px solid gainsboro;
                }

                #innerBanner {
                    overflow-x: scroll;
                }

                #verbiageSection {
                    display: flex;
                    flex-flow: column;
                }

                #centeredCopyWrapper {
                    margin-left: 10%;
                    margin-right: 5%;
                }

                #centeredCopy > p {
                    font-size: 0.9em;
                    line-height: 1.5em;
                }

                #rulesSection {
                    width: 100%;
                }

                #rulesSegment {
                    margin: 2em 0 3em 0;
                }

                #rulesWrapper {
                    margin-left: 10%;
                    margin-right: 5%;
                }

                #rulesHeader {
                    font-size: 1.75em;
                }

                .rule-actual {
                    display: grid;
                    grid-template-columns: 15% 85%;
                    margin: 1em 0 2em 0;
                }

                .number-circle {
                    margin-top: 0.25em;
                }

                .rule-actual > p {
                    font-size: 1.15em;
                    line-height: 1.5em;
                    margin: 0 1em;
                }

                #mainContentSection {
                    width: 100%;
                    height: 100%;
                    max-height: 35em;
                    overflow-x: scroll;
                }

                #searchComponentSection {
                    display: flex;
                    flex-flow: column;
                    margin: 0;
                }

                .search-wrapper {
                    width: 100%;
                    margin: 0.1em 0;
                }

                .search-input {
                    display:flex;
                    flex-flow: column;
                    margin: 1em 12%;
                }

                .search-input > label {
                    margin-bottom: 0.75em;
                    color: #787878;
                    font-weight: 600;
                    font-size: 1.1em;
                }

                .search-input > label > span {
                    margin-left: 0.5em;
                }

                .search-input > input {
                    border-radius: 0.25em;
                    height: 3em;
                    background-color: #F5F5F5;
                    border-color: transparent;
                    font-size: 1em;
                    padding-left: 1em;
                }

                ::placeholder {
                    color: #909090;
                }


                .search-ctrl-panel {
                    margin-left: 1em;
                    margin-top: 1.9em;
                    text-align: center;
                }

                .search-ctrl-panel > button {
                    width: 12em;
                    background-color: #EE7229;
                    height: 3em;
                    border-radius: 0.25em;
                    color: #fff;
                    font-size: 1.15em;
                    font-weight: 600;
                    text-transform: uppercase;
                }

                .search-ctrl-panel > button > i {
                    font-weight: bold;
                }

                .search-ctrl-panel > button:hover {
                    background-color: coral;
                }

            }
        </style>
    @elsenottablet
    <style>
        /* Globals */
        @media screen {
            .beeya-font {
                font-family: 'Isidora Alt', sans-serif;
            }

            .beeya-orange {
                color: #EE7229 !important;
            }

            main {
                width: 100%;
                height: 100%;

                display: flex;
                flex-flow: column;
            }

            #bannerSection {
                border-top: 3px solid transparent;
                border-bottom: 3px solid transparent;
            }

            #centeredCopy > p {
                color: gray;
                font-weight: 400;
            }

            #rulesSection {
                width: 100%;
            }

            #rulesHeader {
                color: gray;
                font-weight: 300;
            }

            .number-circle {
                border-radius: 50%;
                width: 1.1em;
                height: 1.1em;
                padding: 2px;
                background: #fff;
                border: 3px solid #EE7229;
                text-align: center;
                font-size: 1.1em;
                font-weight: 600;
            }

            #rulesActualSegment {
                width: 100%;
            }

            #mainContentSection {
                width: 100%;
                height: 100%;

                border-top: 3px solid transparent;
                border-bottom: 3px solid transparent;
            }
        }

        /* Mobiles */
        @media screen and (max-width: 999px) {
            /* Phones */
            @media screen and (max-width: 767px) {
                header {
                    display: none;
                }

                @media screen and (orientation: portrait) {
                    #bannerSection {
                        padding-top: 1em;
                    }

                    #innerBanner {
                        display: flex;
                        flex-flow: column;
                    }

                    #verbiageSection {
                        display: flex;
                        flex-flow: column;

                        text-align: center;
                    }

                    #bigFrickenLogoSegment {
                        width:100%;
                    }

                    #bigFrickenLogoWrapper {
                        margin: 0 25%;
                    }

                    #bigFrickenLogoContainer {
                        width: 100%;
                    }

                    #bigFrickenLogo {
                        width: 100%;
                        height: 100%;
                    }

                    #centeredCopyWrapper {
                        margin: 0 15%;
                    }

                    #centeredCopy > p {
                        font-size: 1.1em;
                        line-height: 1.5em;
                    }

                    #rulesSection {
                        width: 100%;
                    }

                    #rulesSegment {
                        margin: 1em 0 3em 0;
                    }

                    #rulesWrapper {
                        margin: 0 10%
                    }

                    #rulesContainer {
                        display: flex;
                        flex-flow: column;
                    }

                    #rulesHeaderSegment {
                        text-align: center;
                    }

                    #rulesActualSegment {
                        width: 100%;
                    }

                    #rulesActualWrapper {
                        width: 100%;
                    }

                    #rulesActualContainer {
                        text-align: center;
                        margin: 1.5em 0;
                    }

                    .rules-actual-paragraph {
                        margin-bottom: 2em;
                    }

                    .number-circle {
                        margin: 0 auto;
                    }

                    .rule-actual > p {
                        margin-top: 0.5em;
                        font-size: 1.25em;
                        line-height: 1.5em;
                    }
                }

                @media screen and (orientation: landscape) {
                    main {
                        display: grid;
                        grid-template-columns: 35% 65%;
                        grid-template-rows: 20em;
                    }

                    #bannerSection {
                        width: 100%;
                        height: 100%;
                        overflow-x: scroll;
                        border-right: 1px solid gainsboro;
                        border-bottom: 1px solid gainsboro;
                    }

                    #innerBanner {
                        display: flex;
                        flex-flow: column;
                    }

                    #verbiageSection {
                        display: flex;
                        flex-flow: column;
                    }

                    #centeredCopyWrapper {
                        margin-left: 10%;
                        margin-right: 5%;
                    }

                    #centeredCopy > p {
                        font-size: 0.75em;
                        line-height: 1.5em;
                    }

                    #rulesSection {
                        width: 100%;
                    }

                    #rulesSegment {
                        margin: 2em 0;
                    }

                    #rulesWrapper {
                        margin-left: 10%;
                        margin-right: 5%;
                    }

                    #rulesHeader {
                        font-size: 1.75em;
                    }

                    .rule-actual {
                        display: grid;
                        grid-template-columns: 15% 85%;
                        margin: 1em 0 2em 0;
                    }

                    .number-circle {
                        margin-top: 0.25em;
                    }

                    .rule-actual > p {
                        font-size: 1em;
                        line-height: 1.5em;
                        margin: 0 1em;
                    }

                    #mainContentSection {
                        width: 100%;
                        height: 100%;
                        overflow-x: scroll;
                        border-bottom: 1px solid gainsboro;
                    }
                }
            }

            /* Tablets */
            @media screen and (min-width: 768px) {
                @media screen and (orientation: portrait) {
                    #bannerSection {
                        padding-top: 3em;
                    }

                    #innerBanner {
                        display: grid;
                        grid-template-columns: 50% 50%;
                        grid-template-rows: auto;
                    }

                    #verbiageSection {
                        display: flex;
                        flex-flow: column;
                    }

                    .silly-right-margin {
                        margin-right: 15%;
                    }

                    #bigFrickenLogoWrapper {
                        width: 100%;
                    }

                    #bigFrickenLogoContainer {
                        width: 100%;
                    }

                    #bigFrickenLogo {
                        width: 100%;
                        height: auto;
                    }

                    #centeredCopySegment.silly-right-margin {
                        margin-right: 12.5%;
                    }

                    #centeredCopyWrapper {
                        margin-left: 27.5%;
                    }

                    #centeredCopy > p {
                        font-size: 1em;
                        line-height: 1.95em;
                        font-weight: 400;
                    }

                    #rulesContainer {
                        display: flex;
                        flex-flow: column;
                    }

                    #rulesActualSegment {
                        width: 100%;
                    }

                    #rulesHeader {
                        font-size: 1.75em;
                    }

                    #rulesHeaderWrapper {
                        margin-left: 1em;
                        margin-right: 5%;
                    }

                    #rulesActualWrapper {
                        margin: 2em 1em;
                    }

                    #rulesActualContainer {
                        margin-right: 1em;
                    }

                    .rules-actual-paragraph {
                        height: auto;
                    }

                    .rule-actual {
                        display: grid;
                        grid-template-columns: 10% 90%;
                        margin: 1em 0 2em 0;
                    }

                    .rule-actual > p {
                        font-size: 1.35em;
                        line-height: 1.25em;
                        margin: 0 0 0 0.75em;
                    }
                }

                @media screen and (orientation: landscape) {
                    main {
                        display: grid;
                        grid-template-columns: 30% 70%;
                        grid-template-rows: 31em;
                    }

                    #bannerSection {
                        width: 100%;
                        height: 100%;
                        overflow-x: scroll;

                        border-right: 1px solid gainsboro;
                        border-bottom: 1px solid gainsboro;
                    }

                    #innerBanner {
                        overflow-x: scroll;
                    }

                    #verbiageSection {
                        display: flex;
                        flex-flow: column;
                    }

                    #centeredCopyWrapper {
                        margin-left: 10%;
                        margin-right: 5%;
                    }

                    #centeredCopy > p {
                        font-size: 0.9em;
                        line-height: 1.5em;
                    }

                    #rulesSection {
                        width: 100%;
                    }

                    #rulesSegment {
                        margin: 2em 0 3em 0;
                    }

                    #rulesWrapper {
                        margin-left: 10%;
                        margin-right: 5%;
                    }

                    #rulesHeader {
                        font-size: 1.75em;
                    }

                    .rule-actual {
                        display: grid;
                        grid-template-columns: 15% 85%;
                        margin: 1em 0 2em 0;
                    }

                    .number-circle {
                        margin-top: 0.25em;
                    }

                    .rule-actual > p {
                        font-size: 1.15em;
                        line-height: 1.5em;
                        margin: 0 1em;
                    }

                    #mainContentSection {
                        width: 100%;
                        height: 100%;
                        overflow-x: scroll;
                        border-bottom: 1px solid gainsboro;
                    }
                }
            }
        }

        /* Desktops/Large Screens */
        @media screen and (min-width: 1000px) {
            #bannerSection {
                padding-top: 5.25em;
            }

            #innerBanner {
                display: grid;
                grid-template-columns: 42.5% 57.5%;
                grid-template-rows: auto;
            }

            #verbiageSection {
                display: flex;
                flex-flow: column;
            }

            .silly-right-margin {
                margin-right: 15%;
            }

            #bigFrickenLogoWrapper {
                width: 100%;
            }

            #bigFrickenLogoContainer {
                width: 100%;
            }

            #bigFrickenLogo {
                width: 100%;
                height: auto;
            }

            #centeredCopyWrapper {
                margin-left: 27.5%;
            }

            #centeredCopy > p {
                font-weight: 400;
                font-size: 1.12em;
                line-height: 1.75em;

            }

            #rulesContainer {
                display: flex;
                flex-flow: column;
            }

            #rulesActualSegment {
                width: 100%;
            }

            #rulesHeader {
                font-size: 2.525em;
            }

            #rulesHeaderWrapper {
                margin-left: 1.75em;
                margin-right: 25%;
            }

            #rulesActualWrapper {
                margin: 0em 2em 3em 2em;
            }

            #rulesActualContainer {
                margin-right: 5.5em;
                margin-top: 2em;
            }

            .rules-actual-paragraph {
                height: auto;
            }

            .rule-actual {
                display: grid;
                grid-template-columns: 7.5% 92.5%;
                margin: 1em 0 2em 0;
            }

            .number-circle {
                margin-top: 0.25em;
            }

            .rule-actual > p {
                font-size: 1.4em;
                line-height: 1.5em;
                margin: 0;
            }
        }
        @media screen and (min-width: 1000px) {
            #searchComponentSection {
                display: grid;
                grid-template-columns: 42.5% 57.5%;
                grid-template-rows: auto;
            }

            .search-wrapper {
                width: 100%;
                margin: 0.1em 0;
            }

            .without-button .search-box {
                margin-left: 22.5%;
                margin-bottom: 1.5em;
                margin-top: 0.5em;
            }

            .with-button .search-box {
                display: flex;
                flex-flow: row;
                margin: 0.5em 16.5% 2.5% 2.5%;
            }

            .search-input {
                display:flex;
                flex-flow: column;
                width: 100%;
            }

            .search-input > label {
                margin-bottom: 0.75em;
                color: #787878;
                font-weight: 600;
                font-size: 1.1em;
            }

            .search-input > label > span {
                margin-left: 0.5em;
            }

            .search-input > input {
                border-radius: 0.25em;
                height: 3em;
                background-color: #F5F5F5;
                border-color: transparent;
                font-size: 1em;
                padding-left: 1em;
            }

            ::placeholder {
                color: #909090;
            }


            .search-ctrl-panel {
                margin-left: 1em;
                margin-top: 1.9em;
            }

            .search-ctrl-panel > button {
                width: 12em;
                background-color: #EE7229;
                height: 3em;
                border-radius: 0.25em;
                color: #fff;
                font-size: 1.15em;
                font-weight: 600;
                text-transform: uppercase;
            }

            .search-ctrl-panel > button > i {
                font-weight: bold;
            }

            .search-ctrl-panel > button:hover {
                background-color: coral;
            }
        }
    </style>
    @endtablet


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
                <div id="bigFrickenLogoSegment" class="silly-right-margin">
                    <div id="bigFrickenLogoWrapper">
                        <div id="bigFrickenLogoContainer">
                            <div class="img-box">
                                <img id="bigFrickenLogo" src="https://beeya-web-assets.s3.amazonaws.com/Beeya-Logo.png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div id="centeredCopySegment" class="silly-right-margin">
                    <div id="centeredCopyWrapper">
                        <div id="centeredCopy">
                            <p>Beeya is the only job search site that uses AI
                                (Artificial Intelligence) to match you with
                                jobs that you have the best chance at
                                landing, <b>for free</b>. Our world class algorithm
                                learns your job preferences and combs through
                                11 million jobs to apply for.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="rulesSection">
                <div id="rulesSegment">
                    <div id="rulesWrapper">
                        <div id="rulesContainer">
                            <div id="rulesHeaderSegment">
                                <div id="rulesHeaderWrapper">
                                    <h1 id="rulesHeader">Get started now by training your algorithm.</h1>
                                </div>
                            </div>

                            <div id="rulesActualSegment">
                                <div id="rulesActualWrapper">
                                    <div id="rulesActualContainer">
                                        <div class="rules-actual-paragraph">
                                            <span class="rule-actual beeya-orange">
                                                <div class="number-circle">1</div>
                                                <p><b>Search for the job you want.</b></p>
                                            </span>
                                        </div>

                                        <div class="rules-actual-paragraph">
                                            <span class="rule-actual beeya-orange">
                                                <div class="number-circle">2</div>
                                                <p><b>Apply to the jobs you like and our AI will learn your job
                                                    preferences and show you {!! env('MAX_PAGE_RESULTS', 10) !!}
                                                    more jobs.</b>
                                                </p>
                                            </span>
                                        </div>

                                        <div class="rules-actual-paragraph">
                                            <span class="rule-actual beeya-orange">
                                                <div class="number-circle">3</div>
                                                <p><b>Repeat. Beeya is free forever for job searchers.</b></p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Insert vueJS Component here -->
    <div id="mainContentSection">
        <search-page
            gameid="{!! $game_token !!}"
            gamerounds="{!! $game_rounds !!}"
            reqclicks="{!! $reqd_clicks !!}"
            searchmode="{!! $search_mode !!}"
        ></search-page>
    </div>
</main>
@endsection

@section('footscripts')

@endsection
