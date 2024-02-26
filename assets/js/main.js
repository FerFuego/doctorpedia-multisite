$(document).ready(function () {
    // Big Menu
    var divs = document.getElementsByClassName("site-card").length;

    if (divs <= 4 ) {
        $('.next_bigmenu').remove();
        $('.prev_bigmenu').remove();
    }

    $(".slick_bigmenu").slick({
        autoplay: true,
        autoplaySpeed: 1000,
        pauseOnDotsHover: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: $(".prev_bigmenu"),
        nextArrow: $(".next_bigmenu"),
        dots: ( $(window).width() < 769 ) ? true : false,
        responsive: [
            {
                breakpoint: 1930,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });

    // Navbar
    $('nav').addClass('home-default');
    //Menu
    $('.hamburger-menu').click(function () {
        $('.side-nav').css('left', '0%');
        $('.close-btn').css('left', '20%');

        //Tablet
        if ($(window).width() < 1025) {
            $('.side-nav').css('width', '50%');
            $('.close-btn').css('left', '45%');
        }

        if ($(window).width() < 767) {
            $('.side-nav').css('width', '100%');
            $('.close-btn').css('left', '90%');
            $('.sub-menu').slideUp(200);

            //SECONDARY HEADER
            $('.secondary-nav').css('background-color', '#4432a7');
            $('.secondary-nav .container').css('border-bottom', '0');
        }
    })

    $('.close-btn').click(function () {
        $('.side-nav').css('left', '-25%');
        $('.close-btn').css('left', '-20%');
        //Tablet
        if ($(window).width() < 1025) {
            $('.side-nav').css('left', '-50%');
            $('.close-btn').css('left', '-45%');
        }
        //Mobile
        if ($(window).width() < 767) {
            $('.side-nav').css('left', '-100%');
            $('.hamburger-menu').css('display', 'block');
            $('.sub-menu').slideDown(400);

            //SECONDARY HEADER
            $('.secondary-nav').css('background-color', '#303251');
            $('.secondary-nav .container').css('border-bottom', '1px solid #fff');
        }
    })

    //Explorer nav
    $('.explore').click(function () {
        $('.sub-menu').fadeOut(50);
        $('.explore-menu').slideDown('fast');
        $('nav').addClass('explorer-nav-active');

        // HAMBURGER
        $('#hamburger-icon').css('fill', '#CB214B');

        // LOGO
        $('#Logo-Red').css('fill', '#DF054E');
        $('.nav-logo').css('color', '#DF054E');
        $('#Logo-Blue').css('fill', '#2A2C39');

        // SEARCH
        $('#Magnify').css('stroke', '#DF054E');
        $('#Glass').css('fill', '#D8D8D8');

        if ($(window).width() < 767) {
            $('nav').removeClass('explorer-nav-active');
            $('nav .nav-container').css({ 'justify-content': 'center' });
            $('.hamburger-menu-container').css('display', 'none');

            // SEARCH
            $('.search-button').css('display', 'none');
            // CROSS
            $('.cross-icon').css('display', 'block');

            // HAMBURGER
            $('#hamburger-icon').css('fill', '#FFFFFF');
            $('.nav-logo').css('color', '#FFFFFF');

            // LOGO
            $('#Logo-Red').css('fill', '#FFFFFF');
            $('#Logo-Blue').css('fill', '#FFFFFF');

            // SEARCH
            $('#Magnify').css('stroke', '#FFFFFF');
            $('#Glass').css('fill', '#FFFFFF');

        }
    });

    if ($(window).width() < 767) {
        $('#top .current_page_item').click(function () {
            event.preventDefault();
            $('.sub-menu').fadeOut(50);
            $('.explore-menu').slideDown('fast');
            $('nav').addClass('explorer-nav-active');

            // HAMBURGER
            $('#hamburger-icon').css('fill', '#CB214B');

            $('nav .nav-container').css({ 'justify-content': 'center' });
            $('.hamburger-menu-container').css('display', 'none');
            $('.search-button').css('display', 'none');

            // LOGO
            $('#Logo-Red').css('fill', '#DF054E');
            $('#Logo-Blue').css('fill', '#2A2C39');

            // SEARCH
            $('#Magnify').css('stroke', '#DF054E');
            $('#Glass').css('fill', '#D8D8D8');

            $('nav').removeClass('explorer-nav-active');
            // HAMBURGER
            $('.hamburger-menu').css('visibility', 'hidden');
            // SEARCH
            $('.search-icon').css('display', 'none');
            // CROSS
            $('.cross-icon').css('display', 'block');

            // HAMBURGER
            $('#hamburger-icon').css('fill', '#FFFFFF');

            // LOGO
            $('#Logo-Red').css('fill', '#FFFFFF');
            $('#Logo-Blue').css('fill', '#FFFFFF');

            // SEARCH
            $('#Magnify').css('stroke', '#FFFFFF');
            $('#Glass').css('fill', '#FFFFFF');

        });
    }

    $('.cross').click(function () {

        // HAMBURGER
        $('#hamburger-icon').css('fill', '#FFFFFF');
        $('.hamburger-menu').css('visibility', 'initial');

        // LOGO
        $('#Logo-Red').css('fill', '#FFFFFF');
        $('#Logo-Blue').css('fill', '#FFFFFF');

        // SEARCH
        $('#Magnify').css('stroke', '#FFFFFF');
        $('#Glass').css('fill', '#FFFFFF');
        $('.nav-logo').css('color', '#FFFFFF');

        $('.cross-icon').css('display', 'none');

        $('.sub-menu').fadeIn(300);
        $('.explore-menu').slideUp('fast');
        $('nav').removeClass('explorer-nav-active');

        $('nav .nav-container').css({ 'justify-content': 'space-between' });
        $('.hamburger-menu-container').css('display', 'block');
        $('.search-button').css('display', 'block');
    });

    $('.cross-icon').click(function () {
        // HAMBURGER
        $('.hamburger-menu').css('visibility', 'initial');
        // SEARCH
        $('.search-icon').css('display', 'block');
        // CROSS
        $('.cross-icon').css('display', 'none');

        $('.sub-menu').fadeIn(300);
        $('.explore-menu').slideUp('fast');
        $('nav').removeClass('explorer-nav-active');

        $('nav .nav-container').css({ 'justify-content': 'space-between' });
        $('.hamburger-menu-container').css('display', 'block');
        $('.search-button').css('display', 'block');
    });

    //Navbar Footer
    $("#footer li a").each(function () {
        var title = $(this).attr('title');
        $("<h2>" + title + "</h2>").insertBefore(this);
    });

    // Profile Height
    const authorProfile = $('#js-author__profile');
    const authorContent = $('#js-author__content');

    /* let authorProfileHeight = $(authorProfile).height();
    $(authorContent).height(authorProfileHeight - 58); // 58 comes from the padding between the top of content and the nav
    $(authorContent).css({
        'max-height' : 'initial',
    }); */

    // Fixed nav when srolling
    const authorContentNav = $('#js-author__nav');

    $(authorContent).scroll(function () {
        if ($(authorContent).scrollTop() != 0) {
            $(authorContentNav).addClass('fixed');
        } else {
            $(authorContentNav).removeClass('fixed');
        }
    });

    // Bio Max words
    //$('.author__profile-bio').each(function() {
    const bioText = $('#js-author-profile-bio');
    if (bioText.text().length > 200) {
        let shortText = bioText.text();
        shortText = shortText.substring(0, 205);
        bioText.addClass('fullDescription').hide();
        bioText.append('<a class="read-less-link">Read less</a>');
        bioText.parent().append('<p class="preview"><span>' + shortText + '</span><a class="read-more-link mb-4">Read more</a></p>');
        $('.preview span').after('...');
    }
    //})

    $(document).on('click', '.read-more-link', function () {
        $(this).hide().parents().find('.preview').hide().siblings('p').show();
        $('.fullDescription').show();
    });

    $(document).on('click', '.read-less-link', function () {
        $(this).parent().hide().next().show();
        $(this).parents('.author__profile-bio').find('.read-more-link').show();
    });





    //--------------------------------------------------------
    // Lazy Load Imgs
    //--------------------------------------------------------
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy",
        threshold: 1000
    }); //End Lazy Load

    //Expert
    $('#btn-next').click(function () {
        var i, tabcontent, tablinks;
        var current = $('.tab > .active').next('button');
        var expertName = current[0]['dataset']['id'];

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].className = tabcontent[i].className.replace(" active", "");
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(expertName).style.display = "block";
        $('.' + current[0]['dataset']['id']).addClass('active');
    });

    //Expert
    $('#btn-prev').click(function () {
        var i, tabcontent, tablinks;
        var current = $('.tab > .active').prev('button');
        var expertName = current[0]['dataset']['id'];

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].className = tabcontent[i].className.replace(" active", "");
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(expertName).style.display = "block";
        $('.' + current[0]['dataset']['id']).addClass('active');
    });

    //Interactive map
    $('#close-map').click(function () {
        $('.location-description').css('display', 'none');
    });

    if ($(".adv-right").css('display') == 'none') {
        $('.blog-posts-page-container .body').css('justify-content', 'center');
    }

    //-----------------------------------
    // Newsletter Validation
    //-----------------------------------
    $('.mce_EMAIL').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.-_@]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });


    //---------------------
    // Hero animation cta (Home)
    //---------------------
    $('.keep-reading').click(() => {
        $("html, body").animate({
            scrollTop: $('.module-our-experts').offset().top - 80
        }, 500);
    });

    //---------------------
    // Hero animation cta (Landing)
    //---------------------
    $('.m-landing-hero__keep-reading').click(() => {
        $("html, body").animate({
            scrollTop: $('.m-landing-plataform').offset().top - 80
        }, 500);
    });

});

