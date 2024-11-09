<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Events\NotificationEvent;
use Illuminate\Http\Request;
use App\Events\PostCreated;
use App\Models\Category;
use App\Models\PostCat;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        menuSubmenu('posts', 'postsAll');
        $posts = Post::latest()->paginate(30);
        return view('admin.posts.index',compact('posts'));
    }

    public function create(){
        menuSubmenu('posts', 'postCreate');
        $categories = Category::latest()->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request) {
        menuSubmenu('post', 'postAll');

        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:posts,title',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'slug' => 'nullable',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }

        // Create and save the post
        $post = new Post();
        $post->title = $request->title;
        $post->slug = getSlug($request->title, $post, boolval($request->title));
        $post->excerpt = $request->excerpt;
        $post->description = $request->description;
        $post->active = $request->active ? 1 : 0;

        if ($request->hasFile('image')) {
            $post->image = $post->upload($request->image);
        }

        $post->save();


        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCat::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCat;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->save();
                }
            }
        }

        $data = [
            'title' => $post->title,
            'excerpt' => $post->excerpt ,
        ];

        if ($post) {
            event(new PostCreated($data));
        }



        toast('Post created successfully!', 'success');
        return redirect()->back();
    }
    public function edit(Post $post){
        menuSubmenu('posts', 'postsAll');
        $categories = Category::latest()->get();
        return view('admin.posts.edit',compact('post', 'categories'));
    }

    public function update(Request $request, Post $post){

        menuSubmenu('posts', 'postsAll');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:posts,title,'.$post->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()->withErrors($validation)->withInput();
        }


        $post->title = $request->title;
        $post->slug = getSlug($request->slug, $post, boolval($request->slug));
        $post->excerpt = $request->excerpt;
        $post->description = $request->description;
        $post->active = $request->active ? 1 : 0;
        if ($request->hasFile('image')) {
            $old_file = 'posts/' . $post->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $post->image = $post->upload($request->image);
        }
        $post->save();

        toast('Post updated successfully!', 'success');
        return redirect()->back();
    }

    public function destroy(Request $request){
        $id = $request->post;
        $post = Post::where('id', $id)->first();
        if(!$post){
            return response()->json(['error' => 'Post not found!']);
        }
        $old_file = 'posts/' . $post->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $post->delete();
        return response()->json(['success' => 'Post deleted successfully!']);
    }


    public function status(Request $request){
        $post = Post::find($request->post);
        if(($post->active == 0)){
          $post->active =  1;
          $active = true;
        }else{
          $post->active =  0;
          $active = false;
        }
        $post->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }


    public function search(Request $request)
    {
        $q = $request->q;
        $posts = Post::where(function ($qq) use ($q) {
            $qq->orWhere('title', 'like', "%" . $q . "%")
            ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('title')
        ->paginate(100);
        $posts->appends($request->all());
        $page = View('admin.posts.searchData', ['posts' => $posts])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }
}
