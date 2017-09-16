 @extends("partials.admin.main")
 @section("title","| Create")

 @section("content")
<div class="right_col" role="main">
  <div class="x_panel">
  	@include('partials.admin._message')
  </div>
  {!! Form::open(['route'=>'admin.post.store','files'=>'true','class'=>'form-horizontal']) !!}
  	<div class="x_panel">
  		<div class="row">
		  	<div class="col-md-6">
		  		<div class="x_panel">
		  			<div class="x_title">
		  				<h2>Post</h2>
		  				<div class="clearfix"></div>
		  			</div>
		  			<div class="x_content">
						<div class="form-group">
							{{ Form::label('post_title',"Title:",['class'=>'control-label col-md-3']) }}
							<div class="col-md-9">
							  {{ Form::text('post_title',null,['class'=>'form-control col-md-7','required'=>'','min'=>'5','max'=>'255']) }}
							</div>
						</div>
						<div class="form-group">
                          	{{ Form::label('description',"Description:",['class'=>'control-label col-md-3']) }}
                          	<div class="col-md-9">
                          		{{ Form::textarea('description',null,['class'=>'form-control']) }}
                          	</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('highlight',"Hightlight:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::url('highlight',null,['class'=>'form-control col-md-7']) }}
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('post_thumbnail',"Thumbnail:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  
								  {{ Form::select('thumbnail_types', [
									   'default' => 'Default YT Thumbnail',
									   'custom' => 'Custom Thumbnail',
									   ],null,['class'=>'form-control col-md-7','id'=>'thumbnail_types']
									) }}
								  {{ Form::file('post_thumbnail',['class'=>'form-control col-md-7','id'=>'post-thumbnail','style'=>'display:none','accept'=>'image/x-png,image/gif,image/jpeg']) }}
								  <img src="https://www.panasonic-electric-works.com/static/img/partners/no_image.png" alt="" width="196px" height="110px" id="thumbnail">
								  {{ Form::hidden('default_thumbnail',null,['id'=>'default_thumbnail']) }}
								</div>

							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('tags_1',"Input Tags:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::text('tags_1',null,['class'=>'form-control col-md-7','required'=>'']) }}
								  
								  @foreach($tags as $tag)
								  <span class="label label-primary" style="cursor:pointer;" data-item="{{$tag}}" onclick="addTag(this)">
									 {{$tag}}
								  </span>&nbsp;
								  @endforeach
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('post_types',"Action:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::select('post_types', [
									   'published' => 'Publish',
									   'unpublished' => 'Unpulbish',
									   'drafted' => 'Draft'],null,['class'=>'form-control col-md-7']
									) }}
								</div>
							</div>
						</div>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="col-md-6">
		  		<div class="x_panel">
		  			<div class="x_title">
		  				<h2>Video</h2>
		  				<div class="clearfix"></div>
		  			</div>
		  			
		  			<div class="x_content">
						<div class="form-group">
							{{ Form::label('video_title',"Title:",['class'=>'control-label col-md-3']) }}
							<div class="col-md-9">
							  {{ Form::text('video_title',null,['class'=>'form-control col-md-7','required'=>'','max'=>'255','min'=>'5']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('video_url',"URL:",['class'=>'control-label col-md-3']) }}
							<div class="col-md-9">
							  {{ Form::url('video_url',null,['class'=>'form-control col-md-7','required'=>'','max'=>'255','min'=>'5']) }}
							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('video_types',"Action:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::select('video_types', [
									   'published' => 'Publish',
									   'unpublished' => 'Unpublish'],null,['class'=>'form-control col-md-7']
									) }}
								</div>
							</div>
						</div>
						
		  			</div>
		  		</div>
		  	</div>
	  	</div>
	  	<div class="ln_solid"></div>
	  	<div class="form-group">
	        <div class="col-md-7 col-md-offset-5">
	          <button type="button" class="btn btn-primary">Cancel</button>
	          <button type="submit" class="btn btn-success">Add</button>
	        </div>
	      </div>
  	</div>
    <!--  -->
  {!! Form::close() !!}
</div>
@stop
@section("js")
{{Html::script($PATH."/assets/jquery.tagsinput/src/jquery.tagsinput.js")}}
<script>
function readURL(input) {

	if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function (e) {
	        $('#thumbnail').attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	}
}

$("#post-thumbnail").change(function(){
	readURL(this);
});
$("#video_url").bind("paste keypress",function(e){
	e.preventDefault();
	var pastedData = e.originalEvent.clipboardData.getData('text');
	$(this).val(pastedData.replace("watch?v=","embed/"))//;
	$("#thumbnail_types").trigger('change');
})
$("#thumbnail_types").change(function(e){
	if($(this).val()=="custom")
	{
		$("#post-thumbnail").css("display","inline");
	}else{
		$("#post-thumbnail").css("display","none");
		var img = "https://i.ytimg.com/vi/"+$("#video_url").val().replace("https://www.youtube.com/embed/","")+"/hqdefault.jpg";
		$("#default_thumbnail").val(img);
		$("#thumbnail").attr("src",img)
	}
});

var currtags=[];
function addTag(self)
{
	
	if(!$("#tags_1").tagExist($(self).attr("data-item"))){
		currtags.push($(self).attr("data-item"))
		$('#tags_1').importTags(currtags.toString());
	}

}

</script>
@stop