//Big Menu
$(window).on("resize", function() {
    $(".slick_bigmenu").not(".slick-initialized").slick("resize");
});

function ValidateNewsletterEmail(inputText) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (inputText.value.match(mailformat)) {
        return true;
    } else {
        alert("You have entered an invalid email address!");
        $('.mce_EMAIL').val('');
        event.preventDefault();
        return false;
    }
}

//Hide sidebar when not focused
$(document).on("click", function (e) {

    var sidebar = $(".side-nav");
    var hamburger = $(".hamburger-menu");

    if (!sidebar.is(e.target) && (sidebar.has(e.target).length === 0) && (!hamburger.is(e.target) && hamburger.has(e.target).length === 0)) {

        $('.side-nav').css('left', '-25%');
        $('.close-btn').css('left', '-20%');
        //Mobile
        if ($(window).width() < 1025) {
            $('.side-nav').css('left', '-50%');
            $('.close-btn').css('left', '-45%');
        }
        //Mobile
        if ($(window).width() < 767) {
            $('.side-nav').css('left', '-100%');
            $('.hamburger-menu').css('display', 'block');

        }
    }
});

//Tab Faqs
$('.faqs-navbar ul li').click(function () {

    var tab = $(this).attr('id');

    $(".faqs-navbar ul li").each(function () {
        $(this).removeClass('active');
    });

    $(this).addClass('active');

    $('.tab-group').children('div').fadeOut('fast');

    $('.tab-group').children('#' + tab).fadeIn('fast');

    if (tab == 'all') {
        $('.tab-group').children('div').fadeIn('fast');
    }
});

