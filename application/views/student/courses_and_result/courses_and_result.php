<div class="ibox float-e-margins">
    <div class="ibox-title">

        <div class="col-md-9"><h4>Courses & Result</h4>     </div>
        <div class="col-md-3 has-success"> 

            <select class="form-control required" name="YSESSION_ID" id="YSESSION_ID" data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
                <option value="">--Select Session--</option>
                <?php foreach ($session as $row) { ?>
                <option
                value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME ;?></option>
                <?php } ?>
            </select> 
        </div> 
    </div>
    <div class="ibox-content"> 
            <div id="applicantList"> <span class='text-warning'> <b>Please select academic session to see courses and result.</b> </span> </div>
    </div>
</div>


<script type="text/javascript">


    $(document).on("change", "#YSESSION_ID", function () {

        var YSESSION_ID = $("#YSESSION_ID").val();

        if(YSESSION_ID == '')
        { 
            $("#applicantList").html("<span class='text-warning'><b>No record found</b></sapn>");

        } else {

            $.ajax({
                type: "POST",
                data: {YSESSION_ID:YSESSION_ID},
                url: "<?php echo site_url(); ?>/student/coursesBySemester",
                beforeSend: function () {
                    $("#applicantList").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                },
                success: function (data) {
                    $("#applicantList").html(data);
                }
            });
        }

    });
   
</script>