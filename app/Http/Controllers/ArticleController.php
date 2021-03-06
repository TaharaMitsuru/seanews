<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $posts = Article::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0) {
            $headline = $posts->shift();
        }else {
            $headline = null;
        }
        
        // article/index.blade.phpにファイルを渡している。
        // また、VIEWテンプレートにheadline,post,という変数を渡している。
        return view('article.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
