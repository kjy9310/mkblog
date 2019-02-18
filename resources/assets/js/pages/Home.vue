<template>
    <div>
        <articleComp v-bind:article_id ="article_id"></articleComp>
        <list @changeArticle=changeArticle></list>
    </div>
</template>

<script>
    import Vue from 'vue'

    import articleComp from '../components/ArticleComponent.vue'
    import list from '../components/ListComponent.vue'
    export default {
        data(){
            return {
                article_id:1
            }
        },
        components:{
            articleComp, list
        },
        mounted() {
            console.log('home mounted.');
        },
        methods:{
            changeArticle(val){
                console.log(val)
                this.article_id=parseInt(val)
            }
        }
    }
</script>
