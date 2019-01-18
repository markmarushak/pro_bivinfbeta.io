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
            c.find('.time').append('<h5>-- сроки исполнения -- <a tabindex="0" class="popover-dismiss text-dark" role="button" data-toggle="popover"><i class="fas fa-info-circle"></i></a></h5>'+data[0].time);
            c.find('.region').append('<h5>-- Регион исполнения --</h5>'+data[0].region);
            c.find('.text').append('<h5>-- описание услуги --</h5><p>'+data[0].text+'</p>');
            popover();
        });

    });

    $.get('/section',function(data){
        for (var i = data.length - 1; i >= 0; i--) {
            $('#'+data[i].section_id+' p').append(data[i].text);
        }
    });

    $('body').append('<div id="modal-block"></div>')
    modal_garant();
});

function modal_garant() {

    $('#modal-block').html(
        `<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Гарант</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        Гарант сделок - это независимый гарант-сервис в сети интернет, обеспечивая выполнение оговоренных условий с обеих сторон сетевой сделки. <br>
Суть работы Гарант-Сервиса заключается в оказании посреднических (гарантийных) услуг в проведении купли-продажи товаров и услуг в интернете с контролем выполнения обязательств по сделке в полном объеме, согласно заключённых договоренностей, каждой из заинтересованных сторон.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Я ПРОЧИТАЛ</button>
        
      </div>
    </div>
  </div>
</div>`
    );
}

function popover() {

    var content = 'Гарант сделок - это независимый гарант-сервис в сети интернет, обеспечивая выполнение оговоренных условий с обеих сторон сетевой сделки.Суть работы Гарант-Сервиса заключается в оказании посреднических (гарантийных) услуг в проведении купли-продажи товаров и услуг в интернете с контролем выполнения обязательств по сделке <br> в полном объеме, согласно заключённых договоренностей, каждой из заинтересованных сторон.'

    $('.popover-dismiss').popover({
        trigger: 'focus',
        content: content

    });
}