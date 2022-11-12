// *Sign in
function loginAccount() {
    let user = document.querySelector('#loginForm input[id=username]').value;
    let pass = document.querySelector('#loginForm input[id=password').value;

    if (user == '' || user === undefined || pass == '' || pass === undefined) {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập tài khoản hoặc mật khẩu');
        return;
    }
    //fetch post method
    document.querySelector('#loginForm button[type=button]').removeAttribute('onclick');
    document.querySelector('#loginForm button[type=button]').setAttribute('type', 'submit').click();
};

$(document).on('keypress', '#loginForm', function (e) {
    if (e.which == 13) {
        loginAccount();
    }
});


// *Register
var callRegister = function () {
    let fullname = document.querySelector('#registerForm input[id=fullname]').value;
    let username = document.querySelector('#registerForm input[id=username]').value;
    let email = document.querySelector('#registerForm input[id=email]').value;
    let password = document.querySelector('#registerForm input[id=password]').value;

    if (fullname == '' || fullname === undefined || username == '' || username === undefined || email == '' || email === undefined || password == '' || password === undefined) {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }

    document.querySelector('#registerForm button[type=button]').setAttribute('type', 'submit').click();
}
$(document).on('click', '#registerForm button', function () {
    callRegister();
});
$(document).on('keypress', '#registerForm', function (e) {
    if (e.which == 13) {
        callRegister()
    }
})

// *Change Info
var callChangeInfo = function () {
    let fullname = document.querySelector('#changeInfoForm input[id=fullname]').value;
    let phone = document.querySelector('#changeInfoForm input[id=phone]').value;
    let email = document.querySelector('#changeInfoForm input[id=email]').value;

    if (fullname == '' || fullname === undefined || phone == '' || phone === undefined || email == '' || email === undefined) {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }
    document.querySelector('#changeInfoForm button[type=button]').setAttribute('type', 'submit').click();
}
$(document).on('click', '#changeInfoForm button', function () {
    callChangeInfo();
})
$(document).on('keypress', '#changeInfoForm', function (e) {
    if (e.which == 13) {
        callChangeInfo()
    }
})

// *Change Password
var callChangePass = function () {
    let current_pwd = document.querySelector('#changePassForm input[id=current_pwd]').value;
    let new_pwd = document.querySelector('#changePassForm input[id=new_pwd]').value;
    let confirm_pwd = document.querySelector('#changePassForm input[id=confirm_pwd]').value;

    if (current_pwd == '' || current_pwd === undefined || new_pwd == '' || new_pwd === undefined || confirm_pwd == '' || confirm_pwd === undefined) {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }
    if (new_pwd != confirm_pwd) {
        notify('error', 'fa-duotone fa-badge-check', 'center', 'Mật Khẩu Xác Nhận Không Chính Xác');
    }

    document.querySelector('#changePassForm button[type=button]').setAttribute('type', 'submit').click();
}
$(document).on('click', '#changePassForm button[name=submit]', function () {
    callChangePass();
})
$(document).on('keypress', '#changePassForm', function (e) {
    if (e.which == 13) {
        callChangePass()
    }
})

//* Checkout Form
var callCheckout = function () {
    let fullname = document.querySelector('#checkoutForm input[id=fullname]').value;
    let phone = document.querySelector('#checkoutForm input[id=phone]').value;
    let address = document.querySelector('#checkoutForm input[id=address]').value;
    let email = document.querySelector('#checkoutForm input[id=email]').value;

    let province = document.querySelector('select#province').nextSibling.querySelector('.current').textContent
    let city = document.querySelector('select#city').nextSibling.querySelector('.current').textContent
    let ward = document.querySelector('select#ward').nextSibling.querySelector('.current').textContent

    //console.log(fullname, phone, address, province, city, email);
    if (fullname == '' || fullname === undefined || phone == '' || phone === undefined || address == '' || address === undefined || province == '' || province === undefined || city == '' || city === undefined || ward == '' || ward === undefined || email == '' || email === undefined) {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }
    document.querySelector('#checkoutForm button[type=button]').setAttribute('type', 'submit').click();
}

$(document).on('click', '#checkoutForm button[type=button]', function () {
    callCheckout();
});
$(document).on('keypress', '#checkoutForm', function (e) {
    if (e.which == 13) {
        callCheckout()
    }
});