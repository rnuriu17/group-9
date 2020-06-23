function PageLoading(par) {
    $('[page-loading] [loading-text]').html(par);
    $('[page-loading]').show();
}

function SubmitLoading() {
    $('button[type=submit]').addClass('is-loading').attr('disabled', 'disabled');
}
function SubmitLoaded() {
    $('button[type=submit]').removeClass('is-loading').removeAttr('disabled');
}

function Loading(el) {
    $(el).addClass('is-loading').attr('disabled', 'disabled');
}
function Loaded(el) {
    $(el).removeClass('is-loading').removeAttr('disabled');
}

function ClickOut(par, f) {
    $('html').click(function (e) {
        if ($(e.target).parents(par).length == 0) {
            f(e);
        }
    });
}

function PageLoaded() {
    $('[page-loading]').hide();
}

function Page(par) {
    if (window.location.pathname == '/' + par) return true;
    else return false;
}

function attr(par, el) {
    return $(el).attr(par);
}

function Trigger(par) {
    $('body').addClass(par);
}

function unTrigger(par) {
    $('body').removeClass(par);
}

function Hash(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function onClick(el, _func) {
    $('body').on('click', el, function (e) {
        e.preventDefault();
        _func(this, e);
    });
}


function onClickReturn(el, _func) {
    $('body').on('click', el, function (e) {
        _func(this, e);
    });
}

function onSubmit(el, _func) {
    $('body').on('submit', 'form[action="' + el + '"]', function (e) {
        e.preventDefault();
        _func(this, e);
    });
}

function Post(data, action, _func) {
    return $.ajax({
        data: data,
        url: '?action=' + action,
        method: 'post',
        success: function (e) {
            _func(e);
        }
    });
}

function PostFile(form, action, _func) {
    return $.ajax({
        data: new FormData(form),
        url: '?action=' + action,
        contentType: false,
        cache: false,
        processData: false,
        method: 'post',
        success: function (e) {
            _func(e);
        }
    });
}

function RefreshComponent(par, el) {
    if ($('[c-' + el + ']').length) {
        // Post('name=' + par, 'component', function (e) {
        //     $('[c-' + el + ']').html(e);
        // });
    }
}

function Exists(el) {
    if ($(el).length) return true;
    else return false
}

function Component(par, el) {
    if (Exists('[c-' + el + ']')) {
        $('[c-' + el + ']').html(par);
    }
}

function error(par) {
    var duration = par.length * 41;
    $('main [error]').remove();
    var hash = Hash(5);
    $('main').append('<div error="' + hash + '"><span>' + par + '</span></div>');
    setTimeout(function () {
        $('main [error="' + hash + '"]').delay(duration).fadeOut(200);
    });
    return false;
}
function message(par) {
    $('main [error]').remove();
    var hash = Hash(5);
    $('main').append('<div error="' + hash + '"><span>' + par + '</span></div>');
    return false;
}

function append(par) {
    $('body').append(par);
}

$('body').on('keyup keydown', '[dont-change]', (e) => {
    e.preventDefault();
    return false;
});

