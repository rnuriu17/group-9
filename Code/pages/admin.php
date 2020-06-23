<?php


if (page('home/edit')) {

    user()->mustAdmin();

    $_products = products()->list();
    $products = [];
    foreach ($_products as $i => $s) {
        $products[$s['id']] = $s['code'] . ' - ' . $s['name'];
    }

    render('pages/admin/home', 'Edit - Home' . site()->title, [
        'pageTitle' => 'Edit - Home',
        'products' => $products,
        'page' => pa('home')->get()
    ]);
}

if (page('about/edit')) {

    user()->mustAdmin();

    render('pages/admin/about', 'Edit - About us' . site()->title, [
        'pageTitle' => 'Edit - About us',
        'page' => pa('about')->get()
    ]);
}

if (page('exchange/edit')) {

    user()->mustAdmin();

    render('pages/admin/exchange', 'Edit - Exchange' . site()->title, [
        'pageTitle' => 'Edit - Exchange',
        'page' => pa('exchange')->get()
    ]);
}

if (page('shop/edit')) {

    user()->mustAdmin();

    render('pages/admin/products', 'Edit - Shop' . site()->title, [
        'pageTitle' => 'Edit - Shop',
        'page' => pa('products')->get()
    ]);
}

if (page('settings')) {

    user()->mustAdmin();

    render('pages/admin/settings', 'Settings' . site()->title, [
        'pageTitle' => 'Settings',
        'success' => _get('updated') == 'success' ? true : false
    ]);
}

if (page('products')) {

    user()->mustAdmin();

    $list = products()->list();

    render('pages/admin/products-list', 'Products List' . site()->title, [
        'list' => $list,
    ]);
}

if (page('products/add')) {

    user()->mustAdmin();

    render('pages/admin/products-add', 'Add Product' . site()->title, [
        'pageTitle' => 'Add Product',
    ]);
}

if (page('products/edit/$')) {

    user()->mustAdmin();

    $product = product()->id(get(3))->get();

    render('pages/admin/products-edit', 'Edit Product' . site()->title, [
        'pageTitle' => 'Edit Product',
        'product' => $product
    ]);
}
