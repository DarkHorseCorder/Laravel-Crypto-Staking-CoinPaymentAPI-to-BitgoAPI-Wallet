<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{

   public function __construct(BlogResource $resource)
   {
       $this->resource = $resource;
   }


    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(15);
        return view('admin.blog.index',compact('blogs'));
    }

  
    public function create()
    {
        $categories = BlogCategory::where('status',1)->get(); 
        return view('admin.blog.create',compact('categories'));
    }

   
    public function store(BlogRequest $request)
    {
       
        $input = $request->only('title','category_id','description','photo','status');
        $this->resource->store($input);
        return back()->with('success','New blog has been created');
    }

  
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('status',1)->get(); 
        return view('admin.blog.edit',compact('blog','categories'));
    }
    
    public function update(BlogRequest $request, Blog $blog)
    {
        $this->resource->update($request->only('title','category_id','description','photo','status'),$blog);
        return back()->with('success','Blog has been updated');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back()->with('success','Blog has been deleted');
    }
}
