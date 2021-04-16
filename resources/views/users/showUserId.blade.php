<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    $urlName = substr($url, strpos($url, "/user/") + 6);    

    ($urlName == "br" ? $codeName = "Bar code" : $codeName = "Quick response code");
?>

@extends('layouts.app')

@section('content')

  <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="address" value="{{ Auth::user()->address }}">
                    <input type="hidden" id="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="code" value="{{ Auth::user()->citizen_code }}">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-form"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2><?php echo $codeName; ?></h2>
                                        <p>Please note that this can only be downloaded once.</span></p>
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                    <div class="breadcomb-report">
                                        <?php if($urlName == "br"){ ?>
                                            <button data-toggle="modal" id="btn-Download-br" data-toggle="tooltip" data-placement="left" title="Download card" class="btn"><i class="notika-icon notika-sent"></i></button>
                                        <?php }else{ ?>
                                            <button data-toggle="modal" id="btn-Download-qr" data-toggle="tooltip" data-placement="left" title="Download card" class="btn"><i class="notika-icon notika-sent"></i></button>
                                        <?php } ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
  
  <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <p style="margin-left: 5%; text-indent: 50px;">This <?php echo $codeName; ?> contains information used for contact tracing. Please take care of this valuable information in order to preserve your own privacy.</p>
                            <center  >
                                <?php if($urlName == "br"){ ?>
                                    <div id="br" >
                                        <canvas id="Bar-code" class="center"></canvas>
                                        <img src="" id="imgConverted">
                                        <p id="qr-result" style="text-align:center; display:none;"></p>
                                    </div>
                                    <!-- <img id="br" width="150%" height="150%" src=" asset('img/barCodeSample.png') }}" /> -->
                                <?php }else{ ?>
                                    <div id="qr" >
                                            <canvas id="QRcode" class="center"></canvas>
                                            <img src="" id="imgConverted">
                                            <p id="qr-result" style="text-align:center;"></p>
                                    </div>
                                    <!-- <img id="qr" width="20%" height="20%" src=" asset('img/qrSample.png') }}" /> -->
                                <?php } ?>
                            </center>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script> 
        document.getElementById('menu-id').setAttribute("class", "active");
        document.getElementById('ids').setAttribute("class", "tab-pane notika-tab-menu-bg animated flipInX active");
     </script>
     <script type="module" src="{{ asset('js/generate/index.js') }}"></script>
    <script src="{{ asset('js/qrcode.js') }}"></script>
    <script src="{{ asset('js/barcode.js') }}"></script>
@endsection 