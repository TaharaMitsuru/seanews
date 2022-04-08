@extends('layouts.article')
@section('title', '登録済み投稿データ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>海遊び掲示板</h2>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ArticleController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            
            <div class="col-md-8">
                <form action="{{ action('Admin\ArticleController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="list-artical col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">画像</th>
                                <th width="20%">タイトル</th>
                                <th width="30%">本文</th>
                            </tr>
                        </thead>
                        
                        
                        
                        <tbody>
                            @foreach($posts as $article)
                            <tr>
                                <th>{{ $article->id }}</th>
                                <td> 
                                   <div class="image col-md-6 mt-4 form-control-auto">
                                        @if ($article->image_path) {{-- image_passはArticleModelのarticle.tableのカラムに設定している.その上でarticlecontrollerのindexactionでpostsに代入されている --}}
                                          <img src="{{ $article->image_path }}" class="sample">
                                        @endif    {{-- foreachの中にif文のsrc=assetを使うことにより、1つのスレッドに対しての配列で使う事が出来るようになる --}}
                                  
                                   </div> 
                                </td>
                                
                                
                                
                                <td>{{ \Str::limit($article->title, 100) }}</td>
                                <td>{{ \Str::limit($article->body, 250) }}</td>
                                <td>
                                    <br>
                                    <br>
                                    <div>
                                        <a href="{{ action('Admin\ArticleController@edit', ['id' => $article->id]) }}">編集</a>
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\ArticleController@delete', ['id' => $article->id]) }}">削除</a>
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\CommentController@add', ['id' => $article->id]) }}">コメント</a>
                                    </div>
                          
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    @endsection    