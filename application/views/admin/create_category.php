<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Category</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div><?php echo validation_errors(); ?></div>
                        <div>
                        <?php if (isset($proc_result))
                            {
                                if ($proc_result == TRUE)
                                    echo 'New category was created successfully!';
                                else
                                    echo 'Unable to create category. Please try again!';
                            }  
                        ?>
                        </div>
                        <div>
                            <?php echo form_open('admin/proc-new-category', array('id' => 'formCreateCategory', 'name' => 'formCreateCategory')); ?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-make-group"></i> Create New Category</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtCategoryTitle">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtCategoryTitle" class="form-control" placeholder="Category Name" name="txtCategoryTitle" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Category Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitNewCategory">
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