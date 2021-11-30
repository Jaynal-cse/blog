<template>
  <div>
      
          <section class="content">
      <div class="row justify-content-around">
        <div class="col-8 ">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
              <div class="card-tools">
                
                  <router-link to="/add-category" class="btn btn-primary" style="color:#fff;text-decoration:none">
                  Add Category
                  </router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>
                     <select name="" id="" v-model="select" @change="deleteSelected">
                          <option value="">Select</option>
                          <option value="">Delete All</option>
                      </select>
                      <br>
                      <input type="checkbox" @click="selectAll" v-model="all_select">
                         <span v-if="all_select == false">Check All</span>
                         <span v-else>Uncheck All</span>
                  </th>
                  <th>SI</th>
                  <th>Category Name</th>
                  <th> Date </th>
                  <th>Action(s)</th>
                 
                </tr>
                </thead>
                <tbody>
                <tr v-for="(category,index) in getallCategory" :key ="category.id">
                  <td><input type="checkbox" :value="category.id" v-model="categoryItem"></td>
                  <td>{{index+1}}</td>
                  <td>{{category.cat_name}}</td>
                  <td>{{category.created_at | timeformat}}</td>
                  <td>
                    <router-link :to="`edit-category/${category.id}`">Edit</router-link>
                    <a href="" @click.prevent = "deletecategory(category.id)">Delete</a>
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
   name:'List',
   data(){
     return{
       categoryItem:[],
       select:'',
       all_select:false
     }
   },
   mounted(){
          this.$store.dispatch("allCategory")
   },
   computed:{
       getallCategory(){
         return this.$store.getters.getCategory
       }
   },
   methods:{
       deletecategory(id){
              axios.get('/category/'+id)
               this.$store.dispatch("allCategory")
                .then(()=>{
                     Toast.fire({
                    icon: 'success',
                    title: 'Category Deleted Successfully'
                  }) 
                })
       },
       

       deleteSelected(){
         //alert(this.categoryItem);
         axios.get('/delete-categories/'+this.categoryItem)
         this.categoryItem = []
         this.$store.dispatch("allCategory")
          .then(()=>{
                     Toast.fire({
                    icon: 'success',
                    title: 'Selected Categories Deleted'
                  }) 
                })
       },
       selectAll(){
               if(this.all_select==false){
                    this.all_select = true
                    for(var category in this.getallCategory){
                        this.categoryItem.push(this.getallCategory[category].id)
                    }
                }else{
                    this.all_select = false
                    this.categoryItem = []
                }
         
        // alert(this.categoryItem);
       
       }

     
   }



}
</script>

<style>

</style>