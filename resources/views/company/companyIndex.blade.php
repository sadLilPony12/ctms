
<!-- Main Menu area End-->
<div class="modal fade" id="addCompany" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1>Add company</h1>
            </div>
            <form id="set-Model">
            <input type="hidden" id="user-id" value="{{Auth::user()->id}}">
            <div class="modal-body">

                <!-- <div class="col-md-7">
                    <div class="image-crop">
                        <img src="{{ asset('img/rick_astley.jpg') }}" alt="">
                    </div>
                    <div class="preview-img-pro-ad">
                        <div class="image-crp-int">
                            <div class="img-preview img-preview-custom"></div>
                        </div>
                        <div style="margin-top: -70%;" class="image-crp-img">
                            <label title="Upload image file" for="TinputImage"  class="btn btn-primary img-cropper-cp">
                               <input type="file" accept="image/jpeg" id="TinputImage" onchange="openFileC(event)" class="hidden" > Upload an image
                            </label>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-7">
                    <div class="input-group mg-t-20">
                        <div class="nk-int-st container">
                            <img id="image1" src="{{ asset('images/company.jpg') }}" style="height: 200px;" />
                            <div class="middle">
                            <label class="texttext btn btn-info" for="TinputImage"> Upload image
                                <input id="TinputImage" accept="image/jpeg" type="file" onchange="PreviewImage1(event);" class="hidden" />
                            </label>
                            </div>                                                                   
                        </div>
                    </div>
                </div>

                <input type="hidden" name="log" id="companylogo">

                <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-support"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="name" id="name" placeholder="Company name" type="text" class="form-control"required>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-form"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="subname" id="subname" placeholder="Branch name" type="text" class="form-control"required>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-phone"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="phone" id="phone" placeholder="Company phone number" data-mask="(999) 999-9999" type="text" class="form-control"required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-ip-locator"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="brgy" id="brgy" placeholder="Brgy" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-ip-locator"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="street" id="street" placeholder="Street" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">    
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-ip-locator"></i>
                        </div>
                        <div class="nk-int-st">
                            <input name="purok" id="purok" placeholder="No." type="text" class="form-control"required>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="company-engrave"  data-dismiss="modal">Add company</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
function PreviewImage1(event) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("TinputImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("image1").src = oFREvent.target.result;
        };

        var input = event.target;
        var reader = new FileReader();
        reader.onload =  ()=> {
            var dataURL = reader.result;
            // console.log(dataURL);
            var output = document.getElementById('articlelogo');
            output.value = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };
</script>



    <!-- Breadcomb area Start-->

