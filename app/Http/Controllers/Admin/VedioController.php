<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Vedio;
use Illuminate\Support\Facades\Storage;

class VedioController extends Controller
{
    public function index(){
        menuSubmenu('posts', 'vediosAll');
        $vedios = Vedio::latest()->paginate(30);
        // dd($vedios);
        return view('admin.vedios.index',compact('vedios'));
    }

    public function create(){
        menuSubmenu('posts', 'vediosCreate');
        $posts = Post::latest()->get();
        return view('admin.vedios.create',compact('posts'));
    }

    public function store(Request $request) {
        menuSubmenu('vedios', 'vediosAll');

        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:vedios,title',
                'post_id' => 'required',
                'vedio' => 'required|file',
            ]
        );


        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }


        $vedio = new Vedio();
        $vedio->title = $request->title;
        $vedio->post_id = $request->post_id;
        $vedio->active = $request->active ? 1 : 0;
        if ($request->hasFile('vedio'))
        {
            $vedio->vedio_path = $vedio->upload($request->file('vedio'));
        }
        $vedio->save();

        toast('Vedio created successfully!', 'success');
        return redirect()->back();
    }
    public function edit(Vedio $vedio){
        menuSubmenu('posts', 'vediosAll');
        $posts = Post::latest()->get();
        return view('admin.vedios.edit',compact('vedio','posts'));
    }

    public function update(Request $request, Vedio $vedio){

        menuSubmenu('posts', 'vediosAll');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:vedios,title,'.$vedio->id,
                'post_id' => 'required',
                'vedio' => 'nullable|file',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        $vedio->title = $request->title;
        $vedio->post_id = $request->post_id;
        $vedio->active = $request->active ? 1 : 0;

        if ($request->hasFile('vedio')) {
            $old_file = 'vedios/' . $vedio->vedio_path;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $vedio->vedio_path = $vedio->upload($request->file('vedio'));
        }

        $vedio->save();

        toast('Vedio updated successfully!', 'success');
        return redirect()->back();
    }

    public function destroy(Request $request){
        $id = $request->vedio;
        $vedio = Vedio::where('id', $id)->first();
        if(!$vedio){
            return response()->json(['error' => 'Vedio not found!']);
        }
        $old_file = 'vedios/' . $vedio->vedio_path;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }

        $vedio->delete();
        return response()->json(['success' => 'Vedio deleted successfully!']);
    }


    public function status(Request $request){
        $vedio = Vedio::find($request->vedio);
        if(($vedio->active == 0)){
          $vedio->active =  1;
          $active = true;
        }else{
          $vedio->active =  0;
          $active = false;
        }
        $vedio->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }


    public function search(Request $request)
    {
        $q = $request->q;
        $vedios = Vedio::where(function ($qq) use ($q) {
            $qq->orWhere('title', 'like', "%" . $q . "%")
            ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('title')
        ->paginate(100);
        $vedios->appends($request->all());
        $page = View('admin.vedios.searchData', ['vedios' => $vedios])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }
}
