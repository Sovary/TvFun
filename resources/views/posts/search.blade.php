@extends("main")
@section("title","| Search")
@section('css')
  <style type="text/css">
  .title{font-size: 1.5em;font-weight: bold;}
  .ellipsis-2{
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      text-overflow: ellipsis;
  }
  </style>
@stop
@section("body")
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-offset-2 col-md-7 col-md-offset-4 col-xs-12">
      <div class="x_panel">
          <div class="  col-sm-12 col-xs-12">
            <div class="x_title">
              <h2>Search Result</h2>
              <div class="clearfix"></div>
            </div>
            <div class="row">
              <div class="x_content">
                <ul class="list-unstyled msg_list">
                @if($posts->total() < 1)
                  No result
                @endif
                @foreach($posts->items() as $post)
                  <li>
                    <a href="{{route('posts.watch',$post->fake_id)}}"  style="width:100%; cursor: pointer;">
                      <span class="image">
                        @if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL))
                            @php
                              $post['thumbnail'] = str_replace("hqdefault","mqdefault",$post['thumbnail']);
                            @endphp
                          <img src="{{$post['thumbnail']}}" alt="img" width="246px" height="138px">
                        @else
                          <img src="{{$PATH}}/uploads/{{$post['thumbnail']}}" alt="img" width="246px" height="138px">
                        @endif
                      </span>
                      <p class="txt-ellipse txt-kh title">{{$post->title}}</p>
                      <p style="color:#9e9e9e">{{number_format($post->view_count)}} views &bull; {{$post->created_at->diffForHumans()}}</p>
                      <p class="ellipsis-2">{!! \Illuminate\Support\Str::words($post->description, 100,'....')  !!}</p>
                    </a>
                  </li>
                @endforeach
                </ul>
              </div>
            </div>
            @include('pagination.default', ['paginator' => $posts->appends(\Illuminate\Support\Facades\Input::except('page')),"interval"=>5])
          </div>
      </div>
    </div>

  </div>
 
 
</div>
@endsection
