<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Product</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div><?php echo validation_errors(); ?></div>
                        <div>
                            <?php echo form_open_multipart("admin/proc-edit-product", array('name' => 'formEditProduct', 'id' => 'formEditProduct')); ?>
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['appid'];?>" />
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-shopping-basket"></i> Editing Product (<?php echo $product['product_name']; ?>)</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtProductName">Product Name</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtProductName" class="form-control" placeholder="Product Name" name="txtProductName" value="<?php echo $product['product_name']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtProductPrice">Product Price</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtProductPrice" class="form-control" placeholder="Product Price" name="txtProductPrice" value="<?php echo $product['current_price']; ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Product Image/Banner (640x*)</label>
                                        <div class="col-md-9">
                                            <label id="projectinput8" class="file center-block">
                                                <input type="file" id="fileProductImage" name="fileProductImage">
                                                <span class="file-custom"></span>
                                            </label>

                                            <div id="product_banner_container">
                                                <?php
                                                    if (strlen($product['image_name']) > 2)
                                                    {
                                                ?>
                                                <div class="productpanel row">
                                                    <div class="col-md-12 productvideopanel">
                                                        <img src="<?php echo $banner; ?>" />
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                    else if (isset($product_video))
                                                    {?>
                                                        <div class="productpanel row">
                                                            <div class="col-md-12 productvideopanel">
                                                                <img src="http://vid.ly/<?php echo trim($product_video['vidly_url']); ?>/poster" alt="" class="image-responsive" style="height:100%; height:auto;"  />
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Product Description"><?php echo $product['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>

                                    <button type="button" class="btn btn-teal" id="btnSubmitEditProduct">
                                        <i class="icon-check2"></i> Update
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