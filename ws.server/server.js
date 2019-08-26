// var fs = require('fs')
// var options = {
//     key: fs.readFileSync('/home/admin/web/probiv.cf/public_html/ws.server/probiv.cf.key'),
//     cert: fs.readFileSync('/home/admin/web/probiv.cf/public_html/ws.server/probiv.cf.crt'),
//     ca: fs.readFileSync('/home/admin/web/probiv.cf/public_html/ws.server/probiv.cf.ca'),
//     requestCert: true
// };

// server-side
const fs = require('fs');
const server = require('https').createServer({
    key: fs.readFileSync('/home/admin/conf/web/ssl.probiv.cf.key'),
    cert: fs.readFileSync('/home/admin/conf/web/ssl.probiv.cf.crt'),
    ca: fs.readFileSync('/home/admin/conf/web/ssl.probiv.cf.ca'),
});
const io = require('socket.io')(server);
server.listen(6001);

// var server = https.createServer(options).listen(6001);

var TelegramBot = require('node-telegram-bot-api'),
    request = require('request');

// var https = require('https');
// var express = require('express');
// var app = express();
// var server = https.createServer(options, app);
// var io = require('socket.io')(6001);

// server.listen(6001);

// WARNING: app.listen(80) will NOT work here!


// ### TELEGRAM BOT SETTING ### //
var host = 'https://in-touch.ooo/api/'
var token = '798419976:AAEGP058AxX6pXBzHs88P7ETopD0dvqPXJ0';
var client = ''
var main = {
    "keyboard": [["Ушел"], ["Свободен"]]
}
var client_find = new RegExp('client')

var open_chat = {
    "keyboard": [["Принять"], ["Заблокировать"]]
}
// Включить опрос сервера
var bot = new TelegramBot(token, {polling: true});



function status(msg, status) {
    request.get(host+'manager-status?chat_id='+msg.from.id+'&status='+status)
}

function verb_manager(msg){
    request.get(host+'verbation?chat_id='+msg.from.id+'&client_id='+client)
}

function send_message(text, socketid) {
    io.to(socketid).emit('message', text)
}

bot.onText(/\/start/, function(msg) {
    request.get(host+'storeChat?chat_id='+msg.from.id)
    bot.sendMessage(msg.from.id, 'Привет Менеджер, давай поработаем вместе', {
        'reply_markup': main
    })
})

bot.on('message', function (msg) {
    if(msg.text == 'Ушел'){
         status(msg, 'close')
    }
    else if(msg.text == 'Свободен'){
        status(msg, 'open')
    }
    else if(msg.text == 'Принять'){
        status(msg, 'close')
        bot.sendMessage(msg.from.id, 'Отправь мне id чата для подтверждения "client adsasdasd00f0"')
    }
    else if(msg.text == 'key'){
        bot.sendMessage(msg.from.id, client)
    }
    else if(msg.text == 'Заблокировать'){
        status(msg, 'open')
        send_message(msg.text, client)
    }
    else if(msg.text == 'Завершить'){
        status(msg, 'open')
        send_message(msg.text, client)
        bot.sendMessage(msg.from.id, 'Вы завершили чат с клиентом', {
            'reply_markup': main
        })

    }
    else {
        if(/client /.exec(msg.text)){
            status(msg, 'close')
            bot.sendMessage(msg.from.id, 'Вы начали чат с клиентом, ожидайте вопроса..')
            var id = msg.text.replace('client ', '')
            client = id
            verb_manager(msg)
        }else{
            send_message(msg.text, client)
        }
    }
})

io.on('connection', function (socket) {

    console.log("New connection "+ socket.id)

    socket.on('message', function (data) {
        console.log(data)
        socket.broadcast.send(data)
    })

});
