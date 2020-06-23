<?php


if (page() || page('home')) {

    user()->mustLogin();

    $user = user()->data();

    if ($user['role'] == 'magazine') {


        $list = orders()->all()->list();

        $_14 = strtotime(date('d.m.Y', strtotime('-14 days')) . '00:00');

        $orders = [];


        $stats = [];
        $stats['pending'] = 0;
        $stats['delivery'] = 0;
        $stats['completed'] = 0;
        $stats['canceled'] = 0;

        foreach ($list as $i => $s) {

            if ($s['status'] == 'pending') $stats['pending']++;
            if ($s['status'] == 'delivery') $stats['delivery']++;
            if ($s['status'] == 'completed') $stats['completed']++;
            if ($s['status'] == 'canceled') $stats['canceled']++;

            if ($s['time'] >= $_14 && $s['status'] == 'pending') {
                $orders[$i] = $s;
            }
        }

        render('pages/magazine', 'Home' . site()->title, [
            'orders' => $orders,
            'stats' => $stats,
        ]);
        die();
    }

    $page = pa('home')->get();

    $products = products()->list();

    render('pages/home', 'Home' . site()->title, [
        'products' => $products,
        'page' => $page
    ]);
}
