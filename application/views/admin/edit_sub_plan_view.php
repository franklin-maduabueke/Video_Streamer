<?php
    $privileges = json_decode($sub_plan['mp_privileges']);
?>
<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Subscription Plan(<span style="font-weight:bold;"><?php echo $sub_plan['mp_title']; ?></span>)</h4>
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
                            <?php echo form_open('admin/proc-edit-subscription-plan', array('id' => 'formEditMembershipPlan', 'name' => 'formEditMembershipPlan')); ?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-edit"></i> Edit Subscription Plan</h4>
                                    <input type="hidden" id="subplanKey" name="subplanKey" value="<?php echo $sub_plan['mp_appid']; ?>" />

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanTitle">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtMembershipPlanTitle" class="form-control" placeholder="Subscription Plan Name" name="txtMembershipPlanTitle" value="<?php echo $sub_plan['mp_title']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanPrice">Price</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtMembershipPlanPrice" class="form-control" placeholder="Subscription Plan Price" name="txtMembershipPlanPrice" value="<?php echo $sub_plan['mp_price']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtMembershipPlanValidityPeriod">Validity Period</label>

                                        <div class="col-md-3">
                                            <input type="text" id="txtMembershipPlanValidityPeriod" class="form-control" placeholder="Subscription Plan Validity Period" name="txtMembershipPlanValidityPeriod" value="<?php echo $sub_plan['mp_valid_period']; ?>" />
                                        </div>

                                        <div class="col-md-6">
                                            <select id="txtMembershipPlanValidityFreq" class="form-control" name="txtMembershipPlanValidityFreq">
                                                <option value="0">--Select Range--</option>
                                                <option value="1" <?php echo $sub_plan["mp_valid_freq"] == 1 ? 'selected="selected"' : ''; ?>>Day(s)</option>
                                                <option value="2" <?php echo $sub_plan["mp_valid_freq"] == 2 ? 'selected="selected"' : ''; ?>>Week(s)</option>
                                                <option value="3" <?php echo $sub_plan["mp_valid_freq"] == 3 ? 'selected="selected"' : ''; ?>>Month(s)</option>
                                                <option value="4" <?php echo $sub_plan["mp_valid_freq"] == 4 ? 'selected="selected"' : ''; ?>>Year(s)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Privileges <span class="red">*</span></label>
                                        <div class="col-md-9 skin skin-flat">
                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkPrivEnableAdverts" name="chkPrivEnableAdverts" <?php if ($privileges->adverts) echo 'checked';?> />
                                                <label for="chkPrivEnableAdverts">Enable Adverts</label>
                                            </fieldset>

                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkPrivEnableLiveCam" name="chkPrivEnableLiveCam" <?php if ($privileges->live_cam) echo 'checked';?> />
                                                <label for="chkPrivEnableLiveCam">Enable Live-Cam Access</label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Subscription Plan Description"><?php echo $sub_plan['mp_description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitEditSubscriptionPlane">
                                        <i class="icon-check2"></i> Save Changes
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