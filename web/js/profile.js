var color = localStorage.color;

if (color != null) {
    $("#color").val(color);
    $(".profile-show").css('background-color', color);
}

$("#color").on('change', function() {
    localStorage.clear();
    var valor = $(this).val();
    localStorage.color = valor;
    $(".profile-show").css('background-color', valor);
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
