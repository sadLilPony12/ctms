@extends('layouts.admin')

@section('content')
    <!-- Start Email Statistic area-->
    <div class="notika-email-post-area row">
        <div class="container">
            <div class="row">
                <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                <input type="hidden" id="role" value="{{Auth::user()->role_id}}">
                <div  id="companies"></div>                
            </div>
        </div>
    </div>
    <!-- End Email Statistic area-->
    <div class="modal fade" id="modal-company"  aria-hidden="true"> 
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title"> Add User </h4>
            </div>
            
            <form id="modal-create"> 
                        
                <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="approve" id="approve">
                        <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input id="reason" maxlength="30" name="reason" placeholder="Reason" type="text" class="form-control">
                            </div>
                        </div>
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-engrave" class="btn btn-primary form-control">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('javascript')
<script> 
    document.getElementById('menu-charts').setAttribute("class", "active");
</script>
    <script type="module" src="{{ asset('js/company/user.js') }}"></script>
@endsection 