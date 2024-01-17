<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
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
                                        echo 'Password was changed successfully!';
                                    else
                                        echo 'Unable to change password. Please try again!';
                                }  
                            ?>
                            </div>
                            <?php echo form_open('admin/proc-new-password', array('name'=>'formChangePassword', 'id'=>'formChangePassword'));?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-lock"></i> Change Password</h4>
                                    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>" />
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtOldPassword">Enter Old Password</label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" id="txtOldPassword" class="form-control" placeholder="Enter Old Password" name="txtOldPassword" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtNewPassword">Enter New Password</label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" id="txtNewPassword" class="form-control" placeholder="Enter New Password" name="txtNewPassword" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtNewPasswordConfirm">Enter Password Confirmation</label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" id="txtNewPasswordConfirm" class="form-control" placeholder="Enter New Password" name="txtNewPasswordConfirm" value="" />
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitNewPassword">
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