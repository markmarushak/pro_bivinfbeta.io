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
        c.find('.name').html('<h4>'+$(this).text()+'</h4>');
        c.find('.price, .time, .region, .text').html('');
        $('.menu div').removeClass('show');
        $.get('/content', {id: $(this).attr('data-id')}, function (data) {
            c.find('.price').append('<h5>-- стоимость --</h5>'+data[0].price+' руб.');
            c.find('.time').append('<h5>-- сроки исполнения --</h5>'+data[0].time);
            c.find('.region').append('<h5>-- Регион исполнения --</h5>'+data[0].region);
            c.find('.text').append('<h5>-- описание услуги --</h5><p>'+data[0].text+'</p>');
        });
    });

    $.get('/section',function(data){
        for (var i = data.length - 1; i >= 0; i--) {
            $('#'+data[i].section_id+' p').append(data[i].text);
        }
    });

});