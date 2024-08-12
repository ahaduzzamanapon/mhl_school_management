<!--Start page level style-->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!--Start page level style-->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('sto_ivc'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_stor_manage'); ?> </li>
                    <li> <?php echo lang('header_inven_cate'); ?> </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>
            </div>
            <div class="col-md-7">
                <div class="portlet box purple margin-bottom-15">
                    <div class="portlet-title">
                        <div class="caption"> Update Inventory Item</div>
                        <div class="tools"> <a class="collapse" href="javascript:;">  </a> </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('stock/edit_inv_item/'.$info->id, $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name<span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input  class="form-control" type="text" name="item_name" value="<?php echo set_value('item_name',$info->item_name)?>" placeholder="" data-validation="required" data-validation-error-msg="Item name required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Serial No. </label>
                                <div class="col-md-5">
                                    <input  class="form-control" type="text" name="item_serial" value="<?php echo set_value('item_serial',$info->item_serial)?>" placeholder="" data-validation="" data-validation-error-msg="Item serial no required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Category<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                        $attr = 'class="form-control" data-validation="required" data-validation-error-msg="Category required"';
                                        echo form_dropdown('item_category_id', $inv_category, $info->item_category_id, $attr);
                                    ?>
                                </div>
                            </div>                            

                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantity <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_qty" value="<?php echo set_value('item_qty',$info->item_qty)?>" placeholder="" data-validation="required" data-validation-error-msg="Item quantity required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Cost Price <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_cost" value="<?php echo set_value('item_cost',$info->item_cost)?>" placeholder="" data-validation="required" data-validation-error-msg="Cost price required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Retail Price <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_retail" value="<?php echo set_value('item_retail',$info->item_retail)?>" placeholder="" data-validation="required" data-validation-error-msg="Retail price required">
                                </div>
                            </div>


                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="submit" class="btn green" value="Submit">Update</button>
                                <!-- <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button> -->
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate();</script>
<script>
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>