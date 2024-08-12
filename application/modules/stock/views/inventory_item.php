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
            <div class="col-md-5">
                <div class="portlet box purple margin-bottom-15">
                    <div class="portlet-title">
                        <div class="caption"> Add New Inventory Item</div>
                        <div class="tools"> <a class="collapse" href="javascript:;">  </a> </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('stock/inventory_item', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name<span class="requiredStar"> * </span></label>
                                <div class="col-md-5">
                                    <input  class="form-control" type="text" name="item_name" placeholder="" data-validation="required" data-validation-error-msg="Item name required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Serial No. </label>
                                <div class="col-md-5">
                                    <input  class="form-control" type="text" name="item_serial" placeholder="" data-validation="" data-validation-error-msg="Item serial no required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Category<span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <?php
                                        $attr = 'class="form-control" data-validation="required" data-validation-error-msg="Category required"';
                                        echo form_dropdown('item_category_id', $inv_category, '', $attr);
                                    ?>
                                </div>
                            </div>                            

                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantity <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_qty" placeholder="" data-validation="required" data-validation-error-msg="Item quantity required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Cost Price <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_cost" placeholder="" data-validation="required" data-validation-error-msg="Cost price required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Retail Price <span class="requiredStar"> </span></label>
                                <div class="col-md-4">
                                    <input  class="form-control" type="text" name="item_retail" placeholder="" data-validation="required" data-validation-error-msg="Retail price required">
                                </div>
                            </div>


                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="submit" class="btn green" value="Submit"><?php echo lang('sto_addcat'); ?></button>
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
                        <div class="caption"> Inventory Item List </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th> SL </th>
                                    <th> Item Name </th>
                                    <th> Cost P. </th>
                                    <th> Retail P. </th>
                                    <th> Category </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($results as $row) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $i; ?> </td>
                                        <td> <?php echo $row->item_name?> </td>
                                        <td> <?php echo $row->item_cost?> </td>
                                        <td> <?php echo $row->item_retail?> </td>
                                        <td> <?php echo $row->category_name?> </td>
                                        <td>
                                            <a class="btn btn-xs default" href="index.php/stock/edit_inv_item/<?php echo $row->id?>"> <i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                            <a class="btn btn-xs green" href="index.php/stock/inventory_history/<?php echo $row->id?>"> <i class="fa fa-tag"></i> Inv </a>
                                            <!-- <a class="btn btn-xs red" href="index.php/stock/delete_item?id=<?php echo $row->id?>" onClick="javascript:return confirm('<?php echo lang('sto_sidcon'); ?>')"> <i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a> -->
                                        </td>
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