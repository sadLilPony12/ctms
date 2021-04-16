<!-- Start ban profile modal -->
        <div class="modal fade" id="change-pass" role="dialog" data-keybord="false" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                   
                    <!-- <form> -->
                    <form method="POST" action="{{ route('change.password') }}">
                    @csrf 
                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach 
                    <div class="modal-body">
                        <h2>Please fill up the form.</h2>
                        <div class="col-md-12">
                            <div class="input-group mg-t-15 col-md-12">
                                <div class="form-group ic-cmp-int form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" placeholder="Current password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mg-t-15 col-md-12">
                                <div class="form-group ic-cmp-int form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" placeholder="New password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mg-t-15 col-md-12">
                                <div class="form-group ic-cmp-int form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-refresh"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" placeholder="Confirm new password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    &nbsp;&nbsp;
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"><span class="notika-icon notika-checked"></span>&nbsp;Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- End ban profile modal -->