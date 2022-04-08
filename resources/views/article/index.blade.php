@extends('layouts.front')

@section('content')
    <div class="container">
        <link rel="stylesheet" href="{{ asset('public/css/front.css') }}">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <br>
                    <br>
                    <font color="#404000">
                      <strong><h3><b><i>～MENU～</i></b></h3></strong>
                    </font>
                </div>
               
                <ul class="list-group list-group-flush w-75 p-3">
                   
                   <strong>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('Newindex') }}">●掲示板</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('Newarticle') }}">●投稿フォーム</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('shoreplay') }}">●磯遊びコラム</a>
                    <a class="nav-link text-body border-bottom w-50" href="{{ route('beachcombing') }}">●ビーチコーミング</a>
                    <a class="nav-link text-body border-bottom w-50" href="https://weather.yahoo.co.jp/weather/" rel="nofollow">●天候情報  ～外部リンク～</a>
                    <a class="nav-link text-body border-bottom w-50" href="https://sio.mieyell.jp/select?po=84004" rel="nofollow">●潮情報  ～外部リンク～</a>
                    </strong>
                </ul>
                
                
                
                
                <div class="col-md-10 mx-auto text-center">
                    <font color="#404000">
                       <strong><h3><b>～福岡近況情報～</b></h3></strong>
                    </font>   
                </div>
                
               
                
            　　
       <div class="container">
       <hr color="#000020">
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
                      
                      <div class="col-md-6"><h5><b>
                          <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p></h5></b>
                      </div>
                  </div>
              </div>
          </div>
        @endif
        <hr color="#000020">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date"><font color=#000040><h5>
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div></font></h5>
                                <div class="title"><b>
                                    {{ str_limit($post->title, 150) }}
                                </div></b>
                                <div class="body mt-3"><h5><b>
                                    {{ str_limit($post->body, 1500) }}
                                    </b>
                                    </h5>
                                </div> 
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                @endif    
                            </div>
                        </div>
                    </div>
                    <hr color="#000020">
                @endforeach    
            </div>
        </div>
   </div>
   
@endsection           