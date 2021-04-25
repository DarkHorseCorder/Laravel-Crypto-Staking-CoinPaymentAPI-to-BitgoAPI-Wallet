<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;


class PageController extends Controller
{

    
    public function index()
    {
        $pages = Page::get();
        return view('admin.page.index',compact('pages'));
    }

  
    public function create()
    {
        return view('admin.page.create');
    }

   
    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->details = clean($request->details);
        $page->lang = $request->lang;
        $page->save();
        return back()->with('success',__('Page created successfully'));
    }

  
    public function edit(Page $page)
    {
        return view('admin.page.edit',compact('page'));
    }

    
    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->details = clean($request->details);
        $page->lang = $request->lang;
        $page->update();
        return back()->with('success',__('Page updated successfully'));
    }

    public function destroy(Request $request)
    {
        Page::findOrFail($request->id)->delete();
        return back()->with('success',__('Page deleted successfully'));
    }
}
