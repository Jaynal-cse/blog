<template>
     <span id="singleblog">
         <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{getBlogPost.title}}</a></h3>
                    </div>
                    <img :src="`uploadimage/${getBlogPost.photo}`" alt="" />
                  </div>
                  <p>
                   {{getBlogPost.description}}
                  </p>
                 
                 
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li v-if="getBlogPost.user"><i class="icon-user"></i><a href="#">{{getBlogPost.user.name}}</a></li>
                      <li v-if="getBlogPost.category"><i class="icon-folder-open"></i><a href="#">{{getBlogPost.category.cat_name}}</a></li>
                     
                    </ul>
                  </div>
                </div>
              </div>
            </article>
           
            
          </div>
          <BlogSidebar/>
        </div>
      </div>
    </section>

     </span>
</template>

<script>
import BlogSidebar from "./BlogSidebar.vue"
export default {
   name:'SingleBlog',
   mounted(){
      this.singlepost();
   },
   components:{
        BlogSidebar
   },
   computed:{
        getBlogPost(){
         return this.$store.getters.BlogPost;
       }
   },
   methods:{
        singlepost(){
             this.$store.dispatch("getPostById",this.$route.params.id);
        }   
   },
   watch:{
        $route(to,from){
              this.singlepost();
        }
   }

   

}
</script>

<style>

</style>