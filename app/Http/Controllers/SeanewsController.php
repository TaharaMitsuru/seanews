<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Seanews;

class SeanewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Seanews::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0) {
            $headline = $posts->shift();
        }else {
            $headline = null;
        }
        
        // seanews/index.blade.phpにファイルを渡している。
        // また、VIEWテンプレートにheadline,post,という変数を渡している。
        return view('seanews.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
