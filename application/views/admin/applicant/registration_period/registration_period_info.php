<div class="col-md-12 text-center " style="visibility: visible; animation-name: fadeInRight; top:-20px;">
    <h3>Department of <?php echo $regPer->DEPT_NAME; ?></h3>
    <?php if ($regPer->PROGRAM_NAME == 0): ?>
        <h4>All Program</h4>
    <?php else: ?>
        <h4>Program of <?php echo $regPer->PROGRAM_NAME; ?></h4>
    <?php endif; ?>
</div>
<h3 class="text-center">Registration Info</h3>
<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <th width="20%">Title</th>
        <td style="text-align: justify; "><?php echo $regPer->RP_TITLE; ?></td>
    </tr>
    <tr>
        <th width="20%">Semester</th>
        <td style="text-align: justify; "><?php echo $regPer->LKP_NAME; ?></td>
    </tr>
    <tr>
        <th width="20%">session</th>
        <td style="text-align: justify; "><?php echo $regPer->SESSION_NAME . " (" . $regPer->YEAR_SETUP_TITLE . ")"; ?></td>
    </tr>
    <tr>
        <th width="20%">Description</th>
        <td style="text-align: justify; "><?php echo $regPer->RP_DESC; ?></td>
    </tr>
    <tr>
        <th width="20%">From date</th>
        <td style="text-align: justify; "><?php echo date('d-M-Y', strtotime($regPer->FROM_DT)); ?></td>
    </tr>
    <tr>
        <th width="20%">End date</th>
        <td style="text-align: justify; "><?php echo date('d-M-Y', strtotime($regPer->TO_DT)); ?></td>
    </tr>

    </tbody>
</table>
