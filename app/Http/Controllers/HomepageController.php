<?php

namespace App\Http\Controllers;
use App\Models\Categories; 
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //fungsi untuk menampilkan halaman homepage 
    public function index() 
    { 
        $categories = Categories::all();
        return view('web.homepage',[ 
            'categories' => $categories, 
            ]);
    } 

    public function category($slug) 
   { 
       $category = Categories::find($slug); 
 
       return view('web.category_by_slug', ['slug' => $slug, 'category' => 
       $category]); 
   } 

    //  public function product() 
    // { 
    //     $title=('product');
    //    return view('web.product',['title'=>$title]); 
    // } 

    // public function product($slug){ 
    //     return view('web.product', ['slug' => $slug]); 
    // } 
  
    // public function categories() 
    // { 
    //     return view('web.categories'); 
    // } 
  
    // public function category($slug) 
    // { 
    //     return view('web.category_by_slug', ['slug' => $slug]); 
    // } 
  
    // public function cart() 
    // { 
    //     return view('web.cart'); 
    // } 
    
    // public function checkout() 
    // { 
    //     return view('web.checkout'); 
    // } 
} 
