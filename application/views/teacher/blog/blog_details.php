<?php
if (!empty($blog_details)): ?>
    <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">
                <div class="pull-right">
                     <?php if ($user_id == $blog_details->ENTERED_BY) { ?>
                        <a href="<?php echo base_url(); ?>teacher/editBlog/<?php echo $blog_details->POST_ID ?>"
                           class="btn   btn-xs  btn-warning">Update Blog</a>
                     <?php  }  ?>
                </div>
                <div class="text-center article-title">
                    <span class="text-muted"><i
                            class="fa fa-clock-o"></i> <?php echo date('M-d-y h:i:sa', strtotime($blog_details->ENTRY_TIMESTAMP)) ?></span>

                    <h1>
                        <?php echo $blog_details->POST_TITLE ?>
                    </h1>
                </div>
                <?php if (!empty($blog_details->POST_BANNER)) { ?>
                    <img style="width:100%;height:200px;margin-bottom:50px"
                         src="<?php echo base_url(); ?>upload/blog_banner/<?php echo $blog_details->POST_BANNER ?>">
                <?php } ?>
                <p>
                    <?php echo $blog_details->POST_CONTENT ?>
                    <input type="hidden" value="<?php echo $blog_details->POST_ID ?>" id="POST_ID">
                </p>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Tags:</h5>
                        <?php
                        $tag = (explode(",", $blog_details->POST_TAGS));
                        foreach ($tag as $key => $value): ?>

                            <button type="button" class="btn btn-primary btn-xs"><?php
                                echo $value ?></button>
                        <?php
                        endforeach; ?>


                    </div>
                    <div class="col-md-6">
                        <div class="small text-right">
                            <h5>Stats:</h5>

                            <div>
                                <i class="fa fa-comments-o"> </i> <?php echo $this->db->query("select count(a.POST_ID) as tc FROM blog_post_comment a where a.POST_ID=$blog_details->POST_ID")->row()->tc; ?>
                                comments
                            </div>
                            <i class="fa fa-eye"> </i> 144 views
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <h2>Comments:</h2>
                        <span id="comment_list"><?php $this->load->view('teacher/blog/comment_by_post_id'); ?></span>

                        <?php if($user_id !=''){ ?>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a class="pull-left" href="#">
                                    <?php $user_img=($blog_details->USER_IMG !='')? 'upload/faculty_teacher/'.$row->USER_IMG : 'assets/img/default.png' ?>
                                        <img
                                            src="<?php echo base_url($user_img) ?>"
                                            alt="image">

                                </a>

                                <div class="media-body">
                                    <a href="">
                                        <?php if (!empty($blog_details->FULL_NAME)) echo $blog_details->FULL_NAME ?>
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <input type="text" class="form-control cmt">
                            </div>
                        </div>
                        <?php } ?>


                    </div>
                </div>


            </div>
        </div>
    </div>

    </div>
<?php
endif; ?>
<script type="text/javascript">
    $(".cmt").keyup(function (e) {
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        if (code == 13) {
            var post_id = $('#POST_ID').val();
            var comment = $(this).val();
            $(this).val("");
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>teacher/blogComment',
                data: {post_id: post_id, comment: comment},
                beforSend: function () {

                },
                success: function (data) {
                    if (data) {
                        $("#comment_list").html(data);

                    }
                }

            });
        }

    });

</script>