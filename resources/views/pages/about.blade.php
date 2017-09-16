@extends('main')

@section("title","| About")

@section('css')
	<link rel="stylesheet" type="text/css" href="mycss.css">
@endsection

	@section('content')
	      <div class="row">
	        <div class="col-md-12">
	          <h1>About Me</h1>
	          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis aspernatur quas quibusdam veniam sunt animi, est quos optio explicabo deleniti inventore unde minus, tempore enim ratione praesentium, cumque, dolores nesciunt?</p>
	        </div>
	      </div>
	@endsection

@section('js')
	<script type="text/javascript">
	console.log("About Page!!!!!");
	</script>
@endsection