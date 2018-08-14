<div id="dep_form">
<div class="col-lg-12">
    <div class="ibox-title">
        <h5>Bank Deposit No.</h5>

    </div>
    <div class="ibox-content">
        <p>Please click this button to enter your payment deposit no.</p>
        <?php if(!empty( $exam->EXAM_ID)) {?>
        <button id="dep_btn"  data-exam-id="<?php echo $exam->EXAM_ID ?>" class="btn btn-primary btn-sm">Deposit Now</button>
        <?php } ?>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){

        $("#dep_btn").on('click',function(){
            var exam_id=$(this).attr("data-exam-id");
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>student/studentDeposit',
                data:{exam_id:exam_id},
                success:function(data){
                   if(data){
                       $("#dep_form").html(data);                   }
                }

            });
        });
    });

</script>
