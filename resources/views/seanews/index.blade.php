@extends('layouts.front')

@section('content')
    <div class="container">
        <link rel="stylesheet" href="{{ asset('public/css/front.css') }}">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <br>
                    <br>
                      <strong><h4>～MENU～</h4></strong>
                </div>
               
                <ul class="list-group list-group-flush w-75 p-3">
                   
                   <strong>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('Newindex') }}">●掲示板</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('Newseanews') }}">●投稿フォーム</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('shoreplay') }}">●磯遊びコラム</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('beachcombing') }}">●ビーチコーミング</a>
                    <a class="nav-link text-body border-bottom w-50" href="https://weather.yahoo.co.jp/weather/" rel="nofollow">●天候情報 (外部link)</a>
                    <a class="nav-link text-body border-bottom w-50" href="https://sio.mieyell.jp/select?po=84004" rel="nofollow">●潮情報 (外部link)</a>
                    </strong>
                </ul>
                
                
                
                
                <div class="col-md-10 mx-auto text-center">
                       <strong><h4>～近況情報～</h4></strong>
                </div>
                
               
                
            　　
       <div class="container">
       <hr color="#c0c0c0">
       @if (!is_null($headline))
          <div class="row">
              <div class="headline col-md-10 mx-auto">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="caption mx-auto">
                              <div class="image">
                                  @if ($headline->image_path)
                                    <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                                  @endif
                              </div>
                              <div class="title p-2">
                                 <h1>{{ str_limit($headline->title, 70) }}</h1>
                              </div>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                          <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p>
                      </div>
                  </div>
              </div>
          </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ str_limit($post->title, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->body, 1500) }}
                                </div> 
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                @endif    
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach    
            </div>
        </div>
   </div>
   
@endsection           

