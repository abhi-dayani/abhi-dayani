<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_categories;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function listSub_Category(Request $request)
    {
        $sub_categories = Sub_categories::get();
        
        if (session()->has('success')) {
            return view('backend.sub_categories.index')->with(['sub_categories' => $sub_categories, 'success' => session('success')]);
        } elseif (session()->has('error')) {
            return view('backend.sub_categories.index')->with(['sub_categories' => $sub_categories, 'error' => session('error')]);
        }
        
        return view('backend.sub_categories.index')->with(['sub_categories' => $sub_categories]);
    }
    public function createSub_Category(Request $request)
    {   
        $categories = Category::get();
        return view('backend.sub_categories.create')->with(['categories' => $categories]);
    }
    
    public function storeSub_Category(Request $request)
    {     
        
        $validated = $request->validate([
            'category_type' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $sub_categories = new Sub_categories;
        $sub_categories->category_type = $request->category_type;
        $sub_categories->name = $request->name;
        $sub_categories->slug = $request->slug;
        // $sub_categories->category = $request->sub_category;
        
        if ($request->file('image')) {
            $name = time().'_'.$request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'),$name);
            $sub_categories->image = $name;
        }
        $sub_categories->save();

        if ($sub_categories->id) {
            return redirect()->route('sub_categories')->with(['success' => 'sub_categories create successfully.']);
        } else {
            return redirect()->route('sub_categories')->with(['error' => 'sub_categories not created']);
        } 
    }
    public function editSub_Category($scid)
    {
        $categories = Category::get();
        $sub_categories = Sub_categories::find($scid);

        if (!$sub_categories && empty($sub_categories)) 
        {
            return redirect()->route('sub_categories');
        }

        return view('backend.sub_categories.edit')->with(['sub_categories' => $sub_categories, 'categories' => $categories]);
    }
    public function updateSub_Category(Request $request)
    {
       
        $request->validate([
            'category_type' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);
        $sub_categories = Sub_categories::find($request->id);
    
        $sub_categories->category_type = $request->category_type;
        $sub_categories->name = $request->name;
        $sub_categories->slug = $request->slug;
        // $sub_categories->category = $request->category;

        if($request->status === 'on'){
            $sub_categories->status = 1;
        }
        else {
            $sub_categories->status = 0;
        }
         $sub_categories->save();
        
           
         if ($sub_categories->id) {
            return redirect()->route('sub_categories')->with(['success' => 'sub_categorie create successfully.']);
        } else {
            return redirect()->route('sub_categories')->with(['success' => 'sub_categorie create successfully.']);
        }
        
        
    }
    public function deleteSub_Category($scid)
    {
        Sub_categories::find($scid)->delete();

        return redirect()->route('sub_categories');
    }
}
