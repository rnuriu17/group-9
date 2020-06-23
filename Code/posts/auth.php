<?php


if (action('login')) {

    sleep(1);

    extract(posts());

    $user = user()->username($username)->password($password)->get();

    if ($user) {

        user()->login($user);
        redirect('');
    } else die(modal()->error('Please check your information and try again.')->title('Login failed')->show());

    die();
}


if (action('register')) {


    sleep(1);
    extract(posts());


    $user = user()->username($username)->get();
    if ($user) die(modal()->error('This username is used by another user. Please change your username and try again.')->show());

    $user = user()->email($email)->get();
    if ($user) die(modal()->error('This email is used by another user. Please change your email and try again.')->show());

    if ($password != $confirm_password) die(modal()->error('Passwords doesn\'t match. Please enter same password in both fields.')->show());

    $extra = [];
    $extra['created'] = time();
    $extra['hash'] = code(6);
    $extra['password'] = user()->pass($password);
    $extra['ip'] = $_SERVER['REMOTE_ADDR'];

    user()->new(merge(posts(['confirm_password']), $extra));

    redirect('login?register=success&user=' . $extra['hash']);

    die();
}


if (action('profile')) {


    users()->mustLogin();

    sleep(1);
    extract(posts());

    $u = user()->data();

    $user = user()->username($username)->get();
    if ($user && $user['id'] != $u['id']) die(modal()->error('This username is used by another user. Please change your username and try again.')->show());

    $user = user()->email($email)->get();
    if ($user && $user['id'] != $u['id']) die(modal()->error('This email is used by another user. Please change your email and try again.')->show());

    $post = posts(['password', 'confirm_password']);
    $extra = [];


    if ($password && $confirm_password) {
        if ($password != $confirm_password) die(modal()->error('Passwords doesn\'t match. Please enter same password in both fields.')->show());
        $post = posts(['confirm_password']);
        $extra['password'] = user()->pass($password);
    }

    user()->self()->update(merge($post, $extra));


    user()->login(user()->self()->get());

    modal()->success('Your profile edited successfully.')->show();

    js()->val('#__password');
    js()->val('#__confirm_password');

    die();
}
