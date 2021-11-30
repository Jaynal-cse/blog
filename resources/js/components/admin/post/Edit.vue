<template>
     <div>
             <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Post</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form"  enctype="multipart/form-data" @submit.prevent="updatePost()"> 
                <div class="card-body">
                  <div class="form-group">
                    <label for="postId">Edit Post</label>
                   
                    <input type="text" class="form-control"  id="postId" placeholder="Edit Post" v-model="form.title" name="title" >
                     <div   style="color:red" v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
            
                     
            
                  </div>


                   <div class="form-group">
                    <label for="descriptionId">Edit Description</label>
                     <v-md-editor v-model="form.description" height="200px"></v-md-editor>
                     <div   style="color:red" v-if="form.errors.has('description')" v-html="form.errors.get('description')"  />
            
                     
            
                  </div>

                  <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control" name="cat_id" v-model="form.cat_id">
                      <option disabled value="">Select One</option>
                      <option v-for="category in getallCategory" :value="category.id">{{category.cat_name}}</option>
                      
                    </select> 
                    <div   style="color:red" v-if="form.errors.has('cat_id')" v-html="form.errors.get('cat_id')" />             
                  </div>

                  <div class="form-group">
                          <input type="file"  @change="changePhoto($event)" name="photo">
                          <img :src="updateImage()" alt=" " height="80" width="80">
                          <div   style="color:red" v-if="form.errors.has('photo')" v-html="form.errors.get('photo')" />

                  </div>
                  
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button  class="btn btn-primary"  >Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        

         

          </div>
          <!--/.col (left) -->
          <!-- right column -->
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
     </div>
</template>

<script>
export default {
  name:"Edit",
  data(){
     return{
       form: new Form({
            title:"",
            description:"",
            cat_id:"",
            photo:""
       })
     }
  },
  mounted(){
      this.$store.dispatch("allCategory")
  },
  created(){
      axios.get(`/edit-post/${this.$route.params.postId}`)
            .then((response)=>{
               this.form.fill(response.data.post)
            })
  },
  computed:{
    getallCategory(){
      return this.$store.getters.getCategory;
    }

  },
  methods:{
       changePhoto(event){
         let file = event.target.files[0];
         //console.log(file);
        if(file.size>1048576){
              Swal.fire({
                  icon: 'error',
                  title: 'Sorry',
                  text: 'Size need to be less than 1M',
                  footer: '<a href="">Why do I have this issue?</a>'

                })
         }
         else{
           let reader = new FileReader();
           reader.onload = event=> {
              this.form.photo = event.target.result;
              //console.log(event.target.result);
            };

        reader.readAsDataURL(file);
         }
        
         },
         updatePost(){
              this.form.post(`update-post/${this.$route.params.postId}`)
          .then((response) =>{
               this.$router.push('/post-list');
                  Toast.fire({
                    icon: 'success',
                    title: ' Post Updated Successfully'
                  })  
              })
          .catch(()=>{

             })
                   

         },
         updateImage(){
           let img = this.form.photo;
           if(img.length>100){
                 return this.form.photo;
           }
           else{
                return `uploadimage/${this.form.photo}`;
           }
         }

  }

}
</script>

<style>

</style>