/**
 * Close Modal
 */
function closeModal() {
    $('#js-insert-article-modal').addClass('d-none');
    $('#js-insert-articles-img-modal').addClass('d-none');
    $('#js-draft-article-modal').addClass('d-none');
    $('.js-save-animation').removeClass('done');
    $('#js-modal-bio').addClass('d-none');
    $('#js-modal-video').addClass('d-none');
    $('#js-modal-location').addClass('d-none');
    $('#js-modal-education').addClass('d-none');
    $('#js-modal-publication').addClass('d-none');
    $('#js-modal-video-example').addClass('d-none');
    $('#js-modal-board-certification').addClass('d-none');
    $('#js-modal-expertise').addClass('d-none');
    $('#js-modal-delete-post').addClass('d-none');
    $('#js-bio-modal').addClass('d-none');
    $('#js-bio-modal-skip').addClass('d-none');
    $('#js-bio-modal-complete').addClass('d-none');
    $('#js-modal-delete-post').addClass('d-none');
    $('#js-repost-successful').addClass('d-none');
    $('#js-insert-repost').addClass('d-none');
    $('#js-terms-conditions').addClass('d-none');
    $('#js-terms-conditions-form').addClass('d-none');
}

 /**
 * Close Repost modal
 */
function CloseModalRegister() {
    $('#js-register-form').addClass('d-none');
}

