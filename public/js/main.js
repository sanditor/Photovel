var url = 'http://localhost:8000';
window.addEventListener("load", function () {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado like a la publicacion');

                    } else {
                        console.log('Error al dar like');
                    }

                }
            });

            dislike();
        });
    }
    like();

    //boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart-grey.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado dislike a la publicacion');

                    } else {
                        console.log('Error al dar dislike');
                    }

                }
            });

            like();
        });
    }
    dislike();

    //buscador

    $('#buscador').submit(function(e){
         $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
      });

      //contenedor imagen

      $('input[type=file]').change(function(e) {
        if(typeof FileReader == "undefined") return true;

        var elem    = $(this);
        var files   = e.target.files;

        for ( var i = 0, f; f = files[i]; i++ ) {

            if ( f.type.match('image.*') ) {
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        var image = e.target.result;

                        previewDiv  = $('.home-image', elem.parent() );
                        bg_width    = previewDiv.width() * 2;

                        previewDiv.css({
                            "background-size"   : "cover",
                            "background-image"  : "url("+image+")"
                        });
                    };

                })(f);

                reader.readAsDataURL(f);
            }
        }
    });
});


