<template>
    <div class="main-chat">

        <div class="chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="user_info">
                            <span>Менеджер</span>
                            <p>1767 Messages</p>
                        </div>
                    </div>

                </div>
                <div class="card-body msg_card_body">
                        <List v-for="(message, index) in conversations" :key="index" :data="message"></List>
                        <h4 v-if="manager.status == 'block'" class="text-danger">Вы зблокированы</h4>
                </div>
                <div class="card-footer">
                    <div class="input-group" v-if="manager.status == 'open'">
                        <textarea name="" class="form-control type_msg" v-model="message" placeholder="Type your message..."></textarea>
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
                manager: manager
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

            })
        },
        methods: {
            send(){
                if(manager.status == 'close'){
                    axios.post('/conversations', {client_id: socket.id, message: ''})
                }else{
                    axios.post('/conversations', {client_id: socket.id, message: this.message})
                }
                if(this.message != ''){
                    this.conversations.push({name:'client', message: this.message})
                    // socket.send(this.message)
                    this.message = ''
                }

            },
            addConversations(data){
                this.conversations.push({text:data})
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
