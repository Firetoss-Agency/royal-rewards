<?php

function mo_saml_show_licensing_page(){
    echo '<style>.update-nag, .updated, .error, .is-dismissible, .notice, .notice-error { display: none; }</style>';
    ?>
    <style>
        *, *::after, *::before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            font-size: 62.5%;
        }

        html * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .pricing-container {
            font-size: 1.6rem;
            font-family: "Open Sans", sans-serif;
            color: #fff;
        }

        /* --------------------------------

        Main Components

        -------------------------------- */
        .cd-header{
            margin-top:100px;
        }
        .cd-header>h1{
            text-align: center;
            color: #FFFFFF;
            font-size: 3.2rem;
        }

        .cd-pricing-container {
            width: 90%;
            max-width: 1170px;
            margin: 4em auto;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-container {
                margin: auto;
            }
            .cd-pricing-container.cd-full-width {
                width: 100%;
                max-width: none;
            }
        }

        .cd-pricing-switcher {
            text-align: center;
        }
        .cd-pricing-switcher .fieldset {
            display: inline-block;
            position: relative;
            border-radius: 50em;
            border: 1px solid #e97d68;
        }
        .cd-pricing-switcher input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        .cd-pricing-switcher label {
            position: relative;
            z-index: 1;
            display: inline-block;
            float: left;
            width: 160px;
            height: 40px;
            line-height: 40px;
            cursor: pointer;
            font-size: 1.4rem;
            color: #FFFFFF;
            font-size:18px;
        }
        .cd-pricing-switcher .cd-switch {
            /* floating background */
            position: absolute;
            top: 2px;
            left: 2px;
            height: 40px;
            width: 160px;
            background-color: black;
            border-radius: 50em;
            -webkit-transition: -webkit-transform 0.5s;
            -moz-transition: -moz-transform 0.5s;
            transition: transform 0.5s;
        }
        .cd-pricing-switcher input[type="radio"]:checked + label + .cd-switch,
        .cd-pricing-switcher input[type="radio"]:checked + label:nth-of-type(n) + .cd-switch {
            /* use label:nth-of-type(n) to fix a bug on safari with multiple adjacent-sibling selectors*/
            -webkit-transform: translateX(155px);
            -moz-transform: translateX(155px);
            -ms-transform: translateX(155px);
            -o-transform: translateX(155px);
            transform: translateX(155px);
        }

        .no-js .cd-pricing-switcher {
            display: none;
        }

        .cd-pricing-list {
            margin: 2em 0 0;
        }
        .cd-pricing-list > li {
            position: relative;
            margin-bottom: 1em;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-list {
                margin: 3em 0 0;
            }
            .cd-pricing-list:after {
                content: "";
                display: table;
                clear: both;
            }
            .cd-pricing-list > li {
                width: 35.3333333333%;
                float: left;
            }
            .cd-has-margins .cd-pricing-list > li {
                width: 32.3333333333%;
                float: left;
                margin-right: 1.5%;
            }
            .cd-has-margins .cd-pricing-list > li:last-of-type {
                margin-right: 0;
            }
        }

        .cd-pricing-wrapper {
            /* this is the item that rotates */
            overflow: show;
            position: relative;
        }



        .touch .cd-pricing-wrapper {
            /* fix a bug on IOS8 - rotating elements dissapear*/
            -webkit-perspective: 2000px;
            -moz-perspective: 2000px;
            perspective: 2000px;
        }
        .cd-pricing-wrapper.is-switched .is-visible {
            /* totate the tables - anticlockwise rotation */
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -ms-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
            -webkit-animation: cd-rotate 0.5s;
            -moz-animation: cd-rotate 0.5s;
            animation: cd-rotate 0.5s;
        }
        .cd-pricing-wrapper.is-switched .is-hidden {
            /* totate the tables - anticlockwise rotation */
            -webkit-transform: rotateY(0);
            -moz-transform: rotateY(0);
            -ms-transform: rotateY(0);
            -o-transform: rotateY(0);
            transform: rotateY(0);
            -webkit-animation: cd-rotate-inverse 0.5s;
            -moz-animation: cd-rotate-inverse 0.5s;
            animation: cd-rotate-inverse 0.5s;
            opacity: 0;
        }
        .cd-pricing-wrapper.is-switched .is-selected {
            opacity: 1;
        }
        .cd-pricing-wrapper.is-switched.reverse-animation .is-visible {
            /* invert rotation direction - clockwise rotation */
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            -ms-transform: rotateY(-180deg);
            -o-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
            -webkit-animation: cd-rotate-back 0.5s;
            -moz-animation: cd-rotate-back 0.5s;
            animation: cd-rotate-back 0.5s;
        }
        .cd-pricing-wrapper.is-switched.reverse-animation .is-hidden {
            /* invert rotation direction - clockwise rotation */
            -webkit-transform: rotateY(0);
            -moz-transform: rotateY(0);
            -ms-transform: rotateY(0);
            -o-transform: rotateY(0);
            transform: rotateY(0);
            -webkit-animation: cd-rotate-inverse-back 0.5s;
            -moz-animation: cd-rotate-inverse-back 0.5s;
            animation: cd-rotate-inverse-back 0.5s;
            opacity: 0;
        }
        .cd-pricing-wrapper.is-switched.reverse-animation .is-selected {
            opacity: 1;
        }
        .cd-pricing-wrapper > li {
            background-color: #FFFFFF;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            /* Firefox bug - 3D CSS transform, jagged edges */
            outline: 1px solid transparent;
        }
        .cd-pricing-wrapper > li::after {
            /* subtle gradient layer on the right - to indicate it's possible to scroll */
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 50px;
            pointer-events: none;
            background: -webkit-linear-gradient( right , #FFFFFF, rgba(255, 255, 255, 0));
            background: linear-gradient(to left, #FFFFFF, rgba(255, 255, 255, 0));
        }
        .cd-pricing-wrapper > li.is-ended::after {
            /* class added in jQuery - remove the gradient layer when it's no longer possible to scroll */
            display: none;
        }
        .cd-pricing-wrapper .is-visible {
            /* the front item, visible by default */
            position: relative;
            background-color: #f2f5f8;
        }
        .cd-pricing-wrapper .is-hidden {
            /* the hidden items, right behind the front one */
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 1;
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -ms-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }
        .cd-pricing-wrapper .is-selected {
            /* the next item that will be visible */
            z-index: 3 !important;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-wrapper > li::before {
                /* separator between pricing tables - visible when number of tables > 3 */
                content: '';
                position: absolute;
                z-index: 6;
                left: -1px;
                top: 50%;
                bottom: auto;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                transform: translateY(-50%);
                height: 50%;
                width: 1px;
                background-color: #b1d6e8;
            }
            .cd-pricing-wrapper > li::after {
                /* hide gradient layer */
                display: none;
            }
            .cd-popular .cd-pricing-wrapper > li {
                box-shadow: inset 0 0 0 3px #e97d68;
            }
            .cd-has-margins .cd-pricing-wrapper > li, .cd-has-margins .cd-popular .cd-pricing-wrapper > li {
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            }
            .cd-secondary-theme .cd-pricing-wrapper > li {
                background: #3aa0d1;
                background: -webkit-linear-gradient( bottom , #3aa0d1, #3ad2d1);
                background: linear-gradient(to top, #3aa0d1, #3ad2d1);
            }
            .cd-secondary-theme .cd-popular .cd-pricing-wrapper > li {
                background: #e97d68;
                background: -webkit-linear-gradient( bottom , #e97d68, #e99b68);
                background: linear-gradient(to top, #e97d68, #e99b68);
                box-shadow: none;
            }
            :nth-of-type(1) > .cd-pricing-wrapper > li::before {
                /* hide table separator for the first table */
                display: none;
            }
            .cd-has-margins .cd-pricing-wrapper > li {
                border-radius: 4px 4px 6px 6px;
            }
            .cd-has-margins .cd-pricing-wrapper > li::before {
                display: none;
            }
        }
        @media only screen and (min-width: 1500px) {
            .cd-full-width .cd-pricing-wrapper > li {
                padding: 2.5em 0;
            }
        }

        .no-js .cd-pricing-wrapper .is-hidden {
            position: relative;
            -webkit-transform: rotateY(0);
            -moz-transform: rotateY(0);
            -ms-transform: rotateY(0);
            -o-transform: rotateY(0);
            transform: rotateY(0);
            margin-top: 1em;
        }

        @media only screen and (min-width: 768px) {
            .cd-popular .cd-pricing-wrapper > li::before {
                /* hide table separator for .cd-popular table */
                display: none;
            }

            .cd-popular + li .cd-pricing-wrapper > li::before {
                /* hide table separator for tables following .cd-popular table */
                display: none;
            }
        }
        .cd-pricing-header {
            position: relative;

            height: 80px;
            padding: 1em;
            pointer-events: none;
            background-color: #3aa0d1;
            color: #FFFFFF;
        }
        .cd-pricing-header h2 {
            margin-bottom: 3px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .cd-popular .cd-pricing-header {
            background-color: #e97d68;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-header {
                height: auto;
                padding: 1.9em 0.9em 1.6em;
                pointer-events: auto;
                text-align: center;
                color: #2f6062;
                background-color: transparent;
            }
            .cd-popular .cd-pricing-header {
                color: #e97d68;
                background-color: transparent;
            }
            .cd-secondary-theme .cd-pricing-header {
                color: #FFFFFF;
            }
            .cd-pricing-header h2 {
                font-size: 1.8rem;
                letter-spacing: 2px;
            }
        }

        .cd-currency, .cd-value {
            font-size: 4rem;
            font-weight: 300;
        }

        .cd-duration {
            font-weight: 800;
            font-size: 1.3rem;
            color: #8dc8e4;
            text-transform: uppercase;
        }
        .user-label {
            font-weight: 700;
            font-size: 1.3rem;
            color: #8dc8e4;
            text-transform: uppercase;
        }
        .cd-popular .cd-duration {
            color: #f3b6ab;
        }
        .cd-duration::before {
            content: '/';
            margin-right: 2px;
        }

        @media only screen and (min-width: 768px) {
            .cd-value {
                font-size: 4rem;
                font-weight: 300;
            }

            .cd-contact {
                font-size: 3rem;

            }

            .cd-currency, .cd-duration {
                color: rgba(23, 61, 80, 0.4);
            }
            .cd-popular .cd-currency, .cd-popular .cd-duration {
                color: #e97d68;
            }
            .cd-secondary-theme .cd-currency, .cd-secondary-theme .cd-duration {
                color: #2e80a7;
            }
            .cd-secondary-theme .cd-popular .cd-currency, .cd-secondary-theme .cd-popular .cd-duration {
                color: #ba6453;
            }

            .cd-currency {
                display: inline-block;
                margin-top: 10px;
                vertical-align: top;
                font-size: 2rem;
                font-weight: 700;
            }

            .cd-duration {
                font-size: 1.4rem;
            }
        }
        .cd-pricing-body {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .is-switched .cd-pricing-body {
            /* fix a bug on Chrome Android */
            overflow: hidden;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-body {
                overflow-x: visible;
            }
        }

        .cd-pricing-features {
            width: 600px;
        }
        .cd-pricing-features:after {
            content: "";
            display: table;
            clear: both;
        }
        .cd-pricing-features li {
            width: 100px;
            float: left;
            padding: 1.6em 1em;
            font-size: 1.4rem;
            text-align: center;
            white-space: initial;

            line-height:1.4em;

            text-overflow: ellipsis;
            color: black;
            overflow-wrap: break-word;
            margin: 0 !important;

        }
        .cd-pricing-features em {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: black;
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-features {
                width: auto;
                word-wrap: break-word;
            }
            .cd-pricing-features li {
                float: none;
                width: auto;
                padding: 1em;
                word-wrap: break-word;
            }
            .cd-popular .cd-pricing-features li {
                margin: 0 3px;
            }
            .cd-pricing-features li:nth-of-type(2n+1) {
                background-color: rgba(23, 61, 80, 0.06);
            }
            .cd-pricing-features em {
                display: inline-block;
                margin-bottom: 0;
                word-wrap: break-word;
            }
            .cd-has-margins .cd-popular .cd-pricing-features li, .cd-secondary-theme .cd-popular .cd-pricing-features li {
                margin: 0;
            }
            .cd-secondary-theme .cd-pricing-features li {
                color: #FFFFFF;
            }
            .cd-secondary-theme .cd-pricing-features li:nth-of-type(2n+1) {
                background-color: transparent;
            }
        }

        .cd-pricing-footer {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            /* on mobile it covers the .cd-pricing-header */
            height: 80px;
            width: 100%;
        }
        .cd-pricing-footer::after {
            /* right arrow visible on mobile */
            content: '';
            position: absolute;
            right: 1em;
            top: 50%;
            bottom: auto;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            height: 20px;
            width: 20px;
            background: url(../img/cd-icon-small-arrow.svg);
        }
        @media only screen and (min-width: 768px) {
            .cd-pricing-footer {
                position: relative;
                height: auto;
                padding: 1.8em 0;
                text-align: center;
            }
            .cd-pricing-footer::after {
                /* hide arrow */
                display: none;
            }
            .cd-has-margins .cd-pricing-footer {
                padding-bottom: 0;
            }
        }

        .cd-select {
            position: relative;
            z-index: 1;
            display: block;
            height: 100%;
            /* hide button text on mobile */
            overflow: hidden;
            text-indent: 100%;
            white-space: nowrap;
            color: transparent;
        }
        @media only screen and (min-width: 768px) {
            .cd-select {
                position: static;
                display: inline-block;
                height: auto;
                padding: 1.3em 3em;
                color: #FFFFFF;
                border-radius: 2px;
                background-color: #0c1f28;
                font-size: 1.4rem;
                text-indent: 0;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
            .no-touch .cd-select:hover {
                background-color: #112e3c;
            }
            .cd-popular .cd-select {
                background-color: #e97d68;
            }
            .no-touch .cd-popular .cd-select:hover {
                background-color: #ec907e;
            }
            .cd-secondary-theme .cd-popular .cd-select {
                background-color: #0c1f28;
            }
            .no-touch .cd-secondary-theme .cd-popular .cd-select:hover {
                background-color: #112e3c;
            }
            .cd-has-margins .cd-select {
                display: block;
                padding: 1.7em 0;
                border-radius: 0 0 4px 4px;
            }
        }
        /* --------------------------------

        xkeyframes

        -------------------------------- */
        @-webkit-keyframes cd-rotate {
            0% {
                -webkit-transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(200deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(180deg);
            }
        }
        @-moz-keyframes cd-rotate {
            0% {
                -moz-transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -moz-transform: perspective(2000px) rotateY(200deg);
            }
            100% {
                -moz-transform: perspective(2000px) rotateY(180deg);
            }
        }
        @keyframes cd-rotate {
            0% {
                -webkit-transform: perspective(2000px) rotateY(0);
                -moz-transform: perspective(2000px) rotateY(0);
                -ms-transform: perspective(2000px) rotateY(0);
                -o-transform: perspective(2000px) rotateY(0);
                transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(200deg);
                -moz-transform: perspective(2000px) rotateY(200deg);
                -ms-transform: perspective(2000px) rotateY(200deg);
                -o-transform: perspective(2000px) rotateY(200deg);
                transform: perspective(2000px) rotateY(200deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(180deg);
                -moz-transform: perspective(2000px) rotateY(180deg);
                -ms-transform: perspective(2000px) rotateY(180deg);
                -o-transform: perspective(2000px) rotateY(180deg);
                transform: perspective(2000px) rotateY(180deg);
            }
        }
        @-webkit-keyframes cd-rotate-inverse {
            0% {
                -webkit-transform: perspective(2000px) rotateY(-180deg);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(20deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(0);
            }
        }
        @-moz-keyframes cd-rotate-inverse {
            0% {
                -moz-transform: perspective(2000px) rotateY(-180deg);
            }
            70% {
                /* this creates the bounce effect */
                -moz-transform: perspective(2000px) rotateY(20deg);
            }
            100% {
                -moz-transform: perspective(2000px) rotateY(0);
            }
        }
        @keyframes cd-rotate-inverse {
            0% {
                -webkit-transform: perspective(2000px) rotateY(-180deg);
                -moz-transform: perspective(2000px) rotateY(-180deg);
                -ms-transform: perspective(2000px) rotateY(-180deg);
                -o-transform: perspective(2000px) rotateY(-180deg);
                transform: perspective(2000px) rotateY(-180deg);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(20deg);
                -moz-transform: perspective(2000px) rotateY(20deg);
                -ms-transform: perspective(2000px) rotateY(20deg);
                -o-transform: perspective(2000px) rotateY(20deg);
                transform: perspective(2000px) rotateY(20deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(0);
                -moz-transform: perspective(2000px) rotateY(0);
                -ms-transform: perspective(2000px) rotateY(0);
                -o-transform: perspective(2000px) rotateY(0);
                transform: perspective(2000px) rotateY(0);
            }
        }
        @-webkit-keyframes cd-rotate-back {
            0% {
                -webkit-transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(-200deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(-180deg);
            }
        }
        @-moz-keyframes cd-rotate-back {
            0% {
                -moz-transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -moz-transform: perspective(2000px) rotateY(-200deg);
            }
            100% {
                -moz-transform: perspective(2000px) rotateY(-180deg);
            }
        }
        @keyframes cd-rotate-back {
            0% {
                -webkit-transform: perspective(2000px) rotateY(0);
                -moz-transform: perspective(2000px) rotateY(0);
                -ms-transform: perspective(2000px) rotateY(0);
                -o-transform: perspective(2000px) rotateY(0);
                transform: perspective(2000px) rotateY(0);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(-200deg);
                -moz-transform: perspective(2000px) rotateY(-200deg);
                -ms-transform: perspective(2000px) rotateY(-200deg);
                -o-transform: perspective(2000px) rotateY(-200deg);
                transform: perspective(2000px) rotateY(-200deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(-180deg);
                -moz-transform: perspective(2000px) rotateY(-180deg);
                -ms-transform: perspective(2000px) rotateY(-180deg);
                -o-transform: perspective(2000px) rotateY(-180deg);
                transform: perspective(2000px) rotateY(-180deg);
            }
        }
        @-webkit-keyframes cd-rotate-inverse-back {
            0% {
                -webkit-transform: perspective(2000px) rotateY(180deg);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(-20deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(0);
            }
        }
        @-moz-keyframes cd-rotate-inverse-back {
            0% {
                -moz-transform: perspective(2000px) rotateY(180deg);
            }
            70% {
                /* this creates the bounce effect */
                -moz-transform: perspective(2000px) rotateY(-20deg);
            }
            100% {
                -moz-transform: perspective(2000px) rotateY(0);
            }
        }
        @keyframes cd-rotate-inverse-back {
            0% {
                -webkit-transform: perspective(2000px) rotateY(180deg);
                -moz-transform: perspective(2000px) rotateY(180deg);
                -ms-transform: perspective(2000px) rotateY(180deg);
                -o-transform: perspective(2000px) rotateY(180deg);
                transform: perspective(2000px) rotateY(180deg);
            }
            70% {
                /* this creates the bounce effect */
                -webkit-transform: perspective(2000px) rotateY(-20deg);
                -moz-transform: perspective(2000px) rotateY(-20deg);
                -ms-transform: perspective(2000px) rotateY(-20deg);
                -o-transform: perspective(2000px) rotateY(-20deg);
                transform: perspective(2000px) rotateY(-20deg);
            }
            100% {
                -webkit-transform: perspective(2000px) rotateY(0);
                -moz-transform: perspective(2000px) rotateY(0);
                -ms-transform: perspective(2000px) rotateY(0);
                -o-transform: perspective(2000px) rotateY(0);
                transform: perspective(2000px) rotateY(0);
            }
        }


        .tab-content {
            margin-left: 0%!important;
            margin-top: 0%!important;

        }
        .tab-content>.active {
            width: 100% !important;
        }

        .tab-pane,.cd-pricing-container,.cd-pricing-switcher ,.cd-row,.cd-row>div{

        }

        .center-pills { display: inline-block; }

        .nav-pills{
            border: 1px solid #fff;
            height:48px;
        }

        .nav-pills>li{
            width:250px;
        }

        .tab-font{
            vertical-align:text-bottom;
            font-size:20px;
        }

        .nav-pills>li+li {
            margin-left: 0px;
        }

        .nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus,.nav-pills>li.active>a:active{
            color: #1e3334;
            background-color:white;
            height:47px;
        }

        .nav-pills>li>a:hover {
            color:#fff;
            background: #E97D68;
            height:46px;
        }

        .nav-pills>li>a:focus{
            color:#fff;
            background:grey;
            height:47px;

        }

        .nav-pills>li.active{
            background-color: #fff;
        }

        .nav-pills>li>a {
            border-radius: 0px;
            height:47px;
            border-color:#E85700;
            font-weight: 500;
            color: #d3f3d3;
            text-transform:uppercase;
        }


        .ui-widget-content {
            border: 1px solid #bdc3c7;
            background: #e1e1e1;
            color: #222222;
            margin-top: 4px;
        }

        .ui-slider .ui-slider-handle {
            position: absolute !important;
            z-index: 2 !important;
            width: 3.2em !important;
            height: 2.2em !important;
            cursor: default !important;
            margin: 0 -20px auto !important;
            text-align: center !important;
            line-height: 30px !important;
            color: #FFFFFF !important;
            font-size: 15px !important;
        }




        .ui-state-default,
        .ui-widget-content .ui-state-default {
            background: #393a40 !important;
        }
        .ui-slider .ui-slider-handle {width:2em;left:-.6em;text-decoration:none;text-align:center;}
        .ui-slider-horizontal .ui-slider-handle {
            margin-left: -0.5em !important;
        }

        .ui-slider .ui-slider-handle {
            cursor: pointer;
        }

        .ui-slider a,
        .ui-slider a:focus {
            cursor: pointer;
            outline: none;
        }

        .price, .lead p {
            font-weight: 600;
            font-size: 32px;
            display: inline-block;
            line-height: 60px;
        }


        .price-slider {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .price-form {
            background: #ffffff;
            margin-bottom: 10px;
            padding: 20px;
            border: 1px solid #eeeeee;
            border-radius: 4px;
        }



        .help-text {
            display: block;
            margin-top: 32px;
            margin-bottom: 10px;
            color: #737373;
            position: absolute;
            font-weight: 200;
            text-align: right;
            width: 188px;
        }

        .price-form label {
            font-weight: 200;
            font-size: 21px;
        }

        .ui-slider-range-min {
            background: #2980b9;
        }

        .ui-slider-label-inner {
            border-top: 10px solid #393a40;
            display: block;
            left: 50%;
            position: absolute;
            top: 10%;
            z-index: 99;
        }

        .ui-slider-horizontal .ui-slider-handle {
            top: -.6em !important;
        }
        /***********************ADDED BY SHAILESH************************/

        .plan-tagline{
            margin:1px;
            font-size: 2rem;
            font-weight: 400;
        }

        .pricing-tooltip {
            position: relative;
            display: inline-block;
            /* color:black; */
        }

        .tooltip {
            display:none;
            background: black;
            font-size:12px;
            height:10px;
            width:80px;
            padding:10px;
            color:#fff;
            z-index: 99;
            bottom: 10px;
            border: 2px solid white;
            /* for IE */
            filter:alpha(opacity=80);
            /* CSS3 standard */
            opacity:0.8;
        }
        .pricing-tooltip .pricing-tooltiptext {
            visibility: hidden;
            background-color: black;
            line-height: 1.5em;
            font-size:12px;
            min-width: 300px;
            color: rgb(253, 252, 252);
            padding: 10px;
            border-radius: 6px;
            position: absolute;
            z-index: 5;
            text-align: center;
        }

        .pricing-tooltiptext .body{
            font-weight:100;
        }

        .pricing-tooltip:hover .pricing-tooltiptext {
            visibility: visible;
        }

        .pricing-dotted-border{
            border-bottom: 1px dotted black;
        }
        .pricing-tooltip-class,.pricing-tooltip-class:hover{
            color:black;
            border-bottom: 1px dotted black;
        }
        .pricing-tooltip-class:focus{
            color:black;
            text-decoration: none;
        }

        .toggle-div{
            cursor: pointer;
            font-size:1.5em;
        }

        .toggler_more{
            font-size: 1.1em;
            font-weight: bold;

            cursor: pointer;
        }

        .cd-pricing-features>li>a{
            color:#E97D68;
        }

        .pc-header{
            font-size:18px;
        }

        .cd-row .col-md-4, .cd-row .col-md-6 {
            padding-left: 30px!important;
            font-size: 16px;
            padding: 4px;
        }

        .cd-row .col-md-6 {
            width: 60.33333333%;
        }


        .ribbon {
            font-size: 12px !important;
            /* This ribbon is based on a 16px font side and a 24px vertical rhythm. I've used em's to position each element for scalability. If you want to use a different font size you may have to play with the position of the ribbon elements */

            width: 8%;

            position: relative;
            background: #ba89b6;
            color: #fff;
            text-align: center;
            padding-top: 8px; /* Adjust to suit */
            padding-bottom: 8px;
            margin: 2em auto 3em; /* Based on 24px vertical rhythm. 48px bottom margin - normally 24 but the ribbon 'graphics' take up 24px themselves so we double it. */
        }
        .ribbon:before, .ribbon:after {
            content: "";
            position: absolute;
            display: block;
            bottom: -1em;
            border: 15px solid #986794;
            z-index: -1;
        }
        .ribbon:before {
            left: -2em;
            border-right-width: 1.5em;
            border-left-color: transparent;
        }
        .ribbon:after {
            right: -2em;
            border-left-width: 1.5em;
            border-right-color: transparent;
        }
        .ribbon .ribbon-content:before, .ribbon .ribbon-content:after {
            content: "";
            position: absolute;
            display: block;
            border-style: solid;
            border-color: #804f7c transparent transparent transparent;
            bottom: -1em;
        }
        .ribbon .ribbon-content:before {
            left: 0;
            border-width: 0em 0 0 1em;
        }
        .ribbon .ribbon-content:after {
            right: 0;
            border-width: 0em 1em 0 0;
        }
        .ribbon-placement-1{
            margin-left: -34%;
            position: relative;
            margin-bottom: -80px;
            z-index: 1;
        }

        .ribbon-placement-2{
            margin-left: 34%;
            position: relative;
            margin-bottom: -60px;
            z-index: 1;
        }

        .popover {
            max-width: 25%;
            width: 25%;
            border-radius: 5px;
        }
        .popover-header{ background: rgb(233, 125, 104); color: white;}


    </style>

<?php
    $lp = get_option('mo_license_plan_from_feedback');

    $sssborder = 'none;';
    $sspborder = 'none;';
    $sseborder = 'none;';
    $mspborder = 'none;';
    $mseborder = 'none;';
    $msbborder = 'none;';
    $license_plan_selected = 'singlesite';
    if($lp == 'Single Site - Standard'){
        $sssborder = '8px solid red;';
    }else if($lp == 'Single Site - Premium'){
        $sspborder = '8px solid red;';
    }else if($lp == 'Single Site - Enterprise'){
        $sseborder = '8px solid red;';
    }else if($lp == 'Multisite Network - Premium'){
        $mspborder = '8px solid red;';
        $license_plan_selected = 'multisite';
    }else if($lp == 'Multisite Network - Enterprise'){
        $mseborder = '8px solid red;';
        $license_plan_selected = 'multisite';
    }else if($lp == 'Multisite Network - Business'){
        $msbborder = '8px solid red;';
        $license_plan_selected = 'multisite';
    }

?>
<div style="text-align: center; font-size: 14px; background: forestgreen; color: white; padding-top: 4px; padding-bottom: 4px; border-radius: 16px;"><?php echo get_option('mo_saml_license_message'); ?></div>
    <input type="hidden" id="mo_license_plan_selected" value="<?php echo $license_plan_selected; ?>" />
    <div class="tab-content">
    <div class="tab-pane active text-center" id="cloud">

        <div class="cd-pricing-container cd-has-margins"><br>
            <h1 style="font-size: 32px;">Choose Your Licensing Plan</h1>
            <div class="cd-pricing-switcher">
                <p class="fieldset" style="background-color: #e97d68;">
                    <input type="radio" name="sitetype" value="singlesite" id="singlesite" checked>
                    <label for="singlesite">Single Site</label>
                    <input type="radio" name="sitetype" value="multisite" id="multisite">
                    <label for="multisite">Multisite Network</label>
                    <span class="cd-switch"></span>
                </p>
            </div>

            <script>
                jQuery(document).ready(function(){
                    jQuery("#popover").popover({ trigger: "hover" });
                    jQuery("#popover1").popover({ trigger: "hover" });
                    jQuery("#popover2").popover({ trigger: "hover" });
                    jQuery("#popover3").popover({ trigger: "hover" });
                    jQuery("#popover4").popover({ trigger: "hover" });
                    jQuery("#popover5").popover({ trigger: "hover" });
                    jQuery("#popoverfree").popover({ trigger: "focus" });


                });
            </script>
            <!-- .cd-pricing-switcher -->



            <!--div style="z-index: 1;position: relative;">


                    <button type="button" data-toggle="modal" data-target="#standardPremiumModalCenter" >
                        -COMPARE-
                    </button>

                <button type="button" data-toggle="modal" data-target="#premiumEnterpriseModalCenter" style="cursor: pointer; font-size: 15px;background-color: #ba89b6;border-radius: 4px;padding: 5px;color: white;margin-left: 300px;">
                    -COMPARE-
                </button>
            </div -->



            <input type="hidden" value="<?php echo mo_saml_is_customer_registered_saml(false);?>" id="mo_customer_registered">
            <ul class="cd-pricing-list cd-bounce-invert" >
                <li>

                    <ul class="cd-pricing-wrapper">
                        <li data-type="singlesite" class="mosslp is-visible" style="border: <?php echo $sssborder; ?>">
                            <a id="popover" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>Choose this plan if you are looking for the features like <br /><b>Auto-Redirect to IdP</b><br /><b>Basic Attribute Mapping (Username, Email, First Name, Last Name, Display Name)</b><br /><span style='color:red;'><b>Note:</b></span> Single Logout & Role Mapping is not a part of this plan.</p>">
                            <header class="cd-pricing-header">

                                <h2 style="margin-bottom: 10px" >Standard<span style="font-size:0.5em"></span></h2>
                                <h3 style="color:black;">(Auto-Redirect to IdP)<br /><br /></h3>
                                <div class="cd-price" >
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">249*</span></span>

                                </div>

                            </header> <!-- .cd-pricing-header -->
                            </a>
                            <footer class="cd-pricing-footer">
                                <a href="#" class="cd-select" onclick="upgradeform('wp_saml_sso_standard_plan')" >Upgrade Now</a>
                            </footer>
                            <b style="color: coral;">See the Standard Plugin features list below</b>
                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;<br />&nbsp;</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;<b>Add-Ons</b><br />Purchase Separately<br /><a style="color:blue;" href="<?php echo add_query_arg( array( 'tab' => 'support' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>"><b>Contact us</b></a><br />&nbsp;<br />&nbsp;</li>

                                </ul>
                            </div> <!-- .cd-pricing-body -->
                        </li>

                        <li data-type="multisite" class="momslp is-hidden" style="border: <?php echo $mspborder; ?>">
                            <a id="popover3" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>Choose this plan if you have Multisite Network Installation and are looking for the features like <br /><b>Subsite Specific SSO<br />Auto-Redirect to IdP<br />Advance Attribute Mapping<br />Role Mapping<br />IdP metadata sync<br />Support of custom SP and IdP certificate<br /></b><span style='color:red;'><b>Note:</b></span> Add-ons are not a part of this plan.</p>">
                            <header class="cd-pricing-header">

                                <h2 style="margin-bottom: 10px" >Premium<span style="font-size:0.5em"></span></h2>
                                <h3 style="color:black;">(Multisite Network SSO)<br /><br /><br /></h3>
                                <div class="cd-price" >
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">449*</span></span>

                                </div>

                            </header>
                            </a>
                            <!-- .cd-pricing-header -->
                            <footer class="cd-pricing-footer">
                                <a href="#" class="cd-select" onclick="upgradeform('wp_saml_sso_multisite_basic_plan')" >Upgrade Now</a>
                            </footer>
                            <b style="color: coral;">See the Multisite Premium Plugin features list below</b>
                            <div class="cd-pricing-body">

                                <ul class="cd-pricing-features">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>SAML Single Logout</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>Customized Role Mapping</li>
                                    <li>Auto-sync IdP Configuration from metadata</li>
                                    <li>Custom Attribute Mapping (Any attribute which is stored in user-meta table)</li>
                                    <li>Store Multiple IdP Certificates</li>
                                    <li>Custom SP Certificate</li>
                                    <li>Multi-Site Support</li>
                                    <li>Sub-site specific SSO for Multisite</li>
                                    <li>Auto-Redirection from specific subsites</li>
                                    <li>&nbsp;<b>Add-Ons</b><br />Purchase Separately<br /><a style="color:blue;" href="<?php echo add_query_arg( array( 'tab' => 'support' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>"><b>Contact us</b></a><br />&nbsp;<br />&nbsp;</li>
                                    <li>&nbsp;</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->
                        </li>
                    </ul> <!-- .cd-pricing-wrapper -->
                </li>

                <li class="cd-popular">
                    <ul class="cd-pricing-wrapper">
                        <li data-type="singlesite" class="mosslp is-visible" style="border: <?php echo $sspborder; ?>">
                            <a id="popover1" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>Choose this plan if you are looking for the features like <br /><b>Advance Attribute Mapping<br />Role Mapping<br />Single Logout<br />IdP metadata sync<br />Support of custom SP and IdP certificate<br /></b><span style='color:red;'><b>Note:</b></span> Add-ons are not a part of this plan. All features of Standard Plan are included here.</p>">
                            <header class="cd-pricing-header">

                                <h2 style="margin-bottom: 10px">Premium</h2>
                                <h3 style="color:black;">(Attribute & Role Management))<br /><br /></h3>

                                <div class="cd-price" >
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">449*</span></span>

                                </div>


                            </header> <!-- .cd-pricing-header -->
                            </a>
                            <footer class="cd-pricing-footer">
                                <a href="#" class="cd-select" onclick="upgradeform('wp_saml_sso_basic_plan')" >Upgrade Now</a>
                            </footer>
                            <b>See the Premium Plugin features list below</b>
                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>SAML Single Logout</li>
                                    <li>Customized Role Mapping</li>
                                    <li>Auto-sync IdP Configuration from metadata</li>
                                    <li>Custom Attribute Mapping (Any attribute which is stored in user-meta table)</li>
                                    <li>Store Multiple IdP Certificates</li>
                                    <li>Custom SP Certificate</li>
                                    <li>&nbsp;</li>
                                    <li>&nbsp;<b>Add-Ons</b><br />Purchase Separately<br /><a style="color:blue;" href="<?php echo add_query_arg( array( 'tab' => 'support' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>"><b>Contact us</b></a><br />&nbsp;<br />&nbsp;</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->
                        </li>

                        <li data-type="multisite" class="momslp is-hidden" style="border: <?php echo $mseborder; ?>">
                            <a id="popover4" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>Choose this plan if you have Multisite Network installation and are looking for features like <br /><b>Add-ons</b> (See the list of add-ons below in the feature list) along with the features listed in the Premium Plan like <br /><b>Subsite Specific SSO<br />Auto-Redirect to IdP<br />Advance Attribute Mapping<br />Role Mapping<br />IdP metadata sync<br />Support of custom SP and IdP certificate</b></p>">
                            <header class="cd-pricing-header">

                                <h2 style="margin-bottom: 10px">Enterprise</h2>

                                <h3 style="color:black;">(Multisite Network SSO packaged with Add-ons)<br /><br /></h3>
                                <div class="cd-price" >
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">499*</span></span>

                                </div>


                            </header> <!-- .cd-pricing-header -->
                            </a>
                            <footer class="cd-pricing-footer">
                                <a href="#" class="cd-select" onclick="upgradeform('wp_saml_sso_multisite_enterprise_plan')" >Upgrade Now</a>
                            </footer>
                            <b>See the Multisite Enterprise Plugin features list below</b>
                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>SAML Single Logout</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>Customized Role Mapping</li>
                                    <li>Auto-sync IdP Configuration from metadata</li>
                                    <li>Custom Attribute Mapping (Any attribute which is stored in user-meta table)</li>
                                    <li>Store Multiple IdP Certificates</li>
                                    <li>Custom SP Certificate</li>
                                    <li>Multi-Site Support</li>
                                    <li>Sub-site specific SSO for Multisite</li>
                                    <li>Auto-Redirection from specific subsites</li>
                                    <li><b>Add-Ons</b><br />
                                        1. Page Restriction Add-On<br />
                                        2. Buddypress Attribute Mapping Add-On<br />
                                        3. LearnDash Attribute Integration Add-On<br />
                                        4. SSO Login Audit Add-On</li>
                                    <li>&nbsp;</li>

                                </ul>
                            </div> <!-- .cd-pricing-body -->
                        </li>

                    </ul> <!-- .cd-pricing-wrapper -->
                </li>

                <li>
                    <ul class="cd-pricing-wrapper">
                        <li data-type="singlesite" class="mosslp is-visible" style="border: <?php echo $sseborder; ?>">
                            <a id="popover2" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>Choose this plan if you are looking for features like <br /><b>Support of multiple IdPs<br />Add-ons (Page Restriction, BuddyPress Attribute Mapping, LearnDash Attribute Mapping, SSO Login Audit).</b><br />Click  on Upgrade now and Select Single IdP or Multiple IdP option depending on your requirement. <br /><span style='color:red;'><b>Note:</b></span> All the Add-ons are packaged with this plan. All features of Premium Plan are included here.</p>">
                            <header class="cd-pricing-header">
                                <h2 style="margin-bottom:10px;">Enterprise</h2>
                                <h3 style="color:black;">(Multiple IdP & Add-Ons)<br /><br /></h3>
                                <div class="cd-price" >
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">499*</span></span>

                                </div>
                            </header> <!-- .cd-pricing-header -->
                            </a>
                            <footer class="cd-pricing-footer">
                                <!--a class="cd-select" href="businessfreetrial" target="_blank" >Upgrade now</a -->
                                <div class="btn-group" style="width:100%;">
                                    <button type="button" class="btn btn-default dropdown-toggle cd-select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%">
                                        Upgrade now <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="width: 100%; padding-left: 10px; padding-right: 10px;">
                                        <li style="font-size: 16px;"><a href="#" style="color: #2f6062;" onclick="upgradeform('wp_saml_sso_enterprise_plan')">SINGLE IdP: <span style="font-size:12px;">Select this if you want to setup the SSO with 1 IdP</span></a></li>
                                        <li style="font-size: 16px;"><a href="#" style="color: #2f6062;" onclick="upgradeform('wp_saml_sso_multiple_idp_plan')">MULTIPLE IdP: <span style="font-size:12px;">Select this if you want to setup the SSO in your site with more than 1 IdP</span></a></li>
                                    </ul>
                                </div>
                            </footer>
                            <b style="color: coral;">See the Enterprise Plugin features list below</b>
                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features ">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>SAML Single Logout</li>
                                    <li>Customized Role Mapping</li>
                                    <li>Auto-sync IdP Configuration from metadata</li>
                                    <li>Custom Attribute Mapping (Any attribute which is stored in user-meta table)</li>
                                    <li>Store Multiple IdP Certificates</li>
                                    <li>Custom SP Certificate</li>
                                    <li>Multiple IDP's Supported</li>
                                    <li><b>Add-Ons</b><br />
                                    1. Page Restriction Add-On<br />
                                    2. Buddypress Attribute Mapping Add-On<br />
                                    3. LearnDash Attribute Integration Add-On<br />
                                    4. SSO Login Audit Add-On</li>

                                </ul>
                            </div> <!-- .cd-pricing-body -->

                        </li>

                        <li data-type="multisite" class="momslp is-hidden" style="border: <?php echo $msbborder; ?>">
                            <a id="popover5" data-toggle="popover" title="<h3>Why should I choose this plan?</h3>" data-placement="top" data-html="true"
                               data-content="<p>We are Single Sign-On experts. Talk to us for your Single Sign-On requirement. Our technical lead will contact you and will help you in designing the SSO architecture for you.</p>">
                            <header class="cd-pricing-header">
                                <h2 style="margin-bottom:10px;">Business</h2>
                                <h3 style="color:black;">(Multisite Network with Multiple IdP Support and Service Provider Usecase)<br /><br /></h3>
                                <div class="cd-price" >
                                    <span class="cd-currency"></span>
                                    <span class="cd-value"></span>

                                </div>
                            </header> <!-- .cd-pricing-header -->
                            </a>
                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="<?php echo add_query_arg( array( 'tab' => 'support' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>" >Contact Us</a>
                            </footer>
                            <b>See the Business Plan features list below</b>
                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li>Unlimited Authentications</li>
                                    <li>Basic Attribute Mapping (Username, Email, First Name, Last Name,Display Name)</li>
                                    <li>Widget,Shortcode to add IDP Login Link on your site</li>
                                    <li>Step-by-step guide to setup IDP</li>
                                    <li>Auto-Redirect to IDP from login page</li>
                                    <li>Protect your complete site (Auto-Redirect to IDP from any page)</li>
                                    <li>Change SP base Url and SP Entity ID</li>
                                    <li>Options to select SAML Request binding type</li>
                                    <li>SAML Single Logout</li>
                                    <li>Integrated Windows Authentication (supported with AD FS)</li>
                                    <li>Customized Role Mapping</li>
                                    <li>Auto-sync IdP Configuration from metadata</li>
                                    <li>Custom Attribute Mapping (Any attribute which is stored in user-meta table)</li>
                                    <li>Store Multiple IdP Certificates</li>
                                    <li>Custom SP Certificate</li>
                                    <li>Multi-Site Support</li>
                                    <li>Sub-site specific SSO for Multisite</li>
                                    <li>Auto-Redirection from specific subsites</li>
                                    <li><b>Add-Ons</b><br />
                                        1. Page Restriction Add-On<br />
                                        2. Buddypress Attribute Mapping Add-On<br />
                                        3. LearnDash Attribute Integration Add-On<br />
                                        4. SSO Login Audit Add-On</li>
                                    <li>Multiple IdP Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->
                        </li>
                    </ul> <!-- .cd-pricing-wrapper -->
                </li>
            </ul> <!-- .cd-pricing-list -->
        </div> <!-- .cd-pricing-container -->
        <div style="text-align:left; font-size:12px; padding-left:30px; padding-right:30px;">
            <h3>Steps to Upgrade to Premium Plugin -</h3>
            <p>1. Click on 'Upgrade now' button of the required licensing plan. You will be redirected to miniOrange Login Console. Enter your password with which you created an account
                with us. After that you will be redirected to payment page.</p>
            <p>2. Enter you card details and complete the payment. On successful payment completion, you will see the link
                to download the premium plugin.</p>
            <p>3. To install the premium plugin, first deactivate and delete the free version of the plugin. Enable the "Keep Configuration Intact" checkbox before deactivating and deleting the plugin. By doing so, your saved configurations of the plugin will not get lost.

            <p>4. From this point on, do not update the premium plugin from the Wordpress store.</p>

            <h3>* Cost applicable for one instance only. Licenses are perpetual and the Support Plan includes 12 months of maintenance (support and version updates). You can renew maintenance after 12 months at 50% of the current license cost.</h3>
            <br />
            <h3>* MultiSite Network Support - </h3>
            <p>There is additional cost for the number of subsites in Multisite Network .</p>

            <h3>** Multiple IdPs Supported - </h3>
            <p>There is additional cost for the IdPs if number of IdP is more than 1.</p>
            <h3>10 Days Return Policy -</h3>
            At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is
            not working as advertised and you've attempted to resolve any issues with our support team, which couldn't get
            resolved. We will refund the whole amount within 10 days of the purchase. Please email us at info@xecurify.com
            for any queries regarding the return policy.

        </div>
    </div>





    </div>

    <!-- Modal -->
    <div class="modal fade" id="standardPremiumModalCenter" tabindex="-1" role="dialog" aria-labelledby="standardPremiumModalCenterTitle" aria-hidden="false"
         style="/*overflow-x: auto !important;top: 80px;left:425px !important;*/">
        <div class="modal-dialog" role="document" style="max-width: 794px;height: 1200px;">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #e97d68;">
                    <b><h5 class="modal-title" id="exampleModalLongTitle" style="/*color:white;*/">Fill up the following SSO Form</h5></b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: #f2f5f8;">
                    <h3>Please select the options as per your requirement and we will point you to the right licensing plan.</h3><br />
                    <form name="licensingplanselectionform" action="" method="post">
                        <?php wp_nonce_field("molicensingplanselection");?>
                        <input name="option" value="molicensingplanselection" type="hidden" />
                    <h4>Select the your site installation type:</h4>
                    <input type="radio" name="envtype" value="singlesite" checked style="height:14px;">Single Site Environment
                    <input type="radio" name="envtype" value="multisite" style="height:14px;">MultiSite Network Environment
                    <br /><br />
                    <h4>Select number of Identity Providers (For example, ADFS, Azure AD, miniOrange, Salesforce, Okta etc.):</h4>
                    <input type="radio" name="idpnum" value="1" checked style="height:14px;">1
                    <input type="radio" name="idpnum" value="1+" style="height:14px;">more than 1
                    <br /><br />
                    <h4>Do you want to auto-redirect to IdP?</h4>
                    <input type="radio" name="autoredirect" value="yes" checked style="height:14px;">Yes
                    <input type="radio" name="autoredirect" value="no" style="height:14px;">No
                    <br /><br />
                    <h4>Do you want to Attribute Mapping (fetching user info from IdP and map it to WordPress attributes)?</h4>
                    <input type="radio" name="attrmap" value="yes" checked style="height:14px;">Yes
                    <input type="radio" name="attrmap" value="no" style="height:14px;">No
                    <br /><br />
                    <h4>Do you want to Role Mapping (fetching user role/groups from IdP and map it to WordPress roles)?</h4>
                    <input type="radio" name="rolemap" value="yes" checked style="height:14px;">Yes
                    <input type="radio" name="rolemap" value="no" style="height:14px;">No
                    <br /><br />
                    <h4>Do you want to Single Logout(Applicable only if your IdP supports Single Logout)?</h4>
                    <input type="radio" name="slo" value="yes" checked style="height:14px;">Yes
                    <input type="radio" name="slo" value="no" style="height:14px;">No
                    <br /><br />
                    <h4>Do you require the these add-ons (Page Restriction, BuddyPress Attribute Integration, LearnDash Attribute Integration, SSO Login Audit)?</h4>
                    <input type="radio" name="addon" value="yes" checked style="height:14px;">Yes
                    <input type="radio" name="addon" value="no" style="height:14px;">No
                </div>
                <div class="modal-footer" style="/*display:block !important;*/">
                    <input type="submit" class="btn btn-primary" style="float:left;" value="Submit" /></form>
                    <span style="float:right;"><b>Still Confused? Write us at <a href="mailto:info@miniorange.com">info@miniorange.com</a>.</b>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></span>
                </div>
            </div>
        </div>
    </div>

    <form style="display:none;" id="loginform"
                 action="<?php echo mo_options_plugin_constants::HOSTNAME . '/moas/login'; ?>"
                 target="_blank" method="post">
        <input type="email" name="username" value="<?php echo get_option( 'mo_saml_admin_email' ); ?>"/>
        <input type="text" name="redirectUrl"
               value="<?php echo mo_options_plugin_constants::HOSTNAME . '/moas/initializepayment'; ?>"/>
        <input type="text" name="requestOrigin" id="requestOrigin"/>
    </form>
    <a  id="mobacktoaccountsetup" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account-setup' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>
    <style>

        .btn_blue{
            padding:5px !important;
            width:150px;
        }

        .table-onpremisetable{
            width: 30%;
            padding-top: 100px;
            margin: auto;
            width: 40%;
            padding: 10px;
        }


        .table-onpremisetable2{
            padding-top: 100px;
            margin: auto;
            width:	60%;
            padding: 10px;
            border: 2px solid #fff;
            table-layout:fixed;
            color: #173d50;

        }

        .table-onpremisetable2 th {
            background-color: #fcfdff;

            text-align: center;
            vertical-align:center;
        }

        .table-onpremisetable2 td {
            background-color: #fcfdff;

            text-align: center;
            vertical-align:center;
        }


        /* the third */
        .table-plugin-pricing{
            margin: auto;
            width: 70%;
            padding: 30px;
            background-color: transparent;
            border-collapse: collapse;
            border-spacing: 0;
        }

        /* .table-plugin-pricing td:nth-child(1) {
          width: 25%;
          height:auto;

          background-color: #fff !important;
          color: black;
          vertical-align: middle;


          } */

        /* the second */
        /* width: 20%;
        background-color: transparent;
        height:auto; */
        /* .table-plugin-pricing td:nth-child(2) {

              border: 1px solid #c4c4c4;
            min-width: 8%;
            padding: 10px 5px 10px 20px;
            word-break: normal;

        } */

        .give-some-space-dude{
            margin: 30px auto 45px;
        }


        .onpremise-container{
            color: black ;
            background-color: #fff !important;
        }

        .plugins-pricing{
            padding:50px;
            width:80%;
            margin: auto;
            background-color: inherit;
        }
        h1 {
            margin: .67em 0;
            font-size: 2em;
        }
        .tab-content-plugins-pricing div {
            background: #173d50;
        }

        /* .onpremise-container{
            background-color: #fff !important;
        } */
        .color-make-black{
            color:black;
        }
        .tip-icon {
            display: inline-block;
            width: 15px;
            height: 15px;
            background-image: url(https://cdn.auth0.com/website/assets/pages/pricing/img/tip-help-fc9f80876e.svg);
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: 50%;
            vertical-align: middle;
            margin: 0 0 2px 5px;
            opacity: .3;
        }
    </style>
    <script>

        function upgradeform(planType) {
            jQuery('#requestOrigin').val(planType);
            if(jQuery('#mo_customer_registered').val()==1)
                jQuery('#loginform').submit();
            else{
                location.href = jQuery('#mobacktoaccountsetup').attr('href');
            }

        }

        jQuery("input[name=sitetype]:radio").change(function() {

            if (this.value == 'multisite') {
                jQuery('.mosslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.momslp').addClass('is-visible').removeClass('is-hidden is-selected');

            }
        });

        jQuery(document).ready(function($){

            //document.getElementById("multisite").checked = true;
            if(jQuery('#mo_license_plan_selected').val() == 'multisite'){
                document.getElementById("multisite").checked = true;
            }
            if(document.getElementById("multisite").checked == true){
                jQuery('.mosslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.momslp').addClass('is-visible').removeClass('is-hidden is-selected');
            }

            //hide the subtle gradient layer (.cd-pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
            checkScrolling($('.cd-pricing-body'));
            $(window).on('resize', function(){
                window.requestAnimationFrame(function(){checkScrolling($('.cd-pricing-body'))});
            });
            $('.cd-pricing-body').on('scroll', function(){
                var selected = $(this);
                window.requestAnimationFrame(function(){checkScrolling(selected)});
            });

            function checkScrolling(tables){
                tables.each(function(){
                    var table= $(this),
                        totalTableWidth = parseInt(table.children('.cd-pricing-features').width()),
                        tableViewport = parseInt(table.width());
                    if( table.scrollLeft() >= totalTableWidth - tableViewport -1 ) {
                        table.parent('li').addClass('is-ended');
                    } else {
                        table.parent('li').removeClass('is-ended');
                    }
                });
            }

            //switch from monthly to annual pricing tables
            bouncy_filter($('.cd-pricing-container'));

            function bouncy_filter(container) {
                container.each(function(){
                    var pricing_table = $(this);
                    var filter_list_container = pricing_table.children('.cd-pricing-switcher'),
                        filter_radios = filter_list_container.find('input[type="radio"]'),
                        pricing_table_wrapper = pricing_table.find('.cd-pricing-wrapper');

                    //store pricing table items
                    var table_elements = {};
                    filter_radios.each(function(){
                        var filter_type = $(this).val();
                        table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="'+filter_type+'"]');
                    });

                    //detect input change event
                    filter_radios.on('change', function(event){
                        event.preventDefault();
                        //detect which radio input item was checked
                        var selected_filter = $(event.target).val();

                        //give higher z-index to the pricing table items selected by the radio input
                        show_selected_items(table_elements[selected_filter]);

                        //rotate each cd-pricing-wrapper
                        //at the end of the animation hide the not-selected pricing tables and rotate back the .cd-pricing-wrapper

                        if( !Modernizr.cssanimations ) {
                            hide_not_selected_items(table_elements, selected_filter);
                            pricing_table_wrapper.removeClass('is-switched');
                        } else {
                            pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
                                hide_not_selected_items(table_elements, selected_filter);
                                pricing_table_wrapper.removeClass('is-switched');
                                //change rotation direction if .cd-pricing-list has the .cd-bounce-invert class
                                if(pricing_table.find('.cd-pricing-list').hasClass('cd-bounce-invert')) pricing_table_wrapper.toggleClass('reverse-animation');
                            });
                        }
                    });
                });
            }
            function show_selected_items(selected_elements) {
                selected_elements.addClass('is-selected');
            }

            function hide_not_selected_items(table_containers, filter) {
                $.each(table_containers, function(key, value){
                    if ( key != filter ) {
                        $(this).removeClass('is-visible is-selected').addClass('is-hidden');

                    } else {
                        $(this).addClass('is-visible').removeClass('is-hidden is-selected');
                    }
                });
            }
        });
    </script>
<?php
}