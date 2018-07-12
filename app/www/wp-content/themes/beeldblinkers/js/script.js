'use strict';
// Avoid `console` errors in browsers that lack a console.

jQuery(document).ready(function ($) {

    //console.log('testing console');

    var navMain = $('.nav__main');
    var siteHeader = $('.site__header');
    var siteBody = $('body');

    siteBody.on('click', '.open_nav', function(event) {

        if (!navMain.hasClass('is-active')) {
            event.preventDefault();

            navMain.addClass('is-active');
            siteBody.addClass('nav-active');

        } else {
            event.preventDefault();
        }

    });

    siteBody.on('click', '.close_nav', function(event) {

        if (navMain.hasClass('is-active')) {
            event.preventDefault();

            navMain.removeClass('is-active');
            siteBody.removeClass('nav-active');

        } else {
            event.preventDefault();
        }

    });

    siteBody.on('click', '.menu-item-has-children > a', function(event) {

        event.preventDefault();
        $(this).closest('.menu-item-has-children').toggleClass('tapped');

    });

    siteBody.on('click', '.question > .question_wrap', function(event) {

        event.preventDefault();
        $(this).closest('.question').stop().toggleClass('showanswer');

    });


    var $carousel = $('.slides').flickity({
        imagesLoaded: true,
        //percentPosition: false,
        cellAlign: 'left',
        contain: true,
        prevNextButtons: true,
        pageDots: false,
        dragThreshold: 10,
        adaptiveHeight: false
    });

    var slidesCell = $('.slides-cell');

    // $carousel.fadeIn(3000)
    $carousel.show()
    // resize after un-hiding Flickity
        .flickity('resize');

    //Click anywhere on the page to get rid of lightbox window
    siteBody.on('click', '.scrollto', function(e) {
        //must use live, as the lightbox element is inserted into the DOM
        e.preventDefault();
        var scrollTo = $(this).find("a").attr("href");

        if ( siteBody.hasClass( "home" ) ) {

            //console.log("home =" + " true")
            //console.log("want to scroll to: " + scrollTo);

            $('html, body').animate({
                scrollTop: $(scrollTo).offset().top +0
            }, 600);

        } else {

            location.href = '//' + document.location.host + "/" + scrollTo;

            // console.log("//" + document.location.host + "/" + scrollTo);
            //
            // console.log("Output;");
            // console.log(location.hostname);
            // console.log(document.domain);
            // // alert(window.location.hostname)
            //
            // console.log("document.URL : "+document.URL);
            // console.log("document.location.href : "+document.location.href);
            // console.log("document.location.origin : "+document.location.origin);
            // console.log("document.location.hostname : "+document.location.hostname);
            // console.log("document.location.host : "+document.location.host);
            // console.log("document.location.pathname : "+document.location.pathname);


        }

    });

    //open search bar in main nav
    siteBody.on('click', '.open_search', function(e) {
        e.preventDefault();
        $(this).closest('.site__header').addClass('searchbar_active');
    });

    //close search bar in main nav
    siteBody.on('click', '.close_main_nav_search', function(e) {
        e.preventDefault();
        $(this).closest('.site__header').removeClass('searchbar_active');
    });

});