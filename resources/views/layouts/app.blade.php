<?php  
session_start();

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

$urlName = substr($url, strpos($url, "/user") + 1);

$pass=(session('pw'));
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <title>Citizen homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.transitions.css') }}">
  <!-- meanmenu CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/meanmenu/meanmenu.min.css') }}">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <!-- notification CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('css/notification/notification.css') }}">
  <!-- notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/icon.css') }}">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/wave/waves.min.css') }}">
  <!-- cropper CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/cropper/cropper.min.css') }}">
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
  <style>
      #articleMessage{
        text-indent: 10%; 
        text-align: justify; 
        margin-bottom: 5%; 
        height: 250px; 
        overflow: hidden;
      }

      #articleMessage:hover{
        overflow-y:scroll;
      }
  </style>
<body>
    @if(Auth::user()->is_admin)
        <script>window.location = "{{ route('admin.article') }}";</script>
        <?php exit; ?>
    @endif
    <input type="hidden" id="session" value= {{$pass}} >

     <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo-area">
                        <a href="{{ route('user.article') }}"><img width="100px" height="34px" src="{{ asset('img/ctms.png') }}"/></a>
                    </div>  
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                        <?php if($urlName == "user/company"){ ?>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i id="sa-title" class="notika-icon notika-left-arrow" ></i>                                        
                                        <input placeholder="Search companies" type="text" id="key"/>                            
                                    </div>                                    
                                </div>
                            </li>
                        <?php } ?>     
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="fa fa-cog"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                    <div class="hd-message-info">
                                        <input type="hidden" id="uid" value="{{ auth::user()->id }}">
                                        <a id="profile">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <i class="notika-icon notika-support"></i>
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3 style="text-transform: capitalize;">{{ Auth::user()->name }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a id="change">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <i class="notika-icon notika-refresh"></i>
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Change password</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>  
                            <li class="nav-item">
                                <a id="logout" onclick="swal()" href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="Logout">
                                    <span>
                                        <i class="notika-icon notika-close"></i>
                                    </span>
                                </a>    

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <?php if($urlName == "user/article"){ ?>
                                    <li><a href="#">Home</a></li>
                                <?php }else{ ?>
                                    <li><a href="{{ route('user.article') }}">Home</a></li>
                                <?php } ?>       
                                <?php if($urlName != "user/item"){ ?>
                                        @if(Auth::user()->address)
                                            <li><a href="{{ route('user.company') }}">Companies</a></li> 
                                            <li><a data-toggle="collapse" data-target="#idCard" href="#">ID</a>
                                                <ul id="idCard" class="collapse dropdown-header-top">
                                                    <li><a href="{{ route('show.Uqr') }}">Qr code</a></li>
                                                    <li><a href="{{ route('show.Ubr') }}" id="generateBarcode">Bar code</a></li>
                                                </ul>
                                            </li>     
                                        @else
                                            <li id="sweetalert" onclick="change()"><a href="#">Companies</a></li> 
                                        @endif
                                <?php } ?>                                
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->

    @include('profiles.update')
    @include('profiles.cpassword')

    <!-- Main Menu area start-->
        <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <?php if($urlName == "user/article"){ ?>
                        <li id="menu-home" class="menu-list"><a href="#"><i class="notika-icon notika-house"></i>
                                Home</a>
                        </li>
                    <?php }else{ ?>
                        <li id="menu-home" class="menu-list"><a href="{{ route('user.article') }}"><i class="notika-icon notika-house"></i>
                                Home</a>
                        </li>
                    <?php } ?>                        
                        <?php if($urlName != "user/item"){ ?>
                        @if(Auth::user()->address)
                        <li id="menu-charts" class="menu-list"><a href="{{ route('user.company') }}"><i class="notika-icon notika-windows"></i>
                                Companies</a>
                        </li>                  
                       <li id="menu-id" class="menu-list"><a data-toggle="tab" href="#ids"><i class="notika-icon notika-edit"></i> ID</a></li>
                       @else
                       <li id="sweetalert" onclick="change()" class="menu-list"><a href="#"><i class="notika-icon notika-windows"></i>Companies</a></li>
                       <li id="sweetalert" onclick="change()" class="menu-list"><a href="#"><i class="notika-icon notika-edit"></i>ID</a></li>
                       @endif   
                        <?php } ?>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="ids" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">  
                                <li><a href="{{ route('show.Uqr') }}" >QR code</a></li>
                                <li><a href="{{ route('show.Ubr') }}" id="generateBarcode"  >Bar code</a></li>                               
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('company.companyIndex')
    <main style="margin-bottom: 10%;">
        @yield('javascript')
        @yield('content')
    </main>
    <!-- Breadcomb area End-->    
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2020 . All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
<script>
    function change() {
        Swal.fire({
            title: 'Note',
            text: "Insufficient data about you. Please fill up the form",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Fill up form',
        }).then((result) => {
            if (result.value) {
                location.replace('/user/item')
            }
        })
        // 
    }
        
</script>
  <script type="module" src="{{ asset('js/company/user.js') }}"></script>

    <!-- jquery
		============================================ -->
  <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <!-- fetch JS
		============================================ -->
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script type="module" src="{{ asset('js/actor/user/update.js') }}"></script>
  <!-- wow JS
		============================================ -->
  <script src="{{ asset('js/wow.min.js') }}"></script>
  
<!-- price-slider JS
		============================================ -->
  <script src="{{ asset('js/jquery-price-slider.js') }}"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>  
  <!-- counterup JS
		============================================ -->
  <script src="{{ asset('js/counterup/jquery.counterup.min.js') }}"></script>
  <script src="{{ asset('js/counterup/waypoints.min.js') }}"></script>
  <script src="{{ asset('js/counterup/counterup-active.js') }}"></script>  
  <!--  notification JS
		============================================ -->
    <script src="{{ asset('js/notification/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('js/notification/notification-active.js') }}"></script>
  <!-- flot JS
		============================================ -->
  <script src="{{ asset('js/flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('js/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('js/flot/flot-active.js') }}"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="{{ asset('js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/sparkline/sparkline-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('js/knob/knob-active.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('js/wave/wave-active.js') }}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{asset('js/todo/jquery.todo.js') }}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset('js/jquery.scrollUp.min.js') }}"></script>
    <!-- mCustomScrollbar JS
            ============================================ -->
    <script src="{{asset('js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <script>
        function swal(){
            Swal.fire({
            title: 'You\'re about to be logged out.',
            text: "Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
            }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Logged out!',
                'We hope to see you again soon.',
                'success'
                )
                document.getElementById("logout-form").submit();
            }
            })
        }
        // setTimeout(() => {
        //     delayTodo();
        //     delayTodo1();
        //     delayTodo2();
        // }, -1500);
        

        // setTimeout(delayTodo2, -2000);

        function delayTodo(){
            var head_ID = document.getElementsByTagName("head")[0];
            var script_element = document.createElement('script');
            script_element.type = 'text/javascript';
            script_element.src = '../js/todo/jquery.todo.js';
            head_ID.appendChild(script_element);
        }
         function delayTodo1(){
            var head_ID = document.getElementsByTagName("head")[0];
            var script_element = document.createElement('script');
            script_element.type = 'text/javascript';
             script_element.src = '../js/jquery.scrollUp.min.js';
            head_ID.appendChild(script_element);
        }
         function delayTodo2(){
            var head_ID = document.getElementsByTagName("head")[0];
            var script_element = document.createElement('script');
            script_element.type = 'text/javascript';
              script_element.src = '../js/scrollbar/jquery.mCustomScrollbar.concat.min.js' ;
            head_ID.appendChild(script_element);
        }
    </script>

    <!-- cropper JS
		============================================ -->
    <script src="{{ asset('js/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('js/cropper/cropper-actice.js') }}"></script>
  <!-- Input Mask JS
		============================================ -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
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
