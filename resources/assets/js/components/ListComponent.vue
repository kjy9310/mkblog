<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">list</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li @click="$emit('changeArticle',article.id)" v-for="article in articles" class="list-group-item">
                                <span>{{article.id}}</span>
                                <span>{{article.title}}</span>
                                <span>{{article.user.name}}</span>
                            </li>
                        </ul>
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
            return {
                articles:'',
                };
        },
        mounted() {
            console.log('list mounted.');
        },
        methods:{
            testconsole:function(){
                console.log(this.user);
            },
        },
        apollo: {
            articles: gql`query {
                articles{
                    id
                    title
                    user{
                        name
                    }
                }
            }`,
        }
    }
</script>
