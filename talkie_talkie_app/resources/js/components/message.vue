<template>
    <div>
        <li class="list-group-item" :class="className"><slot> </slot>
        <span id="time">{{time}}</span>
        </li>

        <small class="badge rounded-pill" :class="badgeClass"> {{user}} - {{pronouns}}</small>
    </div>

</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'pronouns',
            'time'
        ],
        computed:{
            className(){
                return 'list-group-item-'+this.color;
            },
            badgeClass(){
                return 'bg-'+this.color;
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<!--Todo: write this in a better place-->
<style>
    #time{
        font-size:8px;
        margin-top:50%;
        color:gray;
    }
</style>
