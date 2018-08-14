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
        <h4>Blog List <a class="btn btn-primary btn-xs pull-right" href="<?php
        echo base_url(); ?>teacher/addBlog"> Add </a></h4>
    </div>
    <div class="ibox-content">

        <table class="table table-striped table-bordered table-hover gridTable ">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                 
                <th>Desc</th>
                <th>Banner</th>
                <th>Remarks</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($blog_list)) $sl = 1;
            foreach ($blog_list as $row): ?>
            <tr id="row_<?php echo $row->POST_ID ?>" <?php echo ($row->APPROVE_BY_ADMIN == 1) ? 'lightYellow' : ''; ?>>
                <td width="5%">

                    &nbsp;<?php echo $sl++; ?>
                </td>
                <td width="10%">
                    <div class="small">
                        <div class="text short">
                            <?php echo $row->POST_TITLE ?>
                        </div>
                        <a href="#" class="read-more">Read more..</a>
                    </div>
                </td>
                 
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
                            <?php if (!empty($row->POST_BANNER)){ ?>
                            <img width="40%"
                                 src="<?php echo base_url(); ?>upload/blog_banner/<?php echo $row->POST_BANNER ?>"/>
                </td>
                <?php } ?>
                </a>

    </div>
    <td width="20%"> <?php echo $row->REMARKS ?></td>
    <td width="10%"><?php echo ($row->PUBLISH_DT == '') ? '' : date('m/d/Y', strtotime($row->PUBLISH_DT)) ?></td>
    <td width="10%" class="text-center">

        <?php echo ($row->APPROVE_BY_ADMIN == 0) ? '<span class="label">Do Nothing</span>' : ''; ?>
        <?php echo ($row->APPROVE_BY_ADMIN == 1) ? '<span class="btn "><span class="label label-success">Published</span></span>' : ''; ?>
        <?php echo ($row->APPROVE_BY_ADMIN == 2) ? '<span class="label label-primary">Review</span>' : ''; ?>
        <?php echo ($row->APPROVE_BY_ADMIN == 3) ? '<span class="label label-danger">Reject</span>' : ''; ?>
        <?php echo ($row->APPROVE_BY_ADMIN == 4) ? '<span class="label label-warning">Pending</span>' : ''; ?>


    </td>
    <td><a href="<?php echo base_url() ?>teacher/editBlog/<?php echo $row->POST_ID ?>" class="label label-default "><i
                class="fa fa-pencil"></i></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>


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