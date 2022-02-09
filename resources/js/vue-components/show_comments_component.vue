<template>
       
            

                <div class="d-flex col-lg-7 col-12 mt-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-comments rounded-circle" style="font-size:1.3em;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>{{comment.email}} <span v-if="p_email!=null">replying to {{p_email}}</span><small class="text-muted ms-2"><i>Posted on {{comment.date}}</i></small></h5>
                        <p>{{comment.body}}</p>
                        <div>                  
                            <button v-if="comment.replies.length!=0" v-on:click="show_replies_clicked(comment)" class="btn btn-sm btn-dark">{{rep_button}}</button> <button class="btn btn-sm btn-success" :id="comment.key" v-if="add_reply_now==0" v-on:click="add_reply_now_clicked()">reply</button>
                        </div>
                        <add-comment-component v-if="add_reply_now==1" v-bind:comments="comment.replies"></add-comment-component>
                        <span v-if="show_replies_now==1">
                            <show-replies class="w-100"  v-for="rs in comment.replies" v-bind:key="rs.key" v-bind:comment="rs" v-bind:p_email="comment.email"></show-replies>
                        </span>   
                    </div>
                </div>
        

</template>
<script>
import add_comment_component from "./add_comment_component.vue";
        export default{
            
           props: ['comment','p_email'],
           name: "show-replies",
           data: function(){
               return {
                   add_reply_now:0,
                   show_replies_now: 0,
                   rep_button: "show replies"
               }
           },
           updated(){
               this.$root.$on('update_add_comment',(data)=>{
            this.add_reply_now = data.new_value
        })
           },
           methods: {
               show_replies_clicked(comment){
                   if(this.show_replies_now==0){
                    this.show_replies_now = 1;
                    this.rep_button = "hide replies"
                   }
                   else{
                       this.show_replies_now = 0;
                       this.rep_button = "show replies"
                   }
                   setTimeout(()=>{
                       let id = '#'+comment.replies[comment.replies.length-1].key
                        this.$scrollTo(id);
                    },10)
               },
               add_reply_now_clicked(){
                   this.add_reply_now = 1;
                  setTimeout(()=>{
                        this.$scrollTo('.scroll-target');
                    },10)
               }
           },
           components:{
               'add-comment-component':add_comment_component
           }
        }

</script>
