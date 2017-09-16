<!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <a href="{{url('/')}}" class="logo">
        <h3>MOVIES</h3>
      </a>
      <nav>
      {!! Form::open(['route'=>'posts.search',"method"=>"GET"]) !!}
        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search">
            <div class="input-group search">
              {{ Form::text('q',old('q'),['class'=>'form-control','required'=>'','min'=>'5','max'=>'255','placeholder'=>'angry bird #animation...']) }}
              <span class="input-group-btn">
                <button class="btn btn-default" style="margin-right:0px" type="submit">Go!</button>
              </span>
            </div>
        </div>
      {!! Form::close() !!}
      </nav>
    </div>
  </div>
  <!-- /top navigation -->