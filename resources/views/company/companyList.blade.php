@extends('layouts.admin')

@section('content')
  <div class="container col-md-12">
    <div class="card">
      <div class="card-header with-border">
        <a href="javascript:void(0)" class="btn btn-success mb-2text-right" style="position:absolute;" id="btn-new"><span class="fa fa-plus"></span></a>
        <h2 class="card-title text-center">Select your Company</h2>
      </div> 
    <div class="card-body">
      <form id="set-Model" class="form-horizontal">
      <input type="hidden" id="user-id"value="{{Auth::user()->id}}">
      <div class="row" id="companies"></div>
      </form>
    </div>  
      @include('company/modal')
  </div>
@endsection 

@section('javascript')
  <script type="text/javascript">
    var token  = "{{Session::token()}}";
    var upload_url = "{{ route('company.imageTransfer') }}";
  </script>
  <script type="module" src="{{ asset('js/company/user.js') }}"></script>
@endsection 