//Tab Experts
function openExpert(evt, expertName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        tabcontent[i].className = tabcontent[i].className.replace(" active", "");
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(expertName).style.display = "block";
    evt.currentTarget.className += " active";
}

//items Search
$('.search-navbar ul li').click(function () {
    var item = $(this).attr('id');
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        //removeParameterToURL(item);
    } else {
        $(this).addClass('active');
        window.location.href = document.location.pathname + addUrlParam(document.location.search, 'tag', item);
        //addParameterToURL(item);
    }
});

$('.filter').click(function () {
    $('.search-navbar').slideToggle('fast');
    $('.filter a h2').toggleClass('active');
});

/**
* items Search
* Add a URL parameter (or changing it if it already exists)
* @param {search} string  this is typically document.location.search
* @param {key}    string  the key to set
* @param {val}    string  value 
*/
var addUrlParam = function (search, key, val) {
    var newParam = key + '=' + val,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (search) {
        // Try to replace an existance instance
        params = search.replace(new RegExp('([?&])' + key + '[^&]*'), '$1' + newParam);

        // If nothing was replaced, then add the new param to the end
        if (params === search) {
            params += '&' + newParam;
        }
    }

    return params;
};


/* 
*  Form 1 Resources Page Condition
*
*/
function formOneSubmit() {

    if (!$('#fullname_1').val() || $('#fullname_1').val() == null) {
        $('#message_1').html('<p class="text-danger">Complete the field Name</p>');
        return;
    }
    if (!$('#email_1').val() || $('#email_1').val() == null) {
        $('#message_1').html('<p class="text-danger">Complete the field Email</p>');
        return;
    }
    if (!$('#resource_1').val() || $('#resource_1').val() == null) {
        $('#message_1').html('<p class="text-danger">Complete the field Resources</p>');
        return;
    }
    if ($('#control_1').val() != '') {
        return;
    }

    const formValue = {
        fullname: $('#fullname_1').val(),
        email: $('#email_1').val(),
        resources: $('#resource_1').val(),
        type: $('#type_1').val()
    };

    $.ajax({
        method: "POST",
        url: location.origin + '/wp-content/themes/doctorpedia/inc/functions/save-form-resources.php',
        data: formValue,

        beforeSend: function () {
            $("#message_1").fadeIn('fast');
            $("#message_1").html('<p class="text-info">Sending....</p>');
        },

        success: function (response) {
            $("#message_1").html('<p class="text-success">' + response + '</p>');
        }
    });
}

/* 
*  Form 2 Resources Page Condition
*
*/
function formTwoSubmit() {

    if (!$('#fullname_2').val() || $('#fullname_2').val() == null) {
        $('#message_2').html('<p class="text-danger">Complete the field Name</p>');
        return;
    }
    if (!$('#email_2').val() || $('#email_2').val() == null) {
        $('#message_2').html('<p class="text-danger">Complete the field Email</p>');
        return;
    }
    if (!$('#resource_2').val() || $('#resource_2').val() == null) {
        $('#message_2').html('<p class="text-danger">Complete the field Resources</p>');
        return;
    }
    if ($('#control_2').val() != '') {
        return;
    }

    const formValue = {
        fullname: $('#fullname_2').val(),
        email: $('#email_2').val(),
        resources: $('#resource_2').val(),
        type: $('#type_2').val()
    };

    $.ajax({
        method: "POST",
        url: location.origin + '/wp-content/themes/doctorpedia/inc/functions/save-form-resources.php',
        data: formValue,

        beforeSend: function () {
            $("#message_2").fadeIn('fast');
            $("#message_2").html('<p class="text-info">Sending....</p>');
        },

        success: function (response) {
            $("#message_2").html('<p class="text-success">' + response + '</p>');
        }
    });
}

/**
 * Read More Header Text
 * 
 */
$('#js-ReadMoreHeaderText').click(function () {
    $('#js-HeaderText').css({ 'height': 'auto', 'transition': 'all 300ms' });
    $('#js-ReadMoreHeaderText').css({ 'display': 'none' });
});

