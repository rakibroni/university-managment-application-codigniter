<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th width="30%">Department</th>
        <td></span><?php echo $courses->DEPT_NAME; ?></td>
    </tr>
    <tr>
        <th>Course Code</th>
        <td></span><?php echo $courses->COURSE_CODE; ?></td>
    </tr>
    <tr>
        <th>Course Title</th>
        <td><?php echo $courses->COURSE_TITLE; ?></td>
    </tr>
    <tr>
        <th>Credits</th>
        <td><?php echo $courses->CREDIT; ?></td>
    </tr>
    <tr>
        <th>Course Category</th>
        <td><?php echo $courses->COURSE_CATEGORY; ?></td>
    </tr>
    <tr>
        <th>Global For Institute/ Faculty</th>
        <td><?php echo ($courses->GLOBAL_FOR_INSTITUTE == 1) ? "Institute" : "Faculty"; ?></td>
    </tr>
    </tbody>
    </tbody>
</table>
<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th>Description</th>
        <td style="text-align: justify; "><?php echo $courses->COURSE_DESC; ?></td>
    </tr>
    <tr>
        <th>Technical Method</th>
        <td style="text-align: justify; "><?php echo $courses->TEACHING_METHOD; ?></td>
    </tr>
    <tr>
        <th>Mission</th>
        <td style="text-align: justify; "><?php echo $courses->MISSION; ?></td>
    </tr>
    <tr>
        <th>Vision</th>
        <td style="text-align: justify; "><?php echo $courses->VISION; ?></td>
    </tr>
    <tr>
        <th>Objective</th>
        <td style="text-align: justify; "><?php echo $courses->OBJECTIVE; ?></td>
    </tr>
    <tr>
        <th>Books</th>
        <td style="text-align: justify; "><?php echo $courses->BOOKS; ?></td>
    </tr>
    </tbody>
</table>