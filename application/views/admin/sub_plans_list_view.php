<section id="configuration">
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Subscription Plans</h4>
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
                        <?php echo form_open('admin/del-subscription-plan', array('id' => 'formDeleteSubscriptionPlan', 'name' => 'formDeleteSubscriptionPlan')); ?>
                            <input type="hidden" name="txthsubplanId" id="txthsubplanId" />
                        </form>

                        <table class="table table-striped table-bordered table-condensed zero-configuration" id="video-cateory-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Price</th>
                                    <th>Validity Period</th>
                                    <th># Subscribers</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($subscription_plans as $subplan)
                                {
                                ?>
                                <tr>
                                    <td><?php echo $subplan['mp_title']; ?></td>
                                    <td><?php echo date('M jS Y', strtotime($subplan['date_created'])); ?></td>
                                    <td><?php echo number_format($subplan['mp_price'], 2); ?></td>
                                    <td>
                                    <?php 
                                        echo $subplan['mp_valid_period'] . " ";

                                        switch ($subplan['mp_valid_freq'])
                                        {
                                            case 1: echo "Day(s)"; break;
                                            case 2: echo "Week(s)"; break;
                                            case 3: echo "Month(s)"; break;
                                            case 4: echo "Year(s)"; break;
                                        } 
                                    ?>
                                    </td>
                                    <td style="text-align:left;"><?php echo number_format($subplan['plan_subscribers']); ?></td>
                                    <td style="text-align:left">
                                        <input type="hidden" value="<?php echo $subplan['mp_appid']; ?>" id="subplankey" />
                                        <input type="hidden" value="<?php echo site_url();?>" id="siteurlpath" />

                                        <button type="button" class="btn btn-teal btnEditSubPlan">
                                            <i class="icon-pencil"></i> Edit
                                        </button>

                                        <button type="button" class="btn btn-teal btnDeleteSubPlan">
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
                                    <th>Price</th>
                                    <th>Validity Period</th>
                                    <th># Subscribers</th>
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