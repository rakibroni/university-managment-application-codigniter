<?php
if (isset($_POST['find_deg'])) {
    if ($_POST['find_deg'] != '') {
        $find_deg = $_POST['find_deg'];
        $degreeList = $this->db->query("SELECT * FROM degree WHERE DEGREE_NAME LIKE '%$find_deg%'")->result();
        foreach ($degreeList as $degreeInfo) {
            ?>
            <li class="success-element">
                <?php echo $degreeInfo->DEGREE_NAME; ?>

            </li>
        <?php
        }
    }
}

if (isset($_POST['find_fac'])) {
    if ($_POST['find_fac'] != '') {
        $find_fac = $_POST['find_fac'];
        $facultyList = $this->db->query("SELECT * FROM faculty WHERE FACULTY_NAME LIKE '%$find_fac%'")->result();
        foreach ($facultyList as $facultyInfo) {
            ?>
            <li class="success-element">
                <?php echo $facultyInfo->FACULTY_NAME; ?>

            </li>
        <?php
        }
    }
}

if (isset($_POST['find_prog'])) {
    $find_prog = $_POST['find_prog'];
    $programList = $this->db->query("SELECT * FROM program WHERE PROGRAM_NAME LIKE '%$find_prog%'")->result();
    foreach ($programList as $programInfo) {
        ?>
        <tr class="read">
            <td><span class="openModal" title="Course offer of program" id="<?php echo $programInfo->PROGRAM_ID; ?>"
                      data-action="portal/applyProg" data-type="edit"><a
                        href="#"><?php echo $programInfo->PROGRAM_NAME; ?></a></span></td>
            <td class="text-right"><span class="label label-warning pull-right openModal pointer"
                                         title="Course offer of program" id="<?php echo $programInfo->PROGRAM_ID; ?>"
                                         data-action="portal/applyProg" data-type="edit">Course Offered</span></td>
        </tr>
    <?php
    }
}
if (isset($_POST['find_deg_program'])) {
    $degree_id = $_POST['find_deg_program'];
    $programList = $this->utilities->findAllByAttribute('program', array('DEGREE_ID' => $degree_id));
    foreach ($programList as $programInfo) {
        ?>
        <tr class="read">
            <td><span class="openModal" title="Course offer of program" id="<?php echo $programInfo->PROGRAM_ID; ?>"
                      data-action="portal/applyProg" data-type="edit"><a
                        href="#"><?php echo $programInfo->PROGRAM_NAME; ?></a></span></td>
            <td class="text-right"><span class="label label-warning pull-right openModal pointer"
                                         title="Course offer of program" id="<?php echo $programInfo->PROGRAM_ID; ?>"
                                         data-action="portal/applyProg" data-type="edit">Course Offered</span></td>
        </tr>
    <?php
    }
}
?>