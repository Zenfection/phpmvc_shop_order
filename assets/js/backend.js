/*
    Author: Zenfection
    Created: 2021-07-10 10:00:00
    Description: Xử lý các Form trong SHOP, fetch API

    !----FUNCTION BỔ TRỢ-----
    * 1. checkText(content, text, min, max): Kiểm tra độ dài của text
    * 2. checkNumber(content, number, min, max): Kiểm tra giá trị của number
    * 3. checkEmail(content, text): Kiểm tra định dạng email
    * 4. checkData(array): Kiểm tra dữ liệu có bị thiếu không

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

function checkData(array) {
    $check = true;
    for (let i = 0; i < array.length; i++) {
        if (array[i] == '' || array[i] == null || array[i] === undefined) {
            $check = false;
            break;
        }
    }
    if (!$check) notify('warning', 'fa-duotone fa-pen-field', 'center', 'Bạn chưa nhập đầy đủ thông tin');
    return $check;
}

//! Login
function loginAccount() {
    let user = document.querySelector('#loginForm input[id=username]').value;
    let pass = document.querySelector('#loginForm input[id=password').value;

    if (!checkData([user, pass])) return;
    if (!checkText('Tài khoản', user, 4, 32)) return;
    if (!checkText('Mật khẩu', pass, 6, 32)) return;

    var data = new FormData();
    data.append('username', user);
    data.append('password', pass);

    fetch('/login/validate', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                msg = data['msg'];
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
                if (data.status == 'success') {
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
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


//! Register
var callRegister = function () {
    let fullname = document.querySelector('#registerForm input[id=fullname]').value;
    let username = document.querySelector('#registerForm input[id=username]').value;
    let email = document.querySelector('#registerForm input[id=email]').value;
    let password = document.querySelector('#registerForm input[id=password]').value;

    if (!checkData([fullname, username, email, password])) return;
    if (!checkText('Họ và tên', fullname, 4, 255)) return;
    if (!checkText('Tài khoản', username, 4, 255)) return;
    if (!checkEmail('Email', email)) return;
    if (!checkText('Mật khẩu', password, 6, 255)) return;

    var data = new FormData();
    data.append('fullname', fullname);
    data.append('username', username);
    data.append('email', email);
    data.append('password', password);

    fetch('/register/validate', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                msg = data['msg'];
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
                if (data.status == 'success') {
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1000);
                }
            } catch (err) {
                notify('error', 'fa-duotone fa-server', 'center top', "API Server không nhận dữ liệu");
            }
        })
        .catch(err => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        })
}
$(document).on('click', '#registerForm button', function () {
    callRegister();
});
$(document).on('keypress', '#registerForm', function (e) {
    if (e.which == 13) {
        callRegister()
    }
})

//! Change User Info
var callChangeInfo = function () {
    //* Lấy dữ liệu
    let fullname = document.querySelector('#changeInfoForm input[id=fullname]').value;
    let phone = document.querySelector('#changeInfoForm input[id=phone]').value;
    let email = document.querySelector('#changeInfoForm input[id=email]').value;
    let address = document.querySelector('#changeInfoForm input[id=address]').value;
    let province = document.querySelector('#changeInfoForm select[id=province]').value;
    let city = document.querySelector('#changeInfoForm select[id=city]').value;
    let ward = document.querySelector('#changeInfoForm select[id=ward]').value;

    //* Kiểm tra dữ liệu
    if(!checkData([fullname, phone, email, address, province, city, ward])) return;
    if (!checkText('Họ tên', fullname, 4, 32)) return;
    if (!checkText('Số điện thoại', phone, 10, 11)) return;
    if (!checkEmail('Email', email)) return;
    if (!checkText('Địa chỉ', address, 4, 255)) return;
    if (!checkText('Tỉnh/Thành phố', province, 4, 255)) return;
    if (!checkText('Quận/Huyện', city, 4, 255)) return;
    if (!checkText('Phường/Xã', ward, 4, 255)) return;


    //* Tạo data post
    var data = new FormData();
    data.append('fullname', fullname);
    data.append('phone', phone);
    data.append('email', email);
    data.append('address', address);
    data.append('province', province);
    data.append('city', city);
    data.append('ward', ward);

    //* Fetch post
    fetch('/account/change_user_info', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
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

//! Change Password
var callChangePass = function () {
    //* Lấy dữ liệu
    let current_pwd = document.querySelector('#changePassForm input[id=current_pwd]').value;
    let new_pwd = document.querySelector('#changePassForm input[id=new_pwd]').value;
    let confirm_pwd = document.querySelector('#changePassForm input[id=confirm_pwd]').value;

    //* Kiểm tra dữ liệu
    if (!checkData([current_pwd, new_pwd, confirm_pwd])) return;
    if (new_pwd != confirm_pwd) {
        notify('error', 'fa-duotone fa-badge-check', 'center', 'Mật Khẩu Xác Nhận Không Chính Xác');
        return;
    }
    if (!checkText('Mật khẩu cũ', current_pwd, 6, 255)) return;
    if (!checkText('Mật khẩu mới', new_pwd, 6, 255)) return;
    if (!checkText('Xác nhận mật khẩu', confirm_pwd, 6, 255)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('current_pwd', current_pwd);
    data.append('new_pwd', new_pwd);
    data.append('confirm_pwd', confirm_pwd);

    //* Fetch post
    fetch('/account/change_user_password', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
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
    //* Lấy dữ liệu
    let fullname = document.querySelector('#checkoutForm input[id=fullname]').value;
    let phone = document.querySelector('#checkoutForm input[id=phone]').value;
    let address = document.querySelector('#checkoutForm input[id=address]').value;
    let email = document.querySelector('#checkoutForm input[id=email]').value;

    let province = document.querySelector('select#province').nextSibling.querySelector('.current').textContent
    let city = document.querySelector('select#city').nextSibling.querySelector('.current').textContent
    let ward = document.querySelector('select#ward').nextSibling.querySelector('.current').textContent

    //* Kiểm tra dữ liệu
    if (!checkData([fullname, phone, address, email])) return;
    if (!checkText('Họ tên', fullname, 4, 255)) return;
    if (!checkText('Số điện thoại', phone, 10, 11)) return;
    if (!checkEmail('Email', email)) return;
    if (!checkText('Địa chỉ', address, 4, 255)) return;

    //* Tạo data post
    var data = new FormData();
    data.append('fullname', fullname);
    data.append('phone', phone);
    data.append('address', address);
    data.append('email', email);
    data.append('province', province);
    data.append('city', city);
    data.append('ward', ward);

    //* Fetch post
    fetch('/checkout/validate', {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            try {
                data = JSON.parse(data);
                msg = data['msg'];
                notify(msg['type'], msg['icon'], msg['position'], msg['content']);
                if (data['status'] == 'success') {
                    let id_order = data['id_order'];
                    setTimeout(() => {
                        window.location.href = '/account/order/' + data['id_order'];
                    }, 1000);
                }
            } catch (err) {
                notify('error', 'fa-duotone fa-server', 'center top', "API Server không nhận dữ liệu");
            }
        })
        .catch(err => {
            notify('error', 'fa-duotone fa-server', 'center top', err);
        })
}

$(document).on('click', '#checkoutForm button[type=button]', function () {
    callCheckout();
});
$(document).on('keypress', '#checkoutForm', function (e) {
    if (e.which == 13) {
        callCheckout()
    }
});