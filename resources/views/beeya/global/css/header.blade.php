<!-- Header -->
<style>
    @media screen {
        header {
            width: 100%;
        }

        .head-wrap {
            width: 100%;
        }

        .beeya-orange {
            color: #EE7229 !important;
        }
        .head-link > i {
            font-size: 1.25em;
            margin-right: 0.25em;
        }

        .head-link > span > a {
            text-decoration: none;
            color: #EE7229;
            font-weight: 600;
            font-size: 1.25em;
        }

    }

    @media screen and (max-width: 999px) {
        header {
            margin-top: 0.5em;
        }

        .nav-bar {
            margin: 0 3.5%;
        }

        .head-wrap {
            display: flex;
            flex-flow: column;
        }

        .head-logo {
            margin: 0 2%;
            display: flex;
            flex-flow: row;
        }

        img {
            width: 75%;
            height: 5em;
        }

        .burger-wrapper {
            width: 100%;
        }

        .burger-wrapper button{
            border: 2px solid #EE7229;
            border-radius: 0.5em;
            float: right;
            margin: 2em 0.5em 2em 0;
            transition: color 0.5s;
        }

        .burger-wrapper button:hover {
            background-color:  #EE7229;
        }

        .burger-wrapper button > i{
            font-size: 3em;
            transition: color 0.5s;
        }

        .burger-wrapper button > i:hover{
            color: #fff !important;
        }

        .head-links {
            display: flex;
            flex-flow: row;
            justify-content:  center;
        }

        .head-link {
            padding: 0 0.5em;
            width: 33.33333%;
        }
    }

    @media screen and (min-width: 1000px) {
        .mobile-only {
            display: none;
        }

        .nav-bar {
            padding: 1em 3em;
        }

        .head-wrap {
            display: flex;
            flex-flow: row;
        }

        .head-logo {
            width: 25%;
        }

        img {
            vertical-align: middle;
            border-style: none;
            height: 3.5em;
        }

        .head-links {
            display: flex;
            flex-flow: row;
            width: 40%;
            padding: 1em 0;
        }

        .head-link {
            width: 33%;
        }

        .head-link:hover, .head-link > span > a:hover {
            color: coral !important;
        }
    }
</style>

<!-- Footer -->
<style>
    @media screen {
        footer {
            width: 100%;
            display: flex;
            flex-flow: column;
        }

        .footer-top {
            background: #1d1e1f;
            border-bottom: 1px solid #1d1e1f;
        }

        .footer-bottom {
            background: #141415;
            padding: 15px 0;
        }

        .footer-bottom .container, .footer-top .container {
            padding: 0.5em 1.75em;
        }

        .copyright {
            padding: 15px 0;
            color: #4d4e4f;
        }

        .f_widget {
            margin-bottom: 25px;
            padding: 0;
        }

        .f_widget .title {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 23px;
        }

        .f_widget .body {
            font-size: 15px;
            color: #6b6d6e;
            line-height: 1.6;
            width: 20em;
        }

        .f_widget .list-f-nav a {
            color: #6b6d6e;
            text-decoration: none;
            transition: color 0.5s;
        }

        .f_widget .list-f-nav a:hover {
            color: #EE7229;
        }

        .f_widget .list-f-nav a i {
            color: #EE7229;
            margin-right: 15px;
        }

        .f_widget .list-f-nav, .list-social {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .list-social {
            display: flex;
            flex-flow: row;

            margin: 1em 0;
        }

        .list-social li {
            padding-right: 1em;
        }

    }

    @media screen and (max-width: 999px) {
        .footer-top {
            padding-top: 90px;
            padding-bottom: 70px;
        }

        .footer-bottom {
            text-align: center;
        }
    }

    @media screen and (min-width: 1000px) {
        .footer-top {
            padding-top: 90px;
            padding-bottom: 70px;
        }

        .row {
            display: flex;
        }

        .col-md-4 {
            max-width: 33.33333%;
            padding: 0 1em;
        }
    }
</style>
