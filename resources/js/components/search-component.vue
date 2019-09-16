<template>
    <div id="searchComponentSection">
        <div class="search-segment">
            <div class="search-wrapper without-button">
                <div class="search-box">
                    <div class="search-input">
                        <label><i class="far fa-briefcase"></i><span><b>What are you looking for?</b></span></label>
                        <input type="text" v-model="$parent.jobInput" placeholder="ex. Marketing">
                    </div>
                </div>
            </div>
        </div>
        <div class="search-segment">
            <div class="search-wrapper with-button">
                <div class="search-box">
                    <div class="search-input">
                        <label><i class="far fa-map-marker-alt"></i><span><b>Where?</b></span></label>
                        <input type="text" v-model="$parent.jobLocation" placeholder="ex. New York, NY">
                    </div>
                    <div class="search-ctrl-panel">
                        <button type="button" @click="$parent.startNewSearch()" :disabled="$parent.showResults === true" :style="($parent.showResults === true) ? 'background-color:gray;' : ''">
                            <i class="fal fa-search"></i>
                            <span>Search</span>
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
        data() {
            return {

            };

        },
        methods: {

        },
        mounted() {
            console.log('Search Component Mounted')
        }
    }
</script>

<style scoped>
    /* Globals */
    @media screen {

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
