"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var Animations = /*#__PURE__*/function () {
  function Animations() {
    _classCallCheck(this, Animations);
  }

  _createClass(Animations, [{
    key: "staggered",
    value: function staggered() {
      var elements = document.querySelectorAll('.js-staggered');
      elements.forEach(function (element) {
        element.waypoint = new Waypoint({
          element: element,
          handler: function handler(direction) {
            anime({
              targets: element.querySelectorAll('.js-staggered-item'),
              translateY: [-220, 0],
              opacity: [0, 1],
              easing: 'easeInOutQuad',
              duration: 500,
              delay: anime.stagger(300, {
                start: 500
              })
            });
            this.destroy();
          },
          horizontal: false,
          offset: '90%'
        });
      });
    }
  }]);

  return Animations;
}();
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var Debounce = /*#__PURE__*/function () {
  function Debounce(_ref) {
    var input = _ref.input,
        time = _ref.time,
        doneFunction = _ref.doneFunction;

    _classCallCheck(this, Debounce);

    this.input = input;
    this.time = time ? time : 500;
    this.done = doneFunction;

    this.executeOnDebounce = function (callback) {
      callback(this.input.value);
    };

    this.init();
  }

  _createClass(Debounce, [{
    key: "init",
    value: function init() {
      //setup before functions
      var typingTimer; //timer identifier

      var doneTypingInterval = this.time; //time in ms, 5 second for example

      var $input = this.input; //on keyup, start the countdown

      $input.addEventListener('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
      }); //on keydown, clear the countdown 

      $input.addEventListener('keydown', function () {
        clearTimeout(typingTimer);
      }); //user is "finished typing," do something

      var self = this;

      function doneTyping() {
        self.executeOnDebounce(self.done);
      }
    }
  }]);

  return Debounce;
}();
"use strict";

/**
 * 
 * Doctor Directory Layout 
 */
function resizeGridItem(item) {
  var grid = $("#js-doctorDirectory");
  var rowHeight = parseInt(grid.css('grid-auto-rows'));
  var rowGap = parseInt(grid.css('grid-row-gap'));
  var rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
  item.style.gridRowEnd = "span " + rowSpan;
  item.querySelector('.content').style.height = "auto";
}

function resizeAllGridItems() {
  var allItems = document.getElementsByClassName("js-expertCard");

  for (var x = 0; x < allItems.length; x++) {
    resizeGridItem(allItems[x]);
  }
}

function resizeInstance(instance) {
  var item = instance.elements[0];
  resizeGridItem(item);
}

window.onload = resizeAllGridItems();
window.addEventListener("resize", resizeAllGridItems);
/**
 * Doctor Directory Search
 */

function searchDoctorDirectory() {
  var current_page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  return function (current_page) {
    var sortBy = $('#sortBy').val();
    var specialty = $('#searchSpecialty').val();
    var expertise = $('#searchExpertise').val();
    var current_page = current_page ? current_page : $('#current_page').val();
    var formData = new FormData();
    formData.append('action', 'searchDoctorDirectory');
    formData.append('specialty', specialty);
    formData.append('expertise', expertise);
    formData.append('sortBy', sortBy);
    formData.append('current_page', current_page);
    jQuery.ajax({
      cache: false,
      url: bms_vars.ajaxurl,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        $('#js-doctorDirectoryPaginator').addClass('d-none');
        $('#js-doctorDirectory').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader">');
      },
      success: function success(response) {
        $('#js-doctorDirectoryPaginator').removeClass('d-none');
        $('#js-doctorDirectory').html(response.data.html);
        $('#js-doctorDirectoryPaginator').html(response.data.paginator);
      },
      complete: function complete() {
        resizeAllGridItems();
      }
    });
  }(current_page);
}

$('#searchSpecialty').on('change', function () {
  searchDoctorDirectory();
});
$('#searchExpertise').on('change', function () {
  searchDoctorDirectory();
});
$('#sortBy').on('change', function () {
  searchDoctorDirectory();
});
/**
 * Filter by name DD 
 */

function filterToProfile(obj) {
  if (obj.value == '') {
    searchDoctorDirectory();
    return;
  }

  var formData = new FormData();
  formData.append('action', 'filterDoctorDirectory');
  formData.append('expert_id', obj.value);
  jQuery.ajax({
    cache: false,
    url: bms_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $('#js-doctorDirectoryPaginator').addClass('d-none');
      $('#js-doctorDirectory').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader">');
    },
    success: function success(response) {
      $('#js-doctorDirectoryPaginator').removeClass('d-none');
      $('#js-doctorDirectory').html(response.data.html);
      $('#js-doctorDirectoryPaginator').html(response.data.paginator);
    },
    complete: function complete() {
      resizeAllGridItems();
    }
  });
}
/**
 * Module Hero DD
 */


$(document).ready(function () {
  /**
   * selectpicker options https://developer.snapappointments.com/bootstrap-select/options/#bootstrap-version
   */
  $('#searchSpecialty').selectpicker({
    virtualScroll: false
  });
  $('#searchExpertise').selectpicker({
    virtualScroll: false
  });
  $('#sortBy').selectpicker({
    virtualScroll: false
  });
  $('#filterByExpert').selectpicker({
    virtualScroll: false
  });
});
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

jQuery(document).ready(function () {
  var Explore = /*#__PURE__*/function () {
    function Explore(module) {
      _classCallCheck(this, Explore);

      this.slider = module.querySelector('.js-explore-slider');
      this.searchWrapper = module.querySelector('.js-search-wrapper');
      this.searchInput = module.querySelector('.js-explore-search');
      this.searchValue = '';
      this.dropdownBtn = module.querySelector('.js-explore-open-close-dropdown');
      this.results = module.querySelector('.js-explore-results');
      this.sliderRun(); //this.search();  // Not implemented

      this.dropdown();
    }

    _createClass(Explore, [{
      key: "sliderRun",
      value: function sliderRun() {
        $(this.slider).slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3,
          responsive: [{
            breakpoint: 850,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }, {
            breakpoint: 620,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '40px'
            }
          }]
        });
      }
    }, {
      key: "search",
      value: function search() {
        var _this = this;

        new Debounce({
          input: this.searchInput,
          time: 300,
          doneFunction: function doneFunction(value) {
            _this.searchValue = value;

            _this.ajaxCall();
          }
        });
      }
    }, {
      key: "ajaxCall",
      value: function ajaxCall() {
        var self = this;
        $.ajax({
          method: "GET",
          url: location.origin + '/wp-json/doctorpedia/v2/channels-taxonomy',
          data: {
            'search': self.searchValue
          },
          success: function success(response) {
            self.results.innerHTML = response.data;

            if (self.searchValue != '') {
              self.searchWrapper.classList.add('open');
            } else {
              self.searchWrapper.classList.remove('open');
            }
          },
          error: function error(_error) {
            console.log(_error);
          }
        });
      }
    }, {
      key: "dropdown",
      value: function dropdown() {
        var self = this;
        this.searchInput.addEventListener('click', function () {
          self.searchWrapper.classList.toggle('open');
        });
        this.dropdownBtn.addEventListener('click', function () {
          self.searchWrapper.classList.toggle('open');
        });
      }
    }]);

    return Explore;
  }();

  var exploreModules = document.querySelectorAll('.js-explore-module');
  exploreModules.forEach(function (module) {
    new Explore(module);
  });
});
"use strict";

$(document).ready(function () {
  // add autocomplete off inputs
  $.each($('.affiliate-form').serializeArray(), function (i, field) {
    $('input[name="' + field.name + '"]').attr('autocomplete', 'off');
  });

  if (document.querySelector('.input__code') !== null) {
    $(".input__code .medium").parent().append('<div class="text-danger js-gf-message-4"></div>');
    $(".input__code .medium").parent().append('<div class="text-danger js-gf-loader"></div>');
    $('.gform_button').attr('disabled', true);
    $('.affiliate-form').attr('autocomplete', 'off'); // listener for GET vars

    var code = getQueryVariable('code');

    if (code) {
      $(".input__code .medium").val(code);
      $('.gform_button').removeAttr('disabled');
    } // listener form affiliate - input code 


    $(".input__code .medium").keyup(function () {
      var input__code = $(this);
      var formData = new FormData();
      formData.append('action', ajax_var.action);
      formData.append('code', input__code.val());
      formData.append('nonce', ajax_var.nonce);
      jQuery.ajax({
        cache: false,
        url: ajax_var.url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function beforeSend() {
          $('.js-gf-loader').html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="15px">');
        },
        success: function success(response) {
          $('.js-gf-loader').html('');

          if (response.data.status == 'error') {
            input__code.css('border', '1px solid red');
            $('.js-gf-message-4').html('Invalid Code');
            $('.gform_button').attr('disabled', true);
          } else {
            input__code.css('border', '1px solid green');
            $('.js-gf-message-4').html('');
            $('.gform_button').removeAttr('disabled');
          }
        }
      });
    });
  }
  /* Form Gravity */


  $('#gform_submit_button_6').click(function () {
    $('#js-register-form').removeClass('d-none');
    var email = $('#input_6_1').val();
    $('#user_email').val(email);
  });
  /* Form Register */

  jQuery('#js-form-register').submit(function (event) {
    event.preventDefault();

    if ($('#user_fistname').val() == '') {
      $("#js-register-messageForm").html('<p class="text-danger">Please complete Fist Name</p>');
      return;
    }

    if ($('#user_lastname').val() == '') {
      $("#js-register-messageForm").html('<p class="text-danger">Please complete Last Name</p>');
      return;
    }

    if ($('#user_email').val() == '') {
      $("#js-register-messageForm").html('<p class="text-danger">Please complete Email</p>');
      return;
    }

    if ($('#user_pass').val() == '') {
      $("#js-register-messageForm").html('<p class="text-danger">Please complete Password</p>');
      return;
    }

    if ($('#user_repass').val() == '') {
      $("#js-register-messageForm").html('<p class="text-danger">Please complete Confirm Password</p>');
      return;
    }

    if ($('#user_repass').val() !== $('#user_pass').val()) {
      $("#js-register-messageForm").html('<p class="text-danger">Passwords don\'t match</p>');
      return;
    }

    if ($('#terms').is(':checked')) {} else {
      $("#js-register-messageForm").html('<p class="text-danger">Please Accept Terms & Conditions</p>');
      return;
    }

    var formData = new FormData();
    formData.append('action', 'blogging_Register');
    formData.append('user_fistname', $('#user_fistname').val());
    formData.append('user_lastname', $('#user_lastname').val());
    formData.append('user_email', $('#user_email').val());
    formData.append('user_pass', $('#user_pass').val());
    jQuery.ajax({
      cache: false,
      url: $('#js-form-register').attr('action'),
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        $("#js-register-messageForm").fadeIn('fast');
        $("#js-register-messageForm").html('<p class="text-info">Sending....</p>');
      },
      success: function success(response) {
        if (response.success == true) {
          $("#js-register-messageForm").html('<p class="text-success">Your registration has been successful! redirecting...</p>');
          $("#js-register-submit").attr('disabled:disabled');
          $(location).attr('href', '/doctor-platform/complete-bio/');
        } else {
          $("#js-register-messageForm").html('<p class="text-danger">' + response.data + '</p>');
        }
      }
    });
    return false;
  });
}); // search var from url

function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");

  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");

    if (pair[0] == variable) {
      return pair[1];
    }
  }

  return false;
}
/**
* Open modal terms
*/


function open_modal_terms_form() {
  $('#js-terms-conditions-form').removeClass('d-none');
}

function closeTermsModal() {
  $('#js-terms-conditions-form').addClass('d-none');
}

function hide_terms_modal() {
  $('#terms').prop("checked", true);
  $('#js-terms-conditions-form').addClass('d-none');
}
/**
* Close Repost modal
*/


function CloseModalRegister() {
  $('#js-register-form').addClass('d-none');
}
"use strict";

$(document).ready(function () {
  // Big Menu
  var divs = document.getElementsByClassName("site-card").length;

  if (divs <= 4) {
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
    dots: $(window).width() < 769 ? true : false,
    responsive: [{
      breakpoint: 1930,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1200,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 450,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  }); // Navbar

  $('nav').addClass('home-default'); //Menu

  $('.hamburger-menu').click(function () {
    $('.side-nav').css('left', '0%');
    $('.close-btn').css('left', '20%'); //Tablet

    if ($(window).width() < 1025) {
      $('.side-nav').css('width', '50%');
      $('.close-btn').css('left', '45%');
    }

    if ($(window).width() < 767) {
      $('.side-nav').css('width', '100%');
      $('.close-btn').css('left', '90%');
      $('.sub-menu').slideUp(200); //SECONDARY HEADER

      $('.secondary-nav').css('background-color', '#4432a7');
      $('.secondary-nav .container').css('border-bottom', '0');
    }
  });
  $('.close-btn').click(function () {
    $('.side-nav').css('left', '-25%');
    $('.close-btn').css('left', '-20%'); //Tablet

    if ($(window).width() < 1025) {
      $('.side-nav').css('left', '-50%');
      $('.close-btn').css('left', '-45%');
    } //Mobile


    if ($(window).width() < 767) {
      $('.side-nav').css('left', '-100%');
      $('.hamburger-menu').css('display', 'block');
      $('.sub-menu').slideDown(400); //SECONDARY HEADER

      $('.secondary-nav').css('background-color', '#303251');
      $('.secondary-nav .container').css('border-bottom', '1px solid #fff');
    }
  }); //Explorer nav

  $('.explore').click(function () {
    $('.sub-menu').fadeOut(50);
    $('.explore-menu').slideDown('fast');
    $('nav').addClass('explorer-nav-active'); // HAMBURGER

    $('#hamburger-icon').css('fill', '#CB214B'); // LOGO

    $('#Logo-Red').css('fill', '#DF054E');
    $('.nav-logo').css('color', '#DF054E');
    $('#Logo-Blue').css('fill', '#2A2C39'); // SEARCH

    $('#Magnify').css('stroke', '#DF054E');
    $('#Glass').css('fill', '#D8D8D8');

    if ($(window).width() < 767) {
      $('nav').removeClass('explorer-nav-active');
      $('nav .nav-container').css({
        'justify-content': 'center'
      });
      $('.hamburger-menu-container').css('display', 'none'); // SEARCH

      $('.search-button').css('display', 'none'); // CROSS

      $('.cross-icon').css('display', 'block'); // HAMBURGER

      $('#hamburger-icon').css('fill', '#FFFFFF');
      $('.nav-logo').css('color', '#FFFFFF'); // LOGO

      $('#Logo-Red').css('fill', '#FFFFFF');
      $('#Logo-Blue').css('fill', '#FFFFFF'); // SEARCH

      $('#Magnify').css('stroke', '#FFFFFF');
      $('#Glass').css('fill', '#FFFFFF');
    }
  });

  if ($(window).width() < 767) {
    $('#top .current_page_item').click(function () {
      event.preventDefault();
      $('.sub-menu').fadeOut(50);
      $('.explore-menu').slideDown('fast');
      $('nav').addClass('explorer-nav-active'); // HAMBURGER

      $('#hamburger-icon').css('fill', '#CB214B');
      $('nav .nav-container').css({
        'justify-content': 'center'
      });
      $('.hamburger-menu-container').css('display', 'none');
      $('.search-button').css('display', 'none'); // LOGO

      $('#Logo-Red').css('fill', '#DF054E');
      $('#Logo-Blue').css('fill', '#2A2C39'); // SEARCH

      $('#Magnify').css('stroke', '#DF054E');
      $('#Glass').css('fill', '#D8D8D8');
      $('nav').removeClass('explorer-nav-active'); // HAMBURGER

      $('.hamburger-menu').css('visibility', 'hidden'); // SEARCH

      $('.search-icon').css('display', 'none'); // CROSS

      $('.cross-icon').css('display', 'block'); // HAMBURGER

      $('#hamburger-icon').css('fill', '#FFFFFF'); // LOGO

      $('#Logo-Red').css('fill', '#FFFFFF');
      $('#Logo-Blue').css('fill', '#FFFFFF'); // SEARCH

      $('#Magnify').css('stroke', '#FFFFFF');
      $('#Glass').css('fill', '#FFFFFF');
    });
  }

  $('.cross').click(function () {
    // HAMBURGER
    $('#hamburger-icon').css('fill', '#FFFFFF');
    $('.hamburger-menu').css('visibility', 'initial'); // LOGO

    $('#Logo-Red').css('fill', '#FFFFFF');
    $('#Logo-Blue').css('fill', '#FFFFFF'); // SEARCH

    $('#Magnify').css('stroke', '#FFFFFF');
    $('#Glass').css('fill', '#FFFFFF');
    $('.nav-logo').css('color', '#FFFFFF');
    $('.cross-icon').css('display', 'none');
    $('.sub-menu').fadeIn(300);
    $('.explore-menu').slideUp('fast');
    $('nav').removeClass('explorer-nav-active');
    $('nav .nav-container').css({
      'justify-content': 'space-between'
    });
    $('.hamburger-menu-container').css('display', 'block');
    $('.search-button').css('display', 'block');
  });
  $('.cross-icon').click(function () {
    // HAMBURGER
    $('.hamburger-menu').css('visibility', 'initial'); // SEARCH

    $('.search-icon').css('display', 'block'); // CROSS

    $('.cross-icon').css('display', 'none');
    $('.sub-menu').fadeIn(300);
    $('.explore-menu').slideUp('fast');
    $('nav').removeClass('explorer-nav-active');
    $('nav .nav-container').css({
      'justify-content': 'space-between'
    });
    $('.hamburger-menu-container').css('display', 'block');
    $('.search-button').css('display', 'block');
  }); //Navbar Footer

  $("#footer li a").each(function () {
    var title = $(this).attr('title');
    $("<h2>" + title + "</h2>").insertBefore(this);
  }); // Profile Height

  var authorProfile = $('#js-author__profile');
  var authorContent = $('#js-author__content');
  /* let authorProfileHeight = $(authorProfile).height();
  $(authorContent).height(authorProfileHeight - 58); // 58 comes from the padding between the top of content and the nav
  $(authorContent).css({
      'max-height' : 'initial',
  }); */
  // Fixed nav when srolling

  var authorContentNav = $('#js-author__nav');
  $(authorContent).scroll(function () {
    if ($(authorContent).scrollTop() != 0) {
      $(authorContentNav).addClass('fixed');
    } else {
      $(authorContentNav).removeClass('fixed');
    }
  }); // Bio Max words
  //$('.author__profile-bio').each(function() {

  var bioText = $('#js-author-profile-bio');

  if (bioText.text().length > 200) {
    var shortText = bioText.text();
    shortText = shortText.substring(0, 205);
    bioText.addClass('fullDescription').hide();
    bioText.append('<a class="read-less-link">Read less</a>');
    bioText.parent().append('<p class="preview"><span>' + shortText + '</span><a class="read-more-link mb-4">Read more</a></p>');
    $('.preview span').after('...');
  } //})


  $(document).on('click', '.read-more-link', function () {
    $(this).hide().parents().find('.preview').hide().siblings('p').show();
    $('.fullDescription').show();
  });
  $(document).on('click', '.read-less-link', function () {
    $(this).parent().hide().next().show();
    $(this).parents('.author__profile-bio').find('.read-more-link').show();
  }); //--------------------------------------------------------
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
  }); //Expert

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
  }); //Interactive map

  $('#close-map').click(function () {
    $('.location-description').css('display', 'none');
  });

  if ($(".adv-right").css('display') == 'none') {
    $('.blog-posts-page-container .body').css('justify-content', 'center');
  } //-----------------------------------
  // Newsletter Validation
  //-----------------------------------


  $('.mce_EMAIL').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9.-_@]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  }); //---------------------
  // Hero animation cta (Home)
  //---------------------

  $('.keep-reading').click(function () {
    $("html, body").animate({
      scrollTop: $('.module-our-experts').offset().top - 80
    }, 500);
  }); //---------------------
  // Hero animation cta (Landing)
  //---------------------

  $('.m-landing-hero__keep-reading').click(function () {
    $("html, body").animate({
      scrollTop: $('.m-landing-plataform').offset().top - 80
    }, 500);
  });
}); //Big Menu

$(window).on("resize", function () {
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
} //Hide sidebar when not focused


$(document).on("click", function (e) {
  var sidebar = $(".side-nav");
  var hamburger = $(".hamburger-menu");

  if (!sidebar.is(e.target) && sidebar.has(e.target).length === 0 && !hamburger.is(e.target) && hamburger.has(e.target).length === 0) {
    $('.side-nav').css('left', '-25%');
    $('.close-btn').css('left', '-20%'); //Mobile

    if ($(window).width() < 1025) {
      $('.side-nav').css('left', '-50%');
      $('.close-btn').css('left', '-45%');
    } //Mobile


    if ($(window).width() < 767) {
      $('.side-nav').css('left', '-100%');
      $('.hamburger-menu').css('display', 'block');
    }
  }
}); //Tab Faqs

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
} //Tab Experts


function openExpert(evt, expertName) {
  // Declare all variables
  var i, tabcontent, tablinks; // Get all elements with class="tabcontent" and hide them

  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    tabcontent[i].className = tabcontent[i].className.replace(" active", "");
  } // Get all elements with class="tablinks" and remove the class "active"


  tablinks = document.getElementsByClassName("tablinks");

  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab


  document.getElementById(expertName).style.display = "block";
  evt.currentTarget.className += " active";
} //items Search


$('.search-navbar ul li').click(function () {
  var item = $(this).attr('id');

  if ($(this).hasClass('active')) {
    $(this).removeClass('active'); //removeParameterToURL(item);
  } else {
    $(this).addClass('active');
    window.location.href = document.location.pathname + addUrlParam(document.location.search, 'tag', item); //addParameterToURL(item);
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

var addUrlParam = function addUrlParam(search, key, val) {
  var newParam = key + '=' + val,
      params = '?' + newParam; // If the "search" string exists, then build params from it

  if (search) {
    // Try to replace an existance instance
    params = search.replace(new RegExp('([?&])' + key + '[^&]*'), '$1' + newParam); // If nothing was replaced, then add the new param to the end

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

  var formValue = {
    fullname: $('#fullname_1').val(),
    email: $('#email_1').val(),
    resources: $('#resource_1').val(),
    type: $('#type_1').val()
  };
  $.ajax({
    method: "POST",
    url: location.origin + '/wp-content/themes/doctorpedia/inc/functions/save-form-resources.php',
    data: formValue,
    beforeSend: function beforeSend() {
      $("#message_1").fadeIn('fast');
      $("#message_1").html('<p class="text-info">Sending....</p>');
    },
    success: function success(response) {
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

  var formValue = {
    fullname: $('#fullname_2').val(),
    email: $('#email_2').val(),
    resources: $('#resource_2').val(),
    type: $('#type_2').val()
  };
  $.ajax({
    method: "POST",
    url: location.origin + '/wp-content/themes/doctorpedia/inc/functions/save-form-resources.php',
    data: formValue,
    beforeSend: function beforeSend() {
      $("#message_2").fadeIn('fast');
      $("#message_2").html('<p class="text-info">Sending....</p>');
    },
    success: function success(response) {
      $("#message_2").html('<p class="text-success">' + response + '</p>');
    }
  });
}
/**
 * Read More Header Text
 * 
 */


$('#js-ReadMoreHeaderText').click(function () {
  $('#js-HeaderText').css({
    'height': 'auto',
    'transition': 'all 300ms'
  });
  $('#js-ReadMoreHeaderText').css({
    'display': 'none'
  });
});
/**
 * Read Less Header Text
 */

$('#js-ReadLessHeaderText').click(function () {
  if ($(window).width() <= 767) {
    $('#js-HeaderText').css({
      'height': '150px',
      'transition': 'all 300ms'
    });
    $('#js-ReadMoreHeaderText').css({
      'display': 'block'
    });
  } else {
    $('#js-HeaderText').css({
      'height': '50px',
      'transition': 'all 300ms'
    });
    $('#js-ReadMoreHeaderText').css({
      'display': 'block'
    });
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
    change: function change(e, value) {
      $s1input.val(value).trigger('input');
    }
  });
  var $s2input = $('#acf-field_5d64533dc0ab2c-field_app1w1c7ea20cf9');
  $('.acf-field-app1w1c7ea20cf9 .acf-range-wrap').hide();
  $('.acf-field-app1w1c7ea20cf9 .acf-input').starrr({
    max: 5,
    rating: $s2input.val(),
    change: function change(e, value) {
      $s2input.val(value).trigger('input');
    }
  });
  var $s3input = $('#acf-field_5d64533dc0ab2c-field_app3w307ea20cf9');
  $('.acf-field-app3w307ea20cf9 .acf-range-wrap').hide();
  $('.acf-field-app3w307ea20cf9 .acf-input').starrr({
    max: 5,
    rating: $s3input.val(),
    change: function change(e, value) {
      $s3input.val(value).trigger('input');
    }
  });
  var $s4input = $('#acf-field_5d64533dc0ab2c-field_app3w30723420cf9');
  $('.acf-field-app3w30723420cf9 .acf-range-wrap').hide();
  $('.acf-field-app3w30723420cf9 .acf-input').starrr({
    max: 5,
    rating: $s4input.val(),
    change: function change(e, value) {
      $s4input.val(value).trigger('input');
    }
  });
  var $s5input = $('#acf-field_5d64533dc0ab2c-field_app3red7ea20cf9');
  $('.acf-field-app3red7ea20cf9 .acf-range-wrap').hide();
  $('.acf-field-app3red7ea20cf9 .acf-input').starrr({
    max: 5,
    rating: $s5input.val(),
    change: function change(e, value) {
      $s5input.val(value).trigger('input');
    }
  });
});
/**
 * Hide inputs ACF_FORM
 */

$('.acf-field-group-rop54312').css({
  'display': 'none'
});
$('.acf-field-group-rup522322').css({
  'display': 'none'
});
/**
 * Success Submit
 */

$('#js-app-reviewed-cancel').click(function () {
  $('#js-app-reviewed-success').css({
    'display': 'none'
  });
});
/**
 * Stiky menu
 */
// Get the navbar

var navbar = document.getElementById("js-app-reviewed-header");

if (typeof navbar != 'undefined' && navbar != null) {
  // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  var myFunction = function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky");
      navbar.classList.add("container");
    } else {
      navbar.classList.remove("sticky");
      navbar.classList.remove("container");
    }
  };

  // When the user scrolls the page, execute myFunction 
  window.onscroll = function () {
    myFunction();
  }; // exists.


  var sticky = navbar.offsetTop + 100;
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
    var elem = $(this).attr('data-id');

    if (elem > min && elem <= max) {
      $(this).addClass('d-block').removeClass('d-none');
    } else {
      $(this).addClass('d-none').removeClass('d-block');
    }
  });
  var el = document.getElementById("js-app-reviewed-header");
  el.scrollIntoView();
}

document.addEventListener('DOMContentLoaded', function () {
  var navi = document.getElementById("js-reviews-navigation");

  if (navi) {
    var elements = document.getElementsByClassName("js-reviews-container").length;
    var postPerPage = 10;
    var fix = elements % postPerPage !== 0 ? 1 : 0;
    var pages = parseInt(elements / postPerPage + fix);

    for (var index = 1; index <= pages; index++) {
      var newDiv = document.createElement("a");
      var current = index == 1 ? 'current' : '';
      var next = parseInt(index) * parseInt(postPerPage);
      newDiv.setAttribute('class', 'page-numbers ' + current);
      newDiv.setAttribute('href', 'javascript:;');
      newDiv.setAttribute('onclick', 'showPage(this, ' + next + ')');
      newDiv.appendChild(document.createTextNode(index));
      navi.appendChild(newDiv);
    }

    showPage(null, postPerPage);
  }
}); // Magnific Popup

$('.image-popup-vertical-fit').magnificPopup({
  type: 'image',
  closeOnContentClick: true,
  mainClass: 'mfp-img-mobile',
  image: {
    verticalFit: true
  }
}); // Magnific Popup Iframe

$('.js-popup-iframe').magnificPopup({
  type: 'iframe',
  iframe: {
    markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' + '</div>',
    // HTML markup of popup, `mfp-close` will be replaced by the close button
    patterns: {
      youtube: {
        index: 'youtube.com/',
        // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
        id: 'v=',
        // String that splits URL in a two parts, second part should be %id%
        // Or null - full URL will be returned
        // Or a function that should return %id%, for example:
        // id: function(url) { return 'parsed id'; }
        src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.

      },
      vimeo: {
        index: 'vimeo.com/',
        id: '/',
        src: '//player.vimeo.com/video/%id%?autoplay=1'
      } // you may add here more sources

    },
    srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".

  }
}); // Magnific Popup Iframe

$('.js-videos-iframe').magnificPopup({
  type: 'iframe',
  iframe: {
    markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' + '</div>',
    // HTML markup of popup, `mfp-close` will be replaced by the close button
    srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".

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
    console.log($(this).attr('id') + '====' + name);

    if ($(this).attr('id') == name) {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });
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
    console.log($(this).attr('id') + '====' + name);

    if ($(this).attr('id') == name) {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });
} //----------------------
//Buttons pre regiter modal
//------------------------
//OPEN


$('.js-pre-register-modal').on('click', function () {
  event.preventDefault();
  var modal = $('.m-pre-register ');
  modal.css('display', 'flex');
  modal.animate({
    opacity: 1
  }, 300);
  disableScroll();
}); //CLOSE

$('.js-pre-register-close').click(function () {
  var modal = $('.m-pre-register ');
  modal.animate({
    opacity: 0
  }, 300, function () {
    modal.css('display', 'none');
    enableScroll();
  }); //Reset form when its close

  $('.medium[name="input_1"]')[0].value = "";
  $('.medium[name="input_3"]')[0].value = "";
  $('.medium[name="input_4"]')[0].value = "";
  $('#input_2_5_1')[0].checked = false;
});
/*************** EVENT SCROLL OMITTER *******************************/

var keys = {
  37: 1,
  38: 1,
  39: 1,
  40: 1
};

function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
} // modern Chrome requires { passive: false } when adding event


var supportsPassive = false;

try {
  window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
    get: function get() {
      supportsPassive = true;
    }
  }));
} catch (e) {}

var wheelOpt = supportsPassive ? {
  passive: false
} : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel'; // call this to Disable

function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF

  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop

  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile

  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
} // call this to Enable


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
  $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration', '.5s');
  $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transform', 'rotate(0deg)');

  if ($(this).children('.js-faqs__faq-description').is(':visible')) {
    $(this).children('.js-faqs__faq-description').slideUp();
    $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration', '.5s');
    $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transform', 'rotate(0deg)');
    $(this).removeClass('open');
  } else {
    $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration', '.5s');
    $(this).children('.faq-card__title-container').children('.faq-card__icon').css('transform', 'rotate(180deg)');
    $(this).children('.js-faqs__faq-description').slideDown();
    $(this).addClass('open');
  }
});
$(document).on('mouseup', function (e) {
  var container = $('.js-faqs__faq');

  if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('.js-faqs__faq').children('.js-faqs__faq-description').slideUp();
    $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transition-duration', '.5s');
    $('.js-faqs__faq').children('.faq-card__title-container').children('.faq-card__icon').css('transform', 'rotate(0deg)');
    $('.js-faqs__faq').removeClass('open');
  }
});
/**
 * Tabs find doctors
 */

$(function () {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-content'),
      activeClass = 'is-active';
  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();
  $tabButtonItem.find('a').on('click', function (e) {
    var target = $(this).attr('href');
    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });
  $tabSelect.on('change', function () {
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
} // Popup Contact


$('.js-form-contact').click(function () {
  $('.c-modal').addClass('c-modal__active');
  $('#masthead').css('z-index', '1');
});
$('.c-modal__close').click(function () {
  $('.c-modal').removeClass('c-modal__active');
  $('#masthead').css('z-index', '3');
});
/**
 * Podcasts
 */

function playPodcastSingle() {
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
    markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' + '</div>',
    // HTML markup of popup, `mfp-close` will be replaced by the close button
    srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".

  }
});
/**
 * Module Affiliate Hero
 */

$('.js-videos-iframe-3').magnificPopup({
  type: 'iframe',
  iframe: {
    markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' + '</div>',
    // HTML markup of popup, `mfp-close` will be replaced by the close button
    srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".

  }
});
/**
 * Slider servides (Landing)
 */

$(document).ready(function () {
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
        centerMode: true,
        centerPadding: '0px',
        dots: true
      }
    }, {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        dots: true,
        centerPadding: '150px'
      }
    }, {
      breakpoint: 645,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        dots: true,
        centerPadding: '0px'
      }
    }]
  });
});
"use strict";

$(document).ready(function () {
  if (window.innerWidth < 1026) {
    $('.js-doctors').slick({
      infinite: false,
      slidesToShow: 2,
      slidesToScroll: 2,
      dots: true,
      arrows: false,
      adaptiveHeight: true,
      responsive: [{
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });
  }
});
"use strict";

//------------      
// Fix Init Modal
//--------------
$(document).ready(function () {
  setTimeout(function () {
    $('#js-dropdown-conditions-menu').css({
      'display': 'block'
    });
    $('#js-dropdown-channels-menu').css({
      'display': 'block'
    });
    $('#js-dropdown-specialty-areas').css({
      'display': 'block'
    });
  }, 1000);
});

(function ($) {
  $(function () {
    //------------      
    // Modal close
    //--------------
    $('.big-menu-conditions__cross').click(function () {
      $('#js-dropdown-conditions-menu').css({
        'top': '-600px'
      });
      $('.big-menu-conditions__cross').css({
        'display': 'none'
      });
    });

    if ($(window).width() > 768) {
      // DESKTOP
      $('.has-mega-menu').on('mouseover', function () {
        $('#js-dropdown-conditions-menu').css({
          'top': '87px'
        });
        $('#js-dropdown-channels-menu').css({
          'top': '-600px'
        });
        $('#js-dropdown-specialty-areas').css({
          'top': '-600px'
        }); //--------------
        // Modal arrow
        //--------------

        $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({
          'left': $(this).offset().left + 30 + 'px',
          'display': 'block'
        });
        $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
        $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({
          'display': 'none'
        }); //--------------
        // Modal close
        //--------------

        $('.big-menu-conditions__cross').css({
          'display': 'block'
        });
      });
      $('#js-dropdown-conditions-menu').on('mouseleave', function () {
        $(this).css({
          'top': '-600px'
        }); //--------------
        // Modal arrow
        //--------------

        $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        }); //--------------
        // Modal close
        //--------------

        $('.big-menu-conditions__cross').css({
          'display': 'none'
        });
      });
      $('.has-channels-menu').on('mouseover', function () {
        $('#js-dropdown-channels-menu').css({
          'top': '87px'
        });
        $('#js-dropdown-conditions-menu').css({
          'top': '-600px'
        });
        $('#js-dropdown-specialty-areas').css({
          'top': '-600px'
        }); //--------------
        // Modal arrow
        //--------------

        $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
        $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
        $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({
          'left': $(this).offset().left + 30 + 'px',
          'display': 'block'
        }); //--------------
        // Modal close
        //--------------

        $('.big-menu-conditions__cross').css({
          'display': 'none'
        });
      });
      $('.has-specialty-areas-menu').on('mouseover', function () {
        $('#js-dropdown-specialty-areas').css({
          'top': '87px',
          'left': '-120px',
          'right': '120px'
        });
        $('#js-dropdown-conditions-menu').css({
          'top': '-600px'
        });
        $('#js-dropdown-channels-menu').css({
          'top': '-600px'
        }); //--------------
        // Modal arrow
        //--------------

        $('#js-dropdown-conditions-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
        $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
        $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({
          'left': $(this).offset().left + 30 + 'px',
          'display': 'block'
        }); //--------------
        // Modal close
        //--------------

        $('.big-menu-conditions__cross').css({
          'display': 'none'
        });
      });
      $('#js-dropdown-channels-menu').on('mouseleave', function () {
        $(this).css({
          'top': '-600px'
        });
        $('#js-dropdown-channels-menu .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
      });
      $('#js-dropdown-specialty-areas').on('mouseleave', function () {
        $(this).css({
          'top': '-600px'
        });
        $('#js-dropdown-specialty-areas .big-menu-conditions__arrow-up').css({
          'display': 'none'
        });
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
      }); //---------------------
      // Fix Children links
      //--------------------

      $('.js-site-link').on('click', function () {
        window.location = $(this).attr('href');
      }); //---------------------
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
      }); //---------------------
      // Fix Children links
      //--------------------

      $('#top_channels_menu > li > a').on('click', function () {
        window.location = $(this).attr('href');
      }); //---------------------
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
      }); //---------------------
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
      });
    }
  });
})(jQuery);
"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/**
 * Active tabs in Authors
 * @param {tab_id} tab 
 */
function activeTab(tab) {
  $('.author__content-nav-item').each(function () {
    var id = $(this).attr('data-id');

    if (id == tab) {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });
  $('.author__tabs-container__tab').each(function () {
    var id = $(this).attr('id');

    if (id == tab) {
      $(this).removeClass('d-none');
    } else {
      $(this).addClass('d-none');
    }
  });
}
/**
 * Play podcast into box
 */


function playPodcast(id) {
  $('#js-play-button-' + id).addClass('d-none');
  $('#js-player-podcast-' + id).removeClass('d-none');
  $('#js-player-podcast-' + id + ' .mejs-play button').click();
}
/**
 * 
 * Open Modal Repost
 */


function repostModal(id) {
  $('#js-insert-repost').removeClass('d-none');
  $('#id_repost').val(id);
}
/**
 * Close Repost modal
 */


function CloseModalRespot() {
  $('#js-insert-repost').addClass('d-none');
  $('#js-repost-successful').addClass('d-none');
}
/**
 * Repost 
 */


function repostArticles() {
  var formData = new FormData();
  formData.append('action', 'repost');
  formData.append(' post_id', $('#id_repost').val());
  formData.append('content', $('#content_repost').val());
  formData.append(' user', $('#user_repost').val());
  jQuery.ajax({
    cache: false,
    url: bms_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $('#js-open-verified').attr('disabled', 'disabled');
    },
    success: function success(response) {
      if (response.data.status == 'success') {
        $('#js-repost-successful').removeClass('d-none');
        $('#js-insert-repost').addClass('d-none'); //$( '#response_repost' ).html( '<p class="text-danger">' + response.data.message + '</p>' );
      } else {
        $('#response_repost').html('<p class="text-danger">' + response.data.message + '</p>');
      }
    }
  });
  return false;
}
/**
 * Search Meta Data
 */


function get_site_og() {
  var obj_content = $('#publish_content').val();
  event.preventDefault();

  if (event.which == 13 && obj_content !== '') {
    var formData = new FormData();
    formData.append('action', 'get_Site_OG');
    formData.append('publish_content', obj_content);
    jQuery.ajax({
      cache: false,
      url: bms_vars.ajaxurl,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function success(response) {
        if (response.status == 'success') {
          $('#publish-content').html('<div class="external-content-delete" onclick="delete_external_content_preview()"><img src="/wp-content/themes/doctorpedia/img/icons/share-repost-close.svg"></div>' + response.html);
        }
      }
    });
  }

  return false;
}
/**
 * Desktop
 */


function submit_profile_share() {
  var obj_content = $('#publish_content').val();
  if (obj_content.trim() == '') return false;
  var preview = $('#publish-content').html();
  var formData = new FormData();
  formData.append('action', 'publish_external_blog');
  formData.append('preview', preview);
  formData.append('content', obj_content);
  jQuery.ajax({
    cache: false,
    url: bms_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $('#js-shared-link').html('<i class="fas fa-spinner fa-pulse"></i>');
    },
    success: function success(response) {
      if (response.data.status == 'success') {
        $("#activity").load(location.href + " #activity>*", "");
        blur_profile_share();
      }

      $('#publish_content').val('');
      $('#publish-content').html('');
      $('#js-shared-link').html('Post');
    }
  });
}
/**
 * Mobile
 */


function submit_profile_share_mobile() {
  var obj_content = $('#publish_content_mobile').val();
  if (obj_content.trim() == '') return false;
  var preview = $('#publish-content').html();
  var formData = new FormData();
  formData.append('action', 'publish_external_blog');
  formData.append('preview', preview);
  formData.append('content', obj_content);
  jQuery.ajax({
    cache: false,
    url: bms_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
      activeTab('activity');
    },
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');

      if (response.data.status == 'success') {
        $("#activity").load(location.href + " #activity>*", "");
        blur_profile_share();
      }

      $('#publish_content_mobile').val('');
      $('#publish-content-mobile').html('');
    }
  });
  setTimeout(function () {
    activeTab('activity');
    $('.js-save-animation').removeClass('done');
    $('#js-modal-publication').addClass('d-none');
  }, 3000);
}

function focus_profile_share() {
  var body = document.querySelector('body');
  var textBox = document.querySelector('.text-box');
  var textBoxNav = document.querySelector('.text-box__nav');
  var textBoxActions = document.querySelectorAll('.text-box__action');
  body.classList.add('dimmed');
  textBox.classList.add('text-box--focused');
  textBoxNav.classList.add('text-box__nav--hidden');
  textBoxActions.forEach(function (action) {
    return action.classList.add('text-box__action--hidden');
  });
}

function blur_profile_share() {
  var body = document.querySelector('body');
  var textBox = document.querySelector('.text-box');
  var textBoxNav = document.querySelector('.text-box__nav');
  var textBoxActions = document.querySelectorAll('.text-box__action');
  body.classList.remove('dimmed');
  textBox.classList.remove('text-box--focused');
  textBoxNav.classList.remove('text-box__nav--hidden');
  textBoxActions.forEach(function (action) {
    return action.classList.remove('text-box__action--hidden');
  });
}

function delete_external_content_preview() {
  $('#publish-content').html('');
}

(function () {
  var measurer = $('<span>', {
    style: "display:inline-block;word-break:break-word;visibility:hidden;white-space:pre-wrap;display:none;"
  }).appendTo('body');

  function initMeasurerFor(textarea) {
    if (!textarea[0].originalOverflowY) {
      textarea[0].originalOverflowY = textarea.css("overflow-y");
    }

    var maxWidth = textarea.css("max-width");
    measurer.text(textarea.text()).css('font', textarea.css('font')).css('overflow-y', textarea.css('overflow-y')).css("max-height", textarea.css("max-height")).css("min-height", textarea.css("min-height")).css("padding", textarea.css("padding")).css("border", textarea.css("border")).css("box-sizing", textarea.css("box-sizing"));
  }

  function updateTextAreaSize(textarea) {
    textarea.height(measurer.height());
    var w = measurer.width();

    if (textarea[0].originalOverflowY == "auto") {
      var mw = textarea.css("max-width");

      if (mw != "none") {
        if (w == parseInt(mw)) {
          textarea.css("overflow-y", "auto");
        } else {
          textarea.css("overflow-y", "hidden");
        }
      }
    }
  }

  $('textarea.autofit').on({
    input: function input() {
      var text = $(this).val();

      if ($(this).attr("preventEnter") == undefined) {
        text = text.replace(/[\n]/g, "<br>&#8203;");
      }

      measurer.html(text);
      updateTextAreaSize($(this));
    },
    focus: function focus() {
      initMeasurerFor($(this));
    },
    keypress: function keypress(e) {
      if (e.which == 13 && $(this).attr("preventEnter") != undefined) {
        e.preventDefault();
      }
    }
  });
})();
/**
 * Open Modal
 */


function openCetificationModal() {
  $('#js-modal-board-certification').removeClass('d-none');
}

function openEducationModal() {
  $('#js-modal-education').removeClass('d-none');
}

function openBioModal() {
  $('#js-modal-bio').removeClass('d-none');
}

function openLocationModal() {
  $('#js-modal-location').removeClass('d-none');
}

function openVideoModal() {
  $('#js-modal-video').removeClass('d-none');
}

function openVideoExampleModal() {
  $('#js-modal-video-example').removeClass('d-none');
}

function openExpertiseModal() {
  $('#js-modal-expertise').removeClass('d-none');
}

function openPublicationModal() {
  $('#js-modal-publication').removeClass('d-none');
  $('#publish_content_mobile').focus();
  document.getElementById("publish_content_mobile").focus().setSelectionRange(0, 999);
  setTimeout($('#publish_content_mobile').focus(), 1000);
}
/**
 * Add New Certification item html
 */


function addCertificationItemAlt() {
  var id = Math.floor(Math.random() * (99 - 0)) + 0;
  var html = '<div class="box-certification-items" id="' + id + '">';
  html += '<input type="text" name="user_certification[]" class="mr-0 certification-item" value="">';
  html += '<div onclick="deleteItemCertification(' + id + ')"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div>';
  html += '</div>';
  $('#js-certifications-items').append(html);
}
/**
 * Delete certification item
 */


function deleteItemCertification(id) {
  $('#' + id).remove();
}
/**
 * Load Sub Specialties select
 */


function saveBoardCertification() {
  $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
  var certifications = [];
  $('.check_certification').each(function () {
    var certification = {
      certification: $(this).find('.item_certification').val(),
      subcertification: $(this).find('.item_subcertification').val()
    };
    certifications.push(certification);
  });
  var formData = new FormData();
  formData.append('action', 'save_certifications');
  formData.append('user_residency', $('#user_residency').val());
  formData.append('user_credential', $('#user_credential').val());
  formData.append('user_certification', JSON.stringify(certifications));
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
      $('#js-certifications').load($(location).attr('href') + ' #js-certifications');
      closeModal();
    }
  });
  setTimeout(function () {
    $('.js-save-animation').removeClass('done');
  }, 3000);
}
/**
 * Active Board Certification
 */


var activeBoardModal = function activeBoardModal() {
  document.getElementById("js-board").checked = true;
  document.getElementById("js-resident").checked = false;
  var board = document.getElementById('js-visible-certifications');
  board.classList.remove('d-none');
  var resident = document.getElementById('js-cta-resident');
  resident.classList.add('d-none');
  var credential = document.getElementById('js-visible-credential');
  credential.classList.add('d-none');
  var resident = document.getElementById('js-visible-resident');
  resident.classList.add('d-none');
};
/**
 * Active Resident
 */


var activeResidentModal = function activeResidentModal() {
  var board = document.getElementById('js-visible-certifications');
  board.classList.add('d-none');
  document.getElementById("js-resident").checked = true;
  document.getElementById("js-board").checked = false;
  var resident = document.getElementById('js-cta-resident');
  resident.classList.remove('d-none');
};
/**
 * Active Resident Field
 */


var activeResidentFieldModal = function activeResidentFieldModal() {
  document.getElementById("js-resident-y").checked = true;
  document.getElementById("js-resident-x").checked = false;
  var resident = document.getElementById('js-visible-resident');
  resident.classList.remove('d-none');
  var credential = document.getElementById('js-visible-credential');
  credential.classList.add('d-none');
};
/**
 * Active Credential Field
 */


var activeCredentialFieldModal = function activeCredentialFieldModal() {
  document.getElementById("js-resident-y").checked = false;
  document.getElementById("js-resident-x").checked = true;
  var credential = document.getElementById('js-visible-credential');
  credential.classList.remove('d-none');
  var resident = document.getElementById('js-visible-resident');
  resident.classList.add('d-none');
};
/**
 * Load Sub Specialties select Board Certification
 */


function loadSubCertification(value) {
  if (!value) return;
  var formData = new FormData();
  formData.append('action', 'load_subspecialties');
  formData.append('user_specialty', value);
  jQuery.ajax({
    cache: false,
    url: dd_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend(response) {
      $('#user_subcertification').html('<option value="" selected disabled>loading...</option>');
    },
    success: function success(response) {
      $('#user_subcertification').html(response.data);
    }
  });
  return false;
}
/**
 * Add bio specialties certification
 */


function addCertification() {
  var rand = Math.floor(Math.random() * (9999 - 9)) + 9;
  var certification = $('#user_certification').val();
  var certification_slug = certification.replace(/ /g, "-").replace(/["'()]/g, "") + rand;
  var subcertification = $('#user_subcertification').val();
  var subcertification_slug = subcertification.replace(/ /g, "-").replace(/["'()]/g, "") + rand;
  var html = '';

  if (certification && certification !== 'none' && certification !== 'null') {
    //$("#user_certification option:selected").attr('disabled','disabled');
    html += '<li id="' + certification_slug + '"  class="d-flex flex-row check_certification">';
    html += '<div class="box-certification box-certification-purple d-flex flex-row">' + certification + '<input type="hidden" value="' + certification + '" class="item_certification"><div onclick="deleteItemcertification(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
  }

  if (subcertification && subcertification !== 'none' && subcertification !== 'null') {
    //$("#user_subcertification option:selected").attr('disabled','disabled');
    html += '<div id="' + subcertification_slug + '"  class="box-certification box-certification-pink d-flex flex-row">' + subcertification + ' <input type="hidden" value="' + subcertification + '" class="item_subcertification"><div onclick="deleteItemSubcertification(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div> ';
  }

  html += '</li>';
  $('#js-list-certification').append(html);
}
/**
 * Delete Item certification
 */


function deleteItemcertification(obj) {
  var elem = obj;
  $(elem).parent().parent().remove(); //$('#user_certification option[value="' + id + '"]').removeAttr('disabled');
}

function deleteItemSubcertification(obj) {
  var elem = obj;
  $(elem).parent().parent().remove(); //$('#user_subcertification option[value="' + id + '"]').removeAttr('disabled');
}
/**
 * Add Bio Education
 */


function addEducationItem() {
  var education = $('#user_education').val();
  var education_slug = education.replace(/ /g, "-").replace(/["'()]/g, "");
  var html = '';

  if (education && education !== 'none' && education !== 'null') {
    html += '<li id="' + education_slug + '"  class="d-flex flex-row check_education">';
    html += '<div class="box-education box-education-purple d-flex flex-row">' + education + '<input type="hidden" value="' + education + '" class="item_education"><div onclick="deleteItemEducation(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
  }

  html += '</li>';
  $('#js-list-education').append(html);
  $('#user_education').val('');
}

function deleteItemEducation(obj) {
  var elem = obj;
  $(elem).parent().parent().remove();
}
/**
 * Save Education
 */


function saveEducation() {
  var educations = [];
  $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
  $('.check_education').each(function () {
    educations.push($(this).find('.item_education').val());
  });
  var formData = new FormData();
  formData.append('action', 'save_education');
  formData.append('user_education', JSON.stringify(educations));
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
      $('#js-educations').load($(location).attr('href') + ' #js-educations');

      if (response.data.length > 1) {
        $('#js-educations').addClass('mb-4');
      } else {
        $('#js-educations').removeClass('mb-4');
      }

      closeModal();
    }
  });
  setTimeout(function () {
    $('.js-save-animation').removeClass('done');
  }, 3000);
}
/**
 * Save Biography
 */


function saveBiography() {
  $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
  var formData = new FormData();
  formData.append('action', 'save_biography');
  formData.append('biography', $('#user_biography').val());
  formData.append('biography_link', $('#user_biography_link').val());
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
      $('#js-author-profile-bio').html(response.data.data);

      if ($('#user_biography').val().length > 1) {
        $('#js-author-profile-bio').addClass('mb-4');
      } else {
        $('#js-author-profile-bio').removeClass('mb-4');
      }

      closeModal();
    }
  });
  setTimeout(function () {
    $('.js-save-animation').removeClass('done');
  }, 3000);
}
/**
 * Save Location
 */


function saveLocation() {
  $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
  var formData = new FormData();
  formData.append('action', 'save_location');
  formData.append('clinic_lat', $('#latitud_prop').val());
  formData.append('clinic_lng', $('#longitud_prop').val());
  formData.append('clinic_name', $('#clinic_name').val());
  formData.append('clinic_email', $('#clinic_email').val());
  formData.append('clinic_open', $('#clinic_open').val());
  formData.append('clinic_phone', $('#clinic_phone').val());
  formData.append('clinic_web', $('#clinic_web').val());
  formData.append('clinic_appointment', $('#clinic_appointment').val());
  formData.append('clinic_location', $('#js-google-search').val());
  formData.append('city', $('#city_prop').val());
  formData.append('state', $('#state_prop').val());
  formData.append('country', $('#country_prop').val());
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
      $("#js-first-column-premium").load($(location).attr("href") + ' #js-first-column-premium');
      closeModal();
    }
  });
  setTimeout(function () {
    $('.js-save-animation').removeClass('done');
  }, 3000);
}
/**
 * Save Expertise
 */


function saveExpertise() {
  var expertises = [];
  $('.js-save-animation').addClass('loading hiddenBtn').removeClass('done');
  $('.check_expertise').each(function () {
    expertises.push($(this).find('.item_education').val());
  });
  var formData = new FormData();
  formData.append('action', 'save_expertise');
  formData.append('user_expertise', JSON.stringify(expertises));
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function success(response) {
      $('.js-save-animation').removeClass('loading hiddenBtn').addClass('done');
      $('#js-expertises').load($(location).attr('href') + ' #js-expertises');

      if (response.data.length > 1) {
        $('#js-expertises').addClass('mb-4');
      } else {
        $('#js-expertises').removeClass('mb-4');
      }

      closeModal();
    }
  });
  setTimeout(function () {
    $('.js-save-animation').removeClass('done');
  }, 3000);
}
/**
 * Map Clinic
 */


(function ($) {
  /**
   * initMap
   *
   * Renders a Google Map onto the selected jQuery element
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @return  object The map instance.
   */
  function initMap($el) {
    // Find marker elements within map.
    var $markers = $el.find('.marker'); // Create gerenic map.

    var mapArgs = {
      zoom: $el.data('zoom') || 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      panControl: false,
      mapTypeControl: false,
      streetViewControl: false,
      overviewMapControl: false,
      zoomControl: true,
      scaleControl: false,
      fullscreenControl: false,
      rotateControl: false
    };
    var map = new google.maps.Map($el[0], mapArgs); // Add markers.

    map.markers = [];
    $markers.each(function () {
      initMarker($(this), map);
    }); // Center map based on markers.

    centerMap(map); // Search Input and push into map

    searchInput(map); // Return map instance.

    return map;
  }
  /**
   * initMarker
   *
   * Creates a marker for the given jQuery element and map.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @param   object The map instance.
   * @return  object The marker instance.
   */


  function initMarker($marker, map) {
    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    $("#latitud_prop").val(lat); //Set input lat

    $("#longitud_prop").val(lng); //Set input lng

    var latLng = {
      lat: parseFloat(lat),
      lng: parseFloat(lng)
    }; // Create marker instance.

    var marker = new google.maps.Marker({
      position: latLng,
      icon: "../../wp-content/themes/doctorpedia/img/authors/marker-premium.svg",
      map: map
    }); // Append to reference for later use.

    map.markers.push(marker); // If marker contains HTML, add it to an infoWindow.

    if ($marker.html()) {
      // Create info window.
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      }); // Show info window when marker is clicked.

      google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
      });
    }
  }
  /**
   * centerMap
   *
   * Centers the map showing all markers in view.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   object The map instance.
   * @return  void
   */


  function centerMap(map) {
    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function (marker) {
      bounds.extend({
        lat: marker.position.lat(),
        lng: marker.position.lng()
      });
    }); // Case: Single marker.

    if (map.markers.length == 1) {
      map.setCenter(bounds.getCenter()); // Case: Multiple markers.
    } else {
      map.fitBounds(bounds);
    }
  }

  function searchInput(map) {
    var input = document.getElementById('js-google-search');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // Bias the SearchBox results towards current map's viewport.

    map.addListener('bounds_changed', function () {
      searchBox.setBounds(map.getBounds());
    });
    var markers = []; // [START region_getplaces]
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.

    searchBox.addListener('places_changed', function () {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      } // Clear out the old markers.


      markers.forEach(function (marker) {
        marker.setMap(null);
      });
      markers = []; // For each place, get the icon, name and location.

      var bounds = new google.maps.LatLngBounds();
      places.forEach(function (place) {
        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: "../../wp-content/themes/doctorpedia/img/authors/marker-premium.svg",
          title: place.name,
          position: place.geometry.location
        }));
        var componentForm = {
          street_number: "short_name",
          route: "long_name",
          locality: "long_name",
          administrative_area_level_1: "short_name",
          country: "long_name",
          postal_code: "short_name"
        };

        var _iterator = _createForOfIteratorHelper(place.address_components),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var component = _step.value;
            var addressType = component.types[0];

            if (componentForm[addressType]) {
              var val = component[componentForm[addressType]];

              if (addressType == 'locality') {
                $("#city_prop").val(val); //set input City
              }

              if (addressType == 'administrative_area_level_1') {
                $("#state_prop").val(val); //set input State
              }

              if (addressType == 'country') {
                $("#country_prop").val(val); //set input State
              }
            }
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }

        $("#latitud_prop").val(place.geometry.location.lat); //set input lat

        $("#longitud_prop").val(place.geometry.location.lng); //set input lng

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  } // Render maps on page load.


  $(document).ready(function () {
    $('.acf-map').each(function () {
      var map = initMap($(this));
    });
  });
})(jQuery);

$('#js-google-search').keypress(function (e) {
  return e.keyCode != 13;
});
/**
 * Active CTA posts
 */

var activeCTA = function activeCTA(elem) {
  var cta = elem.nextSibling;
  cta.nextElementSibling.classList.toggle('d-none');
};
/**
 * Delete Post
 */


function deletePostProfile(elem) {
  $('#js-modal-delete-post').removeClass('d-none');
  $('#js-delete-verified').attr('data-id', $(elem).attr('data-id'));
}
/**
 * Delete Post
 */


$('#js-delete-verified').on('click', function () {
  var post_id = $(this).attr('data-id');
  $('#js-modal-delete-post').addClass('d-none');
  var formData = new FormData();
  formData.append('action', 'delete_post');
  formData.append('post_id', post_id);
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $('#js-cta-container').addClass('d-none');
      $('#post_' + post_id).css('background-color', 'rgba(255,0,0, 0.2)');
      $('#post_' + post_id).hide('slow');
    },
    success: function success(response) {
      $('#post_' + post_id).remove();
    }
  });
});
/**
 * Cancel delet post
 */

function cancelDeletePost() {
  $('#js-modal-delete-post').addClass('d-none');
  $('#js-cta-container').addClass('d-none');
}
/**
 * Feature post
 */


function featurePostProfile(elem) {
  var post_id = $(elem).attr('data-id');
  var formData = new FormData();
  formData.append('action', 'feature_post');
  formData.append('post_id', post_id);
  jQuery.ajax({
    cache: false,
    url: pp_vars.ajaxurl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function beforeSend() {
      $(elem).css({
        'color': '#41b883'
      });
    },
    success: function success(response) {
      $("#js-first-column-premium").load($(location).attr("href") + ' #js-first-column-premium');
    }
  });
}
/**
 * Copy post
 */


function copyPostProfile(link) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(link).attr('data-link')).select();
  $(link).css({
    'color': '#41b883'
  });
  $('.custom-item-copy').css({
    'background-color': '#41b883'
  }); // Single Videos Page

  $(".post-share-title").append(' <span class="text-success">Link copied!</span>');
  document.execCommand("copy");
  $temp.remove();
}
/**
 * Detect paste link
 */


$(document).ready(function () {
  $("#publish_content").bind({
    paste: function paste() {
      setTimeout(function () {
        var obj_content = $('#publish_content').val();

        if (obj_content.trim() == '') {
          return false;
        }

        var formData = new FormData();
        formData.append('action', 'get_Site_OG');
        formData.append('publish_content', obj_content);
        jQuery.ajax({
          cache: false,
          url: bms_vars.ajaxurl,
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function success(response) {
            if (response.status == 'success') {
              $('#publish-content').html('<div class="external-content-delete" onclick="delete_external_content_preview()"><img src="/wp-content/themes/doctorpedia/img/icons/share-repost-close.svg"></div>' + response.html);
            }
          }
        });
      }, 1000);
    }
    /* copy : function(){
        alert('¡Has copiado!');
    },
    cut : function(){
        alert('¡Has cortado!');
    } */

  });
});
/**
 * Count Characters
 */

function countChars(obj) {
  var maxLength = 500;
  var strLength = obj.value.length;

  if (strLength >= maxLength) {
    document.getElementById("charNum").innerHTML = '<span class="text-danger text-min">' + strLength + ' out of ' + maxLength + ' characters</span>';
    $(obj).val($(obj).val().substring(0, maxLength));
    return false;
  } else {
    document.getElementById("charNum").innerHTML = strLength + ' out of ' + maxLength + ' characters';
  }
}
/**
 * Active Tabs by hashtag url
 */


jQuery(document).ready(function () {
  var brand = false;

  if (window.location.hash && !brand) {
    var hash = window.location.hash.replace('#', '');
    var author_id = $("#js-author__nav").attr("data-id");
    activeTab(hash);
    $(window).scrollTop(0);
    brand = true;
    if (hash === "activity") return false;
    load_posts_categ(author_id, hash);
  }

  $(window).off('scroll');
});
/**
 * Add Area of Expertise
 */

function addExpertiseItem() {
  var expertise = $('#user_expertise').val();
  var expertise_slug = expertise.replace(/ /g, "-").replace(/["'()]/g, "");
  var html = '';

  if (expertise && expertise !== 'none' && expertise !== 'null') {
    html += '<li id="' + expertise_slug + '"  class="d-flex flex-row check_expertise">';
    html += '<div class="box-education box-education-purple d-flex flex-row">' + expertise + '<input type="hidden" value="' + expertise + '" class="item_education"><div onclick="deleteExpertiseItem(this);"><img src="/wp-content/plugins/blogging-platform/assets/img/delete-x-icon.svg" /></div></div>';
  }

  html += '</li>';
  $('#js-list-expertise').append(html);
  $('#user_expertise').val('');
}

function deleteExpertiseItem(obj) {
  var elem = obj;
  $(elem).parent().parent().remove();
}
/**
 * See more - Area of Expertise
 */


jQuery(document).ready(function () {
  var items = $('#js-expertises ul li');

  if ($(window).width() > 768) {
    if (items.length > 3) {
      showLessItems();
    }
  }
});
/**
 * Active last items - Area of Expertise
 */

function showMoreItems() {
  var items = $('#js-expertises ul li');
  $.each(items, function (index, value) {
    $(this).removeClass('d-none');
  });
  $('#js-see-more-expertise').addClass('d-none');
  $('#js-see-less-expertise').removeClass('d-none');
}
/**
 * Active last items - Area of Expertise
 */


function showLessItems() {
  var items = $('#js-expertises ul li');
  $.each(items, function (index, value) {
    if (index > 2) {
      $(this).addClass('d-none');
    }
  });
  $('#js-see-more-expertise').removeClass('d-none');
  $('#js-see-less-expertise').addClass('d-none');
}
/**
 * Toggle Specialties - Public Profile
 */


function toggleSpecialtiesPopup() {
  $('.author__profile-container').toggle();
  $('#toggleImg').toggleClass('ToggleActive');
}
/**
 * Hide footbar on scroll final page
 */


$(document).ready(function () {
  $(window).on('scroll', function () {
    // Evento de Scroll
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
      // Si estamos al final de la página
      $('.ocultar').stop(true).animate({
        // Escondemos el div
        opacity: 0
      }, 50);
    } else {
      // Si no
      $('.ocultar').stop(true).animate({
        // Mostramos el div
        opacity: 1
      }, 10);
    }
  });
});
/**
 * Load More Post Activity
 */

var ppp = 10;
var pageNumber = 1;

function load_posts(author_id) {
  pageNumber++;
  $('#more_posts').html('<i class="fa fa-spinner fa-spin"></i>'); //Api rest call

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', "".concat(window.location.origin, "/wp-json/doctorpedia/v2/profile-load-content?ppp=").concat(ppp, "&author_id=").concat(author_id, "&pageNumber=").concat(pageNumber), true);

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      if (xmlhttp.status == 200) {
        //Res content
        var obj = JSON.parse(xmlhttp.responseText);
        var data = obj.data.html;
        var count = obj.data.count;
        var total = obj.data.total;
        console.log(count, total);

        if (total !== 0) {
          $("#ajax-posts").append(data);

          if (parseInt(count) == 10 && parseInt(total) > 10) {
            $('#more_posts').html('Load More');
          } else {
            $('#more_posts').addClass('d-none');
          }
        } else {
          $('.spin-loader').addClass('d-none');
          $('#more_posts').html('<i class="fa fa-check"></i>');
          $('#more_posts').addClass('complete-pagination');
          $('#more_posts').addClass('d-none');
        }
      }
    }
  };

  xmlhttp.send(null);
} // Load More Activity Button Click Event


$("#more_posts").on("click", function () {
  // When btn is pressed.
  var author_id = $("#js-author__nav").attr("data-id");
  load_posts(author_id);
});
/**
 * Load More Post Categories
 */

function load_posts_categ(author_id) {
  var category = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var pageNumberCategory = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

  if (!pageNumberCategory) {
    pageNumberCategory = 0;
  }

  $("#js-placeholder-" + category).addClass('d-none');

  if (pageNumberCategory > 0) {
    $("#ajax-posts-" + category).next().html('<i class="fa fa-spinner fa-spin"></i>');
  } else {
    $("#ajax-posts-" + category).html('<img src="/wp-content/themes/doctorpedia/img/Spin-1s-200px.gif" width="50px" class="spin-loader mb-5"><br>');
  } //Api rest call


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', "".concat(window.location.origin, "/wp-json/doctorpedia/v2/profile-load-content?ppp=").concat(ppp, "&author_id=").concat(author_id, "&category=").concat(category, "&pageNumber=").concat(pageNumberCategory), true);

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      if (xmlhttp.status == 200) {
        //Res content
        var obj = JSON.parse(xmlhttp.responseText);
        var data = obj.data.html;
        var count = obj.data.count;
        var total = obj.data.total;

        if (total === 0 && pageNumberCategory === 0) {
          $('.spin-loader').addClass('d-none');
          $("#ajax-posts-" + category).append(data);
        }

        if (data !== "" && pageNumberCategory === 0) {
          $("#ajax-posts-" + category).html(data);

          if (parseInt(count) == 10 && parseInt(total) > 10) {
            $("#ajax-posts-" + category).next().html('Load More');
            $("#ajax-posts-" + category).next().removeClass('d-none');
          } else {
            $("#ajax-posts-" + category).next().addClass('d-none');
          }

          $("#ajax-posts-" + category).next().attr('data-page', parseInt(pageNumberCategory) + 1);
        } else if (data !== "" && pageNumberCategory > 0) {
          $("#ajax-posts-" + category).append(data);

          if (parseInt(count) == 10 && parseInt(total) > 10) {
            $("#ajax-posts-" + category).next().html('Load More');
            $("#ajax-posts-" + category).next().removeClass('d-none');
          } else {
            $("#ajax-posts-" + category).next().addClass('d-none');
          }

          $("#ajax-posts-" + category).next().attr('data-page', parseInt(pageNumberCategory) + 1);
        } else {
          $("#ajax-posts-" + category).next().html('<i class="fa fa-check"></i>');
          $("#ajax-posts-" + category).next().addClass('complete-pagination');
          $('#more_posts').addClass('d-none');
        }
      }
    }
  };

  xmlhttp.send(null);
} // Tab Content Click Event


$(".author__content-nav-item").on("click", function () {
  var author_id = $("#js-author__nav").attr("data-id");
  var category = $(this).attr("data-id");
  var page = $("#ajax-posts-" + category).next().attr("data-page");

  if (category === "activity" || page > 0) {
    return false;
  }

  load_posts_categ(author_id, category);
}); // Load More Categories Button Click Event

$(".more-posts").on("click", function () {
  var author_id = $("#js-author__nav").attr("data-id");
  var category = $(this).attr("data-id");
  var pageNumberCategory = $(this).attr("data-page");
  load_posts_categ(author_id, category, pageNumberCategory);
});
"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

jQuery(document).ready(function () {
  /**
   * Video Gallery
   */
  var VideoGalleryHero = /*#__PURE__*/function () {
    function VideoGalleryHero() {
      _classCallCheck(this, VideoGalleryHero);

      try {
        this.videoGallery = document.querySelector('.js-search-video-gallery');
        this.videos = document.querySelectorAll('.js-video-slide');
        this.videoModal = document.querySelector('.js-video-modal');
        this.loader = this.videoModal.querySelector('.js-loader');
        this.videoModalContainer = this.videoModal.querySelector('.js-container');
        this.videoModalInfoContainer = this.videoModal.querySelector('.video-info');
        this.currentSlide = 0;
        this.modalBtns = {
          prev: this.videoModal.querySelector('.js-prev-video'),
          next: this.videoModal.querySelector('.js-next-video')
        };
        this.videoSlider();
        this.videoFunctons();
        this.modalActions();
      } catch (_unused) {}
    }

    _createClass(VideoGalleryHero, [{
      key: "videoSlider",
      value: function videoSlider() {
        this.videosEnterAnimation();
        $(this.videoGallery).slick({
          cssEase: 'linear',
          slidesToShow: 5,
          slidesToScroll: 1,
          centerMode: true,
          pauseOnFocus: false,
          pauseOnHover: false,
          speed: 7000,
          autoplay: true,
          autoplaySpeed: 0,
          arrows: false,
          responsive: [{
            breakpoint: 1980,
            settings: {
              slidesToShow: 7.8
            }
          }, {
            breakpoint: 1441,
            settings: {
              slidesToShow: 5
            }
          }, {
            breakpoint: 1200,
            settings: {
              slidesToShow: 4
            }
          }, {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3
            }
          }, {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              centerMode: true,
              centerPadding: '40px',
              variableWidth: true
            }
          }, {
            breakpoint: 480,
            settings: _defineProperty({
              speed: 300,
              autoplay: false,
              autoplaySpeed: 0,
              slidesToShow: 1,
              centerMode: true,
              centerPadding: '40px',
              variableWidth: true
            }, "speed", 300)
          }]
        }); //this.videosSliderController();
      }
    }, {
      key: "videosEnterAnimation",
      value: function videosEnterAnimation() {
        $(this.videoGallery).on('init', function () {
          var animation = new Animations();
          animation.staggered();
        });
      }
    }, {
      key: "videosSliderController",
      value: function videosSliderController() {
        if (window.innerWidth > 600) {
          var self = this;
          var sliderWidth = this.videoGallery.clientWidth;
          var tolerance = 200;

          this.videoGallery.onmousemove = function (e) {
            var coordinates = self.getRelativeCoordinates(e, self.videoGallery);

            if (coordinates.x >= 0 && coordinates.x <= tolerance) {
              //Prev Slide
              $(self.videoGallery).slick('slickPrev');
            }

            if (coordinates.x <= sliderWidth && coordinates.x >= sliderWidth - tolerance) {
              //Next Slide
              $(self.videoGallery).slick('slickNext');
            }
          };
        }
      }
    }, {
      key: "getRelativeCoordinates",
      value: function getRelativeCoordinates(event, referenceElement) {
        var position = {
          x: event.pageX,
          y: event.pageY
        };
        var offset = {
          left: referenceElement.offsetLeft,
          top: referenceElement.offsetTop
        };
        var reference = referenceElement.offsetParent;

        while (reference) {
          offset.left += reference.offsetLeft;
          offset.top += reference.offsetTop;
          reference = reference.offsetParent;
        }

        return {
          x: position.x - offset.left,
          y: position.y - offset.top
        };
      }
    }, {
      key: "videoFunctons",
      value: function videoFunctons() {
        var _this = this;

        var self = this;
        this.videos.forEach(function (video) {
          var videoUrl = video.getAttribute('url');
          var videoInfo = video.querySelector('.video-info');
          video.addEventListener('click', function () {
            self.currentSlide = parseInt(video.getAttribute('slide'));
            self.fillModal(videoInfo, videoUrl);

            _this.openCloseModal();
          });
        });
      }
    }, {
      key: "videoApiLoader",
      value: function videoApiLoader(sectionToPrint, videoUrl) {
        try {
          sectionToPrint.querySelector('.vimeo-iframe-load').remove();
        } catch (_unused2) {}

        var videoIframe = document.createElement('div');
        videoIframe.classList.add('vimeo-iframe-load');
        videoIframe.classList.add('video-info__iframe');
        var options = {
          id: videoUrl,
          loop: false,
          responsive: true
        };
        var player = new Vimeo.Player(videoIframe, options);
        player.play();
        this.resizeModalWithVideoResolution(player);
        sectionToPrint.appendChild(videoIframe);
      }
    }, {
      key: "fillModal",
      value: function fillModal(videoInfo, videoUrl) {
        this.videoModalInfoContainer.innerHTML = videoInfo.innerHTML;
        this.videoApiLoader(this.videoModalInfoContainer, videoUrl);
      }
    }, {
      key: "resizeModalWithVideoResolution",
      value: function resizeModalWithVideoResolution(player) {
        var self = this;
        player.on('loaded', function () {
          player.getVideoHeight().then(function (height) {
            player.getVideoWidth().then(function (width) {
              if (height > width) {
                self.videoModalInfoContainer.style.width = '300px';
                self.videoModalContainer.style.width = '';
              } else {
                self.videoModalInfoContainer.style.width = '';
                self.videoModalContainer.style.width = '100%';
              }

              self.loaderOnOff(false);
            });
          });
        });
      }
    }, {
      key: "openCloseModal",
      value: function openCloseModal() {
        this.videoModal.classList.toggle('open');
        this.loaderOnOff(true);

        if (!this.videoModal.classList.contains('open')) {
          this.videoModal.querySelector('.vimeo-iframe-load').remove();
        }
      }
    }, {
      key: "modalActions",
      value: function modalActions() {
        var self = this; //Prev Video

        this.modalBtns.prev.addEventListener('click', function () {
          var prevVideo = _toConsumableArray(self.videos).filter(function (video) {
            return parseInt(video.getAttribute('slide')) == self.currentSlide - 1;
          });

          if (prevVideo.length > 0) {
            self.currentSlide--;
            var videoUrl = prevVideo[0].getAttribute('url');
            var videoInfo = prevVideo[0].querySelector('.video-info');
            self.fillModal(videoInfo, videoUrl);
            self.loaderOnOff(true);
          }
        }); //Next Video

        this.modalBtns.next.addEventListener('click', function () {
          var nextVideo = _toConsumableArray(self.videos).filter(function (video) {
            return parseInt(video.getAttribute('slide')) == self.currentSlide + 1;
          });

          if (nextVideo.length > 0) {
            self.currentSlide++;
            var videoUrl = nextVideo[0].getAttribute('url');
            var videoInfo = nextVideo[0].querySelector('.video-info');
            self.fillModal(videoInfo, videoUrl);
            self.loaderOnOff(true);
          }
        }); //Close Video

        this.videoModal.addEventListener('click', function (_ref) {
          var target = _ref.target;

          if (target.classList.contains('js-video-modal') || target.classList.contains('js-close-modal')) {
            self.openCloseModal();
          }
        });
      }
    }, {
      key: "loaderOnOff",
      value: function loaderOnOff() {
        var loader = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

        if (loader) {
          this.videoModalContainer.classList.remove('loaded');
          this.loader.classList.remove('hide');
        } else {
          this.videoModalContainer.classList.add('loaded');
          this.loader.classList.add('hide');
        }
      }
    }]);

    return VideoGalleryHero;
  }();

  new VideoGalleryHero();
  /**
   * Search new functions
   */

  var SearchHero = /*#__PURE__*/function () {
    function SearchHero() {
      _classCallCheck(this, SearchHero);

      try {
        this.searchModal = document.querySelector('#js-discover-search-resources');
        this.closeSearch = document.querySelector('.js-close-dropdown');
        this.gallery = document.querySelector('.js-search-video-gallery');
        this.buttonSearch = document.querySelector('#js-discover-health');
        this.inputSearch = document.querySelector('#js-search-condition');
        this.allowedCPT = document.querySelector('#js-sr-form-discover-health').getAttribute('post-types');
        this.resultsFoundMessage = document.querySelector('#js-var-to-search');
        this.loadMoreButtons = document.querySelectorAll('.js-load-more-posts');
        this.searchValue = '';
        this.closeOpenSearch();
        this.inputActions();
        this.loadMoreResults();
      } catch (_unused3) {}
    }

    _createClass(SearchHero, [{
      key: "closeOpenSearch",
      value: function closeOpenSearch() {
        var self = this;
        this.closeSearch.addEventListener('click', function () {
          self.searchModal.classList.toggle('d-none');

          if (window.innerWidth > 767) {
            self.gallery.classList.toggle('hide');
          }
        });
      }
    }, {
      key: "inputActions",
      value: function inputActions() {
        var self = this; //Button submit

        this.buttonSearch.addEventListener('click', function (_ref2) {
          var target = _ref2.target;

          if (self.inputSearch.value == '') {
            self.inputSearch.classList.add('invalid');
            return;
          } else {
            self.inputSearch.classList.remove('invalid');
          }

          self.searchBehaviorsToggler(true);
          self.searchPosts();
        }); //Input Events

        this.inputSearch.addEventListener('keydown', function (e) {
          self.searchValue = e.target.value;

          if (self.inputSearch.value == '') {
            self.inputSearch.classList.add('invalid');
            return;
          } else {
            self.inputSearch.classList.remove('invalid');
          }

          if (e.key == 'Enter' && e.key != '') {
            self.searchPosts();
            self.searchBehaviorsToggler(true);
          }
        });
        this.inputSearch.addEventListener('keyup', function () {
          if (self.inputSearch.value == '') {
            self.inputSearch.classList.add('invalid');
            return;
          } else {
            self.inputSearch.classList.remove('invalid');
          }
        });
      }
    }, {
      key: "searchBehaviorsToggler",
      value: function searchBehaviorsToggler() {
        var search = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

        if (search) {
          this.buttonSearch.classList.add('loading', 'hiddenBtn');
          this.buttonSearch.classList.remove('done');
          this.gallery.classList.remove('hide');
          this.searchModal.classList.add('d-none');
        } else {
          this.buttonSearch.classList.remove('loading', 'hiddenBtn');
          this.buttonSearch.classList.add('done');
          this.gallery.classList.add('hide');
          this.searchModal.classList.remove('d-none');
        }
      }
    }, {
      key: "searchPosts",
      value: function searchPosts() {
        var self = this;
        this.resetHTMLContainers();
        this.searchValue = this.inputSearch.value;
        $.ajax({
          url: window.location.origin + '/wp-json/doctorpedia/v2/search',
          data: {
            s: this.searchValue.replace(/\s+/g, ' ').trim(),
            postTypes: this.allowedCPT
          }
        }).done(function (data) {
          self.searchBehaviorsToggler();
          self.printPostsOnHTML(data.results);
          self.totalPostFound(data);
        });
      }
    }, {
      key: "totalPostFound",
      value: function totalPostFound(data) {
        this.resultsFoundMessage.innerHTML = data.total_results_message;

        if (data.total_results == 0) {
          this.searchModal.classList.add('no-results');
        } else {
          this.searchModal.classList.remove('no-results');
        }
      }
    }, {
      key: "printPostsOnHTML",
      value: function printPostsOnHTML(data) {
        data.forEach(function (cptData) {
          var domPosition = '';

          switch (cptData.posttype) {
            case 'post':
              domPosition = 'articles';
              break;

            case 'categories':
              domPosition = 'channels';
              break;

            case 'videos':
              domPosition = 'videos';
              break;
          }

          if (cptData.postsdata.postsfound != 0) {
            var wrapper = document.querySelector("#js-".concat(domPosition)).parentNode;
            wrapper.classList.remove('d-none');
            var loadMoreButton = wrapper.querySelector('.js-load-more-posts');
            loadMoreButton.setAttribute('page', '1');
            loadMoreButton.setAttribute('total_pages', cptData.postsdata.pages);

            if (cptData.postsdata.pages == 1) {
              loadMoreButton.classList.add('disabled');
            } else {
              loadMoreButton.classList.remove('disabled');
            }

            document.querySelector("#js-count-".concat(domPosition)).innerHTML = cptData.postsdata.postsfound;
            document.querySelector("#js-".concat(domPosition)).innerHTML = cptData.postsdata.html;
          }
        });
      }
    }, {
      key: "resetHTMLContainers",
      value: function resetHTMLContainers() {
        var _this2 = this;

        var allContainers = document.querySelectorAll('.m-search__results-posts');
        allContainers.forEach(function (container) {
          container.innerHTML = '';
          var parent = container.parentNode;
          parent.classList.add('d-none');
          parent.querySelector('h4 > span').innerHTML = '';

          _this2.searchModal.classList.add('d-none');
        });
      }
    }, {
      key: "loadMoreResults",
      value: function loadMoreResults() {
        var self = this;
        this.loadMoreButtons.forEach(function (button) {
          button.addEventListener('click', function (_ref3) {
            var target = _ref3.target;
            var page = parseInt(target.getAttribute('page'));
            var totalPages = parseInt(target.getAttribute('total_pages'));
            var postType = target.getAttribute('post_type');

            if (page < totalPages) {
              self.pagedSearchPostType(postType, page + 1, target.parentNode.querySelector('.m-search__results-posts'));
              target.setAttribute('page', page + 1);

              if (page + 1 == totalPages) {
                target.classList.add('disabled');
              }
            } else {
              target.classList.add('disabled');
            }
          });
        });
      }
    }, {
      key: "pagedSearchPostType",
      value: function pagedSearchPostType(postType, page, container) {
        $.ajax({
          url: window.location.origin + '/wp-json/doctorpedia/v2/search',
          data: {
            s: this.searchValue.replace(/\s+/g, ' ').trim(),
            postTypes: postType,
            page: page
          }
        }).done(function (data) {
          container.innerHTML = container.innerHTML + data.results[0].postsdata.html;
        });
      }
    }]);

    return SearchHero;
  }();

  new SearchHero();
});
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImFuaW1hdGlvbnMuanMiLCJkZWJvdW5jZS5qcyIsImRvY3Rvci1kaXJlY3RvcnkuanMiLCJleHBsb3JlLmpzIiwiZ3Jhdml0eS1mb3Jtcy5qcyIsIm1haW4uanMiLCJtZWV0LW91ci1kb2N0b3JzLmpzIiwibWVnYS1tZW51LmpzIiwicHVibGljLXByb2ZpbGUuanMiLCJzZWFyY2gtbW9kdWxlLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ3pDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FDdkRBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ3RJQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUMzR0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUMzS0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUNub0NBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ3BCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FDN1BBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUNoeUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJhcHBfc2NyaXB0cy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xuXG5mdW5jdGlvbiBfY2xhc3NDYWxsQ2hlY2soaW5zdGFuY2UsIENvbnN0cnVjdG9yKSB7IGlmICghKGluc3RhbmNlIGluc3RhbmNlb2YgQ29uc3RydWN0b3IpKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJDYW5ub3QgY2FsbCBhIGNsYXNzIGFzIGEgZnVuY3Rpb25cIik7IH0gfVxuXG5mdW5jdGlvbiBfZGVmaW5lUHJvcGVydGllcyh0YXJnZXQsIHByb3BzKSB7IGZvciAodmFyIGkgPSAwOyBpIDwgcHJvcHMubGVuZ3RoOyBpKyspIHsgdmFyIGRlc2NyaXB0b3IgPSBwcm9wc1tpXTsgZGVzY3JpcHRvci5lbnVtZXJhYmxlID0gZGVzY3JpcHRvci5lbnVtZXJhYmxlIHx8IGZhbHNlOyBkZXNjcmlwdG9yLmNvbmZpZ3VyYWJsZSA9IHRydWU7IGlmIChcInZhbHVlXCIgaW4gZGVzY3JpcHRvcikgZGVzY3JpcHRvci53cml0YWJsZSA9IHRydWU7IE9iamVjdC5kZWZpbmVQcm9wZXJ0eSh0YXJnZXQsIGRlc2NyaXB0b3Iua2V5LCBkZXNjcmlwdG9yKTsgfSB9XG5cbmZ1bmN0aW9uIF9jcmVhdGVDbGFzcyhDb25zdHJ1Y3RvciwgcHJvdG9Qcm9wcywgc3RhdGljUHJvcHMpIHsgaWYgKHByb3RvUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLnByb3RvdHlwZSwgcHJvdG9Qcm9wcyk7IGlmIChzdGF0aWNQcm9wcykgX2RlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTsgT2JqZWN0LmRlZmluZVByb3BlcnR5KENvbnN0cnVjdG9yLCBcInByb3RvdHlwZVwiLCB7IHdyaXRhYmxlOiBmYWxzZSB9KTsgcmV0dXJuIENvbnN0cnVjdG9yOyB9XG5cbnZhciBBbmltYXRpb25zID0gLyojX19QVVJFX18qL2Z1bmN0aW9uICgpIHtcbiAgZnVuY3Rpb24gQW5pbWF0aW9ucygpIHtcbiAgICBfY2xhc3NDYWxsQ2hlY2sodGhpcywgQW5pbWF0aW9ucyk7XG4gIH1cblxuICBfY3JlYXRlQ2xhc3MoQW5pbWF0aW9ucywgW3tcbiAgICBrZXk6IFwic3RhZ2dlcmVkXCIsXG4gICAgdmFsdWU6IGZ1bmN0aW9uIHN0YWdnZXJlZCgpIHtcbiAgICAgIHZhciBlbGVtZW50cyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5qcy1zdGFnZ2VyZWQnKTtcbiAgICAgIGVsZW1lbnRzLmZvckVhY2goZnVuY3Rpb24gKGVsZW1lbnQpIHtcbiAgICAgICAgZWxlbWVudC53YXlwb2ludCA9IG5ldyBXYXlwb2ludCh7XG4gICAgICAgICAgZWxlbWVudDogZWxlbWVudCxcbiAgICAgICAgICBoYW5kbGVyOiBmdW5jdGlvbiBoYW5kbGVyKGRpcmVjdGlvbikge1xuICAgICAgICAgICAgYW5pbWUoe1xuICAgICAgICAgICAgICB0YXJnZXRzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5qcy1zdGFnZ2VyZWQtaXRlbScpLFxuICAgICAgICAgICAgICB0cmFuc2xhdGVZOiBbLTIyMCwgMF0sXG4gICAgICAgICAgICAgIG9wYWNpdHk6IFswLCAxXSxcbiAgICAgICAgICAgICAgZWFzaW5nOiAnZWFzZUluT3V0UXVhZCcsXG4gICAgICAgICAgICAgIGR1cmF0aW9uOiA1MDAsXG4gICAgICAgICAgICAgIGRlbGF5OiBhbmltZS5zdGFnZ2VyKDMwMCwge1xuICAgICAgICAgICAgICAgIHN0YXJ0OiA1MDBcbiAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgdGhpcy5kZXN0cm95KCk7XG4gICAgICAgICAgfSxcbiAgICAgICAgICBob3Jpem9udGFsOiBmYWxzZSxcbiAgICAgICAgICBvZmZzZXQ6ICc5MCUnXG4gICAgICAgIH0pO1xuICAgICAgfSk7XG4gICAgfVxuICB9XSk7XG5cbiAgcmV0dXJuIEFuaW1hdGlvbnM7XG59KCk7IiwiXCJ1c2Ugc3RyaWN0XCI7XG5cbmZ1bmN0aW9uIF9jbGFzc0NhbGxDaGVjayhpbnN0YW5jZSwgQ29uc3RydWN0b3IpIHsgaWYgKCEoaW5zdGFuY2UgaW5zdGFuY2VvZiBDb25zdHJ1Y3RvcikpIHsgdGhyb3cgbmV3IFR5cGVFcnJvcihcIkNhbm5vdCBjYWxsIGEgY2xhc3MgYXMgYSBmdW5jdGlvblwiKTsgfSB9XG5cbmZ1bmN0aW9uIF9kZWZpbmVQcm9wZXJ0aWVzKHRhcmdldCwgcHJvcHMpIHsgZm9yICh2YXIgaSA9IDA7IGkgPCBwcm9wcy5sZW5ndGg7IGkrKykgeyB2YXIgZGVzY3JpcHRvciA9IHByb3BzW2ldOyBkZXNjcmlwdG9yLmVudW1lcmFibGUgPSBkZXNjcmlwdG9yLmVudW1lcmFibGUgfHwgZmFsc2U7IGRlc2NyaXB0b3IuY29uZmlndXJhYmxlID0gdHJ1ZTsgaWYgKFwidmFsdWVcIiBpbiBkZXNjcmlwdG9yKSBkZXNjcmlwdG9yLndyaXRhYmxlID0gdHJ1ZTsgT2JqZWN0LmRlZmluZVByb3BlcnR5KHRhcmdldCwgZGVzY3JpcHRvci5rZXksIGRlc2NyaXB0b3IpOyB9IH1cblxuZnVuY3Rpb24gX2NyZWF0ZUNsYXNzKENvbnN0cnVjdG9yLCBwcm90b1Byb3BzLCBzdGF0aWNQcm9wcykgeyBpZiAocHJvdG9Qcm9wcykgX2RlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IucHJvdG90eXBlLCBwcm90b1Byb3BzKTsgaWYgKHN0YXRpY1Byb3BzKSBfZGVmaW5lUHJvcGVydGllcyhDb25zdHJ1Y3Rvciwgc3RhdGljUHJvcHMpOyBPYmplY3QuZGVmaW5lUHJvcGVydHkoQ29uc3RydWN0b3IsIFwicHJvdG90eXBlXCIsIHsgd3JpdGFibGU6IGZhbHNlIH0pOyByZXR1cm4gQ29uc3RydWN0b3I7IH1cblxudmFyIERlYm91bmNlID0gLyojX19QVVJFX18qL2Z1bmN0aW9uICgpIHtcbiAgZnVuY3Rpb24gRGVib3VuY2UoX3JlZikge1xuICAgIHZhciBpbnB1dCA9IF9yZWYuaW5wdXQsXG4gICAgICAgIHRpbWUgPSBfcmVmLnRpbWUsXG4gICAgICAgIGRvbmVGdW5jdGlvbiA9IF9yZWYuZG9uZUZ1bmN0aW9uO1xuXG4gICAgX2NsYXNzQ2FsbENoZWNrKHRoaXMsIERlYm91bmNlKTtcblxuICAgIHRoaXMuaW5wdXQgPSBpbnB1dDtcbiAgICB0aGlzLnRpbWUgPSB0aW1lID8gdGltZSA6IDUwMDtcbiAgICB0aGlzLmRvbmUgPSBkb25lRnVuY3Rpb247XG5cbiAgICB0aGlzLmV4ZWN1dGVPbkRlYm91bmNlID0gZnVuY3Rpb24gKGNhbGxiYWNrKSB7XG4gICAgICBjYWxsYmFjayh0aGlzLmlucHV0LnZhbHVlKTtcbiAgICB9O1xuXG4gICAgdGhpcy5pbml0KCk7XG4gIH1cblxuICBfY3JlYXRlQ2xhc3MoRGVib3VuY2UsIFt7XG4gICAga2V5OiBcImluaXRcIixcbiAgICB2YWx1ZTogZnVuY3Rpb24gaW5pdCgpIHtcbiAgICAgIC8vc2V0dXAgYmVmb3JlIGZ1bmN0aW9uc1xuICAgICAgdmFyIHR5cGluZ1RpbWVyOyAvL3RpbWVyIGlkZW50aWZpZXJcblxuICAgICAgdmFyIGRvbmVUeXBpbmdJbnRlcnZhbCA9IHRoaXMudGltZTsgLy90aW1lIGluIG1zLCA1IHNlY29uZCBmb3IgZXhhbXBsZVxuXG4gICAgICB2YXIgJGlucHV0ID0gdGhpcy5pbnB1dDsgLy9vbiBrZXl1cCwgc3RhcnQgdGhlIGNvdW50ZG93blxuXG4gICAgICAkaW5wdXQuYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGNsZWFyVGltZW91dCh0eXBpbmdUaW1lcik7XG4gICAgICAgIHR5cGluZ1RpbWVyID0gc2V0VGltZW91dChkb25lVHlwaW5nLCBkb25lVHlwaW5nSW50ZXJ2YWwpO1xuICAgICAgfSk7IC8vb24ga2V5ZG93biwgY2xlYXIgdGhlIGNvdW50ZG93biBcblxuICAgICAgJGlucHV0LmFkZEV2ZW50TGlzdGVuZXIoJ2tleWRvd24nLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGNsZWFyVGltZW91dCh0eXBpbmdUaW1lcik7XG4gICAgICB9KTsgLy91c2VyIGlzIFwiZmluaXNoZWQgdHlwaW5nLFwiIGRvIHNvbWV0aGluZ1xuXG4gICAgICB2YXIgc2VsZiA9IHRoaXM7XG5cbiAgICAgIGZ1bmN0aW9uIGRvbmVUeXBpbmcoKSB7XG4gICAgICAgIHNlbGYuZXhlY3V0ZU9uRGVib3VuY2Uoc2VsZi5kb25lKTtcbiAgICAgIH1cbiAgICB9XG4gIH1dKTtcblxuICByZXR1cm4gRGVib3VuY2U7XG59KCk7IiwiXCJ1c2Ugc3RyaWN0XCI7XG5cbi8qKlxuICogXG4gKiBEb2N0b3IgRGlyZWN0b3J5IExheW91dCBcbiAqL1xuZnVuY3Rpb24gcmVzaXplR3JpZEl0ZW0oaXRlbSkge1xuICB2YXIgZ3JpZCA9ICQoXCIjanMtZG9jdG9yRGlyZWN0b3J5XCIpO1xuICB2YXIgcm93SGVpZ2h0ID0gcGFyc2VJbnQoZ3JpZC5jc3MoJ2dyaWQtYXV0by1yb3dzJykpO1xuICB2YXIgcm93R2FwID0gcGFyc2VJbnQoZ3JpZC5jc3MoJ2dyaWQtcm93LWdhcCcpKTtcbiAgdmFyIHJvd1NwYW4gPSBNYXRoLmNlaWwoKGl0ZW0ucXVlcnlTZWxlY3RvcignLmNvbnRlbnQnKS5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKS5oZWlnaHQgKyByb3dHYXApIC8gKHJvd0hlaWdodCArIHJvd0dhcCkpO1xuICBpdGVtLnN0eWxlLmdyaWRSb3dFbmQgPSBcInNwYW4gXCIgKyByb3dTcGFuO1xuICBpdGVtLnF1ZXJ5U2VsZWN0b3IoJy5jb250ZW50Jykuc3R5bGUuaGVpZ2h0ID0gXCJhdXRvXCI7XG59XG5cbmZ1bmN0aW9uIHJlc2l6ZUFsbEdyaWRJdGVtcygpIHtcbiAgdmFyIGFsbEl0ZW1zID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcImpzLWV4cGVydENhcmRcIik7XG5cbiAgZm9yICh2YXIgeCA9IDA7IHggPCBhbGxJdGVtcy5sZW5ndGg7IHgrKykge1xuICAgIHJlc2l6ZUdyaWRJdGVtKGFsbEl0ZW1zW3hdKTtcbiAgfVxufVxuXG5mdW5jdGlvbiByZXNpemVJbnN0YW5jZShpbnN0YW5jZSkge1xuICB2YXIgaXRlbSA9IGluc3RhbmNlLmVsZW1lbnRzWzBdO1xuICByZXNpemVHcmlkSXRlbShpdGVtKTtcbn1cblxud2luZG93Lm9ubG9hZCA9IHJlc2l6ZUFsbEdyaWRJdGVtcygpO1xud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoXCJyZXNpemVcIiwgcmVzaXplQWxsR3JpZEl0ZW1zKTtcbi8qKlxuICogRG9jdG9yIERpcmVjdG9yeSBTZWFyY2hcbiAqL1xuXG5mdW5jdGlvbiBzZWFyY2hEb2N0b3JEaXJlY3RvcnkoKSB7XG4gIHZhciBjdXJyZW50X3BhZ2UgPSBhcmd1bWVudHMubGVuZ3RoID4gMCAmJiBhcmd1bWVudHNbMF0gIT09IHVuZGVmaW5lZCA/IGFyZ3VtZW50c1swXSA6IG51bGw7XG4gIHJldHVybiBmdW5jdGlvbiAoY3VycmVudF9wYWdlKSB7XG4gICAgdmFyIHNvcnRCeSA9ICQoJyNzb3J0QnknKS52YWwoKTtcbiAgICB2YXIgc3BlY2lhbHR5ID0gJCgnI3NlYXJjaFNwZWNpYWx0eScpLnZhbCgpO1xuICAgIHZhciBleHBlcnRpc2UgPSAkKCcjc2VhcmNoRXhwZXJ0aXNlJykudmFsKCk7XG4gICAgdmFyIGN1cnJlbnRfcGFnZSA9IGN1cnJlbnRfcGFnZSA/IGN1cnJlbnRfcGFnZSA6ICQoJyNjdXJyZW50X3BhZ2UnKS52YWwoKTtcbiAgICB2YXIgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdzZWFyY2hEb2N0b3JEaXJlY3RvcnknKTtcbiAgICBmb3JtRGF0YS5hcHBlbmQoJ3NwZWNpYWx0eScsIHNwZWNpYWx0eSk7XG4gICAgZm9ybURhdGEuYXBwZW5kKCdleHBlcnRpc2UnLCBleHBlcnRpc2UpO1xuICAgIGZvcm1EYXRhLmFwcGVuZCgnc29ydEJ5Jywgc29ydEJ5KTtcbiAgICBmb3JtRGF0YS5hcHBlbmQoJ2N1cnJlbnRfcGFnZScsIGN1cnJlbnRfcGFnZSk7XG4gICAgalF1ZXJ5LmFqYXgoe1xuICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgdXJsOiBibXNfdmFycy5hamF4dXJsLFxuICAgICAgdHlwZTogJ1BPU1QnLFxuICAgICAgZGF0YTogZm9ybURhdGEsXG4gICAgICBjb250ZW50VHlwZTogZmFsc2UsXG4gICAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiBiZWZvcmVTZW5kKCkge1xuICAgICAgICAkKCcjanMtZG9jdG9yRGlyZWN0b3J5UGFnaW5hdG9yJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAkKCcjanMtZG9jdG9yRGlyZWN0b3J5JykuaHRtbCgnPGltZyBzcmM9XCIvd3AtY29udGVudC90aGVtZXMvZG9jdG9ycGVkaWEvaW1nL1NwaW4tMXMtMjAwcHguZ2lmXCIgd2lkdGg9XCI1MHB4XCIgY2xhc3M9XCJzcGluLWxvYWRlclwiPicpO1xuICAgICAgfSxcbiAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIHN1Y2Nlc3MocmVzcG9uc2UpIHtcbiAgICAgICAgJCgnI2pzLWRvY3RvckRpcmVjdG9yeVBhZ2luYXRvcicpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgJCgnI2pzLWRvY3RvckRpcmVjdG9yeScpLmh0bWwocmVzcG9uc2UuZGF0YS5odG1sKTtcbiAgICAgICAgJCgnI2pzLWRvY3RvckRpcmVjdG9yeVBhZ2luYXRvcicpLmh0bWwocmVzcG9uc2UuZGF0YS5wYWdpbmF0b3IpO1xuICAgICAgfSxcbiAgICAgIGNvbXBsZXRlOiBmdW5jdGlvbiBjb21wbGV0ZSgpIHtcbiAgICAgICAgcmVzaXplQWxsR3JpZEl0ZW1zKCk7XG4gICAgICB9XG4gICAgfSk7XG4gIH0oY3VycmVudF9wYWdlKTtcbn1cblxuJCgnI3NlYXJjaFNwZWNpYWx0eScpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbiAoKSB7XG4gIHNlYXJjaERvY3RvckRpcmVjdG9yeSgpO1xufSk7XG4kKCcjc2VhcmNoRXhwZXJ0aXNlJykub24oJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcbiAgc2VhcmNoRG9jdG9yRGlyZWN0b3J5KCk7XG59KTtcbiQoJyNzb3J0QnknKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xuICBzZWFyY2hEb2N0b3JEaXJlY3RvcnkoKTtcbn0pO1xuLyoqXG4gKiBGaWx0ZXIgYnkgbmFtZSBERCBcbiAqL1xuXG5mdW5jdGlvbiBmaWx0ZXJUb1Byb2ZpbGUob2JqKSB7XG4gIGlmIChvYmoudmFsdWUgPT0gJycpIHtcbiAgICBzZWFyY2hEb2N0b3JEaXJlY3RvcnkoKTtcbiAgICByZXR1cm47XG4gIH1cblxuICB2YXIgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdhY3Rpb24nLCAnZmlsdGVyRG9jdG9yRGlyZWN0b3J5Jyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnZXhwZXJ0X2lkJywgb2JqLnZhbHVlKTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IGJtc192YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICQoJyNqcy1kb2N0b3JEaXJlY3RvcnlQYWdpbmF0b3InKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAkKCcjanMtZG9jdG9yRGlyZWN0b3J5JykuaHRtbCgnPGltZyBzcmM9XCIvd3AtY29udGVudC90aGVtZXMvZG9jdG9ycGVkaWEvaW1nL1NwaW4tMXMtMjAwcHguZ2lmXCIgd2lkdGg9XCI1MHB4XCIgY2xhc3M9XCJzcGluLWxvYWRlclwiPicpO1xuICAgIH0sXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJCgnI2pzLWRvY3RvckRpcmVjdG9yeVBhZ2luYXRvcicpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgICAgICQoJyNqcy1kb2N0b3JEaXJlY3RvcnknKS5odG1sKHJlc3BvbnNlLmRhdGEuaHRtbCk7XG4gICAgICAkKCcjanMtZG9jdG9yRGlyZWN0b3J5UGFnaW5hdG9yJykuaHRtbChyZXNwb25zZS5kYXRhLnBhZ2luYXRvcik7XG4gICAgfSxcbiAgICBjb21wbGV0ZTogZnVuY3Rpb24gY29tcGxldGUoKSB7XG4gICAgICByZXNpemVBbGxHcmlkSXRlbXMoKTtcbiAgICB9XG4gIH0pO1xufVxuLyoqXG4gKiBNb2R1bGUgSGVybyBERFxuICovXG5cblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAvKipcbiAgICogc2VsZWN0cGlja2VyIG9wdGlvbnMgaHR0cHM6Ly9kZXZlbG9wZXIuc25hcGFwcG9pbnRtZW50cy5jb20vYm9vdHN0cmFwLXNlbGVjdC9vcHRpb25zLyNib290c3RyYXAtdmVyc2lvblxuICAgKi9cbiAgJCgnI3NlYXJjaFNwZWNpYWx0eScpLnNlbGVjdHBpY2tlcih7XG4gICAgdmlydHVhbFNjcm9sbDogZmFsc2VcbiAgfSk7XG4gICQoJyNzZWFyY2hFeHBlcnRpc2UnKS5zZWxlY3RwaWNrZXIoe1xuICAgIHZpcnR1YWxTY3JvbGw6IGZhbHNlXG4gIH0pO1xuICAkKCcjc29ydEJ5Jykuc2VsZWN0cGlja2VyKHtcbiAgICB2aXJ0dWFsU2Nyb2xsOiBmYWxzZVxuICB9KTtcbiAgJCgnI2ZpbHRlckJ5RXhwZXJ0Jykuc2VsZWN0cGlja2VyKHtcbiAgICB2aXJ0dWFsU2Nyb2xsOiBmYWxzZVxuICB9KTtcbn0pOyIsIlwidXNlIHN0cmljdFwiO1xuXG5mdW5jdGlvbiBfY2xhc3NDYWxsQ2hlY2soaW5zdGFuY2UsIENvbnN0cnVjdG9yKSB7IGlmICghKGluc3RhbmNlIGluc3RhbmNlb2YgQ29uc3RydWN0b3IpKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJDYW5ub3QgY2FsbCBhIGNsYXNzIGFzIGEgZnVuY3Rpb25cIik7IH0gfVxuXG5mdW5jdGlvbiBfZGVmaW5lUHJvcGVydGllcyh0YXJnZXQsIHByb3BzKSB7IGZvciAodmFyIGkgPSAwOyBpIDwgcHJvcHMubGVuZ3RoOyBpKyspIHsgdmFyIGRlc2NyaXB0b3IgPSBwcm9wc1tpXTsgZGVzY3JpcHRvci5lbnVtZXJhYmxlID0gZGVzY3JpcHRvci5lbnVtZXJhYmxlIHx8IGZhbHNlOyBkZXNjcmlwdG9yLmNvbmZpZ3VyYWJsZSA9IHRydWU7IGlmIChcInZhbHVlXCIgaW4gZGVzY3JpcHRvcikgZGVzY3JpcHRvci53cml0YWJsZSA9IHRydWU7IE9iamVjdC5kZWZpbmVQcm9wZXJ0eSh0YXJnZXQsIGRlc2NyaXB0b3Iua2V5LCBkZXNjcmlwdG9yKTsgfSB9XG5cbmZ1bmN0aW9uIF9jcmVhdGVDbGFzcyhDb25zdHJ1Y3RvciwgcHJvdG9Qcm9wcywgc3RhdGljUHJvcHMpIHsgaWYgKHByb3RvUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLnByb3RvdHlwZSwgcHJvdG9Qcm9wcyk7IGlmIChzdGF0aWNQcm9wcykgX2RlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTsgT2JqZWN0LmRlZmluZVByb3BlcnR5KENvbnN0cnVjdG9yLCBcInByb3RvdHlwZVwiLCB7IHdyaXRhYmxlOiBmYWxzZSB9KTsgcmV0dXJuIENvbnN0cnVjdG9yOyB9XG5cbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICB2YXIgRXhwbG9yZSA9IC8qI19fUFVSRV9fKi9mdW5jdGlvbiAoKSB7XG4gICAgZnVuY3Rpb24gRXhwbG9yZShtb2R1bGUpIHtcbiAgICAgIF9jbGFzc0NhbGxDaGVjayh0aGlzLCBFeHBsb3JlKTtcblxuICAgICAgdGhpcy5zbGlkZXIgPSBtb2R1bGUucXVlcnlTZWxlY3RvcignLmpzLWV4cGxvcmUtc2xpZGVyJyk7XG4gICAgICB0aGlzLnNlYXJjaFdyYXBwZXIgPSBtb2R1bGUucXVlcnlTZWxlY3RvcignLmpzLXNlYXJjaC13cmFwcGVyJyk7XG4gICAgICB0aGlzLnNlYXJjaElucHV0ID0gbW9kdWxlLnF1ZXJ5U2VsZWN0b3IoJy5qcy1leHBsb3JlLXNlYXJjaCcpO1xuICAgICAgdGhpcy5zZWFyY2hWYWx1ZSA9ICcnO1xuICAgICAgdGhpcy5kcm9wZG93bkJ0biA9IG1vZHVsZS5xdWVyeVNlbGVjdG9yKCcuanMtZXhwbG9yZS1vcGVuLWNsb3NlLWRyb3Bkb3duJyk7XG4gICAgICB0aGlzLnJlc3VsdHMgPSBtb2R1bGUucXVlcnlTZWxlY3RvcignLmpzLWV4cGxvcmUtcmVzdWx0cycpO1xuICAgICAgdGhpcy5zbGlkZXJSdW4oKTsgLy90aGlzLnNlYXJjaCgpOyAgLy8gTm90IGltcGxlbWVudGVkXG5cbiAgICAgIHRoaXMuZHJvcGRvd24oKTtcbiAgICB9XG5cbiAgICBfY3JlYXRlQ2xhc3MoRXhwbG9yZSwgW3tcbiAgICAgIGtleTogXCJzbGlkZXJSdW5cIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBzbGlkZXJSdW4oKSB7XG4gICAgICAgICQodGhpcy5zbGlkZXIpLnNsaWNrKHtcbiAgICAgICAgICBpbmZpbml0ZTogdHJ1ZSxcbiAgICAgICAgICBzbGlkZXNUb1Nob3c6IDMsXG4gICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDMsXG4gICAgICAgICAgcmVzcG9uc2l2ZTogW3tcbiAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDg1MCxcbiAgICAgICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMixcbiAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDJcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9LCB7XG4gICAgICAgICAgICBicmVha3BvaW50OiA2MjAsXG4gICAgICAgICAgICBzZXR0aW5nczoge1xuICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXG4gICAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxuICAgICAgICAgICAgICBjZW50ZXJNb2RlOiB0cnVlLFxuICAgICAgICAgICAgICBjZW50ZXJQYWRkaW5nOiAnNDBweCdcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XVxuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwic2VhcmNoXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gc2VhcmNoKCkge1xuICAgICAgICB2YXIgX3RoaXMgPSB0aGlzO1xuXG4gICAgICAgIG5ldyBEZWJvdW5jZSh7XG4gICAgICAgICAgaW5wdXQ6IHRoaXMuc2VhcmNoSW5wdXQsXG4gICAgICAgICAgdGltZTogMzAwLFxuICAgICAgICAgIGRvbmVGdW5jdGlvbjogZnVuY3Rpb24gZG9uZUZ1bmN0aW9uKHZhbHVlKSB7XG4gICAgICAgICAgICBfdGhpcy5zZWFyY2hWYWx1ZSA9IHZhbHVlO1xuXG4gICAgICAgICAgICBfdGhpcy5hamF4Q2FsbCgpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcImFqYXhDYWxsXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gYWpheENhbGwoKSB7XG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICBtZXRob2Q6IFwiR0VUXCIsXG4gICAgICAgICAgdXJsOiBsb2NhdGlvbi5vcmlnaW4gKyAnL3dwLWpzb24vZG9jdG9ycGVkaWEvdjIvY2hhbm5lbHMtdGF4b25vbXknLFxuICAgICAgICAgIGRhdGE6IHtcbiAgICAgICAgICAgICdzZWFyY2gnOiBzZWxmLnNlYXJjaFZhbHVlXG4gICAgICAgICAgfSxcbiAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAgICAgICBzZWxmLnJlc3VsdHMuaW5uZXJIVE1MID0gcmVzcG9uc2UuZGF0YTtcblxuICAgICAgICAgICAgaWYgKHNlbGYuc2VhcmNoVmFsdWUgIT0gJycpIHtcbiAgICAgICAgICAgICAgc2VsZi5zZWFyY2hXcmFwcGVyLmNsYXNzTGlzdC5hZGQoJ29wZW4nKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHNlbGYuc2VhcmNoV3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdvcGVuJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfSxcbiAgICAgICAgICBlcnJvcjogZnVuY3Rpb24gZXJyb3IoX2Vycm9yKSB7XG4gICAgICAgICAgICBjb25zb2xlLmxvZyhfZXJyb3IpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcImRyb3Bkb3duXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gZHJvcGRvd24oKSB7XG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgdGhpcy5zZWFyY2hJbnB1dC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBzZWxmLnNlYXJjaFdyYXBwZXIuY2xhc3NMaXN0LnRvZ2dsZSgnb3BlbicpO1xuICAgICAgICB9KTtcbiAgICAgICAgdGhpcy5kcm9wZG93bkJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBzZWxmLnNlYXJjaFdyYXBwZXIuY2xhc3NMaXN0LnRvZ2dsZSgnb3BlbicpO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9XSk7XG5cbiAgICByZXR1cm4gRXhwbG9yZTtcbiAgfSgpO1xuXG4gIHZhciBleHBsb3JlTW9kdWxlcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5qcy1leHBsb3JlLW1vZHVsZScpO1xuICBleHBsb3JlTW9kdWxlcy5mb3JFYWNoKGZ1bmN0aW9uIChtb2R1bGUpIHtcbiAgICBuZXcgRXhwbG9yZShtb2R1bGUpO1xuICB9KTtcbn0pOyIsIlwidXNlIHN0cmljdFwiO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gIC8vIGFkZCBhdXRvY29tcGxldGUgb2ZmIGlucHV0c1xuICAkLmVhY2goJCgnLmFmZmlsaWF0ZS1mb3JtJykuc2VyaWFsaXplQXJyYXkoKSwgZnVuY3Rpb24gKGksIGZpZWxkKSB7XG4gICAgJCgnaW5wdXRbbmFtZT1cIicgKyBmaWVsZC5uYW1lICsgJ1wiXScpLmF0dHIoJ2F1dG9jb21wbGV0ZScsICdvZmYnKTtcbiAgfSk7XG5cbiAgaWYgKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5pbnB1dF9fY29kZScpICE9PSBudWxsKSB7XG4gICAgJChcIi5pbnB1dF9fY29kZSAubWVkaXVtXCIpLnBhcmVudCgpLmFwcGVuZCgnPGRpdiBjbGFzcz1cInRleHQtZGFuZ2VyIGpzLWdmLW1lc3NhZ2UtNFwiPjwvZGl2PicpO1xuICAgICQoXCIuaW5wdXRfX2NvZGUgLm1lZGl1bVwiKS5wYXJlbnQoKS5hcHBlbmQoJzxkaXYgY2xhc3M9XCJ0ZXh0LWRhbmdlciBqcy1nZi1sb2FkZXJcIj48L2Rpdj4nKTtcbiAgICAkKCcuZ2Zvcm1fYnV0dG9uJykuYXR0cignZGlzYWJsZWQnLCB0cnVlKTtcbiAgICAkKCcuYWZmaWxpYXRlLWZvcm0nKS5hdHRyKCdhdXRvY29tcGxldGUnLCAnb2ZmJyk7IC8vIGxpc3RlbmVyIGZvciBHRVQgdmFyc1xuXG4gICAgdmFyIGNvZGUgPSBnZXRRdWVyeVZhcmlhYmxlKCdjb2RlJyk7XG5cbiAgICBpZiAoY29kZSkge1xuICAgICAgJChcIi5pbnB1dF9fY29kZSAubWVkaXVtXCIpLnZhbChjb2RlKTtcbiAgICAgICQoJy5nZm9ybV9idXR0b24nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xuICAgIH0gLy8gbGlzdGVuZXIgZm9ybSBhZmZpbGlhdGUgLSBpbnB1dCBjb2RlIFxuXG5cbiAgICAkKFwiLmlucHV0X19jb2RlIC5tZWRpdW1cIikua2V5dXAoZnVuY3Rpb24gKCkge1xuICAgICAgdmFyIGlucHV0X19jb2RlID0gJCh0aGlzKTtcbiAgICAgIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICAgICAgZm9ybURhdGEuYXBwZW5kKCdhY3Rpb24nLCBhamF4X3Zhci5hY3Rpb24pO1xuICAgICAgZm9ybURhdGEuYXBwZW5kKCdjb2RlJywgaW5wdXRfX2NvZGUudmFsKCkpO1xuICAgICAgZm9ybURhdGEuYXBwZW5kKCdub25jZScsIGFqYXhfdmFyLm5vbmNlKTtcbiAgICAgIGpRdWVyeS5hamF4KHtcbiAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICB1cmw6IGFqYXhfdmFyLnVybCxcbiAgICAgICAgdHlwZTogJ1BPU1QnLFxuICAgICAgICBkYXRhOiBmb3JtRGF0YSxcbiAgICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgICAgIGJlZm9yZVNlbmQ6IGZ1bmN0aW9uIGJlZm9yZVNlbmQoKSB7XG4gICAgICAgICAgJCgnLmpzLWdmLWxvYWRlcicpLmh0bWwoJzxpbWcgc3JjPVwiL3dwLWNvbnRlbnQvdGhlbWVzL2RvY3RvcnBlZGlhL2ltZy9TcGluLTFzLTIwMHB4LmdpZlwiIHdpZHRoPVwiMTVweFwiPicpO1xuICAgICAgICB9LFxuICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAgICAgJCgnLmpzLWdmLWxvYWRlcicpLmh0bWwoJycpO1xuXG4gICAgICAgICAgaWYgKHJlc3BvbnNlLmRhdGEuc3RhdHVzID09ICdlcnJvcicpIHtcbiAgICAgICAgICAgIGlucHV0X19jb2RlLmNzcygnYm9yZGVyJywgJzFweCBzb2xpZCByZWQnKTtcbiAgICAgICAgICAgICQoJy5qcy1nZi1tZXNzYWdlLTQnKS5odG1sKCdJbnZhbGlkIENvZGUnKTtcbiAgICAgICAgICAgICQoJy5nZm9ybV9idXR0b24nKS5hdHRyKCdkaXNhYmxlZCcsIHRydWUpO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBpbnB1dF9fY29kZS5jc3MoJ2JvcmRlcicsICcxcHggc29saWQgZ3JlZW4nKTtcbiAgICAgICAgICAgICQoJy5qcy1nZi1tZXNzYWdlLTQnKS5odG1sKCcnKTtcbiAgICAgICAgICAgICQoJy5nZm9ybV9idXR0b24nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfSk7XG4gICAgfSk7XG4gIH1cbiAgLyogRm9ybSBHcmF2aXR5ICovXG5cblxuICAkKCcjZ2Zvcm1fc3VibWl0X2J1dHRvbl82JykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICQoJyNqcy1yZWdpc3Rlci1mb3JtJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgIHZhciBlbWFpbCA9ICQoJyNpbnB1dF82XzEnKS52YWwoKTtcbiAgICAkKCcjdXNlcl9lbWFpbCcpLnZhbChlbWFpbCk7XG4gIH0pO1xuICAvKiBGb3JtIFJlZ2lzdGVyICovXG5cbiAgalF1ZXJ5KCcjanMtZm9ybS1yZWdpc3RlcicpLnN1Ym1pdChmdW5jdGlvbiAoZXZlbnQpIHtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgaWYgKCQoJyN1c2VyX2Zpc3RuYW1lJykudmFsKCkgPT0gJycpIHtcbiAgICAgICQoXCIjanMtcmVnaXN0ZXItbWVzc2FnZUZvcm1cIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPlBsZWFzZSBjb21wbGV0ZSBGaXN0IE5hbWU8L3A+Jyk7XG4gICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgaWYgKCQoJyN1c2VyX2xhc3RuYW1lJykudmFsKCkgPT0gJycpIHtcbiAgICAgICQoXCIjanMtcmVnaXN0ZXItbWVzc2FnZUZvcm1cIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPlBsZWFzZSBjb21wbGV0ZSBMYXN0IE5hbWU8L3A+Jyk7XG4gICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgaWYgKCQoJyN1c2VyX2VtYWlsJykudmFsKCkgPT0gJycpIHtcbiAgICAgICQoXCIjanMtcmVnaXN0ZXItbWVzc2FnZUZvcm1cIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPlBsZWFzZSBjb21wbGV0ZSBFbWFpbDwvcD4nKTtcbiAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICBpZiAoJCgnI3VzZXJfcGFzcycpLnZhbCgpID09ICcnKSB7XG4gICAgICAkKFwiI2pzLXJlZ2lzdGVyLW1lc3NhZ2VGb3JtXCIpLmh0bWwoJzxwIGNsYXNzPVwidGV4dC1kYW5nZXJcIj5QbGVhc2UgY29tcGxldGUgUGFzc3dvcmQ8L3A+Jyk7XG4gICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgaWYgKCQoJyN1c2VyX3JlcGFzcycpLnZhbCgpID09ICcnKSB7XG4gICAgICAkKFwiI2pzLXJlZ2lzdGVyLW1lc3NhZ2VGb3JtXCIpLmh0bWwoJzxwIGNsYXNzPVwidGV4dC1kYW5nZXJcIj5QbGVhc2UgY29tcGxldGUgQ29uZmlybSBQYXNzd29yZDwvcD4nKTtcbiAgICAgIHJldHVybjtcbiAgICB9XG5cbiAgICBpZiAoJCgnI3VzZXJfcmVwYXNzJykudmFsKCkgIT09ICQoJyN1c2VyX3Bhc3MnKS52YWwoKSkge1xuICAgICAgJChcIiNqcy1yZWdpc3Rlci1tZXNzYWdlRm9ybVwiKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+UGFzc3dvcmRzIGRvblxcJ3QgbWF0Y2g8L3A+Jyk7XG4gICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgaWYgKCQoJyN0ZXJtcycpLmlzKCc6Y2hlY2tlZCcpKSB7fSBlbHNlIHtcbiAgICAgICQoXCIjanMtcmVnaXN0ZXItbWVzc2FnZUZvcm1cIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPlBsZWFzZSBBY2NlcHQgVGVybXMgJiBDb25kaXRpb25zPC9wPicpO1xuICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICAgIGZvcm1EYXRhLmFwcGVuZCgnYWN0aW9uJywgJ2Jsb2dnaW5nX1JlZ2lzdGVyJyk7XG4gICAgZm9ybURhdGEuYXBwZW5kKCd1c2VyX2Zpc3RuYW1lJywgJCgnI3VzZXJfZmlzdG5hbWUnKS52YWwoKSk7XG4gICAgZm9ybURhdGEuYXBwZW5kKCd1c2VyX2xhc3RuYW1lJywgJCgnI3VzZXJfbGFzdG5hbWUnKS52YWwoKSk7XG4gICAgZm9ybURhdGEuYXBwZW5kKCd1c2VyX2VtYWlsJywgJCgnI3VzZXJfZW1haWwnKS52YWwoKSk7XG4gICAgZm9ybURhdGEuYXBwZW5kKCd1c2VyX3Bhc3MnLCAkKCcjdXNlcl9wYXNzJykudmFsKCkpO1xuICAgIGpRdWVyeS5hamF4KHtcbiAgICAgIGNhY2hlOiBmYWxzZSxcbiAgICAgIHVybDogJCgnI2pzLWZvcm0tcmVnaXN0ZXInKS5hdHRyKCdhY3Rpb24nKSxcbiAgICAgIHR5cGU6ICdQT1NUJyxcbiAgICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICAgJChcIiNqcy1yZWdpc3Rlci1tZXNzYWdlRm9ybVwiKS5mYWRlSW4oJ2Zhc3QnKTtcbiAgICAgICAgJChcIiNqcy1yZWdpc3Rlci1tZXNzYWdlRm9ybVwiKS5odG1sKCc8cCBjbGFzcz1cInRleHQtaW5mb1wiPlNlbmRpbmcuLi4uPC9wPicpO1xuICAgICAgfSxcbiAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIHN1Y2Nlc3MocmVzcG9uc2UpIHtcbiAgICAgICAgaWYgKHJlc3BvbnNlLnN1Y2Nlc3MgPT0gdHJ1ZSkge1xuICAgICAgICAgICQoXCIjanMtcmVnaXN0ZXItbWVzc2FnZUZvcm1cIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LXN1Y2Nlc3NcIj5Zb3VyIHJlZ2lzdHJhdGlvbiBoYXMgYmVlbiBzdWNjZXNzZnVsISByZWRpcmVjdGluZy4uLjwvcD4nKTtcbiAgICAgICAgICAkKFwiI2pzLXJlZ2lzdGVyLXN1Ym1pdFwiKS5hdHRyKCdkaXNhYmxlZDpkaXNhYmxlZCcpO1xuICAgICAgICAgICQobG9jYXRpb24pLmF0dHIoJ2hyZWYnLCAnL2RvY3Rvci1wbGF0Zm9ybS9jb21wbGV0ZS1iaW8vJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgJChcIiNqcy1yZWdpc3Rlci1tZXNzYWdlRm9ybVwiKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+JyArIHJlc3BvbnNlLmRhdGEgKyAnPC9wPicpO1xuICAgICAgICB9XG4gICAgICB9XG4gICAgfSk7XG4gICAgcmV0dXJuIGZhbHNlO1xuICB9KTtcbn0pOyAvLyBzZWFyY2ggdmFyIGZyb20gdXJsXG5cbmZ1bmN0aW9uIGdldFF1ZXJ5VmFyaWFibGUodmFyaWFibGUpIHtcbiAgdmFyIHF1ZXJ5ID0gd2luZG93LmxvY2F0aW9uLnNlYXJjaC5zdWJzdHJpbmcoMSk7XG4gIHZhciB2YXJzID0gcXVlcnkuc3BsaXQoXCImXCIpO1xuXG4gIGZvciAodmFyIGkgPSAwOyBpIDwgdmFycy5sZW5ndGg7IGkrKykge1xuICAgIHZhciBwYWlyID0gdmFyc1tpXS5zcGxpdChcIj1cIik7XG5cbiAgICBpZiAocGFpclswXSA9PSB2YXJpYWJsZSkge1xuICAgICAgcmV0dXJuIHBhaXJbMV07XG4gICAgfVxuICB9XG5cbiAgcmV0dXJuIGZhbHNlO1xufVxuLyoqXG4qIE9wZW4gbW9kYWwgdGVybXNcbiovXG5cblxuZnVuY3Rpb24gb3Blbl9tb2RhbF90ZXJtc19mb3JtKCkge1xuICAkKCcjanMtdGVybXMtY29uZGl0aW9ucy1mb3JtJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xufVxuXG5mdW5jdGlvbiBjbG9zZVRlcm1zTW9kYWwoKSB7XG4gICQoJyNqcy10ZXJtcy1jb25kaXRpb25zLWZvcm0nKS5hZGRDbGFzcygnZC1ub25lJyk7XG59XG5cbmZ1bmN0aW9uIGhpZGVfdGVybXNfbW9kYWwoKSB7XG4gICQoJyN0ZXJtcycpLnByb3AoXCJjaGVja2VkXCIsIHRydWUpO1xuICAkKCcjanMtdGVybXMtY29uZGl0aW9ucy1mb3JtJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xufVxuLyoqXG4qIENsb3NlIFJlcG9zdCBtb2RhbFxuKi9cblxuXG5mdW5jdGlvbiBDbG9zZU1vZGFsUmVnaXN0ZXIoKSB7XG4gICQoJyNqcy1yZWdpc3Rlci1mb3JtJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xufSIsIlwidXNlIHN0cmljdFwiO1xuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gIC8vIEJpZyBNZW51XG4gIHZhciBkaXZzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInNpdGUtY2FyZFwiKS5sZW5ndGg7XG5cbiAgaWYgKGRpdnMgPD0gNCkge1xuICAgICQoJy5uZXh0X2JpZ21lbnUnKS5yZW1vdmUoKTtcbiAgICAkKCcucHJldl9iaWdtZW51JykucmVtb3ZlKCk7XG4gIH1cblxuICAkKFwiLnNsaWNrX2JpZ21lbnVcIikuc2xpY2soe1xuICAgIGF1dG9wbGF5OiB0cnVlLFxuICAgIGF1dG9wbGF5U3BlZWQ6IDEwMDAsXG4gICAgcGF1c2VPbkRvdHNIb3ZlcjogdHJ1ZSxcbiAgICBpbmZpbml0ZTogdHJ1ZSxcbiAgICBzbGlkZXNUb1Nob3c6IDQsXG4gICAgc2xpZGVzVG9TY3JvbGw6IDEsXG4gICAgcHJldkFycm93OiAkKFwiLnByZXZfYmlnbWVudVwiKSxcbiAgICBuZXh0QXJyb3c6ICQoXCIubmV4dF9iaWdtZW51XCIpLFxuICAgIGRvdHM6ICQod2luZG93KS53aWR0aCgpIDwgNzY5ID8gdHJ1ZSA6IGZhbHNlLFxuICAgIHJlc3BvbnNpdmU6IFt7XG4gICAgICBicmVha3BvaW50OiAxOTMwLFxuICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgc2xpZGVzVG9TaG93OiA0LFxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMVxuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGJyZWFrcG9pbnQ6IDEyMDAsXG4gICAgICBzZXR0aW5nczoge1xuICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXG4gICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxXG4gICAgICB9XG4gICAgfSwge1xuICAgICAgYnJlYWtwb2ludDogMTAyNCxcbiAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgIHNsaWRlc1RvU2hvdzogMixcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDFcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBicmVha3BvaW50OiA3NjgsXG4gICAgICBzZXR0aW5nczoge1xuICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXG4gICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxXG4gICAgICB9XG4gICAgfSwge1xuICAgICAgYnJlYWtwb2ludDogNDUwLFxuICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMVxuICAgICAgfVxuICAgIH1dXG4gIH0pOyAvLyBOYXZiYXJcblxuICAkKCduYXYnKS5hZGRDbGFzcygnaG9tZS1kZWZhdWx0Jyk7IC8vTWVudVxuXG4gICQoJy5oYW1idXJnZXItbWVudScpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAkKCcuc2lkZS1uYXYnKS5jc3MoJ2xlZnQnLCAnMCUnKTtcbiAgICAkKCcuY2xvc2UtYnRuJykuY3NzKCdsZWZ0JywgJzIwJScpOyAvL1RhYmxldFxuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDwgMTAyNSkge1xuICAgICAgJCgnLnNpZGUtbmF2JykuY3NzKCd3aWR0aCcsICc1MCUnKTtcbiAgICAgICQoJy5jbG9zZS1idG4nKS5jc3MoJ2xlZnQnLCAnNDUlJyk7XG4gICAgfVxuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDwgNzY3KSB7XG4gICAgICAkKCcuc2lkZS1uYXYnKS5jc3MoJ3dpZHRoJywgJzEwMCUnKTtcbiAgICAgICQoJy5jbG9zZS1idG4nKS5jc3MoJ2xlZnQnLCAnOTAlJyk7XG4gICAgICAkKCcuc3ViLW1lbnUnKS5zbGlkZVVwKDIwMCk7IC8vU0VDT05EQVJZIEhFQURFUlxuXG4gICAgICAkKCcuc2Vjb25kYXJ5LW5hdicpLmNzcygnYmFja2dyb3VuZC1jb2xvcicsICcjNDQzMmE3Jyk7XG4gICAgICAkKCcuc2Vjb25kYXJ5LW5hdiAuY29udGFpbmVyJykuY3NzKCdib3JkZXItYm90dG9tJywgJzAnKTtcbiAgICB9XG4gIH0pO1xuICAkKCcuY2xvc2UtYnRuJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICQoJy5zaWRlLW5hdicpLmNzcygnbGVmdCcsICctMjUlJyk7XG4gICAgJCgnLmNsb3NlLWJ0bicpLmNzcygnbGVmdCcsICctMjAlJyk7IC8vVGFibGV0XG5cbiAgICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPCAxMDI1KSB7XG4gICAgICAkKCcuc2lkZS1uYXYnKS5jc3MoJ2xlZnQnLCAnLTUwJScpO1xuICAgICAgJCgnLmNsb3NlLWJ0bicpLmNzcygnbGVmdCcsICctNDUlJyk7XG4gICAgfSAvL01vYmlsZVxuXG5cbiAgICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPCA3NjcpIHtcbiAgICAgICQoJy5zaWRlLW5hdicpLmNzcygnbGVmdCcsICctMTAwJScpO1xuICAgICAgJCgnLmhhbWJ1cmdlci1tZW51JykuY3NzKCdkaXNwbGF5JywgJ2Jsb2NrJyk7XG4gICAgICAkKCcuc3ViLW1lbnUnKS5zbGlkZURvd24oNDAwKTsgLy9TRUNPTkRBUlkgSEVBREVSXG5cbiAgICAgICQoJy5zZWNvbmRhcnktbmF2JykuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgJyMzMDMyNTEnKTtcbiAgICAgICQoJy5zZWNvbmRhcnktbmF2IC5jb250YWluZXInKS5jc3MoJ2JvcmRlci1ib3R0b20nLCAnMXB4IHNvbGlkICNmZmYnKTtcbiAgICB9XG4gIH0pOyAvL0V4cGxvcmVyIG5hdlxuXG4gICQoJy5leHBsb3JlJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICQoJy5zdWItbWVudScpLmZhZGVPdXQoNTApO1xuICAgICQoJy5leHBsb3JlLW1lbnUnKS5zbGlkZURvd24oJ2Zhc3QnKTtcbiAgICAkKCduYXYnKS5hZGRDbGFzcygnZXhwbG9yZXItbmF2LWFjdGl2ZScpOyAvLyBIQU1CVVJHRVJcblxuICAgICQoJyNoYW1idXJnZXItaWNvbicpLmNzcygnZmlsbCcsICcjQ0IyMTRCJyk7IC8vIExPR09cblxuICAgICQoJyNMb2dvLVJlZCcpLmNzcygnZmlsbCcsICcjREYwNTRFJyk7XG4gICAgJCgnLm5hdi1sb2dvJykuY3NzKCdjb2xvcicsICcjREYwNTRFJyk7XG4gICAgJCgnI0xvZ28tQmx1ZScpLmNzcygnZmlsbCcsICcjMkEyQzM5Jyk7IC8vIFNFQVJDSFxuXG4gICAgJCgnI01hZ25pZnknKS5jc3MoJ3N0cm9rZScsICcjREYwNTRFJyk7XG4gICAgJCgnI0dsYXNzJykuY3NzKCdmaWxsJywgJyNEOEQ4RDgnKTtcblxuICAgIGlmICgkKHdpbmRvdykud2lkdGgoKSA8IDc2Nykge1xuICAgICAgJCgnbmF2JykucmVtb3ZlQ2xhc3MoJ2V4cGxvcmVyLW5hdi1hY3RpdmUnKTtcbiAgICAgICQoJ25hdiAubmF2LWNvbnRhaW5lcicpLmNzcyh7XG4gICAgICAgICdqdXN0aWZ5LWNvbnRlbnQnOiAnY2VudGVyJ1xuICAgICAgfSk7XG4gICAgICAkKCcuaGFtYnVyZ2VyLW1lbnUtY29udGFpbmVyJykuY3NzKCdkaXNwbGF5JywgJ25vbmUnKTsgLy8gU0VBUkNIXG5cbiAgICAgICQoJy5zZWFyY2gtYnV0dG9uJykuY3NzKCdkaXNwbGF5JywgJ25vbmUnKTsgLy8gQ1JPU1NcblxuICAgICAgJCgnLmNyb3NzLWljb24nKS5jc3MoJ2Rpc3BsYXknLCAnYmxvY2snKTsgLy8gSEFNQlVSR0VSXG5cbiAgICAgICQoJyNoYW1idXJnZXItaWNvbicpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7XG4gICAgICAkKCcubmF2LWxvZ28nKS5jc3MoJ2NvbG9yJywgJyNGRkZGRkYnKTsgLy8gTE9HT1xuXG4gICAgICAkKCcjTG9nby1SZWQnKS5jc3MoJ2ZpbGwnLCAnI0ZGRkZGRicpO1xuICAgICAgJCgnI0xvZ28tQmx1ZScpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7IC8vIFNFQVJDSFxuXG4gICAgICAkKCcjTWFnbmlmeScpLmNzcygnc3Ryb2tlJywgJyNGRkZGRkYnKTtcbiAgICAgICQoJyNHbGFzcycpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7XG4gICAgfVxuICB9KTtcblxuICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPCA3NjcpIHtcbiAgICAkKCcjdG9wIC5jdXJyZW50X3BhZ2VfaXRlbScpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAkKCcuc3ViLW1lbnUnKS5mYWRlT3V0KDUwKTtcbiAgICAgICQoJy5leHBsb3JlLW1lbnUnKS5zbGlkZURvd24oJ2Zhc3QnKTtcbiAgICAgICQoJ25hdicpLmFkZENsYXNzKCdleHBsb3Jlci1uYXYtYWN0aXZlJyk7IC8vIEhBTUJVUkdFUlxuXG4gICAgICAkKCcjaGFtYnVyZ2VyLWljb24nKS5jc3MoJ2ZpbGwnLCAnI0NCMjE0QicpO1xuICAgICAgJCgnbmF2IC5uYXYtY29udGFpbmVyJykuY3NzKHtcbiAgICAgICAgJ2p1c3RpZnktY29udGVudCc6ICdjZW50ZXInXG4gICAgICB9KTtcbiAgICAgICQoJy5oYW1idXJnZXItbWVudS1jb250YWluZXInKS5jc3MoJ2Rpc3BsYXknLCAnbm9uZScpO1xuICAgICAgJCgnLnNlYXJjaC1idXR0b24nKS5jc3MoJ2Rpc3BsYXknLCAnbm9uZScpOyAvLyBMT0dPXG5cbiAgICAgICQoJyNMb2dvLVJlZCcpLmNzcygnZmlsbCcsICcjREYwNTRFJyk7XG4gICAgICAkKCcjTG9nby1CbHVlJykuY3NzKCdmaWxsJywgJyMyQTJDMzknKTsgLy8gU0VBUkNIXG5cbiAgICAgICQoJyNNYWduaWZ5JykuY3NzKCdzdHJva2UnLCAnI0RGMDU0RScpO1xuICAgICAgJCgnI0dsYXNzJykuY3NzKCdmaWxsJywgJyNEOEQ4RDgnKTtcbiAgICAgICQoJ25hdicpLnJlbW92ZUNsYXNzKCdleHBsb3Jlci1uYXYtYWN0aXZlJyk7IC8vIEhBTUJVUkdFUlxuXG4gICAgICAkKCcuaGFtYnVyZ2VyLW1lbnUnKS5jc3MoJ3Zpc2liaWxpdHknLCAnaGlkZGVuJyk7IC8vIFNFQVJDSFxuXG4gICAgICAkKCcuc2VhcmNoLWljb24nKS5jc3MoJ2Rpc3BsYXknLCAnbm9uZScpOyAvLyBDUk9TU1xuXG4gICAgICAkKCcuY3Jvc3MtaWNvbicpLmNzcygnZGlzcGxheScsICdibG9jaycpOyAvLyBIQU1CVVJHRVJcblxuICAgICAgJCgnI2hhbWJ1cmdlci1pY29uJykuY3NzKCdmaWxsJywgJyNGRkZGRkYnKTsgLy8gTE9HT1xuXG4gICAgICAkKCcjTG9nby1SZWQnKS5jc3MoJ2ZpbGwnLCAnI0ZGRkZGRicpO1xuICAgICAgJCgnI0xvZ28tQmx1ZScpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7IC8vIFNFQVJDSFxuXG4gICAgICAkKCcjTWFnbmlmeScpLmNzcygnc3Ryb2tlJywgJyNGRkZGRkYnKTtcbiAgICAgICQoJyNHbGFzcycpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7XG4gICAgfSk7XG4gIH1cblxuICAkKCcuY3Jvc3MnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgLy8gSEFNQlVSR0VSXG4gICAgJCgnI2hhbWJ1cmdlci1pY29uJykuY3NzKCdmaWxsJywgJyNGRkZGRkYnKTtcbiAgICAkKCcuaGFtYnVyZ2VyLW1lbnUnKS5jc3MoJ3Zpc2liaWxpdHknLCAnaW5pdGlhbCcpOyAvLyBMT0dPXG5cbiAgICAkKCcjTG9nby1SZWQnKS5jc3MoJ2ZpbGwnLCAnI0ZGRkZGRicpO1xuICAgICQoJyNMb2dvLUJsdWUnKS5jc3MoJ2ZpbGwnLCAnI0ZGRkZGRicpOyAvLyBTRUFSQ0hcblxuICAgICQoJyNNYWduaWZ5JykuY3NzKCdzdHJva2UnLCAnI0ZGRkZGRicpO1xuICAgICQoJyNHbGFzcycpLmNzcygnZmlsbCcsICcjRkZGRkZGJyk7XG4gICAgJCgnLm5hdi1sb2dvJykuY3NzKCdjb2xvcicsICcjRkZGRkZGJyk7XG4gICAgJCgnLmNyb3NzLWljb24nKS5jc3MoJ2Rpc3BsYXknLCAnbm9uZScpO1xuICAgICQoJy5zdWItbWVudScpLmZhZGVJbigzMDApO1xuICAgICQoJy5leHBsb3JlLW1lbnUnKS5zbGlkZVVwKCdmYXN0Jyk7XG4gICAgJCgnbmF2JykucmVtb3ZlQ2xhc3MoJ2V4cGxvcmVyLW5hdi1hY3RpdmUnKTtcbiAgICAkKCduYXYgLm5hdi1jb250YWluZXInKS5jc3Moe1xuICAgICAgJ2p1c3RpZnktY29udGVudCc6ICdzcGFjZS1iZXR3ZWVuJ1xuICAgIH0pO1xuICAgICQoJy5oYW1idXJnZXItbWVudS1jb250YWluZXInKS5jc3MoJ2Rpc3BsYXknLCAnYmxvY2snKTtcbiAgICAkKCcuc2VhcmNoLWJ1dHRvbicpLmNzcygnZGlzcGxheScsICdibG9jaycpO1xuICB9KTtcbiAgJCgnLmNyb3NzLWljb24nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgLy8gSEFNQlVSR0VSXG4gICAgJCgnLmhhbWJ1cmdlci1tZW51JykuY3NzKCd2aXNpYmlsaXR5JywgJ2luaXRpYWwnKTsgLy8gU0VBUkNIXG5cbiAgICAkKCcuc2VhcmNoLWljb24nKS5jc3MoJ2Rpc3BsYXknLCAnYmxvY2snKTsgLy8gQ1JPU1NcblxuICAgICQoJy5jcm9zcy1pY29uJykuY3NzKCdkaXNwbGF5JywgJ25vbmUnKTtcbiAgICAkKCcuc3ViLW1lbnUnKS5mYWRlSW4oMzAwKTtcbiAgICAkKCcuZXhwbG9yZS1tZW51Jykuc2xpZGVVcCgnZmFzdCcpO1xuICAgICQoJ25hdicpLnJlbW92ZUNsYXNzKCdleHBsb3Jlci1uYXYtYWN0aXZlJyk7XG4gICAgJCgnbmF2IC5uYXYtY29udGFpbmVyJykuY3NzKHtcbiAgICAgICdqdXN0aWZ5LWNvbnRlbnQnOiAnc3BhY2UtYmV0d2VlbidcbiAgICB9KTtcbiAgICAkKCcuaGFtYnVyZ2VyLW1lbnUtY29udGFpbmVyJykuY3NzKCdkaXNwbGF5JywgJ2Jsb2NrJyk7XG4gICAgJCgnLnNlYXJjaC1idXR0b24nKS5jc3MoJ2Rpc3BsYXknLCAnYmxvY2snKTtcbiAgfSk7IC8vTmF2YmFyIEZvb3RlclxuXG4gICQoXCIjZm9vdGVyIGxpIGFcIikuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgdmFyIHRpdGxlID0gJCh0aGlzKS5hdHRyKCd0aXRsZScpO1xuICAgICQoXCI8aDI+XCIgKyB0aXRsZSArIFwiPC9oMj5cIikuaW5zZXJ0QmVmb3JlKHRoaXMpO1xuICB9KTsgLy8gUHJvZmlsZSBIZWlnaHRcblxuICB2YXIgYXV0aG9yUHJvZmlsZSA9ICQoJyNqcy1hdXRob3JfX3Byb2ZpbGUnKTtcbiAgdmFyIGF1dGhvckNvbnRlbnQgPSAkKCcjanMtYXV0aG9yX19jb250ZW50Jyk7XG4gIC8qIGxldCBhdXRob3JQcm9maWxlSGVpZ2h0ID0gJChhdXRob3JQcm9maWxlKS5oZWlnaHQoKTtcbiAgJChhdXRob3JDb250ZW50KS5oZWlnaHQoYXV0aG9yUHJvZmlsZUhlaWdodCAtIDU4KTsgLy8gNTggY29tZXMgZnJvbSB0aGUgcGFkZGluZyBiZXR3ZWVuIHRoZSB0b3Agb2YgY29udGVudCBhbmQgdGhlIG5hdlxuICAkKGF1dGhvckNvbnRlbnQpLmNzcyh7XG4gICAgICAnbWF4LWhlaWdodCcgOiAnaW5pdGlhbCcsXG4gIH0pOyAqL1xuICAvLyBGaXhlZCBuYXYgd2hlbiBzcm9sbGluZ1xuXG4gIHZhciBhdXRob3JDb250ZW50TmF2ID0gJCgnI2pzLWF1dGhvcl9fbmF2Jyk7XG4gICQoYXV0aG9yQ29udGVudCkuc2Nyb2xsKGZ1bmN0aW9uICgpIHtcbiAgICBpZiAoJChhdXRob3JDb250ZW50KS5zY3JvbGxUb3AoKSAhPSAwKSB7XG4gICAgICAkKGF1dGhvckNvbnRlbnROYXYpLmFkZENsYXNzKCdmaXhlZCcpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKGF1dGhvckNvbnRlbnROYXYpLnJlbW92ZUNsYXNzKCdmaXhlZCcpO1xuICAgIH1cbiAgfSk7IC8vIEJpbyBNYXggd29yZHNcbiAgLy8kKCcuYXV0aG9yX19wcm9maWxlLWJpbycpLmVhY2goZnVuY3Rpb24oKSB7XG5cbiAgdmFyIGJpb1RleHQgPSAkKCcjanMtYXV0aG9yLXByb2ZpbGUtYmlvJyk7XG5cbiAgaWYgKGJpb1RleHQudGV4dCgpLmxlbmd0aCA+IDIwMCkge1xuICAgIHZhciBzaG9ydFRleHQgPSBiaW9UZXh0LnRleHQoKTtcbiAgICBzaG9ydFRleHQgPSBzaG9ydFRleHQuc3Vic3RyaW5nKDAsIDIwNSk7XG4gICAgYmlvVGV4dC5hZGRDbGFzcygnZnVsbERlc2NyaXB0aW9uJykuaGlkZSgpO1xuICAgIGJpb1RleHQuYXBwZW5kKCc8YSBjbGFzcz1cInJlYWQtbGVzcy1saW5rXCI+UmVhZCBsZXNzPC9hPicpO1xuICAgIGJpb1RleHQucGFyZW50KCkuYXBwZW5kKCc8cCBjbGFzcz1cInByZXZpZXdcIj48c3Bhbj4nICsgc2hvcnRUZXh0ICsgJzwvc3Bhbj48YSBjbGFzcz1cInJlYWQtbW9yZS1saW5rIG1iLTRcIj5SZWFkIG1vcmU8L2E+PC9wPicpO1xuICAgICQoJy5wcmV2aWV3IHNwYW4nKS5hZnRlcignLi4uJyk7XG4gIH0gLy99KVxuXG5cbiAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5yZWFkLW1vcmUtbGluaycsIGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmhpZGUoKS5wYXJlbnRzKCkuZmluZCgnLnByZXZpZXcnKS5oaWRlKCkuc2libGluZ3MoJ3AnKS5zaG93KCk7XG4gICAgJCgnLmZ1bGxEZXNjcmlwdGlvbicpLnNob3coKTtcbiAgfSk7XG4gICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcucmVhZC1sZXNzLWxpbmsnLCBmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5wYXJlbnQoKS5oaWRlKCkubmV4dCgpLnNob3coKTtcbiAgICAkKHRoaXMpLnBhcmVudHMoJy5hdXRob3JfX3Byb2ZpbGUtYmlvJykuZmluZCgnLnJlYWQtbW9yZS1saW5rJykuc2hvdygpO1xuICB9KTsgLy8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAvLyBMYXp5IExvYWQgSW1nc1xuICAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbiAgdmFyIG15TGF6eUxvYWQgPSBuZXcgTGF6eUxvYWQoe1xuICAgIGVsZW1lbnRzX3NlbGVjdG9yOiBcIi5sYXp5XCIsXG4gICAgdGhyZXNob2xkOiAxMDAwXG4gIH0pOyAvL0VuZCBMYXp5IExvYWRcbiAgLy9FeHBlcnRcblxuICAkKCcjYnRuLW5leHQnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGksIHRhYmNvbnRlbnQsIHRhYmxpbmtzO1xuICAgIHZhciBjdXJyZW50ID0gJCgnLnRhYiA+IC5hY3RpdmUnKS5uZXh0KCdidXR0b24nKTtcbiAgICB2YXIgZXhwZXJ0TmFtZSA9IGN1cnJlbnRbMF1bJ2RhdGFzZXQnXVsnaWQnXTtcbiAgICB0YWJjb250ZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmNvbnRlbnRcIik7XG5cbiAgICBmb3IgKGkgPSAwOyBpIDwgdGFiY29udGVudC5sZW5ndGg7IGkrKykge1xuICAgICAgdGFiY29udGVudFtpXS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICB0YWJjb250ZW50W2ldLmNsYXNzTmFtZSA9IHRhYmNvbnRlbnRbaV0uY2xhc3NOYW1lLnJlcGxhY2UoXCIgYWN0aXZlXCIsIFwiXCIpO1xuICAgIH1cblxuICAgIHRhYmxpbmtzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmxpbmtzXCIpO1xuXG4gICAgZm9yIChpID0gMDsgaSA8IHRhYmxpbmtzLmxlbmd0aDsgaSsrKSB7XG4gICAgICB0YWJsaW5rc1tpXS5jbGFzc05hbWUgPSB0YWJsaW5rc1tpXS5jbGFzc05hbWUucmVwbGFjZShcIiBhY3RpdmVcIiwgXCJcIik7XG4gICAgfVxuXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoZXhwZXJ0TmFtZSkuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcbiAgICAkKCcuJyArIGN1cnJlbnRbMF1bJ2RhdGFzZXQnXVsnaWQnXSkuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICB9KTsgLy9FeHBlcnRcblxuICAkKCcjYnRuLXByZXYnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGksIHRhYmNvbnRlbnQsIHRhYmxpbmtzO1xuICAgIHZhciBjdXJyZW50ID0gJCgnLnRhYiA+IC5hY3RpdmUnKS5wcmV2KCdidXR0b24nKTtcbiAgICB2YXIgZXhwZXJ0TmFtZSA9IGN1cnJlbnRbMF1bJ2RhdGFzZXQnXVsnaWQnXTtcbiAgICB0YWJjb250ZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmNvbnRlbnRcIik7XG5cbiAgICBmb3IgKGkgPSAwOyBpIDwgdGFiY29udGVudC5sZW5ndGg7IGkrKykge1xuICAgICAgdGFiY29udGVudFtpXS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICB0YWJjb250ZW50W2ldLmNsYXNzTmFtZSA9IHRhYmNvbnRlbnRbaV0uY2xhc3NOYW1lLnJlcGxhY2UoXCIgYWN0aXZlXCIsIFwiXCIpO1xuICAgIH1cblxuICAgIHRhYmxpbmtzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZShcInRhYmxpbmtzXCIpO1xuXG4gICAgZm9yIChpID0gMDsgaSA8IHRhYmxpbmtzLmxlbmd0aDsgaSsrKSB7XG4gICAgICB0YWJsaW5rc1tpXS5jbGFzc05hbWUgPSB0YWJsaW5rc1tpXS5jbGFzc05hbWUucmVwbGFjZShcIiBhY3RpdmVcIiwgXCJcIik7XG4gICAgfVxuXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoZXhwZXJ0TmFtZSkuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcbiAgICAkKCcuJyArIGN1cnJlbnRbMF1bJ2RhdGFzZXQnXVsnaWQnXSkuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICB9KTsgLy9JbnRlcmFjdGl2ZSBtYXBcblxuICAkKCcjY2xvc2UtbWFwJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICQoJy5sb2NhdGlvbi1kZXNjcmlwdGlvbicpLmNzcygnZGlzcGxheScsICdub25lJyk7XG4gIH0pO1xuXG4gIGlmICgkKFwiLmFkdi1yaWdodFwiKS5jc3MoJ2Rpc3BsYXknKSA9PSAnbm9uZScpIHtcbiAgICAkKCcuYmxvZy1wb3N0cy1wYWdlLWNvbnRhaW5lciAuYm9keScpLmNzcygnanVzdGlmeS1jb250ZW50JywgJ2NlbnRlcicpO1xuICB9IC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgLy8gTmV3c2xldHRlciBWYWxpZGF0aW9uXG4gIC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cblxuXG4gICQoJy5tY2VfRU1BSUwnKS5iaW5kKCdrZXlwcmVzcycsIGZ1bmN0aW9uIChldmVudCkge1xuICAgIHZhciByZWdleCA9IG5ldyBSZWdFeHAoXCJeW2EtekEtWjAtOS4tX0BdKyRcIik7XG4gICAgdmFyIGtleSA9IFN0cmluZy5mcm9tQ2hhckNvZGUoIWV2ZW50LmNoYXJDb2RlID8gZXZlbnQud2hpY2ggOiBldmVudC5jaGFyQ29kZSk7XG5cbiAgICBpZiAoIXJlZ2V4LnRlc3Qoa2V5KSkge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG4gIH0pOyAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAvLyBIZXJvIGFuaW1hdGlvbiBjdGEgKEhvbWUpXG4gIC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbiAgJCgnLmtlZXAtcmVhZGluZycpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAkKFwiaHRtbCwgYm9keVwiKS5hbmltYXRlKHtcbiAgICAgIHNjcm9sbFRvcDogJCgnLm1vZHVsZS1vdXItZXhwZXJ0cycpLm9mZnNldCgpLnRvcCAtIDgwXG4gICAgfSwgNTAwKTtcbiAgfSk7IC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gIC8vIEhlcm8gYW5pbWF0aW9uIGN0YSAoTGFuZGluZylcbiAgLy8tLS0tLS0tLS0tLS0tLS0tLS0tLS1cblxuICAkKCcubS1sYW5kaW5nLWhlcm9fX2tlZXAtcmVhZGluZycpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAkKFwiaHRtbCwgYm9keVwiKS5hbmltYXRlKHtcbiAgICAgIHNjcm9sbFRvcDogJCgnLm0tbGFuZGluZy1wbGF0YWZvcm0nKS5vZmZzZXQoKS50b3AgLSA4MFxuICAgIH0sIDUwMCk7XG4gIH0pO1xufSk7IC8vQmlnIE1lbnVcblxuJCh3aW5kb3cpLm9uKFwicmVzaXplXCIsIGZ1bmN0aW9uICgpIHtcbiAgJChcIi5zbGlja19iaWdtZW51XCIpLm5vdChcIi5zbGljay1pbml0aWFsaXplZFwiKS5zbGljayhcInJlc2l6ZVwiKTtcbn0pO1xuXG5mdW5jdGlvbiBWYWxpZGF0ZU5ld3NsZXR0ZXJFbWFpbChpbnB1dFRleHQpIHtcbiAgdmFyIG1haWxmb3JtYXQgPSAvXlxcdysoW1xcLi1dP1xcdyspKkBcXHcrKFtcXC4tXT9cXHcrKSooXFwuXFx3ezIsM30pKyQvO1xuXG4gIGlmIChpbnB1dFRleHQudmFsdWUubWF0Y2gobWFpbGZvcm1hdCkpIHtcbiAgICByZXR1cm4gdHJ1ZTtcbiAgfSBlbHNlIHtcbiAgICBhbGVydChcIllvdSBoYXZlIGVudGVyZWQgYW4gaW52YWxpZCBlbWFpbCBhZGRyZXNzIVwiKTtcbiAgICAkKCcubWNlX0VNQUlMJykudmFsKCcnKTtcbiAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgIHJldHVybiBmYWxzZTtcbiAgfVxufSAvL0hpZGUgc2lkZWJhciB3aGVuIG5vdCBmb2N1c2VkXG5cblxuJChkb2N1bWVudCkub24oXCJjbGlja1wiLCBmdW5jdGlvbiAoZSkge1xuICB2YXIgc2lkZWJhciA9ICQoXCIuc2lkZS1uYXZcIik7XG4gIHZhciBoYW1idXJnZXIgPSAkKFwiLmhhbWJ1cmdlci1tZW51XCIpO1xuXG4gIGlmICghc2lkZWJhci5pcyhlLnRhcmdldCkgJiYgc2lkZWJhci5oYXMoZS50YXJnZXQpLmxlbmd0aCA9PT0gMCAmJiAhaGFtYnVyZ2VyLmlzKGUudGFyZ2V0KSAmJiBoYW1idXJnZXIuaGFzKGUudGFyZ2V0KS5sZW5ndGggPT09IDApIHtcbiAgICAkKCcuc2lkZS1uYXYnKS5jc3MoJ2xlZnQnLCAnLTI1JScpO1xuICAgICQoJy5jbG9zZS1idG4nKS5jc3MoJ2xlZnQnLCAnLTIwJScpOyAvL01vYmlsZVxuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDwgMTAyNSkge1xuICAgICAgJCgnLnNpZGUtbmF2JykuY3NzKCdsZWZ0JywgJy01MCUnKTtcbiAgICAgICQoJy5jbG9zZS1idG4nKS5jc3MoJ2xlZnQnLCAnLTQ1JScpO1xuICAgIH0gLy9Nb2JpbGVcblxuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDwgNzY3KSB7XG4gICAgICAkKCcuc2lkZS1uYXYnKS5jc3MoJ2xlZnQnLCAnLTEwMCUnKTtcbiAgICAgICQoJy5oYW1idXJnZXItbWVudScpLmNzcygnZGlzcGxheScsICdibG9jaycpO1xuICAgIH1cbiAgfVxufSk7IC8vVGFiIEZhcXNcblxuJCgnLmZhcXMtbmF2YmFyIHVsIGxpJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICB2YXIgdGFiID0gJCh0aGlzKS5hdHRyKCdpZCcpO1xuICAkKFwiLmZhcXMtbmF2YmFyIHVsIGxpXCIpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICB9KTtcbiAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICQoJy50YWItZ3JvdXAnKS5jaGlsZHJlbignZGl2JykuZmFkZU91dCgnZmFzdCcpO1xuICAkKCcudGFiLWdyb3VwJykuY2hpbGRyZW4oJyMnICsgdGFiKS5mYWRlSW4oJ2Zhc3QnKTtcblxuICBpZiAodGFiID09ICdhbGwnKSB7XG4gICAgJCgnLnRhYi1ncm91cCcpLmNoaWxkcmVuKCdkaXYnKS5mYWRlSW4oJ2Zhc3QnKTtcbiAgfVxufSk7XG4vKipcbiAqIENsb3NlIE1vZGFsXG4gKi9cblxuZnVuY3Rpb24gY2xvc2VNb2RhbCgpIHtcbiAgJCgnI2pzLWluc2VydC1hcnRpY2xlLW1vZGFsJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtaW5zZXJ0LWFydGljbGVzLWltZy1tb2RhbCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLWRyYWZ0LWFydGljbGUtbW9kYWwnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLnJlbW92ZUNsYXNzKCdkb25lJyk7XG4gICQoJyNqcy1tb2RhbC1iaW8nKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1tb2RhbC12aWRlbycpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLW1vZGFsLWxvY2F0aW9uJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtbW9kYWwtZWR1Y2F0aW9uJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtbW9kYWwtcHVibGljYXRpb24nKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1tb2RhbC12aWRlby1leGFtcGxlJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtbW9kYWwtYm9hcmQtY2VydGlmaWNhdGlvbicpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLW1vZGFsLWV4cGVydGlzZScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLW1vZGFsLWRlbGV0ZS1wb3N0JykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtYmlvLW1vZGFsJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtYmlvLW1vZGFsLXNraXAnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1iaW8tbW9kYWwtY29tcGxldGUnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1tb2RhbC1kZWxldGUtcG9zdCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXJlcG9zdC1zdWNjZXNzZnVsJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtaW5zZXJ0LXJlcG9zdCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXRlcm1zLWNvbmRpdGlvbnMnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy10ZXJtcy1jb25kaXRpb25zLWZvcm0nKS5hZGRDbGFzcygnZC1ub25lJyk7XG59XG4vKipcbiogQ2xvc2UgUmVwb3N0IG1vZGFsXG4qL1xuXG5cbmZ1bmN0aW9uIENsb3NlTW9kYWxSZWdpc3RlcigpIHtcbiAgJCgnI2pzLXJlZ2lzdGVyLWZvcm0nKS5hZGRDbGFzcygnZC1ub25lJyk7XG59IC8vVGFiIEV4cGVydHNcblxuXG5mdW5jdGlvbiBvcGVuRXhwZXJ0KGV2dCwgZXhwZXJ0TmFtZSkge1xuICAvLyBEZWNsYXJlIGFsbCB2YXJpYWJsZXNcbiAgdmFyIGksIHRhYmNvbnRlbnQsIHRhYmxpbmtzOyAvLyBHZXQgYWxsIGVsZW1lbnRzIHdpdGggY2xhc3M9XCJ0YWJjb250ZW50XCIgYW5kIGhpZGUgdGhlbVxuXG4gIHRhYmNvbnRlbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKFwidGFiY29udGVudFwiKTtcblxuICBmb3IgKGkgPSAwOyBpIDwgdGFiY29udGVudC5sZW5ndGg7IGkrKykge1xuICAgIHRhYmNvbnRlbnRbaV0uc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xuICAgIHRhYmNvbnRlbnRbaV0uY2xhc3NOYW1lID0gdGFiY29udGVudFtpXS5jbGFzc05hbWUucmVwbGFjZShcIiBhY3RpdmVcIiwgXCJcIik7XG4gIH0gLy8gR2V0IGFsbCBlbGVtZW50cyB3aXRoIGNsYXNzPVwidGFibGlua3NcIiBhbmQgcmVtb3ZlIHRoZSBjbGFzcyBcImFjdGl2ZVwiXG5cblxuICB0YWJsaW5rcyA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJ0YWJsaW5rc1wiKTtcblxuICBmb3IgKGkgPSAwOyBpIDwgdGFibGlua3MubGVuZ3RoOyBpKyspIHtcbiAgICB0YWJsaW5rc1tpXS5jbGFzc05hbWUgPSB0YWJsaW5rc1tpXS5jbGFzc05hbWUucmVwbGFjZShcIiBhY3RpdmVcIiwgXCJcIik7XG4gIH0gLy8gU2hvdyB0aGUgY3VycmVudCB0YWIsIGFuZCBhZGQgYW4gXCJhY3RpdmVcIiBjbGFzcyB0byB0aGUgYnV0dG9uIHRoYXQgb3BlbmVkIHRoZSB0YWJcblxuXG4gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGV4cGVydE5hbWUpLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XG4gIGV2dC5jdXJyZW50VGFyZ2V0LmNsYXNzTmFtZSArPSBcIiBhY3RpdmVcIjtcbn0gLy9pdGVtcyBTZWFyY2hcblxuXG4kKCcuc2VhcmNoLW5hdmJhciB1bCBsaScpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgdmFyIGl0ZW0gPSAkKHRoaXMpLmF0dHIoJ2lkJyk7XG5cbiAgaWYgKCQodGhpcykuaGFzQ2xhc3MoJ2FjdGl2ZScpKSB7XG4gICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7IC8vcmVtb3ZlUGFyYW1ldGVyVG9VUkwoaXRlbSk7XG4gIH0gZWxzZSB7XG4gICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSBkb2N1bWVudC5sb2NhdGlvbi5wYXRobmFtZSArIGFkZFVybFBhcmFtKGRvY3VtZW50LmxvY2F0aW9uLnNlYXJjaCwgJ3RhZycsIGl0ZW0pOyAvL2FkZFBhcmFtZXRlclRvVVJMKGl0ZW0pO1xuICB9XG59KTtcbiQoJy5maWx0ZXInKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICQoJy5zZWFyY2gtbmF2YmFyJykuc2xpZGVUb2dnbGUoJ2Zhc3QnKTtcbiAgJCgnLmZpbHRlciBhIGgyJykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xufSk7XG4vKipcbiogaXRlbXMgU2VhcmNoXG4qIEFkZCBhIFVSTCBwYXJhbWV0ZXIgKG9yIGNoYW5naW5nIGl0IGlmIGl0IGFscmVhZHkgZXhpc3RzKVxuKiBAcGFyYW0ge3NlYXJjaH0gc3RyaW5nICB0aGlzIGlzIHR5cGljYWxseSBkb2N1bWVudC5sb2NhdGlvbi5zZWFyY2hcbiogQHBhcmFtIHtrZXl9ICAgIHN0cmluZyAgdGhlIGtleSB0byBzZXRcbiogQHBhcmFtIHt2YWx9ICAgIHN0cmluZyAgdmFsdWUgXG4qL1xuXG52YXIgYWRkVXJsUGFyYW0gPSBmdW5jdGlvbiBhZGRVcmxQYXJhbShzZWFyY2gsIGtleSwgdmFsKSB7XG4gIHZhciBuZXdQYXJhbSA9IGtleSArICc9JyArIHZhbCxcbiAgICAgIHBhcmFtcyA9ICc/JyArIG5ld1BhcmFtOyAvLyBJZiB0aGUgXCJzZWFyY2hcIiBzdHJpbmcgZXhpc3RzLCB0aGVuIGJ1aWxkIHBhcmFtcyBmcm9tIGl0XG5cbiAgaWYgKHNlYXJjaCkge1xuICAgIC8vIFRyeSB0byByZXBsYWNlIGFuIGV4aXN0YW5jZSBpbnN0YW5jZVxuICAgIHBhcmFtcyA9IHNlYXJjaC5yZXBsYWNlKG5ldyBSZWdFeHAoJyhbPyZdKScgKyBrZXkgKyAnW14mXSonKSwgJyQxJyArIG5ld1BhcmFtKTsgLy8gSWYgbm90aGluZyB3YXMgcmVwbGFjZWQsIHRoZW4gYWRkIHRoZSBuZXcgcGFyYW0gdG8gdGhlIGVuZFxuXG4gICAgaWYgKHBhcmFtcyA9PT0gc2VhcmNoKSB7XG4gICAgICBwYXJhbXMgKz0gJyYnICsgbmV3UGFyYW07XG4gICAgfVxuICB9XG5cbiAgcmV0dXJuIHBhcmFtcztcbn07XG4vKiBcbiogIEZvcm0gMSBSZXNvdXJjZXMgUGFnZSBDb25kaXRpb25cbipcbiovXG5cblxuZnVuY3Rpb24gZm9ybU9uZVN1Ym1pdCgpIHtcbiAgaWYgKCEkKCcjZnVsbG5hbWVfMScpLnZhbCgpIHx8ICQoJyNmdWxsbmFtZV8xJykudmFsKCkgPT0gbnVsbCkge1xuICAgICQoJyNtZXNzYWdlXzEnKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+Q29tcGxldGUgdGhlIGZpZWxkIE5hbWU8L3A+Jyk7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgaWYgKCEkKCcjZW1haWxfMScpLnZhbCgpIHx8ICQoJyNlbWFpbF8xJykudmFsKCkgPT0gbnVsbCkge1xuICAgICQoJyNtZXNzYWdlXzEnKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+Q29tcGxldGUgdGhlIGZpZWxkIEVtYWlsPC9wPicpO1xuICAgIHJldHVybjtcbiAgfVxuXG4gIGlmICghJCgnI3Jlc291cmNlXzEnKS52YWwoKSB8fCAkKCcjcmVzb3VyY2VfMScpLnZhbCgpID09IG51bGwpIHtcbiAgICAkKCcjbWVzc2FnZV8xJykuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPkNvbXBsZXRlIHRoZSBmaWVsZCBSZXNvdXJjZXM8L3A+Jyk7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgaWYgKCQoJyNjb250cm9sXzEnKS52YWwoKSAhPSAnJykge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIHZhciBmb3JtVmFsdWUgPSB7XG4gICAgZnVsbG5hbWU6ICQoJyNmdWxsbmFtZV8xJykudmFsKCksXG4gICAgZW1haWw6ICQoJyNlbWFpbF8xJykudmFsKCksXG4gICAgcmVzb3VyY2VzOiAkKCcjcmVzb3VyY2VfMScpLnZhbCgpLFxuICAgIHR5cGU6ICQoJyN0eXBlXzEnKS52YWwoKVxuICB9O1xuICAkLmFqYXgoe1xuICAgIG1ldGhvZDogXCJQT1NUXCIsXG4gICAgdXJsOiBsb2NhdGlvbi5vcmlnaW4gKyAnL3dwLWNvbnRlbnQvdGhlbWVzL2RvY3RvcnBlZGlhL2luYy9mdW5jdGlvbnMvc2F2ZS1mb3JtLXJlc291cmNlcy5waHAnLFxuICAgIGRhdGE6IGZvcm1WYWx1ZSxcbiAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiBiZWZvcmVTZW5kKCkge1xuICAgICAgJChcIiNtZXNzYWdlXzFcIikuZmFkZUluKCdmYXN0Jyk7XG4gICAgICAkKFwiI21lc3NhZ2VfMVwiKS5odG1sKCc8cCBjbGFzcz1cInRleHQtaW5mb1wiPlNlbmRpbmcuLi4uPC9wPicpO1xuICAgIH0sXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJChcIiNtZXNzYWdlXzFcIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LXN1Y2Nlc3NcIj4nICsgcmVzcG9uc2UgKyAnPC9wPicpO1xuICAgIH1cbiAgfSk7XG59XG4vKiBcbiogIEZvcm0gMiBSZXNvdXJjZXMgUGFnZSBDb25kaXRpb25cbipcbiovXG5cblxuZnVuY3Rpb24gZm9ybVR3b1N1Ym1pdCgpIHtcbiAgaWYgKCEkKCcjZnVsbG5hbWVfMicpLnZhbCgpIHx8ICQoJyNmdWxsbmFtZV8yJykudmFsKCkgPT0gbnVsbCkge1xuICAgICQoJyNtZXNzYWdlXzInKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+Q29tcGxldGUgdGhlIGZpZWxkIE5hbWU8L3A+Jyk7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgaWYgKCEkKCcjZW1haWxfMicpLnZhbCgpIHx8ICQoJyNlbWFpbF8yJykudmFsKCkgPT0gbnVsbCkge1xuICAgICQoJyNtZXNzYWdlXzInKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+Q29tcGxldGUgdGhlIGZpZWxkIEVtYWlsPC9wPicpO1xuICAgIHJldHVybjtcbiAgfVxuXG4gIGlmICghJCgnI3Jlc291cmNlXzInKS52YWwoKSB8fCAkKCcjcmVzb3VyY2VfMicpLnZhbCgpID09IG51bGwpIHtcbiAgICAkKCcjbWVzc2FnZV8yJykuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPkNvbXBsZXRlIHRoZSBmaWVsZCBSZXNvdXJjZXM8L3A+Jyk7XG4gICAgcmV0dXJuO1xuICB9XG5cbiAgaWYgKCQoJyNjb250cm9sXzInKS52YWwoKSAhPSAnJykge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIHZhciBmb3JtVmFsdWUgPSB7XG4gICAgZnVsbG5hbWU6ICQoJyNmdWxsbmFtZV8yJykudmFsKCksXG4gICAgZW1haWw6ICQoJyNlbWFpbF8yJykudmFsKCksXG4gICAgcmVzb3VyY2VzOiAkKCcjcmVzb3VyY2VfMicpLnZhbCgpLFxuICAgIHR5cGU6ICQoJyN0eXBlXzInKS52YWwoKVxuICB9O1xuICAkLmFqYXgoe1xuICAgIG1ldGhvZDogXCJQT1NUXCIsXG4gICAgdXJsOiBsb2NhdGlvbi5vcmlnaW4gKyAnL3dwLWNvbnRlbnQvdGhlbWVzL2RvY3RvcnBlZGlhL2luYy9mdW5jdGlvbnMvc2F2ZS1mb3JtLXJlc291cmNlcy5waHAnLFxuICAgIGRhdGE6IGZvcm1WYWx1ZSxcbiAgICBiZWZvcmVTZW5kOiBmdW5jdGlvbiBiZWZvcmVTZW5kKCkge1xuICAgICAgJChcIiNtZXNzYWdlXzJcIikuZmFkZUluKCdmYXN0Jyk7XG4gICAgICAkKFwiI21lc3NhZ2VfMlwiKS5odG1sKCc8cCBjbGFzcz1cInRleHQtaW5mb1wiPlNlbmRpbmcuLi4uPC9wPicpO1xuICAgIH0sXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJChcIiNtZXNzYWdlXzJcIikuaHRtbCgnPHAgY2xhc3M9XCJ0ZXh0LXN1Y2Nlc3NcIj4nICsgcmVzcG9uc2UgKyAnPC9wPicpO1xuICAgIH1cbiAgfSk7XG59XG4vKipcbiAqIFJlYWQgTW9yZSBIZWFkZXIgVGV4dFxuICogXG4gKi9cblxuXG4kKCcjanMtUmVhZE1vcmVIZWFkZXJUZXh0JykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAkKCcjanMtSGVhZGVyVGV4dCcpLmNzcyh7XG4gICAgJ2hlaWdodCc6ICdhdXRvJyxcbiAgICAndHJhbnNpdGlvbic6ICdhbGwgMzAwbXMnXG4gIH0pO1xuICAkKCcjanMtUmVhZE1vcmVIZWFkZXJUZXh0JykuY3NzKHtcbiAgICAnZGlzcGxheSc6ICdub25lJ1xuICB9KTtcbn0pO1xuLyoqXG4gKiBSZWFkIExlc3MgSGVhZGVyIFRleHRcbiAqL1xuXG4kKCcjanMtUmVhZExlc3NIZWFkZXJUZXh0JykuY2xpY2soZnVuY3Rpb24gKCkge1xuICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPD0gNzY3KSB7XG4gICAgJCgnI2pzLUhlYWRlclRleHQnKS5jc3Moe1xuICAgICAgJ2hlaWdodCc6ICcxNTBweCcsXG4gICAgICAndHJhbnNpdGlvbic6ICdhbGwgMzAwbXMnXG4gICAgfSk7XG4gICAgJCgnI2pzLVJlYWRNb3JlSGVhZGVyVGV4dCcpLmNzcyh7XG4gICAgICAnZGlzcGxheSc6ICdibG9jaydcbiAgICB9KTtcbiAgfSBlbHNlIHtcbiAgICAkKCcjanMtSGVhZGVyVGV4dCcpLmNzcyh7XG4gICAgICAnaGVpZ2h0JzogJzUwcHgnLFxuICAgICAgJ3RyYW5zaXRpb24nOiAnYWxsIDMwMG1zJ1xuICAgIH0pO1xuICAgICQoJyNqcy1SZWFkTW9yZUhlYWRlclRleHQnKS5jc3Moe1xuICAgICAgJ2Rpc3BsYXknOiAnYmxvY2snXG4gICAgfSk7XG4gIH1cbn0pO1xuLyoqXG4gKiBSZWFkIE1vcmVcbiAqL1xuXG5mdW5jdGlvbiByZWFkTW9yZShpZCkge1xuICAkKCcjanMtc2hvdy0nICsgaWQpLmNzcygnZGlzcGxheScsICdub25lJyk7XG4gICQoJyNqcy1tb3JlLScgKyBpZCkucmVtb3ZlQ2xhc3MoJ2Qtbm9uZSAnKTtcbn1cbi8qKlxuICogUmVhZCBMZXNzXG4gKi9cblxuXG5mdW5jdGlvbiByZWFkTGVzcyhpZCkge1xuICAkKCcjanMtbW9yZS0nICsgaWQpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXNob3ctJyArIGlkKS5jc3MoJ2Rpc3BsYXknLCAnYmxvY2snKTtcbn1cbi8qKlxuICogTW9kYWwgU2hvd1xuICovXG5cblxuZnVuY3Rpb24gc2hvd01vZGFsKCkge1xuICAkKCcjanMtaW5zZXJ0LXJldmlldy1tb2RhbCcpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbn1cbi8qKlxuICogTW9kYWwgSGlkZVxuICovXG5cblxuZnVuY3Rpb24gaGlkZU1vZGFsKCkge1xuICAkKCcjanMtaW5zZXJ0LXJldmlldy1tb2RhbCcpLmFkZENsYXNzKCcgZC1ub25lJyk7XG59XG4vKipcbiAqIFN0YXJzIGluIElucHV0IHR5cGUgUmFuZ2VcbiAqL1xuXG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgdmFyICRzMWlucHV0ID0gJCgnI2FjZi1maWVsZF81ZDY0NTMzZGMwYWIyYy1maWVsZF9hcHAyMmMwN2VhMjBjZjknKTtcbiAgJCgnLmFjZi1maWVsZC1hcHAyMmMwN2VhMjBjZjkgLmFjZi1yYW5nZS13cmFwJykuaGlkZSgpO1xuICAkKCcuYWNmLWZpZWxkLWFwcDIyYzA3ZWEyMGNmOSAuYWNmLWlucHV0Jykuc3RhcnJyKHtcbiAgICBtYXg6IDUsXG4gICAgcmF0aW5nOiAkczFpbnB1dC52YWwoKSxcbiAgICBjaGFuZ2U6IGZ1bmN0aW9uIGNoYW5nZShlLCB2YWx1ZSkge1xuICAgICAgJHMxaW5wdXQudmFsKHZhbHVlKS50cmlnZ2VyKCdpbnB1dCcpO1xuICAgIH1cbiAgfSk7XG4gIHZhciAkczJpbnB1dCA9ICQoJyNhY2YtZmllbGRfNWQ2NDUzM2RjMGFiMmMtZmllbGRfYXBwMXcxYzdlYTIwY2Y5Jyk7XG4gICQoJy5hY2YtZmllbGQtYXBwMXcxYzdlYTIwY2Y5IC5hY2YtcmFuZ2Utd3JhcCcpLmhpZGUoKTtcbiAgJCgnLmFjZi1maWVsZC1hcHAxdzFjN2VhMjBjZjkgLmFjZi1pbnB1dCcpLnN0YXJycih7XG4gICAgbWF4OiA1LFxuICAgIHJhdGluZzogJHMyaW5wdXQudmFsKCksXG4gICAgY2hhbmdlOiBmdW5jdGlvbiBjaGFuZ2UoZSwgdmFsdWUpIHtcbiAgICAgICRzMmlucHV0LnZhbCh2YWx1ZSkudHJpZ2dlcignaW5wdXQnKTtcbiAgICB9XG4gIH0pO1xuICB2YXIgJHMzaW5wdXQgPSAkKCcjYWNmLWZpZWxkXzVkNjQ1MzNkYzBhYjJjLWZpZWxkX2FwcDN3MzA3ZWEyMGNmOScpO1xuICAkKCcuYWNmLWZpZWxkLWFwcDN3MzA3ZWEyMGNmOSAuYWNmLXJhbmdlLXdyYXAnKS5oaWRlKCk7XG4gICQoJy5hY2YtZmllbGQtYXBwM3czMDdlYTIwY2Y5IC5hY2YtaW5wdXQnKS5zdGFycnIoe1xuICAgIG1heDogNSxcbiAgICByYXRpbmc6ICRzM2lucHV0LnZhbCgpLFxuICAgIGNoYW5nZTogZnVuY3Rpb24gY2hhbmdlKGUsIHZhbHVlKSB7XG4gICAgICAkczNpbnB1dC52YWwodmFsdWUpLnRyaWdnZXIoJ2lucHV0Jyk7XG4gICAgfVxuICB9KTtcbiAgdmFyICRzNGlucHV0ID0gJCgnI2FjZi1maWVsZF81ZDY0NTMzZGMwYWIyYy1maWVsZF9hcHAzdzMwNzIzNDIwY2Y5Jyk7XG4gICQoJy5hY2YtZmllbGQtYXBwM3czMDcyMzQyMGNmOSAuYWNmLXJhbmdlLXdyYXAnKS5oaWRlKCk7XG4gICQoJy5hY2YtZmllbGQtYXBwM3czMDcyMzQyMGNmOSAuYWNmLWlucHV0Jykuc3RhcnJyKHtcbiAgICBtYXg6IDUsXG4gICAgcmF0aW5nOiAkczRpbnB1dC52YWwoKSxcbiAgICBjaGFuZ2U6IGZ1bmN0aW9uIGNoYW5nZShlLCB2YWx1ZSkge1xuICAgICAgJHM0aW5wdXQudmFsKHZhbHVlKS50cmlnZ2VyKCdpbnB1dCcpO1xuICAgIH1cbiAgfSk7XG4gIHZhciAkczVpbnB1dCA9ICQoJyNhY2YtZmllbGRfNWQ2NDUzM2RjMGFiMmMtZmllbGRfYXBwM3JlZDdlYTIwY2Y5Jyk7XG4gICQoJy5hY2YtZmllbGQtYXBwM3JlZDdlYTIwY2Y5IC5hY2YtcmFuZ2Utd3JhcCcpLmhpZGUoKTtcbiAgJCgnLmFjZi1maWVsZC1hcHAzcmVkN2VhMjBjZjkgLmFjZi1pbnB1dCcpLnN0YXJycih7XG4gICAgbWF4OiA1LFxuICAgIHJhdGluZzogJHM1aW5wdXQudmFsKCksXG4gICAgY2hhbmdlOiBmdW5jdGlvbiBjaGFuZ2UoZSwgdmFsdWUpIHtcbiAgICAgICRzNWlucHV0LnZhbCh2YWx1ZSkudHJpZ2dlcignaW5wdXQnKTtcbiAgICB9XG4gIH0pO1xufSk7XG4vKipcbiAqIEhpZGUgaW5wdXRzIEFDRl9GT1JNXG4gKi9cblxuJCgnLmFjZi1maWVsZC1ncm91cC1yb3A1NDMxMicpLmNzcyh7XG4gICdkaXNwbGF5JzogJ25vbmUnXG59KTtcbiQoJy5hY2YtZmllbGQtZ3JvdXAtcnVwNTIyMzIyJykuY3NzKHtcbiAgJ2Rpc3BsYXknOiAnbm9uZSdcbn0pO1xuLyoqXG4gKiBTdWNjZXNzIFN1Ym1pdFxuICovXG5cbiQoJyNqcy1hcHAtcmV2aWV3ZWQtY2FuY2VsJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAkKCcjanMtYXBwLXJldmlld2VkLXN1Y2Nlc3MnKS5jc3Moe1xuICAgICdkaXNwbGF5JzogJ25vbmUnXG4gIH0pO1xufSk7XG4vKipcbiAqIFN0aWt5IG1lbnVcbiAqL1xuLy8gR2V0IHRoZSBuYXZiYXJcblxudmFyIG5hdmJhciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwianMtYXBwLXJldmlld2VkLWhlYWRlclwiKTtcblxuaWYgKHR5cGVvZiBuYXZiYXIgIT0gJ3VuZGVmaW5lZCcgJiYgbmF2YmFyICE9IG51bGwpIHtcbiAgLy8gQWRkIHRoZSBzdGlja3kgY2xhc3MgdG8gdGhlIG5hdmJhciB3aGVuIHlvdSByZWFjaCBpdHMgc2Nyb2xsIHBvc2l0aW9uLiBSZW1vdmUgXCJzdGlja3lcIiB3aGVuIHlvdSBsZWF2ZSB0aGUgc2Nyb2xsIHBvc2l0aW9uXG4gIHZhciBteUZ1bmN0aW9uID0gZnVuY3Rpb24gbXlGdW5jdGlvbigpIHtcbiAgICBpZiAod2luZG93LnBhZ2VZT2Zmc2V0ID49IHN0aWNreSkge1xuICAgICAgbmF2YmFyLmNsYXNzTGlzdC5hZGQoXCJzdGlja3lcIik7XG4gICAgICBuYXZiYXIuY2xhc3NMaXN0LmFkZChcImNvbnRhaW5lclwiKTtcbiAgICB9IGVsc2Uge1xuICAgICAgbmF2YmFyLmNsYXNzTGlzdC5yZW1vdmUoXCJzdGlja3lcIik7XG4gICAgICBuYXZiYXIuY2xhc3NMaXN0LnJlbW92ZShcImNvbnRhaW5lclwiKTtcbiAgICB9XG4gIH07XG5cbiAgLy8gV2hlbiB0aGUgdXNlciBzY3JvbGxzIHRoZSBwYWdlLCBleGVjdXRlIG15RnVuY3Rpb24gXG4gIHdpbmRvdy5vbnNjcm9sbCA9IGZ1bmN0aW9uICgpIHtcbiAgICBteUZ1bmN0aW9uKCk7XG4gIH07IC8vIGV4aXN0cy5cblxuXG4gIHZhciBzdGlja3kgPSBuYXZiYXIub2Zmc2V0VG9wICsgMTAwO1xufVxuLyohXG4gKiBUaGlzIHNjcmlwdCBhbmltYXRlIGxpbmtzIGFkZCBjbGFzcyAnanVtcGVyJ1xuICogXG4gKiBcbiAqL1xuXG5cbiQoXCIuanVtcGVyXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24gKGUpIHtcbiAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAkKFwiYm9keSwgaHRtbFwiKS5hbmltYXRlKHtcbiAgICBzY3JvbGxUb3A6ICQoJCh0aGlzKS5hdHRyKCdocmVmJykpLm9mZnNldCgpLnRvcCAtIDUwXG4gIH0sIDE1MDApO1xufSk7XG4vKipcbiAqIFBhZ2luYXRlIFVzZXIgUmV2aWV3c1xuICovXG5cbmZ1bmN0aW9uIHNob3dQYWdlKGVsZW0sIG1heCkge1xuICB2YXIgcG9zdFBlclBhZ2UgPSAxMDtcbiAgdmFyIG1pbiA9IG1heCAtIHBvc3RQZXJQYWdlO1xuXG4gIGlmIChlbGVtKSB7XG4gICAgJCgnLnBhZ2UtbnVtYmVycycpLnJlbW92ZUNsYXNzKCdjdXJyZW50Jyk7XG4gICAgJChlbGVtKS5hZGRDbGFzcygnY3VycmVudCcpO1xuICB9XG5cbiAgJCgnLmpzLXJldmlld3MtY29udGFpbmVyJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGVsZW0gPSAkKHRoaXMpLmF0dHIoJ2RhdGEtaWQnKTtcblxuICAgIGlmIChlbGVtID4gbWluICYmIGVsZW0gPD0gbWF4KSB7XG4gICAgICAkKHRoaXMpLmFkZENsYXNzKCdkLWJsb2NrJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKHRoaXMpLmFkZENsYXNzKCdkLW5vbmUnKS5yZW1vdmVDbGFzcygnZC1ibG9jaycpO1xuICAgIH1cbiAgfSk7XG4gIHZhciBlbCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwianMtYXBwLXJldmlld2VkLWhlYWRlclwiKTtcbiAgZWwuc2Nyb2xsSW50b1ZpZXcoKTtcbn1cblxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIGZ1bmN0aW9uICgpIHtcbiAgdmFyIG5hdmkgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImpzLXJldmlld3MtbmF2aWdhdGlvblwiKTtcblxuICBpZiAobmF2aSkge1xuICAgIHZhciBlbGVtZW50cyA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoXCJqcy1yZXZpZXdzLWNvbnRhaW5lclwiKS5sZW5ndGg7XG4gICAgdmFyIHBvc3RQZXJQYWdlID0gMTA7XG4gICAgdmFyIGZpeCA9IGVsZW1lbnRzICUgcG9zdFBlclBhZ2UgIT09IDAgPyAxIDogMDtcbiAgICB2YXIgcGFnZXMgPSBwYXJzZUludChlbGVtZW50cyAvIHBvc3RQZXJQYWdlICsgZml4KTtcblxuICAgIGZvciAodmFyIGluZGV4ID0gMTsgaW5kZXggPD0gcGFnZXM7IGluZGV4KyspIHtcbiAgICAgIHZhciBuZXdEaXYgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KFwiYVwiKTtcbiAgICAgIHZhciBjdXJyZW50ID0gaW5kZXggPT0gMSA/ICdjdXJyZW50JyA6ICcnO1xuICAgICAgdmFyIG5leHQgPSBwYXJzZUludChpbmRleCkgKiBwYXJzZUludChwb3N0UGVyUGFnZSk7XG4gICAgICBuZXdEaXYuc2V0QXR0cmlidXRlKCdjbGFzcycsICdwYWdlLW51bWJlcnMgJyArIGN1cnJlbnQpO1xuICAgICAgbmV3RGl2LnNldEF0dHJpYnV0ZSgnaHJlZicsICdqYXZhc2NyaXB0OjsnKTtcbiAgICAgIG5ld0Rpdi5zZXRBdHRyaWJ1dGUoJ29uY2xpY2snLCAnc2hvd1BhZ2UodGhpcywgJyArIG5leHQgKyAnKScpO1xuICAgICAgbmV3RGl2LmFwcGVuZENoaWxkKGRvY3VtZW50LmNyZWF0ZVRleHROb2RlKGluZGV4KSk7XG4gICAgICBuYXZpLmFwcGVuZENoaWxkKG5ld0Rpdik7XG4gICAgfVxuXG4gICAgc2hvd1BhZ2UobnVsbCwgcG9zdFBlclBhZ2UpO1xuICB9XG59KTsgLy8gTWFnbmlmaWMgUG9wdXBcblxuJCgnLmltYWdlLXBvcHVwLXZlcnRpY2FsLWZpdCcpLm1hZ25pZmljUG9wdXAoe1xuICB0eXBlOiAnaW1hZ2UnLFxuICBjbG9zZU9uQ29udGVudENsaWNrOiB0cnVlLFxuICBtYWluQ2xhc3M6ICdtZnAtaW1nLW1vYmlsZScsXG4gIGltYWdlOiB7XG4gICAgdmVydGljYWxGaXQ6IHRydWVcbiAgfVxufSk7IC8vIE1hZ25pZmljIFBvcHVwIElmcmFtZVxuXG4kKCcuanMtcG9wdXAtaWZyYW1lJykubWFnbmlmaWNQb3B1cCh7XG4gIHR5cGU6ICdpZnJhbWUnLFxuICBpZnJhbWU6IHtcbiAgICBtYXJrdXA6ICc8ZGl2IGNsYXNzPVwibWZwLWlmcmFtZS1zY2FsZXJcIj4nICsgJzxkaXYgY2xhc3M9XCJtZnAtY2xvc2VcIj48L2Rpdj4nICsgJzxpZnJhbWUgY2xhc3M9XCJtZnAtaWZyYW1lXCIgZnJhbWVib3JkZXI9XCIwXCIgYWxsb3c9XCJhdXRvcGxheTsgZnVsbHNjcmVlblwiIGFsbG93ZnVsbHNjcmVlbj48L2lmcmFtZT4nICsgJzwvZGl2PicsXG4gICAgLy8gSFRNTCBtYXJrdXAgb2YgcG9wdXAsIGBtZnAtY2xvc2VgIHdpbGwgYmUgcmVwbGFjZWQgYnkgdGhlIGNsb3NlIGJ1dHRvblxuICAgIHBhdHRlcm5zOiB7XG4gICAgICB5b3V0dWJlOiB7XG4gICAgICAgIGluZGV4OiAneW91dHViZS5jb20vJyxcbiAgICAgICAgLy8gU3RyaW5nIHRoYXQgZGV0ZWN0cyB0eXBlIG9mIHZpZGVvIChpbiB0aGlzIGNhc2UgWW91VHViZSkuIFNpbXBseSB2aWEgdXJsLmluZGV4T2YoaW5kZXgpLlxuICAgICAgICBpZDogJ3Y9JyxcbiAgICAgICAgLy8gU3RyaW5nIHRoYXQgc3BsaXRzIFVSTCBpbiBhIHR3byBwYXJ0cywgc2Vjb25kIHBhcnQgc2hvdWxkIGJlICVpZCVcbiAgICAgICAgLy8gT3IgbnVsbCAtIGZ1bGwgVVJMIHdpbGwgYmUgcmV0dXJuZWRcbiAgICAgICAgLy8gT3IgYSBmdW5jdGlvbiB0aGF0IHNob3VsZCByZXR1cm4gJWlkJSwgZm9yIGV4YW1wbGU6XG4gICAgICAgIC8vIGlkOiBmdW5jdGlvbih1cmwpIHsgcmV0dXJuICdwYXJzZWQgaWQnOyB9XG4gICAgICAgIHNyYzogJ2h0dHBzOi8vd3d3LnlvdXR1YmUuY29tL2VtYmVkLyVpZCU/YXV0b3BsYXk9MScgLy8gVVJMIHRoYXQgd2lsbCBiZSBzZXQgYXMgYSBzb3VyY2UgZm9yIGlmcmFtZS5cblxuICAgICAgfSxcbiAgICAgIHZpbWVvOiB7XG4gICAgICAgIGluZGV4OiAndmltZW8uY29tLycsXG4gICAgICAgIGlkOiAnLycsXG4gICAgICAgIHNyYzogJy8vcGxheWVyLnZpbWVvLmNvbS92aWRlby8laWQlP2F1dG9wbGF5PTEnXG4gICAgICB9IC8vIHlvdSBtYXkgYWRkIGhlcmUgbW9yZSBzb3VyY2VzXG5cbiAgICB9LFxuICAgIHNyY0FjdGlvbjogJ2lmcmFtZV9zcmMnIC8vIFRlbXBsYXRpbmcgb2JqZWN0IGtleS4gRmlyc3QgcGFydCBkZWZpbmVzIENTUyBzZWxlY3Rvciwgc2Vjb25kIGF0dHJpYnV0ZS4gXCJpZnJhbWVfc3JjXCIgbWVhbnM6IGZpbmQgXCJpZnJhbWVcIiBhbmQgc2V0IGF0dHJpYnV0ZSBcInNyY1wiLlxuXG4gIH1cbn0pOyAvLyBNYWduaWZpYyBQb3B1cCBJZnJhbWVcblxuJCgnLmpzLXZpZGVvcy1pZnJhbWUnKS5tYWduaWZpY1BvcHVwKHtcbiAgdHlwZTogJ2lmcmFtZScsXG4gIGlmcmFtZToge1xuICAgIG1hcmt1cDogJzxkaXYgY2xhc3M9XCJtZnAtaWZyYW1lLXNjYWxlclwiPicgKyAnPGRpdiBjbGFzcz1cIm1mcC1jbG9zZVwiPjwvZGl2PicgKyAnPGlmcmFtZSBjbGFzcz1cIm1mcC1pZnJhbWVcIiBmcmFtZWJvcmRlcj1cIjBcIiBhbGxvdz1cImF1dG9wbGF5OyBmdWxsc2NyZWVuXCIgYWxsb3dmdWxsc2NyZWVuPjwvaWZyYW1lPicgKyAnPC9kaXY+JyxcbiAgICAvLyBIVE1MIG1hcmt1cCBvZiBwb3B1cCwgYG1mcC1jbG9zZWAgd2lsbCBiZSByZXBsYWNlZCBieSB0aGUgY2xvc2UgYnV0dG9uXG4gICAgc3JjQWN0aW9uOiAnaWZyYW1lX3NyYycgLy8gVGVtcGxhdGluZyBvYmplY3Qga2V5LiBGaXJzdCBwYXJ0IGRlZmluZXMgQ1NTIHNlbGVjdG9yLCBzZWNvbmQgYXR0cmlidXRlLiBcImlmcmFtZV9zcmNcIiBtZWFuczogZmluZCBcImlmcmFtZVwiIGFuZCBzZXQgYXR0cmlidXRlIFwic3JjXCIuXG5cbiAgfVxufSk7XG4vKipcbiAqIENyb3VkZnVuZGluZyBmb3JtIHN1Ym1pdFxuICovXG5cbmZ1bmN0aW9uIGhpZGVIZWFkZXJDcm93ZGZ1bmRpbmcoKSB7XG4gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdqcy1mb3JtUHJlUmVnaXN0ZXInKS5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnO1xufVxuXG5pZiAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2dmb3JtXzEnKSkge1xuICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZ2Zvcm1fMScpLmFkZEV2ZW50TGlzdGVuZXIoJ3N1Ym1pdCcsIGhpZGVIZWFkZXJDcm93ZGZ1bmRpbmcpO1xufVxuLyoqXG4gKiBDaGFubmVscyBBQ0YgTW9kdWxlXG4gKi9cblxuXG5mdW5jdGlvbiBjaGFuZ2VUYWJQYW5lbChlbGVtLCBuYW1lKSB7XG4gIC8qKlxuICAgKiBoZWFkZXJzIGNvbnRyb2xzXG4gICAqL1xuICAkKCcuY2hhbm5lbHNfX25hdmJhciBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAkKGVsZW0pLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgLyoqXG4gICAqIHRhYnMgY29udHJvbCBcbiAgICovXG5cbiAgJCgnLmpzLXRhYnNQYW5lbHMnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICBjb25zb2xlLmxvZygkKHRoaXMpLmF0dHIoJ2lkJykgKyAnPT09PScgKyBuYW1lKTtcblxuICAgIGlmICgkKHRoaXMpLmF0dHIoJ2lkJykgPT0gbmFtZSkge1xuICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgIH1cbiAgfSk7XG59XG5cbmZ1bmN0aW9uIGNoYW5nZVRhYlBhbmVsTW9iaWxlKGVsZW0sIG5hbWUpIHtcbiAgLyoqXG4gICAqIGhlYWRlcnMgY29udHJvbHNcbiAgICovXG4gICQoJy5jaGFubmVsc19fbmF2YmFyX21vYmlsZSBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAkKCcuY2hhbm5lbHNfX25hdmJhcl9tb2JpbGUgZGl2JykuY3NzKCdib3JkZXItY29sb3InLCAnIzAwMDAwMCcpO1xuICAkKGVsZW0pLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgJChlbGVtKS5wYXJlbnQoKS5jc3MoJ2JvcmRlci1jb2xvcicsICcjZGYwNTRlJyk7XG4gIC8qKlxuICAgKiB0YWJzIGNvbnRyb2wgXG4gICAqL1xuXG4gICQoJy5qcy10YWJzUGFuZWxzJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgY29uc29sZS5sb2coJCh0aGlzKS5hdHRyKCdpZCcpICsgJz09PT0nICsgbmFtZSk7XG5cbiAgICBpZiAoJCh0aGlzKS5hdHRyKCdpZCcpID09IG5hbWUpIHtcbiAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICAgIH0gZWxzZSB7XG4gICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICB9XG4gIH0pO1xufSAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vQnV0dG9ucyBwcmUgcmVnaXRlciBtb2RhbFxuLy8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbi8vT1BFTlxuXG5cbiQoJy5qcy1wcmUtcmVnaXN0ZXItbW9kYWwnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gIHZhciBtb2RhbCA9ICQoJy5tLXByZS1yZWdpc3RlciAnKTtcbiAgbW9kYWwuY3NzKCdkaXNwbGF5JywgJ2ZsZXgnKTtcbiAgbW9kYWwuYW5pbWF0ZSh7XG4gICAgb3BhY2l0eTogMVxuICB9LCAzMDApO1xuICBkaXNhYmxlU2Nyb2xsKCk7XG59KTsgLy9DTE9TRVxuXG4kKCcuanMtcHJlLXJlZ2lzdGVyLWNsb3NlJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICB2YXIgbW9kYWwgPSAkKCcubS1wcmUtcmVnaXN0ZXIgJyk7XG4gIG1vZGFsLmFuaW1hdGUoe1xuICAgIG9wYWNpdHk6IDBcbiAgfSwgMzAwLCBmdW5jdGlvbiAoKSB7XG4gICAgbW9kYWwuY3NzKCdkaXNwbGF5JywgJ25vbmUnKTtcbiAgICBlbmFibGVTY3JvbGwoKTtcbiAgfSk7IC8vUmVzZXQgZm9ybSB3aGVuIGl0cyBjbG9zZVxuXG4gICQoJy5tZWRpdW1bbmFtZT1cImlucHV0XzFcIl0nKVswXS52YWx1ZSA9IFwiXCI7XG4gICQoJy5tZWRpdW1bbmFtZT1cImlucHV0XzNcIl0nKVswXS52YWx1ZSA9IFwiXCI7XG4gICQoJy5tZWRpdW1bbmFtZT1cImlucHV0XzRcIl0nKVswXS52YWx1ZSA9IFwiXCI7XG4gICQoJyNpbnB1dF8yXzVfMScpWzBdLmNoZWNrZWQgPSBmYWxzZTtcbn0pO1xuLyoqKioqKioqKioqKioqKiBFVkVOVCBTQ1JPTEwgT01JVFRFUiAqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqL1xuXG52YXIga2V5cyA9IHtcbiAgMzc6IDEsXG4gIDM4OiAxLFxuICAzOTogMSxcbiAgNDA6IDFcbn07XG5cbmZ1bmN0aW9uIHByZXZlbnREZWZhdWx0KGUpIHtcbiAgZS5wcmV2ZW50RGVmYXVsdCgpO1xufVxuXG5mdW5jdGlvbiBwcmV2ZW50RGVmYXVsdEZvclNjcm9sbEtleXMoZSkge1xuICBpZiAoa2V5c1tlLmtleUNvZGVdKSB7XG4gICAgcHJldmVudERlZmF1bHQoZSk7XG4gICAgcmV0dXJuIGZhbHNlO1xuICB9XG59IC8vIG1vZGVybiBDaHJvbWUgcmVxdWlyZXMgeyBwYXNzaXZlOiBmYWxzZSB9IHdoZW4gYWRkaW5nIGV2ZW50XG5cblxudmFyIHN1cHBvcnRzUGFzc2l2ZSA9IGZhbHNlO1xuXG50cnkge1xuICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcInRlc3RcIiwgbnVsbCwgT2JqZWN0LmRlZmluZVByb3BlcnR5KHt9LCAncGFzc2l2ZScsIHtcbiAgICBnZXQ6IGZ1bmN0aW9uIGdldCgpIHtcbiAgICAgIHN1cHBvcnRzUGFzc2l2ZSA9IHRydWU7XG4gICAgfVxuICB9KSk7XG59IGNhdGNoIChlKSB7fVxuXG52YXIgd2hlZWxPcHQgPSBzdXBwb3J0c1Bhc3NpdmUgPyB7XG4gIHBhc3NpdmU6IGZhbHNlXG59IDogZmFsc2U7XG52YXIgd2hlZWxFdmVudCA9ICdvbndoZWVsJyBpbiBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKSA/ICd3aGVlbCcgOiAnbW91c2V3aGVlbCc7IC8vIGNhbGwgdGhpcyB0byBEaXNhYmxlXG5cbmZ1bmN0aW9uIGRpc2FibGVTY3JvbGwoKSB7XG4gIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdET01Nb3VzZVNjcm9sbCcsIHByZXZlbnREZWZhdWx0LCBmYWxzZSk7IC8vIG9sZGVyIEZGXG5cbiAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIod2hlZWxFdmVudCwgcHJldmVudERlZmF1bHQsIHdoZWVsT3B0KTsgLy8gbW9kZXJuIGRlc2t0b3BcblxuICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigndG91Y2htb3ZlJywgcHJldmVudERlZmF1bHQsIHdoZWVsT3B0KTsgLy8gbW9iaWxlXG5cbiAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2tleWRvd24nLCBwcmV2ZW50RGVmYXVsdEZvclNjcm9sbEtleXMsIGZhbHNlKTtcbn0gLy8gY2FsbCB0aGlzIHRvIEVuYWJsZVxuXG5cbmZ1bmN0aW9uIGVuYWJsZVNjcm9sbCgpIHtcbiAgd2luZG93LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ0RPTU1vdXNlU2Nyb2xsJywgcHJldmVudERlZmF1bHQsIGZhbHNlKTtcbiAgd2luZG93LnJlbW92ZUV2ZW50TGlzdGVuZXIod2hlZWxFdmVudCwgcHJldmVudERlZmF1bHQsIHdoZWVsT3B0KTtcbiAgd2luZG93LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ3RvdWNobW92ZScsIHByZXZlbnREZWZhdWx0LCB3aGVlbE9wdCk7XG4gIHdpbmRvdy5yZW1vdmVFdmVudExpc3RlbmVyKCdrZXlkb3duJywgcHJldmVudERlZmF1bHRGb3JTY3JvbGxLZXlzLCBmYWxzZSk7XG59XG4vKipcbiAqIEZhcXMgdGFic1xuICovXG5cblxuJCgnLmpzLWZhcXNfX2ZhcS13cmFwcGVyJykub24oJ2NsaWNrJywgJy5qcy1mYXFzX19mYXEnLCBmdW5jdGlvbiAoKSB7XG4gICQoJy5qcy1mYXFzX19mYXEnKS5jaGlsZHJlbignLmpzLWZhcXNfX2ZhcS1kZXNjcmlwdGlvbicpLnNsaWRlVXAoKTtcbiAgJCgnLmpzLWZhcXNfX2ZhcScpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICQoJy5qcy1mYXFzX19mYXEnKS5jaGlsZHJlbignLmZhcS1jYXJkX190aXRsZS1jb250YWluZXInKS5jaGlsZHJlbignLmZhcS1jYXJkX19pY29uJykuY3NzKCd0cmFuc2l0aW9uLWR1cmF0aW9uJywgJy41cycpO1xuICAkKCcuanMtZmFxc19fZmFxJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9fdGl0bGUtY29udGFpbmVyJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9faWNvbicpLmNzcygndHJhbnNmb3JtJywgJ3JvdGF0ZSgwZGVnKScpO1xuXG4gIGlmICgkKHRoaXMpLmNoaWxkcmVuKCcuanMtZmFxc19fZmFxLWRlc2NyaXB0aW9uJykuaXMoJzp2aXNpYmxlJykpIHtcbiAgICAkKHRoaXMpLmNoaWxkcmVuKCcuanMtZmFxc19fZmFxLWRlc2NyaXB0aW9uJykuc2xpZGVVcCgpO1xuICAgICQodGhpcykuY2hpbGRyZW4oJy5mYXEtY2FyZF9fdGl0bGUtY29udGFpbmVyJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9faWNvbicpLmNzcygndHJhbnNpdGlvbi1kdXJhdGlvbicsICcuNXMnKTtcbiAgICAkKHRoaXMpLmNoaWxkcmVuKCcuZmFxLWNhcmRfX3RpdGxlLWNvbnRhaW5lcicpLmNoaWxkcmVuKCcuZmFxLWNhcmRfX2ljb24nKS5jc3MoJ3RyYW5zZm9ybScsICdyb3RhdGUoMGRlZyknKTtcbiAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gIH0gZWxzZSB7XG4gICAgJCh0aGlzKS5jaGlsZHJlbignLmZhcS1jYXJkX190aXRsZS1jb250YWluZXInKS5jaGlsZHJlbignLmZhcS1jYXJkX19pY29uJykuY3NzKCd0cmFuc2l0aW9uLWR1cmF0aW9uJywgJy41cycpO1xuICAgICQodGhpcykuY2hpbGRyZW4oJy5mYXEtY2FyZF9fdGl0bGUtY29udGFpbmVyJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9faWNvbicpLmNzcygndHJhbnNmb3JtJywgJ3JvdGF0ZSgxODBkZWcpJyk7XG4gICAgJCh0aGlzKS5jaGlsZHJlbignLmpzLWZhcXNfX2ZhcS1kZXNjcmlwdGlvbicpLnNsaWRlRG93bigpO1xuICAgICQodGhpcykuYWRkQ2xhc3MoJ29wZW4nKTtcbiAgfVxufSk7XG4kKGRvY3VtZW50KS5vbignbW91c2V1cCcsIGZ1bmN0aW9uIChlKSB7XG4gIHZhciBjb250YWluZXIgPSAkKCcuanMtZmFxc19fZmFxJyk7XG5cbiAgaWYgKCFjb250YWluZXIuaXMoZS50YXJnZXQpICYmIGNvbnRhaW5lci5oYXMoZS50YXJnZXQpLmxlbmd0aCA9PT0gMCkge1xuICAgICQoJy5qcy1mYXFzX19mYXEnKS5jaGlsZHJlbignLmpzLWZhcXNfX2ZhcS1kZXNjcmlwdGlvbicpLnNsaWRlVXAoKTtcbiAgICAkKCcuanMtZmFxc19fZmFxJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9fdGl0bGUtY29udGFpbmVyJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9faWNvbicpLmNzcygndHJhbnNpdGlvbi1kdXJhdGlvbicsICcuNXMnKTtcbiAgICAkKCcuanMtZmFxc19fZmFxJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9fdGl0bGUtY29udGFpbmVyJykuY2hpbGRyZW4oJy5mYXEtY2FyZF9faWNvbicpLmNzcygndHJhbnNmb3JtJywgJ3JvdGF0ZSgwZGVnKScpO1xuICAgICQoJy5qcy1mYXFzX19mYXEnKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICB9XG59KTtcbi8qKlxuICogVGFicyBmaW5kIGRvY3RvcnNcbiAqL1xuXG4kKGZ1bmN0aW9uICgpIHtcbiAgdmFyICR0YWJCdXR0b25JdGVtID0gJCgnI3RhYi1idXR0b24gbGknKSxcbiAgICAgICR0YWJTZWxlY3QgPSAkKCcjdGFiLXNlbGVjdCcpLFxuICAgICAgJHRhYkNvbnRlbnRzID0gJCgnLnRhYi1jb250ZW50JyksXG4gICAgICBhY3RpdmVDbGFzcyA9ICdpcy1hY3RpdmUnO1xuICAkdGFiQnV0dG9uSXRlbS5maXJzdCgpLmFkZENsYXNzKGFjdGl2ZUNsYXNzKTtcbiAgJHRhYkNvbnRlbnRzLm5vdCgnOmZpcnN0JykuaGlkZSgpO1xuICAkdGFiQnV0dG9uSXRlbS5maW5kKCdhJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcbiAgICB2YXIgdGFyZ2V0ID0gJCh0aGlzKS5hdHRyKCdocmVmJyk7XG4gICAgJHRhYkJ1dHRvbkl0ZW0ucmVtb3ZlQ2xhc3MoYWN0aXZlQ2xhc3MpO1xuICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoYWN0aXZlQ2xhc3MpO1xuICAgICR0YWJTZWxlY3QudmFsKHRhcmdldCk7XG4gICAgJHRhYkNvbnRlbnRzLmhpZGUoKTtcbiAgICAkKHRhcmdldCkuc2hvdygpO1xuICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgfSk7XG4gICR0YWJTZWxlY3Qub24oJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgdGFyZ2V0ID0gJCh0aGlzKS52YWwoKSxcbiAgICAgICAgdGFyZ2V0U2VsZWN0TnVtID0gJCh0aGlzKS5wcm9wKCdzZWxlY3RlZEluZGV4Jyk7XG4gICAgJHRhYkJ1dHRvbkl0ZW0ucmVtb3ZlQ2xhc3MoYWN0aXZlQ2xhc3MpO1xuICAgICR0YWJCdXR0b25JdGVtLmVxKHRhcmdldFNlbGVjdE51bSkuYWRkQ2xhc3MoYWN0aXZlQ2xhc3MpO1xuICAgICR0YWJDb250ZW50cy5oaWRlKCk7XG4gICAgJCh0YXJnZXQpLnNob3coKTtcbiAgfSk7XG59KTtcbi8qKlxuICogRm9vdGJhciAtIFB1YmxpYyBQcm9maWxlXG4gKi9cblxuZnVuY3Rpb24gZm9vdGJhclRvZ2dsZSgpIHtcbiAgJCgnLmZvb3RiYXInKS50b2dnbGVDbGFzcygnZm9vdGJhci0tYWN0aXZlJyk7XG4gICQoJy5mb290YmFyX19jdGEnKS50b2dnbGVDbGFzcygnZm9vdGJhcl9fY3RhLS1hY3RpdmUnKTtcbiAgJCgnLmZvb3RiYXJfX3NsaWRldXAnKS50b2dnbGVDbGFzcygnZm9vdGJhcl9fc2xpZGV1cC0tYWN0aXZlJyk7XG59IC8vIFBvcHVwIENvbnRhY3RcblxuXG4kKCcuanMtZm9ybS1jb250YWN0JykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAkKCcuYy1tb2RhbCcpLmFkZENsYXNzKCdjLW1vZGFsX19hY3RpdmUnKTtcbiAgJCgnI21hc3RoZWFkJykuY3NzKCd6LWluZGV4JywgJzEnKTtcbn0pO1xuJCgnLmMtbW9kYWxfX2Nsb3NlJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAkKCcuYy1tb2RhbCcpLnJlbW92ZUNsYXNzKCdjLW1vZGFsX19hY3RpdmUnKTtcbiAgJCgnI21hc3RoZWFkJykuY3NzKCd6LWluZGV4JywgJzMnKTtcbn0pO1xuLyoqXG4gKiBQb2RjYXN0c1xuICovXG5cbmZ1bmN0aW9uIHBsYXlQb2RjYXN0U2luZ2xlKCkge1xuICAkKCcubWVqcy1wbGF5IGJ1dHRvbicpLmNsaWNrKCk7XG4gICQoJyNqcy1wbGF5ZXItcG9kY2FzdCcpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgJCgnLmpzLXBsYXktYnV0dG9uJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICBjb25zb2xlLmxvZygnUG9kY2FzdCcpO1xufVxuLyoqXG4gKiBNb2R1bGUgTGFuZGluZyBWaWRlb1xuICovXG5cblxuJCgnLmpzLXZpZGVvcy1pZnJhbWUyJykubWFnbmlmaWNQb3B1cCh7XG4gIHR5cGU6ICdpZnJhbWUnLFxuICBpZnJhbWU6IHtcbiAgICBtYXJrdXA6ICc8ZGl2IGNsYXNzPVwibWZwLWlmcmFtZS1zY2FsZXJcIj4nICsgJzxkaXYgY2xhc3M9XCJtZnAtY2xvc2VcIj48L2Rpdj4nICsgJzxpZnJhbWUgY2xhc3M9XCJtZnAtaWZyYW1lXCIgZnJhbWVib3JkZXI9XCIwXCIgYWxsb3c9XCJhdXRvcGxheTsgZnVsbHNjcmVlblwiIGFsbG93ZnVsbHNjcmVlbj48L2lmcmFtZT4nICsgJzwvZGl2PicsXG4gICAgLy8gSFRNTCBtYXJrdXAgb2YgcG9wdXAsIGBtZnAtY2xvc2VgIHdpbGwgYmUgcmVwbGFjZWQgYnkgdGhlIGNsb3NlIGJ1dHRvblxuICAgIHNyY0FjdGlvbjogJ2lmcmFtZV9zcmMnIC8vIFRlbXBsYXRpbmcgb2JqZWN0IGtleS4gRmlyc3QgcGFydCBkZWZpbmVzIENTUyBzZWxlY3Rvciwgc2Vjb25kIGF0dHJpYnV0ZS4gXCJpZnJhbWVfc3JjXCIgbWVhbnM6IGZpbmQgXCJpZnJhbWVcIiBhbmQgc2V0IGF0dHJpYnV0ZSBcInNyY1wiLlxuXG4gIH1cbn0pO1xuLyoqXG4gKiBNb2R1bGUgQWZmaWxpYXRlIEhlcm9cbiAqL1xuXG4kKCcuanMtdmlkZW9zLWlmcmFtZS0zJykubWFnbmlmaWNQb3B1cCh7XG4gIHR5cGU6ICdpZnJhbWUnLFxuICBpZnJhbWU6IHtcbiAgICBtYXJrdXA6ICc8ZGl2IGNsYXNzPVwibWZwLWlmcmFtZS1zY2FsZXJcIj4nICsgJzxkaXYgY2xhc3M9XCJtZnAtY2xvc2VcIj48L2Rpdj4nICsgJzxpZnJhbWUgY2xhc3M9XCJtZnAtaWZyYW1lXCIgZnJhbWVib3JkZXI9XCIwXCIgYWxsb3c9XCJhdXRvcGxheTsgZnVsbHNjcmVlblwiIGFsbG93ZnVsbHNjcmVlbj48L2lmcmFtZT4nICsgJzwvZGl2PicsXG4gICAgLy8gSFRNTCBtYXJrdXAgb2YgcG9wdXAsIGBtZnAtY2xvc2VgIHdpbGwgYmUgcmVwbGFjZWQgYnkgdGhlIGNsb3NlIGJ1dHRvblxuICAgIHNyY0FjdGlvbjogJ2lmcmFtZV9zcmMnIC8vIFRlbXBsYXRpbmcgb2JqZWN0IGtleS4gRmlyc3QgcGFydCBkZWZpbmVzIENTUyBzZWxlY3Rvciwgc2Vjb25kIGF0dHJpYnV0ZS4gXCJpZnJhbWVfc3JjXCIgbWVhbnM6IGZpbmQgXCJpZnJhbWVcIiBhbmQgc2V0IGF0dHJpYnV0ZSBcInNyY1wiLlxuXG4gIH1cbn0pO1xuLyoqXG4gKiBTbGlkZXIgc2VydmlkZXMgKExhbmRpbmcpXG4gKi9cblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAkKCcubS1sYW5kaW5nLXRlc3RpbW9uaWFsc19fc2xpZGVyJykuc2xpY2soe1xuICAgIGluZmluaXRlOiB0cnVlLFxuICAgIHNsaWRlc1RvU2hvdzogMyxcbiAgICBzbGlkZXNUb1Njcm9sbDogMSxcbiAgICBhcnJvd3M6IGZhbHNlLFxuICAgIHJlc3BvbnNpdmU6IFt7XG4gICAgICBicmVha3BvaW50OiAxMjAwLFxuICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgc2xpZGVzVG9TaG93OiAzLFxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcbiAgICAgICAgY2VudGVyTW9kZTogdHJ1ZSxcbiAgICAgICAgY2VudGVyUGFkZGluZzogJzBweCcsXG4gICAgICAgIGRvdHM6IHRydWVcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBicmVha3BvaW50OiAxMDI0LFxuICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxuICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcbiAgICAgICAgY2VudGVyTW9kZTogdHJ1ZSxcbiAgICAgICAgZG90czogdHJ1ZSxcbiAgICAgICAgY2VudGVyUGFkZGluZzogJzE1MHB4J1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGJyZWFrcG9pbnQ6IDY0NSxcbiAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgIHNsaWRlc1RvU2hvdzogMSxcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXG4gICAgICAgIGNlbnRlck1vZGU6IHRydWUsXG4gICAgICAgIGRvdHM6IHRydWUsXG4gICAgICAgIGNlbnRlclBhZGRpbmc6ICcwcHgnXG4gICAgICB9XG4gICAgfV1cbiAgfSk7XG59KTsiLCJcInVzZSBzdHJpY3RcIjtcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICBpZiAod2luZG93LmlubmVyV2lkdGggPCAxMDI2KSB7XG4gICAgJCgnLmpzLWRvY3RvcnMnKS5zbGljayh7XG4gICAgICBpbmZpbml0ZTogZmFsc2UsXG4gICAgICBzbGlkZXNUb1Nob3c6IDIsXG4gICAgICBzbGlkZXNUb1Njcm9sbDogMixcbiAgICAgIGRvdHM6IHRydWUsXG4gICAgICBhcnJvd3M6IGZhbHNlLFxuICAgICAgYWRhcHRpdmVIZWlnaHQ6IHRydWUsXG4gICAgICByZXNwb25zaXZlOiBbe1xuICAgICAgICBicmVha3BvaW50OiA3NjcsXG4gICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxuICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxXG4gICAgICAgIH1cbiAgICAgIH1dXG4gICAgfSk7XG4gIH1cbn0pOyIsIlwidXNlIHN0cmljdFwiO1xuXG4vLy0tLS0tLS0tLS0tLSAgICAgIFxuLy8gRml4IEluaXQgTW9kYWxcbi8vLS0tLS0tLS0tLS0tLS1cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudScpLmNzcyh7XG4gICAgICAnZGlzcGxheSc6ICdibG9jaydcbiAgICB9KTtcbiAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmNzcyh7XG4gICAgICAnZGlzcGxheSc6ICdibG9jaydcbiAgICB9KTtcbiAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykuY3NzKHtcbiAgICAgICdkaXNwbGF5JzogJ2Jsb2NrJ1xuICAgIH0pO1xuICB9LCAxMDAwKTtcbn0pO1xuXG4oZnVuY3Rpb24gKCQpIHtcbiAgJChmdW5jdGlvbiAoKSB7XG4gICAgLy8tLS0tLS0tLS0tLS0gICAgICBcbiAgICAvLyBNb2RhbCBjbG9zZVxuICAgIC8vLS0tLS0tLS0tLS0tLS1cbiAgICAkKCcuYmlnLW1lbnUtY29uZGl0aW9uc19fY3Jvc3MnKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuY3NzKHtcbiAgICAgICAgJ3RvcCc6ICctNjAwcHgnXG4gICAgICB9KTtcbiAgICAgICQoJy5iaWctbWVudS1jb25kaXRpb25zX19jcm9zcycpLmNzcyh7XG4gICAgICAgICdkaXNwbGF5JzogJ25vbmUnXG4gICAgICB9KTtcbiAgICB9KTtcblxuICAgIGlmICgkKHdpbmRvdykud2lkdGgoKSA+IDc2OCkge1xuICAgICAgLy8gREVTS1RPUFxuICAgICAgJCgnLmhhcy1tZWdhLW1lbnUnKS5vbignbW91c2VvdmVyJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuY3NzKHtcbiAgICAgICAgICAndG9wJzogJzg3cHgnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmNzcyh7XG4gICAgICAgICAgJ3RvcCc6ICctNjAwcHgnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykuY3NzKHtcbiAgICAgICAgICAndG9wJzogJy02MDBweCdcbiAgICAgICAgfSk7IC8vLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgLy8gTW9kYWwgYXJyb3dcbiAgICAgICAgLy8tLS0tLS0tLS0tLS0tLVxuXG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1jb25kaXRpb25zLW1lbnUgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnbGVmdCc6ICQodGhpcykub2Zmc2V0KCkubGVmdCArIDMwICsgJ3B4JyxcbiAgICAgICAgICAnZGlzcGxheSc6ICdibG9jaydcbiAgICAgICAgfSk7XG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1jaGFubmVscy1tZW51IC5iaWctbWVudS1jb25kaXRpb25zX19hcnJvdy11cCcpLmNzcyh7XG4gICAgICAgICAgJ2Rpc3BsYXknOiAnbm9uZSdcbiAgICAgICAgfSk7XG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1zcGVjaWFsdHktYXJlYXMgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTsgLy8tLS0tLS0tLS0tLS0tLVxuICAgICAgICAvLyBNb2RhbCBjbG9zZVxuICAgICAgICAvLy0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICAgJCgnLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Nyb3NzJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdibG9jaydcbiAgICAgICAgfSk7XG4gICAgICB9KTtcbiAgICAgICQoJyNqcy1kcm9wZG93bi1jb25kaXRpb25zLW1lbnUnKS5vbignbW91c2VsZWF2ZScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCh0aGlzKS5jc3Moe1xuICAgICAgICAgICd0b3AnOiAnLTYwMHB4J1xuICAgICAgICB9KTsgLy8tLS0tLS0tLS0tLS0tLVxuICAgICAgICAvLyBNb2RhbCBhcnJvd1xuICAgICAgICAvLy0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudSAuYmlnLW1lbnUtY29uZGl0aW9uc19fYXJyb3ctdXAnKS5jc3Moe1xuICAgICAgICAgICdkaXNwbGF5JzogJ25vbmUnXG4gICAgICAgIH0pOyAvLy0tLS0tLS0tLS0tLS0tXG4gICAgICAgIC8vIE1vZGFsIGNsb3NlXG4gICAgICAgIC8vLS0tLS0tLS0tLS0tLS1cblxuICAgICAgICAkKCcuYmlnLW1lbnUtY29uZGl0aW9uc19fY3Jvc3MnKS5jc3Moe1xuICAgICAgICAgICdkaXNwbGF5JzogJ25vbmUnXG4gICAgICAgIH0pO1xuICAgICAgfSk7XG4gICAgICAkKCcuaGFzLWNoYW5uZWxzLW1lbnUnKS5vbignbW91c2VvdmVyJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmNzcyh7XG4gICAgICAgICAgJ3RvcCc6ICc4N3B4J1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudScpLmNzcyh7XG4gICAgICAgICAgJ3RvcCc6ICctNjAwcHgnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykuY3NzKHtcbiAgICAgICAgICAndG9wJzogJy02MDBweCdcbiAgICAgICAgfSk7IC8vLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgLy8gTW9kYWwgYXJyb3dcbiAgICAgICAgLy8tLS0tLS0tLS0tLS0tLVxuXG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1jb25kaXRpb25zLW1lbnUgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLXNwZWNpYWx0eS1hcmVhcyAuYmlnLW1lbnUtY29uZGl0aW9uc19fYXJyb3ctdXAnKS5jc3Moe1xuICAgICAgICAgICdkaXNwbGF5JzogJ25vbmUnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudSAuYmlnLW1lbnUtY29uZGl0aW9uc19fYXJyb3ctdXAnKS5jc3Moe1xuICAgICAgICAgICdsZWZ0JzogJCh0aGlzKS5vZmZzZXQoKS5sZWZ0ICsgMzAgKyAncHgnLFxuICAgICAgICAgICdkaXNwbGF5JzogJ2Jsb2NrJ1xuICAgICAgICB9KTsgLy8tLS0tLS0tLS0tLS0tLVxuICAgICAgICAvLyBNb2RhbCBjbG9zZVxuICAgICAgICAvLy0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICAgJCgnLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Nyb3NzJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgIH0pO1xuICAgICAgJCgnLmhhcy1zcGVjaWFsdHktYXJlYXMtbWVudScpLm9uKCdtb3VzZW92ZXInLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1zcGVjaWFsdHktYXJlYXMnKS5jc3Moe1xuICAgICAgICAgICd0b3AnOiAnODdweCcsXG4gICAgICAgICAgJ2xlZnQnOiAnLTEyMHB4JyxcbiAgICAgICAgICAncmlnaHQnOiAnMTIwcHgnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuY3NzKHtcbiAgICAgICAgICAndG9wJzogJy02MDBweCdcbiAgICAgICAgfSk7XG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1jaGFubmVscy1tZW51JykuY3NzKHtcbiAgICAgICAgICAndG9wJzogJy02MDBweCdcbiAgICAgICAgfSk7IC8vLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgLy8gTW9kYWwgYXJyb3dcbiAgICAgICAgLy8tLS0tLS0tLS0tLS0tLVxuXG4gICAgICAgICQoJyNqcy1kcm9wZG93bi1jb25kaXRpb25zLW1lbnUgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLXNwZWNpYWx0eS1hcmVhcyAuYmlnLW1lbnUtY29uZGl0aW9uc19fYXJyb3ctdXAnKS5jc3Moe1xuICAgICAgICAgICdsZWZ0JzogJCh0aGlzKS5vZmZzZXQoKS5sZWZ0ICsgMzAgKyAncHgnLFxuICAgICAgICAgICdkaXNwbGF5JzogJ2Jsb2NrJ1xuICAgICAgICB9KTsgLy8tLS0tLS0tLS0tLS0tLVxuICAgICAgICAvLyBNb2RhbCBjbG9zZVxuICAgICAgICAvLy0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICAgJCgnLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Nyb3NzJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgIH0pO1xuICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUnKS5vbignbW91c2VsZWF2ZScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCh0aGlzKS5jc3Moe1xuICAgICAgICAgICd0b3AnOiAnLTYwMHB4J1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUgLmJpZy1tZW51LWNvbmRpdGlvbnNfX2Fycm93LXVwJykuY3NzKHtcbiAgICAgICAgICAnZGlzcGxheSc6ICdub25lJ1xuICAgICAgICB9KTtcbiAgICAgIH0pO1xuICAgICAgJCgnI2pzLWRyb3Bkb3duLXNwZWNpYWx0eS1hcmVhcycpLm9uKCdtb3VzZWxlYXZlJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKHRoaXMpLmNzcyh7XG4gICAgICAgICAgJ3RvcCc6ICctNjAwcHgnXG4gICAgICAgIH0pO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzIC5iaWctbWVudS1jb25kaXRpb25zX19hcnJvdy11cCcpLmNzcyh7XG4gICAgICAgICAgJ2Rpc3BsYXknOiAnbm9uZSdcbiAgICAgICAgfSk7XG4gICAgICB9KTtcbiAgICB9IGVsc2Uge1xuICAgICAgLy8gTU9CSUxFXG4gICAgICAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAgICAgLy8gSGFtYnVyZ2VyIGNsaWNrXG4gICAgICAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICAkKCcjanMtaGFtYnVyZ2VyLWJ1dHRvbicpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnLm1haW4tbmF2aWdhdGlvbicpLnNsaWRlVG9nZ2xlKDMwMCk7XG4gICAgICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgJCgnI2pzLWRyb3Bkb3duLXNwZWNpYWx0eS1hcmVhcycpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgIH0pOyAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAgICAgLy8gRml4IENoaWxkcmVuIGxpbmtzXG4gICAgICAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICQoJy5qcy1zaXRlLWxpbmsnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9ICQodGhpcykuYXR0cignaHJlZicpO1xuICAgICAgfSk7IC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICAvLyBDb25kaXRpb24gZHJvcGRvd25cbiAgICAgIC8vLS0tLS0tLS0tLS0tLS0tLS0tLS1cblxuICAgICAgJCgnbGkuaGFzLW1lZ2EtbWVudSwgbGkuaGFzLW1lZ2EtbWVudSBhJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGV2KSB7XG4gICAgICAgIGV2LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgaWYgKCQodGhpcykucGFyZW50KCkuaGFzQ2xhc3MoJ2FjdGl2ZScpKSB7XG4gICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICQoJyNqcy1kcm9wZG93bi1jb25kaXRpb25zLW1lbnUnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLXNwZWNpYWx0eS1hcmVhcycpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGV2LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICB9KTsgLy8tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICAgIC8vIEZpeCBDaGlsZHJlbiBsaW5rc1xuICAgICAgLy8tLS0tLS0tLS0tLS0tLS0tLS0tLVxuXG4gICAgICAkKCcjdG9wX2NoYW5uZWxzX21lbnUgPiBsaSA+IGEnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9ICQodGhpcykuYXR0cignaHJlZicpO1xuICAgICAgfSk7IC8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICAvLyBDaGFubmVscyBkcm9wZG93blxuICAgICAgLy8tLS0tLS0tLS0tLS0tLS0tLS0tLVxuXG4gICAgICAkKCcuaGFzLWNoYW5uZWxzLW1lbnUsIC5oYXMtY2hhbm5lbHMtbWVudSBhJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGV2KSB7XG4gICAgICAgIGNvbnNvbGUubG9nKCdjbGljaycpO1xuICAgICAgICBldi5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGlmICgkKHRoaXMpLnBhcmVudCgpLmhhc0NsYXNzKCdhY3RpdmUnKSkge1xuICAgICAgICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICQodGhpcykucGFyZW50KCkuY2hpbGRyZW4oJy5jb250YWluZXInKS5yZW1vdmUoKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgICQoJyNqcy1kcm9wZG93bi1zcGVjaWFsdHktYXJlYXMnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICB9XG5cbiAgICAgICAgZXYuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgIH0pOyAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICAgICAgLy8gU3BlY2lhbHR5IEFyZWFzIGRyb3Bkb3duXG4gICAgICAvLy0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbiAgICAgICQoJy5oYXMtc3BlY2lhbHR5LWFyZWFzLW1lbnUsIC5oYXMtc3BlY2lhbHR5LWFyZWFzLW1lbnUgYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChldikge1xuICAgICAgICBjb25zb2xlLmxvZygnY2xpY2sgMicpO1xuICAgICAgICBldi5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIGlmICgkKHRoaXMpLnBhcmVudCgpLmhhc0NsYXNzKCdhY3RpdmUnKSkge1xuICAgICAgICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICQodGhpcykucGFyZW50KCkuY2hpbGRyZW4oJy5jb250YWluZXInKS5yZW1vdmUoKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tY2hhbm5lbHMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tY29uZGl0aW9ucy1tZW51JykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgICQoJyNqcy1kcm9wZG93bi1zcGVjaWFsdHktYXJlYXMnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNoYW5uZWxzLW1lbnUnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgJCgnI2pzLWRyb3Bkb3duLWNvbmRpdGlvbnMtbWVudScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjanMtZHJvcGRvd24tc3BlY2lhbHR5LWFyZWFzJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICB9XG5cbiAgICAgICAgZXYuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgIH0pO1xuICAgIH1cbiAgfSk7XG59KShqUXVlcnkpOyIsIlwidXNlIHN0cmljdFwiO1xuXG5mdW5jdGlvbiBfY3JlYXRlRm9yT2ZJdGVyYXRvckhlbHBlcihvLCBhbGxvd0FycmF5TGlrZSkgeyB2YXIgaXQgPSB0eXBlb2YgU3ltYm9sICE9PSBcInVuZGVmaW5lZFwiICYmIG9bU3ltYm9sLml0ZXJhdG9yXSB8fCBvW1wiQEBpdGVyYXRvclwiXTsgaWYgKCFpdCkgeyBpZiAoQXJyYXkuaXNBcnJheShvKSB8fCAoaXQgPSBfdW5zdXBwb3J0ZWRJdGVyYWJsZVRvQXJyYXkobykpIHx8IGFsbG93QXJyYXlMaWtlICYmIG8gJiYgdHlwZW9mIG8ubGVuZ3RoID09PSBcIm51bWJlclwiKSB7IGlmIChpdCkgbyA9IGl0OyB2YXIgaSA9IDA7IHZhciBGID0gZnVuY3Rpb24gRigpIHt9OyByZXR1cm4geyBzOiBGLCBuOiBmdW5jdGlvbiBuKCkgeyBpZiAoaSA+PSBvLmxlbmd0aCkgcmV0dXJuIHsgZG9uZTogdHJ1ZSB9OyByZXR1cm4geyBkb25lOiBmYWxzZSwgdmFsdWU6IG9baSsrXSB9OyB9LCBlOiBmdW5jdGlvbiBlKF9lKSB7IHRocm93IF9lOyB9LCBmOiBGIH07IH0gdGhyb3cgbmV3IFR5cGVFcnJvcihcIkludmFsaWQgYXR0ZW1wdCB0byBpdGVyYXRlIG5vbi1pdGVyYWJsZSBpbnN0YW5jZS5cXG5JbiBvcmRlciB0byBiZSBpdGVyYWJsZSwgbm9uLWFycmF5IG9iamVjdHMgbXVzdCBoYXZlIGEgW1N5bWJvbC5pdGVyYXRvcl0oKSBtZXRob2QuXCIpOyB9IHZhciBub3JtYWxDb21wbGV0aW9uID0gdHJ1ZSwgZGlkRXJyID0gZmFsc2UsIGVycjsgcmV0dXJuIHsgczogZnVuY3Rpb24gcygpIHsgaXQgPSBpdC5jYWxsKG8pOyB9LCBuOiBmdW5jdGlvbiBuKCkgeyB2YXIgc3RlcCA9IGl0Lm5leHQoKTsgbm9ybWFsQ29tcGxldGlvbiA9IHN0ZXAuZG9uZTsgcmV0dXJuIHN0ZXA7IH0sIGU6IGZ1bmN0aW9uIGUoX2UyKSB7IGRpZEVyciA9IHRydWU7IGVyciA9IF9lMjsgfSwgZjogZnVuY3Rpb24gZigpIHsgdHJ5IHsgaWYgKCFub3JtYWxDb21wbGV0aW9uICYmIGl0W1wicmV0dXJuXCJdICE9IG51bGwpIGl0W1wicmV0dXJuXCJdKCk7IH0gZmluYWxseSB7IGlmIChkaWRFcnIpIHRocm93IGVycjsgfSB9IH07IH1cblxuZnVuY3Rpb24gX3Vuc3VwcG9ydGVkSXRlcmFibGVUb0FycmF5KG8sIG1pbkxlbikgeyBpZiAoIW8pIHJldHVybjsgaWYgKHR5cGVvZiBvID09PSBcInN0cmluZ1wiKSByZXR1cm4gX2FycmF5TGlrZVRvQXJyYXkobywgbWluTGVuKTsgdmFyIG4gPSBPYmplY3QucHJvdG90eXBlLnRvU3RyaW5nLmNhbGwobykuc2xpY2UoOCwgLTEpOyBpZiAobiA9PT0gXCJPYmplY3RcIiAmJiBvLmNvbnN0cnVjdG9yKSBuID0gby5jb25zdHJ1Y3Rvci5uYW1lOyBpZiAobiA9PT0gXCJNYXBcIiB8fCBuID09PSBcIlNldFwiKSByZXR1cm4gQXJyYXkuZnJvbShvKTsgaWYgKG4gPT09IFwiQXJndW1lbnRzXCIgfHwgL14oPzpVaXxJKW50KD86OHwxNnwzMikoPzpDbGFtcGVkKT9BcnJheSQvLnRlc3QobikpIHJldHVybiBfYXJyYXlMaWtlVG9BcnJheShvLCBtaW5MZW4pOyB9XG5cbmZ1bmN0aW9uIF9hcnJheUxpa2VUb0FycmF5KGFyciwgbGVuKSB7IGlmIChsZW4gPT0gbnVsbCB8fCBsZW4gPiBhcnIubGVuZ3RoKSBsZW4gPSBhcnIubGVuZ3RoOyBmb3IgKHZhciBpID0gMCwgYXJyMiA9IG5ldyBBcnJheShsZW4pOyBpIDwgbGVuOyBpKyspIHsgYXJyMltpXSA9IGFycltpXTsgfSByZXR1cm4gYXJyMjsgfVxuXG4vKipcbiAqIEFjdGl2ZSB0YWJzIGluIEF1dGhvcnNcbiAqIEBwYXJhbSB7dGFiX2lkfSB0YWIgXG4gKi9cbmZ1bmN0aW9uIGFjdGl2ZVRhYih0YWIpIHtcbiAgJCgnLmF1dGhvcl9fY29udGVudC1uYXYtaXRlbScpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgIHZhciBpZCA9ICQodGhpcykuYXR0cignZGF0YS1pZCcpO1xuXG4gICAgaWYgKGlkID09IHRhYikge1xuICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgIH1cbiAgfSk7XG4gICQoJy5hdXRob3JfX3RhYnMtY29udGFpbmVyX190YWInKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgaWQgPSAkKHRoaXMpLmF0dHIoJ2lkJyk7XG5cbiAgICBpZiAoaWQgPT0gdGFiKSB7XG4gICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgJCh0aGlzKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgfVxuICB9KTtcbn1cbi8qKlxuICogUGxheSBwb2RjYXN0IGludG8gYm94XG4gKi9cblxuXG5mdW5jdGlvbiBwbGF5UG9kY2FzdChpZCkge1xuICAkKCcjanMtcGxheS1idXR0b24tJyArIGlkKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1wbGF5ZXItcG9kY2FzdC0nICsgaWQpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXBsYXllci1wb2RjYXN0LScgKyBpZCArICcgLm1lanMtcGxheSBidXR0b24nKS5jbGljaygpO1xufVxuLyoqXG4gKiBcbiAqIE9wZW4gTW9kYWwgUmVwb3N0XG4gKi9cblxuXG5mdW5jdGlvbiByZXBvc3RNb2RhbChpZCkge1xuICAkKCcjanMtaW5zZXJ0LXJlcG9zdCcpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2lkX3JlcG9zdCcpLnZhbChpZCk7XG59XG4vKipcbiAqIENsb3NlIFJlcG9zdCBtb2RhbFxuICovXG5cblxuZnVuY3Rpb24gQ2xvc2VNb2RhbFJlc3BvdCgpIHtcbiAgJCgnI2pzLWluc2VydC1yZXBvc3QnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1yZXBvc3Qtc3VjY2Vzc2Z1bCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcbn1cbi8qKlxuICogUmVwb3N0IFxuICovXG5cblxuZnVuY3Rpb24gcmVwb3N0QXJ0aWNsZXMoKSB7XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdyZXBvc3QnKTtcbiAgZm9ybURhdGEuYXBwZW5kKCcgcG9zdF9pZCcsICQoJyNpZF9yZXBvc3QnKS52YWwoKSk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY29udGVudCcsICQoJyNjb250ZW50X3JlcG9zdCcpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCcgdXNlcicsICQoJyN1c2VyX3JlcG9zdCcpLnZhbCgpKTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IGJtc192YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICQoJyNqcy1vcGVuLXZlcmlmaWVkJykuYXR0cignZGlzYWJsZWQnLCAnZGlzYWJsZWQnKTtcbiAgICB9LFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIHN1Y2Nlc3MocmVzcG9uc2UpIHtcbiAgICAgIGlmIChyZXNwb25zZS5kYXRhLnN0YXR1cyA9PSAnc3VjY2VzcycpIHtcbiAgICAgICAgJCgnI2pzLXJlcG9zdC1zdWNjZXNzZnVsJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAkKCcjanMtaW5zZXJ0LXJlcG9zdCcpLmFkZENsYXNzKCdkLW5vbmUnKTsgLy8kKCAnI3Jlc3BvbnNlX3JlcG9zdCcgKS5odG1sKCAnPHAgY2xhc3M9XCJ0ZXh0LWRhbmdlclwiPicgKyByZXNwb25zZS5kYXRhLm1lc3NhZ2UgKyAnPC9wPicgKTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgICQoJyNyZXNwb25zZV9yZXBvc3QnKS5odG1sKCc8cCBjbGFzcz1cInRleHQtZGFuZ2VyXCI+JyArIHJlc3BvbnNlLmRhdGEubWVzc2FnZSArICc8L3A+Jyk7XG4gICAgICB9XG4gICAgfVxuICB9KTtcbiAgcmV0dXJuIGZhbHNlO1xufVxuLyoqXG4gKiBTZWFyY2ggTWV0YSBEYXRhXG4gKi9cblxuXG5mdW5jdGlvbiBnZXRfc2l0ZV9vZygpIHtcbiAgdmFyIG9ial9jb250ZW50ID0gJCgnI3B1Ymxpc2hfY29udGVudCcpLnZhbCgpO1xuICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gIGlmIChldmVudC53aGljaCA9PSAxMyAmJiBvYmpfY29udGVudCAhPT0gJycpIHtcbiAgICB2YXIgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdnZXRfU2l0ZV9PRycpO1xuICAgIGZvcm1EYXRhLmFwcGVuZCgncHVibGlzaF9jb250ZW50Jywgb2JqX2NvbnRlbnQpO1xuICAgIGpRdWVyeS5hamF4KHtcbiAgICAgIGNhY2hlOiBmYWxzZSxcbiAgICAgIHVybDogYm1zX3ZhcnMuYWpheHVybCxcbiAgICAgIHR5cGU6ICdQT1NUJyxcbiAgICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgICBpZiAocmVzcG9uc2Uuc3RhdHVzID09ICdzdWNjZXNzJykge1xuICAgICAgICAgICQoJyNwdWJsaXNoLWNvbnRlbnQnKS5odG1sKCc8ZGl2IGNsYXNzPVwiZXh0ZXJuYWwtY29udGVudC1kZWxldGVcIiBvbmNsaWNrPVwiZGVsZXRlX2V4dGVybmFsX2NvbnRlbnRfcHJldmlldygpXCI+PGltZyBzcmM9XCIvd3AtY29udGVudC90aGVtZXMvZG9jdG9ycGVkaWEvaW1nL2ljb25zL3NoYXJlLXJlcG9zdC1jbG9zZS5zdmdcIj48L2Rpdj4nICsgcmVzcG9uc2UuaHRtbCk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9KTtcbiAgfVxuXG4gIHJldHVybiBmYWxzZTtcbn1cbi8qKlxuICogRGVza3RvcFxuICovXG5cblxuZnVuY3Rpb24gc3VibWl0X3Byb2ZpbGVfc2hhcmUoKSB7XG4gIHZhciBvYmpfY29udGVudCA9ICQoJyNwdWJsaXNoX2NvbnRlbnQnKS52YWwoKTtcbiAgaWYgKG9ial9jb250ZW50LnRyaW0oKSA9PSAnJykgcmV0dXJuIGZhbHNlO1xuICB2YXIgcHJldmlldyA9ICQoJyNwdWJsaXNoLWNvbnRlbnQnKS5odG1sKCk7XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdwdWJsaXNoX2V4dGVybmFsX2Jsb2cnKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdwcmV2aWV3JywgcHJldmlldyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY29udGVudCcsIG9ial9jb250ZW50KTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IGJtc192YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICQoJyNqcy1zaGFyZWQtbGluaycpLmh0bWwoJzxpIGNsYXNzPVwiZmFzIGZhLXNwaW5uZXIgZmEtcHVsc2VcIj48L2k+Jyk7XG4gICAgfSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICBpZiAocmVzcG9uc2UuZGF0YS5zdGF0dXMgPT0gJ3N1Y2Nlc3MnKSB7XG4gICAgICAgICQoXCIjYWN0aXZpdHlcIikubG9hZChsb2NhdGlvbi5ocmVmICsgXCIgI2FjdGl2aXR5PipcIiwgXCJcIik7XG4gICAgICAgIGJsdXJfcHJvZmlsZV9zaGFyZSgpO1xuICAgICAgfVxuXG4gICAgICAkKCcjcHVibGlzaF9jb250ZW50JykudmFsKCcnKTtcbiAgICAgICQoJyNwdWJsaXNoLWNvbnRlbnQnKS5odG1sKCcnKTtcbiAgICAgICQoJyNqcy1zaGFyZWQtbGluaycpLmh0bWwoJ1Bvc3QnKTtcbiAgICB9XG4gIH0pO1xufVxuLyoqXG4gKiBNb2JpbGVcbiAqL1xuXG5cbmZ1bmN0aW9uIHN1Ym1pdF9wcm9maWxlX3NoYXJlX21vYmlsZSgpIHtcbiAgdmFyIG9ial9jb250ZW50ID0gJCgnI3B1Ymxpc2hfY29udGVudF9tb2JpbGUnKS52YWwoKTtcbiAgaWYgKG9ial9jb250ZW50LnRyaW0oKSA9PSAnJykgcmV0dXJuIGZhbHNlO1xuICB2YXIgcHJldmlldyA9ICQoJyNwdWJsaXNoLWNvbnRlbnQnKS5odG1sKCk7XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdwdWJsaXNoX2V4dGVybmFsX2Jsb2cnKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdwcmV2aWV3JywgcHJldmlldyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY29udGVudCcsIG9ial9jb250ZW50KTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IGJtc192YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLmFkZENsYXNzKCdsb2FkaW5nIGhpZGRlbkJ0bicpLnJlbW92ZUNsYXNzKCdkb25lJyk7XG4gICAgICBhY3RpdmVUYWIoJ2FjdGl2aXR5Jyk7XG4gICAgfSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5yZW1vdmVDbGFzcygnbG9hZGluZyBoaWRkZW5CdG4nKS5hZGRDbGFzcygnZG9uZScpO1xuXG4gICAgICBpZiAocmVzcG9uc2UuZGF0YS5zdGF0dXMgPT0gJ3N1Y2Nlc3MnKSB7XG4gICAgICAgICQoXCIjYWN0aXZpdHlcIikubG9hZChsb2NhdGlvbi5ocmVmICsgXCIgI2FjdGl2aXR5PipcIiwgXCJcIik7XG4gICAgICAgIGJsdXJfcHJvZmlsZV9zaGFyZSgpO1xuICAgICAgfVxuXG4gICAgICAkKCcjcHVibGlzaF9jb250ZW50X21vYmlsZScpLnZhbCgnJyk7XG4gICAgICAkKCcjcHVibGlzaC1jb250ZW50LW1vYmlsZScpLmh0bWwoJycpO1xuICAgIH1cbiAgfSk7XG4gIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgIGFjdGl2ZVRhYignYWN0aXZpdHknKTtcbiAgICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5yZW1vdmVDbGFzcygnZG9uZScpO1xuICAgICQoJyNqcy1tb2RhbC1wdWJsaWNhdGlvbicpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgfSwgMzAwMCk7XG59XG5cbmZ1bmN0aW9uIGZvY3VzX3Byb2ZpbGVfc2hhcmUoKSB7XG4gIHZhciBib2R5ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignYm9keScpO1xuICB2YXIgdGV4dEJveCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy50ZXh0LWJveCcpO1xuICB2YXIgdGV4dEJveE5hdiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy50ZXh0LWJveF9fbmF2Jyk7XG4gIHZhciB0ZXh0Qm94QWN0aW9ucyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy50ZXh0LWJveF9fYWN0aW9uJyk7XG4gIGJvZHkuY2xhc3NMaXN0LmFkZCgnZGltbWVkJyk7XG4gIHRleHRCb3guY2xhc3NMaXN0LmFkZCgndGV4dC1ib3gtLWZvY3VzZWQnKTtcbiAgdGV4dEJveE5hdi5jbGFzc0xpc3QuYWRkKCd0ZXh0LWJveF9fbmF2LS1oaWRkZW4nKTtcbiAgdGV4dEJveEFjdGlvbnMuZm9yRWFjaChmdW5jdGlvbiAoYWN0aW9uKSB7XG4gICAgcmV0dXJuIGFjdGlvbi5jbGFzc0xpc3QuYWRkKCd0ZXh0LWJveF9fYWN0aW9uLS1oaWRkZW4nKTtcbiAgfSk7XG59XG5cbmZ1bmN0aW9uIGJsdXJfcHJvZmlsZV9zaGFyZSgpIHtcbiAgdmFyIGJvZHkgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5Jyk7XG4gIHZhciB0ZXh0Qm94ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnRleHQtYm94Jyk7XG4gIHZhciB0ZXh0Qm94TmF2ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnRleHQtYm94X19uYXYnKTtcbiAgdmFyIHRleHRCb3hBY3Rpb25zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnRleHQtYm94X19hY3Rpb24nKTtcbiAgYm9keS5jbGFzc0xpc3QucmVtb3ZlKCdkaW1tZWQnKTtcbiAgdGV4dEJveC5jbGFzc0xpc3QucmVtb3ZlKCd0ZXh0LWJveC0tZm9jdXNlZCcpO1xuICB0ZXh0Qm94TmF2LmNsYXNzTGlzdC5yZW1vdmUoJ3RleHQtYm94X19uYXYtLWhpZGRlbicpO1xuICB0ZXh0Qm94QWN0aW9ucy5mb3JFYWNoKGZ1bmN0aW9uIChhY3Rpb24pIHtcbiAgICByZXR1cm4gYWN0aW9uLmNsYXNzTGlzdC5yZW1vdmUoJ3RleHQtYm94X19hY3Rpb24tLWhpZGRlbicpO1xuICB9KTtcbn1cblxuZnVuY3Rpb24gZGVsZXRlX2V4dGVybmFsX2NvbnRlbnRfcHJldmlldygpIHtcbiAgJCgnI3B1Ymxpc2gtY29udGVudCcpLmh0bWwoJycpO1xufVxuXG4oZnVuY3Rpb24gKCkge1xuICB2YXIgbWVhc3VyZXIgPSAkKCc8c3Bhbj4nLCB7XG4gICAgc3R5bGU6IFwiZGlzcGxheTppbmxpbmUtYmxvY2s7d29yZC1icmVhazpicmVhay13b3JkO3Zpc2liaWxpdHk6aGlkZGVuO3doaXRlLXNwYWNlOnByZS13cmFwO2Rpc3BsYXk6bm9uZTtcIlxuICB9KS5hcHBlbmRUbygnYm9keScpO1xuXG4gIGZ1bmN0aW9uIGluaXRNZWFzdXJlckZvcih0ZXh0YXJlYSkge1xuICAgIGlmICghdGV4dGFyZWFbMF0ub3JpZ2luYWxPdmVyZmxvd1kpIHtcbiAgICAgIHRleHRhcmVhWzBdLm9yaWdpbmFsT3ZlcmZsb3dZID0gdGV4dGFyZWEuY3NzKFwib3ZlcmZsb3cteVwiKTtcbiAgICB9XG5cbiAgICB2YXIgbWF4V2lkdGggPSB0ZXh0YXJlYS5jc3MoXCJtYXgtd2lkdGhcIik7XG4gICAgbWVhc3VyZXIudGV4dCh0ZXh0YXJlYS50ZXh0KCkpLmNzcygnZm9udCcsIHRleHRhcmVhLmNzcygnZm9udCcpKS5jc3MoJ292ZXJmbG93LXknLCB0ZXh0YXJlYS5jc3MoJ292ZXJmbG93LXknKSkuY3NzKFwibWF4LWhlaWdodFwiLCB0ZXh0YXJlYS5jc3MoXCJtYXgtaGVpZ2h0XCIpKS5jc3MoXCJtaW4taGVpZ2h0XCIsIHRleHRhcmVhLmNzcyhcIm1pbi1oZWlnaHRcIikpLmNzcyhcInBhZGRpbmdcIiwgdGV4dGFyZWEuY3NzKFwicGFkZGluZ1wiKSkuY3NzKFwiYm9yZGVyXCIsIHRleHRhcmVhLmNzcyhcImJvcmRlclwiKSkuY3NzKFwiYm94LXNpemluZ1wiLCB0ZXh0YXJlYS5jc3MoXCJib3gtc2l6aW5nXCIpKTtcbiAgfVxuXG4gIGZ1bmN0aW9uIHVwZGF0ZVRleHRBcmVhU2l6ZSh0ZXh0YXJlYSkge1xuICAgIHRleHRhcmVhLmhlaWdodChtZWFzdXJlci5oZWlnaHQoKSk7XG4gICAgdmFyIHcgPSBtZWFzdXJlci53aWR0aCgpO1xuXG4gICAgaWYgKHRleHRhcmVhWzBdLm9yaWdpbmFsT3ZlcmZsb3dZID09IFwiYXV0b1wiKSB7XG4gICAgICB2YXIgbXcgPSB0ZXh0YXJlYS5jc3MoXCJtYXgtd2lkdGhcIik7XG5cbiAgICAgIGlmIChtdyAhPSBcIm5vbmVcIikge1xuICAgICAgICBpZiAodyA9PSBwYXJzZUludChtdykpIHtcbiAgICAgICAgICB0ZXh0YXJlYS5jc3MoXCJvdmVyZmxvdy15XCIsIFwiYXV0b1wiKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICB0ZXh0YXJlYS5jc3MoXCJvdmVyZmxvdy15XCIsIFwiaGlkZGVuXCIpO1xuICAgICAgICB9XG4gICAgICB9XG4gICAgfVxuICB9XG5cbiAgJCgndGV4dGFyZWEuYXV0b2ZpdCcpLm9uKHtcbiAgICBpbnB1dDogZnVuY3Rpb24gaW5wdXQoKSB7XG4gICAgICB2YXIgdGV4dCA9ICQodGhpcykudmFsKCk7XG5cbiAgICAgIGlmICgkKHRoaXMpLmF0dHIoXCJwcmV2ZW50RW50ZXJcIikgPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgIHRleHQgPSB0ZXh0LnJlcGxhY2UoL1tcXG5dL2csIFwiPGJyPiYjODIwMztcIik7XG4gICAgICB9XG5cbiAgICAgIG1lYXN1cmVyLmh0bWwodGV4dCk7XG4gICAgICB1cGRhdGVUZXh0QXJlYVNpemUoJCh0aGlzKSk7XG4gICAgfSxcbiAgICBmb2N1czogZnVuY3Rpb24gZm9jdXMoKSB7XG4gICAgICBpbml0TWVhc3VyZXJGb3IoJCh0aGlzKSk7XG4gICAgfSxcbiAgICBrZXlwcmVzczogZnVuY3Rpb24ga2V5cHJlc3MoZSkge1xuICAgICAgaWYgKGUud2hpY2ggPT0gMTMgJiYgJCh0aGlzKS5hdHRyKFwicHJldmVudEVudGVyXCIpICE9IHVuZGVmaW5lZCkge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICB9XG4gICAgfVxuICB9KTtcbn0pKCk7XG4vKipcbiAqIE9wZW4gTW9kYWxcbiAqL1xuXG5cbmZ1bmN0aW9uIG9wZW5DZXRpZmljYXRpb25Nb2RhbCgpIHtcbiAgJCgnI2pzLW1vZGFsLWJvYXJkLWNlcnRpZmljYXRpb24nKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG59XG5cbmZ1bmN0aW9uIG9wZW5FZHVjYXRpb25Nb2RhbCgpIHtcbiAgJCgnI2pzLW1vZGFsLWVkdWNhdGlvbicpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbn1cblxuZnVuY3Rpb24gb3BlbkJpb01vZGFsKCkge1xuICAkKCcjanMtbW9kYWwtYmlvJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xufVxuXG5mdW5jdGlvbiBvcGVuTG9jYXRpb25Nb2RhbCgpIHtcbiAgJCgnI2pzLW1vZGFsLWxvY2F0aW9uJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xufVxuXG5mdW5jdGlvbiBvcGVuVmlkZW9Nb2RhbCgpIHtcbiAgJCgnI2pzLW1vZGFsLXZpZGVvJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xufVxuXG5mdW5jdGlvbiBvcGVuVmlkZW9FeGFtcGxlTW9kYWwoKSB7XG4gICQoJyNqcy1tb2RhbC12aWRlby1leGFtcGxlJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xufVxuXG5mdW5jdGlvbiBvcGVuRXhwZXJ0aXNlTW9kYWwoKSB7XG4gICQoJyNqcy1tb2RhbC1leHBlcnRpc2UnKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG59XG5cbmZ1bmN0aW9uIG9wZW5QdWJsaWNhdGlvbk1vZGFsKCkge1xuICAkKCcjanMtbW9kYWwtcHVibGljYXRpb24nKS5yZW1vdmVDbGFzcygnZC1ub25lJyk7XG4gICQoJyNwdWJsaXNoX2NvbnRlbnRfbW9iaWxlJykuZm9jdXMoKTtcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJwdWJsaXNoX2NvbnRlbnRfbW9iaWxlXCIpLmZvY3VzKCkuc2V0U2VsZWN0aW9uUmFuZ2UoMCwgOTk5KTtcbiAgc2V0VGltZW91dCgkKCcjcHVibGlzaF9jb250ZW50X21vYmlsZScpLmZvY3VzKCksIDEwMDApO1xufVxuLyoqXG4gKiBBZGQgTmV3IENlcnRpZmljYXRpb24gaXRlbSBodG1sXG4gKi9cblxuXG5mdW5jdGlvbiBhZGRDZXJ0aWZpY2F0aW9uSXRlbUFsdCgpIHtcbiAgdmFyIGlkID0gTWF0aC5mbG9vcihNYXRoLnJhbmRvbSgpICogKDk5IC0gMCkpICsgMDtcbiAgdmFyIGh0bWwgPSAnPGRpdiBjbGFzcz1cImJveC1jZXJ0aWZpY2F0aW9uLWl0ZW1zXCIgaWQ9XCInICsgaWQgKyAnXCI+JztcbiAgaHRtbCArPSAnPGlucHV0IHR5cGU9XCJ0ZXh0XCIgbmFtZT1cInVzZXJfY2VydGlmaWNhdGlvbltdXCIgY2xhc3M9XCJtci0wIGNlcnRpZmljYXRpb24taXRlbVwiIHZhbHVlPVwiXCI+JztcbiAgaHRtbCArPSAnPGRpdiBvbmNsaWNrPVwiZGVsZXRlSXRlbUNlcnRpZmljYXRpb24oJyArIGlkICsgJylcIj48aW1nIHNyYz1cIi93cC1jb250ZW50L3BsdWdpbnMvYmxvZ2dpbmctcGxhdGZvcm0vYXNzZXRzL2ltZy9kZWxldGUteC1pY29uLnN2Z1wiIC8+PC9kaXY+JztcbiAgaHRtbCArPSAnPC9kaXY+JztcbiAgJCgnI2pzLWNlcnRpZmljYXRpb25zLWl0ZW1zJykuYXBwZW5kKGh0bWwpO1xufVxuLyoqXG4gKiBEZWxldGUgY2VydGlmaWNhdGlvbiBpdGVtXG4gKi9cblxuXG5mdW5jdGlvbiBkZWxldGVJdGVtQ2VydGlmaWNhdGlvbihpZCkge1xuICAkKCcjJyArIGlkKS5yZW1vdmUoKTtcbn1cbi8qKlxuICogTG9hZCBTdWIgU3BlY2lhbHRpZXMgc2VsZWN0XG4gKi9cblxuXG5mdW5jdGlvbiBzYXZlQm9hcmRDZXJ0aWZpY2F0aW9uKCkge1xuICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5hZGRDbGFzcygnbG9hZGluZyBoaWRkZW5CdG4nKS5yZW1vdmVDbGFzcygnZG9uZScpO1xuICB2YXIgY2VydGlmaWNhdGlvbnMgPSBbXTtcbiAgJCgnLmNoZWNrX2NlcnRpZmljYXRpb24nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgY2VydGlmaWNhdGlvbiA9IHtcbiAgICAgIGNlcnRpZmljYXRpb246ICQodGhpcykuZmluZCgnLml0ZW1fY2VydGlmaWNhdGlvbicpLnZhbCgpLFxuICAgICAgc3ViY2VydGlmaWNhdGlvbjogJCh0aGlzKS5maW5kKCcuaXRlbV9zdWJjZXJ0aWZpY2F0aW9uJykudmFsKClcbiAgICB9O1xuICAgIGNlcnRpZmljYXRpb25zLnB1c2goY2VydGlmaWNhdGlvbik7XG4gIH0pO1xuICB2YXIgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdhY3Rpb24nLCAnc2F2ZV9jZXJ0aWZpY2F0aW9ucycpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ3VzZXJfcmVzaWRlbmN5JywgJCgnI3VzZXJfcmVzaWRlbmN5JykudmFsKCkpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ3VzZXJfY3JlZGVudGlhbCcsICQoJyN1c2VyX2NyZWRlbnRpYWwnKS52YWwoKSk7XG4gIGZvcm1EYXRhLmFwcGVuZCgndXNlcl9jZXJ0aWZpY2F0aW9uJywgSlNPTi5zdHJpbmdpZnkoY2VydGlmaWNhdGlvbnMpKTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IHBwX3ZhcnMuYWpheHVybCxcbiAgICB0eXBlOiAnUE9TVCcsXG4gICAgZGF0YTogZm9ybURhdGEsXG4gICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5yZW1vdmVDbGFzcygnbG9hZGluZyBoaWRkZW5CdG4nKS5hZGRDbGFzcygnZG9uZScpO1xuICAgICAgJCgnI2pzLWNlcnRpZmljYXRpb25zJykubG9hZCgkKGxvY2F0aW9uKS5hdHRyKCdocmVmJykgKyAnICNqcy1jZXJ0aWZpY2F0aW9ucycpO1xuICAgICAgY2xvc2VNb2RhbCgpO1xuICAgIH1cbiAgfSk7XG4gIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLnJlbW92ZUNsYXNzKCdkb25lJyk7XG4gIH0sIDMwMDApO1xufVxuLyoqXG4gKiBBY3RpdmUgQm9hcmQgQ2VydGlmaWNhdGlvblxuICovXG5cblxudmFyIGFjdGl2ZUJvYXJkTW9kYWwgPSBmdW5jdGlvbiBhY3RpdmVCb2FyZE1vZGFsKCkge1xuICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImpzLWJvYXJkXCIpLmNoZWNrZWQgPSB0cnVlO1xuICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImpzLXJlc2lkZW50XCIpLmNoZWNrZWQgPSBmYWxzZTtcbiAgdmFyIGJvYXJkID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLXZpc2libGUtY2VydGlmaWNhdGlvbnMnKTtcbiAgYm9hcmQuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XG4gIHZhciByZXNpZGVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdqcy1jdGEtcmVzaWRlbnQnKTtcbiAgcmVzaWRlbnQuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XG4gIHZhciBjcmVkZW50aWFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLXZpc2libGUtY3JlZGVudGlhbCcpO1xuICBjcmVkZW50aWFsLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xuICB2YXIgcmVzaWRlbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnanMtdmlzaWJsZS1yZXNpZGVudCcpO1xuICByZXNpZGVudC5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcbn07XG4vKipcbiAqIEFjdGl2ZSBSZXNpZGVudFxuICovXG5cblxudmFyIGFjdGl2ZVJlc2lkZW50TW9kYWwgPSBmdW5jdGlvbiBhY3RpdmVSZXNpZGVudE1vZGFsKCkge1xuICB2YXIgYm9hcmQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnanMtdmlzaWJsZS1jZXJ0aWZpY2F0aW9ucycpO1xuICBib2FyZC5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJqcy1yZXNpZGVudFwiKS5jaGVja2VkID0gdHJ1ZTtcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJqcy1ib2FyZFwiKS5jaGVja2VkID0gZmFsc2U7XG4gIHZhciByZXNpZGVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdqcy1jdGEtcmVzaWRlbnQnKTtcbiAgcmVzaWRlbnQuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XG59O1xuLyoqXG4gKiBBY3RpdmUgUmVzaWRlbnQgRmllbGRcbiAqL1xuXG5cbnZhciBhY3RpdmVSZXNpZGVudEZpZWxkTW9kYWwgPSBmdW5jdGlvbiBhY3RpdmVSZXNpZGVudEZpZWxkTW9kYWwoKSB7XG4gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwianMtcmVzaWRlbnQteVwiKS5jaGVja2VkID0gdHJ1ZTtcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJqcy1yZXNpZGVudC14XCIpLmNoZWNrZWQgPSBmYWxzZTtcbiAgdmFyIHJlc2lkZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLXZpc2libGUtcmVzaWRlbnQnKTtcbiAgcmVzaWRlbnQuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XG4gIHZhciBjcmVkZW50aWFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLXZpc2libGUtY3JlZGVudGlhbCcpO1xuICBjcmVkZW50aWFsLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xufTtcbi8qKlxuICogQWN0aXZlIENyZWRlbnRpYWwgRmllbGRcbiAqL1xuXG5cbnZhciBhY3RpdmVDcmVkZW50aWFsRmllbGRNb2RhbCA9IGZ1bmN0aW9uIGFjdGl2ZUNyZWRlbnRpYWxGaWVsZE1vZGFsKCkge1xuICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImpzLXJlc2lkZW50LXlcIikuY2hlY2tlZCA9IGZhbHNlO1xuICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImpzLXJlc2lkZW50LXhcIikuY2hlY2tlZCA9IHRydWU7XG4gIHZhciBjcmVkZW50aWFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLXZpc2libGUtY3JlZGVudGlhbCcpO1xuICBjcmVkZW50aWFsLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xuICB2YXIgcmVzaWRlbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnanMtdmlzaWJsZS1yZXNpZGVudCcpO1xuICByZXNpZGVudC5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcbn07XG4vKipcbiAqIExvYWQgU3ViIFNwZWNpYWx0aWVzIHNlbGVjdCBCb2FyZCBDZXJ0aWZpY2F0aW9uXG4gKi9cblxuXG5mdW5jdGlvbiBsb2FkU3ViQ2VydGlmaWNhdGlvbih2YWx1ZSkge1xuICBpZiAoIXZhbHVlKSByZXR1cm47XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdsb2FkX3N1YnNwZWNpYWx0aWVzJyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgndXNlcl9zcGVjaWFsdHknLCB2YWx1ZSk7XG4gIGpRdWVyeS5hamF4KHtcbiAgICBjYWNoZTogZmFsc2UsXG4gICAgdXJsOiBkZF92YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZChyZXNwb25zZSkge1xuICAgICAgJCgnI3VzZXJfc3ViY2VydGlmaWNhdGlvbicpLmh0bWwoJzxvcHRpb24gdmFsdWU9XCJcIiBzZWxlY3RlZCBkaXNhYmxlZD5sb2FkaW5nLi4uPC9vcHRpb24+Jyk7XG4gICAgfSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAkKCcjdXNlcl9zdWJjZXJ0aWZpY2F0aW9uJykuaHRtbChyZXNwb25zZS5kYXRhKTtcbiAgICB9XG4gIH0pO1xuICByZXR1cm4gZmFsc2U7XG59XG4vKipcbiAqIEFkZCBiaW8gc3BlY2lhbHRpZXMgY2VydGlmaWNhdGlvblxuICovXG5cblxuZnVuY3Rpb24gYWRkQ2VydGlmaWNhdGlvbigpIHtcbiAgdmFyIHJhbmQgPSBNYXRoLmZsb29yKE1hdGgucmFuZG9tKCkgKiAoOTk5OSAtIDkpKSArIDk7XG4gIHZhciBjZXJ0aWZpY2F0aW9uID0gJCgnI3VzZXJfY2VydGlmaWNhdGlvbicpLnZhbCgpO1xuICB2YXIgY2VydGlmaWNhdGlvbl9zbHVnID0gY2VydGlmaWNhdGlvbi5yZXBsYWNlKC8gL2csIFwiLVwiKS5yZXBsYWNlKC9bXCInKCldL2csIFwiXCIpICsgcmFuZDtcbiAgdmFyIHN1YmNlcnRpZmljYXRpb24gPSAkKCcjdXNlcl9zdWJjZXJ0aWZpY2F0aW9uJykudmFsKCk7XG4gIHZhciBzdWJjZXJ0aWZpY2F0aW9uX3NsdWcgPSBzdWJjZXJ0aWZpY2F0aW9uLnJlcGxhY2UoLyAvZywgXCItXCIpLnJlcGxhY2UoL1tcIicoKV0vZywgXCJcIikgKyByYW5kO1xuICB2YXIgaHRtbCA9ICcnO1xuXG4gIGlmIChjZXJ0aWZpY2F0aW9uICYmIGNlcnRpZmljYXRpb24gIT09ICdub25lJyAmJiBjZXJ0aWZpY2F0aW9uICE9PSAnbnVsbCcpIHtcbiAgICAvLyQoXCIjdXNlcl9jZXJ0aWZpY2F0aW9uIG9wdGlvbjpzZWxlY3RlZFwiKS5hdHRyKCdkaXNhYmxlZCcsJ2Rpc2FibGVkJyk7XG4gICAgaHRtbCArPSAnPGxpIGlkPVwiJyArIGNlcnRpZmljYXRpb25fc2x1ZyArICdcIiAgY2xhc3M9XCJkLWZsZXggZmxleC1yb3cgY2hlY2tfY2VydGlmaWNhdGlvblwiPic7XG4gICAgaHRtbCArPSAnPGRpdiBjbGFzcz1cImJveC1jZXJ0aWZpY2F0aW9uIGJveC1jZXJ0aWZpY2F0aW9uLXB1cnBsZSBkLWZsZXggZmxleC1yb3dcIj4nICsgY2VydGlmaWNhdGlvbiArICc8aW5wdXQgdHlwZT1cImhpZGRlblwiIHZhbHVlPVwiJyArIGNlcnRpZmljYXRpb24gKyAnXCIgY2xhc3M9XCJpdGVtX2NlcnRpZmljYXRpb25cIj48ZGl2IG9uY2xpY2s9XCJkZWxldGVJdGVtY2VydGlmaWNhdGlvbih0aGlzKTtcIj48aW1nIHNyYz1cIi93cC1jb250ZW50L3BsdWdpbnMvYmxvZ2dpbmctcGxhdGZvcm0vYXNzZXRzL2ltZy9kZWxldGUteC1pY29uLnN2Z1wiIC8+PC9kaXY+PC9kaXY+JztcbiAgfVxuXG4gIGlmIChzdWJjZXJ0aWZpY2F0aW9uICYmIHN1YmNlcnRpZmljYXRpb24gIT09ICdub25lJyAmJiBzdWJjZXJ0aWZpY2F0aW9uICE9PSAnbnVsbCcpIHtcbiAgICAvLyQoXCIjdXNlcl9zdWJjZXJ0aWZpY2F0aW9uIG9wdGlvbjpzZWxlY3RlZFwiKS5hdHRyKCdkaXNhYmxlZCcsJ2Rpc2FibGVkJyk7XG4gICAgaHRtbCArPSAnPGRpdiBpZD1cIicgKyBzdWJjZXJ0aWZpY2F0aW9uX3NsdWcgKyAnXCIgIGNsYXNzPVwiYm94LWNlcnRpZmljYXRpb24gYm94LWNlcnRpZmljYXRpb24tcGluayBkLWZsZXggZmxleC1yb3dcIj4nICsgc3ViY2VydGlmaWNhdGlvbiArICcgPGlucHV0IHR5cGU9XCJoaWRkZW5cIiB2YWx1ZT1cIicgKyBzdWJjZXJ0aWZpY2F0aW9uICsgJ1wiIGNsYXNzPVwiaXRlbV9zdWJjZXJ0aWZpY2F0aW9uXCI+PGRpdiBvbmNsaWNrPVwiZGVsZXRlSXRlbVN1YmNlcnRpZmljYXRpb24odGhpcyk7XCI+PGltZyBzcmM9XCIvd3AtY29udGVudC9wbHVnaW5zL2Jsb2dnaW5nLXBsYXRmb3JtL2Fzc2V0cy9pbWcvZGVsZXRlLXgtaWNvbi5zdmdcIiAvPjwvZGl2PjwvZGl2PiAnO1xuICB9XG5cbiAgaHRtbCArPSAnPC9saT4nO1xuICAkKCcjanMtbGlzdC1jZXJ0aWZpY2F0aW9uJykuYXBwZW5kKGh0bWwpO1xufVxuLyoqXG4gKiBEZWxldGUgSXRlbSBjZXJ0aWZpY2F0aW9uXG4gKi9cblxuXG5mdW5jdGlvbiBkZWxldGVJdGVtY2VydGlmaWNhdGlvbihvYmopIHtcbiAgdmFyIGVsZW0gPSBvYmo7XG4gICQoZWxlbSkucGFyZW50KCkucGFyZW50KCkucmVtb3ZlKCk7IC8vJCgnI3VzZXJfY2VydGlmaWNhdGlvbiBvcHRpb25bdmFsdWU9XCInICsgaWQgKyAnXCJdJykucmVtb3ZlQXR0cignZGlzYWJsZWQnKTtcbn1cblxuZnVuY3Rpb24gZGVsZXRlSXRlbVN1YmNlcnRpZmljYXRpb24ob2JqKSB7XG4gIHZhciBlbGVtID0gb2JqO1xuICAkKGVsZW0pLnBhcmVudCgpLnBhcmVudCgpLnJlbW92ZSgpOyAvLyQoJyN1c2VyX3N1YmNlcnRpZmljYXRpb24gb3B0aW9uW3ZhbHVlPVwiJyArIGlkICsgJ1wiXScpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJyk7XG59XG4vKipcbiAqIEFkZCBCaW8gRWR1Y2F0aW9uXG4gKi9cblxuXG5mdW5jdGlvbiBhZGRFZHVjYXRpb25JdGVtKCkge1xuICB2YXIgZWR1Y2F0aW9uID0gJCgnI3VzZXJfZWR1Y2F0aW9uJykudmFsKCk7XG4gIHZhciBlZHVjYXRpb25fc2x1ZyA9IGVkdWNhdGlvbi5yZXBsYWNlKC8gL2csIFwiLVwiKS5yZXBsYWNlKC9bXCInKCldL2csIFwiXCIpO1xuICB2YXIgaHRtbCA9ICcnO1xuXG4gIGlmIChlZHVjYXRpb24gJiYgZWR1Y2F0aW9uICE9PSAnbm9uZScgJiYgZWR1Y2F0aW9uICE9PSAnbnVsbCcpIHtcbiAgICBodG1sICs9ICc8bGkgaWQ9XCInICsgZWR1Y2F0aW9uX3NsdWcgKyAnXCIgIGNsYXNzPVwiZC1mbGV4IGZsZXgtcm93IGNoZWNrX2VkdWNhdGlvblwiPic7XG4gICAgaHRtbCArPSAnPGRpdiBjbGFzcz1cImJveC1lZHVjYXRpb24gYm94LWVkdWNhdGlvbi1wdXJwbGUgZC1mbGV4IGZsZXgtcm93XCI+JyArIGVkdWNhdGlvbiArICc8aW5wdXQgdHlwZT1cImhpZGRlblwiIHZhbHVlPVwiJyArIGVkdWNhdGlvbiArICdcIiBjbGFzcz1cIml0ZW1fZWR1Y2F0aW9uXCI+PGRpdiBvbmNsaWNrPVwiZGVsZXRlSXRlbUVkdWNhdGlvbih0aGlzKTtcIj48aW1nIHNyYz1cIi93cC1jb250ZW50L3BsdWdpbnMvYmxvZ2dpbmctcGxhdGZvcm0vYXNzZXRzL2ltZy9kZWxldGUteC1pY29uLnN2Z1wiIC8+PC9kaXY+PC9kaXY+JztcbiAgfVxuXG4gIGh0bWwgKz0gJzwvbGk+JztcbiAgJCgnI2pzLWxpc3QtZWR1Y2F0aW9uJykuYXBwZW5kKGh0bWwpO1xuICAkKCcjdXNlcl9lZHVjYXRpb24nKS52YWwoJycpO1xufVxuXG5mdW5jdGlvbiBkZWxldGVJdGVtRWR1Y2F0aW9uKG9iaikge1xuICB2YXIgZWxlbSA9IG9iajtcbiAgJChlbGVtKS5wYXJlbnQoKS5wYXJlbnQoKS5yZW1vdmUoKTtcbn1cbi8qKlxuICogU2F2ZSBFZHVjYXRpb25cbiAqL1xuXG5cbmZ1bmN0aW9uIHNhdmVFZHVjYXRpb24oKSB7XG4gIHZhciBlZHVjYXRpb25zID0gW107XG4gICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLmFkZENsYXNzKCdsb2FkaW5nIGhpZGRlbkJ0bicpLnJlbW92ZUNsYXNzKCdkb25lJyk7XG4gICQoJy5jaGVja19lZHVjYXRpb24nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICBlZHVjYXRpb25zLnB1c2goJCh0aGlzKS5maW5kKCcuaXRlbV9lZHVjYXRpb24nKS52YWwoKSk7XG4gIH0pO1xuICB2YXIgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdhY3Rpb24nLCAnc2F2ZV9lZHVjYXRpb24nKTtcbiAgZm9ybURhdGEuYXBwZW5kKCd1c2VyX2VkdWNhdGlvbicsIEpTT04uc3RyaW5naWZ5KGVkdWNhdGlvbnMpKTtcbiAgalF1ZXJ5LmFqYXgoe1xuICAgIGNhY2hlOiBmYWxzZSxcbiAgICB1cmw6IHBwX3ZhcnMuYWpheHVybCxcbiAgICB0eXBlOiAnUE9TVCcsXG4gICAgZGF0YTogZm9ybURhdGEsXG4gICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5yZW1vdmVDbGFzcygnbG9hZGluZyBoaWRkZW5CdG4nKS5hZGRDbGFzcygnZG9uZScpO1xuICAgICAgJCgnI2pzLWVkdWNhdGlvbnMnKS5sb2FkKCQobG9jYXRpb24pLmF0dHIoJ2hyZWYnKSArICcgI2pzLWVkdWNhdGlvbnMnKTtcblxuICAgICAgaWYgKHJlc3BvbnNlLmRhdGEubGVuZ3RoID4gMSkge1xuICAgICAgICAkKCcjanMtZWR1Y2F0aW9ucycpLmFkZENsYXNzKCdtYi00Jyk7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICAkKCcjanMtZWR1Y2F0aW9ucycpLnJlbW92ZUNsYXNzKCdtYi00Jyk7XG4gICAgICB9XG5cbiAgICAgIGNsb3NlTW9kYWwoKTtcbiAgICB9XG4gIH0pO1xuICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5yZW1vdmVDbGFzcygnZG9uZScpO1xuICB9LCAzMDAwKTtcbn1cbi8qKlxuICogU2F2ZSBCaW9ncmFwaHlcbiAqL1xuXG5cbmZ1bmN0aW9uIHNhdmVCaW9ncmFwaHkoKSB7XG4gICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLmFkZENsYXNzKCdsb2FkaW5nIGhpZGRlbkJ0bicpLnJlbW92ZUNsYXNzKCdkb25lJyk7XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdzYXZlX2Jpb2dyYXBoeScpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2Jpb2dyYXBoeScsICQoJyN1c2VyX2Jpb2dyYXBoeScpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdiaW9ncmFwaHlfbGluaycsICQoJyN1c2VyX2Jpb2dyYXBoeV9saW5rJykudmFsKCkpO1xuICBqUXVlcnkuYWpheCh7XG4gICAgY2FjaGU6IGZhbHNlLFxuICAgIHVybDogcHBfdmFycy5hamF4dXJsLFxuICAgIHR5cGU6ICdQT1NUJyxcbiAgICBkYXRhOiBmb3JtRGF0YSxcbiAgICBjb250ZW50VHlwZTogZmFsc2UsXG4gICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIHN1Y2Nlc3MocmVzcG9uc2UpIHtcbiAgICAgICQoJy5qcy1zYXZlLWFuaW1hdGlvbicpLnJlbW92ZUNsYXNzKCdsb2FkaW5nIGhpZGRlbkJ0bicpLmFkZENsYXNzKCdkb25lJyk7XG4gICAgICAkKCcjanMtYXV0aG9yLXByb2ZpbGUtYmlvJykuaHRtbChyZXNwb25zZS5kYXRhLmRhdGEpO1xuXG4gICAgICBpZiAoJCgnI3VzZXJfYmlvZ3JhcGh5JykudmFsKCkubGVuZ3RoID4gMSkge1xuICAgICAgICAkKCcjanMtYXV0aG9yLXByb2ZpbGUtYmlvJykuYWRkQ2xhc3MoJ21iLTQnKTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgICQoJyNqcy1hdXRob3ItcHJvZmlsZS1iaW8nKS5yZW1vdmVDbGFzcygnbWItNCcpO1xuICAgICAgfVxuXG4gICAgICBjbG9zZU1vZGFsKCk7XG4gICAgfVxuICB9KTtcbiAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykucmVtb3ZlQ2xhc3MoJ2RvbmUnKTtcbiAgfSwgMzAwMCk7XG59XG4vKipcbiAqIFNhdmUgTG9jYXRpb25cbiAqL1xuXG5cbmZ1bmN0aW9uIHNhdmVMb2NhdGlvbigpIHtcbiAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykuYWRkQ2xhc3MoJ2xvYWRpbmcgaGlkZGVuQnRuJykucmVtb3ZlQ2xhc3MoJ2RvbmUnKTtcbiAgdmFyIGZvcm1EYXRhID0gbmV3IEZvcm1EYXRhKCk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnYWN0aW9uJywgJ3NhdmVfbG9jYXRpb24nKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdjbGluaWNfbGF0JywgJCgnI2xhdGl0dWRfcHJvcCcpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdjbGluaWNfbG5nJywgJCgnI2xvbmdpdHVkX3Byb3AnKS52YWwoKSk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY2xpbmljX25hbWUnLCAkKCcjY2xpbmljX25hbWUnKS52YWwoKSk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY2xpbmljX2VtYWlsJywgJCgnI2NsaW5pY19lbWFpbCcpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdjbGluaWNfb3BlbicsICQoJyNjbGluaWNfb3BlbicpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdjbGluaWNfcGhvbmUnLCAkKCcjY2xpbmljX3Bob25lJykudmFsKCkpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2NsaW5pY193ZWInLCAkKCcjY2xpbmljX3dlYicpLnZhbCgpKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdjbGluaWNfYXBwb2ludG1lbnQnLCAkKCcjY2xpbmljX2FwcG9pbnRtZW50JykudmFsKCkpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2NsaW5pY19sb2NhdGlvbicsICQoJyNqcy1nb29nbGUtc2VhcmNoJykudmFsKCkpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2NpdHknLCAkKCcjY2l0eV9wcm9wJykudmFsKCkpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ3N0YXRlJywgJCgnI3N0YXRlX3Byb3AnKS52YWwoKSk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnY291bnRyeScsICQoJyNjb3VudHJ5X3Byb3AnKS52YWwoKSk7XG4gIGpRdWVyeS5hamF4KHtcbiAgICBjYWNoZTogZmFsc2UsXG4gICAgdXJsOiBwcF92YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcgaGlkZGVuQnRuJykuYWRkQ2xhc3MoJ2RvbmUnKTtcbiAgICAgICQoXCIjanMtZmlyc3QtY29sdW1uLXByZW1pdW1cIikubG9hZCgkKGxvY2F0aW9uKS5hdHRyKFwiaHJlZlwiKSArICcgI2pzLWZpcnN0LWNvbHVtbi1wcmVtaXVtJyk7XG4gICAgICBjbG9zZU1vZGFsKCk7XG4gICAgfVxuICB9KTtcbiAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykucmVtb3ZlQ2xhc3MoJ2RvbmUnKTtcbiAgfSwgMzAwMCk7XG59XG4vKipcbiAqIFNhdmUgRXhwZXJ0aXNlXG4gKi9cblxuXG5mdW5jdGlvbiBzYXZlRXhwZXJ0aXNlKCkge1xuICB2YXIgZXhwZXJ0aXNlcyA9IFtdO1xuICAkKCcuanMtc2F2ZS1hbmltYXRpb24nKS5hZGRDbGFzcygnbG9hZGluZyBoaWRkZW5CdG4nKS5yZW1vdmVDbGFzcygnZG9uZScpO1xuICAkKCcuY2hlY2tfZXhwZXJ0aXNlJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgZXhwZXJ0aXNlcy5wdXNoKCQodGhpcykuZmluZCgnLml0ZW1fZWR1Y2F0aW9uJykudmFsKCkpO1xuICB9KTtcbiAgdmFyIGZvcm1EYXRhID0gbmV3IEZvcm1EYXRhKCk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnYWN0aW9uJywgJ3NhdmVfZXhwZXJ0aXNlJyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgndXNlcl9leHBlcnRpc2UnLCBKU09OLnN0cmluZ2lmeShleHBlcnRpc2VzKSk7XG4gIGpRdWVyeS5hamF4KHtcbiAgICBjYWNoZTogZmFsc2UsXG4gICAgdXJsOiBwcF92YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcgaGlkZGVuQnRuJykuYWRkQ2xhc3MoJ2RvbmUnKTtcbiAgICAgICQoJyNqcy1leHBlcnRpc2VzJykubG9hZCgkKGxvY2F0aW9uKS5hdHRyKCdocmVmJykgKyAnICNqcy1leHBlcnRpc2VzJyk7XG5cbiAgICAgIGlmIChyZXNwb25zZS5kYXRhLmxlbmd0aCA+IDEpIHtcbiAgICAgICAgJCgnI2pzLWV4cGVydGlzZXMnKS5hZGRDbGFzcygnbWItNCcpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgJCgnI2pzLWV4cGVydGlzZXMnKS5yZW1vdmVDbGFzcygnbWItNCcpO1xuICAgICAgfVxuXG4gICAgICBjbG9zZU1vZGFsKCk7XG4gICAgfVxuICB9KTtcbiAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgJCgnLmpzLXNhdmUtYW5pbWF0aW9uJykucmVtb3ZlQ2xhc3MoJ2RvbmUnKTtcbiAgfSwgMzAwMCk7XG59XG4vKipcbiAqIE1hcCBDbGluaWNcbiAqL1xuXG5cbihmdW5jdGlvbiAoJCkge1xuICAvKipcbiAgICogaW5pdE1hcFxuICAgKlxuICAgKiBSZW5kZXJzIGEgR29vZ2xlIE1hcCBvbnRvIHRoZSBzZWxlY3RlZCBqUXVlcnkgZWxlbWVudFxuICAgKlxuICAgKiBAZGF0ZSAgICAyMi8xMC8xOVxuICAgKiBAc2luY2UgICA1LjguNlxuICAgKlxuICAgKiBAcGFyYW0gICBqUXVlcnkgJGVsIFRoZSBqUXVlcnkgZWxlbWVudC5cbiAgICogQHJldHVybiAgb2JqZWN0IFRoZSBtYXAgaW5zdGFuY2UuXG4gICAqL1xuICBmdW5jdGlvbiBpbml0TWFwKCRlbCkge1xuICAgIC8vIEZpbmQgbWFya2VyIGVsZW1lbnRzIHdpdGhpbiBtYXAuXG4gICAgdmFyICRtYXJrZXJzID0gJGVsLmZpbmQoJy5tYXJrZXInKTsgLy8gQ3JlYXRlIGdlcmVuaWMgbWFwLlxuXG4gICAgdmFyIG1hcEFyZ3MgPSB7XG4gICAgICB6b29tOiAkZWwuZGF0YSgnem9vbScpIHx8IDE2LFxuICAgICAgbWFwVHlwZUlkOiBnb29nbGUubWFwcy5NYXBUeXBlSWQuUk9BRE1BUCxcbiAgICAgIHBhbkNvbnRyb2w6IGZhbHNlLFxuICAgICAgbWFwVHlwZUNvbnRyb2w6IGZhbHNlLFxuICAgICAgc3RyZWV0Vmlld0NvbnRyb2w6IGZhbHNlLFxuICAgICAgb3ZlcnZpZXdNYXBDb250cm9sOiBmYWxzZSxcbiAgICAgIHpvb21Db250cm9sOiB0cnVlLFxuICAgICAgc2NhbGVDb250cm9sOiBmYWxzZSxcbiAgICAgIGZ1bGxzY3JlZW5Db250cm9sOiBmYWxzZSxcbiAgICAgIHJvdGF0ZUNvbnRyb2w6IGZhbHNlXG4gICAgfTtcbiAgICB2YXIgbWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcCgkZWxbMF0sIG1hcEFyZ3MpOyAvLyBBZGQgbWFya2Vycy5cblxuICAgIG1hcC5tYXJrZXJzID0gW107XG4gICAgJG1hcmtlcnMuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICBpbml0TWFya2VyKCQodGhpcyksIG1hcCk7XG4gICAgfSk7IC8vIENlbnRlciBtYXAgYmFzZWQgb24gbWFya2Vycy5cblxuICAgIGNlbnRlck1hcChtYXApOyAvLyBTZWFyY2ggSW5wdXQgYW5kIHB1c2ggaW50byBtYXBcblxuICAgIHNlYXJjaElucHV0KG1hcCk7IC8vIFJldHVybiBtYXAgaW5zdGFuY2UuXG5cbiAgICByZXR1cm4gbWFwO1xuICB9XG4gIC8qKlxuICAgKiBpbml0TWFya2VyXG4gICAqXG4gICAqIENyZWF0ZXMgYSBtYXJrZXIgZm9yIHRoZSBnaXZlbiBqUXVlcnkgZWxlbWVudCBhbmQgbWFwLlxuICAgKlxuICAgKiBAZGF0ZSAgICAyMi8xMC8xOVxuICAgKiBAc2luY2UgICA1LjguNlxuICAgKlxuICAgKiBAcGFyYW0gICBqUXVlcnkgJGVsIFRoZSBqUXVlcnkgZWxlbWVudC5cbiAgICogQHBhcmFtICAgb2JqZWN0IFRoZSBtYXAgaW5zdGFuY2UuXG4gICAqIEByZXR1cm4gIG9iamVjdCBUaGUgbWFya2VyIGluc3RhbmNlLlxuICAgKi9cblxuXG4gIGZ1bmN0aW9uIGluaXRNYXJrZXIoJG1hcmtlciwgbWFwKSB7XG4gICAgLy8gR2V0IHBvc2l0aW9uIGZyb20gbWFya2VyLlxuICAgIHZhciBsYXQgPSAkbWFya2VyLmRhdGEoJ2xhdCcpO1xuICAgIHZhciBsbmcgPSAkbWFya2VyLmRhdGEoJ2xuZycpO1xuICAgICQoXCIjbGF0aXR1ZF9wcm9wXCIpLnZhbChsYXQpOyAvL1NldCBpbnB1dCBsYXRcblxuICAgICQoXCIjbG9uZ2l0dWRfcHJvcFwiKS52YWwobG5nKTsgLy9TZXQgaW5wdXQgbG5nXG5cbiAgICB2YXIgbGF0TG5nID0ge1xuICAgICAgbGF0OiBwYXJzZUZsb2F0KGxhdCksXG4gICAgICBsbmc6IHBhcnNlRmxvYXQobG5nKVxuICAgIH07IC8vIENyZWF0ZSBtYXJrZXIgaW5zdGFuY2UuXG5cbiAgICB2YXIgbWFya2VyID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlcih7XG4gICAgICBwb3NpdGlvbjogbGF0TG5nLFxuICAgICAgaWNvbjogXCIuLi8uLi93cC1jb250ZW50L3RoZW1lcy9kb2N0b3JwZWRpYS9pbWcvYXV0aG9ycy9tYXJrZXItcHJlbWl1bS5zdmdcIixcbiAgICAgIG1hcDogbWFwXG4gICAgfSk7IC8vIEFwcGVuZCB0byByZWZlcmVuY2UgZm9yIGxhdGVyIHVzZS5cblxuICAgIG1hcC5tYXJrZXJzLnB1c2gobWFya2VyKTsgLy8gSWYgbWFya2VyIGNvbnRhaW5zIEhUTUwsIGFkZCBpdCB0byBhbiBpbmZvV2luZG93LlxuXG4gICAgaWYgKCRtYXJrZXIuaHRtbCgpKSB7XG4gICAgICAvLyBDcmVhdGUgaW5mbyB3aW5kb3cuXG4gICAgICB2YXIgaW5mb3dpbmRvdyA9IG5ldyBnb29nbGUubWFwcy5JbmZvV2luZG93KHtcbiAgICAgICAgY29udGVudDogJG1hcmtlci5odG1sKClcbiAgICAgIH0pOyAvLyBTaG93IGluZm8gd2luZG93IHdoZW4gbWFya2VyIGlzIGNsaWNrZWQuXG5cbiAgICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICBpbmZvd2luZG93Lm9wZW4obWFwLCBtYXJrZXIpO1xuICAgICAgfSk7XG4gICAgfVxuICB9XG4gIC8qKlxuICAgKiBjZW50ZXJNYXBcbiAgICpcbiAgICogQ2VudGVycyB0aGUgbWFwIHNob3dpbmcgYWxsIG1hcmtlcnMgaW4gdmlldy5cbiAgICpcbiAgICogQGRhdGUgICAgMjIvMTAvMTlcbiAgICogQHNpbmNlICAgNS44LjZcbiAgICpcbiAgICogQHBhcmFtICAgb2JqZWN0IFRoZSBtYXAgaW5zdGFuY2UuXG4gICAqIEByZXR1cm4gIHZvaWRcbiAgICovXG5cblxuICBmdW5jdGlvbiBjZW50ZXJNYXAobWFwKSB7XG4gICAgLy8gQ3JlYXRlIG1hcCBib3VuZGFyaWVzIGZyb20gYWxsIG1hcCBtYXJrZXJzLlxuICAgIHZhciBib3VuZHMgPSBuZXcgZ29vZ2xlLm1hcHMuTGF0TG5nQm91bmRzKCk7XG4gICAgbWFwLm1hcmtlcnMuZm9yRWFjaChmdW5jdGlvbiAobWFya2VyKSB7XG4gICAgICBib3VuZHMuZXh0ZW5kKHtcbiAgICAgICAgbGF0OiBtYXJrZXIucG9zaXRpb24ubGF0KCksXG4gICAgICAgIGxuZzogbWFya2VyLnBvc2l0aW9uLmxuZygpXG4gICAgICB9KTtcbiAgICB9KTsgLy8gQ2FzZTogU2luZ2xlIG1hcmtlci5cblxuICAgIGlmIChtYXAubWFya2Vycy5sZW5ndGggPT0gMSkge1xuICAgICAgbWFwLnNldENlbnRlcihib3VuZHMuZ2V0Q2VudGVyKCkpOyAvLyBDYXNlOiBNdWx0aXBsZSBtYXJrZXJzLlxuICAgIH0gZWxzZSB7XG4gICAgICBtYXAuZml0Qm91bmRzKGJvdW5kcyk7XG4gICAgfVxuICB9XG5cbiAgZnVuY3Rpb24gc2VhcmNoSW5wdXQobWFwKSB7XG4gICAgdmFyIGlucHV0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2pzLWdvb2dsZS1zZWFyY2gnKTtcbiAgICB2YXIgc2VhcmNoQm94ID0gbmV3IGdvb2dsZS5tYXBzLnBsYWNlcy5TZWFyY2hCb3goaW5wdXQpO1xuICAgIG1hcC5jb250cm9sc1tnb29nbGUubWFwcy5Db250cm9sUG9zaXRpb24uVE9QX0xFRlRdLnB1c2goaW5wdXQpOyAvLyBCaWFzIHRoZSBTZWFyY2hCb3ggcmVzdWx0cyB0b3dhcmRzIGN1cnJlbnQgbWFwJ3Mgdmlld3BvcnQuXG5cbiAgICBtYXAuYWRkTGlzdGVuZXIoJ2JvdW5kc19jaGFuZ2VkJywgZnVuY3Rpb24gKCkge1xuICAgICAgc2VhcmNoQm94LnNldEJvdW5kcyhtYXAuZ2V0Qm91bmRzKCkpO1xuICAgIH0pO1xuICAgIHZhciBtYXJrZXJzID0gW107IC8vIFtTVEFSVCByZWdpb25fZ2V0cGxhY2VzXVxuICAgIC8vIExpc3RlbiBmb3IgdGhlIGV2ZW50IGZpcmVkIHdoZW4gdGhlIHVzZXIgc2VsZWN0cyBhIHByZWRpY3Rpb24gYW5kIHJldHJpZXZlXG4gICAgLy8gbW9yZSBkZXRhaWxzIGZvciB0aGF0IHBsYWNlLlxuXG4gICAgc2VhcmNoQm94LmFkZExpc3RlbmVyKCdwbGFjZXNfY2hhbmdlZCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBwbGFjZXMgPSBzZWFyY2hCb3guZ2V0UGxhY2VzKCk7XG5cbiAgICAgIGlmIChwbGFjZXMubGVuZ3RoID09IDApIHtcbiAgICAgICAgcmV0dXJuO1xuICAgICAgfSAvLyBDbGVhciBvdXQgdGhlIG9sZCBtYXJrZXJzLlxuXG5cbiAgICAgIG1hcmtlcnMuZm9yRWFjaChmdW5jdGlvbiAobWFya2VyKSB7XG4gICAgICAgIG1hcmtlci5zZXRNYXAobnVsbCk7XG4gICAgICB9KTtcbiAgICAgIG1hcmtlcnMgPSBbXTsgLy8gRm9yIGVhY2ggcGxhY2UsIGdldCB0aGUgaWNvbiwgbmFtZSBhbmQgbG9jYXRpb24uXG5cbiAgICAgIHZhciBib3VuZHMgPSBuZXcgZ29vZ2xlLm1hcHMuTGF0TG5nQm91bmRzKCk7XG4gICAgICBwbGFjZXMuZm9yRWFjaChmdW5jdGlvbiAocGxhY2UpIHtcbiAgICAgICAgLy8gQ3JlYXRlIGEgbWFya2VyIGZvciBlYWNoIHBsYWNlLlxuICAgICAgICBtYXJrZXJzLnB1c2gobmV3IGdvb2dsZS5tYXBzLk1hcmtlcih7XG4gICAgICAgICAgbWFwOiBtYXAsXG4gICAgICAgICAgaWNvbjogXCIuLi8uLi93cC1jb250ZW50L3RoZW1lcy9kb2N0b3JwZWRpYS9pbWcvYXV0aG9ycy9tYXJrZXItcHJlbWl1bS5zdmdcIixcbiAgICAgICAgICB0aXRsZTogcGxhY2UubmFtZSxcbiAgICAgICAgICBwb3NpdGlvbjogcGxhY2UuZ2VvbWV0cnkubG9jYXRpb25cbiAgICAgICAgfSkpO1xuICAgICAgICB2YXIgY29tcG9uZW50Rm9ybSA9IHtcbiAgICAgICAgICBzdHJlZXRfbnVtYmVyOiBcInNob3J0X25hbWVcIixcbiAgICAgICAgICByb3V0ZTogXCJsb25nX25hbWVcIixcbiAgICAgICAgICBsb2NhbGl0eTogXCJsb25nX25hbWVcIixcbiAgICAgICAgICBhZG1pbmlzdHJhdGl2ZV9hcmVhX2xldmVsXzE6IFwic2hvcnRfbmFtZVwiLFxuICAgICAgICAgIGNvdW50cnk6IFwibG9uZ19uYW1lXCIsXG4gICAgICAgICAgcG9zdGFsX2NvZGU6IFwic2hvcnRfbmFtZVwiXG4gICAgICAgIH07XG5cbiAgICAgICAgdmFyIF9pdGVyYXRvciA9IF9jcmVhdGVGb3JPZkl0ZXJhdG9ySGVscGVyKHBsYWNlLmFkZHJlc3NfY29tcG9uZW50cyksXG4gICAgICAgICAgICBfc3RlcDtcblxuICAgICAgICB0cnkge1xuICAgICAgICAgIGZvciAoX2l0ZXJhdG9yLnMoKTsgIShfc3RlcCA9IF9pdGVyYXRvci5uKCkpLmRvbmU7KSB7XG4gICAgICAgICAgICB2YXIgY29tcG9uZW50ID0gX3N0ZXAudmFsdWU7XG4gICAgICAgICAgICB2YXIgYWRkcmVzc1R5cGUgPSBjb21wb25lbnQudHlwZXNbMF07XG5cbiAgICAgICAgICAgIGlmIChjb21wb25lbnRGb3JtW2FkZHJlc3NUeXBlXSkge1xuICAgICAgICAgICAgICB2YXIgdmFsID0gY29tcG9uZW50W2NvbXBvbmVudEZvcm1bYWRkcmVzc1R5cGVdXTtcblxuICAgICAgICAgICAgICBpZiAoYWRkcmVzc1R5cGUgPT0gJ2xvY2FsaXR5Jykge1xuICAgICAgICAgICAgICAgICQoXCIjY2l0eV9wcm9wXCIpLnZhbCh2YWwpOyAvL3NldCBpbnB1dCBDaXR5XG4gICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICBpZiAoYWRkcmVzc1R5cGUgPT0gJ2FkbWluaXN0cmF0aXZlX2FyZWFfbGV2ZWxfMScpIHtcbiAgICAgICAgICAgICAgICAkKFwiI3N0YXRlX3Byb3BcIikudmFsKHZhbCk7IC8vc2V0IGlucHV0IFN0YXRlXG4gICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICBpZiAoYWRkcmVzc1R5cGUgPT0gJ2NvdW50cnknKSB7XG4gICAgICAgICAgICAgICAgJChcIiNjb3VudHJ5X3Byb3BcIikudmFsKHZhbCk7IC8vc2V0IGlucHV0IFN0YXRlXG4gICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgIH0gY2F0Y2ggKGVycikge1xuICAgICAgICAgIF9pdGVyYXRvci5lKGVycik7XG4gICAgICAgIH0gZmluYWxseSB7XG4gICAgICAgICAgX2l0ZXJhdG9yLmYoKTtcbiAgICAgICAgfVxuXG4gICAgICAgICQoXCIjbGF0aXR1ZF9wcm9wXCIpLnZhbChwbGFjZS5nZW9tZXRyeS5sb2NhdGlvbi5sYXQpOyAvL3NldCBpbnB1dCBsYXRcblxuICAgICAgICAkKFwiI2xvbmdpdHVkX3Byb3BcIikudmFsKHBsYWNlLmdlb21ldHJ5LmxvY2F0aW9uLmxuZyk7IC8vc2V0IGlucHV0IGxuZ1xuXG4gICAgICAgIGlmIChwbGFjZS5nZW9tZXRyeS52aWV3cG9ydCkge1xuICAgICAgICAgIC8vIE9ubHkgZ2VvY29kZXMgaGF2ZSB2aWV3cG9ydC5cbiAgICAgICAgICBib3VuZHMudW5pb24ocGxhY2UuZ2VvbWV0cnkudmlld3BvcnQpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIGJvdW5kcy5leHRlbmQocGxhY2UuZ2VvbWV0cnkubG9jYXRpb24pO1xuICAgICAgICB9XG4gICAgICB9KTtcbiAgICAgIG1hcC5maXRCb3VuZHMoYm91bmRzKTtcbiAgICB9KTtcbiAgfSAvLyBSZW5kZXIgbWFwcyBvbiBwYWdlIGxvYWQuXG5cblxuICAkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gICAgJCgnLmFjZi1tYXAnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBtYXAgPSBpbml0TWFwKCQodGhpcykpO1xuICAgIH0pO1xuICB9KTtcbn0pKGpRdWVyeSk7XG5cbiQoJyNqcy1nb29nbGUtc2VhcmNoJykua2V5cHJlc3MoZnVuY3Rpb24gKGUpIHtcbiAgcmV0dXJuIGUua2V5Q29kZSAhPSAxMztcbn0pO1xuLyoqXG4gKiBBY3RpdmUgQ1RBIHBvc3RzXG4gKi9cblxudmFyIGFjdGl2ZUNUQSA9IGZ1bmN0aW9uIGFjdGl2ZUNUQShlbGVtKSB7XG4gIHZhciBjdGEgPSBlbGVtLm5leHRTaWJsaW5nO1xuICBjdGEubmV4dEVsZW1lbnRTaWJsaW5nLmNsYXNzTGlzdC50b2dnbGUoJ2Qtbm9uZScpO1xufTtcbi8qKlxuICogRGVsZXRlIFBvc3RcbiAqL1xuXG5cbmZ1bmN0aW9uIGRlbGV0ZVBvc3RQcm9maWxlKGVsZW0pIHtcbiAgJCgnI2pzLW1vZGFsLWRlbGV0ZS1wb3N0JykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAkKCcjanMtZGVsZXRlLXZlcmlmaWVkJykuYXR0cignZGF0YS1pZCcsICQoZWxlbSkuYXR0cignZGF0YS1pZCcpKTtcbn1cbi8qKlxuICogRGVsZXRlIFBvc3RcbiAqL1xuXG5cbiQoJyNqcy1kZWxldGUtdmVyaWZpZWQnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gIHZhciBwb3N0X2lkID0gJCh0aGlzKS5hdHRyKCdkYXRhLWlkJyk7XG4gICQoJyNqcy1tb2RhbC1kZWxldGUtcG9zdCcpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgdmFyIGZvcm1EYXRhID0gbmV3IEZvcm1EYXRhKCk7XG4gIGZvcm1EYXRhLmFwcGVuZCgnYWN0aW9uJywgJ2RlbGV0ZV9wb3N0Jyk7XG4gIGZvcm1EYXRhLmFwcGVuZCgncG9zdF9pZCcsIHBvc3RfaWQpO1xuICBqUXVlcnkuYWpheCh7XG4gICAgY2FjaGU6IGZhbHNlLFxuICAgIHVybDogcHBfdmFycy5hamF4dXJsLFxuICAgIHR5cGU6ICdQT1NUJyxcbiAgICBkYXRhOiBmb3JtRGF0YSxcbiAgICBjb250ZW50VHlwZTogZmFsc2UsXG4gICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgIGJlZm9yZVNlbmQ6IGZ1bmN0aW9uIGJlZm9yZVNlbmQoKSB7XG4gICAgICAkKCcjanMtY3RhLWNvbnRhaW5lcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICQoJyNwb3N0XycgKyBwb3N0X2lkKS5jc3MoJ2JhY2tncm91bmQtY29sb3InLCAncmdiYSgyNTUsMCwwLCAwLjIpJyk7XG4gICAgICAkKCcjcG9zdF8nICsgcG9zdF9pZCkuaGlkZSgnc2xvdycpO1xuICAgIH0sXG4gICAgc3VjY2VzczogZnVuY3Rpb24gc3VjY2VzcyhyZXNwb25zZSkge1xuICAgICAgJCgnI3Bvc3RfJyArIHBvc3RfaWQpLnJlbW92ZSgpO1xuICAgIH1cbiAgfSk7XG59KTtcbi8qKlxuICogQ2FuY2VsIGRlbGV0IHBvc3RcbiAqL1xuXG5mdW5jdGlvbiBjYW5jZWxEZWxldGVQb3N0KCkge1xuICAkKCcjanMtbW9kYWwtZGVsZXRlLXBvc3QnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICQoJyNqcy1jdGEtY29udGFpbmVyJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xufVxuLyoqXG4gKiBGZWF0dXJlIHBvc3RcbiAqL1xuXG5cbmZ1bmN0aW9uIGZlYXR1cmVQb3N0UHJvZmlsZShlbGVtKSB7XG4gIHZhciBwb3N0X2lkID0gJChlbGVtKS5hdHRyKCdkYXRhLWlkJyk7XG4gIHZhciBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuICBmb3JtRGF0YS5hcHBlbmQoJ2FjdGlvbicsICdmZWF0dXJlX3Bvc3QnKTtcbiAgZm9ybURhdGEuYXBwZW5kKCdwb3N0X2lkJywgcG9zdF9pZCk7XG4gIGpRdWVyeS5hamF4KHtcbiAgICBjYWNoZTogZmFsc2UsXG4gICAgdXJsOiBwcF92YXJzLmFqYXh1cmwsXG4gICAgdHlwZTogJ1BPU1QnLFxuICAgIGRhdGE6IGZvcm1EYXRhLFxuICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcbiAgICBwcm9jZXNzRGF0YTogZmFsc2UsXG4gICAgYmVmb3JlU2VuZDogZnVuY3Rpb24gYmVmb3JlU2VuZCgpIHtcbiAgICAgICQoZWxlbSkuY3NzKHtcbiAgICAgICAgJ2NvbG9yJzogJyM0MWI4ODMnXG4gICAgICB9KTtcbiAgICB9LFxuICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIHN1Y2Nlc3MocmVzcG9uc2UpIHtcbiAgICAgICQoXCIjanMtZmlyc3QtY29sdW1uLXByZW1pdW1cIikubG9hZCgkKGxvY2F0aW9uKS5hdHRyKFwiaHJlZlwiKSArICcgI2pzLWZpcnN0LWNvbHVtbi1wcmVtaXVtJyk7XG4gICAgfVxuICB9KTtcbn1cbi8qKlxuICogQ29weSBwb3N0XG4gKi9cblxuXG5mdW5jdGlvbiBjb3B5UG9zdFByb2ZpbGUobGluaykge1xuICB2YXIgJHRlbXAgPSAkKFwiPGlucHV0PlwiKTtcbiAgJChcImJvZHlcIikuYXBwZW5kKCR0ZW1wKTtcbiAgJHRlbXAudmFsKCQobGluaykuYXR0cignZGF0YS1saW5rJykpLnNlbGVjdCgpO1xuICAkKGxpbmspLmNzcyh7XG4gICAgJ2NvbG9yJzogJyM0MWI4ODMnXG4gIH0pO1xuICAkKCcuY3VzdG9tLWl0ZW0tY29weScpLmNzcyh7XG4gICAgJ2JhY2tncm91bmQtY29sb3InOiAnIzQxYjg4MydcbiAgfSk7IC8vIFNpbmdsZSBWaWRlb3MgUGFnZVxuXG4gICQoXCIucG9zdC1zaGFyZS10aXRsZVwiKS5hcHBlbmQoJyA8c3BhbiBjbGFzcz1cInRleHQtc3VjY2Vzc1wiPkxpbmsgY29waWVkITwvc3Bhbj4nKTtcbiAgZG9jdW1lbnQuZXhlY0NvbW1hbmQoXCJjb3B5XCIpO1xuICAkdGVtcC5yZW1vdmUoKTtcbn1cbi8qKlxuICogRGV0ZWN0IHBhc3RlIGxpbmtcbiAqL1xuXG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgJChcIiNwdWJsaXNoX2NvbnRlbnRcIikuYmluZCh7XG4gICAgcGFzdGU6IGZ1bmN0aW9uIHBhc3RlKCkge1xuICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciBvYmpfY29udGVudCA9ICQoJyNwdWJsaXNoX2NvbnRlbnQnKS52YWwoKTtcblxuICAgICAgICBpZiAob2JqX2NvbnRlbnQudHJpbSgpID09ICcnKSB7XG4gICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICB9XG5cbiAgICAgICAgdmFyIGZvcm1EYXRhID0gbmV3IEZvcm1EYXRhKCk7XG4gICAgICAgIGZvcm1EYXRhLmFwcGVuZCgnYWN0aW9uJywgJ2dldF9TaXRlX09HJyk7XG4gICAgICAgIGZvcm1EYXRhLmFwcGVuZCgncHVibGlzaF9jb250ZW50Jywgb2JqX2NvbnRlbnQpO1xuICAgICAgICBqUXVlcnkuYWpheCh7XG4gICAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICAgIHVybDogYm1zX3ZhcnMuYWpheHVybCxcbiAgICAgICAgICB0eXBlOiAnUE9TVCcsXG4gICAgICAgICAgZGF0YTogZm9ybURhdGEsXG4gICAgICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgICAgIHByb2Nlc3NEYXRhOiBmYWxzZSxcbiAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiBzdWNjZXNzKHJlc3BvbnNlKSB7XG4gICAgICAgICAgICBpZiAocmVzcG9uc2Uuc3RhdHVzID09ICdzdWNjZXNzJykge1xuICAgICAgICAgICAgICAkKCcjcHVibGlzaC1jb250ZW50JykuaHRtbCgnPGRpdiBjbGFzcz1cImV4dGVybmFsLWNvbnRlbnQtZGVsZXRlXCIgb25jbGljaz1cImRlbGV0ZV9leHRlcm5hbF9jb250ZW50X3ByZXZpZXcoKVwiPjxpbWcgc3JjPVwiL3dwLWNvbnRlbnQvdGhlbWVzL2RvY3RvcnBlZGlhL2ltZy9pY29ucy9zaGFyZS1yZXBvc3QtY2xvc2Uuc3ZnXCI+PC9kaXY+JyArIHJlc3BvbnNlLmh0bWwpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICB9LCAxMDAwKTtcbiAgICB9XG4gICAgLyogY29weSA6IGZ1bmN0aW9uKCl7XG4gICAgICAgIGFsZXJ0KCfCoUhhcyBjb3BpYWRvIScpO1xuICAgIH0sXG4gICAgY3V0IDogZnVuY3Rpb24oKXtcbiAgICAgICAgYWxlcnQoJ8KhSGFzIGNvcnRhZG8hJyk7XG4gICAgfSAqL1xuXG4gIH0pO1xufSk7XG4vKipcbiAqIENvdW50IENoYXJhY3RlcnNcbiAqL1xuXG5mdW5jdGlvbiBjb3VudENoYXJzKG9iaikge1xuICB2YXIgbWF4TGVuZ3RoID0gNTAwO1xuICB2YXIgc3RyTGVuZ3RoID0gb2JqLnZhbHVlLmxlbmd0aDtcblxuICBpZiAoc3RyTGVuZ3RoID49IG1heExlbmd0aCkge1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiY2hhck51bVwiKS5pbm5lckhUTUwgPSAnPHNwYW4gY2xhc3M9XCJ0ZXh0LWRhbmdlciB0ZXh0LW1pblwiPicgKyBzdHJMZW5ndGggKyAnIG91dCBvZiAnICsgbWF4TGVuZ3RoICsgJyBjaGFyYWN0ZXJzPC9zcGFuPic7XG4gICAgJChvYmopLnZhbCgkKG9iaikudmFsKCkuc3Vic3RyaW5nKDAsIG1heExlbmd0aCkpO1xuICAgIHJldHVybiBmYWxzZTtcbiAgfSBlbHNlIHtcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImNoYXJOdW1cIikuaW5uZXJIVE1MID0gc3RyTGVuZ3RoICsgJyBvdXQgb2YgJyArIG1heExlbmd0aCArICcgY2hhcmFjdGVycyc7XG4gIH1cbn1cbi8qKlxuICogQWN0aXZlIFRhYnMgYnkgaGFzaHRhZyB1cmxcbiAqL1xuXG5cbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICB2YXIgYnJhbmQgPSBmYWxzZTtcblxuICBpZiAod2luZG93LmxvY2F0aW9uLmhhc2ggJiYgIWJyYW5kKSB7XG4gICAgdmFyIGhhc2ggPSB3aW5kb3cubG9jYXRpb24uaGFzaC5yZXBsYWNlKCcjJywgJycpO1xuICAgIHZhciBhdXRob3JfaWQgPSAkKFwiI2pzLWF1dGhvcl9fbmF2XCIpLmF0dHIoXCJkYXRhLWlkXCIpO1xuICAgIGFjdGl2ZVRhYihoYXNoKTtcbiAgICAkKHdpbmRvdykuc2Nyb2xsVG9wKDApO1xuICAgIGJyYW5kID0gdHJ1ZTtcbiAgICBpZiAoaGFzaCA9PT0gXCJhY3Rpdml0eVwiKSByZXR1cm4gZmFsc2U7XG4gICAgbG9hZF9wb3N0c19jYXRlZyhhdXRob3JfaWQsIGhhc2gpO1xuICB9XG5cbiAgJCh3aW5kb3cpLm9mZignc2Nyb2xsJyk7XG59KTtcbi8qKlxuICogQWRkIEFyZWEgb2YgRXhwZXJ0aXNlXG4gKi9cblxuZnVuY3Rpb24gYWRkRXhwZXJ0aXNlSXRlbSgpIHtcbiAgdmFyIGV4cGVydGlzZSA9ICQoJyN1c2VyX2V4cGVydGlzZScpLnZhbCgpO1xuICB2YXIgZXhwZXJ0aXNlX3NsdWcgPSBleHBlcnRpc2UucmVwbGFjZSgvIC9nLCBcIi1cIikucmVwbGFjZSgvW1wiJygpXS9nLCBcIlwiKTtcbiAgdmFyIGh0bWwgPSAnJztcblxuICBpZiAoZXhwZXJ0aXNlICYmIGV4cGVydGlzZSAhPT0gJ25vbmUnICYmIGV4cGVydGlzZSAhPT0gJ251bGwnKSB7XG4gICAgaHRtbCArPSAnPGxpIGlkPVwiJyArIGV4cGVydGlzZV9zbHVnICsgJ1wiICBjbGFzcz1cImQtZmxleCBmbGV4LXJvdyBjaGVja19leHBlcnRpc2VcIj4nO1xuICAgIGh0bWwgKz0gJzxkaXYgY2xhc3M9XCJib3gtZWR1Y2F0aW9uIGJveC1lZHVjYXRpb24tcHVycGxlIGQtZmxleCBmbGV4LXJvd1wiPicgKyBleHBlcnRpc2UgKyAnPGlucHV0IHR5cGU9XCJoaWRkZW5cIiB2YWx1ZT1cIicgKyBleHBlcnRpc2UgKyAnXCIgY2xhc3M9XCJpdGVtX2VkdWNhdGlvblwiPjxkaXYgb25jbGljaz1cImRlbGV0ZUV4cGVydGlzZUl0ZW0odGhpcyk7XCI+PGltZyBzcmM9XCIvd3AtY29udGVudC9wbHVnaW5zL2Jsb2dnaW5nLXBsYXRmb3JtL2Fzc2V0cy9pbWcvZGVsZXRlLXgtaWNvbi5zdmdcIiAvPjwvZGl2PjwvZGl2Pic7XG4gIH1cblxuICBodG1sICs9ICc8L2xpPic7XG4gICQoJyNqcy1saXN0LWV4cGVydGlzZScpLmFwcGVuZChodG1sKTtcbiAgJCgnI3VzZXJfZXhwZXJ0aXNlJykudmFsKCcnKTtcbn1cblxuZnVuY3Rpb24gZGVsZXRlRXhwZXJ0aXNlSXRlbShvYmopIHtcbiAgdmFyIGVsZW0gPSBvYmo7XG4gICQoZWxlbSkucGFyZW50KCkucGFyZW50KCkucmVtb3ZlKCk7XG59XG4vKipcbiAqIFNlZSBtb3JlIC0gQXJlYSBvZiBFeHBlcnRpc2VcbiAqL1xuXG5cbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICB2YXIgaXRlbXMgPSAkKCcjanMtZXhwZXJ0aXNlcyB1bCBsaScpO1xuXG4gIGlmICgkKHdpbmRvdykud2lkdGgoKSA+IDc2OCkge1xuICAgIGlmIChpdGVtcy5sZW5ndGggPiAzKSB7XG4gICAgICBzaG93TGVzc0l0ZW1zKCk7XG4gICAgfVxuICB9XG59KTtcbi8qKlxuICogQWN0aXZlIGxhc3QgaXRlbXMgLSBBcmVhIG9mIEV4cGVydGlzZVxuICovXG5cbmZ1bmN0aW9uIHNob3dNb3JlSXRlbXMoKSB7XG4gIHZhciBpdGVtcyA9ICQoJyNqcy1leHBlcnRpc2VzIHVsIGxpJyk7XG4gICQuZWFjaChpdGVtcywgZnVuY3Rpb24gKGluZGV4LCB2YWx1ZSkge1xuICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICB9KTtcbiAgJCgnI2pzLXNlZS1tb3JlLWV4cGVydGlzZScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXNlZS1sZXNzLWV4cGVydGlzZScpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbn1cbi8qKlxuICogQWN0aXZlIGxhc3QgaXRlbXMgLSBBcmVhIG9mIEV4cGVydGlzZVxuICovXG5cblxuZnVuY3Rpb24gc2hvd0xlc3NJdGVtcygpIHtcbiAgdmFyIGl0ZW1zID0gJCgnI2pzLWV4cGVydGlzZXMgdWwgbGknKTtcbiAgJC5lYWNoKGl0ZW1zLCBmdW5jdGlvbiAoaW5kZXgsIHZhbHVlKSB7XG4gICAgaWYgKGluZGV4ID4gMikge1xuICAgICAgJCh0aGlzKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgfVxuICB9KTtcbiAgJCgnI2pzLXNlZS1tb3JlLWV4cGVydGlzZScpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgJCgnI2pzLXNlZS1sZXNzLWV4cGVydGlzZScpLmFkZENsYXNzKCdkLW5vbmUnKTtcbn1cbi8qKlxuICogVG9nZ2xlIFNwZWNpYWx0aWVzIC0gUHVibGljIFByb2ZpbGVcbiAqL1xuXG5cbmZ1bmN0aW9uIHRvZ2dsZVNwZWNpYWx0aWVzUG9wdXAoKSB7XG4gICQoJy5hdXRob3JfX3Byb2ZpbGUtY29udGFpbmVyJykudG9nZ2xlKCk7XG4gICQoJyN0b2dnbGVJbWcnKS50b2dnbGVDbGFzcygnVG9nZ2xlQWN0aXZlJyk7XG59XG4vKipcbiAqIEhpZGUgZm9vdGJhciBvbiBzY3JvbGwgZmluYWwgcGFnZVxuICovXG5cblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAkKHdpbmRvdykub24oJ3Njcm9sbCcsIGZ1bmN0aW9uICgpIHtcbiAgICAvLyBFdmVudG8gZGUgU2Nyb2xsXG4gICAgaWYgKCQod2luZG93KS5zY3JvbGxUb3AoKSArICQod2luZG93KS5oZWlnaHQoKSA9PSAkKGRvY3VtZW50KS5oZWlnaHQoKSkge1xuICAgICAgLy8gU2kgZXN0YW1vcyBhbCBmaW5hbCBkZSBsYSBww6FnaW5hXG4gICAgICAkKCcub2N1bHRhcicpLnN0b3AodHJ1ZSkuYW5pbWF0ZSh7XG4gICAgICAgIC8vIEVzY29uZGVtb3MgZWwgZGl2XG4gICAgICAgIG9wYWNpdHk6IDBcbiAgICAgIH0sIDUwKTtcbiAgICB9IGVsc2Uge1xuICAgICAgLy8gU2kgbm9cbiAgICAgICQoJy5vY3VsdGFyJykuc3RvcCh0cnVlKS5hbmltYXRlKHtcbiAgICAgICAgLy8gTW9zdHJhbW9zIGVsIGRpdlxuICAgICAgICBvcGFjaXR5OiAxXG4gICAgICB9LCAxMCk7XG4gICAgfVxuICB9KTtcbn0pO1xuLyoqXG4gKiBMb2FkIE1vcmUgUG9zdCBBY3Rpdml0eVxuICovXG5cbnZhciBwcHAgPSAxMDtcbnZhciBwYWdlTnVtYmVyID0gMTtcblxuZnVuY3Rpb24gbG9hZF9wb3N0cyhhdXRob3JfaWQpIHtcbiAgcGFnZU51bWJlcisrO1xuICAkKCcjbW9yZV9wb3N0cycpLmh0bWwoJzxpIGNsYXNzPVwiZmEgZmEtc3Bpbm5lciBmYS1zcGluXCI+PC9pPicpOyAvL0FwaSByZXN0IGNhbGxcblxuICB2YXIgeG1saHR0cCA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpO1xuICB4bWxodHRwLm9wZW4oJ0dFVCcsIFwiXCIuY29uY2F0KHdpbmRvdy5sb2NhdGlvbi5vcmlnaW4sIFwiL3dwLWpzb24vZG9jdG9ycGVkaWEvdjIvcHJvZmlsZS1sb2FkLWNvbnRlbnQ/cHBwPVwiKS5jb25jYXQocHBwLCBcIiZhdXRob3JfaWQ9XCIpLmNvbmNhdChhdXRob3JfaWQsIFwiJnBhZ2VOdW1iZXI9XCIpLmNvbmNhdChwYWdlTnVtYmVyKSwgdHJ1ZSk7XG5cbiAgeG1saHR0cC5vbnJlYWR5c3RhdGVjaGFuZ2UgPSBmdW5jdGlvbiAoKSB7XG4gICAgaWYgKHhtbGh0dHAucmVhZHlTdGF0ZSA9PSA0KSB7XG4gICAgICBpZiAoeG1saHR0cC5zdGF0dXMgPT0gMjAwKSB7XG4gICAgICAgIC8vUmVzIGNvbnRlbnRcbiAgICAgICAgdmFyIG9iaiA9IEpTT04ucGFyc2UoeG1saHR0cC5yZXNwb25zZVRleHQpO1xuICAgICAgICB2YXIgZGF0YSA9IG9iai5kYXRhLmh0bWw7XG4gICAgICAgIHZhciBjb3VudCA9IG9iai5kYXRhLmNvdW50O1xuICAgICAgICB2YXIgdG90YWwgPSBvYmouZGF0YS50b3RhbDtcbiAgICAgICAgY29uc29sZS5sb2coY291bnQsIHRvdGFsKTtcblxuICAgICAgICBpZiAodG90YWwgIT09IDApIHtcbiAgICAgICAgICAkKFwiI2FqYXgtcG9zdHNcIikuYXBwZW5kKGRhdGEpO1xuXG4gICAgICAgICAgaWYgKHBhcnNlSW50KGNvdW50KSA9PSAxMCAmJiBwYXJzZUludCh0b3RhbCkgPiAxMCkge1xuICAgICAgICAgICAgJCgnI21vcmVfcG9zdHMnKS5odG1sKCdMb2FkIE1vcmUnKTtcbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnI21vcmVfcG9zdHMnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgfVxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICQoJy5zcGluLWxvYWRlcicpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICAkKCcjbW9yZV9wb3N0cycpLmh0bWwoJzxpIGNsYXNzPVwiZmEgZmEtY2hlY2tcIj48L2k+Jyk7XG4gICAgICAgICAgJCgnI21vcmVfcG9zdHMnKS5hZGRDbGFzcygnY29tcGxldGUtcGFnaW5hdGlvbicpO1xuICAgICAgICAgICQoJyNtb3JlX3Bvc3RzJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICB9XG4gICAgICB9XG4gICAgfVxuICB9O1xuXG4gIHhtbGh0dHAuc2VuZChudWxsKTtcbn0gLy8gTG9hZCBNb3JlIEFjdGl2aXR5IEJ1dHRvbiBDbGljayBFdmVudFxuXG5cbiQoXCIjbW9yZV9wb3N0c1wiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgLy8gV2hlbiBidG4gaXMgcHJlc3NlZC5cbiAgdmFyIGF1dGhvcl9pZCA9ICQoXCIjanMtYXV0aG9yX19uYXZcIikuYXR0cihcImRhdGEtaWRcIik7XG4gIGxvYWRfcG9zdHMoYXV0aG9yX2lkKTtcbn0pO1xuLyoqXG4gKiBMb2FkIE1vcmUgUG9zdCBDYXRlZ29yaWVzXG4gKi9cblxuZnVuY3Rpb24gbG9hZF9wb3N0c19jYXRlZyhhdXRob3JfaWQpIHtcbiAgdmFyIGNhdGVnb3J5ID0gYXJndW1lbnRzLmxlbmd0aCA+IDEgJiYgYXJndW1lbnRzWzFdICE9PSB1bmRlZmluZWQgPyBhcmd1bWVudHNbMV0gOiBmYWxzZTtcbiAgdmFyIHBhZ2VOdW1iZXJDYXRlZ29yeSA9IGFyZ3VtZW50cy5sZW5ndGggPiAyICYmIGFyZ3VtZW50c1syXSAhPT0gdW5kZWZpbmVkID8gYXJndW1lbnRzWzJdIDogZmFsc2U7XG5cbiAgaWYgKCFwYWdlTnVtYmVyQ2F0ZWdvcnkpIHtcbiAgICBwYWdlTnVtYmVyQ2F0ZWdvcnkgPSAwO1xuICB9XG5cbiAgJChcIiNqcy1wbGFjZWhvbGRlci1cIiArIGNhdGVnb3J5KS5hZGRDbGFzcygnZC1ub25lJyk7XG5cbiAgaWYgKHBhZ2VOdW1iZXJDYXRlZ29yeSA+IDApIHtcbiAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmh0bWwoJzxpIGNsYXNzPVwiZmEgZmEtc3Bpbm5lciBmYS1zcGluXCI+PC9pPicpO1xuICB9IGVsc2Uge1xuICAgICQoXCIjYWpheC1wb3N0cy1cIiArIGNhdGVnb3J5KS5odG1sKCc8aW1nIHNyYz1cIi93cC1jb250ZW50L3RoZW1lcy9kb2N0b3JwZWRpYS9pbWcvU3Bpbi0xcy0yMDBweC5naWZcIiB3aWR0aD1cIjUwcHhcIiBjbGFzcz1cInNwaW4tbG9hZGVyIG1iLTVcIj48YnI+Jyk7XG4gIH0gLy9BcGkgcmVzdCBjYWxsXG5cblxuICB2YXIgeG1saHR0cCA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpO1xuICB4bWxodHRwLm9wZW4oJ0dFVCcsIFwiXCIuY29uY2F0KHdpbmRvdy5sb2NhdGlvbi5vcmlnaW4sIFwiL3dwLWpzb24vZG9jdG9ycGVkaWEvdjIvcHJvZmlsZS1sb2FkLWNvbnRlbnQ/cHBwPVwiKS5jb25jYXQocHBwLCBcIiZhdXRob3JfaWQ9XCIpLmNvbmNhdChhdXRob3JfaWQsIFwiJmNhdGVnb3J5PVwiKS5jb25jYXQoY2F0ZWdvcnksIFwiJnBhZ2VOdW1iZXI9XCIpLmNvbmNhdChwYWdlTnVtYmVyQ2F0ZWdvcnkpLCB0cnVlKTtcblxuICB4bWxodHRwLm9ucmVhZHlzdGF0ZWNoYW5nZSA9IGZ1bmN0aW9uICgpIHtcbiAgICBpZiAoeG1saHR0cC5yZWFkeVN0YXRlID09IDQpIHtcbiAgICAgIGlmICh4bWxodHRwLnN0YXR1cyA9PSAyMDApIHtcbiAgICAgICAgLy9SZXMgY29udGVudFxuICAgICAgICB2YXIgb2JqID0gSlNPTi5wYXJzZSh4bWxodHRwLnJlc3BvbnNlVGV4dCk7XG4gICAgICAgIHZhciBkYXRhID0gb2JqLmRhdGEuaHRtbDtcbiAgICAgICAgdmFyIGNvdW50ID0gb2JqLmRhdGEuY291bnQ7XG4gICAgICAgIHZhciB0b3RhbCA9IG9iai5kYXRhLnRvdGFsO1xuXG4gICAgICAgIGlmICh0b3RhbCA9PT0gMCAmJiBwYWdlTnVtYmVyQ2F0ZWdvcnkgPT09IDApIHtcbiAgICAgICAgICAkKCcuc3Bpbi1sb2FkZXInKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgICAgICAgJChcIiNhamF4LXBvc3RzLVwiICsgY2F0ZWdvcnkpLmFwcGVuZChkYXRhKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmIChkYXRhICE9PSBcIlwiICYmIHBhZ2VOdW1iZXJDYXRlZ29yeSA9PT0gMCkge1xuICAgICAgICAgICQoXCIjYWpheC1wb3N0cy1cIiArIGNhdGVnb3J5KS5odG1sKGRhdGEpO1xuXG4gICAgICAgICAgaWYgKHBhcnNlSW50KGNvdW50KSA9PSAxMCAmJiBwYXJzZUludCh0b3RhbCkgPiAxMCkge1xuICAgICAgICAgICAgJChcIiNhamF4LXBvc3RzLVwiICsgY2F0ZWdvcnkpLm5leHQoKS5odG1sKCdMb2FkIE1vcmUnKTtcbiAgICAgICAgICAgICQoXCIjYWpheC1wb3N0cy1cIiArIGNhdGVnb3J5KS5uZXh0KCkucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmF0dHIoJ2RhdGEtcGFnZScsIHBhcnNlSW50KHBhZ2VOdW1iZXJDYXRlZ29yeSkgKyAxKTtcbiAgICAgICAgfSBlbHNlIGlmIChkYXRhICE9PSBcIlwiICYmIHBhZ2VOdW1iZXJDYXRlZ29yeSA+IDApIHtcbiAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkuYXBwZW5kKGRhdGEpO1xuXG4gICAgICAgICAgaWYgKHBhcnNlSW50KGNvdW50KSA9PSAxMCAmJiBwYXJzZUludCh0b3RhbCkgPiAxMCkge1xuICAgICAgICAgICAgJChcIiNhamF4LXBvc3RzLVwiICsgY2F0ZWdvcnkpLm5leHQoKS5odG1sKCdMb2FkIE1vcmUnKTtcbiAgICAgICAgICAgICQoXCIjYWpheC1wb3N0cy1cIiArIGNhdGVnb3J5KS5uZXh0KCkucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmFkZENsYXNzKCdkLW5vbmUnKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmF0dHIoJ2RhdGEtcGFnZScsIHBhcnNlSW50KHBhZ2VOdW1iZXJDYXRlZ29yeSkgKyAxKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAkKFwiI2FqYXgtcG9zdHMtXCIgKyBjYXRlZ29yeSkubmV4dCgpLmh0bWwoJzxpIGNsYXNzPVwiZmEgZmEtY2hlY2tcIj48L2k+Jyk7XG4gICAgICAgICAgJChcIiNhamF4LXBvc3RzLVwiICsgY2F0ZWdvcnkpLm5leHQoKS5hZGRDbGFzcygnY29tcGxldGUtcGFnaW5hdGlvbicpO1xuICAgICAgICAgICQoJyNtb3JlX3Bvc3RzJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICB9XG4gICAgICB9XG4gICAgfVxuICB9O1xuXG4gIHhtbGh0dHAuc2VuZChudWxsKTtcbn0gLy8gVGFiIENvbnRlbnQgQ2xpY2sgRXZlbnRcblxuXG4kKFwiLmF1dGhvcl9fY29udGVudC1uYXYtaXRlbVwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgdmFyIGF1dGhvcl9pZCA9ICQoXCIjanMtYXV0aG9yX19uYXZcIikuYXR0cihcImRhdGEtaWRcIik7XG4gIHZhciBjYXRlZ29yeSA9ICQodGhpcykuYXR0cihcImRhdGEtaWRcIik7XG4gIHZhciBwYWdlID0gJChcIiNhamF4LXBvc3RzLVwiICsgY2F0ZWdvcnkpLm5leHQoKS5hdHRyKFwiZGF0YS1wYWdlXCIpO1xuXG4gIGlmIChjYXRlZ29yeSA9PT0gXCJhY3Rpdml0eVwiIHx8IHBhZ2UgPiAwKSB7XG4gICAgcmV0dXJuIGZhbHNlO1xuICB9XG5cbiAgbG9hZF9wb3N0c19jYXRlZyhhdXRob3JfaWQsIGNhdGVnb3J5KTtcbn0pOyAvLyBMb2FkIE1vcmUgQ2F0ZWdvcmllcyBCdXR0b24gQ2xpY2sgRXZlbnRcblxuJChcIi5tb3JlLXBvc3RzXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24gKCkge1xuICB2YXIgYXV0aG9yX2lkID0gJChcIiNqcy1hdXRob3JfX25hdlwiKS5hdHRyKFwiZGF0YS1pZFwiKTtcbiAgdmFyIGNhdGVnb3J5ID0gJCh0aGlzKS5hdHRyKFwiZGF0YS1pZFwiKTtcbiAgdmFyIHBhZ2VOdW1iZXJDYXRlZ29yeSA9ICQodGhpcykuYXR0cihcImRhdGEtcGFnZVwiKTtcbiAgbG9hZF9wb3N0c19jYXRlZyhhdXRob3JfaWQsIGNhdGVnb3J5LCBwYWdlTnVtYmVyQ2F0ZWdvcnkpO1xufSk7IiwiXCJ1c2Ugc3RyaWN0XCI7XG5cbmZ1bmN0aW9uIF90b0NvbnN1bWFibGVBcnJheShhcnIpIHsgcmV0dXJuIF9hcnJheVdpdGhvdXRIb2xlcyhhcnIpIHx8IF9pdGVyYWJsZVRvQXJyYXkoYXJyKSB8fCBfdW5zdXBwb3J0ZWRJdGVyYWJsZVRvQXJyYXkoYXJyKSB8fCBfbm9uSXRlcmFibGVTcHJlYWQoKTsgfVxuXG5mdW5jdGlvbiBfbm9uSXRlcmFibGVTcHJlYWQoKSB7IHRocm93IG5ldyBUeXBlRXJyb3IoXCJJbnZhbGlkIGF0dGVtcHQgdG8gc3ByZWFkIG5vbi1pdGVyYWJsZSBpbnN0YW5jZS5cXG5JbiBvcmRlciB0byBiZSBpdGVyYWJsZSwgbm9uLWFycmF5IG9iamVjdHMgbXVzdCBoYXZlIGEgW1N5bWJvbC5pdGVyYXRvcl0oKSBtZXRob2QuXCIpOyB9XG5cbmZ1bmN0aW9uIF91bnN1cHBvcnRlZEl0ZXJhYmxlVG9BcnJheShvLCBtaW5MZW4pIHsgaWYgKCFvKSByZXR1cm47IGlmICh0eXBlb2YgbyA9PT0gXCJzdHJpbmdcIikgcmV0dXJuIF9hcnJheUxpa2VUb0FycmF5KG8sIG1pbkxlbik7IHZhciBuID0gT2JqZWN0LnByb3RvdHlwZS50b1N0cmluZy5jYWxsKG8pLnNsaWNlKDgsIC0xKTsgaWYgKG4gPT09IFwiT2JqZWN0XCIgJiYgby5jb25zdHJ1Y3RvcikgbiA9IG8uY29uc3RydWN0b3IubmFtZTsgaWYgKG4gPT09IFwiTWFwXCIgfHwgbiA9PT0gXCJTZXRcIikgcmV0dXJuIEFycmF5LmZyb20obyk7IGlmIChuID09PSBcIkFyZ3VtZW50c1wiIHx8IC9eKD86VWl8SSludCg/Ojh8MTZ8MzIpKD86Q2xhbXBlZCk/QXJyYXkkLy50ZXN0KG4pKSByZXR1cm4gX2FycmF5TGlrZVRvQXJyYXkobywgbWluTGVuKTsgfVxuXG5mdW5jdGlvbiBfaXRlcmFibGVUb0FycmF5KGl0ZXIpIHsgaWYgKHR5cGVvZiBTeW1ib2wgIT09IFwidW5kZWZpbmVkXCIgJiYgaXRlcltTeW1ib2wuaXRlcmF0b3JdICE9IG51bGwgfHwgaXRlcltcIkBAaXRlcmF0b3JcIl0gIT0gbnVsbCkgcmV0dXJuIEFycmF5LmZyb20oaXRlcik7IH1cblxuZnVuY3Rpb24gX2FycmF5V2l0aG91dEhvbGVzKGFycikgeyBpZiAoQXJyYXkuaXNBcnJheShhcnIpKSByZXR1cm4gX2FycmF5TGlrZVRvQXJyYXkoYXJyKTsgfVxuXG5mdW5jdGlvbiBfYXJyYXlMaWtlVG9BcnJheShhcnIsIGxlbikgeyBpZiAobGVuID09IG51bGwgfHwgbGVuID4gYXJyLmxlbmd0aCkgbGVuID0gYXJyLmxlbmd0aDsgZm9yICh2YXIgaSA9IDAsIGFycjIgPSBuZXcgQXJyYXkobGVuKTsgaSA8IGxlbjsgaSsrKSB7IGFycjJbaV0gPSBhcnJbaV07IH0gcmV0dXJuIGFycjI7IH1cblxuZnVuY3Rpb24gX2RlZmluZVByb3BlcnR5KG9iaiwga2V5LCB2YWx1ZSkgeyBpZiAoa2V5IGluIG9iaikgeyBPYmplY3QuZGVmaW5lUHJvcGVydHkob2JqLCBrZXksIHsgdmFsdWU6IHZhbHVlLCBlbnVtZXJhYmxlOiB0cnVlLCBjb25maWd1cmFibGU6IHRydWUsIHdyaXRhYmxlOiB0cnVlIH0pOyB9IGVsc2UgeyBvYmpba2V5XSA9IHZhbHVlOyB9IHJldHVybiBvYmo7IH1cblxuZnVuY3Rpb24gX2NsYXNzQ2FsbENoZWNrKGluc3RhbmNlLCBDb25zdHJ1Y3RvcikgeyBpZiAoIShpbnN0YW5jZSBpbnN0YW5jZW9mIENvbnN0cnVjdG9yKSkgeyB0aHJvdyBuZXcgVHlwZUVycm9yKFwiQ2Fubm90IGNhbGwgYSBjbGFzcyBhcyBhIGZ1bmN0aW9uXCIpOyB9IH1cblxuZnVuY3Rpb24gX2RlZmluZVByb3BlcnRpZXModGFyZ2V0LCBwcm9wcykgeyBmb3IgKHZhciBpID0gMDsgaSA8IHByb3BzLmxlbmd0aDsgaSsrKSB7IHZhciBkZXNjcmlwdG9yID0gcHJvcHNbaV07IGRlc2NyaXB0b3IuZW51bWVyYWJsZSA9IGRlc2NyaXB0b3IuZW51bWVyYWJsZSB8fCBmYWxzZTsgZGVzY3JpcHRvci5jb25maWd1cmFibGUgPSB0cnVlOyBpZiAoXCJ2YWx1ZVwiIGluIGRlc2NyaXB0b3IpIGRlc2NyaXB0b3Iud3JpdGFibGUgPSB0cnVlOyBPYmplY3QuZGVmaW5lUHJvcGVydHkodGFyZ2V0LCBkZXNjcmlwdG9yLmtleSwgZGVzY3JpcHRvcik7IH0gfVxuXG5mdW5jdGlvbiBfY3JlYXRlQ2xhc3MoQ29uc3RydWN0b3IsIHByb3RvUHJvcHMsIHN0YXRpY1Byb3BzKSB7IGlmIChwcm90b1Byb3BzKSBfZGVmaW5lUHJvcGVydGllcyhDb25zdHJ1Y3Rvci5wcm90b3R5cGUsIHByb3RvUHJvcHMpOyBpZiAoc3RhdGljUHJvcHMpIF9kZWZpbmVQcm9wZXJ0aWVzKENvbnN0cnVjdG9yLCBzdGF0aWNQcm9wcyk7IE9iamVjdC5kZWZpbmVQcm9wZXJ0eShDb25zdHJ1Y3RvciwgXCJwcm90b3R5cGVcIiwgeyB3cml0YWJsZTogZmFsc2UgfSk7IHJldHVybiBDb25zdHJ1Y3RvcjsgfVxuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgLyoqXG4gICAqIFZpZGVvIEdhbGxlcnlcbiAgICovXG4gIHZhciBWaWRlb0dhbGxlcnlIZXJvID0gLyojX19QVVJFX18qL2Z1bmN0aW9uICgpIHtcbiAgICBmdW5jdGlvbiBWaWRlb0dhbGxlcnlIZXJvKCkge1xuICAgICAgX2NsYXNzQ2FsbENoZWNrKHRoaXMsIFZpZGVvR2FsbGVyeUhlcm8pO1xuXG4gICAgICB0cnkge1xuICAgICAgICB0aGlzLnZpZGVvR2FsbGVyeSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5qcy1zZWFyY2gtdmlkZW8tZ2FsbGVyeScpO1xuICAgICAgICB0aGlzLnZpZGVvcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5qcy12aWRlby1zbGlkZScpO1xuICAgICAgICB0aGlzLnZpZGVvTW9kYWwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuanMtdmlkZW8tbW9kYWwnKTtcbiAgICAgICAgdGhpcy5sb2FkZXIgPSB0aGlzLnZpZGVvTW9kYWwucXVlcnlTZWxlY3RvcignLmpzLWxvYWRlcicpO1xuICAgICAgICB0aGlzLnZpZGVvTW9kYWxDb250YWluZXIgPSB0aGlzLnZpZGVvTW9kYWwucXVlcnlTZWxlY3RvcignLmpzLWNvbnRhaW5lcicpO1xuICAgICAgICB0aGlzLnZpZGVvTW9kYWxJbmZvQ29udGFpbmVyID0gdGhpcy52aWRlb01vZGFsLnF1ZXJ5U2VsZWN0b3IoJy52aWRlby1pbmZvJyk7XG4gICAgICAgIHRoaXMuY3VycmVudFNsaWRlID0gMDtcbiAgICAgICAgdGhpcy5tb2RhbEJ0bnMgPSB7XG4gICAgICAgICAgcHJldjogdGhpcy52aWRlb01vZGFsLnF1ZXJ5U2VsZWN0b3IoJy5qcy1wcmV2LXZpZGVvJyksXG4gICAgICAgICAgbmV4dDogdGhpcy52aWRlb01vZGFsLnF1ZXJ5U2VsZWN0b3IoJy5qcy1uZXh0LXZpZGVvJylcbiAgICAgICAgfTtcbiAgICAgICAgdGhpcy52aWRlb1NsaWRlcigpO1xuICAgICAgICB0aGlzLnZpZGVvRnVuY3RvbnMoKTtcbiAgICAgICAgdGhpcy5tb2RhbEFjdGlvbnMoKTtcbiAgICAgIH0gY2F0Y2ggKF91bnVzZWQpIHt9XG4gICAgfVxuXG4gICAgX2NyZWF0ZUNsYXNzKFZpZGVvR2FsbGVyeUhlcm8sIFt7XG4gICAgICBrZXk6IFwidmlkZW9TbGlkZXJcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiB2aWRlb1NsaWRlcigpIHtcbiAgICAgICAgdGhpcy52aWRlb3NFbnRlckFuaW1hdGlvbigpO1xuICAgICAgICAkKHRoaXMudmlkZW9HYWxsZXJ5KS5zbGljayh7XG4gICAgICAgICAgY3NzRWFzZTogJ2xpbmVhcicsXG4gICAgICAgICAgc2xpZGVzVG9TaG93OiA1LFxuICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxuICAgICAgICAgIGNlbnRlck1vZGU6IHRydWUsXG4gICAgICAgICAgcGF1c2VPbkZvY3VzOiBmYWxzZSxcbiAgICAgICAgICBwYXVzZU9uSG92ZXI6IGZhbHNlLFxuICAgICAgICAgIHNwZWVkOiA3MDAwLFxuICAgICAgICAgIGF1dG9wbGF5OiB0cnVlLFxuICAgICAgICAgIGF1dG9wbGF5U3BlZWQ6IDAsXG4gICAgICAgICAgYXJyb3dzOiBmYWxzZSxcbiAgICAgICAgICByZXNwb25zaXZlOiBbe1xuICAgICAgICAgICAgYnJlYWtwb2ludDogMTk4MCxcbiAgICAgICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogNy44XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfSwge1xuICAgICAgICAgICAgYnJlYWtwb2ludDogMTQ0MSxcbiAgICAgICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogNVxuICAgICAgICAgICAgfVxuICAgICAgICAgIH0sIHtcbiAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDEyMDAsXG4gICAgICAgICAgICBzZXR0aW5nczoge1xuICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDRcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9LCB7XG4gICAgICAgICAgICBicmVha3BvaW50OiAxMDI0LFxuICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAzXG4gICAgICAgICAgICB9XG4gICAgICAgICAgfSwge1xuICAgICAgICAgICAgYnJlYWtwb2ludDogNjAwLFxuICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAyLFxuICAgICAgICAgICAgICBjZW50ZXJNb2RlOiB0cnVlLFxuICAgICAgICAgICAgICBjZW50ZXJQYWRkaW5nOiAnNDBweCcsXG4gICAgICAgICAgICAgIHZhcmlhYmxlV2lkdGg6IHRydWVcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9LCB7XG4gICAgICAgICAgICBicmVha3BvaW50OiA0ODAsXG4gICAgICAgICAgICBzZXR0aW5nczogX2RlZmluZVByb3BlcnR5KHtcbiAgICAgICAgICAgICAgc3BlZWQ6IDMwMCxcbiAgICAgICAgICAgICAgYXV0b3BsYXk6IGZhbHNlLFxuICAgICAgICAgICAgICBhdXRvcGxheVNwZWVkOiAwLFxuICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXG4gICAgICAgICAgICAgIGNlbnRlck1vZGU6IHRydWUsXG4gICAgICAgICAgICAgIGNlbnRlclBhZGRpbmc6ICc0MHB4JyxcbiAgICAgICAgICAgICAgdmFyaWFibGVXaWR0aDogdHJ1ZVxuICAgICAgICAgICAgfSwgXCJzcGVlZFwiLCAzMDApXG4gICAgICAgICAgfV1cbiAgICAgICAgfSk7IC8vdGhpcy52aWRlb3NTbGlkZXJDb250cm9sbGVyKCk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcInZpZGVvc0VudGVyQW5pbWF0aW9uXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gdmlkZW9zRW50ZXJBbmltYXRpb24oKSB7XG4gICAgICAgICQodGhpcy52aWRlb0dhbGxlcnkpLm9uKCdpbml0JywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgIHZhciBhbmltYXRpb24gPSBuZXcgQW5pbWF0aW9ucygpO1xuICAgICAgICAgIGFuaW1hdGlvbi5zdGFnZ2VyZWQoKTtcbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcInZpZGVvc1NsaWRlckNvbnRyb2xsZXJcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiB2aWRlb3NTbGlkZXJDb250cm9sbGVyKCkge1xuICAgICAgICBpZiAod2luZG93LmlubmVyV2lkdGggPiA2MDApIHtcbiAgICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XG4gICAgICAgICAgdmFyIHNsaWRlcldpZHRoID0gdGhpcy52aWRlb0dhbGxlcnkuY2xpZW50V2lkdGg7XG4gICAgICAgICAgdmFyIHRvbGVyYW5jZSA9IDIwMDtcblxuICAgICAgICAgIHRoaXMudmlkZW9HYWxsZXJ5Lm9ubW91c2Vtb3ZlID0gZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIHZhciBjb29yZGluYXRlcyA9IHNlbGYuZ2V0UmVsYXRpdmVDb29yZGluYXRlcyhlLCBzZWxmLnZpZGVvR2FsbGVyeSk7XG5cbiAgICAgICAgICAgIGlmIChjb29yZGluYXRlcy54ID49IDAgJiYgY29vcmRpbmF0ZXMueCA8PSB0b2xlcmFuY2UpIHtcbiAgICAgICAgICAgICAgLy9QcmV2IFNsaWRlXG4gICAgICAgICAgICAgICQoc2VsZi52aWRlb0dhbGxlcnkpLnNsaWNrKCdzbGlja1ByZXYnKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgaWYgKGNvb3JkaW5hdGVzLnggPD0gc2xpZGVyV2lkdGggJiYgY29vcmRpbmF0ZXMueCA+PSBzbGlkZXJXaWR0aCAtIHRvbGVyYW5jZSkge1xuICAgICAgICAgICAgICAvL05leHQgU2xpZGVcbiAgICAgICAgICAgICAgJChzZWxmLnZpZGVvR2FsbGVyeSkuc2xpY2soJ3NsaWNrTmV4dCcpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgIH07XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwiZ2V0UmVsYXRpdmVDb29yZGluYXRlc1wiLFxuICAgICAgdmFsdWU6IGZ1bmN0aW9uIGdldFJlbGF0aXZlQ29vcmRpbmF0ZXMoZXZlbnQsIHJlZmVyZW5jZUVsZW1lbnQpIHtcbiAgICAgICAgdmFyIHBvc2l0aW9uID0ge1xuICAgICAgICAgIHg6IGV2ZW50LnBhZ2VYLFxuICAgICAgICAgIHk6IGV2ZW50LnBhZ2VZXG4gICAgICAgIH07XG4gICAgICAgIHZhciBvZmZzZXQgPSB7XG4gICAgICAgICAgbGVmdDogcmVmZXJlbmNlRWxlbWVudC5vZmZzZXRMZWZ0LFxuICAgICAgICAgIHRvcDogcmVmZXJlbmNlRWxlbWVudC5vZmZzZXRUb3BcbiAgICAgICAgfTtcbiAgICAgICAgdmFyIHJlZmVyZW5jZSA9IHJlZmVyZW5jZUVsZW1lbnQub2Zmc2V0UGFyZW50O1xuXG4gICAgICAgIHdoaWxlIChyZWZlcmVuY2UpIHtcbiAgICAgICAgICBvZmZzZXQubGVmdCArPSByZWZlcmVuY2Uub2Zmc2V0TGVmdDtcbiAgICAgICAgICBvZmZzZXQudG9wICs9IHJlZmVyZW5jZS5vZmZzZXRUb3A7XG4gICAgICAgICAgcmVmZXJlbmNlID0gcmVmZXJlbmNlLm9mZnNldFBhcmVudDtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgeDogcG9zaXRpb24ueCAtIG9mZnNldC5sZWZ0LFxuICAgICAgICAgIHk6IHBvc2l0aW9uLnkgLSBvZmZzZXQudG9wXG4gICAgICAgIH07XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcInZpZGVvRnVuY3RvbnNcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiB2aWRlb0Z1bmN0b25zKCkge1xuICAgICAgICB2YXIgX3RoaXMgPSB0aGlzO1xuXG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgdGhpcy52aWRlb3MuZm9yRWFjaChmdW5jdGlvbiAodmlkZW8pIHtcbiAgICAgICAgICB2YXIgdmlkZW9VcmwgPSB2aWRlby5nZXRBdHRyaWJ1dGUoJ3VybCcpO1xuICAgICAgICAgIHZhciB2aWRlb0luZm8gPSB2aWRlby5xdWVyeVNlbGVjdG9yKCcudmlkZW8taW5mbycpO1xuICAgICAgICAgIHZpZGVvLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgc2VsZi5jdXJyZW50U2xpZGUgPSBwYXJzZUludCh2aWRlby5nZXRBdHRyaWJ1dGUoJ3NsaWRlJykpO1xuICAgICAgICAgICAgc2VsZi5maWxsTW9kYWwodmlkZW9JbmZvLCB2aWRlb1VybCk7XG5cbiAgICAgICAgICAgIF90aGlzLm9wZW5DbG9zZU1vZGFsKCk7XG4gICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJ2aWRlb0FwaUxvYWRlclwiLFxuICAgICAgdmFsdWU6IGZ1bmN0aW9uIHZpZGVvQXBpTG9hZGVyKHNlY3Rpb25Ub1ByaW50LCB2aWRlb1VybCkge1xuICAgICAgICB0cnkge1xuICAgICAgICAgIHNlY3Rpb25Ub1ByaW50LnF1ZXJ5U2VsZWN0b3IoJy52aW1lby1pZnJhbWUtbG9hZCcpLnJlbW92ZSgpO1xuICAgICAgICB9IGNhdGNoIChfdW51c2VkMikge31cblxuICAgICAgICB2YXIgdmlkZW9JZnJhbWUgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcbiAgICAgICAgdmlkZW9JZnJhbWUuY2xhc3NMaXN0LmFkZCgndmltZW8taWZyYW1lLWxvYWQnKTtcbiAgICAgICAgdmlkZW9JZnJhbWUuY2xhc3NMaXN0LmFkZCgndmlkZW8taW5mb19faWZyYW1lJyk7XG4gICAgICAgIHZhciBvcHRpb25zID0ge1xuICAgICAgICAgIGlkOiB2aWRlb1VybCxcbiAgICAgICAgICBsb29wOiBmYWxzZSxcbiAgICAgICAgICByZXNwb25zaXZlOiB0cnVlXG4gICAgICAgIH07XG4gICAgICAgIHZhciBwbGF5ZXIgPSBuZXcgVmltZW8uUGxheWVyKHZpZGVvSWZyYW1lLCBvcHRpb25zKTtcbiAgICAgICAgcGxheWVyLnBsYXkoKTtcbiAgICAgICAgdGhpcy5yZXNpemVNb2RhbFdpdGhWaWRlb1Jlc29sdXRpb24ocGxheWVyKTtcbiAgICAgICAgc2VjdGlvblRvUHJpbnQuYXBwZW5kQ2hpbGQodmlkZW9JZnJhbWUpO1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJmaWxsTW9kYWxcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBmaWxsTW9kYWwodmlkZW9JbmZvLCB2aWRlb1VybCkge1xuICAgICAgICB0aGlzLnZpZGVvTW9kYWxJbmZvQ29udGFpbmVyLmlubmVySFRNTCA9IHZpZGVvSW5mby5pbm5lckhUTUw7XG4gICAgICAgIHRoaXMudmlkZW9BcGlMb2FkZXIodGhpcy52aWRlb01vZGFsSW5mb0NvbnRhaW5lciwgdmlkZW9VcmwpO1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJyZXNpemVNb2RhbFdpdGhWaWRlb1Jlc29sdXRpb25cIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiByZXNpemVNb2RhbFdpdGhWaWRlb1Jlc29sdXRpb24ocGxheWVyKSB7XG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgcGxheWVyLm9uKCdsb2FkZWQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgcGxheWVyLmdldFZpZGVvSGVpZ2h0KCkudGhlbihmdW5jdGlvbiAoaGVpZ2h0KSB7XG4gICAgICAgICAgICBwbGF5ZXIuZ2V0VmlkZW9XaWR0aCgpLnRoZW4oZnVuY3Rpb24gKHdpZHRoKSB7XG4gICAgICAgICAgICAgIGlmIChoZWlnaHQgPiB3aWR0aCkge1xuICAgICAgICAgICAgICAgIHNlbGYudmlkZW9Nb2RhbEluZm9Db250YWluZXIuc3R5bGUud2lkdGggPSAnMzAwcHgnO1xuICAgICAgICAgICAgICAgIHNlbGYudmlkZW9Nb2RhbENvbnRhaW5lci5zdHlsZS53aWR0aCA9ICcnO1xuICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIHNlbGYudmlkZW9Nb2RhbEluZm9Db250YWluZXIuc3R5bGUud2lkdGggPSAnJztcbiAgICAgICAgICAgICAgICBzZWxmLnZpZGVvTW9kYWxDb250YWluZXIuc3R5bGUud2lkdGggPSAnMTAwJSc7XG4gICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICBzZWxmLmxvYWRlck9uT2ZmKGZhbHNlKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwib3BlbkNsb3NlTW9kYWxcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBvcGVuQ2xvc2VNb2RhbCgpIHtcbiAgICAgICAgdGhpcy52aWRlb01vZGFsLmNsYXNzTGlzdC50b2dnbGUoJ29wZW4nKTtcbiAgICAgICAgdGhpcy5sb2FkZXJPbk9mZih0cnVlKTtcblxuICAgICAgICBpZiAoIXRoaXMudmlkZW9Nb2RhbC5jbGFzc0xpc3QuY29udGFpbnMoJ29wZW4nKSkge1xuICAgICAgICAgIHRoaXMudmlkZW9Nb2RhbC5xdWVyeVNlbGVjdG9yKCcudmltZW8taWZyYW1lLWxvYWQnKS5yZW1vdmUoKTtcbiAgICAgICAgfVxuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJtb2RhbEFjdGlvbnNcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBtb2RhbEFjdGlvbnMoKSB7XG4gICAgICAgIHZhciBzZWxmID0gdGhpczsgLy9QcmV2IFZpZGVvXG5cbiAgICAgICAgdGhpcy5tb2RhbEJ0bnMucHJldi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICB2YXIgcHJldlZpZGVvID0gX3RvQ29uc3VtYWJsZUFycmF5KHNlbGYudmlkZW9zKS5maWx0ZXIoZnVuY3Rpb24gKHZpZGVvKSB7XG4gICAgICAgICAgICByZXR1cm4gcGFyc2VJbnQodmlkZW8uZ2V0QXR0cmlidXRlKCdzbGlkZScpKSA9PSBzZWxmLmN1cnJlbnRTbGlkZSAtIDE7XG4gICAgICAgICAgfSk7XG5cbiAgICAgICAgICBpZiAocHJldlZpZGVvLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICAgIHNlbGYuY3VycmVudFNsaWRlLS07XG4gICAgICAgICAgICB2YXIgdmlkZW9VcmwgPSBwcmV2VmlkZW9bMF0uZ2V0QXR0cmlidXRlKCd1cmwnKTtcbiAgICAgICAgICAgIHZhciB2aWRlb0luZm8gPSBwcmV2VmlkZW9bMF0ucXVlcnlTZWxlY3RvcignLnZpZGVvLWluZm8nKTtcbiAgICAgICAgICAgIHNlbGYuZmlsbE1vZGFsKHZpZGVvSW5mbywgdmlkZW9VcmwpO1xuICAgICAgICAgICAgc2VsZi5sb2FkZXJPbk9mZih0cnVlKTtcbiAgICAgICAgICB9XG4gICAgICAgIH0pOyAvL05leHQgVmlkZW9cblxuICAgICAgICB0aGlzLm1vZGFsQnRucy5uZXh0LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgIHZhciBuZXh0VmlkZW8gPSBfdG9Db25zdW1hYmxlQXJyYXkoc2VsZi52aWRlb3MpLmZpbHRlcihmdW5jdGlvbiAodmlkZW8pIHtcbiAgICAgICAgICAgIHJldHVybiBwYXJzZUludCh2aWRlby5nZXRBdHRyaWJ1dGUoJ3NsaWRlJykpID09IHNlbGYuY3VycmVudFNsaWRlICsgMTtcbiAgICAgICAgICB9KTtcblxuICAgICAgICAgIGlmIChuZXh0VmlkZW8ubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgc2VsZi5jdXJyZW50U2xpZGUrKztcbiAgICAgICAgICAgIHZhciB2aWRlb1VybCA9IG5leHRWaWRlb1swXS5nZXRBdHRyaWJ1dGUoJ3VybCcpO1xuICAgICAgICAgICAgdmFyIHZpZGVvSW5mbyA9IG5leHRWaWRlb1swXS5xdWVyeVNlbGVjdG9yKCcudmlkZW8taW5mbycpO1xuICAgICAgICAgICAgc2VsZi5maWxsTW9kYWwodmlkZW9JbmZvLCB2aWRlb1VybCk7XG4gICAgICAgICAgICBzZWxmLmxvYWRlck9uT2ZmKHRydWUpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7IC8vQ2xvc2UgVmlkZW9cblxuICAgICAgICB0aGlzLnZpZGVvTW9kYWwuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoX3JlZikge1xuICAgICAgICAgIHZhciB0YXJnZXQgPSBfcmVmLnRhcmdldDtcblxuICAgICAgICAgIGlmICh0YXJnZXQuY2xhc3NMaXN0LmNvbnRhaW5zKCdqcy12aWRlby1tb2RhbCcpIHx8IHRhcmdldC5jbGFzc0xpc3QuY29udGFpbnMoJ2pzLWNsb3NlLW1vZGFsJykpIHtcbiAgICAgICAgICAgIHNlbGYub3BlbkNsb3NlTW9kYWwoKTtcbiAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJsb2FkZXJPbk9mZlwiLFxuICAgICAgdmFsdWU6IGZ1bmN0aW9uIGxvYWRlck9uT2ZmKCkge1xuICAgICAgICB2YXIgbG9hZGVyID0gYXJndW1lbnRzLmxlbmd0aCA+IDAgJiYgYXJndW1lbnRzWzBdICE9PSB1bmRlZmluZWQgPyBhcmd1bWVudHNbMF0gOiB0cnVlO1xuXG4gICAgICAgIGlmIChsb2FkZXIpIHtcbiAgICAgICAgICB0aGlzLnZpZGVvTW9kYWxDb250YWluZXIuY2xhc3NMaXN0LnJlbW92ZSgnbG9hZGVkJyk7XG4gICAgICAgICAgdGhpcy5sb2FkZXIuY2xhc3NMaXN0LnJlbW92ZSgnaGlkZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIHRoaXMudmlkZW9Nb2RhbENvbnRhaW5lci5jbGFzc0xpc3QuYWRkKCdsb2FkZWQnKTtcbiAgICAgICAgICB0aGlzLmxvYWRlci5jbGFzc0xpc3QuYWRkKCdoaWRlJyk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XSk7XG5cbiAgICByZXR1cm4gVmlkZW9HYWxsZXJ5SGVybztcbiAgfSgpO1xuXG4gIG5ldyBWaWRlb0dhbGxlcnlIZXJvKCk7XG4gIC8qKlxuICAgKiBTZWFyY2ggbmV3IGZ1bmN0aW9uc1xuICAgKi9cblxuICB2YXIgU2VhcmNoSGVybyA9IC8qI19fUFVSRV9fKi9mdW5jdGlvbiAoKSB7XG4gICAgZnVuY3Rpb24gU2VhcmNoSGVybygpIHtcbiAgICAgIF9jbGFzc0NhbGxDaGVjayh0aGlzLCBTZWFyY2hIZXJvKTtcblxuICAgICAgdHJ5IHtcbiAgICAgICAgdGhpcy5zZWFyY2hNb2RhbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNqcy1kaXNjb3Zlci1zZWFyY2gtcmVzb3VyY2VzJyk7XG4gICAgICAgIHRoaXMuY2xvc2VTZWFyY2ggPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuanMtY2xvc2UtZHJvcGRvd24nKTtcbiAgICAgICAgdGhpcy5nYWxsZXJ5ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmpzLXNlYXJjaC12aWRlby1nYWxsZXJ5Jyk7XG4gICAgICAgIHRoaXMuYnV0dG9uU2VhcmNoID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2pzLWRpc2NvdmVyLWhlYWx0aCcpO1xuICAgICAgICB0aGlzLmlucHV0U2VhcmNoID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2pzLXNlYXJjaC1jb25kaXRpb24nKTtcbiAgICAgICAgdGhpcy5hbGxvd2VkQ1BUID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2pzLXNyLWZvcm0tZGlzY292ZXItaGVhbHRoJykuZ2V0QXR0cmlidXRlKCdwb3N0LXR5cGVzJyk7XG4gICAgICAgIHRoaXMucmVzdWx0c0ZvdW5kTWVzc2FnZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNqcy12YXItdG8tc2VhcmNoJyk7XG4gICAgICAgIHRoaXMubG9hZE1vcmVCdXR0b25zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmpzLWxvYWQtbW9yZS1wb3N0cycpO1xuICAgICAgICB0aGlzLnNlYXJjaFZhbHVlID0gJyc7XG4gICAgICAgIHRoaXMuY2xvc2VPcGVuU2VhcmNoKCk7XG4gICAgICAgIHRoaXMuaW5wdXRBY3Rpb25zKCk7XG4gICAgICAgIHRoaXMubG9hZE1vcmVSZXN1bHRzKCk7XG4gICAgICB9IGNhdGNoIChfdW51c2VkMykge31cbiAgICB9XG5cbiAgICBfY3JlYXRlQ2xhc3MoU2VhcmNoSGVybywgW3tcbiAgICAgIGtleTogXCJjbG9zZU9wZW5TZWFyY2hcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBjbG9zZU9wZW5TZWFyY2goKSB7XG4gICAgICAgIHZhciBzZWxmID0gdGhpcztcbiAgICAgICAgdGhpcy5jbG9zZVNlYXJjaC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBzZWxmLnNlYXJjaE1vZGFsLmNsYXNzTGlzdC50b2dnbGUoJ2Qtbm9uZScpO1xuXG4gICAgICAgICAgaWYgKHdpbmRvdy5pbm5lcldpZHRoID4gNzY3KSB7XG4gICAgICAgICAgICBzZWxmLmdhbGxlcnkuY2xhc3NMaXN0LnRvZ2dsZSgnaGlkZScpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcImlucHV0QWN0aW9uc1wiLFxuICAgICAgdmFsdWU6IGZ1bmN0aW9uIGlucHV0QWN0aW9ucygpIHtcbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzOyAvL0J1dHRvbiBzdWJtaXRcblxuICAgICAgICB0aGlzLmJ1dHRvblNlYXJjaC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChfcmVmMikge1xuICAgICAgICAgIHZhciB0YXJnZXQgPSBfcmVmMi50YXJnZXQ7XG5cbiAgICAgICAgICBpZiAoc2VsZi5pbnB1dFNlYXJjaC52YWx1ZSA9PSAnJykge1xuICAgICAgICAgICAgc2VsZi5pbnB1dFNlYXJjaC5jbGFzc0xpc3QuYWRkKCdpbnZhbGlkJyk7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHNlbGYuaW5wdXRTZWFyY2guY2xhc3NMaXN0LnJlbW92ZSgnaW52YWxpZCcpO1xuICAgICAgICAgIH1cblxuICAgICAgICAgIHNlbGYuc2VhcmNoQmVoYXZpb3JzVG9nZ2xlcih0cnVlKTtcbiAgICAgICAgICBzZWxmLnNlYXJjaFBvc3RzKCk7XG4gICAgICAgIH0pOyAvL0lucHV0IEV2ZW50c1xuXG4gICAgICAgIHRoaXMuaW5wdXRTZWFyY2guYWRkRXZlbnRMaXN0ZW5lcigna2V5ZG93bicsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgc2VsZi5zZWFyY2hWYWx1ZSA9IGUudGFyZ2V0LnZhbHVlO1xuXG4gICAgICAgICAgaWYgKHNlbGYuaW5wdXRTZWFyY2gudmFsdWUgPT0gJycpIHtcbiAgICAgICAgICAgIHNlbGYuaW5wdXRTZWFyY2guY2xhc3NMaXN0LmFkZCgnaW52YWxpZCcpO1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBzZWxmLmlucHV0U2VhcmNoLmNsYXNzTGlzdC5yZW1vdmUoJ2ludmFsaWQnKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBpZiAoZS5rZXkgPT0gJ0VudGVyJyAmJiBlLmtleSAhPSAnJykge1xuICAgICAgICAgICAgc2VsZi5zZWFyY2hQb3N0cygpO1xuICAgICAgICAgICAgc2VsZi5zZWFyY2hCZWhhdmlvcnNUb2dnbGVyKHRydWUpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgIHRoaXMuaW5wdXRTZWFyY2guYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgaWYgKHNlbGYuaW5wdXRTZWFyY2gudmFsdWUgPT0gJycpIHtcbiAgICAgICAgICAgIHNlbGYuaW5wdXRTZWFyY2guY2xhc3NMaXN0LmFkZCgnaW52YWxpZCcpO1xuICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBzZWxmLmlucHV0U2VhcmNoLmNsYXNzTGlzdC5yZW1vdmUoJ2ludmFsaWQnKTtcbiAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJzZWFyY2hCZWhhdmlvcnNUb2dnbGVyXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gc2VhcmNoQmVoYXZpb3JzVG9nZ2xlcigpIHtcbiAgICAgICAgdmFyIHNlYXJjaCA9IGFyZ3VtZW50cy5sZW5ndGggPiAwICYmIGFyZ3VtZW50c1swXSAhPT0gdW5kZWZpbmVkID8gYXJndW1lbnRzWzBdIDogZmFsc2U7XG5cbiAgICAgICAgaWYgKHNlYXJjaCkge1xuICAgICAgICAgIHRoaXMuYnV0dG9uU2VhcmNoLmNsYXNzTGlzdC5hZGQoJ2xvYWRpbmcnLCAnaGlkZGVuQnRuJyk7XG4gICAgICAgICAgdGhpcy5idXR0b25TZWFyY2guY2xhc3NMaXN0LnJlbW92ZSgnZG9uZScpO1xuICAgICAgICAgIHRoaXMuZ2FsbGVyeS5jbGFzc0xpc3QucmVtb3ZlKCdoaWRlJyk7XG4gICAgICAgICAgdGhpcy5zZWFyY2hNb2RhbC5jbGFzc0xpc3QuYWRkKCdkLW5vbmUnKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICB0aGlzLmJ1dHRvblNlYXJjaC5jbGFzc0xpc3QucmVtb3ZlKCdsb2FkaW5nJywgJ2hpZGRlbkJ0bicpO1xuICAgICAgICAgIHRoaXMuYnV0dG9uU2VhcmNoLmNsYXNzTGlzdC5hZGQoJ2RvbmUnKTtcbiAgICAgICAgICB0aGlzLmdhbGxlcnkuY2xhc3NMaXN0LmFkZCgnaGlkZScpO1xuICAgICAgICAgIHRoaXMuc2VhcmNoTW9kYWwuY2xhc3NMaXN0LnJlbW92ZSgnZC1ub25lJyk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwic2VhcmNoUG9zdHNcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBzZWFyY2hQb3N0cygpIHtcbiAgICAgICAgdmFyIHNlbGYgPSB0aGlzO1xuICAgICAgICB0aGlzLnJlc2V0SFRNTENvbnRhaW5lcnMoKTtcbiAgICAgICAgdGhpcy5zZWFyY2hWYWx1ZSA9IHRoaXMuaW5wdXRTZWFyY2gudmFsdWU7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgdXJsOiB3aW5kb3cubG9jYXRpb24ub3JpZ2luICsgJy93cC1qc29uL2RvY3RvcnBlZGlhL3YyL3NlYXJjaCcsXG4gICAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgczogdGhpcy5zZWFyY2hWYWx1ZS5yZXBsYWNlKC9cXHMrL2csICcgJykudHJpbSgpLFxuICAgICAgICAgICAgcG9zdFR5cGVzOiB0aGlzLmFsbG93ZWRDUFRcbiAgICAgICAgICB9XG4gICAgICAgIH0pLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICBzZWxmLnNlYXJjaEJlaGF2aW9yc1RvZ2dsZXIoKTtcbiAgICAgICAgICBzZWxmLnByaW50UG9zdHNPbkhUTUwoZGF0YS5yZXN1bHRzKTtcbiAgICAgICAgICBzZWxmLnRvdGFsUG9zdEZvdW5kKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwidG90YWxQb3N0Rm91bmRcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiB0b3RhbFBvc3RGb3VuZChkYXRhKSB7XG4gICAgICAgIHRoaXMucmVzdWx0c0ZvdW5kTWVzc2FnZS5pbm5lckhUTUwgPSBkYXRhLnRvdGFsX3Jlc3VsdHNfbWVzc2FnZTtcblxuICAgICAgICBpZiAoZGF0YS50b3RhbF9yZXN1bHRzID09IDApIHtcbiAgICAgICAgICB0aGlzLnNlYXJjaE1vZGFsLmNsYXNzTGlzdC5hZGQoJ25vLXJlc3VsdHMnKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICB0aGlzLnNlYXJjaE1vZGFsLmNsYXNzTGlzdC5yZW1vdmUoJ25vLXJlc3VsdHMnKTtcbiAgICAgICAgfVxuICAgICAgfVxuICAgIH0sIHtcbiAgICAgIGtleTogXCJwcmludFBvc3RzT25IVE1MXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gcHJpbnRQb3N0c09uSFRNTChkYXRhKSB7XG4gICAgICAgIGRhdGEuZm9yRWFjaChmdW5jdGlvbiAoY3B0RGF0YSkge1xuICAgICAgICAgIHZhciBkb21Qb3NpdGlvbiA9ICcnO1xuXG4gICAgICAgICAgc3dpdGNoIChjcHREYXRhLnBvc3R0eXBlKSB7XG4gICAgICAgICAgICBjYXNlICdwb3N0JzpcbiAgICAgICAgICAgICAgZG9tUG9zaXRpb24gPSAnYXJ0aWNsZXMnO1xuICAgICAgICAgICAgICBicmVhaztcblxuICAgICAgICAgICAgY2FzZSAnY2F0ZWdvcmllcyc6XG4gICAgICAgICAgICAgIGRvbVBvc2l0aW9uID0gJ2NoYW5uZWxzJztcbiAgICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgIGNhc2UgJ3ZpZGVvcyc6XG4gICAgICAgICAgICAgIGRvbVBvc2l0aW9uID0gJ3ZpZGVvcyc7XG4gICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgIH1cblxuICAgICAgICAgIGlmIChjcHREYXRhLnBvc3RzZGF0YS5wb3N0c2ZvdW5kICE9IDApIHtcbiAgICAgICAgICAgIHZhciB3cmFwcGVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcIiNqcy1cIi5jb25jYXQoZG9tUG9zaXRpb24pKS5wYXJlbnROb2RlO1xuICAgICAgICAgICAgd3JhcHBlci5jbGFzc0xpc3QucmVtb3ZlKCdkLW5vbmUnKTtcbiAgICAgICAgICAgIHZhciBsb2FkTW9yZUJ1dHRvbiA9IHdyYXBwZXIucXVlcnlTZWxlY3RvcignLmpzLWxvYWQtbW9yZS1wb3N0cycpO1xuICAgICAgICAgICAgbG9hZE1vcmVCdXR0b24uc2V0QXR0cmlidXRlKCdwYWdlJywgJzEnKTtcbiAgICAgICAgICAgIGxvYWRNb3JlQnV0dG9uLnNldEF0dHJpYnV0ZSgndG90YWxfcGFnZXMnLCBjcHREYXRhLnBvc3RzZGF0YS5wYWdlcyk7XG5cbiAgICAgICAgICAgIGlmIChjcHREYXRhLnBvc3RzZGF0YS5wYWdlcyA9PSAxKSB7XG4gICAgICAgICAgICAgIGxvYWRNb3JlQnV0dG9uLmNsYXNzTGlzdC5hZGQoJ2Rpc2FibGVkJyk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICBsb2FkTW9yZUJ1dHRvbi5jbGFzc0xpc3QucmVtb3ZlKCdkaXNhYmxlZCcpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiI2pzLWNvdW50LVwiLmNvbmNhdChkb21Qb3NpdGlvbikpLmlubmVySFRNTCA9IGNwdERhdGEucG9zdHNkYXRhLnBvc3RzZm91bmQ7XG4gICAgICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiI2pzLVwiLmNvbmNhdChkb21Qb3NpdGlvbikpLmlubmVySFRNTCA9IGNwdERhdGEucG9zdHNkYXRhLmh0bWw7XG4gICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwicmVzZXRIVE1MQ29udGFpbmVyc1wiLFxuICAgICAgdmFsdWU6IGZ1bmN0aW9uIHJlc2V0SFRNTENvbnRhaW5lcnMoKSB7XG4gICAgICAgIHZhciBfdGhpczIgPSB0aGlzO1xuXG4gICAgICAgIHZhciBhbGxDb250YWluZXJzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLm0tc2VhcmNoX19yZXN1bHRzLXBvc3RzJyk7XG4gICAgICAgIGFsbENvbnRhaW5lcnMuZm9yRWFjaChmdW5jdGlvbiAoY29udGFpbmVyKSB7XG4gICAgICAgICAgY29udGFpbmVyLmlubmVySFRNTCA9ICcnO1xuICAgICAgICAgIHZhciBwYXJlbnQgPSBjb250YWluZXIucGFyZW50Tm9kZTtcbiAgICAgICAgICBwYXJlbnQuY2xhc3NMaXN0LmFkZCgnZC1ub25lJyk7XG4gICAgICAgICAgcGFyZW50LnF1ZXJ5U2VsZWN0b3IoJ2g0ID4gc3BhbicpLmlubmVySFRNTCA9ICcnO1xuXG4gICAgICAgICAgX3RoaXMyLnNlYXJjaE1vZGFsLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LCB7XG4gICAgICBrZXk6IFwibG9hZE1vcmVSZXN1bHRzXCIsXG4gICAgICB2YWx1ZTogZnVuY3Rpb24gbG9hZE1vcmVSZXN1bHRzKCkge1xuICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XG4gICAgICAgIHRoaXMubG9hZE1vcmVCdXR0b25zLmZvckVhY2goZnVuY3Rpb24gKGJ1dHRvbikge1xuICAgICAgICAgIGJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uIChfcmVmMykge1xuICAgICAgICAgICAgdmFyIHRhcmdldCA9IF9yZWYzLnRhcmdldDtcbiAgICAgICAgICAgIHZhciBwYWdlID0gcGFyc2VJbnQodGFyZ2V0LmdldEF0dHJpYnV0ZSgncGFnZScpKTtcbiAgICAgICAgICAgIHZhciB0b3RhbFBhZ2VzID0gcGFyc2VJbnQodGFyZ2V0LmdldEF0dHJpYnV0ZSgndG90YWxfcGFnZXMnKSk7XG4gICAgICAgICAgICB2YXIgcG9zdFR5cGUgPSB0YXJnZXQuZ2V0QXR0cmlidXRlKCdwb3N0X3R5cGUnKTtcblxuICAgICAgICAgICAgaWYgKHBhZ2UgPCB0b3RhbFBhZ2VzKSB7XG4gICAgICAgICAgICAgIHNlbGYucGFnZWRTZWFyY2hQb3N0VHlwZShwb3N0VHlwZSwgcGFnZSArIDEsIHRhcmdldC5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoJy5tLXNlYXJjaF9fcmVzdWx0cy1wb3N0cycpKTtcbiAgICAgICAgICAgICAgdGFyZ2V0LnNldEF0dHJpYnV0ZSgncGFnZScsIHBhZ2UgKyAxKTtcblxuICAgICAgICAgICAgICBpZiAocGFnZSArIDEgPT0gdG90YWxQYWdlcykge1xuICAgICAgICAgICAgICAgIHRhcmdldC5jbGFzc0xpc3QuYWRkKCdkaXNhYmxlZCcpO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICB0YXJnZXQuY2xhc3NMaXN0LmFkZCgnZGlzYWJsZWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfSwge1xuICAgICAga2V5OiBcInBhZ2VkU2VhcmNoUG9zdFR5cGVcIixcbiAgICAgIHZhbHVlOiBmdW5jdGlvbiBwYWdlZFNlYXJjaFBvc3RUeXBlKHBvc3RUeXBlLCBwYWdlLCBjb250YWluZXIpIHtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICB1cmw6IHdpbmRvdy5sb2NhdGlvbi5vcmlnaW4gKyAnL3dwLWpzb24vZG9jdG9ycGVkaWEvdjIvc2VhcmNoJyxcbiAgICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICBzOiB0aGlzLnNlYXJjaFZhbHVlLnJlcGxhY2UoL1xccysvZywgJyAnKS50cmltKCksXG4gICAgICAgICAgICBwb3N0VHlwZXM6IHBvc3RUeXBlLFxuICAgICAgICAgICAgcGFnZTogcGFnZVxuICAgICAgICAgIH1cbiAgICAgICAgfSkuZG9uZShmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgIGNvbnRhaW5lci5pbm5lckhUTUwgPSBjb250YWluZXIuaW5uZXJIVE1MICsgZGF0YS5yZXN1bHRzWzBdLnBvc3RzZGF0YS5odG1sO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9XSk7XG5cbiAgICByZXR1cm4gU2VhcmNoSGVybztcbiAgfSgpO1xuXG4gIG5ldyBTZWFyY2hIZXJvKCk7XG59KTsiXSwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
