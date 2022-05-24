<template>
<span>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="logo" src="logo_images/logo.png" alt=""></a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 w-100">
          <li class="nav-item flex-grow-1 me-lg-2">

            <div class="input-group">
      
              <input type="text" class="form-control" v-model="search_text" v-on:keydown.enter="search_clicked" placeholder="Search anything...!!" aria-label="search" aria-describedby="basic-addon1">
              <span class="input-group-text bg-yellow" id="basic-addon1" v-on:click="search_clicked"><i class="fas fa-search"></i></span>
            </div>
          </li>
         <li class="nav-item">
           <router-link class="nav-link" to="/" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">hi {{this.$current_user.name.split(' ')[0]}}</router-link>
         </li>
        <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <!-- <span class="navbar-toggler-icon"></span> -->
         <a data-bs-toggle="offcanvas" href="#offcanvas" aria-controls="offcanvas"  class="nav-link "  >  Blogs &#38; categories </a>
        </li>
         <li class="nav-item" v-if="this.$current_user.user_id!=-1">
           <router-link class="nav-link" to="/write-blog"><span data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">Write Blog</span></router-link>
         </li>
          <li class="nav-item" v-if="this.$current_user.user_id!=-1">
           <router-link class="nav-link" to="/admin-panel"><span data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">Admin Panel</span></router-link>
         </li>
        <li class="nav-item dropdown" v-if="this.$current_user.user_id==-1">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          login / sign up
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <router-link to="/login" class="text-decoration-none" ><span class="dropdown-item" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" >login</span></router-link>
			          <router-link to="/sign-up" class="text-decoration-none" ><span class="dropdown-item" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" >sign up</span></router-link>
			        </div>
              </li>
			    <li v-else class="nav-item">
			    	<a href="#" v-on:click="logout()" class="nav-link" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">Logout</a>
			    </li>
      </ul>
    </div>
  </div>
    
  
</nav>
<div class="offcanvas bg-dark offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
      <div class="offcanvas-header text-light">
        <h5 class="offcanvas-title text-light text-muted" id="offcanvasLabel"> Blogs &#38; categories</h5>
        <span class="text-light text-muted" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times display-6"></i></span>
      </div>
       <div class="offcanvas-body ms-4">
         <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
        <ul class="navbar-nav justify-content-end flex-grow-1">
          <!-- <li class="nav-item">
            <a class="text-light text-decoration-none" aria-current="page" href="#">Home</a>
          </li> -->
          <li class="nav-item mb-1 fs-4">
            <router-link to="/all_blogs" class="text-light text-decoration-none" ><span data-bs-toggle="offcanvas" data-bs-target="#offcanvas">All Blogs</span></router-link>
          </li>
          <li class="nav-item mb-1 fs-4 dropdown" v-for="(sub_categories,category) in categories" :key="category+''+Math.random()" v-show="sub_categories.length>0">
            <a class="text-light text-decoration-none dropdown-toggle" href="#" id="offcanvasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{category}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasDropdown">
              <router-link v-for="sub_category in sub_categories" :key="sub_category+''+Math.random()" :to='"/blog-card/"+sub_category' class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvas">{{sub_category.replaceAll('_'," ")}}</li></router-link>
              <!-- <router-link to="/mobile_best_under" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Best under</li></router-link>
              <router-link to="/mobile_comparison" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Comparison</li></router-link> -->
              <!-- <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </li>
          <li class="nav-item mb-1 fs-4" v-for="(sub_categories,category) in categories" :key="category+''+Math.random()" v-show="sub_categories.length==0">
            <router-link :to='"/blog-card/"+category' class="text-light text-decoration-none"><span data-bs-toggle="offcanvas" data-bs-target="#offcanvas">{{category.replaceAll("_"," ")}}</span></router-link>
          </li>
          <!-- <li class="nav-item display-6 dropdown">
            <a class="text-light text-decoration-none dropdown-toggle" href="#" id="offcanvasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Laptops
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasDropdown">
              <router-link to="/laptop_review" class="dropdown-item"> <li data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Reiviews</li></router-link>
              <router-link to="/laptop_best_under" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Best under</li></router-link>
              <router-link to="/laptop_comparison" class="dropdown-item"> <li  data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Comparison</li></router-link>

              
            </ul>
          </li> -->
        </ul>
        
      </div>
    </div>
    </span>
</template>
<script>

export default{
  data: function(){
    return {
      search_text: "",
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
    }
  },
  methods: {
    logout(){
      localStorage.removeItem('current_user');
      location.replace('/#/login');
      location.reload();
    },
    search_clicked(){
      if(this.search_text.length>0){
        localStorage.setItem("search_text",this.search_text);
        $('#navbarSupportedContent').collapse('hide');
        if(this.$route.path=='/search-results')
          location.reload();
        else
        location.assign('/#/search-results')
      }
      else{
        swal("enter some keywords to search for..!!"," ","warning");
      }
    }
  }
}
</script>
