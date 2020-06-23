<?php


if (page('about')) {

    user()->mustLogin();



    render('pages/about', 'About us' . site()->title, ['page' => pa('about')->get(), 'hero' => true]);
}


if (page('exchange')) {

    user()->mustLogin();

    render('pages/exchange', 'Currency Exchange' . site()->title, ['page' => pa('exchange')->get(), 'hero' => true]);
}


if (page('profile')) {

    user()->mustLogin();

    render(
        'pages/profile',
        'My Profile' . site()->title,
        [
            'pageTitle' => 'My Profile'
        ]
    );
}


if (page('shop')) {

    user()->mustLogin();

    $list = products()->list();

    render('pages/shop', 'Shop' . site()->title, [
        'page' => pa('products')->get(),
        'hero' => true,
        'list' => $list

    ]);
}


if (page('cart')) {

    user()->mustLogin();

    $products = products()->list();
    $list = cart()->get();

    render('pages/cart', 'Shopping Cart' . site()->title, [
        'pageTitle' => 'Shopping Cart',
        'list' => $list,
        'products' => $products

    ]);
}

if (page('order/success/$')) {

    user()->mustLogin();

    $products = products()->list();
    $data = order()->hash(get(3))->get();

    if (!@$data) die(redirect('cart'));

    render('pages/order-success', 'Success!' . site()->title, [
        'data' => $data,

    ]);
}




if (page('reports')) {

    user()->mustAdmin();

    $list = orders()->all()->list();

    $today = strtotime(date('d.m.Y ') . '00:00');
    $yesterday = strtotime(date('d.m.Y', strtotime('yesterday')) . '00:00');
    $_7 = strtotime(date('d.m.Y', strtotime('-7 days')) . '00:00');
    $_14 = strtotime(date('d.m.Y', strtotime('-14 days')) . '00:00');
    $_30 = strtotime(date('d.m.Y', strtotime('-30 days')) . '00:00');

    $stats = [];
    $stats['today'] = 0;
    $stats['yesterday'] = 0;
    $stats['_7'] = 0;
    $stats['_14'] = 0;
    $stats['_30'] = 0;

    $orders = [];

    foreach ($list as $i => $s) {

        if ($s['time'] >= $today) $stats['today']++;
        if ($s['time'] >= $_7) $stats['_7']++;
        if ($s['time'] >= $_14) $stats['_14']++;
        if ($s['time'] >= $_30) $stats['_30']++;
        if ($s['time'] < $today && $s['time'] >= $yesterday) $stats['yesterday']++;

        if ($s['time'] >= $_14) {
            $orders[$i] = $s;
        }
    }



    render('pages/reports', 'Reports' . site()->title, [
        'orders' => $orders,
        'stats' => $stats,
    ]);
}


if (page('reports/all')) {

    user()->mustAdmin();

    $list = orders()->all()->list();

    $today = strtotime(date('d.m.Y ') . '00:00');
    $yesterday = strtotime(date('d.m.Y', strtotime('yesterday')) . '00:00');
    $_7 = strtotime(date('d.m.Y', strtotime('-7 days')) . '00:00');
    $_14 = strtotime(date('d.m.Y', strtotime('-14 days')) . '00:00');
    $_30 = strtotime(date('d.m.Y', strtotime('-30 days')) . '00:00');

    $stats = [];
    $stats['today'] = 0;
    $stats['yesterday'] = 0;
    $stats['_7'] = 0;
    $stats['_14'] = 0;
    $stats['_30'] = 0;

    foreach ($list as $i => $s) {

        if ($s['time'] >= $today) $stats['today']++;
        if ($s['time'] >= $_7) $stats['_7']++;
        if ($s['time'] >= $_14) $stats['_14']++;
        if ($s['time'] >= $_30) $stats['_30']++;
        if ($s['time'] < $today && $s['time'] >= $yesterday) $stats['yesterday']++;
    }

    $orders = $list;



    render('pages/reports-all', 'Reports' . site()->title, [
        'orders' => $orders,
        'stats' => $stats,
    ]);
}



if (page('orders')) {

    user()->mustLogin();

    $list = orders()->list();

    render('pages/my-orders', 'My Orders' . site()->title, [
        'list' => $list,
    ]);
}


if (page('order/print/$')) {

    $data = orders()->all()->hash(get(3))->get();

    if (!@$data) die(redirect('orders'));

    render('pages/order-print', $data['hash'] . ' - Print Invoice' . site()->title, [
        'data' => $data,
    ]);
}


if (page('order/products/$')) {

    user()->mustLogin();

    $data = orders()->hash(get(3))->get();

    if (!@$data) die(redirect('orders'));

    render('pages/order-products', $data['hash'] . ' - Products' . site()->title, [
        'pageTitle' => $data['hash'] . ' - Products',
        'list' => $data['products_data']['products'],
    ]);
}
