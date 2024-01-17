<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Product</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div>
                            <div><?php echo validation_errors(); ?></div>
                            <div>
                            <?php if (isset($proc_result))
                                {
                                    if ($proc_result == TRUE)
                                        echo 'New product was created successfully!';
                                    else
                                        echo 'Unable to create product. Please try again!';
                                }  
                            ?>
                            </div>
                            <?php echo form_open_multipart('admin/proc-new-product', array('name'=>'formCreateProduct', 'id'=>'formCreateProduct'));?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-shopping-basket"></i> Enter Product Details</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtProductName">Product Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtProductName" class="form-control" placeholder="Product Name" name="txtProductName" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtProductPrice">Product Price</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtProductPrice" class="form-control" placeholder="Product Price" name="txtProductPrice" value="" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Product Image/Banner (640x*)</label>
                                        <div class="col-md-9">
                                            <label id="projectinput8" class="file center-block">
                                                <input type="file" id="fileProductImage" name="fileProductImage">
                                                <span class="file-custom"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Product Description"></textarea>
                                        </div>
                                    </div>                            
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitNewProduct">
                                        <i class="icon-check2"></i> Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->