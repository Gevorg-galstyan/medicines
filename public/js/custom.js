var token = $('meta[name="csrf-token"]').attr('content');


$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
});

$('.form-edit-add').validate();


$('.delete').click(function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $('#conform-delete').attr('href', url);
    parent_tr = $('tr[data-status="' + $(this).data('tr') + '"]')
});
$('#conform-delete').click(function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'delete',
        data: {_token: token},
        success: function (data) {
            if (data == 1) {
                $(parent_tr).fadeOut(function () {
                    $(parent_tr).remove();
                });
            }
            $('#confirm-delete-modal').modal('hide');
        }
    })
});

$(".my-select2").select2({
    width: 'resolve',
    formatResult: format,
    formatSelection: format,
    templateResult: format,
    escapeMarkup: function (m) {
        if (m == 'Select...') {
            return m;
        }
        return '<div><img class="flag"  src="' + m + '" width="30px"/></div>';
    }
});
function format(state) {
    return state.text;
}

$('.form-register').validate({
    rules: {
        password: {required : true, minlength:6},
        password_confirmation: {
            equalTo: "#password"
        }
    },
    submitHandler:function (form) {
        $(form).submit();
    }
});

$('.form-login').validate();
