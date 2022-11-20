/*
    Author: Zenfection
    Created: 2021-07-10 10:00:00
    Description: Xử lý các Form trong SHOP, fetch API

    !----FUNCTION BỔ TRỢ-----
    * 1. checkText(content, text, min, max): Kiểm tra độ dài của text
    * 2. checkNumber(content, number, min, max): Kiểm tra giá trị của number
    * 3. checkEmail(content, text): Kiểm tra định dạng email

    !----FUNCTION CHÍNH-----
    * 1. loginAccout(): Xử lý đăng nhập
    * 2. callRegister(): Xử lý đăng ký
    * 3. callChangeInfo(): Xử lý thay đổi thông tin
    * 4. callChangePassword(): Xử lý thay đổi mật khẩu
*/

function checkText(content, text, min, max) {
    if (text.length < min) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' phải có ít nhất ' + min + ' ký tự');
        return false;
    } else if (text.length > max) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' phải có nhiều nhất ' + max + ' ký tự');
        return false;
    }
    return true;
}

function checkNumber(content, number, min, max) {
    if (number < min) {
        notify('error', 'fa-duotone fa-input-numeric', 'center top', content + 'phải lớn hơn ' + min);
        return false;
    } else if (number > max) {
        notify('error', 'fa-duotone fa-input-numeric', 'center top', content + 'phải nhỏ hơn ' + max);
        return false;
    }
    return true;
}

function checkEmail(content, text) {
    let regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    if (!regex.test(text)) {
        notify('error', 'fa-duotone fa-input-text', 'center top', content + ' không đúng định dạng');
        return false;
    }
    return true;
}

function loginAccount() {
    //* Lấy dữ liệu từ form
    let user = document.querySelector('#loginForm input[id=username]').value;
    let pass = document.querySelector('#loginForm input[id=password').value;

    //* Kiểm tra dữ liệu
    if (user == '' || pass == '') {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập tài khoản hoặc mật khẩu');
        return;
    }
    if(!checkText('Tài khoản', user, 4, 32)) return;
    if(!checkText('Mật khẩu', pass, 6, 32)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('username', user);
    data.append('password', pass);

    //* Fetch post
    fetch('/login/validate', {
        method: 'POST',
        body: data
    })
    .then(res => res.text())
    .then(data => {
        try{
            data = JSON.parse(data);
            msg = data['msg'];
            notify(msg['type'], msg['icon'], msg['position'], msg['content']);
            if(data.status == 'success'){
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
            } 
        } catch (err) {
            notify('error', 'fa-duotone fa-server', 'center top', "API Server không nhận dữ liệu");
        }
    })
    .catch(err => {
        notify('error', 'fa-duotone fa-server', 'center top', err);
    })
}

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
    //* Lấy dữ liệu
    let fullname = document.querySelector('#changeInfoForm input[id=fullname]').value;
    let phone = document.querySelector('#changeInfoForm input[id=phone]').value;
    let email = document.querySelector('#changeInfoForm input[id=email]').value;
    let address = document.querySelector('#changeInfoForm input[id=address]').value;

    //* Kiểm tra dữ liệu
    if (fullname == ''  || phone == '' || email == '') {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }
    if(!checkText('Họ tên', fullname, 4, 32)) return;
    if(!checkText('Số điện thoại', phone, 10, 11)) return;
    if(!checkEmail('Email', email)) return;
    if(!checkText('Địa chỉ', address, 4, 255)) return;


    //* Tạo data post
    var data = new FormData();
    data.append('fullname', fullname);
    data.append('phone', phone);
    data.append('email', email);
    data.append('address', address);

    //* Fetch post
    fetch('/account/change_user_info', {
        method: 'POST',
        body: data
    })
    .then(res => res.text())
    .then(data => {
        try{
            data = JSON.parse(data);
            msg = data['msg'];
            notify(msg['type'], msg['icon'], msg['position'], msg['content']);
        } catch (err) {
            notify('error', 'fa-duotone fa-server', 'center top', "API Server không nhận dữ liệu");
        }
    })
    .catch(err => {
        notify('error', 'fa-duotone fa-server', 'center top', err);
    })
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
    //* Lấy dữ liệu
    let current_pwd = document.querySelector('#changePassForm input[id=current_pwd]').value;
    let new_pwd = document.querySelector('#changePassForm input[id=new_pwd]').value;
    let confirm_pwd = document.querySelector('#changePassForm input[id=confirm_pwd]').value;

    //* Kiểm tra dữ liệu
    if (current_pwd == '' || new_pwd == '' || confirm_pwd == '') {
        notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
        return;
    }
    if (new_pwd != confirm_pwd) {
        notify('error', 'fa-duotone fa-badge-check', 'center', 'Mật Khẩu Xác Nhận Không Chính Xác');
    }
    if(!checkText('Mật khẩu cũ', current_pwd, 6, 255)) return;
    if(!checkText('Mật khẩu mới', new_pwd, 6, 255)) return;
    if(!checkText('Xác nhận mật khẩu', confirm_pwd, 6, 255)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('old_password', current_pwd);
    data.append('new_password', new_pwd);
    data.append('confirm_password', confirm_pwd);

    //* Fetch post
    fetch('/account/change_user_password', {
        method: 'POST',
        body: data
    })
    .then(res => res.text())
    .then(data => {
        try{
            data = JSON.parse(data);
            msg = data['msg'];
            notify(msg['type'], msg['icon'], msg['position'], msg['content']);
        } catch (err) {
            notify('error', 'fa-duotone fa-server', 'center top', "API Server không nhận dữ liệu");
        }
    })
    .catch(err => {
        notify('error', 'fa-duotone fa-server', 'center top', err);
    })
}
$(document).on('click', '#changePassForm button', function () {
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