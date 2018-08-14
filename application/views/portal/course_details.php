<table class="table table-striped table-hover">
    <tbody>
    <?php foreach ($course as $row) { ?>
    <tr>
        <th width="25%">Title</th>
        <td><?php echo "<b>" . $row->COURSE_CODE . " :</b>&nbsp;" . $row->COURSE_TITLE; ?></td>
    </tr>
    <tr>
        <th width="25%">Credits</th>
        <td><?php echo $row->CREDIT; ?></td>
    </tr>

    </tbody>
    </tbody>
</table>
<h3 class="text-center">COURSE OUTLINE</h3>
<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th>Description</th>
        <td style="text-align: justify; "><?php echo $row->COURSE_DESC; ?></td>
    </tr>
    <tr>
        <th>Technical Method</th>
        <td style="text-align: justify; "><?php echo $row->TEACHING_METHOD; ?></td>
    </tr>
    <tr>
        <th>Mission</th>
        <td style="text-align: justify; "><?php echo $row->MISSION; ?></td>
    </tr>
    <tr>
        <th>Vision</th>
        <td style="text-align: justify; "><?php echo $row->VISION; ?></td>
    </tr>
    <tr>
        <th>Objective</th>
        <td style="text-align: justify; "><?php echo $row->OBJECTIVE; ?></td>
    </tr>
    <tr>
        <th>Books</th>
        <td style="text-align: justify; "><?php echo $row->BOOKS; ?></td>
    </tr>

    </tbody>
</table>
<!-- <hr>
<h3 class="text-center">Course Topic Information</h3>
<table class="table table-striped table-hover" >
<tbody>
        <tr><th>Topic Title</th><td style="text-align: justify; "><?php echo $row->TOPIC_TITLE; ?></td></tr>
        <tr><th>Description</th><td style="text-align: justify; "><?php echo $row->TOPIC_DESC; ?></td></tr>
        <tr><th>Duration</th><td style="text-align: justify; "><?php echo $row->TOPIC_DURATION; ?></td></tr>
        <tr><th>Activities</th><td style="text-align: justify; "><?php echo $row->SUGGESTED_ACTIVITIES; ?></td></tr>
    <?php } ?>
</tbody>
</table> -->