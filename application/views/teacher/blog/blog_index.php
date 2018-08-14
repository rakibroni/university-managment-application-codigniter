<div class="row">
    <div class="ibox-title">
        <h4>Blog List</h4>
    </div>

    <div class="ibox-content">
        <div class="col-md-8">
            <?php if (!empty($blog_list)) {
                foreach ($blog_list as $row) { ?>
                    <h2><?php echo $row->POST_TITLE ?></h2>
                    <h5><?php echo $row->POST_SUB_TITLE ?></h5>

                    <p><?php echo $row->POST_CONTENT ?>&nbsp;&nbsp;<a
                            href="<?php echo base_url() ?>teacher/blogDetails/<?php echo $row->POST_ID ?>">Read
                            More...</a></p>
                    <div>
                        <p>Tags:
                            <?php $tag = (explode(",", $row->POST_TAGS));
                            foreach ($tag as $key => $value): ?>
                                <a href="#"><span class="label label-info"><?php echo $value ?></span></a>
                            <?php endforeach; ?>
                            | <i class="icon-user"></i> <a href="#"><?php echo $row->FULL_NAME_EN ?></a>
                            | <i
                                class="icon-calendar"></i> <?php echo date('M-d-y  h:i:sa', strtotime($row->ENTRY_TIMESTAMP)) ?>
                            | <i class="icon-comment"></i> <a href="#"
                                                              id="cmt"><?php echo $this->db->query("select count(a.POST_ID) as tc FROM blog_post_comment a where a.POST_ID=$row->POST_ID")->row()->tc; ?>
                                Comments</a>

                        </p>
                    </div>
                    <hr>
                <?php
                }
            }
            ?>
            <script type="text/javascript">
                $("#cmt").on('click', function () {
                    $("#cmt_details").toggle();
                });
            </script>
            <div id="cmt_details" style="display:none">
                <p>This is paragraph</p>
                <input type="text" class="form-control">
            </div>


        </div>
        <div class="col-lg-4">
            <div class="well">
                <h4><i class="fa fa-search"></i> Blog Search...</h4>

                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-sm" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </div>
            <!-- /well -->
            <div class="well">
                <h4><i class="fa fa-tags"></i> Popular Tags:</h4>

                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href=""><span class="badge badge-info">Windows 8</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">C#</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">Windows Forms</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">WPF</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href=""><span class="badge badge-info">Bootstrap</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">Joomla!</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">CMS</span></a>
                            </li>
                            <li><a href=""><span class="badge badge-info">Java</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /well -->
            <div class="well">
                <h4><i class="fa fa-thumbs-o-up"></i> Follow me!</h4>
                <ul>
                    <p><a title="Facebook" href=""><span class="fa-stack fa-lg"><i
                                    class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-facebook fa-stack-1x"></i></span></a> <a title="Twitter" href=""><span
                                class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-twitter fa-stack-1x"></i></span></a> <a title="Google+" href=""><span
                                class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-google-plus fa-stack-1x"></i></span></a> <a title="Linkedin"
                                                                                             href=""><span
                                class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-linkedin fa-stack-1x"></i></span></a> <a title="GitHub" href=""><span
                                class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-github fa-stack-1x"></i></span></a> <a title="Bitbucket" href=""><span
                                class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                                    class="fa fa-bitbucket fa-stack-1x"></i></span></a></p>
                </ul>
            </div>
            <!-- /well -->
            <!-- /well -->
            <div class="well">
                <h4><i class="fa fa-fire"></i> Popular Posts:</h4>
                <ul>
                    <?php foreach ($blog_list as $row) {
                        echo ' <li><a href="">' . $row->POST_TITLE . '</a></li>';
                    } ?>


                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


</div>


<!-- /well -->