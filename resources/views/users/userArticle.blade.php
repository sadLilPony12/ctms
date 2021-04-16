@extends('layouts.app')

@section('content')
<div>
    <div id="table-user"></div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif            
</div>

    <input type="hidden" id="role" value="{{ Auth::user()->role_id }}">
    <!-- Start Email Statistic area-->
    <div class="sale-statistic-area" style="margin-bottom: 5%;">
        <div class="container">
            <div class="row" id="articles">

            </div>
        </div>
    </div>
    <!-- End Email Statistic area-->
@endsection

@section('javascript')
<script> 
    document.getElementById('menu-home').setAttribute("class", "active");
</script>
<script type="module" src="{{ asset('js/actor/article/index.js') }}"></script>
@endsection 