import Vue from "vue";
import VueRouter from 'vue-router'
import VueResource  from 'vue-resource'
import VueScrollTo from 'vue-scrollto'
Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueScrollTo);


import testcomponent from './vue-components/testcomponent.vue';
import showblogcomponent from './vue-components/showblogcomponent.vue';
import log_in_component from './vue-components/log_in_component.vue';
import navbar_component from './vue-components/navbar_component.vue';
import blogcardcomponent from './vue-components/blogcardcomponent.vue';
import comments_container_component from './vue-components/comments_container_component.vue';
import signup_component from './vue-components/signup_component.vue';
import admin_panel_page_component from "./vue-components/admin_panel_page_component.vue";
import home_page_component from "./vue-components/home_page_component.vue";
// import Editor from 'vue-editor-js/src/index'



// Vue.use(Editor);
const router = new VueRouter({
	routes: [
        {
            path: "/",
            components: {
                home_page_component: home_page_component
            }
        },
        {
            path: "/admin-panel",
            components:{
                admin_panel_page_component: admin_panel_page_component
            }
        },
        {
            path:'/search-results',
            components:{
                search_results: blogcardcomponent
            }
        },
        {
            path:'/write-blog',
            components: {
                testcomponent: testcomponent
            }
        },
        {
            path:'/edit-blog/:id',
            components: {
                editblogcomponent: showblogcomponent
            }
        },
        {
            path:'/show-blog/:id',
            components:{
                showblogcomponent: showblogcomponent,
                comments_container_component: comments_container_component
            }
        },
        {
            path:'/login',
            components:{
                log_in_component: log_in_component
            }
        },
        {
            path:'/all_blogs',
            components:{
                all_blogsblogcardcomponent: blogcardcomponent
            }

        },
        {
            path: '/blog-card/:category',
            components: {
                blogcardcomponent: blogcardcomponent
            }
        },
        {
            path: "/sign-up",
            components:{
                signup_component:signup_component
            }
        }
        // {
        //     path:'/mobile_review',
        //     components:{
        //         mobile_reviewblogcardcomponent: blogcardcomponent
        //     }
            
        // },
        // {
        //     path:'/mobile_best_under',
        //     components:{
        //         mobile_best_underblogcardcomponent: blogcardcomponent
        //     }
            
        // },
        // {
        //     path:'/mobile_comparison',
        //     components:{
        //         mobile_comparisonblogcardcomponent: blogcardcomponent
        //     }
            
        // },
        // {
        //     path:'/laptop_review',
        //     components:{
        //         laptop_reviewblogcardcomponent: blogcardcomponent
        //     }
            
        // },
        // {
        //     path:'/laptop_best_under',
        //     components:{
        //         laptop_best_underblogcardcomponent: blogcardcomponent
        //     }
            
        // },
        // {
        //     path:'/laptop_comparison',
        //     components:{
        //         laptop_comparisonblogcardcomponent: blogcardcomponent
        //     }
            
        // },
    ]})


const app = new Vue({
    http: {
        root: '/',
        headers: {
          Authorization: 'Basic YXBpOnBhc3N3b3Jk'
        }
      },
    el: '#app',
    router: router,
    components: {
        navbar_component: navbar_component
    },
    data: {
        // all_blogs: [{
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_review",
        //     blog_id: 1,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-december-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_comparison",
        //     blog_id: 2,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_review",
        //     blog_id: 3,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_best_under",
        //     blog_id: 4,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "laptop_review",
        //     blog_id: 5,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_review",
        //     blog_id: 6,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // },
        // {
        //     title: "My first blog",
        //     description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
        //     category: "mobile_review",
        //     blog_id: 7,
        //     card_img_link: "storage/card_images/card_img_1.png",
        //     uploaded_at: "22-dec-2021",
        //     company_names: [],
        //     product_names: [],
        //     prices: [],
        //     colors: [],
        //     user_id: 1
        // }
        
        // ]
        all_blogs:[]
    },
    computed:{
        // mobile_review(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="mobile_review"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // },
        // mobile_best_under(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="mobile_best_under"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // },
        // mobile_comparison(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="mobile_comparison"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // },
        // laptop_review(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="laptop_review"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // },
        // laptop_best_under(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="laptop_best_under"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // },
        // laptop_comparison(){
        //     let blogs = []
        //     this.all_blogs.forEach(element=>{
        //         if(element.category=="laptop_comparison"){
        //             if(!blogs.includes(element))
        //                 blogs.push(element);
        //         }
        //     })
        //     return blogs;
        // }
    },
    async created(){
        
        if(localStorage.getItem('current_user')){
            
            Vue.prototype.$current_user = JSON.parse(localStorage.getItem('current_user'));
            console.log("in current_user ",this.$current_user)
        }
        else{
            Vue.prototype.$current_user = {
                user_id: -1,
                name: "guest",
                email: ""
            }
        }
        await this.$http.get('/api/get-all-blogs').then(res=>{
            this.all_blogs = res.body;
            this.all_blogs.forEach(blog=>{
            if(blog.keywords.length>0)
            blog.keywords = JSON.parse(blog.keywords);
            
            })
            

        })

    }
})
