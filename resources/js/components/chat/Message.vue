<template>
    <div class="chat-lists">
    <div class="messages" v-for="message in messages" v-bind:key="message.id">
        <div class="users">
            {{ message.user.name }}
            <span class="time">{{ message.created_at }}</span>
        </div>
        <div class="message">
            {{ message.subject }}
            
        </div>
    </div>
    </div>
</template> 
<style lang="scss">
    .messages {
        margin-top: 5px;
        .time {
            font-weight: 800;
        }
        .message {
            font-size: 2rem;
        }
    }
    .chat-lists {
        max-height: 300px;
        overflow-y : scroll;
    }
</style>
<script>
import BUS from '../../bus'
export default {
    data () {
        return {
            messages : []
        }   
    },
    mounted () {
        BUS.$on('chat.sent',(message) => {
            this.messages.push(message)
            this.scrollToBottom()
        }).$on('chat-removed',(message) => {
            this.removeChat(message.id)
        })
        this.getMessages();
    },
    methods : {

        getMessages() {
            axios.get('/chat/messages')
                .then(response => {
                    this.messages = response.data.reverse()
                    this.scrollToBottom()
                })
                .catch(err => console.log(err))
        },
        scrollToBottom() {
            setTimeout(() => {
                let chatList  = document.getElementsByClassName('chat-lists')[0];
                chatList.scrollTop = chatList.scrollHeight
            },1000)
        },
        removeChat(id) {
            this.messages = this.messages.filter(u => u.id !== id )
        }
    }
}
</script>