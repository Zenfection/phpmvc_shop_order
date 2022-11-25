var table = $('#list_order').DataTable({
    select: true,
    language: {
        url: window.location.origin + '/assets/admin/plugins/datatable/dataTables.vietnam.json'
    }
});
table.buttons().container().appendTo('#list_order_wrapper .col-md-6:eq(0)');

$(document).keydown('#list_order', function (e) {
    switch (e.which) {
        case 37: //left arrow key
            document.querySelector('.paginate_button.page-item.previous').click();
            break;
        case 39: //right arrow key
            document.querySelector('.paginate_button.page-item.next').click();
            break;
    }
})


//Change search input to select
var searchInput = $('#list_order_filter label');

