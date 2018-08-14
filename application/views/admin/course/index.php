<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> -->
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Course List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Course Create" class="btn btn-primary btn-xs pull-right openModal"
            data-action="course/courseFormInsert"> Add New </span>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">

     <table class="table table-bordered" id="posts">
        <thead>
         <th>#</th>
         <th>Course Code</th>
         <th>Title</th>
         <th>Dept</th>
         <th>Action</th>

     </thead>
     <tbody></tbody>                
 </table>
</div>
</div>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> -->
<script type="text/javascript"> 
    $(document).ready(function() {
 
         var   table=$('#posts').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax":{
                        "url": "<?php echo site_url('course/ajaxCourseList') ?>",
                        "dataType": "json",
                        "type": "POST",
                        "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    },
                    "columns": [
                    {"data": "COURSE_ID"}, 
                    {"data": "COURSE_CODE"}, 
                    {"data": "COURSE_TITLE"},
                    {"data": "DEPT_NAME","orderable": false},
                    {"data": "ACTION", "orderable": false}

                    ] , 
    });


    $(document).on("click", ".deleteCourse", function () {
            if (confirm("Are You Sure?")) {
                var item_id = $(this).attr("id");
                var data_field = $(this).attr("data-field");
                var data_tbl = $(this).attr("data-tbl");
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('setup/deleteItem'); ?>/",
                    data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                    beforeSend: function () {
                        //$("#loader_" + item_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        if (data == "Y") {
                            table.ajax.reload(null,false);
                            //$("#row_" + item_id).remove();
                        } else {
                            alert("Row Delete Field");
                        }
                    }
                });
            } else {
                return false;
            }
        });
    }); 
</script>

