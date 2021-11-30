<template>
  <div>
      
          <section class="content">
      <div class="row justify-content-around">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Post List</h3>
              <div class="card-tools">
                
                  <router-link to="/add-post" class="btn btn-primary" style="color:#fff;text-decoration:none">
                  Add Post
                  </router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    
                  <th>SI</th>
                  <th>User</th>
                  <th>Category</th>
                  <th>Title</td>
                  <th>Description</th>
                  <th>Photo</th>
                  <th>Action(s)</th>
                 
                </tr>
                </thead>
                <tbody>
                <tr v-for="(post,index) in getallPost"  :key="post.id">
                  <td>{{index+1}}</td>
                  <td >{{post.user.name}}</td>
                  <td v-if="post.category">{{post.category.cat_name}}</td>
                  <td>{{post.title | sortlength(20,"...")}}</td>
                  <td>{{post.description | sortlength(20,"...")}}</td>
                  <td><img :src="ourImage(post.photo)" alt="" width="50" height="50"></td>

                  <td>
                    <router-link :to="`edit-post/${post.id}`">Edit</router-link>
                    <a href="" @click.prevent="deletePost(post.id)">Delete</a>
                  </td>
                  
                </tr>               
                


                
                </tbody>
               
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
          </div>
          </section>
  </div>
</template>

<script>
export default {
  name:"List",
  mounted(){
    this.$store.dispatch('AllPost');
  },
  computed:{
       getallPost(){
         return this.$store.getters.getPost
       }
  },
  methods:{
    ourImage(img){
      return 'uploadimage/'+img;
    },
    deletePost(id){
              axios.get('/post/'+id)
              this.$store.dispatch("AllPost")
                .then(()=>{
                     Toast.fire({
                    icon: 'success',
                    title: 'Post Deleted Successfully'
                  }) 
                })
       }

  }

}
</script>

<style>

</style>