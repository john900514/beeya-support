<template>
    <div class="results-container">
        <div class="result-inner-container">
            <div class="result-image"></div>
            <div class="result-title">
                <p>{{ title }}</p>
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
</template>

<script>
    export default {
        name: "search-result-component",
        props: ['title','company','loc','url','img','boxno'],
        methods: {
            pickMee() {
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
    .results-container {
        margin: 1em;
        border: 2px solid black;
    }

    .result-inner-container {
        margin: 1em;
    }

    .result-title {
        height: 3em;
    }

    .result-company {
        height: 3em;
    }
</style>
