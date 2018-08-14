
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Employee List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <a href="<?php echo site_url()?>/employee/employeeListPdf" target="_blank" class="btn btn-danger btn-xs pull-right "><i class="fa fa-file-pdf-o"></i> Print</a>
            <a   class="btn btn-primary btn-xs pull-right " href="<?php echo site_url()?>/employee/empFormInsert">Add New </a>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div id="printArea" class="table-responsive contentArea">
            <?php $this->load->view("admin/emp/emp_list"); ?>
        </div>
    </div>
</div>
