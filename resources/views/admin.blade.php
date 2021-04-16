@extends('layouts.admin')

@section('content')
<div>
    <div id="table-user"></div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif            
</div>
@endsection

@section('javascript')
  <script type="module" src="{{ asset('js/actor/user.js') }}"></script>
@endsection 
