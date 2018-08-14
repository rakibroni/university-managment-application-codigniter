<?php if (!empty($appList)): ?>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Student Id</th>
            <th>Semester</th>
            <th>Session</th>
            <th>Program</th>
            <th>Department</th>
            <th>Payment Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($appList as $row):
            ?>
            <tr class="gradeX" id="row_<?php echo $row->STUDENT_ID; ?>">
                <td>
                    <input type="hidden" value="<?php echo $row->EXAM_ID ?>"
                           name="examId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->FACULTY_ID; ?>"
                           name="facultyId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->DEPT_ID; ?>"
                           name="deptId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->PROGRAM_ID; ?>"
                           name="programId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->SESSION_ID;?>"
                           name="sessionId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->SEMESTER_ID;?>"
                           name="semesterId_<?php echo $row->STUDENT_ID ?>">
                    <input type="hidden" value="<?php echo $row->BATCH_ID;?>"
                           name="batchId_<?php echo $row->STUDENT_ID ?>">
                    <input type="checkbox" class="form-control required check" name="studentId[]"
                           value="<?php echo $row->STUDENT_ID; ?>"/>
                </td>
                <td><?php echo $row->STUDENT_ID; ?></td>
                <td><?php echo $row->SEMESTER_NAME; ?></td>
                <td><?php echo $row->SESSION_NAME . " (" . $row->YEAR_SETUP_TITLE . ")"; ?></td>
                <td><?php echo $row->PROGRAM_NAME; ?></td>
                <td><?php echo $row->DEPT_NAME; ?></td>
                <td>
                    <?php
                    $DR_Money = $this->db->query("SELECT sum(bvl.DR_AMT)DR_AMT
                                                        FROM bm_vn_ledgers bvl
                                                        INNER JOIN bm_vouchermst bv on bv.VOUCHER_NO = bvl.VOUCHER_NO
                                                        WHERE bv.STUDENT_ID = $row->STUDENT_ID AND bvl.TRX_CODE_NO = 'PM'")->row();
                    $CR_Money = $this->db->query("SELECT sum(bvl.CR_AMT) CR_AMT
                                                        FROM bm_vn_ledgers bvl
                                                        INNER JOIN bm_vouchermst bv on bv.VOUCHER_NO = bvl.VOUCHER_NO
                                                        WHERE bv.STUDENT_ID = $row->STUDENT_ID AND bvl.TRX_CODE_NO = 'GR'")->row();
                    if ($CR_Money->CR_AMT == $DR_Money->DR_AMT) {
                        echo "<a class='label label-primary'>Paid</a>";
                    } else if ($CR_Money->CR_AMT > $DR_Money->DR_AMT) {
                        echo "<a class='label label-danger'>Due</a></br> ";
                    } else if ($CR_Money->CR_AMT < $DR_Money->DR_AMT) {
                        echo "<a class='label label-success'>Advance</a>";
                    }
                    ?>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Student Id</th>
            <th>Semester</th>
            <th>Session</th>
            <th>Program</th>
            <th>Department</th>
            <th>Payment Status</th>
        </tr>
        </tfoot>
    </table>
<?php else: ?>
    <h3 class="text-danger text-center ">No data found !!</h3>
<?php endif; ?>
