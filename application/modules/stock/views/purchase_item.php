<!--Start page level style-->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<!--Start page level style-->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title"> Purchase Item</h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_stor_manage'); ?> </li>
                    <li> Purchase Item </li>
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
            <div class="col-md-5">
                <div class="portlet box purple margin-bottom-15">
                    <div class="portlet-title">
                        <div class="caption"> Purchase Inventory Item</div>
                        <div class="tools"> <a class="collapse" href="javascript:;">  </a> </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('stock/purchase_item', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date<span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" name="purc_date" class="form-control" value="<?php echo date("d-m-Y")?>" data-validation="required" >
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Vendor<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                        $attr = 'class="form-control" data-validation="required" data-validation-error-msg="Select vendor"';
                                        echo form_dropdown('purc_vendor_id', $vendors, '', $attr);
                                    ?>
                                </div>
                            </div>      

                            <div class="form-group">
                                <label class="col-md-3 control-label">Items<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                        $attr = 'class="form-control" data-validation="required" data-validation-error-msg="Select item"';
                                        echo form_dropdown('purc_item_id', $items, '', $attr);
                                    ?>
                                </div>
                            </div>                    

                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantity <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="purc_quantity" placeholder="" data-validation="required" data-validation-error-msg="Item quantity required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Comment </label>
                                <div class="col-md-8">
                                    <input  class="form-control" type="text" name="purc_coment" placeholder="">
                                </div>
                            </div>

                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="submit" class="btn green" value="Submit">Save</button>
                                <!-- <button type="reset" class="btn default"><?php echo lang('refresh'); ?></button> -->
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"> Purchase Inventory Item List </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th> SL </th>
                                    <th> Vendor Name </th>
                                    <th> Item Name </th>
                                    <th> Quantity </th>
                                    <th> Date </th>
                                    <th> Comments </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($results as $row) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $i; ?> </td>
                                        <td> <?php echo $row->company_name?> </td>
                                        <td> <?php echo $row->item_name?> </td>
                                        <td> <?php echo $row->purc_quantity?> </td>
                                        <td> <?php echo $row->purc_date?> </td>
                                        <td> <?php echo $row->purc_coment?> </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
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

<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate();</script>

<script>
    //$('.datepicker').datepicker();

    $(".monty-year-picker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });
</script>

<script>
    jQuery(document).ready(function () {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>