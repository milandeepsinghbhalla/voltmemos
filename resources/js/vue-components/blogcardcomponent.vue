<template>
    <div class="container" style="margin-top: 8.5em;">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col" v-for="blog in blogs" :key="blog.id">
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
            
         }
     },
     props: ['blogs'],
     methods: {
         open_blog(id){
             location.assign("/#/show-blog/"+id);
         }
     }
 }
</script>
