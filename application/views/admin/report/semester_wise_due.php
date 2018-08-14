<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-md-12 text-center " style="visibility: visible; animation-name: fadeInRight; top:-20px;">
        <h2>Faculty of <?php echo $faculty->FACULTY_NAME; ?></h2>

        <h3>Department of <?php echo $dept->DEPT_NAME; ?></h3>
        <h4><?php echo $program->PROGRAM_NAME; ?></h4>
        <h4><?php echo $degree->DEGREE_NAME; ?></h4>

        <p><?php echo $semester->SEMESTER_NAME; ?>
            || <?php echo $session->SESSION_NAME . " (" . $session->YEAR_SETUP_TITLE . ")"; ?></p>
    </div>
    <?php if (!empty($semester_due)): ?>
        <div class="table-responsive ">
            <table class="table table-striped table-bordered table-hover gridTable">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>STUDENT ID</th>
                    <th>NAME</th>
                    <th>PARTICULARS</th>
                    <th>DEBIT</th>
                    <th>CREDIT</th>
                    <th>DUE</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                $due = 0;
                ?>
                <?php foreach ($semester_due as $row): ?>
                    <?php
                    $due = $row->CR - $row->DR;
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $row->STUDENT_ID; ?></td>
                        <td><?php echo $row->FULL_NAME_EN; ?></td>
                        <td>
                            <?php
                            $particulr = $this->db->query("SELECT  DISTINCT ac.CHARGE_NAME, pp.PARTICULAR_AMOUNT
                                                            FROM bm_vouchermst bv
                                                            INNER JOIN ac_program_particulars pp on (pp.FACULTY_ID = bv.FACULTY_ID AND pp.DEPT_ID = bv.DEPT_ID AND pp.PROGRAM_ID = bv.PROGRAM_ID AND pp.SESSION_ID = bv.SESSION_ID AND pp.SEMESTER_ID = bv.SEMESTER_ID)
                                                            INNER JOIN ac_academic_charge ac on ac.CHARGE_ID = pp.PARTICULAR_ID
                                                            WHERE  bv.STUDENT_ID = $row->STUDENT_ID")->result();
                            $max = 1;
                            foreach ($particulr as $pr) {
                                echo $pr->CHARGE_NAME . ": " . $pr->PARTICULAR_AMOUNT;
                                if ($max == sizeof($particulr)) {

                                } else {
                                    echo "<hr style='margin-top: 5px; margin-bottom: 5px;'>";
                                }
                                $max++;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row->CR == '') {
                                echo '0';
                            } else {
                                echo $row->CR;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row->DR == '') {
                                echo '0';
                            } else {
                                echo $row->DR;
                            }
                            ?>
                        </td>
                        <td><?php echo $due; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php
    else:
        echo "<p class='text-center text-danger'> No data found !!</p>";
    endif;
    ?>
</div>
