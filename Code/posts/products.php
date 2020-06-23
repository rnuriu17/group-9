<?php

if (action('products-add')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'created' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
        'deleted' => '',
    ];

    $image = [];
    if (@$_FILES['image']['name']) {
        $upload = upload('image', 'dist/img/products/', md5($code . time()));
        if (@$upload['success']) {
            $image = ['image' => $upload['url']];
            products()->new(merge(posts(), $image, $extra));
        } else {
            die(modal()->error('Image not uploaded. Please try again.')->show());
        }
    }

    modal()->success('Product added.')->show();
    js()->reset('form');
    die();
}

if (action('products-edit')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    $extra = [
        'updated' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $product = product()->id($id)->get();

    $image = [];
    if (@$_FILES['image']['name']) {
        $upload = upload('image', 'dist/img/products/', md5($code));
        if (@$upload['success']) {
            $image = ['image' => $upload['url']];
        } else {
            modal()->error('Image not uploaded. Please try again.')->show();
        }
    } else {
        $image = [
            'image' => @$product['image'] ?? null
        ];
    }

    products()->id($id)->update(merge(posts(), $image, $extra));
    js()->src('[product-image]', $image['image']);
    modal()->success('Product updated.')->show();
    die();
}

if (action('products-delete')) {

    user()->mustAdmin();

    sleep(1);

    extract(posts());

    product()->remove($id);

    js()->remove('[product="' . $id . '"]');

    die();
}
