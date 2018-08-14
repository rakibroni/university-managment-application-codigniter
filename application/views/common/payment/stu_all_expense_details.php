<style>
    .ibox {
        margin-bottom: 3px;
    }
    .ibox-bordered{border: 1px solid #18A689;}

    .ibox-title {
        padding: 5px;
        background: #18A689;
        color: #fff;
    }
</style>
<div>
        <?php
        $total_due = 0;
        $total_bal = 0;
        $total_amt_bal = 0;
        $total_amt_due = 0;
        $i = 0;
        if (!empty($expenses)):
            $i = 0;
            /*print_r($expenses);
            exit();*/
            foreach ($expenses as $expense):
                $exp_cond = array(
                    "FACULTY_ID" => $txtFaculty,
                    "DEPT_ID" => $txtDept,
                    "PROGRAM_ID" => $txtProgram,
                    "SEMESTER_ID" => $expense->LKP_ID,
                    "SESSION_ID" => $expense->SESSION_ID
                );
                $expense_heads = $this->utilities->findAllByAttributeWithJoin("ac_program_particulars", "ac_academic_charge", "PARTICULAR_ID", "CHARGE_ID", "CHARGE_NAME", $exp_cond);
                $dueAmt = $this->db->query("SELECT v.VOUCHER_NO, v.VOUCHER_DT, v.STUDENT_ID, v.ROLL_NO, v.REMARKS, l.TRX_CODE_NO, l.TRX_TRAN_NO, l.CR_AMT, sum(l.DR_AMT) DEBIT
                                                                            FROM bm_vouchermst v INNER JOIN bm_vn_ledgers l ON v.VOUCHER_NO = l.VOUCHER_NO
                                                                            WHERE v.STUDENT_ID = '$txtStudent' AND v.SEMESTER_ID = $expense->LKP_ID AND l.TRX_CODE_NO = 'PM' GROUP BY v.STUDENT_ID")->row();
                ?>
                <div class="ibox ibox-bordered">
                    <div class="ibox-title" style="min-height: 60px;">
                        <h5><?php echo $expense->LKP_NAME; ?> - <?php echo $expense->SESSION; ?></h5>
                        <input type="hidden" id="expense_<?php echo $i; ?>" data-seq="<?php echo $i; ?>"
                               value="<?php echo $expense->LKP_NAME; ?> - <?php echo $expense->SESSION; ?>"
                               class="expense_name"/>
                        <input type="hidden" id="expense_amt_<?php echo $i; ?>" value="0.00" class="expense_amt"/>
                        <input type="hidden" id="expense_ttl_amt_<?php echo $i; ?>" value="0.00"/>
                        <input type="hidden" id="pay_amt_<?php echo $i; ?>" value="0.00"/>

                        <div class="ibox-tools"><a class="collapse-link pull-right" data-placement="left" data-toggle="tooltip"  title="Click here to view expense details of this semester"><i class="fa fa-chevron-up"></i></a></div>
                        <div style="clear: left;" id="total_label_<?php echo $i; ?>"></div>
                        <br clear="all"/>
                    </div>
                    <div class="ibox-content" style="padding: 5px;">
                        <ul class="todo-list m-t small-list" id="expenseList">
                            <?php
                            $sem_total = 0;
                            if (!empty($expense_heads)):
                                $j = 0;
                                foreach ($expense_heads as $expense):
                                    ?>
                                    <li>
                                        <?php
                                        if (!empty($dueAmt) && $dueAmt->DEBIT == 0) {
                                            ?>
                                            <option
                                                value="<?php echo $semester->SEMESTER_ID ?>" <?php echo $selected; ?>
                                                data-numb="<?php echo $semester->SEMESTER_ID ?>"><?php echo $semester->SEMESTER_NAME ?></option>
                                        <?php
                                        }
                                        ?>
                                        <label
                                            for="checkbox<?php echo $j; ?>"><?php echo $expense->CHARGE_NAME; ?></label>

                                        <div class="pull-right"
                                             style="font-size: 14px; margin-top: 4px;"><?php echo number_format($expense->PARTICULAR_AMOUNT, 2); ?></div>

                                    </li>
                                    <?php
                                    $sem_total += $expense->PARTICULAR_AMOUNT;
                                    $j++;
                                endforeach;
                            endif;
                            ?>
                            <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
                            <li style=" border-radius: 0;border-top:1px solid #000;">
                                <div class="pull-right text-danger">Total =
                                    <strong><?php echo number_format($sem_total, 2); ?></strong></div>
                                <br clear="all"/></li>
                            <li style=" border-radius: 0;">
                                <div class="pull-left text-danger">Payment
                                    Date: <?php echo !empty($dueAmt) ? date('d-m-Y', strtotime($dueAmt->VOUCHER_DT)) : '';?></div>
                                <div class="pull-right text-danger">Payment = <strong
                                        id="payment<?php echo $i; ?>"><?php echo number_format($totalPayment = (!empty($dueAmt) ? $dueAmt->DEBIT : 0), 2); ?></strong>
                                </div>
                                <br clear="all"/></li>
                            <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
                            <?php
                            if ($totalPayment < $sem_total) {
                                ?>
                                <li style="border-top:1px solid #000; border-radius: 0; ">
                                    <div class="pull-right" id="balance<?php echo $i; ?>"><span class="text-danger">Total Due = <strong
                                                id="total_amt"><?php echo number_format($total_amt_due = ($sem_total - $totalPayment), 2); ?></strong></span>
                                    </div>
                                    <br clear="all"/></li>
                                <?php
                                $total_due = $total_amt_due;
                            } else {
                                ?>
                                <li style="border-top:1px solid #000; border-radius: 0; ">
                                    <div class="pull-right" id="balance<?php echo $i; ?>"><span class="">Total Balance = <strong
                                                id="total_amt"><?php echo number_format($total_amt_bal = ($totalPayment - $sem_total), 2); ?></strong></span>
                                    </div>
                                    <br clear="all"/></li>
                                <?php
                                $total_bal = $total_amt_bal;
                            }
                            ?>
                        </ul>
                        <script>
                            $("#total_label_<?php echo $i; ?>").html($("#balance<?php echo $i; ?>").html() + " BDT");
                            $("#expense_amt_<?php echo $i; ?>").val("<?php echo ($total_due != '') ? $total_due : 0; ?>");
                            $("#pay_amt_<?php echo $i; ?>").val("<?php echo $totalPayment; ?>");
                            $("#expense_ttl_amt_<?php echo $i; ?>").val("<?php echo $sem_total; ?>");
                        </script>
                    </div>
                </div>
                <?php
                $i++;
            endforeach;
            ?>
        <?php
        endif;
        ?>
        <ul class="todo-list m-t small-list" id="expenseList" style="margin: 0;">
            <li style="border-bottom:1px solid #000; background: none; border-radius: 0; padding: 0;"></li>
            <li style=" border-radius: 0; border-top:1px solid #000;">
                <div class="pull-right text-danger">Net Total =
                    <strong><?php echo number_format(($total_due - $total_bal), 2); ?> BDT</strong></div>
                <br clear="all"/></li>
        </ul>
</div>
<br clear="all" />
<script>
    // Collapse ibox function
    $('.collapse-link').click(function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var barOptions = {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.8
                        }, {
                            opacity: 0.8
                        }]
                    }
                }
            },
            xaxis: {
                min: 0,
                max: 7,
                mode: null,
                ticks: [
                    [1, "1"],
                    [2, "2"],
                    [3, "3"],
                    [4, "4"],
                    [5, "5"],
                    [6, "6"]

                ],
                tickLength: 0,
                axisLabel: "Sem",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                axisLabelPadding: 5
            },
            colors: ["#1ab394"],
            grid: {
                color: "#999999",
                hoverable: true,
                clickable: true,
                tickColor: "#D4D4D4",
                borderWidth: 0
            },
            legend: {
                show: false
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        };
        var barData = {
            label: "bar",
            data: [
                [1, 3.5],
                [2, 3.15],
                [3, 3.00],
                [4, 3.75],
                [5, 3.5],
                [6, 3.75]
            ]
        };


        /*!
         * Pause jQuery plugin v0.1
         *
         * Copyright 2010 by Tobia Conforto <tobia.conforto@gmail.com>
         *
         * Based on Pause-resume-animation jQuery plugin by Joe Weitzel
         *
         * This program is free software; you can redistribute it and/or modify it
         * under the terms of the GNU General Public License as published by the Free
         * Software Foundation; either version 2 of the License, or(at your option)
         * any later version.
         *
         * This program is distributed in the hope that it will be useful, but WITHOUT
         * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
         * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
         * more details.
         *
         * You should have received a copy of the GNU General Public License along with
         * this program; if not, write to the Free Software Foundation, Inc., 51
         * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
         */
        /* Changelog:
         *
         * 0.1    2010-06-13  Initial release
         */
        (function () {
            var $ = jQuery,
                pauseId = 'jQuery.pause',
                uuid = 1,
                oldAnimate = $.fn.animate,
                anims = {};

            function now() {
                return new Date().getTime();
            }

            $.fn.animate = function (prop, speed, easing, callback) {
                var optall = $.speed(speed, easing, callback);
                optall.complete = optall.old; // unwrap callback
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // start animation
                    var opt = $.extend({}, optall);
                    oldAnimate.apply($(this), [prop, $.extend({}, opt)]);
                    // store data
                    anims[this[pauseId]] = {
                        run: true,
                        prop: prop,
                        opt: opt,
                        start: now(),
                        done: 0
                    };
                });
            };

            $.fn.pause = function () {
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // fetch data
                    var data = anims[this[pauseId]];
                    if (data && data.run) {
                        data.done += now() - data.start;
                        if (data.done > data.opt.duration) {
                            // remove stale entry
                            delete anims[this[pauseId]];
                        } else {
                            // pause animation
                            $(this).stop();
                            data.run = false;
                        }
                    }
                });
            };

            $.fn.resume = function () {
                return this.each(function () {
                    // check pauseId
                    if (!this[pauseId])
                        this[pauseId] = uuid++;
                    // fetch data
                    var data = anims[this[pauseId]];
                    if (data && !data.run) {
                        // resume animation
                        data.opt.duration -= data.done;
                        data.done = 0;
                        data.run = true;
                        data.start = now();
                        oldAnimate.apply($(this), [data.prop, $.extend({}, data.opt)]);
                    }
                });
            };
        })();

        $(document).on('click', '.notice_marque_fn', function () {
            $('.notice_marquee').marquee({
                delayBeforeStart: 0,
                direction: 'up',
                duration: 10000,
                pauseOnHover: true,
                allowCss3Support: false,
                duplicated: true
            });
        });

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:+0'
        });

    });

</script>



