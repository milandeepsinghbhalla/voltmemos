<template>
    <div v-if="this.$current_user.user_id!=-1" class="container mb-5" style="margin-top: 8.5em;">
        <div class="loader-container" v-if="show_animation==1">
                <div class="loader"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                Select Category :- 
                <div class="dropdown d-inline ml-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Category
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item dropdown" v-for="(sub_categories,category) in categories" :key="category+''+Math.random()" v-show="sub_categories.length>0">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{category}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li v-for="sub_category in sub_categories" :key="sub_category+''+Math.random()" v-on:click="select_category(sub_category)"> <span class="dropdown-item"> {{sub_category.replaceAll('_'," ")}} </span></li>
                                <!-- <li v-on:click="select_category('mobile_best_under')" class="dropdown-item" > best under</li>
                                <li v-on:click="select_category('mobile_comparison')" class="dropdown-item" > Comparison</li> -->
                            </ul>
                        </li>
                        <li v-for="(sub_categories,category) in categories" :key="category+''+Math.random()" v-show="sub_categories.length==0" v-on:click="select_category(category)"> <span class="dropdown-item"> {{category.replaceAll('_'," ")}} </span></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laptops
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li v-on:click="select_category('laptop_review')" > <span class="dropdown-item"> Review </span></li>
                                <li v-on:click="select_category('laptop_best_under')" class="dropdown-item" > best under</li>
                                <li v-on:click="select_category('laptop_Comparison')" class="dropdown-item" > Comparison</li>
                            </ul>
                        </li> -->
                    </ul>
                
                </div>
                <div class="mt-2" v-if="show_category==1">Selected category is <span class="fw-bold">{{blog_data.selected_category}} </span></div>
                <div class="mt-3">
                    <label for="title" class="form-label">Title :-</label>
                    <input type="Text" class="form-control" id="Title" v-model="blog_data.title" placeholder="enter title...!!">
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label">Description :-</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="enter description...!!" v-model="blog_data.description" v-on:keydown.enter="enter_presed"></textarea>
                </div>
                <div class="mt-3">
                    <img :src="card_img.link" style="hieght: 200px;width: 250px;margin: 2em;" v-if="card_img.link!=''">
                            <br>
                            <label class="form-label" for="customFile">Add card image :-</label>
                            <input type="file" class="form-control" id="customFile" @change="card_img_changed">
                            
                        
                </div>
                <div class="mt-3">
                    <label for="keywords" class="form-label">keywords (enter words seprated by ,) :-</label>
                    <input type="Text" class="form-control" id="keywords" v-model="blog_data.keywords">
                </div>
                <!-- <div class="mt-3">
                    <label for="products" class="form-label">Products (enter names seprated by *) :-</label>
                    <input type="Text" class="form-control" id="products" v-model="blog_data.products" placeholder="eg:- Poco x3*Galaxy x7*iphone 13">
                </div>
                <div class="mt-3">
                    <label for="prices" class="form-label">prices (enter prices seprated by *) :-</label>
                    <input type="Text" class="form-control" id="prices" v-model="blog_data.prices" placeholder="eg:- 17000*18000*45000">
                </div>
                <div class="mt-3">
                    <label for="colors" class="form-label">colors (enter colors seprated by *) :-</label>
                    <input type="Text" class="form-control" id="colors" v-model="blog_data.colors" placeholder="eg:- blue*purple*pink*black">
                </div> -->
                <h2 class="mt-3">Start writting blog below here...!!!</h2>
                 <div id="editor"></div>
                 <button class="btn-dark btn btn-lg mt-3" v-on:click="send_post">Publish Blog</button>
            </div>
        </div>
    </div>
</template>
<script>

</script>
<script>

