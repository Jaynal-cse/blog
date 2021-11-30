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
                <h3 class="card-title">Add New Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @click.prevent="addCategory">
                <div class="card-body">
                  <div class="form-group">
                    <label for="categoryId">Add New Category</label>
                    <input type="text" class="form-control"  id="categoryId" placeholder="Add New Category" v-model="form.cat_name" name="cat_name" >
                     <div   style="color:red" v-if="form.errors.has('cat_name')" v-html="form.errors.get('cat_name')" />
            
                  </div>
                  
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button  class="btn btn-primary"  >Save</button>
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
       name:"New",
       data(){
            return {
              form: new Form({
                 cat_name:''
              })
            }
       } ,
       methods:{
        addCategory(){
          this.form.post('/add-category')
          .then((response) =>{
               this.$router.push('/category-list');
                  Toast.fire({
                    icon: 'success',
                    title: 'Category Added Successfully'
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

