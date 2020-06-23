<?php



if (page('users')) {

    user()->mustAdmin();

    $list = users()->list();

    $roles = users()->roles();


    render('pages/users', 'Users' . site()->title, [
        'list' => $list,
        'roles' => $roles,
    ]);
}



if (page('users/$')) {

    user()->mustAdmin();

    $list = users()->role(get(2))->list();
    $roles = users()->roles();
    $r = $roles[get(2)];

    render('pages/users-list', get(2) . ' - Users' . site()->title, [
        'list' => $list,
        'r' => $r,
        'roles' => $roles,
    ]);
}

if (page('user/edit/$')) {

    user()->mustAdmin();

    $roles = users()->rolesOption();
    $user = user()->hash(get(3))->get();

    render('pages/users-edit', $user['username'] . ' - Edit User' . site()->title, [
        'pageTitle' => 'Edit user',
        'roles' => $roles,
        'user' => $user
    ]);
}

if (page('user/add')) {

    user()->mustAdmin();

    $roles = users()->rolesOption();

    render('pages/users-add', 'Add User' . site()->title, [
        'pageTitle' => 'Add user',
        'role' => _get('role'),
    ]);
}
