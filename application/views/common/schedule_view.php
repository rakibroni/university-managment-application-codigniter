<?php
if (!empty($roomSchedule)) {
    foreach ($roomSchedule as $schedule) {
        if (($schedule->SAT_ST_TIME != null) || ($schedule->SAT_END_TIME != null)) {
            $sc_sat_text = date("h:i", strtotime($schedule->SAT_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->SAT_END_TIME));
        } else {
            $sc_sat_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->SUN_ST_TIME != null) || ($schedule->SUN_END_TIME != null)) {
            $sc_sun_text = date("h:i", strtotime($schedule->SUN_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->SUN_END_TIME));
        } else {
            $sc_sun_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->MON_ST_TIME != null) || ($schedule->MON_END_TIME != null)) {
            $sc_mon_text = date("h:i", strtotime($schedule->MON_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->MON_END_TIME));
        } else {
            $sc_mon_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->TUE_ST_TIME != null) || ($schedule->TUE_END_TIME != null)) {
            $sc_tue_text = date("h:i", strtotime($schedule->TUE_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->TUE_END_TIME));
        } else {
            $sc_tue_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->WED_ST_TIME != null) || ($schedule->WED_END_TIME != null)) {
            $sc_wed_text = date("h:i", strtotime($schedule->WED_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->WED_END_TIME));
        } else {
            $sc_wed_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->THU_ST_TIME != null) || ($schedule->THU_END_TIME != null)) {
            $sc_thu_text = date("h:i", strtotime($schedule->THU_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->THU_END_TIME));
        } else {
            $sc_thu_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }

        if (($schedule->FRI_ST_TIME != null) || ($schedule->FRI_END_TIME != null)) {
            $sc_fri_text = date("h:i", strtotime($schedule->FRI_ST_TIME)) . "<br />" . date("h:i", strtotime($schedule->FRI_END_TIME));
        } else {
            $sc_fri_text = date("h:i", strtotime($schedule->START_TIME)) . "<br />" . date("h:i", strtotime($schedule->END_TIME));
        }
        ?>
        <div style="padding:10px; margin-top:10px;" class="bg-info">
            <div class="text-danger">SUBJECT: <?php echo $schedule->COURSE_TITLE; ?></div>
            <div>Room: <?php echo $schedule->B_ROOM; ?></div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="10%" class="text-center">SAT</th>
                    <th width="10%" class="text-center">SUN</th>
                    <th width="10%" class="text-center">MON</th>
                    <th width="10%" class="text-center">TUE</th>
                    <th width="10%" class="text-center">WED</th>
                    <th width="10%" class="text-center">THU</th>
                    <th width="10%" class="text-center">FRI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo ($schedule->SAT == 1) ? $sc_sat_text : ""; ?></td>
                    <td><?php echo ($schedule->SUN == 1) ? $sc_sun_text : ""; ?></td>
                    <td><?php echo ($schedule->MON == 1) ? $sc_mon_text : ""; ?></td>
                    <td><?php echo ($schedule->TUE == 1) ? $sc_tue_text : ""; ?></td>
                    <td><?php echo ($schedule->WED == 1) ? $sc_wed_text : ""; ?></td>
                    <td><?php echo ($schedule->THU == 1) ? $sc_thu_text : ""; ?></td>
                    <td><?php echo ($schedule->FRI == 1) ? $sc_fri_text : ""; ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    }
} else {
    echo "<h4 class='alert alert-info'>No Schedule Found</h4>";
}
?>