<template>
    <div class="results-container">
        <div class="result-inner-container">
            <div class="results-wrap">
                <div class="result-image">
                    <img src="/img/favicon.png" />
                </div>
                <div class="result-title">
                    <p><b>{{ title }}</b></p>
                </div>
                <div class="result-company">
                    <p>{{ company }}</p>
                </div>
                <div class="result-location">
                    <p>{{ loc }}</p>
                </div>
                <div class="result-learn-more">
                    <a :href="url" target="_blank" @click="pickMee()">LEARN MORE</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "search-result-component",
        props: ['title','company','loc','url','img','boxno'],
        methods: {
            pickMee() {
                console.log('Updating clicks.');
                this.$parent.clickedPos = this.boxno;
                this.$parent.updateClicks();
            }
        },
        mounted() {
            console.log('A Search Result Block was mounted -'+ this.title);
        }
    }
</script>

<style scoped>
    p {
        margin-block-end: 0.5em;
        margin-block-start: 0.5em;
    }

    .results-container {
        margin: 1em;
        border: 0.5px solid transparent;
        box-shadow: 1px 1px 10px 1px #ccc;
        border-radius: 0.5em;
    }

    .result-inner-container {
        border-radius: 0.5em;
        height: 16.5em;
    }

    .results-wrap {
        margin: 0.75em;
        position: relative;
        display: flex;
        flex-flow: column;
    }

    .result-title {
        height: 3.0em;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 70%;
    }

    .result-company {
        height: 3.0em;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 75%;
    }

    .result-location {
        color:lightgray;
    }

    .result-learn-more {
        bottom: -25%;
        position: absolute;
        left: 55%;
    }

    .result-learn-more > a {
        color: #EE7229;
        text-decoration: none;
        font-weight: bold;
    }

    .result-learn-more > a:hover {
        color: coral;
    }
</style>
