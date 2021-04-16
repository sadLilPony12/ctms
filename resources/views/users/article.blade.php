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
<div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-form"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Articles</h2>
                                        <p>Welcome to CTMS <span class="bread-ntd">Article Section</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    <button data-toggle="modal" data-target="#addArticle" data-toggle="tooltip" data-placement="left" title="Add an article" class="btn"><i class="notika-icon notika-app"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('users.articlemodal')
    <div>
    <input type="hidden" id="role" value="{{ Auth::user()->role_id }}">
    <!-- Start Email Statistic area-->
    <div class="sale-statistic-area" style="margin-bottom: 5%;">
        <div class="container">
            <div class="row" id="articles">

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
    document.getElementById('menu-home').setAttribute("class", "active");</script>
    <script type="module" src="{{ asset('js/actor/article/index.js') }}"></script>
@endsection 