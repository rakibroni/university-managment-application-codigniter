<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Class Schedule</h5>

        <div class="ibox-tools"></div>
    </div>
    <div class="ibox-content">
        <div id="weekly_sch">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="30%" class="text-center">Subject</th>
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
                <?php
                /*echo "<pre>";
                print_r($student_info);
                exit();*/
                foreach ($reg_course as $row):

                    $schedule_details = $this->db->query("select a.*,b.FULL_NAME,c.BR_NAME,c.BR_CODE from sc_schedule a
                                            left join sa_users b on a.MODERATOR_ID=b.USER_ID
                                            left join sc_building_room c on a.ROOM_ID=c.BR_ID
                                            WHERE  a.COURSE_ID=$row->COURSE_ID and a.PROGRAM_ID=$student_info->PROGRAM_ID and a.SESSION_ID=$student_info->SEM_SESSION and a.SEMESTER_ID=$student_info->SEMESTER_ID")->row();

                    ?>
                    <tr>
                        <?php if (!empty($schedule_details)): ?>
                            <td style="background-color:"><?php echo $row->COURSE_TITLE ?></td>
                            <td style="background-color:<?php echo ($schedule_details->SAT == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->SAT == '1'): ?>
                                    <span
                                        style="font-size: 9px">
                            <?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->SUN == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->SUN == '1'): ?>
                                    <span
                                        style="font-size: 9px">
                                <?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->MON == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->MON == '1'): ?>
                                    <span
                                        style="font-size: 9px">
                                <?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->TUE == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->TUE == '1'): ?>
                                    <span style="font-size: 9px">
                                <?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->WED == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->WED == '1'): ?>
                                    <span
                                        style="font-size: 9px"><?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->THU == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->THU == '1'): ?>
                                    <span
                                        style="font-size: 9px"><?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:<?php echo ($schedule_details->FRI == '1') ? 'lightgoldenrodyellow' : ''; ?>">
                                <?php if ($schedule_details->FRI == '1'): ?>
                                    <span
                                        style="font-size: 9px"><?php echo date('H:i A', strtotime($schedule_details->START_TIME)) . ' - ' . date('H:i A', strtotime($schedule_details->END_TIME)) ?>
                                        <br>Room : <?php echo $schedule_details->BR_NAME . '[' . $schedule_details->BR_CODE . ']' ?>
                                        <br><b><?php echo $schedule_details->FULL_NAME ?></b>
                        </span>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>