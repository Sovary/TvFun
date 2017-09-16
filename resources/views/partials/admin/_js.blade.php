<!-- jQuery -->
    {{ Html::script($PATH.'/assets/jquery/dist/jquery.min.js')}}
    <!-- Bootstrap -->
    {{ Html::script($PATH.'/assets/bootstrap/dist/js/bootstrap.min.js')}}
    <!-- FastClick -->
    <script type="text/javascript" charset="utf-8" async defer>
      $('#nightBtn').click(function(d) {
        d.preventDefault();
        var css = 'html,img,video{-webkit-filter:invert(1)hue-rotate(180deg);filter:invert(1)hue-rotate(180deg)}body{background:#000}',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');
        style.type = 'text/css';
        if (style.styleSheet){
        style.styleSheet.cssText = css;
        } else {
        style.appendChild(document.createTextNode(css));
        }
        head.appendChild(style);
      });
    </script>
    {{ Html::script($PATH.'/assets/fastclick/lib/fastclick.js')}}
    <!-- NProgress -->
    {{ Html::script($PATH.'/assets/nprogress/nprogress.js')}}
    <!-- gauge.js -->
    {{ Html::script($PATH.'/assets/gauge.js/dist/gauge.min.js')}}
    <!-- bootstrap-progressbar -->
    {{ Html::script($PATH.'/assets/bootstrap-progressbar/bootstrap-progressbar.min.js')}}
    <!-- iCheck -->
    {{ Html::script($PATH.'/assets/iCheck/icheck.min.js')}}
    <!-- Skycons -->
    {{ Html::script($PATH.'/assets/skycons/skycons.js')}}
    {{ Html::script($PATH.'/assets/custom.js')}}
@yield("js")