/**
 * Read Less Header Text
 */
$('#js-ReadLessHeaderText').click(function () {
    if ($(window).width() <= 767) {
        $('#js-HeaderText').css({ 'height': '150px', 'transition': 'all 300ms' });
        $('#js-ReadMoreHeaderText').css({ 'display': 'block' });
    } else {
        $('#js-HeaderText').css({ 'height': '50px', 'transition': 'all 300ms' });
        $('#js-ReadMoreHeaderText').css({ 'display': 'block' });
    }
});

/**
 * Read More
 */
function readMore(id) {
    $('#js-show-' + id).css('display', 'none');
    $('#js-more-' + id).removeClass('d-none ');
}
/**
 * Read Less
 */
function readLess(id) {
    $('#js-more-' + id).addClass('d-none');
    $('#js-show-' + id).css('display', 'block');
}

/**
 * Modal Show
 */
function showModal() {
    $('#js-insert-review-modal').removeClass('d-none');
}
/**
 * Modal Hide
 */
function hideModal() {
    $('#js-insert-review-modal').addClass(' d-none');
}



/**
 * Stars in Input type Range
 */
$(document).ready(function () {
    var $s1input = $('#acf-field_5d64533dc0ab2c-field_app22c07ea20cf9');
    $('.acf-field-app22c07ea20cf9 .acf-range-wrap').hide();
    $('.acf-field-app22c07ea20cf9 .acf-input').starrr({
        max: 5,
        rating: $s1input.val(),
        change: function (e, value) {
            $s1input.val(value).trigger('input');
        }
    });
    
    var $s2input = $('#acf-field_5d64533dc0ab2c-field_app1w1c7ea20cf9');
    $('.acf-field-app1w1c7ea20cf9 .acf-range-wrap').hide();
    $('.acf-field-app1w1c7ea20cf9 .acf-input').starrr({
        max: 5,
        rating: $s2input.val(),
        change: function (e, value) {
            $s2input.val(value).trigger('input');
        }
    });
    
    var $s3input = $('#acf-field_5d64533dc0ab2c-field_app3w307ea20cf9');
    $('.acf-field-app3w307ea20cf9 .acf-range-wrap').hide();
    $('.acf-field-app3w307ea20cf9 .acf-input').starrr({
        max: 5,
        rating: $s3input.val(),
        change: function (e, value) {
            $s3input.val(value).trigger('input');
        }
    });
    
    var $s4input = $('#acf-field_5d64533dc0ab2c-field_app3w30723420cf9');
    $('.acf-field-app3w30723420cf9 .acf-range-wrap').hide();
    $('.acf-field-app3w30723420cf9 .acf-input').starrr({
        max: 5,
        rating: $s4input.val(),
        change: function (e, value) {
            $s4input.val(value).trigger('input');
        }
    });
    
    var $s5input = $('#acf-field_5d64533dc0ab2c-field_app3red7ea20cf9');
    $('.acf-field-app3red7ea20cf9 .acf-range-wrap').hide();
    $('.acf-field-app3red7ea20cf9 .acf-input').starrr({
        max: 5,
        rating: $s5input.val(),
        change: function (e, value) {
            $s5input.val(value).trigger('input');
        }
    });
});

/**
 * Hide inputs ACF_FORM
 */
$('.acf-field-group-rop54312').css({ 'display': 'none' });
$('.acf-field-group-rup522322').css({ 'display': 'none' });

/**
 * Success Submit
 */
$('#js-app-reviewed-cancel').click(function () {
    $('#js-app-reviewed-success').css({ 'display': 'none' });
});

/**
 * Stiky menu
 */

// Get the navbar
var navbar = document.getElementById("js-app-reviewed-header");

if (typeof (navbar) != 'undefined' && navbar != null) {

    // When the user scrolls the page, execute myFunction 
    window.onscroll = function () { myFunction() };
    // exists.
    var sticky = navbar.offsetTop + 100;

    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
            navbar.classList.add("container")
        } else {
            navbar.classList.remove("sticky")
            navbar.classList.remove("container")
        }
    }
}

/*!
 * This script animate links add class 'jumper'
 * 
 * 
 */
