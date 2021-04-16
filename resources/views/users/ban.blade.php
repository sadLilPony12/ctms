<!-- Start ban profile modal -->
        <div class="modal fade" id="modal-ban" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="set-Model"  >
                    <div class="modal-body">
                        <!-- <input type="hidden" class="form-control" placeholder="Alias" id="id" name="id"  autofocus> -->
                        <input type="hidden" name="deleted_at" id="deleted_at" value="{{ now() }}" >
                        <h2>Are you sure you want to ban this user?</h2>
                        <div class="col-md-12">
                            Please specify the reason.
                            <div class="form-group">
                                <div class="nk-int-st">
                                    <textarea class="form-control auto-size" name="reason" id="reason" rows="3" placeholder="Reason for banning."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="ban-user" class="btn btn-danger"><span class="notika-icon notika-close"></span>&nbsp;Ban</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- End ban profile modal -->