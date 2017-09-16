 @extends("partials.admin.main")
 @section("title","| All Posts")

 @section("content")
<div class="right_col" role="main">
  <div class="x_panel">
  	@include('partials.admin._message')
  </div>
  <div class="">
    <table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
		  <th>Title</th>
		  <th>Tages</th>
		  <th>Type</th>
		  <th>Created at</th>
		  <th>View</th>
		  <th>Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach($posts as $post)
		<tr>
		  <td><a target="_blank" href="{{route('posts.watch',$post->fake_id)}}"> {{$post->title}}</a></td>
		  <td>{{$post->tages}}</td>
		  <td>
			  @if($post->types=="published")
<span class="label label-primary">
			  @elseif($post->types=="drafted")
<span class="label label-warning">
			  @else
<span class="label label-danger">
			  @endif

		  {{$post->types}}
		  </span>
		  </td>
		  <td>{{ date('M j Y H:i',strtotime($post->created_at)) }}</td>
		  <td>{{$post->view_count}}</td>
		  <td>
		  	<a href="{{route('admin.post.edit',$post->fake_id)}}" class="btn btn-warning btn-xs"> <i class="fa fa-pencil"></i> </a>
            <a href="" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> </a>
            <a href="" class="btn btn-success btn-xs"> <i class="fa fa-comments-o"></i> </a>
		  </td>
		</tr>
	@endforeach
	</tbody>
	</table>
  </div>
</div>
@stop

@section('js')

{{Html::script($PATH."/assets/datatables.net/js/jquery.dataTables.min.js")}}
{{Html::script($PATH."/assets/datatables.net-bs/js/dataTables.bootstrap.min.js")}}
@stop