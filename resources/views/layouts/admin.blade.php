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
    $urlNameList = substr($url, -4);

    $pass=(session('pw'));
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <title>Admin homepage</title>
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
  <!-- font awesome CSS
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
  <!-- cropper CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/cropper/cropper.min.css') }}">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <!-- jvectormap CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/jvectormap/jquery-jvectormap-2.0.3.css') }}">
  <!-- notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/icon.css') }}">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="{{ asset('css/wave/waves.min.css') }}">
  <!-- notification CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('css/notification/notification.css') }}">
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
</head>
<body>

    @if(!Auth::user()->is_admin)
        <script>window.location = "{{ route('user.article') }}";</script>
        <?php exit; ?>
    @endif
    <input type="hidden" id="session" value= {{$pass}} >
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo-area">
                        <?php if(substr($urlName, -8) == "viewLogs"){ ?>                               
                            <div class="notification-demo">                         
                                <img onclick="alert('Cannot return to homepage, please Logout.')" width="100px" height="34px" src="{{ asset('img/ctms.png') }}"/>
                            </div>
                        <?php }else{ ?>
                            <a href="{{ route('admin.article') }}"><img width="100px" height="34px" src="{{ asset('img/ctms.png') }}"/></a>
                        <?php } ?>
                    </div>  
                </div>
                <div class="col-md-8">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                        <?php if(substr($urlName, -8) != "viewLogs"){ ?>
                            <?php if($urlNameList == "list"){ ?>
                                <li class="nav-item dropdown">
                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                                        class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                    <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                        <div class="search-input">
                                            <input placeholder="Search for user list" type="text" id="key" autofocus/>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a href="{{ route('tapID') }}">
                                    <span>
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </a>
                            </li>
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
                        <?php } ?>                      
                            <li class="nav-item">
                                <a id="logout" onclick="sswal()" href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-content="Logout">
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
                                <?php if(substr($urlName, -7) == "article"){ ?>
                                    <li><a href="#">Home</a></li>
                                <?php }else{ ?>
                                    <li><a href="{{ route('admin.article') }}">Home</a></li>
                                <?php } ?>     
                                    <li><a data-toggle="collapse" data-target="#userList" href="#">User list</a>
                                        <ul id="userList" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('admin.lists') }}">Admin</a></li>
                                            <li><a href="{{ route('user.list') }}" id="generateBarcode">User</a></li>
                                        </ul>
                                    </li>   
                                <?php if($urlName != "user-item"){ ?>
                                        @if(Auth::user()->address)
                                            <li><a href="{{ route('admin.company') }}">Companies</a></li> 
                                            <li><a data-toggle="collapse" data-target="#idCard" href="#">ID</a>
                                                <ul id="idCard" class="collapse dropdown-header-top">
                                                    <li><a href="{{ route('show.qr') }}">Qr code</a></li>
                                                    <li><a href="{{ route('show.br') }}" id="generateBarcode">Bar code</a></li>
                                                </ul>
                                            </li>     
                                        @else
                                            <li id="sweetalert" onclick="change()"><a href="#">Companies</a></li> 
                                            <li id="sweetalert" onclick="change()"><a href="#">ID</a></li> 
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
    <?php if(substr($urlName, -8) != "viewLogs"){ ?>
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <?php if(substr($urlName, -7) == "article"){ ?>
                        <li id="menu-home" class="menu-list"><a href="#"><i class="notika-icon notika-house"></i>
                                Home</a>
                        </li>
                    <?php }else{ ?>
                        <li id="menu-home" class="menu-list"><a href="{{ route('admin.article') }}"><i class="notika-icon notika-house"></i>
                                Home</a>
                        </li>
                    <?php } ?> 
                        <li id="menu-list" class="menu-list"><a data-toggle="tab" href="#lists"><i class="notika-icon notika-menus"></i> User list</a>
                        </li>                        
                        <?php if($urlName != "user-item"){ ?>
                        @if(Auth::user()->address)                                             
                       <li id="menu-id" class="menu-list"><a data-toggle="tab" href="#ids"><i class="notika-icon notika-edit"></i> ID</a></li>
                        <li id="menu-charts" class="menu-list"><a href="{{ route('admin.company') }}"><i class="notika-icon notika-windows"></i>
                            Companies</a>
                        </li>   
                        @else
                        <li id="sweetalert" onclick="change()" class="menu-list"><a href="#"><i class="notika-icon notika-windows"></i>Companies</a></li>
                       <li id="sweetalert" onclick="change()" class="menu-list"><a href="#"><i class="notika-icon notika-edit"></i>ID</a></li>
                       @endif   
                        <?php } ?>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="lists" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.lists') }}" id="admin-list">Admin</a></li>
                                <li><a href="{{ route('user.list') }}">User</a></li>                                
                            </ul>
                        </div> 
                        <div id="ids" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">  
                                <li><a href="{{ route('show.qr') }}" >QR code</a></li>
                                <li><a href="{{ route('show.br') }}" id="generateBarcode"  >Bar code</a></li>                               
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Main Menu area End-->
        <main style="margin-bottom: 5%;">
            @yield('javascript')
            @yield('content')                            
        </main>
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2020. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    



    

    <!-- End Footer area-->

    <script>
        function sswal(){
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

        function change() {   
            jQuery('.mean-nav ul:first').slideUp();
            $('.meanmenu-reveal').html('<span></span><span></span><span></span>');
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
                    location.replace('/user-item')
                }
            })
            // 
        }

        function validateStart() {
            var endDate = document.getElementById('end_at').value;
            if(endDate != ""){
                document.getElementById('end_at').value = null;
            }
            var startDate = document.getElementById('start_at').value;
            
            startDate = new Date(startDate);
            var today = new Date();

            var startDay = startDate.getDate();
            var startMonth =startDate.getMonth(); 
            var startYear = startDate.getFullYear();   
            
            var dayToday = today.getDate();
            var monthToday = today.getMonth();
            var yearToday = today.getFullYear();
            
            if(startYear <= yearToday){
                if(startMonth <= monthToday){
                    if(startDay < dayToday){
                        alert('Date has already passed.');
                        document.getElementById('start_at').value = null;
                    }
                }
            }
        }

        function validateEnd() {
            var startDate = document.getElementById('start_at').value;            

            if(startDate != ""){  
                var endDate = document.getElementById('end_at').value;

                startDate = new Date(startDate);  
                endDate = new Date(endDate);

                var endDay = endDate.getDate();
                var endMonth =endDate.getMonth(); 
                var endYear = endDate.getFullYear();   
                
                var startDay = startDate.getDate();
                var startMonth = startDate.getMonth();
                var startYear = startDate.getFullYear();
                
                if(endYear <= startYear){
                    if(endMonth <= startMonth){
                        if(endDay <= startDay){
                            alert('Must have a 24 hour interval from starting date.');
                            document.getElementById('end_at').value = null;
                        }
                    }
                }
            }else{
                alert('Please enter a starting date first.');
                document.getElementById('end_at').value = null;
            }
        }


    </script>
    <script type="module" src="{{ asset('js/generate/index.js') }}"></script>
    <!-- jquery
		============================================ -->
  <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  
  <!-- fetch JS
		============================================ -->
    <script type="module" src="{{ asset('js/actor/user/update.js') }}"></script>
  <!-- Sweet alert
		============================================ -->
    <script src="{{ asset('js/sweetalert.js') }}"></script>
  <!-- wow JS
		============================================ -->
  <script src="{{ asset('js/wow.min.js') }}"></script>
  
