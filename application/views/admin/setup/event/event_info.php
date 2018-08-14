<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><h5><b>Course </b></h5></td>
                        <td style="padding-left: 20px;"><?php echo $event->E_TITLE; ?></td>
                    </tr>

                    <tr>
                        <td><h5><b>Start Date</b></h5></td>
                        <td style="padding-left: 20px;"><?php echo $event->START_DT . ' &nbsp;&nbsp;&nbsp;<b> Time </b>&nbsp;&nbsp;:&nbsp;&nbsp;' . $event->START_TIME; ?> </td>
                    </tr>
                    <tr>
                        <td><h5><b>End Date</b></h5></td>
                        <td style="padding-left: 20px;"><?php echo $event->END_DT . ' &nbsp;&nbsp;&nbsp;  <b>Time </b>&nbsp;&nbsp;:&nbsp;&nbsp;' . $event->END_TIME; ?></td>
                    </tr>
                    <tr>
                        <td><h5><b>Description</b></h5></td>
                        <td style="padding-left: 20px;"><p><?php echo $event->E_DESC; ?></p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>