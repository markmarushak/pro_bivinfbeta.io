$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#add_content select').change(function () {
        var s = $('#add_content');
        $('#content_text').html('<textarea name="text" cols="30" rows="10" class="form-control text"></textarea>');
        $.get('/content',{id: $(this).find('option:selected').val()}, function (data) {
            s.find('.price').val(data[0].price);
            s.find('.time').val(data[0].time);
            s.find('.text').text(data[0].text);
        });
    });



    $('#add_content').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: 'POST',
            url:'/admin/add/ad-con',
            dataType: 'JSON',
            data: {_token: CSRF_TOKEN, data:data}
        }).done(function(data){

        });
    });

    $('#add_section').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.post('/admin/add/ad-sec', {_token: CSRF_TOKEN, data:data}, function (data) {
        });
    });

    $('#add_section select').change(function () {
        var s = $('#add_section');
        $('#section_text').html('<textarea name="text" cols="30" rows="10" class="form-control text"></textarea>');
        var id = $(this).find('option:selected').val();
        $.get('/section',{id: id}, function (data) {
            console.log(data);
            s.find('.text').text(data[0].text);
        });
    });


});

function clearContents(element) {
    element.value = '';
}