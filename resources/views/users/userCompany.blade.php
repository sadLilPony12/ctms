@extends('layouts.app')

@section('content')
<input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
<input type="hidden" id="role" value="{{Auth::user()->role_id}}">
<input type="hidden"  id="company-id" value="{{Auth::user()->item->has_company}}">
<input type="hidden"  id="id"value="{{Auth::user()->item->id}}">
 <!-- Start Email Statistic area-->
<div class="notika-email-post-area">
    <div class="container"> 
        <form id="Model" class="form-horizontal">
            <div class="row" id="userCompany">  
                  
                <!-- <div style="height:600px;" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="email-statis-inner notika-shadow">
                        <div class="email-ctn-round">
                            <div class="email-rdn-hd">
                                <h1>Company name</h1>
                            </div>
                            <div class="email-statis-wrap">
                                <img src="{{ asset('images/company.jpg') }}" height="50%"/>
                            </div>
                            <div class="email-rdn-hd">
                                <h1 style="font-size: 20px;"> Subname</h1>
                            </div>
                            <div class="past-statistic-an">
                                <div class="past-statistic-ctn">
                                    <p style="font-size: 15px;">Dimatibagbatumbakal</p>
                                </div>
                                <div class="past-statistic-graph">
                                    <p style="font-size: 15px;">caalibangbangan</p>
                                </div>
                            </div>
                            <div class="past-statistic-an">
                                <div class="past-statistic-ctn">
                                    <p style="font-size: 15px;">ligtas magsasakan</p>
                                </div>
                                <div class="past-statistic-graph">
                                    <p style="font-size: 15px;">22nug2nug</p>
                                </div>
                            </div>
                            <div class="email-rdn-hd">
                                <button class="btn btn-info"><span class="fa fa-hand-o-right"></span>&nbsp; Pick</button>
                            </div>
                        </div>
                    </div>
                </div>    -->

            </div>
        </form>
    </div>
</div>

                                <!-- End Email Statistic area-->
                                <!-- <div class="breadcomb-area"> -->
   
@endsection

@section('javascript')
<script> 
    document.getElementById('menu-charts').setAttribute("class", "active");
</script>
    <script type="module" src="{{ asset('js/actor/userItem/index.js') }}"></script>

@endsection 