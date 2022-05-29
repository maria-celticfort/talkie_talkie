/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 import axios from 'axios';
 import Echo from 'laravel-echo';
 import Vue from 'vue';
 
 import VueChatScroll from 'vue-chat-scroll';
 Vue.use(VueChatScroll);
 
 
 import Toaster from 'v-toaster';
 import 'v-toaster/dist/v-toaster.css'
 Vue.use(Toaster, {timeout: 5000})
 
 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 //Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('message', require('./components/message.vue').default);

 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 //(`chat.${this.conversation_id}`)
 const app = new Vue({
     el: '#app',
     data:{
         message:'',
         chat:{
             message:[],
             user:[],
             pronouns:[],
             color:[],
             time:[],
         },
         typing:'',
         number_of_users:0,
         conversation_id: window.__payload
     },
     watch:{
         message(){
             window.Echo.private(`chat.${this.conversation_id}`)
                 .whisper('typing',  {
                     name: this.message
                 })
                }
     },
    //  beforeMount() {
    //     window.axios.get('/api/conversation_id').then(res => {
    //         this.conversation_id = res.data
    //         console.log('Hola');
    //         console.log(this.conversation_id);
    //     })
    // },
     methods:{
         send_message(){
             if (this.message !== "") {
                 this.chat.message.push(this.message);
                 this.chat.user.push('you');
                 this.chat.color.push('success');
                 this.chat.time.push(this.getTime());
                 axios.post('/send_message',{
                     message : this.message
                 })
                 .then(response => {
                     console.log(response);
                     this.message=''
                 })
                 .catch(error => {
                     console.log(error);
                 });
 
             }
         },
         getTime(){
             let time = new Date();
             return time.getHours()+':'+time.getMinutes();
         },
     },
     mounted(){
         // window.axios.get('/api/conversation_id2').then(res => {
         //     this.conversation_id2 = res.data;
         //     console.log(this.conversation_id2);
         // })
         //window.Echo.private(`chat.298`)
         console.log('hola de nuevo');
         console.log(window.__payload);
         window.Echo.private(`chat.${this.conversation_id}`)
         .listen('ChatEvent',(e) =>{
             this.chat.message.push(e.message);
             this.chat.user.push(e.user);
             this.chat.pronouns.push(e.pronouns);
             this.chat.color.push('warning');
             this.chat.time.push(this.getTime());
         })
         .listenForWhisper('typing', (e) =>{
             if (e.name != ''){
                 this.typing= 'typing...'
             }else{
                 this.typing='';
             }
         });
         window.Echo.join(`chat.${this.conversation_id}`)
             .here((users) => {
                 this.number_of_users = users.length;
             })
             .joining((user) => {
                 this.number_of_users += 1;
                 this.$toaster.success(user.name +' joined the chat');
             })
             .leaving((user) => {
                 this.number_of_users -= 1;
                 this.$toaster.error(user.name +' left the chat');
             })
 
     }
 });