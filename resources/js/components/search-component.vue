<template>
    <div id="searchComponentSection">
        <div class="search-input">
            <label>What are you looking for?</label>
            <input type="text" v-model="$parent.jobInput" placeholder="ex. marketing">
        </div>
        <div class="search-input">
            <label>Where are you looking?</label>
            <input type="text" v-model="$parent.jobLocation" placeholder="ex. New York, NY">
        </div>
        <div class="search-ctrl-panel">
            <button type="button" @click="$parent.startNewSearch()">
                <i class="fal fa-search"></i>
                <span>Search</span>
            </button>
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
    @media screen {
        #searchComponentSection {
            display: flex;
            justify-content: center;
        }

        .search-ctrl-panel {
            margin-top: 1.25em;
        }

        .search-ctrl-panel > button {
            width: 10em;
            background-color: #EE7229;
            height: 2.5em;
            border-radius: 0.5em;
            color: #fff;
            font-size: 1.25em;
        }

        .search-ctrl-panel > button:hover {
            background-color: coral;
        }

        .search-input {
            display:flex;
            flex-flow: column;

            margin-bottom: 1.5em;
        }

        .search-input > input {
            margin-top: 0.5em;
            border-radius: 0.25em;
            padding: 0.5em 1em;
            height: 2.5em;
        }
    }

    @media screen and (max-width: 999px){
        #searchComponentSection {
            flex-flow: column;
        }

        .search-ctrl-panel {
            text-align: center;
        }
    }

    @media screen and (min-width: 1000px){
        #searchComponentSection {
            flex-flow: row;
        }

        .search-input, .search-input > label {
            margin-right: 1em;
        }

        .search-input > input {
            width: 30em;
        }
    }
</style>
