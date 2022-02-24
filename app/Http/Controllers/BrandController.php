<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::get();

        if (session()->has('success')) {
            return view('backend.brands.index')->with(['brands' => $brands, 'success' => session('success')]);
        } elseif (session()->has('error')) {
            return view('backend.brands.index')->with(['brands' => $brands, 'error' => session('error')]);
        }

        return view('backend.brands.index')->with(['brands' => $brands]);
    }

    public function create(Request $request)
    {
        return view('backend.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:brands,name',
            'slug' => 'required|unique:brands,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = $request->slug;


        if ($request->file('image')) {
            $name = time().'_'.$request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'),$name);
            $brand->image = $name;
        }
        $brand->save();

        if ($brand->id) {
            return redirect()->route('brands')->with(['success' => 'Brand create successfully.']);
        } else {
            return redirect()->route('brands')->with(['error' => 'Brand not created']);
        }
    }

    public function edit($bid)
    {
        $brand = Brand::find($bid);
        if (!$brand && empty($brand))
        {
            return redirect()->route('brands');
        }

        return view('backend.brands.edit')->with(['brand' => $brand]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|unique:brands,name,'.$request->id,
            'slug' => 'required|unique:brands,slug,'.$request->id,
        ]);

        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        if (@$request->status) {
            $brand->status = 1;
        } else {
            $brand->status = 0;
        }

        // if ($request->file('image')) {
        //     $validated = $request->validate([
        //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     ]);
        //     $name = time().'_'.$request->file('image')->getClientOriginalName();
        //     $request->image->move(public_path('images'),$name);
        //     $brand->image = $name;
        // }
        $brand->save();

        if ($brand->id) {
            return redirect()->route('brands')->with(['success' => 'Brand edited successfully.']);
        } else {
            return redirect()->route('brands')->with(['error' => 'Brand not created']);
        }
    }

    public function delete($bid)
    {
        Brand::find($bid)->delete();

        return redirect()->route('brands');
    }

}
