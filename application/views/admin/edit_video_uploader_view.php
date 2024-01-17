<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Videos(<?php echo $video['title'];?>)</h4>
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
                                        echo 'Video was edited successfully!';
                                    else
                                        echo 'Unable to edit video. Please try again!';
                                }  
                            ?>
                            </div>
                            <?php echo form_open_multipart('admin/proc-edit-video', array('name'=>'formEditVideo', 'id'=>'formEditVideo'));?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-video2"></i> Edit Video</h4>
                                    <input type="hidden" name="video_appid" id="video_appid" value="<?php echo $video['appid']; ?>" />
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cbCategory">Select Category <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <select name="cbCategory" id="cbCategory" class="form-control">
                                                <option value="-1">Select Video Category</option>
                                                <?php
                                                foreach ($categories as $category)
                                                {?>
                                                    <option value="<?php echo $category['appid'];?>" <?php if ($video['category'] == $category['appid']) echo 'selected="selected"'; ?>><?php echo $category['title'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoTitle">Video Title <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoTitle" class="form-control" placeholder="Video Title" name="txtVideoTitle" value="<?php echo $video['title'];?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoTitle">Keywords</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoKeywords" class="form-control" placeholder="Keywords for search target separeted with a comma(,)" name="txtVideoKeywords" value="<?php echo $video['keywords'];?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoActors">Actors</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoActors" class="form-control" placeholder="Video Actors separeted with a comma(,)" name="txtVideoActors" value="<?php echo $video['actors'];?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoDirectors">Directors</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoDirectors" class="form-control" placeholder="Video Directors separeted with a comma(,)" name="txtVideoDirectors" value="<?php echo $video['directors'];?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoCreators">Creators</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoCreators" class="form-control" placeholder="Video Creators separeted with a comma(,)" name="txtVideoCreators" value="<?php echo $video['creators'];?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Video File</label>
                                        <div class="col-md-9 skin skin-flat">
                                            <fieldset style="font-size:12px; padding:20px; background-color:#afafaf; margin:10px 0px 10px 0px;">
                                                <label id="projectinput8" class="file center-block"></label>
                                                <input type="file" id="fileVideoSourceFile" name="fileVideoSourceFile">
                                                <p style="margin-top:10px; font-weight:bold;">
                                                    <span class="file-custom">Current File: <?php echo $this->config->item('media_source_path') . substr($video['media_source'], strrpos($video['media_source'], '/') + 1); ?></span>
                                                    <br/>
                                                    <span class="file-custom">Encoding Status: <?php echo $video['encoded'] == 1 ? 'Encoded' : 'Not Encoded'; ?></span>
                                                </p>
                                            </fieldset>

                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkStartEncoding" name="chkStartEncoding" />
                                                <label for="chkStartEncoding">Check to Run Encoding Process</label>
                                            </fieldset>

                                            <fieldset style="font-size:12px;" id="fsSaveAsAdsVideo">
                                                <input type="checkbox" id="chkSaveAsAdsVideo" name="chkSaveAsAdsVideo" <?php if ($video['ads_video'] == 1) echo 'checked'; ?> />
                                                <label for="chkSaveAsAdsVideo" id="lblSaveAsAdsVideo">Save As Video Advert</label>
                                            </fieldset>

                                            <fieldset style="font-size:12px;" class="hidden" id="fsTxtProductPrice">
                                                <label for="txtProductPrice">Product Price</label>
                                                <input type="text" id="txtProductPrice" class="form-control" placeholder="Enter Product Price" name="txtProductPrice" value="" />
                                                
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Cover Image File</label>
                                        <div class="col-md-9 skin skin-flat">
                                            <label id="projectinput8" class="file center-block">
                                                <input type="file" id="fileVideoCoverImageFile" name="fileVideoCoverImageFile" accepts="image/*">
                                                <span class="file-custom"></span>
                                            </label>

                                            <div id="product_banner_container">
                                                <?php
                                                    if (strlen($video['cover_image']) > 2)
                                                    {
                                                ?>
                                                <div class="productpanel row">
                                                    <div class="col-md-12 productvideopanel">
                                                        <img src="<?php echo $banner; ?>" />
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                    else if (isset($video['vidly_url']))
                                                    {?>
                                                        <div class="productpanel row">
                                                            <div class="col-md-12 productvideopanel">
                                                                <img src="http://vid.ly/<?php echo trim($video['vidly_url']); ?>/poster" alt="" class="image-responsive" style="height:100%; height:auto;"  />
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Video Description"><?php echo $video['description'];?></textarea>
                                        </div>
                                    </div>
                            
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitEditVideoUpload">
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