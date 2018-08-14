<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/plugins/jQueryUI/jquery-ui.css">

<?php date_default_timezone_set('Asia/Dhaka'); ?>

<form class="form-horizontal" method="post" action="<?php echo base_url()?>Portal/signUpForm">
    <div class="col-md-12">
        <div class="widget-main">
            <div class="widget-inner shortcode-typo">
                <div class="row">

                    <div class="col-md-3"></div>
                    <div class="col-md-12 form-horizontal  bd-col">

                        <div class="ibox-content">
                            <h3 class="text-center"><?php echo $degrees->DEGREE_NAME ?> Offered Program List</h3><hr>

                            <table class="table table-striped table-bordered table-hover gridTable">
                                <thead>
                                <tr>
                                    <th>Program Name</th>
                                    <th>Application</th>
                                    <th>Exam Date</th>
                                    <th>Exam Time</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($programs as $row) { ?>
                                    <tr class="gradeX" id="row_<?php echo $row->PROGRAM_ID; ?>">
                                        <td><b><?php echo $row->PROGRAM_NAME; ?></b></td>
                                        <td>
                                            <?php $dateStr = strtotime( $row->REG_PRG_SDT ); ?>
                                            <?php echo date("d-M-Y", $dateStr ); ?>
                                            <b><?php echo 'to'; ?></b>
                                            <?php $dateStr = strtotime( $row->REG_PRG_EDT ); ?>
                                            <?php echo date("d-M-Y", $dateStr ); ?>
                                        </td>
                                        <td>
                                            <?php $dateStr = strtotime( $row->PRG_EXM_SDT ); ?>
                                            <?php echo date("d-M-Y", $dateStr ); ?>
                                            <b><?php echo 'to'; ?></b>
                                            <?php $dateStr = strtotime( $row->PRG_EXM_EDT ); ?>
                                            <?php echo date("d-M-Y", $dateStr ); ?>
                                        </td>
                                        <td>
                                            <?php $dateStr = strtotime( $row->PRG_EXM_STM ); ?>
                                            <?php echo date("H:i:s", $dateStr ); ?>
                                            <b><?php echo 'to'; ?></b>
                                            <?php $dateStr = strtotime( $row->PRG_EXM_ETM ); ?>
                                            <?php echo date("H:i:s", $dateStr ); ?>
                                        </td>

                                        <?php
                                            $today = date("Y-m-d H:i:s");
                                            $reg_end_date = $row->REG_PRG_EDT;
                                        ?>

                                        <?php if ($today <= $reg_end_date) : ?>
                                        <td><a class="label label-success" data-type="edit" href="<?php echo base_url() . "Portal/signUpForm/" . $row->PROGRAM_ID?>">Apply Now</a>
                                        </td>
                                        <?php else : ?>
                                        <td><a id="over" class="label label-default" data-type="" href="#">Date Over</a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

</div>
<br clear="all"/>

</div>
</div>  
</div>
<div class="col-md-2"></div>
</div>
</div>
</div>
</div>
</form>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        $('body').on('keyup', '.numericOnly', function () {
            var val = $(this).val();
            $(this).val(val.replace(/[^\d]/g, ''));
        });
        
    });
    $( function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd-mm-yy' ,
          yearRange: "-50:+0",
      });
    } );

    $(document).ready(function () {

        $('body').on('click', '#over', function () {
            alert("Opps! Application Date Over !");
        });

    });
</script>