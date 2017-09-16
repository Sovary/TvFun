<!DOCTYPE html>
<html lang="en">
  @include("partials.admin._head")

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include("partials.admin._navtop")
        
        <!-- page content -->
        @yield("content")
       
        <!-- /page content -->
      </div>
    </div>

    
  </body>
  @include("partials.admin._js")
</html>