<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('acc_slipdetails'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                        <?php // echo lang('header_teansec'); ?>
                        Student's Payments
                    </li>
                    <li>
                        <?php // echo lang('acc_slipdetails'); ?>
                        Take Payment
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12" >
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                             Take Payment 
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    
                    <div class="portlet-body form">
                        <?php $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
                        echo form_open_multipart("account/edit_fee_pay?sid=$slip_id", $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($success)) {
                                echo $success;
                            }
                            ?>
                             <div class="form-group">
                                <label class="col-md-3 control-label">Total Amount <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $paymentData->total; ?>" id="total" name="total" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Paid <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $paymentData->payment; ?>" id="paid" name="paid" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fine <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" onkeyup="setFine()" value="<?php echo $paymentData->fine; ?>" id="fine" name="fine" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fee <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?php echo $paymentData->amount; ?>" id="amount" name="amount" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Total Due <span class="requiredStar">  </span></label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="total_due" value="<?php echo $paymentData->due; ?>"  name="total_due" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Current Payment <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input required="true" type="text" class="form-control" placeholder="Enter Payment Amount" name="current_payment" data-validation="required" data-validation-error-msg="Pleas enter your payment amount.">
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $paymentData->student_id; ?>" name="student_id">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Payment Type <span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <select required="true" data-validation="required" name="method" class="form-control" data-validation="required" data-validation-error-msg="Pleas select payment method.">
                                        <option value="Cash"> Cash </option>
                                        <option value="Card"> Card </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="submit"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Save &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript" src="assets/admin/layout/scripts/jQuery.print.js"></script>
<script>
    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top

        $("#print").find('.print-link').on('click', function () {
            //Print print with default options
            $.print("#print");
        });
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 5000));
    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();


    function setFine(){

        var total = $('#total').val();
        var paid = $('#paid').val();
        var fine = $('#fine').val();
        var balance = $('#balance').val();

        var total_due = (+total + +fine) - (+paid + +balance) ;   
        //alert(total_due);
        $('#total_due').val(total_due);
    }

</script>

