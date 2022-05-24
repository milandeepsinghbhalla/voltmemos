<template>
    <div class="container mt-4">
       
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
                <button class="btn btn-sm btn-success" v-if="add_comment_now==0" v-on:click="add_comment_now_clicked">Add comment</button>
                <add-comment-component v-if="add_comment_now==1" v-bind:comments="comments"></add-comment-component>
                <h5 class="mt-3">Comments:-</h5>
            </div>
        <show-comments-component v-for="comment in comments" v-bind:key="comment.key"  v-bind:comment="comment" v-bind:p_email="null"></show-comments-component>
        </div>
    </div>
</template>

<script>
import show_comments_component from './show_comments_component.vue'
import add_comment_component from './add_comment_component.vue'

export default{
    data: function(){
        return {
            blog_id: 0,
            add_comment_now:0,
            comments: []
        }
    },
    created(){
        this.blog_id = this.$route.params.id;
        let obj = {
            blog_id: this.blog_id
        }
        this.$http.post('/api/get-comments',obj).then(res=>{
            if(res.body.comments!=null&&res.body.comments!="")
                this.comments = JSON.parse(res.body.comments);
        })
        
         
    },
    updated(){
        this.$root.$on('update_add_comment',(data)=>{
            this.add_comment_now = data.new_value
            let obj = {
            blog_id: this.blog_id,
                comments: JSON.stringify(this.comments)
            }
            this.$http.post('/api/update-comments',obj).then(res=>{
                console.log("comments updated");
            })
        })
    },
    components:{
        'show-comments-component': show_comments_component,
        'add-comment-component': add_comment_component
    },
    methods:{
        add_comment_now_clicked(){
            this.add_comment_now= 1;
            setTimeout(()=>{
                this.$scrollTo('.scroll-target');
            },10)
            
        }
    }
}
</script>
