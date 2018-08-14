<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<style type="text/css">
    .text {
        font-size: 12px;
        line-height: 17px;
        font-family: arial;
    }

    .text.short {
        height: 20px;
        overflow: hidden;
    }

    .text.full {

    }

    .read-more {
        cursor: pointer;
        color: Black;

    }

</style>
<div class="wrapper wrapper-content">
    <div class="ibox-title">
        <h4>Blog List </h4>
    </div>
    <div class="ibox-content">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="tabs.html#tab-1" data-toggle="tab" aria-expanded="true" id="">New
                            Post</a></li>
                    <li class=""><a href="tabs.html#tab-2" data-toggle="tab" aria-expanded="false" id="approved_post">Approved
                            Post</a></li>
                    <li class=""><a href="tabs.html#tab-3" data-toggle="tab" aria-expanded="false" id="pending_post">Pending
                            Post</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel-body">
                  <span id="">
                   <table class="table table-striped table-bordered table-hover ">
                       <thead>
                       <tr>
                           <th><input type="checkbox" name="select-all" id="select-all"/>&nbsp;#</th>
                           <th>Title</th>
                           <th>Subtitle</th>
                           <th>Desc</th>
                           <th>Banner</th>
                           <th>Remarks</th>
                           <th>Published Date</th>
                           <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php if (!empty($blog_list)) $sl = 1;
                       foreach ($blog_list as $row): ?>
                       <tr id="row_<?php echo $row->POST_ID ?>" <?php echo ($row->APPROVE_BY_ADMIN == 1) ? 'lightYellow' : ''; ?>>

                           <td width="5%">

                               <input name="" type="checkbox">&nbsp;<?php echo $sl++; ?>
                           </td>
                           <td width="10%">
                               <div class="small">
                                   <div class="text short">
                                       <?php echo $row->POST_TITLE ?>
                                   </div>
                                   <a href="#" class="read-more">Read more..</a>
                               </div>
                           </td>
                           <td width="10%"><?php echo $row->POST_SUB_TITLE ?></td>
                           <td width="35%">
                               <div class="small">
                                   <div class="text short">
                                       <?php echo $row->POST_CONTENT ?>
                                   </div>
                                   <a href="#" class="read-more">Read more..</a>
                               </div>
                           </td>
                           <td>

                               <div class="lightBoxGallery">
                                   <a href="<?php echo base_url(); ?>upload/blog_banner/<?php echo $row->POST_BANNER ?>"
                                      title="Banner Photo" data-gallery="">
                                       <?php if (!empty($row->POST_BANNER)) { ?>
                                           <img width="40%"
                                                src="<?php echo base_url(); ?>upload/blog_banner/<?php echo $row->POST_BANNER ?>"/>
                                       <?php } ?>
                                   </a>
                               </div>
                           </td>


                        </div>
                        <td width="20%"><textarea class="form-control"></textarea></td>
                        <td width="10%"><input type="text" class="form-control datepicker"></td>
                        <td width="10%" class="text-center">
                            <select postid="<?php echo $row->POST_ID ?>" class="form-control blog_status">
                                <option value="0" <?php echo ($row->APPROVE_BY_ADMIN == 0) ? 'selected' : ''; ?>>
                                    -Select-
                                </option>
                                <option value="1" <?php echo ($row->APPROVE_BY_ADMIN == 1) ? 'selected' : ''; ?>>
                                    Published
                                </option>
                                <option value="2" <?php echo ($row->APPROVE_BY_ADMIN == 2) ? 'selected' : ''; ?>>
                                    Review
                                </option>
                                <option value="3" <?php echo ($row->APPROVE_BY_ADMIN == 3) ? 'selected' : ''; ?>>
                                    Reject
                                </option>
                                <option value="4" <?php echo ($row->APPROVE_BY_ADMIN == 3) ? 'selected' : ''; ?>>
                                    Pending
                                </option>
                            </select>

                        </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                        </span>
                    </div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="panel-body">
                <span id="approve_post_list">
                </span>
                    </div>
                </div>
                <div class="tab-pane" id="tab-3">
                    <div class="panel-body">
                <span id="pending_post_list">
                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>

<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#pending_post").on('click', function () {
            $.ajax({
                url: '<?php echo base_url()?>teacher/pendingBlogPost',
                success: function (data) {
                    if (data) {
                        $("#pending_post_list").html(data);
                    }
                }
            });
        });
        $("#approved_post").on('click', function () {
            $.ajax({
                url: '<?php echo base_url()?>teacher/approveBlogPost',
                success: function (data) {
                    if (data) {
                        $("#approve_post_list").html(data);
                    }
                }
            });
        });


        $(".blog_status").on("change", function () {
            var approve_status = $(this).val();
            postid = $(this).attr('postid');

            // alert();
            $('#myModal').modal('show');

        });

        $(".read-more").click(function (e) {
            e.preventDefault();
            var $elem = $(this).parent().find(".text");
            if ($elem.hasClass("short")) {
                $(this).text("Click to collapse");
                $elem.removeClass("short").addClass("full");
            }
            else {
                $(this).text("Read More");
                $elem.removeClass("full").addClass("short");
            }
        });
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    });

</script>