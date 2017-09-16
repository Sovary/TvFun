@extends("main")
@section("title","| Home Page")
@section("css")
<style type="text/css">
  .txt-kh{font-weight: bold}
</style>
@stop
@section("body")
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_title">
            <h2>Latest Video</h2>
            <div class="clearfix"></div>
          </div>
          <div class="row">
          @foreach($posts['lasts'] as $post)
            <div class="col-md-55">
              <a href="{{route('posts.watch',$post['fake_id'])}}">
                <div class="thumbnail">
                  <div class="image view view-first">
                    @if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL))
                        @php
                          $post['thumbnail'] = str_replace("hqdefault","mqdefault",$post['thumbnail']);
                        @endphp
                      <img style="width: 100%; display: block;" src="{{$post['thumbnail']}}" alt="image" />
                    @else
                      <img style="width: 100%; display: block;" src="{{$PATH}}/uploads/{{$post['thumbnail']}}" alt="image" />
                    @endif
                    <div class="mask">
                      <p  class="txt-kh">{{$post['description']}}</p>
                      <div class="tools tools-bottom">
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="caption">
                    <a class="txt-ellipse txt-kh" href="{{route('posts.watch',$post['fake_id'])}}">{{$post['title']}}</a>
                    <p style="color:#9e9e9e">{{$post['view_count']}} views &bull; {{$post['created_at']->diffForHumans()}}</p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
          </div>

        </div>
        

        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_title">
            <h2>Top Campaign</h2>
            <div class="clearfix"></div>
          </div>
          <div class="row">
          @foreach($posts['top'] as $post)
            <div class="col-md-55">
              <a href="{{route('posts.watch',$post['fake_id'])}}">
                <div class="thumbnail">
                  <div class="image view view-first">
                    @if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL))
                      @php
                        $post['thumbnail'] = str_replace("hqdefault","mqdefault",$post['thumbnail']);
                      @endphp
                      <img style="width: 100%; display: block;" src="{{$post['thumbnail']}}" alt="image" />
                    @else
                      <img style="width: 100%; display: block;" src="{{$PATH}}/uploads/{{$post['thumbnail']}}" alt="image" />
                    @endif
                    <div class="mask">
                      <p class="txt-kh">{{$post['description']}}</p>
                      <div class="tools tools-bottom">
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="caption">
                    <a class="txt-ellipse txt-kh" href="{{route('posts.watch',$post['fake_id'])}}">{{$post['title']}}</a>
                    <p style="color:#9e9e9e">{{number_format($post['view_count'])}} views &bull; {{$post['created_at']->diffForHumans()}}</p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
          </div>

        </div>
        

        <div class="clearfix"></div>

      </div>
      
    </div>

  </div>
 
</div>
@endsection
