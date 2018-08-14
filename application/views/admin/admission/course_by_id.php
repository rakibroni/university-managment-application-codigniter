<?php if (!empty($courses)) { ?>
    <table width="50%" class="table table-bordered">
        <thead>
        <tr>
            <th><input type="checkbox" name="" id="selecctall"> All</th>
            <th>Code</th>
            <th>Title</th>
            <th>Credit</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($courses as $row): ?>
            <tr>
                <td>
                    <input type="checkbox" name="COURSE_ID[]" value="<?php echo $row->COURSE_ID ?>" class="checkbox">
                    <?php $offer_id=$this->db->query("select a.OFFERED_COURSE_ID from  aca_course_offer a
where a.FACULTY_ID = $row->FACULTY_ID and a.DEPT_ID=$row->DEPT_ID and a.PROGRAM_ID =$row->PROGRAM_ID and a.COURSE_ID=$row->COURSE_ID")->row()->OFFERED_COURSE_ID ?>
                    <input type="hidden" name="OFFERED_COURSE_ID[]" value="<?php echo $offer_id ?>">
                </td>
                <td><?php echo $row->COURSE_CODE ?></td>
                <td><?php echo $row->COURSE_TITLE ?></td>
                <td><?php echo $row->CREDIT ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else {
    echo "No course found";
} ?>
