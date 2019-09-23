<template>
    <div id="searchComponentSection">
        <div class="search-segment">
            <div class="search-wrapper without-button">
                <div class="search-box">
                    <div class="search-input">
                        <label><i class="far fa-briefcase"></i><span><b>What are you looking for?</b></span></label>
                        <input type="text" v-model="$parent.jobInput" placeholder="ex. Marketing" :disabled="$parent.showResults === true">
                    </div>
                </div>
            </div>
        </div>
        <div class="search-segment">
            <div class="search-wrapper with-button">
                <div class="search-box">
                    <div class="search-input">
                        <label><i class="far fa-map-marker-alt"></i><span><b>Where?</b></span></label>
                        <input v-if="searchmode === 'google'" id="searchInput" type="text" v-model="$parent.jobLocation" placeholder="ex. New York, NY" :disabled="$parent.showResults === true">
                        <input v-else id="searchBoxInput" @input="getAutoFillContents" type="text" v-model="$parent.jobLocation" placeholder="ex. New York, NY" :disabled="$parent.showResults === true">
                        <ul v-show="showAutoFill"class="autocomplete-results">
                            <li v-for="(result, i) in results"
                                :key="i"
                                @click="updateInput(result);showAutoFill=false;"
                                class="autocomplete-result">
                                {{ result }}
                            </li>
                        </ul>
                    </div>
                    <div class="search-ctrl-panel">
                        <button type="button" @click="($parent.showResults === true) ? reload() : $parent.startNewSearch()">
                            <i class="fal fa-search"></i>
                            <span>Search {{($parent.showResults === true) ? 'Again?' : '' }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "search-component",
        props: ['searchmode'],
        data() {
            return {
                autoc: '',
                showAutoFill: false,
                results: []
            };

        },
        methods: {
            reload() {
                window.location.reload();
            },
            loadSearchEngine() {
                switch (this.searchmode) {
                    case 'google':
                        let _this = this;
                        let input = document.getElementById('searchInput');
                        this.autoc = new google.maps.places.Autocomplete(input);
                        google.maps.event.addListener(this.autoc, 'place_changed', function() {
                            let place = _this.autoc.getPlace();
                            _this.updateInput(place.name);

                            // derive the lat and long and send to $parent
                            if(place.geometry) {
                                let lat = parseFloat(place.geometry.location.lat()).toFixed(2);
                                console.log('Latitude - ', lat);
                                _this.$parent.locLat = lat;
                                let long = parseFloat(place.geometry.location.lng()).toFixed(2);
                                console.log('Longitude - ', long);
                                _this.$parent.locLong = long;
                            }
                            else {
                                console.log('Could not derive geo-coordinates')
                            }
                        });



                        break;

                    default:
                        console.log('No need to load search engines.')
                }
            },
            updateInput(place) {
                    console.log('Updating parent to - '+ place);
                    this.$parent.jobLocation = place;
            },
            getAutoFillContents() {
                let _this = this;
                let strang = 'l='+this.$parent.jobLocation;
                $.ajax({
                    url: 'api/search?'+strang,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if('success' in data && data.success === true) {
                            _this.showAutoFill = true;
                            _this.filterResults(data['places'])
                        }
                        else {
                            console.log('autocomplete failed...', data);
                        }
                    },
                    error: function(e) {
                        console.log('autocomplete errr...', e);
                    }
                });
            },
            filterResults(items) {
                let userInput = this.$parent.jobLocation.toLowerCase();
                if(userInput === '') {
                    this.results = [];
                    this.showAutoFill = false;
                }
                else {
                    let res = items.filter(function(item) {
                        let curItem = item.toLowerCase();
                        let res = curItem.indexOf(userInput) > -1;
                        if(res) return  item;
                        console.log('results - ', res);
                    });

                    this.results = res;
                }
            }
        },
        mounted() {
            switch (this.searchmode) {
                case 'google':
                    google.maps.event.addDomListener(window, 'load', this.loadSearchEngine);
                    break;

                default:
                    console.log('No need to load search engines.')
            }

            console.log(this.searchmode + ' Search Component Mounted')
        }
    }
</script>

<style scoped>
    /* Globals */
    @media screen {
        .autocomplete {
            position: relative;
            width: 130px;
        }

        .autocomplete-results {
            padding: 0;
            margin: 0;
            border: 1px solid #eeeeee;
            height: 120px;
            overflow: auto;
        }

        .autocomplete-result {
            list-style: none;
            text-align: left;
            padding: 4px 2px;
            cursor: pointer;
        }

        .autocomplete-result:hover {
            background-color: #4AAE9B;
            color: white;
        }
    }

    /* Mobiles */
    @media screen and (max-width: 999px) {
        #searchComponentSection {
            flex-flow: column;
        }

        .search-ctrl-panel {
            text-align: center;
        }

        /* Phones */
        @media screen and (max-width: 767px) {
            @media screen and (orientation: portrait) {
                #searchComponentSection {
                    display: flex;
                    flex-flow: column;
                    margin-bottom: 4em;
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

            @media screen and (orientation: landscape) {
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
        }

        /* Tablets */
        @media screen and (min-width: 768px) {
            @media screen and (orientation: portrait) {
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

            @media screen and (orientation: landscape) {
                #searchComponentSection {
                    display: flex;
                    flex-flow: column;
                    margin: 4em 0;
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
        }
    }
    /* Desktops/Large Screens located in home blade due to tablet incompatibility*/


</style>
