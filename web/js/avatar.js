$(function(){
    $("#avatar").on('click', function(e){
        e.preventDefault();
        $("#profile-imagefile").trigger('click');
    });
});
