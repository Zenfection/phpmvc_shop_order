// *Popup Notification
function notify(type, icon, position, msg) {
  Lobibox.notify(type, {
      pauseDelayOnHover: true,
      size: 'mini',
      rounded: true,
      icon: icon,
      continueDelayOnInactiveTab: false,
      position: position,
      msg: msg
  });
}

(function ($) {
  "use strict";
  /*----------------------------------------
    Sticky Menu Activation
  ------------------------------------------*/
  window.addEventListener('scroll', function () {
    if (window.pageYOffset > 150) {
      document.querySelector('.header-sticky').classList.add('sticky');
    } else {
      document.querySelector('.header-sticky').classList.remove('sticky');
    }
  })

  /*---------------------
        Header Search Action
    --------------------- */
  const searchToggle = document.querySelectorAll('.action-execute');
  searchToggle.forEach((item) => {
    item.addEventListener('click', () => {
      let checkVisible = document.querySelector('.header-search-form').classList.contains('visible-execute');
      if (checkVisible) {
        document.querySelector('.header-search-form').classList.remove('visible-execute');
      } else {
        document.querySelector('.header-search-form').classList.add('visible-execute');
      }
    });
  });

  /*---------------------
      Header Cart Toggle
  --------------------- */
  const cartIcon = document.querySelectorAll('.cart-visible');
  const headerCart = document.querySelector('.header-cart-content');
  cartIcon.forEach((item) => {
    item.addEventListener('click', () => {
      headerCart.style.display = 'block';
      if (headerCart.classList.contains('animate__fadeIn')) {
        headerCart.classList.remove('animate__fadeIn');
        headerCart.classList.add('animate__fadeOut');
        headerCart.style.display = 'none';
      } else {
        headerCart.classList.remove('animate__fadeOut');
        headerCart.classList.add('animate__fadeIn');
        headerCart.style.display = 'block';
      }
    });
  });

  /*-----------------------------------------
    Off Canvas Mobile Menu
  -------------------------------------------*/

  $(document).on('click', '.header-action-btn-menu', function () {
    $("body").addClass('fix');
    $(".mobile-menu-wrapper").addClass('open');
  });

  $(document).on('click', '.offcanvas-btn-close,.offcanvas-overlay', function () {
    $("body").removeClass('fix');
    $(".mobile-menu-wrapper").removeClass('open');
  });


  /*----------------------------------------*/
  /* Toggle Function Active
  /*----------------------------------------*/

  // showlogin toggle
  $(document).on('click', '#showlogin', function () {
    $('#checkout-login').slideToggle(500);
  });
  // showlogin toggle
  $(document).on('click', '#showcoupon', function () {
    $('#checkout_coupon').slideToggle(500);
  });
  // showlogin toggle
  $(document).on('click', '#cbox', function () {
    $('#cbox-info').slideToggle(500);
  });

  // Ship box toggle
  $(document).on('click', '#ship-box', function () {
    $('#ship-box-info').slideToggle(1000);
  });

  /*----------------------------------------
    Responsive Mobile Menu
  ------------------------------------------*/

  //Variables
  var $offCanvasNav = $('.mobile-menu, .category-menu'),
    $offCanvasNavSubMenu = $offCanvasNav.find('.dropdown');

  //Close Off Canvas Sub Menu
  $offCanvasNavSubMenu.slideUp();

  //Category Sub Menu Toggle
  $offCanvasNav.on('click', 'li a, li .menu-expand', function (e) {
    var $this = $(this);
    if (($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand'))) {
      e.preventDefault();
      if ($this.siblings('ul:visible').length) {
        $this.parent('li').removeClass('active');
        $this.siblings('ul').slideUp();
      } else {
        $this.parent('li').addClass('active');
        $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
        $this.closest('li').siblings('li').find('ul:visible').slideUp();
        $this.siblings('ul').slideDown();
      }
    }
  });

  /*----------------------------------------*/
  /*  Shop Grid Activation
  /*----------------------------------------*/

  $(document).on('click', '.shop_toolbar_btn > button', function (e) {

    e.preventDefault();

    $('.shop_toolbar_btn > button').removeClass('active');
    $(this).addClass('active');

    var parentsDiv = $('.shop_wrapper');
    var viewMode = $(this).data('role');


    parentsDiv.removeClass('grid_3 grid_4 grid_5 grid_list').addClass(viewMode);

    if (viewMode == 'grid_3') {
      parentsDiv.children().addClass('col-lg-4 col-md-4 col-sm-6').removeClass('col-lg-3 col-cust-5 col-12');

    }

    if (viewMode == 'grid_4') {
      parentsDiv.children().addClass('col-xl-3 col-lg-4 col-md-4 col-sm-6').removeClass('col-lg-4 col-cust-5 col-12');
    }

    if (viewMode == 'grid_list') {
      parentsDiv.children().addClass('col-12').removeClass('col-xl-3 col-lg-3 col-lg-4 col-md-6 col-md-4 col-sm-6 col-cust-5');
    }

  });

  /*----------------------------------------*/
  /*  Cart Plus Minus Button
  /*----------------------------------------*/

  $('.cart-plus-minus').append(
    '<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>'
  );
  $(document).on('click', '.qtybutton', function () {
    var $button = $(this);
    var oldValue = $button.parent().find('input').val();
    if ($button.hasClass('inc')) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
    $button.parent().find('input').val(newVal);
  });


  /*----------------------------------------*/
  /*  Scroll to top
  /*----------------------------------------*/


  $('#scroll-top').removeClass('show');

  function scrollToTop() {
    let $scrollUp = $('#scroll-top'),
      $lastScrollTop = 0,
      $window = $(window);
    $window.on('scroll', function () {
      let st = $(this).scrollTop();
      if (st > $lastScrollTop) {
        $scrollUp.removeClass('show');
      } else {
        if ($window.scrollTop() > 200) {
          $scrollUp.addClass('show');
        } else {
          $scrollUp.removeClass('show');
        }
      }
      $lastScrollTop = st;
    });

    $scrollUp.on('click', function (evt) {
      window.scrollTo(0, 0);
    });
  }
  scrollToTop();

  /*----------------------------------------*/
  /*  When document is loading, do
  /*----------------------------------------*/
  var varWindow = $(window);
  varWindow.on('load', function () {
    AOS.init({
      once: true,
    });
  });

})(jQuery);