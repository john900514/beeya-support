<template>
    <div class="template-wrapper">
        <div id="searchWrapper">
            <search-component
                :searchmode="searchmode"
            ></search-component>
        </div>

        <div id="searchResultsWrapper" v-show="toggleSearchResults">
            <div class="counter-wrapper">
                <p>{{ resultsVerbiage }}</p>
            </div>

            <div class="results-section" v-for="(results, page) in searchResults">
                <div class="result-box" v-for="(result, idx) in results">
                    <search-result-component
                        :title="result.jobTitle"
                        :company="result.company"
                        :loc="result.location"
                        :url="result.jobUrl"
                        :boxno="idx"
                    ></search-result-component>
                </div>
            </div>

            <div class="result-ctrl-panel">
                <div class="ctrl-inner-wrap">
                    <div class="counter-wrapper"></div>

                    <div id="getMoreBtnWrap">
                        <button id="getMoreBtn" type="button" @click="startNextRound()">Get More Listings</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="leadFormWrapper" v-show="gameOver">
            <div id="innerFormWrap">
                <div id="formTop">
                    <h2>{{ gameOverText }}</h2>
                    <p>Sign up to Receive More Tailored Jobs Each Day!</p>
                </div>

                <div id="formContent">
                    <lead-form
                        :sessionid="gameid"
                    ></lead-form>
                </div>

                <div id="formBottom">
                    <div id="formCtrlPanel">
                        <div class="page-reload-button-wrap">
                            <button type="button" id="pageReloadBtn" onclick="location.reload()">
                                <i class="fas fa-redo-alt"></i>
                                <span>Search Again?</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    // Init plugin
    Vue.use(Loading);

    export default {
        name: "search-page",
        props: ['gameid','gamerounds','reqclicks', 'searchmode'],
        watch: {
            clicks(num) {
                console.log('Total clicks this round -'+ num);
                console.log('Needed clicks left - '+ parseInt(this.neededClicks - num));
            },
            loading(flag) {
                this.toggleLoader(flag);
            },
            toggleSearchResults(flag) {
                if(flag) {
                    setTimeout(function () {
                        console.log('Gonna try to scroll');
                        if(md.phone()) {
                            $('body').animate({ scrollTop: 500 }, 1500)
                        }
                        else if(md.tablet()) {
                            $('#mainContentSection').animate({ scrollTop: 500 }, 1500)
                            //importLink('assets/css/tablet.css');
                        }
                        else {
                            $('html').animate({ scrollTop: 750 }, 1500)
                        }


                    }, 500);
                }
            },
            jobLocation(loc) {
                if(this.searchmode === 'google') {
                    let _this = this;
                    let service = new google.maps.places.AutocompleteService();
                    service.getQueryPredictions({ input: loc }, function(predictions, status) {
                        if (status != google.maps.places.PlacesServiceStatus.OK) {
                            console.log(status);
                            return;
                        }

                        let results = [];

                        predictions.forEach(function(prediction) {
                            results.push(prediction);
                        });

                        _this.storeSearchResults(results);
                    });
                }
            },
        },
        data() {
            return {
                fb: false,
                loading: false,
                loader: '',
                searchResults: [],
                jobInput: '',
                jobLocation: '',
                locLat: '',
                locLong: '',
                totalRecords: 0,
                recordsRetrieved: 0,
                page: 1,
                round: 1,
                reqRounds: 1,
                showResults: false,
                showMoreResultsBtn: false,
                clicks: 0,
                resultText: '',
                clickedPos: '',
                gameOver: false,
                neededClicks: 0,
                gameOverText: 'Congratulations! You\'ve Unlocked Additional Functionality.',
            };
        },
        computed: {
            getMoreResults() {
                // if there are still rounds left AND we have met or exceeeded the min clicks
                if((this.round < parseInt(this.gamerounds)) && (this.clicks >= parseInt(this.reqclicks))) {
                    // if this is a shortened click round due to lack of results.
                    if(parseInt(this.neededClicks) < parseInt(this.reqclicks)) {
                        let _this = this;
                        $('#searchResultsWrapper').fadeOut(function () {
                            _this.gameOverText = 'Bummer, we ran out of results too early. Try Again?';
                            _this.gameOver = true;
                        });
                    }
                    else {

                        return true;
                    }
                }
                else {
                    if((this.round === parseInt(this.gamerounds)) && (this.clicks === parseInt(this.neededClicks))) {
                        let _this = this;
                        $('#searchResultsWrapper').fadeOut(function () {
                            _this.gameOver = true;
                        });
                    }
                }

                return false;
            },
            getRecNum() {
                return this.recordsRetrieved;
            },
            resultsVerbiage() {
                let results = '';
                switch(this.round) {
                    case 1:
                        results = 'Choosing at least '+ this.neededClicks +' jobs will train your algorithm and allow us to show you more jobs instantly!';
                        break;

                    case 3:
                        results = 'Choose at least '+ this.neededClicks +' more jobs! See anything you like?';
                        break;

                    default:
                        results = 'Now displaying '+ this.getRecNum +' more jobs! If you like them all, choose them all!';
                }

                return  results;
            },
            toggleSearchResults() {
                let res = ((this.gameOver === false) && this.totalRecords > 0);

                return res;

            }
        },
        methods: {
            startNewSearch() {
                if(this.jobInput !== '')
                {
                    if(this.jobLocation !== '')
                    {
                        this.searchResults = [];
                        this.totalRecords = 0;
                        this.recordsRetrieved = 0;
                        this.page = 1;
                        this.neededClicks = this.reqclicks;


                        if(this.fb !== false) {
                            console.log('Fb Search go!');
                            fbq('track', 'Search');
                        }

                        this.getSearchResults();
                    }
                    else {
                        alert('Where do you want to work?')
                    }
                }
                else {
                    alert('What kind of job are you looking for?')
                }
            },
            startNextRound() {
                if((this.round < parseInt(this.gamerounds))) {
                    let prompt = "Are you sure? There's still lots of great results to choose from!";
                    let choice = false;

                    if((this.round < parseInt(this.gamerounds)) && (this.clicks >= parseInt(this.neededClicks))) {
                        choice = true;
                    }
                    else {
                        choice = confirm(prompt);
                    }

                    if(choice === true) {
                        if(this.clicks < this.neededClicks) {
                            this.clicks = this.neededClicks
                        }

                        if(this.getMoreResults === true) {
                            this.clicks = 0;
                            this.neededClicks = this.reqclicks;
                            // this.searchResults = [];
                            this.recordsRetrieved = 0;
                            this.round++;
                            this.getSearchResults();
                        }
                    }
                }
                else {
                    let _this = this;
                    $('#searchResultsWrapper').fadeOut(function () {
                        _this.gameOver = true;
                    });
                }
            },
            setResults(results) {
                if(results !== null) {
                    this.searchResults.push(results);
                    console.log('Returned results - ' + results.length);

                    if(results.length < this.reqclicks) {
                        // The amount of results that came back from Beeya are less than the default required amount.
                        console.log('Setting required clicks this round to ' + results.length);
                        this.neededClicks = results.length;
                    }
                }
                else {
                    if(this.round === 1) {
                        alert('No results. Try again?');
                        this.showResults = false;
                        this.loading = false;
                    }
                    else {
                        this.loading = false;
                        this.gameOverText = 'Oh no! We ran out of results...';
                        let _this = this;
                        $('#searchResultsWrapper').fadeOut(function () {
                            _this.gameOver = true;
                        });
                    }

                }

            },
            getSearchResults() {
                let _this = this;
                this.showResults = false;
                this.loading = true;

                let data = {
                    jobTitle: _this.jobInput,
                    jobLocation: _this.jobLocation,
                    page: _this.page
                };

                // Writing it this way makes this logic module-independent
                if(this.locLat !== '' && this.locLong !== '') {
                    console.log('passing coordinates along too!');
                    data = {
                        jobTitle: _this.jobInput,
                        jobLocation: _this.jobLocation,
                        page: _this.page,
                        lat: _this.locLat,
                        long: _this.locLong
                    };
                }

                $.ajax({
                    url: 'api/beeya/results',
                    method: 'POST',
                    dataType: 'json',
                    data: data,
                    success(data) {
                        if('success' in data)
                        {
                            if(data['success']) {
                                _this.page++;

                                _this.showResults = true;
                                _this.loading = false;
                                _this.setResults(data['results']['records']);
                                if(Array.isArray(data['results']['records'])) {
                                    _this.recordsRetrieved = _this.recordsRetrieved + data['results']['records'].length;
                                }
                                _this.totalRecords = data['results']['total'];
                            }
                            else {
                                alert(data['reason']);

                                if(_this.round === 1) {
                                    _this.showResults = false;
                                    _this.loading = false;
                                }
                            }
                        }
                        else
                        {
                            console.log('User error',data);
                            alert('Something weird happened. Try again?');
                            _this.loading = false;
                        }
                    },
                    error(e) {
                        alert('Ooops something happened. Try again in a sec.');
                        console.log('Server error', e);
                        _this.loading = false;
                    }
                });
            },
            storeSearchResults(data) {
                $.ajax({
                    url: 'api/place-results',
                    method: 'POST',
                    dataType: 'json',
                    data: {places: data}
                });
            },
            updateClicks() {
                this.clicks++;

                if(this.fb !== false) {
                    console.log('Fb click go!');
                    fbq('track', 'SubmitApplication');
                }

                this.nowReallyUpdateClicks();
            },
            nowReallyUpdateClicks() {
                let _this = this;
                let job = this.searchResults[0][this.clickedPos];

                let data = {
                    round: this.round,
                    clickNo: this.clicks,
                    gameid: this.gameid,
                    job: this.jobInput,
                    location: this.jobLocation,
                    totalRecords: this.totalRecords,
                    device: null,
                    clickData: {
                        sessionId: this.gameid,
                        position: this.clickedPos,
                        clickNo: this.clicks,
                        sourceJobId: job.sourceJobId,
                        jobName: job.jobName,
                        company: job.company,
                        jobTitle: job.jobTitle,
                        agency: job.agencyCode,
                        round: this.round,
                    }
                };

                $.ajax({
                    url: '/api/clicks',
                    method: 'POST',
                    dataType: 'json',
                    data: data,
                    success(data) {
                        console.log(data);
                    },
                    error(e) {
                        console.log(e);
                    }
                });
            },
            toggleLoader(flag) {
                if(flag) {
                    let _this = this;
                    this.loader = this.$loading.show({
                        // Optional parameters
                        container: this.$refs.formContainer,
                        canCancel: false,
                        onCancel: this.onCancel,
                        loader: 'dots',
                        width: 175,
                        height: 150,
                        color: '#EE7229'
                    });
                }
                else {
                    this.loader.hide();
                    this.loading = false
                }
            },
        },
        mounted() {
            console.log('Game ID - '+ this.gameid);

            this.neededClicks = this.reqclicks;
            console.log('This game requires the user to make '+this.reqclicks+' click(s) for '+this.gamerounds+' rounds.');

            console.log('Fb Status ', facebookPixel);
            if(facebookPixel) {
                this.fb = facebookPixel;
            }
            console.log('Search Page Mounted.')
        }
    }
