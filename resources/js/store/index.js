
import Axios from "axios";

 export default{
    state:{
        category:[],
        post:[],
        blogpost:[],
        singlepost:[],
        allcategories:[],
        latestpost:[]
    },
    getters:{
         getCategory(state){
              return state.category;
         },
         getPost(state){
             return state.post;
         },
         getBlogPost(state){
              return state.blogpost;
         },
         BlogPost(state){
          return state.singlepost;
           },
         allcategories(state){
               return state.allcategories;
          },
          getlatestpost(state){
               return state.latestpost;
               ;
                }
    },
    actions:{
          allCategory(context){
               axios.get('/category')
                   .then((response) =>{
                        context.commit('categories',response.data.categories)
                   })
          },
          AllPost(context){
               axios.get('/post')
                 .then((response)=>{
                      context.commit('posts',response.data.posts)
                 })
          },
          allBlogPost(context){
               axios.get('/blog-post')
                 .then((response)=>{
                      context.commit('allbBogPost',response.data.posts)
                 })
          },
          getPostById(context,id){
               axios.get('/blog-post/'+id)
                 .then((response)=>{
                      context.commit('BlogPost',response.data.post)
                 })
          },
          allcategories(context){
               axios.get('/categories')
                 .then((response)=>{
                      context.commit('allcategories',response.data.categories)
                 })
          },
          getPostByCatID(context,id){
               axios.get('/category-post/'+id)
                 .then((response)=>{
                      context.commit('CategoryPost',response.data.posts)
                 })
          },
          SearchPost(context,payload){
               axios.get('/search?s='+payload)
                 .then((response)=>{
                      context.commit('getSearchPost',response.data.posts)
                 })
          },
          latestPost(context){
               axios.get('/latest-post')
                 .then((response)=>{
                      context.commit('getlatestpost',response.data.posts)
                 })
          }
          
          
    },
    mutations:{
     categories(state,data){
           state.category = data;
     },
     posts(state,payload){
          state.post = payload;

     },
     allbBogPost(state,payload){
          state.blogpost = payload;

     },
     BlogPost(state,payload){
          state.singlepost = payload;

     },
     allcategories(state,payload){
          state.allcategories=payload;

     },
     CategoryPost(state,payload){
         
          state.blogpost=payload;

     },
     getSearchPost(state,payload){
         
          state.blogpost=payload;

     },
     getlatestpost(state,payload){
         
          state.latestpost=payload;

     }
}   
}
