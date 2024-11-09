<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function homeIndex(Request $request)
    {
        if ($request->ajax()) {
            $posts =  post::latest()->paginate(15);
            return Response()->json([
                'success' => true,
                'view' => View('frontend.includes.postItems', [
                    'posts' => $posts,
                ])->render(),
                'next_page_url' => $posts->nextPageUrl()
            ]);
        }

        $posts = Cache::remember('posts', 30, function () {
            return post::latest()->paginate(15);
        });
        return view('frontend.homeIndex', compact('posts'));
    }


    public function singlePost($slug){
        $post = Post::where('slug',$slug)->first();
        return view('frontend.post.singlePost', compact('post'));
    }
}
