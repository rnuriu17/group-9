<?php

if (action('add-to-cart')) {

    user()->mustLogin();

    sleep(1);

    extract(posts());

    if ($amount <= 0) die();

    cart()->add($id, $amount);

    cart()->update();
    die();
}


if (action('remove-from-cart')) {

    user()->mustLogin();

    sleep(1);

    extract(posts());

    cart()->remove($id);
    if (cart()->count <= 0) die(refresh());

    cart()->update();
    js()->remove('.cart_' . $id);


    $amounts = 0;
    $total = 0;
    foreach (cart()->get() as $ci => $cs) {
        $amounts = $amounts + $cs;
        $product = product()->id($ci)->get();
        $total = $total + ($cs * $product['price']);
    }

    js()->component('cart-totals', _component('shop/cart/totals', ['cart' => cart()->get(), 'amounts' => $amounts, 'total' => $total]));

    die();
}

if (action('order-now')) {

    user()->mustLogin();

    sleep(1);

    extract(posts());

    if (cart()->count <= 0) die(refresh());


    $hash = order()->new();
    cart()->reset();
    redirect('order/success/' . $hash);


    die();
}
