<?php




if (action('cancel-order')) {


    user()->mustMagazine();

    sleep(1);
    extract(posts());



    modal()->confirm('Are you sure to cancel this order?', [
        [
            'label' => 'Yes',
            'class' => 'is-danger',
            'attr' => 'cancel-order-confirm="' . $hash . '"',
        ],
        [
            'close' => true,
            'label' => 'No',
        ]
    ])->show();



    die();
}


if (action('cancel-order-confirm')) {


    user()->mustMagazine();

    sleep(1);
    extract(posts());

    order()->all()->hash($hash)->update(['status' => 'canceled', 'canceled_time' => time(), 'canceled_user' => user()->id]);

    refresh();

    die();
}