</script>

<style scoped>
    /* Globals */
    @media screen {
        .results-section {
            display: flex;
            flex-flow: row wrap;
            margin: 2em 1em 3em 1em;
        }

        .result-box {
            height: 19.5em;
        }

        .result-ctrl-panel {
            margin: 2em 10%;
            text-align: center;
        }

        .counter-wrapper {
            text-align: center;
        }

        #getMoreBtn {
            width: 10em;
            background-color: #EE7229;
        }

        #getMoreBtn {
            width: 10em;
            background-color: #EE7229;
            height: 3em;
            border-radius: 0.5em;
            color: #fff;
            font-size: 1.25em;
        }

        #getMoreBtn {
            background-color: coral;
        }

        #leadFormWrapper {
            width: 100%;
        }

        #innerFormWrap {
            display: flex;
            flex-flow: column;
            text-align: center;
            border: 5px solid #EE7229;
            border-radius: 0.5em;
            padding: 2em;
        }

        #formTop > h2 {
            text-transform: uppercase;
        }

        #pageReloadBtn {
            width: 10em;
            background-color: #EE7229;
            height: 2.5em;
            border-radius: 0.5em;
            color: #fff;
            font-size: 1.25em;
        }

        #pageReloadBtn:hover {
            background-color: coral;
        }
    }

    /* Mobiles */
    @media screen and (max-width: 999px) {
        /* Special PITAs */
        @media screen and (max-width: 549px) {
            .result-box {
                width: 100%;
            }

            #innerFormWrap {
                margin: 2em 5%;
            }
        }

        @media screen and (min-width: 550px) {
            .result-box {
                width: 50%;
            }

            #innerFormWrap {
                margin: 2em 10%;
            }
        }

        /* Phones */
        @media screen and (max-width: 767px) {
            @media screen and (orientation: portrait) {

            }

            @media screen and (orientation: landscape) {

            }
        }

        /* Tablets */
        @media screen and (min-width: 768px) {
            @media screen and (orientation: portrait) {

            }

            @media screen and (orientation: landscape) {

            }
        }
    }
    /* Desktops/Large Screens */
    @media screen and (min-width: 1000px) {
        .result-box {
            width: 25%;
        }

        #innerFormWrap {
            margin: 2em 17%;
        }
    }



</style>