$(".jumper").on("click", function (e) {
    e.preventDefault();
    $("body, html").animate({
        scrollTop: $($(this).attr('href')).offset().top - 50
    }, 1500);
});

/**
 * Paginate User Reviews
 */
function showPage(elem, max) {

    var postPerPage = 10;
    var min = max - postPerPage;

    if (elem) {
        $('.page-numbers').removeClass('current');
        $(elem).addClass('current');
    }

    $('.js-reviews-container').each(function () {
        let elem = $(this).attr('data-id');
        if (elem > min && elem <= max) {
            $(this).addClass('d-block').removeClass('d-none');
        } else {
            $(this).addClass('d-none').removeClass('d-block');
        }
    })

    var el = document.getElementById("js-app-reviewed-header");
    el.scrollIntoView();
}

document.addEventListener('DOMContentLoaded', () => {

    var navi = document.getElementById("js-reviews-navigation");

    if (navi) {

        var elements = document.getElementsByClassName("js-reviews-container").length;
        var postPerPage = 10;
        var fix = ((elements % postPerPage) !== 0) ? 1 : 0;
        var pages = parseInt((elements / postPerPage) + fix);

        for (let index = 1; index <= pages; index++) {

            var newDiv = document.createElement("a");
            var current = (index == 1) ? 'current' : '';
            var next = parseInt(index) * parseInt(postPerPage);

            newDiv.setAttribute('class', 'page-numbers ' + current);
            newDiv.setAttribute('href', 'javascript:;');
            newDiv.setAttribute('onclick', 'showPage(this, ' + next + ')');
            newDiv.appendChild(document.createTextNode(index));

            navi.appendChild(newDiv);
        }

        showPage(null, postPerPage);
    }

});


// Magnific Popup
$('.image-popup-vertical-fit').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
        verticalFit: true
    }
});

// Magnific Popup Iframe
$('.js-popup-iframe').magnificPopup({
    type: 'iframe',
    iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' +
            '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
        patterns: {
            youtube: {
                index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                // Or null - full URL will be returned
                // Or a function that should return %id%, for example:
                // id: function(url) { return 'parsed id'; }
                src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
            },
            vimeo: {
                index: 'vimeo.com/',
                id: '/',
                src: '//player.vimeo.com/video/%id%?autoplay=1'
            },
            // you may add here more sources
        },
        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
    }
});

// Magnific Popup Iframe
$('.js-videos-iframe').magnificPopup({
    type: 'iframe',
    iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' +
            '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
    }
});


/**
 * Croudfunding form submit
 */
function hideHeaderCrowdfunding() {
    document.getElementById('js-formPreRegister').style.display = 'none';
}

if (document.getElementById('gform_1')) {
    document.getElementById('gform_1').addEventListener('submit', hideHeaderCrowdfunding);
}

/**
 * Channels ACF Module
 */
function changeTabPanel(elem, name) {
    /**
     * headers controls
     */
    $('.channels__navbar a').removeClass('active');

    $(elem).addClass('active');

    /**
     * tabs control 
     */
    $('.js-tabsPanels').each(function () {
        console.log($(this).attr('id') + '====' + name)
        if ($(this).attr('id') == name) {
            $(this).addClass('active')
        } else {
            $(this).removeClass('active')
        }
    })

}

function changeTabPanelMobile(elem, name) {
    /**
     * headers controls
     */
    $('.channels__navbar_mobile a').removeClass('active');
    $('.channels__navbar_mobile div').css('border-color', '#000000');
    $(elem).addClass('active');
    $(elem).parent().css('border-color', '#df054e');


    /**
     * tabs control 
     */
    $('.js-tabsPanels').each(function () {
        console.log($(this).attr('id') + '====' + name)
        if ($(this).attr('id') == name) {
            $(this).addClass('active')
        } else {
            $(this).removeClass('active')
        }
    })

}

//----------------------
//Buttons pre regiter modal
//------------------------

//OPEN
$('.js-pre-register-modal').on('click', () => {
    event.preventDefault();
    let modal = $('.m-pre-register ');
    modal.css('display', 'flex');
    modal.animate({
        opacity: 1
    }, 300);
    disableScroll();
});

