onClick('[close-modal], .modal-background', (t) => {
    $(t).closest('.modal').removeClass('is-active');
});

function modalClose() {
    $('.modal').removeClass('is-active');
}