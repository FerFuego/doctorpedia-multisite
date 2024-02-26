//------------      
// Fix Init Modal
//--------------
$(document).ready(function() {
    setTimeout(function() {
        $('#js-dropdown-conditions-menu').css({'display':'block'});
        $('#js-dropdown-channels-menu').css({'display':'block'});
        $('#js-dropdown-specialty-areas').css({'display':'block'});
    }, 1000);
});

(function ($) {
    $(function () {
        //------------      
        // Modal close
        //--------------
        $('.big-menu-conditions__cross').click(()=>{
            $('#js-dropdown-conditions-menu').css({'top':'-600px'});
            $('.big-menu-conditions__cross').css({'display':'none'});
        })

        if ($(window).width() > 768) {
            // DESKTOP
            $('.has-mega-menu').on('mouseover', function () {
                $('#js-dropdown-conditions-menu').css({'top':'87px'});
                $('#js-dropdown-channels-menu').css({'top':'-600px'});
                $('#js-dropdown-specialty-areas').css({'top':'-600px'});
                //--------------
                // Modal arrow
                //--------------
                $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({'left':$(this).offset().left + 30 + 'px', 'display':'block'});
                $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({'display':'none'});
                $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({'display':'none'});
                //--------------
                // Modal close
                //--------------
                $('.big-menu-conditions__cross').css({'display':'block'});
            });

            $('#js-dropdown-conditions-menu').on('mouseleave', function () {
                $(this).css({'top':'-600px'});
                //--------------
                // Modal arrow
                //--------------
                $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({'display':'none'});
                //--------------
                // Modal close
                //--------------
                $('.big-menu-conditions__cross').css({'display':'none'});
            });

            $('.has-channels-menu').on('mouseover', function () {
                $('#js-dropdown-channels-menu').css({'top':'87px'});
                $('#js-dropdown-conditions-menu').css({'top':'-600px'});
                $('#js-dropdown-specialty-areas').css({'top':'-600px'});
                //--------------
                // Modal arrow
                //--------------
                $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({'display':'none'});
                $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({'display':'none'});
                $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({'left': $(this).offset().left + 30 + 'px', 'display':'block'});
                //--------------
                // Modal close
                //--------------
                $('.big-menu-conditions__cross').css({'display':'none'});
            });

            $('.has-specialty-areas-menu').on('mouseover', function () {
                $('#js-dropdown-specialty-areas').css({'top':'87px', 'left': '-120px', 'right': '120px'});
                $('#js-dropdown-conditions-menu').css({'top':'-600px'});
                $('#js-dropdown-channels-menu').css({'top':'-600px'});
                //--------------
                // Modal arrow
                //--------------
                $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({'display':'none'});
                $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({'display':'none'});
                $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({'left': $(this).offset().left + 30 + 'px', 'display':'block'});
                //--------------
                // Modal close
                //--------------
                $('.big-menu-conditions__cross').css({'display':'none'});
            });

            $('#js-dropdown-channels-menu').on('mouseleave', function () {
                $(this).css({'top':'-600px'});
                $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({'display':'none'});
            });

            $('#js-dropdown-specialty-areas').on('mouseleave', function () {
                $(this).css({'top':'-600px'});
                $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({'display':'none'});
            });

        } else {
            // MOBILE
            //---------------------
            // Hamburger click
            //--------------------
            $('#js-hamburger-button').on('click', function () {
                $('.main-navigation').slideToggle(300);
                $(this).toggleClass('active');
                $('#js-dropdown-conditions-menu').addClass('d-none');
                $('#js-dropdown-channels-menu').addClass('d-none');
                $('#js-dropdown-specialty-areas').addClass('d-none');
            })
            //---------------------
            // Fix Children links
            //--------------------
            $('.js-site-link').on('click', function () {
                window.location = $(this).attr('href');
            })
            //---------------------
            // Condition dropdown
            //--------------------
            $('li.has-mega-menu, li.has-mega-menu a').on('click', function (ev) {
                ev.preventDefault();
                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active');
                    $('#js-dropdown-conditions-menu').addClass('d-none');
                    $('#js-dropdown-channels-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').addClass('d-none');
                } else {
                    $(this).parent().addClass('active');
                    $('#js-dropdown-conditions-menu').removeClass('d-none');
                    $('#js-dropdown-channels-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').addClass('d-none');
                }
                ev.stopPropagation();
                return false;
            })
            //---------------------
            // Fix Children links
            //--------------------
            $('#top_channels_menu > li > a').on('click', function () {
                window.location = $(this).attr('href');
            })
            //---------------------
            // Channels dropdown
            //--------------------
            $('.has-channels-menu, .has-channels-menu a').on('click', function (ev) {
                console.log('click');
                ev.preventDefault();
                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active');
                    $(this).parent().children('.container').remove();
                    $('#js-dropdown-channels-menu').addClass('d-none');
                    $('#js-dropdown-conditions-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').addClass('d-none');
                } else {
                    $(this).parent().addClass('active');
                    $('#js-dropdown-channels-menu').removeClass('d-none');
                    $('#js-dropdown-conditions-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').addClass('d-none');
                }
                ev.stopPropagation();
                return false;
            })
            //---------------------
            // Specialty Areas dropdown
            //--------------------
            $('.has-specialty-areas-menu, .has-specialty-areas-menu a').on('click', function (ev) {
                console.log('click 2');
                ev.preventDefault();
                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active');
                    $(this).parent().children('.container').remove();
                    $('#js-dropdown-channels-menu').addClass('d-none');
                    $('#js-dropdown-conditions-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').addClass('d-none');
                } else {
                    $(this).parent().addClass('active');
                    $('#js-dropdown-channels-menu').addClass('d-none');
                    $('#js-dropdown-conditions-menu').addClass('d-none');
                    $('#js-dropdown-specialty-areas').removeClass('d-none');
                }
                ev.stopPropagation();
                return false;
            })
        }
    });
})(jQuery);
