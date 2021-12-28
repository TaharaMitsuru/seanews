<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function create(Request $request)
    {
        $comment->article_id = $article->id;   //左辺が特定のスレッドに対してコメントをするアクション。右辺が特定のスレッドを探すアクション。
        $comment->save();
    }
}