import Vue from "vue";

    export default{
        
        data(){
            return {
                show_animation: 0,
                message: "test vue component",
                show_category : 0,
                blog_data: {
                    selected_category: "",
                    title: "",
                    description: "",
                    keywords: "",
                    uploaded_at: "",
                    blogdata: "",
                    user_id: this.$current_user.user_id
                   

                },
                 categories: {
                        tech:["mobiles","laptops","apps","softwares","viruses","others_in_tech"],
                        lifestyle:["dressing","behaviour","incedents","others_in_lifestyle"],
                        sports:["cricket","football","basketball","others_in_sports"],
                        politics:["india","global"],
                        entertainment: ["bollywood","hollywood","series","ott","others_in_entertainment"],
                        astrology: ["daily_horoscope","weekly_horoscope","monthly_horoscope","others_in_astrology"],
                        science: [],
                        finance: [],
                        others: []
                    },
                card_img: {
                    link: ""
                },
                card_img_data: new FormData()
                // config: {
                    
                //     tools: {
                //         header: require('@editorjs/header'),
                //         list: require('@editorjs/list'),
                //         code: require('@editorjs/code'),
                //         personality: require('@editorjs/personality'),
                //         embed: require('@editorjs/embed'),
                //         linkTool: require('@editorjs/link'),
                //         marker: require('@editorjs/marker'),
                //         table: require('@editorjs/table'),
                //         delimiter: require('@editorjs/delimiter'),
                //         quote: require('@editorjs/quote'),
                //         image: require('@editorjs/image'),
                //         warning: require('@editorjs/warning'),
                //         paragraph: require('@editorjs/paragraph'),
                //         checklist: require('@editorjs/checklist'),

                //     },
                //     image: {
                //     // Like in https://github.com/editor-js/image#config-params
                //     endpoints: {
                //         byFile: '/uploadFile', // Your backend file uploader endpoint
                //         byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                //     },
                //     field: 'image',
                //     types: 'image/*',
                //     }
                // }
            }
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

                // let filename = event.target.value;
                // console.log(event);
                // let label = event.target.nextElementSibling;
                // label.innerHTML = filename;
                // this.card_img_data.set('card_img',event.target.files[0]);
            },
            enter_presed(e){
                
                e.preventDefault();
            },
            select_category(category){
                this.blog_data.selected_category = category;
                this.show_category = 1;
            },
            async send_post(){
                
                function optamize_star_fields(data){
                    let optamized_array = data.split(',');
                   let new_optamized_array = optamized_array.map(element => {
                        
                        return element.trim();
                        
                    });
                    return JSON.stringify(new_optamized_array);
                }
                if(this.blog_data.keywords.length>0&&this.blog_data.selected_category!=""&&this.blog_data.selected_category!=null&&this.blog_data.title!=""&&this.blog_data.title!=null&&this.blog_data.description!=""&&this.blog_data.description!=null){
                    if(this.card_img.link!=""&&this.card_img.link!=null){
                        this.show_animation = 1;
                        var delta = this.$qul.getContents();
                        let delta_str = JSON.stringify(delta);
                        this.blog_data.blogdata = delta_str;
                        if(this.blog_data.keywords!=""&&this.blog_data.keywords!=null)
                            this.blog_data.keywords = optamize_star_fields( this.blog_data.keywords);
                        // if(this.blog_data.products!=""&&this.blog_data.products!=null)
                        //     this.blog_data.products = optamize_star_fields( this.blog_data.products);
                        // if(this.blog_data.prices!=""&&this.blog_data.prices!=null)
                        //     this.blog_data.prices = optamize_star_fields(this.blog_data.prices);
                        // if(this.blog_data.colors!=""&&this.blog_data.colors!=null)
                        //     this.blog_data.colors = optamize_star_fields(this.blog_data.colors);
                        var today = new Date();
                        const monthNames = ["January", "February", "March", "April", "May", "June",
                                            "July", "August", "September", "October", "November", "December"
                                            ];

                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = monthNames[today.getMonth()];
                        var yyyy = today.getFullYear();

                        today = dd + '-' + mm + '-' + yyyy;
                        this.blog_data.uploaded_at = today;
                        for(const prop in this.blog_data){
                            this.card_img_data.set(''+prop,this.blog_data[prop]);
                        }
                        const byteSize = str => new Blob([str]).size;
                        console.log(byteSize(this.blog_data.blogdata));
                        this.$http.post('/api/add-blog',this.card_img_data).then(res=>{
                            console.log('card image result : ',res.body);
                            if(res.body.status==1){
                                this.show_animation = 0;
                                swal(res.body.message," ","success");
                                for(const prop in this.blog_data){
                                    this.blog_data[prop] = "";
                                }
                                location.assign('/#/');
                            }
                            else{
                                this.show_animation = 0;
                                swal("blog couldn't be uploaded")
                                this.blog_data.keywords = "";
                                this.blog_data.products = "";
                                this.blog_data.prices = "";
                                this.blog_data.colors = "";
                                this.blog_data.title = "";
                            }
                       })
                    }
                    else{
                        swal("please add card image..!!"," ","warning");
                    }
                   
                }
                else{
                    swal("all fields are required...!!"," ","warning");
                }
               

                // editor.save().then((outputData) => {
                //     console.log('Article data: ', outputData)
                //     }).catch((error) => {
                //     console.log('Saving failed: ', error)
                //     });
                
            }

        },
        created(){
            if(!localStorage.getItem('firstload')){
                localStorage.setItem('firstload',"true");
                location.reload();
            }
            else{
                localStorage.removeItem('firstload');
            }
        },
        mounted(){
           
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
    

    var quill = new Quill('#editor', {
            modules:{
                toolbar: toolbarOptions
               
            },
             
            theme: 'snow'
            });
             
            Vue.prototype.$qul = quill;
        }
    }
</script>