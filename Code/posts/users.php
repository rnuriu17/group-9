<?php



if (action('users-edit')) {


    user()->mustAdmin();


    sleep(1);
    extract(posts());


    $u = user()->hash($hash)->get();

    if (user()->id == $u['id']) die();

    $user = user()->username($username)->get();
    if ($user && $user['id'] != $u['id']) die(modal()->error('This username is used by another user. Please change username and try again.')->show());

    $user = user()->email($email)->get();
    if ($user && $user['id'] != $u['id']) die(modal()->error('This email is used by another user. Please change email and try again.')->show());

    $post = posts(['password', 'confirm_password', 'hash']);
    $extra = [];

    if ($password && $confirm_password) {
        if ($password != $confirm_password) die(modal()->error('Passwords doesn\'t match. Please enter same password in both fields.')->show());
        $post = posts(['confirm_password', 'hash']);
        $extra['password'] = user()->pass($password);
    }

    user()->hash($hash)->update(merge($post, $extra));

    modal()->success('User edited successfully.')->show();

    js()->val('#__password');
    js()->val('#__confirm_password');

    die();
}

if (action('users-add')) {


    user()->mustAdmin();

    sleep(1);
    extract(posts());


    $user = user()->username($username)->get();
    if ($user) die(modal()->error('This username is used by another user. Please change username and try again.')->show());

    $user = user()->email($email)->get();
    if ($user) die(modal()->error('This email is used by another user. Please change email and try again.')->show());

    $post = posts(['confirm_password']);
    $extra = [];

    if ($password != $confirm_password) die(modal()->error('Passwords doesn\'t match. Please enter same password in both fields.')->show());

    $extra['created'] = time();
    $extra['hash'] = code(6);
    $extra['password'] = user()->pass($password);
    $extra['ip'] = $_SERVER['REMOTE_ADDR'];

    user()->new(merge($post, $extra));

    modal()->success('User added successfully.')->show();

    js()->reset('form');

    die();
}


if (action('users-delete')) {


    user()->mustAdmin();

    sleep(1);
    extract(posts());


    $user = user()->hash($hash)->get();

    if (user()->id == $user['id']) die();


    modal()->confirm('Are you sure to delete this user?', [
        [
            'label' => 'Yes',
            'class' => 'is-danger',
            'attr' => 'delete-user-confirm="' . $user['hash'] . '"',
        ],
        [
            'close' => true,
            'label' => 'No',
        ]
    ])->show();



    die();
}


if (action('users-delete-confirm')) {


    user()->mustAdmin();

    sleep(1);
    extract(posts());

    $user = user()->hash($hash)->get();

    if (user()->id == $user['id']) die();

    js()->remove('.u_' . $user['hash']);
    js()->html('.user-count', '`' . user()->roles()[$user['role']]['users'] . '`');
    modal()->success('User deleted.')->show();

    user()->id($user['id'])->delete();

    die();
}
