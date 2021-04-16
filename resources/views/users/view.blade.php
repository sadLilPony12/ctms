<!-- Start view profile modal -->
        <div class="modal fade" id="modal-main" role="dialog">
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h1><span style="text-transform:capitalize;">{{ Auth::user()->name }}'s</span> profile</h1>
                                                <div style="margin-top:5%;" class="row">
                                                
                                                    <div class="col-md-6">
                                                        <div class="form-group ic-cmp-int float-lb floating-lb">
                                                            <div class="nk-int-st">
                                                                <div style="height: 244px; width: 244px;">
                                                                    <img id="profile_picture" name="profile_picture" />
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" placeholder="Alias" id="name" name="name" disabled autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-phone"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" data-mask="(999) 999-9999" id="phone" name="phone" disabled placeholder="Contact number" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="First name" id="fname" name="fname" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="Middle name" id="mname" name="mname" autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="Last name" id="lname" name="lname" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="Address - Region" id="addR" name="addR" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="Address - Province" id="addP" name="addP" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="input-group mg-t-20">
                                                            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                            <div class="nk-int-st">
                                                                <input type="text" class="form-control" disabled placeholder="Address - City" id="addC" name="addC" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 5%;" class="modal-footer">                                                
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    <!-- End view profile modal -->
    