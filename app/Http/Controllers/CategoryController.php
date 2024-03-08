<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index',['categories'=>Category::all()]);
    }
    public function add(Request $request)
    {
        $cat = new Category();
        $cat->category_name=$request->category;
        $cat->save();
        return redirect('/category');
    }
    public function delete($category_id)
    {
        Category::where('category_id',$category_id)->delete();
        return redirect('/category');
    }
    public function show()
    {
        $category = Category::all();
        return response()->json($category);
    }
}
