<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload Videos</h4>
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
                                        echo 'Video was uploaded to server successfully! Awaiting encoding request.';
                                    else
                                        echo 'Unable to upload video. Please try again!';
                                }  
                            ?>
                            </div>
                            <?php echo form_open_multipart('admin/proc-video-upload', array('name'=>'formUploadVideo', 'id'=>'formUploadVideo'));?>
                                <div class="form-body">
                                    <h4 class="form-section"><i class="icon-video2"></i> Pick a Video to Upload</h4>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cbCategory">Select Category <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <select name="cbCategory" id="cbCategory" class="form-control">
                                                <option value="-1">Select Video Category</option>
                                                <?php
                                                foreach ($categories as $category)
                                                {?>
                                                    <option value="<?php echo $category['appid'];?>"><?php echo $category['title'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoTitle">Video Title <span class="red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoTitle" class="form-control" placeholder="Video Title" name="txtVideoTitle" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoTitle">Keywords</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoKeywords" class="form-control" placeholder="Keywords for search target separeted with a comma(,)" name="txtVideoKeywords" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoActors">Actors</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoActors" class="form-control" placeholder="Video Actors separeted with a comma(,)" name="txtVideoActors" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoDirectors">Directors</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoDirectors" class="form-control" placeholder="Video Directors separeted with a comma(,)" name="txtVideoDirectors" value="" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVideoCreators">Creators</label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtVideoCreators" class="form-control" placeholder="Video Creators separeted with a comma(,)" name="txtVideoCreators" value="" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Select Video File <span class="red">*</span></label>
                                        <div class="col-md-9 skin skin-flat">
                                            <label id="projectinput8" class="file center-block">
                                                <input type="file" id="fileVideoSourceFile" name="fileVideoSourceFile" accepts="video/*">
                                                <span class="file-custom"></span>
                                            </label>

                                            <fieldset style="font-size:12px;">
                                                <input type="checkbox" id="chkStartEncoding" name="chkStartEncoding" checked />
                                                <label for="chkStartEncoding">Check to Run Encoding Process</label>
                                            </fieldset>

                                            <fieldset style="font-size:12px;" id="fsSaveAsAdsVideo">
                                                <input type="checkbox" id="chkSaveAsAdsVideo" name="chkSaveAsAdsVideo" />
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
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescription">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="txtDescription" rows="5" class="form-control" name="txtDescription" placeholder="Enter Video Description"></textarea>
                                        </div>
                                    </div>
                            
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-red mr-1" id="btnClearFields">
                                        <i class="icon-cross2"></i> Clear
                                    </button>
                                    <button type="button" class="btn btn-teal" id="btnSubmitVideoUpload">
                                        <i class="icon-check2"></i> Upload
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