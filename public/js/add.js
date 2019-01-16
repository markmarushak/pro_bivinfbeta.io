$(document).ready(function () {



    showMainGroup();
    showSubGroup();



    $('#add-main-groups').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.get('/admin/add/ad-gr', data, function (data) {
            console.log(data);
            showMainGroup();
            showSubGroup();
        });
    });

    $('#add-sub-groups').submit(function (el) {
        el.preventDefault();
        var data = $(this).serialize();
        $.get('/admin/add/ad-gr', data, function (data) {
            console.log(data);
            showMainGroup();
            showSubGroup();
        });
    });


});

function opSh(t) {
    $('.option').removeClass('show');
    $('.item-group').removeClass('parent');
    $(t).next().addClass('show');
    $(t).addClass('parent');

    var id = $(t).attr('data-id');
    $.get('/admin/add/parent',{id: id},function (data) {
        console.log(data);
        for(var i=0; i<data.length;i++)
        {
            $('*[data-id='+data[i].id+']').addClass('parent');
        }
    })
}

function edit(t) {
    var id = $(t).parent().prev().attr('data-id');
    var old_text = $(t).parent().prev().text();
    var text = prompt('введите новое название :)',old_text);
    $.get('/admin/add/edit', {id: id,text: text}, function (data) {
        showMainGroup();
        showSubGroup();
    });
}

function remove(t) {
    var id = $(t).parent().prev().attr('data-id');
    $.get('/admin/add/remove', {id: id}, function (data) {
        showMainGroup();
        showSubGroup();
    });
}

function showMainGroup() {
    $.ajax({
        method: 'GET',
        url: '/admin/add/show',
        data: {main:true}
    }).done(function (data) {
        $('#add-sub-main-group, #main-group').html('');
        $('#add-sub-main-group').append('<option value="-">Выберите</option>');
        for(var i=0; i < data.length; i++){
            $('#add-sub-main-group').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
            $('#main-group').append('<div class="box-group"><button class="name-main-group item-group" data-id="'+data[i].id+'" onclick="script:opSh($(this));">'+data[i].name+'' +
                '</button>' +
                '<div class="option hidden">' +
                '<span class="remove" onclick="script:remove($(this))"><i class="fas fa-times-circle"></i></span>' +
                '<span class="edit" onclick="script:edit($(this));"><i class="fas fa-edit"></i></span>' +
                '</div>'+
                '</div>')
        }
    });
}

function showSubGroup() {
    $.ajax({
        method: 'GET',
        url: '/admin/add/show',
        data: {main:false}
    }).done(function (data) {
        $('#ch-group').html('');
        for(var i=0; i < data.length; i++){
            $('#ch-group').append('<div class="box-group"><button class="name-main-group item-group" data-id="'+data[i].id+'" onclick="script:opSh($(this));">'+data[i].name+'' +
                '</button>' +
                '<div class="option hidden">' +
                '<span class="remove" onclick="script:remove($(this))"><i class="fas fa-times-circle"></i></span>' +
                '<span class="edit" onclick="script:edit($(this));"><i class="fas fa-edit"></i></span>' +
                '</div>'+
                '</div>')
        }
    });
}