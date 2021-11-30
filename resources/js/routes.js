import adminHome from './components/admin/adminHome';
import CategoryList from './components/admin/category/List';
import AddCategory from './components/admin/category/New';
import EditCategory from './components/admin/category/Edit';
import PostList from './components/admin/post/List';
import AddPost from './components/admin/post/New';
import EditPost from './components/admin/post/Edit';


//Frontend Component
import publicHome from './components/public/publicHome';
import BlogPost from './components/public/blog/Blogpost';
import SignlePost from './components/public/blog/SingleBlog';



export const routes = [
   {
       path:'/home',
       component:adminHome
   },
    //Category Component Route
   {
     path:'/category-list',
     component:CategoryList
   },
   {
     path:'/add-category',
     component:AddCategory
   },
   {
    path:'/edit-category/:categoryId',
    component:EditCategory
  },
  //Post Component Route
  {
    path:'/post-list',
    component:PostList
  },
  {
    path:'/add-post',
    component:AddPost
  },
  {
   path:'/edit-post/:postId',
   component:EditPost
 },

 //Frontend Routes
 {
  path:'/',
  component:publicHome
},
{
  path:'/',
  component:publicHome
},
{
  path:'/blog',
  component:BlogPost
},
{
  path:'/blog/:id',
  component:SignlePost
},
{
  path:'/categories/:id',
  component:BlogPost
}
 ]