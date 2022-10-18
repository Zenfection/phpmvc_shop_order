"use strict";

//* Load Content
function loadContent(pathUrl) {
  window.scrollTo(0, 0);
  $("#content").load(pathUrl, function () {
    AOS.init();
  });
} //* Popup Notification


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
} // *Sign in


var callLogin = function callLogin() {
  var user = document.querySelector('#loginForm input[name=user]').value;
  var pass = document.querySelector('#loginForm input[name=pass]').value;
  var error = document.getElementsByClassName('is-invalid').length;
  if (error > 0) return;

  if (user == '' || pass == '') {
    notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập tài khoản hoặc mật khẩu');
    return;
  }

  $.ajax({
    type: 'POST',
    url: './backend/login.php',
    async: false,
    data: {
      user: user,
      pass: pass,
      submit: true
    },
    success: function success(data) {
      if (data == 'true') {
        window.history.pushState('home', 'HOME', './');
        setTimeout(function () {
          loadContent('./home.php');
          notify('success', 'fa-duotone fa-user-check', 'bottom', 'Đăng Nhập Thành Công');
        }, 300);
        $('#header').load('./frontend/header.php');
      } else {
        notify('error', 'fa-duotone fa-user-xmark', 'center', 'Sai tài khoản & mật khẩu');
      }
    }
  });
}; // Sign-in


$(document).on('click', '#loginForm button[name=submit]', function () {
  callLogin();
});
$(document).on('keypress', '#loginForm', function (e) {
  if (e.which == 13) {
    callLogin();
  }
}); // *Register

var callRegister = function callRegister() {
  var fullname = document.querySelector('#registerForm input[name=fullname]').value;
  var username = document.querySelector('#registerForm input[name=username]').value;
  var email = document.querySelector('#registerForm input[name=email]').value;
  var password = document.querySelector('#registerForm input[name=password]').value;
  var error = document.getElementsByClassName('is-invalid').length;
  if (error > 0) return;

  if (fullname == '' || username == '' || email == '' || password == '') {
    notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
    return;
  }

  $.ajax({
    type: 'POST',
    url: './backend/register.php',
    async: false,
    data: {
      fullname: fullname,
      username: username,
      email: email,
      password: password,
      submit: true
    },
    success: function success(data) {
      if (data == 'true') {
        window.history.pushState('login', 'LOGIN', './login');
        setTimeout(function () {
          loadContent('./login.php');
          notify('success', 'fa-duotone fa-user-plus', 'bottom', 'Đăng Ký Thành Công');
        }, 300);
        $('#header').load('./frontend/header.php');
      } else {
        notify('error', 'fa-duotone fa-person-walking-arrow-right', 'center', 'Tài khoản đã tồn tại');
      }
    }
  });
}; // *Change Info


var callChangeInfo = function callChangeInfo() {
  var fullname = document.querySelector('#changeInfoForm input[name=fullname]').value;
  var phone = document.querySelector('#changeInfoForm input[name=phone]').value;
  var email = document.querySelector('#changeInfoForm input[name=email]').value;
  var error = document.getElementsByClassName('is-invalid').length;
  if (error > 0) return;

  if (fullname == '' || phone == '' || email == '') {
    notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
    return;
  }

  $.ajax({
    type: 'POST',
    url: './backend/change_info.php',
    data: {
      fullname: fullname,
      phone: phone,
      email: email,
      submit: true
    },
    async: false,
    success: function success(data) {
      if (data == 'true') {
        notify('success', 'fa-duotone fa-user-check', 'center', 'Thay Đổi Thành Công');
      } else {
        notify('error', 'fa-duotone fa-user-xmark', 'center', 'Thay Đổi Thất Bại');
      }
    }
  });
}; // *Change Password


var callChangePass = function callChangePass() {
  var current_pwd = document.querySelector('#changePassForm input[name=current_pwd]').value;
  var new_pwd = document.querySelector('#changePassForm input[name=new_pwd]').value;
  var confirm_pwd = document.querySelector('#changePassForm input[name=confirm_pwd]').value;

  if (current_pwd == '' || new_pwd == '' || confirm_pwd == '') {
    notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
    return;
  }

  if ($('.is-invalid').length > 0) return;
  $.ajax({
    type: 'POST',
    url: './backend/change_password.php',
    data: {
      current_pwd: current_pwd,
      new_pwd: new_pwd,
      confirm_pwd: confirm_pwd,
      submit: true
    },
    async: false,
    success: function success(data) {
      if (data == 'true') {
        notify('success', 'fa-duotone fa-user-check', 'center', 'Thay Đổi Thành Công');
      } else if (data == 'wrong_comfirm') {
        notify('error', 'fa-duotone fa-badge-check', 'center', 'Mật Khẩu Xác Nhận Không Chính Xác');
      } else if (data = 'wrong_pwd') {
        notify('error', 'fa-duotone fa-user-lock', 'center', 'Mật Khẩu Cũ Không Chính Xác');
      } else {
        notify('error', 'fa-duotone fa-user-xmark', 'center', 'Thay Đổi Thất Bại');
      }
    }
  });
}; // *Cancel Order


var callCancelOrder = function callCancelOrder(id) {
  $.ajax({
    type: 'POST',
    url: './backend/cancel_order.php',
    data: {
      id: id
    },
    async: false,
    success: function success(data) {
      window.history.pushState('account', 'ACCOUNT', './account');

      if (data == 'true') {
        var msg = 'Hủy Đơn ' + id + ' Thành Công';
        notify('success', 'fa-duotone fa-box-archive', 'center', msg);
        loadContent('./account.php');
      } else {
        notify('error', 'fa-duotone fa-user-xmark', 'center', 'Hủy Đơn Hàng Thất Bại');
      }
    }
  });
}; // Register


$(document).on('click', '#registerForm button[name=submit]', function () {
  callRegister();
});
$(document).on('keypress', '#registerForm', function () {
  if (e.which == 13) {
    callRegister();
  }
}); // Logout

$(document).on('click', '#logout', function () {
  $.ajax({
    url: './backend/logout.php',
    success: function success() {
      $('#header').load('./frontend/header.php');
    }
  });
  setTimeout(function () {
    window.history.pushState('home', 'HOME', './');
    loadContent('./home.php');
    notify('success', 'fa-duotone fa-right-from-bracket', 'bottom left', 'Đăng Xuất Thành Công');
  }, 300);
}); // Change Info Form

$(document).on('click', '#changeInfoForm button[name=submit]', function () {
  callChangeInfo();
});
$(document).on('keypress', '#changeInfoForm', function (e) {
  if (e.which == 13) {
    callChangeInfo();
  }
}); // Change Password Form

$(document).on('click', '#changePassForm button[name=submit]', function () {
  callChangePass();
});
$(document).on('keypress', '#changePassForm', function (e) {
  if (e.which == 13) {
    callChangePass();
  }
}); // Cancel Order

$(document).on('click', '#cancelOrder', function () {
  var id = $(this).attr('id_order');
  callCancelOrder(id);
});