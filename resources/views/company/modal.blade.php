<div class="modal fade" id="company"  aria-hidden="true"> 
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modal-title"> Add User </h4>
            </div>
            
            <form id="modal-create"> 
                        
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group, text-center">
                                <label for="imgOutput"><span class="fa fa-camera"></span>&nbsp;Select Image</label>
                                <input type="file"  id="inputImage" onchange="openFile(event)" class="hidden" > 
                            </div>
                        </div>
                        <input type="hidden" name="logo" id="logo">
                        <div class="col-md-8">
                            <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">Name</span></div>
                                <input type="text"name="name"id="name" class="form-control" >
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">Sub Name </span></div>
                                <input type="text"name="subname"id="subname" class="form-control" required>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">Phone </span></div>
                                <input type="text"name="phone"id="phone" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">Region</span></div>
                                <select id="region" class="form-control"></select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">City Municipality</span></div>
                                <select id="city-mun" class="form-control"></select>
                            </div>
                             <div class="input-group mb-2">
                                <div class="input-group-addon"><span class="input-group-text">Purok</span></div>
                                <input type="text"name="purok"id="purok" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <select id="province" class="form-control"></select>
                                <div class="input-group-addon"><span class="input-group-text">Province</span></div>
                            </div>
                            <div class="input-group mb-2">
                                <select name="brgy" id="brgy" class="form-control"></select>
                                <div class="input-group-addon"><span class="input-group-text">Barangay</span></div>
                            </div>
                            <div class="input-group mb-2">
                                <input type="text"name="street"id="street" class="form-control text-right">
                                <div class="input-group-addon"><span class="input-group-text">Street</span></div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn=upload" class="btn btn-primary form-control">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

       var openFile = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload =  ()=> {
            var dataURL = reader.result;
            console.log(dataURL);
            var output = document.getElementById('logo');
            output.value = dataURL;

        };
        reader.readAsDataURL(input.files[0]);
    };
</script>