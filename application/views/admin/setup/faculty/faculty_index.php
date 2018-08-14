
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Faculty List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">            
            <span title="Faculty Create" class="btn btn-primary btn-xs pull-right openModal" data-action="setup/facultyFormInsert">Add New </span>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div id="printArea" class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/faculty/faculty_list"); ?>
        </div>
    </div>
</div>
