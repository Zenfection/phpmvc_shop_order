var nice_select = document.querySelectorAll('.nice-select');
var options = {
    searchable: true
};
nice_select.forEach(element => {
    NiceSelect.bind(element, options);
});

var nice_select_search = document.querySelectorAll('.nice-select-search');
nice_select_search.forEach(element => {
    element.placeholder = 'Tìm kiếm...';
})

var nice_select_text = document.querySelectorAll('.nice-select .current');
nice_select_text.forEach(element => {
    if(element.textContent == 'Select an option'){
        element.textContent = 'Chọn...';
    }
})