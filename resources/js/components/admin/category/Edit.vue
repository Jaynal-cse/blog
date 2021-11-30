<template>
     <div>
             <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @submit.prevent="updateCategory">
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryId">Edit Category</label>
                    <input type="text" class="form-control"  id="categoryId" placeholder="Edit  Category" v-model="form.cat_name" name="cat_name" >
                     <div   style="color:red" v-if="form.errors.has('cat_name')" v-html="form.errors.get('cat_name')" />
            
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
       mounted(){
          axios.get(`/editcategory/${this.$route.params.categoryId}`)
            .then((response)=>{
               this.form.fill(response.data.category)
            })
       },
       data(){
            return {
              form: new Form({
                 cat_name:''
              })
            }
       } ,
       methods:{
        updateCategory(){
          this.form.post(`update-category/${this.$route.params.categoryId}`)
          .then((response) =>{
               this.$router.push('/category-list');
                  Toast.fire({
                    icon: 'success',
                    title: 'Updated Successfully'
                  })  
              })
          .catch(()=>{

             })
            }        
        }
       
}
</script>

<style>

</style>

