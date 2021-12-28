<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seanews;
use App\History;
use Carbon\Carbon;
class SeanewsController extends Controller
{
  public function add()
  {
    return view('admin.seanews.create');
  }
 public function create(Request $request)
 {
   // Varidationを行う。
   
   $this->validate($request, Seanews::$rules);
      
      $seanews = new Seanews();
      $form = $request->all();
      
      // formに画像が送信されてきたら、保存して、$seanews->image_pathに画像のパスを保存する。
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $seanews->image_path = basename($path);
      } else {
           $seanews->image_path = null;
      }
      
      //フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      //フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      //データベースに保存する
      $seanews->fill($form);
      $seanews->save();
      
   // admin/seanews/createにリダイレクトする
   return redirect('admin/seanews/create');
 }
 
 public function index(Request $request)
 {
   $cond_title = $request->cond_title;
   if ($cond_title != '') {
     //検索されたら検索結果を取得する。
     $posts = Seanews::where('title', $cond_title)->get();
   } else {
     //それ以外は全てのニュースを取得する。
     $posts = Seanews::all();
   }
   return view('admin.seanews.index', ['posts' => $posts, 'cond_title' => $cond_title]);
 }
 public function edit(Request $request)
 {
     // seanews Modelからデータを取得する
     $seanews = Seanews::find($request->id);
     if (empty($seanews)) {
         abort(404);
     }
     return view('admin.seanews.edit', ['seanews_form' => $seanews]);
 }
 public function update(Request $request)
 {
     //Validationをかける
     $this->validate($request, Seanews::$rules);
     //Seanews Modelからデータを取得する。
     $seanews = Seanews::find($request->id);
     //送信されてきたフォームデータを格納する。
     $seanews_form = $request->all();
     if ($request->remove == 'true') {
         $seanews_form['image_path'] = null;
     }elseif ($request->file('image')) {
        $path = $request->file('image')->store('public/image');
        $seanews_form['image_path'] = basename($path); 
     }else {
        $seanews_form['image_path'] = $seanews->image_path; 
     }
     unset($seanews_form['image']);
     unset($seanews_form['remove']);
     unset($seanews_form['_token']);
     
     //該当するデータを上書きして保存する。
     $seanews->fill($seanews_form)->save();
     
     //以下を追記。編集履歴のアクション
     $history = new History();
     $history->seanews_id = $seanews->id;
     $history->edited_at = Carbon::now();
     $history->save();
     
     
     return redirect('admin/seanews');
 }
 public function delete(Request $request)
 {
     //該当するSeanews Modelを取得
     $seanews = Seanews::find($request->id);
     //削除する
     $seanews->delete();
     return redirect('admin/seanews/');
 }
 
 public function comment(Request $request)
 {
     
 }
}
