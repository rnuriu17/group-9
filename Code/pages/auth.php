<?php


if (!user()->logged() && (page('login') || page())) {


    $username = '';

    if (_get('register') == 'success' && _get('user')) {
        $username = user()->hash(_get('user'))->get()['username'];
    }

    render('pages/login', 'Login' . site()->title, ['username' => $username, 'title' => 'Login']);
}


if (!user()->logged() && page('register')) {


    render('pages/register', 'Register' . site()->title, ['title' => 'Register']);
}


if (user()->logged() && page('logout')) {

    user()->logout();
    redirect('');
}
