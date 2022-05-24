<template>
    <div class="container mb-5" style="margin-top: 8.5em;">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-7 login-form-box p-lg-4 py-4">
                <div class="text-center mb-3 mt-3">
                    <i class="fas fa-user  display-1"></i><br>
                    <span class="display-5 font-weight-bold mt-2">Sign up</span>
                </div>
                <div id="login_form">
                      <label for="exampleInputEmail1" class="form-label">Name:-</label>
                      <div class="input-group mb-2">
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                          <input type="text" v-model="user_data.name" class="form-control" id="name" placeholder="enter name...!!">
 
                      </div>

                            <label for="exampleInputEmail1" class="form-label">Email:-</label>

                    <div class="input-group mb-2">

                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>

                        <input type="email" v-model="user_data.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter email...!!">
                    </div>
                                                <label for="exampleInputPassword11" class="form-label">Password:-</label>

                    <div class="input-group mb-2">

                          <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>

                        <input type="password" v-model="user_data.password" class="form-control" id="mp" placeholder="enter password...!!">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye" v-on:click="show_pass('mp')"></i></span>

                    </div>

                    <label for="exampleInputPassword11" class="form-label">Confirm Password:-</label>

                    <div class="input-group mb-2">

                          <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>

                        <input type="password" v-model="user_data.confirm_password" class="form-control" id="cp" placeholder="Confirm password...!!">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye" v-on:click="show_pass('cp')"></i></span>

                    </div>
                    
                    <div class="text-center">
                        <button class="btn btn-md btn-dark mt-4" v-on:click="sign_up">Sign Up</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default{
    data : function(){
        return {
            user_data:{
                name: "",
                email: "",
                password: "",
                confirm_password: ""
            },
            mp_clicked:0,
            cp_clicked:0
        }
    },
    methods:{
        show_pass(id){
            
            let inp =  document.getElementById(id);
            let str = id+'_clicked'
            if(this[str] == 0){
              this[str]=1;
              inp.type = 'text';
            }
            else if(this[str]>0){
              this[str]=0;
              inp.type = 'password'
            }
        },
        sign_up(){
            let chk = 0;
            for(let prop in this.user_data){
                if(this.user_data[prop].length==0){
                    chk = 1;
                    swal(prop.replaceAll("_"," ")+" is empty...!!"," ","warning");
                    break;
                }
            }
            const validateEmail = (email) => {
                          return String(email)
                              .toLowerCase()
                              .match(
                              /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                              );
                      };
            if(chk==0){
                if(!validateEmail(this.user_data.email)){
                    chk=1;
                    swal("Email format not valid...!!"," ","error");
                }
            }
            if(chk==0){
                if(this.user_data.password!=this.user_data.confirm_password){
                    chk=1;
                    swal("password and confirm password didn't matched...!!"," ","error");
                }
            }
            if(chk==0){
                let userdata = {
                    name: this.user_data.name,
                    email: this.user_data.email,
                    password: this.user_data.password
                }
                this.$http.post("/api/add-user",userdata).then(res=>{
                    if(res.body.status==1){
                        swal(res.body.message," ","success");
                    }
                    else{
                        swal(res.body.message," ","error");
                    }
                })
            }
        }
    }
}
</script>
