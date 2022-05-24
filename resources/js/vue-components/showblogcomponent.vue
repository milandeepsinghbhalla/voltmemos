<template>
    <div class="container" style="margin-top: 8.5em;">
        <div class="loader-container" v-if="show_animation==1">
                <div class="loader"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12 mb-4" v-if="$route.path.substr(0,10)=='/edit-blog'">
                <div class="mt-3">
                    <label for="title" class="form-label">Title :-</label>
                    <input type="Text" class="form-control" id="Title" v-model="blog_data.title" placeholder="enter title...!!">
                </div>
                <div class="mt-3">
                    <img :src="card_img.link" style="hieght: 200px;width: 250px;margin: 2em;" v-if="card_img.link!=''">
                            <br>
                            <label class="form-label" for="customFile">Edit card image :-</label>
                            <input type="file" class="form-control" id="customFile" @change="card_img_changed">
                            
                        
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label">Description :-</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="enter description...!!" v-model="blog_data.description" v-on:keydown.enter="enter_presed"></textarea>
                </div>
                <div class="mt-3">
                    <label for="keywords" class="form-label">keywords (enter words seprated by ,) :-</label>
                    <input type="Text" class="form-control" id="keywords" v-model="blog_data.keywords">
                </div>
            </div>
            <div class="col-lg-8 col-12 mb-4">
                 <div id="showblog"></div>

                <button class="btn-dark btn btn-lg mt-3" v-on:click="edit_blog" v-if="$route.path.substr(0,10)=='/edit-blog'">Edit</button>

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
                show_animation: 1,
                blog_data: {
                    title: "",
                    description: "",
                    keywords: "",
                },
                card_img: {
                    link: ""
                },
                card_img_data: new FormData()
            }
        },
        async created(){
            this.blog_id = this.$route.params.id;
            let obj ={
                blog_id :this.blog_id
            }
            if(this.$route.path.substr(0,10)=="/edit-blog"){
               await this.$http.post("/api/get-blog-edit-data",obj).then(res=>{
                        console.log(res.body);
                        this.blog_data.title = res.body.title;
                        this.blog_data.description = res.body.description;
                        let str  = "";
                        let keys = JSON.parse(res.body.keywords);
                        keys.forEach(key=>{
                            str = str+ key + ','
                        })
                        str = str.substr(0,str.length-1);
                        this.blog_data.keywords = str;
                        this.card_img.link = res.body.link;
                    })
            }
        },
        mounted(){
            if(this.$route.path.substr(0,10)=='/show-blog'){
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
                    this.show_animation = 0;
                    sbquill.setContents(this.blogdata);
                })
            }
            if(this.$route.path.substr(0,10)=="/edit-blog"){
                var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['image','video'],

            ['clean']                                         // remove formatting button
            ];
                var sbquill = new Quill('#showblog', {
                modules:{
                    toolbar: toolbarOptions
                },
                readOnly: false,
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
                    this.show_animation = 0;
                    sbquill.setContents(this.blogdata);
                })
                
            }
           
            Vue.prototype.$sbquill = sbquill;
        },
        methods: {
            card_img_changed(event){
                function my_func(result,card_img) {
                    card_img.link = result;
                }
                

                function read(callback,card_img) {
                var file = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function() {
                    console.log(reader);
                    console.log(card_img);
                    callback(reader.result,card_img);
                }

                reader.readAsDataURL(file);
                
                }
                read(my_func,this.card_img)
                this.card_img_data.set('card_img',event.target.files[0]);
            },
             enter_presed(e){
                
                e.preventDefault();
            },
             async edit_blog(){
                 function optamize_star_fields(data){
                    let optamized_array = data.split(',');
                   let new_optamized_array = optamized_array.map(element => {
                        
                        return element.trim();
                        
                    });
                    return JSON.stringify(new_optamized_array);
                }
                if(this.blog_data.keywords!=""&&this.blog_data.keywords!=null&&this.blog_data.title!=""&&this.blog_data.title!=null&&this.blog_data.description!=""&&this.blog_data.description!=null){
                    if(this.card_img.link!=""&&this.card_img.link!=null){
                        this.show_animation = 1;
                        var delta = this.$sbquill.getContents();
                        let delta_str = JSON.stringify(delta);
                        this.blog_data.blogdata = delta_str;
                        if(this.blog_data.keywords!=""&&this.blog_data.keywords!=null)
                            this.blog_data.keywords = optamize_star_fields( this.blog_data.keywords);
                        for(const prop in this.blog_data){
                            this.card_img_data.set(''+prop,this.blog_data[prop]);
                        }
                        this.card_img_data.set('blog_id',this.blog_id);
                        this.$http.post('/api/edit-blog',this.card_img_data).then(res=>{
                            if(res.body.status==1){
                                this.show_animation = 0;
                                swal(res.body.message," ","success");
                                location.assign('/#/');

                            }
                            else{
                                swal("blog couldn't be edited...!!"," ","error");
                            }
                        })

                    }
                    else{
                        swal("please add card image..!!"," ","warning");
                    }
                }
                else{
                    swal("All feilds are required....!!"," ","warning");
                }

             }
        }
        
        
    }
</script>