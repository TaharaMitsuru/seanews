@extends('layouts.article')
@section('title', 'コメント投稿画面')

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-8 mx-auto">
               <h2>コメント投稿</h2>
               <form action="{{ action('Admin\CommentController@create') }}" method="post" enctype="multipart/form-data">
                   @if (count($errors) > 0)
                       <ul>
                            @foreach($errors->all() as $e)
                                  <li>{{ $e }}</li>
                            @endforeach      
                       </ul>
                   @endif
                   <br>
                   <br>
                    
                    <div class="form-group row">
                             <label class="col-md-8"><h5><b>スレッド番号: <span class="text-success ml-3">{{ $article->id }}</span></b></h5></label>
                        <div class="col-md-10">
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-md-4"><h5><b>コメントタイトル</b></h5></label><p class="text-danger"><b>必須入力</b></p>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    
                    
                    
                   <div class="form-group row">
                        <label class="col-md-4"><h4><b>～コメントフォーム～</b></h4></label><p class="text-danger"><b>必須入力</b></p>
                       <div class="col-md-10">
                           <textarea class="form-control" name="body" rows="15" value="{{ old('body') }}"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                       <div class="col-md-10">
                           <input type="hidden" name="article_id" value="{{ $article->id }}">
                           
                           {{ csrf_field() }}
                           <input type="submit" class="btn btn-primary" value="投稿">
                           
                       </div>
                   </div>
                </form>   
               
               <strong><h4 class="fw-bold text-center" ><b>～コメント一覧～</b></h4></strong>
               <br>
               <br>
               
                 {{--Article.phpで定義されたcomments --}}
                @if($article->comments != null)
                    
                    @foreach($article->comments as $comment)
                       
                <b><table class="table table-striped">
                        <thead>
                            <tr>
                               <th scope="col">タイトル</th>     
                               <th scope="col">コメント</th>
                               <th scope="col">{{ $comment->updated_at->format('投稿日 . Y年m月d日') }}</th>
                            </tr>
                        </thead>
                    </table>    
                </b>
                
                
                
                <table class="table table-dark table-striped">
                    <thead>
                       <tr class="small">
                         <th scope="col">{{ $comment->title }}</th>
                         <th scope="col">{{ $comment->body }}</th>
                       </tr>
                    </thead>
                </table>
                            
                    @endforeach
                @endif
           </div>
       </div>
   </div>
   @endsection