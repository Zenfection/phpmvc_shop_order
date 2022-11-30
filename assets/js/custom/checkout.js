$(function () {
    function loadCity() {
        let element = document.getElementById('province');
        let province = element.options[element.selectedIndex].text;
    
        fetch(`/address/get_city/${province}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('city').innerHTML = data;
                document.getElementById('city').nextSibling.remove();
    
    
                let options = {
                    searchable: true
                };
                NiceSelect.bind(city, options).update();
    
                //* Change text "Select as option" to "Chọn quận / huyện"
                document.getElementById('city').nextElementSibling.childNodes[1].textContent = 'Chọn Thành phố';
    
                changeTextNiceSelectSearch('Tìm kiếm...');
            })
    }
    
    function loadWard() {
        let element = document.getElementById('city');
        let city = element.options[element.selectedIndex].text;
    
        console.log(city);
        fetch(`/address/get_ward/${city}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('ward').innerHTML = data;
                document.querySelector('#ward').nextSibling.remove();
                let options = {
                    searchable: true
                };
                NiceSelect.bind(ward, options).update();
    
                //* Change text "Select as option" to "Chọn phường / xã "
                document.querySelector('#ward').nextElementSibling.childNodes[1].textContent = 'Chọn phường';
    
                changeTextNiceSelectSearch('Tìm kiếm...');
            });
    }
    
    
    var nice_select = document.querySelector('.nice-select');
    var options = {
        searchable: true
    };
    NiceSelect.bind(nice_select, options);
    
    
    // change text select an options
    var nice_select_text = document.querySelector('.nice-select .current');
    nice_select_text.textContent = 'Chọn tỉnh';
    
    changeTextNiceSelectSearch('Tìm kiếm...');
    
    function changeTextNiceSelectSearch(content) {
        let nice_select_search = document.querySelectorAll('.nice-select-search');
        nice_select_search.forEach(element => {
            if (element.id != 'status') {
                element.placeholder = content;
            }
        });
    }    
})
