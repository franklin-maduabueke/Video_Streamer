<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Subscription Plan</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div><?php echo validation_errors(); ?></div>
                        <div>
                        <?php if (isset($proc_result))
                            {
                                if ($proc_result == TRUE)
                                    echo 'New subscription plan was created successfully!';
                                else
                                    echo 'Unable to create subcription plan. Please try again!';
                            }  
                        ?>
                        </div>
                        <div>
                            <?php echo form_open('admin/proc-new-subscription-plan', array('id' => 'formCreateMembershipPlan', 'name' => 'formCreateMembershipPlan')); ?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-star"></i> Create New Subscription Plan</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanTitle">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtMembershipPlanTitle" class="form-control" placeholder="Subscription Plan Name" name="txtMembershipPlanTitle" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanPrice">Price</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtMembershipPlanPrice" class="form-control" placeholder="Subscription Plan Price" name="txtMembershipPlanPrice" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanValidityPeriod">Validity Period</label>

                                        <div class="col-md-3">
                                            <input type="text" id="txtMembershipPlanValidityPeriod" class="form-control" placeholder="Subscription Plan Validity Period" name="txtMembershipPlanValidityPeriod" value="" />
                                        </div>

                                        <div class="col-md-6">
                                            <select id="txtMembershipPlanValidityFreq" class="form-control" name="txtMembershipPlanValidityFreq">
                                                <option value="0">--Select Range--</option>
                                                <option value="1">Day(s)</option>
                                                <option value="2">Week(s)</option>
                                                <option value="3">Month(s)</option>
                                                <option value="4">Year(s)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Privileges <span class="red">*</span></label>
                                        <div class="col-md-9 skin skin-flat">
                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkPrivEnableAdverts" name="chkPrivEnableAdverts" checked />
                                                <label for="chkPrivEnableAdverts">Enable Adverts</label>
                                            </fieldset>

                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkPrivEnableLiveCam" name="chkPrivEnableLiveCam" />
                                                <label for="chkPrivEnableLiveCam">Enable Live-Cam Access</label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Subscription Plan Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitNewSubscriptionPlane">
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