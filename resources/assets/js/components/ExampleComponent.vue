<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        {{user.name}} : I'm an example component!
                        <button v-on:click="testconsole()">test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import gql from 'graphql-tag'
    export default {
        data(){
            return {user:'',};
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods:{
            testconsole:function(){
                console.log(this.user);
            },
        },
        apollo: {
            user: gql`query {
                user(id:1){
                    id
                    name
                    email
                }
            }`,
        }
    }
</script>
