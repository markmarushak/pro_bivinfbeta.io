<template>
    <div class="chat-wrap">
        <div class="chat-icon" v-bind:class="[isActive ? chatState : '']">
            <a href="#" @click.prevet="OpenChat">
                <i class="fas fa-sms"></i>
            </a>
        </div>
        <div class="main-chat" v-bind:class="[isActive ? chatState : '']">
            <div class="chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight justify-content-between">
                            <div class="user_info">
                                <span>Менеджер</span>
                                <p>1767 Messages</p>
                            </div>
                            <div class="close color-white" @click="OpenChat">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>

                    </div>
                    <div class="card-body msg_card_body" id="chat_body">
                            <List v-for="(message, index) in conversations" :key="index" :data="message"></List>
                            <h4 v-if="manager.status == 'block'" class="text-danger">Вы зблокированы</h4>
                    </div>
                    <div class="card-footer">
                        <div class="input-group" v-if="manager.status == 'open'">
                            <textarea name="" class="form-control type_msg" @keyup.enter="send" v-model="message" placeholder="Type your message..."></textarea>
                            <div class="input-group-append" v-if="manager.status != 'block'">
                                <span class="input-group-text send_btn" @click="send" ><i class="fas fa-location-arrow"></i></span>
                            </div>
                        </div>
                        <div class="input-group" v-if="manager.status == 'close'">
                           <button class="btn btn-block btn-info btn-lg" @click="send">Начать чат</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios'
    import List from "./List.vue"

    let arrays = []
    let manager = {status: 'close'}
    export default {
        data(){
            return {
                message: '',
                conversations: arrays,
                manager: manager,
                chatState: 'disabled',
                isActive: true
            }
        },
        mounted() {
            socket.on('message', function(data){
                if(data == 'Завершить') {
                    manager.status = 'close'
                }else if(data == 'Заблокировать'){
                    manager.status = 'block'
                }else{

                    manager.status = 'open'
                    arrays.push({name:'manager', message:data})
                }
//                this.ScrollChatDown()
            })
        },
        methods: {
            send(){
                console.log('status', manager.status)
                if(manager.status == 'close'){
                    axios.post('/conversations', {client_id: socket.id, message: '', status: manager.status})
                        .then((res) => {
                            if(res.data != ''){
                                this.conversations.push({name:'manager', message: res.data.message})
                            }
                    })
                }else if(this.message.trim() != ''){
                    axios.post('/conversations', {client_id: socket.id, message: this.message})

                    this.conversations.push({name:'client', message: this.message})
                    // socket.send(this.message)
                    this.message = ''
                    this.ScrollChatDown()
                }
            },
            ScrollChatDown(){
                var container = this.$el.querySelector("#chat_body");
                container.scrollTop = parseInt(container.scrollHeight + 20);
            },
            OpenChat()
            {
                this.isActive = !this.isActive
            }
        },
        wath: {
            manager: function(i){
                alert(i)
                this.manager = i
            }
        },
        computed:{
            messages(data){
                this.conversations.filter((f) => {
                    return f
                })
            }
        },
        components:{
            'List': List
        }
    }
</script>


<style>

    .main-chat{
        min-width: 320px;
        border-radius: 15px;
        height: auto;
        margin: 0;
        background: #7F7FD5;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        -ms-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .3s ease;
        position: fixed;
        bottom: 50px;
        right: 20px;
    }

    @media screen and (max-width: 425px) {
        .main-chat {
            border-radius: 0;
            max-height: 100vh;
            bottom: 0%;
            right:0;
            z-index: 999;
        }
    }

    .main-chat.disabled {
        opacity: 0;
        z-index: -100;
        bottom: 0px;
        right: 20px;
    }

    .chat-icon {
        position: fixed;
        bottom: 60px;
        right: 80px;
        opacity: 1;
    }

    .chat-icon.disbled {
        position: fixed;
        bottom: 60px;
        right: 80px;
        opacity: 0;
        z-index: -100;
    }

    .chat-icon a {
        text-decoration: none;
        border-radius: 50%;
        background: #7F7FD5;
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        width: 80px;
        height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 3em;
        transition: transform .3s;
        transform: rotate3d(0);
    }

    .chat-icon:hover a{
        transform: rotate3d(1, 1, 1, 360deg);
    }


    .chat{
        margin-top: auto;
        margin-bottom: auto;
    }

    .card{
        height: 500px;
        border-radius: 15px !important;
        background-color: rgba(0,0,0,0.4) !important;
    }
    .contacts_body{
        padding:  0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
    }
    .msg_card_body{
        overflow-y: auto;
    }
    .card-header{
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
    }
    .card-footer{
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }
    .container{
        align-content: center;
    }
    .search{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
    }
    .search:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .type_msg{
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
        height: 60px !important;
        overflow-y: auto;
    }
    .type_msg:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .attach_btn{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .send_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .search_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts{
        list-style: none;
        padding: 0;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }
    .active{
        background-color: rgba(0,0,0,0.3);
    }
    .user_img{
        height: 70px;
        width: 70px;
        border:1.5px solid #f5f6fa;

    }
    .user_img_msg{
        height: 40px;
        width: 40px;
        border:1.5px solid #f5f6fa;

    }
    .img_cont{
        position: relative;
        height: 70px;
        width: 70px;
    }
    .img_cont_msg{
        height: 40px;
        width: 40px;
    }
    .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .offline{
        background-color: #c23616 !important;
    }
    .user_info{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 15px;
    }
    .user_info span{
        font-size: 20px;
        color: white;
    }
    .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
    }
    .video_cam{
        margin-left: 50px;
        margin-top: 5px;
    }
    .video_cam span{
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-right: 20px;
    }
    .msg_cotainer{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        border-radius: 25px;
        background-color: #82ccdd;
        padding: 10px;
        position: relative;
    }
    .msg_cotainer_send{
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 10px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 10px;
        position: relative;
    }
    .msg_time{
        position: absolute;
        left: 0;
        bottom: -15px;
        color: rgba(255,255,255,0.5);
        font-size: 10px;
    }
    .msg_time_send{
        position: absolute;
        right:0;
        bottom: -15px;
        color: rgba(255,255,255,0.5);
        font-size: 10px;
    }
    .msg_head{
        position: relative;
    }
    #action_menu_btn{
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }
    .action_menu{
        z-index: 1;
        position: absolute;
        padding: 15px 0;
        background-color: rgba(0,0,0,0.5);
        color: white;
        border-radius: 15px;
        top: 30px;
        right: 15px;
        display: none;
    }
    .action_menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .action_menu ul li{
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 5px;
    }
    .action_menu ul li i{
        padding-right: 10px;

    }
    .action_menu ul li:hover{
        cursor: pointer;
        background-color: rgba(0,0,0,0.2);
    }
    @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }

        .card-footer {
            padding: 0;
            margin-bottom: 15px;
        }

        .chat-icon {
            bottom: 50px;
            right: 10px;
        }

        .chat-icon a {
            width: 60px;
            height: 60px;
            font-size: 2em;
        }
    }

</style>