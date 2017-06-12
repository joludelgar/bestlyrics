$('#bloqueo').click(function() {
    $.ajax({
        method: 'POST',
        url: url,
        context: this,
        data: {
            id: $(this).val()
        },
        success: function (data, status, event) {
            if (data) {
                $(this).html("Desbloquear letra");
                $('.modificar').html('Letra bloqueada').attr({
                    'href': '#',
                    'disabled': 'disabled',
                    'class': 'btn btn-default modificar'
                });
            } else {
                $(this).html("Bloquear letra");
                $('.modificar').html('Modificar letra').attr({
                    'href': '/letras/update?id='+$(this).val(),
                    'class': 'btn btn-default modificar'
                });
                $('.modificar').removeAttr("disabled");
            }
        }
    });
});

$('#favorito').click(function(e) {
    $.ajax({
        method: 'POST',
        url: url2,
        context: this,
        data: {
            id: $(this).val()
        },
        success: function (data, status, event) {
            $(this).empty();
            $('#contador').empty();
            if (data[0]) {
                $(this).append('<span class="glyphicon glyphicon-heart" aria-hidden="true" id="iconoLLeno">');
            } else {
                $(this).append('<span class="glyphicon glyphicon-heart-empty" aria-hidden="true" id="icono"></span>');
            }
            $('#contador').append('<span id="contador">' + data[1] +'</span> Favoritos');
        },
        dataType:"json"
    });
});

function checkOffset() {
      var a=$(document).scrollTop()+window.innerHeight;
      var b=$('.comment-wrapper').offset().top;
      if (a<b) {
        $('.panel-letra').css('bottom', '100px');
      } else {
        $('.panel-letra').css('bottom', (100+(a-b))+'px');
      }
}
$(document).ready(checkOffset);
$(document).scroll(checkOffset);
