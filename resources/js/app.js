require('./bootstrap');


$(document).ready(function () {

    sendAjax();
    $('.edit-category').on('click', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var url = "categories/" + id;
        $('#editCategoryModal form').attr('action', url);
        $('#editCategoryModal form input[name="name"]').val(name);
        $('#editCategoryModal form textarea[name="description"]').val(description);
    });

    $('.openbtn').on('click', function () {
        document.getElementById("mySidebar").style.width = "220px";
        let cont = document.getElementById("cont");
        if (cont) {
            cont.style.marginLeft = "220px";
        }

    });

    $('.closebtn').on('click', function () {
        document.getElementById("mySidebar").style.width = "0";
        let cont = document.getElementById("cont");
        if (cont) {
            cont.style.marginLeft = "0";
        }
    });

    $('.add_comp').on('click', function (ev) {
        ev.preventDefault();
        $('.open-comp-items').hide();
        $('#comparing').show();

        let id = $(this).data('id');
        let comp_arr = JSON.parse(localStorage.getItem('compare_items'));
        comp_arr.push(id);
        if (comp_arr.length > 2) {
            alert('You cant compare more then 2products!');
            return false;
        }
        if (comp_arr.length == 1) {
            getFirstItem(id);
            localStorage.setItem('compare_items', JSON.stringify(comp_arr));
        }
        if (comp_arr.length == 2) {
            getSecondItem(id);
            localStorage.setItem('compare_items', JSON.stringify(comp_arr));
        }

    });

    $('.comp-reset').on('click', function () {
        let comf = confirm('Are you sure you want to reset?');
        if (comf) {
            emptyStorage();
            $('#comp-item-1')[0].innerHTML = '';
            $('#comp-item-2')[0].innerHTML = '';
            $('.compare-button').prop("disabled", true);
        }

    });
    $('.compare-button').on('click', function () {
        emptyStorage();
    });
    $('.close-comp').on('click', function () {
        $('#comparing').hide();
        $('.open-comp-items').show();
    });
    $('.open-comp-items').on('click', function () {
        $(this).hide();
        $('#comparing').show();
    })
});

function emptyStorage() {
    let data = JSON.parse(localStorage.getItem('compare_items'));
    data = [];
    localStorage.setItem('compare_items', JSON.stringify(data));
}


function getFirstItem(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/main/compare_phones",
        method: "GET",
        data: {
            id: id
        },
        success: function (data) {
            if (data.phone) {
                $('#comp-item-1').append(`<h4 id="first_phone" class="comp-item-name my-2 py-1" data-id = "${data.phone.id}">${data.phone.name}</h4>
                                              <input name="first_id" type="hidden" value="${data.phone.id}">
                                               <img class="comp-img" src='/storage/${data.phone.image}'/>`);
            }
        },
        error: function () {
            console.log('error')
        }
    });
}

function getSecondItem(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/main/compare_phones",
        method: "GET",
        data: {
            id: id
        },
        success: function (data) {
            if (data.phone) {
                $('#comp-item-2').append(`<h4 id="second_phone" class="comp-item-name my-2 py-1" data-id = "${data.phone.id}">${data.phone.name}</h4>
                                         <input name="second_id" type="hidden" value="${data.phone.id}">
                                        <img class="comp-img" src='/storage/${data.phone.image}'/>`);
                $('.compare-button').prop("disabled", false);
            }
        },
        error: function () {
            console.log('error')
        }
    });
}

function sendAjax() {
    let data = JSON.parse(localStorage.getItem('compare_items'));
    if (!data) {
        data = [];
        localStorage.setItem('compare_items', JSON.stringify(data));
    }
    if (data.length > 0) {
        $('#comparing').show();
    }
    if (data.length == 1) {
        getFirstItem(data[0]);
    }
    if (data.length == 2) {
        getFirstItem(data[0]);
        getSecondItem(data[1]);
    }
}
