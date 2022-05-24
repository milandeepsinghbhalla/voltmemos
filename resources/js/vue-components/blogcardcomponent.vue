<template>
    <div class="container" style="margin-top: 8.5em;">
        <div class="row text-center mb-3" v-if="$route.path=='/search-results'">
            <div class="col-12">
                <button class="btn btn-lg btn-dark">{{current_blogs.length}} results found...!!</button>
            </div>
        </div>
        <div class="row text-center mb-3" v-if="category.length>0">
            <div class="col-12">
                <button class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Subscribe to {{category.replaceAll("_"," ")}} category</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Subscribe to {{category.replaceAll('_'," ")}} category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input type="email" v-model="subscription_data.email" class="form-control" placeholder="enter email" aria-label="email" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" v-on:click="subscribe">Subscribe</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col" v-for="blog in current_blogs" :key="blog.id">
                <div class="card h-100 shadow-lg">
                    <div class="card-header bg-dark">
                        <span class="text-light"><i class="far fa-clock"></i> {{blog.uploaded_at}}</span> 
                    </div>
                <img :src="blog.card_img_link" class="card-img-top" style="height:18em;" alt="">
                <div class="card-body" v-bind:style="back+background_colors[Math.floor((Math.random() * background_colors.length) + 1) - 1]">
                    <h5 class="card-title fw-bolder">{{blog.title}}</h5>
                    <p class="card-text">{{blog.description}}</p>
                </div>
                <div class="card-footer bg-dark d-flex justify-content-between">
        
                    <button class="btn btn-light" v-on:click="open_blog(blog.blog_id)"> Read..!!</button>
            
                    <span class="text-light align-self-center"><i class="fas fa-briefcase"></i> {{blog.category}}</span>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>

 export default{
     data: function(){
         return {
             back: "background-color: #",
             background_colors: ["fed9b7","f07167","f4a261","f77f00","52b788","aaf683","d68c45"],
             category: "",
             subscription_data:{
                 email: ""
             },
             current_blogs: []
            
         }
     },
    
     computed: {
         
     },
     async created(){
         if(this.$route.params.category)
          this.category = this.$route.params.category;
             
         await this.$http.get('/api/get-all-blogs').then(res=>{
            this.blogs = res.body;
            this.blogs.forEach(blog=>{
            if(blog.keywords.length>0)
            blog.keywords = JSON.parse(blog.keywords);
            
            })
        });
         if(this.$route.path!='search-results'){
             if(this.category.length>0){
                 let current_blogs = []
                    this.blogs.forEach(element=>{
                    if(element.category==this.category){
                        if(!current_blogs.includes(element))
                            current_blogs.push(element);
                    }
                })
                console.log("current blogs",current_blogs);
                this.current_blogs = current_blogs;
             }
             else if(this.$route.path!='/search-results'){
                 this.current_blogs =  this.blogs;
             }
         }
        if(this.$route.path=="/search-results"){
            let search_query = localStorage.getItem('search_text');
            let search_keywords = search_query.split(' ');
            search_keywords.map(keyword=>{
                return keyword.trim();
            });
            let search_results = [];
            
            this.blogs.forEach(blog=>{
                let count = 0;
                let new_blog = {};
                blog.keywords.forEach(blogword=>{
                    search_keywords.forEach(searchword=>{
                        if(searchword.toLowerCase().substr(0,3)==blogword.toLowerCase().substr(0,3)){
                            count++
                        }
                    })
                })
                for(let prop in blog){
                    new_blog[prop] = blog[prop]; 
                }
                new_blog.count = count;
                search_results.push(new_blog)

            })
            search_results = search_results.filter(result=>{
                return result.count>0;
            })
            search_results.sort((a,b)=>{
                return b.count - a.count;
            })
            this.current_blogs = search_results;

        }
         
         
     },
     methods: {
         open_blog(id){
             location.assign("/#/show-blog/"+id);
         },
         subscribe(){
             let chk = 0;
             if(this.subscription_data.email.length>0){
                const validateEmail = (email) => {
                          return String(email)
                              .toLowerCase()
                              .match(
                              /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                              );
                      };
                if(validateEmail(this.subscription_data.email)){
                    this.subscription_data.category = this.category;
                    this.$http.post("/api/add-subscription",this.subscription_data).then(res=>{
                        if(res.body.status==1){
                            $('.modal').modal('hide');
                            swal(res.body.message," ","success");
                        }
                        else
                            swal(res.body.message," ","info")
                    })
                } 
             }
         }
     }
 }
</script>
