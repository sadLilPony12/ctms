<!-- <div class="form-group ic-cmp-int">
                                                                <div class="nk-int-st image-container">
                                                                    <div class="image-crop">
                                                                       <img id="image" src=" asset('img/icon.jpg') }}" width="300px" height="300px" alt="">
                                                                    </div>
                                                                    <div class="preview-img-pro-ad">
                                                                        <div class="image-crp-int">
                                                                            <div class="img-preview img-preview-custom"></div>
                                                                        </div>
                                                                        <div style="margin-top: -35%;" class="middle">
                                                                            <label title="Upload image file" for="inputImage" class="btn btn-primary img-cropper-cp">
                                                                                <input type="file" accept="image/jpeg"  id="inputImage" onchange="openFileU(event)" class="hidden" > Upload an image
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
    <!-- Start update profile modal -->

        <div class="modal fade" id="modal-edit" role="dialog">
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form  id="profiles-Model">
                                                <input type="hidden" name="role_id" value="{{ Auth::user()->role_id }}">
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                          
                                                <div class="modal-body">
                                                    <h1><span style="text-transform:capitalize;">{{ Auth::user()->name }}'s</span> profile</h1>
                                                    <div style="margin-top:5%;" class="row">    
                                                     
                                                        <div class="col-md-7">
                                                            <div class="input-group mg-t-20">
                                                                <div class="nk-int-st container">
                                                                    <img id="image" onerror="this.src='../../images/avatar/icon.jpg';" src="{{ asset('img/icon.jpg') }}" style="height: 300px;" />
                                                                    <div class="middle">
                                                                    <label class="texttext btn btn-info" for="inputImage"> Upload image
                                                                        <input id="inputImage" accept="image/jpeg" type="file" onchange="PreviewImage(event);" class="hidden" />
                                                                    </label>
                                                                    </div>                                                                   
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="logoU" id="user_avatar">

                                                        <div style="margin-bottom: 2.5%;" class="col-md-5">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control" placeholder="Alias" id="Name" name="Name"  required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-bottom: 2.5%;" class="col-md-5">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-phone"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control" data-mask="(999) 999-9999" id="Phone" name="Phone"  placeholder="Contact number" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-bottom: 2.5%;" class="col-md-5">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"  name="Fname" id="Fname" placeholder="First name" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-bottom: 2.5%;" class="col-md-5">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control" id="Mname"  name="Mname" placeholder="Middle name" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-bottom: 2.5%;" class="col-md-5">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"  name="Lname" id="Lname" placeholder="Last name" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"  name="AddR" id="AddR" placeholder="Address - Region" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"  name="AddP" id="AddP" placeholder="Address - Province" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="input-group mg-t-20">
                                                                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-ip-locator"></i></span>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"  name="AddC" id="AddC" placeholder="Address - City" required autofocus>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  </form>
                                                <div style="margin-top: 5%;" class="modal-footer">
                                                    <button type="submit" id="btn-edit" data-id="{{ Auth::user()->id }}" class="btn btn-info" >Save changes</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                          
                                        </div>
                                    </div>
                                </div>
    <!-- End update profile modal -->
<script>
    function PreviewImage(event) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("inputImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("image").src = oFREvent.target.result;
        };

        var input = event.target;
        var reader = new FileReader();
        reader.onload =  ()=> {
            var dataURL = reader.result;
            // console.log(dataURL);
            var output = document.getElementById('user_avatar');
            output.value = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };
</script>