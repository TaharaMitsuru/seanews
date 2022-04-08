<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\History;
use Carbon\Carbon;
use Storage;
class ArticleController extends Controller
{
  public function add()
  {
    return view('admin.article.create');
  }
 public function create(Request $request)
 {
   // Varidationを行う。
   
   $this->validate($request, Article::$rules);
      
      $article = new Article;
      $form = $request->all();
      
      // formに画像が送信されてきたら、保存して、$artical->image_pathに画像のパスを保存する。
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $article->image_path = Storage::disk('s3')->url($path);
      } else {
           $artical_form->image_path = null;
      }
      
      //フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      //フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      //データベースに保存する
      $article->fill($form);
      $article->save();
      
   // admin/article/createにリダイレクトする
   return redirect('admin/article/create');
 }
 
 public function index(Request $request)
 {
   $cond_title = $request->cond_title;
   if ($cond_title != '') {
     //検索されたら検索結果を取得する。
     $posts = Article::where('title', $cond_title)->get();
   } else {
     //それ以外は全てのニュースを取得する。
     $posts = Article::all();
   }
   return view('admin.article.index', ['posts' => $posts, 'cond_title' => $cond_title]); //post と　cond_titleをview側で使えるようにする。
 }
 public function edit(Request $request)
 {
     // article Modelからデータを取得する
     $article = Article::find($request->id);
     if (empty($article)) {
         abort(404);
     }
     return view('admin.article.edit', ['article_form' => $article]);
 }
 public function update(Request $request)
 {
     //Validationをかける
     $this->validate($request, Article::$rules);
     //Seanews Modelからデータを取得する。
     $article = Article::find($request->id);
     //送信されてきたフォームデータを格納する。
     $article_form = $request->all();
     if ($request->remove == 'true') {
         $article_form['image_path'] = null;
     }elseif ($request->file('image')) {
        $path = Storage::disk('s3')->putFile('/',$article_form['image'],'public');
        $article->image_path = Storage::disk('s3')->url($path);
     }else {
        $article_form['image_path'] = $article->image_path; 
     }
     unset($article_form['image']);
     unset($article_form['remove']);
     unset($article_form['_token']);
     
     //該当するデータを上書きして保存する。
     $article->fill($article_form)->save();
     
     //以下を追記。編集履歴のアクション
     $history = new History();
     $history->article_id = $article->id;
     $history->edited_at = Carbon::now();
     $history->save();
     
     
     return redirect('admin/article');
 }
 public function delete(Request $request)
 {
     //該当するSeanews Modelを取得
     $article = Article::find($request->id);
     //削除する
     $article->delete();
     return redirect('admin/article/');
 }
}