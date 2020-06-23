onSubmit('about', (_s) => {
    SubmitLoading();
    Post($(_s).serialize(), 'about', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('home', (_s) => {
    SubmitLoading();
    Post($(_s).serialize(), 'home', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('exchange', (_s) => {
    SubmitLoading();
    Post($(_s).serialize(), 'exchange', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('products', (_s) => {


    SubmitLoading();
    Post($(_s).serialize(), 'products', (data) => {
        append(data);
        SubmitLoaded();
    });


});

onSubmit('settings', (_s) => {


    SubmitLoading();
    PostFile(_s, 'settings', (data) => {
        append(data);
        SubmitLoaded();
    });


});

onSubmit('products-add', (_s) => {
    SubmitLoading();
    PostFile(_s, 'products-add', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('products-edit', (_s) => {
    SubmitLoading();
    PostFile(_s, 'products-edit', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('users-edit', (_s) => {
    SubmitLoading();
    Post($(_s).serialize(), 'users-edit', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onSubmit('users-add', (_s) => {
    SubmitLoading();
    Post($(_s).serialize(), 'users-add', (data) => {
        append(data);
        SubmitLoaded();
    });
});

onClick('[delete-user]', (t) => {
    Loading(t);
    var hash = $(t).attr('delete-user');
    Post('hash=' + hash, 'users-delete', (data) => {
        append(data);
        Loaded(t);
    });
});

onClick('[delete-user-confirm]', (t) => {
    Loading(t);
    var hash = $(t).attr('delete-user-confirm');
    Post('hash=' + hash, 'users-delete-confirm', (data) => {
        modalClose();
        append(data);
        Loaded(t);
    });
});

onClick('[cancel-order]', (t) => {
    Loading(t);
    var hash = $(t).attr('cancel-order');
    Post('hash=' + hash, 'cancel-order', (data) => {
        append(data);
        Loaded(t);
    });
});

onClick('[cancel-order-confirm]', (t) => {
    Loading(t);
    var hash = $(t).attr('cancel-order-confirm');
    Post('hash=' + hash, 'cancel-order-confirm', (data) => {
        modalClose();
        append(data);
        Loaded(t);
    });
});

onClick('[delete-product]', (_s) => {
    var id = $(_s).attr('delete-product');
    Loading('[delete-product="' + id + '"]');
    Post('id=' + id, 'products-delete', (data) => {
        append(data);
        SubmitLoaded();
    });
});

$('form').each(function () {
    $(this).attr('enctype', 'multipart/form-data');
});

$('input[type=file]').change(function () {
    var file = $(this)[0].files[0].name;
    var _f = $(this).closest('.file');
    var label = _f.find('label.file-label');

    if (file) {
        _f.addClass('has-name');
        label.find('.file-name').remove();
        label.append('<span class="file-name">' + file + '</span>');
    }
    else {
        _f.removeClass('has-name');
        label.remove();
    }
});