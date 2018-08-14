<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th width="30%">Session</th>
        <td><?php echo $exam->SESSION_NAME; ?></td>
    </tr>

    <tr>
        <th width="30%">Exam Title</th>
        <td><?php echo $exam->EX_TITLE; ?></td>
    </tr>
    <tr>
        <th width="30%">Description</th>
        <td><?php echo $exam->EX_DESC; ?></td>
    </tr>
    <tr>
        <th width="30%">From</th>
        <td><?php echo date('d-M-Y', strtotime($exam->EX_DT_FROM)); ?></td>
    </tr>
    <tr>
        <th width="30%">To</th>
        <td><?php echo date('d-M-Y', strtotime($exam->EX_DT_TO)); ?></td>
    </tr>

    <tr>
        <th width="30%">Program</th>
        <td><ol><?php $program= $this->db->query("select b.PROGRAM_NAME from exam_programs a
                                            left join program b on a.PROGRAM_ID = b.PROGRAM_ID
                                            where a.EXAM_ID= $exam->EXAM_ID")->result();
            foreach($program as $row)echo '<li>'.$row->PROGRAM_NAME.'</li>' ?></ol></td>
    </tr>

    </tbody>
</table>
