$(function () {
    var nice_select = document.querySelectorAll('.nice-select');
    var options = { searchable: true };
    nice_select.forEach(element => {
        if(element.id  == 'status'){
            options = { searchable: false };
        }
        NiceSelect.bind(element, options);
    });
    
    var nice_select_search = document.querySelectorAll('.nice-select-search');
    nice_select_search.forEach(element => {
        if( element.id != 'status'){
            element.placeholder = 'Tìm kiếm...';
        }
    })
})
