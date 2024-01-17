<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Product Orders</h4>
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
                        <?php if (isset($proc_result))
                        {?>
                            <div style="color:#fefefe; background-color:#228EB6; padding:10px; border-radius:5px; font-weight:bold; margin-bottom:10px;">
                            <?php 
                            if ($proc_result == TRUE)
                                echo 'Last operation was successful.';
                            else
                                echo 'Unable to complete your request. Please try again!';
                            ?>   
                            </div>
                        <?php
                        }  ?>
                        <div>
                            <?php echo form_open('admin/del-product-order', array('id' => 'formDeleteProductOrder', 'name' => 'formDeleteProductOrder')); ?>
                                <input type="hidden" name="txthproductorderId" id="txthproductorderId" />
                            </form>

                            <table class="table table-striped table-bordered zero-configuration" id="product-table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price Tag</th>
                                        <th>Qty</th>
                                        <th>Caller #</th>
                                        <th>Date Ordered</th>
                                        <th>Responded</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($product_orders as $order)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $order['product_name']; ?></td>
                                        <td><?php echo 'N' . number_format($order['price_tag']); ?></td>
                                        <td><?php echo number_format($order['quantity']); ?></td>
                                        <td><?php echo $order['phone_number']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($order['order_date'])); ?></td>
                                        <td><?php echo $order['responded'] == 0 ? 'NO' : 'YES'; ?></td>
                                        <td style="text-align:left">
                                            <input type="hidden" value="<?php echo $order['id']; ?>" />
                                            <?php
                                                if ($order['responded'] == 0)
                                                {?>
                                            <a href="<?php echo base_url() . "index.php/admin/respond-product-order/{$order['id']}" ?>" class="btn btn-teal btnRespondToProductOrder">
                                                <i class="icon-mobile-phone"></i>
                                            </a>
                                            <?php
                                                }
                                            ?>
                                            <button type="button" class="btn btn-teal btnDeleteProductOrder">
                                                <i class="icon-cross"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php 
                                    } 
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price Tag</th>
                                        <th>Qty</th>
                                        <th>Caller #</th>
                                        <th>Date Ordered</th>
                                        <th>Responded</th>
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