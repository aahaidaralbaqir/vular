<template>
    <div>
        <p>Daftar user online : {{ users.length }}!</p>
        <ul>
           <li v-for="user in users" v-bind:key="user.id">
               {{ user.name }}
            </li> 
        </ul>
    </div>
</template>

<script>
import Bus from '../../bus'
export default {
    data() {
        return {
            users  : []
        }
    },
    mounted () {  
        Bus.$on('chat.here',(users) => {
            this.users = users

        }).$on('chat.joining',(user) => {
            let check = this.users.some((el) => el.id == user.id)
            if(!check) {
                this.users.push(user)
            }
        }).$on('chat-leaving',(user) => {
            console.log('yah keluarrrrrrrr');
        })
    }
}
</script>