<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>

        <th>#SL</th>
        <th>Blog Title</th>
        <th>Subtitle</th>
        <th>Discription</th>
        <th>Banner</th>
        <th>Approve/Reject</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($pending_post)) $sl = 1;
    foreach ($pending_post as $row): ?>
        <tr id="row_<?php echo $row->POST_ID ?>"
            style="background-color:<?php echo ($row->APPROVE_BY_ADMIN == 1) ? 'lightYellow' : ''; ?>">

            <td><?php echo $sl++; ?></td>
            <td><?php echo $row->POST_TITLE ?></td>
            <td><?php echo $row->POST_SUB_TITLE ?></td>
            <td><?php echo $row->POST_CONTENT ?></td>
            <td>
                <?php if (!empty($row->POST_BANNER)){ ?>
                <img width="100%" src="<?php echo base_url(); ?>upload/blog_banner/<?php echo $row->POST_BANNER ?>"/>
            </td>
            <?php } ?>
            <td class="text-center">
                <?php if ($row->APPROVE_BY_ADMIN == 0) { ?>
                    <span id="btn_<?php echo $row->POST_ID ?>" postid="<?php echo $row->POST_ID ?>"
                          approve_status="<?php echo $row->APPROVE_BY_ADMIN ?>" class="btn btn-xs btn-info apvPost">Approve</span>
                <?php } else { ?>
                    <span id="btn_<?php echo $row->POST_ID ?>" postid="<?php echo $row->POST_ID ?>"
                          approve_status="<?php echo $row->APPROVE_BY_ADMIN ?>" class="btn btn-xs btn-danger apvPost">Reject</span>
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    $(".apvPost").on('click', function () {
        var post_id = $(this).attr('postid');
        var approve_status = $(this).attr('approve_status');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>teacher/apvRejBlogPost',
            data: {post_id: post_id, approve_status: approve_status},
            success: function (data) {

                if (data == 1) {
                    $('#row_' + post_id).css('background-color', 'lightYellow');
                    $("#btn_" + post_id).addClass('btn-danger').text('Reject');
                    $("#btn_" + post_id).attr('approve_status', data);


                } else {
                    $('#row_' + post_id).css('background-color', '');
                    $("#btn_" + post_id).removeClass('btn-danger');
                    $("#btn_" + post_id).addClass('btn-info').text('Approve');
                    $("#btn_" + post_id).attr('approve_status', data);
                }

            }

        });
    });
</script>