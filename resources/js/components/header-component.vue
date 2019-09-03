<template>
    <header>
        <div class="nav-bar">
            <div class="head-wrap">
                <div class="head-logo">
                    <img src="https://beeya-web-assets.s3.amazonaws.com/Beeya_Logo-Orange_Beeya-Logo.jpg" />
                    <div class="burger-wrapper mobile-only">
                        <button type="button" @click="toggleNavBar()"><i class="far fa-bars beeya-orange"></i></button>
                    </div>
                </div>
                <div class="head-links" :class="getLinksStyle">
                    <div class="head-link  beeya-orange">
                        <i class="fal fa-inbox"></i>
                        <span><a href="https://beeya.com/blogs" >Blogs</a></span>
                    </div>
                    <div class="head-link  beeya-orange">
                        <i class="fal fa-id-card-alt"></i>
                        <span><a href="https://beeya.com">Profile</a></span>
                    </div>
                    <div class="head-link  beeya-orange">
                        <i class="fal fa-binoculars"></i>
                        <span><a href="https://beeya.capeandbay.com">Search</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div id="loginModal"></div>
    </header>
</template>

<script>
    export default {
        name: "header-component",
        created() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize);
        },
        data() {
            return {
                width: 0,
                showNav: false
            };
        },
        computed: {
            getLinksStyle() {
                let results = 'desktop';

                if(this.width < 1000) {
                    if(this.showNav === true) {
                        results = 'mobile flex'
                    }
                    else {
                        results = 'mobile'
                    }
                }

                return results;
            },
        },
        methods: {
            handleResize() {
                this.width = window.innerWidth;
            },
            toggleNavBar() {
                if(this.width < 1000) {
                    if(this.showNav === true) {
                        $('.mobile').slideUp();
                        this.showNav = false;
                    }
                    else {
                        $('.mobile').slideDown();
                        this.showNav = true;
                    }
                }
            }
        }
    }
</script>

<style scoped>
    @media screen {

    }
    @media screen and (max-width: 999px) {
        .mobile {
            display:none;
        }
        .flex {
            display: flex !important;
        }
    }

    @media screen and (min-width: 1000px) {

    }
</style>
