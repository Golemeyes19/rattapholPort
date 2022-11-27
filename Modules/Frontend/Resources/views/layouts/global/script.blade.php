
<!--Plugins-->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<!--Template functions-->
<script src="{{ asset('assets/js/functions.js') }}"></script>



<script>
   $(' #mainMenu nav > ul > li').click(function(){
    $(' #mainMenu nav > ul > li.active').removeClass('active');
    $(this).addClass('active');
  });

</script>   

@yield('script')
