 @extends("partials.admin.main")
 @section("title","| Home")

 @section("content")
 <div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="javascript:alert('redirect to page and list all new video')">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
            <div class="count">179</div>
            <h3>New Video</h3>
            <p>The recently videos were inserted</p>
          </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="javascript:alert('redirect to page and list all banned video')">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-ban"></i></div>
            <div class="count">{{$dash['banned']}}</div>
            <h3>Unpublished Video</h3>
            <p>Total banned video</p>
          </div>
        </a>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-eye"></i></div>
          <div class="count">{{$dash['totalView']}}</div>
          <h3>Total View</h3>
          <p>Count all views from the beginning</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-video-camera"></i></div>
          <div class="count">{{$dash['totalVid']}}</div>
          <h3>All Videos</h3>
          <p>Total from scrach</p>
        </div>
      </div>
    </div>
  </div>
</div>

@stop