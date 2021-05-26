var web = 'http://topwines.es'
$(document).ready(function () {

    //Boton like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).removeClass('btn-like');
            $(this).addClass('btn-dislike');
            $(this).attr('src', web + '/img/like-blue.png');
            $.ajax({
                url: web + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log("Has dado like a este vino");
                    } else {
                        console.log("error");
                    }
                }
            });
            dislike();
            reload();
        });
    }
    like();
    //Boton dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).removeClass('btn-dislike');
            $(this).addClass('btn-like');
            $(this).attr('src', web + '/img/like-black.png');
            $.ajax({
                url: web + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log("Has dado dislike a este vino");
                    } else {
                        console.log("error al dar dislike");
                    }
                }
            });
            like();
            reload();
        });
    }
    dislike();

    //Boton favorito
    function favourite() {
        $('.btn-favourite').unbind('click').click(function () {
            console.log('favourite');
            $(this).removeClass('btn-favourite');
            $(this).addClass('btn-quitFavourite');
            $(this).attr('src', web + '/img/heart-red.png');
            $.ajax({
                url: web + '/favourite/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.favourite) {
                        console.log("Has dado favourito a este vino");
                    } else {
                        console.log("error");
                    }
                }
            });
            quitFavourite();
        });
    }
    favourite();
    //Boton quitar Favourito
    function quitFavourite() {
        $('.btn-quitFavourite').unbind('click').click(function () {
            console.log('quit Favourite');
            $(this).removeClass('btn-quitFavourite');
            $(this).addClass('btn-favourite');
            $(this).attr('src', web + '/img/heart-black.png');
            $.ajax({
                url: web + '/quitfavourite/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.favourite) {
                        console.log("Has quitado de favorito a este vino");
                    } else {
                        console.log("error al dar quitFavourite");
                    }
                }
            });
            favourite();
        });
    }
    quitFavourite();

    //Funcion para recargar la pagina cada vez que demos like odislike  y se actualice el contador
    function reload() {
        if ($('.btn-like').unbind('click').click()) {
            location.reload();
        } else if ($('.btn-dislike').unbind('click').click()) {
            location.reload();
        }
    }

});
