<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Products</h4>
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
                                    echo 'Something when wrong while trying to update changes to product. Please try again!';
                            }  
                        ?>
                        </div>
                        <div>
                            <?php echo form_open('admin/proc-delete-product', array('id' => 'formDeleteProduct', 'name' => 'formDeleteProduct')); ?>
                                <input type="hidden" name="txthproductId" id="txthproductId" />
                            </form>

                            <table class="table table-striped table-bordered zero-configuration" id="product-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Product #</th>
                                        <th>Created</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($products as $product)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td><?php echo $product['product_number']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($product['date_created'])); ?></td>
                                        <td><?php echo 'N' . number_format($product['current_price'], 2); ?></td>
                                        <td style="text-align:left">
                                            <input type="hidden" value="<?php echo $product['appid']; ?>" />
                                            <a href="<?php echo base_url() . "index.php/admin/edit-product/{$product['appid']}" ?>" class="btn btn-teal btnEditProduct">
                                                <i class="icon-pencil"></i> Edit
                                            </a>

                                            <button type="button" class="btn btn-teal btnDeleteProduct">
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
                                        <th>Name</th>
                                        <th>Product #</th>
                                        <th>Created</th>
                                        <th>Price</th>
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