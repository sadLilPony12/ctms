<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CTMS</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- font awesome CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <!-- bootstrap select CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select/bootstrap-select.css') }}">
  <!-- Notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/icon.css') }}">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <!-- modernizr JS
		============================================ -->
  <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

  @if(isset(Auth::user()->is_admin))
  @if(!Auth::user()->is_admin)
  <script>
    window.location = "{{ route('user.article') }}";
  </script>
  <?php exit; ?>
  @else
  <script>
    window.location = "{{ route('admin.article') }}";
  </script>
  <?php exit; ?>
  @endif
  @endif

  <!-- Login Register area Start-->
  <div class="login-content">
    <!-- Login -->
    <h1 style="position:absolute; top: 25%; margin:auto; left: 0; bottom: 0; right: 0;">Contact Tracing Management System</h1>
    <div class="nk-block toggled" id="l-login">
      @if(!$errors->isEmpty())
      @foreach($errors->all() as $err)
      <div class="alert alert-danger alert-mg-b-0" role="alert">
        {{ $err }}
      </div>
      @endforeach
      @endif
      <div class="nk-form">
        <form id="loginForm" method="POST" action="{{ route('login') }}">
          @csrf
          <h2>Login</h2>
          <div class="input-group">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
            <div class="nk-int-st">
              <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control" placeholder="Username">
            </div>
          </div>
          <div class="input-group mg-t-15">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
            <div class="nk-int-st">
              <input id="password" type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
            </div>
          </div>
          <button type="submit" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
        </form>
      </div>

      <div class="nk-navigation nk-lg-ic">
        <a href="{{ route('register') }}" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
        <a href="{{ route('fpassword') }}" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot
            Password</span></a>
      </div>
    </div>
    <!-- Login Register area End-->
    <!-- jquery
		============================================ -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ asset('js/jquery-price-slider.js') }}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ asset('js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/counterup/counterup-active.js') }}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{ asset('js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/sparkline/sparkline-active.js') }}"></script>
    <!-- flot JS
		============================================ -->
    <script src="{{ asset('js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/flot/flot-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('js/knob/knob-active.js') }}"></script>
    <!-- Input Mask JS
		============================================ -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <!-- bootstrap select JS
		============================================ -->
    <script src="{{ asset('js/bootstrap-select/bootstrap-select.js') }}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ asset('js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="{{ asset('js/icheck/check.min.js') }}"></script>
    <script src="{{ asset('js/icheck/check-active.js') }}"></script>
    <!--  wizard JS
		============================================ -->
    <script src="{{ asset('js/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('js/wizard/wizard-active.js') }}"></script>
    <!-- Login JS
		============================================ -->
    <script src="{{ asset('js/login/login.js') }}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>