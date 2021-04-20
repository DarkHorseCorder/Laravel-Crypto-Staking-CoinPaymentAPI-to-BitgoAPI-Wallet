<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use Datatables;

class BlogCategoryController extends Controller
{

   public function __construct(BlogCategoryResource $resource)
   {
       $this->resource = $resource;
   }

  
    public function index()
    {
        $categories = BlogCategory::latest()->paginate(15);
        return view('admin.cblog.index',compact('categories'));
    }

   
    public function store(BlogCategoryRequest $request)
    {
        $this->resource->store($request->only('name','status'));
        return back()->with('success',__('Category added successfully'));
    }

    
    public function update(BlogCategoryRequest $request, BlogCategory $bcategory)
    {
        $this->resource->update($request->only('id','name','slug'),$bcategory);
        return back()->with('success',__('Category updated successfully'));
    }
}