//CLOSE
$('.js-pre-register-close').click(() => {
    let modal = $('.m-pre-register ');
    modal.animate({
        opacity: 0
    }, 300, () => {
        modal.css('display', 'none');
        enableScroll();
    });

    //Reset form when its close
    $('.medium[name="input_1"]')[0].value = "";
    $('.medium[name="input_3"]')[0].value = "";
    $('.medium[name="input_4"]')[0].value = "";
    $('#input_2_5_1')[0].checked = false;
});

/*************** EVENT SCROLL OMITTER *******************************/
var keys = { 37: 1, 38: 1, 39: 1, 40: 1 };

function preventDefault(e) {
    e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
    window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () { supportsPassive = true; }
    }));
} catch (e) { }

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
    window.removeEventListener('touchmove', preventDefault, wheelOpt);
    window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}


/**
 * Faqs tabs
 */
$('.js-faqs__faq-wrapper').on('click', '.js-faqs__faq', function () {
    $('.js-faqs__faq').children('.js-faqs__faq-description').slideUp();
    $('.js-faqs__faq').removeClass('open');
    $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration','.5s');
    $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transform','rotate(0deg)');

    if ($(this).children('.js-faqs__faq-description').is(':visible')) {
        $(this).children('.js-faqs__faq-description').slideUp();
        $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration','.5s');
        $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transform','rotate(0deg)');
        $(this).removeClass('open');
    } else {
        $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration','.5s');
        $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transform','rotate(180deg)');
        $(this).children('.js-faqs__faq-description').slideDown();
        $(this).addClass('open');
    }
});
$(document).on('mouseup', function (e) {
    var container = $('.js-faqs__faq'); 

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.js-faqs__faq').children('.js-faqs__faq-description').slideUp();
        $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration','.5s');
        $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transform','rotate(0deg)');
        $('.js-faqs__faq').removeClass('open');
    }
});

/**
 * Tabs find doctors
 */
$(function() {
    var $tabButtonItem = $('#tab-button li'),
        $tabSelect = $('#tab-select'),
        $tabContents = $('.tab-content'),
        activeClass = 'is-active';
  
    $tabButtonItem.first().addClass(activeClass);
    $tabContents.not(':first').hide();
  
    $tabButtonItem.find('a').on('click', function(e) {
      var target = $(this).attr('href');
  
      $tabButtonItem.removeClass(activeClass);
      $(this).parent().addClass(activeClass);
      $tabSelect.val(target);
      $tabContents.hide();
      $(target).show();
      e.preventDefault();
    });
  
    $tabSelect.on('change', function() {
      var target = $(this).val(),
          targetSelectNum = $(this).prop('selectedIndex');
  
      $tabButtonItem.removeClass(activeClass);
      $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
      $tabContents.hide();
      $(target).show();
    });
});

/**
 * Footbar - Public Profile
 */
function footbarToggle() {
    $('.footbar').toggleClass('footbar--active');
    $('.footbar__cta').toggleClass('footbar__cta--active');
    $('.footbar__slideup').toggleClass('footbar__slideup--active');
}

// Popup Contact
$('.js-form-contact').click(function () {
    $('.c-modal').addClass('c-modal__active');
    $('#masthead').css('z-index','1');
});

$('.c-modal__close').click(function () {
    $('.c-modal').removeClass('c-modal__active');
    $('#masthead').css('z-index','3');
});

/**
 * Podcasts
 */
 function playPodcastSingle () {
    $('.mejs-play button').click();
    $('#js-player-podcast').removeClass('d-none');
    $('.js-play-button').addClass('d-none');
    console.log('Podcast');
}

/**
 * Module Landing Video
 */
 $('.js-videos-iframe2').magnificPopup({
    type: 'iframe',
    iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' +
            '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
    }
});

/**
 * Module Affiliate Hero
 */
 $('.js-videos-iframe-3').magnificPopup({
    type: 'iframe',
    iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' +
            '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
    }
});

/**
 * Slider servides (Landing)
 */
$(document).ready(function() {
    $('.m-landing-testimonials__slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode:true,
                centerPadding: '0px',
                dots: true
            }
        },{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode:true,
                dots: true,
                centerPadding: '150px',
            }
        },{
            breakpoint: 645,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode:true,
                dots: true,
                centerPadding: '0px',
            }
        }]
    });
});

