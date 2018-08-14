<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Course Category List</h5>

        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Course Category Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="Course/courseCatFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/course_category/course_category_list"); ?>
        </div>

    </div>
</div>
