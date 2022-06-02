<!-- Dynamic HTML tags-->
<template>
    <div>
        <small class="badge rounded-pill" :class="badgeClass">{{user}}</small>
        <li class="list-group-item" :class="className"><slot> </slot>
        <span id="time">{{time}}</span>
        </li>

        
    </div>
</template>

<script>
    //Variables that would be shown in the view
    export default {
        props:[
            'color',
            'user',
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
            //console.log('Component mounted.')
        }
    }
</script>
