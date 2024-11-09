<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        menuSubmenu('categories', 'categoriesAll');
        $categories = Category::latest()->paginate(30);
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        menuSubmenu('categories', 'categoriesCreate');
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        menuSubmenu('categories', 'categoriesAll');

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories,name',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'slug' => 'nullable',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = getSlug($request->name, $category, boolval($request->name));
        $category->active = $request->active ? 1 : 0;

        if ($request->hasFile('image')) {
            $category->image = $category->upload($request->image);
        }

        $category->save();

        toast('Category created successfully!', 'success');
        return redirect()->back();
    }
    public function edit(Category $category){
        menuSubmenu('categories', 'categoriesAll');
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category){

        menuSubmenu('categories', 'categoriesAll');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories,name,'.$category->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $category->name = $request->name;
        $category->slug = getSlug($request->slug, $category, boolval($request->slug));
        $category->active = $request->active ? 1 : 0;

        if ($request->hasFile('image')) {
            $old_file = 'categories/' . $category->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $category->image = $category->upload($request->image);
        }

        $category->save();

        toast('Category updated successfully!', 'success');
        return redirect()->back();
    }

    public function destroy(Request $request){
        $id = $request->category;
        $category = Category::where('id', $id)->first();
        if(!$category){
            return response()->json(['error' => 'Category not found!']);
        }
        $old_file = 'categories/' . $category->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }

        $category->delete();
        return response()->json(['success' => 'Category deleted successfully!']);
    }


    public function status(Request $request){
        $category = Category::find($request->category);
        if(($category->active == 0)){
          $category->active =  1;
          $active = true;
        }else{
          $category->active =  0;
          $active = false;
        }
        $category->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }


    public function search(Request $request)
    {
        $q = $request->q;
        $categories = Category::where(function ($qq) use ($q) {
            $qq->orWhere('name', 'like', "%" . $q . "%")
            ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('name')
        ->paginate(100);
        $categories->appends($request->all());
        $page = View('admin.categories.searchData', ['categories' => $categories])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }
}
