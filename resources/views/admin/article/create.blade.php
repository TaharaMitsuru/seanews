{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.article')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '掲示板投稿フォーム')



{{-- admin.blade.phpの@yield('content')に以下のタグに埋め込む --}}
@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-8 mx-auto">
                 <h2>海で遊ぼう</h2><h5>携帯画像は投稿の際、「小」を選択してください。</h5>
                 <form action="{{ action('Admin\ArticleController@create') }}" method="post" enctype="multipart/form-data">
                     
                    @if (count($errors) > 0)
                       <ul>
                           @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                           @endforeach    
                       </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label><p class="text-danger">必須入力</p>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">本文</label><p class="text-danger">必須入力</p>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="15">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">画像</label><p class="text-danger">必須選択</p>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="投稿">
                 </form>
           </div>
       </div>
   </div>
@endsection