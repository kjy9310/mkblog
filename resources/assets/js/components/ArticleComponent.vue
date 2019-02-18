<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{article.name}}</div>
                    <div class="panel-body">
                        {{article.content}}
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
        props:{
            article_id:Number,
        },
        data(){
            return {
                article:'',
                };
        },
        mounted() {
            console.log('article mounted.');
        },
        methods:{
            testconsole:function(){
                console.log(this.user);
            },
        },
        apollo: {
            article: gql`query ($article_id:ID){
                article(id:$article_id){
                    id
                    title
                    content
                }
            }`,
            // Reactive parameters
            variables () {
                // Use vue reactive properties here
                return {
                    article_id: this.article_id,
                }
            },
        }
    }
</script>
