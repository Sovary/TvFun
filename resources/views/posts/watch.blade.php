@extends("main")

@section('css')
{{Html::style($PATH.'/assets/switchery/dist/switchery.min.css')}}
<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '147117785886864',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  </script>
<style type="text/css">
  .social-btn{
    height: 30px;
    width: 30px;
    padding-left: 0;
    padding-right: 0;
    color: white;
    font-size: 20px;
  }
  .social-btn>.fa{vertical-align: top;}
  .gplus{background-color: #dd4b39;}
  .twitter{background-color: #2795e9;}
  .facebook{background-color: #3b5998;}
</style>
@stop
@section("title","| ".$posts['post']->title)
@section("body")
<!-- page content -->
<div class="right_col" role="main">
@include("partials.admin._message")
  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="x_panel">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Watch Full Video</a>
            </li>
            @if ($posts['post']->highlight!="" || $posts['post']->highlight !=null)
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Watch Trialer</a>
            </li>
            @endif
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <div class="col-md-12 col-sm-12 col-xs-12">
          
                <div class="row">
                  <div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="{{$posts['post']->videos[0]->url}}?autoplay=0&rel=0&showinfo=0&cc_load_policy=1&cc_lang_pref=en" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
                </div>

                
              </div>
            </div>
            @if ($posts['post']->highlight!="" || $posts['post']->highlight !=null)
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
              <div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="{{$posts['post']->highlight}}?autoplay=0&rel=0&showinfo=0&cc_load_policy=1&cc_lang_pref=en" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
            </div>  
            @endif
          </div>


        </div>
        <div class="row">
          <div class="col-md-12">
            <h2 class="txt-kh" style="line-height: 1.5em">
            @if(Auth::check())
              @if(Auth::user()->id == $posts['post']->user_id)
                <a href="{{route('admin.post.edit',$posts['post']->fake_id)}}" class="btn btn-warning btn-xs"> <i class="fa fa-pencil"></i> </a>
              @endif
            @endif
            {{$posts['post']->videos[0]->title}}
            </h2>
          </div>
        </div>
        <a  data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-warning"></i> Report Us</a>
        <a  onclick="reload()"><i class="fa fa-warning"></i> Reload</a>
        
        <div class="row">
          <div class="col-md-10">
            <h3>{{$posts['post']->view_count}} views</h3>

            <h5>Published on {{ date('M j, Y',strtotime($posts['post']->updated_at)) }}</h5>
            <a class="btn btn-sm btn-default social-btn facebook"  onclick="socialShare('fb',{'url':'','title':'{{$posts['post']->title}}','desc':'{!! \Illuminate\Support\Str::words($posts['post']->description, 80,'....')  !!}','id':'{{$posts['post']->fake_id}}'})"> <i class="fa fa-facebook"></i></a>
            <a class="btn btn-sm btn-default social-btn gplus" onclick="socialShare('go',{'url':'','title':'{{$posts['post']->title}}','desc':'{!! \Illuminate\Support\Str::words($posts['post']->description, 80,'....')  !!}','id':'{{$posts['post']->fake_id}}'})"> <i class="fa fa-google-plus"></i></a>
            <a class="btn btn-sm btn-default social-btn twitter" onclick="socialShare('tw',{'url':'','title':'{{$posts['post']->title}}','desc':'{!! \Illuminate\Support\Str::words($posts['post']->description, 80,'....')  !!}','id':'{{$posts['post']->fake_id}}'})"> <i class="fa fa-twitter"></i></a>
          </div>
          <div class="col-md-2">
          <br/>
            <label>
              <input type="checkbox" class="js-switch" /> Night Mode
            </label>
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <div class="txt-kh">
                {{$posts['post']->description}}
            </div>
            @foreach(explode(',',$posts['post']->tages) as $tag)
              <span class="label label-default">{{$tag}}</span>
            @endforeach
            <div class="clearfix"></div>
          </div>
        </div> 

        
      </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_title">
            <h2>Suggested Video</h2>
            <div class="clearfix"></div>
          </div>
          <div class="row">
            <div class="x_content">
              <ul class="list-unstyled msg_list">
              @foreach($posts['suggests'] as $suggest)
                <li>
                  <a href="{{route('posts.watch',$suggest->fake_id)}}"  style="width:100%; cursor: pointer;">
                    <span class="image">
                    @if (filter_var($suggest['thumbnail'], FILTER_VALIDATE_URL))
                      @php
                        $suggest['thumbnail'] = str_replace("hqdefault","mqdefault",$suggest['thumbnail']);
                      @endphp
                      <img src="{{$suggest['thumbnail']}}" alt="img" width="168px" height="110px">
                    @else
                      <img src="{{$PATH}}/uploads/{{$suggest['thumbnail']}}" alt="img" width="168px" height="94px">
                    @endif
                      
                    </span>
                    
                    <span class="txt-ellipse txt-kh">{{$suggest->title}}</span>
                    
                    <p style="color:#9e9e9e">{{number_format($suggest['view_count'])}} views <br> {{$suggest['created_at']->diffForHumans()}}</p>
                  </a>
                </li>
              @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Report Video</h4>
        </div>
        {!! Form::open(['route'=>['report.send',$posts['post']->fake_id],'method'=>"POST",'id'=>'report']) !!}
        <div class="modal-body">
          <span id="msg"></span>
          @php $reps = ['broken','duplicate','other']  @endphp
          @foreach($reps as $rep)
          <div class="radio">
            <label>
              <input type="radio" checked="" value="{{$rep}}" name="types"> {{ucfirst($rep)  }}
            </label>
          </div>
          @endforeach
          <textarea class="form-control" rows="3" name="message" placeholder="Message"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
@section('js')
{{Html::script($PATH.'/assets/switchery/dist/switchery.min.js')}}
<script type="text/javascript">



  var elem = document.querySelector('.js-switch');
  var init = new Switchery(elem,{size:'small'});
  
  elem.onchange=function(d){
    if(elem.checked)
    {
      modeOn(); 
    }else{
      modeOff();
    }
  }
  if(window.localStorage.getItem("nightmode")==1)
  {
    elem.click();  
  }else{
    modeOff();
  }
  
  function modeOn()
  {
    window.localStorage.setItem("nightmode",1);
     
      var css = '#myTab,#myTab>li,.right_col,.x_panel,.x_title,.x_content,.msg_list>li,footer { background: #111111 !important;border: 0px !important; -webkit-transition: background-color 1000ms linear;-moz-transition: background-color 1000ms linear;-o-transition: background-color 1000ms linear;transition: background-color 2s ease-out;}',
      head = document.head || document.getElementsByTagName('head')[0],
      style = document.createElement('style');
      style.type = 'text/css';
      if (style.styleSheet){
        style.styleSheet.cssText = css;
      } else {
        style.appendChild(document.createTextNode(css));
        style.setAttribute('id','night');
      }
      
      head.appendChild(style);
  }
  function modeOff(){
    $('style#night').remove();
    window.localStorage.setItem("nightmode",0);
  }
  function socialShare(type,obj){
    console.log(obj)
      obj.url = "http://2f7c3d63.ngrok.io/watch/"+obj.id
      //obj.url ="https://stackoverflow.com/questions/19227702/twitter-share-button-dynamic-url-share"
      
      switch (type)
      {
        case "fb":
          FB.ui({
            method: 'share',
              action_type: 'og.shares',
              action_properties: JSON.stringify({
                  object: {
                      'og:url': obj.url,
                      'og:title': obj.title,
                      'og:description': obj.desc,
                      'og:image':"http://2f7c3d63.ngrok.io/uploads/{{$posts['post']->thumbnail}}"
                  }
              })
            
          }, function(response){
              console.log(response);
          }); 
        break;
        case "tw":
          window.open("https://twitter.com/intent/tweet?url="+encodeURIComponent(obj.url)+"&text="+encodeURIComponent(obj.title), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600')
        break;
        case "go":
          window.open("https://plus.google.com/share?url="+encodeURIComponent(obj.url)+"&text="+encodeURIComponent(obj.title), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600')
        break;
      }
      
    }
    
    $('#report').on('submit',function(e){
        
        e.preventDefault(e);

        $(".modal-footer button").attr("disabled",true)
        $.ajaxSetup({
            header:$('input[name="_token"]').val()
        })
    

        $.ajax({
          type:"POST",
          url:'{{route("report.send",$posts["post"]->videos[0]->id)}}',
          data:$(this).serialize(),
          dataType: 'json',
          success: function(data){
             if(data=="ok")
             {
              $("#msg").html("<p style='color:green'>Thanks for your report</p>") 
              setTimeout(function() {$('.bs-example-modal-sm').modal('hide');$('a[data-toggle="modal"]').remove()}, 2000);              
             }
             else{
              $("#msg").html("<p style='color:red'>"+data+"</p>")
              setTimeout(function() {$('.bs-example-modal-sm').modal('hide');},2000);
             }
            
          },
          error: function(data){
            console.log(data)
            var er =JSON.parse(data.responseText)
            for(var x in er)
            {
              $("#msg").html("<p style='color:red'>"+er[x]+"</p>")
            }
            $(".modal-footer button").attr("disabled",false);
          }
        });
    });
  function reload(){
    var iframe = document.querySelector("iframe");
    iframe.src = iframe.src;
  }
</script>

@stop
        