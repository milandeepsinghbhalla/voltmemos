<template>
    <div class="container mb-5" style="margin-top: 8.5em;">
        <div class="row text-center mb-3">
            <div class="col-12 fs-5 mb-2">
                hello {{$current_user.name}}
            </div>
            <div class="col-12">
                <button class="btn btn-warning btn-md">You have written {{my_blogs.length}} blogs..!!</button>
            </div>
        </div>
        <div class="row justify-content-center" v-if="my_blogs.length>0">
            <div class="col-12 text-center mb-4">
                <span class="display-6">Your Blogs</span>
                <div class="input-group mt-3">
      
                    <input type="text" class="form-control" v-model="search_text" v-on:keydown.enter="search_clicked" placeholder="Search blogs...!!" aria-label="search" aria-describedby="basic-addon1">
                    <span class="input-group-text bg-yellow" id="basic-addon1" v-on:click="search_clicked"><i class="fas fa-search"></i></span>
                                    <button class="btn btn-success btn-md ms-3" v-on:click="reset_search()">Reset Search</button>

                </div>
            </div>
            <div class="col-12 table-responsive">
                <!-- <div class="table-responsive"> -->
                    <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                            <th scope="col">blog id</th>
                            <th scope="col">title</th>
                            <th scope="col">published on</th>
                            <th scope="col">category</th>
                            <th scope="col">action</th>
                            </tr>
                        </thead>
                         <tbody>
                            <tr v-for="blog in searched_blogs" :key="blog.blog_id">
                                <th scope="row">{{blog.blog_id}}</th>
                                <td>{{blog.title}}</td>
                                <td>{{blog.uploaded_at}}</td>
                                <td>{{blog.category.replaceAll('_'," ")}}</td>
                                <td><button class="btn btn-success btn-sm me-2" v-on:click="open_blog(blog.blog_id)">View <i class="fas fa-eye"></i></button><button v-on:click="edit_blog(blog.blog_id)" class="btn btn-warning btn-sm me-2">Edit <i class="fas fa-edit"></i></button><button v-on:click="delete_blog(blog.blog_id)" class="btn btn-danger btn-sm me-2">Delete <i class="fas fa-trash"></i> </button></td>
                                <td></td>
                            </tr>
                         </tbody>
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data: function(){
            return {
                my_blogs: [],
                search_text: "",
                searched_blogs: []
            }
        },
        async created(){
            let get_user_blogs_data = {
                user_id : this.$current_user.user_id
            }
            await this.$http.post('/api/get-user-blogs',get_user_blogs_data).then(res=>{
                this.my_blogs = res.body.my_blogs;
                this.my_blogs.forEach(blog=>{
                    if(blog.keywords.length>0)
                    blog.keywords = JSON.parse(blog.keywords);
                })
                this.searched_blogs = this.my_blogs;
            })
        },
        methods: {
            open_blog(id){
             location.assign("/#/show-blog/"+id);
            },
            edit_blog(id){
             location.assign("/#/edit-blog/"+id);

            },
            delete_blog(id){
                let obj = {
                    blog_id : id
                }
                 let blog = this.my_blogs.find(blog=>{
                            return blog.blog_id == id
                        })
                        console.log("blog = ",blog);
                        // let mindex = this.my_blogs.indexOf(blog);
                        // this.my_blogs.splice(mindex,1);
                        let sindex = this.searched_blogs.indexOf(blog);
                        this.searched_blogs.splice(sindex,1);
                this.$http.post("/api/delete-blog",obj).then(res=>{
                    console.log("id = ",id);
                    if(res.body.status==1){
                        swal(res.body.message," ","success");
                    }
                    else{
                        swal("some error occurred"," ","error");
                    }
                    // if(res.body.status==1){
                    //     let blog = this.my_blogs.find(blog=>{
                    //         return blog.id == id
                    //     })
                    //     console.log("blog = ",blog);
                    //     let mindex = this.my_blogs.indexOf(blog);
                    //     this.my_blogs.splice(mindex,1);
                    //     let sindex = this.searched_blogs.indexOf(blog);
                    //     this.searched_blogs.splice(sindex,1);
                    //     swal(res.body.message," ","success");
                    // }
                    // else{
                    //     swal("some error occured"," ","error");
                    // }
                })
            },
            search_clicked(){
            if(this.search_text.length>0){
                let search_query = this.search_text
                let search_keywords = search_query.split(' ');
                search_keywords.map(keyword=>{
                    return keyword.trim();
                });
                let search_results = [];
                
                this.my_blogs.forEach(blog=>{
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
                this.searched_blogs = search_results;
                }
                else{
                    swal("enter some keywords to search for..!!"," ","warning");
                }
            },
            reset_search(){
                this.search_text = ""
                this.searched_blogs = this.my_blogs;
            }
            
        }
    }
</script>
