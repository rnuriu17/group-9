onSubmit('login', (_s) => {


    SubmitLoading();
    Post($(_s).serialize(), 'login', (data) => {
        append(data);
        SubmitLoaded();
    });


});

onSubmit('register', (_s) => {


    SubmitLoading();

    Post($(_s).serialize(), 'register', (data) => {
        append(data);
        SubmitLoaded();
    });


});

onSubmit('profile', (_s) => {

    SubmitLoading();

    Post($(_s).serialize(), 'profile', (data) => {
        append(data);
        SubmitLoaded();
    });

});