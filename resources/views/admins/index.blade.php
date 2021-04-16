@extends('layouts.admin')

@section('content')
<div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
    <div class="normal-table-list">
        <div class="basic-tb-hd">
            <h2>CTMS Admins list</h2>
        </div>
        <div class="table-responsive">
        <input type="hidden" id="role_id" value="{{ Auth::user()->role_id }}">
            <table id="normal-table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-main"></tbody>
            </table>
        </div>
    </div>     
    @include('admins.modal')
    @include('users.ban')
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script> 
        document.getElementById('menu-list').setAttribute("class", "active");
        document.getElementById('lists').setAttribute("class", "tab-pane notika-tab-menu-bg animated flipInX active");
     </script>
    <script type="module" src="{{ asset('js/actor/user/admin.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
@endsection 