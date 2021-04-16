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
  <!-- Login Register area Start-->  
  <div class="login-content"> 
  <h1 style="margin-top: -45%;">Contact Tracing Management System</h1>
    <!-- Register -->
    <div class="nk-block toggled" id="l-register">
    <div id="showError" style="display:none;" class="alert alert-danger alert-mg-b-0" role="alert">
        Password and Confirm password does not match.
    </div>
      <div class="nk-form">
        <form id="registerForm" method="POST" action="{{ route('user.register') }}">
        <input id="ppicture"  type="hidden" value="icon.jpg" name="ppicture">
            @csrf
          <h2>Register</h2>
        <!-- Wizard area Start-->
    <div class="wizard-wrap-int">
        <div id="rootwizard">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-pro wizard-cts-st">
                        <ul>
                            <li><a style="pointer-events: none;" href="#tab1" data-toggle="tab">First</a></li>
                            <li><a style="pointer-events: none;" href="#tab2" data-toggle="tab">Second</a></li>
                            <li><a style="pointer-events: none;" href="#tab3" data-toggle="tab">Third</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane wizard-ctn" id="tab1">
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input onchange="allowNext(1)" id="name" type="text" class="form-control" placeholder="Screen name" name="name"
                                required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                        <div class="nk-int-st">
                            <input onchange="allowNext(1)" id="email" type="email" class="form-control" placeholder="Email-address" name="email"
                                required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                        <div class="nk-int-st">
                            <input onkeyup="allowNext(1)" id="password" type="password" class="form-control" placeholder="Password"
                                name="password" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                        <div class="nk-int-st">
                            <input onkeyup="allowNext(1)" id="confPass" type="password" class="form-control" placeholder="Confirm password"
                                name="confPass" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-phone"></i></span>
                        <div class="nk-int-st">
                            <input id="phone" data-mask="(999) 999-9999" type="text" class="form-control"
                                placeholder="Phone" name="phone" autofocus>
                        </div>
                    </div>
                </div>
                <div class="tab-pane wizard-ctn" id="tab2">
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input onchange="allowNext(2)" id="fname" type="text" class="form-control" placeholder="First name" name="fname"
                                required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input id="mname" type="text" class="form-control" placeholder="Middle name" name="mname"
                                autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input onchange="allowNext(2)" id="lname" type="text" class="form-control" placeholder="Last name" name="lname"
                                required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-calendar"></i></span>
                        <div class="nk-int-st">
                            <input onchange="allowNext(2)" id="dob" type="text" onfocus="(this.type='date')" class="form-control"
                                placeholder="Date of birth" name="dob" required autofocus>
                        </div>
                    </div>  

                    <!-- suffix -->
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <div class="nk-int-mk sl-dp-mn">
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select name="suffix" id="suffix" class="selectpicker">
                                    <option disabled selected>Suffix</option>
                                    <option value="SR">SR</option>
                                    <option value="JR">JR</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                    </div>                                      

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <div class="nk-int-mk sl-dp-mn">
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select name="gender" id="gender" class="selectpicker">
                                    <option disabled selected>Gender</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="tab-pane wizard-ctn" id="tab3">
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addR" type="text" class="form-control" placeholder="Address - Region"
                                name="addR" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addP" type="text" class="form-control" placeholder="Address - Province"
                                name="addP" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addC" type="text" class="form-control" placeholder="Address - City"
                                name="addC" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addB" type="text" class="form-control" placeholder="Address - Baranggay"
                                name="addB" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addPr" type="text" class="form-control" placeholder="Address - Purok"
                                name="addPr" required autofocus>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i
                                class="notika-icon notika-ip-locator"></i></span>
                        <div class="nk-int-st">
                            <input id="addH" type="text" class="form-control" placeholder="Address - House number"
                                name="addH" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="wizard-action-pro">
                    <ul class="wizard-nav-ac">
                        <li>
                            <!-- <a onClick="checkLastButton(0)" class="button-previous a-prevent" href="#"><i class="notika-icon notika-back"></i></a> -->
                            <button id="btnPrev" onclick="removeValue()" disabled class="btn btn-success notika-btn-success button-previous"><i class="notika-icon notika-back"></i></button>
                        </li>
                        <li>
                            <!-- <a id="nextBtn" onClick="checkLastButton(1)" class="button-next a-prevent" href="#"><i class="notika-icon notika-next-pro"></i></a> -->
                            <button id="btnNext" disabled class="btn btn-success notika-btn-success button-next"><i class="notika-icon notika-next-pro"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Wizard area End--> 
        
        <button disabled id="buttonSubmit" type="submit" class="btn btn-login btn-success btn-float"><i id="submitButton" class="notika-icon notika-close right-arrow-ant"></i></button>
        </form>
      </div>

      <div class="nk-navigation rg-ic-stl">
        <a href="{{ route('login') }}" data-ma-block="#l-login"><i
            class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
        <a href="{{ route('fpassword') }}" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot
            Password</span></a>
      </div>
    </div>
  </div>
  <!-- Login Register area End-->
  <!-- Register submit button -->
    <script>
        function removeValue(){
            var pass1 = document.getElementById('password').value;
            var pass2 = document.getElementById('confPass').value;

            var checkPass = [pass1, pass2];
            for (var i = 0; i < checkPass.length; i++) {
                if(checkPass[i] != ""){
                    document.getElementById('password').value = "";
                    document.getElementById('confPass').value = "";
                }
            }
        }

        function allowNext(x){
            if(x == 1){
                var count = 0;

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var password2 = document.getElementById('confPass').value;

                if(password != password2){
                    document.getElementById('showError').style.display = "block";
                }else{
                    document.getElementById('showError').style.display = "none";

                    var validateTab1 = [name, email, password, password2];
                    for (var i = 0; i < validateTab1.length; i++) {
                        if(validateTab1[i] != ""){
                            count++;
                        }
                    }

                    if(count == 4){
                        document.getElementById('btnNext').disabled = false;
                        document.getElementById("btnNext").onclick = function() {btnController(1)};                    
                    }
                }                 
            }else if(x == 2){
                var count = 0;

                var fname = document.getElementById('fname').value;
                var lname = document.getElementById('lname').value;
                var dob = document.getElementById('dob').value;

                var validateTab2 = [fname, lname, dob];
                for (var i = 0; i < validateTab2.length; i++) {
                    if(validateTab2[i] != ""){
                        count++;
                    }
                }

                if(count == 3){
                    document.getElementById('btnNext').disabled = false;        
                    document.getElementById("btnNext").onclick = function() {btnController(2)};         
                }
            }
        }
        
        function btnController(x){
            if(x == 1){
                document.getElementById('btnPrev').disabled = false;
                document.getElementById('btnNext').disabled = true;
            }else if(x == 2){
                document.getElementById('buttonSubmit').disabled = false;
                document.getElementById("submitButton").classList.remove("notika-close");
                document.getElementById("submitButton").classList.add("notika-right-arrow");
            }
        }
    </script>
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