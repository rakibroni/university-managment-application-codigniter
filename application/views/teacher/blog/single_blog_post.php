<td><?php echo $blog_post->POST_TITLE ?></td>
<td><?php echo $blog_post->POST_SUB_TITLE ?></td>
<td><?php echo $blog_post->POST_CONTENT ?></td>
<td>
    <?php if (!empty($blog_post->POST_BANNER)){ ?>
    <img width="100%" src="<?php echo base_url(); ?>upload/blog_banner/<?php echo $blog_post->POST_BANNER ?>"/></td>
<?php } ?>
<td class="text-center">
    <span id="<?php echo $blog_post->POST_ID ?>" approve_status="<?php echo $blog_post->APPROVE_BY_ADMIN ?>"
          class="btn btn-xs btn-info apvPost"><i class="fa fa-check"></i></span>

</td>
        