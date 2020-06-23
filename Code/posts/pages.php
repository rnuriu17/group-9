<?php


if (action('about')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'updated' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $page = pa('about')->get();

    if ($page) pa('about')->update(merge(posts(), $extra));
    else pa('about')->new(merge(posts(), $extra));

    redirect('about');
    die();
}

if (action('home')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'updated' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $page = pa('home')->get();

    if ($page) pa('home')->update(merge(posts(), $extra));
    else pa('home')->new(merge(posts(), $extra));

    redirect('home');
    die();
}


if (action('exchange')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'updated' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $page = pa('exchange')->get();

    if ($page) pa('exchange')->update(merge(posts(), $extra));
    else pa('exchange')->new(merge(posts(), $extra));

    redirect('exchange');
    die();
}


if (action('products')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'updated' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $page = pa('products')->get();

    if ($page) pa('products')->update(merge(posts(), $extra));
    else pa('products')->new(merge(posts(), $extra));

    redirect('shop');
    die();
}

if (action('settings')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $logo = [];
    if (@$_FILES['logo']['name']) {
        $upload = upload('logo', 'dist/img/', 'logo');
        if (@$upload['success']) {
            $logo = ['logo' => $upload['url']];
            site()->settings(merge(posts(), $logo));
        } else {
            die(modal()->error('Logo not uploaded. Please try again.')->show());
        }
    } else {
        $logo = ['logo' => site()->settings()['logo'] ?? null];
        site()->settings(merge(posts(), $logo));
    }
    redirect('settings?updated=success');
    die();
}