<!-- price-slider JS
		============================================ -->
  <script src="{{ asset('js/jquery-price-slider.js') }}"></script>
        <!-- meanmenu JS
		============================================ -->
    <script src="{{ asset('js/meanmenu/jquery.meanmenu.js') }}"></script>
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
  <!-- Input Mask JS
		============================================ -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <!-- Data Table JS
		============================================ -->
    <script src="{{ asset('js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/data-table/data-table-act.js') }}"></script>
    <!--  notification JS
		============================================ -->
    <script src="{{ asset('js/notification/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('js/notification/notification-active.js') }}"></script>
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
  <!-- autosize JS
		============================================ -->
    <script src="{{ asset('js/autosize.min.js') }}"></script>
    <!-- cropper JS
		============================================ -->
    <script src="{{ asset('js/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('js/cropper/cropper-actice.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('js/wave/wave-active.js') }}"></script>
    <!--  animation JS
		============================================ -->
    <script src="{{ asset('js/animation/animation-active.js') }}"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="{{ asset('js/meanmenu/jquery.meanmenu.js') }}"></script>
  <!--  wizard JS
		============================================ -->
    <script src="{{ asset('js/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('js/wizard/wizard-active.js') }}"></script>
  <!-- Login JS
		============================================ -->
  <script src="{{ asset('js/login/login.js') }}"></script>
  <!-- Input Mask JS
		============================================ -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
  <!-- plugins JS
		============================================ -->
  <script src="{{ asset('js/plugins.js') }}"></script>
  <!-- main JS
		============================================ -->
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
