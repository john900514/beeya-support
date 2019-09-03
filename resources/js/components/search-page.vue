<template>
    <div class="template-wrapper">
        <div id="searchWrapper">
            <search-component></search-component>
        </div>
        <div id="searchResultsWrapper" v-show="totalRecords > 0">
            <div class="counter-wrapper">
                <p>Now displaying {{ recordsRetrieved }} jobs out of {{ totalRecords }}</p>
            </div>

            <div class="results-section" v-for="(results, page) in searchResults">
                <div class="result-box" v-for="(result, idx) in results">
                    <search-result-component
                        :title="result.jobTitle"
                        :company="result.company"
                        :loc="result.location"
                        :url="result.jobUrl"
                    ></search-result-component>
                </div>
            </div>

            <div v-if="totalRecords > recordsRetrieved" class="result-ctrl-panel">
                <div class="ctrl-inner-wrap">
                    <div class="counter-wrapper">
                        <p>Now displaying {{ recordsRetrieved }} jobs out of {{ totalRecords }}</p>
                    </div>

                    <div id="getMoreBtnWrap">
                        <button id="getMoreBtn" type="button" @click="getSearchResults()">Get More Listings</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "search-page",
        data() {
            return {
                searchResults: [],
                jobInput: '',
                jobLocation: '',
                totalRecords: 0,
                recordsRetrieved: 0,
                page: 1
            };
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
            setResults(results) {
                this.searchResults.push(results);
                console.log('Returned results - ' + results.length);
            },
            getSearchResults() {
                let _this = this;

                let data = {
                    jobTitle: _this.jobInput,
                    jobLocation: _this.jobLocation,
                    page: _this.page
                };

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
                                _this.setResults(data['results']['records']);
                                _this.recordsRetrieved = _this.recordsRetrieved + data['results']['records'].length;
                                _this.totalRecords = data['results']['total'];

                            }
                            else {
                                alert(data['reason']);
                            }
                        }
                        else
                        {
                            console.log('User error',data);
                            alert('Something weird happened. Try again?');
                        }
                    },
                    error(e) {
                        alert('Ooops something happened. Try again in a sec.');
                        console.log('Server error', e);
                    }
                });
            }
        },
        mounted() {
            console.log('Search Page Mounted.')
        }
    }
</script>

<style scoped>
    @media screen {
        .template-wrapper {
            margin: 0 3em;
        }

        #searchWrapper {
            margin: 2em 1em;
        }

        .results-section {
            display: flex;
            flex-flow: row wrap;
            margin: 2em 1em 3em 1em;
        }

        .result-box {
            height: 17.5em;
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
    }

    @media screen and (max-width: 999px) {
        @media screen and (max-width: 549px) {
            .result-box {
                width: 100%;
            }
        }

        @media screen and (min-width: 550px) {
            .result-box {
                width: 50%;
            }
        }

    }

    @media screen and (min-width: 1000px) {
        .result-box {
            width: 25%;
        }
    }



</style>
