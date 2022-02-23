<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;


class CategoryController extends Controller
{
    public function listCategory(Request $request)
    {
        $categories = Category::get();
        
        if (session()->has('success')) {
            return view('backend.categories.index')->with(['categories' => $categories, 'success' => session('success')]);
        } elseif (session()->has('error')) {
            return view('backend.categories.index')->with(['categories' => $categories, 'error' => session('error')]);
        }

        return view('backend.categories.index')->with(['categories' => $categories]);
    }

    public function createCategory(Request $request)
    {
        return view('backend.categories.create');
    }

    public function storeCategory(Request $request)
    {     
        $validated = $request->validate([
            
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required','in:men,women',
            
        ]);
            
        $categories = new Category;
        $categories->name = $request->name;
        $categories->slug = $request->slug;
        $categories->category = $request->category;
        

        
        if ($request->file('image')) {
            $name = time().'_'.$request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'),$name);
            $categories->image = $name;
        }
        $categories->save();

        if ($categories->id) {
            return redirect()->route('categories')->with(['success' => 'category create successfully.']);
        } else {
            return redirect()->route('categories')->with(['error' => 'category not created']);
        } 
    }
    public function editCategory($cid)
    {
        $categories = Category::find($cid);

        if (!$categories && empty($categories)) 
        {
            return redirect()->route('categories');
        }

        return view('backend.categories.edit')->with(['categories' => $categories]);
    }
    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'slug' => 'required',
            'category' => 'required','in:men,women',       
        ]);
        $categories = Category::find($request->id);
    
        $categories->name = $request->name;
        $categories->slug = $request->slug;
        $categories->category = $request->category;

        if($request->status === 'on'){
            $categories->status = 1;
        }
        else {
            $categories->status = 0;
        }
         $categories->save();
        

        if ($categories->id) {
            return redirect()->route('categories')->with(['success' => 'categorie create successfully.']);
        } else {
            return redirect()->route('categories')->with(['success' => 'categorie create successfully.']);
        }
        
    }
    public function deletecategory($cid)
    {
        Category::find($cid)->delete();

        return redirect()->route('categories');
    }
    
}
