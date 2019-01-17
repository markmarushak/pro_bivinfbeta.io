$(document).ready(function () {
    $('.menu button').append('<span><i class="fas fa-angle-down"></i></span>');

    $('.menu button').click(function (el) {
        el.preventDefault();
        $('.menu div').removeClass('show');
        $(this).next().toggleClass('show');
        var drop = $(this).next(),
            h = $(document).height();
    });

    $('.menu a').click(function (el) {
        el.preventDefault();
        var c = $('#content');

        c.find('.price').html('');
        c.find('.time').html('');
        c.find('.text').html('');

        $('.menu div').removeClass('show');
        $.get('/content', {id: $(this).attr('data-id')}, function (data) {
            console.log(data);
            c.find('.price').append('<h4>стоимость :'+data[0].price+'</h4>');
            c.find('.time').append('<h4>сроки исполнения :'+data[0].time+'</h4>');
            c.find('.text').append('<h5>описание услуги :</h5><p>'+data[0].text+'</p>');

        });
    });

    $.get('/section',function(data){
        for (var i = data.length - 1; i >= 0; i--) {
            $('#'+data[i].section_id+' p').append(data[i].text);
        }
    });

});