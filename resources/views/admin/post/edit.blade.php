 @extends("partials.admin.main")
 @section("title","| Edit")

 @section("content")
<div class="right_col" role="main">
  <div class="x_panel">
  	@include('partials.admin._message')
  </div>

  {!! Form::open(['route'=>['admin.post.update',$post->fake_id],'method'=>"PUT",'files'=>'true','class'=>'form-horizontal']) !!}
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
							  {{ Form::text('post_title',$post->title,['class'=>'form-control col-md-7','required'=>'','min'=>'5','max'=>'255']) }}
							</div>
						</div>
						<div class="form-group">
                          	{{ Form::label('description',"Description:",['class'=>'control-label col-md-3']) }}
                          	<div class="col-md-9">
                          		{{ Form::textarea('description',$post->description,['class'=>'form-control']) }}
                          	</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('highlight',"Highlight:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::url('highlight',$post->highlight,['class'=>'form-control col-md-7']) }}
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('post_thumbnail',"Thumbnail:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								@if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL))
									{{ Form::select('thumbnail_types', [
									   'default' => 'Default YT Thumbnail',
									   'custom' => 'Custom Thumbnail',
									   ],'default',['class'=>'form-control col-md-7','id'=>'thumbnail_types']
									) }}
								@else
									{{ Form::select('thumbnail_types', [
									   'default' => 'Default YT Thumbnail',
									   'custom' => 'Custom Thumbnail',
									   ],'custom',['class'=>'form-control col-md-7','id'=>'thumbnail_types']
									) }}
								@endif
								  
								  {{ Form::file('post_thumbnail',['class'=>'form-control col-md-7','id'=>'post-thumbnail','style'=>'display:none','accept'=>'image/x-png,image/gif,image/jpeg']) }}
								  @if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL))
								  	<img src="{{$post->thumbnail}}" alt="" width="196px" height="110px" id="thumbnail">
								  	{{ Form::hidden('default_thumbnail',$post->thumbnail,['id'=>'default_thumbnail']) }}
								  @else
								  	<img src="{{$PATH}}/uploads/{{$post->thumbnail}}" alt="" width="196px" height="110px" id="thumbnail">
								  	{{ Form::hidden('default_thumbnail',$PATH."/uploads/".$post->thumbnail,['id'=>'default_thumbnail']) }}
								  @endif
								  
								</div>

							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('tags_1',"Input Tags:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::text('tags_1',$post->tages,['class'=>'form-control col-md-7','required'=>'']) }}
								  
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
									   'drafted' => 'Draft'],$post->types,['class'=>'form-control col-md-7']
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
							  {{ Form::text('video_title',$post->videos[0]->title,['class'=>'form-control col-md-7','required'=>'','max'=>'255','min'=>'5']) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('video_url',"URL:",['class'=>'control-label col-md-3']) }}
							<div class="col-md-9">
							  {{ Form::url('video_url',$post->videos[0]->url,['class'=>'form-control col-md-7','required'=>'','max'=>'255','min'=>'5']) }}
							</div>
						</div>
						<div class="form-group">
							<div class="control-group">
								{{ Form::label('video_types',"Action:",['class'=>'control-label col-md-3']) }}
								<div class="col-md-9 col-sm-9">
								  {{ Form::select('video_types', [
									   'published' => 'Publish',
									   'unpublished' => 'Unpublish'],$post->videos[0]->types,['class'=>'form-control col-md-7']
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
	          <button type="submit" class="btn btn-success">Update</button>
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
	if(input.files[0].size/1024 > 300){
		alert("exceed max size file");
		return
	}
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
