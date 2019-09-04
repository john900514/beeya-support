@extends('beeya.global.layouts.beeya')

@section('extra-header-stuff')
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
        ></search-page>
    </div>
</main>
@endsection

@section('footscripts')

@endsection
