$(document).ready(function () {

    $('#add_content select').change(function () {
        var s = $('#add_content');
        $.get('/content',{id: $(this).find('option:selected').val()}, function (data) {
            s.find('.price').val(data[0].price);
            s.find('.time').val(data[0].time);
            s.find('.text').text(data[0].text);
        });
    });

    $('#add_section select').change(function () {
        var s = $('#add_section');
        s.find('.text').text(' ');
        var id = $(this).find('option:selected').val();
        $.get('/section',{id: id}, function (data) {
            s.find('.text').text(data[0].text);
        });
    });

    $('#add_content').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.get('/admin/add/ad-con', data, function (data) {
        });
    });

    $('#add_section').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.get('/admin/add/ad-sec', data, function (data) {
        });
    });


});