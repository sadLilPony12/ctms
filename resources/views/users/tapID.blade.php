@extends('layouts.admin')

@section('content')  
<input type="text" onblur="this.focus()" autofocus id="queue-rfid" style="opacity: 0%;"> 
<div id="clock" style="display:none;"></div>
<div id="date" style="display:none;"></div>
<script type="text/javascript" src="{{ asset('js/broadcast/clock.js') }}"></script>

<div class="breadcomb-area" style="margin-top: 5%;">
        <div class="container">
            <div class="row">
  <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Tapped ID Logs</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody id="attendance"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
</div>
</div>
</div>
@endsection

@section('javascript')
    <script type="module" src="{{ asset('js/broadcast/dtr/index.js') }}"></script>
    <!-- <script type="module" src="{{ asset('js/broadcast/attendance.js') }}"></script> -->
    <!-- <script type="module" src="{{ asset('js/broadcast/clock.js') }}"></script> -->
    <script type="module" src="{{ asset('js/broadcast/sms.js') }}"></script>

@endsection 