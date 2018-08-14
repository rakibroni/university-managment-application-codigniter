<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Finance List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Finance Rate Create" class="btn btn-primary btn-xs pull-right openBigModal"
                                  data-action="finance/financeRateInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/financeRate/finance_rate_list"); ?>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);
    });

    $("#for_all_program").click(function(){
        $('#PROGRAM_ID').prop("disabled", true);;
    });



    $(document).on('click','#PREVIOUS_SESSION_STATUS',function(){
        var status=$(this).val();
        if(status =='YES'){ 

            var program_id=$("#PROGRAM_ID").val();
            
            if(program_id ==''){
                alert("Please select program");
                $("#PROGRAM_ID").focus();

            }else{
                $("#rate_same_as").show();
                var url = '<?php echo site_url('finance/sessionListAlreadyRated') ?>';
                
                $.ajax({
                    type: "POST",
                    url: url,
                    data:{program_id:program_id},                
                    success: function (data) {
                        $('#PREVIOUS_YSESSION').html(data);
                    }
                }); 
            }


        }else{

            $("#rate_same_as").hide();
        }
    });
    $(document).on('change','#PREVIOUS_YSESSION',function(){
        var PROGRAM_ID=$("#PROGRAM_ID").val();
        var PREVIOUS_YSESSION=$(this).val();
        var url = '<?php echo site_url('finance/chargeRateProSesWise') ?>';
                
        $.ajax({
            type: "POST",
            url: url,
            data:{PROGRAM_ID:PROGRAM_ID,PREVIOUS_YSESSION:PREVIOUS_YSESSION},                
            success: function (data) {
                $('#charge_table').html(data);
            }
        }); 
    });

</script>
