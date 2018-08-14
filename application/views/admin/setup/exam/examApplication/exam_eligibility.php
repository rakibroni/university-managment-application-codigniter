
<style type="text/css">

    table#grade_sheet_search_tbl {
        width: 100%;
        padding:  0px !important;
        background-color: #f1f1c1;
    }
    table#interpretation_tbl th, td {
        padding: 3px !important;

    }
</style>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Eligibility</h5>
    </div>
    <form action="<?php echo site_url() ?>" id="exam_eligibility" method="POST">
        <div class="ibox-content">
            <table id="grade_sheet_search_tbl"  style="width: 100%;" cellpadding="5">
                <tr>
                    <td class="col-md-6">
                        <select class="form-control" name="EX_APP_ID" id="EX_APP_ID">
                            <option value="0">--Exam--</option>
                            <?php foreach ($exam_application as $row) {?>
                            <option value="<?php echo $row->EX_APP_ID ?>"><?php echo $row->EXAM_APP_TITLE ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="col-md-6">
                        <select class="form-control faculty_dropdown" name="FACULTY_ID" id="FACULTY_ID">
                            <option value="0">--Faculty--</option>
                            <?php foreach ($faculty as $row) { ?>
                            <option value="<?php echo $row->FACULTY_ID ?>"><?php echo $row->FACULTY_NAME ?></option>
                            <?php  } ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-5">
                        <select class="form-control dept_dropdown" name="DEPT_ID" id="DEPT_ID">
                            <option value="0">--Department--</option>
                        </select>
                    </td>
                    <td class="col-md-5">
                        <select class="form-control program_dropdown " name="PROGRAM_ID" id="PROGRAM_ID">
                            <option value="0">--Program--</option>
                        </select>
                    </td>

                    <td class="text-center col-md-2"  >
                    <span class="btn btn-xs btn-primary" id="eligibility_search_btn"><i class="fa fa-search"></i> Search</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="ibox-content">
            <div id="eligibility_div"></div>
        </div>

    </form>
</div>

<script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change','#DEPT_ID',function(){
            dept_id=$(this).val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/deptWiseTeacherList') ?>',
                data: {dept_id:dept_id},
                beforeSend: function () {
                    $("#TEACHER_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#TEACHER_ID").html(data);

                }
            });
        });

        $(document).on('change','#PROGRAM_ID',function(){
            program_id=$(this).val();
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('common/programWiseBatch') ?>',
                data: {program_id:program_id},
                beforeSend: function () {
                    $("#BATCH_ID").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $(".loadingImg").html("");
                    $("#BATCH_ID").html(data);

                }
            });
        });

        $(document).on('click','#eligibility_search_btn', function(){
            var
            EX_APP_ID=$("#EX_APP_ID").val();
            FACULTY_ID=$("#FACULTY_ID").val();
            DEPT_ID=$("#DEPT_ID").val();
            PROGRAM_ID=$("#PROGRAM_ID").val(); 

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('exam/eligibilityStudentList') ?>',
                data: {
                    EX_APP_ID:EX_APP_ID,
                    FACULTY_ID:FACULTY_ID,
                    DEPT_ID:DEPT_ID,
                    PROGRAM_ID:PROGRAM_ID 
                },
                beforeSend: function () {
                    $("#eligibility_div").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#eligibility_div").html(data);
                }
            });
        });
    });

</script>