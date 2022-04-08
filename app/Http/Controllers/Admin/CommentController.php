<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\History;
use Carbon\Carbon;
use App\Article;
use Auth;

class CommentController extends Controller
{
  public function add(Request $request)
  {
    
  
    $article = Article::find($request->id);
    //commnetのブレードの方にarticleの値を渡している。articleが使えるようになる。
    return view('admin.article.comment', ['article' => $article]);
  }
  
  public function create(Request $request)
    {
        $comment = new Comment;//データベースに保存するために紐づけている。
        
        //左辺の　$a=5　$commentのarticle_idに　$requestのarticle_idの値を代入している。
        $comment->article_id = $request->article_id;
       
        
        //コメントのインスタンスのuser_idに対して、logiin userのidを代入している。
        $comment->user_id = Auth::id(); //右辺はログインしているユーザーのIDを取得できる。
    
        //$formはコントロールのcreateの中で定義している。
        $form = $request->all();
        unset($form['_token']);

       
        $comment->fill($form);
        $comment->save();
        
        
        //?id=はサーバーとプラウザ側のputとpush内部的にindex?id='はurl
        return redirect('admin/article/index?id=' . $request->article_id);//$requestに入っているarticle_idを表示している。
    }
 public function index(Request $request)
   {
  $article = Article::find($request->id);//クラスメソッド
    //commnetのブレードの方にarticle_idの値を渡している
    return view('admin.article.comment', ['article' => $article]);//インスタンス変数article
   }
   
}