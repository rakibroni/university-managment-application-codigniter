<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><?php echo $dep_name->DEPT_NAME; ?>  Course List</h5>
          <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Department Wise Course Create" class="btn btn-primary btn-xs pull-right openModal"
            data-action="course/departmentWiseCourseInsert"> Add New </span>
        </div>
         <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/course/dep_wise_course_list"); ?>
        </div>

    </div>
</div>
