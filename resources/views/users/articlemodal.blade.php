<div class="modal fade" id="addArticle" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                    data-dismiss="modal">&times;</button>
            </div>
            <form  id="article-Model"> 
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="create" value="{{now()}}">

                    <h1>Add article</h1>
                    <!-- <div class="col-md-7">
                        <div class="image-crop">
                            <img src=" asset('images/article/stayHome.jpeg') }}" alt="">
                        </div>

                        <div class="preview-img-pro-ad">
                            <div class="image-crp-int">
                                <div class="img-preview img-preview-custom"></div>
                            </div>
                            <div style="margin-top: -70%;" class="image-crp-img">
                                <label title="Upload image file"  for="TinputImage" class="btn btn-primary img-cropper-cp">
                                    <input type="file" accept="image/jpeg" id="TinputImage" onchange="openFile(event)" class="hidden" > Upload an image
                                </label>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-7">
                        <div class="input-group mg-t-20">
                            <div class="nk-int-st container">
                                <img id="image1" src="{{ asset('images/article/stayHome.jpeg') }}" style="height: 300px;" />
                                <div class="middle">
                                <label class="texttext btn btn-info" for="TinputImage"> Upload image
                                    <input id="TinputImage" accept="image/jpeg" type="file" onchange="PreviewImage1(event);" class="hidden" />
                                </label>
                                </div>                                                                   
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="logo" id="articlelogo">

                    <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input id="title" maxlength="30" name="title" placeholder="Article name" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-form"></i>
                            </div>
                            <div class="nk-int-st">
                                <!-- <input id="message" name="message" placeholder="Article description" type="text" class="form-control"> -->
                                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Article description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 5%;" class="col-md-5 input-group mg-t-15">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input id="reference" name="reference" placeholder="Article reference" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">         
                            <input id="start_at" name="start_at" placeholder="Starts at" onchange="validateStart()" onfocus="(this.type='date')" type="text" class="form-control">           
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">           
                            <input id="end_at" name="end_at" placeholder="Ends at" onchange="validateEnd()" onfocus="(this.type='date')" type="text" class="form-control">             
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <div class="modal-footer">
                    <button type="button" id="btn-article" class="btn btn-info" >Add article</button>
                    <button type="button" class="btn btn-danger"
                        data-dismiss="modal">Cancel</button>
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