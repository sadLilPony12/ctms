@extends('layouts.app')

@section('content') 
  <div class="typography-area">
        <div class="container">
           <input type="hidden" id="role" value="{{ Auth::user()->role_id }}">
           <input type="hidden" id="id" value="{{ Auth::user()->id }}">
          <center>
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="typography-list typography-mgn">                        
                          <img id="company-logo" width="400px" height="400px">
                          <h1 id="companyname"></h1>
                          <h3 id="subnames"></h3>
                          <div class="typography-bd">                            
                              <h2>Location : <span id="address"></span></h2>
                              <h2>Contact number : <span id="phoneNum"></span></h2>
                          </div>
                      </div>
                  </div>
              </div>
            </center>
        </div>
    </div>
@endsection 

@section('javascript')
<script>
    document.getElementById('menu-charts').setAttribute("class", "active");
</script>
  <script type="module" src="{{ asset('js/company/index.js') }}"></script>
@endsection 
