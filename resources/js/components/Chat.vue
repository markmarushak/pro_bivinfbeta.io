<template>

</template>

<script>
    export default {
        props: ['group'],

        data() {
            return {
                conversations: [],
                message: '',
                group_id: this.group.id
            }
        },

        mounted() {
            this.listenForNewMessage();
        },

        methods: {
            store() {
                axios.post('/conversations', {message: this.message, group_id: this.group.id})
                    .then((response) => {
                    this.message = '';
                this.conversations.push(response.data);
            });
            },

            listenForNewMessage() {
                Echo.private('groups.' + this.group.id)
                    .listen('NewMessage', (e) => {
                    // console.log(e);
                    this.conversations.push(e);
            });
            }
        }
    }
</script>