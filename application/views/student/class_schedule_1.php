<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title"><h5>Class Schedule</h5></div>
                <div class="ibox-content">

                    <div class="pull-right">
                        <span id="sch_back" class="btn btn-xs btn-default"><i class="fa fa-chevron-left"></i></span>
                        <span id="sch_forward" class="btn btn-xs btn-default"><i class="fa fa-chevron-right"></i></span>
                    </div>
                    <br>
                    <br>

                    <div id="weekly_sch">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center " width="30%">Subject</th>
                                <th class="text-center" width="10%">SAT</th>
                                <th class="text-center" width="10%">SUN</th>
                                <th class="text-center" width="10%">MON</th>
                                <th class="text-center" width="10%">TUE</th>
                                <th class="text-center" width="10%">WED</th>
                                <th class="text-center" width="10%">THU</th>
                                <th class="text-center" width="10%">FRI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($schedule)):
                                $start = "";
                                $end = "";
                                $room = "";
                                $week = array("SAT", "SUN", "MON", "TUE", "WED", "THU", "FRI");
                                foreach ($schedule as $row):
                                    $sc_days = explode(",", $row->DAYS);
                                    $class_start = explode(",", $row->CLASS_START);
                                    $class_end = explode(",", $row->CLASS_END);
                                    $building = explode(",", $row->BUILDING);
                                    $teachers = explode(",", $row->TEACHER);
                                    ?>
                                    <tr>
                                        <td style=" vertical-align: middle"><?php echo $row->COURSE_TITLE ?></td>
                                        <?php foreach ($week as $key => $value): ?>
                                            <td style=" text-align:justify; background-color:  <?php
                                            if (in_array($value, $sc_days)) {
                                                $i = array_search($value, $sc_days);
                                                echo "lightgoldenrodyellow";
                                            }
                                            ?>" class="text-center">
                                                <?php
                                                if (in_array($value, $sc_days)) {
                                                    $i = array_search($value, $sc_days);
                                                    echo ' <b><span style="font-size: 9px;color:green" >' . date('h:i A', strtotime($class_start[$i])) . ' - ' .
                                                        date('h:i A', strtotime($class_end[$i])) . '</span></b><br>
                                                            <span style="font-size: 9px">Room - ' . $building[$i] . '</span><br>
                                                            <span style="font-size: 9px">' . $teachers[$i] . '</span>';
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#sch_forward').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>student/weeklySch',
            data: {},
            beforeSend: function () {

                $('#weekly_sch').html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $('#weekly_sch').html(data);
            }
        });
    });
</script>
