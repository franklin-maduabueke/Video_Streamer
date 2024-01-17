<section id="configuration">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Videos</h4>
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
                                <div style="color:#FFF; padding:10px; margin-bottom:10px; background-color:#1D7A9C; border-radius:5px;">
                                <?php
                                if ($proc_result == TRUE)
                                    echo 'Video was delivered to server for encoding! Awaiting encoding response.';
                                else
                                    echo 'Unable to deliver video to server for encoding. Please try again!';
                                ?>
                                </div>
                            <?php
                            }  
                        ?>
                        <div>
                            <?php echo form_open('admin/proc-delete-video', array('id' => 'formDeleteVideo', 'name' => 'formDeleteVideo')); ?>
                                <input type="hidden" name="txthvideoId" id="txthvideoId" />
                            </form>

                            <table class="table table-striped table-bordered zero-configuration" id="merchant-userlist-data-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Created</th>
                                        <th>Encode Status</th>
                                        <th>For Ads</th>
                                        <th># Views</th>
                                        <th>Poster</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($videos as $video)
                                    {
                                        ?>
                                    <tr>
                                        <td><?php echo $video['title'] ?></td>
                                        <td><?php echo $video['date_created']; ?></td>
                                        <td style="text-align:center;"><?php echo $video['encoded'] == 0 ? 'Not Encoded' : 'Encoded' ?></td>
                                        <td style="text-align:center"><?php echo $video['ads_video'] == 1 ? 'Yes' : 'No'; ?></td>
                                        <td style="text-align:center"><?php echo numberMinify($video['num_views'], 1); ?></td>
                                        <td style="text-align:center; width:5%">
                                        <?php
                                            if ( $video['encoded'] == 1)
                                            {
                                        ?>
                                            <img src="<?php echo "http://vid.ly/{$video['vidly_url']}/thumbnail1"; ?>" style="width:100%; height:100%" />
                                        <?php 
                                            }
                                            else
                                                echo '&nbsp';
                                        ?>
                                        </td>
                                        <td>
                                            <input type="hidden" value="<?php echo $video['appid'];?>" />
                                            <?php if ($video['encoded'] != TRUE) {
                                            ?>
                                                <a href="<?php echo base_url() . "index.php/admin/encode-video-upload/{$video['appid']}" ?>" class="btn btn-blue anc-request-encode">
                                                    <i class="icon-paperplane"></i>
                                                </a>
                                            <?php
                                            }?>

                                            <a href="<?php echo base_url() . "index.php/admin/edit-video-upload/{$video['appid']}" ?>" class="btn btn-teal">
                                                <i class="icon-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-teal btnDeleteVideoUpload">
                                                <i class="icon-cross2"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Created</th>
                                        <th>Encode Status</th>
                                        <th>For Ads</th>
                                        <th># Views</th>
                                        <th>Poster</th>
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