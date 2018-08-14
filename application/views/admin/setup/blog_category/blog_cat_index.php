<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Blog Category List</h5>

        <div class="ibox-tools">
                        <span title="Create Blog Category" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/addBlogCat"> Add New </span>
        </div>

    </div>
    <div class="ibox-content">
            <?php $this->load->view("admin/setup/blog_category/blog_cat_list"); ?>
    </div>
</div>
