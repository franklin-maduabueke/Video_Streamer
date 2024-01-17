<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="media px-1">
                                <div class="media-left media-middle">
                                    <i class="icon-stats-dots font-large-1 blue-grey"></i>
                                </div>
                                <div class="media-body text-xs-right">
                                    <span class="font-large-2 text-bold-300 info"><?php echo numberMinify($total_videos, 1); ?></span>
                                </div>
                                <p class="text-muted">Total Videos <span class="info float-xs-right"></span></p>
                                <progress class="progress progress-sm progress-info" value="100" max="100"></progress>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="media px-1">
                                <div class="media-left media-middle">
                                    <i class="icon-check font-large-1 blue-grey"></i>
                                </div>
                                <div class="media-body text-xs-right">
                                    <span class="font-large-2 text-bold-300 success"><?php echo numberMinify($total_encodings, 1); ?></span>
                                </div>
                                <p class="text-muted">Total Encodings<span class="success float-xs-right"></span></p>
                                <progress class="progress progress-sm progress-success" value="100" max="100"></progress>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                            <div class="media px-1">
                                <div class="media-body text-xs-right">
                                    <span class="font-large-2 text-bold-300 deep-orange"><?php echo numberMinify($total_views, 1); ?></span>
                                </div>
                                <p class="text-muted">Total Views<span class="deep-orange float-xs-right"></span></p>
                                <progress class="progress progress-sm progress-deep-orange" value="@Math.Round(100 - percentageOwed, 0)" max="100"></progress>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-12">
                            <div class="media px-1">
                                <div class="media-body text-xs-right">
                                    <span class="font-large-2 text-bold-300 warning"><?php echo numberMinify($total_pending, 1); ?></span>
                                </div>
                                <p class="text-muted">Total Pending<span class="warning float-xs-right"></span></p>
                                <progress class="progress progress-sm progress-warning" value="@Math.Round(percentageOwed, 0)" max="100"></progress>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Classes -->
<section id="css-classes" class="card">
    <div class="card-header">
        <h4 class="card-title">Home Page Banner</h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <?php if (isset($proc_result))
                {
                    ?>
                <div class="bg-info" style="font-size:14px; color:#c00; border-radius:5px; padding:10px; margin-bottom:10px;">
                    <i style="color:#eee"> <?php echo $proc_result == TRUE ? 'Banner was changed successfully!' : 'Unable to change banner. Please try again!' ;?></i>
                </div>
                <?php
                }?>
                <p>You can upload the banner for the homepage here!</p>
                <?php echo form_open_multipart('admin/proc-homebanner-upload', array('name'=>'formUploadHomeBanner', 'id'=>'formUploadHomeBanner'));?>
                    <div>
                        <label for="fileHomeBannerImageFile">Image File:</label>
                        <input type="file" id="fileHomeBannerImageFile" name="fileHomeBannerImageFile" accepts="image/*">
                    </div>

                    <button type="button" id="btnUplodaHomeBanner" class="btn btn-success btn-darken-2">Submit</button>
                </form>

                <div style="margin-top:20px;">
                    <img src="<?php echo base_url() . 'static/' . $this->config->item('homebanner'); ?>" class="image-fluid" style="max-width:100%; height:auto;" />
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ CSS Classes -->
