var io = require('socket.io')(6001)
var TelegramBot = require('node-telegram-bot-api')
var request = require('request')

var host = 'http://probiv.loc/api/'

var token = '798419976:AAEGP058AxX6pXBzHs88P7ETopD0dvqPXJ0';
// Включить опрос сервера
var bot = new TelegramBot(token, {polling: true});
var client = ''
var main = {
    "keyboard": [["Ушел"], ["Свободен"]]
}

var open_chat = {
    "keyboard": [["Принять"], ["Заблокировать"]]
}

var client_find = new RegExp('client')

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
        status(msg, 'open', {
            'reply_markup': main
        })
        send_message(msg.text, client)
        bot.sendMessage(msg.from.id, 'Вы закончили чат с клиентом ID '+id, {
            'reply_markup': main
        })
    }
    else {
        if(/client /.exec(msg.text)){
            var id = msg.text.replace('client ', '')
            client = id
            verb_manager(msg)
            send_message('Привет..', id)
            bot.sendMessage(msg.from.id, 'Вы начали чат с клиентом ID '+id)
        }else{
            send_message(msg.text, client)
        }
    }
})


io.on('connection', function (socket) {

    console.log("New connection "+ socket.id)

    socket.on('message', function (data) {
        socket.broadcast.send(data)
    })

});
