<?php if (!empty($cmt_by_post_id)) foreach ($cmt_by_post_id as $row): ?>
    <div class="social-feed-box">
        <div class="social-avatar">
            <a class="pull-left" href="#">
                <?php $user_img=($row->USER_IMG !='')? 'upload/faculty_teacher/'.$row->USER_IMG : 'assets/img/default.png' ?>
                <img src="<?php echo base_url($user_img) ?>" alt="image">
            </a>

            <div class="media-body">
                <a href="">
                    <?php echo $row->FULL_NAME ?>
                </a>
                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
            </div>
        </div>
        <div class="social-body">
            <p>
                <?php echo $row->CMT_COMMENT ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>