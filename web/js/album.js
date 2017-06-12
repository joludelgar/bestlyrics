$('.album').click(function(){
    $('input[type=file]').click();
    return false;
});

$(".upload").change(function() {
    this.form.submit();
});
