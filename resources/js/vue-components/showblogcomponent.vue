<template>
    <div class="container" style="margin-top: 8.5em;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                 <div id="showblog"></div>

                 
            </div>
        </div>
    </div>
</template>
<script>

import Vue from "vue";



    export default{
        data: function(){
            return {
                blogdata: "",
                blog_id: 0,
            }
        },
        mounted(){
            var sbquill = new Quill('#showblog', {
            modules:{
                toolbar: false
            },
            readOnly: true,
            theme: 'snow'
            });
           let blogdata = JSON.parse(localStorage.getItem('blogdata'));
            console.log(this.$route.params.id);
            this.blog_id = this.$route.params.id;
            let obj = {
                blog_id : this.blog_id
            }
            this.$http.post("/api/get-blog-data",obj).then(res=>{
                this.blogdata = JSON.parse(res.body.blogdata);
                 sbquill.setContents(this.blogdata);
            })
           
            
        },
        
        
    }
</script>