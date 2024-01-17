<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Video Category</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2 white"></i></a></li>
                            </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div>
                        <?php if (isset($proc_result))
                            {
                                if ($proc_result == TRUE)
                                    echo 'Last edit was successful!';
                                else
                                    echo 'Something when wrong while trying to update changes to category. Please try again!';
                            }  
                        ?>
                        </div>
                        <div>
                            <?php echo form_open('admin/processDeleteCategory', array('id' => 'formDeleteCategory', 'name' => 'formDeleteCategory')); ?>
                                <input type="hidden" name="txthcategoryId" id="txthcategoryId" />
                            </form>

                            <table class="table table-striped table-bordered zero-configuration" id="video-cateory-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($categories as $category)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $category['title']; ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', strtotime($category['datecreated'])); ?></td>
                                        <td style="text-align:left;"><?php echo substr($category['description'], 0, 50) . '...'; ?></td>
                                        <td style="text-align:left">
                                            <input type="hidden" value="<?php echo $category['appid']; ?>" />
                                            <button type="button" class="btn btn-teal btnEditCategory">
                                                <i class="icon-pencil"></i> Edit
                                            </button>

                                            <button type="button" class="btn btn-teal btnDeleteCategory">
                                                <i class="icon-cross"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <?php 
                                    } 
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->