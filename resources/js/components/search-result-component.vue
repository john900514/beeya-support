<template>
    <div class="results-container">
        <a class="result-link" :href="url" target="_blank" @click="pickMee()">
            <div class="result-inner-container">
                <div class="results-wrap">
                    <div class="result-image">
                        <img src="/img/favicon.png" hidden/>
                        <div class="partner-job-banner">
                            <p>PARTNER JOBS</p>
                        </div>
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
        </a>
    </div>
</template>

<script>
    export default {
        name: "search-result-component",
        props: ['title','company','loc','url','img','boxno'],
        methods: {
            pickThis() {
                $('.result-learn-more').click();
            },
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
    .result-link {
        text-decoration: none;
    }

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

    .result-image {
        display: grid;
        grid-template-rows: 1fr;
        grid-template-columns: 50% 50%;
    }

    .result-title {
        color: black;
        height: 3.0em;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 70%;
    }

    .result-company {
        color: black;
        height: 3.0em;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 75%;
    }

    .result-location {
        color:gray;
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

    .partner-job-banner {
        grid-column: 2;
    }

    .partner-job-banner > p {

        background-color: #EE7229;
        padding: 0.35em 0 0.35em 1em;
        width: 100%;
        color: #fff;
        font-weight: 600;
        border-top-left-radius: .25em;
        border-bottom-left-radius: .25em;
        box-shadow: 0 1px 2px 0.5px peachpuff;
    }

    @media screen and (max-width: 768px) {
        .result-learn-more {
            bottom: -15%;
            position: absolute;
            left: 59%;
        }
    }
</style>
