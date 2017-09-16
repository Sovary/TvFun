<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Movies @yield("title") </title>
    
    @include("partials.user._css")
  </head>

  <body class="nav-md">
  	<div class="container body">
      <div class="main_container">
      	@include("partials.user._navtop")
        @yield("body")
        @include("partials.user._footer")
      </div>
    </div>

  </body>
  @include("partials.user._script")
</html>