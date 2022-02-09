<template>
    <div class="my-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" v-model="new_comment.email" class="form-control" id="exampleFormControlInput1" placeholder="enter your email">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Enter comment</label>
                <textarea v-model="new_comment.body" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="enter your comment...!!"></textarea>
            </div>
            <button class="btn btn-sm btn-success scroll-target" v-on:click="post_comment()">Post comment</button>
    </div>
</template>
<script>
import comments_container_componentVue from './comments_container_component.vue';
export default{
    props: ['comments'],
    data: function(){
        return {
            new_comment: {
                email: "",
                date: "",
                body: "",
                key: ('r'+Math.random()).replace('.','-'),
                replies: []

            }
        }
    },
    methods: {
        post_comment(){
            if(this.new_comment.email!=null&&this.new_comment.email!=""&&this.new_comment.body!=null&&this.new_comment.body!=""){
                var today = new Date();
                const monthNames = ["January", "February", "March", "April", "May", "June",
                                                "July", "August", "September", "October", "November", "December"
                                                ];

                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = monthNames[today.getMonth()];
                            var yyyy = today.getFullYear();

                            today = dd + '-' + mm + '-' + yyyy;
                this.new_comment.date = today;
                this.comments.unshift(this.new_comment);
                swal("comment posted successfully...!!"," ","success");
                this.$root.$emit('update_add_comment', {new_value: 0});
            }
            else{
                swal("email and body of comment required...!!"," ","warning");
            }
        }
    }
}
</script>
