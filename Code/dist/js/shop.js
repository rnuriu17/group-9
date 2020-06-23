onClick('[add-to-cart]', (t) => {

    var amount = $(t).closest('[product]').find('[amount]').val();
    Loading(t);
    Post('amount=' + amount + '&id=' + $(t).attr('add-to-cart'), 'add-to-cart', (data) => {
        append(data);
        Loaded(t);
    });
});


onClick('[remove-from-cart]', (t) => {

    Loading(t);
    Post('id=' + $(t).attr('remove-from-cart'), 'remove-from-cart', (data) => {
        append(data);
        Loaded(t);
    });

});

onClick('[order-now]', (t) => {

    Loading(t);
    Post('id=1', 'order-now', (data) => {
        append(data);
        Loaded(t);
    });

});
