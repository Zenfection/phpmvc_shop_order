"use strict";

$(function () {
  /* Function
  ------------------------- */
  var checkImg = function checkImg() {
    var img = document.querySelectorAll('[img]');
    var length = img.length;

    for (var i = 0; i < length; i++) {
      var pic = img[i].getAttribute('img');
      img[i].setAttribute('src', pic);
      img[i].removeAttribute('img');
    }
  };

  $(document).on('change', '[img]', function () {
    checkImg();
  }); //* Load Content

  function loadContent(pathUrl) {
    window.scrollTo(0, 0);
    $("#content").load(pathUrl, function () {
      AOS.init();
    });
  } //* Check loged in


  function checkLoged() {
    var result;
    $.ajax({
      url: './backend/check_logged.php',
      async: false,
      success: function success(data) {
        data == 'true' ? result = true : result = false;
      }
    });
    return result;
  } //* Load Content when refresh page


  var checkURL = function checkURL() {
    var url = new URL(window.location.href);
    var path = url.pathname;
    var id = path.replace('/', '');
    var loadPage = ['', 'about', 'account', "checkout", 'contact', 'login', 'register', "shop", 'viewcart', 'detail_product', 'order_view'];

    if (!loadPage.includes(id)) {
      loadContent('./404.php');
      return;
    }

    if (id == 'detail_product' || id == 'order_view') {
      loadContent('/' + id + '.php' + url.search);
      return;
    } else {
      if (checkLoged() && (id == 'login' || id == 'register')) {
        //đã đăng nhập
        id = 'account';
      } else if (!checkLoged() && (id == 'account' || id == 'viewcart' || id == 'checkout')) {
        id = 'login';
      }
    }

    loadContent('./' + id + '.php');
  };

  checkURL(); //* Listen back & forward button to load content

  window.addEventListener('popstate', function () {
    var url = new URL(window.location.href);
    var path = url.pathname;
    var id = path.replace('/', '');
    if (id == '') id = 'home';
    loadContent('/' + id + '.php' + url.search);
  }); //* choose num page paginator page

  function choosePage(id) {
    var short_by = $("option:selected", '.nice-select').val();

    if (short_by != 'default') {
      var total = parseInt($('.shop-top-show').text().trim().replace(/[^0-9\.]+/g, ''));
      $.ajax({
        type: 'post',
        url: './content/short-by-shop.php',
        data: {
          page: id,
          short_by: short_by,
          total: total
        },
        success: function success(data) {
          $('#product-content').html(data);
          AOS.init();
        }
      });
    } else {
      $.ajax({
        type: "get",
        url: './content/filter-shop.php',
        data: {
          page: id
        },
        success: function success(data) {
          $("#shop-content").html(data);
          AOS.init();
        }
      });
    }
  } //* Check product exist or not in cart by id


  function checkProductExistCart(id) {
    var check = $(".cart-product-wrapper .cart-product-inner");

    for (var i = 0; i < check.length; i++) {
      if (check[i].id == "product_id" + id) return true;
    }

    return false;
  }
  /*-------------------------
      Ajax Load Data Nagivation
  ---------------------------*/
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

  $(document).on('click', '.load-product', function () {
    var id = 'detail_product';
    var id_product = $(this).attr('id');
    window.history.pushState(id, id.toUpperCase(), '/detail_product?id=' + id_product);
    loadContent('./detail_product.php?id=' + id_product);
  });
  $(document).on('click', '.load-order', function () {
    var id = 'order_view';
    var id_order = $(this).attr('id');
    window.history.pushState(id, id.toUpperCase(), '/order_view?id=' + id_order);
    loadContent('./order_view.php?id=' + id_order);
  });
  $(document).on('click', '.load-checkout', function () {
    var count_cart = parseInt($('#count-cart').text());

    if (count_cart > 0) {
      var id = 'checkout';
      window.history.pushState(id, id.toUpperCase(), '/checkout');
      loadContent('./checkout.php');
    } else if (count_cart == 0) {
      notify('info', 'fa-duotone fa-bags-shopping', 'right', 'Bạn chưa có sản phẩm nào trong giỏ hàng');
    } else {
      notify('warning', 'fa-duotone fa-right-to-bracket', 'bottom', 'Bạn chưa đăng nhập, hãy đăng nhập');
    }
  }); //* Listen click to load content

  $(document).on('click', '.nav-content', function () {
    var url = new URL(window.location.href).pathname;
    var id = $(this).attr('id');
    var path;

    if (checkLoged() && (id == 'login' || id == 'register')) {
      //đã đăng nhập
      notify('info', 'fa-duotone fa-info', 'bottom right', 'Bạn đã đăng nhập rồi');
      return;
    } else if (!checkLoged() && (id == 'account' || id == 'viewcart')) {
      notify('warning', 'fa-duotone fa-right-to-bracket', 'bottom right', 'Bạn chưa đăng nhập, hãy đăng nhập');
      return;
    } else {
      if (id == 'home') path = '/';else path = '/' + id;
    }

    loadContent('./' + id + '.php');

    if (url != path) {
      window.history.pushState(id, id.toUpperCase(), path);
    }
  });
  $(document).on('click', '.category-filter', function () {
    var category_filter = $(this).attr('id');
    var active = $(this).parent();
    active.addClass('active').siblings().removeClass('active');
    $.ajax({
      type: "post",
      url: "./content/filter-shop.php",
      data: {
        category_filter: category_filter
      },
      success: function success(data) {
        $("#shop-content").html(data);
        AOS.init();
      }
    });
  }); // SHOP

  $(document).on("keypress", "#searchFilterProduct", function (e) {
    if (e.which == 13) {
      var search_filter = $(this).val();
      $.ajax({
        type: "post",
        url: "./content/filter-shop.php",
        data: {
          search_filter: search_filter
        },
        success: function success(data) {
          $("#shop-content").html(data);
          AOS.init();
        }
      });
    }
  });
  $(document).on("click", ".search-box button", function () {
    var search_filter = $(this).siblings('input').val();
    $.ajax({
      type: "post",
      url: "./content/filter-shop.php",
      data: {
        search_filter: search_filter
      },
      success: function success(data) {
        $("#shop-content").html(data);
        AOS.init();
      }
    });
  });
  $(document).on("change", ".nice-select", function () {
    var short_by = $("option:selected", this).val();
    var total = parseInt($('.shop-top-show').text().trim().replace(/[^0-9\.]+/g, ''));
    var category = $('.sidebar-list li.active a').attr('id');
    $.ajax({
      type: "post",
      url: "./content/short-by-shop.php",
      data: {
        short_by: short_by,
        total: total,
        category: category
      },
      success: function success(data) {
        $("#product-content").html(data);
        AOS.init();
      }
    });
  }); //* search Product by name, listener via Enter

  $(document).on("keypress", "#searchProduct", function (e) {
    if (e.which == 13) {
      var search = $("#searchProduct input").val();
      $.ajax({
        type: "post",
        url: "./shop.php",
        data: {
          search: search
        },
        success: function success(data) {
          $("#content").html(data);
          AOS.init();
        }
      });
    }
  });

  function getQtyProductCart(id) {
    var amount = parseInt($("#quantity" + id).text().replace(/\D/g, ""));
    return amount;
  }

  ;

  function addProduct(id, qty) {
    if (checkProductExistCart(id)) {
      // có hàng trong giỏ chỉ cần tăng số lượng
      var add_qty = getQtyProductCart(id);
      var money = parseFloat($("#product_id" + id + " .price .new").text().replace("$", ""));
      var total_qty = add_qty + qty;
      var total = parseFloat($("#totalmoney").text().replace("$", ""));
      var totalMoney = parseFloat(total + money * qty).toFixed(2);
      $("#quantity" + id + " > strong").text(total_qty);
      $("#totalmoney").text(totalMoney + "$");
    } else {
      // không có hàng trong giỏ thì thêm mới
      var amount = $("#count-cart").text();
      $("#count-cart").text(parseInt(amount) + 1);
      var image = $("#img-product" + id).attr("src");
      var name = $("#product" + id + " .product-title").text();
      if (name == '') name = $(".product-title").text();
      var newprice = $("#product" + id + " .price .new").text();
      if (newprice == '') newprice = $(".regular-price").text();
      var oldprice = $("#product" + id + " .price .old").text();
      if (oldprice == '') oldprice = $(".old-price").text();

      var _total = parseFloat($("#totalmoney").text().replace("$", ""));

      var _totalMoney = parseFloat(newprice.replace("$", "")) * qty + _total;

      var html = "<div class=\"cart-product-inner p-b-20 m-b-20 border-bottom\" id=\"product_id".concat(id, "\">\n                    <div class=\"single-cart-product\">\n                  <div class=\"cart-product-thumb\">\n                      <a href=\"./frontend/detail_product.php\"><img src=\"").concat(image, "\" alt=\"Cart Product\" class=\"rounded\"></a>\n                  </div>\n                  <div class=\"cart-product-content\">\n                      <h3 class=\"title\"><a href=\"./frontend/detail_product.php\">").concat(name, "</a></h3>\n                      <div class=\"product-quty-price\">\n                          <span class=\"cart-quantity\" id=\"quantity").concat(id, "\">S\u1ED1 l\u01B0\u1EE3ng: <strong> ").concat(qty, " </strong></span>\n                          <span class=\"price\">\n                            ");

      if (oldprice != "") {
        html += "\n              <span class=\"new\">".concat(newprice, "</span>\n              <span class=\"old\" style=\"text-decoration: line-through;color: #DC3545;opacity: 0.5;\">").concat(oldprice, "</span>\n              </span>\n            ");
      } else {
        html += "<span class='new'>".concat(newprice, "</span>\n            </span>");
      }

      html += "\n                      </div>\n                  </div>\n              </div>\n              <div class=\"cart-product-remove\">\n                  <a class=\"remove-cart\" id=\"product".concat(id, "\">\n                    <i class=\"fa-duotone fa-trash-can\"></i>\n                  </a>\n              </div>\n          </div>");
      $(".cart-product-wrapper").prepend(html);
      $("#product_id" + id).hide().fadeIn();
      $("#totalmoney").text(parseFloat(_totalMoney).toFixed(2) + "$");
    }

    $.ajax({
      type: "post",
      url: "./backend/add_product_cart.php",
      data: {
        id: id,
        qty: qty
      }
    });
  }
  /*-------------------------
      Ajax Shop Page
  ---------------------------*/


  $(document).on("click", ".add-to_cart", function () {
    if (!checkLoged()) {
      notify('warning', 'fa-duotone fa-cart-circle-xmark', 'right', 'Vui lòng đăng nhập để mua hàng');
      return;
    }

    var id = parseInt($(this).attr("id").replace("product", ""));
    var qty = parseInt($(".cart-plus-minus-box").val());
    addProduct(id, qty);
  });
  $(document).on('click', 'a#plus_product', function () {
    if (!checkLoged()) {
      notify('warning', 'fa-duotone fa-cart-circle-xmark', 'right', 'Vui lòng đăng nhập để mua hàng');
      return;
    }

    var id = parseInt($(this).parent().attr('id').replace('wrapper', ''));
    var qty = 1;
    addProduct(id, qty);
  });
  $(document).keydown('.shop_wrapper grid_4', function (e) {
    var next = $('.page-item a[aria-label="Next"]');
    var prev = $('.page-item a[aria-label="Prev"]');

    switch (e.which) {
      case 37:
        //left arrow key
        if (prev.length > 0) {
          var id = parseInt($(prev).attr('name').split('page=')[1]);
          choosePage(id - 1);
        }

        break;

      case 39:
        //right arrow key
        if (next.length > 0) {
          var _id = parseInt($(next).attr('name').split('page=')[1]);

          choosePage(_id + 1);
        }

        break;
    }
  });
  $(document).on('click', '.page-item a[aria-label="Next"]', function () {
    var id = parseInt($(this).attr('name').split('page=')[1]);
    choosePage(id + 1);
  });
  $(document).on('click', '.page-item a[aria-label="Prev"]', function () {
    var id = parseInt($(this).attr('name').split('page=')[1]);
    choosePage(id - 1);
  });
  $(document).on('click', '#page-choose', function () {
    var id = parseInt($(this).attr('name').split('page=')[1]);
    choosePage(id);
  });
  /*-------------------------
      Ajax Cart View
  ---------------------------*/

  $(document).on('click', '#clear-cart', function () {
    $('#table-cart').hide('normal', function () {
      $(this).remove();
    });
    $('.cart-product-wrapper').children().hide('normal', function () {
      $(this).remove();
    });
    $('#count-cart').text('0');
    $('#totalmoney').text('0.00$');
    $('#total-money').text('0.00$');
    $('#total-bill').text('0.00$');
    $.ajax({
      type: 'post',
      url: './backend/clear_cart.php'
    });
  });
  /*-------------------------
      Ajax Remove Product Cart 
  ---------------------------*/

  $(document).on('click', '.remove-cart', function () {
    var id = $(this).attr('id').replace('product', '');
    $('#product_id' + id).fadeOut('normal', function () {
      var amount = parseInt($('#count-cart').text());
      $('#count-cart').text(amount - 1);
      var money = parseFloat($('#product_id' + id + " .price .new").text().replace('$', ''));
      var total = parseFloat($('#totalmoney').text().replace('$', ''));
      var qty = parseInt($('#quantity' + id).text().replace(/\D/g, ''));
      var totalMoney = (total - money * qty).toFixed(2);
      $('#totalmoney').text(totalMoney + '$');
      $(this).remove();
    });
    $.ajax({
      type: 'post',
      url: './backend/delete_product_cart.php',
      data: {
        delete_id: id
      }
    });
  });
});