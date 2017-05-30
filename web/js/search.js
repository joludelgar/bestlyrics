var canciones = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: urlCanciones,
        wildcard: '%QUERY'
    }
});

var artistas = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: urlArtistas,
        wildcard: '%QUERY'
    }
});

var albumes = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: urlAlbumes,
        wildcard: '%QUERY'
    }
});

$('.typeahead').typeahead({
    hint: true,
    minLength: 1,
}, {
    name: 'canciones',
    source: canciones,
    displayKey: 'nombre',
    limit: 5,
    templates: {
        header: '<h4 class="name">Canciones</h4>',
        suggestion: function(data) {
            html = '<div class="media">';
            html += '<p"><a href ="' + cancionesView + data.id + '">' + data.nombre + ' - <small>' + data.artista + '</small></a></p>';
            html += '</div></div>';
            return html;
        }
    }
}, {
    name: 'artistas',
    source: artistas,
    displayKey: 'nombre',
    limit: 5,
    templates: {
        header: '<h4 class="name">Artistas</h4>',
        suggestion: function(data) {
            html = '<div class="media row">';
            html += '<div class="media-body">';
            html += '<div class="media-heading"><div class="image-search img-circle col-md-12" style="background:url(' + data.cover + ');background-size: cover;background-repeat: no-repeat;background-position: center;"></div><a href="' + artistasView + data.id + '">' + data.nombre + '</a></div>';
            html += '</div></div>';
            return html;
        }
    }
}, {
    name: 'albumes',
    source: albumes,
    displayKey: 'nombre',
    limit: 5,
    templates: {
        header: '<h4 class="name">Álbumes</h4>',
        suggestion: function(data) {
            html = '<div class="media row">';
            html += '<div class="media-body">';
            html += '<div class="media-heading"><div class="image-search img-circle col-md-12" style="background:url(' + data.cover + ');background-size: cover;background-repeat: no-repeat;background-position: center;"></div><a href ="' + albumesView + data.id + '">' + data.nombre + '</a></div>';
            html += '<div class="media-artist"><small id="artist"><a class="artist-data" href="' + artistasView + data.artistaId + '">' + data.artista + '</a></small></div>';
            html += '</div></div>';
            return html;
        }
    }
});
