<template>
    <form>
        <div class="form-group">
            <textarea name="message" cols="30" rows="10" class="form-control" v-model="body" @keydown="handleInput"></textarea>
        </div>
    </form>
</template> 
<script>
import Bus from '../../bus'
import moment from 'moment'
export default {
   data() {
       return {
           body : null
       }
   },
   methods : {
       handleInput(e) {
           if(e.keyCode === 13 && !e.shiftKey) {
               e.preventDefault();
               this.submit();
           }
       },
       submit() {
           if(!this.body || this.body.trim() === '') {
               console.log('cannot be null')
               return
           }

            let newMessage = {
                id : Date.now(),
                subject : this.body.trim(),
                created_at : moment.utc(0).format('YYYY-MM-DD hh:mm:ss'),
                user : {
                    name : Laravel.user.name
                }
            }

            let message = this.body.trim()
            Bus.$emit('chat.sent',newMessage)
            this.body = ''
            
            axios.post('/chat/messages',{ subject:message })
                 .then(response => {

                 })
                 .catch(err => {
                     this.body = message
                     Bus.$emit('chat.removed',newMessage)
                 })
       }
   }
}
</script>