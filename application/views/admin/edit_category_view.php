<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Category</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div><?php echo validation_errors(); ?></div>
                        <div>
                            <?php echo form_open("admin/proc-edit-category", array('name' => 'formEditCategory', 'id' => 'formEditCategory')); ?>
                                <input type="hidden" name="categoryId" id="categoryId" value="<?php echo $category['appid'];?>" />
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-make-group"></i> Editing Category (<?php echo $category['title']; ?>)</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtCategoryTitle">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtCategoryTitle" class="form-control" placeholder="Category Name" name="txtCategoryTitle" value="<?php echo $category['title']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Category Description"><?php echo $category['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitEditCategory">
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