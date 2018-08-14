<div class="col-md-12 text-center " style="visibility: visible; animation-name: fadeInRight; top:-20px;">
    <h3>Department of <?php echo $courseTopic->DEPT_NAME; ?></h3>
    <h4><?php echo $courseTopic->COURSE_CODE . " :&nbsp;" . $courseTopic->COURSE_TITLE; ?></h4>
</div>
<h3 class="text-center">COURSE TOPICS</h3>
<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th width="20%">Topic Name</th>
        <td style="text-align: justify; "><?php echo $courseTopic->TOPIC_TITLE; ?></td>
    </tr>
    <tr>
        <th width="20%">Description</th>
        <td style="text-align: justify; "><?php echo $courseTopic->TOPIC_DESC; ?></td>
    </tr>
    <tr>
        <th width="20%">Duration</th>
        <td style="text-align: justify; "><?php echo $courseTopic->TOPIC_DURATION; ?></td>
    </tr>
    <tr>
        <th width="20%">Activities</th>
        <td style="text-align: justify; "><?php echo $courseTopic->SUGGESTED_ACTIVITIES; ?></td>
    </tr>

    </tbody>
</table>