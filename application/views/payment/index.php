<style>
    .highrow{ border-top: 3px solid #111 !important; background: #f2f2f2; color: red;}
    .amount{ width: 30px;}
    form{ background: none;}
    h1{ margin: 0;}
</style>
<form id='payment_gw' name='payment_gw' method='POST' action='https://www.sslcommerz.com.bd/gwprocess/testbox/'>
    <!-- MANDATORY / REQUIRED PARAMETERS !-->
    <input type="hidden" name="total_amount" value='1000.00'>
    <input type="hidden" name="store_id" value='test_atilimited001'>
    <input type="hidden" name="tran_id" value='123456'>
    <input type="hidden" name="success_url" value="<?php echo site_url('payment/success'); ?>"/>
    <input type="hidden" name="fail_url" value="<?php echo site_url('payment/fail'); ?>"/>
    <input type="hidden" name="cancel_url" value="<?php echo site_url('payment/cancel'); ?>"/>
    <!-- OPTIONAL / SEND API VERSION !--> <input type="hidden" name="version" value="2.00" />
    <!-- OPTIONAL / SHOPPING CART LIST !-->
    <!-- PRODUCT LIST !-->
    <input type='hidden' name='cart[0][product]' value='Registration Fess' />
    <input type='hidden' name='cart[0][amount]' value='1000.00' />
    <!-- OPTIONAL / CHOOSE DEFAULT BANK !-->
    <input type="hidden" name="card_name" value='mtbl'> <input type="hidden" name="show_all_gw" value="1" />
    <!-- SUBMIT REQUEST !-->
    <div class="card">
        <div class="card-body" style="padding: 5px;">
            <div class="col-md-12">
                <div class="panel" style="border:none !important; box-shadow: none !important; margin-bottom: 0;">
                    <div class="panel-body">
                        <div class="card"><br />
                            <div class="text-center">You have to pay</div>
                            <h3 class="text-center" style="margin-top:0;">REGISTRATION FEE</h3>
                            <div class="card-body card-padding bgm-pink c-white">
                                <h1 class="text-center">
                                    1000.00 TK
                                </h1>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-danger">** In case of failure, Money will not be charged. **</div><br /><br />
                            <input type="submit" class="btn btn-success btn-sm" name="submit" value='Pay Now'>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </div>
</form>